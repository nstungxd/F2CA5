<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        OrganizationUserToverify
* GENERATION DATE:  19.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.OrganizationUserToverify.php
* FOR MYSQL TABLE:  b2b_organization_user_toverify
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class OrganizationUserToverify
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iVerifiedID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iVerifiedID;
	protected $_iUserID;
	protected $_iOrganizationID;
	protected $_vFirstName;
	protected $_vLastName;
	protected $_eSalutation;
	protected $_vAddressLine1;
	protected $_vAddressLine2;
	protected $_vAddressLine3;
	protected $_vCity;
	protected $_vZipCode;
	protected $_vState;
	protected $_vCountry;
	protected $_vPhone;
	protected $_vExtention;
	protected $_vMobile;
	protected $_vEmail;
	protected $_vUserName;
	protected $_vPassword;
	protected $_iSecretQuestion1ID;
	protected $_vAnswer;
	protected $_iSecretQuestion2ID;
	protected $_vAnwser;
	protected $_ePermissionType;
	protected $_iGroupID;
	protected $_eUserType;
   protected $_dLastAccessDate;
	protected $_dCreatedDate;
	protected $_dModifiedDate;
	protected $_dVerifiedDate;
	protected $_dRejectedDate;
   protected $_iCreatedBy;
	protected $_eCreatedBy;
	protected $_iModifiedByID;
	protected $_eModifiedBy;
	protected $_iVerifiedSMID;
	protected $_eVerifiedBy;
	protected $_iRejectedById;
	protected $_eRejectedBy;
	protected $_tReasonToReject;
	protected $_eNeedToVerify;
	protected $_eStatus;
	protected $_vDefaltLan;
	protected $_eEmailNotification;

/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iVerifiedID = null;
		$this->_iUserID = null;
		$this->_iOrganizationID = null;
		$this->_vFirstName = null;
		$this->_vLastName = null;
		$this->_eSalutation = null;
		$this->_vAddressLine1 = null;
		$this->_vAddressLine2 = null;
		$this->_vAddressLine3 = null;
		$this->_vCity = null;
		$this->_vZipCode = null;
		$this->_vState = null;
		$this->_vCountry = null;
		$this->_vPhone = null;
		$this->_vExtention = null;
		$this->_vMobile = null;
		$this->_vEmail = null;
		$this->_vUserName = null;
		$this->_vPassword = null;
		$this->_iSecretQuestion1ID = null;
		$this->_vAnswer = null;
		$this->_iSecretQuestion2ID = null;
		$this->_vAnwser = null;
		$this->_ePermissionType = null;
		$this->_iGroupID = null;
		$this->_eUserType = null;
      $this->_dLastAccessDate = null;
		$this->_dCreatedDate = null;
		$this->_dModifiedDate = null;
		$this->_dVerifiedDate = null;
		$this->_dRejectedDate = null;
      $this->_iCreatedBy = null;
		$this->_eCreatedBy = null;
		$this->_iModifiedByID = null;
		$this->_eModifiedBy = null;
		$this->_iVerifiedSMID = null;
		$this->_eVerifiedBy = null;
		$this->_iRejectedById = null;
		$this->_eRejectedBy = null;
		$this->_tReasonToReject = null;
		$this->_eNeedToVerify = null;
		$this->_eStatus = null;
		$this->_vDefaltLan = null;
		$this->_eEmailNotification = null;
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


	public function getiVerifiedID()
	{
		return $this->_iVerifiedID;
	}

	public function getiUserID()
	{
		return $this->_iUserID;
	}

	public function getiOrganizationID()
	{
		return $this->_iOrganizationID;
	}

	public function getvFirstName()
	{
		return $this->_vFirstName;
	}

	public function getvLastName()
	{
		return $this->_vLastName;
	}

	public function geteSalutation()
	{
		return $this->_eSalutation;
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

	public function getvZipCode()
	{
		return $this->_vZipCode;
	}

	public function getvState()
	{
		return $this->_vState;
	}

	public function getvCountry()
	{
		return $this->_vCountry;
	}

	public function getvPhone()
	{
		return $this->_vPhone;
	}

	public function getvExtention()
	{
		return $this->_vExtention;
	}

	public function getvMobile()
	{
		return $this->_vMobile;
	}

	public function getvEmail()
	{
		return $this->_vEmail;
	}

	public function getvUserName()
	{
		return $this->_vUserName;
	}

	public function getvPassword()
	{
		return $this->_vPassword;
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

	public function getePermissionType()
	{
		return $this->_ePermissionType;
	}

	public function getiGroupID()
	{
		return $this->_iGroupID;
	}

	public function geteUserType()
	{
		return $this->_eUserType;
	}

     public function getdLastAccessDate() {
          return $this->_dLastAccessDate;
     }

     	public function getiCreatedBy()
	{
		return $this->_iCreatedBy;
	}

	public function geteCreatedBy()
	{
		return $this->_eCreatedBy;
	}

	public function getiModifiedByID()
	{
		return $this->_iModifiedByID;
	}

	public function geteModifiedBy()
	{
		return $this->_eModifiedBy;
	}

	public function getiVerifiedSMID()
	{
		return $this->_iVerifiedSMID;
	}

	public function getiRejectedById()
	{
	  return $this->_iRejectedById;
	}

	public function geteRejectedBy()
	{
	  return $this->_eRejectedBy;
	}

	public function geteNeedToVerify()
	{
		return $this->_eNeedToVerify;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}

     public function getvDefaltLan()
	{
		return $this->_vDefaltLan;
	}

     public function geteEmailNotification()
	{
		return $this->_eEmailNotification;
	}

	public function getdCreatedDate()
	{
		return $this->_dCreatedDate;
	}

	public function getdModifiedDate()
	{
		return $this->_dModifiedDate;
	}

	public function getdVerifiedDate()
	{
		return $this->_dVerifiedDate;
	}

	public function getdRejectedDate()
	{
	  return $this->_dRejectedDate;
	}

	public function gettReasonToReject()
   {
	  return $this->_tReasonToReject;
   }

	public function geteVerifiedBy()
	{
	   return $this->_eVerifiedBy;
	}

/**
*   @desc   SETTER METHODS
*/


	public function setiVerifiedID($val)
	{
		 $this->_iVerifiedID =  $val;
	}

	public function setiUserID($val)
	{
		 $this->_iUserID =  $val;
	}

	public function setiOrganizationID($val)
	{
		 $this->_iOrganizationID =  $val;
	}

	public function setvFirstName($val)
	{
		 $this->_vFirstName =  $val;
	}

	public function setvLastName($val)
	{
		 $this->_vLastName =  $val;
	}

	public function seteSalutation($val)
	{
		 $this->_eSalutation =  $val;
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

	public function setvZipCode($val)
	{
		 $this->_vZipCode =  $val;
	}

	public function setvState($val)
	{
		 $this->_vState =  $val;
	}

	public function setvCountry($val)
	{
		 $this->_vCountry =  $val;
	}

	public function setvPhone($val)
	{
		 $this->_vPhone =  $val;
	}

	public function setvExtention($val)
	{
		 $this->_vExtention =  $val;
	}

	public function setvMobile($val)
	{
		 $this->_vMobile =  $val;
	}

	public function setvEmail($val)
	{
		 $this->_vEmail =  $val;
	}

	public function setvUserName($val)
	{
		 $this->_vUserName =  $val;
	}

	public function setvPassword($val)
	{
		 $this->_vPassword =  $val;
	}

	public function setiSecretQuestion1ID($val)
	{
		 $this->_iSecretQuestion1ID =  $val;
	}

	public function setvAnswer($val)
	{
		 $this->_vAnswer =  $val;
	}

	public function setiSecretQuestion2ID($val)
	{
		 $this->_iSecretQuestion2ID =  $val;
	}

	public function setvAnwser($val)
	{
		 $this->_vAnwser =  $val;
	}

	public function setePermissionType($val)
	{
		 $this->_ePermissionType =  $val;
	}

	public function setiGroupID($val)
	{
		 $this->_iGroupID =  $val;
	}

	public function seteUserType($val)
	{
		 $this->_eUserType =  $val;
	}

     public function setdLastAccessDate($val) {
          $this->_dLastAccessDate =  $val;
     }

     public function setiCreatedBy($val)
	{
		 $this->_iCreatedBy =  $val;
	}

	public function seteCreatedBy($val)
	{
		 $this->_eCreatedBy =  $val;
	}

	public function setiModifiedByID($val)
	{
		$this->_iModifiedByID = $val;
	}

	public function seteModifiedBy($val)
	{
		$this->_eModifiedBy = $val;
	}

	public function setiVerifiedSMID($val)
	{
		 $this->_iVerifiedSMID =  $val;
	}

	public function setiRejectedById($val)
	{
	  $this->_iRejectedById =  $val;
	}

	public function seteRejectedBy($val)
	{
	  $this->_eRejectedBy =  $val;
	}

     public function seteNeedToVerify($val)
	{
		 $this->_eNeedToVerify =  $val;
	}

	public function seteStatus($val)
	{
		 $this->_eStatus =  $val;
	}

     public function setvDefaltLan($val)
	{
		 $this->_vDefaltLan =  $val;
	}
     public function seteEmailNotification($val)
	{
		 $this->_eEmailNotification =  $val;
	}

	public function setdCreatedDate($val)
	{
	   $this->_dCreatedDate =  $val;
	}

	public function setdModifiedDate($val)
	{
	   $this->_dModifiedDate =  $val;
	}

	public function setdVerifiedDate($val)
	{
	   $this->_dVerifiedDate =  $val;
	}

	public function setdRejectedDate($val)
	{
	  $this->_dRejectedDate =  $val;
	}

	public function settReasonToReject($val)
	{
		$this->_tReasonToReject =  $val;
	}

	public function seteVerifiedBy($val)
	{
	   $this->_eVerifiedBy = $val;
	}

/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{

		 $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_user_toverify WHERE iVerifiedID = $id";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iVerifiedID = $row[0]['iVerifiedID'];
		 $this->_iUserID = $row[0]['iUserID'];
		 $this->_iOrganizationID = $row[0]['iOrganizationID'];
		 $this->_vFirstName = $row[0]['vFirstName'];
		 $this->_vLastName = $row[0]['vLastName'];
		 $this->_eSalutation = $row[0]['eSalutation'];
		 $this->_vAddressLine1 = $row[0]['vAddressLine1'];
		 $this->_vAddressLine2 = $row[0]['vAddressLine2'];
		 $this->_vAddressLine3 = $row[0]['vAddressLine3'];
		 $this->_vCity = $row[0]['vCity'];
		 $this->_vZipCode = $row[0]['vZipCode'];
		 $this->_vState = $row[0]['vState'];
		 $this->_vCountry = $row[0]['vCountry'];
		 $this->_vPhone = $row[0]['vPhone'];
		 $this->_vExtention = $row[0]['vExtention'];
		 $this->_vMobile = $row[0]['vMobile'];
		 $this->_vEmail = $row[0]['vEmail'];
		 $this->_vUserName = $row[0]['vUserName'];
		 $this->_vPassword = $row[0]['vPassword'];
		 $this->_iSecretQuestion1ID = $row[0]['iSecretQuestion1ID'];
		 $this->_vAnswer = $row[0]['vAnswer'];
		 $this->_iSecretQuestion2ID = $row[0]['iSecretQuestion2ID'];
		 $this->_vAnwser = $row[0]['vAnwser'];
		 $this->_ePermissionType = $row[0]['ePermissionType'];
		 $this->_iGroupID = $row[0]['iGroupID'];
		 $this->_eUserType = $row[0]['eUserType'];
		$this->_dLastAccessDate = $row[0]['dLastAccessDate'];
		$this->_dCreatedDate = $row[0]['dCreatedDate'];
		$this->_dModifiedDate = $row[0]['dModifiedDate'];
		$this->_dVerifiedDate = $row[0]['dVerifiedDate'];
		$this->_dRejectedDate = $row[0]['dRejectedDate'];
      $this->_iCreatedBy = $row[0]['iCreatedBy'];
		$this->_eCreatedBy = $row[0]['eCreatedBy'];
		$this->_iModifiedByID = $row[0]['iModifiedByID'];
		$this->_eModifiedBy = $row[0]['eModifiedBy'];
		$this->_iVerifiedSMID = $row[0]['iVerifiedSMID'];
		$this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		$this->_iRejectedById = $row[0]['iRejectedById'];
		$this->_eRejectedBy = $row[0]['eRejectedBy'];
		$this->_tReasonToReject = $row[0]['tReasonToReject'];
		$this->_eNeedToVerify = $row[0]['eNeedToVerify'];
		$this->_eStatus = $row[0]['eStatus'];
      $this->_vDefaltLan = $row[0]['vDefaltLan'];
      $this->_eEmailNotification = $row[0]['eEmailNotification'];

 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_user_toverify WHERE iVerifiedID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}

	function del($where)
	{
           $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_user_toverify WHERE 1 $where";
           //echo $sql;exit;
		  return $result = $this->_obj->sql_query($sql);
	}

/**
*   @desc   INSERT
*/

	function insert($Data=array())
	{
		 $this->iVerifiedID = ""; // clear key for autoincrement
		if(!(is_array($Data) && count($Data)>0))
		{
		 	$Data = array(
						'iUserID'		=>	$this->_iUserID,
						'iOrganizationID'		=>	$this->_iOrganizationID,
						'vFirstName'		=>	$this->_vFirstName,
						'vLastName'		=>	$this->_vLastName,
						'eSalutation'		=>	$this->_eSalutation,
						'vAddressLine1'		=>	$this->_vAddressLine1,
						'vAddressLine2'		=>	$this->_vAddressLine2,
						'vAddressLine3'		=>	$this->_vAddressLine3,
						'vCity'		=>	$this->_vCity,
						'vZipCode'		=>	$this->_vZipCode,
						'vState'		=>	$this->_vState,
						'vCountry'		=>	$this->_vCountry,
						'vPhone'		=>	$this->_vPhone,
						'vExtention'		=>	$this->_vExtention,
						'vMobile'		=>	$this->_vMobile,
						'vEmail'		=>	$this->_vEmail,
						'vUserName'		=>	$this->_vUserName,
						'vPassword'		=>	$this->_vPassword,
						'iSecretQuestion1ID'		=>	$this->_iSecretQuestion1ID,
						'vAnswer'		=>	$this->_vAnswer,
						'iSecretQuestion2ID'		=>	$this->_iSecretQuestion2ID,
						'vAnwser'		=>	$this->_vAnwser,
						'ePermissionType'		=>	$this->_ePermissionType,
						'iGroupID'		=>	$this->_iGroupID,
						'eUserType'		=>	$this->_eUserType,
						'dLastAccessDate'		=>	$this->_dLastAccessDate,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iCreatedBy'					=>	$this->_iCreatedBy,
						'eCreatedBy'					=>	$this->_eCreatedBy,
						'iModifiedByID'	=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'iVerifiedSMID'				=> $this->_iVerifiedSMID,
						'eVerifiedBy' 		=> $this->_eVerifiedBy,
						'iRejectedById'				=> $this->_iRejectedById,
						'eRejectedBy' 		=> $this->_eRejectedBy,
						'tReasonToReject' 		=> $this->_tReasonToReject,
						'eNeedToVerify'	=> $this->_eNeedToVerify,
						'eStatus'						=> $this->_eStatus,
						'vDefaltLan'			=>	$this->_vDefaltLan,
						'eEmailNotification'=>	$this->_eEmailNotification
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user_toverify",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($id)
	{

		 $Data = array(
						 'iUserID'		=>	$this->_iUserID,
						'iOrganizationID'		=>	$this->_iOrganizationID,
						'vFirstName'		=>	$this->_vFirstName,
						'vLastName'		=>	$this->_vLastName,
						'eSalutation'		=>	$this->_eSalutation,
						'vAddressLine1'		=>	$this->_vAddressLine1,
						'vAddressLine2'		=>	$this->_vAddressLine2,
						'vAddressLine3'		=>	$this->_vAddressLine3,
						'vCity'		=>	$this->_vCity,
						'vZipCode'		=>	$this->_vZipCode,
						'vState'		=>	$this->_vState,
						'vCountry'		=>	$this->_vCountry,
						'vPhone'		=>	$this->_vPhone,
						'vExtention'		=>	$this->_vExtention,
						'vMobile'		=>	$this->_vMobile,
						'vEmail'		=>	$this->_vEmail,
						'vUserName'		=>	$this->_vUserName,
						'vPassword'		=>	$this->_vPassword,
						'iSecretQuestion1ID'		=>	$this->_iSecretQuestion1ID,
						'vAnswer'		=>	$this->_vAnswer,
						'iSecretQuestion2ID'		=>	$this->_iSecretQuestion2ID,
						'vAnwser'		=>	$this->_vAnwser,
						'ePermissionType'		=>	$this->_ePermissionType,
						'iGroupID'		=>	$this->_iGroupID,
						'eUserType'		=>	$this->_eUserType,
						'dLastAccessDate'		=>	$this->_dLastAccessDate,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iCreatedBy'					=>	$this->_iCreatedBy,
						'eCreatedBy'					=>	$this->_eCreatedBy,
						'iModifiedByID'	=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'iVerifiedSMID'				=> $this->_iVerifiedSMID,
						'eVerifiedBy' 		=> $this->_eVerifiedBy,
						'iRejectedById'				=> $this->_iRejectedById,
						'eRejectedBy' 		=> $this->_eRejectedBy,
						'tReasonToReject' 		=> $this->_tReasonToReject,
						'eNeedToVerify'	=> $this->_eNeedToVerify,
						'eStatus'						=> $this->_eStatus,
						'vDefaltLan'	    =>	$this->_vDefaltLan,
						'eEmailNotification'=>	$this->_eEmailNotification);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user_toverify",$Data,'update',$upd);
		  return $result;

	}


	function updateData($data,$where)
	{
          //prints($data);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user_toverify",$data,"update",$where);
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
	}

   /**
	*   @desc   GET DETAILS
	*/

	function getDetails($feild="*",$where="",$OrderBy="",$GroupBy="",$limit="")
	{
       if($where != "") {
          $cnt = " WHERE 1 ".$where;
       }
		 $groupby = '';
       if($GroupBy != "") {
         $groupby = " GROUP BY ".$GroupBy;
       }

       if($OrderBy != "") {
          $orderby = " ORDER BY ".$OrderBy;
       }

       $sql =  "SELECT $feild FROM b2b_organization_user_toverify $cnt $groupby $orderby $limit";
       // echo $sql;exit;
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

   function getDetails_PG($field='*',$where='',$orderBy='',$groupBy='',$limit='')
	{
      if($where != '') {
         $cnt = " Where 1 ".$where;
			$cnt_count = " Where 1 ".$where;
      }
      if($groupBy != '') {
         $cnt .= " Group By ".$groupBy;
      }
      if($orderBy != '') {
         $cnt .= " Order By ".$orderBy;
			$cnt_count .= " Order By ".$orderBy;
      }
      $sql =  "SELECT $field FROM ".PRJ_DB_PREFIX."_organization_user_toverify $cnt $limit";
		//echo $sql; exit;
		$sql_count = "select Count(*) as tot from ".PRJ_DB_PREFIX."_organization_user_toverify $cnt_count";
      //echo $sql; exit;
      $row = $this->_obj->MySQLSelect($sql);
		$row_count = $this->_obj->MySqlSelect($sql_count);
		$row['tot'] = $row_count[0]['tot'];
      return $row;
	}

   function getJoinTableInfo($jtbl,$fields='*',$where='',$orderBy='',$groupBy='',$limit='',$pg='')
	{
		if($where != '') {
         $cnt = " Where 1 ".$where;
			$cnt_count = " Where 1 ".$where;
      }
		if($groupBy != '') {
         $cnt .= " Group By ".$groupBy;
         $cnt_count .= " Group By ".$groupBy;
      }
		if($orderBy != '') {
         $cnt .= " Order By ".$orderBy;
			//$cnt_count .= " Order By ".$orderBy;
      }
      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_organization_user_toverify ou $jtbl $cnt $limit";
		// echo $sql; exit;
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=='yes')
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_organization_user_toverify ou $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
       if($groupBy != '') {
				$row['tot'] = count($row_count);
			}
			else {
				$row['tot'] = $row_count[0]['tot'];
			}

//			 $row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}

	function getHistory($iUserID)
	{
		$sql = "Select * from ".PRJ_DB_PREFIX."_organization_user_toverify where iUserID=$iUserID Order By iVerifiedID ASC ";
		$vdtls = $this->_obj->MySQLSelect($sql);
		for($l=0;$l<count($vdtls);$l++) {
			if($vdtls[$l]['eCreatedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iCreatedBy'];
				$cusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['createdby'] = $cusr[0]['name'];
			} else if($vdtls[$l]['eCreatedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iCreatedBy'];
				$cusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['createdby'] = $cusr[0]['name'];
			}

			if($vdtls[$l]['eModifiedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iModifiedByID'];
				$musr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['modifiedby'] = $musr[0]['name'];
			} else if($vdtls[$l]['eModifiedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iModifiedByID'];
				$musr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['modifiedby'] = $musr[0]['name'];
			}

			if($vdtls[$l]['eVerifiedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iVerifiedSMID'];
				$vusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['verifiedby'] = $vusr[0]['name'];
			} else if($vdtls[$l]['eVerifiedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iVerifiedSMID'];
				$vusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['verifiedby'] = $vusr[0]['name'];
			}

			if($vdtls[$l]['eRejectedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iRejectedById'];
				$rusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['rejectedby'] = $rusr[0]['name'];
			} else if($vdtls[$l]['eRejectedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iRejectedById'];
				$rusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['rejectedby'] = $rusr[0]['name'];
			}
		}
		return $vdtls;
	}

}
?>