<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Memo extends CI_Controller {

	// construktor memanggil model dan library
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));

		$this->load->model(array('dashboard_m', 'memo_m'));
	}

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data['content']			= 'memo/memo_v';
			$data['title_box'] 			= 'Memo';

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$data['query'] = $this->memo_m->getAll();

			$this->load->view('dashboard_v', $data);
		}else{
			redirect('home/logout','refresh');
		}	
	}

	function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "memo/form";
			$data['title_box'] 		= 'Tambah Data Memo';
			$data['form_action']	= site_url('memo/insert');
			$data['link_back'] 		= array('link_back' => anchor('memo','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
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
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "memo/form";
			$data['title_box'] 		= 'Tambah Data Memo';
			$data['form_action']	= site_url('memo/insert');
			$data['link_back'] 		= array('link_back' => anchor('memo','Kembali', array('class' => 'btn btn-default btn-sm"')));

			// validasi
			$this->form_validation->set_rules('judul_memo','Judul Memo', 'required|callback_valid_judulmemo');
			$this->form_validation->set_rules('isi_memo','Isi Memo', 'required');
	        // $this->form_validation->set_error_delimiters('<div class="callout callout-danger"> <h4>Peringatan</h4> ', '</div>');
			
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

	        if($this->form_validation->run() === TRUE) {
	        	$data = array('judul_memo' 		=> $this->input->post('judul_memo'),
	        					'isi_memo' 		=> $this->input->post('isi_memo'),
	        					'id_pengguna' 	=> $this->input->post('id_pengguna'),
	        					'datecreated'	=> $datetime
	        					);
				$this->memo_m->add($data);

	        	$this->session->set_flashdata('message', 'Data berhasil disimpan');
				redirect('memo', 'refresh');
	        }else{
				$this->tambah();	
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}
	}

	// menampilkan form edit
	function ubah($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "memo/form";
			$data['title_box'] 		= 'Edit Data Memo';
			$data['form_action']	= site_url('memo/update');
			$data['link_back'] 		= array('link_back' => anchor('memo','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);
			
			$detail = $this->memo_m->get_by_id($id);
			
			$this->session->set_userdata('id_memo', $detail->id_memo);

			$data['default']['id'] 			= $detail->id_memo;
			$data['default']['judul_memo'] 	= $detail->judul_memo;
			$data['default']['isi_memo'] 	= $detail->isi_memo;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	// proses edit data
	function update(){

		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "memo/form";
			$data['title_box'] 		= 'Edit Data Memo';
			$data['form_action']	= site_url('memo/update');
			$data['link_back'] 		= array('link_back' => anchor('memo','Kembali', array('class' => 'btn btn-default btn-sm"')));
			
			$this->form_validation->set_rules('judul_memo','Judul Memo', 'required|callback_valid_judulmemo_edit');
			$this->form_validation->set_rules('isi_memo','Isi Memo', 'required');
	        // $this->form_validation->set_error_delimiters('<div class="callout callout-danger"> <h4>Peringatan</h4> ', '</div>');
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("Y-m-d H:i:s");

	        if($this->form_validation->run() === TRUE) {
				$data = array('judul_memo' 		=> $this->input->post('judul_memo'),
	        					'isi_memo' 		=> $this->input->post('isi_memo'),
	        					'id_pengguna' 	=> $this->input->post('id_pengguna'),
	        					'datecreated'	=> $datetime
	        					);
				$this->memo_m->update($this->session->userdata('id_memo'), $data);
				
				$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
			
	        	redirect('memo', 'refresh');
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

			$this->memo_m->delete($id);
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			
			redirect('memo', 'refresh');

		}else{
			redirect('home/logout','refresh');
		}
	}

	// menampilkan form edit
	function detail($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "memo/detail_v";
			$data['title_box'] 		= 'Data Memo';
			$data['link_back'] 		= array('link_back' => anchor('memo','Kembali', array('class' => 'btn btn-default btn-xs pull-right')));
			
			$detail = $this->memo_m->get_by_id($id);
			
			$this->session->set_userdata('id_memo', $detail->id_memo);

			$data['default']['id'] 			= $detail->id_memo;
			$data['default']['judul_memo'] 	= $detail->judul_memo;
			$data['default']['isi_memo'] 	= $detail->isi_memo;
			$data['default']['datecreated'] 	= $detail->datecreated;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	// validasi unique inputan, ketika di tambah
	function valid_judulmemo($judul_memo)
	{
		if ($this->memo_m->valid_judulmemo($judul_memo) == TRUE)
		{
			$this->form_validation->set_message('valid_judulmemo', "Judul memo $judul_memo sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}

	// validasi unique inputan, ketika di edit
	function valid_judulmemo_edit()
	{
		$current_id = $this->session->userdata('id_memo');
		$detail 	= $this->memo_m->get_by_id($current_id);
		
		$current	= $detail->judul_memo;
		$judul_memo = $this->input->post('judul_memo');
				
		if ($judul_memo == $current)
		{
			return TRUE;
		}
		else
		{
			if($this->memo_m->valid_judulmemo($judul_memo) === TRUE)
			{
				$this->form_validation->set_message('valid_judulmemo_edit', "Judul memo $judul_memo sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

}

/* End of file memo.php */
/* Location: ./application/controllers/memo.php */