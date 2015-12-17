<?php
class groups extends MY_Model {
    var $tbl_groups;
    function __construct()
    {
        global $TABLE;
        $this->tbl_groups = $TABLE['groups'];
        parent::__construct();
    }

    function add($data)
    {
        $this->dbop->insert($this->tbl_groups, $data);
    }

    function update($seq, $data)
    {
        $where = array(
            'Seq' => $seq
        );
        $this->dbop->update($this->tbl_groups, $data, $where);
    }

    function delete($seq)
    {
        $where = array(
            'Seq' => $seq
        );
        $this->dbop->delete($this->tbl_groups, $where);
    }

    function is_reg($seq)
    {
        $where = array(
            'Seq' => $seq
        );

        if ($this->dbop->count($this->tbl_groups, $where) > 0)
            return true;
        else
            return false;
    }

    function get($seq)
    {
        $where = array(
            'Seq' => $seq
        );
        return $this->dbop->row_where($this->tbl_groups, $where);
    }

    function get2($where)
    {
        return $this->dbop->row_where($this->tbl_groups, $where);
    }

    function lists($where)
    {
        return $this->dbop->get_where($this->tbl_groups, $where);
    }
    function all()
    {
        return $this->dbop->all($this->tbl_groups, array("Name"=>"asc", "Seq"=>"asc"));
    }

}
?>