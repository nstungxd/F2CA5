<?php  

//member include class
require_once(SITE_CLASS_APPLICATION."class.member.php");
//initialize object of member
$memobj = new Member();

//xml parser class
include_once(SITE_CLASS_GEN."class.xmlparser.php");

$username = GetVar('unm'); 	// username
$orgcode = GetVar('orcode'); 	// orgcode
$answer = GetVar('answer');
$password = GetVar('password');

if(trim($orgcode) != '') {
   $memtype = 'orguser';
} else {
   $memtype = 'securitymanager';
}

//Check whether the entered username is available or not
$where = " AND vUserName='".$username."' ";
/*if(trim($answer)!='') {
	$where .= " AND (vAnswer='".$answer."') ";
}*/

if($memtype == 'securitymanager')
{
   $memArr = $generalobj->getTableInfo(PRJ_DB_PREFIX.'_security_manager',$where,'iSMID,vUserName,vFirstName,vLastName,vPassword,vEmail,vAnswer,eStatus','',"");
}
else if($memtype == 'orguser')
{
	$where .= " AND org.vCompCode='".$orgcode."' ";
   $memArr = $generalobj->getTableInfo(PRJ_DB_PREFIX.'_organization_user user INNER JOIN '.PRJ_DB_PREFIX.'_organization_master org on user.iOrganizationID=org.iOrganizationID',$where,'iUserID,vUserName,vFirstName,vLastName,vPassword,user.vEmail,user.iOrganizationID,user.vAnswer,user.eStatus','',"");
}

if(count($memArr) > 0)
{
	if($memArr[0]['vAnswer'] != $answer) {
		$msg = $smarty->get_template_vars('LBL_WRONG_USER_DETAILS');
		echo $msg;
		exit;
	}
   $newpass = $password; 	// $generalobj->GenerateAdminPass('5');
   // $pswd = $memArr[0]['vPassword'];
   // $newpass = $generalobj->decrypt($pswd);
//	$Data['vPassword'] = $generalobj->encrypt($pswd);
/*   if(trim($memtype) == '')
   {
      $where = " iUserId = '".$memArr[0]['iUserId']."'";
      $res = $dbobj->MySQLQueryPerform(PRJ_DB_PREFIX.'_user',$Data,'update',$where);
   }
*/
   
	if($memtype == 'securitymanager')
	{
		if(!isset($secManObj))
		{
			require_once(SITE_CLASS_APPLICATION."securitymanager/class.SecurityManager.php");
			$secManObj = new SecurityManager();
		}
      $where = " (vUserName='".$username."') ";
		$data['vActivationCode'] = '';
      $data['vPassword'] = $generalobj->encrypt($newpass);
		$id = $secManObj->updateData($data,$where);
	}
	else if($memtype == 'orguser')
	{
		if(!isset($orgUsrObj))
		{
			require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
			$orgUsrObj = new OrganizationUser();
		}
      $where = " (vUserName='".$username."') ";
		$data['vActivationCode'] = '';
      $data['vPassword'] = $generalobj->encrypt($newpass);
		$id = $orgUsrObj->updateData($data,$where);
      if(!isset($orgObj)) {
         include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
         $orgObj = new Organization();
      }
      $orgDetail=$orgObj->select($memArr[0]['iOrganizationID']);
	}

	$name = $memArr[0]['vFirstName']." ".$memArr[0]['vLastName'];

  if(!isset($sendMail))
  {
      require_once(SITE_CLASS_GEN."class.sendmail.php");
      $sendMail = new SendPHPMail();
  }
  
  /*if($memtype == 'orguser')
  {
      $compname=$orgDetail[0]['vCompanyName'];
      $compcode=$orgDetail[0]['vCompCode'];
     	//assign values of the Body of the Email Format
     	$bodyarray = array("#SITE_NAME#","#NAME#","#USERNAME#","#EMAIL#","#PASSWORD#","#CNAME#","#COMPCODE#","#MAIL_FOOTER#","#SITE_URL#");
     	$postarray = array($SITE_NAME,$name,$memArr[0]['vUserName'],$memArr[0]['vEmail'],$newpass,$compname,$compcode,$MAIL_FOOTER,SITE_URL_DUM);
   	//echo $email;
		//prints($postarray); exit;
   	//send mail to the require email address
   	$sendMail->Send('Forgot Password','Member',$memArr[0]['vEmail'],$bodyarray,$postarray);
  } else {
      //assign values of the Body of the Email Format
     	$bodyarray = array("#SITE_NAME#","#NAME#","#USERNAME#","#EMAIL#","#PASSWORD#","#MAIL_FOOTER#","#SITE_URL#");
     	$postarray = array($SITE_NAME,$name,$memArr[0]['vUserName'],$memArr[0]['vEmail'],$newpass,$MAIL_FOOTER,SITE_URL_DUM);
   	//echo $email;
		//prints($postarray); exit;
   	//send mail to the require email address
   	$sendMail->Send('Forgot Password','Member',$memArr[0]['vEmail'],$bodyarray,$postarray);
  }*/
  
   /*
	//assign values of the Body of the Email Format
	$bodyarray = array("#SITE_NAME#","#NAME#","#USERNAME#","#EMAIL#","#PASSWORD#","#MAIL_FOOTER#","#SITE_URL#");
	$postarray = array($SITE_NAME,$name,$memArr[0]['vUserName'],$memArr[0]['vEmail'],$newpass,$MAIL_FOOTER,SITE_URL_DUM);
	//echo $email;
	//prints($postarray); exit;
	//send mail to the require email address
	$sendMail->Send('Forgot Password','Member',$memArr[0]['vEmail'],$bodyarray,$postarray);
	*/
   $msg = $smarty->get_template_vars('LBL_PASSWORD_CHANGED_SUCCESS')."<script type='text/javascript'>setTimeout('window.location=\"".SITE_URL_DUM."home\"',3000);</script>"; 	// LBL_LOGIN_INFO_SENT
}
else
{
	$msg = $smarty->get_template_vars('LBL_WRONG_USER_DETAILS');
}
echo $msg;
exit;

//intialize object of xml parser
/*$parseObj = new xmlparser('UTF-8');
$xmlcontent = '<?xml version="1.0" encoding="UTF-8"?><list>';
// $xmlcontent = '<?xml version="1.0" encoding="iso-8859-1"?><list>'; 
$xmlcontent .= '<msg>'.$msg.'</msg>';
$xmlcontent .= '</list>';
$arr_xml = $parseObj->xml2php($xmlcontent);
$xml = $parseObj->php2xml($arr_xml);
$parseObj->output_xml($xml);*/
// exit;
?>