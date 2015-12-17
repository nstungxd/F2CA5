<?php
class userattendhistory extends MY_Model {
	var $tbl_userattendhistory;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_userattendhistory = $TABLE['userattendhistory'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_userattendhistory, $data);
	}
	
	function delete($seq)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->delete($this->tbl_userattendhistory, $where);
	}

	function getcount($userseq, $date) 
	{
		try {
			$monthstart = monthstart($date);
			$monthend = monthend($date);

			global $TABLE;
			$sql = sprintf("
				 SELECT * FROM %s A
				 WHERE UserSeq='%s' AND AttendDt>='%s' AND AttendDt<='%s'
				",
				$this->tbl_userattendhistory,
				$userseq,
				$monthstart,
				$monthend);

			$list = $this->dbop->execSQL($sql);
			return count($list);
		}
		catch (Exception $e) {
		}
		return 0;
	}
}
?>