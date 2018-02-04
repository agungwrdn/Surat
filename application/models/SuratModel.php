<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getSuratMasuk(){
		$idUser = $this->session->userdata('idUser');
		return $this->db->where('disposisi.penerima', $idUser)
						->join('surat_masuk', 'surat_masuk.idSuratMasuk = disposisi.idSurat')
						->get('disposisi')
						->result();
	}

	public function getSurat(){
		$idUser = $this->session->userdata('idUser');
		return $this->db->where('pembuat', $idUser)
						->get('surat_masuk')
						->result();
	}

	public function hapusDisposisi(){
		$id = $this->uri->segment(3);
		$this->db->where('idDisposisi', $id)
				 ->delete('disposisi');
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	public function editSurat(){
		$idSurat = $this->input->post('idSurat');
		$judul = $this->input->post('judul');
		$noSurat = $this->input->post('noSurat');
		$perihal = $this->input->post('perihal');
		$pengirim = $this->input->post('pengirim');
		$penerima = $this->input->post('penerima');
		$data = array(
			'judul' => $judul,
			'noSurat' => $noSurat,
			'perihal' => $perihal,
			'pengirim' => $pengirim,
			'penerima' => $penerima,);
		$this->db->where('idSuratMasuk', $idSurat)
				 ->update('surat_masuk', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function setStatus(){
		$id = $this->uri->segment(3);
		$data = array('status' => "sudah terbaca", );
		$this->db->where('idDisposisi', $id)
				 ->update('disposisi', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	public function getSuratKeluar(){
		$idUser = $this->session->userdata('idUser');
		return $this->db->where('disposisi.pengirim', $idUser)
						->join('disposisi', 'disposisi.idSurat = surat_masuk.idSuratMasuk')
						->join('user', 'user.idUser = disposisi.penerima')
						->get('surat_masuk')
						->result();
	}

	public function getSuratByid($idSurat){
		$data = $this->db->where('idSuratMasuk', $idSurat)
						->get('surat_masuk')
						->row();
		echo json_encode($data);
	}
	
	public function tambahSurat($file){
		$idUser = $this->session->userdata('idUser');
		$judul = $this->input->post('judul');
		$noSurat = $this->input->post('noSurat');
		$perihal = $this->input->post('perihal');
		$pengirim = $this->input->post('pengirim');
		$penerima = $this->input->post('penerima');
		$data = array(
			'judul' => $judul,
			'noSurat' => $noSurat,
			'perihal' => $perihal,
			'pengirim' => $pengirim,
			'penerima' => $penerima,
			'pembuat' => $idUser,
			'file' => $file['file_name']);
		$this->db->insert('surat_masuk', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function disposisi(){
		$idSurat = $this->input->post('idSurat');
		$penerima = $this->input->post('user');
		$pengirim = $this->session->userdata('idUser');
		$data = array(
			'penerima' => $penerima,
			'pengirim' => $pengirim,
			'idSurat' => $idSurat,
			'status' => "belum terbaca" );

		$this->db->insert('disposisi', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

}

/* End of file TableModel.php */
/* Location: ./application/models/TableModel.php */