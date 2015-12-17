<?php
// print_r($_GET);exit;
if(!isset($secManObj)) {
   require_once(SITE_CLASS_APPLICATION."class.Organization.php");
   $orgObj = new Organization();
}
if(!isset($orgUsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUsrObj = new OrganizationUser();
}
if(!isset($orgvrfObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization_Toverify.php");
   $orgvrfObj =	new Organization_Toverify();
}
if(!isset($userToVerifyObj)) {
	include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
	$userToVerifyObj = new OrganizationUserToverify();
}
if(!isset($orgprefObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj =	new OrganizationPreference();
}
if(!isset($orgPrefVrfObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreferenceToverify.php");
	$orgPrefVrfObj = new OrganizationPreferenceToverify();
}

$activationcode = GetVar('msg');
if(trim($activationcode)=='') {
   header("Location: ".SITE_URL_DUM."home");
   exit;
}

//$id = $orgObj->getid($activationcode);
$where = " vActivationCode='$activationcode' ";
$data['eStatus'] = 'Active';
$data['vActivationCode'] = '';
$dtls = $orgObj->getDetails('*', ' AND '.$where);
if(is_array($dtls) && count($dtls)>0 && isset($dtls[0]['iOrganizationID']) && $dtls[0]['iOrganizationID']>0) {
   $rs = $orgObj->updateData($data, $where);
   $r = $orgUsrObj->updateData($data, $where);
	// unset($data['vActivationCode']);
	$s = $orgvrfObj->updateData($data, $where);
	$s = $userToVerifyObj->updateData($data, $where);
	unset($data['vActivationCode']);
	$where = " iOrganizationID = ".$dtls[0]['iOrganizationID']."";
	$s = $orgprefObj->updateData($data, $where);
	$opdtls = $orgprefObj->getDetails('*', ' AND '.$where);
	if(isset($opdtls[0]['iAdditionalInfoID']) && $opdtls[0]['iAdditionalInfoID'] >0) {
		$where = " iAdditionalInfoID = ".$opdtls[0]['iAdditionalInfoID']."";
		$s = $orgPrefVrfObj->updateData($data, $where);
	}
} else {
   header("Location: ".SITE_URL_DUM."home");
   exit;      
}
?>