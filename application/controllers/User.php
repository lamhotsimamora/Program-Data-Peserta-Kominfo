<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Model_User');
	}
	public function index()
	{
		$this->load->view('index');
	}

	public function api_view_user()
	{
		$data['user'] = $this->Model_User->getData();

		echo json_encode($data);
	}

	public function api_add_user()
	{
		if (isset($_POST['name']) 
			&& isset($_POST['email']) 
			&& isset($_POST['phone'])
			&& isset($_POST['nik'])

			&& isset($_POST['tgl_lahir'])
			&& isset($_POST['tgl_serti'])

			&& isset($_POST['organisasi'])

			&& isset($_POST['skema'])
			&& isset($_POST['lokasi'])
			)
		{
			$data['name']        = addslashes(trim($_POST['name'])); 
			$data['email']       = addslashes(trim($_POST['email'])); 
			$data['nik']         = addslashes(trim($_POST['nik'])); 
			$data['phone']       = addslashes(trim($_POST['phone']));

			$data['tgl_lahir']       = addslashes(trim($_POST['tgl_lahir'])); 
			$data['tgl_sertifikat']       = addslashes(trim($_POST['tgl_serti']));

			$data['organisasi']       = addslashes(trim($_POST['organisasi']));

			$data['id_skema']       = addslashes(trim($_POST['skema'])); 
			$data['id_tempat_uji']       = addslashes(trim($_POST['lokasi']));

			$data['rekomendasi'] = 'Kompeten'; 

			if ($data['name']=='' || 
				$data['email']=='' || 
				$data['nik']=='' || 
				$data['phone']=='' ||
				$data['tgl_lahir']=='' ||
				$data['tgl_sertifikat']=='' ||

				$data['id_skema']=='' ||
				$data['id_tempat_uji']=='' 
			)
			{
				echo "F";
				exit;
			}

			$result = $this->Model_User->addData($data);

			if ($result)
			{
				echo "T";
			}else{
				echo "F";
			}

		}else{
			echo "F1";
		}
	}

	public function api_update_user()
	{
		if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['id']))
		{
			$id         = addslashes(trim($_POST['id'])); 
			$name       = addslashes(trim($_POST['name'])); 
			$email      = addslashes(trim($_POST['email'])); 
			$phone    = addslashes(trim($_POST['phone'])); 

			if ($name=='' || $email=='' || $address=='' || $id=='' || $phone=='')
			{
				echo "F";
				exit;
			}

			$id     = (int) $id;

			$result = $this->Model_User->updateData($id,$name,$email,$address,$phone);

			if ($result)
			{
				echo "T";
			}else{
				echo "F";
			}

		}else{
			echo "F1";
		}
	}

	public function api_delete_user()
	{
		if (isset($_POST['id']))
		{
			$id         = addslashes(trim($_POST['id'])); 

			if ($id=='')
			{
				echo "F";
				exit;
			}

			$id     = (int) $id;

			$result = $this->Model_User->deleteData($id);

			if ($result)
			{
				echo "T";
			}else{
				echo "F";
			}

		}else{
			echo "F1";
		}
	}

	public function api_search_user()
	{
		if (isset($_POST['name']))
		{
			$name         = addslashes(trim($_POST['name'])); 

			if ($name=='')
			{
				echo "F";
				exit;
			}

			$data['user'] = $this->Model_User->searchUser($name);

			echo json_encode($data);

		}else{
			echo "F1";
		}
	}

	public function api_view_user_single_data()
	{
		if (isset($_POST['id']))
		{
			$id         = addslashes(trim($_POST['id'])); 

			if ($id=='')
			{
				echo "F";
				exit;
			}

			
			$id     = (int) $id;


			echo json_encode($this->Model_User->getDataById($id));

		}else{
			echo "F1";
		}
	}

	public function checkNIK()
	{
		$nik = 1503082812930002;
		$result = $this->Model_User->checkNik($nik);

		var_dump($result);
	}
}
