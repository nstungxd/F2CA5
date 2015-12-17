<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        RFQ2Master
* GENERATION DATE:  18.04.2012
* CLASS FILE:       /var/www/B2B/libraries/classes/application/class.RFQ2Master.php
* FOR MYSQL TABLE:  b2b_rfq2_master
* FOR MYSQL DB:     b2b_auction_live
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class RFQ2Master
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iRFQ2Id;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iRFQ2Id;
	protected $_vRFQ2Code;
	protected $_vRFQ2No;
	protected $_iUserID;
	protected $_iOrganizationID;
	protected $_iInvoiceID;
	protected $_iPurchaseOrderID;
	protected $_eCreatedBy;
	protected $_eAuctionType;
	protected $_dStartDate;
	protected $_dEndDate;
	protected $_tInstruction;
	protected $_tDescription;
	protected $_fBuyOutAdvance;
	protected $_fBuyOutPrice;
	protected $_fAdvanceMinPc;
	protected $_fAdvanceMinAmt;
	protected $_fAdvanceMaxPc;
	protected $_fAdvanceMaxAmt;
	protected $_fPriceMinPc;
	protected $_fPriceMinAmt;
	protected $_fPriceMaxPc;
	protected $_fPriceMaxAmt;
	protected $_fAdvanceTotal;
	protected $_fPriceTotal;
	protected $_fTotal;
	protected $_fIntervalPrice;
	protected $_fBestBidAdvance;
	protected $_fBestBidPrice;
	protected $_fBestBidAmount;
	protected $_fPOAwardAdvace;
	protected $_fPOAwardPrice;
	protected $_fPOAwardAmount;
	protected $_iEndAfterHrs;
	protected $_iEndAfterMin;
	protected $_eInstantStart;
	protected $_eRelativeEndTime;
	protected $_eAutoBid;
	protected $_eBidCriteria;
	protected $_tReasonToReject;
	protected $_dADate;
	protected $_vFromIP;
	protected $_iStatusID;
	protected $_iModifiedById;
	protected $_iRejectedById;
	protected $_iVerifiedBy;
	protected $_eFrom;
	protected $_eSaved;
	protected $_eDelete;
	protected $_eAuctionStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iRFQ2Id = null;
		$this->_vRFQ2Code = null;
		$this->_vRFQ2No = null;
		$this->_iUserID = null;
		$this->_iOrganizationID = null;
		$this->_iInvoiceID = null;
		$this->_iPurchaseOrderID = null;
		$this->_eCreatedBy = null;
		$this->_eAuctionType = null;
		$this->_dStartDate = null;
		$this->_dEndDate = null;
		$this->_tInstruction = null;
		$this->_tDescription = null;
		$this->_fBuyOutAdvance = null;
		$this->_fBuyOutPrice = null;
		$this->_fAdvanceMinPc = null;
		$this->_fAdvanceMinAmt = null;
		$this->_fAdvanceMaxPc = null;
		$this->_fAdvanceMaxAmt = null;
		$this->_fPriceMinPc = null;
		$this->_fPriceMinAmt = null;
		$this->_fPriceMaxPc = null;
		$this->_fPriceMaxAmt = null;
		$this->_fAdvanceTotal = null;
		$this->_fPriceTotal = null;
		$this->_fTotal = null;
		$this->_fIntervalPrice = null;
		$this->_fBestBidAdvance = null;
		$this->_fBestBidPrice = null;
		$this->_fBestBidAmount = null;
		$this->_fPOAwardAdvace = null;
		$this->_fPOAwardPrice = null;
		$this->_fPOAwardAmount = null;
		$this->_iEndAfterHrs = null;
		$this->_iEndAfterMin = null;
		$this->_eInstantStart = null;
		$this->_eRelativeEndTime = null;
		$this->_eAutoBid = null;
		$this->_eBidCriteria = null;
		$this->_tReasonToReject = null;
		$this->_dADate = null;
		$this->_vFromIP = null;
		$this->_iStatusID = null;
		$this->_iModifiedById = null;
		$this->_iRejectedById = null;
		$this->_iVerifiedBy = null;
		$this->_eFrom = null;
		$this->_eSaved = null;
		$this->_eDelete = null;
		$this->_eAuctionStatus = null;
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


	public function getiRFQ2Id()
	{
		return $this->_iRFQ2Id;
	}

	public function getvRFQ2Code()
	{
		return $this->_vRFQ2Code;
	}

	public function getvRFQ2No()
	{
		return $this->_vRFQ2No;
	}

	public function getiUserID()
	{
		return $this->_iUserID;
	}

	public function getiOrganizationID()
	{
		return $this->_iOrganizationID;
	}

	public function getiInvoiceID()
	{
		return $this->_iInvoiceID;
	}

	public function getiPurchaseOrderID()
	{
		return $this->_iPurchaseOrderID;
	}

	public function geteCreatedBy()
	{
		return $this->_eCreatedBy;
	}

	public function geteAuctionType()
	{
		return $this->_eAuctionType;
	}

	public function getdStartDate()
	{
		return $this->_dStartDate;
	}

	public function getdEndDate()
	{
		return $this->_dEndDate;
	}

	public function gettInstruction()
	{
		return $this->_tInstruction;
	}

	public function gettDescription()
	{
		return $this->_tDescription;
	}

	public function getfBuyOutAdvance()
	{
		return $this->_fBuyOutAdvance;
	}

	public function getfBuyOutPrice()
	{
		return $this->_fBuyOutPrice;
	}

	public function getfAdvanceMinPc()
	{
		return $this->_fAdvanceMinPc;
	}

	public function getfAdvanceMinAmt()
	{
		return $this->_fAdvanceMinAmt;
	}

	public function getfAdvanceMaxPc()
	{
		return $this->_fAdvanceMaxPc;
	}

	public function getfAdvanceMaxAmt()
	{
		return $this->_fAdvanceMaxAmt;
	}

	public function getfPriceMinPc()
	{
		return $this->_fPriceMinPc;
	}

	public function getfPriceMinAmt()
	{
		return $this->_fPriceMinAmt;
	}

	public function getfPriceMaxPc()
	{
		return $this->_fPriceMaxPc;
	}

	public function getfPriceMaxAmt()
	{
		return $this->_fPriceMaxAmt;
	}

	public function getfAdvanceTotal()
	{
		return $this->_fAdvanceTotal;
	}

	public function getfPriceTotal()
	{
		return $this->_fPriceTotal;
	}

	public function getfTotal()
	{
		return $this->_fTotal;
	}

	public function getfIntervalPrice()
	{
		return $this->_fIntervalPrice;
	}

	public function getfBestBidAdvance()
	{
		return $this->_fBestBidAdvance;
	}

	public function getfBestBidPrice()
	{
		return $this->_fBestBidPrice;
	}

	public function getfBestBidAmount()
	{
		return $this->_fBestBidAmount;
	}

	public function getfPOAwardAdvace()
	{
		return $this->_fPOAwardAdvace;
	}

	public function getfPOAwardPrice()
	{
		return $this->_fPOAwardPrice;
	}

	public function getfPOAwardAmount()
	{
		return $this->_fPOAwardAmount;
	}

	public function getiEndAfterHrs()
	{
		return $this->_iEndAfterHrs;
	}

	public function getiEndAfterMin()
	{
		return $this->_iEndAfterMin;
	}

	public function geteInstantStart()
	{
		return $this->_eInstantStart;
	}

	public function geteRelativeEndTime()
	{
		return $this->_eRelativeEndTime;
	}

	public function geteAutoBid()
	{
		return $this->_eAutoBid;
	}

	public function geteBidCriteria()
	{
		return $this->_eBidCriteria;
	}

	public function gettReasonToReject()
	{
		return $this->_tReasonToReject;
	}

	public function getdADate()
	{
		return $this->_dADate;
	}

	public function getvFromIP()
	{
		return $this->_vFromIP;
	}

	public function getiStatusID()
	{
		return $this->_iStatusID;
	}

	public function getiModifiedById()
	{
		return $this->_iModifiedById;
	}

	public function getiRejectedById()
	{
		return $this->_iRejectedById;
	}

	public function getiVerifiedBy()
	{
		return $this->_iVerifiedBy;
	}

	public function geteFrom()
	{
		return $this->_eFrom;
	}

	public function geteSaved()
	{
		return $this->_eSaved;
	}

	public function geteDelete()
	{
		return $this->_eDelete;
	}

	public function geteAuctionStatus()
	{
		return $this->_eAuctionStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiRFQ2Id($val)
	{
		 $this->_iRFQ2Id =  $val;
	}

	public function setvRFQ2Code($val)
	{
		 $this->_vRFQ2Code =  $val;
	}

	public function setvRFQ2No($val)
	{
		 $this->_vRFQ2No =  $val;
	}

	public function setiUserID($val)
	{
		 $this->_iUserID =  $val;
	}

	public function setiOrganizationID($val)
	{
		 $this->_iOrganizationID =  $val;
	}

	public function setiInvoiceID($val)
	{
		 $this->_iInvoiceID =  $val;
	}

	public function setiPurchaseOrderID($val)
	{
		 $this->_iPurchaseOrderID =  $val;
	}

	public function seteCreatedBy($val)
	{
		 $this->_eCreatedBy =  $val;
	}

	public function seteAuctionType($val)
	{
		 $this->_eAuctionType =  $val;
	}

	public function setdStartDate($val)
	{
		 $this->_dStartDate =  $val;
	}

	public function setdEndDate($val)
	{
		 $this->_dEndDate =  $val;
	}

	public function settInstruction($val)
	{
		 $this->_tInstruction =  $val;
	}

	public function settDescription($val)
	{
		 $this->_tDescription =  $val;
	}

	public function setfBuyOutAdvance($val)
	{
		 $this->_fBuyOutAdvance =  $val;
	}

	public function setfBuyOutPrice($val)
	{
		 $this->_fBuyOutPrice =  $val;
	}

	public function setfAdvanceMinPc($val)
	{
		 $this->_fAdvanceMinPc =  $val;
	}

	public function setfAdvanceMinAmt($val)
	{
		 $this->_fAdvanceMinAmt =  $val;
	}

	public function setfAdvanceMaxPc($val)
	{
		 $this->_fAdvanceMaxPc =  $val;
	}

	public function setfAdvanceMaxAmt($val)
	{
		 $this->_fAdvanceMaxAmt =  $val;
	}

	public function setfPriceMinPc($val)
	{
		 $this->_fPriceMinPc =  $val;
	}

	public function setfPriceMinAmt($val)
	{
		 $this->_fPriceMinAmt =  $val;
	}

	public function setfPriceMaxPc($val)
	{
		 $this->_fPriceMaxPc =  $val;
	}

	public function setfPriceMaxAmt($val)
	{
		 $this->_fPriceMaxAmt =  $val;
	}

	public function setfAdvanceTotal($val)
	{
		 $this->_fAdvanceTotal =  $val;
	}

	public function setfPriceTotal($val)
	{
		 $this->_fPriceTotal =  $val;
	}

	public function setfTotal($val)
	{
		 $this->_fTotal =  $val;
	}

	public function setfIntervalPrice($val)
	{
		 $this->_fIntervalPrice =  $val;
	}

	public function setfBestBidAdvance($val)
	{
		 $this->_fBestBidAdvance =  $val;
	}

	public function setfBestBidPrice($val)
	{
		 $this->_fBestBidPrice =  $val;
	}

	public function setfBestBidAmount($val)
	{
		 $this->_fBestBidAmount =  $val;
	}

	public function setfPOAwardAdvace($val)
	{
		 $this->_fPOAwardAdvace =  $val;
	}

	public function setfPOAwardPrice($val)
	{
		 $this->_fPOAwardPrice =  $val;
	}

	public function setfPOAwardAmount($val)
	{
		 $this->_fPOAwardAmount =  $val;
	}

	public function setiEndAfterHrs($val)
	{
		 $this->_iEndAfterHrs =  $val;
	}

	public function setiEndAfterMin($val)
	{
		 $this->_iEndAfterMin =  $val;
	}

	public function seteInstantStart($val)
	{
		 $this->_eInstantStart =  $val;
	}

	public function seteRelativeEndTime($val)
	{
		 $this->_eRelativeEndTime =  $val;
	}

	public function seteAutoBid($val)
	{
		 $this->_eAutoBid =  $val;
	}

	public function seteBidCriteria($val)
	{
		 $this->_eBidCriteria =  $val;
	}

	public function settReasonToReject($val)
	{
		 $this->_tReasonToReject =  $val;
	}

	public function setdADate($val)
	{
		 $this->_dADate =  $val;
	}

	public function setvFromIP($val)
	{
		 $this->_vFromIP =  $val;
	}

	public function setiStatusID($val)
	{
		 $this->_iStatusID =  $val;
	}

	public function setiModifiedById($val)
	{
		 $this->_iModifiedById =  $val;
	}

	public function setiRejectedById($val)
	{
		 $this->_iRejectedById =  $val;
	}

	public function setiVerifiedBy($val)
	{
		 $this->_iVerifiedBy =  $val;
	}

	public function seteFrom($val)
	{
		 $this->_eFrom =  $val;
	}

	public function seteSaved($val)
	{
		 $this->_eSaved =  $val;
	}

	public function seteDelete($val)
	{
		 $this->_eDelete =  $val;
	}

	public function seteAuctionStatus($val)
	{
		 $this->_eAuctionStatus =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2_master WHERE iRFQ2Id = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2_master WHERE iRFQ2Id=$this->_iRFQ2Id ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iRFQ2Id = $row[0]['iRFQ2Id'];
		 $this->_vRFQ2Code = $row[0]['vRFQ2Code'];
		 $this->_vRFQ2No = $row[0]['vRFQ2No'];
		 $this->_iUserID = $row[0]['iUserID'];
		 $this->_iOrganizationID = $row[0]['iOrganizationID'];
		 $this->_iInvoiceID = $row[0]['iInvoiceID'];
		 $this->_iPurchaseOrderID = $row[0]['iPurchaseOrderID'];
		 $this->_eCreatedBy = $row[0]['eCreatedBy'];
		 $this->_eAuctionType = $row[0]['eAuctionType'];
		 $this->_dStartDate = $row[0]['dStartDate'];
		 $this->_dEndDate = $row[0]['dEndDate'];
		 $this->_tInstruction = $row[0]['tInstruction'];
		 $this->_tDescription = $row[0]['tDescription'];
		 $this->_fBuyOutAdvance = $row[0]['fBuyOutAdvance'];
		 $this->_fBuyOutPrice = $row[0]['fBuyOutPrice'];
		 $this->_fAdvanceMinPc = $row[0]['fAdvanceMinPc'];
		 $this->_fAdvanceMinAmt = $row[0]['fAdvanceMinAmt'];
		 $this->_fAdvanceMaxPc = $row[0]['fAdvanceMaxPc'];
		 $this->_fAdvanceMaxAmt = $row[0]['fAdvanceMaxAmt'];
		 $this->_fPriceMinPc = $row[0]['fPriceMinPc'];
		 $this->_fPriceMinAmt = $row[0]['fPriceMinAmt'];
		 $this->_fPriceMaxPc = $row[0]['fPriceMaxPc'];
		 $this->_fPriceMaxAmt = $row[0]['fPriceMaxAmt'];
		 $this->_fAdvanceTotal = $row[0]['fAdvanceTotal'];
		 $this->_fPriceTotal = $row[0]['fPriceTotal'];
		 $this->_fTotal = $row[0]['fTotal'];
		 $this->_fIntervalPrice = $row[0]['fIntervalPrice'];
		 $this->_fBestBidAdvance = $row[0]['fBestBidAdvance'];
		 $this->_fBestBidPrice = $row[0]['fBestBidPrice'];
		 $this->_fBestBidAmount = $row[0]['fBestBidAmount'];
		 $this->_fPOAwardAdvace = $row[0]['fPOAwardAdvace'];
		 $this->_fPOAwardPrice = $row[0]['fPOAwardPrice'];
		 $this->_fPOAwardAmount = $row[0]['fPOAwardAmount'];
		 $this->_iEndAfterHrs = $row[0]['iEndAfterHrs'];
		 $this->_iEndAfterMin = $row[0]['iEndAfterMin'];
		 $this->_eInstantStart = $row[0]['eInstantStart'];
		 $this->_eRelativeEndTime = $row[0]['eRelativeEndTime'];
		 $this->_eAutoBid = $row[0]['eAutoBid'];
		 $this->_eBidCriteria = $row[0]['eBidCriteria'];
		 $this->_tReasonToReject = $row[0]['tReasonToReject'];
		 $this->_dADate = $row[0]['dADate'];
		 $this->_vFromIP = $row[0]['vFromIP'];
		 $this->_iStatusID = $row[0]['iStatusID'];
		 $this->_iModifiedById = $row[0]['iModifiedById'];
		 $this->_iRejectedById = $row[0]['iRejectedById'];
		 $this->_iVerifiedBy = $row[0]['iVerifiedBy'];
		 $this->_eFrom = $row[0]['eFrom'];
		 $this->_eSaved = $row[0]['eSaved'];
		 $this->_eDelete = $row[0]['eDelete'];
		 $this->_eAuctionStatus = $row[0]['eAuctionStatus'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2_master WHERE iRFQ2Id = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert($Data = Array())
	{
		 $this->_iRFQ2Id = '';
		 $this->iRFQ2Id = ""; // clear key for autoincrement
		 if(!is_array($Data) || count($Data)<1) {
		 $Data = array(
						 'vRFQ2Code'		=>	$this->_vRFQ2Code,
						'vRFQ2No'		=>	$this->_vRFQ2No,
						'iUserID'		=>	$this->_iUserID,
						'iOrganizationID'		=>	$this->_iOrganizationID,
						'iInvoiceID'		=>	$this->_iInvoiceID,
						'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'eAuctionType'		=>	$this->_eAuctionType,
						'dStartDate'		=>	$this->_dStartDate,
						'dEndDate'		=>	$this->_dEndDate,
						'tInstruction'		=>	$this->_tInstruction,
						'tDescription'		=>	$this->_tDescription,
						'fBuyOutAdvance'		=>	$this->_fBuyOutAdvance,
						'fBuyOutPrice'		=>	$this->_fBuyOutPrice,
						'fAdvanceMinPc'		=>	$this->_fAdvanceMinPc,
						'fAdvanceMinAmt'		=>	$this->_fAdvanceMinAmt,
						'fAdvanceMaxPc'		=>	$this->_fAdvanceMaxPc,
						'fAdvanceMaxAmt'		=>	$this->_fAdvanceMaxAmt,
						'fPriceMinPc'		=>	$this->_fPriceMinPc,
						'fPriceMinAmt'		=>	$this->_fPriceMinAmt,
						'fPriceMaxPc'		=>	$this->_fPriceMaxPc,
						'fPriceMaxAmt'		=>	$this->_fPriceMaxAmt,
						'fAdvanceTotal'		=>	$this->_fAdvanceTotal,
						'fPriceTotal'		=>	$this->_fPriceTotal,
						'fTotal'		=>	$this->_fTotal,
						'fIntervalPrice'		=>	$this->_fIntervalPrice,
						'fBestBidAdvance'		=>	$this->_fBestBidAdvance,
						'fBestBidPrice'		=>	$this->_fBestBidPrice,
						'fBestBidAmount'		=>	$this->_fBestBidAmount,
						'fPOAwardAdvace'		=>	$this->_fPOAwardAdvace,
						'fPOAwardPrice'		=>	$this->_fPOAwardPrice,
						'fPOAwardAmount'		=>	$this->_fPOAwardAmount,
						'iEndAfterHrs'		=>	$this->_iEndAfterHrs,
						'iEndAfterMin'		=>	$this->_iEndAfterMin,
						'eInstantStart'		=>	$this->_eInstantStart,
						'eRelativeEndTime'		=>	$this->_eRelativeEndTime,
						'eAutoBid'		=>	$this->_eAutoBid,
						'eBidCriteria'		=>	$this->_eBidCriteria,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'dADate'		=>	$this->_dADate,
						'vFromIP'		=>	$this->_vFromIP,
						'iStatusID'		=>	$this->_iStatusID,
						'iModifiedById'		=>	$this->_iModifiedById,
						'iRejectedById'		=>	$this->_iRejectedById,
						'iVerifiedBy'		=>	$this->_iVerifiedBy,
						'eFrom'		=>	$this->_eFrom,
						'eSaved'		=>	$this->_eSaved,
						'eDelete'		=>	$this->_eDelete,
						'eAuctionStatus'		=>	$this->_eAuctionStatus
);

		 }
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_master",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'vRFQ2Code'		=>	$this->_vRFQ2Code,
						'vRFQ2No'		=>	$this->_vRFQ2No,
						'iUserID'		=>	$this->_iUserID,
						'iOrganizationID'		=>	$this->_iOrganizationID,
						'iInvoiceID'		=>	$this->_iInvoiceID,
						'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'eAuctionType'		=>	$this->_eAuctionType,
						'dStartDate'		=>	$this->_dStartDate,
						'dEndDate'		=>	$this->_dEndDate,
						'tInstruction'		=>	$this->_tInstruction,
						'tDescription'		=>	$this->_tDescription,
						'fBuyOutAdvance'		=>	$this->_fBuyOutAdvance,
						'fBuyOutPrice'		=>	$this->_fBuyOutPrice,
						'fAdvanceMinPc'		=>	$this->_fAdvanceMinPc,
						'fAdvanceMinAmt'		=>	$this->_fAdvanceMinAmt,
						'fAdvanceMaxPc'		=>	$this->_fAdvanceMaxPc,
						'fAdvanceMaxAmt'		=>	$this->_fAdvanceMaxAmt,
						'fPriceMinPc'		=>	$this->_fPriceMinPc,
						'fPriceMinAmt'		=>	$this->_fPriceMinAmt,
						'fPriceMaxPc'		=>	$this->_fPriceMaxPc,
						'fPriceMaxAmt'		=>	$this->_fPriceMaxAmt,
						'fAdvanceTotal'		=>	$this->_fAdvanceTotal,
						'fPriceTotal'		=>	$this->_fPriceTotal,
						'fTotal'		=>	$this->_fTotal,
						'fIntervalPrice'		=>	$this->_fIntervalPrice,
						'fBestBidAdvance'		=>	$this->_fBestBidAdvance,
						'fBestBidPrice'		=>	$this->_fBestBidPrice,
						'fBestBidAmount'		=>	$this->_fBestBidAmount,
						'fPOAwardAdvace'		=>	$this->_fPOAwardAdvace,
						'fPOAwardPrice'		=>	$this->_fPOAwardPrice,
						'fPOAwardAmount'		=>	$this->_fPOAwardAmount,
						'iEndAfterHrs'		=>	$this->_iEndAfterHrs,
						'iEndAfterMin'		=>	$this->_iEndAfterMin,
						'eInstantStart'		=>	$this->_eInstantStart,
						'eRelativeEndTime'		=>	$this->_eRelativeEndTime,
						'eAutoBid'		=>	$this->_eAutoBid,
						'eBidCriteria'		=>	$this->_eBidCriteria,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'dADate'		=>	$this->_dADate,
						'vFromIP'		=>	$this->_vFromIP,
						'iStatusID'		=>	$this->_iStatusID,
						'iModifiedById'		=>	$this->_iModifiedById,
						'iRejectedById'		=>	$this->_iRejectedById,
						'iVerifiedBy'		=>	$this->_iVerifiedBy,
						'eFrom'		=>	$this->_eFrom,
						'eSaved'		=>	$this->_eSaved,
						'eDelete'		=>	$this->_eDelete,
						'eAuctionStatus'		=>	$this->_eAuctionStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_master",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_master",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_rfq2_master $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_rfq2_master $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_rfq2_master $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>