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
		$data['post_list'] = $this->post_model->getAll('','date_posted desc', $paging['per_page'], $start );
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
            'button' => 'Create',
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
                
                if($id)
                {
                    $this->edit($id);
                }
                else
                {
                    $this->new();
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
						'max_size' => "5120",
					);
	
					$this->upload->initialize($config);
	
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
					$dataimage['image_header'] = ($this->input->post('def_image')) ? $this->input->post('def_image') : NULL;
				}
				//Create new post array to insert to database
				$new_post = array(
					'image_header' => ($dataimage['image_header'] !== NULL) ? $path_dir.$dataimage['file_name'] : $dataimage['image_header'],
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
					'allow_comments' => ($this->input->post('allow_comment')) ? $this->input->post("allow_comment") : 0,
					'sticky' => ($this->input->post('sticky')) ? $this->input->post('sticky') : 0,
					'featured' => ($this->input->post('featured')) ? $this->input->post('featured') : 0,					
				);
				
				//save data and return id
				$post_id = $this->post_model->add($new_post);
				$tags = $this->input->post('tags');
				
				if($post_id){
					//insert tags	
					if($tags)
					{
						$this->post_model->add_tags($this->post_model->parse_tags($tags), $post_id);
					}
					
					$this->session->set_flashdata('success', lang('form_succes_create_post'));

					redirect(site_url('admin/posts'));
				} else {

					$this->session->set_flashdata('error', lang('form_failed_create_post'));
					redirect(site_url('admin/posts/new'));
				}
			}

		} else {
			echo "invalid method";
			exit;
		}
		
	}
	
	function edit($id)
	{
		//cek apakah user sudah login dan diizinkan untuk masuk ke halaman ini
		$this->auth->restrict();
		
		//load module yang dibutuhkan
		$this->load->model('content/content_model','cm');
		$this->load->model('kategori/kategori_model','km');
		
		$data['tpl_page'] = "article/form_article";
		$data['tpl_data'] = array(
			'form_action' => $this->url_admin."article/update/".$id,
			'title' => $this->title." > Edit Article",
			'content_list' => $this->cm->getAll('id'),
			'kat_list'=> $this->km->getAll('id'),
			'return' => $this->am->get($id)
		);
	
		$this->load->view('_admin/simpla_admin/template',$data);
	}
	
	function update($id)
	{
		//cek apakah user sudah login dan diizinkan untuk masuk ke halaman ini
		$this->auth->restrict();
		
		$params_form = array(
				'author' => $this->session->userdata('userid'),
				'date_posted' => date('Y-m-d'),
				'time_posted' => date('H-i-s'),
				'meta_key' => $this->input->post('meta_key'),
				'meta_desc' => $this->input->post('meta_desc'),
				'title' => $this->input->post('judul_article'),
				'cat' => $this->input->post('kategori'),
				'content_id' => $this->input->post('content_area'),
				'url_title' => $this->input->post("url_article"),
				'head_article' => $this->input->post('head_article'),
				'main_article' => $this->input->post('main_article'),
				'allow_comments' => $this->input->post("allow_comment"),
				'sticky' => $this->input->post('stick'),
				'status' => $this->input->post('status')
				
		);
		
		//save ke dalam database content
			$proses = $this->am->update($id,$params_form);
			
			if($proses){
				$this->session->set_flashdata('success','Berhasil update data article : <b>'.$this->input->post('judul_article')."</b>");
			} else {
				$this->session->set_flashdata('error','Gagal mengupdate article. Hubungi Administrator untuk masalah ini.');
			}
		
			redirect($this->url_admin.'article/index');
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