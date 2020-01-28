<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model
{

	private $_table;

	
	public function __construct()
	{
        parent::__construct();
        
        $this->_table = $this->config->item('database_tables');
	}	
	
	
	// Public methods
	public function get_settings()
	{
		$this->db->select('name, value');
			
		$query = $this->db->get($this->_table['settings']);
			
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();

			foreach ($result as $row)
			{
				$result[$row['name']] = $row['value'];
			}
			
			return $result;
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
	public function update($params)
	{	
		foreach($params as $key => $value):
			$this->db->set('value', $value);
			$this->db->where('name', $key);
			$this->db->update($this->_table['settings']);
		endforeach;
		
		return $this->db->affected_rows();;
	}
	

}

/* End of file Settings_model.php */ 
/* Location: ./application/models/Settings_model.php */ 