<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdev_calculator extends CI_Model {

	public function get_difficulties()
	{
		$this->db->select('*');
		$this->db->from('fis_rdevelop_modules');
		$this->db->order_by('dmodules_difficulties');
			$query = $this->db->get();
		return $query->result();
	}

	public function get_dev_files()
	{
		return $this->db->get_where('fis_ddevelop_files', array('dfiles_status'=>'y'))->result();
	}

	public function add($data)
	{
		return $this->db->insert('fis_ddevelop_price_reference', $data);
	}

	public function delete($id)
	{
		return $this->db->delete('fis_ddevelop_price_reference', array('dpriceref_id' => $id));
	}

	public function deleteall()
	{
		return $this->db->empty_table('fis_ddevelop_price_reference'); 
	}
}