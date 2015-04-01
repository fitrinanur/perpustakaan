<?php
 class M_peminjaman extends CI_Model{
 	private $table = "transaksi";

 	function getAnggota()
 	{
 		return $this->db->get("anggota");
 	}
 	function cariAnggota($id)
 	{
 		$this->db->where("id",$id);
 		$this->db->get("anggota");
 	}
 	function cariBuku($id)
 	{
 		$this->db->where("id",$id);
 		$this->db->get("buku");
 	}
 	function saveTmp($info)
 	{
 		$this->db->insert("tmp",$info);
 	}
 	function showTmp()
 	{
 		return $this->db->get("tmp");
 	}
 	function cekTmp($id)
 	{
 		$this->db->where("id",$id);
 		$this->db->get("tmp");
 	}
 	

 }
?>
