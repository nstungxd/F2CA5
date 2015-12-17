<?php
class user extends MY_Model {
	var $tbl_user;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_user = $TABLE['user'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_user, $data);
	}
	
	function update($seq, $data)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->update($this->tbl_user, $data, $where);
	}
	
	function delete($seq)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->delete($this->tbl_user, $where);
	}
	
	function is_reg($seq)
	{
		$where = array(
				'Seq' => $seq
			);
			
		if ($this->dbop->count($this->tbl_user, $where) > 0)
			return true;
		else
			return false;
	}

	function get($seq)
	{
		$where = array(
				'Seq' => $seq
			);
		return $this->dbop->row_where($this->tbl_user, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_user, $where);
	}

	function all()
	{
		return $this->dbop->all($this->tbl_user, array("UserNm"=>"asc", "Seq"=>"asc"));
	}

	function is_reg_userid($userid)
	{
		$where = array(
				'UserID' => $userid
			);
			
		if ($this->dbop->count($this->tbl_user, $where) > 0)
			return true;
		else
			return false;
	}

	function get_by_userid($userid)
	{
		$where = array(
				'UserID' => $userid
			);

		return $this->dbop->row_where($this->tbl_user, $where);
	}

	function change_password($userid, $password)
	{
		$data = array(
				'UserPW' => $password
			);
		$where = array(
				'UserID' => $userid
			);

		$this->dbop->update($this->tbl_user, $data, $where);
	}

	
}
?>