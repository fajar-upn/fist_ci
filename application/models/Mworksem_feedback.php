<?php


class Mworksem_feedback extends CI_Model
{
    /**
     * menampilkan seluruh data workshopseminar submit feedback pada tabel fis_dworkshopseminar_feedbacks
     * dikembalikan dalam bentek object
     * @return mixed
     */
    function get_list_worksem_part()
    {
        $query = $this->db->get('fis_dworkshopseminar_feedbacks');
        return $query->result();
    }

    /**
     * menampilkan data workshopseminar submit feedback pada tabel fis_dworkshopseminar_feedbacks berdasarkan id
     * dikembalikan dalam bentuk object
     * @param $id
     * @return mixed
     */
    function get_by_id($id)
    {
        $this->db->where('wsfeed_id', $id);
        $query = $this->db->get('fis_dworkshopseminar_feedbacks');
        return $query->row();
    }

    /**
     * insert data pada fis_dworkshopseminar_feedbacks
     * @param $data
     * @return $id
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dworkshopseminar_feedbacks', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }
    }


    /**
     * update data workshopseminar submit feedback pada tabel fis_dworkshopseminar_feedbacks berdasarkan id
     * data yang diupdate bervariasi bergantung pada banyaknya data pada array assosiatif
     * @param $data - data bervariasi, bergantung pada field yang ingin diubah
     * @param $id
     * @return bool
     */
    function update($data, $id)
    {
        $this->db->where('wsfeed_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dworkshopseminar_feedbacks', $data)) {
            $this->session->set_userdata('typeNotif', 'successEdited');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEdited');
            return FALSE;
        }
    }


    /**
     * menghapus data workshopseminar submit feedback pada tabel fis_dworkshopseminar_feedbacks berdasarkan id
     * akan diberikan flashdata sebagai notifikasi apakah penghapusan berhasil atau tidak
     * @param $id
     * @return bool
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dworkshopseminar_feedbacks', array('wsfeed_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
    }
}
