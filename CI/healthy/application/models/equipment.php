<?php
class equipment extends MY_Model {
	var $tbl_equipment;
    function __construct()
    {
    	global $TABLE;
		$this->tbl_equipment = $TABLE['equipment'];
        parent::__construct();
    }
	
	function add($data)
	{
		return $this->dbop->insert($this->tbl_equipment, $data);
	}
	
	function update($seq, $data)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->update($this->tbl_equipment, $data, $where);
	}
	
	function delete($seq)
	{
		$where = array(
        		'Seq' => $seq
        	);
        $this->dbop->delete($this->tbl_equipment, $where);
	}
	
	function is_reg($seq)
	{
		$where = array(
				'Seq' => $seq
			);
			
		if ($this->dbop->count($this->tbl_equipment, $where) > 0)
			return true;
		else
			return false;
	}

	function get($where)
	{
		return $this->dbop->row_where($this->tbl_equipment, $where);
	}

	function lists($where)
	{
		return $this->dbop->get_where($this->tbl_equipment, $where);
	}
}
?>