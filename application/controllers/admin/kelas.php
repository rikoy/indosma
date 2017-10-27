<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('kelas_m'));
	}

	function index()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 	= "admin/kelas/kelas_v";
			$data["title_box"] 	= "Data Kelas";
			$data["title_inbox"]= "List Data Kelas";

			$data['query'] = $this->kelas_m->getAll_kelas();

			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}	
	}

	function hapus($id)
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			
			$this->kelas_m->delete_kelas_byadmin($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');

			redirect('admin/kelas', 'refresh');

		}else{
			redirect('admin/login/proses_logout','refresh');
		}

	}

}

/* End of file kelas.php */
/* Location: ./application/controllers/admin/kelas.php */