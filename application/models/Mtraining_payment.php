<?php

class Mtraining_payment extends CI_Model
{
    /**
     * mendapatkan seluruh data dari tabel yang berkaitan dengan kelas
     */
    function get_list_payment()
    {
        $query = $this->db->select('*')
                ->from('fis_dtraining_payments')
                ->join('fis_dtraining_contracts','tpymt_tcontr_fk = tcontr_id')
                ->get();
        return $query->result();
    }

    function get_total_payment($tcontr_id)
    {
        // $query = $this->db->query("SELECT SUM(py.tpymt_amt) AS tpymt_total FROM fis_dtraining_payments py JOIN fis_dtraining_contracts ct ON py.tpymt_tcontr_fk = ct.tcontr_id");
        $query = $this->db->select_sum('tpymt_amt','tpymt_total')
                ->from('fis_dtraining_payments')
                ->join('fis_dtraining_contracts','tpymt_tcontr_fk = tcontr_id')
                ->where('tpymt_tcontr_fk', $tcontr_id)
                ->get();
        return $query->row();
    }

    /**
     * mendapatkan data dari tabel fis_dtraining_classes, fis_rtraining_packages dan fis_duser_profiles berdasarkan tclass_id
     */
    public function get_by_contr_id($id)
    {
        $this->db->where('tcontr_id', $id);
        $user = $this->db->select('*')
                ->from('fis_dtraining_payments')
                ->join('fis_dtraining_contracts','tpymt_tcontr_fk = tcontr_id')
                ->get();
        return $user->result();
    }

    public function get_by_id($id)
    {
        $this->db->where('tpymt_id', $id);
        $user = $this->db->select('*')
                ->from('fis_dtraining_payments')
                ->get();
        return $user->row();
    }

    /**
     * insert data kedalam tabel fis_dtraining_classes
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dtraining_payments', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * mengupdate data yang berada pada tabel fis_dtraining_classes
     */
    function update($data, $id)
    {
        $this->db->where('tpymt_id', $id);

        if ($this->db->update('fis_dtraining_payments', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete($id)
    {
        if ($this->db->delete('fis_dtraining_payments', array('tpymt_id' => $id))) {
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
    public function saveData($data, $tpymt_id = 0)
    {
        /**
         * jika $tclass_id != 0 maka akan dilakukan proses update pada fis_dtraining_classes
         * data yang diupdate bervariasi, bergantung pada isi dari array $data
         */
        if ($tpymt_id != 0) {
            $this->db->where('tpymt_id', $tpymt_id);

            if ($this->db->update('fis_dtraining_payments', $data)) {
                $this->session->set_userdata('typeNotif', 'successEditData');
                return true;
            } else {
                $this->session->set_userdata('typeNotif', 'errorEditData');
                return false;
            }
        } else {
            /**
             * selain itu maka dilakukan proses penambahan data pada table fis_dtraining_classesS
             */
            if ($this->db->insert('fis_dtraining_payments', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return false;
            }
        }
    }
}
