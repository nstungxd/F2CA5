<?php
$iAssociationId = GetVar('id');
/*if($sess_usertype == 'orgadmin' && $asoc != $iAssociationId) {
   header("Location: ".SITE_URL_DUM."oadashboard");
   exit;
}*/
if(!isset($b2saObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Supplier_Association.php");
	$b2saObj = new Buyer2_Supplier_Association();
}
if(!isset($b2savObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Supplier_Association_ToVerify.php");
	$b2savObj = new Buyer2_Supplier_Association_ToVerify();
}

$b2bprdtls = $b2saObj->select($iAssociationId);
$b2bprdthistory = $b2savObj->getHistory($iAssociationId);
// prints($b2bprdthistory); exit;

$smarty->assign('b2bprdtls', $b2bprdtls);
$smarty->assign('b2bprdthistory', $b2bprdthistory);
?>