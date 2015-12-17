<?php
class achiveratio extends MY_Model {
	var $tbl_achiveratio;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_achiveratio = $TABLE['achiveratio'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_achiveratio, $data);
	}

	function update($where, $data)
	{
		$this->dbop->update($this->tbl_achiveratio, $data, $where);
	}
	
	function delete($where)
	{
		$this->dbop->delete($this->tbl_achiveratio, $where);
	}
	
	function get($where)
	{
		return $this->dbop->row_where($this->tbl_achiveratio, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_achiveratio, $where);
	}

	function getratio($userseq, $month) 
	{
		$data = $this->get(array("UserSeq"=>$userseq, "AchiveMonth"=>$month));
		if ($data != null) {
			return $data->Value;
		}
		return 0;
	}

	function register($userseq, $month, $v)
	{
		$ratio = $this->get(array("UserSeq"=>$userseq, "AchiveMonth"=>$month));
		if ($ratio == null) {
			$this->add(array(
				"UserSeq" => $userseq,
				"Value" => $v,
				"AchiveMonth"=>$month,
				"UpdateDt" => now()
			));
		}
		else {
			$this->update(
				array("Seq" => $ratio->Seq),
				array(
					"UserSeq" => $userseq,
					"Value" => $v,
					"AchiveMonth" => $month,
					"UpdateDt" => now()
				));
		}
	}
}
?>