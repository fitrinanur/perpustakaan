<?php
/**
* 
*/
class M_petugas extends CI_Model
{
	private $table = "petugas";
	private $primary = "id";

	function all($offset = 0, $limit= 10, $order_type = 'asc', $order_column = '')
	{
		if(empty($order_type)||empty($order_column))
			$this->db->order_by($this->primary,'asc');
		else
			$this->db->order_by($order_column,$order_type);
			return $this->db->get($this->table,$limit,$offset);
	}
	function count_all()
	{
		return $this->db->count_all($this->table);
	}
	function check($kode,$jenis)
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
		$this->db->where ($this->primary,$kode);
		$this->db->delete($this->table);
	}
	functin search($keyword)
	{
		$this->db->like($this->primary,$keyword)
		$this->db->or_like("nama",$keyword);
		return $this->db->get($this->table);
	}
}
?>