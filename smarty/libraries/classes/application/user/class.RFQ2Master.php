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

class RFQ2Master {

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
    protected $_iDays;
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
    function __construct() {
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
        $this->_iDays = null;
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
    function __destruct() {
        unset($this->_dbobj);
    }

    /**
     *   @desc   GETTER METHODS
     */
    public function getiRFQ2Id() {
        return $this->_iRFQ2Id;
    }

    public function getvRFQ2Code() {
        return $this->_vRFQ2Code;
    }

    public function getvRFQ2No() {
        return $this->_vRFQ2No;
    }

    public function getiUserID() {
        return $this->_iUserID;
    }

    public function getiOrganizationID() {
        return $this->_iOrganizationID;
    }

    public function getiInvoiceID() {
        return $this->_iInvoiceID;
    }

    public function getiPurchaseOrderID() {
        return $this->_iPurchaseOrderID;
    }

    public function geteCreatedBy() {
        return $this->_eCreatedBy;
    }

    public function geteAuctionType() {
        return $this->_eAuctionType;
    }

    public function getdStartDate() {
        return $this->_dStartDate;
    }

    public function getdEndDate() {
        return $this->_dEndDate;
    }

    public function gettInstruction() {
        return $this->_tInstruction;
    }

    public function gettDescription() {
        return $this->_tDescription;
    }

    public function getfBuyOutAdvance() {
        return $this->_fBuyOutAdvance;
    }

    public function getfBuyOutPrice() {
        return $this->_fBuyOutPrice;
    }

    public function getiDays() {
        return $this->_iDays;
    }

    public function getfAdvanceMinPc() {
        return $this->_fAdvanceMinPc;
    }

    public function getfAdvanceMinAmt() {
        return $this->_fAdvanceMinAmt;
    }

    public function getfAdvanceMaxPc() {
        return $this->_fAdvanceMaxPc;
    }

    public function getfAdvanceMaxAmt() {
        return $this->_fAdvanceMaxAmt;
    }

    public function getfPriceMinPc() {
        return $this->_fPriceMinPc;
    }

    public function getfPriceMinAmt() {
        return $this->_fPriceMinAmt;
    }

    public function getfPriceMaxPc() {
        return $this->_fPriceMaxPc;
    }

    public function getfPriceMaxAmt() {
        return $this->_fPriceMaxAmt;
    }

    public function getfAdvanceTotal() {
        return $this->_fAdvanceTotal;
    }

    public function getfPriceTotal() {
        return $this->_fPriceTotal;
    }

    public function getfTotal() {
        return $this->_fTotal;
    }

    public function getfIntervalPrice() {
        return $this->_fIntervalPrice;
    }

    public function getfBestBidAdvance() {
        return $this->_fBestBidAdvance;
    }

    public function getfBestBidPrice() {
        return $this->_fBestBidPrice;
    }

    public function getfBestBidAmount() {
        return $this->_fBestBidAmount;
    }

    public function getfPOAwardAdvace() {
        return $this->_fPOAwardAdvace;
    }

    public function getfPOAwardPrice() {
        return $this->_fPOAwardPrice;
    }

    public function getfPOAwardAmount() {
        return $this->_fPOAwardAmount;
    }

    public function getiEndAfterHrs() {
        return $this->_iEndAfterHrs;
    }

    public function getiEndAfterMin() {
        return $this->_iEndAfterMin;
    }

    public function geteInstantStart() {
        return $this->_eInstantStart;
    }

    public function geteRelativeEndTime() {
        return $this->_eRelativeEndTime;
    }

    public function geteAutoBid() {
        return $this->_eAutoBid;
    }

    public function geteBidCriteria() {
        return $this->_eBidCriteria;
    }

    public function gettReasonToReject() {
        return $this->_tReasonToReject;
    }

    public function getdADate() {
        return $this->_dADate;
    }

    public function getvFromIP() {
        return $this->_vFromIP;
    }

    public function getiStatusID() {
        return $this->_iStatusID;
    }

    public function getiModifiedById() {
        return $this->_iModifiedById;
    }

    public function getiRejectedById() {
        return $this->_iRejectedById;
    }

    public function getiVerifiedBy() {
        return $this->_iVerifiedBy;
    }

    public function geteFrom() {
        return $this->_eFrom;
    }

    public function geteSaved() {
        return $this->_eSaved;
    }

    public function geteDelete() {
        return $this->_eDelete;
    }

    public function geteAuctionStatus() {
        return $this->_eAuctionStatus;
    }

    /**
     *   @desc   SETTER METHODS
     */
    public function setiRFQ2Id($val) {
        $this->_iRFQ2Id = $val;
    }

    public function setvRFQ2Code($val) {
        $this->_vRFQ2Code = $val;
    }

    public function setvRFQ2No($val) {
        $this->_vRFQ2No = $val;
    }

    public function setiUserID($val) {
        $this->_iUserID = $val;
    }

    public function setiOrganizationID($val) {
        $this->_iOrganizationID = $val;
    }

    public function setiInvoiceID($val) {
        $this->_iInvoiceID = $val;
    }

    public function setiPurchaseOrderID($val) {
        $this->_iPurchaseOrderID = $val;
    }

    public function seteCreatedBy($val) {
        $this->_eCreatedBy = $val;
    }

    public function seteAuctionType($val) {
        $this->_eAuctionType = $val;
    }

    public function setdStartDate($val) {
        $this->_dStartDate = $val;
    }

    public function setdEndDate($val) {
        $this->_dEndDate = $val;
    }

    public function settInstruction($val) {
        $this->_tInstruction = $val;
    }

    public function settDescription($val) {
        $this->_tDescription = $val;
    }

    public function setfBuyOutAdvance($val) {
        $this->_fBuyOutAdvance = $val;
    }

    public function setfBuyOutPrice($val) {
        $this->_fBuyOutPrice = $val;
    }

    public function setiDays($val) {
        $this->_iDays = $val;
    }

    public function setfAdvanceMinPc($val) {
        $this->_fAdvanceMinPc = $val;
    }

    public function setfAdvanceMinAmt($val) {
        $this->_fAdvanceMinAmt = $val;
    }

    public function setfAdvanceMaxPc($val) {
        $this->_fAdvanceMaxPc = $val;
    }

    public function setfAdvanceMaxAmt($val) {
        $this->_fAdvanceMaxAmt = $val;
    }

    public function setfPriceMinPc($val) {
        $this->_fPriceMinPc = $val;
    }

    public function setfPriceMinAmt($val) {
        $this->_fPriceMinAmt = $val;
    }

    public function setfPriceMaxPc($val) {
        $this->_fPriceMaxPc = $val;
    }

    public function setfPriceMaxAmt($val) {
        $this->_fPriceMaxAmt = $val;
    }

    public function setfAdvanceTotal($val) {
        $this->_fAdvanceTotal = $val;
    }

    public function setfPriceTotal($val) {
        $this->_fPriceTotal = $val;
    }

    public function setfTotal($val) {
        $this->_fTotal = $val;
    }

    public function setfIntervalPrice($val) {
        $this->_fIntervalPrice = $val;
    }

    public function setfBestBidAdvance($val) {
        $this->_fBestBidAdvance = $val;
    }

    public function setfBestBidPrice($val) {
        $this->_fBestBidPrice = $val;
    }

    public function setfBestBidAmount($val) {
        $this->_fBestBidAmount = $val;
    }

    public function setfPOAwardAdvace($val) {
        $this->_fPOAwardAdvace = $val;
    }

    public function setfPOAwardPrice($val) {
        $this->_fPOAwardPrice = $val;
    }

    public function setfPOAwardAmount($val) {
        $this->_fPOAwardAmount = $val;
    }

    public function setiEndAfterHrs($val) {
        $this->_iEndAfterHrs = $val;
    }

    public function setiEndAfterMin($val) {
        $this->_iEndAfterMin = $val;
    }

    public function seteInstantStart($val) {
        $this->_eInstantStart = $val;
    }

    public function seteRelativeEndTime($val) {
        $this->_eRelativeEndTime = $val;
    }

    public function seteAutoBid($val) {
        $this->_eAutoBid = $val;
    }

    public function seteBidCriteria($val) {
        $this->_eBidCriteria = $val;
    }

    public function settReasonToReject($val) {
        $this->_tReasonToReject = $val;
    }

    public function setdADate($val) {
        $this->_dADate = $val;
    }

    public function setvFromIP($val) {
        $this->_vFromIP = $val;
    }

    public function setiStatusID($val) {
        $this->_iStatusID = $val;
    }

    public function setiModifiedById($val) {
        $this->_iModifiedById = $val;
    }

    public function setiRejectedById($val) {
        $this->_iRejectedById = $val;
    }

    public function setiVerifiedBy($val) {
        $this->_iVerifiedBy = $val;
    }

    public function seteFrom($val) {
        $this->_eFrom = $val;
    }

    public function seteSaved($val) {
        $this->_eSaved = $val;
    }

    public function seteDelete($val) {
        $this->_eDelete = $val;
    }

    public function seteAuctionStatus($val) {
        $this->_eAuctionStatus = $val;
    }

    /**
     *   @desc   SELECT METHOD / LOAD
     */
    function select($id) {
        if (($id > 0) && (trim($id) != '')) {
            $sql = "SELECT * FROM " . PRJ_DB_PREFIX . "_rfq2_master WHERE iRFQ2Id = $id";
        } else {
            $sql = "SELECT * FROM " . PRJ_DB_PREFIX . "_rfq2_master WHERE iRFQ2Id=$this->_iRFQ2Id ";
        }
        $row = $this->_obj->MySQLSelect($sql);

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
        $this->_iDays = $row[0]['iDays'];
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
    function delete($id) {
        $sql = "DELETE FROM " . PRJ_DB_PREFIX . "_rfq2_master WHERE iRFQ2Id = $id";
        return $result = $this->_obj->sql_query($sql);
    }

    /**
     *   @desc   INSERT
     */
    function insert($Data = Array()) {
        $this->_iRFQ2Id = '';
        $this->iRFQ2Id = ""; // clear key for autoincrement
        if (!is_array($Data) || count($Data) < 1) {
            $Data = array(
                'vRFQ2Code' => $this->_vRFQ2Code,
                'vRFQ2No' => $this->_vRFQ2No,
                'iUserID' => $this->_iUserID,
                'iOrganizationID' => $this->_iOrganizationID,
                'iInvoiceID' => $this->_iInvoiceID,
                'iPurchaseOrderID' => $this->_iPurchaseOrderID,
                'eCreatedBy' => $this->_eCreatedBy,
                'eAuctionType' => $this->_eAuctionType,
                'dStartDate' => $this->_dStartDate,
                'dEndDate' => $this->_dEndDate,
                'tInstruction' => $this->_tInstruction,
                'tDescription' => $this->_tDescription,
                'fBuyOutAdvance' => $this->_fBuyOutAdvance,
                'fBuyOutPrice' => $this->_fBuyOutPrice,
                'iDays' => $this->_iDays,
                'fAdvanceMinPc' => $this->_fAdvanceMinPc,
                'fAdvanceMinAmt' => $this->_fAdvanceMinAmt,
                'fAdvanceMaxPc' => $this->_fAdvanceMaxPc,
                'fAdvanceMaxAmt' => $this->_fAdvanceMaxAmt,
                'fPriceMinPc' => $this->_fPriceMinPc,
                'fPriceMinAmt' => $this->_fPriceMinAmt,
                'fPriceMaxPc' => $this->_fPriceMaxPc,
                'fPriceMaxAmt' => $this->_fPriceMaxAmt,
                'fAdvanceTotal' => $this->_fAdvanceTotal,
                'fPriceTotal' => $this->_fPriceTotal,
                'fTotal' => $this->_fTotal,
                'fIntervalPrice' => $this->_fIntervalPrice,
                'fBestBidAdvance' => $this->_fBestBidAdvance,
                'fBestBidPrice' => $this->_fBestBidPrice,
                'fBestBidAmount' => $this->_fBestBidAmount,
                'fPOAwardAdvace' => $this->_fPOAwardAdvace,
                'fPOAwardPrice' => $this->_fPOAwardPrice,
                'fPOAwardAmount' => $this->_fPOAwardAmount,
                'iEndAfterHrs' => $this->_iEndAfterHrs,
                'iEndAfterMin' => $this->_iEndAfterMin,
                'eInstantStart' => $this->_eInstantStart,
                'eRelativeEndTime' => $this->_eRelativeEndTime,
                'eAutoBid' => $this->_eAutoBid,
                'eBidCriteria' => $this->_eBidCriteria,
                'tReasonToReject' => $this->_tReasonToReject,
                'dADate' => $this->_dADate,
                'vFromIP' => $this->_vFromIP,
                'iStatusID' => $this->_iStatusID,
                'iModifiedById' => $this->_iModifiedById,
                'iRejectedById' => $this->_iRejectedById,
                'iVerifiedBy' => $this->_iVerifiedBy,
                'eFrom' => $this->_eFrom,
                'eSaved' => $this->_eSaved,
                'eDelete' => $this->_eDelete,
                'eAuctionStatus' => $this->_eAuctionStatus
            );
        }
        $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX . "_rfq2_master", $Data, 'insert');
        return $result;
    }

    /**
     *   @desc   UPDATE
     */
    function update($where) {

        $Data = array(
            'vRFQ2Code' => $this->_vRFQ2Code,
            'vRFQ2No' => $this->_vRFQ2No,
            'iUserID' => $this->_iUserID,
            'iOrganizationID' => $this->_iOrganizationID,
            'iInvoiceID' => $this->_iInvoiceID,
            'iPurchaseOrderID' => $this->_iPurchaseOrderID,
            'eCreatedBy' => $this->_eCreatedBy,
            'eAuctionType' => $this->_eAuctionType,
            'dStartDate' => $this->_dStartDate,
            'dEndDate' => $this->_dEndDate,
            'tInstruction' => $this->_tInstruction,
            'tDescription' => $this->_tDescription,
            'fBuyOutAdvance' => $this->_fBuyOutAdvance,
            'fBuyOutPrice' => $this->_fBuyOutPrice,
            'iDays' => $this->_iDays,
            'fAdvanceMinPc' => $this->_fAdvanceMinPc,
            'fAdvanceMinAmt' => $this->_fAdvanceMinAmt,
            'fAdvanceMaxPc' => $this->_fAdvanceMaxPc,
            'fAdvanceMaxAmt' => $this->_fAdvanceMaxAmt,
            'fPriceMinPc' => $this->_fPriceMinPc,
            'fPriceMinAmt' => $this->_fPriceMinAmt,
            'fPriceMaxPc' => $this->_fPriceMaxPc,
            'fPriceMaxAmt' => $this->_fPriceMaxAmt,
            'fAdvanceTotal' => $this->_fAdvanceTotal,
            'fPriceTotal' => $this->_fPriceTotal,
            'fTotal' => $this->_fTotal,
            'fIntervalPrice' => $this->_fIntervalPrice,
            'fBestBidAdvance' => $this->_fBestBidAdvance,
            'fBestBidPrice' => $this->_fBestBidPrice,
            'fBestBidAmount' => $this->_fBestBidAmount,
            'fPOAwardAdvace' => $this->_fPOAwardAdvace,
            'fPOAwardPrice' => $this->_fPOAwardPrice,
            'fPOAwardAmount' => $this->_fPOAwardAmount,
            'iEndAfterHrs' => $this->_iEndAfterHrs,
            'iEndAfterMin' => $this->_iEndAfterMin,
            'eInstantStart' => $this->_eInstantStart,
            'eRelativeEndTime' => $this->_eRelativeEndTime,
            'eAutoBid' => $this->_eAutoBid,
            'eBidCriteria' => $this->_eBidCriteria,
            'tReasonToReject' => $this->_tReasonToReject,
            'dADate' => $this->_dADate,
            'vFromIP' => $this->_vFromIP,
            'iStatusID' => $this->_iStatusID,
            'iModifiedById' => $this->_iModifiedById,
            'iRejectedById' => $this->_iRejectedById,
            'iVerifiedBy' => $this->_iVerifiedBy,
            'eFrom' => $this->_eFrom,
            'eSaved' => $this->_eSaved,
            'eDelete' => $this->_eDelete,
            'eAuctionStatus' => $this->_eAuctionStatus
        );

        $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX . "_rfq2_master", $Data, 'update', $where);
        return $result;
    }

    function updateData($data, $where) {
        $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX . "_rfq2_master", $data, "update", $where);
        return $result;
    }

    /**
     *   @desc   SET ALL VARIABLE
     */
    function setAllVar($Data = array()) {
        $MethodArr = get_class_methods($this);
        if (count($Data) > 0) {
            foreach ($Data AS $KEY => $VAL) {
                $method = "set" . $KEY;
                if (in_array($method, $MethodArr)) {
                    @call_user_method($method, $this, $VAL);
                }
            }
        } else {
            foreach ($_REQUEST AS $KEY => $VAL) {
                $method = "set" . $KEY;
                if (in_array($method, $MethodArr)) {
                    @call_user_method($method, $this, $VAL);
                }
            }
        }
    }

    /**
     *   @desc   GET ALL VARIABLE
     */
    function getAllVar() {
        $MethodArr = get_class_methods($this);
        $method_notArr = Array('getAllVar');
        $evalStr = '';
        for ($i = 0; $i < count($MethodArr); $i++) {
            if (substr($MethodArr[$i], 0, 3) == 'get' && (!(in_array($MethodArr[$i], $method_notArr)))) {
                $var_name = substr($MethodArr[$i], 3);
                $evalStr.= 'global $' . $var_name . '; $' . $var_name . ' = $this->' . $MethodArr[$i] . "();";
            }
        }
        eval($evalStr);
    }

    /**
     *   @desc   GET DETAILS
     */
    function getDetails($feild = "*", $where = "", $orderBy = "", $groupBy = "", $limit = "") {
        $cnt = "";
        if ($where != "") {
            $cnt = " Where 1 " . $where;
        }
        if ($groupBy != "") {
            $cnt .= " Group By " . $groupBy;
        }
        if ($orderBy != "") {
            $cnt .= " Order By " . $orderBy;
        }
        $sql = "SELECT $feild FROM " . PRJ_DB_PREFIX . "_rfq2_master rfq2 $cnt $limit";
        $row = $this->_obj->MySQLSelect($sql);
        return $row;
    }

    /**
     *   @desc   GET DETAILS WITH PAGING AND JOINED TABLE IF REQUIRED
     */
    function getJoinTableInfo($jtbl, $fields = "*", $where = "", $orderBy = "", $groupBy = "", $limit = "", $pg = "") {
        $cnt = "";
        $cnt_count = "";
        if ($where != "") {
            $cnt = " Where 1 " . $where;
            $cnt_count = " Where 1 " . $where;
        }
        if ($groupBy != "") {
            $cnt .= " Group By " . $groupBy;
            $cnt_count .= " Group By " . $groupBy;
        }
        if ($orderBy != "") {
            $cnt .= " Order By " . $orderBy;
        }

        $sql = "SELECT $fields FROM " . PRJ_DB_PREFIX . "_rfq2_master rfq2 $jtbl $cnt $limit";
        // echo $sql; // exit;
        $row = $this->_obj->MySQLSelect($sql);
        if ($pg == "yes") {
            if ($groupBy != "") {
                if (stripos($fields, 'distinct') !== false) {
                    $fields = str_ireplace('distinct', '', $fields);
                }
                $fields = "Count(*) as tot, $fields";
            }
            $sql_count = "SELECT Count(*) as tot, $fields FROM " . PRJ_DB_PREFIX . "_rfq2_master rfq2 $jtbl $cnt_count";
            $row_count = $this->_obj->MySQLSelect($sql_count);
            $row['tot'] = $row_count[0]['tot'];
            if ($groupBy != "") {
                $row['tot'] = @ count($row_count);
            }
        }
        return $row;
    }

    function getUniqueCode($type = '') {
        $sql = "Select COUNT(*) as tot from " . PRJ_DB_PREFIX . "_rfq2_master where dCreatedDate>'" . date('Y-m-d') . "'";
        // echo $sql; exit;
        $rw = $this->_obj->MySQLSelect($sql);
        $num = ($rw[0]['tot'] + 1);
        if ($num < 10) {
            $num = '000' . $num;
        } else if ($num < 100) {
            $num = '00' . $num;
        } else if ($num < 1000) {
            $num = '0' . $num;
        }
        /* $t=0;
          if($type == 'Buyer') {
          $t=1;
          } else if($type == 'Supplier') {
          $t=2;
          } else if($type == 'Both') {
          $t=3;
          } */
        $code = '001' . date('ymd') . $type . $num;
        // echo $code; exit;
        return $code;
    }

    function getRfq2Files($irfq2id) {
        $dtls = array();
        if (trim($irfq2id) != '' && $irfq2id > 0) {
            $sql = "SELECT * FROM " . PRJ_DB_PREFIX . "_rfq2_files where iRFQ2Id=$irfq2id";
            $dtls = $this->_obj->MySQLSelect($sql);
        }
        return $dtls;
    }

    function getRfq2Product($irfq2id) {
        $dtls = array();
        if (trim($irfq2id) != '' && $irfq2id > 0) {
            $sql = "SELECT DISTINCT
						IF(ePType='BProduct',
						(SELECT vProductName FROM " . PRJ_DB_PREFIX . "_bproduct_organization WHERE iProductId=rpb2.iProductId),
						(SELECT vProductName FROM " . PRJ_DB_PREFIX . "_sproduct_organization WHERE iProductId=rpb2.iProductId)
						) AS vProductName,
						IF(ePType='BProduct',
						(SELECT vProductCode FROM " . PRJ_DB_PREFIX . "_bproduct_organization WHERE iProductId=rpb2.iProductId),
						(SELECT vProductCode FROM " . PRJ_DB_PREFIX . "_sproduct_organization WHERE iProductId=rpb2.iProductId)
						) AS vProductCode, iProductId, ePType
						FROM " . PRJ_DB_PREFIX . "_rfq2_product_buyer2 rpb2 where iRFQ2Id=$irfq2id ";
            $dtls = $this->_obj->MySQLSelect($sql);
        }
        return $dtls;
    }

    function getRfq2PB2Asoc($irfq2id) {
        $dtls = array();
        if (trim($irfq2id) != '' && $irfq2id > 0) {
            $sql = "SELECT * FROM " . PRJ_DB_PREFIX . "_rfq2_product_buyer2 where iRFQ2Id=$irfq2id";
            $dtls = $this->_obj->MySQLSelect($sql);
        }
        return $dtls;
    }

    function getRfq2B2($irfq2id) {
        $dtls = array();
        if (trim($irfq2id) != '' && $irfq2id > 0) {
            $sql = "SELECT orgm.iOrganizationID, orgm.vCompanyName, orgm.vOrganizationCode, rpb2.iProductId, rpb2.ePType FROM " . PRJ_DB_PREFIX . "_organization_master orgm LEFT JOIN " . PRJ_DB_PREFIX . "_rfq2_product_buyer2 rpb2 ON orgm.iOrganizationID=rpb2.iBuyer2Id WHERE orgm.eOrganizationType='Buyer2' AND rpb2.iRFQ2Id=$irfq2id";
            // $sql = "Select * from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID IN (SELECT iBuyer2Id FROM ".PRJ_DB_PREFIX."_rfq2_product_buyer2 where iRFQ2Id=$irfq2id) AND eOrganizationType='Buyer2'";
            // echo $sql; exit;
            $dtls = $this->_obj->MySQLSelect($sql);
        }
        return $dtls;
    }

    function getHistory($iRFQ2Id, $orgid = 0) {
        $oc = "";
        if ($orgid > 0) {
            $oc = " iOrganizationID = $orgid AND ";
        }
        $sql = "Select iVerifiedID,iItemID,eSubject,eType,vAction,vMailSubject_en,iOrganizationID,iCreatedBy,eCreatedType,eVerifiedBy,iVerifiedBy,dActionDate,dVerifyDate,vVerifyFromIP from " . PRJ_DB_PREFIX . "_user_action_verification where $oc iItemID=$iRFQ2Id AND eSubject='RFQ2' Order By dActionDate ASC ";
        // echo $sql; exit;
        $dtls = $this->_obj->MySQLSelect($sql);
        for ($l = 0; $l < count($dtls); $l++) {
            $sql = "Select CONCAT(vFirstName,' ',vLastName) as name from " . PRJ_DB_PREFIX . "_organization_user where iUserID=" . $dtls[$l]['iCreatedBy'];
            $cusr = $this->_obj->MySQLSelect($sql);
            $dtls[$l]['createdby'] = $cusr[0]['name'];
            $sql = "Select CONCAT(vFirstName,' ',vLastName) as name from " . PRJ_DB_PREFIX . "_organization_user where iUserID=" . $dtls[$l]['iVerifiedBy'];
            $cusr = $this->_obj->MySQLSelect($sql);
            $dtls[$l]['verifiedby'] = $cusr[0]['name'];
        }
        return $dtls;
    }

    function getB2Rfq2Status($id) {
        $sts = "";
        if ($id > 0) {
            /* $dtls = $this->select($id);
              if(is_array($dtls) && count($dtls[0])>0)
              {
              if(strtolower($dtls[0]['eAuctionStatus'])=='completed' || strtolower($dtls[0]['eAuctionStatus'])=='cancelled') {
              $sts = strtolower($dtls[0]['eAuctionStatus']);
              } else if((strtotime(date('Y-m-d'))-strtotime($dtls[0]['dStartDate']) > 0) && (strtotime($dtls[0]['dEndDate'])-strtotime(date('Y-m-d')) > 0) && strtolower($dtls[0]['eAuctionStatus'])=='not started') {
              $sts = "live";
              } else if(strtotime(date('Y-m-d')-strtotime($dtls[0]['dStartDate'])) > 0) {
              $sts = "notstarted";
              } else {
              $sts = strtolower($dtls[0]['eAuctionStatus']);
              }
              } */
            $sql = "Select IF(rfq2.eAuctionStatus='Completed' || rfq2.eAuctionStatus='Cancelled', rfq2.eAuctionStatus, IF(rfq2.dStartDate<NOW() AND rfq2.dEndDate>NOW(),'Live', IF(rfq2.dStartDate>NOW() AND rfq2.dEndDate>NOW(),'Not Started', rfq2.eAuctionStatus)) ) as eStatus from " . PRJ_DB_PREFIX . "_rfq2_master rfq2 where iRFQ2Id=$id";
            // echo $sql; exit;
            $dtls = $this->_obj->MySQLSelect($sql);
            $sts = (isset($dtls[0]['eStatus'])) ? $dtls[0]['eStatus'] : '';
        }
        //
        return strtolower($sts);
    }

    function setAllRfq2Ststus() {
        $sql = "Update " . PRJ_DB_PREFIX . "_rfq2_master set eAuctionStatus='Live' where eSaved!='Yes' AND eDelete='No' AND eAuctionStatus NOT IN ('Live','Completed','Cancelled') AND iStatusID=(Select iStatusID from " . PRJ_DB_PREFIX . "_status_master where vForAuction LIKE 'RFQ2,%' AND vStatus_en='Verify') AND dStartDate < Now() AND dEndDate > Now()";
        $rs = $this->_obj->sql_query($sql);
        $sql = "Update " . PRJ_DB_PREFIX . "_rfq2_master set eAuctionStatus='Completed' where eSaved!='Yes' AND eDelete='No' AND eAuctionStatus NOT IN ('Completed','Cancelled') AND iStatusID=(Select iStatusID from " . PRJ_DB_PREFIX . "_status_master where vForAuction LIKE 'RFQ2,%' AND vStatus_en='Verify') AND dStartDate < Now() AND dEndDate < Now()";
        $rs = $this->_obj->sql_query($sql);
        return $rs;
    }

    function iacalcRfq2Amount($ary) {
        $rfq2amount = 0;
        if (isset($ary['fAdvanceTotal']) && isset($ary['fPriceTotal']) && $ary['fAdvanceTotal'] > 0 && $ary['fPriceTotal'] > 0) {
            $ary['fTotal'] = $rfq2amount = (float) ( ((float) $ary['fAdvanceTotal'] + (float) $ary['fPriceTotal']) / 2 );
        } else if (isset($ary['iInvoiceID']) && $ary['iInvoiceID'] > 0 && ($ary['fAdvanceMinPc'] > 0 || $ary['fAdvanceMinAmt'] > 0) && ($ary['fPriceMaxPc'] > 0 || $ary['fPriceMaxAmt'] > 0)) {
            $sql = "Select io.fAcceptedAmount from " . PRJ_DB_PREFIX . "_inovice_order_heading io where io.iInvoiceID=" . $ary['iInvoiceID'] . "";
            $iamt = $this->_obj->MySQLSelect($sql);
            $ipaam = $iamt[0]['fAcceptedAmount'];
            $advance = 0;
            $price = 0;
            if (trim($ipaam) != '' && $ipaam > 0) {
                if ($ary['fAdvanceMinPc'] > 0) {
                    $ary['fAdvanceMinAmt'] = (float) ($ipaam * $ary['fAdvanceMinPc'] / 100);
                    $ary['fAdvanceTotal'] = $advance = $ipaam + $ary['fAdvanceMinAmt'];
                } else if ($ary['fAdvanceMinAmt'] > 0) {
                    $ary['fAdvanceMinPc'] = (float) ($ary['fAdvanceMinAmt'] * 100 / $ipaam);
                    $ary['fAdvanceTotal'] = $advance = $ipaam + $ary['fAdvanceMinAmt'];
                }
                if ($ary['fPriceMaxPc'] > 0) {
                    $ary['fPriceMaxAmt'] = (float) ($ipaam * $ary['fPriceMaxPc'] / 100);
                    $ary['fPriceTotal'] = $price = $ipaam + $ary['fPriceMaxAmt'];
                } else if ($ary['fPriceMaxAmt'] > 0) {
                    $ary['fPriceMaxPc'] = (float) ($ary['fPriceMaxAmt'] * 100 / $ipaam);
                    $ary['fPriceTotal'] = $price = $ipaam + $ary['fPriceMaxAmt'];
                }
            }
            if ($advance > 0 && $price > 0) {
                $ary['fTotal'] = $rfq2amount = (float) ( ((float) $advance + (float) $price) / 2 );
            }
        }
        return $ary;
    }

    function chkAutoAcptLimit($id) {
        $aacptl['chk'] = 'n';
        $curORGID = (isset($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGID'])) ? $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGID'] : '0';
        // echo $curORGID; exit;
        $dtls = $this->select($id);
        // $r2pb2_dtls = $this->getRfq2Product($id);
        // $r2pb2_dtls = $this->getRfq2B2($id);
        $r2pb2_dtls = $this->getRfq2PB2Asoc($id);
        // pr($r2pb2_dtls); exit;
        if (is_array($r2pb2_dtls) && count($r2pb2_dtls) == 1 && isset($r2pb2_dtls[0]['iAssociationId']) && $r2pb2_dtls[0]['iAssociationId'] > 0 && $curORGID > 0) {
            if (isset($r2pb2_dtls[0]['iProductId']) && $r2pb2_dtls[0]['iProductId'] > 0 && isset($r2pb2_dtls[0]['iBuyer2Id']) && $r2pb2_dtls[0]['iBuyer2Id'] > 0 && $r2pb2_dtls[0]['ePType'] != '') {
                $tbl = '';
                $fld = '';
                if (strtolower($r2pb2_dtls[0]['ePType']) == 'sproduct') {
                    $tbl = PRJ_DB_PREFIX . "_buyer2_supplier_sproduct_association";
                    $fld = 'iSupplierId';
                } else if (strtolower($r2pb2_dtls[0]['ePType']) == 'bproduct') {
                    $tbl = PRJ_DB_PREFIX . "_buyer2_buyer_bproduct_association";
                    $fld = 'iBuyerId';
                }
                if ($tbl != '' && $fld != '') {
                    $sql = "Select fAutoAcceptLimit, iBuyer2Id, fAutoAcceptAdvance, fAutoAcceptPrice, iDays from $tbl where $fld=$curORGID AND iProductId=" . $r2pb2_dtls[0]['iProductId'] . " AND iBuyer2Id=" . $r2pb2_dtls[0]['iBuyer2Id'] . "";  // iAssociationId=".$r2pb2_dtls[0]['iAssociationId']." AND
                    $adtl = $this->_obj->MySQLSelect($sql);
                    // pr($adtl); exit;
                    // pr($dtls); exit;
                    $ec = "0";
                    if ($adtl[0]['fAutoAcceptAdvance'] > 0) {
                        $ec = ($dtls[0]['fAdvanceMinPc'] <= $adtl[0]['fAutoAcceptAdvance']) ? '1' : '0';
                    }
                    if ($adtl[0]['fAutoAcceptPrice'] > 0) {
                        $ec = ($dtls[0]['fPriceMaxPc'] >= $adtl[0]['fAutoAcceptPrice']) ? '1' : '0';                        
                    }
                    if ($adtl[0]['iDays'] > 0) {
                        $ec = ($dtls[0]['iDays'] <= $adtl[0]['iDays']) ? '1' : '0';                        
                    }
                    
                    if (isset($adtl[0]['fAutoAcceptLimit']) && $adtl[0]['fAutoAcceptLimit'] > 0 && $dtls[0]['fTotal'] <= $adtl[0]['fAutoAcceptLimit'] && $ec == "1") {
                        $aacptl['chk'] = 'y';
                        $aacptl['fBidAdvancePc'] = $dtls[0]['fAdvanceMinPc'];
                        $aacptl['fBidAdvanceAmt'] = $dtls[0]['fAdvanceMinAmt'];
                        $aacptl['fBidPricePc'] = $dtls[0]['fPriceMaxPc'];
                        $aacptl['fBidPriceAmt'] = $dtls[0]['fPriceMaxAmt'];
                        $aacptl['fBidAdvanceTotal'] = $dtls[0]['fAdvanceTotal'];
                        $aacptl['fBidPriceTotal'] = $dtls[0]['fPriceTotal'];
                        $aacptl['bidamount'] = $dtls[0]['fTotal'];
                        $aacptl['iBuyer2Id'] = $r2pb2_dtls[0]['iBuyer2Id'];
                    }
                }
            }
        }
        # pr($aacptl); exit;
        return $aacptl;
    }

    function getR2InvOrgType($orgid, $rfq2id, $eFrom = "Invoice") {
        if ($eFrom == "PO") {
            $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading ioh on ioh.iPurchaseOrderID=rfq2.iPurchaseOrderID ";
        } else {
            $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ioh on ioh.iInvoiceID=rfq2.iInvoiceID ";
        }
        $dtls = $this->getJoinTableInfo($jtbl, " IF(ioh.iBuyerOrganizationID=" . $orgid . ", 'Buyer', IF(ioh.iSupplierOrganizationID=" . $orgid . ", 'Supplier', '') ) as eOrgType", " AND rfq2.iOrganizationID=$orgid AND rfq2.iRFQ2Id=$rfq2id ");
        // pr($dtls); exit;
        return $dtls[0]['eOrgType'];
    }

    function getCurrentBestBid($rfq2id) {
        $bestbid_id = 0;
        $sql = "Select * from " . PRJ_DB_PREFIX . "_rfq2_bids where iRFQ2Id=$rfq2id AND eStatus='current'";
        $dtls = $this->_obj->MySQLSelect($sql);
        $len = @ count($dtls);
        if (is_array($dtls) && $len > 0) {
            if ($len == 1) {
                $bestbid_id = $dtls[0]['iBidId'];
            } else if ($len > 1) {
                $vl_ary = @ multi21Array($dtls, 'fBidAmount');
                $mxvl = max($vl_ary);
                for ($l = 0; $l < $len; $l++) {
                    if ($mxvl == $dtls[0]['fBidAmount']) {
                        $bestbid_id = $dtls[0]['iBidId'];
                    }
                }
            }
        }
        // pr($bestbid_id); exit;
        return $bestbid_id;
    }

    function clearRfq2NAssoc($id) {
        $sql = "Delete rfq2, r2pb from " . PRJ_DB_PREFIX . "_rfq2_master rfq2 LEFT JOIN " . PRJ_DB_PREFIX . "_rfq2_product_buyer2 r2pb ON rfq2.iRFQ2Id=r2pb.iRFQ2Id where rfq2.iRFQ2Id=$id";
        $rs = $this->_obj->sql_query($sql);
        return $rs;
    }

}

?>