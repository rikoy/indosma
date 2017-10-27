<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teman extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('kelas_m', 'teman_m', 'dashboard_m'));
	}

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data["content"] 			= "teman/teman_v";
			$data["title_box"] 			= "Teman";

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$data['query'] = $this->teman_m->getAll();

			$this->load->view('dashboard_v', $data);
		}else{
			redirect('home/logout','refresh');
		}	
	}

	function profil($id)
	{

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "teman/profil_v";
			$data['title_box'] 		= 'Profil';
			
			$data['form_action']		= site_url('pt/update');
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);
			
			$detail = $this->teman_m->get_by_id($id);
			
			$this->session->set_userdata('id_pengguna', $detail->id_pengguna);
			
			$data['default']['id'] 					= $detail->id_pengguna;
			$data['default']['nama_lengkap'] 		= $detail->nama_lengkap;
			$data['default']['foto_profil'] 		= $detail->foto_profil;
			$data['default']['status_pengguna'] 	= $detail->status_pengguna;
			$data['default']['jenis_kelamin'] 		= $detail->jenis_kelamin;
			$data['default']['status_pernikahan'] 	= $detail->status_pernikahan;
			$data['default']['alamat'] 				= $detail->alamat;
			$data['default']['tgl_lahir'] 			= $detail->tgl_lahir;
			$data['default']['email'] 				= $detail->email;
			$data['default']['tentang_pribadi'] 	= $detail->tentang_pribadi;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}	
	}

}

/* End of file teman.php */
/* Location: ./application/controllers/teman.php */