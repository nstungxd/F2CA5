<?php

include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($orgAssocObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
	$orgAssocObj = new OrganizationAssociation();
}
if(!isset($orgAssocVerifyObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociationToVerify.php");
    $orgAssocVerifyObj =	new OrganizationAssociationToVerify();
}

$iAsociationID = $_GET['id'];
$asocdt = $orgAssocObj->select($iAsociationID);

$vAsocode = $asocdt[0]['vAssociationCode'];

$asochistory = $orgAssocVerifyObj->getHistory($vAsocode);
// prints($asochistory); exit;

$smarty->assign('vAsocode',$vAsocode);
$smarty->assign('asochistory',$asochistory);

?>