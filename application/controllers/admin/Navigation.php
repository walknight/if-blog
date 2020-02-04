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
	
	function index($group=1)
	{
        //load data
        $where_page = array(
            'default !=' => 1,
            'status' => 'active'
		);
		
		if($this->input->get('group')){
			$group = $this->input->get('group');
		}

        $pages = $this->page_model->getWhere('id, title, url_title',$where_page, 'id DESC');
        $categories = $this->categories_model->getAll('id, name, url_name');
        $group_nav = $this->navigation_model->getAllGroup();
        $navigation = $this->navigation_model->getWhere(array('id_groups' => $group));

        //set data to view
        $group_nav_data = array();
        foreach($group_nav->result_array() as $list):
            $group_nav_data[$list['id']] = $list['title'];
        endforeach;
        
        $data['group_list']  = $group_nav_data;
        $data['nav_list'] = ($navigation !== FALSE) ? $navigation->result_array() : array();
        $data['cat_list'] = $categories->result_array();
		$data['page_list'] = $pages->result_array();
		$data['group_select'] = $group;
		
		$this->output->append_title('Navigation');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
        $this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
        $this->load->js('assets/vendor/nestable/jquery.nestable.js');
        $this->load->js('assets/js/mod_nav.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/navigation/index', $data);
	}

	/**
	 * =====================================
	 * All save, update and delete in this class using ajax and return JSON
	 * =====================================
	 */

	function addNav(){
		$this->output->unset_template();
		
		$response['error'] = false;
		$response['messages'] = '';

		if($this->input->post())
		{
			//insert new navigation
			$param_insert = array(
				'parent_id' => 0, //set default parent to 0
				'title' => $this->input->post('name'),
				'description' => ($this->input->post('description')) ? $this->input->post('description') : '',
				'url' => $this->input->post('url'),
				'external' => ($this->input->post('external')) ? '1' : '0',
				'id_groups' => ($this->input->post('id_groups')) ? $this->input->post('id_groups') : 0,
			);

			$insert = $this->navigation_model->add($param_insert, $param_insert['id_groups']);

			if($insert !== FALSE){
				$response['error'] = false;
				$response['messages'] = lang('success_add_nav');
			} else {
				$response['error'] = true;
				$response['messages'] = lang('failed_add_nav');
			}
			
		} else {
			$response['error'] = true;
			$response['messages'] = lang('invalid_data_nav');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
	
	function reorderNav()
	{

	}

	function update()
	{

	}

	//return ajax response
	function delete()
	{
		$this->output->unset_template();

		if($this->input->post()){
			$id = $this->input->post('id_nav');

			//we delete parent and children :(
			$proses = $this->navigation_model->delete($id);
				
			if($proses){
				$response['error'] = false;
				$response['messages'] = lang('success_delete_nav');
			} else {
				$response['error'] = true;
				$response['messages'] = lang('failed_delete_nav');
			}

		} else {
			$response['success'] = false;
			$response['messages'] = lang('invalid_data_nav');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
	
}

/* End of file Navigation.php */
/* Location: ./application/controllers/admin/Navigation.php */