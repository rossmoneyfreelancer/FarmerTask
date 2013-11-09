<?php
class Livestock_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_livestock($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('livestock');
			return $query->result_array();
		}

		$query = $this->db->get_where('livestock', array('id' => $id));
		return $query->result_array();
	}

	public function get_livestock_with_farmer($farmerid = FALSE)
	{
		$this->db->select('farmer.name as farmer, livestock.cowname as name, averagedailymilk');
		$this->db->from('livestock');
		$this->db->join('farmer', 'farmer.id = livestock.farmer_id' );
		$this->db->order_by('averagedailymilk', 'DESC');

		if ($farmerid != FALSE)
		{
			$this->db->where('livestock.farmer_id', $farmerid);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_livestock_by_farmer($farmerid = FALSE)
	{
		$this->db->select('*');
		$this->db->from('livestock');
		$this->db->where('farmer_id', $farmerid);
		$this->db->order_by('averagedailymilk', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

}