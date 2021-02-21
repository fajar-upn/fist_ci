<?php 
	class Mdevelopment_submitfile extends CI_Model{

		function insert_account($data){
			$this->db->insert('fis_duser_accounts',$data);
			return $this->db->insert_id();
		}

		public function get_account($email)
		{
			return $this->db->get_where('fis_duser_accounts', array('uacc_email' => $email))->row();
		}

		function insertprofile($data){
			$this->db->insert('fis_duser_profiles',$data);
		}

		function insertfile($data){
			$this->db->insert('fis_ddevelop_files',$data);
			return $this->db->insert_id();
		}

		function read(){
			$this->db->order_by('dfiles_status DESC');
			$files=$this->db->get('fis_ddevelop_files');
			return $files->result();
		}

		function update($data, $id){
			$this->db->where('dfiles_id', $id);
			$this->db->update('fis_ddevelop_files', $data);

		}

		function get_by_id($id) {
        	$this->db->where('dfiles_id', $id);
        	$query = $this->db->get('fis_ddevelop_files');
        	return $query->row(); //untuk memastikan baris dari query  tersebut ada
     	}
	}
 ?>