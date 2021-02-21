<?php


class Mconsult_feedback extends CI_Model
{
    /**
     * menampilkan seluruh data konsultasi submit feedback pada tabel fis_dservice_consult_feedbacks
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_list_consult_part()
    {
        $query = $this->db->get('fis_dservice_consult_feedbacks');
        return $query->result();
    }

    /**
     * menampilkan seluruh data konsultasi submit feedback pada tabel fis_dservice_consult_feedbacks
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_last_id()
    {
        $query = $this->db->query("SELECT * FROM fis_dservice_consult_feedbacks ORDER BY scfeed_id DESC LIMIT 1");
        return $query->row();
    }

    /**
     * menampilkan data konsultasi submit feedback pada tabel fis_dservice_consult_feedbacks berdasarkan id
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_by_id($id)
    {
        $this->db->where('scfeed_id', $id);
        $query = $this->db->get('fis_dservice_consult_feedbacks');
        return $query->row();
    }

    /**
     * insert data pada fis_dservice_consult_feedbacks
     * @param $data
     * @return bool
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dservice_consult_feedbacks', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }
    }


    /**
     * update data konsultasi submit feedback pada tabel fis_dservice_consult_feedbacks berdasarkan id
     * data yang diupdate bervariasi bergantung pada banyaknya data pada array assosiatif
     * @param $data - data bervariasi, bergantung pada field yang ingin diubah
     * @param $id
     * @return bool
     */
    function update($data, $id)
    {
        $this->db->where('scfeed_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dservice_consult_feedbacks', $data)) {
            $this->session->set_userdata('typeNotif', 'successEdited');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEdited');
            return FALSE;
        }
    }


    /**
     * menghapus data konsultasi submit feedback pada tabel fis_dservice_consult_feedbacks berdasarkan id
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dservice_consult_feedbacks', array('scfeed_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }
}
