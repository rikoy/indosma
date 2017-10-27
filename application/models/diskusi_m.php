<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diskusi_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'diskusi';
	
	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	function add_komen($data){
		$this->db->insert('jawab_diskusi', $data);
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
		$this->db->delete($this->table, array('id_diskusi' => $id));
		$this->db->delete('jawab_diskusi', array('id_diskusi' => $id));
	}

	// hapus data
	function delete_komen($id)
	{
		$this->db->delete('jawab_diskusi', array('id_jawab_diskusi' => $id));
	}
	

}

/* End of file diskusi_m.php */
/* Location: ./application/models/diskusi_m.php */