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
if(!isset($iohObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$iohObj =	new InvoiceOrderHeading();
}

$iInvId = GetVar('id');
$invdtls = $iohObj->select($iInvId);
$invhistory = $iohObj->getHistory($iInvId,$curORGID);
// prints($invhistory); exit;

$smarty->assign('invdtls',$invdtls);
$smarty->assign('invhistory',$invhistory);
?>