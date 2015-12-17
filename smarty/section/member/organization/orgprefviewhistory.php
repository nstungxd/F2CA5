<?php

include(S_SECTIONS."/member/memberaccess.php");

$iOrganizationID = GetVar('id');

if($sess_usertype =='orgadmin' && $orgid != $iOrganizationID)
{
     header("Location: ".SITE_URL_DUM."oadashboard");
     exit;
}
if(!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
    $orgprefObj =	new OrganizationPreference();
}
if(!isset($orgPrefVrfObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreferenceToverify.php");
    $orgPrefVrfObj =	new OrganizationPreferenceToverify();
}
if(!isset($orgObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}

$orgdtls = $orgObj->select($iOrganizationID);
$orgprefhistory = $orgprefObj->getHistory($iOrganizationID);
// prints($orgprefhistory); exit;

$smarty->assign('orgdtls',$orgdtls);
$smarty->assign('orgprefhistory',$orgprefhistory);

?>