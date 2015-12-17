<?php  
/**
 * This file is useful to check authintification of Admin Login.
 *
 * @package		auth.php
 * @section		login
*/

include(SITE_CLASS_GEN."class.xmlparser.php");

if (!isset($lgnprmobj)) {
    include_once(SITE_CLASS_APPLICATION . "class.loginParameter.php");
    $lgnprmobj = new LoginParameter();
}

$adminobj=new Admin;
$parseObj=new xmlparser;
$userName = GetVar('uname');
$pass = md5(GetVar('pass'));
$loginparameter = GetVar('loginparameter');
$chk  =GetVar('chk');
$theme = GetVar('theme');

$sucss = $adminobj->chkAuth($userName,$pass,$type);

$res_lgnprm = $lgnprmobj->getLoginParameter($userName,$pass,'',$loginparameter);

if(!$res_lgnprm){
    $sucss = "0";
}

if($chk == "on"){
	if($sucss==1){

		$_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERTHEME']	=	$theme;
		$_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_COOKIE']	=	$userName;
		$_SESSION[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']=	GetVar('pass');

	}
	$_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_REMEMBER']='Yes';
     
}
else
{
	$_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_COOKIE']='';
	$_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_REMEMBER']='No';
	$_SESSION[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']='';
}
$_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN']='YES';
$xmlcontent ='<?xml version="1.0"?><list>';
$xmlcontent .='<succ>'.str_replace("&","and",$sucss).'</succ>';
$xmlcontent.='</list>';
$parseObj = new xmlparser();
$parseObj->output_xml($xmlcontent);
?>