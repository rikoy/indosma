<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tugas_m extends CI_Model {

	var $gallery_path;
	var $gallery_path_url;

	var $gallery_path_kumpul;
	var $gallery_path_url_kumpul;

	// inisialisasi nama table
	var $table = 'tugas';
	
	function __construct(){
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../tugas');
		$this->gallery_path_url = base_url().'tugas';

		$this->gallery_path_kumpul = realpath(APPPATH . '../tugas_mhs');
		$this->gallery_path_url_kumpul = base_url().'tugas_mhs';
	}

	// mendapatkan semua data
	function getAll(){
		$idp = $this->session->userdata('idp');
		$kdk = $this->uri->segment(3);
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kode_kelas', $kdk);
        $this->db->order_by('id_tugas','DESC');
        $query = $this->db->get();

        return $query->result();
    }

    // mendapatkan semua data
	function getAll_nilai_tugas(){
		$idp = $this->session->userdata('idp');
		$id_tugas = $this->uri->segment(3);

		$this->db->select('nilai_tugas.*, pengguna.nama_lengkap');
        $this->db->from('nilai_tugas');
        $this->db->join('pengguna', 'nilai_tugas.id_pengguna = pengguna.id_pengguna', 'LEFT');
        $this->db->where('id_tugas', $id_tugas);
        $this->db->order_by('id_pengguna','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by('id_tugas');
		return $this->db->get($this->table);
	}

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		return $this->db->get_where($this->table, array('id_tugas' => $id))->row();
	}

	// mendapatkan satu data berdasarkan id
	function get_by_id_nilai($id)
	{
		return $this->db->get_where('nilai_tugas', array('id_nilai_tugas' => $id))->row();
	}

	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}
	// menambah data
    function add_kumpul_tugas($data){
		$this->db->insert('nilai_tugas', $data);
	}

	// update data
	function update($id_tugas, $data)
	{
		$this->db->where('id_tugas', $id_tugas);
		$this->db->update($this->table, $data);
	}

	// update data
	function beri_nilai($id_pengguna, $data)
	{
		// $this->db->where('id_tugas', $id_tugas);
		$this->db->where('id_pengguna', $id_pengguna);

		$this->db->update_batch('nilai_tugas', $data, 'id_tugas');
	}

	// hapus data
	function delete($id)
	{
		$this->db->delete($this->table, array('id_tugas' => $id));
		$this->db->delete('nilai_tugas', array('id_tugas' => $id));
	}

	//upload file
	function do_upload($file_tugas) {
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png|zip|pdf|doc|docx|xls|xlsx',
			'upload_path' => $this->gallery_path,
			'max_size' => 20000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload($file_tugas);
        $data = $this->upload->data($file_tugas);
		$image_data = $this->upload->data();
		$nama_filenya = $image_data['file_name'];
		return $nama_filenya;
	}

	//upload file
	function do_upload_kumpul_tugas($file_tugas) {
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png|zip|pdf|doc|docx|xls|xlsx',
			'upload_path' => $this->gallery_path_kumpul,
			'max_size' => 20000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload($file_tugas);
        $data = $this->upload->data($file_tugas);
		$image_data = $this->upload->data();
		$nama_filenya = $image_data['file_name'];
		return $nama_filenya;
	}

	// cek validasi unique
	function valid_namatugas($nama_tugas)
	{
		$idp = $this->session->userdata('idp');
		$query = $this->db->get_where($this->table, array('nama_tugas' => $nama_tugas, 'id_pengguna' => $idp));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getAll_mhs($kdk)
	{
		$this->db->select('pengguna.nama_lengkap, pengguna.id_pengguna');
        $this->db->from('pengguna');
        $this->db->join('kelas_pengguna', 'pengguna.id_pengguna = kelas_pengguna.id_pengguna', 'LEFT');
        $this->db->where('pengguna.status_pengguna', 'mahasiswa');
        $this->db->where('kelas_pengguna.kode_kelas', $kdk);
        $this->db->order_by('pengguna.nama_lengkap','ASC');
        $query = $this->db->get();

        return $query->result();
	}

}

/* End of file tugas_m.php */
/* Location: ./application/models/tugas_m.php */