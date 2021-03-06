<?php 


class Model_User extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * View Data
     * @return [type] [description]
     */
    public function getData()
    {
    	$query = $this->db->get('view_display_user');
    	return $query->result_array();
    }

    /**
     * View Data By Id
     * @return [type] [description]
     */
    public function getDataById($id)
    {
        $query = $this->db->get_where('t_user', array('id' => $id), 30);
        return $query->result_array();
    }

     /**
     * Search Data
     * @return [type] [description]
     */
    public function searchUser($name)
    {
    	$this->db->like('name', $name);
    	$query = $query = $this->db->get('view_display_user');
    	return $query->result_array();
    }

    /**
     * Add Data
     * @param [type] $data [description]
     */
    public function addData($data=Array())
    {
		$result = $this->db->insert('t_user', $data);
		return $result ? true : false;
    }

    /**
     * Update Data
     */
    public function updateData($id,$name,$email,$address,$phone)
    {
		$this->db->set('name', $name, true);
		$this->db->set('email', $email, true);
		$this->db->set('phone', $phone, true);
		$this->db->where('id', $id);
		$result = $this->db->update('t_user');
		return $result ? true : false;
    }

    public function deleteData($id)
    {
    	$this->db->where('id', $id);
		$result = $this->db->delete('t_user');
		return $result ? true : false;
    }


    public function checkNik($nik)
    {
        $nik = addslashes($nik);

        $query = $this->db->query("select id from t_user where nik=".$nik." limit 1");
        $jumlah =  $query->num_rows();
        return $jumlah;
       // return $jumlah>0 ? true : false;
    }
}