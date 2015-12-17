<?php  
/**
 * Action File For Admin change password
 *
 * @package		addadminchangepassword_a.php
 * @Section		general
 * @author		Andrew Dev
*/
//sendmail class incude
include(SITE_CLASS_GEN."class.sendmail.php");
$sendMail=new SendPHPMail;

if(!isset($secManObj)) {
  include_once(SITE_CLASS_APPLICATION.'securitymanager/class.SecurityManager.php');
  $secManObj = new SecurityManager();
}
$gdbobj->getRequestVars();


//prints($_POST);exit;
$password = md5(PostVar('vPassword'));
$Data['vPassword']= $password;
$iSMID = PostVar("iSMID");

$arr = $secManObj->select($iSMID);
$secManObj->setAllVar($arr);
$secManObj->setAllVar($Data);
$where = "iSMID = '".$iSMID."'";
$res = $secManObj->update($where);

if($res) {
     $NAME = $arr[0]['vFirstName']." ".$arr[0]['vLastName'];
	
	//set the valuse of the body of email format
	$body_arr = Array("#NAME#","#PASSWORD#","#MAIL_FOOTER#","#SITE_URL#");
	$post_arr = Array($NAME,PostVar('vPassword'),$MAIL_FOOTER,SITE_URL_DUM);
	
	//send mail to the desired member
	$sendMail->Send("Password changed","Security Manager",$arr[0]['vEmail'],$body_arr,$post_arr);
}

if($res)$var_msg = "Password changed Successfully.";else $var_msg="Eror-in password change.";

header("Location:index.php?file=se-smchangepass&view=edit&iSMID=".$iSMID."&parent=se-securitymanage&var_msg=$var_msg");
exit;
?>