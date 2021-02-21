<?php

class Mtraining_class extends CI_Model
{
    /**
     * mendapatkan seluruh data dari tabel yang berkaitan dengan kelas
     */
    function get_list_class()
    {
        $query = $this->db->get('fis_vtraining_classes');
        return $query->result();
    }

     /**
     * mendapatkan seluruh data dari tabel yang berkaitan dengan kelas
     */
    function get_meeting_total()
    {
        $query = $this->db->query('SELECT COUNT(DISTINCT fda.tattd_date) AS total
        FROM fis_dtraining_attendances fda
        JOIN fis_dtraining_contracts ct ON fda.tattd_tcontr_fk = ct.tcontr_id
        JOIN fis_dtraining_students s ON s.tstudt_tcontr_fk = ct.tcontr_id
        JOIN fis_dtraining_classes c ON s.tstudt_tclass_fk = c.tclass_id
        GROUP BY c.tclass_id');

        // $query = $this->db->select('count(a.tattd_date)')
        //     ->from('fis_dtraining_classes c')
        //     ->join('fis_dtraining_students s', 's.tstudt_tclass_fk = c.tclass_id')
        //     ->join('fis_dtraining_contracts ct', 's.tstudt_tcontr_fk = ct.tcontr_id')
        //     ->join('fis_dtraining_attendances a', 'a.tattd_tcontr_fk = ct.tcontr_id')
        //     ->distinct()
        //     ->group_by('c.tclass_id')
        //     ->get();
        return $query->result();
    }

    /**
     * mendapatkan data dari untuk tabel class berdasarkan tclass_id
     */
    public function get_id($id)
    {
        $this->db->where('tclass_id', $id);
        $user = $this->db->get('fis_vtraining_participants');
        return $user->result();
    }

    /**
     * mendapatkan data dari untuk tabel class berdasarkan tclass_id
     */
    public function get_by_id($id)
    {
        $this->db->where('tclass_id', $id);
        $user = $this->db->select('*')
            ->from('fis_dtraining_classes')
            ->join('fis_duser_accounts', 'tclass_tentor_fk = uacc_id')
            ->join('fis_duser_profiles', 'uprof_uacc_fk = uacc_id')
            ->join('fis_rtraining_package_types', 'tclass_tptype_fk = tptype_id')
            ->join('fis_rtraining_packages', 'tptype_tpack_fk = tpack_id')
            ->get();
        return $user->row();
    }

    function delete($id)
    {
        if ($this->db->delete('fis_dtraining_classes', array('tclass_id' => $id))) {
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

            if ($this->db->update('fis_dtraining_classes', $data)) {
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
            if ($this->db->insert('fis_dtraining_classes', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return false;
            }
        }
    }
}
