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
}
