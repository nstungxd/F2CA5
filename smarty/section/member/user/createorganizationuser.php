<?php
include(S_SECTIONS."/member/memberaccess.php");

$iUserID = GetVar('id');

$msg = GetVar('msg');
/*if($msg=='dup'){
$msg = $smarty->get_template_vars('LBL_EMAIL_TAKEN');
}*/
$msg =(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
//print $generalobj->decrypt('XOHf3r2jow==');
if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
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
if(!isset($orgGroupObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
   $orgGroupObj =	new OrganizationGroup();
}

### CREATE SERVER SIDE VALIDATION MESSAGE ###

//prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);

if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '' ) {
   include(SITE_CLASS_GEN."class.validation.php");
   $validation=new Validation();
   $msg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
}
#### ENDS HERE ###

if($iUserID != '') {
     $view = 'edit';
     $userData = $orgUserObj->select($iUserID);
     if($sess_usertype_short == 'OA' && $userData[0]['iOrganizationID']!=$curORGID) {
     	  header("Location: ".SITE_URL_DUM."organizationuserlist");
     	  exit;
     }
     $userData=$userData[0];
	  // prints($_SESSION); exit;
     if($userData['eStatus'] != 'Active' && $userData['eStatus'] != 'Inactive' && $_SESSION['from']!='usr') {
          header('Location:'.SITE_URL_DUM.'organizationuserview/'.$iUserID);
          exit;
     }
} else {
    $_SESSION['Data'] =(isset($_SESSION['Data']))? $_SESSION['Data'] : '';
	$userData=$_SESSION['Data'];
   unset ($_SESSION['Data']);
}
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
//$stateArr	=	array($stateArr);
//echo $stateArr[0][2];
//prints($stateArr);exit;
$groupArr =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_organization_group"," AND eStatus='Active' ","iGroupID","vGroupName","iOrganizationID","iGroupID,vGroupName,iOrganizationID");
$groupArr = $groupArr[0];
// prints($groupArr); exit;
$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode,iCountryISD","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");

$sql="select vLanguage,vLanguageCode from ".PRJ_DB_PREFIX."_language Order By vLanguage";
$res=$dbobj->MySQLSelect($sql);

$orgArr = array(
        "ID"				=>	"iOrganizationID",
        "Name" 				=>	"Data[iOrganizationID]",
        "Type"				=>	"Query",
        "tableName" 		=>	PRJ_DB_PREFIX."_organization_master",
        "fieldId" 			=>	"iOrganizationID",
        "fieldName"			=>	"vCompanyName",
        "extVal"			=>	'',
        "selectedVal" 		=>	isset($userData['iOrganizationID']) ? $userData['iOrganizationID']: '',
        "width"  			=>	'200px',
        "height"  			=>	'',
        "onchange" 			=>	"getRelativeCombo(this.value,\"\",\"iGroupID\",\"-- Select Group --\",groupArr);",
        "selectText" 		=>	"---Select Organization---",
        "where" 			=>	"iASMID =".$sess_id,
        "multiple_select" 	=>	"",
        "orderby" 			=>	'',
        "extra"			=>	"",
        "validationmsg"		=>  ""
);
//,'','iGroupID','-- Select State --',stateArr
$organization=$gdbobj->DynamicDropDown($orgArr);
//print_r($organization);
$organization = str_replace("class=\"input1\"","class='required' title='Select Organization'", $organization);

$secQueArr1 = array(
        "ID"				=>	"iSecretQuestion1ID",
        "Name" 				=>	"Data[iSecretQuestion1ID]",
        "Type"				=>	"Query",
        "tableName" 		=>	PRJ_DB_PREFIX."_sec_question",
        "fieldId" 			=>	"iQuestionId",
        "fieldName"			=>	"vQuestion_".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'],
        "extVal"			=>	'',
        "selectedVal" 		=>	isset($userData['iSecretQuestion1ID']) ? $userData['iSecretQuestion1ID']  : '',
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
        "selectedVal" 		=>	isset($userData['iSecretQuestion2ID']) ? $userData['iSecretQuestion2ID']: '',
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
$secQuestion1=str_replace("class=\"input1 \"","class='required' title='Select Secret Question' ", $secQuestion1);
$secQuestion2=$gdbobj->DynamicDropDown($secQueArr2);
$secQuestion2=str_replace("class=\"input1 \"","class='' title='Select Secret Question' ", $secQuestion2);

/*if($userData['eStatus']!='')
     $statusVal=$userData['eStatus'];
else
     $statusVal='Need to Verify';
*/
$userData['eUserType'] = isset($userData['eUserType']) ? $userData['eUserType'] : '';
if($userData['eUserType'] == '')
     $userData['eUserType']='User';
$userTypes = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eUserType","Data[eUserType]", "eUserType","",$userData['eUserType'],"class='drop-down' onchange='showHidePermission(this.value)' ","Select User Type");
//$eStatus = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eStatus","Data[eStatus]", "eStatus","",$statusVal,"style='width:200px;' class='drop-down' ","Select Status");
$view = isset($view) ? $view : '';
if($view != 'edit') {
	if($sess_usertype != 'SM') {
		// prints($udts); exit;
		$orgdetails = $orgObj->select($curORGID);
  		//prints($orgdetails);exit;
	}
}
$userData['iOrganizationID'] = isset($userData['iOrganizationID']) ? $userData['iOrganizationID'] : '';
if($userData['iOrganizationID'] != '') {
// $orgdtls = $orgObj->select($userData[iOrganizationID]);
$orgdetails = $orgObj->select($userData['iOrganizationID']);
}
// prints($orgdetails); exit;
$userData['vPhone'] = isset($userData['vPhone']) ? $userData['vPhone'] : '';
$phoneData=explode("-",$userData['vPhone']);
if(count($phoneData)==1){
     $userData['vPhone']=$phoneData[0];
}
else{
     $userData['vPhoneCode']=$phoneData[0];
     $userData['vPhone']=$phoneData[1];
}
$userData['vMobile'] = isset($userData['vMobile']) ? $userData['vMobile'] : '';
$phoneData=explode("-",$userData['vMobile']);
if(count($phoneData)==1){
     $userData['vMobile']=$phoneData[0];
}
else{
     $userData['vMobileCode']=$phoneData[0];
     $userData['vMobile']=$phoneData[1];
}
//prints($userData);exit;
//print"<hr>";prints($_SESSION);
$userData['eSalutation'] = isset($userData['eSalutation']) ? $userData['eSalutation'] : '';
$salutation = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eSalutation","Data[eSalutation]", "eSalutation","", "".$userData['eSalutation'].""," ","","--- Select ---");
 //prints($_SESSION); exit;
$usertype=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'];
// prints($orgdetails); exit;
$smarty->assign('msg',$msg);
$smarty->assign('stateArr',$stateArr);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('secQuestion1',$secQuestion1);
$smarty->assign('secQuestion2',$secQuestion2);
$smarty->assign('iUserID',$iUserID);
$smarty->assign('userData',$userData);
$smarty->assign('orgdetails',$orgdetails);
$smarty->assign('orgdtls',isset($orgdtls) ? $orgdtls : '');
$smarty->assign('organization',$organization);
$smarty->assign('groupArr',$groupArr);
$smarty->assign('view',$view);
$smarty->assign('sess_usertype',$sess_usertype);
$smarty->assign('userTypes',$userTypes);
$smarty->assign('res',$res);
$smarty->assign('generalobj',$generalobj);
$smarty->assign('salutation',$salutation);
$smarty->assign('usertype',$usertype);
?>