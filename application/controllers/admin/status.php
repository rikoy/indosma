<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('status_m'));
	}

	function index()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 	= "admin/status/status_v";
			$data["title_box"] 	= "Data Status Pengguna";
			$data["title_inbox"]= "List Data Status Pengguna";

			$data['query'] = $this->status_m->getAll_status();

			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}	
	}

	function hapus($id)
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			
			$this->status_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');

			redirect('admin/status', 'refresh');

		}else{
			redirect('admin/login/proses_logout','refresh');
		}

	}

}

/* End of file status.php */
/* Location: ./application/controllers/admin/status.php */