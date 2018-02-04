<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getUser(){
		$idUser = $this->session->userdata('idUser');
		return $this->db->where('idUser !=', $idUser)
						->get('user')
						->result();
	}

	public function getAllUser(){

	}
}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */