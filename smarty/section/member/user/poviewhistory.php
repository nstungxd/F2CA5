<?php
include(S_SECTIONS."/member/memberaccess.php");
if(!isset($orgUserObj)) {
     include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
     $orgUserObj =	new OrganizationUser();
}
if(!isset($userToVerifyObj)) {
     include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
     $userToVerifyObj = new OrganizationUserToverify();
}
if(!isset($orgObj))
{
     include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
     $orgObj = new Organization();
}
if(!isset($pohObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
	$pohObj =	new PurchaseOrderHeading();
}

$iPoId = GetVar('id');
$podtls = $pohObj->select($iPoId);
$pohistory = $pohObj->getHistory($iPoId,$curORGID); 	// ,$curORGID
// prints($pohistory); exit;
$smarty->assign('podtls',$podtls);
$smarty->assign('pohistory',$pohistory);
?>