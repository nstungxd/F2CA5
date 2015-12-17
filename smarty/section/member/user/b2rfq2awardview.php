<?php

if (!isset($r2bdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/" . "class.Rfq2Bids.php");
    $r2bdObj = new Rfq2Bids();
}
if (!isset($rpb2Obj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2ProductBuyer2.php");
    $rpb2Obj = new Rfq2ProductBuyer2();
}
if (!isset($rfq2fObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Files.php");
    $rfq2fObj = new Rfq2Files();
}
if (!isset($rfq2Obj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2Master.php");
    $rfq2Obj = new RFQ2Master();
}
if (!isset($rfq2awObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Award.php");
    $rfq2awObj = new Rfq2Award();
}
if (!isset($invoiceorderObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderAttachment.php");
    $invoiceorderObj = new InvoiceOrderAttachment();
}
if (!isset($r2bdflObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2BidFiles.php");
    $r2bdflObj = new RFQ2BidFiles();
}
if (!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.OrganizationPreference.php");
    $orgprefObj = new OrganizationPreference();
}
if (!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUserPermission.php");
    $orgUserPermObj = new OrganizationUserPermission();
}
if (!isset($statusmasterObj)) {
    include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
    $statusmasterObj = new StatusMaster();
}

$iAwardId = GetVar('id');

$jtbl = " INNER JOIN " . PRJ_DB_PREFIX . "_rfq2_master rfq2 on r2aw.iRFQ2Id=rfq2.iRFQ2Id
            INNER JOIN " . PRJ_DB_PREFIX . "_rfq2_bids r2bd ON r2bd.iBidId=r2aw.iBidId
            LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ih ON rfq2.iInvoiceID=ih.iInvoiceID
                LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_heading ph ON rfq2.iPurchaseOrderID=ph.iPurchaseOrderID
				LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm ON sm.iStatusID=r2aw.iStatusID
				LEFT JOIN " . PRJ_DB_PREFIX . "_organization_master org ON org.iOrganizationID=r2bd.iBuyer2Id";
$where = " AND r2aw.iAwardId=$iAwardId ";
$bdtls = $rfq2awObj->getJoinTableInfo($jtbl, " DISTINCT *, ph.vPOCode, r2aw.iAwardId, rfq2.iOrganizationID, org.vCompanyName as vBuyer2, r2aw.iStatusID, r2aw.iaStatusID, sm.vStatus_en as status, sm.vStatus_" . LANG . " as eStatus, r2aw.eSaved, r2aw.eDelete, r2aw.iModifiedById ", "$where", "", "", "", "");
// pr($bdtls); exit;
if ((!(is_array($bdtls) && count($bdtls) > 0)) || trim($bdtls[0]['iBidId']) == '' || $bdtls[0]['iBidId'] < 1 || trim($bdtls[0]['iRFQ2Id']) == '' || $bdtls[0]['iRFQ2Id'] < 1) {
    header("Location: " . SITE_URL_DUM . "rfq2awardlist");
    exit;
}
// pr($bdtls); exit;
$rfq2bidfilearr = array();
$rfq2bidfiles = $r2bdflObj->getDetails("*", " AND iBidId=" . $bdtls[0]['iBidId']);
if (is_array($rfq2bidfiles) && count($rfq2bidfiles) > 0) {
    for ($l = 0; $l < count($rfq2bidfiles); $l++) {
        if (is_file($cfgimg['rfq2bid']['docs']['path'] . $rfq2bidfiles[$l]['iBidId'] . '/' . $rfq2bidfiles[$l]['vFile'])) {
            $bidfiles = $rfq2bidfiles[$l]['vFile'];
            $no = strpos($bidfiles, "_", "_");
            $bidfiles = substr($bidfiles, $no + 1);
            $no = strpos($bidfiles, "_", "_");
            $bidfiles = substr($bidfiles, $no + 1);
            $rfq2bidfilearr[$l]['iFileId'] = $rfq2bidfiles[$l]['iBidFileId'];
            $rfq2bidfilearr[$l]['vFileName'] = $bidfiles;
            $rfq2bidfilearr[$l]['vFile'] = $cfgimg['rfq2bid']['docs']['url'] . $rfq2bidfiles[$l]['iBidId'] . '/' . $rfq2bidfiles[$l]['vFile'];
        }
    }
}

$rfq2file = $rfq2fObj->getDetails('*', " AND iRFQ2Id='" . $bdtls[0]['iRFQ2Id'] . "'");
// $cfgimg['rfq2']['docs']['path'].$dtls[0]['iRFQ2Id'].'/'.$rfq2file[0]['vFile'];
$rfq2files = array();
if (is_array($rfq2file) && count($rfq2file) > 0) {
    for ($l = 0; $l < count($rfq2file); $l++) {
        if (is_file($cfgimg['rfq2']['docs']['path'] . $rfq2file[0]['iRFQ2Id'] . '/' . $rfq2file[0]['vFile'])) {
            $bidfiles = $rfq2file[$l]['vFile'];
            $no = strpos($bidfiles, "_", "_");
            $bidfiles = substr($bidfiles, $no + 1);
            $no = strpos($bidfiles, "_", "_");
            $bidfiles = substr($bidfiles, $no + 1);
            $rfq2files[$l]['filename'] = $bidfiles;
            $rfq2files[$l]['fileurl'] = $cfgimg['rfq2']['docs']['url'] . $rfq2file[0]['iRFQ2Id'] . '/' . $rfq2file[$l]['vFile'];
        }
    }
}

$rfq2pb2_dtls = $rpb2Obj->getDetails('*', " AND iRFQ2Id='" . $bdtls[0]['iRFQ2Id'] . "'");
// pr($rfq2pb2_dtls); exit;
$product_dtls = array();
$buyer2_dtls = array();
if (is_array($rfq2pb2_dtls) && count($rfq2pb2_dtls) > 0) {
    if (isset($rfq2pb2_dtls[0]['iProductId']) && $rfq2pb2_dtls[0]['iProductId'] > 0) {
        if (isset($rfq2pb2_dtls[0]['ePType']) && $rfq2pb2_dtls[0]['ePType'] == 'BProduct') {
            if (!isset($bproductObj)) {
                include_once(SITE_CLASS_APPLICATION . 'productorganization/class.BProductOrganization.php');
                $bproductObj = new BProductOrganization();
            }
            $product_dtls = $bproductObj->select($rfq2pb2_dtls[0]['iProductId']);
        } else if (isset($rfq2pb2_dtls[0]['ePType']) && $rfq2pb2_dtls[0]['ePType'] == 'SProduct') {
            if (!isset($sproductObj)) {
                include_once(SITE_CLASS_APPLICATION . 'productorganization/class.SProductOrganization.php');
                $sproductObj = new SProductOrganization();
            }
            $product_dtls = $sproductObj->select($rfq2pb2_dtls[0]['iProductId']);
            //pr($product_dtls);exit;
        }
    }
}
// pr($product_dtls); exit;
// pr($bdtls); exit;

$b2rfq2sts = "";
if (isset($bdtls[0]['iRFQ2Id']) && $bdtls[0]['iRFQ2Id'] > 0) {
    $b2rfq2sts = $rfq2Obj->getB2Rfq2Status($bdtls[0]['iRFQ2Id']);
}

$vreq = 'n';
$permitted = 'n';
$asts = $statusmasterObj->getDetails('*', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Auth3' ");
$asts = $asts[0]['iStatusID'];
$acpt_sts = $statusmasterObj->getDetails('*', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Accepted' ");
$acpt_sts = $acpt_sts[0]['iStatusID'];
// $orgprf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$dtls[0]['iOrganizationID']);
if (($bdtls[0]['iStatusID'] <= $asts && $bdtls[0]['iaStatusID'] < $acpt_sts && $bdtls[0]['eStatus'] != 'Rejected') && $bdtls[0]['eSaved'] != 'Yes' && $b2rfq2sts != 'cancelled') {  // && $orgprf[0]['eRFQ2VerifyReq']=='Yes'
    $vreq = 'y';
    if ($bdtls[0]['iModifiedById'] != $sess_id && $bdtls[0]['iOrganizationID'] == $curORGID) {
        $rfq2vp = $orgUserPermObj->getUserR2Permits($sess_id, "%RFQ2 Award,%", "vRFQ2AwardPermits");
        $onp = $orgprefObj->getNextStatus($curORGID, $bdtls[0]['iStatusID'], "vRFQ2AwardStatusLevel", 'y');
        $nsts = key($onp);
        if (isset($rfq2vp[$onp[$nsts]]) && $rfq2vp[$onp[$nsts]] == 'y') {
            $permitted = 'y';
        }
    } else if ($bdtls[0]['iModifiedById'] != $sess_id && $bdtls[0]['iBuyer2Id'] == $curORGID) {
        $rfq2vp = $orgUserPermObj->getUserR2Permits($sess_id, "%RFQ2 Award,%", "vRFQ2AwardAcceptPermits");
        if ($bdtls[0]['iaStatusID'] == 0) {
            $onp[$acpt_sts] = 'Accepted';
        } else {
            $onp = $orgprefObj->getNextStatus($curORGID, $bdtls[0]['iaStatusID'], "vRFQ2AwardAcceptLevel", 'y');
        }
        // pr($onp); exit;
        $nsts = key($onp);
        if (isset($rfq2vp[$onp[$nsts]]) && $rfq2vp[$onp[$nsts]] == 'y') {
            $permitted = 'y';
        }
    }
}
$stsmsg = '';
if ($permitted == 'y') {
    $stsmsg = $statusmasterObj->getDetails('vStatusMsg_' . LANG . ' as vStatusMsg, vStatus_' . LANG . ' as vStatus', " AND iStatusID=$nsts ");
    $nstsz = $stsmsg[0]['vStatus'];
    $stsmsg = $stsmsg[0]['vStatusMsg'];
    $smarty->assign("nstsz", $nstsz);
}
// pr($permitted); exit;
//
$smarty->assign("iAwardId", $iAwardId);
$smarty->assign("rfq2pb2_dtls", $rfq2pb2_dtls);
$smarty->assign('rfq2bidfiles', $rfq2bidfilearr);
$smarty->assign("bdtls", $bdtls);
$smarty->assign("rfq2sts", $b2rfq2sts);
$smarty->assign("product_dtls", $product_dtls);
$smarty->assign("rfq2files", $rfq2files);
$smarty->assign("asts", $asts);
$smarty->assign("vreq", $vreq);
$smarty->assign("permitted", $permitted);
$smarty->assign("stsmsg", $stsmsg);
?>