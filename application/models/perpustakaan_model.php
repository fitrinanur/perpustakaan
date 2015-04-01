<?php
	class Perpustakaan_model extends CI_model
	{
		function get_records($field, $table, $where)
		{
			$query = 'SELECT'.$field. 'FROM' .$table.''.$where;
			return $this->db->query($query);
		}
		function save_records($data,$table)
		{
			$return =FALSE;
			if ($this->db->insert($table,$data))
				{	$return=TRUE;	}
			return $return;

		}
		function update_records($id, $data, $field, $table)
		{
			$return = FALSE;
			$this->db->where($field, $id);
			if ($this->db->update($table, $data))
				{	$return = TRUE;	}
			return $return;
		}
		function delete_records($id, $field, $table)
		{
			$return = FALSE;
			$this->db->where($field, $id);
			if ($this->db->delete($table))
				{	$return = TRUE;	}
			return $return;
		}
	}


?>
