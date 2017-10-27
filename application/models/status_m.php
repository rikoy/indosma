<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'status';
	
	 // mendapatkan semua data
	function getAll(){
		$idp = $this->session->userdata('idp');

		//cari kode pt
		$query_cari_pt = $this->db->query("SELECT kode_pt FROM pt_pengguna WHERE id_pengguna = '$idp'");
		$row_pt = $query_cari_pt->row();

		$this->db->select('status.*, pengguna.nama_lengkap, pengguna.foto_profil, pengguna.status_pengguna');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = status.id_pengguna', 'left');
        $this->db->where('kode_pt', $row_pt->kode_pt);
        $this->db->order_by('id_status','DESC');
        $query = $this->db->get();

        return $query->result();
    }

    function getAll_status()
    {

    	$this->db->select('status.*, pengguna.nama_lengkap, pengguna.id_pengguna');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = status.id_pengguna', 'left');
        $this->db->order_by('id_status','DESC');
        $query = $this->db->get();

        return $query->result();
    }

    function getAll_komenstatus()
    {
    	$this->db->select('komentar_status.*, pengguna.nama_lengkap, pengguna.id_pengguna');
        $this->db->from('komentar_status');
        $this->db->join('pengguna', 'pengguna.id_pengguna = komentar_status.id_pengguna', 'left');
        $this->db->order_by('id_status','DESC');
        $query = $this->db->get();

        return $query->result();
    }

	// mendapatkan semua data
	function getAll_jawaban($id){
		$idp = $this->session->userdata('idp');

		$this->db->select('jawaban_pesan.*, pengguna.nama_lengkap, pengguna.foto_profil, pengguna.status_pengguna');
        $this->db->from('jawaban_pesan');
        $this->db->join('pengguna', 'pengguna.id_pengguna = jawaban_pesan.id_pengirim', 'left');
        $this->db->where('id_status', $id);
        $this->db->order_by('id_status','DESC');
        $query = $this->db->get();

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by('id_status');
		return $this->db->get($this->table);
	}

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		// return $this->db->get_where($this->table, array('id_status' => $id))->row();

		$this->db->select('pesan.*, pengguna.nama_lengkap, pengguna.foto_profil, pengguna.status_pengguna');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = pesan.id_pengirim', 'left');
        $this->db->where('pesan.id_status', $id);
        $query = $this->db->get();

        return $query->row();
	}

	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	function add_komen($data){
		$this->db->insert('komentar_status', $data);
	}

	// menambah data
    function add_jawaban($data){
		$this->db->insert('jawaban_pesan', $data);
	}

	// update data
	function update($id_status, $data)
	{
		$this->db->where('id_status', $id_status);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
		$this->db->delete($this->table, array('id_status' => $id));
		$this->db->delete('komentar_status', array('id_status' => $id));
	}

	// hapus data
	function delete_komen($id)
	{
		$this->db->delete('komentar_status', array('id_komentar_status' => $id));
	}

}

/* End of file status_m.php */
/* Location: ./application/models/status_m.php */