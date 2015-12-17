<?php
if(!isset($memobj)) {
	include_once(SITE_CLASS_APPLICATION."class.member.php");
	$memobj = new Member();
}

if(!isset($sendMail)) {
	include(SITE_CLASS_GEN."class.sendmail.php");
	$sendMail = new SendPHPMail();
}

$username = GetVar('username'); 	// username
$orgcode = GetVar('orgcode'); 	// orgcode

if(trim($orgcode) != '') {
   $memtype = 'orguser';
} else {
   $memtype = 'securitymanager';
}

//Check whether the entered username is available or not
$where = " AND vUserName='".$username."' ";
if($memtype == 'securitymanager') {
   $memArr = $generalobj->getTableInfo(PRJ_DB_PREFIX.'_security_manager',$where,'iSMID,vUserName,vFirstName,vLastName,vPassword,vEmail,eStatus','',"");
	$table = PRJ_DB_PREFIX.'_security_manager';
} else if($memtype == 'orguser') {
	$where .= " AND org.vCompCode='".$orgcode."' ";
   $memArr = $generalobj->getTableInfo(PRJ_DB_PREFIX.'_organization_user user INNER JOIN '.PRJ_DB_PREFIX.'_organization_master org on user.iOrganizationID=org.iOrganizationID',$where,'iUserID,vUserName,vFirstName,vLastName,vPassword,user.vEmail,user.iOrganizationID,user.vAnswer,user.eStatus','',"");
	$table = PRJ_DB_PREFIX.'_organization_user';
}
//
$msg = "";
if(is_array($memArr[0]) && count($memArr[0])>0) {
	if(! isset($memArr[0]['eStatus']) || $memArr[0]['eStatus']!='Active') {
		$msg = $smarty->get_template_vars('LBL_ACCOUNT_NOT_ACTIVE_OR_MODIFIED');
	} else {
		$activationcode = substr($memtype,0,1).'-'.md5($memArr[0]['vEmail'].time());
		if($memtype == 'securitymanager') {
			$where = " iSMID=".$memArr[0]['iSMID']." ";
		} else {
			$where = " iUserID=".$memArr[0]['iUserID']." ";
		}
		$dbobj->MySQLQueryPerform($table, array('vActivationCode'=>$activationcode), 'update', $where);
		$bodyarray = array("#NAME#","#SITE_NAME#","#LINK","#MAIL_FOOTER#","#SITE_URL#");
		$name = $memArr[0]['vUserName'];
		$email = $memArr[0]['vEmail'];
		$link = SITE_URL_DUM."forgotpass".'/'.$activationcode;
		$postarray = array($name,$SITE_NAME,$link,$MAIL_FOOTER,SITE_URL_DUM);
		$rs = $sendMail->Send('Forgot Password Link','Member',$email,$bodyarray,$postarray);
		$msg = $smarty->get_template_vars('LBL_LINK_TO_CHANGE_PASSWORD_EMAILED');
	}
} else {
	$msg = $smarty->get_template_vars('LBL_WRONG_USER_DETAILS');
}
echo $msg;
exit;
?>