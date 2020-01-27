<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends MY_AdminController{

    function __construct()
    {
		parent::__construct();
	
		if(!$this->ion_auth->logged_in()){
			redirect(site_url('admin/auth/login'));
		}
	}

    function index()
    {		
		$data = array();
		
		//load simple template
		//but still can change themes for further
		$this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
		$this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->view('themes/'.$this->_template['themes'].'/layout/home', $data);

	}
	
	function welcome()
	{
		echo "<pre>";
		print_r($this->session->userdata());
		echo "</pre>";
	}

    function site_settings()
	{
		//allowed user ?
		$this->ion_auth->get_allowed();
		
		//load library
		$this->load->library('form_validation');
		
		//load model
		$this->load->model('setting_model','sm');
		
		$data['tpl_data'] = array(
				'title' => "Site Setup > Settings Site Configuration ",
				'form_action' => $this->url_admin."save_settings",
				'return' => $this->sm->get_settings()
		);
		
		$this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
		$this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->view('themes/'.$this->_template['themes'].'/layout/form_settings', $data);

		$this->load->view($this->templateAdmin.'template',$data);
	}
	
	function save_settings()
	{
		if(empty($_POST))
		{
			redirect($this->url_admin.'dashboard');
			die();
		}
		
		//load library
		$this->load->library('form_validation');
		//load idel
		$this->load->model('setting_model','sm');
		
		$rules_forms = array(
				array(
					'field'=>'site_title',
					'label'=>'Site Title',
					'rules'=>'required|min_length[4]'
				),
				array(
					'field'=>'meta_key',
					'label'=>'Meta Keywords',
					'rules'=>'required'
				),
				array(
					'field'=>'site_desc',
					'label'=>'Meta Description',
					'rules'=>'required'
				),
				array(
					'field'=>'regist',
					'label'=>'Allow Registration',
					'rules'=>'required'
				),
				array(
					'field'=>'enable_cap',
					'label'=>'Enable Captcha',
					'rules'=>'required'
				),
				array(
					'field'=>'user_agent',
					'label'=>'Recognize User Agent',
					'rules'=>'required'
				),
				array(
					'field'=>'rss_post',
					'label'=>'Enable RSS Post',
					'rules'=>'required'
				),
				array(
					'field'=>'rss_comment',
					'label'=>'Enable RSS Comments',
					'rules'=>'required'
				),
				array(
					'field'=>'atom_post',
					'label'=>'Enable Atom Post',
					'rules'=>'required'
				),
				array(
					'field'=>'atom_comment',
					'label'=>'Enable Atom Comments',
					'rules'=>'required'
				),
				array(
					'field'=>'post_per_page',
					'label'=>'Post Per Page',
					'rules'=>'required'
				),
				array(
					'field'=>'links_per_box',
					'label'=>'Llinks per box',
					'rules'=>'required'
				),
				array(
					'field'=>'month_archive',
					'label'=>'Month per archive',
					'rules'=>'required'
				),
				array(
					'field'=>'enable_site',
					'label'=>'Enable Site',
					'rules'=>'required'
				),
				array(
					'field'=>'off_reason',
					'label'=>'Offline Reason',
					'rules'=>'required'
				),
				array(
					'field'=>'email_admin',
					'label'=>'Email Admin',
					'rules'=>'required|valid_email'
				)
		);
		
		//set parameter error form
		$this->form_validation->set_error_delimiters('<span class="input-notification error png_bg">', '</span>');
		//insert variabel rules form
		$this->form_validation->set_rules($rules_forms);
		//cek apakah form valid
		if($this->form_validation->run() == FALSE)
		{
			/* setting file template dan data */
			$data['tpl_page'] = 'settings/form_settings';
			$data['tpl_data'] = array(
					'title' => "Site Setup > Settings Site Configuration ",
					'form_action' => $this->url_admin."save_settings",
					'return' => $this->sm->get_settings()
			);
			print_r($_POST);
			echo validation_errors();
			//load the form view
			$this->load->view($this->templateAdmin.'template',$data);
			
		} else {
			//buat variable array dari masing2 input form
			$params_form = array(
				'site_title' => $this->input->post('site_title'),
				'site_description' => $this->input->post('site_desc'),
				'meta_keywords' => $this->input->post('meta_key'),
				'allow_registrations' => $this->input->post('regist'),
				'enable_captcha' => $this->input->post('capthca'),
				'recognize_user_agent' => $this->input->post('user_agent'),
				'enable_rss_post' => $this->input->post('rss_post'),
				'enable_rss_comments' => $this->input->post('rss_comment'),
				'enable_atom_post' => $this->input->post('atom_post'),
				'enable_atom_comments' => $this->input->post('atom_comment'),
				'post_per_page' => $this->input->post('post_per_page'),
				'links_per_box' => $this->input->post('links_per_box'),
				'months_per_archive' => $this->input->post('month_archive'),
				'enabled' => $this->input->post('enable_site'),
				'offline_reason' => $this->input->post('off_reason'),
				'admin_email' => $this->input->post('email_admin')
				
			);
			
			//save ke dalam database content
			$proses = $this->sm->update($params_form);
			
			if($proses == 0){
				$this->session->set_flashdata('success','Berhasil mengubah seting website');
			} else {
				$this->session->set_flashdata('error','Gagal mengubah seting website. Hubungi Administrator untuk masalah ini.');
			}
			
		
			redirect($this->url_admin.'site_settings');
		}
	}

	public function not_allowed()
	{
		//load simple template
		//but still can change themes for further
		$this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
		$this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata', 'themes/'.$this->_template['themes'].'/static/notification');

		$this->load->view('themes/'.$this->_template['themes'].'/layout/blank');
	}

}