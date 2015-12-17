<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        Organization
* GENERATION DATE:  17.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.Organization.php
* FOR MYSQL TABLE:  b2b_organization_master
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class Organization
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iOrganizationID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iOrganizationID;  
	protected $_iASMID;  
	protected $_iVerifiedSMID;  
	protected $_vCompanyName;  
	protected $_vCompanyRegNo;  
	protected $_vOrganizationCode;  
	protected $_vCompCode;  
	protected $_vAddressLine1;  
	protected $_vAddressLine2;  
	protected $_vAddressLine3;  
	protected $_vCity;  
	protected $_vState;  
	protected $_vCountry;  
	protected $_vZipcode;  
	protected $_vPhone;  
	protected $_vEmail;  
	protected $_vWebSite;  
	protected $_eOrganizationType;  
	protected $_vPrimaryContactNo;  
	protected $_vPrimaryContactEmail;  
	protected $_vPrimaryContactTelephone;  
	protected $_vPrimaryContactMobile;  
	protected $_iBankId;  
	protected $_vBankName;  
	protected $_vBankCode;  
	protected $_vBranchName;  
	protected $_vBranchCode;  
	protected $_vAccount1Number;  
	protected $_vAccount1Title;  
	protected $_vAccount1Currency;  
	protected $_vAccount2Number;  
	protected $_vAccount2Title;  
	protected $_vAccount2Currency;  
	protected $_vVatId;  
	protected $_iSchemeId;  
	protected $_vSchemeCode;  
	//protected $_eCreateMethodAllowed;  
	//protected $_eReqVerification;  
	protected $_dCreatedDate;  
	protected $_dVerifiedDate;  
	protected $_dRejectedDate;  
	protected $_dCreateFromIP;  
	protected $_dVerifiedFromIP;  
	protected $_iModifiedByID;  
	protected $_eModifiedBy;  
	protected $_dModifiedDate;  
	protected $_eVerifiedBy;  
	protected $_iRejectedById;  
	protected $_eRejectedBy;  
	protected $_tReasonToReject;  
	protected $_eNeedToVerify;
	protected $_eSelfReg;
	protected $_vActivationCode;
	protected $_eStatus;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iOrganizationID = null; 
		$this->_iASMID = null; 
		$this->_iVerifiedSMID = null; 
		$this->_vCompanyName = null; 
		$this->_vCompanyRegNo = null; 
		$this->_vOrganizationCode = null; 
		$this->_vCompCode = null; 
		$this->_vAddressLine1 = null; 
		$this->_vAddressLine2 = null; 
		$this->_vAddressLine3 = null; 
		$this->_vCity = null; 
		$this->_vState = null; 
		$this->_vCountry = null; 
		$this->_vZipcode = null; 
		$this->_vPhone = null; 
		$this->_vEmail = null; 
		$this->_vWebSite = null; 
		$this->_eOrganizationType = null; 
		$this->_vPrimaryContactNo = null; 
		$this->_vPrimaryContactEmail = null; 
		$this->_vPrimaryContactTelephone = null; 
		$this->_vPrimaryContactMobile = null; 
		$this->_iBankId = null; 
		$this->_vBankName = null; 
		$this->_vBankCode = null; 
		$this->_vBranchName = null; 
		$this->_vBranchCode = null; 
		$this->_vAccount1Number = null; 
		$this->_vAccount1Title = null; 
		$this->_vAccount1Currency = null; 
		$this->_vAccount2Number = null; 
		$this->_vAccount2Title = null; 
		$this->_vAccount2Currency = null; 
		$this->_vVatId = null; 
		$this->_iSchemeId = null; 
		$this->_vSchemeCode = null; 
		//$this->_eCreateMethodAllowed = null; 
		//$this->_eReqVerification = null; 
		$this->_dCreatedDate = null; 
		$this->_dVerifiedDate = null; 
		$this->_dRejectedDate = null; 
		$this->_dCreateFromIP = null; 
		$this->_dVerifiedFromIP = null; 
		$this->_iModifiedByID = null; 
		$this->_eModifiedBy = null; 
		$this->_dModifiedDate = null; 
		$this->_eVerifiedBy = null; 
		$this->_iRejectedById = null; 
		$this->_eRejectedBy = null; 
		$this->_tReasonToReject = null; 
		$this->_eNeedToVerify = null;
		$this->_eSelfReg = null;
		$this->_vActivationCode = null;
		$this->_eStatus = null; 
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


	public function getiOrganizationID()
	{
		return $this->_iOrganizationID;
	}

	public function getiASMID()
	{
		return $this->_iASMID;
	}

	public function getiVerifiedSMID()
	{
		return $this->_iVerifiedSMID;
	}

	public function getvCompanyName()
	{
		return $this->_vCompanyName;
	}

	public function getvCompanyRegNo()
	{
		return $this->_vCompanyRegNo;
	}

	public function getvOrganizationCode()
	{
		return $this->_vOrganizationCode;
	}

	public function getvCompCode()
	{
		return $this->_vCompCode;
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

	public function getvPhone()
	{
		return $this->_vPhone;
	}

	public function getvEmail()
	{
		return $this->_vEmail;
	}

	public function getvWebSite()
	{
		return $this->_vWebSite;
	}

	public function geteOrganizationType()
	{
		return $this->_eOrganizationType;
	}

	public function getvPrimaryContactNo()
	{
		return $this->_vPrimaryContactNo;
	}

	public function getvPrimaryContactEmail()
	{
		return $this->_vPrimaryContactEmail;
	}

	public function getvPrimaryContactTelephone()
	{
		return $this->_vPrimaryContactTelephone;
	}

	public function getvPrimaryContactMobile()
	{
		return $this->_vPrimaryContactMobile;
	}

	public function getiBankId()
	{
		return $this->_iBankId;
	}

	public function getvBankName()
	{
		return $this->_vBankName;
	}

	public function getvBankCode()
	{
		return $this->_vBankCode;
	}

	public function getvBranchName()
	{
		return $this->_vBranchName;
	}

	public function getvBranchCode()
	{
		return $this->_vBranchCode;
	}

	public function getvAccount1Number()
	{
		return $this->_vAccount1Number;
	}

	public function getvAccount1Title()
	{
		return $this->_vAccount1Title;
	}

	public function getvAccount1Currency()
	{
		return $this->_vAccount1Currency;
	}

	public function getvAccount2Number()
	{
		return $this->_vAccount2Number;
	}

	public function getvAccount2Title()
	{
		return $this->_vAccount2Title;
	}

	public function getvAccount2Currency()
	{
		return $this->_vAccount2Currency;
	}

	public function getvVatId()
	{
		return $this->_vVatId;
	}

	public function getiSchemeId()
	{
		return $this->_iSchemeId;
	}

	public function getvSchemeCode()
	{
		return $this->_vSchemeCode;
	}

	/*public function geteCreateMethodAllowed()
	{
		return $this->_eCreateMethodAllowed;
	}

	public function geteReqVerification()
	{
		return $this->_eReqVerification;
	}*/

	public function getdCreatedDate()
	{
		return $this->_dCreatedDate;
	}

	public function getdVerifiedDate()
	{
		return $this->_dVerifiedDate;
	}

	public function getdRejectedDate()
	{
		return $this->_dRejectedDate;
	}

	public function getdCreateFromIP()
	{
		return $this->_dCreateFromIP;
	}

	public function getdVerifiedFromIP()
	{
		return $this->_dVerifiedFromIP;
	}

	public function getiModifiedByID()
	{
		return $this->_iModifiedByID;
	}

	public function geteModifiedBy()
	{
		return $this->_eModifiedBy;
	}

	public function getdModifiedDate()
	{
		return $this->_dModifiedDate;
	}

	public function geteVerifiedBy()
	{
		return $this->_eVerifiedBy;
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

	public function geteNeedToVerify()
	{
		return $this->_eNeedToVerify;
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


	public function setiOrganizationID($val)
	{
		 $this->_iOrganizationID =  $val;
	}

	public function setiASMID($val)
	{
		 $this->_iASMID =  $val;
	}

	public function setiVerifiedSMID($val)
	{
		 $this->_iVerifiedSMID =  $val;
	}

	public function setvCompanyName($val)
	{
		 $this->_vCompanyName =  $val;
	}

	public function setvCompanyRegNo($val)
	{
		 $this->_vCompanyRegNo =  $val;
	}

	public function setvOrganizationCode($val)
	{
		 $this->_vOrganizationCode =  $val;
	}

	public function setvCompCode($val)
	{
		 $this->_vCompCode =  $val;
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

	public function setvPhone($val)
	{
		 $this->_vPhone =  $val;
	}

	public function setvEmail($val)
	{
		 $this->_vEmail =  $val;
	}

	public function setvWebSite($val)
	{
		 $this->_vWebSite =  $val;
	}

	public function seteOrganizationType($val)
	{
		 $this->_eOrganizationType =  $val;
	}

	public function setvPrimaryContactNo($val)
	{
		 $this->_vPrimaryContactNo =  $val;
	}

	public function setvPrimaryContactEmail($val)
	{
		 $this->_vPrimaryContactEmail =  $val;
	}

	public function setvPrimaryContactTelephone($val)
	{
		 $this->_vPrimaryContactTelephone =  $val;
	}

	public function setvPrimaryContactMobile($val)
	{
		 $this->_vPrimaryContactMobile =  $val;
	}

	public function setiBankId($val)
	{
		 $this->_iBankId =  $val;
	}

	public function setvBankName($val)
	{
		 $this->_vBankName =  $val;
	}

	public function setvBankCode($val)
	{
		 $this->_vBankCode =  $val;
	}

	public function setvBranchName($val)
	{
		 $this->_vBranchName =  $val;
	}

	public function setvBranchCode($val)
	{
		 $this->_vBranchCode =  $val;
	}

	public function setvAccount1Number($val)
	{
		 $this->_vAccount1Number =  $val;
	}

	public function setvAccount1Title($val)
	{
		 $this->_vAccount1Title =  $val;
	}

	public function setvAccount1Currency($val)
	{
		 $this->_vAccount1Currency =  $val;
	}

	public function setvAccount2Number($val)
	{
		 $this->_vAccount2Number =  $val;
	}

	public function setvAccount2Title($val)
	{
		 $this->_vAccount2Title =  $val;
	}

	public function setvAccount2Currency($val)
	{
		 $this->_vAccount2Currency =  $val;
	}

	public function setvVatId($val)
	{
		 $this->_vVatId =  $val;
	}

	public function setiSchemeId($val)
	{
		 $this->_iSchemeId =  $val;
	}

	public function setvSchemeCode($val)
	{
		 $this->_vSchemeCode =  $val;
	}

	public function seteCreateMethodAllowed($val)
	{
		 $this->_eCreateMethodAllowed =  $val;
	}

	public function seteReqVerification($val)
	{
		 $this->_eReqVerification =  $val;
	}

	public function setdCreatedDate($val)
	{
		 $this->_dCreatedDate =  $val;
	}

	public function setdVerifiedDate($val)
	{
		 $this->_dVerifiedDate =  $val;
	}

	public function setdRejectedDate($val)
	{
		 $this->_dRejectedDate =  $val;
	}

	public function setdCreateFromIP($val)
	{
		 $this->_dCreateFromIP =  $val;
	}

	public function setdVerifiedFromIP($val)
	{
		 $this->_dVerifiedFromIP =  $val;
	}

	public function setiModifiedByID($val)
	{
		 $this->_iModifiedByID =  $val;
	}

	public function seteModifiedBy($val)
	{
		 $this->_eModifiedBy =  $val;
	}

	public function setdModifiedDate($val)
	{
		 $this->_dModifiedDate =  $val;
	}

	public function seteVerifiedBy($val)
	{
		 $this->_eVerifiedBy =  $val;
	}

	public function setiRejectedById($val)
	{
		 $this->_iRejectedById =  $val;
	}

	public function seteRejectedBy($val)
	{
		 $this->_eRejectedBy =  $val;
	}

	public function settReasonToReject($val)
	{
		 $this->_tReasonToReject =  $val;
	}

	public function seteNeedToVerify($val)
	{
		 $this->_eNeedToVerify =  $val;
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

	function select($id)
	{
		if(($id > 0) && (trim($id) != '')) {
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_master WHERE iOrganizationID=$id";
		} else {
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_master WHERE iOrganizationID=$this->iOrganizationID";
		}
		$row =  $this->_obj->MySQLSelect($sql);

		 $this->_iOrganizationID = $row[0]['iOrganizationID'];
		 $this->_iASMID = $row[0]['iASMID'];
		 $this->_iVerifiedSMID = $row[0]['iVerifiedSMID'];
		 $this->_vCompanyName = $row[0]['vCompanyName'];
		 $this->_vCompanyRegNo = $row[0]['vCompanyRegNo'];
		 $this->_vOrganizationCode = $row[0]['vOrganizationCode'];
		 $this->_vCompCode = $row[0]['vCompCode'];
		 $this->_vAddressLine1 = $row[0]['vAddressLine1'];
		 $this->_vAddressLine2 = $row[0]['vAddressLine2'];
		 $this->_vAddressLine3 = $row[0]['vAddressLine3'];
		 $this->_vCity = $row[0]['vCity'];
		 $this->_vState = $row[0]['vState'];
		 $this->_vCountry = $row[0]['vCountry'];
		 $this->_vZipcode = $row[0]['vZipcode'];
		 $this->_vPhone = $row[0]['vPhone'];
		 $this->_vEmail = $row[0]['vEmail'];
		 $this->_vWebSite = $row[0]['vWebSite'];
		 $this->_eOrganizationType = $row[0]['eOrganizationType'];
		 $this->_vPrimaryContactNo = $row[0]['vPrimaryContactNo'];
		 $this->_vPrimaryContactEmail = $row[0]['vPrimaryContactEmail'];
		 $this->_vPrimaryContactTelephone = $row[0]['vPrimaryContactTelephone'];
		 $this->_vPrimaryContactMobile = $row[0]['vPrimaryContactMobile'];
		 $this->_iBankId = $row[0]['iBankId'];
		 $this->_vBankName = $row[0]['vBankName'];
		 $this->_vBankCode = $row[0]['vBankCode'];
		 $this->_vBranchName = $row[0]['vBranchName'];
		 $this->_vBranchCode = $row[0]['vBranchCode'];
		 $this->_vAccount1Number = $row[0]['vAccount1Number'];
		 $this->_vAccount1Title = $row[0]['vAccount1Title'];
		 $this->_vAccount1Currency = $row[0]['vAccount1Currency'];
		 $this->_vAccount2Number = $row[0]['vAccount2Number'];
		 $this->_vAccount2Title = $row[0]['vAccount2Title'];
		 $this->_vAccount2Currency = $row[0]['vAccount2Currency'];
		 $this->_vVatId = $row[0]['vVatId'];
		 $this->_iSchemeId = $row[0]['iSchemeId'];
		 $this->_vSchemeCode = $row[0]['vSchemeCode'];
		// $this->_eCreateMethodAllowed = $row[0]['eCreateMethodAllowed'];
		// $this->_eReqVerification = $row[0]['eReqVerification'];
		 $this->_dCreatedDate = $row[0]['dCreatedDate'];
		 $this->_dVerifiedDate = $row[0]['dVerifiedDate'];
		 $this->_dRejectedDate = $row[0]['dRejectedDate'];
		 $this->_dCreateFromIP = $row[0]['dCreateFromIP'];
		 $this->_dVerifiedFromIP = $row[0]['dVerifiedFromIP'];
		 $this->_iModifiedByID = $row[0]['iModifiedByID'];
		 $this->_eModifiedBy = $row[0]['eModifiedBy'];
		 $this->_dModifiedDate = $row[0]['dModifiedDate'];
		 $this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		 $this->_iRejectedById = $row[0]['iRejectedById'];
		 $this->_eRejectedBy = $row[0]['eRejectedBy'];
		 $this->_tReasonToReject = $row[0]['tReasonToReject'];
		 $this->_eNeedToVerify = $row[0]['eNeedToVerify'];
		 $this->_eSelfReg = $row[0]['eSelfReg'];
		 $this->_vActivationCode = $row[0]['vActivationCode'];
		 $this->_eStatus = $row[0]['eStatus'];
		 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_master WHERE iOrganizationID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   DELETE BY CONDITION
*/

	function del($where)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_master WHERE 1 $where";
           //echo $sql;exit;
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert($Data = Array())
	{
		$this->iOrganizationID = ""; // clear key for autoincrement
		$this->_iOrganizationID = "";

		if(!is_array($Data) || count($Data)<1) {
			$Data = array(
						'iASMID'		=>	$this->_iASMID,
						'iVerifiedSMID'		=>	$this->_iVerifiedSMID,
						'vCompanyName'		=>	$this->_vCompanyName,
						'vCompanyRegNo'		=>	$this->_vCompanyRegNo,
						'vOrganizationCode'		=>	$this->_vOrganizationCode,
						'vCompCode'		=>	$this->_vCompCode,
						'vAddressLine1'		=>	$this->_vAddressLine1,
						'vAddressLine2'		=>	$this->_vAddressLine2,
						'vAddressLine3'		=>	$this->_vAddressLine3,
						'vCity'		=>	$this->_vCity,
						'vState'		=>	$this->_vState,
						'vCountry'		=>	$this->_vCountry,
						'vZipcode'		=>	$this->_vZipcode,
						'vPhone'		=>	$this->_vPhone,
						'vEmail'		=>	$this->_vEmail,
						'vWebSite'		=>	$this->_vWebSite,
						'eOrganizationType'		=>	$this->_eOrganizationType,
						'vPrimaryContactNo'		=>	$this->_vPrimaryContactNo,
						'vPrimaryContactEmail'		=>	$this->_vPrimaryContactEmail,
						'vPrimaryContactTelephone'		=>	$this->_vPrimaryContactTelephone,
						'vPrimaryContactMobile'		=>	$this->_vPrimaryContactMobile,
						'iBankId'		=>	$this->_iBankId,
						'vBankName'		=>	$this->_vBankName,
						'vBankCode'		=>	$this->_vBankCode,
						'vBranchName'		=>	$this->_vBranchName,
						'vBranchCode'		=>	$this->_vBranchCode,
						'vAccount1Number'		=>	$this->_vAccount1Number,
						'vAccount1Title'		=>	$this->_vAccount1Title,
						'vAccount1Currency'		=>	$this->_vAccount1Currency,
						'vAccount2Number'		=>	$this->_vAccount2Number,
						'vAccount2Title'		=>	$this->_vAccount2Title,
						'vAccount2Currency'		=>	$this->_vAccount2Currency,
						'vVatId'		=>	$this->_vVatId,
						'iSchemeId'		=>	$this->_iSchemeId,
						'vSchemeCode'		=>	$this->_vSchemeCode,
						'eCreateMethodAllowed'		=>	$this->_eCreateMethodAllowed,
						'eReqVerification'		=>	$this->_eReqVerification,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'dCreateFromIP'		=>	$this->_dCreateFromIP,
						'dVerifiedFromIP'		=>	$this->_dVerifiedFromIP,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eSelfReg' 			=> $this->_eSelfReg,
						'vActivationCode' 			=> $this->_vActivationCode,
						'eStatus'		=>	$this->_eStatus
			);
		}
      //prints($Data);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_master",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{
			$Data = array(
						'iASMID'		=>	$this->_iASMID,
						'iVerifiedSMID'		=>	$this->_iVerifiedSMID,
						'vCompanyName'		=>	$this->_vCompanyName,
						'vCompanyRegNo'		=>	$this->_vCompanyRegNo,
						'vOrganizationCode'		=>	$this->_vOrganizationCode,
						'vCompCode'		=>	$this->_vCompCode,
						'vAddressLine1'		=>	$this->_vAddressLine1,
						'vAddressLine2'		=>	$this->_vAddressLine2,
						'vAddressLine3'		=>	$this->_vAddressLine3,
						'vCity'		=>	$this->_vCity,
						'vState'		=>	$this->_vState,
						'vCountry'		=>	$this->_vCountry,
						'vZipcode'		=>	$this->_vZipcode,
						'vPhone'		=>	$this->_vPhone,
						'vEmail'		=>	$this->_vEmail,
						'vWebSite'		=>	$this->_vWebSite,
						'eOrganizationType'		=>	$this->_eOrganizationType,
						'vPrimaryContactNo'		=>	$this->_vPrimaryContactNo,
						'vPrimaryContactEmail'		=>	$this->_vPrimaryContactEmail,
						'vPrimaryContactTelephone'		=>	$this->_vPrimaryContactTelephone,
						'vPrimaryContactMobile'		=>	$this->_vPrimaryContactMobile,
						'iBankId'		=>	$this->_iBankId,
						'vBankName'		=>	$this->_vBankName,
						'vBankCode'		=>	$this->_vBankCode,
						'vBranchName'		=>	$this->_vBranchName,
						'vBranchCode'		=>	$this->_vBranchCode,
						'vAccount1Number'		=>	$this->_vAccount1Number,
						'vAccount1Title'		=>	$this->_vAccount1Title,
						'vAccount1Currency'		=>	$this->_vAccount1Currency,
						'vAccount2Number'		=>	$this->_vAccount2Number,
						'vAccount2Title'		=>	$this->_vAccount2Title,
						'vAccount2Currency'		=>	$this->_vAccount2Currency,
						'vVatId'		=>	$this->_vVatId,
						'iSchemeId'		=>	$this->_iSchemeId,
						'vSchemeCode'		=>	$this->_vSchemeCode,
						// 'eCreateMethodAllowed'		=>	$this->_eCreateMethodAllowed,
						// 'eReqVerification'		=>	$this->_eReqVerification,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'dCreateFromIP'		=>	$this->_dCreateFromIP,
						'dVerifiedFromIP'		=>	$this->_dVerifiedFromIP,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eSelfReg' 			=> $this->_eSelfReg,
						'vActivationCode' 			=> $this->_vActivationCode,
						'eStatus'		=>	$this->_eStatus
			);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_master",$Data,'update',$where);
		return $result;
	}

	function updateData($data,$where)
	{
      //prints($data);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_master",$data,'update',$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_organization_master $cnt $limit";
       // echo $sql; //exit;
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

	function getDetails_PG($field='*',$where='',$orderBy='',$groupBy='',$limit='')
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

      $sql =  "SELECT $field FROM ".PRJ_DB_PREFIX."_organization_master $cnt $limit";
		// echo $sql; //exit;
		$sql_count = "select Count(*) as tot from ".PRJ_DB_PREFIX."_organization_master $cnt";
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
      }
		if($orderBy != '') {
         $cnt .= " Order By ".$orderBy;
			$cnt_count .=" Order By ".$orderBy;
      }
      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_organization_master org $jtbl $cnt $limit";
		// echo $sql; exit;
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=='yes')
		{
			$sql_count = "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_organization_master org $jtbl $cnt_count";
               //print $sql_count;
			$row_count = $this->_obj->MySQLSelect($sql_count);
/*         if($groupBy != '') {
				$row['tot'] = count($row_count);
			}
			else {
				$row['tot'] = $row_count[0]['tot'];
			}
 */
		}
      $row['tot'] = $row_count[0]['tot'];
      return $row;
	}

	function getOADashboardAssocStats($table,$where)
	{
		$sql = "Select (select count(*) from $table where 1 AND $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eStatus='Delete' OR eNeedToVerify='Yes' )) as verify_org,
					(select count(*) from $table where 1 AND $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) as actrec,
					(select count(*) from $table where 1 AND $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) as inactrec,
					(select count(*) from $table where 1 AND $where ) as tot ";
		// (select count(*) from $table where ((eStatus='Active' OR eStatus='Inactive') AND eNeedToVerify='No')) as act_org,
		// echo $sql; exit;
		$row =  $this->_obj->MySQLSelect($sql);
      return $row;
	}

	function getUniqueCode($type)
	{
		$sql = "Select COUNT(*) as tot from ".PRJ_DB_PREFIX."_organization_master where dCreatedDate > '".date('Y-m-d')."'";
		// echo $sql; exit;
		$rw =  $this->_obj->MySQLSelect($sql);
		$num = ($rw[0]['tot']+1);
		// echo $num; exit;
		if($num<10) {
			$num = '000'.$num;
		} else if($num<100) {
			$num = '00'.$num;
		} else if($num<1000) {
			$num = '0'.$num;
		}
		$t=0;
		if($type == 'Buyer') {
			$t=1;
		} else if($type == 'Supplier') {
			$t=2;
		} else if($type == 'Both') {
			$t=3;
		}
		$code = '001'.date('ymd').$t.$num;
		// echo $code; exit;
		return $code;
	}

	function getOADashboardGrpStats($table,$where)
	{
		$sql = "Select (select count(*) from $table where 1 AND $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eStatus='Delete' OR eNeedToVerify='Yes' )) as verify_org,
					(select count(*) from $table where 1 AND $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) as actrec,
					(select count(*) from $table where 1 AND $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) as inactrec,
					(select count(*) from $table where 1 AND $where ) as tot";
		// (select count(*) from $table where ((eStatus='Active' OR eStatus='Inactive') AND eNeedToVerify='No')) as act_org,
		$row =  $this->_obj->MySQLSelect($sql);
      return $row;
	}

	function delOrgRelRec($iOrgId, $orgdtls=array())
	{
      global $sess_id, $sess_usertype_short;

		if(is_array($orgdtls) && count($orgdtls)>0) {
         if(isset($orgdtls[0]['eOrganizationType']) && $orgdtls[0]['eOrganizationType']=='Buyer2') {
            /*$sql = "INSERT INTO b2b_buyer2_bproduct_association_toverify
                     (iAssociationId,iBuyer2Id,iProductId,vACode,fGlobalLimit,fOutstandingAmt,fFeePc,fFeeFlat,fAdvancePc,fMinValue,fMaxValue,vAccount1,vAccount2,vAccount3,vAccount4,vAccount5,vAccount6,vAccount7,vAccount8,vNarrative,dADate,vFromIP,iCreatedByID,eCreatedBy,iModifiedByID,eModifiedBy,dModifiedDate,iRejectedByID,eRejectedBy,dRejectedDate,iVerifiedByID,eVerifiedBy,dVerifiedDate,tReasonToReject,eNeedToVerify,eStatus)
                     SELECT
                     (iAssociationId,iBuyer2Id,iProductId,vACode,fGlobalLimit,fOutstandingAmt,fFeePc,fFeeFlat,fAdvancePc,fMinValue,fMaxValue,vAccount1,vAccount2,vAccount3,vAccount4,vAccount5,vAccount6,vAccount7,vAccount8,vNarrative,dADate,vFromIP,iCreatedByID,eCreatedBy,".$orgdtls[0]['iModifiedByID'].",".$orgdtls[0]['eModifiedBy'].",".$orgdtls[0]['dModifiedDate'].",iRejectedByID,eRejectedBy,dRejectedDate,".$sess_id.",".$sess_usertype_short.",".date('Y-m-d H:i:s').",tReasonToReject,'No','Delete')
                     FROM b2b_buyer2_bproduct_association WHERE id IN ()";
            $result = $this->_obj->sql_query($sql);
            $sql = "INSERT INTO b2b_buyer2_sproduct_association_toverify
                     (iAssociationId,iBuyer2Id,iProductId,vACode,fGlobalLimit,fOutstandingAmt,fFeePc,fFeeFlat,fAdvancePc,fMinValue,fMaxValue,vAccount1,vAccount2,vAccount3,vAccount4,vAccount5,vAccount6,vAccount7,vAccount8,vNarrative,dADate,vFromIP,iCreatedByID,eCreatedBy,iModifiedByID,eModifiedBy,dModifiedDate,iRejectedByID,eRejectedBy,dRejectedDate,iVerifiedByID,eVerifiedBy,dVerifiedDate,tReasonToReject,eNeedToVerify,eStatus)
                     SELECT
                     (iAssociationId,iBuyer2Id,iProductId,vACode,fGlobalLimit,fOutstandingAmt,fFeePc,fFeeFlat,fAdvancePc,fMinValue,fMaxValue,vAccount1,vAccount2,vAccount3,vAccount4,vAccount5,vAccount6,vAccount7,vAccount8,vNarrative,dADate,vFromIP,iCreatedByID,eCreatedBy,".$orgdtls[0]['iModifiedByID'].",".$orgdtls[0]['eModifiedBy'].",".$orgdtls[0]['dModifiedDate'].",iRejectedByID,eRejectedBy,dRejectedDate,".$sess_id.",".$sess_usertype_short.",".date('Y-m-d H:i:s').",tReasonToReject,'No','Delete')
                     FROM b2b_buyer2_bproduct_association WHERE id IN ()";
            $result = $this->_obj->sql_query($sql);*/
            $sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_bproduct_association where iBuyer2Id=$iOrgId";
            $result = $this->_obj->sql_query($sql);
            $sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_sproduct_association where iBuyer2Id=$iOrgId";
            $result = $this->_obj->sql_query($sql);
         }
      }
      $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_user_permission WHERE iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user where iOrganizationID=$iOrgId)";
      $result = $this->_obj->sql_query($sql);
		$sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_user where iOrganizationID=$iOrgId";
      $result = $this->_obj->sql_query($sql);
      $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_default_settings WHERE iOrganizationID=$iOrgId";
      $result = $this->_obj->sql_query($sql);
		return $result;
	}

	function delAllAssocs($iOrgId, $typ='') 	// $orgdtls=array()
	{
		global $sess_id, $sess_usertype_short;
		$result='';
		if(trim($iOrgId)!='' && $iOrgId>0) {
			//if($typ=='b2') {
				/*$sql = "INSERT INTO b2b_buyer2_bproduct_association_toverify
                     (iAssociationId,iBuyer2Id,iProductId,vACode,fGlobalLimit,fOutstandingAmt,fFeePc,fFeeFlat,fAdvancePc,fMinValue,fMaxValue,vAccount1,vAccount2,vAccount3,vAccount4,vAccount5,vAccount6,vAccount7,vAccount8,vNarrative,dADate,vFromIP,iCreatedByID,eCreatedBy,iModifiedByID,eModifiedBy,dModifiedDate,iRejectedByID,eRejectedBy,dRejectedDate,iVerifiedByID,eVerifiedBy,dVerifiedDate,tReasonToReject,eNeedToVerify,eStatus)
                     SELECT
                     (iAssociationId,iBuyer2Id,iProductId,vACode,fGlobalLimit,fOutstandingAmt,fFeePc,fFeeFlat,fAdvancePc,fMinValue,fMaxValue,vAccount1,vAccount2,vAccount3,vAccount4,vAccount5,vAccount6,vAccount7,vAccount8,vNarrative,dADate,vFromIP,iCreatedByID,eCreatedBy,iModifiedByID,eModifiedBy,dModifiedDate,iRejectedByID,eRejectedBy,dRejectedDate,".$sess_id.",".$sess_usertype_short.",".date('Y-m-d H:i:s').",tReasonToReject,'No','Delete')
                     FROM b2b_buyer2_bproduct_association WHERE iBuyer2Id=$iOrgId";
            $result = $this->_obj->sql_query($sql);*/
				$sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_bproduct_association WHERE iBuyer2ID=$iOrgId";
				//
				$result = $this->_obj->sql_query($sql);
				$sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_buyer_association WHERE iBuyer2ID=$iOrgId";
				$result = $this->_obj->sql_query($sql);
				$sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE iBuyer2ID=$iOrgId";
				$result = $this->_obj->sql_query($sql);
				$sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_sproduct_association WHERE iBuyer2ID=$iOrgId";
				$result = $this->_obj->sql_query($sql);
				$sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association WHERE iBuyer2ID=$iOrgId";
				$result = $this->_obj->sql_query($sql);
				$sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association WHERE iBuyer2ID=$iOrgId";
				$result = $this->_obj->sql_query($sql);
			//} else {
				$sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_association WHERE (iBuyerOrganizationID=$iOrgId OR iSupplierAssocationID=$iOrgId)";
				$result = $this->_obj->sql_query($sql);
			//}
		}
		return $result;
	}

   ### CHECK WHETHER THEIR ARE MULTIPLE ADMIN FOR THE SAME ORGANIZATION ###
   function ChkMultipleOrgAdmin(){
      if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID'] != ''){
         $sql = "SELECT COUNT(iUserID) as tot FROM ".PRJ_DB_PREFIX."_organization_user WHERE iOrganizationID = '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."' AND eUserType = 'Admin'";
         $result = $this->_obj->sql_query($sql);
         //Prints($result);exit();
         if($result[0]['tot'] > 1){
            $retval = 0;
         }else{
            $retval = 1;
         }
      }else{
         $retval = 0;
      }
      return $retval;
   }

	// Dashboard stats of buyer2 associations
	function getB2AsocsDashboardStats($where)
	{
		$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_bproduct_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_bproduct_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_bproduct_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_bproduct_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
		// echo $sql;
		$row[0] =  $this->_obj->MySQLSelect($sql);
		$row[0] = $row[0][0];
		$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
		$row[1] =  $this->_obj->MySQLSelect($sql);
		$row[1] = $row[1][0];
		$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
		$row[2] =  $this->_obj->MySQLSelect($sql);
		$row[2] = $row[2][0];
		$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_sproduct_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_sproduct_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_sproduct_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_sproduct_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
		$row[3] =  $this->_obj->MySQLSelect($sql);
		$row[3] = $row[3][0];
		$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
		$row[4] =  $this->_obj->MySQLSelect($sql);
		$row[4] = $row[4][0];
		$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
					(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
		$row[5] =  $this->_obj->MySQLSelect($sql);
		$row[5] = $row[5][0];
      return $row;
	}
	
	// Dashboard stats of buyer2 associations for Buyer
	function getBB2AsocsDashboardStats($id,$typ='Both')
	{
		if($typ!='Supplier') {
			$where = " AND iBuyerId=$id ";
			$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
			$row[1] =  $this->_obj->MySQLSelect($sql);
			$row[1] = $row[1][0];
			$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
			$row[2] =  $this->_obj->MySQLSelect($sql);
			$row[2] = $row[2][0];
		}
		if($typ!='Buyer') {
			$where = " AND iSupplierId=$id ";
			$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
			$row[4] =  $this->_obj->MySQLSelect($sql);
			$row[4] = $row[4][0];
			$sql = "SELECT (SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association WHERE 1 $where AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' )) AS verifyrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association WHERE 1 $where AND (eStatus='Active' AND eNeedToVerify!='Yes' )) AS actrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association WHERE 1 $where AND (eStatus='Inactive' AND eNeedToVerify!='Yes' )) AS inactrec,
						(SELECT COUNT(*) FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association WHERE 1 $where AND NOT(eStatus='Delete' AND eNeedToVerify!='Yes') ) AS tot";
			$row[5] =  $this->_obj->MySQLSelect($sql);
			$row[5] = $row[5][0];
		}
      return $row;
	}
	
	function getOrgUsersPermits($orgid)
	{
	   $dtls = array();
	   if(trim($orgid)!='' && $orgid>0)
		{
			$sql = "SELECT ou.*,  
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.tPermission,oup.tPermission) AS tPermission,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.tAcceptancePermit,oup.tAcceptancePermit) AS tAcceptancePermit,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.eFormCreation,oup.eFormCreation) AS eFormCreation,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.eImportCreation,oup.eImportCreation) AS eImportCreation,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.eVerify,oup.eVerify) AS eVerify,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.vRFQ2Permits,oup.vRFQ2Permits) AS vRFQ2Permits,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.vRFQ2BidPermits,oup.vRFQ2BidPermits) AS vRFQ2BidPermits,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.vRFQ2AwardPermits,oup.vRFQ2AwardPermits) AS vRFQ2AwardPermits,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.vRFQ2AwardAcceptPermits,oup.vRFQ2AwardAcceptPermits) AS vRFQ2AwardAcceptPermits,
						  IF(ou.ePermissionType='Group' AND ou.iGroupID>0, grp.eInvFPO,oup.eInvFPO) AS eInvFPO
						  FROM b2b_organization_user ou
						  LEFT JOIN b2b_organization_user_permission oup ON oup.iUserID=ou.iUserID
						  LEFT JOIN b2b_organization_group grp ON grp.iGroupID=ou.iGroupID
						  WHERE ou.iOrganizationID=$orgid ";
			$dtls =  $this->_obj->MySQLSelect($sql);
		}
		return $dtls;
	}
}
?>