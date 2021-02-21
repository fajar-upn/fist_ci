<?php


class Mtraining_feedback_question extends CI_Model
{
    /**
     * menampilkan seluruh feedback training pertanyaan pada tabel fis_dtraining_feedback_questions
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_list_training_que()
    {
        $query = $this->db->get('fis_dtraining_feedback_questions');
        return $query->result();
    }

    /**
     * menampilkan seluruh feedback training pertanyaan pada tabel fis_dtraining_feedback_questions
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_list_question_desc()
    {
        $query = $this->db->query("select * from fis_dtraining_feedback_questions
        order by tfque_id desc");
        return $query->result();
    }

    /**
     * menampilkan data feedback training pertanyaan pada tabel fis_dtraining_feedback_questions
     * left join dengan table fis_dtraining_feedback_selections
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_question()
    {
        $query = $this->db->query("SELECT * FROM fis_dtraining_feedback_questions fq
        left JOIN fis_dtraining_feedback_selections fs ON fq.tfque_id=fs.tfselect_tfque_fk
        order by fq.tfque_id");
        return $query->result();
    }

    /**
     * menampilkan jumlah data feedback training pertanyaan pada tabel fis_dtraining_feedback_questions
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_amt_question()
    {
        $query = $this->db->query("SELECT COUNT(*) as amount FROM fis_dtraining_feedback_questions");
        return $query->row();
    }

    /**
     * menampilkan data feedback training pertanyaan pada tabel fis_dtraining_feedback_questions berdasarkan id
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_by_id($id)
    {
        $this->db->where('tfque_id', $id);
        $query = $this->db->get('fis_dtraining_feedback_questions');
        return $query->row();
    }

    /**
     * insert data pada fis_dtraining_feedback_questions
     * @param $data
     * @return bool
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dtraining_feedback_questions', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * update data feedback training pertanyaan pada tabel fis_dtraining_feedback_questions berdasarkan id
     * data yang diupdate bervariasi bergantung pada banyaknya data pada array assosiatif
     * @param $data - data bervariasi, bergantung pada field yang ingin diubah
     * @param $id
     * @return bool
     */
    function update($data, $id)
    {
        $this->db->where('tfque_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dtraining_feedback_questions', $data)) {
            $this->session->set_userdata('typeNotif', 'successEditFeedback');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditFeedback');
            return FALSE;
        }
    }


    /**
     * menghapus data feedback training pertanyaan pada tabel fis_dtraining_feedback_questions berdasarkan id
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dtraining_feedback_questions', array('tfque_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }
}
