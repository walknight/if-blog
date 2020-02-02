<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->model(['post_model' => 'blog']);
		
	}

	public function index()
	{

		$this->load->view('welcome_message');
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
