<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends MY_AdminController{

    function __construct()
    {
		parent::__construct();

		//load model,library,helper     
		$array_model = array('page_model','post_model','comments_model');
		$this->load->model($array_model);
        $this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(['language','form']);
		
		$this->lang->load('general');
		$this->lang->load('posts');
	
		if(!$this->ion_auth->logged_in()){
			redirect(site_url('admin/auth/login'));
		}
	}

    function index()
    {		
		//get total pages
		$get_pages = $this->page_model->get_count_all();
		//get total posts
		$get_posts = $this->post_model->get_count_all();
		//get total comments
		$get_comments = $this->comments_model->get_count_all();
		//get total users
		$get_users = 0;

		//get latest posts
		$get_latest_post = $this->post_model->get_posts();
		//get latest comments
		
		$data = array(
			'total_pages' => $get_pages,
			'total_posts' => $get_posts,
			'total_comments' => $get_comments,
			'total_users' => $get_users,
			'latest_post' => $get_latest_post
		);

		$this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
		$this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
		$this->load->js($this->config->item('js').'mod_dashboard.js');
		$this->load->view('themes/'.$this->_template['themes'].'/layout/home', $data);

	}
	
	function welcome()
	{
		$data = array();

		$this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
		$this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
		$this->load->view('themes/'.$this->_template['themes'].'/layout/welcome', $data);
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
		$logo_data = NULL;
		$og_image_data = NULL;
		//check site logo upload
		if($_FILES['site_logo']['size'] > 0)
		{					
			//set upload file config
			$config = array(
				'upload_path' => $this->config->item('images'),
				'allowed_types' => 'jpg|png|jpeg', //change this if you want to more extension files
				'overwrite' => TRUE,
				'max_size' => "2048",
			);

			$this->load->library('upload', $config);

			if ($this->upload->do_upload("site_logo"))
			{						
				$logo_data = $this->upload->data();
			}

		}
		else
		{
			$logo_data = ($this->input->post('def_logo_image')) ? $this->input->post('def_logo_image') : NULL;
		}

		//check og_image upload
		if($_FILES['og_image']['size'] > 0)
		{					
			//set upload file config
			$config = array(
				'upload_path' => $this->config->item('images'),
				'allowed_types' => 'jpg|png|jpeg', //change this if you want to more extension files
				'overwrite' => TRUE,
				'max_size' => "2048",
			);

			$this->load->library('upload', $config);

			if ($this->upload->do_upload("og_image"))
			{						
				$og_image_data = $this->upload->data();
			}

		}
		else
		{
			$og_image_data = ($this->input->post('def_og_image')) ? $this->input->post('def_og_image') : NULL;
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
			$params_form = array(
				'admin_email' => $this->input->post('admin_email'),
				'allow_registrations' => ($this->input->post('allow_registrations')) ? 1 : 0,
				'contact_email' => $this->input->post('contact_email'),
				'email_protocal' => $this->input->post('email_protocal'),
				'enable_atom_comments' => ($this->input->post('enable_atom_comments')) ? 1 : 0,
				'enable_atom_posts' => ($this->input->post('enable_atom_posts')) ? 1 : 0,
				'enable_captcha' => ($this->input->post('enable_captcha')) ? 1 : 0,
				'enable_delicious' => ($this->input->post('enable_delicious')) ? 1 : 0,
				'enable_digg' => ($this->input->post('enable_digg')) ? 1 : 0,
				'enable_furl' => ($this->input->post('enable_furl')) ? 1 : 0,
				'enable_reddit' => ($this->input->post('enable_reddit')) ? 1 : 0,
				'enable_rss_comments' => ($this->input->post('enable_rss_comments')) ? 1 : 0,
				'enable_rss_posts' => ($this->input->post('enable_rss_posts')) ? 1 : 0,
				'enable_stumbleupon' => ($this->input->post('enable_stumbleupon')) ? 1 : 0,
				'enable_technorati' => ($this->input->post('enable_technorati')) ? 1 : 0,
				'links_per_box' => $this->input->post('links_per_box'),
				'meta_keywords' => $this->input->post('meta_keywords'),
				'months_per_archive' => $this->input->post('months_per_archive'),
				'offline_reason' => $this->input->post('offline_reason'),
				'og_image' => ($og_image_data !== NULL || $og_image_data !== '') ? $og_image_data['file_name'] : $og_image_data,
				'posts_per_page' => $this->input->post('posts_per_page'),
				'recognize_user_agent' => ($this->input->post('recognize_user_agent')) ? 1 : 0,
				'sendmail_path' => ($this->input->post('sendmail_path')) ? $this->input->post('sendmail_path') : '',
				'site_description' => $this->input->post('site_description'),
 				'site_enabled' => ($this->input->post('site_enabled')) ? 1 : 0,
				'site_logo' => ($logo_data !== NULL || $logo_data !== '') ? $logo_data['file_name'] : $logo_data, 
				'site_title' => $this->input->post('site_title'),
				'smtp_host' => ($this->input->post('smtp_host')) ? $this->input->post('smtp_host') : '',
				'smtp_pass' => ($this->input->post('smtp_pass')) ? $this->input->post('smtp_pass') : '',
				'smtp_port' => ($this->input->post('smtp_port')) ? $this->input->post('smtp_port') : '',
				'smtp_user' => ($this->input->post('smtp_user')) ? $this->input->post('smtp_user') : '',
				'system_email' => $this->input->post('system_email'),
			);	
		
			//save ke to database
			$proses = $this->sm->update($params_form);
			//update social links
			foreach($this->input->post('social') as $key => $value):
				if(array_key_exists('active', $value)){
					$this->sm->update_social_links($key, array(
							'social_url' => $value['link'],
							'active' => (array_key_exists('active', $value)) ? 1 : 0,
							'timestamp_update' => date('Y-m-d H:i:s')
						)
					);
				}
			endforeach;
			
			if($proses){
				$this->session->set_flashdata('success',lang('update_setting_success'));
			} else {
				$this->session->set_flashdata('error', lang('update_setting_failed'));
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
		$this->form_validation->set_rules('site_title', 'Site Title', 'trim|required');
        $this->form_validation->set_rules('site_description', 'Site Description', 'trim|required');
        $this->form_validation->set_rules('meta_keywords' , 'Meta Keywords', 'trim|required');
        $this->form_validation->set_rules('offline_reason', 'Offline Reason', 'trim|required');
        $this->form_validation->set_rules('site_enabled', 'Site Enable', 'required');
	
		//set parameter error form
		$this->form_validation->set_error_delimiters('<span class="input-notification error png_bg">', '</span>');
	}

}