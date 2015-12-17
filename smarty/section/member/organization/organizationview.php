<?php
include(S_SECTIONS."/member/memberaccess.php");
$iASMID = $sess_id;
$iOrganizationID = GetVar('id');
$pg = GetVar('pg');

if($sess_usertype =='orgadmin' && $orgid != $iOrganizationID)
{
     header("Location: ".SITE_URL_DUM."oadashboard");
     exit;
}
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

$msg = (isset($msg))? $msg : '';
if($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
}else{
          $msg='';
     }
//echo $iOrganizationID;exit;
if($iOrganizationID != '') {
   $view = 'edit';
   // $msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
   if($pg == 'verify') {
        $where = 'AND iOrganizationID = '.$iOrganizationID.'';
        $Oarr = $arr = $orgvrfObj->getDetails('*',$where);
        $where = 'AND iOrganizationID = '.$arr[0]['iOrganizationID'].'';
        $Oprefarr = $prefarr = $orgprefObj->getDetails('iAdditionalInfoID',$where);
        $OiAdditionalInfoID = $iAdditionalInfoID = $prefarr[0]['iAdditionalInfoID'];
   } else {
        $where = 'AND iOrganizationID = '.$iOrganizationID.'';
        $Oarr = $arr = $orgObj->getDetails('*',$where);
        $Oprefarr = $prefarr = $orgprefObj->getDetails('iAdditionalInfoID',$where);
        $OiAdditionalInfoID = $iAdditionalInfoID = (isset($prefarr[0]['iAdditionalInfoID']))? $prefarr[0]['iAdditionalInfoID'] : ''; 
   }
//   prints($arr);exit;
}
//prints($arr);exit;
//Get State Array
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
//prints($stateArr);exit;

$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active' AND vCountryCode = '".$arr[0]['vCountry']."'","vState");
//prints($db_state);exit;

if($arr[0]['eStatus'] == 'Modified' || $arr[0]['eStatus'] == 'Active' || $arr[0]['eStatus'] == 'Inactive') {
	 $where = 'AND iOrganizationID = '.$iOrganizationID.'';
	 $orderby = 'iVerifiedID Desc';
	 $limit = 'LIMIT 0,1';
	 $arr = $orgvrfObj->getDetails('*',$where,$orderby,'',$limit);
	 $prefarr = $orgprefObj->getDetails('iAdditionalInfoID',$where);
	 $iAdditionalInfoID = (isset($prefarr[0]['iAdditionalInfoID']))? $prefarr[0]['iAdditionalInfoID'] : '';
}
if(($arr[0]['eStatus'] == 'Need to Verify')) {
	if($arr[0]['eStatus'] == 'Need to Verify' && $arr[0]['iASMID']!=$sess_id) {
		$verify = 'yes';
		$msg = $smarty->get_template_vars('MSG_VERIFY_NEED_TO_VERIFY');
	} else {
	   $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
	}
}
else if($arr[0]['eStatus'] == 'Modified' || $arr[0]['eStatus'] == 'Delete' || ($arr[0]['eStatus'] == 'Inactive' && $arr[0]['eNeedToVerify'] == 'Yes') || ($arr[0]['eStatus'] == 'Active' && $arr[0]['eNeedToVerify'] == 'Yes')) {
	switch($sess_usertype){
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
// prints($arr); exit;
// $msg = $orgvrfObj->getVerificationMessage($iOrganizationID,$arr);
// echo $msg; exit;

if($arr[0]['eStatus'] == 'Need to Verify') {
	 if($arr[0]['iASMID'] == $sess_id) {
		$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
	}
} else {
	 switch($arr[0]['eStatus']) {
		 case "Modified":
				if($arr[0]['iModifiedByID'] == $sess_id) {
					 $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
				} else {
					 $msg = $smarty->get_template_vars('MSG_VERIFY_MODIFICATION');
				}
		 break;
		 case "Delete":
				if($arr[0]['iModifiedByID'] == $sess_id) {
					 $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
				} else {
					 $msg = $smarty->get_template_vars('MSG_VERIFY_DELETE');
				}
		 break;
/*			  case "Inactive":
			 $msg = $smarty->get_template_vars('MSG_VERIFY_INACTIVE');
		 break;*/
	 }
}
if($arr[0]['eNeedToVerify'] == 'Yes') {
	$msg = $smarty->get_template_vars('MSG_VERIFY_STATUS');
	$msg .= "<br/>".$smarty->get_template_vars('LBL_NEW_STATUS_WILL_BE')." '".$arr[0]['eStatus']."'.";
}
$varr = $arr;
// prints($arr); exit;
$chng = '';
if((($Oarr[0]['eStatus']=='Active' || $Oarr[0]['eStatus']=='Inactive') && $Oarr[0]['eNeedToVerify']!='Yes')) {
	$chng = 'yes';
	$arr = $Oarr;
}

$verify = (isset($verify))? $verify : '';
// echo $msg; exit;
$smarty->assign('stateArr',$stateArr);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('iASMID',$iASMID);
$smarty->assign('arr',$arr);
$smarty->assign('Oarr',$Oarr);
$smarty->assign('varr',$varr);
$smarty->assign('iOrganizationID',$iOrganizationID);
$smarty->assign('iAdditionalInfoID',$iAdditionalInfoID);
$smarty->assign('OiAdditionalInfoID',$OiAdditionalInfoID);
$smarty->assign('view',$view);
$smarty->assign('pg',$pg);
$smarty->assign('msg',$msg);
$smarty->assign('chng',$chng);
$smarty->assign('verify',$verify);

?>