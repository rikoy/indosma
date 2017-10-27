<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 			= "admin/dashboard/dashboard_v";
			$data["title_box"] 			= "Dashboard";

			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}			
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */