<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_sekretaris extends CI_Controller {

	public function index()
	{
		$data['main_view'] = 'dashboard_sekretaris';
		$this->load->view('template_view', $data);

	}

}

/* End of file dashboard_sekretaris.php */
/* Location: ./application/controllers/dashboard_sekretaris.php */