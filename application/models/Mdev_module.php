<?php 
class Mdev_module extends CI_Model{

	function insertdata($data){
		return $this->db->insert('fis_rdevelop_modules',$data);
	}

	function get_list_berkas(){
		$this->db->select('*');
		$this->db->from('fis_rdevelop_modules');
		$this->db->order_by('dmodules_difficulties');
		$query=$this->db->get();
		return $query->result();
	}

	public function get_by_id($id) {
		$this->db->select('*');
		$this->db->where('dmodules_id',$id);
		$this->db->from('fis_rdevelop_modules');
		$query = $this->db->get();
		return $query->row();
	}

	function deleteModule($id)
	{
		return $this->db->delete('fis_rdevelop_modules', array('dmodules_id' => $id));
	}

	function insertModule($data){
		if ($result = $this->db->insert('fis_rdevelop_modules', $data)) {
			$this->session->set_userdata('typeNotif', 'successAddData');
		} else {
			$this->session->set_userdata('typeNotif', 'errorAddData');
		}
		return $result;
	}
	
	function updateModule($data, $id){
		if ($result = $this->db->update('fis_rdevelop_modules', $data, array('dmodules_id' => $id))) {
			$this->session->set_userdata('typeNotif', 'successEditData');
		} else {
			$this->session->set_userdata('typeNotif', 'errorEditData');
		}
		return $result;
	}
}
?>