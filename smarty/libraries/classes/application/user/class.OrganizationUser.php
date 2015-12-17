<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        OrganizationUser
* GENERATION DATE:  17.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.OrganizationUser.php
* FOR MYSQL TABLE:  b2b_organization_user
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class OrganizationUser {


     /**
      *   @desc Variable Declaration with default value
      */

     protected $iUserId;   // KEY ATTR. WITH AUTOINCREMENT

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
	  protected $_vDefaltLan;
	  protected $_eEmailNotification;
	  protected $_eSelfReg;
	  protected $_vActivationCode;
	  protected $_eStatus;


     /**
      *   @desc   CONSTRUCTOR METHOD
      */

     function __construct() {
          global $dbobj;
          $this->_obj = $dbobj;

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
			 $this->_vDefaltLan = null;
          $this->_eEmailNotification = null;
			 $this->_eSelfReg = null;
			 $this->_vActivationCode = null;
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


     public function getiUserID() {
          return $this->_iUserID;
     }

     public function getiOrganizationID() {
          return $this->_iOrganizationID;
     }

     public function getvFirstName() {
          return $this->_vFirstName;
     }

     public function getvLastName() {
          return $this->_vLastName;
     }

     public function geteSalutation() {
          return $this->_eSalutation;
     }

     public function getvAddressLine1() {
          return $this->_vAddressLine1;
     }

     public function getvAddressLine2() {
          return $this->_vAddressLine2;
     }

     public function getvAddressLine3() {
          return $this->_vAddressLine3;
     }

     public function getvCity() {
          return $this->_vCity;
     }

     public function getvZipCode() {
          return $this->_vZipCode;
     }

     public function getvState() {
          return $this->_vState;
     }

     public function getvCountry() {
          return $this->_vCountry;
     }

     public function getvPhone() {
          return $this->_vPhone;
     }

     public function getvExtention() {
          return $this->_vExtention;
     }

     public function getvMobile() {
          return $this->_vMobile;
     }

     public function getvEmail() {
          return $this->_vEmail;
     }

     public function getvUserName() {
          return $this->_vUserName;
     }

     public function getvPassword() {
          return $this->_vPassword;
     }

     public function getiSecretQuestion1ID() {
          return $this->_iSecretQuestion1ID;
     }

     public function getvAnswer() {
          return $this->_vAnswer;
     }

     public function getiSecretQuestion2ID() {
          return $this->_iSecretQuestion2ID;
     }

     public function getvAnwser() {
          return $this->_vAnwser;
     }

     public function getePermissionType() {
          return $this->_ePermissionType;
     }

     public function getiGroupID() {
          return $this->_iGroupID;
     }

     public function geteUserType() {
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

	public function geteNeedToVerify()
	{
		return $this->_eNeedToVerify;
	}

	public function getiRejectedById()
	{
	  return $this->_iRejectedById;
	}

	public function geteRejectedBy()
	{
	  return $this->_eRejectedBy;
	}

   public function gettReasonToReject()
   {
	  return $this->_tReasonToReject;
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

	public function geteVerifiedBy()
	{
	   return $this->_eVerifiedBy;
	}

	public function geteSelfReg()
	{
		return $this->_eSelfReg;
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


     public function setiUserID($val) {
          $this->iUserId = $this->_iUserID =  $val;
     }

     public function setiOrganizationID($val) {
          $this->_iOrganizationID =  $val;
     }

     public function setvFirstName($val) {
          $this->_vFirstName =  $val;
     }

     public function setvLastName($val) {
          $this->_vLastName =  $val;
     }

     public function seteSalutation($val) {
          $this->_eSalutation =  $val;
     }

     public function setvAddressLine1($val) {
          $this->_vAddressLine1 =  $val;
     }

     public function setvAddressLine2($val) {
          $this->_vAddressLine2 =  $val;
     }

     public function setvAddressLine3($val) {
          $this->_vAddressLine3 =  $val;
     }

     public function setvCity($val) {
          $this->_vCity =  $val;
     }

     public function setvZipCode($val) {
          $this->_vZipCode =  $val;
     }

     public function setvState($val) {
          $this->_vState =  $val;
     }

     public function setvCountry($val) {
          $this->_vCountry =  $val;
     }

     public function setvPhone($val) {
          $this->_vPhone =  $val;
     }

     public function setvExtention($val) {
          $this->_vExtention =  $val;
     }

     public function setvMobile($val) {
          $this->_vMobile =  $val;
     }

     public function setvEmail($val) {
          $this->_vEmail =  $val;
     }

     public function setvUserName($val) {
          $this->_vUserName =  $val;
     }

     public function setvPassword($val) {
          $this->_vPassword =  $val;
     }

     public function setiSecretQuestion1ID($val) {
          $this->_iSecretQuestion1ID =  $val;
     }

     public function setvAnswer($val) {
          $this->_vAnswer =  $val;
     }

     public function setiSecretQuestion2ID($val) {
          $this->_iSecretQuestion2ID =  $val;
     }

     public function setvAnwser($val) {
          $this->_vAnwser =  $val;
     }

     public function setePermissionType($val) {
          $this->_ePermissionType =  $val;
     }

     public function setiGroupID($val) {
          $this->_iGroupID =  $val;
     }

     public function seteUserType($val) {
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

	public function seteSelfReg($val)
	{
		$this->_eSelfReg =  $val;
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

     function select($id) {
          if(($id > 0) && (trim($id) != '')) {
               $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_user WHERE iUserId=$id";
          }
          else {
               $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_user WHERE iUserId=$this->iUserId";
          }
          //print $sql;exit;
          $row =  $this->_obj->MySQLSelect($sql);

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
			 $this->_vDefaltLan = $row[0]['vDefaltLan'];
			 $this->_eEmailNotification = $row[0]['eEmailNotification'];
			 $this->_eSelfReg = $row[0]['eSelfReg'];
			 $this->_vActivationCode = $row[0]['vActivationCode'];
			 $this->_eStatus = $row[0]['eStatus'];
          return $row;
     }


     /**
      *   @desc   DELETE
      */

     function delete($id) {
          $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_user WHERE iUserId = $id";
          return $result = $this->_obj->sql_query($sql);
     }

/**
*   @desc   DELETE BY CONDITION
*/

	function del($where)
	{
           $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_user WHERE 1 $where";
           //echo $sql;exit;
		  return $result = $this->_obj->sql_query($sql);
	}


     /**
      *   @desc   INSERT
      */

     function insert($Data=array())
	  {
          $this->iUserId = ""; // clear key for autoincrement
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
						'vDefaltLan'			=>	$this->_vDefaltLan,
                  'eEmailNotification'=>	$this->_eEmailNotification,
						'eSelfReg' 			=> $this->_eSelfReg,
						'vActivationCode' 			=> $this->_vActivationCode,
                  'eStatus'					=> $this->_eStatus
					);
			 }
			 // prints($Data); exit;
          $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user",$Data,'insert');
			 // echo $result; exit;
          return $result;
     }


     /**
      *   @desc   UPDATE
      */

     function update($where) {

          $Data = array(
                    //'iUserID'		=>	$this->_iUserID,
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
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
                  'iVerifiedSMID'				=> $this->_iVerifiedSMID,
						'eVerifiedBy' 		=> $this->_eVerifiedBy,
						'iRejectedById'				=> $this->_iRejectedById,
						'eRejectedBy' 		=> $this->_eRejectedBy,
						'tReasonToReject' 		=> $this->_tReasonToReject,
                  'eNeedToVerify'	=> $this->_eNeedToVerify,
						'vDefaltLan'	    =>	$this->_vDefaltLan,
                  'eEmailNotification'=>	$this->_eEmailNotification,
						'eSelfReg' 			=> $this->_eSelfReg,
						'vActivationCode' 			=> $this->_vActivationCode,
                  'eStatus'						=> $this->_eStatus
          );

          $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user",$Data,'update',$where);
          return $result;

     }

     function updateData($data,$where) {
       //prints($data);exit;
       $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user",$data,'update',$where);
       //exit;
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
      *   @desc   GET ORGANIZAION DETAILS
      */
   function getDetails($feild='*',$where='',$orderBy='',$groupBy='',$limit='')
	{
       if($where != '') {
          $cnt = " Where 1 ".$where;
       }
       if($groupBy != '') {
          $cnt .= " Group By ".$groupBy;
       }
       if($orderBy != '') {
          $cnt .= " Order By ".$orderBy;
       }

       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_organization_user $cnt $limit";
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
      if($orderBy != '') {
         $cnt .= " Order By ".$orderBy;
      }
		if($groupBy != '') {
         $cnt .= " Group By ".$groupBy;
			$cnt_count .= " Order By ".$orderBy;
      }
/*      $sql =  "SELECT $field FROM ".PRJ_DB_PREFIX."_organization_user bou
               INNER JOIN  ".PRJ_DB_PREFIX."_organization_master bom
               ON bou.iorganizationid = bom.iorganizationid $cnt $limit";
		$sql_count = "select Count(*) as tot from ".PRJ_DB_PREFIX."_organization_user bou
               INNER JOIN  ".PRJ_DB_PREFIX."_organization_master bom
               ON bou.iorganizationid = bom.iorganizationid  $cnt";
 */
		$sql =  "SELECT $field FROM ".PRJ_DB_PREFIX."_organization_user $cnt $limit";
		 //echo $sql;exit;
		$sql_count = "select Count(*) as tot from ".PRJ_DB_PREFIX."_organization_user $cnt";
      // echo $sql; exit;
      $row = $this->_obj->MySQLSelect($sql);
		$row_count = $this->_obj->MySqlSelect($sql_count);
/*       if($groupBy != '') {
				$row['tot'] = count($row_count);
			}
			else {
				$row['tot'] = $row_count[0]['tot'];
			}
*/
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
			$cnt_count .= " Order By ".$orderBy;
      }
      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_organization_user ou $jtbl $cnt $limit";
		// echo $sql."<br/>"; //exit;
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=='yes')
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_organization_user ou $jtbl $cnt_count";
			// echo $sql_count; // exit;
			$row_count = $this->_obj->MySqlSelect($sql_count);
       	if($groupBy != '') {
				$row['tot'] = count($row_count);
			}
			else {
				$row['tot'] = $row_count[0]['tot'];
			}
			// $row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}

	function getOADashboardUsrStats($table,$where) {
		$sql = "Select (select count(*) from $table where 1 AND $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eStatus='Delete' OR eNeedToVerify='Yes' )) as verify_org,
					(select count(*) from $table where 1 AND $where AND (eStatus='Active' OR eNeedToVerify='Yes' )) as actrec,
					(select count(*) from $table where 1 AND $where AND (eStatus='Inactive' OR eNeedToVerify='Yes' )) as inactrec,
					(select count(*) from $table where 1 AND $where ) as tot";
		// (select count(*) from $table where ((eStatus='Active' OR eStatus='Inactive') AND eNeedToVerify='No')) as act_org,
		 // echo $sql."<br/>"; //exit;
		$row =  $this->_obj->MySQLSelect($sql);
      return $row;
	}

   function getOUSatistics($where,$iOrgId,$wh_po,$wh_inv,$typ='isu')
	{
		global $statusmasterObj;
		$poisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Issued' ");
		$poisu = $poisu[0]['iStatusID'];
		$rpoisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Rejected' ");
		$rpoisu = $rpoisu[0]['iStatusID'];
		$ioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issued' ");
		$ioisu = $ioisu[0]['iStatusID'];
		$rioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
		$rioisu = $rioisu[0]['iStatusID'];
		$crpoisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Create' ");
		$crpoisu = $crpoisu[0]['iStatusID'];
		$crioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Create' ");
		$crioisu = $crioisu[0]['iStatusID'];
		$apoisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Accepted' ");
		$apoisu = $apoisu[0]['iStatusID'];
		$aioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
		$aioisu = $aioisu[0]['iStatusID'];
                $pnvc = " AND ((iStatusID>=$poisu AND iStatusID!=$rpoisu) OR iaStatusID=$rpoisu)";
		$invc = " AND ((iStatusID>=$ioisu AND iStatusID!=$rioisu) OR iStatusID=$rioisu)";
	  if($typ == 'acpt') {
			 $sql = "SELECT (SELECT count(iInvoiceID) FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE iaStatusID = bsm.iStatusID AND ((iBuyerOrganizationID=$iOrgId) $wh_inv) $invc) as incnt,
            	(SELECT count(iPurchaseOrderID) FROM ".PRJ_DB_PREFIX."_purchase_order_heading WHERE iaStatusID = bsm.iStatusID AND ((iSupplierOrganizationID=$iOrgId) $wh_po) $pnvc) as pocnt,
            	bsm.vStatus_en,bsm.vStatus_fr,vStatusMsg_fr,bsm.iStatusID,bsm.eFor
            	FROM ".PRJ_DB_PREFIX."_status_master bsm
            	WHERE bsm.eStatus = 'Active'
               ".$where."
            	ORDER BY bsm.eFor,bsm.iDisplayOrder ASC"; 	// AND vStatus_en!='Verified'
	  } else {
			 $sql = "SELECT (SELECT count(iInvoiceID) FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE iStatusID = bsm.iStatusID AND IF(iStatusID=$crioisu OR iStatusID=$rioisu OR iStatusID=$aioisu,eSaved!='Yes',1) AND ((iSupplierOrganizationID=$iOrgId) $wh_inv)) as incnt,
            	(SELECT count(iPurchaseOrderID) FROM ".PRJ_DB_PREFIX."_purchase_order_heading WHERE iStatusID = bsm.iStatusID AND IF(iStatusID=$crpoisu OR iStatusID=$rpoisu OR iStatusID=$apoisu,eSaved!='Yes',1) AND ((iBuyerOrganizationID=$iOrgId) $wh_po)) as pocnt,
            	bsm.vStatus_en,bsm.vStatus_fr,vStatusMsg_fr,bsm.iStatusID,bsm.eFor
            	FROM ".PRJ_DB_PREFIX."_status_master bsm
            	WHERE bsm.eStatus = 'Active'
               ".$where."
            	ORDER BY bsm.eFor,bsm.iDisplayOrder ASC"; 	// AND vStatus_en!='Verified'
	  }
		// echo $sql."<br/>"; //exit;
		$row =  $this->_obj->MySQLSelect($sql);
      return $row;
	}

	function getOUStatistics($where)
	{
		$sql1 = "SELECT (SELECT count(iPurchaseOrderID) FROM ".PRJ_DB_PREFIX."_purchase_order_heading WHERE iStatusID = bsm.iStatusID) as pocnt,
            	bsm.vStatus_en,bsm.vStatus_fr,vStatusMsg_fr,bsm.iStatusID,bsm.eFor
            	FROM ".PRJ_DB_PREFIX."_status_master bsm
            	WHERE bsm.eStatus = 'Active' AND bsm.eFor='PO'
               ".$where."
            	ORDER BY bsm.eFor,bsm.iDisplayOrder ASC";
		//echo $sql1."<br/>"; //exit;
		$sql2 = "SELECT (SELECT count(iInvoiceID) FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE iStatusID = bsm.iStatusID) as incnt,
            	bsm.vStatus_en,bsm.vStatus_fr,vStatusMsg_fr,bsm.iStatusID,bsm.eFor
            	FROM ".PRJ_DB_PREFIX."_status_master bsm
            	WHERE bsm.eStatus = 'Active' AND bsm.eFor='Invoice'
               ".$where."
            	ORDER BY bsm.eFor,bsm.iDisplayOrder ASC";
	   // echo $sql2."<br/>"; //exit;
		$row1 =  $this->_obj->MySQLSelect($sql1);
		$row2 =  $this->_obj->MySQLSelect($sql2);
		if(is_array($row1))
			 $row['po'] = $row1;
		if(is_array($row2))
			 $row['inv'] = $row2;
		// prints($row); exit;
      return $row;
	}

	function getNtvPI($iOrgId,$typ='isu')
	{
		global $statusmasterObj;
		$poisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Issued' ");
		$poisu = $poisu[0]['iStatusID'];
		$rpoisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Rejected' ");
		$rpoisu = $rpoisu[0]['iStatusID'];
		$ioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issued' ");
		$ioisu = $ioisu[0]['iStatusID'];
		$rioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
		$rioisu = $rioisu[0]['iStatusID'];
		$crpoisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Create' ");
		$crpoisu = $crpoisu[0]['iStatusID'];
		$crioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Create' ");
		$crioisu = $crioisu[0]['iStatusID'];
		$pnvc = " AND iStatusID>=$poisu AND iStatusID!=$rpoisu";
		$invc = " AND iStatusID>=$ioisu AND iStatusID!=$rioisu";
	  if($typ == 'acpt') {
			 $sql = " SELECT
					(SELECT count(iInvoiceID) FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE iaStatusID=$crioisu AND eSaved!='Yes' AND ((iBuyerOrganizationID=$iOrgId) ) $invc) as iocnt,
					(SELECT count(iPurchaseOrderID) FROM ".PRJ_DB_PREFIX."_purchase_order_heading WHERE iaStatusID=$crpoisu AND eSaved!='Yes' AND ((iSupplierOrganizationID=$iOrgId) ) $pnvc) as pocnt ";
	  } else {
			 $sql = " SELECT
					(SELECT count(iInvoiceID) FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE iStatusID=$crioisu AND eSaved!='Yes' AND ((iSupplierOrganizationID=$iOrgId) )) as iocnt,
					(SELECT count(iPurchaseOrderID) FROM ".PRJ_DB_PREFIX."_purchase_order_heading WHERE iStatusID=$crpoisu AND eSaved!='Yes' AND ((iBuyerOrganizationID=$iOrgId) )) as pocnt ";
	  }
	  $row =  $this->_obj->MySQLSelect($sql);
	  //prits($row); exit;
	  return $row;
	}

	function getCrStats($orgid,$type='isu')
	{
		global $statusmasterObj;
		$poisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Issued' ");
		$poisu = $poisu[0]['iStatusID'];
		$ioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issued' ");
		$ioisu = $ioisu[0]['iStatusID'];
		if($type=='acpt') {
			$sql = "Select
						(Select count(iPurchaseOrderID) from ".PRJ_DB_PREFIX."_purchase_order_heading where iStatusID=$poisu AND iaStatusID=0 AND iSupplierOrganizationID=$orgid) as pocnt,
						(Select count(iInvoiceID) from ".PRJ_DB_PREFIX."_inovice_order_heading where iStatusID=$ioisu AND iaStatusID=0 AND iBuyerOrganizationID=$orgid) as iocnt
					";
		} else {
			$sql = "Select
						(Select count(iPurchaseOrderID) from ".PRJ_DB_PREFIX."_purchase_order_heading where eSaved='Yes'AND iBuyerOrganizationID=$orgid) as pocnt,
						(Select count(iInvoiceID) from ".PRJ_DB_PREFIX."_inovice_order_heading where eSaved='Yes' AND iSupplierOrganizationID=$orgid) as iocnt
					";
		}
		$row =  $this->_obj->MySQLSelect($sql);
		return $row;
	}

	function getTotalPI($orgid,$type='isu')
	{
		global $statusmasterObj;
		$poisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Issued' ");
		$poisu = $poisu[0]['iStatusID'];
		$ioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issued' ");
		$ioisu = $ioisu[0]['iStatusID'];
		$poact = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Accepted' ");
		$poact = $poact[0]['iStatusID'];
		$ioact = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
		$ioact = $ioact[0]['iStatusID'];
		$porjt = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Rejected' ");
		$porjt = $porjt[0]['iStatusID'];
		$iorjt = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
		$iorjt = $iorjt[0]['iStatusID'];
		if($type=='acpt') {
			$sql = "Select
					(Select count(iPurchaseOrderID) as tpoisu from ".PRJ_DB_PREFIX."_purchase_order_heading where iSupplierOrganizationID=$orgid and (iStatusID>=$poisu || iaStatusID=$porjt)) as tpoact,
					(Select count(iInvoiceID) as tioisu from ".PRJ_DB_PREFIX."_inovice_order_heading where iBuyerOrganizationID=$orgid and (iStatusID>=$ioisu || iaStatusID=$iorjt)) as tioact
				";
		} else {
			$sql = "Select
					(Select count(iPurchaseOrderID) as tpoisu from ".PRJ_DB_PREFIX."_purchase_order_heading where iBuyerOrganizationID=$orgid) as tpoisu,
					(Select count(iInvoiceID) as tioisu from ".PRJ_DB_PREFIX."_inovice_order_heading where iSupplierOrganizationID=$orgid) as tioisu
				";
		}
	  // echo $sql; exit;
	  $row =  $this->_obj->MySQLSelect($sql);
	  return $row;
	}

   function getUserPermission($iUserId)
	{
		$udt = $this->select($iUserId);
		if($udt[0]['ePermissionType']=='Group') {
			$iGroupID = $udt[0]['iGroupID'];
			$sql = "SELECT * FROM ".PRJ_DB_PREFIX."_organization_group bsm WHERE bsm.iGroupID = '".$iGroupID."'";
			// echo $sql."<br/>"; //exit;
			$row =  $this->_obj->MySQLSelect($sql);
		} else {
			$sql = "SELECT * FROM ".PRJ_DB_PREFIX."_organization_user_permission bsm WHERE bsm.iUserID = '".$iUserId."'"; 	// AND (eStatus = 'Active' OR eStatus = 'Modified')
			// echo $sql."<br/>"; //exit;
			$row =  $this->_obj->MySQLSelect($sql);
		}
		// prints($row); exit;
      if(count($row) >0) {
         if($row[0]['tPermission'] != '') {
            $tPermission = @explode(";",$row[0]['tPermission']);
            $tPermissioninv= $tPermission[0];
            $tPermission_inv= @explode(":",$tPermissioninv);
            $tPermissions['inv'] = (isset($tPermission_inv[1]))? $tPermission_inv[1] : '';
            $tPermissionpo= $tPermission[1];
            $tPermission_po= @explode(":",$tPermissionpo);
            $tPermissions['po'] = (isset($tPermission_po[1]))? $tPermission_po[1] : '';
         }
         if($row[0]['tAcceptancePermit'] != '') {
            $tAcceptance = @explode(";",$row[0]['tAcceptancePermit']);
            $tAcceptanceinv= $tAcceptance[0];
            $tAcceptance_inv= @explode(":",$tAcceptanceinv);
            $tAcceptance['inv'] = $tAcceptance_inv[1];
            $tAcceptancepo = $tAcceptance[1];
            $tAcceptance_po = @explode(":",$tAcceptancepo);
            $tAcceptance['po'] = (isset($tAcceptance_po[1])) ? $tAcceptance_po[1] : '';
         }
      }

      if(isset($tPermissions['inv']) && $tPermissions['inv'] != ''){
         $totPermission['issu'] = $tPermissions['inv'];
      }
      if(isset($totPermission['issu']) && $totPermission['issu'] != '') {
         $totPermission['issu'] .= ','.$tPermissions['po'];
      } else {
         $totPermission['issu'] = $tPermissions['po'];
      }

		if(isset($tAcceptance['inv']) && $tAcceptance['inv'] != '') {
         $totPermission['acpt'] = $tAcceptance['inv'];
      }
      if(isset($totPermission['acpt']) && $totPermission['acpt'] != '') {
         $totPermission['acpt'] .= ','.$tAcceptance['po'];
      } else {
         $totPermission['acpt'] = $tAcceptance['po'];
      }
		// prints($totPermission); exit;
      return $totPermission;
	}

	function getPermittedUsers($iOrgId,$sts,$itm,$typ='isu',$extw='',$orgin='')
	{
	  $chk = "";
	  if($typ == 'acpt') {
		  $fld = "tAcceptancePermit";
		  $chk = " '%$itm:%$sts%' ";
	  } else if($typ == 'isu') {
	     $fld = "tPermission";
		  $chk = " '%$itm:%$sts%' ";
	  } else {
	     $fld = $typ;
		  $chk = " '$sts' ";
	  }
	  $whr = "";
	  if($orgin=='y') {
	     $whr .= " ou.iOrganizationID IN ($iOrgId) ";
	  } else {
	     $whr .= " ou.iOrganizationID=$iOrgId ";
	  }

	  // $sql = "Select ou.* from ".PRJ_DB_PREFIX."_organization_user ou INNER JOIN ".PRJ_DB_PREFIX."_organization_user_permission oup on ou.iUserID=oup.iUserID where ou.iOrganizationID=$iOrgId AND eUserType='User' AND oup.".$fld." LIKE '%$itm:%$sts%' AND oup.iUserID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
	  $sql = "(SELECT ou.* FROM ".PRJ_DB_PREFIX."_organization_user ou INNER JOIN ".PRJ_DB_PREFIX."_organization_user_permission oup ON (ou.iUserID=oup.iUserID) WHERE $whr AND ou.ePermissionType='Individual' AND eUserType='User' AND oup.$fld LIKE $chk $extw)
					UNION
					(SELECT ou.* FROM ".PRJ_DB_PREFIX."_organization_user ou INNER JOIN ".PRJ_DB_PREFIX."_organization_group grp ON (ou.iGroupID=grp.iGroupID) WHERE $whr AND ou.ePermissionType='Group' AND ou.iGroupID>0 AND eUserType='User' AND grp.$fld LIKE $chk $extw )";
	  // echo $sql; // exit;
	  $dtls =  $this->_obj->MySQLSelect($sql);
	  return $dtls;
	}

	function getUserPermits($uid, $ptyp)
	{
	   $dtls = array();
	   if(trim($uid)!='' && $uid>0)
		{
			$sql = "SELECT ou.*,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.$ptyp, oup.$ptyp) AS $ptyp
						  FROM ".PRJ_DB_PREFIX."_organization_user ou
						  LEFT JOIN ".PRJ_DB_PREFIX."_organization_user_permission oup ON oup.iUserID=ou.iUserID
						  LEFT JOIN ".PRJ_DB_PREFIX."_organization_group grp ON grp.iGroupID=ou.iGroupID
						  WHERE ou.iOrganizationID=$uid ";
			$dtls =  $this->_obj->MySQLSelect($sql);
		}
		return $dtls;
	}

	function getOrgRFQ2Bids($id)
	{
	  	$sql = "SELECT
					(SELECT COUNT(bid.iStatusID) FROM ".PRJ_DB_PREFIX."_rfq2_bids bid INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 ON rfq2.iRFQ2Id=bid.iRFQ2Id WHERE bid.eSaved='Yes' AND bid.eDelete <>'Verified' AND bid.iBuyer2Id=$id) AS 'Create',
					IF((SELECT eRFQ2BidVerifyReq FROM ".PRJ_DB_PREFIX."_organization_default_settings WHERE iOrganizationID=$id)='Yes', (SELECT COUNT(bid.iStatusID) FROM ".PRJ_DB_PREFIX."_rfq2_bids bid INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 ON rfq2.iRFQ2Id=bid.iRFQ2Id, ".PRJ_DB_PREFIX."_status_master sm WHERE bid.eSaved='No' AND bid.iStatusID=sm.iStatusID AND sm.vStatus_en='Create' AND bid.eDelete <>'Verified' AND bid.iBuyer2Id=$id), 'x') AS 'Verify',
					(SELECT COUNT(bid.iStatusID) FROM ".PRJ_DB_PREFIX."_rfq2_bids bid INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 ON rfq2.iRFQ2Id=bid.iRFQ2Id, ".PRJ_DB_PREFIX."_status_master sm WHERE bid.eSaved='No' AND bid.iStatusID=sm.iStatusID AND sm.vStatus_en='Verify' AND bid.eDelete <>'Verified' AND bid.iBuyer2Id=$id) AS 'Accepted',
					(SELECT COUNT(bid.iStatusID) FROM ".PRJ_DB_PREFIX."_rfq2_bids bid INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 ON rfq2.iRFQ2Id=bid.iRFQ2Id, ".PRJ_DB_PREFIX."_status_master sm WHERE bid.eSaved='No' AND bid.iStatusID=sm.iStatusID AND sm.vStatus_en='Rejected' AND bid.eDelete <>'Verified' AND bid.iBuyer2Id=$id) AS 'Rejected',
					(SELECT COUNT(bid.eDelete) FROM ".PRJ_DB_PREFIX."_rfq2_bids bid INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 ON rfq2.iRFQ2Id=bid.iRFQ2Id WHERE bid.eDelete <>'Verified' AND iBuyer2Id=$id) AS ttol FROM ".PRJ_DB_PREFIX."_rfq2_bids WHERE iBuyer2Id=$id AND eDelete <>'Verified'";
		 # echo $sql; exit;
	   $dtls=  $this->_obj->MySQLSelect($sql);
		return $dtls[0];
	}

	function getOrgRFQ2($id)
	{
	  	  $sql = "SELECT
					(SELECT COUNT(bid.iStatusID) FROM ".PRJ_DB_PREFIX."_rfq2_master bid WHERE bid.eSaved='Yes' AND bid.eDelete <>'Verified' AND ( bid.iOrganizationID=$id OR bid.iInvoiceID IN (Select iInvoiceID from ".PRJ_DB_PREFIX."_inovice_order_heading where iBuyerOrganizationID=$id OR iSupplierOrganizationID=$id) )) AS 'Create',
					IF((SELECT eRFQ2VerifyReq FROM ".PRJ_DB_PREFIX."_organization_default_settings WHERE iOrganizationID=$id)='Yes', (SELECT COUNT(bid.iStatusID) FROM ".PRJ_DB_PREFIX."_rfq2_master bid, ".PRJ_DB_PREFIX."_status_master sm WHERE bid.eSaved='No' AND bid.iStatusID=sm.iStatusID AND sm.vStatus_en='Create' AND bid.eDelete <>'Verified' AND (bid.iOrganizationID=$id OR bid.iInvoiceID IN (Select iInvoiceID from ".PRJ_DB_PREFIX."_inovice_order_heading where iBuyerOrganizationID=$id OR iSupplierOrganizationID=$id)) ), 'x') AS 'Verify',
					(SELECT COUNT(bid.iStatusID) FROM ".PRJ_DB_PREFIX."_rfq2_master bid, ".PRJ_DB_PREFIX."_status_master sm WHERE bid.eSaved='No' AND bid.iStatusID=sm.iStatusID AND sm.vStatus_en='Verify' AND bid.eDelete <>'Verified' AND (bid.iOrganizationID=$id OR bid.iInvoiceID IN (Select iInvoiceID from ".PRJ_DB_PREFIX."_inovice_order_heading where iBuyerOrganizationID=$id OR iSupplierOrganizationID=$id)) ) AS 'Accepted',
					(SELECT COUNT(bid.iStatusID) FROM ".PRJ_DB_PREFIX."_rfq2_master bid, ".PRJ_DB_PREFIX."_status_master sm WHERE bid.eSaved='No' AND bid.iStatusID=sm.iStatusID AND sm.vStatus_en='Rejected' AND bid.eDelete <>'Verified' AND (bid.iOrganizationID=$id OR bid.iInvoiceID IN (Select iInvoiceID from ".PRJ_DB_PREFIX."_inovice_order_heading where iBuyerOrganizationID=$id OR iSupplierOrganizationID=$id)) ) AS 'Rejected',
					(SELECT COUNT(iRFQ2Id) FROM ".PRJ_DB_PREFIX."_rfq2_master WHERE eDelete <>'Verified' AND (iOrganizationID=$id OR iInvoiceID IN (Select iInvoiceID from ".PRJ_DB_PREFIX."_inovice_order_heading where iBuyerOrganizationID=$id OR iSupplierOrganizationID=$id)) ) AS ttol
					FROM ".PRJ_DB_PREFIX."_rfq2_master WHERE eDelete <>'Verified'"; 	// iOrganizationID=$id AND
	  	  // echo $sql."<br/>"; // exit;
	  	  $dtls =  $this->_obj->MySQLSelect($sql);
		  // pr($dtls); exit;
	  	  return $dtls[0];
	}

	function hasBuyerInvPermit($id)
	{
		$sql = "Select eInvFPO from ".PRJ_DB_PREFIX."_organization_user_permission where iUserID=$id";
		$dtls =  $this->_obj->MySQLSelect($sql);
		$dtls[0]['eInvFPO'] = (isset($dtls[0]['eInvFPO']) && trim($dtls[0]['eInvFPO'])!='')? $dtls[0]['eInvFPO'] : 'No';
	  	return $dtls[0]['eInvFPO'];
	}
}
?>