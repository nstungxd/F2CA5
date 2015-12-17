<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        InvoiceOrderHeading
* GENERATION DATE:  05.05.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.InvoiceOrderHeading.php
* FOR MYSQL TABLE:  b2b_inovice_order_heading
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class InvoiceOrderHeading
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iInvoiceID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iInvoiceID;  
	protected $_vInvoiceNumber;  
	protected $_vInvoiceCode;  
	protected $_vInvSupplierCode;  
	protected $_iPurchaseOrderID;  
	protected $_iBuyerID;  
	protected $_iSupplierID;  
	protected $_dCreatedDate;  
	protected $_dIssueDate;  
	protected $_iSupplierOrganizationID;  
	protected $_iBuyerOrganizationID;  
	protected $_vInvoiceSupplierCode;  
	protected $_vAssociatePOBuyerCode;  
	protected $_vBuyerName;  
	protected $_vBuyerContactParty;  
	protected $_vSupplierName;  
	protected $_vSupplierAddLine1;  
	protected $_vSupplierAddLine2;  
	protected $_vSupplierCity;  
	protected $_vSupplierZipCode;  
	protected $_vSupplierState;  
	protected $_vSupplierCountry;  
	protected $_vSupplierContactParty;  
	protected $_vSupplierContactTelephone;  
	protected $_dInvoiceDate;  
	protected $_eInvoiceType;  
	protected $_vInvoice_group;  
	protected $_tInvoiceDescription;  
	protected $_vInvoiceStatus;  
	protected $_vRegisterNumber;  
	protected $_iOpeningUnit;  
	protected $_vExtPOCode;  
	protected $_vSupplierOrderNum;  
	protected $_eLineItemTax;  
	protected $_vBillToParty;  
	protected $_vBillToAddLine1;  
	protected $_vBillToAddLine2;  
	protected $_vBillToCity;  
	protected $_vBillToState;  
	protected $_vBillToZipCode;  
	protected $_vBillToCountry;  
	protected $_vBillToContactParty;  
	protected $_vBillToContactTelephone;  
	protected $_vCurrency;  
	protected $_fVAT;  
	protected $_fOtherTax1;  
	protected $_fPrePayment;  
	protected $_fWithHoldingTax;  
	protected $_vFreight;  
	protected $_tMiscellaneous;
	protected $_fSubTotal;
	protected $_fDiscount;
	protected $_fCharge;
	protected $_fInvoiceTotal;
	protected $_dCashDiscountBaseline;  
	protected $_iMaxCashDiscountDays;  
	protected $_fMaxCashDiscountPercentage;  
	protected $_iNormalCashDiscountDays;  
	protected $_iNormalCashDiscountPercentage;  
	protected $_iNetPaymentDays;  
	protected $_dNetPaymentdate;  
	protected $_vVatId;  
	protected $_iBankId;  
	protected $_vBankName;  
	protected $_vBankCode;  
	protected $_vBranchName;  
	protected $_vBranchCode;  
	protected $_vAccountName;  
	protected $_vAccountNumber;  
	protected $_vIBAN;  
	protected $_vSwiftCode;  
	protected $_eAccepted2;
	protected $_dAcceptedDate;
	protected $_dAcceptedVat;
	protected $_dAcceptedOtherTax;
	protected $_dAcceptedWHTax;
	protected $_dAcceptedNetPaymentDate;
	protected $_fAcceptedAmount;  
	protected $_vFromIP;  
	protected $_iModifiedByID;  
	protected $_tReasonToReject;  
	protected $_vImage;  
	protected $_iStatusID;  
	protected $_iaStatusID;  
	protected $_eCreateByBuyer;  
	protected $_eSaved;  
	protected $_eDelete;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iInvoiceID = null; 
		$this->_vInvoiceNumber = null; 
		$this->_vInvoiceCode = null; 
		$this->_vInvSupplierCode = null; 
		$this->_iPurchaseOrderID = null; 
		$this->_iBuyerID = null; 
		$this->_iSupplierID = null; 
		$this->_dCreatedDate = null; 
		$this->_dIssueDate = null; 
		$this->_iSupplierOrganizationID = null; 
		$this->_iBuyerOrganizationID = null; 
		$this->_vInvoiceSupplierCode = null; 
		$this->_vAssociatePOBuyerCode = null; 
		$this->_vBuyerName = null; 
		$this->_vBuyerContactParty = null; 
		$this->_vSupplierName = null; 
		$this->_vSupplierAddLine1 = null; 
		$this->_vSupplierAddLine2 = null; 
		$this->_vSupplierCity = null; 
		$this->_vSupplierZipCode = null; 
		$this->_vSupplierState = null; 
		$this->_vSupplierCountry = null; 
		$this->_vSupplierContactParty = null; 
		$this->_vSupplierContactTelephone = null; 
		$this->_dInvoiceDate = null; 
		$this->_eInvoiceType = null; 
		$this->_vInvoice_group = null; 
		$this->_tInvoiceDescription = null; 
		$this->_vInvoiceStatus = null; 
		$this->_vRegisterNumber = null; 
		$this->_iOpeningUnit = null; 
		$this->_vExtPOCode = null; 
		$this->_vSupplierOrderNum = null; 
		$this->_eLineItemTax = null; 
		$this->_vBillToParty = null; 
		$this->_vBillToAddLine1 = null; 
		$this->_vBillToAddLine2 = null; 
		$this->_vBillToCity = null; 
		$this->_vBillToState = null; 
		$this->_vBillToZipCode = null; 
		$this->_vBillToCountry = null; 
		$this->_vBillToContactParty = null; 
		$this->_vBillToContactTelephone = null; 
		$this->_vCurrency = null; 
		$this->_fVAT = null; 
		$this->_fOtherTax1 = null; 
		$this->_fPrePayment = null; 
		$this->_fWithHoldingTax = null; 
		$this->_vFreight = null; 
		$this->_tMiscellaneous = null;
		$this->_fSubTotal = null;
		$this->_fDiscount = null;
		$this->_fCharge = null;
		$this->_fInvoiceTotal = null; 
		$this->_dCashDiscountBaseline = null; 
		$this->_iMaxCashDiscountDays = null; 
		$this->_fMaxCashDiscountPercentage = null; 
		$this->_iNormalCashDiscountDays = null; 
		$this->_iNormalCashDiscountPercentage = null; 
		$this->_iNetPaymentDays = null; 
		$this->_dNetPaymentdate = null; 
		$this->_vVatId = null; 
		$this->_iBankId = null; 
		$this->_vBankName = null; 
		$this->_vBankCode = null; 
		$this->_vBranchName = null; 
		$this->_vBranchCode = null; 
		$this->_vAccountName = null; 
		$this->_vAccountNumber = null; 
		$this->_vIBAN = null; 
		$this->_vSwiftCode = null; 
		$this->_eAccepted2 = null; 
		$this->_dAcceptedDate = null;
		$this->_dAcceptedVat = null;
		$this->_dAcceptedOtherTax = null;
		$this->_dAcceptedWHTax = null;
		$this->_dAcceptedNetPaymentDate = null;
		$this->_fAcceptedAmount = null; 
		$this->_vFromIP = null; 
		$this->_iModifiedByID = null; 
		$this->_tReasonToReject = null; 
		$this->_vImage = null; 
		$this->_iStatusID = null; 
		$this->_iaStatusID = null; 
		$this->_eCreateByBuyer = null; 
		$this->_eSaved = null; 
		$this->_eDelete = null; 
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


	public function getiInvoiceID()
	{
		return $this->_iInvoiceID;
	}

	public function getvInvoiceNumber()
	{
		return $this->_vInvoiceNumber;
	}

	public function getvInvoiceCode()
	{
		return $this->_vInvoiceCode;
	}

	public function getvInvSupplierCode()
	{
		return $this->_vInvSupplierCode;
	}

	public function getiPurchaseOrderID()
	{
		return $this->_iPurchaseOrderID;
	}

	public function getiBuyerID()
	{
		return $this->_iBuyerID;
	}

	public function getiSupplierID()
	{
		return $this->_iSupplierID;
	}

	public function getdCreatedDate()
	{
		return $this->_dCreatedDate;
	}

	public function getdIssueDate()
	{
		return $this->_dIssueDate;
	}

	public function getiSupplierOrganizationID()
	{
		return $this->_iSupplierOrganizationID;
	}

	public function getiBuyerOrganizationID()
	{
		return $this->_iBuyerOrganizationID;
	}

	public function getvInvoiceSupplierCode()
	{
		return $this->_vInvoiceSupplierCode;
	}

	public function getvAssociatePOBuyerCode()
	{
		return $this->_vAssociatePOBuyerCode;
	}

	public function getvBuyerName()
	{
		return $this->_vBuyerName;
	}

	public function getvBuyerContactParty()
	{
		return $this->_vBuyerContactParty;
	}

	public function getvSupplierName()
	{
		return $this->_vSupplierName;
	}

	public function getvSupplierAddLine1()
	{
		return $this->_vSupplierAddLine1;
	}

	public function getvSupplierAddLine2()
	{
		return $this->_vSupplierAddLine2;
	}

	public function getvSupplierCity()
	{
		return $this->_vSupplierCity;
	}

	public function getvSupplierZipCode()
	{
		return $this->_vSupplierZipCode;
	}

	public function getvSupplierState()
	{
		return $this->_vSupplierState;
	}

	public function getvSupplierCountry()
	{
		return $this->_vSupplierCountry;
	}

	public function getvSupplierContactParty()
	{
		return $this->_vSupplierContactParty;
	}

	public function getvSupplierContactTelephone()
	{
		return $this->_vSupplierContactTelephone;
	}

	public function getdInvoiceDate()
	{
		return $this->_dInvoiceDate;
	}

	public function geteInvoiceType()
	{
		return $this->_eInvoiceType;
	}

	public function getvInvoice_group()
	{
		return $this->_vInvoice_group;
	}

	public function gettInvoiceDescription()
	{
		return $this->_tInvoiceDescription;
	}

	public function getvInvoiceStatus()
	{
		return $this->_vInvoiceStatus;
	}

	public function getvRegisterNumber()
	{
		return $this->_vRegisterNumber;
	}

	public function getiOpeningUnit()
	{
		return $this->_iOpeningUnit;
	}

	public function getvExtPOCode()
	{
		return $this->_vExtPOCode;
	}

	public function getvSupplierOrderNum()
	{
		return $this->_vSupplierOrderNum;
	}

	public function geteLineItemTax()
	{
		return $this->_eLineItemTax;
	}

	public function getvBillToParty()
	{
		return $this->_vBillToParty;
	}

	public function getvBillToAddLine1()
	{
		return $this->_vBillToAddLine1;
	}

	public function getvBillToAddLine2()
	{
		return $this->_vBillToAddLine2;
	}

	public function getvBillToCity()
	{
		return $this->_vBillToCity;
	}

	public function getvBillToState()
	{
		return $this->_vBillToState;
	}

	public function getvBillToZipCode()
	{
		return $this->_vBillToZipCode;
	}

	public function getvBillToCountry()
	{
		return $this->_vBillToCountry;
	}

	public function getvBillToContactParty()
	{
		return $this->_vBillToContactParty;
	}

	public function getvBillToContactTelephone()
	{
		return $this->_vBillToContactTelephone;
	}

	public function getvCurrency()
	{
		return $this->_vCurrency;
	}

	public function getfVAT()
	{
		return $this->_fVAT;
	}

	public function getfOtherTax1()
	{
		return $this->_fOtherTax1;
	}

	public function getfPrePayment()
	{
		return $this->_fPrePayment;
	}

	public function getfWithHoldingTax()
	{
		return $this->_fWithHoldingTax;
	}

	public function getvFreight()
	{
		return $this->_vFreight;
	}

	public function gettMiscellaneous()
	{
		return $this->_tMiscellaneous;
	}
	
	public function getfSubTotal()
	{
		return $this->_fSubTotal;
	}
	
	public function getfDiscount()
	{
		return $this->_fDiscount;
	}
	
	public function getfCharge()
	{
		return $this->_fCharge;
	}
	
	public function getfInvoiceTotal()
	{
		return $this->_fInvoiceTotal;
	}

	public function getdCashDiscountBaseline()
	{
		return $this->_dCashDiscountBaseline;
	}

	public function getiMaxCashDiscountDays()
	{
		return $this->_iMaxCashDiscountDays;
	}

	public function getfMaxCashDiscountPercentage()
	{
		return $this->_fMaxCashDiscountPercentage;
	}

	public function getiNormalCashDiscountDays()
	{
		return $this->_iNormalCashDiscountDays;
	}

	public function getiNormalCashDiscountPercentage()
	{
		return $this->_iNormalCashDiscountPercentage;
	}

	public function getiNetPaymentDays()
	{
		return $this->_iNetPaymentDays;
	}

	public function getdNetPaymentdate()
	{
		return $this->_dNetPaymentdate;
	}

	public function getvVatId()
	{
		return $this->_vVatId;
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

	public function getvAccountName()
	{
		return $this->_vAccountName;
	}

	public function getvAccountNumber()
	{
		return $this->_vAccountNumber;
	}

	public function getvIBAN()
	{
		return $this->_vIBAN;
	}

	public function getvSwiftCode()
	{
		return $this->_vSwiftCode;
	}

	public function geteAccepted2()
	{
		return $this->_eAccepted2;
	}

	public function getdAcceptedDate()
	{
		return $this->_dAcceptedDate;
	}
        public function getdAcceptedVat()
	{
		return $this->_dAcceptedVat;
	}
        public function getdAcceptedOtherTax()
	{
		return $this->_dAcceptedOtherTax;
	}
        public function getdAcceptedWHTax()
	{
		return $this->_dAcceptedWHTax;
	}
        public function getdAcceptedNetPaymentDate()
	{
		return $this->_dAcceptedNetPaymentDate;
	}
        //
	public function getfAcceptedAmount()
	{
		return $this->_fAcceptedAmount;
	}

	public function getvFromIP()
	{
		return $this->_vFromIP;
	}

	public function getiModifiedByID()
	{
		return $this->_iModifiedByID;
	}

	public function gettReasonToReject()
	{
		return $this->_tReasonToReject;
	}

	public function getvImage()
	{
		return $this->_vImage;
	}

	public function getiStatusID()
	{
		return $this->_iStatusID;
	}

	public function getiaStatusID()
	{
		return $this->_iaStatusID;
	}

	public function geteCreateByBuyer()
	{
		return $this->_eCreateByBuyer;
	}

	public function geteSaved()
	{
		return $this->_eSaved;
	}

	public function geteDelete()
	{
		return $this->_eDelete;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiInvoiceID($val)
	{
		 $this->_iInvoiceID =  $val;
	}

	public function setvInvoiceNumber($val)
	{
		 $this->_vInvoiceNumber =  $val;
	}

	public function setvInvoiceCode($val)
	{
		 $this->_vInvoiceCode =  $val;
	}

	public function setvInvSupplierCode($val)
	{
		 $this->_vInvSupplierCode =  $val;
	}

	public function setiPurchaseOrderID($val)
	{
		 $this->_iPurchaseOrderID =  $val;
	}

	public function setiBuyerID($val)
	{
		 $this->_iBuyerID =  $val;
	}

	public function setiSupplierID($val)
	{
		 $this->_iSupplierID =  $val;
	}

	public function setdCreatedDate($val)
	{
		 $this->_dCreatedDate =  $val;
	}

	public function setdIssueDate($val)
	{
		 $this->_dIssueDate =  $val;
	}

	public function setiSupplierOrganizationID($val)
	{
		 $this->_iSupplierOrganizationID =  $val;
	}

	public function setiBuyerOrganizationID($val)
	{
		 $this->_iBuyerOrganizationID =  $val;
	}

	public function setvInvoiceSupplierCode($val)
	{
		 $this->_vInvoiceSupplierCode =  $val;
	}

	public function setvAssociatePOBuyerCode($val)
	{
		 $this->_vAssociatePOBuyerCode =  $val;
	}

	public function setvBuyerName($val)
	{
		 $this->_vBuyerName =  $val;
	}

	public function setvBuyerContactParty($val)
	{
		 $this->_vBuyerContactParty =  $val;
	}

	public function setvSupplierName($val)
	{
		 $this->_vSupplierName =  $val;
	}

	public function setvSupplierAddLine1($val)
	{
		 $this->_vSupplierAddLine1 =  $val;
	}

	public function setvSupplierAddLine2($val)
	{
		 $this->_vSupplierAddLine2 =  $val;
	}

	public function setvSupplierCity($val)
	{
		 $this->_vSupplierCity =  $val;
	}

	public function setvSupplierZipCode($val)
	{
		 $this->_vSupplierZipCode =  $val;
	}

	public function setvSupplierState($val)
	{
		 $this->_vSupplierState =  $val;
	}

	public function setvSupplierCountry($val)
	{
		 $this->_vSupplierCountry =  $val;
	}

	public function setvSupplierContactParty($val)
	{
		 $this->_vSupplierContactParty =  $val;
	}

	public function setvSupplierContactTelephone($val)
	{
		 $this->_vSupplierContactTelephone =  $val;
	}

	public function setdInvoiceDate($val)
	{
		 $this->_dInvoiceDate =  $val;
	}

	public function seteInvoiceType($val)
	{
		 $this->_eInvoiceType =  $val;
	}

	public function setvInvoice_group($val)
	{
		 $this->_vInvoice_group =  $val;
	}

	public function settInvoiceDescription($val)
	{
		 $this->_tInvoiceDescription =  $val;
	}

	public function setvInvoiceStatus($val)
	{
		 $this->_vInvoiceStatus =  $val;
	}

	public function setvRegisterNumber($val)
	{
		 $this->_vRegisterNumber =  $val;
	}

	public function setiOpeningUnit($val)
	{
		 $this->_iOpeningUnit =  $val;
	}

	public function setvExtPOCode($val)
	{
		 $this->_vExtPOCode =  $val;
	}

	public function setvSupplierOrderNum($val)
	{
		 $this->_vSupplierOrderNum =  $val;
	}

	public function seteLineItemTax($val)
	{
		 $this->_eLineItemTax =  $val;
	}

	public function setvBillToParty($val)
	{
		 $this->_vBillToParty =  $val;
	}

	public function setvBillToAddLine1($val)
	{
		 $this->_vBillToAddLine1 =  $val;
	}

	public function setvBillToAddLine2($val)
	{
		 $this->_vBillToAddLine2 =  $val;
	}

	public function setvBillToCity($val)
	{
		 $this->_vBillToCity =  $val;
	}

	public function setvBillToState($val)
	{
		 $this->_vBillToState =  $val;
	}

	public function setvBillToZipCode($val)
	{
		 $this->_vBillToZipCode =  $val;
	}

	public function setvBillToCountry($val)
	{
		 $this->_vBillToCountry =  $val;
	}

	public function setvBillToContactParty($val)
	{
		 $this->_vBillToContactParty =  $val;
	}

	public function setvBillToContactTelephone($val)
	{
		 $this->_vBillToContactTelephone =  $val;
	}

	public function setvCurrency($val)
	{
		 $this->_vCurrency =  $val;
	}

	public function setfVAT($val)
	{
		 $this->_fVAT =  $val;
	}

	public function setfOtherTax1($val)
	{
		 $this->_fOtherTax1 =  $val;
	}

	public function setfPrePayment($val)
	{
		 $this->_fPrePayment =  $val;
	}

	public function setfWithHoldingTax($val)
	{
		 $this->_fWithHoldingTax =  $val;
	}

	public function setvFreight($val)
	{
		 $this->_vFreight =  $val;
	}

	public function settMiscellaneous($val)
	{
		 $this->_tMiscellaneous =  $val;
	}
	
	public function setfSubTotal($val)
	{
		$this->_fSubTotal = $val;
	}
	
	public function setfDiscount($val)
	{
		$this->_fDiscount = $val;
	}
	
	public function setfCharge($val)
	{
		$this->_fCharge = $val;
	}
	
	public function setfInvoiceTotal($val)
	{
		 $this->_fInvoiceTotal =  $val;
	}

	public function setdCashDiscountBaseline($val)
	{
		 $this->_dCashDiscountBaseline =  $val;
	}

	public function setiMaxCashDiscountDays($val)
	{
		 $this->_iMaxCashDiscountDays =  $val;
	}

	public function setfMaxCashDiscountPercentage($val)
	{
		 $this->_fMaxCashDiscountPercentage =  $val;
	}

	public function setiNormalCashDiscountDays($val)
	{
		 $this->_iNormalCashDiscountDays =  $val;
	}

	public function setiNormalCashDiscountPercentage($val)
	{
		 $this->_iNormalCashDiscountPercentage =  $val;
	}

	public function setiNetPaymentDays($val)
	{
		 $this->_iNetPaymentDays =  $val;
	}

	public function setdNetPaymentdate($val)
	{
		 $this->_dNetPaymentdate =  $val;
	}

	public function setvVatId($val)
	{
		 $this->_vVatId =  $val;
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

	public function setvAccountName($val)
	{
		 $this->_vAccountName =  $val;
	}

	public function setvAccountNumber($val)
	{
		 $this->_vAccountNumber =  $val;
	}

	public function setvIBAN($val)
	{
		 $this->_vIBAN =  $val;
	}

	public function setvSwiftCode($val)
	{
		 $this->_vSwiftCode =  $val;
	}

	public function seteAccepted2($val)
	{
		 $this->_eAccepted2 =  $val;
	}

	public function setdAcceptedDate($val)
	{
		 $this->_dAcceptedDate =  $val;
	}
        public function setdAcceptedVat($val)
	{
		 $this->_dAcceptedVat =  $val;
	}
        public function setdAcceptedOtherTax($val)
	{
		 $this->_dAcceptedOtherTax =  $val;
	}
        public function setdAcceptedWHTax($val)
	{
		 $this->_dAcceptedWHTax =  $val;
	}
        public function setdAcceptedNetPaymentDate($val)
	{
		 $this->_dAcceptedNetPaymentDate =  $val;
	}

	public function setfAcceptedAmount($val)
	{
		 $this->_fAcceptedAmount =  $val;
	}

	public function setvFromIP($val)
	{
		 $this->_vFromIP =  $val;
	}

	public function setiModifiedByID($val)
	{
		 $this->_iModifiedByID =  $val;
	}

	public function settReasonToReject($val)
	{
		 $this->_tReasonToReject =  $val;
	}

	public function setvImage($val)
	{
		 $this->_vImage =  $val;
	}

	public function setiStatusID($val)
	{
		 $this->_iStatusID =  $val;
	}

	public function setiaStatusID($val)
	{
		 $this->_iaStatusID =  $val;
	}

	public function seteCreateByBuyer($val)
	{
		 $this->_eCreateByBuyer =  $val;
	}

	public function seteSaved($val)
	{
		 $this->_eSaved =  $val;
	}

	public function seteDelete($val)
	{
		 $this->_eDelete =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE iInvoiceID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE iInvoiceID=$this->_iInvoiceID ";
		 }
		 $row = $this->_obj->MySQLSelect($sql);

		 $this->_iInvoiceID = $row[0]['iInvoiceID'];
		 $this->_vInvoiceNumber = $row[0]['vInvoiceNumber'];
		 $this->_vInvoiceCode = $row[0]['vInvoiceCode'];
		 $this->_vInvSupplierCode = $row[0]['vInvSupplierCode'];
		 $this->_iPurchaseOrderID = $row[0]['iPurchaseOrderID'];
		 $this->_iBuyerID = $row[0]['iBuyerID'];
		 $this->_iSupplierID = $row[0]['iSupplierID'];
		 $this->_dCreatedDate = $row[0]['dCreatedDate'];
		 $this->_dIssueDate = $row[0]['dIssueDate'];
		 $this->_iSupplierOrganizationID = $row[0]['iSupplierOrganizationID'];
		 $this->_iBuyerOrganizationID = $row[0]['iBuyerOrganizationID'];
		 $this->_vInvoiceSupplierCode = $row[0]['vInvoiceSupplierCode'];
		 $this->_vAssociatePOBuyerCode = $row[0]['vAssociatePOBuyerCode'];
		 $this->_vBuyerName = $row[0]['vBuyerName'];
		 $this->_vBuyerContactParty = $row[0]['vBuyerContactParty'];
		 $this->_vSupplierName = $row[0]['vSupplierName'];
		 $this->_vSupplierAddLine1 = $row[0]['vSupplierAddLine1'];
		 $this->_vSupplierAddLine2 = $row[0]['vSupplierAddLine2'];
		 $this->_vSupplierCity = $row[0]['vSupplierCity'];
		 $this->_vSupplierZipCode = $row[0]['vSupplierZipCode'];
		 $this->_vSupplierState = $row[0]['vSupplierState'];
		 $this->_vSupplierCountry = $row[0]['vSupplierCountry'];
		 $this->_vSupplierContactParty = $row[0]['vSupplierContactParty'];
		 $this->_vSupplierContactTelephone = $row[0]['vSupplierContactTelephone'];
		 $this->_dInvoiceDate = $row[0]['dInvoiceDate'];
		 $this->_eInvoiceType = $row[0]['eInvoiceType'];
		 $this->_vInvoice_group = $row[0]['vInvoice_group'];
		 $this->_tInvoiceDescription = $row[0]['tInvoiceDescription'];
		 $this->_vInvoiceStatus = $row[0]['vInvoiceStatus'];
		 $this->_vRegisterNumber = $row[0]['vRegisterNumber'];
		 $this->_iOpeningUnit = $row[0]['iOpeningUnit'];
		 $this->_vExtPOCode = $row[0]['vExtPOCode'];
		 $this->_vSupplierOrderNum = $row[0]['vSupplierOrderNum'];
		 $this->_eLineItemTax = $row[0]['eLineItemTax'];
		 $this->_vBillToParty = $row[0]['vBillToParty'];
		 $this->_vBillToAddLine1 = $row[0]['vBillToAddLine1'];
		 $this->_vBillToAddLine2 = $row[0]['vBillToAddLine2'];
		 $this->_vBillToCity = $row[0]['vBillToCity'];
		 $this->_vBillToState = $row[0]['vBillToState'];
		 $this->_vBillToZipCode = $row[0]['vBillToZipCode'];
		 $this->_vBillToCountry = $row[0]['vBillToCountry'];
		 $this->_vBillToContactParty = $row[0]['vBillToContactParty'];
		 $this->_vBillToContactTelephone = $row[0]['vBillToContactTelephone'];
		 $this->_vCurrency = $row[0]['vCurrency'];
		 $this->_fVAT = $row[0]['fVAT'];
		 $this->_fOtherTax1 = $row[0]['fOtherTax1'];
		 $this->_fPrePayment = $row[0]['fPrePayment'];
		 $this->_fWithHoldingTax = $row[0]['fWithHoldingTax'];
		 $this->_vFreight = $row[0]['vFreight'];
		 $this->_tMiscellaneous = $row[0]['tMiscellaneous'];
		 $this->_fSubTotal = $row[0]['fSubTotal'];
		 $this->_fDiscount = $row[0]['fDiscount'];
		 $this->_fCharge = $row[0]['fCharge'];
		 $this->_fInvoiceTotal = $row[0]['fInvoiceTotal'];
		 $this->_dCashDiscountBaseline = $row[0]['dCashDiscountBaseline'];
		 $this->_iMaxCashDiscountDays = $row[0]['iMaxCashDiscountDays'];
		 $this->_fMaxCashDiscountPercentage = $row[0]['fMaxCashDiscountPercentage'];
		 $this->_iNormalCashDiscountDays = $row[0]['iNormalCashDiscountDays'];
		 $this->_iNormalCashDiscountPercentage = $row[0]['iNormalCashDiscountPercentage'];
		 $this->_iNetPaymentDays = $row[0]['iNetPaymentDays'];
		 $this->_dNetPaymentdate = $row[0]['dNetPaymentdate'];
		 $this->_vVatId = $row[0]['vVatId'];
		 $this->_iBankId = $row[0]['iBankId'];
		 $this->_vBankName = $row[0]['vBankName'];
		 $this->_vBankCode = $row[0]['vBankCode'];
		 $this->_vBranchName = $row[0]['vBranchName'];
		 $this->_vBranchCode = $row[0]['vBranchCode'];
		 $this->_vAccountName = $row[0]['vAccountName'];
		 $this->_vAccountNumber = $row[0]['vAccountNumber'];
		 $this->_vIBAN = $row[0]['vIBAN'];
		 $this->_vSwiftCode = $row[0]['vSwiftCode'];
		 $this->_eAccepted2 = $row[0]['eAccepted2'];
		 $this->_dAcceptedDate = $row[0]['dAcceptedDate'];
		 $this->_dAcceptedVat = $row[0]['dAcceptedVat'];
		 $this->_dAcceptedOtherTax = $row[0]['dAcceptedOtherTax'];
		 $this->_dAcceptedWHTax = $row[0]['_dAcceptedWHTax'];
		 $this->_dAcceptedNetPaymentDate = $row[0]['dAcceptedNetPaymentDate'];
		 $this->_fAcceptedAmount = $row[0]['fAcceptedAmount'];
		 $this->_vFromIP = $row[0]['vFromIP'];
		 $this->_iModifiedByID = $row[0]['iModifiedByID'];
		 $this->_tReasonToReject = $row[0]['tReasonToReject'];
		 $this->_vImage = $row[0]['vImage'];
		 $this->_iStatusID = $row[0]['iStatusID'];
		 $this->_iaStatusID = $row[0]['iaStatusID'];
		 $this->_eCreateByBuyer = $row[0]['eCreateByBuyer'];
		 $this->_eSaved = $row[0]['eSaved'];
		 $this->_eDelete = $row[0]['eDelete'];
		return $row;	
	}

/**
*   @desc   DELETE
*/
	function delete($id)
	{
		 if(trim($id)!='' && $id>0)
		 {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE iInvoiceID = $id";
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE $where";
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
		$this->_iInvoiceID = '';
		$this->iInvoiceID = ""; // clear key for autoincrement
		 
		 if(!is_array($Data) || count($Data)<1) {
				$Data = array(
						 'vInvoiceNumber'		=>	$this->_vInvoiceNumber,
						'vInvoiceCode'		=>	$this->_vInvoiceCode,
						'vInvSupplierCode'		=>	$this->_vInvSupplierCode,
						'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'iBuyerID'		=>	$this->_iBuyerID,
						'iSupplierID'		=>	$this->_iSupplierID,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dIssueDate'		=>	$this->_dIssueDate,
						'iSupplierOrganizationID'		=>	$this->_iSupplierOrganizationID,
						'iBuyerOrganizationID'		=>	$this->_iBuyerOrganizationID,
						'vInvoiceSupplierCode'		=>	$this->_vInvoiceSupplierCode,
						'vAssociatePOBuyerCode'		=>	$this->_vAssociatePOBuyerCode,
						'vBuyerName'		=>	$this->_vBuyerName,
						'vBuyerContactParty'		=>	$this->_vBuyerContactParty,
						'vSupplierName'		=>	$this->_vSupplierName,
						'vSupplierAddLine1'		=>	$this->_vSupplierAddLine1,
						'vSupplierAddLine2'		=>	$this->_vSupplierAddLine2,
						'vSupplierCity'		=>	$this->_vSupplierCity,
						'vSupplierZipCode'		=>	$this->_vSupplierZipCode,
						'vSupplierState'		=>	$this->_vSupplierState,
						'vSupplierCountry'		=>	$this->_vSupplierCountry,
						'vSupplierContactParty'		=>	$this->_vSupplierContactParty,
						'vSupplierContactTelephone'		=>	$this->_vSupplierContactTelephone,
						'dInvoiceDate'		=>	$this->_dInvoiceDate,
						'eInvoiceType'		=>	$this->_eInvoiceType,
						'vInvoice_group'		=>	$this->_vInvoice_group,
						'tInvoiceDescription'		=>	$this->_tInvoiceDescription,
						'vInvoiceStatus'		=>	$this->_vInvoiceStatus,
						'vRegisterNumber'		=>	$this->_vRegisterNumber,
						'iOpeningUnit'		=>	$this->_iOpeningUnit,
						'vExtPOCode'		=>	$this->_vExtPOCode,
						'vSupplierOrderNum'		=>	$this->_vSupplierOrderNum,
						'eLineItemTax'		=>	$this->_eLineItemTax,
						'vBillToParty'		=>	$this->_vBillToParty,
						'vBillToAddLine1'		=>	$this->_vBillToAddLine1,
						'vBillToAddLine2'		=>	$this->_vBillToAddLine2,
						'vBillToCity'		=>	$this->_vBillToCity,
						'vBillToState'		=>	$this->_vBillToState,
						'vBillToZipCode'		=>	$this->_vBillToZipCode,
						'vBillToCountry'		=>	$this->_vBillToCountry,
						'vBillToContactParty'		=>	$this->_vBillToContactParty,
						'vBillToContactTelephone'		=>	$this->_vBillToContactTelephone,
						'vCurrency'		=>	$this->_vCurrency,
						'fVAT'		=>	$this->_fVAT,
						'fOtherTax1'		=>	$this->_fOtherTax1,
						'fPrePayment'		=>	$this->_fPrePayment,
						'fWithHoldingTax'		=>	$this->_fWithHoldingTax,
						'vFreight'		=>	$this->_vFreight,
						'tMiscellaneous'		=>	$this->_tMiscellaneous,
						'fSubTotal'		=>	$this->_fSubTotal,
						'fDiscount'		=>	$this->_fDiscount,
						'fCharge'		=>	$this->_fCharge,
						'fInvoiceTotal'		=>	$this->_fInvoiceTotal,
						'dCashDiscountBaseline'		=>	$this->_dCashDiscountBaseline,
						'iMaxCashDiscountDays'		=>	$this->_iMaxCashDiscountDays,
						'fMaxCashDiscountPercentage'		=>	$this->_fMaxCashDiscountPercentage,
						'iNormalCashDiscountDays'		=>	$this->_iNormalCashDiscountDays,
						'iNormalCashDiscountPercentage'		=>	$this->_iNormalCashDiscountPercentage,
						'iNetPaymentDays'		=>	$this->_iNetPaymentDays,
						'dNetPaymentdate'		=>	$this->_dNetPaymentdate,
						'vVatId'		=>	$this->_vVatId,
						'iBankId'		=>	$this->_iBankId,
						'vBankName'		=>	$this->_vBankName,
						'vBankCode'		=>	$this->_vBankCode,
						'vBranchName'		=>	$this->_vBranchName,
						'vBranchCode'		=>	$this->_vBranchCode,
						'vAccountName'		=>	$this->_vAccountName,
						'vAccountNumber'		=>	$this->_vAccountNumber,
						'vIBAN'		=>	$this->_vIBAN,
						'vSwiftCode'		=>	$this->_vSwiftCode,
						'eAccepted2'		=>	$this->_eAccepted2,
						'dAcceptedDate'		=>	$this->_dAcceptedDate,
						'dAcceptedVat'		=>	$this->_dAcceptedVat,
						'dAcceptedOtherTax'		=>	$this->_dAcceptedOtherTax,
						'dAcceptedWHTax'		=>	$this->_dAcceptedWHTax,
						'dAcceptedNetPaymentDate'		=>	$this->_dAcceptedNetPaymentDate,
						'fAcceptedAmount'		=>	$this->_fAcceptedAmount,
						'vFromIP'		=>	$this->_vFromIP,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'vImage'		=>	$this->_vImage,
						'iStatusID'		=>	$this->_iStatusID,
						'iaStatusID'		=>	$this->_iaStatusID,
						'eCreateByBuyer'		=>	$this->_eCreateByBuyer,
						'eSaved'		=>	$this->_eSaved,
						'eDelete'		=>	$this->_eDelete 				
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_inovice_order_heading",$Data,'insert');
		return $result;	
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						'vInvoiceNumber'		=>	$this->_vInvoiceNumber,
						'vInvoiceCode'		=>	$this->_vInvoiceCode,
						'vInvSupplierCode'		=>	$this->_vInvSupplierCode,
						'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'iBuyerID'		=>	$this->_iBuyerID,
						'iSupplierID'		=>	$this->_iSupplierID,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dIssueDate'		=>	$this->_dIssueDate,
						'iSupplierOrganizationID'		=>	$this->_iSupplierOrganizationID,
						'iBuyerOrganizationID'		=>	$this->_iBuyerOrganizationID,
						'vInvoiceSupplierCode'		=>	$this->_vInvoiceSupplierCode,
						'vAssociatePOBuyerCode'		=>	$this->_vAssociatePOBuyerCode,
						'vBuyerName'		=>	$this->_vBuyerName,
						'vBuyerContactParty'		=>	$this->_vBuyerContactParty,
						'vSupplierName'		=>	$this->_vSupplierName,
						'vSupplierAddLine1'		=>	$this->_vSupplierAddLine1,
						'vSupplierAddLine2'		=>	$this->_vSupplierAddLine2,
						'vSupplierCity'		=>	$this->_vSupplierCity,
						'vSupplierZipCode'		=>	$this->_vSupplierZipCode,
						'vSupplierState'		=>	$this->_vSupplierState,
						'vSupplierCountry'		=>	$this->_vSupplierCountry,
						'vSupplierContactParty'		=>	$this->_vSupplierContactParty,
						'vSupplierContactTelephone'		=>	$this->_vSupplierContactTelephone,
						'dInvoiceDate'		=>	$this->_dInvoiceDate,
						'eInvoiceType'		=>	$this->_eInvoiceType,
						'vInvoice_group'		=>	$this->_vInvoice_group,
						'tInvoiceDescription'		=>	$this->_tInvoiceDescription,
						'vInvoiceStatus'		=>	$this->_vInvoiceStatus,
						'vRegisterNumber'		=>	$this->_vRegisterNumber,
						'iOpeningUnit'		=>	$this->_iOpeningUnit,
						'vExtPOCode'		=>	$this->_vExtPOCode,
						'vSupplierOrderNum'		=>	$this->_vSupplierOrderNum,
						'eLineItemTax'		=>	$this->_eLineItemTax,
						'vBillToParty'		=>	$this->_vBillToParty,
						'vBillToAddLine1'		=>	$this->_vBillToAddLine1,
						'vBillToAddLine2'		=>	$this->_vBillToAddLine2,
						'vBillToCity'		=>	$this->_vBillToCity,
						'vBillToState'		=>	$this->_vBillToState,
						'vBillToZipCode'		=>	$this->_vBillToZipCode,
						'vBillToCountry'		=>	$this->_vBillToCountry,
						'vBillToContactParty'		=>	$this->_vBillToContactParty,
						'vBillToContactTelephone'		=>	$this->_vBillToContactTelephone,
						'vCurrency'		=>	$this->_vCurrency,
						'fVAT'		=>	$this->_fVAT,
						'fOtherTax1'		=>	$this->_fOtherTax1,
						'fPrePayment'		=>	$this->_fPrePayment,
						'fWithHoldingTax'		=>	$this->_fWithHoldingTax,
						'vFreight'		=>	$this->_vFreight,
						'tMiscellaneous'		=>	$this->_tMiscellaneous,
						'fSubTotal'		=>	$this->_fSubTotal,
						'fDiscount'		=>	$this->_fDiscount,
						'fCharge'		=>	$this->_fCharge,
						'fInvoiceTotal'		=>	$this->_fInvoiceTotal,
						'dCashDiscountBaseline'		=>	$this->_dCashDiscountBaseline,
						'iMaxCashDiscountDays'		=>	$this->_iMaxCashDiscountDays,
						'fMaxCashDiscountPercentage'		=>	$this->_fMaxCashDiscountPercentage,
						'iNormalCashDiscountDays'		=>	$this->_iNormalCashDiscountDays,
						'iNormalCashDiscountPercentage'		=>	$this->_iNormalCashDiscountPercentage,
						'iNetPaymentDays'		=>	$this->_iNetPaymentDays,
						'dNetPaymentdate'		=>	$this->_dNetPaymentdate,
						'vVatId'		=>	$this->_vVatId,
						'iBankId'		=>	$this->_iBankId,
						'vBankName'		=>	$this->_vBankName,
						'vBankCode'		=>	$this->_vBankCode,
						'vBranchName'		=>	$this->_vBranchName,
						'vBranchCode'		=>	$this->_vBranchCode,
						'vAccountName'		=>	$this->_vAccountName,
						'vAccountNumber'		=>	$this->_vAccountNumber,
						'vIBAN'		=>	$this->_vIBAN,
						'vSwiftCode'		=>	$this->_vSwiftCode,
						'eAccepted2'		=>	$this->_eAccepted2,
						'dAcceptedDate'		=>	$this->_dAcceptedDate,
						'dAcceptedVat'		=>	$this->_dAcceptedVat,
						'dAcceptedOtherTax'		=>	$this->_dAcceptedOtherTax,
						'dAcceptedWHTax'		=>	$this->_dAcceptedWHTax,
						'dAcceptedNetPaymentDate'		=>	$this->_dAcceptedNetPaymentDate,
						'fAcceptedAmount'		=>	$this->_fAcceptedAmount,
						'fAcceptedAmount'		=>	$this->_fAcceptedAmount,
						'vFromIP'		=>	$this->_vFromIP,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'vImage'		=>	$this->_vImage,
						'iStatusID'		=>	$this->_iStatusID,
						'iaStatusID'		=>	$this->_iaStatusID,
						'eCreateByBuyer'		=>	$this->_eCreateByBuyer,
						'eSaved'		=>	$this->_eSaved,
						'eDelete'		=>	$this->_eDelete 				
			);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_inovice_order_heading",$Data,'update',$where);
		return $result;	
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_inovice_order_heading",$data,"update",$where);
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

   function getDetails($feild="*",$where="",$orderBy="",$groupBy="",$limit="")
	{
       if($where != "") {
          $cnt = " Where 1 ".$where;
       }
       if($groupBy != "") {
          $cnt .= " Group By ".$groupBy;
       }
       if($orderBy != "") {
          $cnt .= " Order By ".$orderBy;
       }
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_inovice_order_heading $cnt $limit";
		 // echo $sql; exit;
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

   /**
	*   @desc   GET DETAILS WITH PAGING AND JOINED TABLE IF REQUIRED
	*/
   function getJoinTableInfo($jtbl,$fields="*",$where="",$orderBy="",$groupBy="",$limit="",$pg="")
	{
		if($where != "") {
         $cnt = " Where 1 ".$where;
			$cnt_count = " Where 1 ".$where;
      }
		if($groupBy != "") {
         $cnt .= " Group By ".$groupBy;
			$cnt_count .= " Group By ".$groupBy;
      }
		if($orderBy != "") {
         $cnt .= " Order By ".$orderBy;
      }

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_inovice_order_heading ioh $jtbl $cnt $limit";
      // echo $sql; // exit;
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_inovice_order_heading ioh $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}

   function GetInvoiceItems($iInvoiceID){
      $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_invoice_detail_line WHERE iInvoiceID = '".$iInvoiceID."'";
		// echo $sql; exit;
		$row = $this->_obj->MySqlSelect($sql);
      //Prints($row);exit;
      return $row;
   }

   ### GET ALL ITEMS OF THE SAME PURCHASE ORDER
   function chkDuplicate($fileds,$data){
      $filedsArr = @explode(',',$fileds);
      for($i=0;$i<count($filedsArr);$i++){
         $where.= " AND ".$filedsArr[$i]." = '".$data[$filedsArr[$i]]."'";
      }
      $sql =  "SELECT iInvoiceID as ID FROM ".PRJ_DB_PREFIX."_inovice_order_heading WHERE 1 $where";
		$row = $this->_obj->MySqlSelect($sql);
      //Prints($row);exit;
      if(count($row) > 0){
         $dup = $row[0][ID];
      }else{
         $dup = 0;
      }
      return $dup;
   }

	function getUniqueCode($type='inv')
	{
		$sql = "Select COUNT(*) as tot from ".PRJ_DB_PREFIX."_inovice_order_heading where dCreatedDate>'".date('Y-m-d')."'";
		// echo $sql; exit;
		$rw =  $this->_obj->MySQLSelect($sql);
		$num = ($rw[0]['tot']+1);
		/*$t=0;
		if($type == 'Buyer') {
			$t=1;
		} else if($type == 'Supplier') {
			$t=2;
		} else if($type == 'Both') {
			$t=3;
		}*/
		$code = '001'.date('ymd').$type.$num;
		// echo $code; exit;
		return $code;
	}

	function getHistory($iPoId,$orgid=0)
   {
		$oc = "";
		if($orgid>0) {
			$oc = " iOrganizationID=$orgid AND ";
		}
      $sql = "Select iVerifiedID,iItemID,eSubject,eType,vAction,vMailSubject_en,iOrganizationID,iCreatedBy,eCreatedType,eVerifiedBy,iVerifiedBy,dActionDate,dVerifyDate,vVerifyFromIP from ".PRJ_DB_PREFIX."_user_action_verification where $oc iItemID=$iPoId AND eSubject='Invoice' AND vMailSubject_en!='New invoice waiting for acceptance' Order By dActionDate ASC ";
		// echo $sql; exit;
		$iohdtls = $this->_obj->MySQLSelect($sql);
		for($l=0;$l<count($iohdtls);$l++)
		{
			$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$iohdtls[$l]['iCreatedBy'];
			$cusr = $this->_obj->MySQLSelect($sql);
			$iohdtls[$l]['createdby'] = $cusr[0]['name'];
		}
		return $iohdtls;
   }
	
	function getInvoiceRfq2Buyer2OrgIds($id)
	{
		$sql = "Select iOrganizationID from ".PRJ_DB_PREFIX."_organization_master org INNER JOIN ".PRJ_DB_PREFIX."_rfq2_product_buyer2 rpb2 on org.iOrganizationID=rpb2.iBuyer2Id where rpb2.iRFQ2Id=(Select iRFQ2Id from ".PRJ_DB_PREFIX."_rfq2_master where iInvoiceId=$id ORDER BY iRFQ2Id DESC LIMIT 0,1) ";
		$ids = $this->_obj->MySQLSelect($sql);
		$ids = @ multi21Array($ids,'iOrganizationID');
		return $ids;
	}
}
?>