<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Kelas kontroler untuk menu penjadwalan konsultasi
 * @author nurhasanhilmi
 */
class Consult_schedule extends CI_Controller {

	/**
	 * Konstruktor dari kelas ini
	 */
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
			$this->session->set_userdata('typeNotif', 'notLoggedIn');
			redirect('auth'); //redirect kehalaman login
		}
		else if ($this->session->userdata('role') != 3) { // ketika bukan admin (id role admin adalah 3)
			redirect('dashboard'); //redirect ke halaman dashboard pengguna
		}
		$this->load->model('muser_account');
		$this->load->model('mconsult_schedule');
		$this->load->model('mconsult_class');		
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index() {
		$data['mentor'] = $this->muser_account->get_by_role_id(6); //mengambil data tentor (role_id untuk tentor adalah 6)
		$data['breadcrumb'] = 'consult_schedule/vconsult_schedule_breadcrumb.php';
		$data['content'] = 'consult_schedule/vconsult_schedule_content.php';
		$data['css'] = 'consult_schedule/vconsult_schedule_css.php';
		$data['js'] = 'consult_schedule/vconsult_schedule_js.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data, FALSE);
	}

	/**
	 * Method untuk mengambil data jadwal konsultasi dari model Mconsult_schedule
	 * Memberikan RESPONSE dari POST REQUEST
	 * Method akan berjalan dengan baik jika jadwal konsultasi sudah terurut berdasarkan id_class nya
	 * @return JSON	Data Jadwal Konsultasi
	 */
	public function fetch_schedules() {
		$input = $this->input->post(NULL, TRUE);
		extract($input);
		if ($mentor_id) { //mendapatkan data jadwal konsultasi per tentor
			$schedules = $this->mconsult_schedule->get_by_mentor_id($mentor_id);
			$current_class = $schedules[0]->class_id;
			$counter = 0;
			foreach ($schedules as $row) {
				if ($row->class_id != $current_class) {
					$counter++;
					$current_class = $row->class_id;
				}
				$title = $row->client_name;
				$start = $row->schedule_date. 'T'. $row->schedule_time_start;
				$end = $row->schedule_date. 'T'. $row->schedule_time_end;
				$schedule_events[] = array(
					'schedule_id' => $row->schedule_id,
					'class_id' => $row->class_id,
					'title' => $title,
					'start' => $start,
					'end' => $end,
					'allDay' => false,
					'className' => $this->get_event_color($counter)
				);
			}
			echo json_encode($schedule_events);
		}
		else { //mendapatkan semua jadwal konsultasi
			$schedules = $this->mconsult_schedule->get_all();
			foreach ($schedules as $row) {
				$title = $row->client_name;
				$start = $row->schedule_date. 'T'. $row->schedule_time_start;
				$end = $row->schedule_date. 'T'. $row->schedule_time_end;

				$schedule_events[] = array(
					'schedule_id' => $row->schedule_id,
					'title' => $title,
					'start' => $start,
					'end' => $end,
					'allDay' => false,
					'className' => ''
				);
			}
			echo json_encode($schedule_events);
		}
	}

	private function get_event_color($counter) {
		$help = $counter % 6;
		switch ($help) {
			case 0:
				return 'bg-success';
				break;
			case 1:
				return 'bg-danger';
				break;
			case 2:
				return 'bg-info';
				break;
			case 3:
				return 'bg-primary';
				break;
			case 4:
				return 'bg-warning';
				break;
			case 5:
				return 'bg-inverse';
				break;
			default:
				return '';
				break;
		}
	}

	/**
	 * Method untuk mengambil data kelas konsultasi dari Mconsult_schedule
	 * Memberikan RESPONSE dari POST REQUEST
	 * @return JSON Data Kelas Konsultasi
	 */
	public function fetch_classes() {
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		if (isset($mentor_id)) { //mendapatakan data kelas konsultasi per tentor
			$consult_classes = $this->mconsult_class->get_by_mentor_id($mentor_id);
			echo json_encode($consult_classes);
		} else { //mendapatkan semua data kelas konsultasi
			$consult_classes = $this->mconsult_class->get_all();
			echo json_encode($consult_classes);
		}
	}

	/**
	 * Menyimpan data jadwal konsultasi ke Mconsult_schedule
	 */
	public function save_data() {
		$active_user = $this->session->userdata('id');
		$input = $this->input->post(NULL, TRUE);
		extract($input);
		$data = array(
			'scsched_scclass_fk' => $class_id,
			'scsched_date' => $event_date,
			'scsched_time_start' => $event_time_start,
			'scsched_time_finish' => $event_time_finish
		);
		if (isset($schedule_id)) { //mengubah data jadwal konsultasi
			$data['user_update'] = $active_user;
			$this->mconsult_schedule->update($data, $schedule_id);
		} else { //menambah data jadwal konsultasi baru
			$data['user_create'] = $active_user;
			$this->mconsult_schedule->insert($data);
		}
	}

	/**
	 * Menghapus data jadwal konsultasi
	 */
	public function delete() {
		$schedule_id = $this->input->post('schedule_id', TRUE);
		$this->mconsult_schedule->delete($schedule_id);
	}
}

/* End of file Consult_schedule.php */
/* Location: ./application/controllers/Consult_schedule.php */
