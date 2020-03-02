<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Ifuk Permana
 * @application if-blog
 * @copyright 2019
 * --------------------------------------------------------------------------
 *  Page Model
 * --------------------------------------------------------------------------
 * Model for Page
 * 
 */
 
 class Page_model extends CI_Model{
	
	// Protected or private properties
	protected $_table;

	function __construct()
	{
		parent::__construct();

		$this->_table = $this->config->item('database_tables');
			
	}
	
	/** 
	* Get and return all records from DB table.
	* 
	* @access public 
	* @param string
	* @return object
	*/ 
	public function getAll($field = "", $order_by = "", $limit="", $offset="")
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

		$this->db->join($this->_table['users'] . ' users', 'pages.author = users.id');

		$result = $this->db->get($this->_table['pages']);
		
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
	* Get and return specified record from DB table.
	* 
	* @access public 
	* @param array
	* @return object
	*/ 	
	public function getWhere($field = "", $params, $order_by = NULL)
	{
		if($field != "")
		{
			$this->db->select($field);
		}
		
		if($order_by)
		{
			$this->db->order_by($order_by);
		}
		$result = $this->db->get_where($this->_table['pages'], $params);
		
		return $result;
	}
	
	/** 
	* Get and return specified record from DB table by id.
	* 
	* @access public 
	* @param int
	* @return object
	*/ 	
	public function get($id)
	{
		$result = $this->db->get_where($this->_table['pages'], array('id' => $id));
		
		if($result->num_rows() > 0)
		{
			return $result->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	/** 
	* Get and return specified record from DB table by id.
	* 
	* @access public 
	* @param string
	* @return object
	*/ 	
	public function get_by_url($url_name)
	{
		$result = $this->db->get_where($this->_table['pages'], array('url_title' => $url_name));
		
		if($result->num_rows() > 0)
		{
			return $result->row_array();
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
	* @return bool
	*/ 
	public function add($params)
	{
		//insert into data_content table
		$this->db->insert($this->_table['pages'], $params);
		$query = $this->db->insert_id();
			
		if($query > 0)
		{
			return true;
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
		$this->db->update($this->_table['pages'], $params, array('id' => $id));
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
		$this->db->delete($this->_table['pages'], $params);
		return $this->db->affected_rows();
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
		if($where != null && is_array($where)){
			$this->db->where($where);
		}
	
		return $this->db->count_all_results($this->_table['pages']);
	}
}

?>