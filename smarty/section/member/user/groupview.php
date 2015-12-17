<?php
include(S_SECTIONS."/member/memberaccess.php");
$iGroupID = GetVar('id');
$msg = GetVar('msg');
if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
}else $msg='';

if(!isset($orgGroupObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
    $orgGroupObj =	new OrganizationGroup();
}
//print_r($orgGroupObj);
if(!isset($orgGroupVerifyfObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroupToVerify.php");
    $orgGroupVerifyfObj =	new OrganizationGroupToVerify();
}
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
     $OgrpData = $grpData = $orgGroupObj->select($iGroupID);
     if($sess_usertype_short == 'OA' && $grpData[0]['iOrganizationID']!=$curORGID) {
     	  header("Location: ".SITE_URL_DUM."grouplist");
     	  exit;
     }
     // $msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
     // prints($grpData);exit;
     $OuserStatus = $userStatus = @explode(";",$grpData[0]['tPermission']);

     $Oorgdata = $orgdata = $orgObj->select($grpData[0]['iOrganizationID']);
     $where =' AND iUserID IN ('.$grpData[0]['tUserID'].')';
     $Ouserdata = $userdata = $UsrObj->getDetails("CONCAT(vFirstName,' ',vLastName) as vTitle,iUserID as Id",$where);
     $where = " ";
     $Ostatus = $status = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatus_en as status',$where,'iDisplayOrder','');
     //prints($status);exit;
	  $where = 'AND iGroupID = '.$iGroupID.'';
	  $gdts = $orgGroupVerifyfObj->getDetails('*',$where,' iVerifiedID desc ','',' LIMIT 0,1 ');
     if($gdts[0]['eStatus'] == 'Modified' || $gdts[0]['eNeedToVerify'] == 'Yes' || $gdts[0]['eStatus'] == 'Inactive') {
          $where = 'AND iGroupID = '.$iGroupID.'';
          $orderby = ' iVerifiedID Desc';
          $grpData = $orgGroupVerifyfObj->getDetails('*',$where,$orderby);
          $orgdata = $orgObj->select($grpData[0]['iOrganizationID']);
          $where =' AND iUserID IN ('.$grpData[0]['tUserID'].')';
          $userdata = $UsrObj->getDetails("CONCAT(vFirstName,' ',vLastName) as vTitle,iUserID as Id",$where);
          //prints($userdata);exit;
          $where = " ";
          $status = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatus_en as status',$where,'iDisplayOrder','');
			 $userStatus = @explode(";",$grpData[0]['tPermission']);
     }

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
	if(strpos($grpData[0]['eVerify'],'pi:ia')!==false) {
		 $everify['po'] = 'Yes';
	}
	if(strpos($grpData[0]['eVerify'],'ii:pa')!==false) {
		 $everify['inv'] = 'Yes';
	}
}
$verify = '';
if(($OgrpData[0]['eStatus'] == 'Need to Verify'))
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($OgrpData[0]['eCreatedBy']=='SM') {
						if($OgrpData[0]['iCreatedID']!=$sess_id) {
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
					if($OgrpData[0]['eCreatedBy']=='OA') {
						if($OgrpData[0]['iCreatedID']!=$sess_id) {
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
else if($OgrpData[0]['eStatus'] == 'Modified' || $OgrpData[0]['eStatus'] == 'Delete' || $grpData[0]['eNeedToVerify'] == 'Yes')
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($OgrpData[0]['eModifiedBy']=='SM') {
						if($OgrpData[0]['iModifiedByID']!=$sess_id) {
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
					if($OgrpData[0]['eModifiedBy']=='OA') {
						if($OgrpData[0]['iModifiedByID']!=$sess_id) {
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
//prints($OgrpData);
if($OgrpData[0]['eStatus'] == 'Need to Verify'){
      if($OgrpData[0]['iCreatedID'] == $sess_id){
          $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
     }
} else {
	  switch($OgrpData[0]['eStatus']){
		  case "Modified":
			 if($OgrpData[0]['iModifiedByID'] == $sess_id){
					$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
			 } else {
					$msg = $smarty->get_template_vars('MSG_VERIFY_MODIFICATION');
			 }
		  break;
		  case "Delete":
			 if($OgrpData[0]['iModifiedByID'] == $sess_id){
					$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
			 } else {
					$msg = $smarty->get_template_vars('MSG_VERIFY_DELETE');
			 }
		  break;
	  }
}
if($gdts[0]['eNeedToVerify'] == 'Yes') {
	 $msg = $smarty->get_template_vars('MSG_VERIFY_STATUS');
	 $msg .= "<br/>".$smarty->get_template_vars('LBL_NEW_STATUS_WILL_BE')." '".$gdts[0]['eStatus']."'.";
	 if($gdts[0]['eModifiedBy']=='SM' && $sess_usertype_short == 'SM' && $gdts[0]['iModifiedByID']!=$sess_id) {
			 $verify = 'yes';
	 } else if($gdts[0]['eModifiedBy']=='OA') {
	  if($sess_usertype_short == 'OA' && $gdts[0]['iModifiedByID']!=$sess_id){
			 $verify = 'yes';
	  } else if($sess_usertype_short == 'SM'){
			 $verify = 'yes';
	  }
	 }
}
$vgrpData = $grpData;
$OgrpData['eStatus'] = (isset($OgrpData['eStatus']))? $OgrpData['eStatus'] : '';
if($OgrpData['eStatus']=='Active' && $OgrpData['eNeedToVerify']!='Yes') {
	$chng = 'yes';
	$grpData = $OgrpData;
	$OuserStatus = $userStatus = @explode(";",$grpData[0]['tPermission']);
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
	if(strpos($grpData[0]['eVerify'],'pi:ia')!==false) {
		 $everify['po'] = 'Yes';
	}
	if(strpos($grpData[0]['eVerify'],'ii:pa')!==false) {
		 $everify['inv'] = 'Yes';
	}
}

if($orgdata[0]['eOrganizationType']=='Buyer2') {
   // echo $vgrpData[0]['vRFQ2AwardAcceptPermits']; exit;
   if(trim($vgrpData[0]['vRFQ2AwardAcceptPermits'])!='') {
      $rfq2awrdacpt = @explode(',',$vgrpData[0]['vRFQ2AwardAcceptPermits']);
   } else {
      $rfq2awrdacpt = array();
   }
   if(trim($vgrpData[0]['vRFQ2BidPermits'])!='') {
      $rfq2bid = @explode(',',$vgrpData[0]['vRFQ2BidPermits']);
   } else {
      $rfq2bid = array();
   }
   $rfq2awrdacptsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en NOT IN ('Create','Rejected') "); 	// 'Verify','Accepted',
   $crfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Create'");
   $vrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Verify'");
   $arfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Accepted'");
   $rrfq2awrdsts = $orgStaObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en='Rejected'");
   // pr($rfq2awrdacpt); exit;
   $smarty->assign('rfq2bid',$rfq2bid);
   $smarty->assign('rfq2awrdacpt',$rfq2awrdacpt);
   $smarty->assign('rfq2awrdacptsts',$rfq2awrdacptsts);
   $smarty->assign('crfq2awrdsts',$crfq2awrdsts);
   $smarty->assign('vrfq2awrdsts',$vrfq2awrdsts);
   $smarty->assign('arfq2awrdsts',$arfq2awrdsts);
   $smarty->assign('rrfq2awrdsts',$rrfq2awrdsts);
} else {
   if(trim($vgrpData[0]['vRFQ2AwardPermits'])!='') {
      $rfq2awrd = @explode(',',$vgrpData[0]['vRFQ2AwardPermits']);
   } else {
      $rfq2awrd = array();
   }
   if(trim($vgrpData[0]['vRFQ2Permits'])!='') {
      $rfq2s = @explode(',',$vgrpData[0]['vRFQ2Permits']);
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

$ores = $orgPrefObj->getDetails('*'," AND iOrganizationId=".$grpData[0]['iOrganizationID']);

// prints($grpData); exit;
$smarty->assign('iGroupID',$iGroupID);
$smarty->assign('grpData',$grpData);
$smarty->assign('orgdata',$orgdata);
$smarty->assign('OgrpData',$OgrpData);
$smarty->assign('Oorgdata',$Oorgdata);
$smarty->assign('vgrpData',$vgrpData);
$smarty->assign('ecreate',$ecreate);
$smarty->assign('eimport',$eimport);
$smarty->assign('everify',$everify);
$smarty->assign('view',$view);
$smarty->assign('userdata',$userdata);
$smarty->assign('status',$status);
$smarty->assign('Ouserdata',$Ouserdata);
$smarty->assign('Ostatus',$Ostatus);
$smarty->assign('poUserStatus',$poUserStatus);
$smarty->assign('invUserStatus',$invUserStatus);
$smarty->assign('poUserAcpt',$poUserAcpt);
$smarty->assign('invUserAcpt',$invUserAcpt);
$smarty->assign('msg',$msg);
$smarty->assign('verify',$verify);
$smarty->assign('ores',$ores);
?>