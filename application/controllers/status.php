<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status extends CI_Controller {

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
		$idp = $this->session->userdata('idp');

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$data = array('id_pengguna' 	=> $this->input->post('id_pengguna'),
	    					'kode_pt' 	=> $this->input->post('kode_pt'),
	    					'isi_status' 	=> $this->input->post('isi_status'),
	    					'datecreated'	=> $datetime
						);
			$this->status_m->add($data);

	    	/*$this->session->set_flashdata('message', 'Pesan berhasil dikirm');
			redirect('pesan', 'refresh');*/

			//notifikasi
			$query_pengguna = $this->db->query("SELECT b.id_pengguna FROM pt_pengguna AS a
									LEFT JOIN pengguna AS b ON b.id_pengguna = a.id_pengguna 
									WHERE b.id_pengguna != '$idp' AND kode_pt IN
                            			(SELECT kode_pt FROM pt_pengguna WHERE id_pengguna = '$idp') GROUP BY b.id_pengguna");

			foreach ($query_pengguna->result() as $row)
			{
			   $data_notifikasi = array(
				   'id_pengguna' 		=> $row->id_pengguna,
				   'tipe_notifikasi' 	=> 'status' ,
				   'status_notifikasi' 	=> 'Membuat status baru',
				   'deskripsi' 			=> $this->input->post('isi_status'),
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
		$idp = $this->session->userdata('idp');

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$data = array('id_pengguna' 	=> $this->input->post('id_pengguna'),
	    					'id_status' 	=> $this->input->post('id_status'),
	    					'isi_komentar' 	=> $this->input->post('isi_komentar'),
	    					'datecreated'	=> $datetime
						);
			$this->status_m->add_komen($data);

	    	/*$this->session->set_flashdata('message', 'Pesan berhasil dikirm');
			redirect('pesan', 'refresh');*/

			//notifikasi
			$ids = $this->input->post('id_status');

			$query_pengguna1 = $this->db->query("SELECT id_pengguna FROM status WHERE id_status = '$ids' AND id_pengguna != '$idp' GROUP BY id_pengguna");
		
			if ($query_pengguna1->num_rows() > 0)
			{
				foreach ($query_pengguna1->result() as $row1)
				{
				   $data_notifikasi1 = array(
					   'id_pengguna' 			=> $row1->id_pengguna,
					   'tipe_notifikasi' 		=> 'komentar' ,
					   'status_notifikasi' 		=> 'Mengomentari status',
					   'deskripsi' 				=> $this->input->post('isi_komentar'),
					   'id_pemeberitahuan' 		=> $this->input->post('id_status'),
					   'datecreated' 			=> $datetime
					);

					$this->db->insert('notifikasi', $data_notifikasi1); 
				}
			}

			$query_pengguna = $this->db->query("SELECT id_pengguna FROM komentar_status WHERE id_status = '$ids' AND id_pengguna != '$idp' GROUP BY id_pengguna");

			if ($query_pengguna->num_rows() > 0)
			{
				foreach ($query_pengguna->result() as $row)
				{
				   $data_notifikasi = array(
					   'id_pengguna' 			=> $row->id_pengguna,
					   'tipe_notifikasi' 		=> 'komentar' ,
					   'status_notifikasi' 		=> 'Mengomentari status',
					   'deskripsi' 				=> $this->input->post('isi_komentar'),
					   'id_pemeberitahuan' 		=> $this->input->post('id_status'),
					   'datecreated' 			=> $datetime
					);

					$this->db->insert('notifikasi', $data_notifikasi); 
				}
			}

		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses delete data
	function hapus_status($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->status_m->delete($id);
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

			$this->status_m->delete_komen($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			
		}else{
			redirect('home/logout','refresh');
		}
	}

}

/* End of file status.php */
/* Location: ./application/controllers/status.php */