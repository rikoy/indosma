<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('pesan_m'));
	}

	function index()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 	= "admin/pesan/pesan_v";
			$data["title_box"] 	= "Data Pesan Pengguna";
			$data["title_inbox"]= "List Data Pesan Pengguna";

			$data['query'] = $this->pesan_m->getAll_pesan();

			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}	
	}

	function hapus($id)
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			
			$this->pesan_m->delete_byadmin($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');

			redirect('admin/pesan', 'refresh');

		}else{
			redirect('admin/login/proses_logout','refresh');
		}

	}

}

/* End of file pesan.php */
/* Location: ./application/controllers/admin/pesan.php */