<?php
$iSMID = $sess_id;
//$msg = GetVar('msg');
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'])) {
	$msg = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
	unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
}
include(S_SECTIONS."/member/memberaccess.php");

if($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
}else $msg='';

if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '' ) {
   include(SITE_CLASS_GEN."class.validation.php");
   $validation=new Validation();
// prints( $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   $msg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
//prints($msg);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
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

$smdata = $secManObj->select($iSMID);
//prints($smdata);exit;
$vPassword = $generalobj->decrypt($smdata[0]['vPassword']);

//Get State Array
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
//$stateArr	=	array($stateArr);
//echo $stateArr[0][2]prints($stateArr);exit;

$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");
//prints($db_state);exit;

$sql="select vLanguage,vLanguageCode from ".PRJ_DB_PREFIX."_language";
$res=$dbobj->MySQLSelect($sql);
//prints($res);exit;


$smarty->assign('smdata',$smdata);
$smarty->assign('res',$res);
$smarty->assign('vPassword',$vPassword);
if(isset($statusdrp)) {
	$smarty->assign('statusdrp',$statusdrp);
}
$smarty->assign('stateArr',$stateArr);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('iSMID',$iSMID);
$smarty->assign('msg',$msg);
?>
