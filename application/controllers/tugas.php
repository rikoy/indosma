<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tugas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('kelas_m', 'dashboard_m', 'materi_m', 'tugas_m'));
	}

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data['content']			= 'tugas/tugas_v';
			$data['title_box'] 			= 'Tugas';

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$data['query'] = $this->tugas_m->getAll();

			$this->load->view('dashboard_v', $data);
		}else{
			redirect('home/logout','refresh');
		}	
	}

	function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "tugas/form";
			$data['title_box'] 		= 'Tambah Data Tugas';
			$data['form_action']	= site_url('tugas/insert');
			// $data['link_back'] 		= array('link_back' => anchor('tugas','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
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

			$data["content"] 		= "tugas/form";
			$data['title_box'] 		= 'Tambah Data Tugas';
			$data['form_action']	= site_url('tugas/insert');
			// $data['link_back'] 		= array('link_back' => anchor('materi','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			// validasi
			$this->form_validation->set_rules('nama_tugas','Nama Tugas', 'required|callback_valid_namatugas');
			$this->form_validation->set_rules('isi_tugas','Isi Tugas', 'required');
	        
	        //datetime
	        date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$kdk = $this->input->post('kode_kelas');

			if($this->form_validation->run() === TRUE) {
				$file_tugas = $this->tugas_m->do_upload('file_tugas');
				
				if(!$file_tugas){

		        	$data = array('isi_tugas' 			=> $this->input->post('isi_tugas'),
		        					'nama_tugas' 		=> $this->input->post('nama_tugas'),
		        					'id_pengguna' 		=> $this->input->post('id_pengguna'),
		        					'kode_kelas' 		=> $this->input->post('kode_kelas'),
		        					'batas_pengumpulan' => date("Y-m-d", strtotime($this->input->post('batas_pengumpulan'))),
		        					'datecreated'		=> $datetime
		        					);

		        	//notifikasi
					$query_pengguna = $this->db->query("SELECT b.id_pengguna FROM kelas_pengguna AS a  LEFT JOIN pengguna AS b ON b.id_pengguna = a.id_pengguna
															WHERE b.id_pengguna != '$idp' AND kode_kelas = '$kdk'");

					foreach ($query_pengguna->result() as $row)
					{
					   $data_notifikasi = array(
						   'id_pengguna' 		=> $row->id_pengguna,
						   'tipe_notifikasi' 	=> 'tugas',
						   'status_notifikasi' 	=> 'Ada tugas baru',
						   'deskripsi' 			=> 'Mendapat tugas baru',
						   'kode_mark'			=> $this->input->post('kode_kelas'),
						   'id_pemeberitahuan'	=> $this->input->post('nama_tugas'),
						   'datecreated' 		=> $datetime
						);

						$this->db->insert('notifikasi', $data_notifikasi); 
					}

		        }else{
		        	$data = array('isi_tugas' 			=> $this->input->post('isi_tugas'),
		        					'nama_tugas' 		=> $this->input->post('nama_tugas'),
		        					'id_pengguna' 		=> $this->input->post('id_pengguna'),
		        					'kode_kelas' 		=> $this->input->post('kode_kelas'),
		        					'datecreated'		=> $datetime,
		        					'batas_pengumpulan' => date("Y-m-d", strtotime($this->input->post('batas_pengumpulan'))),
		        					'file_tugas' 		=> $file_tugas
		        					);

		        	//notifikasi
					$query_pengguna = $this->db->query("SELECT b.id_pengguna FROM kelas_pengguna AS a  LEFT JOIN pengguna AS b ON b.id_pengguna = a.id_pengguna
															WHERE b.id_pengguna != '$idp' AND kode_kelas = '$kdk'");

					foreach ($query_pengguna->result() as $row)
					{
					   $data_notifikasi = array(
						   'id_pengguna' 		=> $row->id_pengguna,
						   'tipe_notifikasi' 	=> 'tugas',
						   'status_notifikasi' 	=> 'Ada tugas baru',
						   'deskripsi' 			=> 'Mendapat tugas baru',
						   'kode_mark'			=> $this->input->post('kode_kelas'),
						   'id_pemeberitahuan'	=> $this->input->post('nama_tugas'),
						   'datecreated' 		=> $datetime
						);

						$this->db->insert('notifikasi', $data_notifikasi); 
					}

		        }
				
				$this->tugas_m->add($data);

	        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
				redirect('kelas/masuk/'.$kdk.'', 'refresh');
	        }else{
	        	$this->session->set_flashdata('message', 'Gagal disimpan. Nama sudah ada');
				redirect('tugas/tambah/'.$kdk.'', 'refresh');
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}	

	}

	function ubah($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "tugas/form";
			$data['title_box'] 		= 'Edit Data Tugas';
			$data['form_action']	= site_url('tugas/update');
			// $data['link_back'] 		= array('link_back' => anchor('materi','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);
			
			$detail = $this->tugas_m->get_by_id($id);
			
			$this->session->set_userdata('id_tugas', $detail->id_tugas);

			$data['default']['id'] 					= $detail->id_tugas;
			$data['default']['isi_tugas'] 			= $detail->isi_tugas;
			$data['default']['kode_kelas'] 			= $detail->kode_kelas;
			$data['default']['nama_tugas'] 			= $detail->nama_tugas;
			$data['default']['batas_pengumpulan'] 	= date("m/d/Y", strtotime($detail->batas_pengumpulan));
			$data['default']['file_tugas'] 			= $detail->file_tugas;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}	
	}

	// proses edit data
	function update(){

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "tugas/form";
			$data['title_box'] 		= 'Edit Data Tugas';
			$data['form_action']	= site_url('tugas/update');
			// $data['link_back'] 		= array('link_back' => anchor('materi','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);
			
			// validasi
			$this->form_validation->set_rules('nama_tugas','Nama Tugas', 'required|callback_valid_namatugas_edit');
			$this->form_validation->set_rules('isi_tugas','Isi Tugas', 'required');
	        
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

			$kdk = $this->input->post('kode_kelas');

	        if($this->form_validation->run() === TRUE) {

				$file_tugas = $this->tugas_m->do_upload('file_tugas');
				
				if(!$file_tugas){

		        	$data = array('isi_tugas' 			=> $this->input->post('isi_tugas'),
		        					'nama_tugas' 		=> $this->input->post('nama_tugas'),
		        					'id_pengguna' 		=> $this->input->post('id_pengguna'),
		        					'kode_kelas' 		=> $this->input->post('kode_kelas'),
		        					'batas_pengumpulan' => date("Y-m-d", strtotime($this->input->post('batas_pengumpulan'))),
		        					'datecreated'		=> $datetime
		        					);

		        }else{
		        	$data = array('isi_tugas' 			=> $this->input->post('isi_tugas'),
		        					'nama_tugas' 		=> $this->input->post('nama_tugas'),
		        					'id_pengguna' 		=> $this->input->post('id_pengguna'),
		        					'kode_kelas' 		=> $this->input->post('kode_kelas'),
		        					'datecreated'		=> $datetime,
		        					'batas_pengumpulan' => date("Y-m-d", strtotime($this->input->post('batas_pengumpulan'))),
		        					'file_tugas' 		=> $file_tugas
		        					);
		        }

				$this->tugas_m->update($this->session->userdata('id_tugas'), $data);
				
				$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
			
	        	redirect('kelas/masuk/'.$kdk.'', 'refresh');
	 		}else{
	        	$this->session->set_flashdata('message', 'Gagal disimpan. Nama sudah ada');
				redirect('tugas/ubah/'.$this->session->userdata('id_tugas').'', 'refresh');
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}	
	}

	// menampilkan form edit
	function kumpul($id, $kdk)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "tugas/form_kumpul_tugas";
			$data['title_box'] 		= 'Mengumpulkan Tugas Tugas';
			// $data['link_back'] 		= array('link_back' => anchor('kelas/masuk/'.$kdk.'','Kembali', array('class' => 'btn btn-default btn-xs')));
			$data['form_action']	= site_url('tugas/kirim');

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$detail = $this->tugas_m->get_by_id($id);
			
			$this->session->set_userdata('id_tugas', $detail->id_tugas);

			$data['default']['id'] 			= $detail->id_tugas;
			$data['default']['nama_tugas'] 	= $detail->nama_tugas;
			$data['default']['isi_tugas'] 	= $detail->isi_tugas;
			$data['default']['file_tugas'] 	= $detail->file_tugas;
			$data['default']['kode_kelas'] 	= $detail->kode_kelas;
			$data['default']['datecreated'] = $detail->datecreated;

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

			$file_tugas = $this->tugas_m->do_upload_kumpul_tugas('file_tugas');

			$data = array('id_tugas' 			=> $this->input->post('id'),
	    					'id_pengguna' 		=> $this->input->post('id_pengguna'),
	    					'datecreated'		=> $datetime,
	    					'file_tugas' 		=> $file_tugas
	    					);
		       
			$this->tugas_m->add_kumpul_tugas($data);

			$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
			
	    	redirect('kelas/masuk/'.$this->input->post('kode_kelas').'', 'refresh');

	    }else{
			redirect('home/logout','refresh');
		}	

	}

	function nilai()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data['content']			= 'tugas/form_nilai';
			$data['title_box'] 			= 'Nilai Tugas';

			$data['form_action']		= site_url('tugas/beri_nilai');

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$data['query'] = $this->tugas_m->getAll_nilai_tugas();

			$this->load->view('dashboard_v', $data);
		}else{
			redirect('home/logout','refresh');
		}
	}

	function beri_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$id_pengguna 	= $this->input->post('id_pengguna');
			$nilai_tugas 	= $this->input->post('nilai_tugas');
			$id_tugas 		= $this->input->post('id_tugas');
			$kode_kelas 	= $this->input->post('kode_kelas');

			$data = array();
			if ($nilai_tugas != "") {

				foreach ($nilai_tugas as $key => $value)
				{
		        	$data[] = array('nilai_tugas' 	=> $nilai_tugas[$key],
		        					'id_pengguna' 	=> $id_pengguna[$key],
		        					'id_tugas' 		=> $this->input->post('id_tugas')
		        					);

	 				// $this->tugas_m->beri_nilai($id_pengguna[$key], $data);
					// $this->db->where('id_pengguna', $id_pengguna[$key]);

		        	$this->db->where('id_tugas', $id_tugas);
					
					$this->db->update_batch('nilai_tugas', $data, 'id_pengguna');
		    	}
	 			
	 			$this->session->set_flashdata('message', 'Data berhasil disimpan');
	        	redirect('kelas/masuk/'.$kode_kelas.'', 'refresh');

			}else{
				$this->session->set_flashdata('message', 'Nilai belum dipilih');
				redirect('tugas/nilai/'.$id_tugas.'/'.$kode_kelas.'', 'refresh');
			}
		
		}else{
			redirect('home/logout','refresh');
		}	
	}

	// validasi unique inputan, ketika di tambah
	function valid_namatugas($nama_tugas)
	{
		if ($this->tugas_m->valid_namatugas($nama_tugas) == TRUE)
		{
			$this->form_validation->set_message('valid_namatugas', "Nama tugas $nama_tugas sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

	// validasi unique inputan, ketika di edit
	function valid_namatugas_edit()
	{
		$current_id = $this->session->userdata('id_tugas');
		$detail 	= $this->tugas_m->get_by_id($current_id);
		
		$current	= $detail->nama_tugas;
		$nama_tugas = $this->input->post('nama_tugas');
				
		if ($nama_tugas == $current)
		{
			return TRUE;
		}
		else
		{
			if($this->tugas_m->valid_namatugas($nama_tugas) === TRUE)
			{
				$this->form_validation->set_message('valid_namatugas_edit', "Nama tugas $nama_tugas sudah terdaftar");
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

			$this->tugas_m->delete($id);
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

			$detail = $this->tugas_m->get_by_id($id);
			
			$this->session->set_userdata('file_tugas', $detail->file_tugas);
			$file = $this->session->userdata('file_tugas');

			if ($file != "") {
				$data = file_get_contents(base_url()."tugas/".$file.""); // Read the file's contents
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

	function download_file_tugas($id, $id_tugas, $kode_kelas)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->load->helper('download');

			$detail = $this->tugas_m->get_by_id_nilai($id);
			
			$this->session->set_userdata('file_tugas', $detail->file_tugas);
			$file = $this->session->userdata('file_tugas');

			if ($file != "") {
				$data = file_get_contents(base_url()."tugas_mhs/".$file.""); // Read the file's contents
				$name = $file;

				force_download($name, $data);
				redirect('tugas/nilai/'.$id_tugas.'/'.$kode_kelas.'', 'refresh');
			}else{
				$this->session->set_flashdata('message', 'File tidak ditemukan');
			
	        	redirect('tugas/nilai/'.$id_tugas.'/'.$kode_kelas.'', 'refresh');
			}

		}else{
			redirect('home/logout','refresh');
		}	
	}

	function cetak_nilai($kdk, $id_tugas)
	{
		$this->load->helper('pdf_helper');

		//get nama tugas
		$q_get_nama_tugas = $this->db->query("SELECT a.nama_tugas, b.nama_kelas FROM tugas AS a 
												LEFT JOIN kelas AS b ON a.kode_kelas = b.kode_kelas
												WHERE id_tugas = '$id_tugas'");
		$nmt = $q_get_nama_tugas->row();

		//get data dosen
		$q_get_nama_dosen = $this->db->query("SELECT a.nama_lengkap, a.id_pengguna FROM pengguna AS a
												LEFT JOIN kelas AS b ON a.id_pengguna = b.id_pengguna
												WHERE b.kode_kelas = '$kdk'");
		$nmd = $q_get_nama_dosen->row();

		$data['nama_dosen'] = $nmd->nama_lengkap;
		$data['id_dosen'] 	= $nmd->id_pengguna;

		$data['nama_tugas'] = $nmt->nama_tugas;
		$data['id_tugas'] 	= $id_tugas;
		$data['nama_kelas'] = $nmt->nama_kelas;

		$data['query'] = $this->tugas_m->getAll_mhs($kdk);

		$this->load->view("tugas/print_tugas_v", $data);
	}

}

/* End of file tugas.php */
/* Location: ./application/controllers/tugas.php */