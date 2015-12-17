<?php

include(S_SECTIONS."/member/memberaccess.php");

$iUserID = GetVar('id');

$msg = GetVar('msg');
if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raerr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
}

if(!isset($orgUserObj)) {
     include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
     $orgUserObj =	new OrganizationUser();
}
//print_r($orgUserObj);
if(!isset($userToVerifyObj)) {
     include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
     $userToVerifyObj = new OrganizationUserToverify();
}
if(!isset($orgObj))
{
     include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
     $orgObj = new Organization();
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
if($iUserID != '') {
     $view = 'verify';
     $userData = $orgUserObj->select($iUserID);
     $OuserData = $userData=$userData[0];
}
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
//$stateArr	=	array($stateArr);
//echo $stateArr[0][2];
//prints($stateArr);exit;
$groupArr =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_organization_group"," AND eStatus='Active' ","iGroupID","vGroupName","iOrganizationID","iGroupID,vGroupName,iOrganizationID");
$groupArr=$groupArr[0];
$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active' AND vCountryCode = '".$userData['vCountry']."'","vState");

$where = "AND iOrganizationID = ".$userData['iOrganizationID']."";
$organization = $orgObj->getDetails('*',$where);
$msg = $smarty->get_template_vars('MSG_NEED_VERIFY');


$secQuestion1=$gdbobj->getreqtableinfo(PRJ_DB_PREFIX."_sec_question","iQuestionID='".$userData['iSecretQuestion1ID']."'",'vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']);
$secQuestion1=$secQuestion1[0];
$secQuestion1=$secQuestion1['vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']];
if($userData['iSecretQuestion2ID'] != '')
{
     $secQuestion2=$gdbobj->getreqtableinfo(PRJ_DB_PREFIX."_sec_question","iQuestionID='".$userData['iSecretQuestion2ID']."'",'vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']);
     $secQuestion2 = (isset($secQuestion2[0]))? $secQuestion2[0] : '';
     $secQuestion2 = (isset($secQuestion2['vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']]))? $secQuestion2['vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']] : '';
     //$secQuestion2=$secQuestion2[0];
     //$secQuestion2=$secQuestion2['vQuestion_'.$_SESSION['SESS_B2B_LANG']];

}
$defaltLan=$gdbobj->getreqtableinfo(PRJ_DB_PREFIX."_language","vLanguageCode='".$userData['vDefaltLan']."'",'vLanguage');
$defaltLan=$defaltLan[0];
$defaltLan=$defaltLan['vLanguage'];

if($userData['eUserType']!='')
     $userTypeVal=$userData['eUserType'];
else
     $userTypeVal='User';
$userTypes = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eUserType","Data[eUserType]", "eUserType","",$userTypeVal,"style='width:200px;' class='drop-down' ","Select User Type");
//$eStatus = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eStatus","Data[eStatus]", "eStatus","",$statusVal,"style='width:200px;' class='drop-down' ","Select Status");

if((($OuserData['eStatus']=='Active' || $OuserData['eStatus']=='Inactive') && $OuserData['eNeedToVerify']!='Yes')) {
//	$chng = 'yes';
	$userData = $OuserData;
}

$smarty->assign('stateArr',$stateArr);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('secQuestion1',$secQuestion1);
$smarty->assign('secQuestion2',$secQuestion2);
$smarty->assign('iUserID',$iUserID);
$smarty->assign('userData',$userData);
$smarty->assign('OuserData',$OuserData);
$smarty->assign('organization',$organization);
$smarty->assign('groupArr',$groupArr);
$smarty->assign('view',$view);
$smarty->assign('sess_usertype',$sess_usertype);
$smarty->assign('userTypes',$userTypes);
$smarty->assign('msg',$msg);
$smarty->assign('defaltLan',$defaltLan);
$smarty->assign('generalobj',$generalobj);
//print_r($userData);

?>