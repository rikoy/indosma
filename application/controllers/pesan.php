<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesan extends CI_Controller {

	// construktor memanggil model dan library
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));

		$this->load->model(array('dashboard_m', 'teman_m', 'pesan_m'));
	}

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data["content"] 			= "pesan/pesan_v";
			$data["title_box"] 			= "Pesan";
			$data["form_action"] 		= "pesan/kirim";

			$data['query'] = $this->pesan_m->getAll();

			// data jabatan untuk dropdown menu
			$nama_pengguna = $this->teman_m->getAll();
			foreach($nama_pengguna as $row)
			{
				$data['options_pengguna'][''] = "Pilih Tujuan Pesan";
				$data['options_pengguna'][$row->id_pengguna] = $row->nama_lengkap;
			}

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

	function kirim()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$data = array('id_pengirim' 	=> $this->input->post('id_pengirim'),
	    					'id_tujuan' 	=> $this->input->post('id_tujuan'),
	    					'judul_pesan' 	=> $this->input->post('judul_pesan'),
	    					'isi_pesan' 	=> $this->input->post('isi_pesan'),
	    					'datecreated'	=> $datetime
						);
			$this->pesan_m->add($data);

			//notifikasi
		   	$data_notifikasi = array(
			   'id_pengguna' 			=> $this->input->post('id_tujuan'),
			   'tipe_notifikasi' 		=> 'pesan' ,
			   'status_notifikasi' 		=> 'Mendapat pesan baru',
			   'deskripsi' 	=> $this->input->post('isi_pesan'),
			   'datecreated' 			=> $datetime
			);

			$this->db->insert('notifikasi', $data_notifikasi); 

	    	/*$this->session->set_flashdata('message', 'Pesan berhasil dikirm');
			redirect('pesan', 'refresh');*/
		}else{
			redirect('home/logout','refresh');
		}
	}

	public function buka($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data["content"] 			= "pesan/detail_v";
			$data["title_box"] 			= "Pesan";
			$data["form_action"] 		= "pesan/balas";

			$detail = $this->pesan_m->get_by_id($id);

			$data['query'] = $this->pesan_m->getAll_jawaban($id);
			
			$this->session->set_userdata('id_pesan', $detail->id_pesan);

			$data['default']['id'] 				= $detail->id_pesan;
			$data['default']['isi_pesan'] 		= $detail->isi_pesan;
			$data['default']['judul_pesan'] 	= $detail->judul_pesan;
			$data['default']['id_pengirim'] 	= $detail->id_pengirim;
			$data['default']['id_tujuan'] 		= $detail->id_tujuan;
			$data['default']['datecreated'] 	= $detail->datecreated;
			$data['default']['foto_profil'] 	= $detail->foto_profil;
			$data['default']['nama_lengkap'] 	= $detail->nama_lengkap;
			$data['default']['status_pengguna'] = $detail->status_pengguna;

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

	function balas()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$id_pesan = $this->input->post('id_pesan');

			$data = array('id_pengirim' 		=> $this->input->post('id_pengirim'),
	    					'id_tujuan' 		=> $this->input->post('id_tujuan'),
	    					'id_pesan' 			=> $this->input->post('id_pesan'),
	    					'isi_jawaban_pesan' => $this->input->post('isi_jawaban_pesan'),
	    					'datecreated'		=> $datetime
						);
			$this->pesan_m->add_jawaban($data);

			//notifikasi
		   	$data_notifikasi = array(
			   'id_pengguna' 			=> $this->input->post('id_tujuan'),
			   'tipe_notifikasi' 		=> 'jawaban' ,
			   'status_notifikasi' 		=> 'Mendapat jawaban pesan',
			   'deskripsi' 				=> $this->input->post('isi_jawaban_pesan'),
			   'datecreated' 			=> $datetime
			);
			$this->db->insert('notifikasi', $data_notifikasi);

			// $this->session->set_flashdata('message', 'Pesan berhasil dikirim');
			// redirect('pesan/buka/'.$id_pesan.'', 'refresh');

		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses delete data
	function hapus_pesan($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->pesan_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			
		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses delete data
	function hapus_jawaban($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->pesan_m->delete_jawaban($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			
		
		}else{
			redirect('home/logout','refresh');
		}
	}

}

/* End of file pesan.php */
/* Location: ./application/controllers/pesan.php */