<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Laporan');
	}

	public function show()
	{
		$data = $this->Model_Laporan->getData();
		

		echo json_encode($data->result());
	}




	public function index()
	{
		$this->load->view('Laporan');
	}

}
