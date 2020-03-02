<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {


	function __construct()
	{
		parent::__construct();
		//model
		$models = array(
			'post_model' => 'blog',
			'page_model' => 'pm'
		);
		
		$this->load->model($models);

		$this->load->library('user_agent');

		$this->lang->load('posts_lang');
	
	}

	public function index()
	{
		$url_page = $this->uri->segment(2);
		
		if($url_page != null){
			
			$query = $this->pm->get_by_url($url_page);

			if($query){

				$this->_template['page'] = 'pages/index';

				$data['pages'] = $query;

				//set section of the template
				$load_section = array(
					'menu' => 'themes/'.$this->_template['themes'].'/section/menu',
					'footer' => 'themes/'.$this->_template['themes'].'/section/footer', 
				);

				$this->load_template($this->_template['page'], $data, $load_section);

			} else {
				show_404();
			}

		} else {
			show_404();
		}
	
	}

	public function search()
	{

	}

	public function not_found()
	{
		$this->output->set_status_header('404');
		
		echo "Not found";

		//$this->load->view('template', $data);
	}
}
