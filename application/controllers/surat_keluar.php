<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['list'] = $this->admin_model->surat_keluar();
		$data['main_view'] = 'surat_keluar';	
		$this->load->view('template_view', $data);	
	}

	public function v_tambah_surat()
	{
		$data['main_view'] = 'tambah_surat_keluar';
		$this->load->view('template_view', $data);
	}
    
    public function tambah_surat()
    {
    	if($this->input->post('submit'))
    	{
    		$this->form_validation->set_rules('no_surat', 'no', 'trim|required');
    		$this->form_validation->set_rules('tgl_kirim', 'tgl_kirim', 'trim|required');
 
    		$this->form_validation->set_rules('penerima', 'penerima', 'trim|required');
    		$this->form_validation->set_rules('perihal', 'perihal', 'trim|required');
				if ($this->form_validation->run() == TRUE) {
    			$config['upload_path'] = './uploads/';
    			$config['allowed_types'] = 'pdf';
    			$config['max_size']  = '100';
    			
    			$this->load->library('upload', $config);
    				
    			if($this->upload->do_upload('file_surat'))
    			{
    				if($this->admin_model->tambah_surat($this->upload->data()) == TRUE)
    				{
    					$this->session->set_flashdata('notif', 'berhasil');
    					redirect('surat_keluar');
    				}
    				else
    				{
    					$this->session->set_flashdata('notif', 'gagal');
    					redirect('surat_keluar');
    				}
    			} else{
    				$this->session->set_flashdata('notif', $this->uploaad->display_errors());
    				redirect('surat_keluar');
    			}

    		} else {
    			$this->session->set_flashdata('notif', validation_errors());
					redirect('surat_keluar');
    		}
    	}
    }

    public function lihat_surat_keluar()
    {
        $id_surat = $this->uri->segment(3);
        $data['list'] = $this->admin_model->get_surat_masuk($id_surat);
        $data['main_view'] = 'ubah_surat_keluar';
        $this->load->view('template_view', $data);
    }

    public function lihat_file_keluar()
    {
        $id_surat = $this->uri->segment(3);
        $data['list'] = $this->admin_model->get_surat_masuk($id_surat);
        $data['main_view'] = 'ubah_file_keluar';
        $this->load->view('template_view', $data);
    }

    public function ubah_surat_keluar()
    {
        $id_surat = $this->uri->segment(3);
        $data['list'] = $this->admin_model->get_surat_masuk($id_surat);
        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('no_surat', 'nomor surat', 'trim|required');
            $this->form_validation->set_rules('tgl_kirim', 'tgl kirim', 'trim|required');
            $this->form_validation->set_rules('penerima', 'penerima', 'trim|required');
            $this->form_validation->set_rules('perihal', 'perihal', 'trim|required');

           if ($this->form_validation->run() == TRUE) 
           {
            if($this->admin_model->ubah_surat($id_surat) == TRUE)
            {
                $this->session->set_flashdata('notif', 'berhasil');
                redirect('surat_keluar');
            }
            else
            {
                 $this->session->set_flashdata('notif', 'gagal');
                redirect('surat_keluar');
            }
           }
           else
           {
            $this->session->set_flashdata('notif', validation_errors());
            redirect('surat_keluar');
           }
        }
    }

    public function ubah_file()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']  = '200';
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('file_surat'))
        {
            if($this->admin_model->ubah_file($this->upload->data(), $this->uri->segment(3)) == TRUE)
            {
                $this->session->set_flashdata('notif', 'berhasil');
                redirect('surat_keluar');
            }
            else
            {
                $this->session->set_flashdata('notif', 'gagal');
                redirect('surat_keluar');
            }
            
            
        }
        else{
             $this->session->set_flashdata('notif', $this->upload->display_errors());
                redirect('surat_keluar');
        }
    }

    public function hapus()
    {
        $id_surat = $this->uri->segment(3);
        if($this->admin_model->hapus_surat($id_surat) == TRUE)
        {
            $this->session->set_flashdata('notif', 'Hapus Berhasil');
            redirect('surat_keluar');
        }
        else
        {
            $this->session->set_flashdata('notif', 'Hapus gagal');
            redirect('surat_keluar');
        }
    }

}

/* End of file surat_keluar.php */
/* Location: ./application/controllers/surat_keluar.php */