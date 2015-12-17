<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        Organization_Toverify
* GENERATION DATE:  19.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.Organization_Toverify.php
* FOR MYSQL TABLE:  b2b_organization_master_toverify
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class Organization_Toverify
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iVerifiedID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iVerifiedID;  
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
	protected $_dCreateFromIP;  
	protected $_dVerifiedFromIP;  
	protected $_iModifiedByID;  
	protected $_eModifiedBy;  
	protected $_dModifiedDate;  
	protected $_eVerifiedBy;  
	protected $_dRejectedDate;  
	protected $_iRejectedById;  
	protected $_eRejectedBy;  
	protected $_tReasonToReject;  
	protected $_eNeedToVerify;  
	protected $_eStatus;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iVerifiedID = null; 
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
		$this->_dCreateFromIP = null; 
		$this->_dVerifiedFromIP = null; 
		$this->_iModifiedByID = null; 
		$this->_eModifiedBy = null; 
		$this->_dModifiedDate = null; 
		$this->_eVerifiedBy = null; 
		$this->_dRejectedDate = null; 
		$this->_iRejectedById = null; 
		$this->_eRejectedBy = null; 
		$this->_tReasonToReject = null; 
		$this->_eNeedToVerify = null; 
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


	public function getiVerifiedID()
	{
		return $this->_iVerifiedID;
	}

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
	} */

	public function getdCreatedDate()
	{
		return $this->_dCreatedDate;
	}

	public function getdVerifiedDate()
	{
		return $this->_dVerifiedDate;
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

	public function getdRejectedDate()
	{
		return $this->_dRejectedDate;
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

	public function geteStatus()
	{
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiVerifiedID($val)
	{
		 $this->_iVerifiedID =  $val;
	}

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

	/*public function seteCreateMethodAllowed($val)
	{
		 $this->_eCreateMethodAllowed =  $val;
	}

	public function seteReqVerification($val)
	{
		 $this->_eReqVerification =  $val;
	}*/

	public function setdCreatedDate($val)
	{
		 $this->_dCreatedDate =  $val;
	}

	public function setdVerifiedDate($val)
	{
		 $this->_dVerifiedDate =  $val;
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

	public function setdRejectedDate($val)
	{
		 $this->_dRejectedDate =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_master_toverify WHERE iVerifiedID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_master_toverify WHERE iVerifiedID=$this->_iVerifiedID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql); 

		 $this->_iVerifiedID = $row[0]['iVerifiedID'];
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
		 //$this->_eCreateMethodAllowed = $row[0]['eCreateMethodAllowed'];
		 //$this->_eReqVerification = $row[0]['eReqVerification'];
		 $this->_dCreatedDate = $row[0]['dCreatedDate'];
		 $this->_dVerifiedDate = $row[0]['dVerifiedDate'];
		 $this->_dCreateFromIP = $row[0]['dCreateFromIP'];
		 $this->_dVerifiedFromIP = $row[0]['dVerifiedFromIP'];
		 $this->_iModifiedByID = $row[0]['iModifiedByID'];
		 $this->_eModifiedBy = $row[0]['eModifiedBy'];
		 $this->_dModifiedDate = $row[0]['dModifiedDate'];
		 $this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		 $this->_dRejectedDate = $row[0]['dRejectedDate'];
		 $this->_iRejectedById = $row[0]['iRejectedById'];
		 $this->_eRejectedBy = $row[0]['eRejectedBy'];
		 $this->_tReasonToReject = $row[0]['tReasonToReject'];
		 $this->_eNeedToVerify = $row[0]['eNeedToVerify'];
		 $this->_eStatus = $row[0]['eStatus'];
		return $row;	
	}

/**
*   @desc   DELETE
*/
	function delete($id)
	{
		 if(trim($id)!='' && $id>0)
		 {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_master_toverify WHERE iVerifiedID = $id";
		 $result = $this->_obj->sql_query($sql);
		 return $result;
		 }
		 return '';
	}

/**
*   @desc   DELETE BY CONDITION
*/
	function del($where)
	{
		 if(trim($where)!='')
		 {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_master_toverify WHERE $where";
		 $result = $this->_obj->sql_query($sql);
		 return $result;
		 }
		 return '';
	}


/**
*   @desc   INSERT
*/

	function insert($Data = Array())
	{
		$this->_iVerifiedID = '';
		$this->iVerifiedID = ""; // clear key for autoincrement
		 
		if(!is_array($Data) || count($Data)<1) {
			 $Data = array(
						'iOrganizationID'		=>	$this->_iOrganizationID,
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
						//'eCreateMethodAllowed'		=>	$this->_eCreateMethodAllowed,
						//'eReqVerification'		=>	$this->_eReqVerification,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dCreateFromIP'		=>	$this->_dCreateFromIP,
						'dVerifiedFromIP'		=>	$this->_dVerifiedFromIP,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus 				
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_master_toverify",$Data,'insert');
		return $result;	
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

			$Data = array(
						'iOrganizationID'		=>	$this->_iOrganizationID,
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
						//'eCreateMethodAllowed'		=>	$this->_eCreateMethodAllowed,
						//'eReqVerification'		=>	$this->_eReqVerification,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dCreateFromIP'		=>	$this->_dCreateFromIP,
						'dVerifiedFromIP'		=>	$this->_dVerifiedFromIP,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus 				
			);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_master_toverify",$Data,'update',$where);
		 return $result;	
	}

     function updateData($data,$where)
	{
      //prints($data);exit;
      $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_master_toverify",$data,'update',$where);
		return $result;
	}

	/**
	*   @desc   SET ALL VARIABLE
	*/

	function setAllVar($Arr)
	{
		$MethodArr = get_class_methods($this);
		foreach($Arr AS $KEY => $VAL)
		{
			$method = "set".$KEY;
			if(in_array($method , $MethodArr))
			{
			  @call_user_method($method,$this,$VAL);
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

    function getDetails($field="*",$where="",$OrderBy="",$GroupBy="",$limit='')
	 {
       if($where != "") {
          $cnt = " WHERE 1 ".$where;
       }
       if($GroupBy != "") {
         $cnt .= $groupby = " GROUP BY ".$GroupBy;
       }
       if($OrderBy != "") {
         $cnt .= $orderby = " ORDER BY ".$OrderBy;
       }
       $sql =  "SELECT $field FROM b2b_organization_master_toverify $cnt $limit";
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

   /**
    * GET DATA FOR LISTING WITH PAGING
   */
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

      $sql =  "SELECT $field FROM ".PRJ_DB_PREFIX."_organization_master_toverify $cnt $limit";
		// echo $sql; exit;
		$sql_count = "select Count(*) as tot from ".PRJ_DB_PREFIX."_organization_master_toverify $cnt";

		$row = $this->_obj->MySQLSelect($sql);
		$row_count = $this->_obj->MySqlSelect($sql_count);
      if(count($row_count) > 1){
         $row['tot'] = count($row_count);
      }else{
         $row['tot'] = $row_count[0]['tot'];
      }

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
			//$cnt_count .=" Order By ".$orderBy;
      }
      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_organization_master_toverify orgtv $jtbl $cnt $limit";
	   // echo $sql;exit;
      $row = $this->_obj->MySQLSelect($sql);
		if($pg=='yes')
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_organization_master_toverify orgtv $jtbl $cnt_count";
			//print $sql_count;
               $row_count = $this->_obj->MySqlSelect($sql_count);
         if($groupBy != '') {
				$row['tot'] = count($row_count);
			}
			else {
				$row['tot'] = $row_count[0]['tot'];
			}
		}
      return $row;
	}

	function getVerificationMessage($iOrgId,$dtls)
	{
		global $smarty;
		$msg = "";
		$userid = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		$usertype = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		$orgid = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID'];

		if($dtls[0]['eStatus'] == "Need to Verify") {
			if($dtls[0]['iASMID'] == $userid) {
				$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
			} else {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$dtls[0]['iASMID'];
				$musr = $this->_obj->MySqlSelect($sql);
				$msg = $smarty->get_template_vars('LBL_REC_CREATE_BY')." ".$musr[0]['name']." ".$smarty->get_template_vars('LBL_ON')." ".DateTime($dtls[0]['dCreatedDate'],'0');
			}
		} else if($dtls[0]['eStatus'] == "Modified" || $dtls[0]['eStatus'] == "Delete" || $dtls[0]['eNeedToVerify'] == "Yes") {
			if($dtls[0]['eModifiedBy']==$usertype && $dtls[0]['iModifiedByID']==$userid) {
				$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
			} else {
				$msg = $smarty->get_template_vars('LBL_REC_MODIFIED_BY')." ".$dtls[0]['iModifiedByID']." ".$smarty->get_template_vars('LBL_ON')." ".DateTime($dtls[0]['dModifiedDate'],'0');
			}
		}
		return $msg;
	}

	function getHistory($iOrgId)
	{
		$sql = "Select * from ".PRJ_DB_PREFIX."_organization_master_toverify where iOrganizationID=$iOrgId Order By iVerifiedID ASC ";
		$vdtls = $this->_obj->MySQLSelect($sql);
		for($l=0;$l<count($vdtls);$l++) {
			// if($vdtls[$l]['eCreatedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iASMID'];
				$cusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['createdby'] = $cusr[0]['name'];
			// }

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