<?php

include(S_SECTIONS."/member/memberaccess.php");

$iGroupID = GetVar('id');
$msg = GetVar('msg');
if($msg == 'ras') {
   $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
   $msg = $smarty->get_template_vars('MSG_ADD_ERR');
}

if(!isset($orgGroupObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
   $orgGroupObj =	new OrganizationGroup();
}
//print_r($orgGroupObj);
if(!isset($orgObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
   $orgObj =	new Organization();
}
if(!isset($UsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$UsrObj = new OrganizationUser;
}
if(!isset($orgStaObj)) {
	require_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$orgStaObj = new StatusMaster;
	//$sess_id
}

if(!isset($orgPrefObj)) {
   require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgPrefObj = new OrganizationPreference();
	//$sess_id
}

if($iGroupID != '') {
   $view = 'verify';
   $grpData = $orgGroupObj->select($iGroupID);
   $msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
     // prints($grpData);exit;
     $userStatus = @explode(";",$grpData[0]['tPermission']);
     $invUserStatus = $userStatus[0];
     $invUserStatus = str_replace("inv:","",$invUserStatus);
     $poUserStatus = $userStatus[1];
     $poUserStatus = str_replace("po:","",$poUserStatus);
     $invUserStatus = @explode(',',$invUserStatus);
     $poUserStatus = @explode(',',$poUserStatus);

	  $invUserStatus = $userStatus[0];
     $invUserStatus = str_replace("inv:","",$invUserStatus);
     $poUserStatus = $userStatus[1];
     $poUserStatus = str_replace("po:","",$poUserStatus);
     $invUserStatus = @explode(',',$invUserStatus);
     $poUserStatus = @explode(',',$poUserStatus);

	  $OuserAcpt = $userAcpt = @explode(";",$grpData[0]['tAcceptancePermit']);
     $invUserAcpt = $userAcpt[0];
     $invUserAcpt = str_replace("inv:","",$invUserAcpt);
     $poUserAcpt = $userAcpt[1];
     $poUserAcpt = str_replace("po:","",$poUserAcpt);
     $invUserAcpt = @explode(',',$invUserAcpt);
     $poUserAcpt = @explode(',',$poUserAcpt);

	  $ecreate = array();
	  $eimport = array();
	  $everify = array();
	  if(strpos($grpData[0]['eFormCreation'],'po')!==false) {
			$ecreate['po'] = 'Yes';
	  }
	  if(strpos($grpData[0]['eFormCreation'],'inv')!==false) {
			$ecreate['inv'] = 'Yes';
	  }
	  if(strpos($grpData[0]['eImportCreation'],'po')!==false) {
			$eimport['po'] = 'Yes';
	  }
	  if(strpos($grpData[0]['eImportCreation'],'inv')!==false) {
			$eimport['inv'] = 'Yes';
	  }
	  if(strpos($grpData[0]['eVerify'],'po')!==false) {
			$everify['po'] = 'Yes';
	  }
	  if(strpos($grpData[0]['eVerify'],'inv')!==false) {
			$everify['inv'] = 'Yes';
	  }

     $orgdata = $orgObj->select($grpData[0]['iOrganizationID']);
     $where =' AND iUserID IN ('.$grpData[0]['tUserID'].')';
     $userdata = $UsrObj->getDetails("CONCAT(vFirstName,' ',vLastName) as vTitle,iUserID as Id",$where);
     $where = " ";
     $status = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatus_en as status',$where,'iDisplayOrder','');
     // prints($status); exit;

    if($orgdata[0]['eOrganizationType']=='Buyer2') {
      if(trim($grpData[0]['vRFQ2AwardAcceptPermits'])!='') {
         $rfq2awrdacpt = @explode(',',$grpData[0]['vRFQ2AwardAcceptPermits']);
      } else {
         $rfq2awrdacpt = array();
      }
      if(trim($grpData[0]['vRFQ2BidPermits'])!='') {
         $rfq2bid = @explode(',',$grpData[0]['vRFQ2BidPermits']);
      } else {
         $rfq2bid = array();
      }
      $rfq2awrdacptsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en NOT IN ('Create','Rejected') "); 	// ,'Verify','Accepted'
      $crfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Create'");
      $vrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Verify'");
      $arfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Accepted'");
      $rrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Rejected'");
      $smarty->assign('rfq2bid',$rfq2bid);
      $smarty->assign('rfq2awrdacpt',$rfq2awrdacpt);
      $smarty->assign('rfq2awrdacptsts',$rfq2awrdacptsts);
      $smarty->assign('crfq2awrdsts',$crfq2awrdsts);
      $smarty->assign('vrfq2awrdsts',$vrfq2awrdsts);
      $smarty->assign('arfq2awrdsts',$arfq2awrdsts);
      $smarty->assign('rrfq2awrdsts',$rrfq2awrdsts);
   } else {
      if(trim($grpData[0]['vRFQ2AwardPermits'])!='') {
         $rfq2awrd = @explode(',',$grpData[0]['vRFQ2AwardPermits']);
      } else {
         $rfq2awrd = array();
      }
      if(trim($grpData[0]['vRFQ2Permits'])!='') {
         $rfq2s = @explode(',',$grpData[0]['vRFQ2Permits']);
      } else {
         $rfq2s = array();
      }
      $rfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en NOT IN ('Accepted','Rejected') "); 	// 'Create','Verify',
      $crfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Create'");
      $vrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Verify'");
      $arfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Accepted'");
      $rrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Rejected'");
      $smarty->assign('rfq2s',$rfq2s);
      $smarty->assign('rfq2awrd',$rfq2awrd);
      $smarty->assign('rfq2awrdsts',$rfq2awrdsts);
      $smarty->assign('crfq2awrdsts',$crfq2awrdsts);
      $smarty->assign('vrfq2awrdsts',$vrfq2awrdsts);
      $smarty->assign('arfq2awrdsts',$arfq2awrdsts);
      $smarty->assign('rrfq2awrdsts',$rrfq2awrdsts);
   }
}

$ores = $orgPrefObj->getDetails('*'," AND iOrganizationId=".$grpData[0]['iOrganizationID']);

$smarty->assign('iGroupID',$iGroupID);
$smarty->assign('grpData',$grpData);
$smarty->assign('orgdata',$orgdata);
$smarty->assign('view',$view);
$smarty->assign('userdata',$userdata);
$smarty->assign('status',$status);
$smarty->assign('ecreate',$ecreate);
$smarty->assign('eimport',$eimport);
$smarty->assign('everify',$everify);
$smarty->assign('poUserStatus',$poUserStatus);
$smarty->assign('invUserStatus',$invUserStatus);
$smarty->assign('poUserAcpt',$poUserAcpt);
$smarty->assign('invUserAcpt',$invUserAcpt);
$smarty->assign('msg',$msg);
$smarty->assign('ores',$ores);
?>