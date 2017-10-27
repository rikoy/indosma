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
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			redirect('dashboard','refresh');
		}else{
			$data['form_daftar']	= site_url('home/registrasi');
			$data['form_login']		= site_url('home/login');

			$this->load->view('home_v', $data);
		}

	}

	function registrasi()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			redirect('dashboard','refresh');
		}else{

			$data['form_daftar']	= site_url('home/registrasi');
			
			// validasi
			$this->form_validation->set_rules('id_pengguna','No. Identitas', 'required|callback_valid_idpengguna');
			$this->form_validation->set_rules('username','Username', 'required|callback_valid_username');
			$this->form_validation->set_rules('email','Email', 'required|callback_valid_email');
	        // $this->form_validation->set_error_delimiters('<div class="alert alert-danger catatan-form" style="margin-bottom: 0;"> ', '</div><br>');
	        $this->form_validation->set_error_delimiters('<li>', '</li>');
			
			$datetime = date("Y-m-d H:i:s");
	        if($this->form_validation->run() === TRUE) {
	        	$data = array('id_pengguna' => $this->input->post('id_pengguna'),
	        					'username' => $this->input->post('username'),
	        					'password' => md5($this->input->post('password')),
	        					'email' => $this->input->post('email'),
	        					'nama_lengkap' => $this->input->post('nama_lengkap'),
	        					'status_pengguna' => $this->input->post('status_pengguna'),
	        					'status_verifikasi' => '0',
	        					'datecreated' => $datetime
	        				);

				$this->pengguna_m->add($data);

				$sess_data['logged_in'] 		= 'sayasedanglogin';
				$sess_data['id_pengguna'] 		= $this->input->post('id_pengguna');
				$sess_data['idp'] 				= $this->input->post('id_pengguna');
				$sess_data['nama_lengkap'] 		= $this->input->post('nama_lengkap');
				$sess_data['status_pengguna'] 	= $this->input->post('status_pengguna');
				$sess_data['avatar'] 			= 'avatar.jpg';
				$this->session->set_userdata($sess_data);

				//insert data login 
				date_default_timezone_set('Asia/Jakarta');
				$now = date("Y-m-d");
				$jam = date("H:i:s");

				//get ip address
				$ip = $this->session->userdata('ip_address');
				//get session
				$sessionid = $this->session->userdata('session_id');
				//get user agen
				$user_agent = $this->session->userdata('user_agent');

				$data = array('date' 			=> $now,
								'session_kode'	=> $sessionid,
								'id_pengguna'	=> $this->input->post('id_pengguna'),
								'ip_login'		=> $ip,
								'user_agent'	=> $user_agent,
								'time' 			=> $jam);

				$this->db->insert('session_login', $data);

	        	$this->session->set_flashdata('message', 'Selamat bergabung dengan inDosma');
				redirect('dashboard', 'refresh');
	        }else{

	        	$data['default']['username'] 		= $this->input->post('username');
				$data['default']['email'] 			= $this->input->post('email');
				$data['default']['nama_lengkap'] 	= $this->input->post('nama_lengkap');

				$this->daftar();	
	   		}
	   	}

	}

	function daftar(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			redirect('dashboard','refresh');
		}else{

			$data['form_daftar']	= site_url('home/registrasi');
			$data['form_login']		= site_url('home/login');
			$this->load->view('daftar_v', $data);
		}
	}

	function masuk()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			redirect('dashboard','refresh');
		}else{

			$data['form_daftar']	= site_url('home/registrasi');
			$data['form_login']		= site_url('home/login');
			$this->load->view('login_v', $data);
		}
	}

	function login()
	{
		$data['form_daftar']	= site_url('home/registrasi');
		$data['form_login']		= site_url('home/login');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('login_v', $data);	
		}else{
			$u = $this->input->post('username');
			$p = $this->input->post('password');
			$this->pengguna_m->getLoginData($u,$p);

			// $this->db->delete('notifikasi', array('status_dilihat' => '1')); 
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		header('location:'.base_url());
	}

	// validasi unique inputan, ketika di tambah
	function valid_idpengguna($id_pengguna)
	{
		if ($this->pengguna_m->valid_idpengguna($id_pengguna) == TRUE)
		{
			$this->form_validation->set_message('valid_idpengguna', "Nomor Identitas $id_pengguna sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

	// validasi unique inputan, ketika di tambah
	function valid_username($username)
	{
		if ($this->pengguna_m->valid_username($username) == TRUE)
		{
			$this->form_validation->set_message('valid_username', "Username $username sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

	// validasi unique inputan, ketika di tambah
	function valid_email($email)
	{
		if ($this->pengguna_m->valid_email($email) == TRUE)
		{
			$this->form_validation->set_message('valid_email', "Email $email sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */