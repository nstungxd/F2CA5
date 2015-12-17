<?php
class exercise extends MY_Model {
	var $tbl_exercise;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_exercise = $TABLE['exercise'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_exercise, $data);
	}
	
	function update($seq, $data)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->update($this->tbl_exercise, $data, $where);
	}
	
	function delete($seq)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->delete($this->tbl_exercise, $where);
	}
	
	function is_reg($seq)
	{
		$where = array(
				'Seq' => $seq
			);
			
		if ($this->dbop->count($this->tbl_exercise, $where) > 0)
			return true;
		else
			return false;
	}

	function get($where)
	{
		return $this->dbop->row_where($this->tbl_exercise, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_exercise, $where);
	}

	function all()
	{
		return $this->dbop->all($this->tbl_exercise, array("Type"=>"asc", "ExCode"=>"asc", "Name"=>"asc", "Seq"=>"asc"));
	}
}
?>