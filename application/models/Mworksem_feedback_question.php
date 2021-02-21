<?php


class Mworksem_feedback_question extends CI_Model
{
    /**
     * menampilkan seluruh feedback workshopseminar pertanyaan pada tabel fis_dworkshopseminar_feedback_questions
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_list_worksem_que()
    {
        $query = $this->db->get('fis_dworkshopseminar_feedback_questions');
        return $query->result();
    }

    /**
     * menampilkan seluruh feedback workshopseminar pertanyaan pada tabel fis_dworkshopseminar_feedback_questions
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_worksem_quetion_ws_id($id)
    {
        $this->db->where('wsfque_ws_fk', $id);
        $query = $this->db->get('fis_dworkshopseminar_feedback_questions');
        return $query->result();
    }

    /**
     * menampilkan seluruh feedback workshopseminar pertanyaan pada tabel fis_dworkshopseminar_feedback_questions
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    function get_list_question_desc()
    {
        $query = $this->db->query("select * from fis_dworkshopseminar_feedback_questions
        order by wsfque_id desc");
        return $query->result();
    }


    /**
     * menampilkan data feedback workshopseminar pertanyaan pada tabel fis_dworkshopseminar_feedback_questions berdasarkan id
     * dikembalikan dalam bentuk objcet
     * @param $id
     * @return mixed
     */
    function get_by_id($id)
    {
        $this->db->where('wsfque_id', $id);
        $query = $this->db->get('fis_dworkshopseminar_feedback_questions');
        return $query->row();
    }

    /**
     * menampilkan data feedback workshopseminar pertanyaan pada tabel fis_dworkshopseminar_feedback_questions
     * join dengan table fis_dworkshopseminars
     * left join dengan table fis_dworkshopseminar_feedback_selections
     * dengan kondisi ws_active = 'Y' atau sedang aktif dan diurutkan berdasarkan wsfque_id
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_question($id)
    {
        $query = $this->db->query("SELECT * FROM fis_dworkshopseminar_feedback_questions fq
        left join fis_dworkshopseminar_feedback_selections fs on fs.wsfselect_wsfque_fk = fq.wsfque_id
        WHERE fq.wsfque_ws_fk = $id order by fq.wsfque_id");
        return $query->result();
    }

    /**
     * menampilkan data feedback workshopseminar pertanyaan pada tabel fis_dworkshopseminar_feedback_questions
     * join dengan table fis_dworkshopseminars
     * left join dengan table fis_dworkshopseminar_feedback_selections
     * dengan kondisi ws_active = 'Y' atau sedang aktif dan diurutkan berdasarkan wsfque_id
     * dikembalikan dalam bentuk object
     * @return mixed
     */
    // function get_question_active()
    // {
    //     $query = $this->db->query("SELECT * FROM fis_dworkshopseminar_feedback_questions fq
    //     JOIN fis_dworkshopseminars ws ON fq.wsfque_ws_fk=ws.ws_id
    //     left join fis_dworkshopseminar_feedback_selections fs on fs.wsfselect_wsfque_fk = fq.wsfque_id
    //     WHERE ws.ws_active = 'Y' order by fq.wsfque_id");
    //     return $query->result();
    // }

    /**
     * menampilkan jumlah data feedback workshopseminar pertanyaan pada tabel fis_dworkshopseminar_feedback_questions
     * join dengan table fis_dworkshopseminars dengan kondisi ws_active = 'Y' atau sedang aktif
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_amt_question($id)
    {
        $query = $this->db->query("SELECT COUNT(*) as amount FROM fis_dworkshopseminar_feedback_questions fq
        JOIN fis_dworkshopseminars ws ON fq.wsfque_ws_fk=ws.ws_id
        WHERE fq.wsfque_ws_fk = $id");
        return $query->row();
    }
    /**
     * insert data pada fis_dworkshopseminar_feedback_questions
     * @param $data
     * @return bool
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dworkshopseminar_feedback_questions', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * update data feedback workshopseminar pertanyaan pada tabel fis_dworkshopseminar_feedback_questions berdasarkan id
     * data yang diupdate bervariasi bergantung pada banyaknya data pada array assosiatif
     * @param $data - data bervariasi, bergantung pada field yang ingin diubah
     * @param $id
     * @return bool
     */
    function update($data, $id)
    {
        $this->db->where('wsfque_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dworkshopseminar_feedback_questions', $data)) {
            $this->session->set_userdata('typeNotif', 'successEditFeedback');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditFeedback');
            return FALSE;
        }
    }


    /**
     * menghapus data feedback workshopseminar pertanyaan pada tabel fis_dworkshopseminar_feedback_questions berdasarkan id
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dworkshopseminar_feedback_questions', array('wsfque_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }
}
