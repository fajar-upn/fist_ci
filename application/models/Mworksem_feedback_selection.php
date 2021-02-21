<?php


class Mworksem_feedback_selection extends CI_Model
{
    /**
     * menampilkan seluruh data pilihan jawaban pada tabel fis_dworkshopseminar_feedback_selections
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_list_selection_ans()
    {
        $query = $this->db->get('fis_dworkshopseminar_feedback_selections');
        return $query->result();
    }


    /**
     * menampilkan data pilihan jawaban pada tabel fis_dworkshopseminar_feedback_selections berdasarkan id
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_by_id($id)
    {
        $this->db->where('wsfselect_id', $id);
        $query = $this->db->get('fis_dworkshopseminar_feedback_selections');
        return $query->row();
    }

    /**
     * menampilkan data pilihan jawaban pada tabel fis_dworkshopseminar_feedback_selections berdasarkan id pertanyaan
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_by_id_question($id)
    {
        $this->db->where('wsfselect_wsfque_fk', $id);
        $query = $this->db->get('fis_dworkshopseminar_feedback_selections');
        return $query->result();
    }

    /**
     * menampilkan jumlah data feedback worksem pilihan pada tabel fis_dworkshopseminar_feedback_selections
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_amt_selection($id)
    {
        $query = $this->db->query("SELECT COUNT(*) as amount FROM fis_dworkshopseminar_feedback_selections
        where wsfselect_wsfque_fk = $id");
        return $query->row();
    }

    /**
     * insert data pilihan jawaban pada fis_dworkshopseminar_feedback_selections
     * @param $data
     * @return bool
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dworkshopseminar_feedback_selections', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * update data pilihan jawaban pada tabel fis_dworkshopseminar_feedback_selections berdasarkan id
     * data yang diupdate bervariasi bergantung pada banyaknya data pada array assosiatif
     * @param $data - data bervariasi, bergantung pada field yang ingin diubah
     * @param $id
     * @return bool
     */
    function update($data, $id)
    {
        $this->db->where('wsfselect_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dworkshopseminar_feedback_selections', $data)) {
            $this->session->set_userdata('typeNotif', 'successEdited');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEdited');
            return FALSE;
        }
    }


    /**
     * menghapus data pilihan jawaban pada tabel fis_dworkshopseminar_feedback_selections berdasarkan id
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dworkshopseminar_feedback_selections', array('wsfselect_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }

    /**
     * menghapus data pilihan jawaban pada tabel fis_dworkshopseminar_feedback_selections berdasarkan fk pertanyaan
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete_by_id_question($id)
    {
        if ($this->db->delete('fis_dworkshopseminar_feedback_selections', array('wsfselect_wsfque_fk' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }
}
