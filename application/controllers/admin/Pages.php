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
        $data['page_list'] = $this->page_model->getAll('*','id desc', $paging['per_page'], $start);
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
	
	function create()
	{
		//cek apakah user sudah login dan diizinkan untuk masuk ke halaman ini
		$this->auth->restrict();
		
		$data['tpl_page'] = "content/form_content";
		$data['tpl_data'] = array(
			'form_action' => $this->url_admin."content/save",
			'title' => $this->title." > Create New Section",
			'cat_list' => "",
			'blog_list'=> ""
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
					'field'=>'content_name',
					'label'=>'Section Name',
					'rules'=>'required|min_length[4]'
				),
				array(
					'field'=>'content_url',
					'label'=>'Section URL',
					'rules'=>'required'
				),
				array(
					'field'=>'content_type',
					'label'=>'Content Type',
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
			$data['tpl_page'] = "content/form_content";
			$data['tpl_data'] =array(
					'form_action' => $this->url_admin."content/save",
					'title' => $this->title." > Create New Section",
			);
			//load the form view
			$this->load->view('_admin/simpla_admin/template',$data);
			
		} else {
			//buat variable array dari masing2 input form
			$params_form = array(
				'title' => $this->input->post('content_name'),
				'url_title' => $this->input->post('content_url'),
				'author' => $this->session->userdata('userid'),
				'date' => date('Y-m-d'),
				'time' => date('H-i-s'),
				'status' => $this->input->post('status'),
				'type' => $type_section
				
			);
			
			//save ke dalam database content
			$proses = $this->cm->add($params_form);
			
			if($proses){
				$this->session->set_flashdata('success','Berhasil membuat content baru');
			} else {
				$this->session->set_flashdata('error','Gagal membuat content baru. Hubungi Administrator untuk masalah ini.');
			}
			
		
			redirect($this->url_admin.'content/index');
		}
		
	}
	
	function edit($id)
	{
		//cek apakah user sudah login dan diizinkan untuk masuk ke halaman ini
		$this->auth->restrict();
		
		$data['tpl_page'] = "content/form_content";
		$data['tpl_data'] = array(
			'form_action' => $this->url_admin."content/update/".$id,
			'title' => $this->title." > Edit Content",
			'return' => $this->cm->get($id)
		);
		
		$this->load->view('_admin/simpla_admin/template',$data);
	}
	
	function update($id)
	{
		//buat variable array dari masing2 input form
			$params_form = array(
				'title' => $this->input->post('content_name'),
				'url_title' => $this->input->post('content_url'),
				'author' => $this->session->userdata('userid'),
				'date' => date('Y-m-d'),
				'time' => date('H-i-s'),
				'status' => $this->input->post('status'),
				'type' => $this->input->post('content_type')
			);
			
			//save ke dalam database content
			$proses = $this->cm->update($id,$params_form);
			
			if($proses){
				$this->session->set_flashdata('success','Berhasil mengubah content '.$this->input->post('content_name'));
			} else {
				$this->session->set_flashdata('error','Gagal mengubah content. Hubungi Administrator untuk masalah ini.');
			}
			
		
			redirect($this->url_admin.'content/index');
	}
	
	
}

/* End of file menu.php */
/* Location: ./system/application/controllers/menu.php */