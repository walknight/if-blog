<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Ifuk Permana
 * @copyright 2019
 * @script Posts Admin Controller
 * --------------------------------------------------------------------------
 *  Administration Posts
 * --------------------------------------------------------------------------
 *		Module Controller Admin for Posts
 * 
 */

class Posts extends MY_AdminController{
	
	function __construct()
	{
		parent::__construct();
		//load model,library,helper,modules
        $this->load->model(['post_model','categories_model']);        
        $this->load->library(array('ion_auth','form_validation','pagination'));
		$this->load->helper('language');
		
		$this->lang->load('posts');
        
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect(site_url('admin/auth/login'), 'refresh');
        }
        
        if(!in_array('accessModPost', $this->_user_permission)) {			
            $this->session->set_flashdata('error','Sorry you don\'t have permission to see that page');
            redirect('admin/home/not_allowed', 'refresh');
        }


	}
	
	function index()
	{
		//get start list value 
		$start = $this->uri->segment(4,0);
		
        $paging['base_url'] = site_url('admin/posts/index/');
        $paging['total_rows'] = $this->post_model->getAll()->num_rows();
        $paging['uri_segment'] = 4;
        $paging['per_page'] = 10;
        $this->pagination->initialize($paging);
		
		//prepare data for view
		$select = 'posts.*, users.id as user_id, users.username, cat.id as cat_id, cat.name as cat_name';
		$data['post_list'] = $this->post_model->getAll($select,'posts.id desc', $paging['per_page'], $start );
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $paging['total_rows'];
		$data['start'] = $start;

		$this->output->append_title('Post List');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
        $this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
        $this->load->js('assets/js/mod_post.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/post/list_post', $data);
	}
	
	function new()
	{
		$data = array(
            'form_action' => site_url('admin/posts/save'),
			'readonly' => '',
			'cat_list' => $this->categories_model->get_categories(),
			'title' => set_value('title'),
			'url_title' => set_value('url_title'),
			'head_article' => set_value('head_article'),
			'main_article' => set_value('main_article'),
			'allow_comments' => set_value('allow_comments'),
			'sticky' => set_value('sticky'),
			'featured' => set_value('featured'),
			'status' => set_value('status'),
			'tags' => set_value('tags'),
			'meta_desc' => set_value('meta_desc'),
			'meta_key' => set_value('meta_key'),
			'date_posted' => set_value('date_posted'),
			'image_header' => '',
			'id_cat' => set_value('id_cat'),
            'id_post' => ''
		);
		
		$this->output->append_title('New Post');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
		//datepicker
		$this->load->js('assets/vendor/gijgo-combined-1.9.13/js/gijgo.min.js');
		$this->load->css('assets/vendor/gijgo-combined-1.9.13/css/gijgo.min.css');
		$this->load->js('assets/js/mod_form_post.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/post/form_post', $data);
	}
	
	function save()
	{
		
		if($this->input->post())
		{
			$id = $this->input->post('id_post');

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
				$path_dir = $this->config->item('upload').'post/';
				
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
				$param_post = array(
					'image_header' => ($dataimage !== NULL && is_array($dataimage)) ? $path_dir.$dataimage['file_name'] : $dataimage,
					'author' => $this->session->userdata('user_id'),
					'date_posted' => date('Y-m-d H:i:s', strtotime($this->input->post('date_posted'))),
					'meta_key' => $this->input->post('meta_key'),
					'meta_desc' => $this->input->post('meta_desc'),
					'title' => $this->input->post('title'),
					'id_cat' => $this->input->post('id_cat'),
					'url_title' => $this->input->post("url_title"),
					'head_article' => $this->input->post('head_article'),
					'main_article' => $this->input->post('main_article'),					
					'status' => ($this->input->post('status')) ? $this->input->post('status') : 'draft',
					'allow_comments' => ($this->input->post('allow_comments')) ? $this->input->post("allow_comments") : 0,
					'sticky' => ($this->input->post('sticky')) ? $this->input->post('sticky') : 0,
					'featured' => ($this->input->post('featured')) ? $this->input->post('featured') : 0,					
				);
				
				//check if is update or create
				if($id === NULL || $id == '')
				{
					//if create so insert it
					//add param create time
					$param_post['create_at'] = date('Y-m-d H:i:s');					
					$post_id = $this->post_model->add($param_post);
				} else {
					//if update so update it
					//add param update time
					$param_post['update_at'] = date('Y-m-d H:i:s');					
					$post_id = $this->post_model->update($id, $param_post);					
				}
				
				$tags = $this->input->post('tags');
				
				if($post_id){
					//insert tags for new or update tags	
					if($tags)
					{
						$this->post_model->add_tags($this->post_model->parse_tags($tags), $post_id);
					}
					
					if($id === NULL || $id == ''){
						$this->session->set_flashdata('success', lang('form_succes_create_post'));
						redirect(site_url('admin/posts'));						
					} else { 
						$this->session->set_flashdata('success', lang('form_succes_update_post'));
						redirect(site_url('admin/posts/edit/'.$id));
					}

					
				} else {
					if($id === NULL || $id == ''){
						$this->session->set_flashdata('error', lang('form_failed_create_post'));
						redirect(site_url('admin/posts/new'));
					} else {
						$this->session->set_flashdata('error', lang('form_failed_update_post'));
						redirect(site_url('admin/posts/edit/'.$id));
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
		$post_data = $this->post_model->get_post_by_id($id);

		$data = array(
            'form_action' => site_url('admin/posts/save'),
			'readonly' => '',
			'cat_list' => $this->categories_model->get_categories(),
			'title' => $post_data['title'],
			'url_title' => $post_data['url_title'],
			'head_article' => $post_data['head_article'],
			'main_article' => $post_data['main_article'],
			'allow_comments' => $post_data['allow_comments'],
			'sticky' => $post_data['sticky'],
			'featured' => $post_data['featured'],
			'status' => $post_data['status'],
			'tags' => $post_data['tags'],
			'meta_desc' => $post_data['meta_desc'],
			'meta_key' => $post_data['meta_key'],
			'date_posted' => $post_data['date_posted'],
			'image_header' => $post_data['image_header'],
			'id_cat' => $post_data['id_cat'],
            'id_post' => $post_data['id']
		);
		
		$this->output->append_title('Edit Post');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
		$this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
		//datepicker
		$this->load->js('assets/vendor/gijgo-combined-1.9.13/js/gijgo.min.js');
		$this->load->css('assets/vendor/gijgo-combined-1.9.13/css/gijgo.min.css');
		$this->load->js('assets/js/mod_form_post.js');

		$this->load->view('themes/'.$this->_template['themes'].'/layout/post/form_post', $data);
		
	}
	
	//return ajax response
	function delete()
	{
		$this->output->unset_template();

		if($this->input->post()){
			$id = $this->input->post('id_post');

			$proses = $this->post_model->delete(array('id'=>$id));
				
			if($proses){
				$response['success'] = true;
				$response['messages'] = lang('index_success_delete_post');
			} else {
				$response['success'] = false;
				$response['messages'] = lang('index_failed_delete_post');
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
        $this->form_validation->set_rules('title', lang('form_title_post'), 'trim|required');
        $this->form_validation->set_rules('id_cat', lang('form_category_post'), 'trim|required');
        $this->form_validation->set_rules('url_title' , lang('form_url_post'), 'trim|required');
        $this->form_validation->set_rules('head_article', lang('form_head_article_post'), 'trim|required');
        $this->form_validation->set_rules('main_article', lang('form_main_content_post'), 'trim|required');
        //$this->form_validation->set_rules('allow_comments', lang('form_allow_comment_post'), 'trim|required');
        //$this->form_validation->set_rules('sticky', lang('form_sticky_content_post'), 'trim|required');
        //$this->form_validation->set_rules('featured', lang('form_featured_content_post'), 'trim|required');
        $this->form_validation->set_rules('status', lang('form_status_post'), 'trim|required');
        $this->form_validation->set_rules('meta_desc', lang('form_meta_description_post'), 'trim|required');
        $this->form_validation->set_rules('meta_key', lang('form_meta_key_post'), 'trim|required');
        $this->form_validation->set_rules('date_posted', lang('form_date_post'), 'trim|required');                          

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');
	}
	
}

/* End of file admin.php */
/* Location: ./system/application/admin/Posts.php */