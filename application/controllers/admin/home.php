<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
			redirect('admin/dashboard','refresh');
		}else{
			$data['title_box']	= "Login";	
			$data['form_login']	= site_url('admin/login/proses_login');

			$this->load->view('admin/login_v', $data);
		}

	}

}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */