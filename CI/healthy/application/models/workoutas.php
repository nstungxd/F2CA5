<?php
class workoutas extends MY_Model {
    var $tbl_workoutas;
    function __construct()
    {
        global $TABLE;
        $this->tbl_workoutas = $TABLE['workoutas'];
        parent::__construct();
    }

    function add($data)
    {
        $this->dbop->insert($this->tbl_workoutas, $data);
    }

    function update($seq, $data)
    {
        $where = array(
            'Seq' => $seq
        );
        $this->dbop->update($this->tbl_workoutas, $data, $where);
    }

    function delete($seq)
    {
        $where = array(
            'Seq' => $seq
        );
        $this->dbop->delete($this->tbl_workoutas, $where);
    }

    function is_reg($seq)
    {
        $where = array(
            'Seq' => $seq
        );

        if ($this->dbop->count($this->tbl_workoutas, $where) > 0)
            return true;
        else
            return false;
    }

    function get($seq)
    {
        $where = array(
            'Seq' => $seq
        );
        return $this->dbop->row_where($this->tbl_workoutas, $where);
    }

    function get2($where)
    {
        return $this->dbop->row_where($this->tbl_workoutas, $where);
    }

    function lists($where)
    {
        return $this->dbop->get_where($this->tbl_workoutas, $where);
    }
    function all()
    {
        return $this->dbop->all($this->tbl_workoutas, array("Name"=>"asc", "Seq"=>"asc"));
    }

}