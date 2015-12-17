<?php

include(S_SECTIONS."/member/memberaccess.php");

$iASMID = $sess_id;
$iAdditionalInfoID = GetVar('id');
$iOrganizationID = GetVar('orgid');
//$msg = GetVar('msg');
$msg = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
if($sess_usertype == 'orgadmin' && $orgid != $iOrganizationID){
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
}else{
   $msg='';
}

if(isset($_SESSION['from']) && $_SESSION['from'] == 'org') {
	$msg = '';
}

if(!isset($orgObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
    $orgprefObj =	new OrganizationPreference();
}
if(!isset($stMstrObj)) {
    include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
    $stMstrObj =	new StatusMaster();
}

if($iOrganizationID != '') {
$orgdtls = $orgObj->select($iOrganizationID);
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
$arr = $orgprefObj->getDetails('*'," AND iOrganizationID=$iOrganizationID");

/*if($arr[0]['eStatus'] != 'Active' && $arr[0]['iAdditionalInfoID'] > 0)
{
	header("Location:".SITE_URL_DUM."organizationprefview/".$iOrganizationID);
	exit;
}
 */
// prints($arr); exit;
### CREATE SERVER SIDE VALIDATION MESSAGE ###
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '') {
   include(SITE_CLASS_GEN."class.validation.php");
   $validation=new Validation();
   $msg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
}
#### ENDS HERE ###
//
if(isset($arr[0]['eStatus']) && ($arr[0]['eStatus'] == 'Need to Verify' || $arr[0]['eStatus'] == 'Modified') && ($_SESSION['from'] != 'org'))
{
	header("Location:".SITE_URL_DUM."organizationprefview/".$iOrganizationID);
	exit;
}

$iAdditionalInfoID = (isset($arr[0]['iAdditionalInfoID']))? $arr[0]['iAdditionalInfoID'] : '';
if($iAdditionalInfoID != '') {
	$view = 'edit';
//   $where = 'AND iAdditionalInfoID = "'.$iAdditionalInfoID.'"';
//   $arr = $orgprefObj->getDetails('*',$where);
	//prints($arr);exit;
} else {
	$view = 'add';
   if(isset($_SESSION['Data'])) {
	  $arr[0]=$_SESSION['Data'];
	  unset ($_SESSION['Data']);
   }
 }
}

$arr[0]['eCreateMethodAllowedPO'] = (isset($arr[0]['eCreateMethodAllowedPO']))? $arr[0]['eCreateMethodAllowedPO'] : '';
$arr[0]['eReqVerification'] = (isset($arr[0]['eReqVerification']))? $arr[0]['eReqVerification'] : '';
$arr[0]['eCreateMethodAllowedInv'] = (isset($arr[0]['eCreateMethodAllowedInv']))? $arr[0]['eCreateMethodAllowedInv'] : '';
$crMethodPO = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_default_settings", "eCreateMethodAllowedPO","Data[eCreateMethodAllowedPO]", "eCreateMethodAllowedPO","", "".$arr[0]['eCreateMethodAllowedPO']."","class='required' style='width:170px;' title='Select Method Allowed'","Select Method Allowed","---Select PO Create Method----");
$crMethodINV = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_default_settings", "eCreateMethodAllowedInv","Data[eCreateMethodAllowedInv]", "eCreateMethodAllowedInv","", "".$arr[0]['eCreateMethodAllowedInv']."","class='required' style='width:170px;' title='Select Method Allowed'","Select Method Allowed","---Select Invoice Create Method----");
$reqVerif = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eReqVerification","Data[eReqVerification]", "eReqVerification","", "".$arr[0]['eReqVerification']."","class='required' tabIndex='28' ","","");

$where = "AND eFor='Invoice' AND eType='Optional' AND eStatus='Active'";
$invarr = $stMstrObj->getDetails(' *, vStatus_en as status ',$where);
$selinvarr = @explode(',',$arr[0]['vInvoiceStatusLevel']);
$where = "AND eFor='PO' AND eType='Optional' AND eStatus='Active'";
$POarr = $stMstrObj->getDetails(' *, vStatus_en as status ',$where);
$selPOarr = @explode(',',$arr[0]['vOrderStatusLevel']);
$acptInvArr = @explode(',',$arr[0]['vInvoiceAcceptanceLevel']);
$acptOrdArr = @explode(',',$arr[0]['vOrderAcceptanceLevel']);
$lvls = Array('Auth1','Auth2','Auth3');
// currency combo box
$csql = "Select DISTINCT vCode as vCurrency from ".PRJ_DB_PREFIX."_currency_master where eStatus='Active' ";
$currency = $dbobj->MySqlSelect($csql);
//prints($currency); exit;
if(isset($arr[0]['vCurrency']) && trim($arr[0]['vCurrency'])!='') {
	$arr[0]['vCurrency'] = @explode(',',$arr[0]['vCurrency']);
} else if(!isset($arr[0]['vCurrency']) || trim($arr[0]['vCurrency'])=='') {
	$arr[0]['vCurrency'] = array();
}
$arr[0]['eCryptAlgo'] = (isset($arr[0]['eCryptAlgo'])) ? $arr[0]['eCryptAlgo'] : '';
$cryptAlgo = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_default_settings", "eCryptAlgo","Data[eCryptAlgo]", "eCryptAlgo","", "".$arr[0]['eCryptAlgo'].""," class='' title='".$smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_ENCRYPTION_METHOD')."' ","","Select Encryption Method");
//------------------  TO CONVERT CKEDITOR FROM TEXTAREA   --------------------------------------//
 include_once (CK_EDITOR_PATH.'ckeditor.php');
 include_once (CK_EDITOR_PATH.'ckfinder/ckfinder.php');

 $ckeditor = new CKEditor();
 $ckeditor->basePath = CK_EDITOR_URL;
 $ckfinder = new CKFinder();
 $ckfinder->BasePath = SITE_FOLDER.'components/ckeditor/ckfinder/'; // Note: BasePath property in CKFinder class starts with capital letter
 $ckfinderpath = SITE_FOLDER.'components/ckeditor/ckfinder/';
 $ckfinder->SetupCKEditorObject($ckeditor);

if(isset($ENABLE_AUCTION) && $ENABLE_AUCTION=='Yes') {
   $awardStatus = $stMstrObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en LIKE 'Auth%' ", " iDisplayOrder ASC ");
   $awardAcceptStatus = $stMstrObj->getDetails('*, vStatus_'.LANG.' as vStatus'," AND vForAuction LIKE '%RFQ2 Award Acceptance%' AND vStatus_en LIKE 'Auth%' ", " iDisplayOrder ASC ");
   // pr($awardAcceptStatus); exit;
   $smarty->assign('awardStatus',$awardStatus);
   $smarty->assign('awardAcceptStatus',$awardAcceptStatus);
}
$rfq2awrdacptsel = array();
$rfq2awrdstssel = array();
if($orgdtls[0]['eOrganizationType']=='Buyer2') {
   if(trim($arr[0]['vRFQ2AwardAcceptLevel'])!='') {
      $rfq2awrdacptsel = @explode(',',$arr[0]['vRFQ2AwardAcceptLevel']);
   }
} else {
   if(trim($arr[0]['vRFQ2AwardStatusLevel'])!='') {
      $rfq2awrdstssel = @explode(',',$arr[0]['vRFQ2AwardStatusLevel']);
   }
}

$OrgType = (isset($OrgType))? $OrgType : '';
$bylvl = (isset($bylvl))? $bylvl : '';
$suplvl = (isset($suplvl))? $suplvl : '';
 $smarty->assign('ckeditor',$ckeditor);
 $smarty->assign('ckeditor->basePath',$ckeditor->basePath);
 $smarty->assign('ckfinder',$ckfinder);
 $smarty->assign('ckfinder->BasePath',$ckfinder->BasePath);
 $smarty->assign('ckfinderpath',$ckfinderpath);
 $smarty->assign('ckeditor',$ckeditor);
//------------------ END TO CONVERT CKEDITOR FROM TEXTAREA   --------------------------------------//

$smarty->assign('msg',$msg);
$smarty->assign('iASMID',$iASMID);
$smarty->assign('OrgType',$OrgType);
$smarty->assign('orgdtls',$orgdtls);
$smarty->assign('iOrganizationID',$iOrganizationID);
$smarty->assign('arr',$arr);
$smarty->assign('iAdditionalInfoID',$iAdditionalInfoID);
$smarty->assign('view',$view);
$smarty->assign('invarr',$invarr);
$smarty->assign('POarr',$POarr);
$smarty->assign('selinvarr',$selinvarr);
$smarty->assign('selPOarr',$selPOarr);
$smarty->assign('acptInvArr',$acptInvArr);
$smarty->assign('acptOrdArr',$acptOrdArr);
$smarty->assign('currency',$currency);
$smarty->assign('bylvl',$bylvl);
$smarty->assign('suplvl',$suplvl);
$smarty->assign('lvls',$lvls);
$smarty->assign('cryptAlgo',$cryptAlgo);
$smarty->assign('crMethodPO',$crMethodPO);
$smarty->assign('crMethodINV',$crMethodINV);
$smarty->assign('reqVerif',$reqVerif);
$smarty->assign('rfq2awrdacptsel',$rfq2awrdacptsel);
$smarty->assign('rfq2awrdstssel',$rfq2awrdstssel);
?>