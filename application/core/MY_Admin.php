<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Admin_Controller extends CI_Controller {

	public $user_agent;  //var user agent
	public $platform;  //var user agent
	public $language; //var for language
	public $notif; //var for notification alert

	public function __construct() {
		parent::__construct();

		$lib_array = array('user_agent','ion_auth');
		$this->load->library($lib_array);
                
        //set the language default here
		if($this->session->userdata('language')) {
			$this->language = $this->session->userdata('language');
		} else {
			$this->language = "english";
		}

        //enable profiler
        //$this->output->enable_profiler(TRUE);
	}

}