<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller
{
	// Protected or private properties
	protected $_template;
	
	// Constructor
	public function __construct()
	{
		parent::__construct();

		// Load needed models, libraries, helpers and language files
		$this->load->model([
			'post_model' => 'blog',
			'users_model' => 'users',
			'categories_model' => 'category'
		]);

		$this->load->library('user_agent');

		$this->lang->load('posts_lang');
		
		//$this->load->library('securimage_library');
		$this->_template['themes'] = $this->system_library->template;
	
    }

	// Public methods
	public function index($page = null)
	{
		$this->load->library('pagination');

		$config['total_rows'] = $this->blog->get_posts_count();
		$config['per_page'] = $this->blog->get_posts_per_page();
			
		$this->pagination->initialize($config);
			
		$pages_count = ceil($config['total_rows'] / $config['per_page']);
		$page = ($page == 0) ? 1 : $page;
		$offset = $config['per_page'] * ($page - 1);
		$data['posts'] = $this->blog->get_posts($config['per_page'], $offset);
		
		if ($data['posts'] != NULL)
		{
			if ($page > $pages_count)
			{
				redirect('post', 'refresh');
			}
		
			$data['posts_per_page'] = $this->blog->get_posts_per_page();
			$data['posts_count'] = $this->blog->get_posts_count();
			$data['pages_count'] = $pages_count;
			$data['current_page'] = $page;
			$data['next_page'] = $page + 1;
			$data['previous_page'] = $page - 1;

			//this is for sticky post
			$data['sticky_post'] = $data['posts'][0];

			foreach ($data['posts'] as $key => $post)
			{
				$data['posts'][$key]['url'] = post_url($post['url_title'], $post['date_posted']);
				$data['posts'][$key]['display_name'] = $this->users->get_user_display_name($post['author']);
			}

			$this->_template['page'] = 'post/index';
		}
		else
		{
			$this->_template['page'] = 'post/no_posts';
		}
			
		$this->load->section('highlight', 'themes/'.$this->_template['themes'].'/section/highlight');
		$this->load->section('featured', 'themes/'.$this->_template['themes'].'/section/featured');

		$this->system_library->load($this->_template['page'], $data);

	}

	public function date($year = NULL, $month = NULL, $day = NULL, $url_title = NULL)
	{
		$this->load->model('comments_model', 'comments');
			
		if ($data['post'] = $this->blog->get_post_by_url($year, $month, $day, $url_title))
		{
			$data['post']['url'] = post_url($data['post']['url_title'], $data['post']['date_posted']);
			$data['post']['display_name'] = $this->users->get_user_display_name($data['post']['author']);
			
			if ($data['post']['allow_comments'] == 1)
			{
				$this->comment($data['post']['id'], $data['post']['url']);
			}
				
			$data['comments'] = $this->comments->get_comments($data['post']['id']);

			if ($data['comments'] != "")
			{
				foreach ($data['comments'] as $key => $comment)
				{
					$data['comments'][$key]['content']  = parse_bbcode(nl2br(parse_smileys($comment['content'], base_url() . 'application/views/admin/static/javascript/tiny_mce/plugins/emotions/img/')));

					if ($comment['user_id'] != "")
					{
						$website = $this->users->get_user_website($comment['user_id']);
						$display_name = $this->users->get_user_display_name($comment['user_id']);
						$data['comments'][$key]['author'] = '<a href="' . prep_url($website) . '" target="_blank">' . $display_name . '</a>';
					}
					else
					{
						if ($comment['author_website'] != "")
						{
							$data['comments'][$key]['author'] = '<a href="' . prep_url($comment['author_website']) . '" target="_blank">' . $comment['author'] . '</a>';
						}
					}
				}
			}

			$this->output->append_title($data['post']['title']);
			
			$this->_template['page']	= 'post/single_post';
		}
		else
		{
			show_404();
		}
			
		$this->system_library->load($this->_template['page'], $data);
	}

	public function archive($year = null, $month = null)
	{
		if ($data['posts'] = $this->blog->get_posts_by_date($year, $month))
		{
			foreach ($data['posts'] as $key => $post)
			{
				$data['posts'][$key]['url'] = post_url($post['url_title'], $post['date_posted']);
				$data['posts'][$key]['display_name'] = $this->users->get_user_display_name($post['author']);
			}

			$this->_template['page']	= 'blog/archive';
		}
		else
		{
			$this->_template['page']	= 'errors/archive_no_posts';
		}
			
		$this->system_library->load($this->_template['page'], $data);
	}

	public function category($url_name = null)
	{		
		$data['category'] = $this->category->get_categories_by_url($url_name);
		$data['posts'] = $this->blog->get_posts_by_category($url_name);

		if($data['category'] != NULL){
			if ($data['posts'] != NULL)
			{
				foreach ($data['posts'] as $key => $post)
				{
					$data['posts'][$key]['url'] = post_url($post['url_title'], $post['date_posted']);
					$data['posts'][$key]['display_name'] = $this->users->get_user_display_name($post['author']);
				}

			
			}

			$this->output->append_title($data['category']['name']);
			$this->_template['page']	= 'post/category_post';
		}
		else
		{
			show_404();
		}
		
		
			
		$this->system_library->load($this->_template['page'], $data);
	}
	
	public function tags($tag_name = null)
	{
		$data['tag_name'] = $tag_name;
		
		if ($data['posts'] = $this->blog->get_posts_by_tags($tag_name))
		{
			foreach ($data['posts'] as $key => $post)
			{
				$data['posts'][$key]['url'] = post_url($post['url_title'], $post['date_posted']);
				$data['posts'][$key]['display_name'] = $this->users->get_user_display_name($post['author']);
			}
				
			$this->_template['page']	= 'post/tags';
		}
		else
		{
			show_404();
		}
		
		$this->system_library->load($this->_template['page'], $data);
	}

	public function search()
	{
		$data['search_term'] = $this->input->post('term', TRUE);
			
		if ($data['search_term'] != "")
		{
			if ($data['posts'] = $this->blog->get_posts_by_term($data['search_term']))
			{
				foreach ($data['posts'] as $key => $post)
				{
					$data['posts'][$key]['url'] = post_url($post['url_title'], $post['date_posted']);
					$data['posts'][$key]['display_name'] = $this->users->get_user_display_name($post['author']);
				}
					
				$this->_template['page']	= 'post/search';
			}
			else
			{
				$this->_template['page']	= 'errors/search_no_results';
			}
				
			$this->system_library->load($this->_template['page'], $data);
		}
		else
		{
			redirect('blog', 'refresh');
		}
	}

	public function comment($id, $url)
	{
		$this->load->model('comments_model', 'comments');
			
		if ($this->session->userdata('logged_in') == FALSE)
		{
			$this->form_validation->set_rules('nickname', 'lang:nickname', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('email', 'lang:email', 'required|valid_email');
			
			if ($this->system_library->settings['enable_captcha'] == 1)
			{
				$this->form_validation->set_rules('confirmation_code', 'lang:confirmation_code', 'required|callback_valid_confirmation_code');
			}
		}
		
		$this->form_validation->set_rules('website', 'lang:website', 'xss_clean');
		$this->form_validation->set_rules('comment', 'lang:comment', 'required|max_length[400]|htmlentities');
			
		$this->form_validation->set_error_delimiters('', '<br />');

		if ($this->form_validation->run() == TRUE)
		{
			$this->comments->create_comment($id);
			redirect($url, 'refresh');
		}
	}
	
	public function valid_confirmation_code($confirmation_code)
	{
		if ($this->securimage_library->check($confirmation_code) == true)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('valid_confirmation_code', lang('invalid_confirmation_code'));
			
			return FALSE;
		}
	}
}

/* End of file blog.php */
/* Location: ./application/Post.php */