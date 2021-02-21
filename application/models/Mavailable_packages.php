<?php

class Mavailable_packages extends CI_Model
{

    function get_list_package()
    {
        $query = $this->db->get('fis_rservice_consult_available_packages');
        return $query->result();
    }
}
