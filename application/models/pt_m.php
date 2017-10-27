<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pt_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'perguruan_tinggi';

	// mendapatkan semua data
	function getAll(){
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('kode_pt','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by('kode_pt');
		return $this->db->get($this->table);
	}

    function getAll_pt()
    {
        $this->db->select('perguruan_tinggi.*, pengguna.nama_lengkap, pengguna.id_pengguna');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = perguruan_tinggi.id_pengguna', 'left');
        $this->db->order_by('kode_pt','ASC');
        $query = $this->db->get();

        return $query->result();
    }

	//print
	function print_all()
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('perguruan_tinggi.*, pengguna.nama_lengkap');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = perguruan_tinggi.id_pengguna', 'left');
        // $this->db->where('datecreated >=', $tgl_sekarng);
        $this->db->order_by('kode_pt','ASC');
        $query = $this->db->get();

        return $query->result();
    }

	function print_akhir($ttgl_akhir)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('perguruan_tinggi.*, pengguna.nama_lengkap');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = perguruan_tinggi.id_pengguna', 'left');
        // $this->db->where('datecreated >=', $tgl_sekarng);
        $this->db->where('perguruan_tinggi.datecreated <=', $ttgl_akhir);
        $this->db->order_by('kode_pt','ASC');
        $query = $this->db->get();

        return $query->result();
    }
    
    function print_awal($ttgl_awal)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('perguruan_tinggi.*, pengguna.nama_lengkap');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = perguruan_tinggi.id_pengguna', 'left');
        // $this->db->where('datecreated >=', $tgl_sekarng);
        $this->db->where('perguruan_tinggi.datecreated >=', $ttgl_awal);
        $this->db->order_by('kode_pt','ASC');
        $query = $this->db->get();

        return $query->result();
    }
    
    function print_awal_akhir($ttgl_awal, $ttgl_akhir)
    {
    	$tgl_sekarng = date("Y-m-d");

    	$this->db->select('perguruan_tinggi.*, pengguna.nama_lengkap');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'pengguna.id_pengguna = perguruan_tinggi.id_pengguna', 'left');
        $this->db->where('perguruan_tinggi.datecreated >=', $ttgl_awal);
        $this->db->where('perguruan_tinggi.datecreated <=', $ttgl_akhir);
        $this->db->order_by('kode_pt','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		return $this->db->get_where($this->table, array('kode_pt' => $id))->row();
	}

	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	// menambah data
    function add_pt_pengguna($data_pt_pengguna){
		$this->db->insert('pt_pengguna', $data_pt_pengguna);
	}

	// update data
	function update($kode_pt, $data)
	{
		$this->db->where('kode_pt', $kode_pt);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
        $this->db->delete($this->table, array('kode_pt' => $id));
		$this->db->delete('pt_pengguna', array('kode_pt' => $id));
	}

	// cek validasi unique
	function valid_nama_pt($nama_pt)
	{
		$query = $this->db->get_where($this->table, array('nama_pt' => $nama_pt));
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

/* End of file pt_m.php */
/* Location: ./application/models/pt_m.php */