<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'kelas';

	// mendapatkan semua data
	function getAll(){
		$idp = $this->session->userdata('idp');
		$this->db->select('kelas.nama_kelas, kelas.kode_kelas, pengguna.nama_lengkap, pengguna.foto_profil');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = kelas.id_pengguna', 'left');
        $this->db->join('kelas_pengguna', 'kelas_pengguna.kode_kelas = kelas.kode_kelas', 'left');
        $this->db->where('kelas_pengguna.id_pengguna', $idp);
        $this->db->order_by('kelas.kode_kelas','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by('kode_kelas');
		return $this->db->get($this->table);
	}

    function getAll_kelas()
    {
        $this->db->select('kelas.*, pengguna.nama_lengkap, pengguna.id_pengguna, perguruan_tinggi.nama_pt');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = kelas.id_pengguna', 'left');
        $this->db->join('perguruan_tinggi', 'perguruan_tinggi.kode_pt = kelas.kode_pt', 'left');
        $this->db->order_by('kode_kelas','ASC');
        $query = $this->db->get();

        return $query->result();
    }

	//print
	function print_all()
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('kelas.*, pengguna.nama_lengkap, perguruan_tinggi.nama_pt');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = kelas.id_pengguna', 'left');
        $this->db->join('perguruan_tinggi', 'perguruan_tinggi.kode_pt = kelas.kode_pt', 'left');
        // $this->db->where('datecreated >=', $tgl_sekarng);
        $this->db->order_by('kode_kelas','ASC');
        $query = $this->db->get();

        return $query->result();
    }

	function print_akhir($ttgl_akhir)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('kelas.*, pengguna.nama_lengkap, perguruan_tinggi.nama_pt');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = kelas.id_pengguna', 'left');
        $this->db->join('perguruan_tinggi', 'perguruan_tinggi.kode_pt = kelas.kode_pt', 'left');
        // $this->db->where('datecreated >=', $tgl_sekarng);
        $this->db->where('kelas.datecreated <=', $ttgl_akhir);
        $this->db->order_by('kode_kelas','ASC');
        $query = $this->db->get();

        return $query->result();
    }
    
    function print_awal($ttgl_awal)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('kelas.*, pengguna.nama_lengkap, perguruan_tinggi.nama_pt');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = kelas.id_pengguna', 'left');
        $this->db->join('perguruan_tinggi', 'perguruan_tinggi.kode_pt = kelas.kode_pt', 'left');
        // $this->db->where('datecreated >=', $tgl_sekarng);
        $this->db->where('kelas.datecreated >=', $ttgl_awal);
        $this->db->order_by('kode_kelas','ASC');
        $query = $this->db->get();

        return $query->result();
    }
    
    function print_awal_akhir($ttgl_awal, $ttgl_akhir)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('kelas.*, pengguna.nama_lengkap, perguruan_tinggi.nama_pt');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = kelas.id_pengguna', 'left');
        $this->db->join('perguruan_tinggi', 'perguruan_tinggi.kode_pt = kelas.kode_pt', 'left');
        $this->db->where('kelas.datecreated >=', $ttgl_awal);
        $this->db->where('kelas.datecreated <=', $ttgl_akhir);
        $this->db->order_by('kode_kelas','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		return $this->db->get_where($this->table, array('kode_kelas' => $id))->row();
	}

	function get_detail_id($id)
	{
		$this->db->select('kelas.nama_kelas, kelas.kode_kelas, kelas.jurusan, pengguna.status_pengguna, pengguna.nama_lengkap, pengguna.foto_profil');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = kelas.id_pengguna', 'left');
        $this->db->join('kelas_pengguna', 'kelas_pengguna.kode_kelas = kelas.kode_kelas', 'left');
        $this->db->where('kelas.kode_kelas', $id);
        $query = $this->db->get();

        return $query->row();
	}

	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	// menambah data
    function addSelect($data){
        $this->db->insert_batch('kelas_pengguna', $data);
    }

	// menambah data
    function add_kelas_pengguna($data_kelas_pengguna){
		$this->db->insert('kelas_pengguna', $data_kelas_pengguna);
	}

	// update data
	function update($kode_kelas, $data)
	{
		$this->db->where('kode_kelas', $kode_kelas);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
		$idp = $this->session->userdata('idp');
		$this->db->delete('kelas_pengguna', array('kode_kelas' => $id, 'id_pengguna' => $idp));
	}

    // hapus data
    function delete_kelas_byadmin($id)
    {
        $this->db->delete($this->table, array('kode_kelas' => $id));
    }

	// hapus data
	function delete_kelas($id)
	{
		$this->db->delete($this->table, array('kode_kelas' => $id));
		// $this->db->delete('kelas_pengguna', array('kode_kelas' => $id));
		// $this->db->delete('tugas', array('kode_kelas' => $id));
		// $this->db->delete('diskusi', array('kode_kelas' => $id));
	}

	// cek validasi unique
	function valid_nama_kelas($nama_kelas)
	{
		$idp = $this->session->userdata('idp');
        $q_pt = $this->db->query("SELECT * FROM pt_pengguna WHERE id_pengguna = '$idp'");
        $jml_pt = $q_pt->num_rows();
        $r_pt = $q_pt->row();

		$query = $this->db->get_where($this->table, array('nama_kelas' => $nama_kelas, 'kode_pt' => $r_pt->kode_pt, 'id_pengguna' => $idp));
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

/* End of file kelas_m.php */
/* Location: ./application/models/kelas_m.php */