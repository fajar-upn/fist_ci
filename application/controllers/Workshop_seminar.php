<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop_seminar extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mworksem_participant');
        $this->load->model('mworksem_registration_answer');
    	$this->load->model('mworksem_registration_qa_option');
    	$this->load->model('mworksem_registration_question');
    	$this->load->model('mworksem_speaker');
        $this->load->model('mworkshop_seminar');
    }


	/**
	 * menampilkan daftar manajemen workshop dan seminar
	 */
	public function index()
	{
		$user_access	= $this->session->userdata('role');
		$as_developer	= 2;
		$as_admin		= 3;
		$as_director	= 7;

		if (!($user_access	== $as_developer or
			$user_access	== $as_admin or
			$user_access	== $as_director)) {
			redirect('dashboard');
		}

		$data['user_role']			= $this->session->userdata('role');
		$data['workshop_seminars']	= $this->mworkshop_seminar->get_workshop_seminars();

		foreach ($data['workshop_seminars'] as $key => $val) {
			if (!empty($val->ws_date_start)) {
				$data['workshop_seminars'][$key]->ws_date_start	= $this->convert_date($val->ws_date_start);
				$data['workshop_seminars'][$key]->ws_date_done	= $this->convert_date($val->ws_date_done);
			}
		}

    	$data['js']			= 'workshop_seminar/vws_management_js';
    	$data['css']		= 'workshop_seminar/vws_management_css';
    	$data['content']	= 'workshop_seminar/vws_management';
    	$data['breadcrumb']	= 'workshop_seminar/vws_management_breadcrumb';
    	$this->load->view('template/vtemplate', $data);
    }


	/**
	 * menambahkan data seminar, mulai dari informasi umum seminar, informasi pembicara, dan informasi tentang list untuk registrasi
	 * dalam sekali insert langsung menghubungkan dengan 4 tabel
	 */
	public function insert($insert_for)
	{
		$user_access	= $this->session->userdata('role');
		$as_developer	= 2;
		$as_admin		= 3;

		if (!($user_access == $as_developer or
			$user_access == $as_admin)) {
			redirect('dashboard');
		}

		$input = $this->input->post(NULL, TRUE);
		extract($input);

		/**
		 * ws_add digunakan untuk menambahkan workshop seminar
		 */
		if ($insert_for == "ws_add") {
			/**
			 * data untuk informasi umum seminar
			 */
			$data_ws = array(
				'ws_type'		=> $type,
				'ws_title'		=> $title,
				'ws_date_start'	=> $date_start,
				'ws_date_done'	=> $date_end,
				'ws_time_start'	=> $time_start,
				'ws_time_done'	=> $time_end,
				'ws_desc'		=> $description,
				'ws_place'		=> $place,
				'ws_price'		=> $price,
				'ws_active'		=> 'n',
				'user_create'	=> $this->session->userdata('id')
			);

			$ws_id = $this->mworkshop_seminar->insert($data_ws);

			/**
			 * data untuk informasi pembicara
			 */
			$data_speaker = array(
				'wsspeaker_ws_fk'		=> $ws_id,
				'wsspeaker_name'		=> $name,
				'wsspeaker_theory'		=> $theory,
				'wsspeaker_identity'	=> $identity,
				'user_create'			=> $this->session->userdata('id')
			);

			$speaker_id = $this->mworksem_speaker->insert($data_speaker);

			/**
			 * data untuk informasi pertanyaan serta opsi apabila tipe pertanyaannya membutuhkan opsi
			 */
			$question_option_index	= 0;

			foreach ($question as $key_question => $val_question) {
				$data_question = array(
					'wsrque_ws_fk'		=> $ws_id,
					'wsrque_question'	=> $val_question,
					'wsrque_type'		=> $type_question[$key_question],
					'wsrque_page'		=> $page[$key_question],
					'user_create'		=> $this->session->userdata('id')
				);

				$question_id = $this->mworksem_registration_question->insert($data_question);

				if (
					$type_question[$key_question] == 'checkbox' or
					$type_question[$key_question] == 'dropdown' or
					$type_question[$key_question] == 'radio'
				) {

					// membagi memecah opsi jawaban
					$option = explode(";", $question_option[$question_option_index]);

					foreach ($option as $val) {
						$data_option = array(
							'wsrselect_wsrque_fk'	=> $question_id,
							'wsrselect_selection'	=> ltrim($val),  // remove whitespace didepan
							'user_create'			=> $this->session->userdata('id')
						);
						$option_id = $this->mworksem_registration_qa_option->insert($data_option);
					}
					$question_option_index++;
				}
			}

			redirect('workshop_seminar');
		}

		/**
		 * ws_registration digunakan untuk menambahkan peserta dan jawaban registrasi
		 */
		else if ($insert_for == "ws_registration") {
			$data_participant = array(
				'wspart_name'			=> $name,
				'wspart_paid_status'	=> 0,
				'user_create'			=> $this->session->userdata('id')
			);

			$participant_id = $this->mworksem_participant->insert($data_participant);

			$data_question_answer = array(
				'wsrans_wsrque_fk'		=> $question_id,
				'wsrans_wspart_fk'		=> $participant_id,
				'wsrans_answer'			=> $answer,
				'user_create'			=> $this->session->userdata('id')
			);

			$this->mworksem_registration_answer->insert($data_question_answer);
		}
	}


	/**
	 * Digunakan untuk mengupdate workshop seminar
	 * mulai dari informasi workshop seminar sampai pertanyaan registrasi
	 * @param $ws_id
	 */
	public function update($ws_id) {
		$user_access	= $this->session->userdata('role');
		$as_developer	= 2;
		$as_admin		= 3;

		if (!($user_access == $as_developer or
			$user_access == $as_admin)) {
			redirect('dashboard');
		}

		$input = $this->input->post(NULL, TRUE);
		extract($input);

		/**
		 * data untuk informasi umum seminar
		 */
		$data_ws = array(
			'ws_type'		=> $type,
			'ws_title'		=> $title,
			'ws_date_start'	=> $date_start,
			'ws_date_done'	=> $date_end,
			'ws_time_start'	=> $time_start,
			'ws_time_done'	=> $time_end,
			'ws_desc'		=> $description,
			'ws_place'		=> $place,
			'ws_price'		=> $price,
			'user_update'	=> $this->session->userdata('id')
		);

		$this->mworkshop_seminar->update($data_ws, $ws_id);

		/**
		 * data untuk informasi pembicara
		 */
		$data_speaker = array(
			'wsspeaker_ws_fk'		=> $ws_id,
			'wsspeaker_name'		=> $name,
			'wsspeaker_theory'		=> $theory,
			'wsspeaker_identity'	=> $identity,
			'user_update'			=> $this->session->userdata('id')
		);

		$this->mworksem_speaker->update($data_speaker, $wsspeaker_id);

		/**
		 * Sebelum melakukan update pertanyaan workshop seminar (menambah, menghapus, mengedit),
		 * maka akan dicek terlebih dahulu apakah terdapat pertanyaan yang dihapus atau tidak
		 * Apabila terdapat pertanyaan yang dihapus, maka id dari pertanyaan akan disimpan dalam $list_delete_question
		 * dalam bentuk string dengan delimiter ";" yang kemudian akan dipecah menjadi array dan disimpan dalam
		 * variable $delete_question
		 */

		$delete_question = explode(";", $list_delete_question);

		/**
		 * Karena pada setiap akhir dari $list_delete_question adalah tanda ";" (semicolon), maka proses pemecahan
		 * menjadi array menyebabkan terbentuknya satu buah array yang isinya kosong
		 * Untuk menghilangkan ini dilakukan proses pop pada elemen terakhir dari array tersebut
		 */
		array_pop($delete_question);

		/**
		 * Selama proses penghapusan akan melakukan pengecekan apakah id dari pertanyaan yang dihapus bernilai 0
		 * Jika id bernilai 0 artinya pertanyaan tersebut baru saja ditambahkan dan belum tersimpan dalam database,
		 * oleh karenanya proses penghapusan yang melibatkan database dilewatkan.
		 * Jika id tidak bernilai 0 maka proses penghapusan dalam database akan dilakukan.
		 * ID yang terseimpan dalam variabel $question_id akan dihapus, hal ini dilakukan agar data yang dihapus
		 * tetap konsisten dan menghindari kesalahan penggunaan id maupun index
		 */
		foreach ($delete_question as $id_question) {
			if (strcmp($id_question, "0") != 0) {
				$this->mworksem_registration_qa_option->delete_by_question_id($id_question);
				$this->mworksem_registration_question->delete($id_question);
			}

			if ($key = array_search($id_question, $question_id)) {
				unset($question_id[$key]);  // penghapusan id
			}
		}

		/**
		 * Array yang dihapus dengan unset tidak membuat index dibuat kembali,
		 * diperlukan proses reindex agar index dalam array tetap terurut dengan baik dan tidak ada nilai yang terlewat
		 */
		$question_id = array_values($question_id);

		/**
		 * data untuk informasi pertanyaan serta opsi apabila tipe pertanyaannya membutuhkan opsi
		 */
		$question_option_index	= 0;
		foreach ($question as $key_question => $val_question) {
			if (isset($question_id[$key_question]) and strcmp($question_id[$key_question], "0") != 0) {
				$data_question = array(
					'wsrque_ws_fk'		=> $ws_id,
					'wsrque_question'	=> $val_question,
					'wsrque_type'		=> $type_question[$key_question],
					'wsrque_page'		=> $page[$key_question],
					'user_update'		=> $this->session->userdata('id')
				);

				$this->mworksem_registration_question->update($data_question, $question_id[$key_question]);

				$get_type = $this->mworksem_registration_question->get_question_type($question_id[$key_question]);
				$last_type = $get_type->wsrque_type;

				// jika tipe berbeda, maka opsi jawaban dihapus
				if (strcmp($last_type, $type_question[$key_question]) != 0) {
					$this->mworksem_registration_qa_option->delete_by_question_id($question_id[$key_question]);
				}

				if (
					$type_question[$key_question] == 'checkbox' or
					$type_question[$key_question] == 'dropdown' or
					$type_question[$key_question] == 'radio'
				) {

					// membagi memecah opsi jawaban
					$option		= explode(";", $question_option[$question_option_index]);
					$option_id	= explode(";", $question_option_id[$question_option_index]);

					foreach ($option as $key_option => $val) {
						$data_option = array(
							'wsrselect_wsrque_fk' => $question_id[$key_question],
							'wsrselect_selection' => ltrim($val),  // remove whitespace didepan
							'user_create' => $this->session->userdata('id')
						);

						$this->mworksem_registration_qa_option->insert($data_option);
					}
					$question_option_index++;
				}
			}
			else {
				$data_question = array(
					'wsrque_ws_fk'		=> $ws_id,
					'wsrque_question'	=> $val_question,
					'wsrque_type'		=> $type_question[$key_question],
					'wsrque_page'		=> $page[$key_question],
					'user_create'		=> $this->session->userdata('id')
				);

				$question_id = $this->mworksem_registration_question->insert($data_question);

				if (
					$type_question[$key_question] == 'checkbox' or
					$type_question[$key_question] == 'dropdown' or
					$type_question[$key_question] == 'radio'
				) {

					// membagi memecah opsi jawaban
					$option = explode(";", $question_option[$question_option_index]);

					foreach ($option as $val) {
						$data_option = array(
							'wsrselect_wsrque_fk'	=> $question_id,
							'wsrselect_selection'	=> ltrim($val),  // remove whitespace didepan
							'user_create'			=> $this->session->userdata('id')
						);
						$option_id = $this->mworksem_registration_qa_option->insert($data_option);
						$data_option['wsrque_id'] = 0;
					}
					$question_option_index++;
				}
			}
		}
		redirect('workshop_seminar');
    }


	/**
	 * Digunakan untuk menampilkan form yang berfungsi menambahkan workshop seminar
	 */
	public function add() {
		$user_access	= $this->session->userdata('role');
		$as_developer	= 2;
		$as_admin		= 3;

		if (!($user_access == $as_developer or
			$user_access == $as_admin)) {
			redirect('dashboard');
		}

		$data['workshop_question'] = array(
			1 => array(
				'question_id'	=> 0,
				'question'		=> 'Nama'
			),
			2 => array(
				'question_id'	=> 0,
				'question'		=> 'Email'
			),
			3 => array(
				'question_id'	=> 0,
				'question'		=> 'No Telp'
			),
			4 => array(
				'question_id'	=> 0,
				'question'		=> 'Instansi'
			)
		);

		$data['user_role']	= $this->session->userdata('role');
		$data['any_participant'] = 0;

    	$data['js']			= 'workshop_seminar/vws_form_add_js';
    	$data['css']		= 'workshop_seminar/vws_form_add_css';
    	$data['content']	= 'workshop_seminar/vws_form_add';
    	$data['breadcrumb']	= 'workshop_seminar/vws_form_add_breadcrumb';
    	$this->load->view('template/vtemplate', $data);
	}


	/**
	 * digunakan untuk mengedit workshop seminar
	 * jika sudah ada partisipan yang mendaftar workshop atau seminar maka tidak dapat mengedit pertanyaan
	 * @param $id
	 */
	public function edit($id) {
		$participant	= $this->mworksem_participant->get_participants($id);
		$user_access	= $this->session->userdata('role');
		$as_developer	= 2;
		$as_admin		= 3;

		if (!($user_access == $as_developer or
			$user_access == $as_admin)) {
			redirect('dashboard');
		}

		/**
		 * cek apakah sudah ada participant atau belum
		 * jika ada maka set $data['any_participant'] menjadi 1
		 * jika tidak ada maka set $data['any_participant'] menjadi 0
		 * hal ini digunakan untuk menentukan apakah form question masih dapat diedit atau tidak
		 */
		$any_participant = $participant ? $data['any_participant'] = 1 : $data['any_participant'] = 0;

		if ($any_participant) {
			$this->session->set_userdata('typeNotif', 'anyParticipantOnWS');
		}

		$data['is_edit'] = true;
		$data['workshop_seminar']	= $this->mworkshop_seminar->get_with_speaker_by_id($id);
		$data['workshop_question']	= $this->mworksem_registration_question->get_by_ws_id($id);

		$question			= array();
		$str_option			= '';
		$str_option_index	= '';

		foreach ($data['workshop_question'] as $row) {
			$data['workshop_question_option'] = $this->mworksem_registration_qa_option->get_by_question_id($row->wsrque_id);

			if ($data['workshop_question_option']) {
				$count	= 0;
				$len	= count($data['workshop_question_option']);
				foreach ($data['workshop_question_option'] as $val) {
					if ($count == $len - 1) {
						$str_option			.= "$val->wsrselect_selection";
						$str_option_index	.= "$val->wsrselect_id";
					} else {
						$str_option			.= "$val->wsrselect_selection; ";
						$str_option_index	.= "$val->wsrselect_id; ";
					}
					$count++;
				}

				array_push($question,
					array(
						'question_id'	=> $row->wsrque_id,
						'question_type'	=> $row->wsrque_type,
						'question'		=> $row->wsrque_question,
						'page'			=> $row->wsrque_page,
						'option'		=> array(
							'option_text'	=> $str_option,
							'option_id'		=> $str_option_index)
					));
				$str_option			= '';
				$str_option_index	= '';
			} else {
				array_push(
					$question,
					array(
						'question_id'	=> $row->wsrque_id,
						'question_type'	=> $row->wsrque_type,
						'question'		=> $row->wsrque_question,
						'page'			=> $row->wsrque_page
					));
			}
		}

		// define type pertanyaan
		$qtype = array(
			'text'		=> 'Jawaban Singkat',
			'textarea'	=> 'Jawaban Panjang',
			'checkbox'	=> 'Checkbox',
			'dropdown'	=> 'Dropdown',
			'radio'		=> 'Radio',
		);

		// define halaman pertanyaan
		$pages = array(2, 3, 4, 5);

		$data['workshop_question']	= $question;
		$data['user_role']			= $this->session->userdata('role');
		$data['qtypes'] 			= $qtype;
		$data['pages']				= $pages;
		$data['breadcrumb']			= 'workshop_seminar/vws_form_add_breadcrumb';
		$data['content']			= 'workshop_seminar/vws_form_add';
		$data['css']				= 'workshop_seminar/vws_form_add_css';
		$data['js']					= 'workshop_seminar/vws_form_add_js';
		$this->load->view('template/vtemplate', $data);
	}


	/**
	 * Digunakan untuk melakukan cek apakah suatu event sudah kadaluarsa atau belum
	 * Jika waktu sekarang lebih besar dari waktu yang terdapat dalam event
	 * maka event tersebut telah kadaluarsa, sehingga form registrasi tidak dapat dibuka
	 * @param $date_db
	 * @param $date_now
	 * @param $time_db
	 * @param $time_now
	 * @return bool
	 */
	public function is_expired($date_db, $date_now, $time_db, $time_now) {
		if (strcmp($date_db, $date_now) < 0 and strtotime($time_db) > $time_now) {
			return true;
		}
		return false;
	}


	/**
	 * digunakan untuk proses registrasi peserta workshop atau seminar
	 * dapat atau tidaknya diakses bergantung pada beberapa parameter
	 *
	 * dalam kasus ini workshop atau seminar terdapat beberapa rule (atau status) dalam pengaksesannya :
	 * - aktif, artinya workshop atau seminar dapat diakses oleh peserta dan waktu registrasi belum kadaluarsa
	 * - nonaktif, artinya workshop atau seminar tidak dapat diakses meskipun waktu registrasi belum kadaluarsa
	 * - expired, artinya workshop atau seminar tidak dapat diakses karena waktu pendaftaran sudah habis
	 *
	 * adapun parameternya :
	 * - admin ataupun developer dapat mengakses form registrasi apapun status dari workshop dan seminarnya
	 * - peserta hanya dapat mengakses form apabila workshop aktif dan tidak kadaluarsa
	 * @param $ws_id
	 */
	public function registration($ws_id) {
		$data['ws_id']				= $ws_id;
		$data['workshop_seminar']	= $this->mworkshop_seminar->get_ws_by_id($ws_id);
		$data['workshop_question']	= $this->mworksem_registration_question->get_by_ws_id($ws_id);

		date_default_timezone_set('Asia/Jakarta');
		$time_now		= date('Y-m-d H:i:s', time());
		$split_time_now	= explode(" ", $time_now);
		$date_now		= $split_time_now[0];
		$time_now		= strtotime($split_time_now[1]);

		$as_admin		= 3;
		$as_developer	= 2;

		/**
		 * cek apakah workshop atau seminar aktif atau tidak
		 * apabila result = N maka tidak aktif
		 * apabila result = Y maka aktif
		*/
		$is_active		= $data['workshop_seminar']->ws_active;

		/**
		 * cek hak akses dalam form
		 * $has_privileges berarti memiliki akses penuh terhadap form
		 * dan ketiga syarat yang ada (yang sudah disebutkan diatas) tidak berpengaruh.
		 */
		if ((int) $this->session->userdata('role') == $as_admin or
			(int) $this->session->userdata('role') == $as_developer) {
			$has_privileges = 1;  // true
		} else { $has_privileges = 0; }  // false

		/**
		 * Cek apakah workshop atau seminar sudah expired atau belum
		 */
		$is_expired		= $this->is_expired(
								$data['workshop_seminar']->ws_date_start,
								$date_now,
								$data['workshop_seminar']->ws_time_done,
								$time_now);

		/**
		 * babak penentukan form mana yang akan ditambilkan
		 * sesuai dengan rule yang sudah ditentukan diatas
		*/
		if (($is_expired and !$has_privileges) or ($is_active == 'N' and !$has_privileges)) {
			$this->load->view('workshop_seminar/vws_registration_not_found');
		}
		else if (!$is_expired or $has_privileges) {
			$question			= array();
			$str_option			= array();
			$str_option_index	= array();
			$list_page			= array();

			foreach ($data['workshop_question'] as $row) {
				$data['workshop_question_option'] = $this->mworksem_registration_qa_option->get_by_question_id($row->wsrque_id);

				array_push($list_page, $row->wsrque_page);

				if ($data['workshop_question_option']) {
					foreach ($data['workshop_question_option'] as $val) {
						array_push($str_option, $val->wsrselect_selection);
						array_push($str_option_index, $val->wsrselect_id);
					}

					array_push($question,
						array(
							'question_id'	=> $row->wsrque_id,
							'question_type'	=> $row->wsrque_type,
							'question'		=> $row->wsrque_question,
							'page'			=> $row->wsrque_page,
							'option'		=> array(
												'option_text'	=> $str_option,
												'option_id'		=> $str_option_index)
						));
					$str_option			= array();
					$str_option_index	= array();
				}

				else {
					array_push($question,
						array(
							'question_id'	=> $row->wsrque_id,
							'question_type'	=> $row->wsrque_type,
							'question'		=> $row->wsrque_question,
							'page'			=> $row->wsrque_page
						));
				}
			}

			$pages = array_unique($list_page);

			$data['pages']			= $pages;
			$data['ws_question'] 	= $question;
			$this->load->view('workshop_seminar/vws_registration', $data);
		}
	}


	/**
	 * Digunakan untuk memproses registrasi event
	 * @param $id_ws
	 */
	public function register($id_ws) {
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$data_participant = array(
			'wspart_name'			=> $answer[0],
			'wspart_paid_status'	=> 'tidak',
		);

		$participant_id = $this->mworksem_participant->insert($data_participant);

		foreach ($input['question_id'] as $key => $val) {
			$data_answer = array(
				'wsrans_wsrque_fk'	=> $val,
				'wsrans_wspart_fk'	=> $participant_id,
				'wsrans_answer'		=> $input['answer'][$key]
			);
			$answer_id = $this->mworksem_registration_answer->insert($data_answer);
		}
		redirect("workshop_seminar/registration/$id_ws");
	}


	/**
	 * Digunakan untuk menampilkan data peserta yang mengikuti workshop atau seminar
	 * @param $ws_id
	 */
	public function detail($ws_id) {
		$user_access	= $this->session->userdata('role');
		$as_developer	= 2;
		$as_admin		= 3;
		$as_director	= 7;

		if (!($user_access	== $as_developer or
			$user_access	== $as_admin or
			$user_access	== $as_director)) {
			redirect('dashboard');
		}

		$data['ws_id']				= $ws_id;
		$data['user_role']			= $this->session->userdata('role');
		$data['participants']		= $this->mworksem_participant->get_participants($ws_id);
		$data['workshop_seminar']	= $this->mworkshop_seminar->get_with_speaker_by_id($ws_id);

		$data['js']					= 'workshop_seminar/vws_detail_js';
		$data['css']				= 'template/vdatatable_css';
		$data['content']			= 'workshop_seminar/vws_detail';
		$this->load->view('template/vtemplate', $data);
	}


	/**
	 * Digunakan untuk memperbarui status pembayaran
	 * hanya developer dan admin yang dapat mengakses method ini
	 *
	 * update_payment dapat digunakan untuk dua kondisi
	 * pertama digunakan untuk mengganti status menjadi telah membayar
	 * kedua digunakan untuk mengganti status menjadi belum membayar
	 *
	 * [mengganti status telah membayar]
	 * $receipt_number adalah angka yang akan digunakan sebagai nomor kwitansi
	 * $receipt_number tersusun dari: tahun|bulan|tanggal|ws_id|id_participant
	 * ws_id dan id_participant pada $receipt_number terdiri dari 4 digit, jika nilainya tidak memenuhi 4 digit
	 * maka akan ditambahkan angka 0 didepannya
	 *
	 * [mengganti status belum membayar]
	 * semua data (wspart_pay_date dan wspart_receipt_number) diset menjadi "null" kemudian diupdate ke DB
	 * tujuan dibuat fungsi ini adalah untuk mengantisipasi apabila admin salah dalam memilih pengguna yang membayar
	 *
	 * @param $ws_id
	 * @param $id_participant
	 */
	public function update_payment($ws_id, $id_participant) {
		$user_access	= $this->session->userdata('role');
		$as_developer	= 2;
		$as_admin		= 3;

		if (!($user_access == $as_developer or
			  $user_access == $as_admin)) {
			redirect('dashboard');
		}

		// set timezone
		date_default_timezone_set('Asia/Jakarta');

		// bagian untuk mendapatkan waktu saat ini beserta untuk generate $receipt_number
		$time_now			= date('Y-m-d H:i:s', time());
		$split_time_now		= explode(" ", $time_now);

		$year				= 0;  // index tahun dalam $split_time_now
		$length				= 4;  // panjang karakter untuk $ws_id dan $id_participant
		$last_4digit		= -4;  // diambil 4 digit terakhir untuk $ws_id dan $id_participant

		$date_now			= str_replace("-", "", $split_time_now[$year]);
		$receipt_number		= $date_now .
							  sprintf("%04d", substr($ws_id, $last_4digit, $length)) .
							  sprintf("%04d", substr($id_participant, $last_4digit, $length));

		$participant = $this->mworksem_participant->get_participant($id_participant);

		if (strcmp(strtolower($participant->wspart_paid_status), "tidak") == 0) {
			$data = array(
				'wspart_paid_status' 	=> 'ya',
				'wspart_pay_date'		=> $time_now,
				'wspart_receipt_number'	=> $receipt_number
			);
		} else {
			$data = array(
				'wspart_paid_status'	=> 'tidak',
				'wspart_pay_date'		=> null,
				'wspart_receipt_number'	=> null
			);
		}
		if ($this->mworksem_participant->update($data, $id_participant)) {
			$this->session->set_userdata('typeNotif', 'successUpdatePayment');
		} else {
			$this->session->set_userdata('typeNotif', 'failedUpdatePayment');
		}

		redirect("workshop_seminar/detail/$ws_id");
	}


	/**
	 * Digunakan untuk mengupdate kedatangan saat workshop atau seminar dengan mengupdate wspart_attendance
	 * @param $ws_id
	 * @param $id_participant
	 */
	public function update_attendance($ws_id, $id_participant) {
		$user_access	= $this->session->userdata('role');
		$as_developer	= 2;
		$as_admin		= 3;

		if (!($user_access == $as_developer or
			$user_access == $as_admin)) {
			redirect('dashboard');
		}

		$participant = $this->mworksem_participant->get_participant($id_participant);
		if (strcmp(strtolower($participant->wspart_attendance), "tidak") == 0) {
			$data = array('wspart_attendance' => 'ya');
		} else {
			$data = array('wspart_attendance' => 'tidak');
		}
		if ($this->mworksem_participant->update($data, $id_participant)) {
			$this->session->set_userdata('typeNotif', 'successUpdateAttendance');
		} else {
			$this->session->set_userdata('typeNotif', 'failedUpdateAttendance');
		}

		redirect("workshop_seminar/detail/$ws_id");
	}


	/**
	 * mengaktifkan workshop atau seminar dengan mengupdate nilai dari "ws_active"
	 * @param $ws_id
	 */
	public function activate_worksem($ws_id) {
		$make_active = 'Y';
		$data['ws_active'] = $make_active;

		if ($this->mworkshop_seminar->update($data, $ws_id)) {
			$this->session->set_userdata('typeNotif', 'successActivateWorksem');
		}
		redirect('workshop_seminar');
	}


	/**
	 * menonaktifkan workshop atau seminar dengan mengupdate nilai dari "ws_active"
	 * @param $ws_id
	 */
	public function deactivate_worksem($ws_id) {
		$make_nonactive = 'N';
		$data['ws_active'] = $make_nonactive;

		if ($this->mworkshop_seminar->update($data, $ws_id)) {
			$this->session->set_userdata('typeNotif', 'successDeactivateWorksem');
		}
		redirect('workshop_seminar');
	}


	/**
	 * mengubah format date yang semula YYYY-MM-DD menjadi DD MM YYYY
	 * mengubah MM yang semula memiliki format angka menjadi format bulan dalam string
	 * parameter masukan berupa date dengan forma YYYY-MM-DD
	 * @param $date
	 * @return string
	 */
	private function convert_date($date) {
		$split_date			= explode("-", $date);
		$year				= $split_date[0];
		$month				= (int) $split_date[1];
		$day				= $split_date[2];

		if		($month == 1)	{ $month = "Januari"; }
		else if ($month == 2)	{ $month = "Februari"; }
		else if ($month == 3)	{ $month = "Maret"; }
		else if ($month == 4)	{ $month = "April"; }
		else if ($month == 5)	{ $month = "Mei"; }
		else if ($month == 6)	{ $month = "Juni"; }
		else if ($month == 7)	{ $month = "Juli"; }
		else if ($month == 8)	{ $month = "Agustus"; }
		else if ($month == 9)	{ $month = "September"; }
		else if ($month == 10)	{ $month = "Oktober"; }
		else if ($month == 11)	{ $month = "November"; }
		else if ($month == 12)	{ $month = "Desember"; }

		$final_convert = $day . " " . $month . " " . $year;
		return $final_convert;
	}
}
