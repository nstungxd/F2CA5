<?php
class constant extends MY_Model {
	var $tbl_constant;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_constant = $TABLE['constant'];
        parent::__construct();
    }
	
	function get($where)
	{
		return $this->dbop->row_where($this->tbl_constant, $where);
	}

	function update($where, $data)
	{
		$this->dbop->update($this->tbl_constant, $data, $where);
	}
}
?>