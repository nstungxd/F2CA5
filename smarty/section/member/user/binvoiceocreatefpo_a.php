<?php
$invid = PostVar('iInvoiceID');
if(!isset($invOrderObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invOrderObj = new InvoiceOrderHeading();
}
$invdtls = $invOrderObj->select($invid);
if($view=='bifp' && trim($invid)!='' && $invid>0 && is_array($invdtls) && count($invdtls)>0 && isset($invdtls[0]['eSaved']) && $invdtls[0]['eSaved']=='Yes') {
	$Data = (isset($_POST['Data']))? $_POST['Data'] : array();
	$invdtls[0]['iaStatusID'] = '1';
	$Data['eSaved'] = 'No';
	$rs = $invOrderObj->updateData($Data," iInvoiceID=$invid ");
}
$msg = ''; 	// 'invc';
$redirecturl = SITE_URL_DUM."invacptlist/".$msg;
header("Location:".$redirecturl);
exit;
?>