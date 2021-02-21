<?php

class Mtraining_package extends CI_Model
{
    /**
     * mendapatkan data paket dari tabel fis_rtraining_types dan fis_rtraining_packages
     */
    function get_package()
    {
        $query = $this->db->select('*')
            ->from('fis_rtraining_package_types')
            ->join('fis_rtraining_packages', 'tptype_tpack_fk = tpack_id')
            ->join('fis_dtraining_package_details', 'tpdetail_tpack_fk = tpack_id')
            ->group_by('tpdetail_tpack_fk')
            ->group_by('tptype_name')
            ->get();
        return $query->result();
    }

    /**
     * mendapatkan data berdasarkan tptype_id
     */
    public function get_by_id($id)
    {
        $this->db->where('tptype_id', $id);
        $query = $this->db->select('*')
            ->from('fis_rtraining_package_types')
            ->join('fis_rtraining_packages', 'tptype_tpack_fk = tpack_id')
            ->join('fis_dtraining_package_details', 'tpdetail_tpack_fk = tpack_id')
            ->group_by('tpdetail_tpack_fk')
            ->get();
        return $query->row();
    }

    /**
     * mendapatkan data resources dari tabel fis_dtraining_package_details berdasarkan tpack_id dengan otput array
     */
    function get_list_resource($id)
    {
        $this->db->where('tpack_id', $id);
        $query = $this->db->select('tres_name, tres_id, tpdetail_id')
            ->from('fis_dtraining_package_details')
            ->join('fis_rtraining_resource', 'tpdetail_tres_fk = tres_id')
            ->join('fis_rtraining_packages', 'tpdetail_tpack_fk = tpack_id')
            ->get();
        return $query->result();
    }
    /**
     * mendapatkan data resources dari tabel fis_dtraining_package_details berdasarkan tpack_id dengan output object
     */
    function get_resource($id)
    {
        $this->db->where('tpack_id', $id);
        $query = $this->db->select('tres_name, tres_id, tpdetail_id')
            ->from('fis_dtraining_package_details')
            ->join('fis_rtraining_resource', 'tpdetail_tres_fk = tres_id')
            ->join('fis_rtraining_packages', 'tpdetail_tpack_fk = tpack_id')
            ->get();
        return $query->row();
    }

    function get_resource_by_id($id)
    {
        $this->db->where('tres_id', $id);
        $query = $this->db->select('*')
            ->from('fis_dtraining_package_details')
            ->join('fis_rtraining_resource', 'tpdetail_tres_fk = tres_id')
            ->join('fis_rtraining_packages', 'tpdetail_tpack_fk = tpack_id')
            ->get();
        return $query->row();
    }

    function get_packDetail()
    {
        $query = $this->db->get('fis_dtraining_package_details');
        return $query->result();
    }

    function get_packDetail_by_id($id)
    {
        $this->db->where('tpdetail_tpack_fk', $id);
        $query = $this->db->get('fis_dtraining_package_details');
        return $query->row();
    }

    function addPack_detail($data)
    {
        if ($this->db->insert('fis_dtraining_package_details', $data)) {
            $this->session->set_userdata('typeNotif', 'successAddData');
            return $this->db->insert_id();
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditData');
            return false;
        }
    }

    function insertPack_detail($data, $tpack_id)
    {
        $this->db->where('tpdetail_tpack_fk', $tpack_id);

        if ($this->db->update('fis_dtraining_package_details', $data)) {
            $this->session->set_userdata('typeNotif', 'successEditData');
            return true;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditData');
            return false;
        }
    }

    function updatePack_detail($data, $tpdetail_id)
    {
        $this->db->where('tpdetail_id', $tpdetail_id);

        if ($this->db->update('fis_dtraining_package_details', $data)) {
            $this->session->set_userdata('typeNotif', 'successEditData');
            return true;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditData');
            return false;
        }
    }

    function insertPack_type($data)
    {
        if ($this->db->insert('fis_rtraining_package_types', $data)) {
            $this->session->set_userdata('typeNotif', 'successAddData');
            return $this->db->insert_id();
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditData');
            return false;
        }
    }

    /**
     * menambahkan atau mengedit data pada tabel fis_dtraining_packages berdasarkan tpack_id
     * flashdata digunakan sebagai notifikasi apakah proses penyimpanan berhasil atau tidak
     * @param $data - data bervariasi bergantung pada field yang ingin ditambahkan
     * @param int $tpack_id
     * @return bool
     */
    public function saveData($data, $tpack_id = 0)
    {
        /**
         * jika $tpack_id != 0 maka akan dilakukan proses update pada fis_rtraining_packages
         * data yang diupdate bervariasi, bergantung pada isi dari array $data
         */
        if ($tpack_id != 0) {
            $this->db->where('tpack_id', $tpack_id);

            if ($this->db->update('fis_rtraining_packages', $data)) {
                $this->session->set_userdata('typeNotif', 'successEditData');
                return true;
            } else {
                $this->session->set_userdata('typeNotif', 'errorEditData');
                return false;
            }
        } else {
            /**
             * selain itu maka dilakukan proses penambahan data pada table fis_rtraining_packages
             */
            if ($this->db->insert('fis_rtraining_packages', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return false;
            }
        }
    }

    /**
     * menambahkan atau mengedit data pada tabel fis_dtraining_package_details berdasarkan tpack_id
     * flashdata digunakan sebagai notifikasi apakah proses penyimpanan berhasil atau tidak
     * @param $data - data bervariasi bergantung pada field yang ingin ditambahkan
     * @param int $tpack_id
     * @return bool
     */
    public function saveDetail($data, $tpdetail_id)
    {
        /**
         * jika $tpack_id != 0 maka akan dilakukan proses update pada fis_rtraining_packages
         * data yang diupdate bervariasi, bergantung pada isi dari array $data
         */
        if ($tpdetail_id != 0) {
            $this->db->where('tpdetail_id', $tpdetail_id);

            if ($this->db->update('fis_dtraining_package_details', $data)) {
                $this->session->set_userdata('typeNotif', 'successEditData');
                return true;
            } else {
                $this->session->set_userdata('typeNotif', 'errorEditData');
                return false;
            }
        } else {
            /**
             * selain itu maka dilakukan proses penambahan data pada table fis_rtraining_packages
             */
            if ($this->db->insert('fis_dtraining_package_details', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorEditData');
                return false;
            }
        }
    }

    /**
     * menambahkan atau mengedit data pada tabel fis_rtraining_package_types berdasarkan tptype_id
     * flashdata digunakan sebagai notifikasi apakah proses penyimpanan berhasil atau tidak
     * @param $data - data bervariasi bergantung pada field yang ingin ditambahkan
     * @param int $tpack_id
     * @return bool
     */
    public function saveType($data, $tptype_id)
    {
        /**
         * jika $tptype_id != 0 maka akan dilakukan proses update pada fis_rtraining_package_types
         * data yang diupdate bervariasi, bergantung pada isi dari array $data
         */
        if ($tptype_id != 0) {
            $this->db->where('tptype_id', $tptype_id);

            if ($this->db->update('fis_rtraining_package_types', $data)) {
                $this->session->set_userdata('typeNotif', 'successEditData');
                return true;
            } else {
                $this->session->set_userdata('typeNotif', 'errorEditData');
                return false;
            }
        } else {
            /**
             * selain itu maka dilakukan proses penambahan data pada table fis_rtraining_package_types
             */
            if ($this->db->insert('fis_rtraining_package_types', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorEditData');
                return false;
            }
        }
    }

    function deleteRes($id)
    {
        if ($this->db->delete('fis_dtraining_package_details', array('tpdetail_tres_fk' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeleteData');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDeleteData');
            return FALSE;
        }
    }

    function deletePack($id)
    {
        if ($this->db->delete('fis_rtraining_package_types', array('tptype_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeleteData');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDeleteData');
            return FALSE;
        }
    }
}
