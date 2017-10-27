<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pt extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('pt_m'));
	}

	function index()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 	= "admin/pt/pt_v";
			$data["title_box"] 	= "Data Perguruan Tinggi";
			$data["title_inbox"]= "List Data Perguruan Tinggi";

			$data['query'] = $this->pt_m->getAll_pt();

			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}	
	}

	function hapus($id)
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			
			$this->pt_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');

			redirect('admin/pt', 'refresh');

		}else{
			redirect('admin/login/proses_logout','refresh');
		}

	}

}

/* End of file pt.php */
/* Location: ./application/controllers/admin/pt.php */