<?php
class dailyhealthgrade extends MY_Model {
	var $tbl_dailyhealthgrade;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_dailyhealthgrade = $TABLE['dailyhealthgrade'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_dailyhealthgrade, $data);
	}
	
	function delete($where)
	{
		$this->dbop->delete($this->tbl_dailyhealthgrade, $where);
	}
	
	function get($where)
	{
		return $this->dbop->row_where($this->tbl_dailyhealthgrade, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_dailyhealthgrade, $where);
	}

	function update($data, $where)
	{
		$this->dbop->update($this->tbl_dailyhealthgrade, $data, $where);
	}
}

?>