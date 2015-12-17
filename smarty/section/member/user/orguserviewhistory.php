<?php

include(S_SECTIONS."/member/memberaccess.php");

$iUserID = GetVar('id');

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

$usrdtls = $orgUserObj->select($iUserID);
$orgdtls = $orgObj->select($usrdtls[0]['iOrganizationID']);

$usrhistory = $userToVerifyObj->getHistory($iUserID);
// prints($usrhistory); exit;

$smarty->assign('usrdtls',$usrdtls);
$smarty->assign('orgdtls',$orgdtls);
$smarty->assign('usrhistory',$usrhistory);
?>