<?php

class Categories_model extends CI_Model
{
	// Protected or private properties
	protected $_table;
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
			
		$this->_table = $this->config->item('database_tables');
	}

	// Public methods
	public function get_categories()
	{
		$this->db->select('id, name, url_name, description');
			
		$query = $this->db->get($this->_table['categories']);
			
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}
	
	public function get_categories_by_ids($category_ids)
	{
		$this->db->select('id, name, url_name, description');
		$this->db->where_in('id', $category_ids);
			
		$query = $this->db->get($this->_table['categories']);
			
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}

	public function get_categories_by_url($url)
	{
		$this->db->select('id, name, url_name, description');
		$this->db->where('url_name', $url);

		$query = $this->db->get($this->_table['categories']);

		if($query->num_rows() > 0){
			return $query->row_array();
		}
	}
	
	public function get_categories_by_post($post_id)
	{
		$this->db->select('categories.name');
		$this->db->join($this->_table['categories'] . ' categories', 'posts_to_categories.category_id = categories.id');
		$this->db->where('post_id', $post_id);
		
		$query = $this->db->get($this->_table['posts_to_categories'] . ' posts_to_categories');
			
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}

	/** 
	* Get and return all category from DB table.
	* 
	* @access public 
	* @param string
	* @return object
	*/ 
	public function getAll($field='', $order_by="",$limit="",$offset="")
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
        
		$result = $this->db->get($this->_table['categories']);
	
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
	* Add new record to categories table.
	* 
	* @access public
	* @param array
	* @return bool
	*/ 
	public function add($input_data)
	{
	
		$this->db->insert($this->_table['categories'], $input_data);
		$query = $this->db->insert_id();
		
		if($query > 0)
		{
			return true;
		} else {
			return false;
		}
	}
	
	
	/** 
	* Update existing record in categories table.
	* 
	* @access public 
	* @param int
	* @param array
	* @return bool
	*/ 
	public function update($id, $params)
	{
		$this->db->update($this->_table['categories'], $params, array('id' => $id));
		return $this->db->affected_rows();
	}
	
	
	/** 
	* Delete specified records from the categories table.
	* 
	* @access public 
	* @param array
	* @return bool
	*/ 
	public function delete($params)
	{
		$this->db->delete($this->_table['categories'], $params);
		return $this->db->affected_rows();
	}
}

/* End of file Categories_model.php */
/* Location: ./application/models/Categories_model.php */