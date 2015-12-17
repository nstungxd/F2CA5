<?php
if(!isset($b2baObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_Association.php");
	$b2baObj = new Buyer2_Buyer_Association();
}
if(!isset($b2bavObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_Association_ToVerify.php");
	$b2bavObj = new Buyer2_Buyer_Association_ToVerify();
}
if(!isset($emailObj)) {
   include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
   $emailObj = new EmailTemplate();
}
$mod = PostVar('mod');
$admr = PostVar('admr');
$iAssociationId = PostVar('iAssociationId');
$Data = PostVar('Data');
$body_arr = '';
$type = '';
$post_data = $_POST;
// pr($_POST); exit;

if($mod=='verify')
{
   $dtv = $vasocdt = $b2bavObj->getDetails('*', " AND iAssociationId=$iAssociationId ", ' iVerifiedID DESC ', '', ' LIMIT 0,1');
   $dtv = $dtv[0];
   if(is_array($vasocdt) && count($vasocdt)>0 && isset($vasocdt[0]['iAssociationId']) && isset($vasocdt[0]['iVerifiedID'])) {
      $dtv['eVerifiedBy'] = $sess_usertype_short;
      $dtv['iVerifiedByID'] = $sess_id;
      $dtv['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
      // if(! (($dtv['eStatus']=='Active' || $dtv['eStatus']=='Inactive' || $dtv['eStatus']=='Delete') )) {
      if(! (($dtv['eStatus']=='Active' || $dtv['eStatus']=='Inactive' || $dtv['eStatus']=='Delete') && $dtv['eNeedToVerify']=='Yes')) {
         $dtv['eStatus'] = 'Active';
      }
      $dtv['eNeedToVerify'] = 'No';
      $rs = $b2bavObj->updateData($dtv, " iVerifiedID='".$vasocdt[0]['iVerifiedID']."'");
      if($rs) {
         unset($dtv['iVerifiedID']);
         unset($dtv['iAssociationId']);
         if($vasocdt[0]['eStatus']=='Delete' && $vasocdt[0]['eNeedToVerify']=='Yes') {
            $rs = $b2baObj->delete($iAssociationId);
         } else {
            $rs = $b2baObj->updateData($dtv, " iAssociationId=$iAssociationId ");
         }
      }
   } else {
      $dtv = $vasocdt = $b2baObj->select($iAssociationId);
      $dtv = $dtv[0];
      $dtv['eVerifiedBy'] = $sess_usertype_short;
      $dtv['iVerifiedByID'] = $sess_id;
      $dtv['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
      if(! (($dtv['eStatus']=='Active' || $dtv['eStatus']=='Inactive' || $dtv['eStatus']=='Delete') && $dtv['eNeedToVerify']=='Yes')) {
         $dtv['eStatus'] = 'Active';
      }
      $dtv['eNeedToVerify'] = 'No';
      if($vasocdt[0]['eStatus']=='Delete' && $vasocdt[0]['eNeedToVerify']=='Yes') {
         $rs = $b2baObj->delete($iAssociationId);
      } else {
         $rs = $b2baObj->updateData($dtv, " iAssociationId=$iAssociationId ");
         $dtv['iAssociationId'] = $iAssociationId;
         $r = $b2bavObj->insert($dtv);
      }
   }
   if($rs) { $msg = 'rvs'; } else { $msg = 'verr'; }
   $id = $iAssociationId;
}
else if($mod=='reject')
{
   $dtv = $vasocdt = $b2bavObj->getDetails('*', " AND iAssociationId=$iAssociationId ", ' iVerifiedID DESC ', '', ' LIMIT 0,1');
   $dtv = $dtv[0];
   if(is_array($vasocdt) && count($vasocdt)>0 && isset($vasocdt[0]['iAssociationId']) && isset($vasocdt[0]['iVerifiedID'])) {
      $dt['eRejectedBy'] = $dtv['eRejectedBy'] = $sess_usertype_short;
      $dt['iRejectedByID'] = $dtv['iRejectedByID'] = $sess_id;
      $dt['dRejectedDate'] = $dtv['dRejectedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
      $dt['tReasonToReject'] = $dtv['tReasonToReject'] = PostVar('tReasonToReject');
      // if(! (($dtv['eStatus']=='Active' || $dtv['eStatus']=='Inactive' || $dtv['eStatus']=='Delete') )) {
      if($dtv['eStatus']=='Inactive' && $dtv['eNeedToVerify']=='Yes') {
         $dt['eStatus'] = $dtv['eStatus'] = 'Active';
      } else {
         $dt['eStatus'] = $dtv['eStatus'] = 'Inactive';
      }
      $dt['eNeedToVerify'] = $dtv['eNeedToVerify'] = 'No';
      $rs = $b2bavObj->updateData($dtv, " iVerifiedID='".$vasocdt[0]['iVerifiedID']."'");
      if($rs) {
         // unset($dtv['iVerifiedID']);
         // unset($dtv['iAssociationId']);
         $rs = $b2baObj->updateData($dt, " iAssociationId=$iAssociationId ");
      }
   } else {
      $dtv = $vasocdt = $b2baObj->select($iAssociationId);
      $dtv = $dtv[0];
      $dt['eRejectedBy'] = $dtv['eRejectedBy'] = $sess_usertype_short;
      $dt['iRejectedByID'] = $dtv['iRejectedByID'] = $sess_id;
      $dt['dRejectedDate'] = $dtv['dRejectedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
      $dt['tReasonToReject'] = $dtv['tReasonToReject'] = PostVar('tReasonToReject');
      if($dtv['eStatus']=='Inactive' && $dtv['eNeedToVerify']=='Yes') {
         $dt['eStatus'] = $dtv['eStatus'] = 'Active';
      } else {
         $dt['eStatus'] = $dtv['eStatus'] = 'Inactive';
      }
      $dt['eNeedToVerify'] = $dtv['eNeedToVerify'] = 'No';
      $rs = $b2baObj->updateData($dt, " iAssociationId=$iAssociationId ");
      $dtv['iAssociationId'] = $iAssociationId;
      $r = $b2bavObj->insert($dtv);
   }
   if($rs) { $msg = 'rrs'; } else { $msg = 'rerr'; }
   $id = $iAssociationId;
}
else if(trim($iAssociationId)!='' && $iAssociationId>0 && $mod=='edit')
{
   // $mod = 'edit';
	if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']=='Buyer2') {
		if(isset($Data['iBuyer2Id']) && ($Data['iBuyer2Id']<1 || $Data['iBuyer2Id']!=$curORGID)) {
			header("Location: ".SITE_URL_DUM."b2buyerasoclist");
			exit;
		} else {
			$Data['iBuyer2Id'] = $curORGID;
		}
	}
   $Data['eModifiedBy'] = $sess_usertype_short;
   $Data['iModifiedByID'] = $sess_id;
   $Data['dModifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
   $dtv['eStatus'] = $Data['eStatus'] = 'Modified';
   $Data['iAssociationId'] = $iAssociationId;
   $odtl = $b2baObj->select($iAssociationId);
	if(trim($odtl[0]['vACode'])=='') {
		$dtv['vACode'] = $Data['vACode'] = $b2baObj->getUniqueCode('');
	}
   $Data = array_merge($odtl[0],$Data);
   unset($Data['eVerifiedBy']);
   unset($Data['iVerifiedByID']);
   unset($Data['dVerifiedDate']);
   unset($Data['tReasonToReject']);
   unset($Data['eRejectedBy']);
   unset($Data['iRejectedByID']);
   unset($Data['dRejectedDate']);
   // pr($Data); exit;
   $rs = $b2bavObj->insert($Data);
   if($rs) {
      $r = $b2baObj->updateData($dtv, " iAssociationId=$iAssociationId ");
      $msg = 'rus';
		//
		$esubtyp = 'Buyer2 Buyer Association Modified';
      $whr_cndt = " AND vType='$esubtyp' AND eSection='Member' " ;
      $email_cnt = $emailObj->getDetails('*', $whr_cndt);
      $type = "Modified";
      $body = Array("#BUYER2#","#BUYER#","#ACODE#","#LINK#","#MODIFIED_BY#");
		$body_arr = Array("#USER#","#BUYER2#","#BUYER#","#ACODE#","#LINK#","#MODIFIED_BY#","#MAIL_FOOTER#","#SITE_URL#");
   } else {
		$msg = 'uerr';
	}
   $id = $iAssociationId;
}
else if($mod == 'add')
{
   // $mod = 'add';
	if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']=='Buyer2') {
		$Data['iBuyer2Id'] = $curORGID;
	}
	$drec = $b2baObj->getDetails('*'," AND iBuyer2Id=".$Data['iBuyer2Id']." AND iBuyerId=".$Data['iBuyerId']."");
	if(is_array($drec) && count($drec)>0 && isset($drec[0]['iAssociationId']) && $drec[0]['iAssociationId']>0) {
		if(isset($_SERVER['HTTP_REFERER']) && trim($_SERVER['HTTP_REFERER'])!='') {
			header("Location: ".$_SERVER['HTTP_REFERER']);
		} else {
			header("Location: ".SITE_URL_DUM."b2buyerasoclist");
		}
		exit;
	}
   $Data['dADate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
   $Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];
   $Data['eCreatedBy'] = $sess_usertype_short;
   $Data['iCreatedByID'] = $sess_id;
   $Data['eStatus'] = 'Need to Verify';
	$Data['vACode'] = $b2baObj->getUniqueCode('');
   $rs = $id = $b2baObj->insert($Data);
   if($rs) {
      $Data['iAssociationId'] = $rs;
      $r = $b2bavObj->insert($Data);
      $msg = 'ras';
		//
		$esubtyp = 'New Buyer2 Buyer Association';
      $whr_cndt = " AND vType='$esubtyp' AND eSection='Member' " ;
      $email_cnt = $emailObj->getDetails('*', $whr_cndt);
      $type = "Create";
      $body = Array("#BUYER2#","#BUYER#","#ACODE#","#LINK#","#ADDED_BY#");
		$body_arr = Array("#USER#","#BUYER2#","#BUYER#","#ACODE#","#LINK#","#ADDED_BY#","#MAIL_FOOTER#","#SITE_URL#");
   } else {
      $msg = 'aerr';
   }
}

if(($mod=='add' || $mod=='edit') && $rs && $id>0)
{
	$flds = "b2ba.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2ba.iBuyer2Id) as vBuyer2,
					(Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2ba.iBuyerId) as vBuyer";
	$assocs = $b2baObj->getDetails($flds," AND b2ba.eStatus IN ('Active','Inactive') AND b2ba.eNeedToVerify!='Yes' AND b2ba.iAssociationId=$id ");
	if(is_array($assocs) && count($assocs)>0 && isset($email_cnt) && is_array($email_cnt) && count($email_cnt)>0)
	{
		$verifyid = $b2bavObj->getDetails('iVerifiedID'," AND iAssociationId='".$id."' ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
		if(isset($verifyid[0]['iVerifiedID']) && $verifyid[0]['iVerifiedID']>0) {
			$rplarr = Array("Dear #USER#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
			$link = SITE_URL_DUM."b2buyerasocview/".$id;
			$post = array($assocs[0]['vBuyer2'],$assocs[0]['vBuyer'],$assocs[0]['vACode'],$link,$sess_user_name."($sess_usertype_short)");
			$tbody_en = str_replace($rplarr," ", $email_cnt[0]['tBody_en']);
			$emailContent_en = trim(str_replace($body, $post, $tbody_en));
			$tbody_fr = str_replace($rplarr," ", $email_cnt[0]['tBody_fr']);
			$emailContent_fr = trim(str_replace($body, $post, $tbody_fr));
			//
			$uvdtl['iItemID'] = $verifyid[0]['iVerifiedID'];
			$uvdtl['iOrganizationID'] = $assocs[0]['iBuyer2Id'];
			$uvdtl['eSubject'] = 'Association';
			$uvdtl['eType'] = $type;
			$uvdtl['vMailSubject_en'] = $email_cnt[0]['vSub_en'];
			$uvdtl['vMailSubject_fr'] = $email_cnt[0]['vSub_fr'];
			$uvdtl['tMailContent_en'] = $emailContent_en;
			$uvdtl['tMailContent_fr'] = $emailContent_fr;
			$uvdtl['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			$uvdtl['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			$uvdtl['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
			if(!isset($userActionObj)) {
				include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
				$userActionObj = new UserActionVerification();
			}
			$ua = $userActionObj->insert($uvdtl);
			//
			if(!isset($secManObj)) {
				require_once(SITE_CLASS_APPLICATION."securitymanager/class.SecurityManager.php");
				$secManObj = new SecurityManager();
			}
			if(!isset($orgUserObj)) {
				include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUser.php');
				$orgUserObj = new OrganizationUser();
			}
			//
			if($sess_usertype_short=='OA') {
				$smwhr = " AND eEmailNotification='Yes' AND eStatus='Active' ";
				$smgrs = $secManObj->getDetails('vEmail', $smwhr);
				$oawhr = " AND iUserID!='".$sess_id."' AND eStatus='Active' AND eUserType='Admin' AND iOrganizationID='".$assocs[0]['iBuyer2Id']."' AND eEmailNotification='Yes' ";
				$oadms = $orgUserObj->getDetails('vEmail',$oawhr);
			} else {
				$smgrs = '';
				$smwhr = " AND iSMID!='".$sess_id."' AND eEmailNotification='Yes' AND eStatus='Active' ";
				$smgrs = $secManObj->getDetails('vEmail', $smwhr);
			}
			//
			if(!isset($sendMail)) {
				include_once(SITE_CLASS_GEN."class.sendmail.php");
				$sendMail = new SendPHPMail();
			}
			$smemails = '';
			$oaemails = '';
			if(is_array($smgrs) && count($smgrs)>0) {
				/*$sm_emails = multi21Array($smgrs,'vEmail');
				$sm_emails = array_filter($sm_emails);
				$smemails = @ implode(',',$sm_emails);*/
				for($l=0;$l<count($smgrs);$l++) {
					$user = $smgrs[$l]['vFirstName'].' '.$smgrs[$l]['vLastName'];
					$smemails = $smgrs[$l]['vEmail'];
					if(trim($smemails)!='') {
						// $user = 'Security Manager';
						$post_arr = Array($user,$assocs[0]['vBuyer2'],$assocs[0]['vProduct'],$assocs[0]['vACode'],$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
						$sendMail->Send($esubtyp,"Member",$smemails,$body_arr,$post_arr);
					}
				}
			}
			if(is_array($oadms) && count($oadms)>0) {
				//$oa_emails = multi21Array($oadms,'vEmail');
				//$oa_emails = array_filter($oa_emails);
				//$oaemails = @ implode(',',$oa_emails);
				for($l=0;$l<count($oadms);$l++) {
					$user = $oadms[$l]['vFirstName'].' '.$oadms[$l]['vLastName'];
					$oaemails = $oadms[$l]['vEmail'];
					if(trim($oaemails)!='') {
						// $user = 'Organization Admin';
						$post_arr = Array($user,$assocs[0]['vBuyer2'],$assocs[0]['vProduct'],$assocs[0]['vACode'],$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
						$sendMail->Send($esubtyp,"Member",$oaemails,$body_arr,$post_arr);
					}
				}
			}
			//
			if(trim($smemails)!='') {
				$user = 'Security Manager';
				$post_arr = Array($user,$assocs[0]['vBuyer2'],$assocs[0]['vBuyer'],$assocs[0]['vACode'],$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
				$sendMail->Send($esubtyp,"Member",$smemails,$body_arr,$post_arr);
			}
			if(trim($oaemails)!='') {
				$user = 'Organization Admin';
				$post_arr = Array($user,$assocs[0]['vBuyer2'],$assocs[0]['vBuyer'],$assocs[0]['vACode'],$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
				$sendMail->Send($esubtyp,"Member",$oaemails,$body_arr,$post_arr);
			}
			//
		}
	}
}

if(trim($admr)=='admr') {
	if(isset($post_data) && count($post_data)>0 && ($mod=='add' || $mod=='edit')) {
		$_SESSION[PRJ_CONST_PREFIX.'_postdata'] = serialize($post_data);
	}
   $_SESSION[PRJ_CONST_PREFIX.'_action_msg'] = $msg;
	header('Location: '.SITE_URL_DUM.'b2buyerasoc/'.$msg);
} else {
   $_SESSION[PRJ_CONST_PREFIX.'_action_msg'] = $msg;
	header('Location: '.SITE_URL_DUM.'b2buyerasoclist/'.$msg);
}
exit;
?>