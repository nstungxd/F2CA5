<?php

$mode = Postvar('mod');
$val = Postvar('val');
$sts = PostVar('sts');
$status = Postvar('status');

$vRFQ2Code = PostVar('vRFQ2Code');
$gmtoffset = PostVar('gmtoffset');
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
$fBestBid = PostVar('bestbid');
$eStatus = PostVar('eStatus');
//$dStartDate = calcGTzTimeFmo($dStartDate, 'Y-m-d', $gmtoffset);
//$dEndDate = calcGTzTimeFmo($dEndDate, 'Y-m-d', $gmtoffset); 
//$dStartDate = calcGTzTime($dStartDate, 'Y-m-d H:i:s');
//$dEndDate = calcGTzTime($dEndDate, 'Y-m-d H:i:s');
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
    if (trim($dStartDate) != '') {
        $where .= " AND DATE(rfq2.dStartDate)>=DATE('$dStartDate')";
    }
    if (trim($dEndDate) != '') {
        $where .= " AND DATE(rfq2.dEndDate)<='$dEndDate'";
    }
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
        if (strtolower(trim($eStatus)) == $smarty->get_template_vars('MSG_SAVED')) {
            $where .= " AND rfq2.eSaved='Yes' ";
        } else if (strtolower(trim($eStatus)) == $smarty->get_template_vars('LBL_VERIFIED')) {
            $where .= " AND (sm.vStatus_en LIKE 'Verify') AND rfq2.eSaved!='Yes' ";
        } else {
            $where .= " AND (sm.vStatus_en LIKE '%$eStatus%' OR sm.vStatus_fr LIKE '%$eStatus%') AND rfq2.eSaved!='Yes' ";
        }
    }
}
if ($status != 'all' && $status != '') {
    //
}

if ($sess_usertype_short == 'OU' || $sess_usertype_short == 'OA') {
    $where .= " AND rfq2.iOrganizationID=$curORGID ";
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
          LEFT JOIN " . PRJ_DB_PREFIX . "_rfq2_product_buyer2 rpb2 on rpb2.iRFQ2Id=rfq2.iRFQ2Id ";
$where .= " AND rfq2.iStatusID=$csts AND rfq2.eSaved!='Yes' ";
// echo $where; exit;
$fields = " DISTINCT rfq2.*, IF(rfq2.eFrom='Invoice',ioh.vInvoiceCode,poh.vPOCode) as vInvoiceCode, IF(rfq2.eFrom='Invoice',ioh.vBuyerName,poh.vBuyerCompanyName) as vBuyerName, IF(rfq2.eFrom='Invoice',ioh.vSupplierName,poh.vSupplierName) as vSupplierName, sm.vStatus_" . LANG . " as eStatus, 
					IF(rpb2.ePType='BProduct',(Select vProductName from " . PRJ_DB_PREFIX . "_bproduct_organization where iProductId=rpb2.ePType), (Select vProductName from " . PRJ_DB_PREFIX . "_sproduct_organization where iProductId=rpb2.ePType) ) as vProductName,
					IF(rfq2.dStartDate>NOW(), TIMESTAMPDIFF(DAY,NOW(),rfq2.dStartDate), 0) as rdays, IF(rfq2.dStartDate>NOW(), TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,NOW(),rfq2.dStartDate) - (TIMESTAMPDIFF(DAY,NOW(),rfq2.dStartDate) * 24*60*60) ), '%H:%i'), 0) as rtime ";
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