<?php

//print_r($_SESSION);exit;
$userid = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
$mode = Postvar('mod');
$val = Postvar('val');
$sts = PostVar('sts');
$status = Postvar('status');

$vRFQ2Code = PostVar('vRFQ2Code');
$vInvoiceCode = PostVar('vInvoiceCode');
$vProductName = PostVar('product');
$vBuyerName = PostVar('buyer');
$vSupplierName = PostVar('supplier');
$eAuctionType = PostVar('eAuctionType');
$eBidCriteria = PostVar('eBidCriteria');
$dStartDate = PostVar('dStartDate');
$dEndDate = PostVar('dEndDate');
//$dStartDate = calcGTzTime($dStartDate, 'Y-m-d H:i:s');
//$dEndDate = calcGTzTime($dEndDate, 'Y-m-d H:i:s');
// $fMaxPrice = PostVar('fMaxPrice');
// $fMinPrice = PostVar('fMinPrice');
$fBestBid = PostVar('bestbid');
$eStatus = PostVar('eStatus');

// echo $status; exit;
// $page = (isset($_POST['page']))? $_POST['page'] : '';
$page = PostVar('page');
if (trim($page) == '' || trim($page) < 1) {
    $page = 1;
}
//Prints($_POST); exit;
if (!isset($rfq2Obj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2Master.php");
    $rfq2Obj = new RFQ2Master();
}
if (!isset($statusmasterObj)) {
    include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
    $statusmasterObj = new StatusMaster();
}
$csts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Create' ");
$csts = $csts[0]['iStatusID'];

$where = "";
$having = "";

if ($mode == 'srch') {
    if (trim($vRFQ2Code) != '') {
        $where = " AND rfq2.vRFQ2Code LIKE '%$vRFQ2Code%'";
    }
    if (trim($vInvoiceCode) != '') {
        $where .= " AND (ioh.vInvoiceCode LIKE '%$vInvoiceCode%' OR poh.vPOCode LIKE '%$vInvoiceCode%')";
    }
    if (trim($vProductName) != '') {
        $having .= " HAVING vProductName LIKE '%$vProductName%'";
    }
    if (trim($vBuyerName) != '') {
        $where .= " AND (ioh.vBuyerName LIKE '%$vBuyerName%' OR poh.vBuyerCompanyName LIKE '%$vBuyerName%')";
    }
    if (trim($vSupplierName) != '') {
        $where .= " AND (ioh.vSupplierName LIKE '%$vSupplierName%' OR poh.vSupplierName LIKE '%$vSupplierName%')";
    }
    if (trim($eAuctionType) != '') {
        $where .= " AND rfq2.eAuctionType LIKE '%$eAuctionType%'";
    }
    if (trim($eBidCriteria) != '') {
        $where .= " AND rfq2.eBidCriteria LIKE '%$eBidCriteria%'";
    }
    if (trim($dStartDate) != '' && trim($dEndDate) == '') {
        $where .= " AND rfq2.dStartDate>=DATE('$dStartDate')";
    } else if (trim($dEndDate) != '' && trim($dStartDate) == '') {
        $where .= " AND rfq2.dStartDate<='$dEndDate'";
    } else if (trim($dStartDate) != '' && trim($dEndDate) != '') {
        $where .= " AND (rfq2.dStartDate>=DATE('$dStartDate') AND rfq2.dStartDate<='$dEndDate') ";
    }
    /* if(trim($dStartDate) != '') {
      $where .= " AND rfq2.dStartDate='$dStartDate'";
      }
      if(trim($dEndDate) != '') {
      $where .= " AND rfq2.dEndDate='$dEndDate'";
      } */
    /* if(trim($fMaxPrice) != '') {
      $where .= " AND rfq2.fMaxPrice LIKE '$fMaxPrice%'";
      }
      if(trim($fMinPrice) != '') {
      $where .= " AND rfq2.fMinPrice LIKE '$fMinPrice%'";
      } */
    if (trim($fBestBid) != '') {
        $where .= " AND rfq2.fBestBidAmount LIKE '$fBestBid%'";
    }
    if (trim($eStatus) != '') {
        // $where .= " AND (sm.vStatus_en LIKE '%$eStatus%' OR sm.vStatus_fr LIKE '%$eStatus%')";
        // $where .= " AND (sm.vStatus_en LIKE '%$eStatus%' OR sm.vStatus_fr LIKE '%$eStatus%')";
        if (strtolower(trim($eStatus)) == strtolower($smarty->get_template_vars('MSG_SAVED'))) {
            $where .= " AND rfq2.eSaved='Yes' ";
        } else {
            $where .= " AND rfq2.eAuctionStatus LIKE '%$eStatus%' ";
        }
    }
}
if ($status != 'all' && $status != '') {
    //
}

if ($sess_usertype_short == 'OU' || $sess_usertype_short == 'OA') {
    $where .= " AND rpb2.iBuyer2Id=$curORGID AND sm.vStatus_en='Verify' ";
} /* else if($sess_usertype_short == 'OA') {
  $where .= " AND rfq2.iOrganizationID=$curORGID ";
  } */
// echo $where; exit;
### SORTING ###
$cursort = PostVar('cursort');
$cursort = stripslashes($cursort);
$cursorttype = PostVar('cursorttype');
$cursorttype = stripslashes($cursorttype);

if ($cursort != '') {
    if ($cursorttype == '1') {
        $cursort_type = 'ASC';
    } else {
        $cursort_type = 'DESC';
    }
    $orderBy = " $cursort $cursort_type";
} else {
    $orderBy = " rfq2.dADate DESC ";
}
## ENDS HERE ###

$limit = " LIMIT " . ($page - 1) * $REC_LIMIT_FRONT . ", " . $REC_LIMIT_FRONT . " ";
// echo $where;
$jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID
                                LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading poh on rfq2.iPurchaseOrderID=poh.iPurchaseOrderID
				LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
				LEFT JOIN " . PRJ_DB_PREFIX . "_rfq2_product_buyer2 rpb2 on rpb2.iRFQ2Id=rfq2.iRFQ2Id
				INNER JOIN " . PRJ_DB_PREFIX . "_buyer2_rfq2_watchlist watch on  watch.iRFQ2Id=rfq2.iRFQ2Id";

$where .= " AND rfq2.eDelete!='Verified' AND watch.iUserID=$userid";
$fields = " DISTINCT rfq2.*, IF(rfq2.eFrom='Invoice',ioh.vInvoiceCode,poh.vPOCode) as vInvoiceCode, IF(rfq2.eFrom='Invoice',ioh.fAcceptedAmount,poh.fPOTotal) as fAcceptedAmount, IF(rfq2.eFrom='Invoice',ioh.vBuyerName,poh.vBuyerCompanyName) as vBuyerName, IF(rfq2.eFrom='Invoice',ioh.vSupplierName,poh.vSupplierName) as vSupplierName, sm.vStatus_" . LANG . " as status,
					IF(rfq2.eAuctionStatus='Completed' || rfq2.eAuctionStatus='Cancelled', rfq2.eAuctionStatus, IF(rfq2.dStartDate<NOW() AND rfq2.dEndDate>NOW(),'Live', IF(rfq2.dStartDate>NOW() AND rfq2.dEndDate>NOW(),'Not Started', rfq2.eAuctionStatus)) ) as eStatus,
					IF(rpb2.ePType='BProduct',(Select vProductName from " . PRJ_DB_PREFIX . "_bproduct_organization where iProductId=rpb2.ePType), (Select vProductName from " . PRJ_DB_PREFIX . "_sproduct_organization where iProductId=rpb2.ePType) ) as vProductName,
                                        @rd:=IF(rfq2.dStartDate>UTC_TIMESTAMP(), TIMESTAMPDIFF(DAY,UTC_TIMESTAMP(),rfq2.dStartDate), 0) as rdays, IF(rfq2.dStartDate>UTC_TIMESTAMP(), TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,UTC_TIMESTAMP(),rfq2.dStartDate) - (@rd * 24*60*60) ), '%H:%i'), 0) as rtime,
					(Select COUNT(iBidId) FROM " . PRJ_DB_PREFIX . "_rfq2_bids WHERE eStatus='current') AS totbid  ";  // , 

$dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where, $orderBy, 'rfq2.iRFQ2Id' . $having, $limit, 'yes');
// pr($dtls); exit;
$count = $dtls['tot'];
unset($dtls['tot']);

if (!isset($pgajxobj)) {
    require_once(SITE_CLASS_GEN . "class.paging-ajax.php");
    $pgajxobj = new Paging($count, $page, "listrfq2", $REC_LIMIT_FRONT);
}
$paging = $pgajxobj->getListPG($page);
$pgmsg = $pgajxobj->setMessage("Records");
//echo $paging; exit;
$smarty->assign('dtls', $dtls);
$smarty->assign('isusts', $isusts);
$smarty->assign('count', $count);
$smarty->assign('paging', $paging);
$smarty->assign('pgmsg', $pgmsg);
?>