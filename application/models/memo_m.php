<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Memo_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'memo';
	

	// mendapatkan semua data
	function getAll(){
		$idp = $this->session->userdata('idp');
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_pengguna', $idp);
        $this->db->order_by('id_memo','ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by('id_memo');
		return $this->db->get($this->table);
	}

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		return $this->db->get_where($this->table, array('id_memo' => $id))->row();
	}

	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id_memo, $data)
	{
		$this->db->where('id_memo', $id_memo);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
		$this->db->delete($this->table, array('id_memo' => $id));
	}

	// cek validasi unique
	function valid_judulmemo($judul_memo)
	{
		$idp = $this->session->userdata('idp');
		$query = $this->db->get_where($this->table, array('judul_memo' => $judul_memo, 'id_pengguna' => $idp));
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

/* End of file memo_m.php */
/* Location: ./application/models/memo_m.php */