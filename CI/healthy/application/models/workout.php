<?php
class workout extends MY_Model {
    var $tbl_workout;
    function __construct()
    {
        global $TABLE;
        $this->tbl_workout = $TABLE['workout'];
        parent::__construct();
    }

    function add($data)
    {
        $this->dbop->insert($this->tbl_workout, $data);
    }

    function update($seq, $data)
    {
        $where = array(
            'Seq' => $seq
        );
        $this->dbop->update($this->tbl_workout, $data, $where);
    }

    function delete($seq)
    {
        $where = array(
            'Seq' => $seq
        );
        $this->dbop->delete($this->tbl_workout, $where);
    }

    function is_reg($seq)
    {
        $where = array(
            'Seq' => $seq
        );

        if ($this->dbop->count($this->tbl_workout, $where) > 0)
            return true;
        else
            return false;
    }

    function get($seq)
    {
        $where = array(
            'Seq' => $seq
        );
        return $this->dbop->row_where($this->tbl_workout, $where);
    }

    function get2($where)
    {
        return $this->dbop->row_where($this->tbl_workout, $where);
    }

    function lists($where)
    {
        return $this->dbop->get_where($this->tbl_workout, $where);
    }
    function all()
    {
        return $this->dbop->all($this->tbl_workout, array("Name"=>"asc", "Seq"=>"asc"));
    }

}