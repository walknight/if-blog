<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Ifuk Permana
 * @copyright 2019
 * @script Pages Admin Controller
 * --------------------------------------------------------------------------
 *  Admin Pages Module
 * --------------------------------------------------------------------------
 *		Module Controller Admin for Pages
 * 
 */

class Pages extends MY_AdminController{
	
	function __construct()
	{
		parent::__construct();
		
        //load model,library,helper     
        $this->load->library(array('ion_auth','form_validation','pagination'));
        $this->load->model('page_model');
		$this->load->helper('language');
		
		$this->lang->load('pages');
        
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect(site_url('admin/auth/login'), 'refresh');
        }
        
        if(!in_array('accessModPage', $this->_user_permission)) {			
            $this->session->set_flashdata('error','Sorry you don\'t have permission to see that page');
            redirect('admin/home/not_allowed', 'refresh');
        }
	}
	
	function index()
	{
		//get start list value 
		$start = $this->uri->segment(4,0);
		
        $paging['base_url'] = site_url('admin/pages/index');
        $paging['total_rows'] = ($this->page_model->getAll()) ? $this->page_model->getAll()->num_rows() : 0;
        $paging['uri_segment'] = 4;
        $paging['per_page'] = 10;
        
        $this->pagination->initialize($paging); 
        
        //load data
        $data['page_list'] = $this->page_model->getAll('pages.*, users.username','pages.id desc', $paging['per_page'], $start);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $paging['total_rows'];
		$data['start'] = $start;
		
		$this->output->append_title('Page List');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
        $this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
        $this->load->js('assets/js/mod_page.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/page/list_page', $data);
	}
	
	function new()
	{
		$data = array(
            'form_action' => site_url('admin/pages/save'),
			'readonly' => '',			
			'title' => set_value('title'),
			'url_title' => set_value('url_title'),
			'content' => set_value('content'),			
			'status' => set_value('status'),
			'default' => set_value('default'),
			'meta_desc' => set_value('meta_desc'),
			'meta_key' => set_value('meta_key'),
			'date' => set_value('date'),
			'image_header' => '',
            'id_page' => set_value('id_page')
		);
		
		$this->output->append_title('New Pages');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
		//datepicker
		$this->load->js('assets/vendor/gijgo-combined-1.9.13/js/gijgo.min.js');
		$this->load->css('assets/vendor/gijgo-combined-1.9.13/css/gijgo.min.css');
		$this->load->js('assets/js/mod_form_page.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/page/form_page', $data);
	}
	
	function save()
	{
		if($this->input->post())
		{
			$id = $this->input->post('id_page');

			$this->_rules();
			
			if ($this->form_validation->run() == FALSE) {
                
                if($id === NULL || $id == '')
                {
					$this->new();
                }
                else
                {
					$this->edit($id);
                }
                
            } else {				
				//check upload image status
				$dataimage = NULL;
				//check directory upload for post
				$path_dir = $this->config->item('upload').'page/';
				
				if(!is_dir($path_dir)){					
					//create new folder for the first time
					mkdir($path_dir, 0755, TRUE);                    
				}

				if($_FILES['image_header']['size'] > 0 && $_FILES['image_header']['error'] == 0)
				{					
					//set upload file config
					$config = array(
						'upload_path' => $path_dir,
						'allowed_types' => 'jpg|png|jpeg|bmp', //change this if you want to more extension files
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
				$param_page = array(
					'image_header' => ($dataimage !== NULL && is_array($dataimage)) ? $path_dir.$dataimage['file_name'] : $dataimage,
					'author' => $this->session->userdata('user_id'),
					'date' => date('Y-m-d H:i:s', strtotime($this->input->post('date'))),
					'meta_key' => $this->input->post('meta_key'),
					'meta_desc' => $this->input->post('meta_desc'),
					'title' => $this->input->post('title'),					
					'url_title' => $this->input->post("url_title"),					
					'content' => $this->input->post('content'),					
					'status' => ($this->input->post('status')) ? $this->input->post('status') : 'inactive',
					'default' => ($this->input->post('default')) ? $this->input->post("default") : 0,									
				);
				
				//check if is update or create
				if($id === NULL || $id == '')
				{
					//if create so insert it
					//add param create time
					$param_page['create_at'] = date('Y-m-d H:i:s');					
					$page_id = $this->page_model->add($param_page);
				} else {
					//if update so update it
					//add param update time
					$param_page['update_at'] = date('Y-m-d H:i:s');					
					$page_id = $this->page_model->update($id, $param_page);					
				}
								
				if($page_id){					
					
					if($id === NULL || $id == ''){
						$this->session->set_flashdata('success', lang('form_succes_create_page'));
						redirect(site_url('admin/pages'));						
					} else { 
						$this->session->set_flashdata('success', lang('form_succes_update_page'));
						redirect(site_url('admin/pages/edit/'.$id));
					}

					
				} else {
					if($id === NULL || $id == ''){
						$this->session->set_flashdata('error', lang('form_failed_create_page'));
						redirect(site_url('admin/pages/new'));
					} else {
						$this->session->set_flashdata('error', lang('form_failed_update_page'));
						redirect(site_url('admin/pages/edit/'.$id));
					}
				}
			}

		} else {
			$this->output->unset_template();
			echo "invalid method";
			exit;
		}
		
	}
	
	function edit($id)
	{
		//return single row array;
		$page_data = $this->page_model->get($id);

		$data = array(
            'form_action' => site_url('admin/pages/save'),
			'readonly' => '',			
			'title' => $page_data['title'],
			'url_title' => $page_data['url_title'],
			'content' => $page_data['content'],			
			'status' => $page_data['status'],
			'default' => $page_data['default'],
			'meta_desc' => $page_data['meta_desc'],
			'meta_key' => $page_data['meta_key'],
			'date' => date('H:i m/d/Y', strtotime($page_data['date'])),
			'image_header' => $page_data['image_header'],
            'id_page' => $page_data['id']
		);
		
		$this->output->append_title('Edit Page');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
		//datepicker
		$this->load->js('assets/vendor/gijgo-combined-1.9.13/js/gijgo.min.js');
		$this->load->css('assets/vendor/gijgo-combined-1.9.13/css/gijgo.min.css');
		$this->load->js('assets/js/mod_form_page.js');

		$this->load->view('themes/'.$this->_template['themes'].'/layout/page/form_page', $data);
	}

	//return ajax response
	function delete()
	{
		$this->output->unset_template();

		if($this->input->post()){
			$id = $this->input->post('id_page');

			$proses = $this->page_model->delete(array('id'=>$id));
				
			if($proses){
				$response['success'] = true;
				$response['messages'] = lang('index_success_delete_page');
			} else {
				$response['success'] = false;
				$response['messages'] = lang('index_failed_delete_page');
			}

		} else {
			$response['success'] = false;
			$response['messages'] = "Refresh the page again!!";
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	function _rules()
	{		
        $this->form_validation->set_rules('title', lang('form_title_page'), 'trim|required');
        $this->form_validation->set_rules('url_title' , lang('form_url_page'), 'trim|required');
        $this->form_validation->set_rules('content', lang('form_content_area_page'), 'trim|required');       
        $this->form_validation->set_rules('status', lang('form_status_page'), 'trim|required');
        $this->form_validation->set_rules('meta_desc', lang('form_meta_description_page'), 'trim|required');
        $this->form_validation->set_rules('meta_key', lang('form_meta_key_page'), 'trim|required');
        $this->form_validation->set_rules('date', lang('form_date_page'), 'trim|required');                          

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');
	}
	
	
	
}

/* End of file Pages.php */
/* Location: ./application/controllers/admin/Pages.php */