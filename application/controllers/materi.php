<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('kelas_m', 'dashboard_m', 'materi_m'));
	}

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data["content"] 			= "kelas/kelas_v";
			$data["title_box"] 			= "Kelas";

			$data['query'] = $this->kelas_m->getAll();

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

	public function dashboard()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
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

	function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "materi/form";
			$data['title_box'] 		= 'Tambah Data Materi';
			$data['form_action']	= site_url('materi/insert');
			// $data['link_back'] 		= array('link_back' => anchor('materi','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$this->load->view("dashboard_v",$data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	function insert()
	{
		$idp = $this->session->userdata('idp');
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "materi/form";
			$data['title_box'] 		= 'Tambah Data Materi';
			$data['form_action']	= site_url('materi/insert');
			// $data['link_back'] 		= array('link_back' => anchor('materi','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			// validasi
			$this->form_validation->set_rules('nama_materi','Nama Materi', 'required|callback_valid_namamateri');
			$this->form_validation->set_rules('isi_materi','Isi Materi', 'required');
	        
	        //datetime
	        date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$kdk = $this->input->post('kode_kelas');

			if($this->form_validation->run() === TRUE) {
				$file_materi = $this->materi_m->do_upload('file_materi');
				
				if(!$file_materi){

		        	$data = array('isi_materi' 		=> $this->input->post('isi_materi'),
		        					'nama_materi' 	=> $this->input->post('nama_materi'),
		        					'id_pengguna' 	=> $this->input->post('id_pengguna'),
		        					'kode_kelas' 	=> $this->input->post('kode_kelas'),
		        					'datecreated'	=> $datetime
		        					);

		        	//notifikasi
					$query_pengguna = $this->db->query("SELECT b.id_pengguna FROM kelas_pengguna AS a  LEFT JOIN pengguna AS b ON b.id_pengguna = a.id_pengguna
															WHERE b.id_pengguna != '$idp' AND kode_kelas = '$kdk'");

					foreach ($query_pengguna->result() as $row)
					{
					   $data_notifikasi = array(
						   'id_pengguna' 		=> $row->id_pengguna,
						   'tipe_notifikasi' 	=> 'materi',
						   'status_notifikasi' 	=> 'Ada materi baru',
						   'deskripsi' 			=> 'Mendapat materi baru',
						   'kode_mark'			=> $this->input->post('kode_kelas'),
						   'id_pemeberitahuan'	=> $this->input->post('nama_materi'),
						   'datecreated' 		=> $datetime
						);

						$this->db->insert('notifikasi', $data_notifikasi); 
					}

		        }else{
		        	$data = array('isi_materi' 		=> $this->input->post('isi_materi'),
		        					'nama_materi' 	=> $this->input->post('nama_materi'),
		        					'id_pengguna' 	=> $this->input->post('id_pengguna'),
		        					'kode_kelas' 	=> $this->input->post('kode_kelas'),
		        					'datecreated'	=> $datetime,
		        					'file_materi' 	=> $file_materi
		        					);

		        	//notifikasi
					$query_pengguna = $this->db->query("SELECT b.id_pengguna FROM kelas_pengguna AS a  LEFT JOIN pengguna AS b ON b.id_pengguna = a.id_pengguna
															WHERE b.id_pengguna != '$idp' AND kode_kelas = '$kdk'");

					foreach ($query_pengguna->result() as $row)
					{
					   $data_notifikasi = array(
						   'id_pengguna' 		=> $row->id_pengguna,
						   'tipe_notifikasi' 	=> 'materi',
						   'status_notifikasi' 	=> 'Ada materi baru',
						   'deskripsi' 			=> 'Mendapat materi baru',
						   'kode_mark'			=> $this->input->post('kode_kelas'),
						   'id_pemeberitahuan'	=> $this->input->post('nama_materi'),
						   'datecreated' 		=> $datetime
						);

						$this->db->insert('notifikasi', $data_notifikasi); 
					}

		        }
				
				$this->materi_m->add($data);

	        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
				redirect('kelas/masuk/'.$kdk.'', 'refresh');
	        }else{
	        	$this->session->set_flashdata('message', 'Gagal disimpan. Nama sudah ada');
				redirect('materi/tambah/'.$kdk.'', 'refresh');
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}

	}

	function ubah($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "materi/form";
			$data['title_box'] 		= 'Edit Data Materi';
			$data['form_action']	= site_url('materi/update');
			// $data['link_back'] 		= array('link_back' => anchor('materi','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);
			
			$detail = $this->materi_m->get_by_id($id);
			
			$this->session->set_userdata('id_materi', $detail->id_materi);

			$data['default']['id'] 			= $detail->id_materi;
			$data['default']['nama_materi'] = $detail->nama_materi;
			$data['default']['isi_materi'] 	= $detail->isi_materi;
			$data['default']['file_materi'] = $detail->file_materi;
			$data['default']['kode_kelas'] 	= $detail->kode_kelas;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses edit data
	function update(){

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "materi/form";
			$data['title_box'] 		= 'Edit Data Materi';
			$data['form_action']	= site_url('materi/update');
			// $data['link_back'] 		= array('link_back' => anchor('materi','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);
			
			$this->form_validation->set_rules('nama_materi','Nama Materi', 'required|callback_valid_namamateri_edit');
			$this->form_validation->set_rules('isi_materi','Isi Materi', 'required');
	        
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$kdk = $this->input->post('kode_kelas');

	        if($this->form_validation->run() === TRUE) {

				$file_materi = $this->materi_m->do_upload('file_materi');
				
				if(!$file_materi){

		        	$data = array('isi_materi' 		=> $this->input->post('isi_materi'),
		        					'nama_materi' 	=> $this->input->post('nama_materi'),
		        					'id_pengguna' 	=> $this->input->post('id_pengguna'),
		        					'kode_kelas' 	=> $this->input->post('kode_kelas'),
		        					'datecreated'	=> $datetime
		        					);

		        }else{
		        	$data = array('isi_materi' 		=> $this->input->post('isi_materi'),
		        					'nama_materi' 	=> $this->input->post('nama_materi'),
		        					'id_pengguna' 	=> $this->input->post('id_pengguna'),
		        					'kode_kelas' 	=> $this->input->post('kode_kelas'),
		        					'datecreated'	=> $datetime,
		        					'file_materi' 	=> $file_materi
		        					);
		        }

				$this->materi_m->update($this->session->userdata('id_materi'), $data);
				
				$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
			
	        	redirect('kelas/masuk/'.$kdk.'', 'refresh');
	 		}else{
	        	$this->session->set_flashdata('message', 'Gagal disimpan. Nama sudah ada');
				redirect('materi/tambah/'.$kdk.'', 'refresh');
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}
	}

	// menampilkan form edit
	function detail($id, $kdk)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "materi/detail_v";
			$data['title_box'] 		= 'Data Materi';
			$data['link_back'] 		= array('link_back' => anchor('kelas/masuk/'.$kdk.'','Kembali', array('class' => 'btn btn-default btn-xs')));
			
			$detail = $this->materi_m->get_by_id($id);
			
			$this->session->set_userdata('id_materi', $detail->id_materi);

			$data['default']['id'] 			= $detail->id_materi;
			$data['default']['nama_materi'] = $detail->nama_materi;
			$data['default']['isi_materi'] 	= $detail->isi_materi;
			$data['default']['file_materi'] = $detail->file_materi;
			$data['default']['kode_kelas'] 	= $detail->kode_kelas;
			$data['default']['datecreated'] = $detail->datecreated;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	// validasi unique inputan, ketika di tambah
	function valid_namamateri($nama_materi)
	{
		if ($this->materi_m->valid_namamateri($nama_materi) == TRUE)
		{
			$this->form_validation->set_message('valid_namamateri', "Nama materi $nama_materi sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

	// validasi unique inputan, ketika di edit
	function valid_namamateri_edit()
	{
		$current_id = $this->session->userdata('id_materi');
		$detail 	= $this->materi_m->get_by_id($current_id);
		
		$current	= $detail->nama_materi;
		$nama_materi = $this->input->post('nama_materi');
				
		if ($nama_materi == $current)
		{
			return TRUE;
		}
		else
		{
			if($this->materi_m->valid_namamateri($nama_materi) === TRUE)
			{
				$this->form_validation->set_message('valid_namamateri_edit', "Judul memo $nama_materi sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

	// proses delete data
	function hapus($id, $kdk)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->materi_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			redirect('kelas/masuk/'.$kdk.'', 'refresh');

		}else{
			redirect('home/logout','refresh');
		}
	}

	function download($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->load->helper('download');

			$detail = $this->materi_m->get_by_id($id);
			
			$this->session->set_userdata('file_materi', $detail->file_materi);
			$file = $this->session->userdata('file_materi');

			if ($file != "") {
				$data = file_get_contents(base_url()."materi/".$file.""); // Read the file's contents
				$name = $file;

				force_download($name, $data);
				redirect('kelas/masuk/'.$id.'', 'refresh');
			}else{
				$this->session->set_flashdata('message', 'File tidak ditemukan');
			
	        	redirect('kelas/masuk/'.$id.'', 'refresh');
			}

		}else{
			redirect('home/logout','refresh');
		}
	}

}

/* End of file materi.php */
/* Location: ./application/controllers/materi.php */