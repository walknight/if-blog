<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Ifuk Permana
 * @application ifblog
 * @copyright 2019
 * --------------------------------------------------------------------------
 *  Navigation Model
 * --------------------------------------------------------------------------
 * 
 */

class Navigation_model extends CI_Model{
	
	
	public $nav_data = array();
	
	public function __construct()
	{
        parent::__construct();
        
        $this->_table = $this->config->item('database_tables');
	}
	
	public function load_nav($group)
	{
		$this->db->select('*');
		$this->db->where('id_groups',$group);
		$this->db->order_by('order ASC');
		$query = $this->db->get($this->_table['navigation']);
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $menu):
			
				$nav_data[$menu->parent_id][] = $menu;
			
			endforeach;
			
		return $nav_data;
		
		} else {
			
			return false;
		}
	}
	
	/** 
	* Get and return all records from DB table.
	* 
	* @access public 
	* @param string
	* @return object
	*/ 
	public function getAll($order_by="", $limit="",$offset="")
	{
		if($order_by != "")
		{
			$this->db->order_by($order_by);
		}
        
        if($limit != "")
        {
            $this->db->limit($limit,$offset);
        }
        
		$result = $this->db->get($this->_table['navigation']);
		
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
	* Add new record to DB table.
	* 
	* @access public
	* @param array
	* @return bool
	*/ 
	public function add($input_data)
	{
		$input_data['order'] = $this->get_max_number_order() + 1;
		
		$this->db->insert($this->_table['navigation'], $input_data);
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
		$this->db->update($this->_table['navigation'], $params, array('id' => $id));
		return $this->db->affected_rows();
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
		$result = $this->db->get_where($this->_table['navigation'], array('id' => $id));
		
		if($result->num_rows() > 0)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
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
		$this->db->delete($this->_table['navigation'], $params);
		
        $this->reorganize_navigation();
	}
	
	/** 
	* Get max ordering number
	* 
	* @access public
	* @param array
	* @return max number order
	*/ 
	
	public function get_max_number_order()
	{
		$this->db->select_max('order');
		
		$query = $this->db->get($this->_table['navigation']);
		
		$order = $query->row();
		
		return $order->menu_order;
	}
    
    /** 
	* Get menu position
	* 
	* @access public
	* @param id
	* @return position number item
	*/
    protected function get_item_position($id)
	{
		$this->db->select('order');
		$this->db->where('id', $id);
		
		$query = $this->db->get($this->_table['navigation'], 1);
			
		if ($query->num_rows() == 1)
		{
			$result = $query->row_array();
			
			return $result['order'];
		}
	}
    
    /** 
	* Reorganized Item Position After Delete
	* 
	* @access public
	* @param 
	* @return NULL
	*/
	public function reorganize_navigation()
	{
		$this->db->select('id');
		
		$query = $this->db->get($this->_table['navigation']);
			
		if ($query->num_rows() > 0)
		{
			$result =  $query->result_array();
			
			$i = 0;

			foreach ($result as $row)
			{
				$this->db->set('order', ++$i);
				$this->db->where('id', $row['id']);
				$this->db->update($this->_table);
			}
		}
	}
    
    /** 
	* Move up position ordering 
	* 
	* @access public
	* @param id
	*/ 
    
    public function move_item_up($id)
	{
		$previous_item_id = $this->get_previous_item_id($this->get_item_position($id));
		
		$this->db->set('order', 'order-1', FALSE);
		
		$this->db->where('id', $id);
		$this->db->update($this->_table['navigation']);
		
		$this->db->set('order', 'order+1', FALSE);
		
		$this->db->where('id', $previous_item_id);
		$this->db->update($this->_table['navigation']);
	}
	
    /** 
	* Move down position ordering 
	* 
	* @access public
	* @param id
	*/
    
	public function move_item_down($id)
	{
		$next_item_id = $this->get_next_item_id($this->get_item_position($id));
		
		$this->db->set('order', 'order+1', FALSE);
		
		$this->db->where('id', $id);
		$this->db->update($this->_table['navigation']);
		
		$this->db->set('order', 'order-1', FALSE);
		
		$this->db->where('id', $next_item_id);
		$this->db->update($this->_table['navigation']);
	}
    
    /** 
	* Get Previous Position Item
	* 
	* @access protected
	* @param id
	*/
    protected function get_previous_item_id($position)
	{
		$this->db->select('id');
		$this->db->where('order', $position - 1);
		
		$query = $this->db->get($this->_table['navigation'], 1);
			
		if ($query->num_rows() == 1)
		{
			$result = $query->row_array();
			
			return $result['id'];
		}
	}
	
    /** 
	* Get Next Position Item
	* 
	* @access protected
	* @param id
	*/
	protected function get_next_item_id($position)
	{
		$this->db->select('id');
		$this->db->where('order', $position + 1);
		
		$query = $this->db->get($this->_table['navigation'], 1);
			
		if ($query->num_rows() == 1)
		{
			$result = $query->row_array();
			
			return $result['id'];
		}
    }
    
    /** ===========================================================================================================
     *              NAVIGATION GROUP
     *  ===========================================================================================================
     */

    /** 
	* Get and return all records from DB table.
	* 
	* @access public 
	* @param string
	* @return object
	*/ 
	public function getAllGroup($order_by="", $limit="",$offset="")
	{
		if($order_by != "")
		{
			$this->db->order_by($order_by);
		}
        
        if($limit != "")
        {
            $this->db->limit($limit,$offset);
        }
        
		$result = $this->db->get($this->_table['nav_groups']);
		
		if($result->num_rows() > 0)
		{
			return $result;
		}
		else 
		{
			return FALSE;
		}
	}
}


/* End of file Navigation_model.php */
/* Location: ./application/models/Navigation_model.php */