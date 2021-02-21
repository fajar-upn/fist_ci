<?php


class Mworksem_feedback_answer extends CI_Model
{
    /**
     * menampilkan seluruh feedback workshopseminar jawaban pada tabel fis_dworkshopseminar_feedback_answers
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_list_worksem_ans()
    {
        $query = $this->db->get('fis_dworkshopseminar_feedback_answers');
        return $query->result();
    }

    /**
     * menampilkan seluruh feedback workshopseminar jawaban pada tabel fis_dworkshopseminar_feedback_answers
     * join dengan table fis_dworkshopseminar_feedback_questions berdasarkan wsfque_ws_fk
     * dikelompokkan berdasarkan wsfans_wsfeed_fk dari bawah keatas
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_data_answer($id)
    {
        $query = $this->db->query("SELECT * FROM fis_dworkshopseminar_feedback_answers fa
        JOIN fis_dworkshopseminar_feedback_questions fq on fa.wsfans_wsfque_fk=fq.wsfque_id
        where fq.wsfque_ws_fk=$id Group BY fa.wsfans_wsfeed_fk desc");
        return $query->result();
    }

    /**
     * menampilkan feedback workshopseminar jawaban pada tabel fis_dworkshopseminar_feedback_answers
     * join dengan table fis_dworkshopseminar_feedback_questions berdasarkan wsfans_wsfeed_fk
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_detail_answer($id)
    {
        $query = $this->db->query("SELECT * FROM fis_dworkshopseminar_feedback_answers fa
        JOIN fis_dworkshopseminar_feedback_questions fq on fa.wsfans_wsfque_fk=fq.wsfque_id
        WHERE fa.wsfans_wsfeed_fk = $id");
        return $query->result();
    }

    /**
     * menampilkan data feedback workshopseminar jawaban pada tabel fis_dworkshopseminar_feedback_answers berdasarkan id
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_by_id($id)
    {
        $this->db->where('wsfans_id', $id);
        $query = $this->db->get('fis_dworkshopseminar_feedback_answers');
        return $query->row();
    }

    /**
     * menampilkan seluruh feedback konsultasi jawaban pada tabel fis_dworkshopseminar_feedback_answers
     * berdasarkan $id/wsfans_wsfque_fk
     * dikembalikan berupa nilai/jumlah data
     * @param $id
     * @return mixed
     */
    function get_num_rows_by_id($id)
    {
        $this->db->where('wsfans_wsfque_fk', $id);
        $query = $this->db->get('fis_dworkshopseminar_feedback_answers');
        return $query->num_rows();
    }

    /**
     * insert data pada fis_dworkshopseminar_feedback_answers
     * @param $data
     * @return bool
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dworkshopseminar_feedback_answers', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * update data feedback workshopseminar jawaban pada tabel fis_dworkshopseminar_feedback_answers berdasarkan id
     * data yang diupdate bervariasi bergantung pada banyaknya data pada array assosiatif
     * @param $data - data bervariasi, bergantung pada field yang ingin diubah
     * @param $id
     * @return bool
     */
    function update($data, $id)
    {
        $this->db->where('wsfans_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dworkshopseminar_feedback_answers', $data)) {
            $this->session->set_userdata('typeNotif', 'successEdited');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEdited');
            return FALSE;
        }
    }


    /**
     * menghapus data feedback workshopseminar jawaban pada tabel fis_dworkshopseminar_feedback_answers berdasarkan id
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dworkshopseminar_feedback_answers', array('wsfans_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }

    /**
     * menghapus data submit jawaban workshopseminar pada tabel fis_dworkshopseminar_feedback_answers 
     * berdasarkan wsfans_wsfeed_fk
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete_submit($id)
    {
        if ($this->db->delete('fis_dworkshopseminar_feedback_answers', array('wsfans_wsfeed_fk' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeleteFeedback');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDeleteFeedback');
            return FALSE;
        }
    }
}
