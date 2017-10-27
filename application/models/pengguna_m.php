<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna_m extends CI_Model {

	var $gallery_path;
	var $gallery_path_url;

	// inisialisasi nama table
	var $table = 'pengguna';

	function __construct(){
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../avatar');
		$this->gallery_path_url = base_url().'avatar';
	}

	// mendapatkan semua data
	function getAll(){
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function getAll_userlogin()
    {
    	$this->db->select('session_login.*, pengguna.nama_lengkap');
        $this->db->from('session_login');
        $this->db->join('pengguna', 'pengguna.id_pengguna = session_login.id_pengguna', 'left');
        $this->db->order_by('id_session_login','DESC');
        $query = $this->db->get();

        return $query->result();
    }

    // mendapatkan semua data
	function getAll_user(){
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status_pengguna !=','admin');
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    //print
    function print_sp_awal_akhir($status_pengguna, $ttgl_awal, $ttgl_akhir)
    {
    	$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status_pengguna', $status_pengguna);
        $this->db->where('datecreated >=', $ttgl_awal);
        $this->db->where('datecreated <=', $ttgl_akhir);
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function print_sp_awal($status_pengguna, $ttgl_awal)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status_pengguna', $status_pengguna);
        $this->db->where('datecreated >=', $ttgl_awal);
        // $this->db->where('datecreated <=', $tgl_sekarng);
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function print_sp($status_pengguna)
    {
    	$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status_pengguna', $status_pengguna);
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }
    
    function print_sp_akhir($status_pengguna, $ttgl_akhir)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status_pengguna', $status_pengguna);
        // $this->db->where('datecreated >=', $tgl_sekarng);
        $this->db->where('datecreated <=', $ttgl_akhir);
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }
    
    function print_akhir($ttgl_akhir)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('*');
        $this->db->from($this->table);
        // $this->db->where('datecreated >=', $tgl_sekarng);
        $this->db->where('datecreated <=', $ttgl_akhir);
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }
    
    function print_awal($ttgl_awal)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('*');
        $this->db->from($this->table);
        // $this->db->where('datecreated >=', $tgl_sekarng);
        $this->db->where('datecreated >=', $ttgl_awal);
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }
    
    function print_awal_akhir($ttgl_awal, $ttgl_akhir)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('datecreated >=', $ttgl_awal);
        $this->db->where('datecreated <=', $ttgl_akhir);
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by('id_pengguna');
		return $this->db->get($this->table);
	}

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		return $this->db->get_where($this->table, array('id_pengguna' => $id))->row();
	}

	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id_pengguna, $data)
	{
		$this->db->where('id_pengguna', $id_pengguna);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
		$this->db->delete($this->table, array('id_pengguna' => $id));
	}

	// hapus data
	function delete_user($id)
	{
		$this->db->delete($this->table, array('id_pengguna' => $id));
		$this->db->delete('diskusi', array('id_pengguna' => $id));
		$this->db->delete('jawaban_pesan', array('id_pengirim' => $id));
		$this->db->delete('jawaban_pesan', array('id_tujuan' => $id));
		$this->db->delete('jawab_diskusi', array('id_pengguna' => $id));
		$this->db->delete('kelas', array('id_pengguna' => $id));
		$this->db->delete('kelas_pengguna', array('id_pengguna' => $id));
		$this->db->delete('komentar_status', array('id_pengguna' => $id));
		$this->db->delete('materi', array('id_pengguna' => $id));
		$this->db->delete('memo', array('id_pengguna' => $id));
		$this->db->delete('nilai_tugas', array('id_pengguna' => $id));
		$this->db->delete('perguruan_tinggi', array('id_pengguna' => $id));
		$this->db->delete('pesan', array('id_pengirim' => $id));
		$this->db->delete('pesan', array('id_tujuan' => $id));
		$this->db->delete('pt_pengguna', array('id_pengguna' => $id));
		$this->db->delete('status', array('id_pengguna' => $id));
		$this->db->delete('tugas', array('id_pengguna' => $id));
	}

	//upload file
	function do_upload($photo) {
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path,
			'max_size' => 20000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload($photo);
	            $data = $this->upload->data($photo);
		$image_data = $this->upload->data();
		$nama_filenya = $image_data['file_name'];
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path . '/thumb',
			'maintain_ration' => true,
			'width' => 160,
			'height' => 160
		);

		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		return $nama_filenya;
	}

	//query login
	public function getLoginData($usr,$psw)
	{
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->db->get_where('pengguna', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				foreach($q_cek_login->result() as $qad)
				{
					$sess_data['logged_in'] 		= 'sayasedanglogin';
					$sess_data['id_pengguna'] 		= $qad->id_pengguna;
					$sess_data['idp'] 				= $qad->id_pengguna;
					$sess_data['nama_lengkap'] 		= $qad->nama_lengkap;
					$sess_data['status_pengguna'] 	= $qad->status_pengguna;
					$sess_data['avatar'] 			= $qad->foto_profil;
					$this->session->set_userdata($sess_data);

					//insert data login 
					date_default_timezone_set('Asia/Jakarta');
					$now = date("Y-m-d");
					$jam = date("H:i:s");

					//get ip address
					$ip = $this->session->userdata('ip_address');
					//get session
					$sessionid = $this->session->userdata('session_id');
					//get user agen
					$user_agent = $this->session->userdata('user_agent');

					$idp = $this->session->userdata('idp');

					$data = array('date' 			=> $now,
									'session_kode'	=> $sessionid,
									'id_pengguna'	=> $idp,
									'ip_login'		=> $ip,
									'user_agent'	=> $user_agent,
									'time' 			=> $jam);

					$this->db->insert('session_login', $data);

				}
				header('location:'.base_url().'dashboard');
			}

		}
		else
		{
			$this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'home/masuk');
		}
	}

	function getLoginAdmin($usr,$psw)
	{
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->db->get_where('pengguna', array('username' => $u, 'password' => $p, 'status_pengguna' => 'admin'));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				foreach($q_cek_login->result() as $qad)
				{
					$sess_data['login_admin'] 			= 'adminsedanglogin';
					$sess_data['id_admin'] 				= $qad->id_pengguna;
					$sess_data['nama_lengkap_admin'] 	= $qad->nama_lengkap;
					$sess_data['avatar_admin']			= $qad->foto_profil;
					$this->session->set_userdata($sess_data);
				}
				header('location:'.base_url().'admin/dashboard');
			}

			/*$now = date("Y-m-d");
			$jam = date("H:i:s");

			$data = array('last_login_date' 	=> $now,
							'last_login_time' 	=> $jam);

			$this->db->where('id_pegawai', $this->session->userdata('id_pegawai'));
			$this->db->update($this->table, $data);*/

		}
		else
		{
			// $this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
			// header('location:'.base_url().'home/masuk');
		}
	}

	// cek validasi unique
	function valid_idpengguna($id_pengguna)
	{
		$query = $this->db->get_where($this->table, array('id_pengguna' => $id_pengguna));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// cek validasi unique
	function valid_username($username)
	{
		$query = $this->db->get_where($this->table, array('username' => $username));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// cek validasi unique
	function valid_email($email)
	{
		$query = $this->db->get_where($this->table, array('email' => $email));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}

/* End of file pengguna_m.php */
/* Location: ./application/models/pengguna_m.php */