<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        State
* GENERATION DATE:  20.03.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.State.php
* FOR MYSQL TABLE:  b2b_state_master
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class State {


/**
*   @desc Variable Declaration with default value
*/

	protected $iStateId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iStateId;
	protected $_iCountryId;
	protected $_vCountryCode;
	protected $_vStateCode;
	protected $_vState;
	protected $_eStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct() {
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iStateId = null;
		$this->_iCountryId = null;
		$this->_vCountryCode = null;
		$this->_vStateCode = null;
		$this->_vState = null;
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


	public function getiStateId() {
		return $this->_iStateId;
	}

	public function getiCountryId() {
		return $this->_iCountryId;
	}

	public function getvCountryCode() {
		return $this->_vCountryCode;
	}

	public function getvStateCode() {
		return $this->_vStateCode;
	}

	public function getvState() {
		return $this->_vState;
	}

	public function geteStatus() {
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiStateId($val) {
		 $this->_iStateId =  $val;
	}

	public function setiCountryId($val) {
		 $this->_iCountryId =  $val;
	}

	public function setvCountryCode($val) {
		 $this->_vCountryCode =  $val;
	}

	public function setvStateCode($val) {
		 $this->_vStateCode =  $val;
	}

	public function setvState($val) {
		 $this->_vState =  $val;
	}

	public function seteStatus($val) {
		 $this->_eStatus =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id) {
		 $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_state_master WHERE iStateId = $id";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iStateId = $row[0]['iStateId'];
		 $this->_iCountryId = $row[0]['iCountryId'];
		 $this->_vCountryCode = $row[0]['vCountryCode'];
		 $this->_vStateCode = $row[0]['vStateCode'];
		 $this->_vState = $row[0]['vState'];
		 $this->_eStatus = $row[0]['eStatus'];

           return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id) {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_state_master WHERE iStateId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert() {
		 $this->iStateId = ""; // clear key for autoincrement

		 $Data = array(
						 'iCountryId'		=>	$this->_iCountryId,
						'vCountryCode'		=>	$this->_vCountryCode,
						'vStateCode'		=>	$this->_vStateCode,
						'vState'		=>	$this->_vState,
						'eStatus'		=>	$this->_eStatus
                        );
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_state_master",$Data,'insert');
		 return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($upd) {

		 $Data = array(
						 'iCountryId'		=>	$this->_iCountryId,
						'vCountryCode'		=>	$this->_vCountryCode,
						'vStateCode'		=>	$this->_vStateCode,
						'vState'		=>	$this->_vState,
						'eStatus'		=>	$this->_eStatus
                        );
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_state_master",$Data,'update',$upd);
		 return $result;

	}

	/**
	*   @desc   SET ALL VARIABLE
	*/

	function setAllVar($Arr) {
		$MethodArr = get_class_methods($this);
		foreach($Arr AS $KEY => $VAL) {
			$method = "set".$KEY;
			if(in_array($method , $MethodArr)) {
			  @call_user_method($method,$this,$VAL);
			}
		}
	}

	/**
	*   @desc   GET ALL VARIABLE
	*/

	function getAllVar() {
		$MethodArr = get_class_methods($this);
		$method_notArr=Array('getAllVar');
		$evalStr='';
		for($i=0;$i<count($MethodArr);$i++) {
			if(substr($MethodArr[$i] , 0 ,3) == 'get' && (!(in_array($MethodArr[$i],$method_notArr)))) {
				$var_name = substr($MethodArr[$i] , 3 );
				$evalStr.= 'global $'.$var_name.'; $'.$var_name.' = $this->'.$MethodArr[$i]."();";
			}
		}
		eval($evalStr);
	}

     /**
	*   @desc   GET STATE DETAILS
	*/

     function getStateDetail($feild='*',$where='',$OrderBy='') {
          if($where != '') {
             $cnt = " Where 1 ".$where;
          }
          if($OrderBy != '') {
             $cnt .= " Order By ".$OrderBy;
          }

		$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_state_master $cnt";
      $row =  $this->_obj->MySQLSelect($sql);

		$this->_iStateId = $row[0]['iStateId'];
		$this->_iCountryId = $row[0]['iCountryId'];
		$this->_vCountryCode = $row[0]['vCountryCode'];
		$this->_vStateCode = $row[0]['vStateCode'];
		$this->_vState = $row[0]['vState'];
		$this->_eStatus = $row[0]['eStatus'];

           return $row;
	}
}
?>