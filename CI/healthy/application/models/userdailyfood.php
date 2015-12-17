<?php
class userdailyfood extends MY_Model {
	var $tbl_userdailyfood;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_userdailyfood = $TABLE['userdailyfood'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_userdailyfood, $data);
	}
	
	function delete($where)
	{
		$this->dbop->delete($this->tbl_userdailyfood, $where);
	}
	
	function get($where)
	{
		return $this->dbop->row_where($this->tbl_userdailyfood, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_userdailyfood, $where);
	}
}
?>