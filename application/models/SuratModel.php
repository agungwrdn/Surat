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
		return $this->db->get('surat_masuk')
						->result();
	}

	public function getSuratKeluar(){
		return $this->db->get('surat_keluar')
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

	public function editSuratKeluar(){
		$idSurat = $this->input->post('idSurat');
		$judul = $this->input->post('judul');
		$noSurat = $this->input->post('noSurat');
		$perihal = $this->input->post('perihal');
		$pengirim = $this->input->post('pengirim');
		$penerima = $this->input->post('penerima');
		$tglkirim = $this->input->post('tglkirim');
		$data = array(
			'judul' => $judul,
			'noSurat' => $noSurat,
			'perihal' => $perihal,
			'pengirim' => $pengirim,
			'penerima' => $penerima,
			'tglKirim' => $tglkirim);
		$this->db->where('idSuratKeluar', $idSurat)
				 ->update('surat_keluar', $data);

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

	public function getSuratDisposisi(){
		$idUser = $this->session->userdata('idUser');
		return $this->db->where('disposisi.pengirim', $idUser)
						->join('disposisi', 'disposisi.idSurat = surat_masuk.idSuratMasuk')
						->join('user', 'user.idUser = disposisi.penerima')
						->get('surat_masuk')
						->result();
	}

	public function getSuratDisposisiMasuk(){
		$idUser = $this->session->userdata('idUser');
		return $this->db->where('disposisi.penerima', $idUser)
						->join('disposisi', 'disposisi.idSurat = surat_masuk.idSuratMasuk')
						->join('user', 'user.idUser = disposisi.pengirim')
						->get('surat_masuk')
						->result();
	}

	public function getSuratByid($idSurat){
		$data = $this->db->where('idSuratMasuk', $idSurat)
						->get('surat_masuk')
						->row();
		echo json_encode($data);
	}
	
	public function getSuratKeluarByid($idSurat){
		$data = $this->db->where('idSuratKeluar', $idSurat)
						->get('surat_keluar')
						->row();
		echo json_encode($data);
	}

	public function tambahSurat($file){
		
		$judul = $this->input->post('judul');
		$noSurat = $this->input->post('noSurat');
		$perihal = $this->input->post('perihal');
		$pengirim = $this->input->post('pengirim');
		$penerima = $this->input->post('penerima');
		$tglKirim = $this->input->post('tglkirim');
		$tglTerima = $this->input->post('tglterima');
		$data = array(
			'judul' => $this->input->post('judul'),
			'noSurat' => $noSurat,
			'perihal' => $perihal,
			'pengirim' => $pengirim,
			'penerima' => $penerima,
			'tglKirim' => $tglKirim,
			'tglTerima' => $tglTerima,
			'file' => $file['file_name']);
		$this->db->insert('surat_masuk', $data);
		
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function tambahSuratKeluar($file){
		
		$judul = $this->input->post('judul');
		$noSurat = $this->input->post('noSurat');
		$perihal = $this->input->post('perihal');
		$pengirim = $this->input->post('pengirim');
		$penerima = $this->input->post('penerima');
		$tglKirim = $this->input->post('tglkirim');
		$data = array(
			'judul' => $this->input->post('judul'),
			'noSurat' => $noSurat,
			'perihal' => $perihal,
			'pengirim' => $pengirim,
			'penerima' => $penerima,
			'tglKirim' => $tglKirim,
			'file' => $file['file_name']);
		$this->db->insert('surat_keluar', $data);
		
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

	public function hapusSuratMasuk(){
		$id = $this->uri->segment(3);
		$this->db->where('idSuratMasuk', $id)
				 ->delete('surat_masuk');
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function hapusSuratKeluar(){
		$id = $this->uri->segment(3);
		$this->db->where('idSuratKeluar', $id)
				 ->delete('surat_keluar');
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function editFileSurat($file){
		$idSurat = $this->input->post('idSurat');
		$data = array('file' => $file['file_name'], );

		$this->db->where('idSuratMasuk', $idSurat)
				 ->update('surat_masuk', $data);

		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function editFileSuratKeluar($file){
		$idSurat = $this->input->post('idSurat');
		$data = array('file' => $file['file_name'], );

		$this->db->where('idSuratKeluar', $idSurat)
				 ->update('surat_keluar', $data);

		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file TableModel.php */
/* Location: ./application/models/TableModel.php */