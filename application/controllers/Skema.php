<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skema extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Model_Skema');
	}

	public function api_view_skema()
	{
		
		$result = $this->Model_Skema->getData();


		$template = '<option value="N">Pilih Skema</option>';
		for ($i=0; $i <  count($result); $i++) 
		{ 
			$id_skema = $result[$i]['id_skema'];
			$skema = $result[$i]['nama_skema'];
			$template .= '<option value="'.$id_skema.'">'.$skema.'</option>';
		}

		echo $template;
	}

}
