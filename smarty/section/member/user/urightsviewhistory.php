<?php

include(S_SECTIONS."/member/memberaccess.php");

$iUserID = $_GET['id'];

if(!isset($orgUserObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
   $orgUserObj =	new OrganizationUser();
}
if(!isset($orgUserPerObj)) {
   require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
   $orgUserPerObj = new OrganizationUserPermission();
}
if(!isset($orgUserPermVerifyObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermissionToVerify.php");
   $orgUserPermVerifyObj =	new OrganizationUserPermissionToVerify();
}

$usrdtls = $orgUserObj->select($iUserID);
$orgdtls = $orgObj->select($usrdtls[0]['iOrganizationID']);

$urightshistory = $orgUserPermVerifyObj->getHistory($iUserID);

$smarty->assign('usrdtls',$usrdtls);
$smarty->assign('urightshistory',$urightshistory);
?>