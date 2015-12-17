<?php  

include(S_SECTIONS."/member/memberaccess.php");

$pswd = GetVar('val');
$iUserId = GetVar('id');
$pswd = $generalobj->encrypt($pswd);
//prints($_GET); exit;

if($sess_usertype == 'securitymanager')
{
	//$id = $dbobj->MySQLQueryPerform(PRJ_DB_PREFIX."_security_manager",$data,'update',$where);
	$dt = $secManObj->select($iUserId);	// $secManObj->changePAssword($iMemberId,$vPassword);
	$vPassword = $secManObj->getvPassword();	
}
else if($sess_usertype == 'orguser' || $sess_usertype == 'orgadmin')
{
     $dt = $orgUsrObj->select($iUserId);
     $vPassword = $orgUsrObj->getvPassword();
}

if($pswd == $vPassword)
{
	echo 'true';
}
else
{
	echo 'false';
}
exit;
?>