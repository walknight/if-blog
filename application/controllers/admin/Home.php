<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends MY_AdminController{

    function __construct()
    {
		parent::__construct();

		//load model,library,helper     
        $this->load->library(array('ion_auth','form_validation'));
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
		//load model
		$this->load->model('settings_model','sm');
		
		$data = array(
			'form_action' => site_url('admin/home/save_settings'),
			'social_links' => $this->sm->get_social_links(),
		);
		
		$this->output->append_title('Edit Settings');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
		$this->load->js($this->config->item('js').'mod_form_settings.js');

		$this->load->view('themes/'.$this->_template['themes'].'/layout/settings/form_settings', $data);
	}

	function save_settings()
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
		
		//load model
		$this->load->model('settings_model','sm');
		
		$this->_rules_settings();

		//cek apakah form valid
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('admin/home/site_settings'));
			
		} else {
			//buat variable array dari masing2 input form
			$params_form = array();
			$params_social = array();
			
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

	function _rules_settings()
	{
		$this->form_validation->set_rules('title', lang('form_title_post'), 'trim|required');
        $this->form_validation->set_rules('id_cat', lang('form_category_post'), 'trim|required');
        $this->form_validation->set_rules('url_title' , lang('form_url_post'), 'trim|required');
        $this->form_validation->set_rules('head_article', lang('form_head_article_post'), 'trim|required');
        $this->form_validation->set_rules('main_article', lang('form_main_content_post'), 'trim|required');
	
		//set parameter error form
		$this->form_validation->set_error_delimiters('<span class="input-notification error png_bg">', '</span>');
	}

}