<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Kelas model untuk menu penjadwalan konsultasi
 * @author nurhasanhilmi
 */
class Mconsult_schedule extends CI_Model
{

    /**
     * Mengambil semua record jadwal konsultasi dari database tabel fis_vconsult_schedules
     * @return Objects Data Jadwal Konsultasi
     */
    public function get_all()
    {
        $query = $this->db->get('fis_vconsult_schedules');
        return $query->result();
    }

    /**
     * Mengambil record jadwal konsultasi dari database table fis_vconsult_schedules berdasarkan id-nya
     * @return  Object Data Jadwal Konsultasi
     */
    public function get_by_id($id)
    {
        $query = $this->db->get_where('fis_vconsult_schedules', array('id' => $id), 1);
        return $query->row();
    }

    /**
     * Mengambil semua record jadwal konsultasi dari database table fis_vconsult_schedules berdasarkan id tentor-nya
     * @param  int      $id    ID Tentor
     * @return Objects         Data Jadwal Konsultasi
     */
    public function get_by_mentor_id($id) {
        $array = array('mentor_id' => $id, 'contract_end' => '0', 'contract_cancel' => '0');
        $query = $this->db->get_where('fis_vconsult_schedules', $array);
        return $query->result();
    }

    /**
     * Menambah record jadwal konsultasi baru ke database table fis_dservice_consult_schedules
     * @param  array   $data   Data Jadwal Konsultasi Baru
     * @return bool            TRUE on success, FALSE on failure
     */
    public function insert($data)
    {
        $this->db->insert('fis_dservice_consult_schedules', $data);
    }

    /**
     * Mengubah record jadwal konsultasi pada database tabel fis_dservice_consult_schedules
     * @param  array   $data   An associative array of field/value pairs
     * @param  int     $id     Schedule ID
     * @return bool            TRUE on success, FALSE on failure
     */
    public function update($data, $id)
    {
        $this->db->update('fis_dservice_consult_schedules', $data, array('scsched_id' => $id));
    }

    /**
     * Menghapus recode jadwal konsultasi pada database tabel fis_dservice_consult_schedules
     * @param  int     $id     Schedule ID
     * @return mixed           CI_DB_query_builder instance (method chaining) or FALSE on failure
     */
    public function delete($id)
    {
        $this->db->delete('fis_dservice_consult_schedules', array('scsched_id' => $id));
    }
}

/* End of file Mconsult_schedule.php */
/* Location: ./application/models/Mconsult_schedule.php */
