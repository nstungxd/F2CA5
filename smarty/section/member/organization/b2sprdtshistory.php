<?php
$iAssociationId = GetVar('id');
/*if($sess_usertype == 'orgadmin' && $asoc != $iAssociationId) {
   header("Location: ".SITE_URL_DUM."oadashboard");
   exit;
}*/
if(!isset($b2spsObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Supplier_SProduct_Association.php");
	$b2spsObj = new Buyer2_Supplier_SProduct_Association();
}
if(!isset($b2spsvObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Supplier_SProduct_Association_ToVerify.php");
	$b2spsvObj = new Buyer2_Supplier_SProduct_Association_ToVerify();
}

$b2bprdtls = $b2spsObj->select($iAssociationId);
$b2bprdthistory = $b2spsvObj->getHistory($iAssociationId);
// prints($b2bprdthistory); exit;

$smarty->assign('b2bprdtls', $b2bprdtls);
$smarty->assign('b2bprdthistory', $b2bprdthistory);
?>