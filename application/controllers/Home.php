<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('SuratModel');
		$this->load->model('UserModel');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == "admin") {
				$data['SuratMasuk'] = $this->SuratModel->getSuratMasuk();
				$data['users'] = $this->UserModel->getUser();
				$data['view'] = "admin/Dashboard";
				$this->load->view('Template', $data);
			} else {
				$data['view'] = "anggota/SuratMasuk";
				$data['SuratMasuk'] = $this->SuratModel->getSuratMasuk();
				$data['users'] = $this->UserModel->getUser();
				$this->load->view('TemplateA', $data);
			}
		} else {
			$this->load->view('Login');	
		}	
	}

	public function suratKeluar(){
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == "admin") {
				$data['view'] = "admin/SuratKeluar";
				$data['SuratKeluar'] = $this->SuratModel->getSuratKeluar();
				$data['users'] = $this->UserModel->getUser();
				$this->load->view('Template', $data);
			} else {
				$data['view'] = "anggota/SuratKeluar";
				$data['SuratKeluar'] = $this->SuratModel->getSuratKeluar();
				$data['users'] = $this->UserModel->getUser();
				$this->load->view('TemplateA', $data);
			}
		} else {
			redirect('home');
		}
	}

	public function cekUser(){
		if ($this->LoginModel->cekUser() == TRUE) {
			if ($this->session->userdata('level') == "super admin" || $this->session->userdata('level') == "admin") {
				$data['view'] = "admin/Dashboard";
				$this->load->view('Template', $data);
			} else {
				$data['view'] = "anggota/SuratMasuk";
				$data['SuratMasuk'] = $this->SuratModel->getSuratMasuk();
				$this->load->view('TemplateA', $data);
			}
		} else {
			redirect('home');
		}
	}

	public function Logout(){
		session_destroy();
		redirect('home');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */