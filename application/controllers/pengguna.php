<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('kelas_m', 'teman_m', 'dashboard_m', 'pengguna_m'));
	}

	function ubah($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "pengguna/form";
			$data['title_box'] 		= 'Edit Profil';
			
			$data['form_action']		= site_url('pengguna/update');
			$data['link_back'] 		= array('link_back' => anchor('teman/profil/'.$id.'','Kembali', array('class' => 'btn btn-default btn-sm"')));
			

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);
			
			$detail = $this->pengguna_m->get_by_id($id);
			
			$this->session->set_userdata('id_pengguna', $detail->id_pengguna);
			
			$data['default']['id'] 					= $detail->id_pengguna;
			$data['default']['nama_lengkap'] 		= $detail->nama_lengkap;
			$data['default']['foto_profil'] 		= $detail->foto_profil;
			$data['default']['status_pengguna'] 	= $detail->status_pengguna;
			$data['default']['jenis_kelamin'] 		= $detail->jenis_kelamin;
			$data['default']['status_pernikahan'] 	= $detail->status_pernikahan;
			$data['default']['alamat'] 				= $detail->alamat;
			$data['default']['tgl_lahir'] 			= date("d-m-Y", strtotime($detail->tgl_lahir));
			$data['default']['email'] 				= $detail->email;
			$data['default']['tentang_pribadi'] 	= $detail->tentang_pribadi;
			$data['default']['no_telp'] 			= $detail->no_telp;

			$this->load->view('dashboard_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	function update()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$id = $this->input->post('id_pengguna');
			$data["content"] 		= "pengguna/form";
			$data['title_box'] 		= 'Edit Profil';
			
			$data['form_action']	= site_url('pengguna/update');
			$data['link_back'] 		= array('link_back' => anchor('teman/profil/'.$id.'','Kembali', array('class' => 'btn btn-default btn-sm"')));
			

			$data['form_pt']			= site_url('pt/insert');
			$data['form_cari_pt']		= site_url('pt/insert_cari_pt');
			$data['form_kelas']			= site_url('kelas/insert');
			$data['form_cari_kelas']	= site_url('kelas/insert_cari_kelas');
			$data['multilevel'] 		= array(''=>'- pilih -') + $this->dashboard_m->get_child(12);

			$this->form_validation->set_rules('nama_lengkap','Nama Lengkap', 'required');
			$this->form_validation->set_rules('email','Email', 'required');
	        
	        if($this->form_validation->run() === TRUE) {
	        	$nm_foto = $this->pengguna_m->do_upload('foto_profil');

	        	if ($this->input->post('tgl_lahir') != "" ) {
	        		$tgl_lahir = date("Y-m-d", strtotime($this->input->post('tgl_lahir')));
	        	}else{
	        		$tgl_lahir = "";
	        	}

	        	if(!$nm_foto){
					$data = array('nama_lengkap' 		=> $this->input->post('nama_lengkap'),
									'email' 			=> $this->input->post('email'),
									'no_telp' 			=> $this->input->post('no_telp'),
									'alamat' 			=> $this->input->post('alamat'),
									'status_pernikahan' => $this->input->post('status_pernikahan'),
									'jenis_kelamin' 	=> $this->input->post('jenis_kelamin'),
									'tentang_pribadi' 	=> $this->input->post('tentang_pribadi'),
									'tgl_lahir' 		=> $tgl_lahir
								);
				}else{
					$data = array('nama_lengkap' 		=> $this->input->post('nama_lengkap'),
									'email' 			=> $this->input->post('email'),
									'no_telp' 			=> $this->input->post('no_telp'),
									'alamat' 			=> $this->input->post('alamat'),
									'status_pernikahan' => $this->input->post('status_pernikahan'),
									'jenis_kelamin' 	=> $this->input->post('jenis_kelamin'),
									'tentang_pribadi' 	=> $this->input->post('tentang_pribadi'),
									'foto_profil' 		=> $nm_foto,
									'tgl_lahir' 		=> $tgl_lahir
								);
				}

				$this->pengguna_m->update($this->input->post('id_pengguna'), $data);
				
				$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
			
	        	redirect('teman/profil/'.$id.'', 'refresh');
	 		}else{
	        	$this->load->view('dashboard_v', $data);
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}
	}

	function ganti_password($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$data["content"] 		= "pengguna/form_ganti_password";
			$data['title_box'] 		= 'Ganti Password';
			
			$data['form_action']	= site_url('pengguna/update_password');
			$data['link_back'] 		= array('link_back' => anchor('teman/profil/'.$id.'','Kembali', array('class' => 'btn btn-default btn-sm"')));
			

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

	function update_password()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data = array('password' => md5($this->input->post('password')));
			$this->pengguna_m->update($this->input->post('id_pengguna'), $data);
				
			$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
		
        	redirect('teman/profil/'.$this->input->post('id_pengguna').'', 'refresh');
		}else{
			redirect('home/logout','refresh');
		}
	}

}

/* End of file pengguna.php */
/* Location: ./application/controllers/pengguna.php */