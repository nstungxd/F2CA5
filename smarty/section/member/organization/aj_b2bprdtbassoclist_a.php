<?php
$mode = PostVar('mode');
$val = PostVar('val');

if(trim($val)=='' || $val<1 || trim($mode)=='') { exit; }

if(!isset($b2bpbObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_BProduct_Association.php");
	$b2bpbObj = new Buyer2_Buyer_BProduct_Association();
}
if(!isset($b2bpbvObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_BProduct_Association_ToVerify.php");
	$b2bpbvObj = new Buyer2_Buyer_BProduct_Association_ToVerify();
}
if(!isset($emailObj)) {
   include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
   $emailObj = new EmailTemplate();
}
$flds = "b2bpb.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpb.iBuyer2Id) as vBuyer2,
					(Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2bpb.iProductId) as vProduct,
               (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpb.iBuyerId) as vBuyer";
$assocs = $b2bpbObj->getDetails($flds," AND b2bpb.eStatus IN ('Active','Inactive') AND b2bpb.eNeedToVerify!='Yes' AND b2bpb.iAssociationId IN ($val) ");
// pr($assocs); exit;
$assocsids = multi21Array($assocs,'iAssociationId');
$vl = '';
if(is_array($assocsids) && count($assocsids)>0) {
   $vl = @ implode(',',$assocsids);
}

$rs = false;
$type = '';
$esubtyp = '';
if($mode=='status' && trim($vl)!='')
{
   $sql1 = "UPDATE ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association SET eStatus = IF(eStatus='Inactive','Active','Inactive'), eNeedToVerify='Yes', eModifiedBy='".$sess_usertype_short."', iModifiedByID='".$sess_id."', dModifiedDate='".date('Y-m-d H:i:s')."', eVerifiedBy='', iVerifiedByID='', dVerifiedDate='', eRejectedBy='', iRejectedByID='', dRejectedDate='' WHERE iAssociationId IN ($vl)";
   $sql2 = "INSERT INTO ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association_toverify
            (iAssociationId,iBuyer2Id,iBuyerId,iProductId,vACode,fLimit,fFeePc,fFeeFlat,fAdvancePc,fMinValue,fMaxValue,vNarrative,fAutoAcceptLimit,fTotalGlobalLimit,fTotalOutstandingAmt,dADate,vFromIP,iCreatedByID,eCreatedBy,iModifiedByID,eModifiedBy,dModifiedDate,iRejectedByID,eRejectedBy,dRejectedDate,iVerifiedByID,eVerifiedBy,dVerifiedDate,tReasonToReject,eNeedToVerify,eStatus)
            SELECT * FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE iAssociationId IN ($vl)";
   // $rs = $dbobj->dotransaction($sqls);
   $rs = $dbobj->sql_query($sql1);
   if($rs) {
      $r = $dbobj->sql_query($sql2);
      //
      $msg = $smarty->get_template_vars('MSG_STATUS_SENT_SUCC');
      $esubtyp = 'Buyer2 BProduct Buyer Association Status Changed';
      $whr_cndt = " AND vType='$esubtyp' AND eSection='Member' " ;
      $email_cnt = $emailObj->getDetails('*', $whr_cndt);
      $type = "Modified";
      $body = Array("#BUYER2#","#PRODUCT#","#BUYER#","#ACODE#","#LINK#","#MODIFIED_BY#");
   } else {
      $msg = $smarty->get_template_vars('MSG_STATUS_SENT_ERR');
   }
} else if(($mode=='delete' || $mode=='deleteall') && trim($vl)!='') {
   $sql1 = "UPDATE ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association SET eStatus='Delete', eNeedToVerify='Yes', eModifiedBy='".$sess_usertype_short."', iModifiedByID='".$sess_id."', dModifiedDate='".date('Y-m-d H:i:s')."', eVerifiedBy='', iVerifiedByID='', dVerifiedDate='', eRejectedBy='', iRejectedByID='', dRejectedDate='' WHERE iAssociationId IN ($vl)";
   $sql2 = "INSERT INTO ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association_toverify
            (iAssociationId,iBuyer2Id,iBuyerId,iProductId,vACode,fLimit,fFeePc,fFeeFlat,fAdvancePc,fMinValue,fMaxValue,vNarrative,fAutoAcceptLimit,fTotalGlobalLimit,fTotalOutstandingAmt,dADate,vFromIP,iCreatedByID,eCreatedBy,iModifiedByID,eModifiedBy,dModifiedDate,iRejectedByID,eRejectedBy,dRejectedDate,iVerifiedByID,eVerifiedBy,dVerifiedDate,tReasonToReject,eNeedToVerify,eStatus)
            SELECT * FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association WHERE iAssociationId IN ($vl)";
   // $rs = $dbobj->dotransaction($sqls);
   $rs = $dbobj->sql_query($sql1);
   if($rs) {
      $r = $dbobj->sql_query($sql2);
      //
      $msg = $smarty->get_template_vars('MSG_DEL_SENT_SUCC');
      $esubtyp = 'Buyer2 BProduct Buyer Association Delete';
      $whr_cndt = " AND vType='$esubtyp' AND eSection='Member' ";
      $email_cnt = $emailObj->getDetails('*', $whr_cndt);
      $type = "Delete";
      $body = Array("#BUYER2#","#PRODUCT#","#BUYER#","#ACODE#","#LINK#","#DELETE_BY#");
   } else {
      $msg = $smarty->get_template_vars('MSG_DEL_SENT_ERR');
   }
}
//
// pr($assocs); exit;
if($rs && is_array($assocs) && count($assocs)>0)
{
   for($l=0;$l<count($assocs);$l++)
   {
      if(isset($assocs[$l]['iAssociationId']) && $assocs[$l]['iAssociationId']>0) {
         if(is_array($email_cnt) && count($email_cnt)>0) {
            $verifyid = $b2bpbvObj->getDetails('iVerifiedID'," AND iAssociationId='".$assocs[$l]['iAssociationId']."' ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
            if(isset($verifyid[0]['iVerifiedID']) && $verifyid[0]['iVerifiedID']>0) {
               $rplarr = Array("Dear #USER#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
               $link = SITE_URL_DUM."b2bprodtbasocview/".$assocs[$l]['iAssociationId'];
               $post = array($assocs[$l]['vBuyer2'],$assocs[$l]['vProduct'],$assocs[$l]['vBuyer'],$assocs[$l]['vACode'],$link,$sess_user_name."($sess_usertype_short)");
               $tbody_en = str_replace($rplarr," ", $email_cnt[0]['tBody_en']);
               $emailContent_en = trim(str_replace($body, $post, $tbody_en));
               $tbody_fr = str_replace($rplarr," ", $email_cnt[0]['tBody_fr']);
               $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));
               //
               $uvdtl['iItemID'] = $verifyid[0]['iVerifiedID'];
               $uvdtl['iOrganizationID'] = $assocs[$l]['iBuyer2Id'];
               $uvdtl['eSubject'] = 'Association';
               $uvdtl['eType'] = $type;
               $uvdtl['vMailSubject_en'] = $email_cnt[0]['vSub_en'];
               $uvdtl['vMailSubject_fr'] = $email_cnt[0]['vSub_fr'];
               $uvdtl['tMailContent_en'] = $emailContent_en;
               $uvdtl['tMailContent_fr'] = $emailContent_fr;
               $uvdtl['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
               $uvdtl['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
               $uvdtl['dActionDate'] = date("Y-m-d H:i:s");
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
                  $oawhr = " AND iUserID!='".$sess_id."' AND eStatus='Active' AND eUserType='Admin' AND iOrganizationID='".$assocs[$l]['iBuyer2Id']."' AND eEmailNotification='Yes' ";
                  $oadms = $orgUserObj->getDetails('vEmail',$oawhr);
               } else {
                  $smgrs = '';
                  $smwhr = " AND iSMID!='".$sess_id."' AND eEmailNotification='Yes' AND eStatus='Active' ";
                  $smgrs = $secManObj->getDetails('vEmail', $smwhr);
               }
               $smemails = '';
               $oaemails = '';
               if(is_array($smgrs) && count($smgrs)>0) {
                  $sm_emails = multi21Array($smgrs,'vEmail');
                  $sm_emails = array_filter($sm_emails);
                  $smemails = @ implode(',',$sm_emails);
               }
               if(is_array($oadms) && count($oadms)>0) {
                  $oa_emails = multi21Array($oadms,'vEmail');
                  $oa_emails = array_filter($oa_emails);
                  $oaemails = @ implode(',',$oa_emails);
               }
               //
               if(!isset($sendMail)) {
                  include_once(SITE_CLASS_GEN."class.sendmail.php");
                  $sendMail = new SendPHPMail();
               }
               if(trim($smemails)!='') {
                  $user = 'Security Manager';
                  $body_arr = Array("#USER#","#BUYER2#","#PRODUCT#","BUYER","#ACODE#","#LINK#","#MODIFIED_BY#","#MAIL_FOOTER#","#SITE_URL#");
                  $post_arr = Array($user,$assocs[$l]['vBuyer2'],$assocs[$l]['vProduct'],$assocs[$l]['vBuyer'],$assocs[$l]['vACode'],$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
                  $sendMail->Send($esubtyp,"Member",$smemails,$body_arr,$post_arr);
               }
               if(trim($oaemails)!='') {
                  $user = 'Organization Admin';
                  $body_arr = Array("#USER#","#BUYER2#","#PRODUCT#","BUYER","#ACODE#","#LINK#","#MODIFIED_BY#","#MAIL_FOOTER#","#SITE_URL#");
                  $post_arr = Array($user,$assocs[$l]['vBuyer2'],$assocs[$l]['vProduct'],$assocs[$l]['vBuyer'],$assocs[$l]['vACode'],$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
                  $sendMail->Send($esubtyp,"Member",$oaemails,$body_arr,$post_arr);
               }
               //
            }
         }
      }
   }
}
ob_clean();
echo $msg;
exit;
?>