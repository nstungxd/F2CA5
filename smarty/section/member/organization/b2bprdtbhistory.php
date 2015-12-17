<?php
$iAssociationId = GetVar('id');
/*if($sess_usertype == 'orgadmin' && $asoc != $iAssociationId) {
   header("Location: ".SITE_URL_DUM."oadashboard");
   exit;
}*/
if(!isset($b2bpbObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_BProduct_Association.php");
	$b2bpbObj = new Buyer2_Buyer_BProduct_Association();
}
if(!isset($b2bpbvObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_BProduct_Association_ToVerify.php");
	$b2bpbvObj = new Buyer2_Buyer_BProduct_Association_ToVerify();
}

$b2bprdtls = $b2bpbObj->select($iAssociationId);
$b2bprdthistory = $b2bpbvObj->getHistory($iAssociationId);
// prints($b2bprdthistory); exit;

$smarty->assign('b2bprdtls', $b2bprdtls);
$smarty->assign('b2bprdthistory', $b2bprdthistory);
?>