<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        Organization_Preference_Toverify
* GENERATION DATE:  19.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.Organization_Preference_Toverify.php
* FOR MYSQL TABLE:  b2b_organization_default_settings_toverify
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class OrganizationPreferenceToverify
{
/**
*   @desc Variable Declaration with default value
*/

	protected $iVerifiedID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iVerifiedID;
	protected $_iAdditionalInfoID;
	protected $_iOrganizationID;
	protected $_tSourcingDocument;
	protected $_tGlobalAgreement;
	protected $_tPaymentTerms;
	protected $_tFOB;
	protected $_tDeliveryTerms;
	protected $_tShippingControl;
	protected $_tConditionsForPayment;
	protected $_tPenalties;
	protected $_tSpecialInstruction;
	protected $_tNote;
	protected $_tTermsAndConditions;
	protected $_vCurrency;
	protected $_fVAT;
	protected $_fOtherTax;
	protected $_fWithHoldingTax;
	protected $_vOrderStatusLevel;
	protected $_vInvoiceStatusLevel;
	protected $_vOrderAcceptanceLevel;
	protected $_vInvoiceAcceptanceLevel;
	protected $_eCreateMethodAllowedPO;
	protected $_eCreateMethodAllowedInv;
	protected $_eReqVerificationInv;
	protected $_eReqVerificationPo;
	protected $_eReqVerifyPoAcpt;
	protected $_eReqVerifyInvAcpt;
	protected $_vEncryptionKey;
	protected $_eSecureImportPO;
	protected $_eSecureImportInvoice;
	protected $_eSecureExportPO;
	protected $_eSecureExportInvoice;
	protected $_eCryptAlgo;
	protected $_eRFQ2VerifyReq;
	protected $_eRFQ2AwardVerifyReq;
	protected $_vRFQ2AwardStatusLevel;
	protected $_eRFQ2BidVerifyReq;
	protected $_eRFQ2AwardAcceptVerifyReq;
	protected $_vRFQ2AwardAcceptLevel;
	protected $_iModifiedByID;
	protected $_eModifiedBy;
	protected $_dCreatedDate;
	protected $_dModifiedDate;
	protected $_iCreatedBy;
	protected $_eCreatedBy;
	protected $_iVerifiedByID;
	protected $_eVerifiedBy;
	protected $_dVerifiedDate;
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
		$this->_iAdditionalInfoID = null;
		$this->_iOrganizationID = null;
		$this->_tSourcingDocument = null;
		$this->_tGlobalAgreement = null;
		$this->_tPaymentTerms = null;
		$this->_tFOB = null;
		$this->_tDeliveryTerms = null;
		$this->_tShippingControl = null;
		$this->_tConditionsForPayment = null;
		$this->_tPenalties = null;
		$this->_tSpecialInstruction = null;
		$this->_tNote = null;
		$this->_tTermsAndConditions = null;
		$this->_vCurrency = null;
		$this->_fVAT = null;
		$this->_fOtherTax = null;
		$this->_fWithHoldingTax = null;
		$this->_vOrderStatusLevel = null;
		$this->_vInvoiceStatusLevel = null;
		$this->_vOrderAcceptanceLevel = null;
		$this->_vInvoiceAcceptanceLevel = null;
		$this->_eCreateMethodAllowedPO = null;
		$this->_eCreateMethodAllowedInv = null;
		$this->_eReqVerificationInv = null;
		$this->_eReqVerificationPo = null;
		$this->_eReqVerifyPoAcpt = null;
		$this->_eReqVerifyInvAcpt = null;
		$this->_vEncryptionKey = null;
		$this->_eSecureImportPO = null;
		$this->_eSecureImportInvoice = null;
		$this->_eSecureExportPO = null;
		$this->_eSecureExportInvoice = null;
		$this->_eCryptAlgo = null;
		$this->_eRFQ2VerifyReq = null;
		$this->_eRFQ2AwardVerifyReq = null;
		$this->_vRFQ2AwardStatusLevel = null;
		$this->_eRFQ2BidVerifyReq = null;
		$this->_eRFQ2AwardAcceptVerifyReq = null;
		$this->_vRFQ2AwardAcceptLevel = null;
		$this->_iModifiedByID = null;
		$this->_eModifiedBy = null;
		$this->_dCreatedDate = null;
		$this->_dModifiedDate = null;
		$this->_iCreatedBy = null;
		$this->_eCreatedBy = null;
		$this->_iVerifiedByID = null;
		$this->_eVerifiedBy = null;
		$this->_dVerifiedDate = null;
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

	public function getiAdditionalInfoID()
	{
		return $this->_iAdditionalInfoID;
	}

	public function getiOrganizationID()
	{
		return $this->_iOrganizationID;
	}

	public function gettSourcingDocument()
	{
		return $this->_tSourcingDocument;
	}

	public function gettGlobalAgreement()
	{
		return $this->_tGlobalAgreement;
	}

	public function gettPaymentTerms()
	{
		return $this->_tPaymentTerms;
	}

	public function gettFOB()
	{
		return $this->_tFOB;
	}

	public function gettDeliveryTerms()
	{
		return $this->_tDeliveryTerms;
	}

	public function gettShippingControl()
	{
		return $this->_tShippingControl;
	}

	public function gettConditionsForPayment()
	{
		return $this->_tConditionsForPayment;
	}

	public function gettPenalties()
	{
		return $this->_tPenalties;
	}

	public function gettSpecialInstruction()
	{
		return $this->_tSpecialInstruction;
	}

	public function gettNote()
	{
		return $this->_tNote;
	}

	public function gettTermsAndConditions()
	{
		return $this->_tTermsAndConditions;
	}

	public function getvCurrency()
	{
		return $this->_vCurrency;
	}

	public function getfVAT()
	{
		return $this->_fVAT;
	}

	public function getfOtherTax()
	{
		return $this->_fOtherTax;
	}

	public function getfWithHoldingTax()
	{
		return $this->_fWithHoldingTax;
	}

	public function getvOrderStatusLevel()
	{
		return $this->_vOrderStatusLevel;
	}

	public function getvInvoiceStatusLevel()
	{
		return $this->_vInvoiceStatusLevel;
	}

	public function getvOrderAcceptanceLevel()
	{
		return $this->_vOrderAcceptanceLevel;
	}

	public function getvInvoiceAcceptanceLevel()
	{
		return $this->_vInvoiceAcceptanceLevel;
	}

	public function geteCreateMethodAllowedPO()
	{
		return $this->_eCreateMethodAllowedPO;
	}

	public function geteCreateMethodAllowedInv()
	{
		return $this->_eCreateMethodAllowedInv;
	}

	public function geteReqVerificationInv()
	{
		return $this->_eReqVerificationInv;
	}

	public function geteReqVerificationPo()
	{
		return $this->_eReqVerificationPo;
	}

	public function geteReqVerifyPoAcpt()
	{
		return $this->_eReqVerifyPoAcpt;
	}

	public function geteReqVerifyInvAcpt()
	{
		return $this->_eReqVerifyInvAcpt;
	}

	public function getvEncryptionKey()
	{
		return $this->_vEncryptionKey;
	}

	public function geteSecureImportPO()
	{
		return $this->_eSecureImportPO;
	}

	public function geteSecureImportInvoice()
	{
		return $this->_eSecureImportInvoice;
	}

	public function geteSecureExportPO()
	{
		return $this->_eSecureExportPO;
	}

	public function geteSecureExportInvoice()
	{
		return $this->_eSecureExportInvoice;
	}

	public function geteCryptAlgo()
	{
		return $this->_eCryptAlgo;
	}

	public function geteRFQ2VerifyReq()
	{
		return $this->_eRFQ2VerifyReq;
	}

	public function geteRFQ2AwardVerifyReq()
	{
		return $this->_eRFQ2AwardVerifyReq;
	}

	public function getvRFQ2AwardStatusLevel()
	{
		return $this->_vRFQ2AwardStatusLevel;
	}

	public function geteRFQ2BidVerifyReq()
	{
		return $this->_eRFQ2BidVerifyReq;
	}

	public function geteRFQ2AwardAcceptVerifyReq()
	{
		return $this->_eRFQ2AwardAcceptVerifyReq;
	}

	public function getvRFQ2AwardAcceptLevel()
	{
		return $this->_vRFQ2AwardAcceptLevel;
	}

	public function getiModifiedByID()
	{
		return $this->_iModifiedByID;
	}

	public function geteModifiedBy()
	{
		return $this->_eModifiedBy;
	}

	public function getdCreatedDate()
	{
		return $this->_dCreatedDate;
	}

	public function getdModifiedDate()
	{
		return $this->_dModifiedDate;
	}

	public function getiCreatedBy()
	{
		return $this->_iCreatedBy;
	}

	public function geteCreatedBy()
	{
		return $this->_eCreatedBy;
	}

	public function getiVerifiedByID()
	{
		return $this->_iVerifiedByID;
	}

	public function geteVerifiedBy()
	{
		return $this->_eVerifiedBy;
	}

	public function getdVerifiedDate()
	{
		return $this->_dVerifiedDate;
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

	public function setiAdditionalInfoID($val)
	{
		 $this->_iAdditionalInfoID =  $val;
	}

	public function setiOrganizationID($val)
	{
		 $this->_iOrganizationID =  $val;
	}

	public function settSourcingDocument($val)
	{
		 $this->_tSourcingDocument =  $val;
	}

	public function settGlobalAgreement($val)
	{
		 $this->_tGlobalAgreement =  $val;
	}

	public function settPaymentTerms($val)
	{
		 $this->_tPaymentTerms =  $val;
	}

	public function settFOB($val)
	{
		 $this->_tFOB =  $val;
	}

	public function settDeliveryTerms($val)
	{
		 $this->_tDeliveryTerms =  $val;
	}

	public function settShippingControl($val)
	{
		 $this->_tShippingControl =  $val;
	}

	public function settConditionsForPayment($val)
	{
		 $this->_tConditionsForPayment =  $val;
	}

	public function settPenalties($val)
	{
		 $this->_tPenalties =  $val;
	}

	public function settSpecialInstruction($val)
	{
		 $this->_tSpecialInstruction =  $val;
	}

	public function settNote($val)
	{
		 $this->_tNote =  $val;
	}

	public function settTermsAndConditions($val)
	{
		 $this->_tTermsAndConditions =  $val;
	}

	public function setvCurrency($val)
	{
		 $this->_vCurrency =  $val;
	}

	public function setfVAT($val)
	{
		 $this->_fVAT =  $val;
	}

	public function setfOtherTax($val)
	{
		 $this->_fOtherTax =  $val;
	}

	public function setfWithHoldingTax($val)
	{
		 $this->_fWithHoldingTax =  $val;
	}

	public function setvOrderStatusLevel($val)
	{
		 $this->_vOrderStatusLevel =  $val;
	}

	public function setvInvoiceStatusLevel($val)
	{
		 $this->_vInvoiceStatusLevel =  $val;
	}

	public function setvOrderAcceptanceLevel($val)
	{
		 $this->_vOrderAcceptanceLevel =  $val;
	}

	public function setvInvoiceAcceptanceLevel($val)
	{
		 $this->_vInvoiceAcceptanceLevel =  $val;
	}

	public function seteCreateMethodAllowedPO($val)
	{
		 $this->_eCreateMethodAllowedPO =  $val;
	}

	public function seteCreateMethodAllowedInv($val)
	{
		 $this->_eCreateMethodAllowedInv =  $val;
	}

	public function seteReqVerificationInv($val)
	{
		 $this->_eReqVerificationInv =  $val;
	}

	public function seteReqVerificationPo($val)
	{
		 $this->_eReqVerificationPo =  $val;
	}

	public function seteReqVerifyPoAcpt($val)
	{
		 $this->_eReqVerifyPoAcpt =  $val;
	}

	public function seteReqVerifyInvAcpt($val)
	{
		 $this->_eReqVerifyInvAcpt =  $val;
	}

	public function setvEncryptionKey($val)
	{
		 $this->_vEncryptionKey =  $val;
	}

	public function seteSecureImportPO($val)
	{
		 $this->_eSecureImportPO =  $val;
	}

	public function seteSecureImportInvoice($val)
	{
		 $this->_eSecureImportInvoice =  $val;
	}

	public function seteSecureExportPO($val)
	{
		 $this->_eSecureExportPO =  $val;
	}

	public function seteSecureExportInvoice($val)
	{
		 $this->_eSecureExportInvoice =  $val;
	}

	public function seteCryptAlgo($val)
	{
		 $this->_eCryptAlgo =  $val;
	}

	public function seteRFQ2VerifyReq($val)
	{
		 $this->_eRFQ2VerifyReq =  $val;
	}

	public function seteRFQ2AwardVerifyReq($val)
	{
		 $this->_eRFQ2AwardVerifyReq =  $val;
	}

	public function setvRFQ2AwardStatusLevel($val)
	{
		 $this->_vRFQ2AwardStatusLevel =  $val;
	}

	public function seteRFQ2BidVerifyReq($val)
	{
		 $this->_eRFQ2BidVerifyReq =  $val;
	}

	public function seteRFQ2AwardAcceptVerifyReq($val)
	{
		 $this->_eRFQ2AwardAcceptVerifyReq =  $val;
	}

	public function setvRFQ2AwardAcceptLevel($val)
	{
		 $this->_vRFQ2AwardAcceptLevel =  $val;
	}

	public function setiModifiedByID($val)
	{
		 $this->_iModifiedByID =  $val;
	}

	public function seteModifiedBy($val)
	{
		 $this->_eModifiedBy =  $val;
	}

	public function setdCreatedDate($val)
	{
		 $this->_dCreatedDate =  $val;
	}

	public function setdModifiedDate($val)
	{
		 $this->_dModifiedDate =  $val;
	}

	public function setiCreatedBy($val)
	{
		 $this->_iCreatedBy =  $val;
	}

	public function seteCreatedBy($val)
	{
		 $this->_eCreatedBy =  $val;
	}

	public function setiVerifiedByID($val)
	{
		 $this->_iVerifiedByID =  $val;
	}

	public function seteVerifiedBy($val)
	{
		 $this->_eVerifiedBy =  $val;
	}

	public function setdVerifiedDate($val)
	{
		 $this->_dVerifiedDate =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_default_settings_toverify WHERE iVerifiedID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_default_settings_toverify WHERE iVerifiedID=$this->_iVerifiedID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iVerifiedID = $row[0]['iVerifiedID'];
		 $this->_iAdditionalInfoID = $row[0]['iAdditionalInfoID'];
		 $this->_iOrganizationID = $row[0]['iOrganizationID'];
		 $this->_tSourcingDocument = $row[0]['tSourcingDocument'];
		 $this->_tGlobalAgreement = $row[0]['tGlobalAgreement'];
		 $this->_tPaymentTerms = $row[0]['tPaymentTerms'];
		 $this->_tFOB = $row[0]['tFOB'];
		 $this->_tDeliveryTerms = $row[0]['tDeliveryTerms'];
		 $this->_tShippingControl = $row[0]['tShippingControl'];
		 $this->_tConditionsForPayment = $row[0]['tConditionsForPayment'];
		 $this->_tPenalties = $row[0]['tPenalties'];
		 $this->_tSpecialInstruction = $row[0]['tSpecialInstruction'];
		 $this->_tNote = $row[0]['tNote'];
		 $this->_tTermsAndConditions = $row[0]['tTermsAndConditions'];
		 $this->_vCurrency = $row[0]['vCurrency'];
		 $this->_fVAT = $row[0]['fVAT'];
		 $this->_fOtherTax = $row[0]['fOtherTax'];
		 $this->_fWithHoldingTax = $row[0]['fWithHoldingTax'];
		 $this->_vOrderStatusLevel = $row[0]['vOrderStatusLevel'];
		 $this->_vInvoiceStatusLevel = $row[0]['vInvoiceStatusLevel'];
		 $this->_vOrderAcceptanceLevel = $row[0]['vOrderAcceptanceLevel'];
		 $this->_vInvoiceAcceptanceLevel = $row[0]['vInvoiceAcceptanceLevel'];
		 $this->_eCreateMethodAllowedPO = $row[0]['eCreateMethodAllowedPO'];
		 $this->_eCreateMethodAllowedInv = $row[0]['eCreateMethodAllowedInv'];
		 $this->_eReqVerificationInv = $row[0]['eReqVerificationInv'];
		 $this->_eReqVerificationPo = $row[0]['eReqVerificationPo'];
		 $this->_eReqVerifyPoAcpt = $row[0]['eReqVerifyPoAcpt'];
		 $this->_eReqVerifyInvAcpt = $row[0]['eReqVerifyInvAcpt'];
		 $this->_vEncryptionKey = $row[0]['vEncryptionKey'];
		 $this->_eSecureImportPO = $row[0]['eSecureImportPO'];
		 $this->_eSecureImportInvoice = $row[0]['eSecureImportInvoice'];
		 $this->_eSecureExportPO = $row[0]['eSecureExportPO'];
		 $this->_eSecureExportInvoice = $row[0]['eSecureExportInvoice'];
		 $this->_eCryptAlgo = $row[0]['eCryptAlgo'];
		 $this->_eRFQ2VerifyReq = $row[0]['eRFQ2VerifyReq'];
		 $this->_eRFQ2AwardVerifyReq = $row[0]['eRFQ2AwardVerifyReq'];
		 $this->_vRFQ2AwardStatusLevel = $row[0]['vRFQ2AwardStatusLevel'];
		 $this->_eRFQ2BidVerifyReq = $row[0]['eRFQ2BidVerifyReq'];
		 $this->_eRFQ2AwardAcceptVerifyReq = $row[0]['eRFQ2AwardAcceptVerifyReq'];
		 $this->_vRFQ2AwardAcceptLevel = $row[0]['vRFQ2AwardAcceptLevel'];
		 $this->_iModifiedByID = $row[0]['iModifiedByID'];
		 $this->_eModifiedBy = $row[0]['eModifiedBy'];
		 $this->_dCreatedDate = $row[0]['dCreatedDate'];
		 $this->_dModifiedDate = $row[0]['dModifiedDate'];
		 $this->_iCreatedBy = $row[0]['iCreatedBy'];
		 $this->_eCreatedBy = $row[0]['eCreatedBy'];
		 $this->_iVerifiedByID = $row[0]['iVerifiedByID'];
		 $this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		 $this->_dVerifiedDate = $row[0]['dVerifiedDate'];
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_default_settings_toverify WHERE iVerifiedID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iVerifiedID = '';
		 $this->iVerifiedID = ""; // clear key for autoincrement

		 $Data = array(
						 'iAdditionalInfoID'		=>	$this->_iAdditionalInfoID,
						'iOrganizationID'		=>	$this->_iOrganizationID,
						'tSourcingDocument'		=>	$this->_tSourcingDocument,
						'tGlobalAgreement'		=>	$this->_tGlobalAgreement,
						'tPaymentTerms'		=>	$this->_tPaymentTerms,
						'tFOB'		=>	$this->_tFOB,
						'tDeliveryTerms'		=>	$this->_tDeliveryTerms,
						'tShippingControl'		=>	$this->_tShippingControl,
						'tConditionsForPayment'		=>	$this->_tConditionsForPayment,
						'tPenalties'		=>	$this->_tPenalties,
						'tSpecialInstruction'		=>	$this->_tSpecialInstruction,
						'tNote'		=>	$this->_tNote,
						'tTermsAndConditions'		=>	$this->_tTermsAndConditions,
						'vCurrency'		=>	$this->_vCurrency,
						'fVAT'		=>	$this->_fVAT,
						'fOtherTax'		=>	$this->_fOtherTax,
						'fWithHoldingTax'		=>	$this->_fWithHoldingTax,
						'vOrderStatusLevel'		=>	$this->_vOrderStatusLevel,
						'vInvoiceStatusLevel'		=>	$this->_vInvoiceStatusLevel,
						'vOrderAcceptanceLevel'		=>	$this->_vOrderAcceptanceLevel,
						'vInvoiceAcceptanceLevel'		=>	$this->_vInvoiceAcceptanceLevel,
						'eCreateMethodAllowedPO'		=>	$this->_eCreateMethodAllowedPO,
						'eCreateMethodAllowedInv'		=>	$this->_eCreateMethodAllowedInv,
						'eReqVerificationInv'		=>	$this->_eReqVerificationInv,
						'eReqVerificationPo'		=>	$this->_eReqVerificationPo,
						'eReqVerifyPoAcpt'		=>	$this->_eReqVerifyPoAcpt,
						'eReqVerifyInvAcpt'		=>	$this->_eReqVerifyInvAcpt,
						'vEncryptionKey'		=>	$this->_vEncryptionKey,
						'eSecureImportPO'		=>	$this->_eSecureImportPO,
						'eSecureImportInvoice'		=>	$this->_eSecureImportInvoice,
						'eSecureExportPO'		=>	$this->_eSecureExportPO,
						'eSecureExportInvoice'		=>	$this->_eSecureExportInvoice,
						'eCryptAlgo'		=>	$this->_eCryptAlgo,
						'eRFQ2VerifyReq'		=>	$this->_eRFQ2VerifyReq,
						'eRFQ2AwardVerifyReq'		=>	$this->_eRFQ2AwardVerifyReq,
						'vRFQ2AwardStatusLevel'		=>	$this->_vRFQ2AwardStatusLevel,
						'eRFQ2BidVerifyReq'		=>	$this->_eRFQ2BidVerifyReq,
						'eRFQ2AwardAcceptVerifyReq'		=>	$this->_eRFQ2AwardAcceptVerifyReq,
						'vRFQ2AwardAcceptLevel'		=>	$this->_vRFQ2AwardAcceptLevel,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'iCreatedBy'		=>	$this->_iCreatedBy,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iVerifiedByID'		=>	$this->_iVerifiedByID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
         );

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_default_settings_toverify",$Data,'insert');
		 return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iAdditionalInfoID'		=>	$this->_iAdditionalInfoID,
						'iOrganizationID'		=>	$this->_iOrganizationID,
						'tSourcingDocument'		=>	$this->_tSourcingDocument,
						'tGlobalAgreement'		=>	$this->_tGlobalAgreement,
						'tPaymentTerms'		=>	$this->_tPaymentTerms,
						'tFOB'		=>	$this->_tFOB,
						'tDeliveryTerms'		=>	$this->_tDeliveryTerms,
						'tShippingControl'		=>	$this->_tShippingControl,
						'tConditionsForPayment'		=>	$this->_tConditionsForPayment,
						'tPenalties'		=>	$this->_tPenalties,
						'tSpecialInstruction'		=>	$this->_tSpecialInstruction,
						'tNote'		=>	$this->_tNote,
						'tTermsAndConditions'		=>	$this->_tTermsAndConditions,
						'vCurrency'		=>	$this->_vCurrency,
						'fVAT'		=>	$this->_fVAT,
						'fOtherTax'		=>	$this->_fOtherTax,
						'fWithHoldingTax'		=>	$this->_fWithHoldingTax,
						'vOrderStatusLevel'		=>	$this->_vOrderStatusLevel,
						'vInvoiceStatusLevel'		=>	$this->_vInvoiceStatusLevel,
						'vOrderAcceptanceLevel'		=>	$this->_vOrderAcceptanceLevel,
						'vInvoiceAcceptanceLevel'		=>	$this->_vInvoiceAcceptanceLevel,
						'eCreateMethodAllowedPO'		=>	$this->_eCreateMethodAllowedPO,
						'eCreateMethodAllowedInv'		=>	$this->_eCreateMethodAllowedInv,
						'eReqVerificationInv'		=>	$this->_eReqVerificationInv,
						'eReqVerificationPo'		=>	$this->_eReqVerificationPo,
						'eReqVerifyPoAcpt'		=>	$this->_eReqVerifyPoAcpt,
						'eReqVerifyInvAcpt'		=>	$this->_eReqVerifyInvAcpt,
						'vEncryptionKey'		=>	$this->_vEncryptionKey,
						'eSecureImportPO'		=>	$this->_eSecureImportPO,
						'eSecureImportInvoice'		=>	$this->_eSecureImportInvoice,
						'eSecureExportPO'		=>	$this->_eSecureExportPO,
						'eSecureExportInvoice'		=>	$this->_eSecureExportInvoice,
						'eCryptAlgo'		=>	$this->_eCryptAlgo,
						'eRFQ2VerifyReq'		=>	$this->_eRFQ2VerifyReq,
						'eRFQ2AwardVerifyReq'		=>	$this->_eRFQ2AwardVerifyReq,
						'vRFQ2AwardStatusLevel'		=>	$this->_vRFQ2AwardStatusLevel,
						'eRFQ2BidVerifyReq'		=>	$this->_eRFQ2BidVerifyReq,
						'eRFQ2AwardAcceptVerifyReq'		=>	$this->_eRFQ2AwardAcceptVerifyReq,
						'vRFQ2AwardAcceptLevel'		=>	$this->_vRFQ2AwardAcceptLevel,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'iCreatedBy'		=>	$this->_iCreatedBy,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iVerifiedByID'		=>	$this->_iVerifiedByID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
         );

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_default_settings_toverify",$Data,'update',$where);
		 return $result;
	}

     function updateData($data,$where)
	{
      //prints($where);exit;
          $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_default_settings_toverify",$data,'update',$where);
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
			}//else print "<br> $KEY=$method";
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

     function getDetails($feild="*",$where="",$OrderBy="",$GroupBy="",$limit='') {
       if($where != "") {
          $cnt = " WHERE 1 ".$where;
       }

       if($GroupBy != "") {
         $groupby = " GROUP BY ".$GroupBy;
       }

       if($OrderBy != "") {
          $cnt .= " Order By ".$OrderBy;
          $orderby = " ORDER BY ".$OrderBy;
       }

       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_organization_default_settings_toverify $cnt $limit";
      // echo $sql;exit;
		 $row =  $this->_obj->MySQLSelect($sql);
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
      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_organization_default_settings_toverify orgpf $jtbl $cnt $limit";
		// echo $sql; exit;
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=='yes')
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_organization_default_settings_toverify orgpf $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
/*         if($groupBy != '') {
				$row['tot'] = count($row);
			}
			else {
				$row['tot'] = $row_count[0]['tot'];
			}
 */
			$row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}
}
?>