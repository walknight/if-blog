<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $language; //var for language
	public $notif; //var for notification alert
	public $_template; //var for themes
	public $_settings; //var site settings

	public function __construct() {
		parent::__construct();

		$lib_array = array('user_agent','cmscore_library');
		$this->load->library($lib_array);
                
        //set the language default here
		if($this->session->userdata('language')) {
			$this->language = $this->session->userdata('language');
		} else {
			$this->language = "english";
		}

		//get settings
		$this->_settings = $this->cmscore_library->settings;
		//load active template
		//load base tempalte and default title
		$this->_template['themes'] = $this->cmscore_library->getActiveTemplate();

		$masterpage = $this->_template['themes'].'/base_template';
		$title = $this->_settings['site_title'];
		
		//set masterpage template and default title
		$this->_init_template($masterpage, $title);
		
        //enable profiler
        //$this->output->enable_profiler(TRUE);
	}

	public function _init_template($base_template, $default_title='')
	{
		$this->output->set_template($base_template);
		$this->output->set_title($default_title);
	}

	public function load_template($page_name, $data = NULL, $section=NULL)
	{
		$data['page'] = $page_name;

		if ($this->_settings['recognize_user_agent'] == 1)
		{
			if ($this->agent->is_mobile())
			{
				//load mobile template soon...
				$this->load->view('mobile/layout/container', $data);
				
			}
			else
			{
				if($section != NULL && is_array($section))
				{
					foreach($section as $key => $value):
						
						if(is_array($value)){
							$this->load->section($key, $value['path'], $value['data']);
						} else {
							$this->load->section($key, $value);
						}
					endforeach;
				}
				
				$this->load->view('themes/' . $this->_template['themes'] . '/layout/'.$page_name, $data);
			}
		}
		else
		{
			if ($admin == TRUE)
			{
				$this->CI->load->view('admin/layout/'.$page_name, $data);
			}
			else
			{
				$this->CI->load->section('menu', 'themes/'.$this->template.'/section/menu');
				$this->CI->load->section('footer', 'themes/'.$this->template.'/section/footer'); 

				$this->CI->load->view('themes/' . $this->template . '/layout/'.$page_name, $data);
			}
		}
	}
	
	public function load_template_default($page, $data = NULL)
	{
		$this->load->section('menu', 'themes/'.$this->_template['themes'].'/section/menu');
		$this->load->section('footer', 'themes/'.$this->_template['themes'].'/section/footer'); 

		$this->CI->load->view('themes/' . $this->_template['themes'] . '/layout/' . $page, $data);
	}

}

class MY_AdminController extends CI_Controller
{
	public $_settings;
	public $_template;

	public function __construct()
	{
		parent::__construct();

		$lib_array = array('user_agent','ion_auth','cmscore_library');
		$this->load->library($lib_array);

		//get settings
		$this->_settings = $this->cmscore_library->settings;
		//load active admin template
		//load base admin tempalte and default title
		$this->_template['themes'] = $this->cmscore_library->getActiveTemplate(TRUE);

		$masterpage = $this->_template['themes'].'/masterpage';
		$title = $this->_settings['site_title'];
		
		//set masterpage template and default title
		$this->_init_admin_template($masterpage, $title);
		

	}
	/**
	 * Initiation base home admin template and base title
	 */
	public function _init_admin_template($masterpage,$title='')
    {
        $this->output->set_template($masterpage);
		$this->output->set_title($title);
    }
}