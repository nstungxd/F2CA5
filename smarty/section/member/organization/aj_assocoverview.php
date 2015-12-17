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

$iAsociationID = $_GET['id'];
$view = 'verify';
$msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
$asocdtls = $orgAssocObj->select($iAsociationID);
$asocCode = $asocdtls[0]['vAssociationCode'];
$fields = " *, (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) as vBuyerOrg,
					(Select vCompanyName from b2b_organization_master where iOrganizationID=iSupplierAssocationID) as vSupplierOrg ";
$assorgdt = $orgAssocObj->getDetails($fields," AND vAssociationCode='$asocCode' ",'','','');
// prints($assorgdt); exit;
$smarty->assign('iAsociationID',$iAsociationID);
$smarty->assign('assorgdt',$assorgdt);
$smarty->assign('view',$view);
$smarty->assign('msg',$msg);
?>