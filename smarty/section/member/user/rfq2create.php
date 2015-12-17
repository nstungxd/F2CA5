<?php

$irfq2id = GetVar('id');
$msg = GetVar('msg');
if (!isset($rfq2Obj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2Master.php");
    $rfq2Obj = new RFQ2Master();
}
if (!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.OrganizationPreference.php");
    $orgprefObj = new OrganizationPreference();
}
if (!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUserPermission.php");
    $orgUserPermObj = new OrganizationUserPermission();
}

if ($msg == 'pb2m') {
    $msg = $smarty->get_template_vars('MSG_PRODUCT_BUYER2_MISMATCH');
}

$invoiceid = 0;
$view = 'add';
if (trim($irfq2id) != '' && $irfq2id > 0 && $msg != 'i') {
    $view = 'edit';
    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
                  LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID 
                      LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading poh on rfq2.iPurchaseOrderID=poh.iPurchaseOrderID";
    $where .= " AND rfq2.iRFQ2ID=$irfq2id ";
    $fields = " rfq2.*, ioh.*, rfq2.iPurchaseOrderID, poh.vPOCode, poh.vBuyerCompanyName,poh.vSupplierName as poh_vSupplierName, poh.fPOTotal, sm.vStatus_en as vStatus, rfq2.eSaved, rfq2.eDelete ";
    $dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where, '', '', '', '');
    //pr($dtls); exit;
    // $orgprf = $orgprefObj->select($dtls[0]['iOrganizationID']);
    if ((isset($dtls[0]['eAuctionStatus']) && strtolower($dtls[0]['eAuctionStatus']) == 'cancelled') || (isset($dtls[0]['iOrganizationID']) && $dtls[0]['iOrganizationID'] != $curORGID)) {
        header("Location: " . SITE_URL_DUM . "rfq2view/$irfq2id");
        exit;
    }

    if (!is_array($dtls) || count($dtls) < 1) {
        header("Location: " . SITE_URL_DUM . "rfq2list/rnme");
        exit;
    }

    if (!isset($statusmasterObj)) {
        include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
        $statusmasterObj = new StatusMaster();
    }
    $crsts = $statusmasterObj->getDetails('*', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Create' ");
    $crsts = $crsts[0]['iStatusID'];

    if (($dtls[0]['vStatus'] == 'Create' || $dtls[0]['vStatus'] == 'Verify' || $dtls[0]['eDelete'] == 'Yes') && $dtls[0]['eSaved'] != 'Yes') {  // && $orgprf[0]['eRFQ2VerifyReq']=='Yes'
        header("Location: " . SITE_URL_DUM . "rfq2view/$irfq2id");
        exit;
    }

    $orgprf = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $dtls[0]['iOrganizationID']);

    $rfq2files = $rfq2Obj->getRfq2Files($irfq2id);
    $rfq2prdt = $rfq2Obj->getRfq2Product($irfq2id);
    $rfq2pb2asoc = $rfq2Obj->getRfq2PB2Asoc($irfq2id);
    $rfq2b2 = $rfq2Obj->getRfq2B2($irfq2id);

    $orgas = "";
    if ($dtls[0]['iBuyerID'] == $curORGID) {
        $orgas = "Buyer";
    } else if ($dtls[0]['iSupplierID'] == $curORGID) {
        $orgas = "Supplier";
    }
    //

    $acptsts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Accepted' ");
    $acptsts = $acptsts[0]['iStatusID'];
    $dtls[0]['iInvoiceID'] = (isset($dtls[0]['iInvoiceID'])) ? $dtls[0]['iInvoiceID'] : '0';
    $invsc = "";
    if (trim($dtls[0]['iInvoiceID']) != '' && $dtls[0]['iInvoiceID'] > 0) {
        $invsc = " OR iInvoiceID=" . $dtls[0]['iInvoiceID'] . " ";
    }
    $posc = "";
    if (trim($dtls[0]['iPurchaseOrderID']) != '' && $dtls[0]['iPurchaseOrderID'] > 0) {
        $posc = " OR iPurchaseOrderID=" . $dtls[0]['iPurchaseOrderID'] . " ";
    }
    $invCombAry = array(
        "ID" => "iInvoiceID",
        "Name" => "Data[iInvoiceID]",
        "Type" => "Query",
        "tableName" => "" . PRJ_DB_PREFIX . "_inovice_order_heading",
        "fieldId" => "iInvoiceID",
        "fieldName" => "vInvSupplierCode",
        "extVal" => '',
        "selectedVal" => $dtls[0]['iInvoiceID'],
        "width" => '210px',
        "height" => '',
        "onchange" => '',
        "selectText" => "--- " . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_INVOICE') . " ---",
        "where" => " iStatusID='$acptsts' AND iaStatusID='$acptsts' AND (iBuyerOrganizationID=$curORGID OR iSupplierOrganizationID=$curORGID) AND eRfq2Awarded='No' AND iInvoiceID NOT IN (SELECT iInvoiceID FROM " . PRJ_DB_PREFIX . "_rfq2_master WHERE eFrom='Invoice' AND eDelete!='Verified' AND eAuctionStatus!='Cancelled') $invsc ",
        "multiple_select" => "",
        "orderby" => 'vInvSupplierCode',
        "validationmsg" => '',
        "extra" => " title='" . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_INVOICE') . "' ",
        "class" => "required"
    );
    $invoices = $gdbobj->DynamicDropDown($invCombAry);
    $smarty->assign('invoices', $invoices);
    //
    $pacptsts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Accepted' ");
    $pacptsts = $pacptsts[0]['iStatusID'];
    $poCombAry = array(
        "ID" => "iPurchaseOrderID",
        "Name" => "Data[iPurchaseOrderID]",
        "Type" => "Query",
        "tableName" => "" . PRJ_DB_PREFIX . "_purchase_order_heading",
        "fieldId" => "iPurchaseOrderID",
        "fieldName" => "vPoBuyerCode",
        "extVal" => '',
        "selectedVal" => $dtls[0]['iPurchaseOrderID'],
        "width" => '210px',
        "height" => '',
        "onchange" => '',
        "selectText" => "--- " . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_PO') . " ---",
        "where" => " iStatusID='$pacptsts' AND iaStatusID='$pacptsts' AND (iBuyerOrganizationID=$curORGID OR iSupplierOrganizationID=$curORGID) AND eRfq2Awarded='No' AND iPurchaseOrderID NOT IN (SELECT iPurchaseOrderID FROM " . PRJ_DB_PREFIX . "_rfq2_master WHERE eFrom='PO' AND eDelete!='Verified' AND eAuctionStatus!='Cancelled') AND (Select COUNT(iInvoiceID) from " . PRJ_DB_PREFIX . "_inovice_order_heading where iPurchaseOrderID=" . PRJ_DB_PREFIX . "_purchase_order_heading.iPurchaseOrderID AND iStatusID='$acptsts' AND iaStatusID='$acptsts' AND (iBuyerOrganizationID=$curORGID OR iSupplierOrganizationID=$curORGID) $invsc) < 1 $posc ",
        "multiple_select" => "",
        "orderby" => 'vPoBuyerCode',
        "validationmsg" => '',
        "extra" => " title='" . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_PO') . "' ",
        "class" => "required"
    );
    $pos = $gdbobj->DynamicDropDown($poCombAry);
    $smarty->assign('pos', $pos);
    //
    // pr($rfq2prdt); exit;
    $smarty->assign('dtls', $dtls);
    $smarty->assign('orgprf', $orgprf);
    $smarty->assign('rfq2b2', $rfq2b2);
    $smarty->assign('rfq2files', $rfq2files);
    $smarty->assign('rfq2prdt', $rfq2prdt);
    $smarty->assign('rfq2pb2asoc', $rfq2pb2asoc);
} else {
    if ($irfq2id > 0 && $msg == 'i') {
        $invoiceid = $irfq2id;
        $irfq2id = 0;
    }
    if (!isset($statusmasterObj)) {
        include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
        $statusmasterObj = new StatusMaster();
    }
    $acptsts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Accepted' ");
    $acptsts = $acptsts[0]['iStatusID'];

    $invCombAry = array(
        "ID" => "iInvoiceID",
        "Name" => "Data[iInvoiceID]",
        "Type" => "Query",
        "tableName" => "" . PRJ_DB_PREFIX . "_inovice_order_heading",
        "fieldId" => "iInvoiceID",
        "fieldName" => "vInvSupplierCode",
        "extVal" => '',
        "selectedVal" => "$invoiceid",
        "width" => '',
        "height" => '',
        "onchange" => '',
        "selectText" => "--- " . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_INVOICE') . " ---",
        "where" => " iStatusID='$acptsts' AND iaStatusID='$acptsts' AND (iBuyerOrganizationID=$curORGID OR iSupplierOrganizationID=$curORGID) AND eRfq2Awarded='No' AND iInvoiceID NOT IN (SELECT iInvoiceID FROM " . PRJ_DB_PREFIX . "_rfq2_master WHERE eDelete!='Verified' AND eAuctionStatus!='Cancelled') OR iInvoiceID=$invoiceid ",
        "multiple_select" => "",
        "orderby" => 'vInvSupplierCode',
        "validationmsg" => '',
        "extra" => " title='" . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_INVOICE') . "' ",
        "class" => "form-control"
    );
    $invoices = $gdbobj->DynamicDropDown($invCombAry);
    $smarty->assign('invoices', $invoices);
    //
    $pacptsts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Accepted' ");
    $pacptsts = $pacptsts[0]['iStatusID'];
    $poCombAry = array(
        "ID" => "iPurchaseOrderID",
        "Name" => "Data[iPurchaseOrderID]",
        "Type" => "Query",
        "tableName" => "" . PRJ_DB_PREFIX . "_purchase_order_heading",
        "fieldId" => "iPurchaseOrderID",
        "fieldName" => "vPoBuyerCode",
        "extVal" => '',
        "selectedVal" => $dtls[0]['iPurchaseOrderID'],
        "width" => '',
        "height" => '',
        "onchange" => '',
        "selectText" => "--- " . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_PURCHASE_ORDER') . " ---",
        "where" => " iStatusID='$pacptsts' AND iaStatusID='$pacptsts' AND (iBuyerOrganizationID=$curORGID OR iSupplierOrganizationID=$curORGID) AND eRfq2Awarded='No' AND iPurchaseOrderID NOT IN (SELECT iPurchaseOrderID FROM " . PRJ_DB_PREFIX . "_rfq2_master WHERE eFrom='PO' AND eDelete!='Verified' AND eAuctionStatus!='Cancelled') AND (Select COUNT(iInvoiceID) from " . PRJ_DB_PREFIX . "_inovice_order_heading where iPurchaseOrderID=" . PRJ_DB_PREFIX . "_purchase_order_heading.iPurchaseOrderID AND iStatusID='$acptsts' AND iaStatusID='$acptsts' AND (iBuyerOrganizationID=$curORGID OR iSupplierOrganizationID=$curORGID) $invsc) < 1 $posc ",
        "multiple_select" => "",
        "orderby" => 'vPoBuyerCode',
        "validationmsg" => '',
        "extra" => " title='" . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_PO') . "' ",
        "class" => "form-control"
    );
    $pos = $gdbobj->DynamicDropDown($poCombAry);
    # pr($pos); exit;
    $smarty->assign('pos', $pos);
    //
}

if ($sess_usertype_short == 'OA') {
    header("Location: " . SITE_URL_DUM . "rfq2view/$irfq2id");
    exit;
}

if ($sess_usertype_short == 'OU' && $uorg_type != 'Buyer2' && $uorg_type != 'SM') {
    $ur2p = $orgUserPermObj->getUserR2Permits($sess_id, '%,RFQ2 Award,%', 'vRFQ2Permits');
    if ($ur2p['Create'] != 'y') {
        header("Location: " . SITE_URL_DUM . "rfq2list");
        exit;
    }
}

$dtls[0]['eAuctionType'] = (isset($dtls[0]['eAuctionType'])) ? $dtls[0]['eAuctionType'] : '';
$dtls[0]['eBidCriteria'] = (isset($dtls[0]['eBidCriteria'])) ? $dtls[0]['eBidCriteria'] : '';
$rfq2type = $gdbobj->getEnumSelect(PRJ_DB_PREFIX . "_rfq2_master", "eAuctionType", "Data[eAuctionType]", "eAuctionType", "", "" . $dtls[0]['eAuctionType'] . "", "style='' class='form-control' title='" . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_TYPE') . "' ", "Select Type", "");
$bidtype = $gdbobj->getEnumSelect(PRJ_DB_PREFIX . "_rfq2_master", "eBidCriteria", "Data[eBidCriteria]", "eBidCriteria", "", "" . $dtls[0]['eBidCriteria'] . "", "style='' class='form-control' title='" . $smarty->get_template_vars('LBL_SELECT') . ' ' . $smarty->get_template_vars('LBL_BID_EVALUATION_CRITERIA') . "' ", "Select Bid Evaluation Criteria", "");

// echo date('Y-m-d H:i:s');

$smarty->assign('view', $view);
$smarty->assign('irfq2id', $irfq2id);
$smarty->assign('bidtype', $bidtype);
$smarty->assign('rfq2type', $rfq2type);
?>
<?php

/*
  <!--{*
  $("#dStartDate").attr('readonly','readonly');
  $("#dStartDate").datetimepicker({
  dateFormat: 'yy-mm-dd',
  timeFormat: 'hh:mm:ss',
  showOn: "button",
  buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
  buttonImageOnly: true
  });
  $("#dEndDate").attr('readonly','readonly');
  $("#dEndDate").datetimepicker({
  dateFormat: 'yy-mm-dd',
  timeFormat: 'hh:mm:ss',
  showOn: "button",
  buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
  buttonImageOnly: true
  });
 * }-->
 */
?>