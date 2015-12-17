<?php
include(S_SECTIONS."/member/memberaccess.php");
$msg = '';
$iASMID = $sess_id;
$iOrganizationID = GetVar('id');
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

if($iOrganizationID != '') {
   $view = 'edit';
    $where = 'AND iOrganizationID = '.$iOrganizationID.'';
    $Oarr = $arr = $orgObj->getDetails('*',$where);
    $Oprefarr = $prefarr = $orgprefObj->getDetails('iAdditionalInfoID',$where);
    $OiAdditionalInfoID = $iAdditionalInfoID = $prefarr[0]['iAdditionalInfoID'];
//   prints($arr);exit;
}

//Get State Array
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
//prints($stateArr);exit;

$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active' AND vCountryCode = '".$arr[0]['vCountry']."'","vState");
//prints($db_state);exit;
// pr($arr); exit;
$verify = '';
$smarty->assign('stateArr',$stateArr);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('iASMID',$iASMID);
$smarty->assign('arr',$arr);
$smarty->assign('Oarr',$Oarr);
$smarty->assign('iOrganizationID',$iOrganizationID);
$smarty->assign('iAdditionalInfoID',$iAdditionalInfoID);
$smarty->assign('OiAdditionalInfoID',$OiAdditionalInfoID);
$smarty->assign('view',$view);
$smarty->assign('pg',$pg);
$smarty->assign('msg',$msg);
$smarty->assign('verify',$verify);
?>

