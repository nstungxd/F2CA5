<?php
/**
* -------------------------------------------------------
* CLASSNAME:        Rfq2Bids
* GENERATION DATE:  15.04.2011
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.Rfq2Bids.php
* FOR MYSQL TABLE:  b2b_rfq2_bids
* FOR MYSQL DB:     B2B_Auction
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class Rfq2Bids
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iBidId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iBidId;
	protected $_iRFQ2Id;
	protected $_iBuyer2Id;
	protected $_vBidCode;
	protected $_vBidNum;
	protected $_eBidType;
	protected $_fBidAdvancePc;
	protected $_fBidAdvanceAmt;
	protected $_fBidPricePc;
	protected $_fBidPriceAmt;
	protected $_fBidAdvanceTotal;
	protected $_fBidPriceTotal;
	protected $_fBidAmount;
	protected $_dBidDate;
	protected $_iCreatedById;
	protected $_iModifiedById;
	protected $_iRejectedBy;
	protected $_iVerifiedById;
	protected $_tReasonToReject;
	protected $_eSaved;
	protected $_eDelete;
	protected $_iStatusID;
	protected $_eStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iBidId = null;
		$this->_iRFQ2Id = null;
		$this->_iBuyer2Id = null;
		$this->_vBidCode = null;
		$this->_vBidNum = null;
		$this->_eBidType = null;
		$this->_fBidAdvancePc = null;
		$this->_fBidAdvanceAmt = null;
		$this->_fBidPricePc = null;
		$this->_fBidPriceAmt = null;
		$this->_fBidAdvanceTotal = null;
		$this->_fBidPriceTotal = null;
		$this->_fBidAmount = null;
		$this->_dBidDate = null;
		$this->_iCreatedById = null;
		$this->_iModifiedById = null;
		$this->_iRejectedBy = null;
		$this->_iVerifiedById = null;
		$this->_tReasonToReject = null;
		$this->_eSaved = null;
		$this->_eDelete = null;
		$this->_iStatusID = null;
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


	public function getiBidId()
	{
		return $this->_iBidId;
	}

	public function getiRFQ2Id()
	{
		return $this->_iRFQ2Id;
	}

	public function getiBuyer2Id()
	{
		return $this->_iBuyer2Id;
	}

	public function getvBidCode()
	{
		return $this->_vBidCode;
	}

	public function getvBidNum()
	{
		return $this->_vBidNum;
	}

	public function geteBidType()
	{
		return $this->_eBidType;
	}

	public function getfBidAdvancePc()
	{
		return $this->_fBidAdvancePc;
	}

	public function getfBidAdvanceAmt()
	{
		return $this->_fBidAdvanceAmt;
	}

	public function getfBidPricePc()
	{
		return $this->_fBidPricePc;
	}

	public function getfBidPriceAmt()
	{
		return $this->_fBidPriceAmt;
	}

	public function getfBidAdvanceTotal()
	{
		return $this->_fBidAdvanceTotal;
	}

	public function getfBidPriceTotal()
	{
		return $this->_fBidPriceTotal;
	}

	public function getfBidAmount()
	{
		return $this->_fBidAmount;
	}

	public function getdBidDate()
	{
		return $this->_dBidDate;
	}

	public function getiCreatedById()
	{
		return $this->_iCreatedById;
	}

	public function getiModifiedById()
	{
		return $this->_iModifiedById;
	}

	public function getiRejectedBy()
	{
		return $this->_iRejectedBy;
	}

	public function getiVerifiedById()
	{
		return $this->_iVerifiedById;
	}

	public function gettReasonToReject()
	{
		return $this->_tReasonToReject;
	}

	public function geteSaved()
	{
		return $this->_eSaved;
	}

	public function geteDelete()
	{
		return $this->_eDelete;
	}

	public function getiStatusID()
	{
		return $this->_iStatusID;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiBidId($val)
	{
		 $this->_iBidId =  $val;
	}

	public function setiRFQ2Id($val)
	{
		 $this->_iRFQ2Id =  $val;
	}

	public function setiBuyer2Id($val)
	{
		 $this->_iBuyer2Id =  $val;
	}

	public function setvBidCode($val)
	{
		 $this->_vBidCode =  $val;
	}

	public function setvBidNum($val)
	{
		 $this->_vBidNum =  $val;
	}

	public function seteBidType($val)
	{
		 $this->_eBidType =  $val;
	}

	public function setfBidAdvancePc($val)
	{
		 $this->_fBidAdvancePc =  $val;
	}

	public function setfBidAdvanceAmt($val)
	{
		 $this->_fBidAdvanceAmt =  $val;
	}

	public function setfBidPricePc($val)
	{
		 $this->_fBidPricePc =  $val;
	}

	public function setfBidPriceAmt($val)
	{
		 $this->_fBidPriceAmt =  $val;
	}

	public function setfBidAdvanceTotal($val)
	{
		 $this->_fBidAdvanceTotal =  $val;
	}

	public function setfBidPriceTotal($val)
	{
		 $this->_fBidPriceTotal =  $val;
	}

	public function setfBidAmount($val)
	{
		 $this->_fBidAmount =  $val;
	}

	public function setdBidDate($val)
	{
		 $this->_dBidDate =  $val;
	}

	public function setiCreatedById($val)
	{
		 $this->_iCreatedById =  $val;
	}

	public function setiModifiedById($val)
	{
		 $this->_iModifiedById =  $val;
	}

	public function setiRejectedBy($val)
	{
		 $this->_iRejectedBy =  $val;
	}

	public function setiVerifiedById($val)
	{
		 $this->_iVerifiedById =  $val;
	}

	public function settReasonToReject($val)
	{
		 $this->_tReasonToReject =  $val;
	}

	public function seteSaved($val)
	{
		 $this->_eSaved =  $val;
	}

	public function seteDelete($val)
	{
		 $this->_eDelete =  $val;
	}

	public function setiStatusID($val)
	{
		 $this->_iStatusID =  $val;
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
			$sql =  "SELECT *, ".PRJ_DB_PREFIX."_rfq2_master.vRFQ2Code FROM ".PRJ_DB_PREFIX."_rfq2_bids LEFT JOIN ".PRJ_DB_PREFIX."_rfq2_master on ".PRJ_DB_PREFIX."_rfq2_bids.iRFQ2Id = ".PRJ_DB_PREFIX."_rfq2_master.iRFQ2Id WHERE iBidId = $id";
		} else {
			$sql =  "SELECT *, ".PRJ_DB_PREFIX."_rfq2_master.vRFQ2Code FROM ".PRJ_DB_PREFIX."_rfq2_bids LEFT JOIN ".PRJ_DB_PREFIX."_rfq2_master on ".PRJ_DB_PREFIX."_rfq2_bids.iRFQ2Id = ".PRJ_DB_PREFIX."_rfq2_master.iRFQ2Id WHERE iBidId=$this->_iBidId ";
		}
		$row =  $this->_obj->MySQLSelect($sql);

		$this->_iBidId = $row[0]['iBidId'];
		$this->_iRFQ2Id = $row[0]['iRFQ2Id'];
		$this->_iBuyer2Id = $row[0]['iBuyer2Id'];
		$this->_vBidCode = $row[0]['vBidCode'];
		$this->_vBidNum = $row[0]['vBidNum'];
		$this->_eBidType = $row[0]['eBidType'];
		$this->_fBidAdvancePc = $row[0]['fBidAdvancePc'];
		$this->_fBidAdvanceAmt = $row[0]['fBidAdvanceAmt'];
		$this->_fBidPricePc = $row[0]['fBidPricePc'];
		$this->_fBidPriceAmt = $row[0]['fBidPriceAmt'];
		$this->_fBidAdvanceTotal = $row[0]['fBidAdvanceTotal'];
		$this->_fBidPriceTotal = $row[0]['fBidPriceTotal'];
		$this->_fBidAmount = $row[0]['fBidAmount'];
		$this->_dBidDate = $row[0]['dBidDate'];
		$this->_iCreatedById = $row[0]['iCreatedById'];
		$this->_iModifiedById = $row[0]['iModifiedById'];
		$this->_iRejectedBy = $row[0]['iRejectedBy'];
		$this->_iVerifiedById = $row[0]['iVerifiedById'];
		$this->_tReasonToReject = $row[0]['tReasonToReject'];
		$this->_eSaved = $row[0]['eSaved'];
		$this->_eDelete = $row[0]['eDelete'];
		$this->_iStatusID = $row[0]['iStatusID'];
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
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2_bids WHERE iBidId = $id";
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
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2_bids WHERE $where";
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
		$this->_iBidId = '';
		$this->iBidId = ""; // clear key for autoincrement

		if(!is_array($Data) || count($Data)<1) {
				$Data = array(
						'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'vBidCode'		=>	$this->_vBidCode,
						'vBidNum'		=>	$this->_vBidNum,
						'eBidType'		=>	$this->_eBidType,
						'fBidAdvancePc'		=>	$this->_fBidAdvancePc,
						'fBidAdvanceAmt'		=>	$this->_fBidAdvanceAmt,
						'fBidPricePc'		=>	$this->_fBidPricePc,
						'fBidPriceAmt'		=>	$this->_fBidPriceAmt,
						'fBidAdvanceTotal'		=>	$this->_fBidAdvanceTotal,
						'fBidPriceTotal'		=>	$this->_fBidPriceTotal,
						'fBidAmount'		=>	$this->_fBidAmount,
						'dBidDate'		=>	$this->_dBidDate,
						'iCreatedById'		=>	$this->_iCreatedById,
						'iModifiedById'		=>	$this->_iModifiedById,
						'iRejectedBy'		=>	$this->_iRejectedBy,
						'iVerifiedById'		=>	$this->_iVerifiedById,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eSaved'		=>	$this->_eSaved,
						'eDelete'		=>	$this->_eDelete,
						'iStatusID'		=>	$this->_iStatusID,
						'eStatus'		=>	$this->_eStatus
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_bids",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{
			$Data = array(
						'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'vBidCode'		=>	$this->_vBidCode,
						'vBidNum'		=>	$this->_vBidNum,
						'eBidType'		=>	$this->_eBidType,
						'fBidAdvancePc'		=>	$this->_fBidAdvancePc,
						'fBidAdvanceAmt'		=>	$this->_fBidAdvanceAmt,
						'fBidPricePc'		=>	$this->_fBidPricePc,
						'fBidPriceAmt'		=>	$this->_fBidPriceAmt,
						'fBidAdvanceTotal'		=>	$this->_fBidAdvanceTotal,
						'fBidPriceTotal'		=>	$this->_fBidPriceTotal,
						'fBidAmount'		=>	$this->_fBidAmount,
						'dBidDate'		=>	$this->_dBidDate,
						'iCreatedById'		=>	$this->_iCreatedById,
						'iModifiedById'		=>	$this->_iModifiedById,
						'iRejectedBy'		=>	$this->_iRejectedBy,
						'iVerifiedById'		=>	$this->_iVerifiedById,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eSaved'		=>	$this->_eSaved,
						'eDelete'		=>	$this->_eDelete,
						'iStatusID'		=>	$this->_iStatusID,
						'eStatus'		=>	$this->_eStatus
			);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_bids",$Data,'update',$where);
		return $result;
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_bids",$data,"update",$where);
		return $result;
	}

	/**
	*   @desc   SET ALL VARIABLE
	*/
	function setAllVar($Data=array())
	{
		$MethodArr = get_class_methods($this);
		if(count($Data) > 0) {
			foreach($Data AS $KEY => $VAL) {
				$method = "set".$KEY;
				if(in_array($method , $MethodArr))
				{
				  @ call_user_method($method,$this,$VAL);
				}
			}
		} else {
			foreach($_REQUEST AS $KEY => $VAL) {
				$method = "set".$KEY;
				if(in_array($method , $MethodArr))
				{
				  @ call_user_method($method,$this,$VAL);
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
      $cnt = "";
      if($where != "") {
         $cnt = " Where 1 ".$where;
      }
      if($groupBy != "") {
         $cnt .= " Group By ".$groupBy;
      }
      if($orderBy != "") {
         $cnt .= " Order By ".$orderBy;
      }
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_rfq2_bids r2bd $cnt $limit";
		// echo $sql; // exit;
      $row = $this->_obj->MySQLSelect($sql);
      return $row;
   }

   /**
	*   @desc   GET DETAILS WITH PAGING AND JOINED TABLE IF REQUIRED
	*/
   function getJoinTableInfo($jtbl,$fields="*",$where="",$orderBy="",$groupBy="",$limit="",$pg="")
   {
      $cnt = "";
      $cnt_count = "";
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

      $sql = "SELECT $fields FROM ".PRJ_DB_PREFIX."_rfq2_bids r2bd $jtbl $cnt $limit";

		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			if($groupBy != "") {
				if(stripos($fields,'distinct')!==false) {
					$fields = str_ireplace('distinct','',$fields);
				}
				$fields = "Count(*) as tot, $fields";
			}
			$sql_count =  "SELECT Count(*) as tot, $fields FROM ".PRJ_DB_PREFIX."_rfq2_bids r2bd $jtbl $cnt_count";
			// echo $sql_count; exit;
			$row_count = $this->_obj->MySQLSelect($sql_count);
			// pr($row_count); exit;
			$row['tot'] = $row_count[0]['tot'];
			if($groupBy != "") {
				$row['tot'] = @ count($row_count);
			}
		}
      return $row;
	}

	function getOrgBids($orgid)
	{
		$sql = "Select * from ".PRJ_DB_PREFIX."_rfq2_bids r2bd INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id where r2bd.iBuyer2Id=$orgid ORDER BY r2bd.iBidId DESC LIMIT 0,3";
		$dtls = $this->_obj->MySQLSelect($sql);
		return $dtls;
	}
	function getOrgBid($orgid)
	{
		$sql = "Select * from ".PRJ_DB_PREFIX."_rfq2_bids r2bd INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id where rfq2.iOrganizationID=$orgid AND eStatus NOT IN ('pending','rejected') ORDER BY r2bd.iBidId DESC LIMIT 0,3";
		$dtls = $this->_obj->MySQLSelect($sql);
		return $dtls;
	}
	function getOrgrfq2($orgid)
	{
		$sql="SELECT invhead.vInvoiceCode,bm.iRFQ2Id,bm.vRFQ2Code,bm.eAuctionType,bm.dStartDate,bm.dEndDate,bm.eAuctionStatus
			FROM ".PRJ_DB_PREFIX."_rfq2_master bm
			INNER JOIN ".PRJ_DB_PREFIX."_inovice_order_heading invhead ON bm.iInvoiceID=invhead.iInvoiceID
			WHERE bm.iOrganizationID=$orgid
			ORDER BY  bm.iRFQ2Id DESC
			LIMIT 0,3";
		$dtls = $this->_obj->MySQLSelect($sql);
		return $dtls;
	}
	function getB2Orgrfq2($orgid)
	{
		$sql="SELECT DISTINCT bm.iRFQ2Id,invhead.vInvoiceCode,bm.vRFQ2Code,bm.eAuctionType,bm.dStartDate,bm.dEndDate,bm.eAuctionStatus
			FROM ".PRJ_DB_PREFIX."_rfq2_master bm
			INNER JOIN ".PRJ_DB_PREFIX."_rfq2_product_buyer2 r2pb ON r2pb.iRFQ2Id=bm.iRFQ2Id
			INNER JOIN ".PRJ_DB_PREFIX."_inovice_order_heading invhead ON bm.iInvoiceID=invhead.iInvoiceID
			WHERE r2pb.iBuyer2Id=$orgid
			ORDER BY  bm.iRFQ2Id DESC
			LIMIT 0,2";
		$dtls = $this->_obj->MySQLSelect($sql);
		return $dtls;
	}
	function getviewbidhistory($id, $orgid)
	{
		$sql = "Select *,bu.vFirstName,bu.vLastName, r2bd.eStatus, r2bd.eSaved, r2bd.eDelete from ".PRJ_DB_PREFIX."_rfq2_bids r2bd
					INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id
					LEFT JOIN  ".PRJ_DB_PREFIX."_organization_user bu ON bu.iUserID=rfq2.iUserID
					where rfq2.iRFQ2Id=$id AND r2bd.iBuyer2Id=$orgid ORDER BY r2bd.iBidId DESC";
		$dtls = $this->_obj->MySQLSelect($sql);
		return $dtls;
	}

	function iacalcBidAmount($ary)
	{
		$bidamount = 0;
		if(isset($ary['fBidAdvanceTotal']) && isset($ary['fBidPriceTotal']) && $ary['fBidAdvanceTotal']>0 && $ary['fBidPriceTotal']>0)
		{
			$ary['fBidAmount'] = $bidamount = (float) ( ((float)$ary['fBidAdvanceTotal'] + (float)$ary['fBidPriceTotal']) / 2 );
		} else if(isset($ary['iRFQ2Id']) && $ary['iRFQ2Id']>0 && ($ary['fBidAdvancePc']>0 || $ary['fBidAdvanceAmt']>0) && ($ary['fBidPricePc']>0 || $ary['fBidPriceAmt']>0)) {
			$sql = "Select io.fAcceptedAmount from ".PRJ_DB_PREFIX."_inovice_order_heading io INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 on io.iInvoiceID=rfq2.iInvoiceID where rfq2.iRFQ2Id=".$ary['iRFQ2Id']."";
			$iamt = $this->_obj->MySQLSelect($sql);
			$ipaam = $iamt[0]['fAcceptedAmount'];
			$advance = 0;
			$price = 0;
			if(trim($ipaam)!='' && $ipaam>0)
			{
				if($ary['fBidAdvancePc']>0) {
					$ary['fBidAdvanceAmt'] = (float) ($ipaam*$ary['fBidAdvancePc']/100);
					$ary['fBidAdvanceTotal'] = $advance = $ipaam + $ary['fBidAdvanceAmt'];
				} else if($ary['fBidAdvanceAmt']>0) {
					$ary['fBidAdvancePc'] = (float) ($ary['fBidAdvanceAmt']*100/$ipaam);
					$ary['fBidAdvanceTotal'] = $advance = $ipaam + $ary['fBidAdvanceAmt'];
				}
				if($ary['fBidPricePc']>0) {
					$ary['fBidPriceAmt'] = (float) ($ipaam*$ary['fBidPricePc']/100);
					$ary['fBidPriceTotal'] = $price = $ipaam + $ary['fBidPriceAmt'];
				} else if($ary['fBidPriceAmt']>0) {
					$ary['fBidPricePc'] = (float) ($ary['fBidPriceAmt']*100/$ipaam);
					$ary['fBidPriceTotal'] = $price = $ipaam + $ary['fBidPriceAmt'];
				}
			}
			if($advance>0 && $price>0) {
				$ary['fBidAmount'] = $bidamount = (float) ( ((float)$advance + (float)$price) / 2 );
			}
		}
		return $ary;
	}

	function chkAuctionBidAmount($bidcriteria,$iRFQ2Id,$iBidId,$advance,$price,$fBidAmount)
	{
		$vbd = array('a'=>'y','p'=>'y','b'=>'y','msg'=>'');
		$chkbid = $this->getDetails('*, MAX(r2bd.fBidAdvanceTotal) as maxadvance, MIN(r2bd.fBidPriceTotal) as minprice, MAX(r2bd.fBidAmount) as maxbidamount'," AND r2bd.iRFQ2Id=".$iRFQ2Id." AND r2bd.eStatus='current' AND iBidId!='$iBidId'"," r2bd.iBidId DESC "," r2bd.iBidId "," LIMIT 0,1 ");
		// pr($chkbid); exit;
		if(is_array($chkbid) && count($chkbid)>0)
		{
			if($bidcriteria=='Advance') {
				if($advance<=$chkbid[0]['maxadvance']) {
					$vbd['a'] = 'n';
					$vbd['msg'] = "al"; 	// "LBL_BID_ADVANCE_NOT_HIGHER";
				}
				//
			} else if($bidcriteria=='Price') {
				if($price>=$chkbid[0]['minprice']) {
					$vbd['p'] = 'n';
					$vbd['msg'] = "pl"; 	// "LBL_BID_PRICE_NOT_LESSER";
				}
			} else {
				/*if($advance<=$chkbid[0]['maxadvance']) {
					$vbd['a'] = 'n';
					$vbd['msg'] = "al"; 	// "Bid amount is not higher than other bids";
				} else if($price>=$chkbid[0]['minprice']) {
					$vbd['p'] = 'n';
					$vbd['msg'] = "pl"; 	// "Bid amount is not higher than other bids";
				} else*/ if($fBidAmount<=$chkbid[0]['maxbidamount']) {
					$vbd['b'] = 'n';
					$vbd['msg'] = "bl"; 	// "MSG_LESSER_BID_ADVANCE_PRICE";
				}
			}
			//
		}
		return $vbd;
	}

	function chkTenderBidAmount($eBidCriteria,$iRFQ2Id,$iBidId,$fBidAdvanceTotal,$fBidPriceTotal,$fBidAmount,$orgid)
	{
		$vbd = array('a'=>'y','p'=>'y','b'=>'y','msg'=>'');
		$chkbid = $this->getDetails('*, MAX(r2bd.fBidAdvanceTotal) as maxadvance, MIN(r2bd.fBidPriceTotal) as minprice, MAX(r2bd.fBidAmount) as maxbidamount'," AND r2bd.iRFQ2Id=".$iRFQ2Id." AND r2bd.eStatus='current' AND iBidId!='$iBidId' AND iBuyer2Id=$orgid"," r2bd.iBidId DESC "," r2bd.iBidId "," LIMIT 0,1 ");
		// pr($chkbid); exit;
		if(is_array($chkbid) && count($chkbid)>0)
		{
			if($bidcriteria=='Advance') {
				if($advance<=$chkbid[0]['maxadvance']) {
					$vbd['a'] = 'n';
					$vbd['msg'] = "al"; 	// "Advance amount is not higher than other bids";
				}
				//
			} else if($bidcriteria=='Price') {
				if($price>=$chkbid[0]['minprice']) {
					$vbd['p'] = 'n';
					$vbd['msg'] = "pl"; 	// "Price amount is not higher than other bids";
				}
			} else {
				/*if($advance<=$chkbid[0]['maxadvance']) {
					$vbd['a'] = 'n';
					$vbd['msg'] = "bl"; 	// "Bid amount is not higher than other bids";
				} else if($price>=$chkbid[0]['minprice']) {
					$vbd['p'] = 'n';
					$vbd['msg'] = "bl"; 	// "Bid amount is not higher than other bids";
				} else*/ if($fBidAmount<=$chkbid[0]['maxbidamount']) {
					$vbd['b'] = 'n';
					$vbd['msg'] = "bl"; 	// "Bid amount is not higher than other bids";
				}
			}
			//
		}
		return $vbd;
	}

	function getUniqueCode($type='')
	{
		$sql = "Select COUNT(*) as tot from ".PRJ_DB_PREFIX."_rfq2_bids where dBidDate>'".date('Y-m-d')."'";
		// echo $sql; exit;
		$rw =  $this->_obj->MySQLSelect($sql);
		$num = ($rw[0]['tot']+1);
		if($num<10) {
			$num = '000'.$num;
		} else if($num<100) {
			$num = '00'.$num;
		} else if($num<1000) {
			$num = '0'.$num;
		}
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

	function chkAuctionBidStatus($iBidId)
	{
		$sts = 'pending';
		$vbd = array('a'=>'y','p'=>'y','b'=>'y','msg'=>'');
		$dtls = $this->GetDetails(' iRFQ2Id, fBidAmount, fBidAdvanceTotal, fBidPriceTotal, fBidAmount '," AND iBidId=$iBidId ");
		$chkbid = $this->getDetails('*, MAX(r2bd.fBidAdvanceTotal) as maxadvance, MIN(r2bd.fBidPriceTotal) as minprice, MAX(r2bd.fBidAmount) as maxbidamount'," AND r2bd.iRFQ2Id=".$dtls[0]['iRFQ2Id']." AND r2bd.eStatus='current' AND iBidId!='$iBidId' "," r2bd.iBidId DESC "," r2bd.iBidId "," LIMIT 0,1 ");
		if(is_array($chkbid) && count($chkbid)>0)
		{
			if($bidcriteria=='Advance') {
				if($advance<=$chkbid[0]['maxadvance']) {
					$vbd['a'] = 'n';
					$vbd['msg'] = "al"; 	// "Advance amount is not higher than other bids";
				}
				//
			} else if($bidcriteria=='Price') {
				if($price>=$chkbid[0]['minprice']) {
					$vbd['p'] = 'n';
					$vbd['msg'] = "pl"; 	// "Price amount is not higher than other bids";
				}
			} else {
				if($advance<=$chkbid[0]['maxadvance']) {
					$vbd['a'] = 'n';
					$vbd['msg'] = "bl"; 	// "Bid amount is not higher than other bids";
				}
				if($price>=$chkbid[0]['minprice']) {
					$vbd['p'] = 'n';
					$vbd['msg'] = "bl"; 	// "Bid amount is not higher than other bids";
				}
				if($fBidAmount<=$chkbid[0]['maxbidamount']) {
					$vbd['b'] = 'n';
					$vbd['msg'] = "bl"; 	// "Bid amount is not higher than other bids";
				}
			}
			//
		}
		if($cvbd['b']=='n' || $cvbd['a']=='n'|| $cvbd['p']=='n') {
			$sts = 'outbided';
		} else {
			$sts = 'current';
		}
		return $sts;
	}

	function setAuctionAllBidStatus($iBidId)
	{
		$rs = "";
		$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id ";
		$bdtls = $this->getJoinTableInfo($jtbl," DISTINCT *, r2bd.eStatus, r2bd.eSaved, r2bd.eDelete, r2bd.iModifiedById, rfq2.eBidCriteria "," AND r2bd.iBidId=$iBidId ","","","","");
		// pr($bdtls); exit;
		if(is_array($bdtls) && count($bdtls)>0 && isset($bdtls[0]['iBidId']) && $bdtls[0]['iBidId']>0)
		{
			$sql = "";
			if(isset($bdtls[0]['eBidCriteria']) && $bdtls[0]['eBidCriteria']=='Advance') {
				$sql = "Update ".PRJ_DB_PREFIX."_rfq2_bids set eStatus='outbidded' where fBidAdvanceTotal<".$bdtls[0]['fBidAdvanceTotal']." AND iRFQ2Id=".$bdtls[0]['iRFQ2Id']." AND eStatus='current'";
			} else if(isset($bdtls[0]['eBidCriteria']) && $bdtls[0]['eBidCriteria']=='Price') {
				$sql = "Update ".PRJ_DB_PREFIX."_rfq2_bids set eStatus='outbidded' where fBidPriceTotal>".$bdtls[0]['fBidPriceTotal']." AND iRFQ2Id=".$bdtls[0]['iRFQ2Id']." AND eStatus='current'";
			} else {
				$sql = "Update ".PRJ_DB_PREFIX."_rfq2_bids set eStatus='outbidded' where fBidAmount<".$bdtls[0]['fBidAmount']." AND iRFQ2Id=".$bdtls[0]['iRFQ2Id']." AND eStatus='current'";
			}
			if(trim($sql)!='')
			{
				$rs = $this->_obj->sql_query($sql);
			}
		}
		return $rs;
	}

	function getHistory($iBidId, $orgid=0)
   {
		$oc = "";
		if($orgid>0) {
			$oc = " iOrganizationID = $orgid AND ";
		}
      $sql = "Select iVerifiedID,iItemID,eSubject,eType,vAction,vMailSubject_en,iOrganizationID,iCreatedBy,eCreatedType,eVerifiedBy,iVerifiedBy,dActionDate,dVerifyDate,vVerifyFromIP from ".PRJ_DB_PREFIX."_user_action_verification where $oc iItemID=$iBidId AND eSubject='RFQ2 Bid' AND eType!='Rejected' AND vMailSubject_en!='New Bid For RFQ2' Order By dActionDate ASC ";
		// echo $sql; exit;
		$dtls = $this->_obj->MySQLSelect($sql);
		for($l=0;$l<count($dtls);$l++)
		{
			$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$dtls[$l]['iCreatedBy'];
			$cusr = $this->_obj->MySQLSelect($sql);
			$dtls[$l]['createdby'] = $cusr[0]['name'];
			$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$dtls[$l]['iVerifiedBy'];
			$cusr = $this->_obj->MySQLSelect($sql);
			$dtls[$l]['verifiedby'] = $cusr[0]['name'];
		}
		return $dtls;
   }

	function getRFQ2Stats($orgid)
	{
		$sql = "(SELECT COUNT(iRFQ2Id) as cnt, eAuctionStatus FROM b2b_rfq2_master WHERE eDelete!='Verified' AND (iOrganizationID=$orgid OR iInvoiceID IN (Select iInvoiceID from ".PRJ_DB_PREFIX."_inovice_order_heading where iBuyerOrganizationID=$orgid OR iSupplierOrganizationID=$orgid)) GROUP BY eAuctionStatus)
					UNION
					(SELECT COUNT(r2.iRFQ2Id) as cnt, 'Awarded' AS eAuctionStatus FROM b2b_rfq2_master r2 WHERE r2.eDelete!='Verified' AND (r2.iOrganizationID=$orgid OR r2.iInvoiceID IN (Select iInvoiceID from ".PRJ_DB_PREFIX."_inovice_order_heading where iBuyerOrganizationID=$orgid OR iSupplierOrganizationID=$orgid)) AND (SELECT COUNT(aw.iAwardId) FROM b2b_rfq2award_master aw WHERE aw.iRFQ2Id=r2.iRFQ2Id AND aw.iaStatusID=(SELECT iStatusID FROM b2b_status_master WHERE vStatus_en='Accepted' AND vForAuction!=''))>0 )";
		// echo $sql; exit;
		$dtls = $this->_obj->MySQLSelect($sql);
		// pr($dtls); exit;
		return $dtls;
	}

	function getB2BidStats($orgid)
	{
		$sql = "(SELECT COUNT(iBidId) as cnt, eStatus FROM b2b_rfq2_bids r2bd INNER JOIN b2b_rfq2_master rfq2 ON (r2bd.iRFQ2Id=rfq2.iRFQ2Id AND rfq2.eDelete!='Verified') WHERE r2bd.eDelete!='Verified' AND r2bd.iBuyer2Id=$orgid AND r2bd.eStatus NOT IN('pending','rejected') GROUP BY r2bd.eStatus)
					UNION
					(SELECT COUNT(iBidId) as cnt, 'awarded' AS eStatus FROM b2b_rfq2_bids bd INNER JOIN b2b_rfq2_master rfq2 ON (bd.iRFQ2Id=rfq2.iRFQ2Id AND rfq2.eDelete!='Verified') WHERE bd.eDelete!='Verified' AND bd.iBuyer2Id=$orgid AND (SELECT COUNT(aw.iAwardId) FROM b2b_rfq2award_master aw WHERE aw.eDelete!='Verified' AND aw.iBidId=bd.iBidId)>0 AND bd.eStatus NOT IN('pending','rejected'))";
		// echo $sql; exit;
		$dtls = $this->_obj->MySQLSelect($sql);
		// pr($dtls); exit;
		return $dtls;
	}

	function getRfq2Awardlist($orgid,$StatusID)
	{
		$sql="(SELECT COUNT(rfq2mas.iRFQ2Id) AS cnt,rfq2mas.eAuctionStatus FROM b2b_rfq2_master rfq2mas
			INNER JOIN b2b_rfq2_product_buyer2 rfq2buy ON rfq2buy.iRFQ2Id=rfq2mas.iRFQ2Id
			WHERE rfq2buy.iBuyer2Id=$orgid AND rfq2mas.eSaved='No' AND rfq2mas.eDelete='No'
			GROUP BY eAuctionStatus)
			UNION
			(SELECT COUNT(rfq2aw.iAwardId) AS cnt, 'Awarded' AS eAuctionStatus FROM  b2b_rfq2award_master rfq2aw
			LEFT JOIN b2b_rfq2_master rfq2mast ON rfq2mast.iRFQ2Id=rfq2aw.iRFQ2Id
			LEFT JOIN b2b_rfq2_bids rfq2bid ON rfq2aw.iBidId=rfq2bid.iBidId
			WHERE rfq2bid.iBuyer2Id=$orgid AND rfq2aw.iaStatusID=$StatusID AND rfq2aw.eDelete='No' AND rfq2aw.eSaved='No')";
			$dtls = $this->_obj->MySQLSelect($sql);
		// pr($dtls); exit;
		return $dtls;
	}
}
?>