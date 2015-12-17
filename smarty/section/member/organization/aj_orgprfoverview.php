<?php

include(S_SECTIONS."/member/memberaccess.php");

$iASMID = $sess_id;
$iAdditionalInfoID = GetVar('id');
$iOrganizationID = GetVar('orgid');
$pg = GetVar('pg');

if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj =	new Organization();
}
if(!isset($orgvrfObj)) {
     include_once(SITE_CLASS_APPLICATION."organization/class.Organization_Toverify.php");
     $orgvrfObj = new Organization_Toverify();
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

if(!isset($countryObj)) {
    include_once(SITE_CLASS_APPLICATION."class.Country.php");
    $countryObj =	new Country();
}
if(!isset($stateObj)) {
    include_once(SITE_CLASS_APPLICATION."class.State.php");
    $stateObj =	new State();
}
if(!isset($cntstObj)) {
    include_once(SITE_CLASS_GEN."class.countrystate.php");
    $cntstObj =	new CountryState();
}

if($iOrganizationID != ''){
   $view = 'edit';
	$orgObj->setiOrganizationID($iOrganizationID);
     $orgdtls = $orgObj->select('');
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
}

//Get State Array
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
//prints($stateArr);exit;

$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;
$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active' AND vCountryCode = '".(isset($arr[0]['vCountry'])? $arr[0]['vCountry'] : '')."'","vState");
//prints($db_state);exit;

$where = " AND eFor='Invoice' AND eStatus='Active' AND vStatus_en NOT IN ('Accepted','Issue','Verified') ";
$invarr = $stMstrObj->getDetails('*',$where);
$selinvarr = @explode(',',$arr[0]['vInvoiceStatusLevel']);
$where = " AND eFor='PO' AND eStatus='Active' AND vStatus_en NOT IN ('Accepted','Issue','Verified') ";
$POarr = $stMstrObj->getDetails('*',$where);
$selPOarr = @explode(',',$arr[0]['vOrderStatusLevel']);
$acptInvArr = @explode(',',$arr[0]['vInvoiceAcceptanceLevel']);
$acptOrdArr = @explode(',',$arr[0]['vOrderAcceptanceLevel']);

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

$rfq2awrdacptsts = '';
if($orgdtls[0]['eOrganizationType']=='Buyer2') {
   $rfq2awardacptsts = $stMstrObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND iStatusID IN (".$arr[0]['vRFQ2AwardAcceptLevel'].") AND vStatus_en NOT IN ('Create','Verify','Accepted','Rejected') ");
   if(is_array($rfq2awardacptsts) && count($rfq2awardacptsts)>0) {
      for($l=0;$l<count($rfq2awardacptsts);$l++) {
         $rfq2awrdacptsts .= ($rfq2awrdacptsts == '')? $rfq2awardacptsts[$l]['vStatus'] : ','.$rfq2awardacptsts[$l]['vStatus'];
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
// pr($arr); exit;
// prints($selPOarr); exit;
$smarty->assign('stateArr',$stateArr);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('iASMID',$iASMID);
$smarty->assign('arr',$arr);
$smarty->assign('Oarr',$Oarr);
$smarty->assign('orgdtls',$orgdtls);
$smarty->assign('iOrganizationID',$iOrganizationID);
$smarty->assign('iAdditionalInfoID',$iAdditionalInfoID);
$smarty->assign('OiAdditionalInfoID',$OiAdditionalInfoID);
$smarty->assign('view',$view);
$smarty->assign('invarr',$invarr);
$smarty->assign('POarr',$POarr);
$smarty->assign('selinvarr',$selinvarr);
$smarty->assign('selPOarr',$selPOarr);
$smarty->assign('acptInvArr',$acptInvArr);
$smarty->assign('acptOrdArr',$acptOrdArr);
$smarty->assign('pg',$pg);
$smarty->assign('msg',(isset($msg) ? $msg : ''));
$smarty->assign('verify',(isset($verify) ? $verified : ''));
$smarty->assign('bylvl',$bylvl);
$smarty->assign('suplvl',$suplvl);
$smarty->assign('rfq2awrdacptsts',$rfq2awrdacptsts);
$smarty->assign('rfq2awrdsts',$rfq2awrdsts);
?>