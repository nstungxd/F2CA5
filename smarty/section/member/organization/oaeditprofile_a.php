<?php

include(S_SECTIONS."/member/memberaccess.php");

//sendmail class incude
include(SITE_CLASS_GEN."class.sendmail.php");
//initialization of senmail class object
$sendMail=new SendPHPMail;

if(!isset($secManObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.SecurityManager.php');
     $secManObj = new SecurityManager();
}
if(!isset($orgUserObj)) {
     include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUser.php');
     $orgUserObj = new OrganizationUser();
}
if(!isset($userToVerifyObj)) {
     include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
     $userToVerifyObj = new OrganizationUserToverify();
}
if(!isset($emailObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
     $emailObj = new EmailTemplate();
}



$Data = PostVar("Data");
if(!isset($Data['eEmailNotification']))
     $Data['eEmailNotification']='No';

$Data['vPhone']=$_POST['vPhoneCode']."-".$Data['vPhone'];
$Data['vMobile']=$_POST['vMobileCode']."-".$Data['vMobile'];
//prints($Data);exit;
if(count($emailArr)>0) {
		$Dt['eStatus'] =  'Modified';
	}
$Data_access = PostVar("Data_access");
$iUserID = PostVar("iUserID");
$view = PostVar("view");
$curr_date =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');


$userData=$orgUsrObj->select($iUserID);
$userData=$userData[0];

$ordt = $orgUserObj->getDetails('*'," AND eStatus='Active' AND eEmailNotification='Yes' AND eUserType='Admin' AND iOrganizationID=".$usrdt[0]['iOrganizationID']);
$smdt = $secManObj->getDetails('*'," AND eStatus='Active' AND eEmailNotification='Yes' ");

if(is_array($smdt) && is_array($ordt)) {
     $emailArr = array_merge($smdt,$ordt);
}
else if(is_array($smdt)) {
     $emailArr = $smdt;
}
else if(is_array($ordt)) {
     $emailArr = $ordt;
}

$Data['iUserID']=$iUserID;
$Data['vUserName']=$userData['vUserName'];
$Data['vPassword'] =$userData['vPassword'];
$Data['eUserType']=$userData['eUserType'];
$Data['ePermissionType']=$userData['ePermissionType'];
$Data['iGroupID']=$userData['iGroupID'];
$Data['eStatus']='Need to Verify';
$Data['iVerifiedID']='';

	if(count($emailArr)>0) {
		$dt['eStatus'] = $Data['eStatus'] = 'Modified';
	}
	else {
		$dt = $Data;
		$dt['eStatus'] = $Data['eStatus'] = 'Active';
	}

	$dt['iModifiedByID'] = $Data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$dt['eModifiedBy'] = $Data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$oudt = $orgUserObj->getDetails('*'," AND iUserID=$iUserID ");
	$Data['iCreatedBy'] = $oudt[0]['iCreatedBy'];
	$Data['eCreatedBy'] = $oudt[0]['eCreatedBy'];
	$Data['vPassword'] = $oudt[0]['vPassword'];
	$userToVerifyObj->setAllVar($Data);
   // prints($Data);exit;
	$iVerifiedID=$userToVerifyObj->insert($Data);
	if($iVerifiedID) {
		$where= "  iUserID='".$iUserID."'";
		$updateSucc=$orgUserObj->updateData($dt,$where);
	}
$iOrgID=$Data['iOrganizationID'];
$userName=$Data['vFirstName']." ".$Data['vLastName'];
$userEmail=$Data['vEmail'];
//unset($Data);
if(!$updateSucc)
               $iUserID='';
if($iUserID) {
     /*
     unset ($Data['dLastAccessDate']);
     $Data['iUserID']=$iUserID;
     $Data['iVerifiedID']='';
     $userToVerifyObj->setAllVar($Data);
     $iVerifiedID=$userToVerifyObj->insert(); */
     if(count($emailArr)>0) {
          $link = SITE_URL_DUM."organizationuserview/".$iUserID;
          $secMan=$secManObj->select($sess_id);
          $secMan=$secMan[0];
          $body_arr = Array("#SMNAME#","#USERNAME#","#USEREMAIL#","#SECNAME","#LINK#","#SITE_NAME#","#MAIL_FOOTER#","#SITE_URL#");

          if($iVerifiedID) {
               unset($Data);
               $smname = $secMan['vFirstName'].' '.$iUserID;
               $emailTo='';
               //set the values of the body of email format
               $post_arr = Array('',$userName,$userEmail,$smname,$link,$SITE_NAME,$MAIL_FOOTER,SITE_URL_DUM);
               $Data['iItemID']=$iVerifiedID;
               $Data['iCreatedBy']=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
               $Data['eCreatedType']=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
					$Data['iOrganizationID']=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID'];
               $Data['eSubject']='User';
                    $mailtype = 'Organization User Updated';
                    $eType='Modified';

               $where = "AND vType='$mailtype' AND eSection='Member'" ;
               $db_email = $emailObj->getDetails('*',$where);
//          if(trim($smname)!='')
//				$emailContent=$sendMail->Send($vMailSubject_en,"Member",$emailTo,$body_arr,$post_arr,'','','Yes');

               $body = Array("#USERNAME#","#USEREMAIL#","#SECNAME","#LINK#","#SITE_NAME#");
               $post = Array($userName,$userEmail,$smname,$link,$SITE_NAME);

               $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
               $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
               $emailContent_en = trim(str_replace($body,$post, $tbody_en));
               $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
               $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

               $Data['eType']=$eType;
               $Data['vMailSubject_en']=$db_email[0]['vSub_en'];
               $Data['vMailSubject_fr']=$db_email[0]['vSub_fr'];
               $Data['tMailContent_en']=$emailContent_en;
               $Data['tMailContent_fr']=$emailContent_fr;
               $Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
               if(!isset($userActionObj)) {
                    include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
                    $userActionObj = new UserActionVerification();
               }
               // print_r($Data);
               $userActionObj->setAllVar($Data);
               $userActionObj->insert();
          }

          //prints(count($emailArr));exit;
          for($i=0;$i<count($emailArr);$i++) {
               $smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
               $emailTo=$emailArr[$i]['vEmail'];
               //set the values of the body of email format
               $post_arr = Array($smname,$userName,$userEmail,$secMan['vFirstName']." ".$secMan['vLast Name'],$link,$SITE_NAME,$MAIL_FOOTER,SITE_URL_DUM);
               //send mail to the Security Manager and Organization's Admin User
               //print_r($post_arr);

               if(trim($smname)!='')
                     $sendMail->Send($mailtype,"Member",$emailTo,$body_arr,$post_arr);

          }
     }
     $var_msg = "rus";
     $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
           header("Location:".SITE_URL_DUM."oaeditprofile/".$var_msg);
}
else {
     $var_msg="raerr.";
     $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
          header("Location:".SITE_URL_DUM."oaeditprofile/".$var_msg);
}
//print SITE_URL_DUM.$var_msg;
exit;
?>
