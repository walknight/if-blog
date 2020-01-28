<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends MY_AdminController{

    function __construct()
    {
		parent::__construct();

		//load model,library,helper     
        $this->load->library(array('ion_auth'));
		$this->load->helper(['language','form']);
	
		$this->lang->load('general');
	
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
		//load library
		$this->load->library('form_validation');
		
		$data = array(
			'form_action' => site_url('admin/home/save_settings'),
		);
		
		$this->output->append_title('Edit Settings');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
		$this->load->js($this->config->item('js').'mod_form_settings.js');

		$this->load->view('themes/'.$this->_template['themes'].'/layout/settings/form_settings', $data);
	}

	function upload_image()
	{
		if($this->input->post())
		{
			if(count($_FILES) == 0)
			{
				$this->session->set_flashdata('error', lang('error_upload_multiple_value'));

				redirect(site_url('admin/home/site_settings'));
			}

			print_r($_FILES);
			exit;

			if($_FILES['image_header']['size'] > 0 && $_FILES['image_header']['error'] == 0)
			{					
				//set upload file config
				$config = array(
					'upload_path' => $this->config->item('upload'),
					'allowed_types' => 'jpg|png|jpeg', //change this if you want to more extension files
					'overwrite' => TRUE,
					'max_size' => "2048",
				);

				$this->load->library('upload', $config);

				if ($this->upload->do_upload("image_header"))
				{						
					$dataimage = $this->upload->data();
				}
				else
				{
					$dataimage = NULL;
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
				}
			}
			else
			{
				$dataimage = ($this->input->post('def_image')) ? $this->input->post('def_image') : NULL;
			}
			//Create new post array to insert to database
			$param_post = array(
				'image_header' => ($dataimage !== NULL && is_array($dataimage)) ? $path_dir.$dataimage['file_name'] : $dataimage,
				'author' => $this->session->userdata('user_id'),
				'date_posted' => date('Y-m-d H:i:s', strtotime($this->input->post('date_posted'))),
				'meta_key' => $this->input->post('meta_key'),
				'meta_desc' => $this->input->post('meta_desc'),
				'title' => $this->input->post('title'),
				'id_cat' => $this->input->post('id_cat'),
				'url_title' => $this->input->post("url_title"),
				'head_article' => $this->input->post('head_article'),
				'main_article' => $this->input->post('main_article'),					
				'status' => ($this->input->post('status')) ? $this->input->post('status') : 'draft',
				'allow_comments' => ($this->input->post('allow_comments')) ? $this->input->post("allow_comments") : 0,
				'sticky' => ($this->input->post('sticky')) ? $this->input->post('sticky') : 0,
				'featured' => ($this->input->post('featured')) ? $this->input->post('featured') : 0,					
			);
		}
		else
		{
			$this->output->unset_template();
			echo "invalid method";
			exit;
		}
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
		$this->load->model('settings_model','sm');
		
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
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('admin/home/site_settings'));
			
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
			
			redirect(site_url('admin/home/site_settings'));
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