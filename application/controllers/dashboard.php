<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	// construktor memanggil model dan library
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));

		$this->load->model(array('dashboard_m', 'status_m'));
	}

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data["content"] 			= "kantin/kantin_v";
			$data["title_box"] 			= "Kantin";

			// $data['query_status'] = $this->status_m->getAll();

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$this->load->view('dashboard_v', $data);
		}else{
			redirect('home/logout','refresh');
		}	
	}

	public function show_pt()
	{
		$id = $this->uri->segment(3);
		$combo_level = $this->uri->segment(4);
		$childs = $this->dashboard_m->get_pt($id);
		if(count($childs) > 0)
		{	
			echo '<div class="well"> <div class="row"> <div class="col-xs-6">';
				echo "<h4>".$childs->nama_pt."</h4>";
				echo "<p>".$childs->alamat_pt."<br> Kode POS: ".$childs->kode_pos_pt."<br> Telepon: ".$childs->no_telp_pt."</p>";
			echo '</div></div></div>';
		}
		else
		{
			echo '<input id="nama_pt" name="nama_pt" class="form-control" type="text" style="display: none;" class="input-large" required="required">';
			echo '<div class="alert alert-danger"> <i class="icon-ban-circle"></i><strong>Data tidak ditemukan</strong> </div>';
		}
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */