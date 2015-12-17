<?php  
/**
 * This file is useful to check UserName And Sequrity Answer For Forgot password.
 *
 * @package		fpass.inc.php
 * @section		login
 * @author		Jack Scott
 */

include(SITE_CLASS_GEN."class.xmlparser.php");
$adminobj=new Admin;
include(SITE_CLASS_GEN."class.sendmail.php");
$sendMail=new SendPHPMail;
$parseObj=new xmlparser;
$userName 		= GetVar('uname');

$type 			= GetVar('type');
$adArr 			= $adminobj->chkFPassword($userName);

/*echo "<pre>";
print_r($adArr);exit;*/

$xmlcontent ='<?xml version="1.0"?><list>';
if(count($adArr) > 0){
	$sucss = '1';
	$newpass = $generalobj->GenerateAdminPass('4');
	//$xmlcontent .='<uname>'.stripslashes($adArr[0]['vPassword']).'</uname>';
	if($type == 'uname'){
		$Data['vPassword'] = md5($newpass);
		$where = " iAdminId = '".$adArr[0]['iAdminId']."'";
		$res = $dbobj->MySQLQueryPerform("".PRJ_DB_PREFIX."_administrator",$Data,'update',$where);
		if($res){
			$body_arr = Array("#NAME#","#USERNAME#","#PASSWORD#","#MAIL_FOOTER#","#SITE_URL#");
			$post_arr = Array($adArr[0]['Name'],$userName,$newpass,$MAIL_FOOTER,SITE_URL_DUM);
			$sendMail->Send("Forgot Passsword Admin","Admin",$adArr[0]['vEmail'],$body_arr,$post_arr);
		}
	}
}else{
	$sucss = '0';
}
$xmlcontent .='<type>'.$type.'</type>';
$xmlcontent .='<succ>'.str_replace("&","and",$sucss).'</succ>';
$xmlcontent.='</list>';
$parseObj = new xmlparser();
$parseObj->output_xml($xmlcontent);
?>