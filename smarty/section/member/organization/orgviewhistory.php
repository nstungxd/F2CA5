<?php

include(S_SECTIONS."/member/memberaccess.php");

$iOrganizationID = GetVar('id');

if($sess_usertype =='orgadmin' && $orgid != $iOrganizationID)
{
     header("Location: ".SITE_URL_DUM."oadashboard");
     exit;
}
if(!isset($orgObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($orgvrfObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization_Toverify.php");
	$orgvrfObj = new Organization_Toverify();
}

$orgdtls = $orgObj->select($iOrganizationID);
$orghistory = $orgvrfObj->getHistory($iOrganizationID);
// prints($orghistory); exit;

$smarty->assign('orgdtls',$orgdtls);
$smarty->assign('orghistory',$orghistory);

?>