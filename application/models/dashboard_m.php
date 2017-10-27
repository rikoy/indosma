<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

	public function get_data($induk=0)
	{
		$data = array();
		$this->db->from('multileveldata');
		$this->db->where('induk',$induk);
		$result = $this->db->get();
	
		foreach($result->result() as $row)
		{
			$data[] = array(
					'id'	=>$row->id,
					'nama'	=>$row->nama,
					// recursive
					'child'	=>$this->get_data($row->id)
				);
		}
		return $data;
	}
	
	public function get_child($id)
	{
		$data = array();
		$this->db->from('multileveldata');
		$this->db->where('induk',$id);
		$result = $this->db->get();
		foreach($result->result() as $row)
		{
			$data[$row->id] = $row->nama;
		}
		return $data;
	}

	// mendapatkan satu data berdasarkan id
	function get_pt($id)
	{
		return $this->db->get_where('perguruan_tinggi', array('kode_pt' => $id))->row();
	}

}

/* End of file dashboard_m.php */
/* Location: ./application/models/dashboard_m.php */