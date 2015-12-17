<?php
class exercisetarget extends MY_Model {
	var $tbl_exercisetarget;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_exercisetarget = $TABLE['exercisetarget'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_exercisetarget, $data);
	}
	
	function delete($where)
	{
		$this->dbop->delete($this->tbl_exercisetarget, $where);
	}
	
	function get($where)
	{
		return $this->dbop->row_where($this->tbl_exercisetarget, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_exercisetarget, $where);
	}

	function all()
	{
		return $this->dbop->all($this->tbl_exercisetarget, array("Name"=>"asc"));
	}
}
?>