<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class 	admin_model extends CI_Model {

	public function tambah_surat($file_surat)
	{
		$data = array('no_surat' => $this->input->post('no_surat') ,
				      'tgl_kirim' => $this->input->post('tgl_kirim'),
				      'tgl_terima' => $this->input->post('tgl_terima'),
				      'pengirim' => $this->input->post('pengirim'),
				      'penerima' => $this->input->post('penerima'),
				      'perihal' => $this->input->post('perihal'),
				      'kategori_surat' => $this->input->post('kategori_surat'),
				      'file_surat' => $file_surat['file_name']

					);
		$this->db->insert('surat_masuk_keluar', $data);
		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}

	public function surat_masuk()
	{
		return $this->db->where('kategori_surat', 'surat masuk' )->get('surat_masuk_keluar')->result();
	}

	public function surat_keluar()
	{
		return $this->db->where('kategori_surat', 'surat keluar' )->get('surat_masuk_keluar')->result();
	}

	public function get_surat_masuk($id_surat)
	{
		return $this->db->where('id_surat', $id_surat)->get('surat_masuk_keluar')->row();
	}

	public function ubah_surat($id_surat)
	{
		$data = array('no_surat' => $this->input->post('no_surat') ,
				      'tgl_kirim' => $this->input->post('tgl_kirim'),
				      'tgl_terima' => $this->input->post('tgl_terima'),
				      'pengirim' => $this->input->post('pengirim'),
				      'penerima' => $this->input->post('penerima'),
				      'perihal' => $this->input->post('perihal'));
				      //'kategori_surat' => $this->input->post('kategori_surat'));
		
		$this->db->where('id_surat', $id_surat)
				 ->update('surat_masuk_keluar', $data);
		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function ubah_file($file_surat, $id_surat)
	{
		$data = array(
					'file_surat' => $file_surat['file_name']
						);

		$this->db->where('id_surat', $id_surat)
				 ->update('surat_masuk_keluar', $data);

		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function hapus_surat($id_surat)
	{
		$this->db->where('id_surat', $id_surat)
				 ->delete('surat_masuk_keluar');
		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	//DISPOSISI SEKERTARIS MASUK MULAI

	public function get_jabatan()
	{
		return $this->db->get('jabatan')->result();
	}

	public function get_pegawai_by_jabatan($id_jabatan)
	{
		return $this->db->where('id_jabatan', $id_jabatan)
						->get('pegawai')
						->result();
	}

	public function get_surat_masuk_by_id($id_surat)
	{
		return $this->db->where('id_surat', $id_surat)
						->get('surat_masuk_keluar')
						->row();
	}

	public function get_all_disposisi($id_surat)
	{
		return $this->db->join('surat_disposisi', 'surat_disposisi.id_surat = surat_masuk_keluar.id_surat')
						->join('jabatan', 'surat_disposisi.id_pengirim = jabatan.id_jabatan')
						->join('pegawai', 'pegawai.id_pegawai = surat_disposisi.id_pegawai_penerima')
						->where('surat_disposisi.id_surat', $id_surat)
						->get('surat_masuk_keluar')
						->result();
	}

	public function tambah_disposisi($id_surat)
	{
		$data = array(
			'id_surat'				=> $id_surat,
			'id_pengirim'	=> $this->session->userdata('id_pegawai'),
			'id_pegawai_penerima'	=> $this->input->post('id_pegawai_penerima'),
			'keterangan'			=> $this->input->post('keterangan')
		);

		$this->db->insert('surat_disposisi', $data);

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}	
	}

	//DISPOSISI SEKERTARIS SELESAI



	public function get_all_disposisi_masuk($id_pegawai_penerima)
	{
		return $this->db->join('surat_disposisi', 'surat_disposisi.id_surat = surat_masuk_keluar.id_surat')
						->join('pegawai', 'surat_disposisi.id_pengirim = pegawai.id_pegawai')
						->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
						->where('id_pegawai_penerima', $id_pegawai_penerima)
						->get('surat_masuk_keluar')
						->result();
	}

	public function get_all_disposisi_keluar($id_pegawai_pengirim)
	{
		return $this->db->join('surat_disposisi', 'surat_disposisi.id_surat = surat_masuk_keluar.id_surat')
						->join('pegawai', 'surat_disposisi.id_pegawai_penerima = pegawai.id_pegawai')
						->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
						->where('surat_disposisi.id_pengirim', $this->session->userdata('id_pegawai'))
						->where('surat_disposisi.id_surat', $this->uri->segment(3))
						->get('surat_masuk_keluar')
						->result();
	}

	public function hapus_disposisi($id_disposisi, $id_surat)
	{
		$this->db->where('id_disposisi',$id_disposisi)
				 ->delete('surat_disposisi');

		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
		

}

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */