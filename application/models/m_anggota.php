<?php 
/**
* 
*/
class M_anggota extends CI_Model
{
	private $table = "anggota";
	private $primary = "id";
	
	function all($offset = 0, $limit= 10, $order_type='asc', $order_column='')
	{
		if(empty($order_column) || empty($order_type))
			$this->db->order_by($this->primary,'asc');
		else
			$this->db->order_by($order_type,$order_column);
			return $this->db->get($this->table,$limit,$offset);
	}
	function count_all()
	{
		return $this->db->count_all($this->table);
	}
	function check($kode)
	{
		$this->db->where($this->primary,$kode);
		return $this->db->get($this->table);
	}
	function save($jenis)
	{
		$this->db->insert($this->table,$jenis);
		return $this->db->insert_id();
	}
	function update($kode,$jenis)
	{
		$this->db->where($this->primary,$kode);
		$this->db->update($this->table,$jenis);
	}
	function delete($kode)
	{
		$this->db->where($this->primary,$kode);
		$this->db->delete($this->table);
	}
	function search($keyword)
	{
		$this->db->like($this->primary,$keyword);
		$this->db->or_like("nama",$keyword);
		return $this->db->get($this->table);
	}
}


?>