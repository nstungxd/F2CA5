<?php
class center extends MY_Model {
	var $tbl_center;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_center = $TABLE['center'];
        parent::__construct();
    }
	
	function add($data)
	{
		$this->dbop->insert($this->tbl_center, $data);
	}
	
	function update($seq, $data)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->update($this->tbl_center, $data, $where);
	}
	
	function delete($seq)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->delete($this->tbl_center, $where);
	}
	
	function is_reg($seq)
	{
		$where = array(
				'Seq' => $seq
			);
			
		if ($this->dbop->count($this->tbl_center, $where) > 0)
			return true;
		else
			return false;
	}

	function get($seq)
	{
		$where = array(
				'Seq' => $seq
			);
		return $this->dbop->row_where($this->tbl_center, $where);
	}

	function get2($where)
	{
		return $this->dbop->row_where($this->tbl_center, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_center, $where);
	}

	function all()
	{
		return $this->dbop->all($this->tbl_center, array("CenterNm"=>"asc", "Seq"=>"asc"));
	}
}
?>