<?php
$invid = GetVar('id');
$msg = GetVar('msg');

if(!isset($invOrderObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invOrderObj = new InvoiceOrderHeading();
}

$invdtls = $invOrderObj->select($invid);
if(trim($invid)!='' && $invid>0 && is_array($invdtls) && count($invdtls)>0) {
	// if(! isset($invdtls[0]['eSaved']) || $invdtls[0]['eSaved']!='Yes' || ! isset($invdtls[0]['eCreateByBuyer']) || $invdtls[0]['eCreateByBuyer']!='Yes') {
	if(! isset($invdtls[0]['eCreateByBuyer']) || $invdtls[0]['eCreateByBuyer']!='Yes' || ! isset($invdtls[0]['iaStatusID']) || $invdtls[0]['iaStatusID']>0) {
		$redirecturl = SITE_URL_DUM."invacptlist/".$msg;
		header("Location: $redirecturl");
		exit;
	}
} else {
	$redirecturl = SITE_URL_DUM."invacptlist/".$msg;
	header("Location: $redirecturl");
	exit;
}

if($msg=='invc') {
	$msg = $smarty->get_template_vars('MSG_INVOICE_CREATED');
}

$lineItemTax = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_inovice_order_heading", "eLineItemTax","Data[eLineItemTax]", "eLineItemTax","setT()", "".$invdtls[0]['eLineItemTax'].""," class='' ");
$invoiceType = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_inovice_order_heading", "eInvoiceType","Data[eInvoiceType]", "eInvoiceType","", "".$invdtls[0]['eInvoiceType'].""," ");

$smarty->assign('invid',$invid);
$smarty->assign('invoiceType',$invoiceType);
$smarty->assign('lineItemTax',$lineItemTax);
?>