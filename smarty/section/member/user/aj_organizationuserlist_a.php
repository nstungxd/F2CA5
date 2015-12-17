<?php

include(S_SECTIONS."/member/memberaccess.php");

$mode = $_POST['mode'];
$val = $_POST['val'];
  //prints($_POST); exit;

if(!isset($orgObj)) {
   require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($UsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$UsrObj = new OrganizationUser;
}
if(!isset($userToVerifyObj)) {
	include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
	$userToVerifyObj = new OrganizationUserToverify();
}
if(!isset($userActionObj)) {
	  include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
	  $userActionObj = new UserActionVerification();
}
if(!isset($orgUserPermObj)) {
	  include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	  $orgUserPermObj =	new OrganizationUserPermission();
 }
 if(!isset($orgUserPermVerifyObj)) {
	  include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermissionToVerify.php");
	  $orgUserPermVerifyObj =	new OrganizationUserPermissionToVerify();
 }
if(!isset($emailObj)) {
	  include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
	  $emailObj = new EmailTemplate();
}
if(!isset($sendMail)) {
	  include_once(SITE_CLASS_GEN."class.sendmail.php");
	  $sendMail = new SendPHPMail();
}

$sess_user_name = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_NAME'];
$sess_usertype_short = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];

     if($mode == 'status'){
          $where = "AND iUserID IN ($val)";
          $arr = $UsrObj->getDetails('*',$where);

          foreach($arr as $k=>$v) {
	       $data = $v;
               $data['eNeedToVerify'] = 'Yes';
               $data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
               $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
					$data['dModifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

               if($v['eStatus'] == 'Active' && $v['eNeedToVerify']!='Yes') {
						  $whr = " AND iUserID=".$v['iUserID'];
						  $varr = $userToVerifyObj->getDetails('*',$whr,' iVerifiedID DESC ','',' LIMIT 0,1 ');
						  if($varr[0]['eStatus'] == 'Active' && $varr[0]['eNeedToVerify']!='Yes') {
								 $data['eStatus'] = 'Inactive';
								 //$UsrObj->setAllVar($data);
								 $where = "iUserID = ".$v['iUserID']."";
								 //$res = $UsrObj->updateData($data, $where);
								 $userToVerifyObj->setAllVar($data);
								 $res = $userToVerifyObj->insert();
								 // $res = $userToVerifyObj->updateData($data, $where);
						  } else {
								 $var_msg = $smarty->get_template_vars('MSG_VERIFY_NEED_TO_VERIFY_OR_MODIFIED');
								 echo $var_msg;
								 exit;
						  }
               } elseif($v['eStatus'] == 'Inactive' && $v['eNeedToVerify']!='Yes') {
						  $whr = " AND iUserID=".$v['iUserID'];
						  $varr = $userToVerifyObj->getDetails('*',$whr,' iVerifiedID DESC ','',' LIMIT 0,1 ');
						  if($varr[0]['eStatus'] == 'Inactive' && $varr[0]['eNeedToVerify']!='Yes') {
								 $data['eStatus'] = 'Active';
								 //$UsrObj->setAllVar($data);
								 $where = "iUserID = ".$v['iUserID']."";
								 //$res = $UsrObj->updateData($data, $where);
								 $userToVerifyObj->setAllVar($data);
								 $res = $userToVerifyObj->insert();
								 // $res = $userToVerifyObj->updateData($data, $where);
						  } else {
								 $var_msg = $smarty->get_template_vars('MSG_VERIFY_NEED_TO_VERIFY_OR_MODIFIED');
								 echo $var_msg;
								 exit;
						  }
               } elseif($v['eStatus'] == 'Modified' || $v['eStatus'] == 'Need to Verify' || $v['eNeedToVerify']=='Yes') {
                    $var_msg = $smarty->get_template_vars('MSG_VERIFY_NEED_TO_VERIFY_OR_MODIFIED');
                    echo $var_msg;
                    exit;
               }

               $where = 'AND iUserID = '.$v['iUserID'].'';
               $orderby = ' iVerifiedID Desc';
               $vrfid = $userToVerifyObj->getDetails('iVerifiedID',$where,$orderby);

               // ---------------------  ORGANIZATION DATA FETCHED ------------------------------------------//
               $iOrgID=$v['iOrganizationID'];
               $userName=$v['vFirstName']." ".$v['vLastName'];
               $userEmail=$v['vEmail'];

               $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active"' ;
               $smdtls = $secManObj->getDetails('*',$where);
               // ---------------------
               $where = 'AND vType="Organization User Status Changed" AND eSection = "Member"' ;
               $db_email = $emailObj->getDetails('*',$where);
               $link = SITE_URL_DUM."organizationuserview/".$v['iUserID'];
               $body = Array("#USERNAME#","#USEREMAIL#","#SECNAME","#LINK#","#MODIFIED_BY#");
               $post = Array($userName,$userEmail,$smname,$link,$sess_user_name."($sess_usertype_short)");

               $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
               $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
               $emailContent_en = trim(str_replace($body,$post, $tbody_en));
               $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
               $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
               // prints($emailContent);exit;

               $Data['iItemID']=$vrfid[0]['iVerifiedID'];
               $Data['iOrganizationID']=$v['iOrganizationID'];
               $Data['eSubject']='User';
               $Data['eType']='Modified';
               $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
               $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
               $Data['tMailContent_en'] = $emailContent_en;
               $Data['tMailContent_fr'] = $emailContent_fr;
               $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
               $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
               $Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

               ## INSERT INTO USER ACTION TABLE
               $userActionObj->setAllVar($Data);
               $userActionObj->insert();

               for($i=0;$i<count($smdtls);$i++)
               {
                     $smname = $smdtls[$i]['vFirstName'].' '.$smdtls[$i]['vLastName'];
                     $email = $smdtls[$i]['vEmail'];
                     $body_arr = Array("#SMNAME#","#USERNAME#","#USEREMAIL#","#SECNAME","#LINK#","#MODIFIED_BY#","#MAIL_FOOTER#","#SITE_URL#");
                     $post_arr = Array($smname,$userName,$userEmail,$smname,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
                     $sendMail->Send("Organization User Status Changed","Member",$email,$body_arr,$post_arr);
               }
               unset($Data);
               unset($_POST);

               if($res)$var_msg = $smarty->get_template_vars('MSG_STATUS_SENT_SUCC');else$var_msg = $smarty->get_template_vars('MSG_STATUS_SENT_ERR');
          }
     } else {
          $where = "AND iUserID IN ($val)";
          $arr = $UsrObj->getDetails('*',$where);
          foreach($arr as $k=>$v) {
               if(($v['eStatus'] == 'Active' || $v['eStatus'] == 'Inactive' || $v['eStatus'] == '') && $v['eNeedToVerify'] != 'Yes') {
                    $data['eStatus'] = 'Delete';
                    $data['iModifiedByID'] = $sess_id;
                    $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						  $data['dModifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                    $UsrObj->setAllVar($data);
                    $where = "iUserID IN (".$v['iUserID'].")";
                    $res = $UsrObj->updateData($data, $where);

						  $data = $v;
						  $data['eStatus'] = 'Delete';
                    $data['iModifiedByID'] = $sess_id;
                    $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						  $data['dModifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
						  $userToVerifyObj->setAllVar($data);
						  $res = $userToVerifyObj->insert();
						  // $res = $userToVerifyObj->updateData($data, $where);
                    $where = 'AND iUserID = '.$v['iUserID'].'';
                    $orderby = ' iVerifiedID Desc';
                    $vrfid = $userToVerifyObj->getDetails('iVerifiedID',$where,$orderby);

                    // ---------------------  ORGANIZATION DATA FETCHED ------------------------------------------//
                    $iOrgID=$v['iOrganizationID'];
                    $userName=$v['vFirstName']." ".$v['vLastName'];
                    $userEmail=$v['vEmail'];
						  $smname = "";
                    $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active"' ;
                    $smdtls = $secManObj->getDetails('*',$where);
                    // ---------------------
                    $where = 'AND vType="Organization User Deleted" AND eSection = "Member"' ;
                    $db_email = $emailObj->getDetails('*',$where);
                    $link = SITE_URL_DUM."organizationuserview/".$v['iUserID'];
                    $body = Array("#USERNAME#","#USEREMAIL#","#SECNAME","#LINK#","#DELETE_BY#");
                    $post = Array($userName,$userEmail,$smname,$link,$sess_user_name."($sess_usertype_short)");

                    $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
                    $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
                    $emailContent_en = trim(str_replace($body,$post, $tbody_en));
                    $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
                    $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
                    // prints($emailContent);exit;

                    $Data['iItemID']=$vrfid[0]['iVerifiedID'];
                    $Data['iOrganizationID']=$v['iOrganizationID'];
                    $Data['eSubject']='User';
                    $Data['eType']='Delete';
                    $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
                    $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
                    $Data['tMailContent_en'] = $emailContent_en;
                    $Data['tMailContent_fr'] = $emailContent_fr;
                    $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
                    $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
                    $Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

                    ## INSERT INTO USER ACTION TABLE
                    $userActionObj->setAllVar($Data);
                    $userActionObj->insert();

                    for($i=0;$i<count($smdtls);$i++)
                    {
								$smname = $smdtls[$i]['vFirstName'].' '.$smdtls[$i]['vLastName'];
								$email = $smdtls[$i]['vEmail'];
								$body_arr = Array("#SMNAME#","#USERNAME#","#USEREMAIL#","#SECNAME","#LINK#","#DELETE_BY#","#MAIL_FOOTER#","#SITE_URL#");
								$post_arr = Array($smname,$userName,$userEmail,$smname,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
								$sendMail->Send("Organization User Deleted","Member",$email,$body_arr,$post_arr);
                    }
                    unset($Data);
                    unset($_POST);

                    if($res)$var_msg = $smarty->get_template_vars('MSG_DEL_SENT_SUCC');else$var_msg = $smarty->get_template_vars('MSG_DEL_SENT_ERR');
               } elseif($v['eStatus'] == 'Modified' || $v['eStatus'] == 'Need to Verify') {
                    $var_msg = $smarty->get_template_vars('MSG_VERIFY_NEED_TO_VERIFY_OR_MODIFIED');
                    echo $var_msg;
                    exit;
               }
          }
     }

     echo $var_msg;
     exit;
?>