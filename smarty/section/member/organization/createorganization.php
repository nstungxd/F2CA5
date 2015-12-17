<?php
include_once(S_SECTIONS."/member/memberaccess.php");

$iASMID = $sess_id;;
$iOrganizationID = GetVar('id');
//$msg = GetVar('msg');
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))
    $msg=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
if($sess_usertype =='orgadmin' && $orgid != $iOrganizationID) {
   header("Location: ".SITE_URL_DUM."oadashboard");
   exit;
}

if($msg == 'ras') {
   $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
   $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} elseif($msg == 'orgvrfy') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_SUCC');
} elseif($msg == 'orgvrfyer') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_ERR');
} else {
   $msg='';
}

### CREATE SERVER SIDE VALIDATION MESSAGE ###
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'])){
    if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '') {
       include(SITE_CLASS_GEN."class.validation.php");
       $validation=new Validation();
        $msg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
        unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
    }
}

#### ENDS HERE ###

if(!isset($orgObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj =	new Organization();
}

if(!isset($orgprefObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
   $orgprefObj =	new OrganizationPreference();
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

if(!isset($bnkObj)) {
   include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
   $bnkObj = new BankMaster();
}

//echo "sa";exit;

function phoneCode($field)
{
     global $arr;
     $phoneData=@explode("-",$arr[0][$field]);
     if(count($phoneData)==1)
     {
        $arr[0][$field]=$phoneData[0];
     }else{
        $arr[0][$field.'Code']=$phoneData[0];
        $arr[0][$field]=$phoneData[1];
     }
}
$arr = Array();
if($iOrganizationID != '') {
   $view = 'edit';
   $where = 'AND iOrganizationID = '.$iOrganizationID.'';
   $arr = $orgObj->getDetails('*',$where);
	if(($arr[0]['eStatus'] == 'Need to Verify' || $arr[0]['eStatus'] == 'Modified') && ($_SESSION['from'] != 'org'))
	{
		header("Location:".SITE_URL_DUM."organizationview/".$iOrganizationID);
		exit;
	}
   $prefarr = $orgprefObj->getDetails('iAdditionalInfoID',$where);
   $iAdditionalInfoID = (isset($prefarr[0]['iAdditionalInfoID']))? $prefarr[0]['iAdditionalInfoID'] : '';
   //prints($arr);//exit;
}  else {
    if(isset($_SESSION['Data'])){
        $arr[0]=$_SESSION['Data'];
        unset($_SESSION['Data']);
    }
}

//Get State Array
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
//prints($stateArr);exit;

$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode,iCountryISD,iCurrencyID","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");
//prints($db_state);exit;
$arrorgtype = (isset($arr[0]['eOrganizationType']))? $arr[0]['eOrganizationType'] : '';
$arrcrtmtd = (isset($arr[0]['eCreateMethodAllowed']))? $arr[0]['eCreateMethodAllowed'] : '';
$arrreqvrf = (isset($arr[0]['eReqVerification']))? $arr[0]['eReqVerification'] : '';
if(isset($ENABLE_AUCTION) && $ENABLE_AUCTION=='Yes') {
   $OrgType = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eOrganizationType","Data[eOrganizationType]", "eOrganizationType","", "".$arrorgtype."","class='required' tabIndex=14","Select Organization Type","---Select Organization Type----");
} else {
   $OrgType = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eOrganizationType","Data[eOrganizationType]", "eOrganizationType","", "".$arrorgtype."","class='required' tabIndex=14","Select Organization Type","---Select Organization Type----",'Buyer2');
}
$CrMethod = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eCreateMethodAllowed","Data[eCreateMethodAllowed]", "eCreateMethodAllowed","", "".$arrcrtmtd."","class='required' tabIndex='27' ","Select Method Allowed","---Select Method Allowed----");
$reqVerif = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eReqVerification","Data[eReqVerification]", "eReqVerification","", "".$arrreqvrf."","class='required' tabIndex='28' ","","");

    $view = (isset($view))? $view : '';
if($view == 'edit') {
	$serarr = serialize($arr);
	//prints($serarr); exit;
}

$currency = $generalobj->getCurrency();

phoneCode('vPhone');
phoneCode('vPrimaryContactNo');
phoneCode('vPrimaryContactTelephone');
phoneCode('vPrimaryContactMobile');

$iAdditionalInfoID = (isset($iAdditionalInfoID))? $iAdditionalInfoID : '';
$bnk_dtls = $bnkObj->getDetails('*', " AND eStatus='Active'");
// $eary = multi21Array($arr,'iOrganizationID');
// pr($eary); exit;
$smarty->assign('stateArr',$stateArr);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('msg',$msg);
$smarty->assign('iASMID',$iASMID);
$smarty->assign('OrgType',$OrgType);
$smarty->assign('CrMethod',$CrMethod);
$smarty->assign('reqVerif',$reqVerif);
$smarty->assign('arr',$arr);
$smarty->assign('bnk_dtls',$bnk_dtls);
$smarty->assign('iOrganizationID',$iOrganizationID);
$smarty->assign('iAdditionalInfoID',$iAdditionalInfoID);
$smarty->assign('view',$view);
$smarty->assign('currency',$currency);
?>