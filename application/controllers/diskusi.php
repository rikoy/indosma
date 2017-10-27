<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diskusi extends CI_Controller {

	// construktor memanggil model dan library
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));

		$this->load->model(array('dashboard_m', 'diskusi_m'));
	}

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data["content"] 			= "kantin/kantin_v";
			$data["title_box"] 			= "Kantin";

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

	function buat()
	{	
		$kdk = $this->input->post('kode_kelas');
		$idp = $this->session->userdata('idp');

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$data = array('id_pengguna' 	=> $this->input->post('id_pengguna'),
	    					'kode_kelas' 	=> $this->input->post('kode_kelas'),
	    					'isi_diskusi' 	=> $this->input->post('isi_diskusi'),
	    					'datecreated'	=> $datetime
						);
			$this->diskusi_m->add($data);

			//notifikasi
			$query_pengguna = $this->db->query("SELECT b.id_pengguna FROM kelas_pengguna AS a  LEFT JOIN pengguna AS b ON b.id_pengguna = a.id_pengguna
													WHERE b.id_pengguna != '$idp' AND kode_kelas = '$kdk'");

			foreach ($query_pengguna->result() as $row)
			{
			   $data_notifikasi = array(
				   'id_pengguna' 		=> $row->id_pengguna,
				   'tipe_notifikasi' 	=> 'diskusi',
				   'status_notifikasi' 	=> 'Ada diskusi baru',
				   'deskripsi' 			=> 'Mendapat diskusi baru',
				   'kode_mark'			=> $this->input->post('kode_kelas'),
				   'datecreated' 		=> $datetime
				);

				$this->db->insert('notifikasi', $data_notifikasi); 
			}

		}else{
			redirect('home/logout','refresh');
		}
	}

	function komen()
	{
		$kdk = $this->input->post('kode_kelas');
		$idp = $this->session->userdata('idp');

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$data = array('id_pengguna' 		=> $this->input->post('id_pengguna'),
	    					'id_diskusi' 		=> $this->input->post('id_diskusi'),
	    					'isi_jawab_diskusi' => $this->input->post('isi_jawab_diskusi'),
	    					'datecreated'		=> $datetime
						);
			$this->diskusi_m->add_komen($data);

			//notifikasi
			$query_pengguna = $this->db->query("SELECT b.id_pengguna FROM kelas_pengguna AS a  LEFT JOIN pengguna AS b ON b.id_pengguna = a.id_pengguna
													WHERE b.id_pengguna != '$idp' AND kode_kelas = '$kdk'");

			foreach ($query_pengguna->result() as $row)
			{
			   $data_notifikasi = array(
				   'id_pengguna' 		=> $row->id_pengguna,
				   'tipe_notifikasi' 	=> 'komendiskusi',
				   'status_notifikasi' 	=> 'Ada komentar diskusi baru',
				   'deskripsi' 			=> 'Mendapat komentar diskusi baru',
				   'kode_mark'			=> $kdk,
				   'datecreated' 		=> $datetime
				);

				$this->db->insert('notifikasi', $data_notifikasi); 
			}

	    	/*$this->session->set_flashdata('message', 'Pesan berhasil dikirm');
			redirect('pesan', 'refresh');*/
		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses delete data
	function hapus_diskusi($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->diskusi_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			
		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses delete data
	function hapus_komen($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->diskusi_m->delete_komen($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			
		}else{
			redirect('home/logout','refresh');
		}
	}

}

/* End of file diskusi.php */
/* Location: ./application/controllers/diskusi.php */