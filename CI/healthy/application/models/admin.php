<?php
/*
|--------------------------------------------------------------------------
| Administrator Account Management Model
|--------------------------------------------------------------------------
|
| This model is worked to manage administrators of INZONE site.
|
*/
class admin extends CI_Model {
	var $tbl_admin;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_admin = $TABLE['admin'];
        parent::__construct();
    }
	
	// Get one administrator info
	function get($idx)
	{
		$where = array(
				'Seq' => $idx
			);
		return $this->dbop->row_where($this->tbl_admin, $where);
	}
	
	// Confirm administrator
	function confirm($adminid, $password)
	{
		$admin = $this->dbop->row_where($this->tbl_admin, array(
				'AdminID' => $adminid
			));
		if ($admin != null && $admin->AdminPW == $password)
		{
			return $admin;
		}
		return null;
	}
	
	// Update administrator info
	function update($olduserid, $newuserid, $newpassword)
	{
		return $this->dbop->update($this->tbl_admin, 
			array(
				'AdminID' => $newuserid,
				'AdminPW' => $newpassword
			), 
			array(
				'AdminID' => $newuserid,
				'AdminPW' => $newpassword
			));
	}
}
?>