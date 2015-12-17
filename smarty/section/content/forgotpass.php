<?php
// s-1e7f60b0645e7f78ddb5f136789310a3
$activationcode = GetVar('msg');
if(trim($activationcode)=='') {
	header("Location: ".SITE_URL_DUM."home");
   exit;
}

$where = " AND vActivationCode='$activationcode' "; 	// AND eStatus='Active'
$mtyp = substr($activationcode,0,2);
if($mtyp == 's-') {
	$dtls = $generalobj->getTableInfo(PRJ_DB_PREFIX.'_security_manager',$where,'iSMID as id,vUserName,vFirstName,vLastName,vPassword,vEmail,eStatus','',"");
} else if($mtyp == 'o-') {
	$dtls = $generalobj->getTableInfo(PRJ_DB_PREFIX.'_organization_user user INNER JOIN '.PRJ_DB_PREFIX.'_organization_master org on user.iOrganizationID=org.iOrganizationID',$where,'iUserID as id,vUserName,vFirstName,vLastName,vPassword,user.vEmail,user.iOrganizationID,user.vAnswer,user.eStatus','',"");
}

if(is_array($dtls[0]) && count($dtls[0])>0 && isset($dtls[0]['id']) && $dtls[0]['id']>0 && isset($dtls[0]['eStatus'])) {
	if($dtls[0]['eStatus']!='Active') {
		header("Location: ".SITE_URL_DUM."home/ina");
		exit;
	}
	if(!isset($gencaptchaObj)) {
		include_once(SITE_CLASS_GEN."class.gencaptcha.php");
		$gencaptchaObj =	new gencaptcha();
	}
	$smarty->assign('gencaptchaObj',$gencaptchaObj);
} else {
	header("Location: ".SITE_URL_DUM."home");
   exit;
}
?>