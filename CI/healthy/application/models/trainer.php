<?php
class trainer extends MY_Model {
	var $tbl_trainer;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_trainer = $TABLE['trainer'];
        parent::__construct();
    }
	
	function add($data)
	{
		$this->dbop->insert($this->tbl_trainer, $data);
	}
	
	function update($seq, $data)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->update($this->tbl_trainer, $data, $where);
	}
	
	function delete($seq)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->delete($this->tbl_trainer, $where);
	}
	
	function is_reg($seq)
	{
		$where = array(
				'Seq' => $seq
			);
			
		if ($this->dbop->count($this->tbl_trainer, $where) > 0)
			return true;
		else
			return false;
	}

	function get($seq)
	{
		$where = array(
				'Seq' => $seq
			);
		return $this->dbop->row_where($this->tbl_trainer, $where);
	}

	function get2($where)
	{
		return $this->dbop->row_where($this->tbl_trainer, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_trainer, $where);
	}
    function all()
    {
        return $this->dbop->all($this->tbl_trainer, array("Name"=>"asc", "Seq"=>"asc"));
    }

}
?>