<?php

$mode = Postvar('mod');
$val = Postvar('val');
$sts = PostVar('sts');
$status = Postvar('status');
$bidstatus = Postvar('bidstatus');
// pr($_POST); exit;

$vRFQ2Code = PostVar('vRFQ2Code');
$vInvoiceCode = PostVar('vInvoiceCode');
$vProductName = PostVar('product');
$vBuyerName = PostVar('buyer');
$vSupplierName = PostVar('supplier');
$eAuctionType = PostVar('eAuctionType');
$eBidCriteria = PostVar('eBidCriteria');
$dStartDate = PostVar('dStartDate');
$dEndDate = PostVar('dEndDate');
// $fMaxPrice = PostVar('fMaxPrice');
// $fMinPrice = PostVar('fMinPrice');
$famount = PostVar('amount');
$eStatus = PostVar('eStatus');
//$dStartDate = calcGTzTime($dStartDate, 'Y-m-d H:i:s');
//$dEndDate = calcGTzTime($dEndDate, 'Y-m-d H:i:s');
// echo $status; exit;
// $page = (isset($_POST['page']))? $_POST['page'] : '';
$page = PostVar('page');
if (trim($page) == '' || trim($page) < 1) {
    $page = 1;
}
//Prints($_POST); exit;
if (!isset($r2bdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/" . "class.Rfq2Bids.php");
    $r2bdObj = new Rfq2Bids();
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
        $where .= " AND DATE(r2bd.dBidDate)>=DATE('$dStartDate')";
    } else if (trim($dEndDate) != '' && trim($dStartDate) == '') {
        $where .= " AND DATE(r2bd.dBidDate)<='$dEndDate'";
    } else if (trim($dStartDate) != '' && trim($dEndDate) != '') {
        $where .= " AND (DATE(r2bd.dBidDate)>=DATE('$dStartDate') AND DATE(r2bd.dBidDate)<='$dEndDate') ";
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
    if (trim($famount) != '') {
        $having .= (trim($having)!='')? " AND fAcceptedAmount LIKE '$famount%'" : " HAVING fAcceptedAmount LIKE '$famount%'";
    }
    if (trim($eStatus) != '') {
        // $where .= " AND (sm.vStatus_en LIKE '%$eStatus%' OR sm.vStatus_fr LIKE '%$eStatus%')";
        if (strtolower(trim($eStatus)) == strtolower($smarty->get_template_vars('MSG_SAVED'))) {
            $where .= " AND (r2bd.eSaved='Yes') ";
        } else {
            $where .= " AND (r2bd.eStatus LIKE '%$eStatus%') AND r2bd.eSaved!='Yes' ";
        }
    }
}
if ($sts == 'b2') {
    if ($status > 0) {
        $where .= " AND r2bd.iStatusID=$status AND r2bd.eSaved!='Yes' ";
    } else if ($status == 0) {
        $where .= " AND r2bd.eSaved='Yes' ";
    }
}
if ($status != 'all' && $status != '') {
    //
}
if ($bidstatus == "bidcount") {

    if ($sts == "1") {
        $where .= " AND r2bd.eStatus='current'";
    } else {
        $where .= " AND r2bd.eStatus='outbidded'";
    }
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
    if (strpos($cursort, ',') !== false) {
        $cursort = str_replace(",", " $cursort_type, ", $cursort);
    }
    $orderBy = " $cursort $cursort_type";
} else {
    $orderBy = " r2bd.dBidDate DESC ";
}
## ENDS HERE ###

$limit = " LIMIT " . ($page - 1) * $REC_LIMIT_FRONT . ", " . $REC_LIMIT_FRONT . " ";
$jtbl = " INNER JOIN " . PRJ_DB_PREFIX . "_rfq2_master rfq2 on rfq2.iRFQ2Id=r2bd.iRFQ2Id
				LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID
                                LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading poh on rfq2.iPurchaseOrderID=poh.iPurchaseOrderID
				LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
				LEFT JOIN " . PRJ_DB_PREFIX . "_rfq2_product_buyer2 rpb2 on rpb2.iRFQ2Id=rfq2.iRFQ2Id ";
// echo $where; exit;
// $where .= " AND rfq2.iStatusID!=$csts ";
// $where .= " AND rfq2.dStartDate<NOW() ";
$where .= " AND r2bd.eDelete!='Verified' AND r2bd.iBuyer2Id=$curORGID ";
$fields = " DISTINCT r2bd.*, rfq2.*, IF(rfq2.eFrom='Invoice',ioh.vInvoiceCode,poh.vPOCode) as vInvoiceCode, IF(rfq2.eFrom='Invoice',ioh.fAcceptedAmount,poh.fPOTotal) as fAcceptedAmount, IF(rfq2.eFrom='Invoice',ioh.vBuyerName,poh.vBuyerCompanyName) as vBuyerName, IF(rfq2.eFrom='Invoice',ioh.vSupplierName,poh.vSupplierName) as vSupplierName, sm.vStatus_" . LANG . " as status, r2bd.eStatus, r2bd.eSaved, r2bd.eDelete,
					IF(rfq2.eAuctionStatus='Completed' || rfq2.eAuctionStatus='Cancelled', rfq2.eAuctionStatus, IF(rfq2.dStartDate<NOW() AND rfq2.dEndDate>NOW(),'Live', IF(rfq2.dStartDate>NOW() AND rfq2.dEndDate>NOW(),'Not Started', rfq2.eAuctionStatus)) ) as rfq2Status,
					IF(rpb2.ePType='BProduct',(Select vProductName from " . PRJ_DB_PREFIX . "_bproduct_organization where iProductId=rpb2.ePType), (Select vProductName from " . PRJ_DB_PREFIX . "_sproduct_organization where iProductId=rpb2.ePType) ) as vProductName";
// IF(rfq2.dStartDate<NOW() AND rfq2.dEndDate>NOW(), 'Live', IF(rfq2.dStartDate>NOW() AND rfq2.dEndDate>NOW(), 'Not Started', IF(rfq2.eAuctionStatus!='Completed' AND rfq2.eAuctionStatus!='Cancelled', 'Completed', rfq2.eAuctionStatus) ) ) as eStatus,
// "IF(rfq2.dStartDate>NOW(), TIMESTAMPDIFF(DAY,NOW(),rfq2.dStartDate), 0) as rdays, IF(rfq2.dStartDate>NOW(), TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,NOW(),rfq2.dStartDate) - (TIMESTAMPDIFF(DAY,NOW(),rfq2.dStartDate) * 24*60*60) ), '%H:%i'), 0) as rtime ";
$dtls = $r2bdObj->getJoinTableInfo($jtbl, $fields, $where, $orderBy, 'r2bd.iBidId' . $having, $limit, 'yes');
// pr($dtls); exit;
$count = $dtls['tot'];
unset($dtls['tot']);

if (!isset($pgajxobj)) {
    require_once(SITE_CLASS_GEN . "class.paging-ajax.php");
    $pgajxobj = new Paging($count, $page, "listrfq2bid", $REC_LIMIT_FRONT);
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