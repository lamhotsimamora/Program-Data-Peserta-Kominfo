<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Model_Lokasi');
	}

	public function api_view_lokasi()
	{
		
		$result = $this->Model_Lokasi->getData();


		$template = '<option value="N">Pilih Lokasi Ujian</option>';
		for ($i=0; $i <  count($result); $i++) 
		{ 
			$id_skema = $result[$i]['id_tempat_uji'];
			$skema = $result[$i]['tempat_uji'];
			$template .= '<option value="'.$id_skema.'">'.$skema.'</option>';
		}

		echo $template;
	}

}
