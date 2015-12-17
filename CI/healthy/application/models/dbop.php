<?php
// 모든 DB관련조작 진행
class dbop extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

	function str2sql($string)
	{
		return implode("\'", explode("'", $string));
	}
	
	function query($sql)
	{
		return $this->db->query($sql);
	}
	
	function get($sql)
	{
		try
		{
			$ret = array();
			
			$query = $this->db->query($sql);
			$ret['data'] = $query->result();
			$ret['rc'] = $query->num_rows();
			$ret['fc'] = $query->num_fields();
			
			return $ret;
		}
		catch (Exception $e)
		{
			return null;
		}
	}
	
	function row($sql)
	{
		try
		{
			$query = $this->db->query($sql);
			return $query->row();
		}
		catch (Exception $e)
		{
			return null;
		}
	}
	
	function execSQL($sql)
	{
		try
		{
			$query = $this->db->query($sql);
			return $query->result();
		}
		catch (Exception $e)
		{
			return null;
		}
	}

	function execQuery($sql)
	{
		try
		{
			$this->db->query($sql);
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	function bindRow($sql, $inarr)
	{
		//$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
		//$this->db->query($sql, array(3, 'live', 'Rick'));
		try
		{
			$query = $this->db->query($sql, $inarr);
			return $query->row();
		}
		catch (Exception $e)
		{
			return null;
		}
	}
	
	function bindSQL($sql, $inarr)
	{
		//$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
		//$this->db->query($sql, array(3, 'live', 'Rick'));
		try
		{
			$query = $this->db->query($sql, $inarr);
			return $query->result();
		}
		catch (Exception $e)
		{
			return null;
		}
	}
	
	function bindQuery($sql, $inarr)
	{
		try
		{
			$this->db->query($sql, $inarr);
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	function all($tbl, $orderby=array())
	{
		try
		{
			foreach ($orderby as $key=>$value)
			{
				$this->db->order_by($key, $value);
			}
			$query = $this->db->get($tbl);
			return $query->result();
		}
		catch (Exception $e)
		{
			return null;
		}
	}
	
	function get_where($tbl, $where, $orderby=array())
	{
		try
		{
			foreach ($orderby as $key=>$value)
			{
				$this->db->order_by($key, $value);
			}
			$query = $this->db->get_where($tbl, $where);
			return $query->result();
		}
		catch (Exception $e)
		{
			return null;
		}
	}
	
	/*
	function get_or_where($tbl, $where1, $where2)
	{
		try
		{
			$this->db->where($where1);
			$this->db->or_where($where2);
			$query = $this->db->get($tbl);
			return $query->result();
		}
		catch (Exception $e)
		{
			return null;
		}
	}
	*/
	function row_where($tbl, $where)
	{
		try
		{
			$query = $this->db->get_where($tbl, $where);
			return $query->row();
		}
		catch (Exception $e)
		{
			return null;
		}
	}
	
	function insert($tbl, $data)
	{
		/*
		$data = array(
               'title' => $title,
               'name' => $name,
               'date' => $date
            );
		*/
		try
		{
			$this->db->insert($tbl, $data);
			return mysql_insert_id();
		}
		catch (Exception $e)
		{
			return -1;
		}
		// Produces: INSERT INTO mytable (title, name, date) VALUES ('{$title}', '{$name}', '{$date}')
	}
	
	function update($tbl, $data, $where)
	{
		/*
		$data = array(
               'title' => $title,
               'name' => $name,
               'date' => $date
            );
        $where = array(
        		'id' => $id
        	)

		$this->db->where('id', $id);
		$this->db->update('mytable', $data);
		*/
		try
		{
			$this->db->where($where);
			$this->db->update($tbl, $data);
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
		// 생성결과:
		// UPDATE mytable
		// SET title = '{$title}', name = '{$name}', date = '{$date}'
		// WHERE id = $id
	}

	function delete($tbl, $where)
	{
		/*
		$this->db->where('id', $id);
		$this->db->delete('mytable');

		// 생성결과:
		// DELETE FROM mytable
		// WHERE id = $id
		*/
		try
		{
			$this->db->delete($tbl, $where);
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}

	function countall($tbl)
	{
		return $this->db->count_all_results($tbl);
	}
	
	function count($tbl, $where)
	{
		$this->db->where($where);
		return $this->db->count_all_results($tbl);
	}
	
	function escape($data)
	{
		return $this->db->escape($data);
	}
}
?>