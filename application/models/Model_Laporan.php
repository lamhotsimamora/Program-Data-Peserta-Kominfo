<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Laporan extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function getData()
    {
    	$query = $this->db->get('view_data_skema');
    	return $query;
    }
}