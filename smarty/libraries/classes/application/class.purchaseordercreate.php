<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        purchaseordercreate
* GENERATION DATE:  03.05.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.purchaseordercreate.php
* FOR MYSQL TABLE:  b2b_purchase_order_heading
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class purchaseordercreate
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iPurchaseOrderID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iPurchaseOrderID;
	protected $_vPONumber;
	protected $_vPOCode;
	protected $_iBuyerID;
	protected $_iSupplierOrganizationID;
	protected $_iSupplierID;
	protected $_dCreateDate;
	protected $_dVerifyDate;
	protected $_dIssueDate;
	protected $_eSupplierAccept;
	protected $_dSupplierAcceptDate;
	protected $_tSupplierAcceptCommnet;
	protected $_vSupplierAcceptFromIP;
	protected $_vBuyerCode;
	protected $_vSupplierName;
	protected $_vSupplierAddLine1;
	protected $_vSupplierAddLine2;
	protected $_vSupplierCity;
	protected $_vSupplierZipCode;
	protected $_vSupplierState;
	protected $_vSupplierCountry;
	protected $_vSupplierContactParty;
	protected $_vSupplierContactTelephone;
	protected $_vBuyerCompanyName;
	protected $_vBuyerContactName;
	protected $_vBuyerContactTelephone;
	protected $_vBuyerContactEmail;
	protected $_dOrderDate;
	protected $_tOrderDescription;
	protected $_vOrderStatus;
	protected $_iOpeningUnit;
	protected $_vSupplierOrderNum;
	protected $_tCarrier;
	protected $_eLineItemTax;
	protected $_fVAT;
	protected $_fOther_tax_1;
	protected $_vShipToParty;
	protected $_vShipToAddressLine1;
	protected $_vShipToAddressLine2;
	protected $_vShipToCity;
	protected $_vShipToState;
	protected $_vShipToZipCode;
	protected $_vShipToCountry;
	protected $_vShipToContactParty;
	protected $_vShipToContactTelephone;
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
	protected $_fPOTotal;
	protected $_fPrepayment;
	protected $_vFromIP;
	protected $_iStatusID;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iPurchaseOrderID = null;
		$this->_vPONumber = null;
		$this->_vPOCode = null;
		$this->_iBuyerID = null;
		$this->_iSupplierOrganizationID = null;
		$this->_iSupplierID = null;
		$this->_dCreateDate = null;
		$this->_dVerifyDate = null;
		$this->_dIssueDate = null;
		$this->_eSupplierAccept = null;
		$this->_dSupplierAcceptDate = null;
		$this->_tSupplierAcceptCommnet = null;
		$this->_vSupplierAcceptFromIP = null;
		$this->_vBuyerCode = null;
		$this->_vSupplierName = null;
		$this->_vSupplierAddLine1 = null;
		$this->_vSupplierAddLine2 = null;
		$this->_vSupplierCity = null;
		$this->_vSupplierZipCode = null;
		$this->_vSupplierState = null;
		$this->_vSupplierCountry = null;
		$this->_vSupplierContactParty = null;
		$this->_vSupplierContactTelephone = null;
		$this->_vBuyerCompanyName = null;
		$this->_vBuyerContactName = null;
		$this->_vBuyerContactTelephone = null;
		$this->_vBuyerContactEmail = null;
		$this->_dOrderDate = null;
		$this->_tOrderDescription = null;
		$this->_vOrderStatus = null;
		$this->_iOpeningUnit = null;
		$this->_vSupplierOrderNum = null;
		$this->_tCarrier = null;
		$this->_eLineItemTax = null;
		$this->_fVAT = null;
		$this->_fOther_tax_1 = null;
		$this->_vShipToParty = null;
		$this->_vShipToAddressLine1 = null;
		$this->_vShipToAddressLine2 = null;
		$this->_vShipToCity = null;
		$this->_vShipToState = null;
		$this->_vShipToZipCode = null;
		$this->_vShipToCountry = null;
		$this->_vShipToContactParty = null;
		$this->_vShipToContactTelephone = null;
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
		$this->_fPOTotal = null;
		$this->_fPrepayment = null;
		$this->_vFromIP = null;
		$this->_iStatusID = null;
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


	public function getiPurchaseOrderID()
	{
		return $this->_iPurchaseOrderID;
	}

	public function getvPONumber()
	{
		return $this->_vPONumber;
	}

	public function getvPOCode()
	{
		return $this->_vPOCode;
	}

	public function getiBuyerID()
	{
		return $this->_iBuyerID;
	}

	public function getiSupplierOrganizationID()
	{
		return $this->_iSupplierOrganizationID;
	}

	public function getiSupplierID()
	{
		return $this->_iSupplierID;
	}

	public function getdCreateDate()
	{
		return $this->_dCreateDate;
	}

	public function getdVerifyDate()
	{
		return $this->_dVerifyDate;
	}

	public function getdIssueDate()
	{
		return $this->_dIssueDate;
	}

	public function geteSupplierAccept()
	{
		return $this->_eSupplierAccept;
	}

	public function getdSupplierAcceptDate()
	{
		return $this->_dSupplierAcceptDate;
	}

	public function gettSupplierAcceptCommnet()
	{
		return $this->_tSupplierAcceptCommnet;
	}

	public function getvSupplierAcceptFromIP()
	{
		return $this->_vSupplierAcceptFromIP;
	}

	public function getvBuyerCode()
	{
		return $this->_vBuyerCode;
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

	public function getvBuyerCompanyName()
	{
		return $this->_vBuyerCompanyName;
	}

	public function getvBuyerContactName()
	{
		return $this->_vBuyerContactName;
	}

	public function getvBuyerContactTelephone()
	{
		return $this->_vBuyerContactTelephone;
	}

	public function getvBuyerContactEmail()
	{
		return $this->_vBuyerContactEmail;
	}

	public function getdOrderDate()
	{
		return $this->_dOrderDate;
	}

	public function gettOrderDescription()
	{
		return $this->_tOrderDescription;
	}

	public function getvOrderStatus()
	{
		return $this->_vOrderStatus;
	}

	public function getiOpeningUnit()
	{
		return $this->_iOpeningUnit;
	}

	public function getvSupplierOrderNum()
	{
		return $this->_vSupplierOrderNum;
	}

	public function gettCarrier()
	{
		return $this->_tCarrier;
	}

	public function geteLineItemTax()
	{
		return $this->_eLineItemTax;
	}

	public function getfVAT()
	{
		return $this->_fVAT;
	}

	public function getfOther_tax_1()
	{
		return $this->_fOther_tax_1;
	}

	public function getvShipToParty()
	{
		return $this->_vShipToParty;
	}

	public function getvShipToAddressLine1()
	{
		return $this->_vShipToAddressLine1;
	}

	public function getvShipToAddressLine2()
	{
		return $this->_vShipToAddressLine2;
	}

	public function getvShipToCity()
	{
		return $this->_vShipToCity;
	}

	public function getvShipToState()
	{
		return $this->_vShipToState;
	}

	public function getvShipToZipCode()
	{
		return $this->_vShipToZipCode;
	}

	public function getvShipToCountry()
	{
		return $this->_vShipToCountry;
	}

	public function getvShipToContactParty()
	{
		return $this->_vShipToContactParty;
	}

	public function getvShipToContactTelephone()
	{
		return $this->_vShipToContactTelephone;
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

	public function getfPOTotal()
	{
		return $this->_fPOTotal;
	}

	public function getfPrepayment()
	{
		return $this->_fPrepayment;
	}

	public function getvFromIP()
	{
		return $this->_vFromIP;
	}

	public function getiStatusID()
	{
		return $this->_iStatusID;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiPurchaseOrderID($val)
	{
		 $this->_iPurchaseOrderID =  $val;
	}

	public function setvPONumber($val)
	{
		 $this->_vPONumber =  $val;
	}

	public function setvPOCode($val)
	{
		 $this->_vPOCode =  $val;
	}

	public function setiBuyerID($val)
	{
		 $this->_iBuyerID =  $val;
	}

	public function setiSupplierOrganizationID($val)
	{
		 $this->_iSupplierOrganizationID =  $val;
	}

	public function setiSupplierID($val)
	{
		 $this->_iSupplierID =  $val;
	}

	public function setdCreateDate($val)
	{
		 $this->_dCreateDate =  $val;
	}

	public function setdVerifyDate($val)
	{
		 $this->_dVerifyDate =  $val;
	}

	public function setdIssueDate($val)
	{
		 $this->_dIssueDate =  $val;
	}

	public function seteSupplierAccept($val)
	{
		 $this->_eSupplierAccept =  $val;
	}

	public function setdSupplierAcceptDate($val)
	{
		 $this->_dSupplierAcceptDate =  $val;
	}

	public function settSupplierAcceptCommnet($val)
	{
		 $this->_tSupplierAcceptCommnet =  $val;
	}

	public function setvSupplierAcceptFromIP($val)
	{
		 $this->_vSupplierAcceptFromIP =  $val;
	}

	public function setvBuyerCode($val)
	{
		 $this->_vBuyerCode =  $val;
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

	public function setvBuyerCompanyName($val)
	{
		 $this->_vBuyerCompanyName =  $val;
	}

	public function setvBuyerContactName($val)
	{
		 $this->_vBuyerContactName =  $val;
	}

	public function setvBuyerContactTelephone($val)
	{
		 $this->_vBuyerContactTelephone =  $val;
	}

	public function setvBuyerContactEmail($val)
	{
		 $this->_vBuyerContactEmail =  $val;
	}

	public function setdOrderDate($val)
	{
		 $this->_dOrderDate =  $val;
	}

	public function settOrderDescription($val)
	{
		 $this->_tOrderDescription =  $val;
	}

	public function setvOrderStatus($val)
	{
		 $this->_vOrderStatus =  $val;
	}

	public function setiOpeningUnit($val)
	{
		 $this->_iOpeningUnit =  $val;
	}

	public function setvSupplierOrderNum($val)
	{
		 $this->_vSupplierOrderNum =  $val;
	}

	public function settCarrier($val)
	{
		 $this->_tCarrier =  $val;
	}

	public function seteLineItemTax($val)
	{
		 $this->_eLineItemTax =  $val;
	}

	public function setfVAT($val)
	{
		 $this->_fVAT =  $val;
	}

	public function setfOther_tax_1($val)
	{
		 $this->_fOther_tax_1 =  $val;
	}

	public function setvShipToParty($val)
	{
		 $this->_vShipToParty =  $val;
	}

	public function setvShipToAddressLine1($val)
	{
		 $this->_vShipToAddressLine1 =  $val;
	}

	public function setvShipToAddressLine2($val)
	{
		 $this->_vShipToAddressLine2 =  $val;
	}

	public function setvShipToCity($val)
	{
		 $this->_vShipToCity =  $val;
	}

	public function setvShipToState($val)
	{
		 $this->_vShipToState =  $val;
	}

	public function setvShipToZipCode($val)
	{
		 $this->_vShipToZipCode =  $val;
	}

	public function setvShipToCountry($val)
	{
		 $this->_vShipToCountry =  $val;
	}

	public function setvShipToContactParty($val)
	{
		 $this->_vShipToContactParty =  $val;
	}

	public function setvShipToContactTelephone($val)
	{
		 $this->_vShipToContactTelephone =  $val;
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

	public function setfPOTotal($val)
	{
		 $this->_fPOTotal =  $val;
	}

	public function setfPrepayment($val)
	{
		 $this->_fPrepayment =  $val;
	}

	public function setvFromIP($val)
	{
		 $this->_vFromIP =  $val;
	}

	public function setiStatusID($val)
	{
		 $this->_iStatusID =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_purchase_order_heading WHERE iPurchaseOrderID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_purchase_order_heading WHERE iPurchaseOrderID=$this->_iPurchaseOrderID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iPurchaseOrderID = $row[0]['iPurchaseOrderID'];
		 $this->_vPONumber = $row[0]['vPONumber'];
		 $this->_vPOCode = $row[0]['vPOCode'];
		 $this->_iBuyerID = $row[0]['iBuyerID'];
		 $this->_iSupplierOrganizationID = $row[0]['iSupplierOrganizationID'];
		 $this->_iSupplierID = $row[0]['iSupplierID'];
		 $this->_dCreateDate = $row[0]['dCreateDate'];
		 $this->_dVerifyDate = $row[0]['dVerifyDate'];
		 $this->_dIssueDate = $row[0]['dIssueDate'];
		 $this->_eSupplierAccept = $row[0]['eSupplierAccept'];
		 $this->_dSupplierAcceptDate = $row[0]['dSupplierAcceptDate'];
		 $this->_tSupplierAcceptCommnet = $row[0]['tSupplierAcceptCommnet'];
		 $this->_vSupplierAcceptFromIP = $row[0]['vSupplierAcceptFromIP'];
		 $this->_vBuyerCode = $row[0]['vBuyerCode'];
		 $this->_vSupplierName = $row[0]['vSupplierName'];
		 $this->_vSupplierAddLine1 = $row[0]['vSupplierAddLine1'];
		 $this->_vSupplierAddLine2 = $row[0]['vSupplierAddLine2'];
		 $this->_vSupplierCity = $row[0]['vSupplierCity'];
		 $this->_vSupplierZipCode = $row[0]['vSupplierZipCode'];
		 $this->_vSupplierState = $row[0]['vSupplierState'];
		 $this->_vSupplierCountry = $row[0]['vSupplierCountry'];
		 $this->_vSupplierContactParty = $row[0]['vSupplierContactParty'];
		 $this->_vSupplierContactTelephone = $row[0]['vSupplierContactTelephone'];
		 $this->_vBuyerCompanyName = $row[0]['vBuyerCompanyName'];
		 $this->_vBuyerContactName = $row[0]['vBuyerContactName'];
		 $this->_vBuyerContactTelephone = $row[0]['vBuyerContactTelephone'];
		 $this->_vBuyerContactEmail = $row[0]['vBuyerContactEmail'];
		 $this->_dOrderDate = $row[0]['dOrderDate'];
		 $this->_tOrderDescription = $row[0]['tOrderDescription'];
		 $this->_vOrderStatus = $row[0]['vOrderStatus'];
		 $this->_iOpeningUnit = $row[0]['iOpeningUnit'];
		 $this->_vSupplierOrderNum = $row[0]['vSupplierOrderNum'];
		 $this->_tCarrier = $row[0]['tCarrier'];
		 $this->_eLineItemTax = $row[0]['eLineItemTax'];
		 $this->_fVAT = $row[0]['fVAT'];
		 $this->_fOther_tax_1 = $row[0]['fOther_tax_1'];
		 $this->_vShipToParty = $row[0]['vShipToParty'];
		 $this->_vShipToAddressLine1 = $row[0]['vShipToAddressLine1'];
		 $this->_vShipToAddressLine2 = $row[0]['vShipToAddressLine2'];
		 $this->_vShipToCity = $row[0]['vShipToCity'];
		 $this->_vShipToState = $row[0]['vShipToState'];
		 $this->_vShipToZipCode = $row[0]['vShipToZipCode'];
		 $this->_vShipToCountry = $row[0]['vShipToCountry'];
		 $this->_vShipToContactParty = $row[0]['vShipToContactParty'];
		 $this->_vShipToContactTelephone = $row[0]['vShipToContactTelephone'];
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
		 $this->_fPOTotal = $row[0]['fPOTotal'];
		 $this->_fPrepayment = $row[0]['fPrepayment'];
		 $this->_vFromIP = $row[0]['vFromIP'];
		 $this->_iStatusID = $row[0]['iStatusID'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_purchase_order_heading WHERE iPurchaseOrderID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iPurchaseOrderID = '';
		 $this->iPurchaseOrderID = ""; // clear key for autoincrement

		 $Data = array(
						 'vPONumber'		=>	$this->_vPONumber,
						'vPOCode'		=>	$this->_vPOCode,
						'iBuyerID'		=>	$this->_iBuyerID,
						'iSupplierOrganizationID'		=>	$this->_iSupplierOrganizationID,
						'iSupplierID'		=>	$this->_iSupplierID,
						'dCreateDate'		=>	date("Y-m-d H:i:s"),
						'dVerifyDate'		=>	$this->_dVerifyDate,
						'dIssueDate'		=>	$this->_dIssueDate,
						'eSupplierAccept'		=>	$this->_eSupplierAccept,
						'dSupplierAcceptDate'		=>	$this->_dSupplierAcceptDate,
						'tSupplierAcceptCommnet'		=>	$this->_tSupplierAcceptCommnet,
						'vSupplierAcceptFromIP'		=>	$this->_vSupplierAcceptFromIP,
						'vBuyerCode'		=>	$this->_vBuyerCode,
						'vSupplierName'		=>	$this->_vSupplierName,
						'vSupplierAddLine1'		=>	$this->_vSupplierAddLine1,
						'vSupplierAddLine2'		=>	$this->_vSupplierAddLine2,
						'vSupplierCity'		=>	$this->_vSupplierCity,
						'vSupplierZipCode'		=>	$this->_vSupplierZipCode,
						'vSupplierState'		=>	$this->_vSupplierState,
						'vSupplierCountry'		=>	$this->_vSupplierCountry,
						'vSupplierContactParty'		=>	$this->_vSupplierContactParty,
						'vSupplierContactTelephone'		=>	$this->_vSupplierContactTelephone,
						'vBuyerCompanyName'		=>	$this->_vBuyerCompanyName,
						'vBuyerContactName'		=>	$this->_vBuyerContactName,
						'vBuyerContactTelephone'		=>	$this->_vBuyerContactTelephone,
						'vBuyerContactEmail'		=>	$this->_vBuyerContactEmail,
						'dOrderDate'		=>	$this->_dOrderDate,
						'tOrderDescription'		=>	$this->_tOrderDescription,
						'vOrderStatus'		=>	$this->_vOrderStatus,
						'iOpeningUnit'		=>	$this->_iOpeningUnit,
						'vSupplierOrderNum'		=>	$this->_vSupplierOrderNum,
						'tCarrier'		=>	$this->_tCarrier,
						'eLineItemTax'		=>	$this->_eLineItemTax,
						'fVAT'		=>	$this->_fVAT,
						'fOther_tax_1'		=>	$this->_fOther_tax_1,
						'vShipToParty'		=>	$this->_vShipToParty,
						'vShipToAddressLine1'		=>	$this->_vShipToAddressLine1,
						'vShipToAddressLine2'		=>	$this->_vShipToAddressLine2,
						'vShipToCity'		=>	$this->_vShipToCity,
						'vShipToState'		=>	$this->_vShipToState,
						'vShipToZipCode'		=>	$this->_vShipToZipCode,
						'vShipToCountry'		=>	$this->_vShipToCountry,
						'vShipToContactParty'		=>	$this->_vShipToContactParty,
						'vShipToContactTelephone'		=>	$this->_vShipToContactTelephone,
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
						'fPOTotal'		=>	$this->_fPOTotal,
						'fPrepayment'		=>	$this->_fPrepayment,
						'vFromIP'		=>	$_SERVER[REMOTE_ADDR],
						'iStatusID'		=>	$this->_iStatusID
);     // prints ($Data); exit;

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_heading",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'vPONumber'		=>	$this->_vPONumber,
						'vPOCode'		=>	$this->_vPOCode,
						'iBuyerID'		=>	$this->_iBuyerID,
						'iSupplierOrganizationID'		=>	$this->_iSupplierOrganizationID,
						'iSupplierID'		=>	$this->_iSupplierID,
						'dCreateDate'		=>	$this->_dCreateDate,
						'dVerifyDate'		=>	$this->_dVerifyDate,
						'dIssueDate'		=>	$this->_dIssueDate,
						'eSupplierAccept'		=>	$this->_eSupplierAccept,
						'dSupplierAcceptDate'		=>	$this->_dSupplierAcceptDate,
						'tSupplierAcceptCommnet'		=>	$this->_tSupplierAcceptCommnet,
						'vSupplierAcceptFromIP'		=>	$this->_vSupplierAcceptFromIP,
						'vBuyerCode'		=>	$this->_vBuyerCode,
						'vSupplierName'		=>	$this->_vSupplierName,
						'vSupplierAddLine1'		=>	$this->_vSupplierAddLine1,
						'vSupplierAddLine2'		=>	$this->_vSupplierAddLine2,
						'vSupplierCity'		=>	$this->_vSupplierCity,
						'vSupplierZipCode'		=>	$this->_vSupplierZipCode,
						'vSupplierState'		=>	$this->_vSupplierState,
						'vSupplierCountry'		=>	$this->_vSupplierCountry,
						'vSupplierContactParty'		=>	$this->_vSupplierContactParty,
						'vSupplierContactTelephone'		=>	$this->_vSupplierContactTelephone,
						'vBuyerCompanyName'		=>	$this->_vBuyerCompanyName,
						'vBuyerContactName'		=>	$this->_vBuyerContactName,
						'vBuyerContactTelephone'		=>	$this->_vBuyerContactTelephone,
						'vBuyerContactEmail'		=>	$this->_vBuyerContactEmail,
						'dOrderDate'		=>	$this->_dOrderDate,
						'tOrderDescription'		=>	$this->_tOrderDescription,
						'vOrderStatus'		=>	$this->_vOrderStatus,
						'iOpeningUnit'		=>	$this->_iOpeningUnit,
						'vSupplierOrderNum'		=>	$this->_vSupplierOrderNum,
						'tCarrier'		=>	$this->_tCarrier,
						'eLineItemTax'		=>	$this->_eLineItemTax,
						'fVAT'		=>	$this->_fVAT,
						'fOther_tax_1'		=>	$this->_fOther_tax_1,
						'vShipToParty'		=>	$this->_vShipToParty,
						'vShipToAddressLine1'		=>	$this->_vShipToAddressLine1,
						'vShipToAddressLine2'		=>	$this->_vShipToAddressLine2,
						'vShipToCity'		=>	$this->_vShipToCity,
						'vShipToState'		=>	$this->_vShipToState,
						'vShipToZipCode'		=>	$this->_vShipToZipCode,
						'vShipToCountry'		=>	$this->_vShipToCountry,
						'vShipToContactParty'		=>	$this->_vShipToContactParty,
						'vShipToContactTelephone'		=>	$this->_vShipToContactTelephone,
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
						'fPOTotal'		=>	$this->_fPOTotal,
						'fPrepayment'		=>	$this->_fPrepayment,
						'vFromIP'		=>	$this->_vFromIP,
						'iStatusID'		=>	$this->_iStatusID
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_heading",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_heading",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_purchase_order_heading $cnt $limit";
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

   /**
	*   @desc   GET DETAILS WITH PAGING AND JOINED TABLE IF REQUIRED
	*/
   function getJoinTableInfo($jtbl,$fields="*",$where="",$orderBy="",$groupBy="",$limit="",$pg="") {
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_purchase_order_heading $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_purchase_order_heading $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>