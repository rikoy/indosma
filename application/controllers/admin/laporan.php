<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('pengguna_m', 'pt_m', 'kelas_m'));
	}

	public function index()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			redirect('admin/dashboard','refresh');
		}else{
			redirect('admin/login/proses_logout','refresh');
		}
	}

	function pengguna()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 	= "admin/laporan/form_lap_pengguna";
			$data["title_box"] 	= "Laporan Data Pengguna";
			$data["title_inbox"]= "Form Laporan Data Pengguna";
			$data['form_action']= site_url('admin/laporan/cetak_lap_pengguna');

			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}
	}

	function cetak_lap_pengguna(){
		$this->load->helper('pdf_helper');

		$status_pengguna 	= $this->input->post('status_pengguna');
		$tgl_awal 			= $this->input->post('tgl_awal');
		$tgl_akhir			= $this->input->post('tgl_akhir');

		$ttgl_awal 		= date("Y-m-d", strtotime($tgl_awal));
		$ttgl_akhir		= date("Y-m-d", strtotime($tgl_akhir));

		if(($status_pengguna != "") AND ($tgl_awal != "") AND ($tgl_akhir != "")){
		
			$data['query'] = $this->pengguna_m->print_sp_awal_akhir($status_pengguna, $ttgl_awal, $ttgl_akhir);
		
		}elseif(($status_pengguna != "") AND ($tgl_awal != "") AND ($tgl_akhir == "")){
		
			$data['query'] = $this->pengguna_m->print_sp_awal($status_pengguna, $ttgl_awal);
		
		}elseif(($status_pengguna != "") AND ($tgl_awal == "") AND ($tgl_akhir == "")){
		
			$data['query'] = $this->pengguna_m->print_sp($status_pengguna);
		
		}elseif(($status_pengguna != "") AND ($tgl_awal == "") AND ($tgl_akhir != "")){
		
			$data['query'] = $this->pengguna_m->print_sp_akhir($status_pengguna, $ttgl_akhir);
		
		}elseif(($status_pengguna == "") AND ($tgl_awal == "") AND ($tgl_akhir != "")){
		
			$data['query'] = $this->pengguna_m->print_akhir($ttgl_akhir);
		
		}elseif(($status_pengguna == "") AND ($tgl_awal != "") AND ($tgl_akhir == "")){
		
			$data['query'] = $this->pengguna_m->print_awal($ttgl_awal);
		
		}elseif(($status_pengguna == "") AND ($tgl_awal != "") AND ($tgl_akhir != "")){

			$data['query'] = $this->pengguna_m->print_awal_akhir($ttgl_awal, $ttgl_akhir);
		
		}else{

			$data['query'] = $this->pengguna_m->getAll_user();
		
		}
		
		$this->load->view("admin/laporan/print_pengguna_v", $data);
	}

	function pt()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 	= "admin/laporan/form_lap_pt";
			$data["title_box"] 	= "Laporan Data Perguruan Tinggi";
			$data["title_inbox"]= "Form Laporan Data Perguruan Tinggi";
			$data['form_action']= site_url('admin/laporan/cetak_lap_pt');

			
			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}
	}

	function cetak_lap_pt(){
		$this->load->helper('pdf_helper');

		$tgl_awal 		= $this->input->post('tgl_awal');
		$tgl_akhir		= $this->input->post('tgl_akhir');

		$ttgl_awal 		= date("Y-m-d", strtotime($tgl_awal));
		$ttgl_akhir		= date("Y-m-d", strtotime($tgl_akhir));

		if(($tgl_awal == "") AND ($tgl_akhir != "")){
		
			$data['query'] = $this->pt_m->print_akhir($ttgl_akhir);
		
		}elseif(($tgl_awal != "") AND ($tgl_akhir == "")){
		
			$data['query'] = $this->pt_m->print_awal($ttgl_awal);
		
		}elseif(($tgl_awal != "") AND ($tgl_akhir != "")){

			$data['query'] = $this->pt_m->print_awal_akhir($ttgl_awal, $ttgl_akhir);
		
		}else{

			$data['query'] = $this->pt_m->print_all();
		
		}
		
		$this->load->view("admin/laporan/print_pt_v", $data);
	}

	function kelas()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			$data["content"] 	= "admin/laporan/form_lap_kelas";
			$data["title_box"] 	= "Laporan Data Kelas";
			$data["title_inbox"]= "Form Laporan Data Kelas";
			$data['form_action']= site_url('admin/laporan/cetak_lap_kelas');

			
			
			$this->load->view('admin/layout_v', $data);
		}else{
			redirect('admin/login/proses_logout','refresh');
		}
	}

	function cetak_lap_kelas(){
		$this->load->helper('pdf_helper');

		$tgl_awal 		= $this->input->post('tgl_awal');
		$tgl_akhir		= $this->input->post('tgl_akhir');

		$ttgl_awal 		= date("Y-m-d", strtotime($tgl_awal));
		$ttgl_akhir		= date("Y-m-d", strtotime($tgl_akhir));

		if(($tgl_awal == "") AND ($tgl_akhir != "")){
		
			$data['query'] = $this->kelas_m->print_akhir($ttgl_akhir);
		
		}elseif(($tgl_awal != "") AND ($tgl_akhir == "")){
		
			$data['query'] = $this->kelas_m->print_awal($ttgl_awal);
		
		}elseif(($tgl_awal != "") AND ($tgl_akhir != "")){

			$data['query'] = $this->kelas_m->print_awal_akhir($ttgl_awal, $ttgl_akhir);
		
		}else{

			$data['query'] = $this->kelas_m->print_all();
		
		}
		
		$this->load->view("admin/laporan/print_kelas_v", $data);
	}

}

/* End of file laporan.php */
/* Location: ./application/controllers/admin/laporan.php */