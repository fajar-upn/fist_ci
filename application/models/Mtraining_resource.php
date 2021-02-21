<?php

class Mtraining_resource extends CI_Model
{
    function get_All()
    {
        $query = $this->db->select('*')
        ->from('fis_rtraining_resource')
        ->get();
        return $query->result();
    }

    /**
	 * menampilkan data user pada tabel fis_duser_accounts berdasarkan id
	 * dikembalikan dalam bentuk array
	 * @param $id
	 * @return mixed
	 */
	function get_by_id($id) {
		$this->db->where('tres_id', $id);
		$query = $this->db->get('fis_rtraining_resource');
		return $query->row();
	}

    public function saveRes($data, $tres_id = 0)
    {
        /**
         * jika $tclass_id != 0 maka akan dilakukan proses update pada fis_dtraining_classes
         * data yang diupdate bervariasi, bergantung pada isi dari array $data
         */
        if ($tres_id != 0) {
            $this->db->where('tres_id', $tres_id);

            if ($this->db->update('fis_rtraining_resource', $data)) {
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
            if ($this->db->insert('fis_rtraining_resource', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return false;
            }
        }
    }

    function delete($id)
    {
        if ($this->db->delete('fis_rtraining_resource', array('tres_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeleteData');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDeleteData');
            return FALSE;
        }
    }
}

?>