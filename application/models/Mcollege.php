<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mcollege extends CI_Model {

	function __construct() {
		parent:: __construct();
	}

	/**
	 * Insert data college
	 * @param $data
	 * @return bool
	 */
	function insert($data) {
		if ($this->db->insert('fis_rcolleges', $data)) {
			$this->session->set_userdata('typeNotif', 'successAddCollege');
			return $this->db->insert_id();
		} else {
			$this->session->set_userdata('typeNotif', 'failedAddCollege');
			return false;
		}
	}


	/**
	 * Mendapatkan seluruh data kampus dari tabel fis_rcolleges
	 * @return mixed
	 */
	function read() {
		$this->db->select('*');
		$this->db->from('fis_rcolleges');
		return $this->db->get()->result();
	}


	/**
	 * Mendapatkan seluruh data college
	 * Data yang didapatkan dibagi menjadi dua:
	 * - used_college : merepresentasikan data college yang telah digunakan pada tabel lain
	 * - not_used_college : merepresentasikan data college yang belum digunakan pada tabel lain
	 * Tabel yang dimaksud yaitu fis_dservice_consultations
	 * @return array
	 */
	function get_separated_college() {
		$id = $this->get_usage_id();
		$used_college		= $this->get_used_college($id);
		$not_used_college	= $this->get_not_used_college($id);

		return array(
			'used_college'		=> $used_college,
			'not_used_college'	=> $not_used_college
		);
	}


	/**
	 * Menghapus data kampus dari tabel fis_rcolleges berdasarkan id
	 * @param $id
	 * @return bool
	 */
	function delete($id) {
		$is_used = $this->check_usage($id);

		if ($is_used) {
			$this->session->set_userdata('typeNotif', 'collegeHasUsed');
			return false;
		} else {
			$this->db->where('college_id', $id);
			if ($this->db->delete('fis_rcolleges')) {
				$this->session->set_userdata('typeNotif', 'successDeleteCollege');
				return true;
			} else {
				$this->session->set_userdata('typeNotif', 'failedDeleteCollege');
				return false;
			}
		}
	}


	/**
	 * Memperbarui data kampus pada tabel fis_rcolleges
	 * @param $id
	 * @param $data
	 * @return bool
	 */
	function update($id, $data){
		$this->db->where('college_id', $id);
		if ($this->db->update('fis_rcolleges', $data)) {
			$this->session->set_userdata('typeNotif', 'successUpdateCollege');
			return $this->db->affected_rows();
		} else {
			$this->session->set_userdata('typeNotif', 'failedUpdateCollege');
			return false;
		}
	}


	/**
	 * melakukan pengecekan penggunaan data college
	 * bertujuan untuk menghindari error apabila data digunakan sebagai referensi tabel lain
	 * @param $id
	 * @return mixed
	 */
	function check_usage($id) {
		$this->db->where('scons_college_fk', $id);
		$result = $this->db->get('fis_dservice_consultations');
		return $result->row();
	}


	/**
	 * Mendapatkan id dari college yang telah digunakan pada tabel lain
	 * @return array
	 */
	function get_usage_id() {
		/**
		 * Untuk mengembalikan data college yang digunakan
		 * maka perlu mendapatkan foreign key mana saja data yang digunakan pada tabel lain
		 * Oleh karenanya pertama yang perlu dilakukan yaitu mendapatkan seluruh foreign key college
		 * yang terdapat pada tabel fis_dservice_consultation
		 */
		$this->db->distinct();
		$this->db->select('scons_college_fk');
		$id_usage = $this->db->get('fis_dservice_consultations');
		$id_usage = $id_usage->result();

		/**
		 * Sampai sini data dalam $id_usage merupakan id college yang telah digunakan
		 * akan tetapi bentuknya masih object.
		 * Data yang diperlukan berupa array, oleh karenanya object tersebut akan di parse terlebih dahulu
		 */
		$id = array();
		foreach ($id_usage as $key => $item) {
			array_push($id, $item->scons_college_fk);
		}

		return $id;
	}


	/**
	 * Mendapatkan data college yang telah digunakan pada tabel lain
	 * @param $id
	 * @return mixed
	 */
	function get_used_college($id) {
		/**
		 * $id sudah berupa array,
		 * sekarang tinggal melakukan query untuk mendapatkan data college berdasarkan id yang telah digunakan
		 */
		$this->db->where_in('college_id', $id);
		$college_usage = $this->db->get('fis_rcolleges');
		return $college_usage->result();
	}


	/**
	 * Mendapatkan data college yang belum digunakan pada tabel lain
	 * @param $id
	 * @return mixed
	 */
	function get_not_used_college($id) {
		/**
		 * $id sudah berupa array
		 * sekarang tinggal melakukan query untuk mendapatkan data college berdasarkan id yang belum digunakan
		 */
		$this->db->where_not_in('college_id', $id);
		$college_not_usage = $this->db->get('fis_rcolleges');
		return $college_not_usage->result();
	}
}
