<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Ifuk Permana
 * @copyright 2019
 * @script Navigation Admin Controller
 * --------------------------------------------------------------------------
 *  Admin Navigation Module
 * --------------------------------------------------------------------------
 *		Module Controller Admin for Navigation
 * 
 */

class Navigation extends MY_AdminController{
	
	function __construct()
	{
		parent::__construct();
		
        //load model,library,helper     
        $this->load->library(array('ion_auth','form_validation'));
        $model_load = array('navigation_model','page_model','categories_model');
        $this->load->model($model_load);
		$this->load->helper('language');
		
		$this->lang->load('navigation');
        
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect(site_url('admin/auth/login'), 'refresh');
        }
        
        if(!in_array('accessModNavigation', $this->_user_permission)) {			
            $this->session->set_flashdata('error','Sorry you don\'t have permission to see that page');
            redirect('admin/home/not_allowed', 'refresh');
        }
	}
	
	function index()
	{
        //load data
        $where_page = array(
            'default !=' => 1,
            'status' => 'active'
        );

        $pages = $this->page_model->getWhere('id, title, url_title',$where_page, 'id DESC');
        $categories = $this->categories_model->getAll('id, name, url_name');
        $group_nav = $this->navigation_model->getAllGroup();
        $navigation = $this->navigation_model->getAll();

        //set data to view
        $group_nav_data = array();
        foreach($group_nav->result_array() as $list):
            $group_nav_data[$list['id']] = $list['title'];
        endforeach;
        
        $data['group_list']  = $group_nav_data;
        $data['nav_list'] = $navigation->result_array();
        $data['cat_list'] = $categories->result_array();
        $data['page_list'] = $pages->result_array();
		
		$this->output->append_title('Navigation');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
        $this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
        $this->load->js('assets/vendor/nestable/jquery.nestable.js');
        $this->load->js('assets/js/mod_nav.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/navigation/index', $data);
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
					$page_id = $this->navigation_model->add($param_page);
				} else {
					//if update so update it
					//add param update time
					$param_page['update_at'] = date('Y-m-d H:i:s');					
					$page_id = $this->navigation_model->update($id, $param_page);					
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
		$page_data = $this->navigation_model->get($id);

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

			$proses = $this->navigation_model->delete(array('id'=>$id));
				
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
        $this->form_validation->set_rules('date', lang('form_date_page'), 'trim|required');                          

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');
	}
	
	
	
}

/* End of file Navigation.php */
/* Location: ./application/controllers/admin/Navigation.php */