<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	public function cekUser(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query = $this->db->where('user.username', $username)
						   ->where('user.password', $password)
						   ->join('jabatan','user.idJabatan = jabatan.idJabatan')
						   ->get('user');
		if ($this->db->affected_rows() == 1) {
			$a = $query->row();
			$data = array(
				'logged_in' => TRUE,
				'level' => $a->level,
				'idUser' => $a->idUser,
				'nama' => $a->namaLengkap);
			$this->session->set_userdata( $data );
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

}

/* End of file LoginModel.php */
/* Location: ./application/models/LoginModel.php */