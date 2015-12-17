<?php

include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_POST['mode'];
	$val = $_POST['val'];
     //prints($_POST); exit;

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
/*
     $where = "AND iAsociationID IN ($val)";
     $res = $assObj->del($where);
     $res = $assvrfObj->del($where);
     $arr = $assvrfObj->getDetails('iVerifiedID',$where);

     foreach($arr as $k=>$v) {
          $starr[] = $v['iVerifiedID'];
     }

     $str = @implode(',',$starr);
     $where = "AND iItemID IN ($str)";
     $res = $userActionObj->del($where);
*/

	  $sess_user_name = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_NAME'];
	  $sess_usertype_short = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];

     if($mode == 'status') {
          $where = "AND iAsociationID IN ($val)";

          $arr = $assObj->getDetails('*',$where);
          foreach($arr as $k=>$v) {
               $data['eNeedToVerify'] = 'Yes';
               $data['iModifiedByID'] = $sess_id;
               $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
					$data['dModifiedDate'] = date('Y-m-d H:i:s');

					$whr = " vAssociationCode='".$v['vAssociationCode']."'";

					$asdt = $assObj->getDetails('iChangeNo'," AND ".$whr,' iChangeNo DESC ','',' LIMIT 0,1');
					// prints($asdt); exit;
					if($asdt[0]['iChangeNo'] == '') {
						$asdt[0]['iChangeNo'] = 0;
					}
					$adtl['iChangeNo'] = ($asdt[0]['iChangeNo']+1);
               if($v['eStatus'] == 'Active') {
                    $assocStr = $assObj->getDetails('group_concat(iAsociationID) as Assoc',' AND vAssociationCode="'.$v['vAssociationCode'].'" and eStatus="Active"');
						  // prints($assocStr);exit;
						  $assocStr=$assocStr[0]['Assoc'];

                    $data['eStatus'] = 'Inactive';
                    $data['eNeedToVerify']='Yes';


						  $dts = $v; 	// $asocs[$l];
						  $dts['eStatus'] = 'Inactive';
						  $dts['eNeedToVerify']='Yes';
						  $dts['iModifiedByID'] = $sess_id;
						  $dts['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						  $dts['dModifiedDate'] = date('Y-m-d H:i:s');
						  $dts['iChangeNo'] = $adtl['iChangeNo'];
						  $assvrfObj->setAllVar($dts);
						  $res = $assvrfObj->insert();

						  // $dtl['eNeedToVerify'] = 'Yes';
						  // $wh = "iAsociationID=".$asocs[$l]['iAsociationID'];
						  // $res = $assObj->updateData($dtl, $wh);
						  // $res = $assObj->updateData($data, $where); //
						  $data['iChangeNo'] = $adtl['iChangeNo'];
						  $res = $assObj->updateData($data, " iAsociationID=".$v['iAsociationID']);

                    //$assObj->setAllVar($data);
/*                    $where = "iAsociationID in (".$assocStr.")";

						  $asocs = $assObj->getDetails('*',' AND '.$whr);
						  for($l=0; $l<count($asocs);$l++) {
								 $dts = $asocs[$l];
								 $dts['eStatus'] = 'Inactive';
								 $dts['eNeedToVerify']='Yes';
								 $dts['iModifiedByID'] = $sess_id;
								 $dts['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
								 $dts['dModifiedDate'] = date('Y-m-d H:i:s');
								 $dts['iChangeNo'] = $adtl['iChangeNo'];
								 $assvrfObj->setAllVar($dts);
								 $res = $assvrfObj->insert();

								 // $dtl['eNeedToVerify'] = 'Yes';
								 // $wh = "iAsociationID=".$asocs[$l]['iAsociationID'];
								 // $res = $assObj->updateData($dtl, $wh);
								 // $res = $assObj->updateData($data, $where); //
								 $data['iChangeNo'] = $adtl['iChangeNo'];
								 $res = $assObj->updateData($data, " iAsociationID=".$asocs[$l]['iAsociationID']);
						  }
*/
                    // $assvrfObj->setAllVar($data);

                   /// $assObj->updateData(array("eStatus"=>'Modified'), $where);
                    // $assObj->updateData(array("eNeedToVerify"=>'Yes'), $where);

                    // $res = $assvrfObj->updateData($data, $where);
               } elseif($v['eStatus'] == 'Inactive') {
                    $assocStr = $assObj->getDetails('group_concat(iAsociationID) as Assoc',' AND vAssociationCode="'.$v['vAssociationCode'].'" and eStatus="Inactive"');
                    $assocStr=$assocStr[0]['Assoc'];

                    $data['eStatus'] = 'Active';
                    $data['eNeedToVerify']='Yes';
                    //$assObj->setAllVar($data);
                    //$where = "iAsociationID = ".$v['iAsociationID']."";
                     $where = "iAsociationID in (".$assocStr.")";

						  $dts = $v; 	// $asocs[$l];
						  $dts['eStatus'] = 'Active';
						  $dts['eNeedToVerify']='Yes';
						  $dts['iModifiedByID'] = $sess_id;
						  $dts['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						  $dts['dModifiedDate'] = date('Y-m-d H:i:s');
						  $dts['iChangeNo'] = $adtl['iChangeNo'];
						  $assvrfObj->setAllVar($dts);
						  $res = $assvrfObj->insert();

						  // $res = $assObj->updateData($data, $where);
						  $data['iChangeNo'] = $adtl['iChangeNo'];
						  $res = $assObj->updateData($data, " iAsociationID=".$v['iAsociationID']);

/*						  $asocs = $assObj->getDetails('*',' AND '.$whr);
						  for($l=0; $l<count($asocs);$l++) {
								 $dts = $asocs[$l];
								 $dts['eStatus'] = 'Active';
								 $dts['eNeedToVerify']='Yes';
								 $dts['iModifiedByID'] = $sess_id;
								 $dts['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
								 $dts['dModifiedDate'] = date('Y-m-d H:i:s');
								 $dts['iChangeNo'] = $adtl['iChangeNo'];
								 $assvrfObj->setAllVar($dts);
								 $res = $assvrfObj->insert();

								 // $res = $assObj->updateData($data, $where);
								 $data['iChangeNo'] = $adtl['iChangeNo'];
								 $res = $assObj->updateData($data, " iAsociationID=".$asocs[$l]['iAsociationID']);
						  }
*/
                    /*
						  //$res = $assObj->updateData($data, $where);
                    $assvrfObj->setAllVar($data);
                    $res = $assvrfObj->updateData($data, $where);
                    $assObj->updateData(array("eNeedToVerify"=>'Yes'), $where);
						  */
               } elseif($v['eStatus'] == 'Modified' || $v['eStatus'] == 'Need to Verify') {
                    $var_msg = $smarty->get_template_vars('MSG_VERIFY_NEED_TO_VERIFY_OR_MODIFIED');
                    echo $var_msg;
                    exit;
               }

               $where = 'AND iAsociationID = '.$v['iAsociationID'].'';
               $orderby = ' iVerifiedID Desc';
               $vrfid = $assvrfObj->getDetails('iVerifiedID',$where,$orderby);

               // ---------------------  ORGANIZATION DATA FETCHED ------------------------------------------//
               $orgdata = $orgObj->select($v['iBuyerOrganizationID']);
               $ORGNAME = $orgdata[0]['vCompanyName'];
               $CODE = $orgdata[0]['vOrganizationCode'];

               $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active"' ;
               $smdtls = $secManObj->getDetails('*',$where);
               // ---------------------
               $where = 'AND vType="Association Status Changed" AND eSection = "Member"' ;
               $db_email = $emailObj->getDetails('*',$where);
               $link = SITE_URL_DUM."associationview/".$v['iAsociationID'];
               $body = Array("#ORGNAME#","#ACODE#","#LINK#","#MODIFIED_BY#");
               $post = Array($ORGNAME,$CODE,$link,$sess_user_name."($sess_usertype_short)");

               $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
               $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
               $emailContent_en = trim(str_replace($body,$post, $tbody_en));
               $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
               $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
               // prints($emailContent);exit;

               $Data['iItemID']=$vrfid[0]['iVerifiedID'];
               $Data['iOrganizationID']=$v['iBuyerOrganizationID'];
               $Data['eSubject']='Association';
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
                     $body_arr = Array("#SMNAME#","#ORGNAME#","#ACODE#","#LINK#","#MODIFIED_BY#","#MAIL_FOOTER#","#SITE_URL#");
                     $post_arr = Array($smname,$ORGNAME,$CODE,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
                     $sendMail->Send("Association Status Changed","Member",$email,$body_arr,$post_arr);
               }
               unset($Data);
               unset($_POST);

               if($res)$var_msg = $smarty->get_template_vars('MSG_STATUS_SENT_SUCC');else$var_msg = $smarty->get_template_vars('MSG_STATUS_SENT_ERR');
          }
     } else { // if($mode == 'deleteall' || $mode == 'delete')
          $where = " AND iAsociationID IN ($val) ";
          $arr = $assObj->getDetails('*',$where);

          foreach($arr as $k=>$v) {

					$whr = " vAssociationCode='".$v['vAssociationCode']."'";

					$asdt = $assObj->getDetails('iChangeNo'," AND ".$whr,' iChangeNo DESC ','',' LIMIT 0,1');
					// prints($asdt); exit;
					if($asdt[0]['iChangeNo'] == '') {
						$asdt[0]['iChangeNo'] = 0;
					}
					$adtl['iChangeNo'] = ($asdt[0]['iChangeNo']+1);

               if($v['eStatus'] == 'Active' || $v['eStatus'] == 'Inactive') {
						  $whr = " vAssociationCode='".$v['vAssociationCode']."'";
						  // $ar = $assObj->getDetails('*',$whr);

                    $data['eStatus'] = 'Delete';
                    $data['iModifiedByID'] = $sess_id;
                    $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						  $dts['dModifiedDate'] = date('Y-m-d H:i:s');
                    // $assObj->setAllVar($data);
                    // $where = " iAsociationID IN (".$v['iAsociationID'].")";
						  $where = $whr; 	// " iAsociationID IN (".$v['iAsociationID'].")";
                    // $res = $assObj->updateData($data, $whr);

						  $dts = $v;
						  $dts['eStatus'] = 'Delete';
						  $dts['iModifiedByID'] = $sess_id;
						  $dts['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						  $dts['dModifiedDate'] = date('Y-m-d H:i:s');
						  $assvrfObj->setAllVar($dts);
						  $res = $assvrfObj->insert();

						  $data['iChangeNo'] = $adtl['iChangeNo'];
						  $res = $assObj->updateData($data, " iAsociationID=".$v['iAsociationID']);

/*						  $asocs = $assObj->getDetails('*',' AND '.$whr);
						  for($l=0; $l<count($asocs);$l++) {
								 $dts = $asocs[$l];
								 $dts['eStatus'] = 'Delete';
								 $dts['iModifiedByID'] = $sess_id;
								 $dts['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
								 $dts['dModifiedDate'] = date('Y-m-d H:i:s');
								 $assvrfObj->setAllVar($dts);
								 $res = $assvrfObj->insert();

								 $data['iChangeNo'] = $adtl['iChangeNo'];
								 $res = $assObj->updateData($data, " iAsociationID=".$asocs[$l]['iAsociationID']);
						  }
*/
                    // $assvrfObj->setAllVar($data);
                    // $res = $assvrfObj->updateData($data, $whr);
                    $where = 'AND iAsociationID = '.$v['iAsociationID'].'';
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
                    $Data['iOrganizationID']=$v['iBuyerOrganizationID'];
                    $Data['eSubject']='Association';
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
                          $body_arr = Array("#SMNAME#","#ORGNAME#","#ACODE#","#LINK#","#DELETE_BY#","#MAIL_FOOTER#","#SITE_URL#");
                          $post_arr = Array($smname,$ORGNAME,$CODE,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
                          $sendMail->Send("Association Deleted","Member",$email,$body_arr,$post_arr);
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