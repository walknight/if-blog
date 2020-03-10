<?php

class Post_model extends CI_Model
{
	// Protected or private properties
	protected $_table;
	
	// Constructor
	public function __construct()
	{
		parent::__construct();

		$this->_table = $this->config->item('database_tables');
		$this->load->model('categories_model', 'categories');
	}

	// Public methods
	public function get_posts_per_page()
	{
		$this->db->select('value');
		$this->db->where('name', 'posts_per_page');
			
		$query = $this->db->get($this->_table['settings'], 1);
			
		if ($query->num_rows() == 1)
		{
			$row = $query->row_array();
		}
			
		return $row['value'];
	}

	/** 
	* Get count all row data
	* 
	* @access public
	* @param array
	* @return bool
	*/ 
	
	public function get_count_all($where=null)
	{
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
	
		return $this->db->count_all_results($this->_table['posts']);
	}

	public function get_posts_count()
	{
		$current_date = date('Y-m-d');
		
		$this->db->select('id');
		$this->db->where('status', 'published');
		$this->db->where('posts.featured', 0);
		$this->db->where('posts.sticky', 0);
		$this->db->where('posts.date_posted <=', $current_date);
		
			
		$query = $this->db->count_all_results($this->_table['posts']);
			
		return $query;
	}
	
	public function get_post_categories($post_id)
	{
		$this->db->select('category_id');
		$this->db->where('post_id', $post_id);
		
		$query = $this->db->get($this->_table['posts_to_categories']);
			
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			
			foreach ($result as $category)
			{
				$categories[] = $category['category_id'];
			}
			
			return $categories;
		}
	}

	public function get_posts($number = 10, $offset = 0)
	{
		$current_date = date('Y-m-d');
		
		$this->db->select('posts.id, posts.author, posts.date_posted, posts.title, posts.url_title, posts.head_article, posts.main_article, posts.id_cat, posts.allow_comments, posts.sticky, posts.featured, posts.status, posts.author, users.first_name');
		$this->db->from($this->_table['posts'] . ' posts');
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->where('posts.status', 'published');
		$this->db->where('posts.featured', 0);
		$this->db->where('posts.sticky', 0);
		$this->db->where('posts.date_posted <=', $current_date);
		$this->db->order_by('sticky', 'DESC');
		$this->db->order_by('posts.id', 'DESC');
		$this->db->limit($number, $offset);
			
		$query = $this->db->get();
			
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			
			foreach (array_keys($result) as $key)
			{
				$result[$key]['categories'] = $this->categories->get_categories_by_ids($result[$key]['id_cat']);
				$result[$key]['comment_count'] = $this->db->where('post_id', $result[$key]['id'])->from($this->_table['comments'])->count_all_results();
			}

			return $result;
		}
	}

	public function get_posts_featured()
	{
		$current_date = date('Y-m-d');
		
		$this->db->select('posts.id, posts.author, posts.date_posted, posts.title, posts.url_title, posts.head_article, posts.main_article, posts.id_cat, posts.allow_comments, posts.sticky, posts.featured, posts.status, posts.author, users.first_name');
		$this->db->from($this->_table['posts'] . ' posts');
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->where('posts.status', 'published');
		$this->db->where('posts.featured', 1);
		$this->db->order_by('id', 'DESC');
		//$this->db->limit($number, $offset);
			
		$query = $this->db->get();
			
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			
			foreach (array_keys($result) as $key)
			{
				$result[$key]['categories'] = $this->categories->get_categories_by_ids($result[$key]['id_cat']);
				$result[$key]['comment_count'] = $this->db->where('post_id', $result[$key]['id'])->from($this->_table['comments'])->count_all_results();
			}

			return $result;
		}
	}

	public function get_posts_sticky()
	{
		$current_date = date('Y-m-d');
		
		$this->db->select('posts.id, posts.author, posts.date_posted, posts.title, posts.url_title, posts.head_article, posts.main_article, posts.id_cat, posts.allow_comments, posts.sticky, posts.featured, posts.status, posts.author, users.first_name');
		$this->db->from($this->_table['posts'] . ' posts');
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->where('posts.status', 'published');
		$this->db->where('posts.sticky', 1);
		$this->db->where('posts.featured', 0);
		$this->db->order_by('id', 'DESC');
		//$this->db->limit($number, $offset);
			
		$query = $this->db->get();
			
		if ($query->num_rows() > 0)
		{
			$result = $query->row_array();
			
			$result['categories'] = $this->categories->get_categories_by_ids($result['id_cat']);
			$result['comment_count'] = $this->db->where('post_id', $result['id'])->from($this->_table['comments'])->count_all_results();
			
			return $result;
		}
	}

	public function get_posts_by_date($year, $month)
	{
		$date = $year . '-' . $month;
		$current_date = date('Y-m-d');
		
		$this->db->select('posts.id, posts.author, posts.date_posted, posts.title, posts.url_title, posts.head_article, posts.main_article, posts.id_cat, posts.allow_comments, posts.sticky, posts.featured, posts.status, posts.author, users.first_name');
		$this->db->from($this->_table['posts'] . ' posts');
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->where('posts.status', 'published');
		$this->db->where('posts.date_posted <=', $current_date);
		$this->db->like('posts.date_posted', $date);
		$this->db->order_by('posts.sticky', 'DESC');
		$this->db->order_by('posts.id', 'DESC');
			
		$query = $this->db->get();
			
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			
			foreach (array_keys($result) as $key)
			{
				$result[$key]['categories'] = $this->categories->get_categories_by_ids($result[$key]['id_cat']);
				$result[$key]['comment_count'] = $this->db->where('post_id', $result[$key]['id'])->from($this->_table['comments'])->count_all_results();
			}

			return $result;
		}
	}

	public function get_posts_by_category($url_name)
	{
		$current_date = date('Y-m-d');
		
		$this->db->select('posts.id, posts.author, posts.date_posted, posts.title, posts.url_title, posts.head_article, posts.main_article, posts.id_cat, posts.allow_comments, posts.sticky, posts.status, posts.author, users.first_name');
		$this->db->from($this->_table['posts'] . ' posts');
		//$this->db->join($this->_table['posts_to_categories'] . ' posts_to_categories', 'posts.id = posts_to_categories.post_id');
		$this->db->join($this->_table['categories'] . ' categories', 'posts.id_cat = categories.id');
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->where('posts.status', 'published');
		$this->db->where('posts.date_posted <=', $current_date);
		$this->db->where('categories.url_name', $url_name);
		$this->db->order_by('posts.sticky', 'DESC');
		$this->db->order_by('posts.id', 'DESC');
			
		$query = $this->db->get();
			
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			
			foreach (array_keys($result) as $key)
			{
				$result[$key]['categories'] = $this->categories->get_categories_by_ids($result[$key]['id_cat']);
				$result[$key]['comment_count'] = $this->db->where('post_id', $result[$key]['id'])->from($this->_table['comments'])->count_all_results();
			}

			return $result;
		}
	}

	public function get_post_by_url($year, $month, $day, $url_title)
	{
		$date = $year . '-' . $month . '-' . $day;
		
		$this->db->select('posts.id, posts.author, posts.date_posted, posts.title, posts.url_title, posts.head_article, posts.main_article, posts.id_cat, posts.allow_comments, posts.sticky, posts.status, posts.author, users.first_name');
		$this->db->from($this->_table['posts'] . ' posts');
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->where('posts.status', 'published');
		$this->db->where('posts.url_title', $url_title);
		$this->db->where('posts.date_posted', $date);
		$this->db->limit(1);
			
		$query = $this->db->get();
			
		if ($query->num_rows() == 1)
		{
			$result = $query->row_array();
			
			$result['categories'] = $this->categories->get_categories_by_ids($result['id_cat']);
			$result['comment_count'] = $this->db->where('post_id', $result['id'])->from($this->_table['comments'])->count_all_results();

			return $result;
		}
	}
	
	public function get_post_by_id($post_id, $where=null)
	{
		$this->db->select('posts.id, posts.author, posts.date_posted, posts.title, posts.url_title, posts.head_article, posts.main_article, posts.meta_key, posts.meta_desc, posts.image_header, posts.id_cat, posts.allow_comments, posts.sticky, posts.featured, posts.status, posts.author, users.first_name');
		$this->db->from($this->_table['posts'] . ' posts');
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->where('posts.id', $post_id);
		//for extra clause
		//where must be array
		if($where != null && is_array($where)){
			$this->db->where($where);
		}

		$this->db->limit(1);
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			//because just single row result
			$result = $query->row_array();

			if(isset($result))
			{
				$result['categories'] = $this->categories->get_categories_by_ids($result['id_cat']);
				$result['comment_count'] = $this->db->where('post_id', $result['id'])->from($this->_table['comments'])->count_all_results();
				$result['tags'] = $this->get_tags_by_id_post($result['id']);
			}
			
			return $result;
		}
	}
	
	public function get_posts_by_tags($tag_name)
	{
		$current_date = date('Y-m-d');
		
		$this->db->select('posts.id, posts.author, posts.date_posted, posts.title, posts.url_title, posts.head_article, posts.main_article, posts.id_cat, posts.allow_comments, posts.sticky, posts.status, posts.author, users.first_name');
		$this->db->from($this->_table['posts'] . ' posts');
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->join($this->_table['tags_to_posts'] . ' tags_to_posts', 'posts.id = tags_to_posts.post_id');
		$this->db->join($this->_table['tags'] . ' tags', 'tags_to_posts.tag_id = tags.id');
		$this->db->where('posts.status', 'published');
		$this->db->where('posts.date_posted <=', $current_date);
		$this->db->where('tags.name', $tag_name);
		$this->db->order_by('posts.sticky', 'DESC');
		$this->db->order_by('posts.id', 'DESC');
			
		$query = $this->db->get();
			
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			
			foreach (array_keys($result) as $key)
			{
				$result[$key]['categories'] = $this->categories->get_categories_by_ids($result[$key]['id_cat']);
				$result[$key]['comment_count'] = $this->db->where('post_id', $result[$key]['id'])->from($this->_table['comments'])->count_all_results();
			}

			return $result;
		}
	}

	public function get_posts_by_term($term)
	{
		$current_date = date('Y-m-d');
		
		$this->db->select('posts.id, posts.author, posts.date_posted, posts.title, posts.url_title, posts.head_article, posts.main_article, posts.id_cat, posts.allow_comments, posts.sticky, posts.status, posts.author, users.first_name');
		$this->db->from($this->_table['posts'] . ' posts');
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->where('posts.status', 'published');
		$this->db->where('posts.date_posted <=', $current_date);
		$this->db->like('posts.title', $term);
		$this->db->or_like('posts.head_article', $term);
		$this->db->or_like('posts.main_article', $term);
		$this->db->order_by('posts.sticky', 'DESC');
		$this->db->order_by('posts.id', 'DESC');
			
		$query = $this->db->get();
			
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			
			foreach (array_keys($result) as $key)
			{
				$result[$key]['categories'] = $this->categories->get_categories_by_ids($result[$key]['id_cat']);
				$result[$key]['comment_count'] = $this->db->where('post_id', $result[$key]['id'])->from($this->_table['comments'])->count_all_results();
			}

			return $result;
		}
	}

	/** 
	* Get and return all records from DB table.
	* 
	* @access public 
	* @param string
	* @return object
	*/ 
	public function getAll($field = "", $order_by = "",$limit="",$offset="")
	{
		if($order_by != "")
		{
			$this->db->order_by($order_by);
		}
		if($field != "")
		{
			$this->db->select($field);
		}
		
		if($limit != "")
		{
			$this->db->limit($limit,$offset);
		}
		
		$this->db->join($this->_table['users'] . ' users', 'posts.author = users.id');
		$this->db->join($this->_table['categories'].' cat','posts.id_cat = cat.id');

		$result = $this->db->get($this->_table['posts']);
		
		if($result->num_rows() > 0)
		{
			return $result;
		}
		else 
		{
			return FALSE;
		}
	}

	/** 
	* get id tags
	* 
	* @access public
	* @param array
	* @return array id tags
	*/
	function get_id_tags($tag)
	{
		$this->db->select('id');
		$this->db->where('name', $tag);
		
		$query = $this->db->get($this->_table['tags'], 1);
		
		if ($query->num_rows() == 1)
		{
			$result = $query->row_array();
			
			return $result['id'];
		}
		else
		{
			return FALSE;
		}
	}

	/** 
	* Add new record to DB table.
	* 
	* @access public
	* @param array
	* @return int
	*/ 
	public function add($params)
	{
		//insert into data_content table
		$this->db->insert($this->_table['posts'], $params);
		$query = $this->db->insert_id();
			
		if($query > 0)
		{
			return $query;
		} else {
			return false;
		}
	}

	/** 
	* Update existing record in DB table.
	* 
	* @access public 
	* @param int
	* @param array
	* @return bool
	*/ 
	public function update($id, $params)
	{
		$this->db->update($this->_table['posts'], $params, array('id' => $id));
		return $this->db->affected_rows();
	}
	
	
	/** 
	* Delete specified records from the DB table.
	* 
	* @access public 
	* @param array
	* @return bool
	*/ 
	public function delete($params)
	{
		$this->db->delete($this->_table['posts'], $params);

		//remove post from linked tags
		$this->db->delete($this->_table['tags_to_posts'], array('post_id' => $params['id']));

		return $this->db->affected_rows();
	}

	/** 
	* Parse tag commas to array
	* 
	* @access public
	* @param string
	* @return array
	*/ 
	public function parse_tags($tags)
	{
		$tags = str_replace(' ', '', $tags);
		$tags = explode(',', $tags);
		
		return $tags;
	}

	/** 
	* Add new tag for post
	* 
	* @access public
	* @param array
	* @return NULL
	*/ 
	function add_tags($tags, $post_id)
	{
		foreach ($tags as $tag)
		{
			$tag_id = $this->get_id_tags($tag);
			
			if ($tag_id == FALSE) 
			{
				$data = array
				(
					'name' => $tag
				);
					
				$this->db->insert($this->_table['tags'], $data);
				
				$tag_id = $this->db->insert_id();
			}

			$this->add_tag_to_post($tag_id, $post_id);
		}
	}

	/** 
	* Add tags to post
	* 
	* @access public
	* @param array
	* @return array id tags
	*/
	function add_tag_to_post($tag_id,$post_id)
	{
		$data = array
		(
			'tag_id' => $tag_id,
			'post_id' => $post_id
		);
					
		$this->db->insert($this->_table['tags_to_posts'], $data);
	}

	/** 
	* Get tags by id post
	* 
	* @access public
	* @param int
	* @return string
	*/
	function get_tags_by_id_post($post_id)
	{
		$this->db->select('tags.name');
		$this->db->join('tags_to_posts','tags.id = tags_to_posts.tag_id');
		$this->db->where('tags_to_posts.post_id',$post_id);
					
		$query = $this->db->get($this->_table['tags']);

		if($query)
		{
			$tags_string = '';
			foreach($query->result_array() as $row):
				$tags_string .= $row['name'].',';
			endforeach;

			return rtrim($tags_string,',');
		}
		else
		{
			return false;
		}
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/Posts_model.php */