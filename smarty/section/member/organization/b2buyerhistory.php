<?php
$iAssociationId = GetVar('id');
/*if($sess_usertype == 'orgadmin' && $asoc != $iAssociationId) {
   header("Location: ".SITE_URL_DUM."oadashboard");
   exit;
}*/
if(!isset($b2baObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_Association.php");
	$b2baObj = new Buyer2_Buyer_Association();
}
if(!isset($b2bavObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_Association_ToVerify.php");
	$b2bavObj = new Buyer2_Buyer_Association_ToVerify();
}

$b2bprdtls = $b2baObj->select($iAssociationId);
$b2bprdthistory = $b2bavObj->getHistory($iAssociationId);
// prints($b2bprdthistory); exit;

$smarty->assign('b2bprdtls', $b2bprdtls);
$smarty->assign('b2bprdthistory', $b2bprdthistory);
?>