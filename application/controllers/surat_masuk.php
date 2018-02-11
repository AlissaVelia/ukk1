<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{

		if($this->session->userdata('logged_in') == TRUE)
		{
		$data['list'] = $this->admin_model->surat_masuk();
	    $data['main_view'] = 'surat_masuk';
    	$this->load->view('template_view', $data);
		}
		else
		{
			redirect('login');
		}
	}

	public function v_tambah_surat()
	{
		$data['main_view'] = 'tambah_surat_masuk';
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
    		$this->form_validation->set_rules('kategori_surat', 'kategori_surat', 'trim|required');
				if ($this->form_validation->run() == TRUE) {
    			$config['upload_path'] = './uploads/';
    			$config['allowed_types'] = 'pdf';
    			$config['max_size']  = '200';
    			
    			$this->load->library('upload', $config);
    				
    			if($this->upload->do_upload('file_surat'))
    			{
    				if($this->admin_model->tambah_surat($this->upload->data()) == TRUE)
    				{
    					$this->session->set_flashdata('notif', 'berhasil');
    					redirect('surat_masuk');
    				}
    				else
    				{
    					$this->session->set_flashdata('notif', 'gagal');
    					redirect('surat_masuk/v_tambah_surat');
    				}
    			} else{
    				$this->session->set_flashdata('notif', $this->upload->display_errors());
    				redirect('surat_masuk/v_tambah_surat');
    			}

    		} else {
    			$this->session->set_flashdata('notif', validation_errors());
					redirect('surat_masuk/v_tambah_surat');
    		}
    	}
    }
    public function v_tambah_surat_keluar()
    {
        $data['main_view'] = 'tambah_surat_keluar';
        $this->load->view('template_view', $data);
    }

    public function lihat_surat_masuk()
    {
        $id_surat = $this->uri->segment(3);
        $data['list'] = $this->admin_model->get_surat_masuk($id_surat);
        $data['main_view'] = 'ubah_surat_masuk';
        $this->load->view('template_view', $data);
    }
 

    


    public function ubah_surat_masuk()
    {
        $id_surat = $this->uri->segment(3);
        $data['list'] = $this->admin_model->get_surat_masuk($id_surat);
        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('no_surat', 'no', 'trim|required');
            $this->form_validation->set_rules('tgl_kirim', 'tgl_kirim', 'trim|required');
            $this->form_validation->set_rules('penerima', 'penerima', 'trim|required');
            $this->form_validation->set_rules('perihal', 'perihal', 'trim|required');
            //$this->form_validation->set_rules('kategori_surat', 'kategori_surat', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    if($this->admin_model->ubah_surat($id_surat) == TRUE)
                    {
                        $this->session->set_flashdata('notif', 'berhasil');
                        redirect('surat_masuk');
                    }
                    else
                    {
                        $this->session->set_flashdata('notif', 'gagal');
                        redirect('surat_masuk/lihat_surat_masuk/'.$this->uri->segment(3));
                    }
                }
                else{
                     $this->session->set_flashdata('notif', validation_errors());
                        redirect('surat_masuk/lihat_surat_masuk/'.$this->uri->segment(3));
                }
               
        }
    }

     public function ubah_file()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']  = '200';
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('file_surat')){
            if($this->admin_model->ubah_file($this->upload->data(), $this->uri->segment(3)) == TRUE)
            {
                $this->session->set_flashdata('notif', 'berhasil');
                redirect('surat_masuk');
            }
            else{
                $this->session->set_flashdata('notif', 'gagal');
                redirect('surat_masuk/v_ubah_file/'.$this->uri->segment(3));
            }
            
            }
        else{
           $this->session->set_flashdata('notif', $this->upload->display_errors());
                redirect('surat_masuk/v_ubah_file/'.$this->uri->segment(3));
        }
    }

    public function hapus_surat()
    {
        $id_surat = $this->uri->segment(3);
        if($this->admin_model->hapus_surat($id_surat) == TRUE)
        {
            $this->session->set_flashdata('notif', 'berhasil');
            redirect('surat_masuk');
        }
        else
        {
            $this->session->set_flashdata('notif', 'gagal');
            redirect('surat_masuk');
        }
    }


    //UNTUK MENAMPILKAN DISPOSISI  PER ID SURAT
     public  function disposisi_sekretaris($id_surat)
    {
        //menampilkan data surat masuk saja (untuk menampilkan no surat)
        $data['data_surat']          = $this->admin_model->get_surat_masuk_by_id($this->uri->segment(3));
        //menampilkan jabatan dropdown
        $data['drop_down_jabatan']  = $this->admin_model->get_jabatan();
        //menampilkan data surat masuk dan disposisisi yang telah di join
        $data['data_disposisi']     = $this->admin_model->get_all_disposisi($id_surat);
        $data['main_view'] = 'disposisi/disposisi_sekretaris';
        $this->load->view('template_view', $data);
    }

    //UNTUK MENAMPILKAN FORM TAMBAH  DISPOSISI
    public function v_tambah_disposisi()
    {   
        $data['drop_down']  = $this->admin_model->get_jabatan();
        $data['main_view'] = 'disposisi/tambah_disposisi_sekretaris';
        $this->load->view('template_view', $data);
    }
    
    public function get_pegawai_by_jabatan($id_jabatan)
    {
        if($this->session->userdata('logged_in') == TRUE){
            $data_pegawai = $this->admin_model->get_pegawai_by_jabatan($id_jabatan);

            echo json_encode($data_pegawai);
            //untuk ngirim ke views

        } else {
            redirect('login');
        }
    }

    public function tambah_disposisi_masuk()
    {
            $this->form_validation->set_rules('id_pegawai_penerima', 'Tujuan Pegawai', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                if($this->admin_model->tambah_disposisi($this->uri->segment(3)) == TRUE ){
                    $this->session->set_flashdata('notif', 'Tambah disposisi berhasil!');
                    if($this->session->userdata('id_jabatan') == '1'){
                        redirect('surat_masuk/disposisi_sekretaris/'.$this->uri->segment(3));
                    } else {
                        redirect('surat_masuk/disposisi/'.$this->uri->segment(3));
                    }           
                } else {
                    $this->session->set_flashdata('notif', 'Tambah disposisi gagal!');
                    if($this->session->userdata('id_jabatan') == '1'){
                        redirect('surat_masuk/disposisi/'.$this->uri->segment(3));
                    } else {
                        redirect('surat_masuk/disposisi/'.$this->uri->segment(3));
                    }       
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                if($this->session->userdata('id_jabatan') == '1'){
                    redirect('surat_masuk/disposisi/'.$this->uri->segment(3));
                } else {
                    redirect('surat_masuk/disposisi/'.$this->uri->segment(3));
                }           
            }
    }

    public function hapus_disposisi($id_surat, $id_disposisi)
    {
        if($this->admin_model->hapus_disposisi($id_disposisi) == TRUE)
        {
            $this->session->set_flashdata('notif', 'berhasil');
            redirect('surat_masuk/disposisi_sekretaris/'.$this->uri->segment(3));
        }
        else
        {
            $this->session->set_flashdata('notif', 'gagal');
            redirect('surat_masuk/disposisi_sekretaris/'.$this->uri->segment(3));
        }
    }

    public function v_ubah_file($id_surat)
    {
        $data['data'] = $this->admin_model->get_surat_masuk_by_id($id_surat); 
        $data['main_view'] = 'ubah_file';
        $this->load->view('template_view', $data);
    }

   


}

/* End of file surat_sekretaris.php */
/* Location: ./application/controllers/surat_sekretaris.php */