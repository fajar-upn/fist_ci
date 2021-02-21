<?php 
	class Model_kontrak extends CI_Model{

		function insertdata($data){
			return $this->db->insert('fis_ddevelop_contracts',$data);
		}

		function get_list_berkas(){
			$this->db->select('*');
			$this->db->from('fis_ddevelop_contracts');

			$query=$this->db->get();
			return $query->result();
		}


		function delete($id)
    {
        if ($this->db->delete('fis_ddevelop_files', array('dfiles_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }

	}
}
 ?>