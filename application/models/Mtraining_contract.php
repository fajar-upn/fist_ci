<?php

class Mtraining_contract extends CI_Model
{
    /**
     * mendapatkan data dari tabel fis_dtraining_contracts, fis_duser_accouts dan fis_duser_profiles berdasarkan uacc_id
     */
    public function get_by_uacc_id($id)
    {
        $this->db->where('tcontr_uacc_fk', $id);
        $user = $this->db->select('*')
            ->from('fis_dtraining_contracts')
            ->join('fis_duser_accounts', 'tcontr_uacc_fk = uacc_id')
            ->join('fis_duser_profiles', 'uprof_uacc_fk = uacc_id')
            ->get();
        return $user->row();
    }

    /**
     * mendapatkan data dari tabel fis_dtraining_contracts berdasarkan tcontr_id
     */
    public function get_by_id($id)
    {
        $this->db->where('tcontr_id', $id);
        $user = $this->db->select('tcontr_id, uprof_full_name, tcontr_file_name, tcontr_date')
            ->from('fis_dtraining_contracts')
            ->join('fis_duser_accounts', 'tcontr_uacc_fk = uacc_id')
            ->join('fis_duser_profiles', 'uprof_uacc_fk = uacc_id')
            ->get();
        return $user->row();
    }

    /**
     * insert data kedalam tabel fis_dtraining_contracts
     */
    public function insert($data)
    {
        if ($this->db->insert('fis_dtraining_contracts', $data)) {
            $this->session->set_userdata('typeNotif', 'successAddUser');
            return $this->db->insert_id();
        } else {
            $this->session->set_userdata('typeNotif', 'errorAddUser');
            return false;
        }
    }

    /**
     * mengupdate data yang berada pada tabel fis_dtraining_contracts
     */
    function update($data, $id)
    {
        $this->db->where('tcontr_uacc_fk', $id);

        if ($this->db->update('fis_dtraining_contracts', $data)) {
            $this->session->set_userdata('typeNotif', 'successEditData');
            return true;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditData');
            return false;
        }
    }

    function delete($id)
    {
        if ($this->db->delete('fis_dtraining_contracts', array('tclass_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeleteData');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDeleteData');
            return FALSE;
        }
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
            $this->db->where('tclass_id', $tclass_id);

            if ($this->db->update('fis_dtraining_contracts', $data)) {
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
            if ($this->db->insert('fis_dtraining_contracts', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return false;
            }
        }
    }
}
