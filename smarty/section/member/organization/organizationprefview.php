<?php

include(S_SECTIONS."/member/memberaccess.php");

$iASMID = $sess_id;
$iAdditionalInfoID = GetVar('id');
$iOrganizationID = GetVar('orgid');
$pg = GetVar('pg');

if($sess_usertype =='orgadmin' && $orgid != $iOrganizationID)
{
     header("Location: ".SITE_URL_DUM."oadashboard");
     exit;
}
if(!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
    $orgprefObj =	new OrganizationPreference();
}
if(!isset($orgPrefVrfObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreferenceToverify.php");
    $orgPrefVrfObj =	new OrganizationPreferenceToverify();
}
if(!isset($stMstrObj)) {
    include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
    $stMstrObj =	new StatusMaster();
}
if(!isset($orgObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($orgvrfObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization_Toverify.php");
   $orgvrfObj = new Organization_Toverify();
}
if($iOrganizationID != ''){
   $view = 'edit';
	// $orgObj->setiOrganizationID($iOrganizationID);
   $orgdtls = $orgObj->select($iOrganizationID);
	$orgvf = $orgvrfObj->getDetails('*'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
	// prints($orgdtls); exit;
	 if($orgdtls[0]['eOrganizationType'] == 'Supplier') {
		 $suplvl = 'Yes';
	 } else if($orgdtls[0]['eOrganizationType'] == 'Buyer') {
		 $bylvl = 'Yes';
	 } else if($orgdtls[0]['eOrganizationType'] == 'Both') {
		 $bylvl = 'Yes';
		 $suplvl = 'Yes';
	 } else {
       $bylvl = 'No';
		 $suplvl = 'No';
	 }

     // $msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
     if($pg == 'verify') {
			$Oarr = $arr = $orgPrefVrfObj->getDetails('*'," AND iOrganizationID=$iOrganizationID");
			$OiAdditionalInfoID = $iAdditionalInfoID = $arr[0]['iAdditionalInfoID'];
//          $where = 'AND iVerifiedID = "'.$iAdditionalInfoID.'"';
//          $arr = $orgPrefVrfObj->getDetails('*',$where);
     } else {
			$Oarr = $arr = $orgprefObj->getDetails('*'," AND iOrganizationID=$iOrganizationID");
			$OiAdditionalInfoID = $iAdditionalInfoID = $arr[0]['iAdditionalInfoID'];
//          $where = 'AND iAdditionalInfoID = "'.$iAdditionalInfoID.'"';
          //$arr = $orgprefObj->getDetails('*',$where);
     }

     //prints($arr);exit;
	 if($orgdtls[0]['eStatus'] == 'Need to Verify' || $orgdtls[0]['eStatus'] == 'Modified' || $orgdtls[0]['eStatus'] == 'Delete' || $orgdtls[0]['eNeedToVerify'] == 'Yes' || $orgvf[0]['eStatus'] == 'Need to Verify' || $orgvf[0]['eStatus'] == 'Modified' || $orgvf[0]['eStatus'] == 'Delete' || $orgvf[0]['eNeedToVerify'] == 'Yes')
	 {
		  $msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
		  if(($orgdtls[0]['eStatus'] == 'Need to Verify')) {
				if($orgdtls[0]['eStatus'] == 'Need to Verify' && $orgdtls[0]['iASMID']!=$sess_id) {
					$verify = 'yes';
					$msg = $smarty->get_template_vars('MSG_VERIFY_NEED_TO_VERIFY');
				} else {
					$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
				}
		  }
		  else // if($orgdtls[0]['eStatus'] == 'Modified' || $arr[0]['eStatus'] == 'Delete' || ($arr[0]['eStatus'] == 'Inactive' && $arr[0]['eNeedToVerify'] == 'Yes') || ($arr[0]['eStatus'] == 'Active' && $arr[0]['eNeedToVerify'] == 'Yes'))
		  {
				switch($sess_usertype){
					case 'securitymanager':
						  if($orgvf[0]['eModifiedBy']=='SM') {
							  if($orgvf[0]['iModifiedByID']!=$sess_id) {
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
						  if($orgvf[0]['eModifiedBy']=='OA') {
							  if($orgvf[0]['iModifiedByID']!=$sess_id) {
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

		  if($orgdtls[0]['eStatus'] == 'Need to Verify'){
					 if($orgdtls[0]['iASMID'] == $sess_id){
						  $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
					}
		  } else {
				switch($orgvf[0]['eStatus']){
					  case "Modified":
						  if($orgvf[0]['iModifiedByID'] == $sess_id){
								$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
						  } else {
								$msg = $smarty->get_template_vars('MSG_VERIFY_MODIFICATION');
						  }
					  break;
					  case "Delete":
						  if($orgvf[0]['iModifiedByID'] == $sess_id){
								$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
						  } else {
								$msg = $smarty->get_template_vars('MSG_VERIFY_DELETE');
						  }
					  break;
				}
		  }
		  if($orgvf[0]['eNeedToVerify'] == 'Yes') {
				$msg = $smarty->get_template_vars('MSG_VERIFY_STATUS');
		  }
	 }
}

if($arr[0]['eStatus'] == 'Modified' || $arr[0]['eStatus'] == 'Active' || $arr[0]['eStatus'] == 'Inactive') {
     $where = 'AND iOrganizationID = '.$iOrganizationID.'';
     $orderby = 'iVerifiedID Desc';
     $limit = 'LIMIT 0,1';
     $arr = $orgPrefVrfObj->getDetails('*',$where,$orderby,'',$limit);
     //prints($arr);exit;
     $iAdditionalInfoID = $arr[0]['iAdditionalInfoID'];
}
$verify = (isset($verify))? $verify : '';
if($verify != 'yes')
{
if(($arr[0]['eStatus'] == 'Need to Verify'))
{
	$msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
	if($arr[0]['eStatus'] == 'Need to Verify' && $orgdtls[0]['iASMID']!=$sess_id && $orgdtls[0]['eSelfReg']!='Yes') {
		$verify = 'yes';
	}
}
else if($arr[0]['eStatus'] == 'Modified' || $arr[0]['eStatus'] == 'Delete' || ($arr[0]['eStatus'] == 'Inactive' && $arr[0]['eNeedToVerify'] == 'Yes') || ($arr[0]['eStatus'] == 'Active' && $arr[0]['eNeedToVerify'] == 'Yes'))
{
	 $msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($arr[0]['eModifiedBy']=='SM') {
						if($arr[0]['iModifiedByID']!=$sess_id) {
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
					if($arr[0]['eModifiedBy']=='OA') {
						if($arr[0]['iModifiedByID']!=$sess_id) {
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
}

$where = " AND eFor='Invoice' AND eStatus='Active' AND vStatus_en NOT IN ('Accepted','Issue','Verify') ";
$invarr = $stMstrObj->getDetails('*',$where);
$selinvarr = @explode(',',$arr[0]['vInvoiceStatusLevel']);
$where = " AND eFor='PO' AND eStatus='Active' AND vStatus_en NOT IN ('Accepted','Issue','Verify') ";
$POarr = $stMstrObj->getDetails('*',$where);
$selPOarr = @explode(',',$arr[0]['vOrderStatusLevel']);
$acptInvArr = @explode(',',$arr[0]['vInvoiceAcceptanceLevel']);
$acptOrdArr = @explode(',',$arr[0]['vOrderAcceptanceLevel']);

if($arr[0]['eStatus'] == 'Need to Verify') {
    if($arr[0]['iCreatedBy'] == $sess_id) {
        $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
    }
} else {
	 switch($arr[0]['eStatus']) {
		 case "Modified":
				if($arr[0]['iModifiedByID'] == $sess_id){
					 $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
				} else {
					 $msg = $smarty->get_template_vars('MSG_VERIFY_MODIFICATION');
				}
		 break;
		 case "Delete":
				if($arr[0]['iModifiedByID'] == $sess_id){
					 $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
				 } else {
					 $msg = $smarty->get_template_vars('MSG_VERIFY_DELETE');
				 }
		 break;
	 }
}
if($arr[0]['eNeedToVerify'] == 'Yes') {
	 $msg = $smarty->get_template_vars('MSG_VERIFY_STATUS');
	 $msg .= "<br/>".$smarty->get_template_vars('LBL_NEW_STATUS_WILL_BE')." '".$arr[0]['eStatus']."'.";
}
$varr = $arr;
if($Oarr[0]['eStatus']=='Active' && $Oarr[0]['eNeedToVerify']!='Yes') {
	$chng = 'yes';
	$arr = $Oarr;
	$selPOarr = @explode(',',$arr[0]['vOrderStatusLevel']);
	$acptInvArr = @explode(',',$arr[0]['vInvoiceAcceptanceLevel']);
	$acptOrdArr = @explode(',',$arr[0]['vOrderAcceptanceLevel']);

}
if($orgdtls[0]['eStatus']=='Active' && $orgdtls[0]['eNeedToVerify']!='Yes') {
	$act = 'yes';
}

$OrgType = (isset($OrgType))? $OrgType : '';
$msg = (isset($msg))? $msg : '';
//
$rfq2awrdacptsts = '';
$rfq2awrdsts = '';
if($orgvf[0]['eOrganizationType']=='Buyer2') {
   $rfq2awardacptsts = $stMstrObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND iStatusID IN (".$arr[0]['vRFQ2AwardAcceptLevel'].") AND vStatus_en NOT IN ('Create','Verify','Accepted','Rejected') ");
   if(is_array($rfq2awardacptsts) && count($rfq2awardacptsts)>0) {
      for($l=0;$l<count($rfq2awardacptsts);$l++) {
         $rfq2awrdacptsts .= ($rfq2awrdacptsts == '')? $rfq2awardacptsts[$l]['vStatus'] : ', '.$rfq2awardacptsts[$l]['vStatus'];
      }
   }
} else {
   $rfq2awardsts = $stMstrObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND iStatusID IN (".$arr[0]['vRFQ2AwardStatusLevel'].") AND vStatus_en NOT IN ('Create','Verify','Accepted','Rejected') ");
   if(is_array($rfq2awardsts) && count($rfq2awardsts)>0) {
      for($l=0;$l<count($rfq2awardsts);$l++) {
         $rfq2awrdsts .= ($rfq2awrdsts == '')? $rfq2awardsts[$l]['vStatus'] : ', '.$rfq2awardsts[$l]['vStatus'];
      }
   }
}
if(trim($rfq2awrdacptsts)=='') {
   $rfq2awrdacptsts = '---';
}
if(trim($rfq2awrdsts)=='') {
   $rfq2awrdsts = '---';
}
// pr($rfq2awrdacptsts); exit;
// prints($rfq2awardsts); exit;
$smarty->assign('pg',$pg);
$smarty->assign('iASMID',$iASMID);
$smarty->assign('OrgType',$OrgType);
$smarty->assign('iOrganizationID',$iOrganizationID);
$smarty->assign('arr',$arr);
$smarty->assign('Oarr',$Oarr);
$smarty->assign('varr',$varr);
$smarty->assign('orgdtls',$orgdtls);
$smarty->assign('orgvf',$orgvf);
$smarty->assign('iAdditionalInfoID',$iAdditionalInfoID);
$smarty->assign('OiAdditionalInfoID',$OiAdditionalInfoID);
$smarty->assign('view',$view);
$smarty->assign('invarr',$invarr);
$smarty->assign('POarr',$POarr);
$smarty->assign('selinvarr',$selinvarr);
$smarty->assign('selPOarr',$selPOarr);
$smarty->assign('acptInvArr',$acptInvArr);
$smarty->assign('acptOrdArr',$acptOrdArr);
$smarty->assign('msg',(isset($msg) ? $msg : ''));
$smarty->assign('act',(isset($act) ? $act : ''));
$smarty->assign('verify',(isset($verify) ? $verify : ''));
$smarty->assign('bylvl',$bylvl);
$smarty->assign('suplvl',$suplvl);
$smarty->assign('rfq2awardsts',$rfq2awardsts);
$smarty->assign('rfq2awrdsts', $rfq2awrdsts);
$smarty->assign('rfq2awrdacptsts', $rfq2awrdacptsts);
//$smarty->assign('orgprefhistory',$orgprefhistory);
?>