<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Ifuk Permana
 * @copyright 2019
 * @script Category Admin Controller
 * --------------------------------------------------------------------------
 *  Administration Category
 * --------------------------------------------------------------------------
 *		Module Controller Admin for Category
 * 
 */

class Category extends MY_AdminController{
	
	function __construct()
	{
		parent::__construct();
		//load model,library,helper,modules
        $this->load->model(['categories_model']);        
        $this->load->library(array('ion_auth','form_validation','pagination'));
		$this->load->helper('language');
		
		$this->lang->load('category');
        
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect(site_url('admin/auth/login'), 'refresh');
        }
        
        if(!in_array('accessModCategory', $this->_user_permission)) {			
            $this->session->set_flashdata('error','Sorry you don\'t have permission to see that page');
            redirect('admin/home/not_allowed', 'refresh');
        }


	}
	
	function index()
	{
		//get start list value 
		$start = $this->uri->segment(4,0);
		
        $paging['base_url'] = site_url('admin/category/index/');
        $paging['total_rows'] = $this->categories_model->getAll()->num_rows();
        $paging['uri_segment'] = 4;
        $paging['per_page'] = 10;
        $this->pagination->initialize($paging);
		
		//prepare data for view		
        $data['cat_list'] = $this->categories_model->getAll('','id desc', $paging['per_page'], $start);
        
    	$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $paging['total_rows'];
		$data['start'] = $start;

		$this->output->append_title('Category List');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
        $this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
        $this->load->js('assets/js/mod_category.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/category/list_category', $data);
	}
	
	function new()
	{
		$data = array(
            'form_action' => site_url('admin/category/save'),
			'readonly' => '',			
			'title' => set_value('title'),
			'url_title' => set_value('url_title'),
			'description' => set_value('description'),			
			'id_cat' => set_value('id_cat'),
		);
		
		$this->output->append_title('New Category');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
        $this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');	
        $this->load->js('assets/js/mod_category.js');	
		
        $this->load->view('themes/'.$this->_template['themes'].'/layout/category/form_category', $data);
	}
	
	function save()
	{		
		if($this->input->post())
		{
			$id = $this->input->post('id_cat');
           
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
				//Create new post array to insert to database
				$param_cat = array(					
					'name' => $this->input->post('title'),
					'url_name' => $this->input->post("url_title"),
					'description' => $this->input->post('description'),										
				);
				
				//check if is update or create
				if($id === NULL || $id == '')
				{
					//if create so insert it							
                    $cat_id = $this->categories_model->add($param_cat);
                    
                    $this->session->set_flashdata('success', lang('form_succes_create_category'));
                    redirect(site_url('admin/category'));	
                        
				} else {
					//if update so update it					
                    $cat_id = $this->categories_model->update($id, $param_cat);
                    
                    $this->session->set_flashdata('success', lang('form_succes_update_category'));
					redirect(site_url('admin/category/edit/'.$id));					
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
        $cat_data = $this->categories_model->get_categories_by_ids($id);
     
		$data = array(
            'form_action' => site_url('admin/category/save'),			
			'title' => $cat_data['name'],
			'url_title' => $cat_data['url_name'],
			'description' => $cat_data['description'],			
			'id_cat' => $cat_data['id']
		);
		
		$this->output->append_title('Edit Category');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');		
		$this->load->js('assets/js/mod_category.js');

		$this->load->view('themes/'.$this->_template['themes'].'/layout/category/form_category', $data);
		
	}
	
	//return ajax response
	function delete()
	{
		$this->output->unset_template();

		if($this->input->post()){
			$id = $this->input->post('id_cat');

			$proses = $this->categories_model->delete(array('id'=>$id));
				
			if($proses){
				$response['success'] = true;
				$response['messages'] = lang('index_success_delete_category');
			} else {
				$response['success'] = false;
				$response['messages'] = lang('index_failed_delete_category');
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
        $this->form_validation->set_rules('title', lang('form_title_category'), 'trim|required');        
        $this->form_validation->set_rules('url_title' , lang('form_url_category'), 'trim|required');
        $this->form_validation->set_rules('description', lang('form_description_category'), 'trim|required');                            

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');
	}
	
}

/* End of file admin.php */
/* Location: ./system/application/admin/Posts.php */