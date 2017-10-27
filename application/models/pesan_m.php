<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesan_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'pesan';
	
	 // mendapatkan semua data
	function getAll(){
		$idp = $this->session->userdata('idp');

		$this->db->select('pesan.*, pengguna.nama_lengkap, pengguna.foto_profil');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = pesan.id_tujuan', 'left');
        $where = "id_pengirim = '$idp' OR id_tujuan = '$idp'";
        $this->db->where($where);
        $this->db->order_by('id_pesan','DESC');
        $query = $this->db->get();

        return $query->result();
    }

     // mendapatkan semua data
	function getAll_pesan(){
		
		$this->db->select('pesan.*, pengguna.nama_lengkap, pengguna.id_pengguna');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = pesan.id_tujuan', 'left');
        $this->db->order_by('id_pesan','DESC');
        $query = $this->db->get();

        return $query->result();
    }

     // mendapatkan semua data
	function getAll_jawabpesan(){
		
		$this->db->select('jawaban_pesan.*, pengguna.nama_lengkap, pengguna.id_pengguna');
        $this->db->from('jawaban_pesan');
        $this->db->join('pengguna', 'pengguna.id_pengguna = jawaban_pesan.id_pengirim', 'left');
        $this->db->order_by('id_pesan','DESC');
        $query = $this->db->get();

        return $query->result();
    }

	// mendapatkan semua data
	function getAll_jawaban($id){
		$idp = $this->session->userdata('idp');

		$this->db->select('jawaban_pesan.*, pengguna.nama_lengkap, pengguna.foto_profil, pengguna.status_pengguna');
        $this->db->from('jawaban_pesan');
        $this->db->join('pengguna', 'pengguna.id_pengguna = jawaban_pesan.id_pengirim', 'left');
        $this->db->where('id_pesan', $id);
        $this->db->order_by('id_pesan','DESC');
        $query = $this->db->get();

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by('id_pesan');
		return $this->db->get($this->table);
	}

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		// return $this->db->get_where($this->table, array('id_pesan' => $id))->row();

		$this->db->select('pesan.*, pengguna.nama_lengkap, pengguna.foto_profil, pengguna.status_pengguna');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = pesan.id_pengirim', 'left');
        $this->db->where('pesan.id_pesan', $id);
        $query = $this->db->get();

        return $query->row();
	}

	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	// menambah data
    function add_jawaban($data){
		$this->db->insert('jawaban_pesan', $data);
	}

	// update data
	function update($id_pesan, $data)
	{
		$this->db->where('id_pesan', $id_pesan);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
		$this->db->delete($this->table, array('id_pesan' => $id));
		$this->db->delete('jawaban_pesan', array('id_pesan' => $id));
	}

	// hapus data
	function delete_byadmin($id)
	{
		$this->db->delete($this->table, array('id_pesan' => $id));
	}

	// hapus data
	function delete_jawaban($id)
	{
		$this->db->delete('jawaban_pesan', array('id_jawaban_pesan' => $id));
	}

	// hapus data
	function delete_jawabpesan_byadmin($id)
	{
		$this->db->delete('jawaban_pesan', array('id_jawaban_pesan' => $id));
	}

}

/* End of file pesan_m.php */
/* Location: ./application/models/pesan_m.php */