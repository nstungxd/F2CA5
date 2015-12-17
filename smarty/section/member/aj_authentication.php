<?php
// error_reporting(-1);
//member include class
require_once(SITE_CLASS_APPLICATION."class.member.php");
//initialize object of member
$memobj = new Member();

if (!isset($lgnprmobj)) {
    include_once(SITE_CLASS_APPLICATION . "class.loginParameter.php");
    $lgnprmobj = new LoginParameter();
}

include_once(SITE_CLASS_GEN."class.xmlparser.php");

//$val = '';
$fname = 'home';
$fromAdmin=  PostVar('fromadmin');
$fname=  PostVar('fname');
if($fname == '' || $fname == 'undefined') {
   $fname = 'home';
}
$Password = '';
if($fromAdmin == 'Yes'){
	$_SESSION['FROM_ADMIN'] = "Yes";
	$Password = PostVar('pswd');
} else {
	$pswd = $gdbobj->encrypt(PostVar('pswd'));
	$Password = $pswd;
}

//set post variable here
$orgcode	= PostVar('orgcode');
$username = PostVar('username');
$loginparameter = PostVar('loginParameter');
//$memtype	= PostVar('memtype');
$iPrId = 'iUserId';
if(trim($orgcode) != '') {
	$memtype = 'orguser';
	$table = PRJ_DB_PREFIX.'_organization_user';
//	$fname = 'dashboard';
	$iPrId = 'iUserID';
} else {
	$memtype = 'securitymanager';
	$table = PRJ_DB_PREFIX.'_security_manager';
	$fname = 'smdashboard';
	$iPrId = 'iSMID';
}
//check customer authentification to login
$member = $memobj->checkauthentication($username,$Password,$memtype,$table,$iPrId,$orgcode);
// pr($_SESSION); exit;
// prints($member);exit;
$user = "b2b_usr";
$pass = "b2b_pswd";

$res_lgnprm = $lgnprmobj->getLoginParameter($username,$Password,$orgcode,$loginparameter);

if(!$res_lgnprm){
    $member = "0";
}

if($member == '1')
{
	if(PostVar('chk'))
	{
		if(PostVar('chk') == 'true')
		{
			setcookie($user,$username,time()+2592000);
			setcookie($pass,$pswd,time()+2592000);
		}
		else
		{
			setcookie($user,"",time()+2592000);
			setcookie($pass ,"",time()+2592000);
		}
	}
}

elseif($member == '2')
{
	setcookie($user,"",time()+2592000);
	setcookie($pass ,"",time()+2592000);
	$msg = "loginactive";
}
elseif($member == '3')
{
	setcookie($user,"",time()+2592000);
	setcookie($pass ,"",time()+2592000);
	$msg = "loginblock";
}
else
{
	setcookie($user,"",time()+2592000);
	setcookie($pass ,"",time()+2592000);
}

//set condition for login
if($member == '0')
	$succ =  "0";
else if($member == '1')
	$succ =  "1";
else if($member == '2')
	$succ =  "2";
else if($member == '3')
	$succ =  "3";
else if($member == '4')
	$succ =  "4";
else if($member == '5')
	$succ =  "5";

if($fromAdmin !=''){
    $fromAdmin = $fromAdmin;
}else{
    $fromAdmin = '';
}

$parseObj = new xmlparser('UTF-8');
$xmlcontent ='<?xml version="1.0" ?><list>';
$xmlcontent .='<succ>1</succ>';
$xmlcontent .='<fname>'.$fname.'</fname>';
$xmlcontent .='<fromadmin>'.$fromAdmin.'</fromadmin>';
$xmlcontent.='</list>';
$arr_xml = $parseObj->xml2php($xmlcontent);
$xml = $parseObj->php2xml($arr_xml);
$parseObj->output_xml($xml);
exit;
?>