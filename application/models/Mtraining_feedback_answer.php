<?php


class Mtraining_feedback_answer extends CI_Model
{
    /**
     * menampilkan seluruh feedback training jawaban pada tabel fis_dtraining_feedback_answers
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_list_training_ans()
    {
        $query = $this->db->get('fis_dtraining_feedback_answers');
        return $query->result();
    }


    /**
     * menampilkan data feedback training jawaban pada tabel fis_dtraining_feedback_answers berdasarkan id
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_by_id($id)
    {
        $this->db->where('tfans_id', $id);
        $query = $this->db->get('fis_dtraining_feedback_answers');
        return $query->row();
    }

    /**
     * menampilkan seluruh feedback training jawaban pada tabel fis_dtraining_feedback_answers
     * join dengan table fis_dtraining_feedback_questions
     * dikelompokkan berdasarkan tfans_tfeed_fk dari bawah keatas
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_data_answer()
    {
        $query = $this->db->query("SELECT * FROM fis_dtraining_feedback_answers fa
        JOIN fis_dtraining_feedback_questions fq on fa.tfans_tfque_fk=fq.tfque_id
        Group BY fa.tfans_tfeed_fk desc");
        return $query->result();
    }

    /**
     * menampilkan seluruh feedback training jawaban pada tabel fis_dtraining_feedback_answers
     * berdasarkan $id/tfans_tfque_fk
     * dikembalikan berupa nilai/jumlah data
     * @param $id
     * @return mixed
     */
    function get_num_rows_by_id($id)
    {
        $this->db->where('tfans_tfque_fk', $id);
        $query = $this->db->get('fis_dtraining_feedback_answers');
        return $query->num_rows();
    }

    /**
     * menampilkan feedback training jawaban pada tabel fis_dtraining_feedback_answers
     * berdasarkan tfans_tfeed_fk
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_detail_answer($id)
    {
        $query = $this->db->query("SELECT * FROM fis_dtraining_feedback_answers fa
        JOIN fis_dtraining_feedback_questions fq on fa.tfans_tfque_fk=fq.tfque_id
        WHERE fa.tfans_tfeed_fk = $id");
        return $query->result();
    }

    /**
     * insert data pada fis_dtraining_feedback_answers
     * @param $data
     * @return bool
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dtraining_feedback_answers', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * update data feedback training jawaban pada tabel fis_dtraining_feedback_answers berdasarkan id
     * data yang diupdate bervariasi bergantung pada banyaknya data pada array assosiatif
     * @param $data - data bervariasi, bergantung pada field yang ingin diubah
     * @param $id
     * @return bool
     */
    function update($data, $id)
    {
        $this->db->where('tfans_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dtraining_feedback_answers', $data)) {
            $this->session->set_userdata('typeNotif', 'successEdited');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEdited');
            return FALSE;
        }
    }


    /**
     * menghapus data feedback training jawaban pada tabel fis_dtraining_feedback_answers berdasarkan id
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dtraining_feedback_answers', array('tfans_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }

    /**
     * menghapus data submit jawaban training pada tabel fis_dtraining_feedback_answers 
     * berdasarkan tfans_tfeed_fk
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete_submit($id)
    {
        if ($this->db->delete('fis_dtraining_feedback_answers', array('tfans_tfeed_fk' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeleteFeedback');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDeleteFeedback');
            return FALSE;
        }
    }
}
