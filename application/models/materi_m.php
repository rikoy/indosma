<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materi_m extends CI_Model {

	var $gallery_path;
	var $gallery_path_url;

	// inisialisasi nama table
	var $table = 'materi';

	function __construct(){
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../materi');
		$this->gallery_path_url = base_url().'materi';
	}
	

	// mendapatkan semua data
	function getAll(){
		$idp = $this->session->userdata('idp');
		$kdk = $this->uri->segment(3);
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kode_kelas', $kdk);
        $this->db->order_by('id_materi','DESC');
        $query = $this->db->get();

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by('id_materi');
		return $this->db->get($this->table);
	}

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		return $this->db->get_where($this->table, array('id_materi' => $id))->row();
	}

	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id_materi, $data)
	{
		$this->db->where('id_materi', $id_materi);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
		$this->db->delete($this->table, array('id_materi' => $id));
	}

	// cek validasi unique
	function valid_namamateri($nama_materi)
	{
		$idp = $this->session->userdata('idp');
		$query = $this->db->get_where($this->table, array('nama_materi' => $nama_materi, 'id_pengguna' => $idp));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	//upload file
	function do_upload($file_materi) {
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png|zip|pdf|rar|doc|docx|xls|xlsx',
			'upload_path' => $this->gallery_path,
			'max_size' => 20000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload($file_materi);
        $data = $this->upload->data($file_materi);
		$image_data = $this->upload->data();
		$nama_filenya = $image_data['file_name'];
		return $nama_filenya;
	}

}

/* End of file materi_m.php */
/* Location: ./application/models/materi_m.php */