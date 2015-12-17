<?php

include(S_SECTIONS."/member/memberaccess.php");

$iUserID = $sess_id;
//$msg = GetVar('msg');
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'])) {
	$msg = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
	unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
}
//print $generalobj->encrypt('andrewdev123');

if($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
}else $msg='';

if(!isset($orgObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($orgUserObj)) {
     include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
     $orgUserObj =	new OrganizationUser();
}
//print_r($orgUserObj);
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

$userData = $orgUserObj->select($iUserID);

$userData=$userData[0];

if($userData['eStatus'] != 'Active' || $userData['eStatus'] == 'Inctive') {
          header('Location:'.SITE_URL_DUM.'oaview');
          exit;
     }
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];

$groupArr =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_organization_group"," AND eStatus='Active' ","iGroupID","vGroupName","iOrganizationID","iGroupID,vGroupName,iOrganizationID");
//prints($groupArr);
$groupArr=$groupArr[0];

$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");
//print_r($_SESSION);
$sql="select vLanguageCode,vLanguage from b2b_language";
$res=$dbobj->MySQLSelect($sql);
$phoneData=explode("-",$userData['vPhone']);
if(count($phoneData)==1){
     $userData['vPhone']=$phoneData[0];
}
else{
     $userData['vPhoneCode']=$phoneData[0];
     $userData['vPhone']=$phoneData[1];
}
$phoneData=explode("-",$userData['vMobile']);
if(count($phoneData)==1){
     $userData['vMobile']=$phoneData[0];
}
else{
     $userData['vMobileCode']=$phoneData[0];
     $userData['vMobile']=$phoneData[1];
}

$secQueArr1 = array(
        "ID"				=>	"iSecretQuestion1ID",
        "Name" 				=>	"Data[iSecretQuestion1ID]",
        "Type"				=>	"Query",
        "tableName" 		=>	PRJ_DB_PREFIX."_sec_question",
        "fieldId" 			=>	"iQuestionId",
        "fieldName"			=>	"vQuestion_".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'],
        "extVal"			=>	'',
        "selectedVal" 		=>	$userData['iSecretQuestion1ID'],
        "width"  			=>	'200px',
        "height"  			=>	'',
        "onchange" 			=>	'',
        "selectText" 		=>	"---Select Secret Question---",
        "where" 			=>	"eStatus ='Active' ",
        "multiple_select" 	=>	"",
        "orderby" 			=>	'',
        "extra"			=>	"",
        "validationmsg"		=>  ""
);
$secQueArr2 = array(
        "ID"				=>	"iSecretQuestion2ID",
        "Name" 				=>	"Data[iSecretQuestion2ID]",
        "Type"				=>	"Query",
        "tableName" 		=>	PRJ_DB_PREFIX."_sec_question",
        "fieldId" 			=>	"iQuestionId",
        "fieldName"			=>	"vQuestion_".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'],
        "extVal"			=>	'',
        "selectedVal" 		=>	$userData['iSecretQuestion2ID'],
        "width"  			=>	'200px',
        "height"  			=>	'',
        "onchange" 			=>	'',
        "selectText" 		=>	"---Select Secret Question---",
        "where" 			=>	"eStatus ='Active' ",
        "multiple_select" 	=>	"",
        "orderby" 			=>	'',
        "extra"			=>	"",
        "validationmsg"		=>  ""
);
$secQuestion1=$gdbobj->DynamicDropDown($secQueArr1);
$secQuestion1=str_replace("class=\"input1\"","class='required' title='Select Secret Question' tabindex='18'", $secQuestion1);
$secQuestion2=$gdbobj->DynamicDropDown($secQueArr2);
$secQuestion2=str_replace("class=\"input1\"","tabindex='20'", $secQuestion2);

if($userData['iOrganizationID'] != '') {
$orgdtls = $orgObj->select($userData['iOrganizationID']);
}
$salutation = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eSalutation","Data[eSalutation]", "eSalutation","", "".$userData['eSalutation'].""," tabIndex=4","","--- Select ---");
$smarty->assign('stateArr',$stateArr);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('secQuestion1',$secQuestion1);
$smarty->assign('secQuestion2',$secQuestion2);
$smarty->assign('iUserID',$iUserID);
$smarty->assign('userData',$userData);
$smarty->assign('orgdtls',$orgdtls);
$smarty->assign('groupArr',$groupArr);
$smarty->assign('sess_usertype',$sess_usertype);
$smarty->assign('res',$res);
$smarty->assign('generalobj',$generalobj);
$smarty->assign('salutation',$salutation);
//$smarty->assign('eStatus',$eStatus);
?>