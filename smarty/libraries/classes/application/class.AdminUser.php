<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        AdminUser
* GENERATION DATE:  20.03.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.AdminUser.php
* FOR MYSQL TABLE:  b2b_administrator
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class AdminUser {


/**
*   @desc Variable Declaration with default value
*/

	protected $iAdminId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iAdminId;
	protected $_eType;
	protected $_vFirstName;
	protected $_vLastName;
	protected $_vEmail;
	protected $_vUsername;
	protected $_vPassword;
	protected $_iQuestionId;
	protected $_vCountry;
	protected $_vAnswer;
	protected $_vFromIP;
	protected $_vAddress1;
	protected $_vAddress2;
	protected $_vState;
	protected $_vCity;
	protected $_vZip;
	protected $_vPhone;
	protected $_vMobile;
	protected $_vFax;
	protected $_dDate;
	protected $_dLastAccess;
	protected $_iTotLogin;
	protected $_eStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct() {
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iAdminId = null;
		$this->_eType = null;
		$this->_vFirstName = null;
		$this->_vLastName = null;
		$this->_vEmail = null;
		$this->_vUsername = null;
		$this->_vPassword = null;
		$this->_iQuestionId = null;
		$this->_vCountry = null;
		$this->_vAnswer = null;
		$this->_vFromIP = null;
		$this->_vAddress1 = null;
		$this->_vAddress2 = null;
		$this->_vState = null;
		$this->_vCity = null;
		$this->_vZip = null;
		$this->_vPhone = null;
		$this->_vMobile = null;
		$this->_vFax = null;
		$this->_dDate = null;
		$this->_dLastAccess = null;
		$this->_iTotLogin = null;
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


	public function getiAdminId() {
		return $this->_iAdminId;
	}

	public function geteType() {
		return $this->_eType;
	}

	public function getvFirstName() {
		return $this->_vFirstName;
	}

	public function getvLastName() {
		return $this->_vLastName;
	}

	public function getvEmail() {
		return $this->_vEmail;
	}

	public function getvUsername() {
		return $this->_vUsername;
	}

	public function getvPassword() {
		return $this->_vPassword;
	}

	public function getiQuestionId() {
		return $this->_iQuestionId;
	}

	public function getvCountry() {
		return $this->_vCountry;
	}

	public function getvAnswer() {
		return $this->_vAnswer;
	}

	public function getvFromIP() {
		return $this->_vFromIP;
	}

	public function getvAddress1() {
		return $this->_vAddress1;
	}

	public function getvAddress2() {
		return $this->_vAddress2;
	}

	public function getvState() {
		return $this->_vState;
	}

	public function getvCity() {
		return $this->_vCity;
	}

	public function getvZip() {
		return $this->_vZip;
	}

	public function getvPhone() {
		return $this->_vPhone;
	}

	public function getvMobile() {
		return $this->_vMobile;
	}

	public function getvFax() {
		return $this->_vFax;
	}

	public function getdDate() {
		return $this->_dDate;
	}

	public function getdLastAccess() {
		return $this->_dLastAccess;
	}

	public function getiTotLogin() {
		return $this->_iTotLogin;
	}

	public function geteStatus() {
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiAdminId($val) {
		 $this->_iAdminId =  $val;
	}

	public function seteType($val) {
		 $this->_eType =  $val;
	}

	public function setvFirstName($val) {
		 $this->_vFirstName =  $val;
	}

	public function setvLastName($val) {
		 $this->_vLastName =  $val;
	}

	public function setvEmail($val) {
		 $this->_vEmail =  $val;
	}

	public function setvUsername($val) {
		 $this->_vUsername =  $val;
	}

	public function setvPassword($val) {
		 $this->_vPassword =  $val;
	}

	public function setiQuestionId($val) {
		 $this->_iQuestionId =  $val;
	}

	public function setvCountry($val) {
		 $this->_vCountry =  $val;
	}

	public function setvAnswer($val) {
		 $this->_vAnswer =  $val;
	}

	public function setvFromIP($val) {
		 $this->_vFromIP =  $val;
	}

	public function setvAddress1($val) {
		 $this->_vAddress1 =  $val;
	}

	public function setvAddress2($val) {
		 $this->_vAddress2 =  $val;
	}

	public function setvState($val) {
		 $this->_vState =  $val;
	}

	public function setvCity($val) {
		 $this->_vCity =  $val;
	}

	public function setvZip($val) {
		 $this->_vZip =  $val;
	}

	public function setvPhone($val) {
		 $this->_vPhone =  $val;
	}

	public function setvMobile($val) {
		 $this->_vMobile =  $val;
	}

	public function setvFax($val) {
		 $this->_vFax =  $val;
	}

	public function setdDate($val) {
		 $this->_dDate =  $val;
	}

	public function setdLastAccess($val) {
		 $this->_dLastAccess =  $val;
	}

	public function setiTotLogin($val) {
		 $this->_iTotLogin =  $val;
	}

	public function seteStatus($val) {
		 $this->_eStatus =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id) {
		 $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_administrator WHERE iAdminId = $id";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iAdminId = $row[0]['iAdminId'];
		 $this->_eType = $row[0]['eType'];
		 $this->_vFirstName = $row[0]['vFirstName'];
		 $this->_vLastName = $row[0]['vLastName'];
		 $this->_vEmail = $row[0]['vEmail'];
		 $this->_vUsername = $row[0]['vUsername'];
		 $this->_vPassword = $row[0]['vPassword'];
		 $this->_iQuestionId = $row[0]['iQuestionId'];
		 $this->_vCountry = $row[0]['vCountry'];
		 $this->_vAnswer = $row[0]['vAnswer'];
		 $this->_vFromIP = $row[0]['vFromIP'];
		 $this->_vAddress1 = $row[0]['vAddress1'];
		 $this->_vAddress2 = $row[0]['vAddress2'];
		 $this->_vState = $row[0]['vState'];
		 $this->_vCity = $row[0]['vCity'];
		 $this->_vZip = $row[0]['vZip'];
		 $this->_vPhone = $row[0]['vPhone'];
		 $this->_vMobile = $row[0]['vMobile'];
		 $this->_vFax = $row[0]['vFax'];
		 $this->_dDate = $row[0]['dDate'];
		 $this->_dLastAccess = $row[0]['dLastAccess'];
		 $this->_iTotLogin = $row[0]['iTotLogin'];
		 $this->_eStatus = $row[0]['eStatus'];

           return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id) {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_administrator WHERE iAdminId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert() {
		 $this->iAdminId = ""; // clear key for autoincrement

		 $Data = array(
						 'eType'		=>	$this->_eType,
						'vFirstName'		=>	$this->_vFirstName,
						'vLastName'		=>	$this->_vLastName,
						'vEmail'		=>	$this->_vEmail,
						'vUsername'		=>	$this->_vUsername,
						'vPassword'		=>	$this->_vPassword,
						'iQuestionId'		=>	$this->_iQuestionId,
						'vCountry'		=>	$this->_vCountry,
						'vAnswer'		=>	$this->_vAnswer,
						'vFromIP'		=>	$this->_vFromIP,
						'vAddress1'		=>	$this->_vAddress1,
						'vAddress2'		=>	$this->_vAddress2,
						'vState'		=>	$this->_vState,
						'vCity'		=>	$this->_vCity,
						'vZip'		=>	$this->_vZip,
						'vPhone'		=>	$this->_vPhone,
						'vMobile'		=>	$this->_vMobile,
						'vFax'		=>	$this->_vFax,
						'dDate'		=>	$this->_dDate,
						'dLastAccess'		=>	$this->_dLastAccess,
						'iTotLogin'		=>	$this->_iTotLogin,
						'eStatus'		=>	$this->_eStatus
                        );
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_administrator",$Data,'insert');
		 return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($upd) {

          $Data = array(
						 'eType'		=>	$this->_eType,
						'vFirstName'		=>	$this->_vFirstName,
						'vLastName'		=>	$this->_vLastName,
						'vEmail'		=>	$this->_vEmail,
						'vUsername'		=>	$this->_vUsername,
						'vPassword'		=>	$this->_vPassword,
						'iQuestionId'		=>	$this->_iQuestionId,
						'vCountry'		=>	$this->_vCountry,
						'vAnswer'		=>	$this->_vAnswer,
						'vFromIP'		=>	$this->_vFromIP,
						'vAddress1'		=>	$this->_vAddress1,
						'vAddress2'		=>	$this->_vAddress2,
						'vState'		=>	$this->_vState,
						'vCity'		=>	$this->_vCity,
						'vZip'		=>	$this->_vZip,
						'vPhone'		=>	$this->_vPhone,
						'vMobile'		=>	$this->_vMobile,
						'vFax'		=>	$this->_vFax,
						'dDate'		=>	$this->_dDate,
						'dLastAccess'		=>	$this->_dLastAccess,
						'iTotLogin'		=>	$this->_iTotLogin,
						'eStatus'		=>	$this->_eStatus
                      );
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_administrator",$Data,'update',$upd);
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
	*   @desc   GET ADMIN DETAILS
	*/

   function getAdminDetail($feild='*',$where='',$OrderBy='')
	{
		if($where != '') {
			$cnt = " Where 1 ".$where;
      }
      if($OrderBy != '') {
			$cnt .= " Order By ".$OrderBy;
      }

		 $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_administrator $cnt";
		 $row =  $this->_obj->MySQLSelect($sql);

       $this->_iAdminId = $row[0]['iAdminId'];
		 $this->_eType = $row[0]['eType'];
		 $this->_vFirstName = $row[0]['vFirstName'];
		 $this->_vLastName = $row[0]['vLastName'];
		 $this->_vEmail = $row[0]['vEmail'];
		 $this->_vUsername = $row[0]['vUsername'];
		 $this->_vPassword = $row[0]['vPassword'];
		 $this->_iQuestionId = $row[0]['iQuestionId'];
		 $this->_vCountry = $row[0]['vCountry'];
		 $this->_vAnswer = $row[0]['vAnswer'];
		 $this->_vFromIP = $row[0]['vFromIP'];
		 $this->_vAddress1 = $row[0]['vAddress1'];
		 $this->_vAddress2 = $row[0]['vAddress2'];
		 $this->_vState = $row[0]['vState'];
		 $this->_vCity = $row[0]['vCity'];
		 $this->_vZip = $row[0]['vZip'];
		 $this->_vPhone = $row[0]['vPhone'];
		 $this->_vMobile = $row[0]['vMobile'];
		 $this->_vFax = $row[0]['vFax'];
		 $this->_dDate = $row[0]['dDate'];
		 $this->_dLastAccess = $row[0]['dLastAccess'];
		 $this->_iTotLogin = $row[0]['iTotLogin'];
		 $this->_eStatus = $row[0]['eStatus'];
       return $row;
	}

	function getDetails($feild='*',$where='',$orderBy='',$groupBy='',$limit='')
	{
		if(trim($feild)=='')
		{
			$feild = '*';
		}
      if($where != '') {
         $cnt = " Where 1 ".$where;
      }
      if($orderBy != '') {
         $cnt .= " Order By ".$orderBy;
      }
		if($groupBy != '') {
			$cnt .= " Group By ".$groupBy;
      }
      $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_administrator $cnt $limit";
     // print $sql;
		$row =  $this->_obj->MySQLSelect($sql);
      return $row;
	}
}
?>