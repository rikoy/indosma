<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teman_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'kelas_pengguna';
	

	// mendapatkan semua data
	function getAll(){
		$idp = $this->session->userdata('idp');
		$query = $this->db->query("SELECT b.nama_lengkap, b.id_pengguna, b.status_pengguna, b.foto_profil FROM pt_pengguna AS a
									LEFT JOIN pengguna AS b ON b.id_pengguna = a.id_pengguna 
									WHERE b.id_pengguna != '$idp' AND kode_pt IN
                            			(SELECT kode_pt FROM pt_pengguna WHERE id_pengguna = '$idp') GROUP BY b.id_pengguna");

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by('id_kelas_pengguna');
		return $this->db->get($this->table);
	}

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		return $this->db->get_where('pengguna', array('id_pengguna' => $id))->row();
	}

	// menambah data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id_kelas_pengguna, $data)
	{
		$this->db->where('id_kelas_pengguna', $id_kelas_pengguna);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
		$this->db->delete($this->table, array('id_kelas_pengguna' => $id));
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

/* End of file teman_m.php */
/* Location: ./application/models/teman_m.php */