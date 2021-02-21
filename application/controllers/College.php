<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template_b file, choose Tools | Templates
 * and open the template_b in the editor.
 */


class College extends CI_Controller
{

	function __construct() {
		parent::__construct();

		$allow = ($this->session->userdata('role') == 2 ? true : false) ||
			($this->session->userdata('role') == 3 ? true : false);

		if ($allow) {
			$this->load->model('mcollege');
		} else {
			redirect('dashboard');
		}
	}

	/**
	 * Digunakan untuk menampilkan tabel yang berisikan daftar kampus
	 * Apabila data college sudah digunakan pada service lain,
	 * maka tombol delete dibuat disable atau tidak dapat digunakan
	 * Untuk mengatasi hal tersebut terdapat beberapa cara:
	 * 		[1] Mendapatkan seluruh data college dan menggunakan if-else pada view
	 * 		[2] Memisahkan data yang telah digunakan dan yang belum digunakan kemudian dirender ke view
	 * Yang digunakan dalam kasus ini adalah poin kedua.
	 * Data dipisahkan terlebih dahulu dengan menggunakan get_separated_college(), yang mana data difilter dalam DB
	 * Hal ini bertujuan untuk meringankan beban server app, karena proses filtering dilakukan pada server DB,
	 * proses filtering tidak menggunakan if-else yang melakukan pengecekan sampai dengan ribuan baris
	 * yang dapat memakan kinerja server app.
	 */
	function index() {
		$data['breadcrumb'] = 'college/vcustom_breadcrumb';
		$data['js'] 		= 'college/vcustom_script.php';
		$data['css']		= 'college/vcollege_css.php';
		$data['content'] 	= 'college/vcollege.php';
		$data['college']	= $this->mcollege->get_separated_college();
		$data['user_role']  = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}


	/**
	 * digunakan untuk menambahkan data kampus
	 */
	function insert_college() {
		$nama = $this->input->post('nama');
		$inisial = $this->input->post('inisial');

		$data = array(
			'college_name' => $nama,
			'college_abbr' => $inisial
		);

		$cek = $this->mcollege->insert($data);
		if ($cek) {
			redirect('college');
		}
	}


	/**
	 * digunakan untuk menghapus kampus berdasarkan id
	 * @param $id
	 */
	function delete_college($id) {
		$this->mcollege->delete($id);
		redirect('college');
	}


	/**
	 * digunakan untuk memperbarui data kampus
	 * @param $id
	 */
	function update_proses($id) {
		$nama = $this->input->post('name');
		$inisial = $this->input->post('inisial');

		$data = array(
			'college_name' => $nama,
			'college_abbr' => $inisial
		);

		$cek = $this->mcollege->update($id, $data);
		if ($cek > 0) {
			redirect('college');
		}
	}
}
