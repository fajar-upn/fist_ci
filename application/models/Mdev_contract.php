<?php 
	class Mdev_contract extends CI_Model{

		function insertdata($dataContract){
			$this->db->insert('fis_ddevelop_contracts',$dataContract);
			return $this->db->insert_id();
		}

		function insertFitur($data) {
			$this->db->insert_batch('fis_ddevelop_features',$data);
		}

		function get_list_berkas(){
			$this->db->select('*');
			$this->db->from('fis_ddevelop_contracts');
			$this->db->order_by('dcontr_date DESC');
			$query=$this->db->get();
			return $query->result();
		}

		public function get_list_contract()
		{
			return $this->db->get('fis_vdev_contracts')->result();
		}

		public function getContractById($id)
		{
			return $this->db->get_where('fis_vdev_contracts', array('contract_id'=>$id))->row();
		}

		public function getFeatureByContractId($id)
		{	$this->db->select('*');
			$this->db->from('fis_ddevelop_features');
			$this->db->join('fis_rdevelop_modules', 'fis_rdevelop_modules.dmodules_id = fis_ddevelop_features.dfeature_module_fk');
			$this->db->where('fis_ddevelop_features.dfeature_contract_fk', $id);
			$query = $this->db->get();
			
			return $query->result();
		}


		public function get_develop_files()
		{
			$this->db->select('*');
			$this->db->from('fis_ddevelop_files');
			$this->db->join('fis_ddevelop_contracts', 'fis_ddevelop_files.dfiles_id = fis_ddevelop_contracts.dcontr_files_fk', 'left');
			$query = $this->db->get();
			return $query->result();
		}

		public function get_develop_files2()
		{
			$this->db->select('*');
			$this->db->from('fis_ddevelop_files');
			$this->db->join('fis_ddevelop_contracts', 'fis_ddevelop_files.dfiles_id = fis_ddevelop_contracts.dcontr_files_fk');
			$query = $this->db->get();
			return $query->result();
		}

		public function get_by_id($id) {
			$this->db->select('*');
			$this->db->where('dcontr_id',$id);
			$this->db->from('fis_ddevelop_contracts');
			$query = $this->db->get();
			return $query->row();
		}


		function deleteContract($id)
    {
        if ($this->db->delete('fis_ddevelop_contracts', array('dcontr_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }

	}

	function updateContract($data, $id){
		if($this->db->update('fis_ddevelop_contracts', $data, array('dcontr_id' => $id))){
			return true;
		} else return false;
	}

	public function changeFeatureStatus($id)
	{
		$SQL = 'UPDATE fis_ddevelop_features SET dfeature_done= NOT dfeature_done WHERE dfeature_id=' . $id;
		return $this->db->query($SQL);
	}
}
 ?>