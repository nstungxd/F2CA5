<?php

include(S_SECTIONS."/member/memberaccess.php");

	$val = $str;

	if(!isset($orgObj)) {
          require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
          $orgObj = new Organization();
   }
	if(!isset($assObj))
	{
		include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
		$assObj = new OrganizationAssociation();
	}

     if(!isset($assvrfObj)) {
         include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociationToVerify.php");
         $assvrfObj =	new OrganizationAssociationToVerify();
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

     $where = " AND iAsociationID IN ($val) ";
     $arr = $orgAssocObj->getDetails('*',$where);
     foreach($arr as $k => $v) {
          if($v['eNeedToVerify'] != 'Yes') {
               $dlts['eStatus'] = 'Delete';
					// $dlts['eNeedToVerify'] = 'Yes';
               $dlts['iModifiedByID'] = $sess_id;
               $dlts['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
					$dlts['dModifiedDate'] = date('Y-m-d H:i:s');
               $assObj->setAllVar($dlts);
               // $where = " iAsociationID IN (".$v['iAsociationID'].") ";
					$where = " iAsociationID=".$v['iAsociationID'];
					// prints($where); exit;
               $res = $assObj->updateData($dlts, $where);
               //$assvrfObj->setAllVar($dlts);
               //$res = $assvrfObj->updateData($dlts, $where);
					$where = ' AND iAsociationID = '.$v['iAsociationID'].'';
					$dts = $v;
					$dts['iModifiedByID'] = $sess_id;
               $dts['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
					$dts['dModifiedDate'] = date('Y-m-d H:i:s');
					$dts['eStatus'] = 'Delete';
					$assvrfObj->setAllVar($dts);
					$rs = $assvrfObj->insert();
               $orderby = ' iVerifiedID Desc';
               $vrfid = $assvrfObj->getDetails('iVerifiedID',$where,$orderby);

               // ---------------------  ORGANIZATION DATA FETCHED ------------------------------------------//
               $orgdata = $orgObj->select($v['iBuyerOrganizationID']);
               $ORGNAME = $orgdata[0]['vCompanyName'];
               $CODE = $orgdata[0]['vOrganizationCode'];

               $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active"' ;
               $smdtls = $secManObj->getDetails('*',$where);
               // ---------------------
               $where = 'AND vType="Association Deleted" AND eSection = "Member"' ;
               $db_email = $emailObj->getDetails('*',$where);
               $link = SITE_URL_DUM."associationview/".$v['iAsociationID'];
               $body = Array("#ORGNAME#","#ACODE#","#LINK#","#DELETE_BY#");
               $post = Array($ORGNAME,$CODE,$link,$sess_user_name."($sess_usertype_short)");

               $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
               $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
               $emailContent_en = trim(str_replace($body,$post, $tbody_en));
               $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
               $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
               // prints($emailContent);exit;

               $Data['iItemID']=$vrfid[0]['iVerifiedID'];
               $Data['eSubject']='Association';
               $Data['eType']='Delete';
               $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
               $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
               $Data['tMailContent_en'] = $emailContent_en;
               $Data['tMailContent_fr'] = $emailContent_fr;
               $Data['dActionDate']=date("Y-m-d H:i:s");

               ## INSERT INTO USER ACTION TABLE
               $userActionObj->setAllVar($Data);
               $userActionObj->insert();

               for($i=0;$i<count($smdtls);$i++)
               {
                     $smname = $smdtls[$i]['vFirstName'].' '.$smdtls[$i]['vLastName'];
                     $email = $smdtls[$i]['vEmail'];
                     $body_arr = Array("#SMNAME#","#ORGNAME#","#ACODE#","#LINK#","#DELETE_BY#","#MAIL_FOOTER#","#SITE_URL#");
                     $post_arr = Array($smname,$ORGNAME,$CODE,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
                     $sendMail->Send("Association Deleted","Member",$email,$body_arr,$post_arr);
               }
               unset($Data);
               unset($_POST);

               if($res){ $msg = "rus"; } else { $msg = "ruserr"; }
          } elseif($v['eStatus'] == 'Modified' || $v['eStatus'] == 'Need to Verify') {
               $var_msg = $smarty->get_template_vars('MSG_VERIFY_NEED_TO_VERIFY_OR_MODIFIED');
          }
			 // exit;
     }
?>
