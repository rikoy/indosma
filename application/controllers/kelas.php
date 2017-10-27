<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas extends CI_Controller {

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

	function masuk($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 			= "kelas/detail_v";
			$data["title_box"] 			= "Kelas";

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$data['query_materi'] = $this->materi_m->getAll();
			$data['query_tugas'] = $this->tugas_m->getAll();

			$detail = $this->kelas_m->get_detail_id($id);
			
			$this->session->set_userdata('kode_kelas', $detail->kode_kelas);

			$data['default']['id'] 				= $detail->kode_kelas;
			$data['default']['nama_kelas'] 		= $detail->nama_kelas;
			$data['default']['jurusan'] 		= $detail->jurusan;
			$data['default']['nama_lengkap'] 	= $detail->nama_lengkap;
			$data['default']['foto_profil'] 	= $detail->foto_profil;
			$data['default']['status_pengguna'] = $detail->status_pengguna;

			$this->load->view('dashboard_v', $data);
		}else{
			redirect('home/logout','refresh');
		}
	}

	function insert()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data['form_daftar']	= site_url('home/registrasi');
				
			// validasi
			$this->form_validation->set_rules('nama_kelas','Nama Perguruan Tinggi', 'required|callback_valid_nama_kelas');
	        // $this->form_validation->set_error_delimiters('<div class="alert alert-danger catatan-form" style="margin-bottom: 0;"> ', '</div><br>');
	        // $this->form_validation->set_error_delimiters('<li>', '</li>');
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");
			$n = rand(10e16, 10e20);
	        $kode_kelas = base_convert($n, 6, 36);
	        if($this->form_validation->run() === TRUE) {
	        	$data = array('id_pengguna' => $this->input->post('id_pengguna'),
	        					'nama_kelas' => $this->input->post('nama_kelas'),
	        					'kode_pt' => $this->input->post('kode_pt'),
	        					'jurusan' => $this->input->post('jurusan'),
	        					'kode_kelas' => $kode_kelas,
	        					'datecreated' => $datetime
	        				);

	        	$data_kelas_pengguna = array('id_pengguna' => $this->input->post('id_pengguna'),
	        								'kode_pt' => $this->input->post('kode_pt'),
	        								'kode_kelas' => $kode_kelas
	        							);

				$this->kelas_m->add($data);
				$this->kelas_m->add_kelas_pengguna($data_kelas_pengguna);

	        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
				redirect('dashboard', 'refresh');
	        }else{

	        	$data['default']['nama_kelas'] 	= $this->input->post('nama_kelas');
				$data['default']['jurusan'] 	= $this->input->post('jurusan');

				$this->index();	
	   		}
		
		}else{
			redirect('home/logout','refresh');
		}
	}

	function insert_cari_kelas()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$kode_kelas = $this->input->post('kode_kelas');

			$data = array();
			if ($kode_kelas != "") {
				foreach ($kode_kelas as $key => $value)
				{
		        	$data[] = array('kode_kelas' 	=> $kode_kelas[$key],
		        					'kode_pt' 		=> $this->input->post('kode_pt'),
		        					'id_pengguna' 	=> $this->input->post('id_pengguna')
		        					);
		        }

		    	$this->kelas_m->addSelect($data);
	        	// $this->db->insert_batch('disposisi_surat', $data);
				
	        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
	        	redirect('kelas', 'refresh');

			}else{
				$this->session->set_flashdata('message', 'Kelas belum dipilih');
				redirect('kelas', 'refresh');
			}

		}else{
			redirect('home/logout','refresh');
		}
	}

	function ubah($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 			= "kelas/form";
			$data["title_box"] 			= "Edit Data Kelas";
			$data['link_back'] 			= array('link_back' => anchor('kelas','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_action']		= site_url('kelas/update');

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$detail = $this->kelas_m->get_by_id($id);
			
			$this->session->set_userdata('kode_kelas', $detail->kode_kelas);

			$data['default']['id'] 			= $detail->kode_kelas;
			$data['default']['nama_kelas'] 	= $detail->nama_kelas;
			$data['default']['jurusan'] 	= $detail->jurusan;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses edit data
	function update(){

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data['content'] 		= 'kelas/form';
			$data['title_box'] 		= 'Edit Data Kelas';
			$data['form_action']	= site_url('kelas/update');
			$data['link_back'] 		= array('link_back' => anchor('kelas','Kembali', array('class' => 'btn btn-default btn-sm"')));
			

			$this->form_validation->set_rules('nama_kelas','Nama Kelas', 'required|callback_valid_nama_kelas_edit');
			$this->form_validation->set_rules('jurusan','Jurusan', 'required');
	        
	        if($this->form_validation->run() === TRUE) {
				$data = array('nama_kelas' => $this->input->post('nama_kelas'),
	        					'jurusan' => $this->input->post('jurusan'));

				$this->kelas_m->update($this->session->userdata('kode_kelas'), $data);
				
				$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
			
	        	redirect('kelas', 'refresh');
	 		}else{
	        	$this->load->view('dashboard_v', $data);
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}
	}

	// proses delete data
	function hapus($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->kelas_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			redirect('kelas', 'refresh');

		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses delete data
	function hapus_kelas($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$this->kelas_m->delete_kelas($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			redirect('kelas', 'refresh');

		}else{
			redirect('home/logout','refresh');
		}
	}

	// validasi unique inputan, ketika di tambah
	function valid_nama_kelas($nama_kelas)
	{
		if ($this->kelas_m->valid_nama_kelas($nama_kelas) == TRUE)
		{
			$this->form_validation->set_message('valid_nama_kelas', "Nama Kelas $nama_kelas sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

	// validasi unique inputan, ketika di edit
	function valid_nama_kelas_edit()
	{
		$current_id = $this->session->userdata('kode_kelas');
		$detail 	= $this->kelas_m->get_by_id($current_id);
		
		$current	= $detail->nama_kelas;
		$nama_kelas = $this->input->post('nama_kelas');
				
		if ($nama_kelas == $current)
		{
			return TRUE;
		}
		else
		{
			if($this->kelas_m->valid_nama_kelas($nama_kelas) === TRUE)
			{
				$this->form_validation->set_message('valid_nama_kelas_edit', "Nama kelas $nama_kelas sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

}

/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */