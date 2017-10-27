<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pt extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('pt_m', 'dashboard_m'));
	}

	public function index()
	{
				
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

	function insert()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data['form_daftar']	= site_url('home/registrasi');
				
			// validasi
			$this->form_validation->set_rules('nama_pt','Nama Perguruan Tinggi', 'required|callback_valid_nama_pt');
	        // $this->form_validation->set_error_delimiters('<div class="alert alert-danger catatan-form" style="margin-bottom: 0;"> ', '</div><br>');
	        // $this->form_validation->set_error_delimiters('<li>', '</li>');
	        
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");
			$n = rand(10e16, 10e20);
	        $kode_pt = base_convert($n, 5, 36);
	        if($this->form_validation->run() === TRUE) {
	        	$data = array('id_pengguna' => $this->input->post('id_pengguna'),
	        					'nama_pt' => $this->input->post('nama_pt'),
	        					'alamat_pt' => $this->input->post('alamat_pt'),
	        					'kode_pos_pt' => $this->input->post('kode_pos_pt'),
	        					'no_telp_pt' => $this->input->post('no_telp_pt'),
	        					'kode_pt' => $kode_pt,
	        					'datecreated' => $datetime
	        				);

	        	$data_pt_pengguna = array('id_pengguna' => $this->input->post('id_pengguna'),
	        					'kode_pt' => $kode_pt
	        				);

				$this->pt_m->add($data);
				$this->pt_m->add_pt_pengguna($data_pt_pengguna);

	        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
				redirect('dashboard', 'refresh');
	        }else{

	        	$data['default']['nama_pt'] 	= $this->input->post('nama_pt');
				$data['default']['alamat_pt'] 	= $this->input->post('alamat_pt');
				$data['default']['kode_pos_pt'] = $this->input->post('kode_pos_pt');
				$data['default']['no_telp_pt'] 	= $this->input->post('no_telp_pt');

				// echo "gagal";
				$this->dashboard();	
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}
	}

	function insert_cari_pt()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data_pt_pengguna = array('id_pengguna' => $this->input->post('id_pengguna'),
	        					'kode_pt' => $this->input->post('kode_pt')
	        				);
			$this->pt_m->add_pt_pengguna($data_pt_pengguna);
			$this->session->set_flashdata('message', 'Data berhasil disimpan');
			redirect('dashboard', 'refresh');

		}else{
			redirect('home/logout','refresh');
		}
	}

	public function lihat($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "pt/detail_v";
			$data['title_box'] 		= 'Data Perguruan Tinggi';
			// $data['form_action']	= site_url('memo/update');
			// $data['link_back'] 		= array('link_back' => anchor('memo','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);
			
			$detail = $this->pt_m->get_by_id($id);
			
			$this->session->set_userdata('kode_pt', $detail->kode_pt);

			$data['default']['id'] 			= $detail->kode_pt;
			$data['default']['id_pengguna'] = $detail->id_pengguna;
			$data['default']['nama_pt'] 	= $detail->nama_pt;
			$data['default']['alamat_pt'] 	= $detail->alamat_pt;
			$data['default']['kode_pos_pt'] = $detail->kode_pos_pt;
			$data['default']['no_telp_pt'] 	= $detail->no_telp_pt;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	public function ubah($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "pt/form";
			$data['title_box'] 		= 'Edit Perguruan Tinggi';
			$data['form_action']	= site_url('pt/update');
			$data['link_back'] 		= array('link_back' => anchor('pt/lihat/'.$id.'','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);
			
			$detail = $this->pt_m->get_by_id($id);
			
			$this->session->set_userdata('kode_pt', $detail->kode_pt);

			$data['default']['id'] 			= $detail->kode_pt;
			$data['default']['id_pengguna'] = $detail->id_pengguna;
			$data['default']['nama_pt'] 	= $detail->nama_pt;
			$data['default']['alamat_pt'] 	= $detail->alamat_pt;
			$data['default']['kode_pos_pt'] = $detail->kode_pos_pt;
			$data['default']['no_telp_pt'] 	= $detail->no_telp_pt;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses edit data
	function update(){

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "pt/form";
			$data['title_box'] 		= 'Edit Perguruan Tinggi';
			$data['form_action']	= site_url('pt/update');
			$data['link_back'] 		= array('link_back' => anchor('pt/lihat/'.$this->input->post('id').'','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$this->form_validation->set_rules('nama_pt','Nama Perguruan Tinggi', 'required|callback_valid_nama_pt_edit');
			// $this->form_validation->set_rules('isi_memo','Isi Memo', 'required');
	        // $this->form_validation->set_error_delimiters('<div class="callout callout-danger"> <h4>Peringatan</h4> ', '</div>');
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

	        if($this->form_validation->run() === TRUE) {
				$data = array('nama_pt' => $this->input->post('nama_pt'),
	        					'alamat_pt' => $this->input->post('alamat_pt'),
	        					'kode_pos_pt' => $this->input->post('kode_pos_pt'),
	        					'no_telp_pt' => $this->input->post('no_telp_pt')
	        					);
				$this->pt_m->update($this->session->userdata('kode_pt'), $data);
				
				$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
			
	        	redirect('pt/lihat/'.$this->input->post('id').'', 'refresh');
	 		}else{
	 			
	 			$detail = $this->pt_m->get_by_id($this->input->post('id'));

	 			$data['default']['id'] 			= $detail->kode_pt;
				$data['default']['id_pengguna'] = $detail->id_pengguna;
				$data['default']['nama_pt'] 	= $detail->nama_pt;
				$data['default']['alamat_pt'] 	= $detail->alamat_pt;
				$data['default']['kode_pos_pt'] = $detail->kode_pos_pt;
				$data['default']['no_telp_pt'] 	= $detail->no_telp_pt;

	        	$this->load->view('dashboard_v', $data);
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}
	}

	// validasi unique inputan, ketika di tambah
	function valid_nama_pt($nama_pt)
	{
		if ($this->pt_m->valid_nama_pt($nama_pt) == TRUE)
		{
			$this->form_validation->set_message('valid_nama_pt', "Nama Perguruan Tinggi $nama_pt sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

	// validasi unique inputan, ketika di edit
	function valid_nama_pt_edit()
	{
		$current_id = $this->session->userdata('kode_pt');
		$detail 	= $this->pt_m->get_by_id($current_id);
		
		$current	= $detail->nama_pt;
		$nama_pt 	= $this->input->post('nama_pt');
				
		if ($nama_pt == $current)
		{
			return TRUE;
		}
		else
		{
			if($this->pt_m->valid_nama_pt($nama_pt) === TRUE)
			{
				$this->form_validation->set_message('valid_nama_pt_edit', "Nama Perguruan Tinggi $nama_pt sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

}

/* End of file pt.php */
/* Location: ./application/controllers/pt.php */