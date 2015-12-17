<?php
class category extends MY_Model {
	var $tbl_category;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_category = $TABLE['category'];
        parent::__construct();
    }
	
	function add($data)
	{
		$this->dbop->insert($this->tbl_category, $data);
	}
	
	function update($seq, $data)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->update($this->tbl_category, $data, $where);
	}
	
	function delete($seq)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->delete($this->tbl_category, $where);
	}
	
	function is_reg($seq)
	{
		$where = array(
				'Seq' => $seq
			);
			
		if ($this->dbop->count($this->tbl_category, $where) > 0)
			return true;
		else
			return false;
	}

	function get($seq)
	{
		$where = array(
				'Seq' => $seq
			);
		return $this->dbop->row_where($this->tbl_category, $where);
	}

	function get2($where)
	{
		return $this->dbop->row_where($this->tbl_category, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_category, $where);
	}

	function all()
	{
		return $this->dbop->all($this->tbl_category, array("Seq"=>"asc"));
	}
}
?>