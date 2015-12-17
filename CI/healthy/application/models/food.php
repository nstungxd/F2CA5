<?php
class food extends MY_Model {
	var $tbl_food;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_food = $TABLE['food'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_food, $data);
	}
	
	function delete($where)
	{
		$this->dbop->delete($this->tbl_food, $where);
	}
	
	function get($where)
	{
		return $this->dbop->row_where($this->tbl_food, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_food, $where);
	}
}
?>