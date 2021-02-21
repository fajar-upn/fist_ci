<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Muser_role extends CI_Model {

	/**
	 * menampilkan seluruh data role pada tabel fis_ruser_roles
	 * @return mixed
	 */
	public function get_roles() {
		$role = $this->db->get('fis_ruser_roles');
		return $role->result();
	}
}
?>
