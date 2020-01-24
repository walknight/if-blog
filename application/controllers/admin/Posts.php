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
        $this->load->model('post_model');        
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
		//cek apakah user sudah login dan diizinkan untuk masuk ke halaman ini
		$this->auth->restrict();
		
		//load module yang dibutuhkan
		$this->load->model('content/content_model','cm');
		$this->load->model('kategori/kategori_model','km');
		
		$data['tpl_page'] = "article/form_article";
		$data['tpl_data'] = array(
			'form_action' => $this->url_admin."article/save",
			'title' => $this->title." > Create New Article",
			'content_list' => $this->cm->getAll('id'),
			'kat_list'=> $this->km->getAll('id')
		);
		
		$this->load->view('_admin/simpla_admin/template',$data);
	}
	
	function save()
	{
		//cek apakah user sudah login dan diizinkan untuk masuk ke halaman ini
		$this->auth->restrict();
		
		//check type dari section
		$type_section = $this->input->post('content_type');
		
		$rules_form = array(
				array(
					'field'=>'judul_article',
					'label'=>'Judul Article',
					'rules'=>'required|min_length[4]'
				),
				array(
					'field'=>'url_article',
					'label'=>'URL Article',
					'rules'=>'required'
				),
				array(
					'field'=>'content_area',
					'label'=>'Content Area',
					'rules'=>'required'
				),
				array(
					'field'=>'kategori',
					'label'=>'Kategori',
					'rules'=>'required'
				),
				array(
					'field'=>'meta_key',
					'label'=>'Meta Key',
					'rules'=>'required'
				),
				array(
					'field'=>'meta_desc',
					'label'=>'Meta Description',
					'rules'=>'required|min_length(4)'
				),
				array(
					'field'=>'head_article',
					'label'=>'Head Article',
					'rules'=>'required|min_length(4)'
				),
				array(
					'field'=>'main_article',
					'label'=>'Main Article',
					'rules'=>'required|min_length(4)'
				),
				array(
					'field'=>'allow_comment',
					'label'=>'Allow Comment',
					'rules'=>'required'
				),
				array(
					'field'=>'stick',
					'label'=>'Stick',
					'rules'=>'required'
				),
				array(
					'field'=>'status',
					'label'=>'Status',
					'rules'=>'required'
				)
				
		
		);
		
		//set parameter error form
		$this->form_validation->set_error_delimiters('<span class="input-notification error png_bg">', '</span>');
		//insert variabel rules form
		$this->form_validation->set_rules($rules_form);
		//cek apakah form valid
		if($this->form_validation->run() == FALSE)
		{
			/* setting file template dan data */
			$data['tpl_page'] = "article/form_article";
			$data['tpl_data'] =array(
					'form_action' => $this->url_admin."article/save",
					'title' => $this->title." > Create Article",
			);
			//load the form view
			$this->load->view('_admin/simpla_admin/template',$data);
			
		} else {
			//buat variable array dari masing2 input form
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
				'sticky' => $this->input->post('sticky'),
				'status' => $this->input->post('status')
				
			);
			
			//save ke dalam database content
			$proses = $this->am->add($params_form);
			$tags = $this->input->post('tags');
			
			if($proses){
				//insert tags	
				if($tags)
				{
					$this->am->add_tags();
				}
				
				$this->session->set_flashdata('success','Berhasil membuat article baru');
			} else {
				$this->session->set_flashdata('error','Gagal membuat article baru. Hubungi Administrator untuk masalah ini.');
			}
		
			redirect($this->url_admin.'article/index');
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
	
	function delete($id)
	{
		//cek apakah user sudah login dan diizinkan untuk masuk ke halaman ini
		$this->auth->restrict();
		
		$proses = $this->am->delete(array('id'=>$id));
			
			if($proses){
				$this->session->set_flashdata('success','Article telah berhasil dihapus.');
			} else {
				$this->session->set_flashdata('error','Gagal menghapus article. Hubungi Administrator untuk masalah ini.');
			}
		
			redirect($this->url_admin.'article/index');
	}
	
}

/* End of file admin.php */
/* Location: ./system/application/admin/Posts.php */