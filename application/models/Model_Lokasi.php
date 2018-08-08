<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Lokasi extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function getData()
    {
    	$query = $this->db->get('t_tempat_uji');
    	return $query->result_array();
    }
}