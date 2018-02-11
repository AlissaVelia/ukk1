<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {


	//HAFALIN	
	public function login()
	{
		$query = $this->db->join('jabatan','jabatan.id_jabatan = pegawai.id_jabatan')
						  ->where('nama', $this->input->post('nama'))
				 		  ->where('password', $this->input->post('password'))
				 		  ->get('pegawai');

		if($query->num_rows() == 1){
			$data_pegawai = $query->row();
			$session = array(
				'logged_in'		=>	TRUE,
				'nik'			=>	$data_pegawai->nik,
				'id_pegawai'	=>	$data_pegawai->id_pegawai,
				'nama_pegawai'	=>  $data_pegawai->nama_pegawai,
				'id_jabatan'	=>	$data_pegawai->id_jabatan,
				'jabatan'		=>	$data_pegawai->nama_jabatan,
				'level'			=> $data_pegawai->level
			);

			$this->session->set_userdata($session);

			return TRUE;
		} else {
			return FALSE;
		}
	}
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */