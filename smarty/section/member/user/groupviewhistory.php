<?php
include(S_SECTIONS."/member/memberaccess.php");

$iGroupID = GetVar('id');

if(!isset($orgGroupObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
    $orgGroupObj =	new OrganizationGroup();
}
if(!isset($orgGroupVerifyfObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroupToVerify.php");
    $orgGroupVerifyfObj =	new OrganizationGroupToVerify();
}

$grpdtls = $orgGroupObj->select($iGroupID);
$grouphistory = $orgGroupVerifyfObj->getHistory($iGroupID);

$smarty->assign('grpdtls',$grpdtls);
$smarty->assign('grouphistory',$grouphistory);
?>