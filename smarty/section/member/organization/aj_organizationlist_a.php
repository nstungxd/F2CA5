<?php

include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_POST['mode'];
	$val = $_POST['val'];

	if(!isset($orgObj))
	{
		include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
		$orgObj = new Organization();
	}
     if(!isset($orgvrfObj)) {
         include_once(SITE_CLASS_APPLICATION."organization/class.Organization_Toverify.php");
         $orgvrfObj =	new Organization_Toverify();
     }
     if(!isset($userActionObj)) {
          include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
          $userActionObj = new UserActionVerification();
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
          $where = "AND iOrganizationID IN ($val)";
          $arr = $orgObj->getDetails('*',$where);

          foreach($arr as $k=>$v) {
					$data = $v;
               $data['eNeedToVerify'] = 'Yes';
               $data['iModifiedByID'] = $sess_id;
               $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
					$data['dModifiedDate'] = date('Y-m-d H:i:s');

               if($v['eStatus'] == 'Active') {
                    $data['eStatus'] = 'Inactive';
                    //$orgObj->setAllVar($data);
                    $where = "iOrganizationID = ".$v['iOrganizationID']."";
						  $dtl['eNeedToVerify'] = 'Yes';
                    $res = $orgObj->updateData($dtl, $where);
                    $orgvrfObj->setAllVar($data);
                    $res = $orgvrfObj->insert();
               } elseif($v['eStatus'] == 'Inactive') {
                    $data['eStatus'] = 'Active';
                    //$orgObj->setAllVar($data);
                    $where = "iOrganizationID = ".$v['iOrganizationID']."";
						  $dtl['eNeedToVerify'] = 'Yes';
                    $res = $orgObj->updateData($dtl, $where);
                    //$res = $orgObj->updateData($data, $where);
                    $orgvrfObj->setAllVar($data);
                    $res = $orgvrfObj->insert();
               } elseif($v['eStatus'] == 'Modified' || $v['eStatus'] == 'Need to Verify') {
                    $var_msg = $smarty->get_template_vars('MSG_VERIFY_NEED_TO_VERIFY_OR_MODIFIED');
                    echo $var_msg;
                    exit;
               }

               $where = " AND iOrganizationID = ".$v['iOrganizationID']."";
               $orderby = ' iVerifiedID Desc';
               $vrfid = $orgvrfObj->getDetails('iVerifiedID',$where,$orderby);

               // ---------------------  ORGANIZATION DATA FETCHED ------------------------------------------//
               $cname = $v['vCompanyName'];
               $regno = $v['vCompanyRegNo'];
               $code = $v['vOrganizationCode'];

               $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active"' ;
               $smdtls = $secManObj->getDetails('*',$where);
               // ---------------------
               $where = 'AND vType="Organization Status Changed" AND eSection = "Member"' ;
               $db_email = $emailObj->getDetails('*',$where);
               $link = SITE_URL_DUM."organizationview/".$v['iOrganizationID'];
               $body = Array("#SMNAME#","#CNAME#","#LINK#","#MODIFIED_BY#","#REGNO#","#ORGCODE#");
               $post = Array($sname,$cname,$link,$sess_user_name."($sess_usertype_short)",$regno,$code);

               $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
               $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
               $emailContent_en = trim(str_replace($body,$post, $tbody_en));
               $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
               $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
               // prints($emailContent);exit;

               $Data['iItemID']=$vrfid[0]['iVerifiedID'];
               $Data['iOrganizationID']=$v['iOrganizationID'];
               $Data['eSubject']='OA';
               $Data['eType']='Modified';
               $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
               $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
               $Data['tMailContent_en'] = $emailContent_en;
               $Data['tMailContent_fr'] = $emailContent_fr;
               $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
               $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
               $Data['dActionDate']=date("Y-m-d H:i:s");

               ## INSERT INTO USER ACTION TABLE
               $userActionObj->setAllVar($Data);
               $userActionObj->insert();

               for($i=0;$i<count($smdtls);$i++)
               {
                     $smname = $smdtls[$i]['vFirstName'].' '.$smdtls[$i]['vLastName'];
                     $email = $smdtls[$i]['vEmail'];
                     $body_arr = Array("#SMNAME#","#CNAME#","#LINK#","#MODIFIED_BY#","#REGNO#","#ORGCODE#","#MAIL_FOOTER#","#SITE_URL#");
                     $post_arr = Array($smname,$cname,$link,$sess_user_name."($sess_usertype_short)",$regno,$code,$MAIL_FOOTER,SITE_URL_DUM);
                     $sendMail->Send("Organization Status Changed","Member",$email,$body_arr,$post_arr);
               }
               unset($Data);
               unset($_POST);

               if($res)$var_msg = $smarty->get_template_vars('MSG_STATUS_SENT_SUCC');else$var_msg = $smarty->get_template_vars('MSG_STATUS_SENT_ERR');
          }
     } else {
          $where = "AND iOrganizationID IN ($val)";
          $arr = $orgObj->getDetails('*',$where);
          foreach($arr as $k=>$v) {
               if($v['eStatus'] == 'Active' || $v['eStatus'] == 'Inactive') {
                    $data['eStatus']='Delete';
                    $data['iModifiedByID'] = $sess_id;
                    $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						  $data['dModifiedDate'] = date('Y-m-d H:i:s');
                    $orgObj->setAllVar($data);
                    $where = "iOrganizationID IN (".$v['iOrganizationID'].")";
                    $res = $orgObj->updateData($data, $where);

						  $data = $v;
						  $data['eStatus'] = 'Delete';
                    $data['iModifiedByID'] = $sess_id;
                    $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						  $data['dModifiedDate'] = date('Y-m-d H:i:s');
                    $orgvrfObj->setAllVar($data);
                    $res = $orgvrfObj->insert();
                    $where = 'AND iOrganizationID = '.$v['iOrganizationID'].'';
                    $orderby = ' iVerifiedID Desc';
                    $vrfid = $orgvrfObj->getDetails('iVerifiedID',$where,$orderby);

                    // ---------------------  ORGANIZATION DATA FETCHED ------------------------------------------//
                    $cname = $v['vCompanyName'];
                    $regno = $v['vCompanyRegNo'];
                    $code = $v['vOrganizationCode'];

                    $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active"' ;
                    $smdtls = $secManObj->getDetails('*',$where);
                    // ---------------------
                    $where = 'AND vType="Organization Deleted" AND eSection = "Member"' ;
                    $db_email = $emailObj->getDetails('*',$where);
                    $link = SITE_URL_DUM."organizationview/".$v['iOrganizationID'];
                    $body = Array("#SMNAME#","#CNAME#","#LINK#","#DELETE_BY#","#REGNO#","#ORGCODE#");
                    $post = Array($sname,$cname,$link,$sess_user_name."($sess_usertype_short)",$regno,$code);

                    $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
                    $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
                    $emailContent_en = trim(str_replace($body,$post, $tbody_en));
                    $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
                    $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
                    // prints($emailContent);exit;
                    $Data['iItemID']=$vrfid[0]['iVerifiedID'];
                    $Data['iOrganizationID']=$v['iOrganizationID'];
                    $Data['eSubject']='OA';
                    $Data['eType']='Delete';
                    $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
                    $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
                    $Data['tMailContent_en'] = $emailContent_en;
                    $Data['tMailContent_fr'] = $emailContent_fr;
                    $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
                    $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
                    $Data['dActionDate']=date("Y-m-d H:i:s");

                    ## INSERT INTO USER ACTION TABLE
                    $userActionObj->setAllVar($Data);
                    $userActionObj->insert();

                    for($i=0;$i<count($smdtls);$i++)
                    {
                          $smname = $smdtls[$i]['vFirstName'].' '.$smdtls[$i]['vLastName'];
                          $email = $smdtls[$i]['vEmail'];
                          $body_arr = Array("#SMNAME#","#CNAME#","#LINK#","#DELETE_BY#","#REGNO#","#ORGCODE#","#MAIL_FOOTER#","#SITE_URL#");
                          $post_arr = Array($smname,$cname,$link,$sess_user_name."($sess_usertype_short)",$regno,$code,$MAIL_FOOTER,SITE_URL_DUM);
                          $sendMail->Send("Organization Deleted","Member",$email,$body_arr,$post_arr);
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