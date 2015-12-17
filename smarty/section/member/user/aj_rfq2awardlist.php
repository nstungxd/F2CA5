<?php

$mode = Postvar('mod');
$val = Postvar('val');
$sts = PostVar('sts');
$status = Postvar('status');
//echo $masage = PostVar('vRFQ2Code');
$gmtoffset = PostVar('gmtoffset');
$vRFQ2Code = PostVar('vRFQ2Code');
$vInvoiceCode = PostVar('vInvoiceCode');
$vProductName = PostVar('product');
$vBuyerName = PostVar('buyer');
$vSupplierName = PostVar('supplier');
$vBuyer2 = PostVar('buyer2');
$eAuctionType = PostVar('eAuctionType');
$eBidCriteria = PostVar('eBidCriteria');
$dStartDate = PostVar('dStartDate');
$dEndDate = PostVar('dEndDate');
$famount = PostVar('amount');
$eStatus = PostVar('eStatus');
//$dStartDate = calcGTzTimeFmo($dStartDate, 'Y-m-d', $gmtoffset);
//$dEndDate = calcGTzTimeFmo($dEndDate, 'Y-m-d', $gmtoffset);
//$dStartDate = calcGTzTime($dStartDate, 'Y-m-d H:i:s');
//$dEndDate = calcGTzTime($dEndDate, 'Y-m-d H:i:s');
// pr($_POST); exit;

$page = PostVar('page');
if (trim($page) == '' || trim($page) < 1) {
    $page = 1;
}
//Prints($_POST); exit;
if (!isset($r2bdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/" . "class.Rfq2Bids.php");
    $r2bdObj = new Rfq2Bids();
}
if (!isset($r2awObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/" . "class.Rfq2Award.php");
    $r2awObj = new Rfq2Award();
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
    if (trim($vBuyer2) != '') {
        $where .= " AND org.vCompanyName LIKE '%$vBuyer2%'";
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
    if (trim($famount) != '') {
        $having .= (trim($having)!='')? " AND fAcceptedAmount LIKE '$famount%'" : " HAVING fAcceptedAmount LIKE '$famount%'";
    }
    if (trim($eStatus) != '') {
        $where .= " AND (sm.vStatus_en LIKE '%$eStatus%' OR sm.vStatus_fr LIKE '%$eStatus%')";
    }
}
//if($sts == "a") {
if (trim($status) != '' && $status > 0 && (trim($eStatus) == '')) {
    if ($sts == 'a') {
        $where .= " AND rfq2.iRFQ2Id=$status ";
    } else {
        $where .= " AND sm.iStatusID=$status ";
    }
}
/* if($status!='all' && $status!='')
  {
  echo $where .= "AND rfq2.iRFQ2Id=$rfq2id";
  } */
//echo $where;

if ($sess_usertype_short == 'OU' || $sess_usertype_short == 'OA') {
    $where .= " AND rfq2.iOrganizationID=$curORGID ";  // AND sm.vStatus_en='Verify'
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

$jtbl = "INNER JOIN " . PRJ_DB_PREFIX . "_rfq2_bids r2bd on r2bd.iRFQ2Id=r2aw.iRFQ2Id
            INNER JOIN " . PRJ_DB_PREFIX . "_rfq2_master rfq2 on rfq2.iRFQ2Id=r2bd.iRFQ2Id
				LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID
                                LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading poh on rfq2.iPurchaseOrderID=poh.iPurchaseOrderID
				LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on sm.iStatusID=r2aw.iStatusID
				LEFT JOIN " . PRJ_DB_PREFIX . "_rfq2_product_buyer2 rpb2 on rpb2.iRFQ2Id=rfq2.iRFQ2Id
				LEFT JOIN " . PRJ_DB_PREFIX . "_organization_master org on org.iOrganizationID=r2bd.iBuyer2Id
            ";
$where .= " AND r2bd.eSaved!='Yes' AND r2bd.eStatus NOT IN ('pending','rejected') ";
$where .= " AND r2bd.eDelete!='Verified' ";
$fields = " DISTINCT r2aw.iAwardId, r2bd.*, rfq2.*, IF(rfq2.eFrom='Invoice',ioh.vInvoiceCode,poh.vPOCode) as vInvoiceCode, IF(rfq2.eFrom='Invoice',ioh.fAcceptedAmount,poh.fPOTotal) as fAcceptedAmount, IF(rfq2.eFrom='Invoice',ioh.vBuyerName,poh.vBuyerCompanyName) as vBuyerName, IF(rfq2.eFrom='Invoice',ioh.vSupplierName,poh.vSupplierName) as vSupplierName, sm.vStatus_" . LANG . " as eStatus, r2aw.eSaved, r2aw.eDelete, org.vCompanyName as vBuyer2,
					IF(rpb2.ePType='BProduct',(Select vProductName from " . PRJ_DB_PREFIX . "_bproduct_organization where iProductId=rpb2.ePType), (Select vProductName from " . PRJ_DB_PREFIX . "_sproduct_organization where iProductId=rpb2.ePType) ) as vProductName,
					r2bd.dBidDate";
$dtls = $r2awObj->getJoinTableInfo($jtbl, $fields, $where, $orderBy, 'r2aw.iAwardId' . $having, $limit, 'yes');
// pr($dtls); exit;
//echo $where;
$count = $dtls['tot'];
unset($dtls['tot']);

if (!isset($pgajxobj)) {
    require_once(SITE_CLASS_GEN . "class.paging-ajax.php");
    $pgajxobj = new Paging($count, $page, "listrfq2award", $REC_LIMIT_FRONT);
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