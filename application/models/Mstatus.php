<?php

class Mstatus extends CI_Model
{
    function get_status()
    {
        $query = $this->db->get('fis_rservice_statuses');
        return $query->result();
    }
}
