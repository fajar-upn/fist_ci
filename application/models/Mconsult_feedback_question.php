<?php


class Mconsult_feedback_question extends CI_Model
{
    /**
     * menampilkan seluruh feedback konsultasi pertanyaan pada tabel fis_dservice_consult_feedback_questions
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_list_consult_que()
    {
        $query = $this->db->get('fis_dservice_consult_feedback_questions');
        return $query->result();
    }

    /**
     * menampilkan seluruh feedback konsutasi pertanyaan pada tabel fis_dservice_consult_feedback_questions
     * diurutkan berdasarkan id pertanyaan dari bawah ke atas
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_list_question_desc()
    {
        $query = $this->db->query("select * from fis_dservice_consult_feedback_questions
        order by scfque_id desc");
        return $query->result();
    }

    /**
     * menampilkan data feedback konsultasi pertanyaan pada tabel fis_dservice_consult_feedback_questions
     * left join dengan table fis_dservis_consult_feedback_selections
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_question()
    {
        $query = $this->db->query("SELECT * FROM fis_dservice_consult_feedback_questions fq
        left JOIN fis_dservice_consult_feedback_selections fs ON fq.scfque_id=fs.scfselect_scfque_fk
        order by fq.scfque_id");
        return $query->result();
    }

    /**
     * menampilkan jumlah data feedback konsultasi pertanyaan pada tabel fis_dservice_consult_feedback_questions
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_amt_question()
    {
        $query = $this->db->query("SELECT COUNT(*) as amount FROM fis_dservice_consult_feedback_questions");
        return $query->row();
    }

    /**
     * menampilkan data feedback konsultasi pertanyaan pada tabel fis_dservice_consult_feedback_questions berdasarkan id
     * dikembalikan dalam bentek object
     * @param $id
     * @return mixed
     */
    function get_by_id($id)
    {
        $this->db->where('scfque_id', $id);
        $query = $this->db->get('fis_dservice_consult_feedback_questions');
        return $query->row();
    }

    /**
     * insert data pada fis_dservice_consult_feedback_questions
     * @param $data
     * @return bool
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dservice_consult_feedback_questions', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * update data feedback konsultasi pertanyaan pada tabel fis_dservice_consult_feedback_questions berdasarkan id
     * data yang diupdate bervariasi bergantung pada banyaknya data pada array assosiatif
     * @param $data - data bervariasi, bergantung pada field yang ingin diubah
     * @param $id
     * @return bool
     */
    function update($data, $id)
    {
        $this->db->where('scfque_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dservice_consult_feedback_questions', $data)) {
            $this->session->set_userdata('typeNotif', 'successEditFeedback');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditFeedback');
            return FALSE;
        }
    }


    /**
     * menghapus data feedback konsultasi pertanyaan pada tabel fis_dservice_consult_feedback_questions berdasarkan id
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dservice_consult_feedback_questions', array('scfque_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }
}
