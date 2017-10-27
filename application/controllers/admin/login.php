<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model('pengguna_m');
	}

	public function index()
	{
		$this->masuk();
	}

	public function masuk()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			redirect('admin/dashboard','refresh');
		}else{
			
			$data['title']		= "Sistem Interaksi Dosen dan Mahasiswa";	
			$data['title_box']	= "Login";	
			$data['form_login']	= site_url('admin/login/proses_login');

			$this->load->view('admin/login_v', $data);
		
		}	
	}

	function proses_login()
	{
		$data['form_login']		= site_url('admin/login/proses_login');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/login_v', $data);	
		}else{
			$u = $this->input->post('username');
			$p = $this->input->post('password');
			$this->pengguna_m->getLoginAdmin($u,$p);
		}
	}

	public function proses_logout(){
		$this->session->sess_destroy();
		header('location:'.base_url().'admin/login/masuk');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */