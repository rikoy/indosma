<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model('pengguna_m');
	}

	public function index()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 	= "admin/pengguna/pengguna_v";
			$data["title_box"] 	= "Data Pengguna";
			$data["title_inbox"]= "List Data Pengguna";

			$data['query'] = $this->pengguna_m->getAll_user();

			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}	
	}

	function data_login()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 	= "admin/pengguna/datalogin_v";
			$data["title_box"] 	= "Data Login Pengguna";
			$data["title_inbox"]= "List Data Login Pengguna";

			$data['query'] = $this->pengguna_m->getAll_userlogin();

			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}	
	}

	function hapus($id)
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){

			$this->pengguna_m->delete_user($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			redirect('admin/pengguna', 'refresh');

		}else{
			redirect('admin/login/proses_logout','refresh');
		}
	}

}

/* End of file pengguna.php */
/* Location: ./application/controllers/admin/pengguna.php */