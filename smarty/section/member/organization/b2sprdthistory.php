<?php
$iAssociationId = GetVar('id');
/*if($sess_usertype == 'orgadmin' && $asoc != $iAssociationId) {
   header("Location: ".SITE_URL_DUM."oadashboard");
   exit;
}*/
if(!isset($b2spaObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_SProduct_Association.php");
	$b2spaObj = new Buyer2_SProduct_Association();
}
if(!isset($b2spavObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_SProduct_Association_ToVerify.php");
	$b2spavObj = new Buyer2_SProduct_Association_ToVerify();
}

$b2sprdtls = $b2spaObj->select($iAssociationId);
$b2sprdthistory = $b2spavObj->getHistory($iAssociationId);
// prints($b2sprdthistory); exit;

$smarty->assign('b2sprdtls', $b2sprdtls);
$smarty->assign('b2sprdthistory', $b2sprdthistory);
?>