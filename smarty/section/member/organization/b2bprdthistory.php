<?php
$iAssociationId = GetVar('id');
/*if($sess_usertype == 'orgadmin') { 	// && $asoc != $iAssociationId
   header("Location: ".SITE_URL_DUM."oadashboard");
   exit;
}*/
if(!isset($b2bpaObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_BProduct_Association.php");
	$b2bpaObj = new Buyer2_BProduct_Association();
}
if(!isset($b2bpavObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_BProduct_Association_ToVerify.php");
	$b2bpavObj = new Buyer2_BProduct_Association_ToVerify();
}

$b2bprdtls = $b2bpaObj->select($iAssociationId);
$b2bprdthistory = $b2bpavObj->getHistory($iAssociationId);
// prints($b2bprdthistory); exit;

$smarty->assign('b2bprdtls', $b2bprdtls);
$smarty->assign('b2bprdthistory', $b2bprdthistory);
?>