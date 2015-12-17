<?php
class userexercise extends MY_Model {
	var $tbl_userexercise;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_userexercise = $TABLE['userexercise'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_userexercise, $data);
	}
	
	function delete($where)
	{
		$this->dbop->delete($this->tbl_userexercise, $where);
	}
	
	function get($where)
	{
		return $this->dbop->row_where($this->tbl_userexercise, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_userexercise, $where);
	}
}
?>