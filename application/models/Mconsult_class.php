<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model untuk menu daftar kelas konsultasi
 * @author nurhasanhilmi
 */
class Mconsult_class extends CI_Model {

    /**
     * Mengambil semua record kelas konsultasi dari database tabel fis_vconsult_classes
     * @return Objects         Data kelas konsultasi
     */
	public function get_all() {
		$query = $this->db->get('fis_vconsult_classes');
		return $query->result();
	}

    /**
     * Mengambil semua record kelas konsultasi dari database table fis_vconsult_classes berdasarkan id tentor-nya
     * @param  int      $id    ID Tentor
     * @return Objects         Data Kelas Konsultasi
     */
	public function get_by_mentor_id($id) {
        $query = $this->db->get_where('fis_vconsult_classes', array('mentor_id' => $id));
        return $query->result();
    }

    /**
     * Mengambil semua record kelas konsultasi dari database tabel fis_vconsult_unassigned_classes
     * fis_vconsult_unassigned_classes merupakan table view untuk kontrak konsultasi yang belum ditentukan tentornya
     * @return Objects
     */
    public function get_all_unassigned(){
        $query = $this->db->get('fis_vconsult_unassigned_classes');
        return $query->result();
    }

    /**
     * Menambah record kelas konsultasi baru ke database table fis_dservice_consult_classes
     * @param  array   $data   Data Kelas Konsultasi Baru
     * @return bool            TRUE on success, FALSE on failure
     */
    public function insert($data) {
        return $this->db->insert('fis_dservice_consult_classes', $data);
    }

    /**
     * Mengubah record kelas konsultasi pada database tabel fis_dservice_consult_classes
     * @param  array   $data   Data perubahan kelas konsultasi
     * @param  int     $id     Class ID yang akan diubah
     * @return bool            TRUE on success, FALSE on failure
     */
    public function update($data, $id) {
        return $this->db->update('fis_dservice_consult_classes', $data, array('scclass_id' => $id));
    }

    /**
     * Menghapus record kelas konsultasi pada database tabel fis_dservice_consult_classes
     * @param  int     $id     Class ID yang ingin dihapus
     * @return bool            TRUE on success, FALSE on failure
     */
    public function delete($id) {
        return $this->db->delete('fis_dservice_consult_classes', array('scclass_id' => $id));
    }
}

/* End of file Mconsult_class.php */
/* Location: ./application/models/Mconsult_class.php */
