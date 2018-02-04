<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SuratModel');
		$this->load->model('UserModel');
	}

	public function index(){
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == "admin") {
				$data['view'] = "admin/Surat";
				$data['Surat'] = $this->SuratModel->getSurat();
				$data['users'] = $this->UserModel->getUser();
				$this->load->view('Template', $data);
			} else {
				$data['view'] = "anggota/SuratMasuk";
				$data['Surat'] = $this->SuratModel->getSuratMasuk();
				$data['users'] = $this->UserModel->getUser();
				$this->load->view('TemplateA', $data);
			}
		} else {
			$this->load->view('Login');	
		}	
	}

	public function tambahSurat(){
		$user = $this->session->userdata('level');
		if ($this->session->userdata('logged_in') == TRUE) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types']	= 'pdf';
			$this->load->library('upload', $config);
			if ( !$this->upload->do_upload('file')){
				$error = array('error' => $this->upload->display_errors());
				echo json_encode($error);
			}
			else{
				if ($this->SuratModel->tambahSurat($this->upload->data()) == TRUE) {
					echo
					'<script type="text/javascript">alert("Tambah Surat Berhasil");
				 window.location.href="'.base_url().'home/suratkeluar";
				 </script>';
				} else {
					echo
					'<script type="text/javascript">alert("Tambah Surat Gagal");
				 window.location.href="'.base_url().'home/suratkeluar";
				 </script>';
				}
			}
		} else {
			redirect('home');
		}
	}

	public function setStatus(){
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->SuratModel->setStatus() == TRUE) {
				redirect('home');
			} else {
				redirect('home');
			}
		} else {
			redirect('home');
		}
		
	}

	public function getSuratByid($idSurat){
		$this->SuratModel->getSuratByid($idSurat);
	}

	public function editSurat(){
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->SuratModel->editSurat() == TRUE) {
				echo
				'<script type="text/javascript">alert("Edit Surat Berhasil");
				 window.location.href="'.base_url().'home/suratkeluar";
				 </script>';
			} else {
				echo
				'<script type="text/javascript">alert("Edit Surat Gagal");
				 window.location.href="'.base_url().'home/suratkeluar";
				 </script>';
			}
			
		} else {
			redirect('home');
		}
	}

	public function hapusDisposisi(){
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->SuratModel->hapusDisposisi() == TRUE) {
				echo 
				'<script type="text/javascript">alert("Hapus Surat Berhasil");
				 window.location.href="'.base_url().'home";
				 </script>';
			} else {
				echo
				'<script type="text/javascript">alert("Hapus Surat Gagal");
				 window.location.href="'.base_url().'home";
				 </script>';
			}
		} else {
			
		}
		
	}

	public function disposisi(){
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->SuratModel->disposisi() == TRUE) {
				echo
				'<script type="text/javascript">alert("Disposisi Berhasil");
				 window.location.href="'.base_url().'/home";
				 </script>';
			} else {
				echo
				'<script type="text/javascript">alert("Disposisi Gagal");
				 window.location.href="'.base_url().'/home/suratkeluar";
				 </script>';
			}
		} else {
			redirect('home');
		}
		
	}

	public function getAllUser(){
		
	}
}

/* End of file Surat.php */
/* Location: ./application/controllers/Surat.php */