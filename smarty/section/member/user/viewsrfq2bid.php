<?php

$iBidId = GetVar('id');
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
if (!isset($invoiceorderObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderAttachment.php");
    $invoiceorderObj = new InvoiceOrderAttachment();
}
if (!isset($r2bdflObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2BidFiles.php");
    $r2bdflObj = new RFQ2BidFiles();
}
if (!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUserPermission.php");
    $orgUserPermObj = new OrganizationUserPermission();
}

$jtbl = "INNER JOIN " . PRJ_DB_PREFIX . "_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id
            LEFT JOIN " . PRJ_DB_PREFIX . "_organization_user bu ON bu.iUserID=rfq2.iUserID
            LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ih ON rfq2.iInvoiceID=ih.iInvoiceID
                LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading poh on rfq2.iPurchaseOrderID=poh.iPurchaseOrderID
				LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm ON sm.iStatusID=r2bd.iStatusID ";
$where = "AND r2bd.iBidId=$iBidId";
$bdtls = $r2bdObj->getJoinTableInfo($jtbl, " DISTINCT *, ih.iInvoiceID, poh.vSupplierName as poh_vSupplierName, r2bd.eStatus, r2bd.eSaved, r2bd.eDelete, r2bd.iModifiedById ", "$where", "", "", "", "");
if (is_array($bdtls) && count($bdtls) > 0 && isset($bdtls[0]['iBidId']) && $bdtls[0]['iBidId'] > 0) {
    if ($uorg_type == 'Buyer2' && $bdtls[0]['iBuyer2Id'] != $curORGID) {
        header("Location: " . SITE_URL_DUM . "b2rfq2bidlist");
        exit;
    }
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
    $smarty->assign('rfq2bidfiles', $rfq2bidfilearr);
}
// prints($bdtls); exit;
$invoiceorderfile = $invoiceorderObj->getdetails('*', "AND iInvoiceID='" . $bdtls[0]['iInvoiceID'] . "'");
$invoiceorderfilearr = array();
if (is_array($invoiceorderfile) && count($invoiceorderfile) > 0) {
    for ($l = 0; $l < count($invoiceorderfile); $l++) {
        if (is_file($cfgimg['INV']['docs']['path'] . $invoiceorderfile[0]['iInvoiceID'] . '/' . $invoiceorderfile[0]['vFile'])) {
            $invoicefile = $invoiceorderfile[$l]['vFile'];
            $no = strpos($invoicefile, "_");
            $invoicefile = substr($invoicefile, $no + 1);
            $no = strpos($invoicefile, "_");
            $invoicefile = substr($invoicefile, $no + 1);
            $invoiceorderfilearr[$l]['filename'] = $invoicefile;
            $invoiceorderfilearr[$l]['fileurl'] = $cfgimg['INV']['docs']['url'] . $invoiceorderfile[0]['iInvoiceID'] . '/' . $invoiceorderfile[$l]['vFile'];
        }
    }
}
//prints($invoiceorderfilearr);exit;
//$rfq2file = $rfq2fObj->getDetails('*'," AND iRFQ2Id='".$bdtls[0]['iRFQ2Id']."'");
$rfq2file = $rfq2fObj->getDetails('*', " AND iRFQ2Id='" . $bdtls[0]['iRFQ2Id'] . "'");
$cfgimg['rfq2']['docs']['path'] . $dtls[0]['iRFQ2Id'] . '/' . $rfq2file[0]['vFile'];
$rfq2files = array();
if (is_array($rfq2file) && count($rfq2file) > 0) {
    for ($l = 0; $l < count($rfq2file); $l++) {
        if (is_file($cfgimg['rfq2']['docs']['path'] . $rfq2file[0]['iRFQ2Id'] . '/' . $rfq2file[0]['vFile'])) {
            $bidfiles = $rfq2file[$l]['vFile'];
            $no = strpos($bidfiles, "_", "_");
            $bidfiles = substr($bidfiles, $no + 1);
            $no = strpos($bidfiles, "_", "_");
            $bidfiles = substr($bidfiles, $no + 1);
            $rfq2files[$l][filename] = $bidfiles;
            $rfq2files[$l][fileurl] = $cfgimg['rfq2']['docs']['url'] . $rfq2file[0]['iRFQ2Id'] . '/' . $rfq2file[$l]['vFile'];
        }
    }
}
//pr($rfq2files);exit;
$rfq2pb2_dtls = $rpb2Obj->getDetails('*', " AND iRFQ2Id='" . $bdtls[0]['iRFQ2Id'] . "'");
//pr($rfq2pb2_dtls); 
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

$b2rfq2sts = "";
if (isset($bdtls[0]['iRFQ2Id']) && $bdtls[0]['iRFQ2Id'] > 0) {
    $b2rfq2sts = $rfq2Obj->getB2Rfq2Status($bdtls[0]['iRFQ2Id']);
}

$vreq = 'n';
$permitted = 'n';
// $orgprf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$dtls[0]['iOrganizationID']);
//echo $b2rfq2sts; exit;
if (($bdtls[0]['vStatus_en'] == 'Create' || $bdtls[0]['eDelete'] == 'Yes') && $bdtls[0]['eSaved'] != 'Yes' && $b2rfq2sts == 'live') {  // && $orgprf[0]['eRFQ2VerifyReq']=='Yes'
    $vreq = 'y';
    if ($bdtls[0]['iModifiedById'] != $sess_id && $bdtls[0]['iBuyer2Id'] == $curORGID) {
        $rfq2vp = $orgUserPermObj->getUserR2Permits($sess_id, "%RFQ2 Bid,%", "vRFQ2BidPermits");

        if (isset($rfq2vp['Verify']) && $rfq2vp['Verify'] == 'y') {
            $permitted = 'y';
        }
    }
}
// pr($permitted); exit;

$smarty->assign('iBidId', $iBidId);
$smarty->assign('bidarr', $bdtls);
$smarty->assign('rfq2pb2_dtls', $rfq2pb2_dtls);
$smarty->assign('productdtls', $product_dtls);
$smarty->assign('rfq2files', $rfq2files);
$smarty->assign('invoiceorder', $invoiceorderfilearr);
$smarty->assign('vreq', $vreq);
$smarty->assign('permitted', $permitted);
?>