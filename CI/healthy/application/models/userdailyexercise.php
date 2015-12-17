<?php
class userdailyexercise extends MY_Model {
	var $tbl_userdailyexercise;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_userdailyexercise = $TABLE['userdailyexercise'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_userdailyexercise, $data);
	}
	
	function delete($where)
	{
		$this->dbop->delete($this->tbl_userdailyexercise, $where);
	}
	
	function get($where)
	{
		return $this->dbop->row_where($this->tbl_userdailyexercise, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_userdailyexercise, $where);
	}

	function update($where, $data)
	{
		$this->dbop->update($this->tbl_userdailyexercise, $data, $where);
	}
}
?>