<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		
		$this->load->model(array('teman_m', 'pengguna_m'));
	}

	public function index()
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			redirect('admin/dashboard','refresh');
		}else{
			redirect('admin/login/proses_logout','refresh');
		}
	}

	function lihat($id)
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){
			
			$data["content"] 		= "admin/profil/profil_v";
			$data['title_box'] 		= 'Profil';
			
			$detail = $this->teman_m->get_by_id($id);
			
			$this->session->set_userdata('id_pengguna', $detail->id_pengguna);
			
			$data['default']['id'] 					= $detail->id_pengguna;
			$data['default']['nama_lengkap'] 		= $detail->nama_lengkap;
			$data['default']['foto_profil'] 		= $detail->foto_profil;
			$data['default']['status_pengguna'] 	= $detail->status_pengguna;
			$data['default']['jenis_kelamin'] 		= $detail->jenis_kelamin;
			$data['default']['status_pernikahan'] 	= $detail->status_pernikahan;
			$data['default']['alamat'] 				= $detail->alamat;
			$data['default']['tgl_lahir'] 			= $detail->tgl_lahir;
			$data['default']['email'] 				= $detail->email;
			$data['default']['tentang_pribadi'] 	= $detail->tentang_pribadi;

			$this->load->view('admin/layout_v', $data);

		}else{
			redirect('admin/login/proses_logout','refresh');
		}
	}

	function ubah($id)
	{
		$cek = $this->session->userdata('login_admin');
		if(!empty($cek)){

			$data["content"] 		= "admin/profil/form";
			$data["title_box"] 		= "Edit Profl";
			$data["title_inbox"]	= "Form Edit Profl";
			
			$data['form_action']	= site_url('admin/profil/update');
			$data['link_back'] 		= array('link_back' => anchor('teman/profil/'.$id.'','Kembali', array('class' => 'btn btn-default btn-sm"')));
			

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

			$this->load->view('admin/layout_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	function update()
	{
		$cek = $this->session->userdata('id_admin');
		if(!empty($cek)){

			$id = $this->input->post('id_pengguna');
			$data["content"] 		= "pengguna/form";
			$data['title_box'] 		= 'Edit Profil';
			
			$data['form_action']	= site_url('admin/profil/update');
			
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
			
	        	redirect('admin/profil/lihat/'.$id.'', 'refresh');
	 		}else{
	        	$this->load->view('admin/layout_v', $data);
	   		}

	   	}else{
			redirect('home/logout','refresh');
		}

	}

	function ganti_password($id)
	{
		$cek = $this->session->userdata('id_admin');
		if(!empty($cek)){

			$data["content"] 		= "admin/profil/form_ganti_password";
			$data['title_box'] 		= 'Ganti Password';
			$data["title_inbox"]	= "Form Ganti Password";
			
			$data['form_action']	= site_url('admin/profil/update_password');
			
			$this->load->view('admin/layout_v', $data);

		}else{
			redirect('home/logout','refresh');
		}
	}

	function update_password()
	{
		$cek = $this->session->userdata('id_admin');
		if(!empty($cek)){
			$data = array('password' => md5($this->input->post('password')));
			$this->pengguna_m->update($this->input->post('id_pengguna'), $data);
				
			$this->session->set_flashdata('message', 'Satu data berhasil diupdate!');
			
			redirect('admin/profil/lihat/'.$this->input->post('id_pengguna').'', 'refresh');
		}else{
			redirect('home/logout','refresh');
		}
	}

}

/* End of file profil.php */
/* Location: ./application/controllers/admin/profil.php */