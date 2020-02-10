<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Ifuk Permana
 * @copyright 2019
 * @script Comments Admin Controller
 * --------------------------------------------------------------------------
 *  Admin Comments Module
 * --------------------------------------------------------------------------
 *		Module Controller Admin for Comments
 * 
 */

class Comments extends MY_AdminController{
	
	function __construct()
	{
		parent::__construct();
		
        //load model,library,helper     
        $this->load->library(array('ion_auth','form_validation','pagination'));
        $this->load->model('comments_model');
		$this->load->helper('language');
		
		$this->lang->load('comments');
        
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect(site_url('admin/auth/login'), 'refresh');
        }
        
        if(!in_array('accessModComments', $this->_user_permission)) {			
            $this->session->set_flashdata('error','Sorry you don\'t have permission to see that page');
            redirect('admin/home/not_allowed', 'refresh');
        }
	}
	
	function index()
	{
		//get start list value 
		$start = $this->uri->segment(4,0);
		
        $paging['base_url'] = site_url('admin/comments/index');
        $paging['total_rows'] = $this->comments_model->get_count_all();
        $paging['uri_segment'] = 4;
        $paging['per_page'] = 10;
        
        $this->pagination->initialize($paging); 
        
        //load data
        $data['comment_list'] = $this->comments_model->getAll('posts.url_title', 'id DESC', $paging['per_page'], $start);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $paging['total_rows'];
		$data['start'] = $start;

		/* echo "<pre>";
		print_r($data['comment_list']->result_array());
		echo "</pre>";
		exit; */
		
		$this->output->append_title('Comment List');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
        $this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
        $this->load->js('assets/js/mod_comments.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/comments/list_comment', $data);
	}

	function publish()
	{
		$response['error'] = false;
		$response['messages'] = '';

		$this->output->unset_template();

		if($this->input->post()){

			$id = $this->input->post('id_comment');
			$show = $this->input->post('show');

			if($show == "Y"){
				$this->comments_model->accept_comment($id);
				$response['messages'] = lang('success_publish_comments');
			}else{ 
				$this->comments_model->hide_comment($id);
				$response['messages'] = lang('success_unpublish_comments');
			}

		} else {
			$response['error'] = true;
			$response['messages'] = 'Invalid data method.';
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
	
	function reply()
	{
		$response['error'] = false;
		$response['messages'] = '';

		$this->output->unset_template();

		if($this->input->post()){
			$id = $this->input->post('id_parent');
			$id_post = $this->input->post('id_post');
			$comment = $this->input->post('comment_reply');
			$name = $this->input->post('name_reply');
			$user_id = ($this->input->post('user_id')) ? $this->input->post('user_id') : null;

			$insert_data = array(
				'id_parent' => $id,
				'post_id' => $id_post,
				'user_id' => $user_id,
				'name' => $name,
				'author_ip' => $this->input->ip_address(),
				'comment' => $comment,
				'date' => date('Y-m-d H:i:s'),
				'show' => ($this->session->userdata('user_id') !== NULL) ? 'Y' : 'N',
			);

			$save = $this->comments_model->insert($insert_data);

			if($save){
				$response['messages'] = lang('success_reply_comments');
				$response['return'] = $save;
			} else {
				$response['error'] = true;
				$response['messages'] = lang('failed_reply_comments');
			}

		} else {
			$response['error'] = true;
			$response['messages'] = 'Invalid data method.';
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	//return ajax response
	function delete()
	{
		$this->output->unset_template();

		if($this->input->post()){
			$id = $this->input->post('id_comment');

			$proses = $this->comments_model->remove_comment($id);
				
			if($proses){
				$response['success'] = true;
				$response['messages'] = lang('index_success_delete_comments');
			} else {
				$response['success'] = false;
				$response['messages'] = lang('index_failed_delete_comments');
			}

		} else {
			$response['success'] = false;
			$response['messages'] = "Refresh the page again!!";
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	
	
	
}

/* End of file Comments.php */
/* Location: ./application/controllers/admin/Comments.php */