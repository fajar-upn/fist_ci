<?php


class Mconsult_feedback_answer extends CI_Model
{
    /**
     * menampilkan seluruh feedback konsultasi jawaban pada tabel fis_dservice_consult_feedback_answers
     * @return mixed
     */
    function get_list_consult_ans()
    {
        $query = $this->db->get('fis_dservice_consult_feedback_answers');
        return $query->result(); // mengembalikan dalam bentuk object
    }


    /**
     * menampilkan data feedback konsultasi jawaban pada tabel fis_dservice_consult_feedback_answers berdasarkan id
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_by_id($id)
    {
        $this->db->where('scfans_id', $id);
        $query = $this->db->get('fis_dservice_consult_feedback_answers');
        return $query->row();
    }

    /**
     * menampilkan seluruh feedback konsultasi jawaban pada tabel fis_dservice_consult_feedback_answers
     * berdasarkan $id/scfans_scfque_fk
     * dikembalikan berupa nilai/jumlah data
     * @param $id
     * @return mixed
     */
    function get_num_rows_by_id($id)
    {
        $this->db->where('scfans_scfque_fk', $id);
        $query = $this->db->get('fis_dservice_consult_feedback_answers');
        return $query->num_rows();
    }

    /**
     * menampilkan seluruh feedback konsultasi jawaban pada tabel fis_dservice_consult_feedback_answers
     * join dengan table fis_dservice_consult_feedback_questions
     * dikelompokkan berdasarkan scfans_scfeed_fk dari bawah keatas
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_data_answer()
    {
        $query = $this->db->query("SELECT * FROM fis_dservice_consult_feedback_answers fa
        JOIN fis_dservice_consult_feedback_questions fq on fa.scfans_scfque_fk=fq.scfque_id
        Group BY fa.scfans_scfeed_fk desc");
        return $query->result();
    }

    /**
     * menampilkan feedback konsultasi jawaban pada tabel fis_dservice_consult_feedback_answers
     * berdasarkan scfans_scfeed_fk
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_detail_answer($id)
    {
        $query = $this->db->query("SELECT * FROM fis_dservice_consult_feedback_answers fa
        JOIN fis_dservice_consult_feedback_questions fq on fa.scfans_scfque_fk=fq.scfque_id
        WHERE fa.scfans_scfeed_fk = $id");
        return $query->result();
    }


    /**
     * insert data pada fis_dservice_consult_feedback_answers
     * @param $data
     * @return bool
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dservice_consult_feedback_answers', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * update data feedback konsultasi jawaban pada tabel fis_dservice_consult_feedback_answers berdasarkan id
     * data yang diupdate bervariasi bergantung pada banyaknya data pada array assosiatif
     * @param $data - data bervariasi, bergantung pada field yang ingin diubah
     * @param $id
     * @return bool
     */
    function update($data, $id)
    {
        $this->db->where('scfans_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dservice_consult_feedback_answers', $data)) {
            $this->session->set_userdata('typeNotif', 'successEdited');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEdited');
            return FALSE;
        }
    }


    /**
     * menghapus data feedback konsultasi jawaban pada tabel fis_dservice_consult_feedback_answers berdasarkan id
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dservice_consult_feedback_answers', array('scfans_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }

    /**
     * menghapus data submit jawaban konsultasi pada tabel fis_dservice_consult_feedback_answers 
     * berdasarkan scfans_scfeed_fk
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete_submit($id)
    {
        if ($this->db->delete('fis_dservice_consult_feedback_answers', array('scfans_scfeed_fk' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeleteFeedback');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDeleteFeedback');
            return FALSE;
        }
    }
}
