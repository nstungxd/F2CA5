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

$password = $generalobj->encrypt(PostVar('vPassword'));
$Data['vPassword']= $password;
$iSMID = PostVar("iSMID");
$email=$_POST['vEmail'];
$FirstName=$_POST['vFirstName'];
$LastName=$_POST['vLastName'];
$where = "iSMID = '".$iSMID."'";
$res = $secManObj->updateData($Data,$where);
//$arr[0]['vEmail'];
if($res) {
     $NAME = $FirstName." ".$LastName;
     $pass=PostVar('vPassword');

	//set the valuse of the body of email format
	$body_arr = Array("#NAME#","#PASSWORD#","#MAIL_FOOTER#","#SITE_URL#");
	$post_arr = Array($NAME,$pass,$MAIL_FOOTER,SITE_URL_DUM);

	//send mail to the desired member
	$sendMail->Send("Password changed","Member",$email,$body_arr,$post_arr);

}

if($res)$var_msg = "Password changed Successfully.";else $var_msg="Eror-in password change.";

header("Location:index.php?file=se-smchangepass&view=edit&iSMID=".$iSMID."&parent=se-securitymanager&var_msg=$var_msg");
exit;
?>