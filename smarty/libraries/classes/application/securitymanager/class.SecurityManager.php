<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        Security Manager
* GENERATION DATE:  07.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.Security Manager.php
* FOR MYSQL TABLE:  b2b_security_manager
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class SecurityManager
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iSMID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iSMID;
	protected $_vUserName;
	protected $_vPassword;
	protected $_vEmail;
	protected $_vFirstName;
	protected $_vLastName;
	protected $_iSecretQuestion1ID;
	protected $_vAnswer;
	protected $_iSecretQuestion2ID;
	protected $_vAnwser;
	protected $_vAddressLine1;
	protected $_vAddressLine2;
	protected $_vAddressLine3;
	protected $_vCity;
	protected $_vState;
	protected $_vCountry;
	protected $_vZipcode;
	protected $_dAddedDate;
	protected $_dLastAccessDate;
	protected $_vIP;
	protected $_iAdminID;
	protected $_eVerify;
   protected $_vDefaltLan;
   protected $_eEmailNotification;
	protected $_vActivationCode;
	protected $_eStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iSMID = null;
		$this->_vUserName = null;
		$this->_vPassword = null;
		$this->_vEmail = null;
		$this->_vFirstName = null;
		$this->_vLastName = null;
		$this->_iSecretQuestion1ID = null;
		$this->_vAnswer = null;
		$this->_iSecretQuestion2ID = null;
		$this->_vAnwser = null;
		$this->_vAddressLine1 = null;
		$this->_vAddressLine2 = null;
		$this->_vAddressLine3 = null;
		$this->_vCity = null;
		$this->_vState = null;
		$this->_vCountry = null;
		$this->_vZipcode = null;
		$this->_dAddedDate = null;
		$this->_dLastAccessDate = null;
		$this->_vIP = null;
		$this->_iAdminID = null;
		$this->_eVerify = null;
		$this->_vDefaltLan = null;
		$this->_eEmailNotification = null;
		$this->_vActivationCode = null;
	}

/**
*   @desc   DECONSTRUCTOR METHOD
*/

	function __destruct()
	{
		unset($this->_dbobj);
	}



/**
*   @desc   GETTER METHODS
*/


	public function getiSMID()
	{
		return $this->_iSMID;
	}

	public function getvUserName()
	{
		return $this->_vUserName;
	}

	public function getvPassword()
	{
		return $this->_vPassword;
	}

	public function getvEmail()
	{
		return $this->_vEmail;
	}

	public function getvFirstName()
	{
		return $this->_vFirstName;
	}

	public function getvLastName()
	{
		return $this->_vLastName;
	}

	public function getiSecretQuestion1ID()
	{
		return $this->_iSecretQuestion1ID;
	}

	public function getvAnswer()
	{
		return $this->_vAnswer;
	}

	public function getiSecretQuestion2ID()
	{
		return $this->_iSecretQuestion2ID;
	}

	public function getvAnwser()
	{
		return $this->_vAnwser;
	}

	public function getvAddressLine1()
	{
		return $this->_vAddressLine1;
	}

	public function getvAddressLine2()
	{
		return $this->_vAddressLine2;
	}

	public function getvAddressLine3()
	{
		return $this->_vAddressLine3;
	}

	public function getvCity()
	{
		return $this->_vCity;
	}

	public function getvState()
	{
		return $this->_vState;
	}

	public function getvCountry()
	{
		return $this->_vCountry;
	}

	public function getvZipcode()
	{
		return $this->_vZipcode;
	}

	public function getdAddedDate()
	{
		return $this->_dAddedDate;
	}

	public function getdLastAccessDate()
	{
		return $this->_dLastAccessDate;
	}

	public function getvIP()
	{
		return $this->_vIP;
	}

	public function getiAdminID()
	{
		return $this->_iAdminID;
	}

	public function geteVerify()
	{
		return $this->_eVerify;
	}

	public function getvDefaltLan()
	{
		return $this->_vDefaltLan;
	}

	public function geteEmailNotification()
	{
		return $this->_eEmailNotification;
	}

	public function getvActivationCode()
	{
		return $this->_vActivationCode;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}

/**
*   @desc   SETTER METHODS
*/

	public function setiSMID($val)
	{
		$this->iSMID = $this->_iSMID = $val;
	}

	public function setvUserName($val)
	{
		 $this->_vUserName =  $val;
	}

	public function setvPassword($val)
	{
		 $this->_vPassword =  $val;
	}

	public function setvEmail($val)
	{
		 $this->_vEmail =  $val;
	}

	public function setvFirstName($val)
	{
		 $this->_vFirstName =  $val;
	}

	public function setvLastName($val)
	{
		$this->_vLastName =  $val;
	}

	public function setiSecretQuestion1ID()
	{
		$this->_iSecretQuestion1ID =  $val;
	}

	public function setvAnswer()
	{
		$this->_vAnswer =  $val;
	}

	public function setiSecretQuestion2ID()
	{
		$this->_iSecretQuestion2ID =  $val;
	}

	public function setvAnwser()
	{
		$this->_vAnwser =  $val;
	}

	public function setvAddressLine1($val)
	{
		$this->_vAddressLine1 =  $val;
	}

	public function setvAddressLine2($val)
	{
		 $this->_vAddressLine2 =  $val;
	}

	public function setvAddressLine3($val)
	{
		 $this->_vAddressLine3 =  $val;
	}

	public function setvCity($val)
	{
		 $this->_vCity =  $val;
	}

	public function setvState($val)
	{
		 $this->_vState =  $val;
	}

	public function setvCountry($val)
	{
		 $this->_vCountry =  $val;
	}

	public function setvZipcode($val)
	{
		 $this->_vZipcode =  $val;
	}

	public function setdAddedDate($val)
	{
		 $this->_dAddedDate =  $val;
	}

	public function setdLastAccessDate($val)
	{
		 $this->_dLastAccessDate =  $val;
	}

	public function setvIP($val)
	{
		 $this->_vIP =  $val;
	}

	public function setiAdminID($val)
	{
		 $this->_iAdminID =  $val;
	}

	public function seteVerify($val)
	{
		$this->_eVerify = $val;
	}

	public function setvDefaltLan($val)
	{
		 $this->_vDefaltLan =  $val;
	}

	public function seteEmailNotification($val)
	{
		 $this->_eEmailNotification =  $val;
	}

	public function setvActivationCode($val)
	{
		$this->_vActivationCode =  $val;
	}

	public function seteStatus($val)
	{
		$this->_eStatus =  $val;
	}

/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
		if(($id > 0) && (trim($id) != ''))
		{
			$sql = "SELECT * FROM ".PRJ_DB_PREFIX."_security_manager WHERE iSMID=$id";
		}
		else
		{
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_security_manager WHERE iSMID=$this->iSMID";
		}
		$row =  $this->_obj->MySQLSelect($sql);

		$this->_iSMID = $row[0]['iSMID'];
		$this->_vUserName = $row[0]['vUserName'];
		$this->_vPassword = $row[0]['vPassword'];
		$this->_vEmail = $row[0]['vEmail'];
		$this->_vFirstName = $row[0]['vFirstName'];
		$this->_vLastName = $row[0]['vLastName'];
		$this->_iSecretQuestion1ID = $row[0]['iSecretQuestion1ID'];
		$this->_vAnswer = $row[0]['vAnswer'];
		$this->_iSecretQuestion2ID = $row[0]['iSecretQuestion2ID'];
		$this->_vAnwser = $row[0]['vAnwser'];
		$this->_vAddressLine1 = $row[0]['vAddressLine1'];
		$this->_vAddressLine2 = $row[0]['vAddressLine2'];
		$this->_vAddressLine3 = $row[0]['vAddressLine3'];
		$this->_vCity = $row[0]['vCity'];
		$this->_vState = $row[0]['vState'];
		$this->_vCountry = $row[0]['vCountry'];
		$this->_vZipcode = $row[0]['vZipcode'];
		$this->_dAddedDate = $row[0]['dAddedDate'];
		$this->_dLastAccessDate = $row[0]['dLastAccessDate'];
		$this->_vIP = $row[0]['vIP'];
		$this->_iAdminID = $row[0]['iAdminID'];
		$this->_eVerify = $row[0]['eVerify'];
		$this->_vDefaltLan = $row[0]['vDefaltLan'];
		$this->_eEmailNotification = $row[0]['eEmailNotification'];
		$this->_vActivationCode = $row[0]['vActivationCode'];
		$this->_eStatus = $row[0]['eStatus'];
		return $row;
	}

/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_security_manager WHERE iSMID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}

	function del($where)
	{
           $sql = "DELETE FROM ".PRJ_DB_PREFIX."_security_manager WHERE 1 $where";
           //echo $sql;exit;
		  return $result = $this->_obj->sql_query($sql);
	}

/**
*   @desc   INSERT
*/

	function insert()
	{
		$this->iSMID = "";
		$this->_iSMID = "";	// clear key for autoincrement

		$Data = array(
						'vUserName'			=>	$this->_vUserName,
						'vPassword'			=>	$this->_vPassword,
						'vEmail'				=>	$this->_vEmail,
						'vFirstName'		=>	$this->_vFirstName,
						'vLastName'			=>	$this->_vLastName,
						'iSecretQuestion1ID'	=>	$this->_iSecretQuestion1ID,
						'vAnswer'			=>	$this->_vAnswer,
						'iSecretQuestion2ID'	=>	$this->_iSecretQuestion2ID,
						'vAnwser'			=>	$this->_vAnwser,
						'vAddressLine1'	=>	$this->_vAddressLine1,
						'vAddressLine2'	=>	$this->_vAddressLine2,
						'vAddressLine3'	=>	$this->_vAddressLine3,
						'vCity'				=>	$this->_vCity,
						'vState'				=>	$this->_vState,
						'vCountry'			=>	$this->_vCountry,
						'vZipcode'			=>	$this->_vZipcode,
						'dAddedDate'		=>	$this->_dAddedDate,
						'dLastAccessDate'	=>	$this->_dLastAccessDate,
						'vIP'					=>	$this->_vIP,
						'iAdminID'			=>	$this->_iAdminID,
						'eVerify'			=> $this->_eVerify,
						'vDefaltLan'			=>	$this->_vDefaltLan,
						'eEmailNotification'			=>	$this->_eEmailNotification,
						'vActivationCode' 	=> $this->_vActivationCode,
						'eStatus'			=>	$this->_eStatus
		);
      //prints($Data);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_security_manager",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{
		$Data = array(
						'vUserName'			=>	$this->_vUserName,
						'vPassword'			=>	$this->_vPassword,
						'vEmail'				=>	$this->_vEmail,
						'vFirstName'		=>	$this->_vFirstName,
						'vLastName'			=>	$this->_vLastName,
						'iSecretQuestion1ID'	=>	$this->_iSecretQuestion1ID,
						'vAnswer'			=>	$this->_vAnswer,
						'iSecretQuestion2ID'	=>	$this->_iSecretQuestion2ID,
						'vAnwser'			=>	$this->_vAnwser,
						'vAddressLine1'	=>	$this->_vAddressLine1,
						'vAddressLine2'	=>	$this->_vAddressLine2,
						'vAddressLine3'	=>	$this->_vAddressLine3,
						'vCity'				=>	$this->_vCity,
						'vState'				=>	$this->_vState,
						'vCountry'			=>	$this->_vCountry,
						'vZipcode'			=>	$this->_vZipcode,
						'dAddedDate'		=>	$this->_dAddedDate,
						'dLastAccessDate'	=>	$this->_dLastAccessDate,
						'vIP'			=>	$this->_vIP,
						'iAdminID'		=>	$this->_iAdminID,
						'eVerify'			=>   $this->_eVerify,
						'vDefaltLan'	    =>	$this->_vDefaltLan,
						'eEmailNotification'=>	$this->_eEmailNotification,
						'vActivationCode' 	=> $this->_vActivationCode,
						'eStatus'			=>	$this->_eStatus
		);
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_security_manager",$Data,'update',$where);
		 return $result;
	}

	function updateData($data,$where)
	{
     // prints($data);exit;
      //echo $where;exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_security_manager",$data,'update',$where);
		return $result;
	}

	/**
	*   @desc   SET ALL VARIABLE
	*/

	function setAllVar($Data=array())
	{
		$MethodArr = get_class_methods($this);
		if(count($Data) > 0){
			foreach($Data AS $KEY => $VAL) {
				$method = "set".$KEY;
				if(in_array($method , $MethodArr))
				{
				  @call_user_method($method,$this,$VAL);
				}
			}
		}else{
			foreach($_REQUEST AS $KEY => $VAL) {
				$method = "set".$KEY;
				if(in_array($method , $MethodArr))
				{
				  @call_user_method($method,$this,$VAL);
				}
			 }
		}
	}

	/**
	*   @desc   GET ALL VARIABLE
	*/

	function getAllVar()
	{
		$MethodArr = get_class_methods($this);
		$method_notArr=Array('getAllVar');
		$evalStr='';
		for($i=0;$i<count($MethodArr);$i++)
		{
			if(substr($MethodArr[$i] , 0 ,3) == 'get' && (!(in_array($MethodArr[$i],$method_notArr))))
			{
				$var_name = substr($MethodArr[$i] , 3 );
				$evalStr.= 'global $'.$var_name.'; $'.$var_name.' = $this->'.$MethodArr[$i]."();";
			}
		}
		eval($evalStr);

		$Data = array(
						'vUserName'			=>	$this->_vUserName,
						'vPassword'			=>	$this->_vPassword,
						'vEmail'				=>	$this->_vEmail,
						'vFirstName'		=>	$this->_vFirstName,
						'vLastName'			=>	$this->_vLastName,
						'iSecretQuestion1ID'	=>	$this->_iSecretQuestion1ID,
						'vAnswer'			=>	$this->_vAnswer,
						'iSecretQuestion2ID'	=>	$this->_iSecretQuestion2ID,
						'vAnwser'			=>	$this->_vAnwser,
						'vAddressLine1'	=>	$this->_vAddressLine1,
						'vAddressLine2'	=>	$this->_vAddressLine2,
						'vAddressLine3'	=>	$this->_vAddressLine3,
						'vCity'				=>	$this->_vCity,
						'vState'				=>	$this->_vState,
						'vCountry'			=>	$this->_vCountry,
						'vZipcode'			=>	$this->_vZipcode,
						'dAddedDate'		=>	$this->_dAddedDate,
						'dLastAccessDate'	=>	$this->_dLastAccessDate,
						'vIP'					=>	$this->_vIP,
						'iAdminID'			=>	$this->_iAdminID,
						'eVerify'			=> $this->_eVerify,
						'vDefaltLan'	    =>	$this->_vDefaltLan,
						'eEmailNotification'=>	$this->_eEmailNotification,
						'vActivationCode' 	=> $this->_vActivationCode,
						'eStatus'			=>	$this->_eStatus
		);
		return $Data;
	}

     /**
	*   @desc   GET SECURITY MANAGER DETAILS
	*/

   function getDetails($feild='*',$where='',$orderBy='',$groupBy='',$limit='')
	{
       if($where != '') {
          $cnt = " Where 1 ".$where;
       }
       if($orderBy != '') {
          $cnt .= " Order By ".$orderBy;
       }
		 if($groupBy != '') {
          $cnt .= " Group By ".$groupBy;
       }
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_security_manager $cnt $limit";
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

	function getSMDashboardOrgStats($table,$where)
	{
		$grp = '';
		/*if($table == PRJ_DB_PREFIX."_organization_association") {
			$grp = " Group By vAssociationCode ";
			$sql = "select COUNT(vAssociationCode) from $table where eStatus='Active' AND eNeedToVerify!='Yes' Group By vAssociationCode";
			$rw =  $this->_obj->MySQLSelect($sql);
			$row[0]['act_org'] = @count($rw);
			$sql = "select COUNT(vAssociationCode) from $table where eStatus='Inactive' AND eNeedToVerify!='Yes' Group By vAssociationCode";
			$rw =  $this->_obj->MySQLSelect($sql);
			$row[0]['inact_org'] = @count($rw);
			$sql = "select COUNT(vAssociationCode) from $table where (eStatus='Need to Verify' OR eStatus='Modified' OR eStatus='Delete' OR eNeedToVerify='Yes') Group By vAssociationCode";
			$rw =  $this->_obj->MySQLSelect($sql);
			$row[0]['verify_org'] = @count($rw);
			$sql = "select COUNT(vAssociationCode) from $table Group By vAssociationCode";
			$rw =  $this->_obj->MySQLSelect($sql);
			$row[0]['tot'] = @count($rw);
			// prints($row); exit;
		} else {*/
		$sql = "Select (select count(*) from $table where eStatus='Active' AND eNeedToVerify!='Yes') as act_org,
					(select count(*) from $table where eStatus='Inactive' AND eNeedToVerify!='Yes' ) as inact_org,
					(select count(*) from $table where (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes') ) as verify_org,
					(select count(*) from $table ) as tot"; 	// OR eStatus='Delete'
			$row =  $this->_obj->MySQLSelect($sql);
		//}
		// echo $sql; exit;
      return $row;
	}

	function getSMDashboardUsrStats($table,$type)
	{
		$sql = "Select (select count(iUserID) from $table ou inner join b2b_organization_master org on (ou.iOrganizationID=org.iOrganizationID AND NOT (org.eStatus='Delete' AND org.eNeedToVerify='No')) where eUserType='$type' AND ou.eStatus='Active') as act_usr,
					(select count(iUserID) from $table ou inner join b2b_organization_master org on (ou.iOrganizationID=org.iOrganizationID AND NOT (org.eStatus='Delete' AND org.eNeedToVerify='No')) where eUserType='$type' AND ou.eStatus='Inactive') as inact_usr,
					(select count(iUserID) from $table ou inner join b2b_organization_master org on (ou.iOrganizationID=org.iOrganizationID AND NOT (org.eStatus='Delete' AND org.eNeedToVerify='No')) where eUserType='$type' AND (ou.eStatus='Need to Verify' OR ou.eStatus='Modified' OR ou.eNeedToVerify='Yes')) as verify_usr,
					(select count(iUserID) from $table ou inner join b2b_organization_master org on (ou.iOrganizationID=org.iOrganizationID AND NOT (org.eStatus='Delete' AND org.eNeedToVerify='No')) where eUserType='$type') as tot"; 	// OR eStatus='Delete'
		$row =  $this->_obj->MySQLSelect($sql);
      return $row;
	}
}
?>