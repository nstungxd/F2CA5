<?php

/*
 *
 * -------------------------------------------------------
 * CLASSNAME:        UnitOfMeasure
 * GENERATION DATE:  17.04.2012
 * CLASS FILE:       /var/www/B2B/libraries/classes/application/class.UnitOfMeasure.php
 * FOR MYSQL TABLE:  b2b_unitofmeasure
 * FOR MYSQL DB:     B2B
 * -------------------------------------------------------
 * AUTHOR:
 * from: >> www.hiddenbrains.com
 * -------------------------------------------------------
 *
 */

class UnitOfMeasure {

    /**
     *   @desc Variable Declaration with default value
     */
    protected $iUnitId;   // KEY ATTR. WITH AUTOINCREMENT
    protected $_iUnitId;
    protected $_vUnitOfMeasure;
    protected $_tDescription;
    protected $_dADate;
    protected $_eStatus;

    /**
     *   @desc   CONSTRUCTOR METHOD
     */
    function __construct() {
        global $dbobj;
        $this->_obj = $dbobj;

        $this->_iUnitId = null;
        $this->_vUnitOfMeasure = null;
        $this->_tDescription = null;
        $this->_dADate = null;
        $this->_eStatus = null;
    }

    /**
     *   @desc   DECONSTRUCTOR METHOD
     */
    function __destruct() {
        unset($this->_dbobj);
    }

    /**
     *   @desc   GETTER METHODS
     */
    public function getiUnitId() {
        return $this->_iUnitId;
    }

    public function getvUnitOfMeasure() {
        return $this->_vUnitOfMeasure;
    }

    public function gettDescription() {
        return $this->_tDescription;
    }

    public function getdADate() {
        return $this->_dADate;
    }

    public function geteStatus() {
        return $this->_eStatus;
    }

    /**
     *   @desc   SETTER METHODS
     */
    public function setiUnitId($val) {
        $this->_iUnitId = $val;
    }

    public function setvUnitOfMeasure($val) {
        $this->_vUnitOfMeasure = $val;
    }

    public function settDescription($val) {
        $this->_tDescription = $val;
    }

    public function setdADate($val) {
        $this->_dADate = $val;
    }

    public function seteStatus($val) {
        $this->_eStatus = $val;
    }

    /**
     *   @desc   SELECT METHOD / LOAD
     */
    function select($id) {
        if (($id > 0) && (trim($id) != '')) {
            $sql = "SELECT * FROM " . PRJ_DB_PREFIX . "_unitofmeasure WHERE iUnitId = $id";
        } else {
            $sql = "SELECT * FROM " . PRJ_DB_PREFIX . "_unitofmeasure WHERE iUnitId=$this->_iUnitId ";
        }
        $row = $this->_obj->MySQLSelect($sql);

        $this->_iUnitId = $row[0]['iUnitId'];
        $this->_vUnitOfMeasure = $row[0]['vUnitOfMeasure'];
        $this->_tDescription = $row[0]['tDescription'];
        $this->_dADate = $row[0]['dADate'];
        $this->_eStatus = $row[0]['eStatus'];
        return $row;
    }

    /**
     *   @desc   DELETE
     */
    function delete($id) {
        $sql = "DELETE FROM " . PRJ_DB_PREFIX . "_unitofmeasure WHERE iUnitId = $id";
        return $result = $this->_obj->sql_query($sql);
    }

    /**
     *   @desc   INSERT
     */
    function insert($Data = array()) {
        $this->_iUnitId = '';
        $this->iUnitId = ""; // clear key for autoincrement

        if(!is_array($Data) || count($Data)<1) {
            $Data = array(
                'vUnitOfMeasure' => $this->_vUnitOfMeasure,
                'tDescription' => $this->_tDescription,
                'dADate' => $this->_dADate,
                'eStatus' => $this->_eStatus
            );
        }

        $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX . "_unitofmeasure", $Data, 'insert');
        return $result;
    }

    /**
     *   @desc   UPDATE
     */
    function update($where) {

        $Data = array(
            'vUnitOfMeasure' => $this->_vUnitOfMeasure,
            'tDescription' => $this->_tDescription,
            'dADate' => $this->_dADate,
            'eStatus' => $this->_eStatus
        );

        $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX . "_unitofmeasure", $Data, 'update', $where);
        return $result;
    }

    function updateData($data, $where) {
        $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX . "_unitofmeasure", $data, "update", $where);
        return $result;
    }

    /**
     *   @desc   SET ALL VARIABLE
     */
    function setAllVar($Data = array()) {
        $MethodArr = get_class_methods($this);
        if (count($Data) > 0) {
            foreach ($Data AS $KEY => $VAL) {
                $method = "set" . $KEY;
                if (in_array($method, $MethodArr)) {
                    @call_user_method($method, $this, $VAL);
                }
            }
        } else {
            foreach ($_REQUEST AS $KEY => $VAL) {
                $method = "set" . $KEY;
                if (in_array($method, $MethodArr)) {
                    @call_user_method($method, $this, $VAL);
                }
            }
        }
    }

    /**
     *   @desc   GET ALL VARIABLE
     */
    function getAllVar() {
        $MethodArr = get_class_methods($this);
        $method_notArr = Array('getAllVar');
        $evalStr = '';
        for ($i = 0; $i < count($MethodArr); $i++) {
            if (substr($MethodArr[$i], 0, 3) == 'get' && (!(in_array($MethodArr[$i], $method_notArr)))) {
                $var_name = substr($MethodArr[$i], 3);
                $evalStr.= 'global $' . $var_name . '; $' . $var_name . ' = $this->' . $MethodArr[$i] . "();";
            }
        }
        eval($evalStr);
    }

    /**
     *   @desc   GET DETAILS
     */
    function getDetails($feild = "*", $where = "", $orderBy = "", $groupBy = "", $limit = "") {
        if ($where != "") {
            $cnt = " Where 1 " . $where;
        }
        if ($groupBy != "") {
            $cnt .= " Group By " . $groupBy;
        }
        if ($orderBy != "") {
            $cnt .= " Order By " . $orderBy;
        }
        $sql = "SELECT $feild FROM " . PRJ_DB_PREFIX . "_unitofmeasure $cnt $limit";
        $row = $this->_obj->MySQLSelect($sql);
        return $row;
    }

    /**
     *   @desc   GET DETAILS WITH PAGING AND JOINED TABLE IF REQUIRED
     */
    function getJoinTableInfo($jtbl, $fields = "*", $where = "", $orderBy = "", $groupBy = "", $limit = "", $pg = "") {
        if ($where != "") {
            $cnt = " Where 1 " . $where;
            $cnt_count = " Where 1 " . $where;
        }
        if ($groupBy != "") {
            $cnt .= " Group By " . $groupBy;
            $cnt_count .= " Group By " . $groupBy;
        }
        if ($orderBy != "") {
            $cnt .= " Order By " . $orderBy;
        }

        $sql = "SELECT $fields FROM " . PRJ_DB_PREFIX . "_unitofmeasure $jtbl $cnt $limit";
        $row = $this->_obj->MySQLSelect($sql);
        if ($pg == "yes") {
            $sql_count = "SELECT Count(*) as tot FROM " . PRJ_DB_PREFIX . "_unitofmeasure $jtbl $cnt_count";
            $row_count = $this->_obj->MySqlSelect($sql_count);
            $row[tot] = $row_count[0][tot];
        }
        return $row;
    }

}

?>