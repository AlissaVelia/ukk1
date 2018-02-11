<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_lain extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_model');
		}
	public function index()
	{
		$data['disposisi'] = $this->admin_model->get_all_disposisi_masuk($this->session->userdata('id_pegawai'));
		$data['main_view'] = 'dashboard_lain';
		
		$this->load->view('template_view', $data);
		
	}

	public function disposisi_keluar()
	{
		$data['data_disposisi']	= $this->admin_model->get_all_disposisi_keluar($this->session->userdata('id_pegawai'));
		$data['main_view'] = 'disposisi/disposisi_keluar';
		$this->load->view('template_view', $data);
	}

	public function v_disposisi_keluar()
	{

		$data['drop_down'] = $this->admin_model->get_jabatan();
		$data['main_view'] = 'disposisi/tambah_disposisi_keluar';
		$this->load->view('template_view', $data);

	}

	public function tambah_disposisi_keluar()
    {
            $this->form_validation->set_rules('id_pegawai_penerima', 'Tujuan Pegawai', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                if($this->admin_model->tambah_disposisi($this->uri->segment(3)) == TRUE ){
                    $this->session->set_flashdata('notif', 'Tambah disposisi berhasil!');
                    if($this->session->userdata('id_jabatan') == '1'){
                        redirect('dashboard_lain/disposisi_keluar/'.$this->uri->segment(3));
                    } else {
                        redirect('dashboard_lain/disposisi_keluar/'.$this->uri->segment(3));
                    }           
                } else {
                    $this->session->set_flashdata('notif', 'Tambah disposisi gagal!');
                    if($this->session->userdata('id_jabatan') == '1'){
                        redirect('dashboard_lain/v_disposisi_keluar/'.$this->uri->segment(3));
                    } else {
                        redirect('dashboard_lain/v_disposisi_keluar/'.$this->uri->segment(3));
                    }       
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                if($this->session->userdata('id_jabatan') == '1'){
                    redirect('dashboard_lain/v_disposisi_keluar/'.$this->uri->segment(3));
                } else {
                    redirect('dashboard_lain/v_disposisi_keluar/'.$this->uri->segment(3));
                }           
            }
    }

    public function hapus_disposisi($id_surat, $id_disposisi)
    {
        if($this->admin_model->hapus_disposisi($id_disposisi) == TRUE )
        {
            $this->session->set_flashdata('notif', 'berhasil');
            redirect('dashboard_lain/disposisi_keluar/'.$this->uri->segment(3));
        }
        else{
            $this->session->set_flashdata('notif', 'gagal');
            redirect('dashboard_lain/disposisi_keluar/'.$this->uri->segment(3));
        }
    }



}

/* End of file dashboard_lain.php */
/* Location: ./application/controllers/dashboard_lain.php */