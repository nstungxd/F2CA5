<?php
include(S_SECTIONS."/member/memberaccess.php");

$UserName=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];
$msg = $_GET['msg'];
$iInvoiceID = $_GET['id'];

if(!isset($InvLineObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceDetailLine.php");
	$InvLineObj =	new InvoiceDetailLine();
}
if(!isset($orgUserObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invOrdObj = new InvoiceOrderHeading();
}

if($msg!='pop') {
	$msg = '';
}

if(trim($iInvoiceID) != '' && is_numeric($iInvoiceID)) {
	$view = 'edit';
	$where = ' AND iInvoiceID = "'.$iInvoiceID.'"';
	$invoiceData = $InvLineObj->getDetails('*',$where);
	$invdtls = $invOrdObj->select($iInvoiceID);
	$isdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
	$isdtls = $isdtls[0]['iStatusID'];
	if(!(is_array($invoiceData) && count($invoiceData)>0)) {
		// header("Location: ".SITE_URL_DUM."invoicelist");
		// exit;
	}
	if($uorg_type=='Buyer2') {
		$b2us = $invOrdObj->getInvoiceRfq2Buyer2OrgIds($iInvoiceID);
		if(! in_array($curORGID,$b2us)) {
			header("Location: ".SITE_URL_DUM."invoicelist");
			exit;
		}
	} else if($invdtls[0]['iBuyerOrganizationID']!=$curORGID && $invdtls[0]['iSupplierOrganizationID']!=$curORGID) {
		header("Location: ".SITE_URL_DUM."invoicelist/all");
		exit;
	} else if($invdtls[0]['iBuyerOrganizationID']==$curORGID && $invdtls[0]['iStatusID']<$isdtls) {
		header("Location: ".SITE_URL_DUM."invoicelist/all");
		exit;
	}
}

$smarty->assign('msg',$msg);
$smarty->assign('view',$view);
$smarty->assign('invoiceData',$invoiceData);
$smarty->assign('invdtls',$invdtls);
$smarty->assign('iInvoiceID',$iInvoiceID);
?>