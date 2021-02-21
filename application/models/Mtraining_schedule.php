<?php

class Mtraining_schedule extends CI_Model
{
    /**
     * mendapatkan seluruh data dari tabel yang berkaitan dengan kelas
     */
    function get_list_schedule()
    {
        $query = $this->db->select('*')
                ->from('fis_dtraining_schedules')
                ->join('fis_dtraining_classes','tsched_tclass_fk = tclass_id')
                ->get();
        return $query->result();
    }

    /**
     * mendapatkan seluruh data dari tabel yang berkaitan dengan kelas
     */
    function get_list_schedule_mentor($id)
    {
        $this->db->where('tclass_tentor_fk', $id);
        $query = $this->db->select('*')
                ->from('fis_dtraining_schedules')
                ->join('fis_dtraining_classes','tsched_tclass_fk = tclass_id')
                ->join('fis_rtraining_package_types','tclass_tptype_fk = tptype_id')
                ->join('fis_rtraining_packages','tptype_tpack_fk = tpack_id')
                ->get();
        return $query->result();
    }

    /**
     * mendapatkan data dari tabel fis_dtraining_classes, fis_rtraining_packages dan fis_duser_profiles berdasarkan tclass_id
     */
    public function get_by_class($id)
    {
        $this->db->where('tclass_id', $id);
        $user = $this->db->select('*')
                ->from('fis_dtraining_schedules')
                ->join('fis_dtraining_classes','tsched_tclass_fk = tclass_id')
                ->get();
        return $user->result();
    }

    public function get_by_id($id)
    {
        $this->db->where('tsched_id', $id);
        $user = $this->db->select('*')
                ->from('fis_dtraining_schedules')
                ->get();
        return $user->row();
    }

    /**
     * insert data kedalam tabel fis_dtraining_classes
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dtraining_schedules', $data)) {
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
        $this->db->where('tsched_id', $id);

        if ($this->db->update('fis_dtraining_schedules', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete($id)
    {
        if ($this->db->delete('fis_dtraining_schedules', array('tsched_id' => $id))) {
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
    public function saveData($data, $tsched_id = 0)
    {
        /**
         * jika $tclass_id != 0 maka akan dilakukan proses update pada fis_dtraining_classes
         * data yang diupdate bervariasi, bergantung pada isi dari array $data
         */
        if ($tsched_id != 0) {
            $this->db->where('tsched_id', $tsched_id);

            if ($this->db->update('fis_dtraining_schedules', $data)) {
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
            if ($this->db->insert('fis_dtraining_schedules', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return false;
            }
        }
    }
}
