<?php

class Mtraining_student extends CI_Model
{
    function get_list_student()
    {
        $query = $this->db->get('fis_dtraining_students');
        return $query->result();
    }
    /**
     * mendapatkan data berdasarkan tptype_id
     */
    public function get_by_id($id)
    {
        $user = $this->db->select('*')
            ->from('fis_dtraining_students')
            ->join('fis_dtraining_classes', 'tstudt_tclass_fk = tclass_id')
            ->join('fis_dtraining_contracts', 'tstudt_tcontr_fk = tcontr_id')
            ->join('fis_duser_accounts', 'tcontr_uacc_fk = uacc_id and tclass_tentor_fk = uacc_id')
            ->join('fis_duser_profiles', 'uacc_id = uprof_uacc_fk')
            ->where('tstudt_tclass_fk', $id)->get();
        return $user->result();
    }

    public function get_by_contr_id($id)
    {
        $this->db->where('tcontr_id',$id);
        $query = $this->db->get('fis_vtraining_participants');
        return $query->row();
    }

    /**
     * menambahkan atau mengedit data pada tabel fis_dtraining_classes berdasarkan tclass_id
     * flashdata digunakan sebagai notifikasi apakah proses penyimpanan berhasil atau tidak
     * @param $data - data bervariasi bergantung pada field yang ingin ditambahkan
     * @param int $tclass_id
     * @return bool
     */
    public function saveData($data, $tclass_id = 0)
    {
        /**
         * jika $tclass_id != 0 maka akan dilakukan proses update pada fis_dtraining_classes
         * data yang diupdate bervariasi, bergantung pada isi dari array $data
         */
        if ($tclass_id != 0) {
            $this->db->where('tstudt_tclass_fk', $tclass_id);

            if ($this->db->update('fis_dtraining_students', $data)) {
                $this->session->set_userdata('typeNotif', 'successEditData');
                return true;
            } else {
                $this->session->set_userdata('typeNotif', 'errorEditData');
                return false;
            }
        } else {
            /**
             * selain itu maka dilakukan proses penambahan data pada table fis_dtraining_classes
             */
            if ($this->db->insert('fis_dtraining_students', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return false;
            }
        }
    }

    function insert($data)
    {
        if ($this->db->insert('fis_dtraining_students', $data)) {
            $this->session->set_userdata('typeNotif', 'successAddData');
            return $this->db->insert_id();
        } else {
            $this->session->set_userdata('typeNotif', 'errorAddData');
            return false;
        }
    }
}
