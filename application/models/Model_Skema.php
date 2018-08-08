<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Skema extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function getData()
    {
    	$query = $this->db->get('t_skema');
    	return $query->result_array();
    }
}