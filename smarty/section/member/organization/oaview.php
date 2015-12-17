<?php

include(S_SECTIONS."/member/memberaccess.php");

if($sess_usertype == 'orgadmin')
{
     $iUserID=$sess_id;
//print $iUserID;

}
else
{
     exit;
}
$msg = GetVar('msg');
if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raerr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
}else $msg='';

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
     $OuserData = $userData = $orgUserObj->select($iUserID);
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
     $secQuestion2=$secQuestion2[0];
     $secQuestion2=$secQuestion2['vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']];

}
$defaltLan=$gdbobj->getreqtableinfo(PRJ_DB_PREFIX."_language","vLanguageCode='".$userData['vDefaltLan']."'",'vLanguage');
$defaltLan=$defaltLan[0];
$defaltLan=$defaltLan['vLanguage'];

//print_r ($userData);
if($userData['eUserType']!='')
     $userTypeVal=$userData['eUserType'];
else
     $userTypeVal='User';
$userTypes = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eUserType","Data[eUserType]", "eUserType","",$userTypeVal,"style='width:200px;' class='drop-down' ","Select User Type");
//$eStatus = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eStatus","Data[eStatus]", "eStatus","",$statusVal,"style='width:200px;' class='drop-down' ","Select Status");

if($userData['eStatus']=='Modified' || $userData['eStatus']=='Need to Verify' || $userData['eNeedToVerify']=='Yes') {
     $where = 'AND iUserID = '.$iUserID.'';
     $userData = $userToVerifyObj->getDetails('*',$where,' iVerifiedID DESC','',' LIMIT 0,1 ');
     $userData=$userData[0];

     $db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active' AND vCountryCode = '".$userData['vCountry']."'","vState");
     $where = "AND iOrganizationID = ".$userData['iOrganizationID']."";
     $organization = $orgObj->getDetails('*',$where);
}

if(($OuserData['eStatus'] == 'Need to Verify'))
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($OuserData['eCreatedBy']=='SM') {
						if($OuserData['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						}
					}
					else {
						$verify = 'no';
					}
					break;
		case 'orgadmin':
					if($OuserData['eCreatedBy']=='OA') {
						if($OuserData['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						}
					}
					else {
						$verify = 'no';
					}
					break;
	}
}
else if($OuserData['eStatus'] == 'Modified' || $OuserData['eStatus'] == 'Delete' || ($userData['eStatus'] == 'Inactive' && $userData['eNeedToVerify'] == 'Yes') || ($userData['eStatus'] == 'Active' && $userData['eNeedToVerify'] == 'Yes'))
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($OuserData['eModifiedBy']=='SM') {
						if($OuserData['iModifiedByID']!=$sess_id) {
							$verify = 'yes';
						}
					}
					else {
						$verify = 'no';
					}
					break;
		case 'orgadmin':
					if($OuserData['eModifiedBy']=='OA') {
						if($OuserData['iModifiedByID']!=$sess_id) {
							$verify = 'yes';
						}
					}
					else {
						$verify = 'no';
					}
					break;
	}
}
//Prints($OuserData);exit;
switch($OuserData[0]['eStatus']){
   case "Modified":
      $msg = $smarty->get_template_vars('MSG_VERIFY_MODIFICATION');
   break;
   case "Delete":
      $msg = $smarty->get_template_vars('MSG_VERIFY_DELETE');
   break;
   case "Inactive":
      $msg = $smarty->get_template_vars('MSG_VERIFY_INACTIVE');
   break;
}
if((($OuserData['eStatus']=='Active' || $OuserData['eStatus']=='Inactive') && $OuserData['eNeedToVerify']!='Yes')) {
//	$chng = 'yes';
	$userData = $OuserData;
}
// prints($userData); exit;
//echo $verify; exit;
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
$smarty->assign('verify',$verify);
$smarty->assign('generalobj',$generalobj);
$smarty->assign('defaltLan',$defaltLan);
?>