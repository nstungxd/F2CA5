<?php

include(S_SECTIONS."/member/memberaccess.php");

$iUserID = $_GET['id'];
$msg = (isset($_GET['msg']))? $_GET['msg'] : '';
if(!isset($orgUserObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
   $orgUserObj =	new OrganizationUser();
}
if(!isset($orgUserPerObj)) {
   require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
   $orgUserPerObj = new OrganizationUserPermission();
}
if(!isset($orgUserPermVerifyObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermissionToVerify.php");
	$orgUserPermVerifyObj =	new OrganizationUserPermissionToVerify();
}
if(!isset($userToVerifyObj)) {
	include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
	$userToVerifyObj = new OrganizationUserToverify();
}

$orgUserObj->setiUserID($iUserID);
if(!isset($orgStaObj)) {
	  require_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	  $orgStaObj = new StatusMaster();
}
if(!isset($orgObj)) {
	 include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	 $orgObj =	new Organization();
}

if(!isset($orgPrefObj)) {
   require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgPrefObj = new OrganizationPreference();
	//$sess_id
}

$userStatus = Array();
$userAcpt = Array();
$ures = Array();
     $view = 'verify';
     // $msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
     $where = " AND iUserID='".$iUserID."'";
     $userdata = $orgUserObj->getDetails('*',$where);
     $vuserdata = $userToVerifyObj->getDetails('*',$where,' iVerifiedID DESC ','',' LIMIT 0,1 ');
     $ures = $orgUserPerObj->getDetails('*',$where);
     $userStatus = @explode(";",$ures[0]['tPermission']);
	  $userAcpt = @explode(";",$ures[0]['tAcceptancePermit']);

	  $invUserStatus = $userStatus[0];
     $invUserStatus = str_replace("inv:","",$invUserStatus);
     $poUserStatus = (isset($userStatus[1]))? $userStatus[1] : '';
     $poUserStatus = str_replace("po:","",$poUserStatus);
	  if(trim($invUserStatus)!='')
		 $invUserStatus = @explode(',',$invUserStatus);
	  if(trim($poUserStatus)!='')
		 $poUserStatus = @explode(',',$poUserStatus);

	  $invUserAcpt = $userAcpt[0];
     $invUserAcpt = str_replace("inv:","",$invUserAcpt);
     $poUserAcpt = (isset($userAcpt[1]))? $userAcpt[1] : '';
     $poUserAcpt = str_replace("po:","",$poUserAcpt);
	  if(trim($invUserAcpt)!='')
		 $invUserAcpt = @explode(',',$invUserAcpt);
	  if(trim($poUserAcpt)!='')
		 $poUserAcpt = @explode(',',$poUserAcpt);
	$poapt = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatus_en as status'," AND eFor='PO' AND vStatus_en='Accepted' ");
	$invapt = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatus_en as status'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
   $ecreate = array();
	$eimport = array();
	$everify = array();
    $ures[0]['eFormCreation'] = (isset($ures[0]['eFormCreation']))? $ures[0]['eFormCreation'] : '';
   if(strpos($ures[0]['eFormCreation'],'po')!==false) {
		 $ecreate['po'] = 'Yes';
	}
	if(strpos($ures[0]['eFormCreation'],'inv')!==false) {
		 $ecreate['inv'] = 'Yes';
	}
    $ures[0]['eImportCreation'] = (isset($ures[0]['eImportCreation']))? $ures[0]['eImportCreation'] : '';
	if(strpos($ures[0]['eImportCreation'],'po')!==false) {
		 $eimport['po'] = 'Yes';
	}
	if(strpos($ures[0]['eImportCreation'],'inv')!==false) {
		 $eimport['inv'] = 'Yes';
	}
    $ures[0]['eVerify'] = (isset($ures[0]['eVerify']))? $ures[0]['eVerify'] : '';
	if(strpos($ures[0]['eVerify'],'pi:ia')!==false) {
		 $everify['po'] = 'Yes';
	}
	if(strpos($ures[0]['eVerify'],'ii:pa')!==false) {
		 $everify['inv'] = 'Yes';
	}
	// prints($poUserAcpt); exit;

     $where = " AND iOrganizationID='".$userdata[0]['iOrganizationID']."'";
     $orgdata = $orgObj->getDetails('vCompanyName,eOrganizationType',$where);
     $orgname = $orgdata[0]['vCompanyName'];
     $where = "";
     $status = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatus_en as status',$where,'iDisplayOrder','');
// prints($ures); exit;
$ures[0]['eStatus'] = (isset($ures[0]['eStatus']))? $ures[0]['eStatus'] : '';
if(($ures[0]['eStatus'] == 'Need to Verify'))
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($ures[0]['eCreatedBy']=='SM') {
						if($ures[0]['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
		case 'orgadmin':
					if($ures[0]['eCreatedBy']=='OA') {
						if($ures[0]['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
	}
}
else if($ures[0]['eStatus'] == 'Modified')
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($ures[0]['eModifiedBy']=='SM') {
						if($ures[0]['iModifiedByID']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
		case 'orgadmin':
					if($ures[0]['eModifiedBy']=='OA') {
						if($ures[0]['iModifiedByID']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
	}
}

if($ures[0]['eStatus'] == 'Need to Verify') {
      if($ures[0]['iCreatedBy'] == $sess_id) {
       $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
     }
} else {
          switch($ures[0]['eStatus']){
             case "Modified":
							if($ures[0]['iModifiedByID'] == $sess_id){
							$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
							} else {
							$msg = $smarty->get_template_vars('MSG_VERIFY_MODIFICATION');
							}
             break;
             case "Delete":
							if($ures[0]['iModifiedByID'] == $sess_id){
							$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
							} else {
							$msg = $smarty->get_template_vars('MSG_VERIFY_DELETE');
							}
             break;
             /*case "Inactive":
							if($ures[0]['iModifiedByID'] == $sess_id){
							$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
							} else {
							$msg = $smarty->get_template_vars('MSG_VERIFY_INACTIVE');
							}
             break;*/
     }
}
$OuserData[0]['eNeedToVerify'] = (isset($OuserData[0]['eNeedToVerify']))? $OuserData[0]['eNeedToVerify'] : '';
if($OuserData[0]['eNeedToVerify'] == 'Yes') {
	 $msg = $smarty->get_template_vars('MSG_VERIFY_STATUS');
	 $msg .= "<br/>".$smarty->get_template_vars('LBL_NEW_STATUS_WILL_BE')." '".$OuserData[0]['eStatus']."'.";
}
$vures = array();
$usrStatus = array();
if(($ures[0]['eStatus']=='Active' || $ures[0]['eStatus']=='Inactive') && $ures[0]['eNeedToVerify']=='No') {
   $vures = $ures;
} else {
// $vures = $orgUserPermVerifyObj->getDetails('*'," AND iUserID=$iUserID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
// if($verify == 'yes') {
   $where = " AND iUserID='".$iUserID."'";
   // $urs = $orgUserPermVerifyObj->getDetails('*',$where,' iVerifiedID DESC ','',' LIMIT 0,1 ');
   $vures = $urs = $orgUserPermVerifyObj->getDetails('*'," AND iUserID=$iUserID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
   $usrStatus = @explode(";",$urs[0]['tPermission']);
	$userAcpt = @explode(";",$urs[0]['tAcceptancePermit']);

   $invUserStatus = $usrStatus[0];
   $invUserStatus = str_replace("inv:","",$invUserStatus);
   $poUserStatus = (isset($usrStatus[1]))? $usrStatus[1] : '';
   //$poUserStatus = $usrStatus[1];
   $poUserStatus = str_replace("po:","",$poUserStatus);
   if(trim($invUserStatus)!='')
      $invUserStatus = @explode(',',$invUserStatus);
   if(trim($poUserStatus)!='')
      $poUserStatus = @explode(',',$poUserStatus);

   $invUserAcpt = $userAcpt[0];
   $invUserAcpt = str_replace("inv:","",$invUserAcpt);
   $poUserAcpt = (isset($userAcpt[1]))? $userAcpt[1] : '';
   //$poUserAcpt = $userAcpt[1];
   $poUserAcpt = str_replace("po:","",$poUserAcpt);
   if(trim($invUserAcpt)!='')
      $invUserAcpt = @explode(',',$invUserAcpt);
   if(trim($poUserAcpt)!='')
      $poUserAcpt = @explode(',',$poUserAcpt);
//   prints($poUserAcpt); exit;
   $ecreate = array();
	$eimport = array();
	$everify = array();
    $vures[0]['eFormCreation'] = (isset($vures[0]['eFormCreation']))? $vures[0]['eFormCreation'] : '';
   if(strpos($vures[0]['eFormCreation'],'po')!==false) {
		 $ecreate['po'] = 'Yes';
	}
	if(strpos($vures[0]['eFormCreation'],'inv')!==false) {
		 $ecreate['inv'] = 'Yes';
	}
    $vures[0]['eImportCreation'] = (isset($vures[0]['eImportCreation']))? $vures[0]['eImportCreation'] : '';
	if(strpos($vures[0]['eImportCreation'],'po')!==false) {
		 $eimport['po'] = 'Yes';
	}
	if(strpos($vures[0]['eImportCreation'],'inv')!==false) {
		 $eimport['inv'] = 'Yes';
	}
    $vures[0]['eVerify'] = (isset($vures[0]['eVerify']))? $vures[0]['eVerify'] : '';
	if(strpos($vures[0]['eVerify'],'pi:ia')!==false) {
		 $everify['po'] = 'Yes';
	}
	if(strpos($vures[0]['eVerify'],'ii:pa')!==false) {
		 $everify['inv'] = 'Yes';
	}
// }
}
// prints($poUserAcpt); exit;
// prints($vures); exit;
// prints($status); exit;
// prints($vuserdata); exit;
$usrvrfy = '';
if(!(($userdata[0]['eStatus'] == 'Active' || $userdata[0]['eStatus'] == 'Inactive') && $userdata[0]['eNeedToVerify']!='Yes')) {
   if($vuserdata[0]['eModifiedBy']=='SM' && $sess_usertype_short=='SM' && $sess_id!=$vuserdata[0]['iModifiedByID']) {
		 $usrvrfy = 'yes';
   } else if($vuserdata[0]['eModifiedBy']=='OA') {
		 if($sess_usertype_short=='OA' && $sess_id!=$vuserdata[0]['iModifiedByID']) {
		    $usrvrfy = 'yes';
		 } else if($sess_usertype_short=='SM') {
		    $usrvrfy = 'yes';
		 }
	}
}
//
if($orgdata[0]['eOrganizationType']=='Buyer2') {
   if(trim($vures[0]['vRFQ2AwardAcceptPermits'])!='') {
      $rfq2awrdacpt = @explode(',',$vures[0]['vRFQ2AwardAcceptPermits']);
   } else {
      $rfq2awrdacpt = array();
   }
   if(trim($vures[0]['vRFQ2BidPermits'])!='') {
      $rfq2bid = @explode(',',$vures[0]['vRFQ2BidPermits']);
   } else {
      $rfq2bid = array();
   }

	// pr($rfq2awrdacpt); exit;
   $rfq2awrdacptsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en NOT IN ('Create','Rejected') "); 	// 'Verify','Accepted'
   $crfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Create'");
   $vrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Verify'");
   $arfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Accepted'");
   $rrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Rejected'");
	// pr($rfq2awrdacptsts); exit;
	$smarty->assign('rfq2bid',$rfq2bid);
   $smarty->assign('rfq2awrdacpt',$rfq2awrdacpt);
   $smarty->assign('rfq2awrdacptsts',$rfq2awrdacptsts);
   $smarty->assign('crfq2awrdsts',$crfq2awrdsts);
   $smarty->assign('vrfq2awrdsts',$vrfq2awrdsts[0]['iStatusID']);
   $smarty->assign('arfq2awrdsts',$arfq2awrdsts);
   $smarty->assign('rrfq2awrdsts',$rrfq2awrdsts);
} else {
   if(trim($vures[0]['vRFQ2AwardPermits'])!='') {
      $rfq2awrd = @explode(',',$vures[0]['vRFQ2AwardPermits']);
   } else {
      $rfq2awrd = array();
   }
   if(trim($vures[0]['vRFQ2Permits'])!='') {
      $rfq2s = @explode(',',$vures[0]['vRFQ2Permits']);
   } else {
      $rfq2s = array();
   }
	// pr($rfq2awrd); exit;
   $rfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en NOT IN ('Accepted','Rejected') "); 	// 'Create','Verify'
   $crfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Create'");
   $vrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Verify'");
   $arfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Accepted'");
   $rrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Rejected'");
	// pr($rfq2awrdsts); exit;
   $smarty->assign('rfq2s',$rfq2s);
   $smarty->assign('rfq2awrd',$rfq2awrd);
   $smarty->assign('rfq2awrdsts',$rfq2awrdsts);
   $smarty->assign('crfq2awrdsts',$crfq2awrdsts);
   $smarty->assign('vrfq2awrdsts',$vrfq2awrdsts[0]['iStatusID']);
   $smarty->assign('arfq2awrdsts',$arfq2awrdsts);
   $smarty->assign('rrfq2awrdsts',$rrfq2awrdsts);
}

$ores = $orgPrefObj->getDetails('*'," AND iOrganizationId=".$userdata[0]['iOrganizationID']);
// pr($ores); exit;
// prints($orgdata); exit;
$verify = (isset($verify))? $verify : '';
// prints($userdata[0]['ePermissionType']); exit;
$smarty->assign('iUserID',$iUserID);
$smarty->assign('status',$status);
$smarty->assign('poUserStatus',$poUserStatus);
$smarty->assign('invUserStatus',$invUserStatus);
$smarty->assign('poUserStatus',$poUserStatus);
$smarty->assign('poUserAcpt',$poUserAcpt);
$smarty->assign('invUserAcpt',$invUserAcpt);
$smarty->assign('invapt',$invapt);
$smarty->assign('poapt',$poapt);
$smarty->assign('ecreate',$ecreate);
$smarty->assign('eimport',$eimport);
$smarty->assign('everify',$everify);
$smarty->assign('userdata',$userdata);
$smarty->assign('ures',$ures);
$smarty->assign('vures',$vures);
$smarty->assign('orgname',$orgname);
$smarty->assign('view',$view);
$smarty->assign('msg',$msg);
$smarty->assign('usrvrfy',$usrvrfy);
$smarty->assign('verify',$verify);
$smarty->assign('orgdata',$orgdata);
$smarty->assign('ores',$ores);
?>