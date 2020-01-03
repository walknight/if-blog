<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $user_agent;  //var user agent
	public $platform;  //var user agent
	public $language; //var for language
	public $notif; //var for notification alert

	public function __construct() {
		parent::__construct();

		$this->load->library('user_agent');
                
                //set the language default here
		/*if($this->session->userdata('language')) {
			$this->language = $this->session->userdata('language');
		} else {
			$this->language = "english";
		}*/

                //enable profiler
                #$this->output->enable_profiler(TRUE);
	}

	public function isLoggedin() {

		$logged = $this->session->userdata('logged_in');
		if(!$logged) {
			$this->session->set_flashdata('redirectToCurrent', current_url());
			redirect(site_url('admin/home/login'));
		}

	}

}