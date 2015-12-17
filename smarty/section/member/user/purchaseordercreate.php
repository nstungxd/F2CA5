<?php
include(S_SECTIONS."/member/memberaccess.php");

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
if(!isset($orgObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($pohObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
	$pohObj = new PurchaseOrderHeading();
}
if(!isset($asocObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
	$asocObj = new OrganizationAssociation();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj =	new StatusMaster();
}
if(!isset($orgUserPermObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	$orgUserPermObj =	new OrganizationUserPermission();
}
if(!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
    $orgprefObj =	new OrganizationPreference();
}
if(!isset($poAttachmentObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderAttachment.php");
	$poAttachmentObj = new PurchaseOrderAttachment();
}
if(!isset($invOrdObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invOrdObj =	new InvoiceOrderHeading();
}
$mmsg = "";
$msg = $_GET['msg'];
/*if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} else*/if($msg == 'tmm') {
     $mmsg = $smarty->get_template_vars('LBL_PO_TOTAL_MISMATCH');
     $msg = '';
}/* else{ $msg=''; }*/

$UserName=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];
//$msg=$_REQUEST['msg'];
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']!='') {
$msg=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
}
$iPurchaseOrderID = $_GET['id'];

$orgdtls = $orgObj->select($curORGID);
if($orgdtls[0]['eCreateMethodAllowed'] == 'File Import' || $sess_usertype_short != 'OU') {
   if($sess_usertype_short == 'SM') {
      header("Location: ".SITE_URL_DUM."smdashboard/all");
	} else {
	  if(trim($iPurchaseOrderID) != '' && is_numeric($iPurchaseOrderID)) {
			  header("Location: ".SITE_URL_DUM."purchaseorderview/$iPurchaseOrderID");
	  } else {
			 header("Location: ".SITE_URL_DUM."polist/all");
	  }
	}
   exit;
}
if($sess_usertype_short=='OU' && $poCreate!='Yes'){
   header("Location: ".SITE_URL_DUM."polist/all");
	exit;
}
if(trim($iPurchaseOrderID) != '' && is_numeric($iPurchaseOrderID)) {
	$view = 'edit';
}
$view = (isset($view))? $view : '';
### CREATE SERVER SIDE VALIDATION MESSAGE ###
$vldmsg = "";
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '') {
   include(SITE_CLASS_GEN."class.validation.php");
   $validation=new Validation();
   $vldmsg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
}

#### ENDS HERE ###
// prints($vldmsg); exit;
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];

$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode,iCountryISD,iCurrencyID","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");

//$sql="select vOrganizationCode, vCompanyName from b2b_organization_master org,b2b_organization_user user where org.iOrganizationId=user.iOrganizationId and user.vUserName='user'";
//$sql="select vOrganizationCode, vCompanyName from b2b_organization_master org where org.iOrganizationId=$curORGID";
//$res=$dbobj->MySqlSelect($sql); //$curORGID

$orgdtls = $orgObj->select($curORGID);
$orgname = $orgdtls[0]['vCompanyName'];
$OrgCode = $orgdtls[0]['vOrganizationCode'];
// prints($orgname);exit;
$poad = (isset($_SESSION['poadd']))? $_SESSION['poadd'] : '';
$podtls = array();
$asocdtls = array();
$sorgdtls = array();
$invdl = array();
$poAttachments = array();
if($view == 'edit') {
	$podtls = $pohObj->select($iPurchaseOrderID);
	$isdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
	$isdtls = $isdtls[0]['iStatusID'];
	if($podtls[0]['iBuyerOrganizationID']!=$curORGID && $podtls[0]['iSupplierOrganizationID']!=$curORGID) {
		header("Location: ".SITE_URL_DUM."polist/all");
		exit;
	} else if($podtls[0]['iSupplierOrganizationID']==$curORGID && $podtls[0]['iStatusID']<$isdtls) {
		header("Location: ".SITE_URL_DUM."polist/all");
		exit;
	}
	$sorgdtls = $orgObj->select($podtls[0]['iSupplierOrganizationID']);
	if($podtls[0]['iInvoiceID']>0) {
	  $invdl = $invOrdObj->select($podtls[0]['iInvoiceID']);
	}
	$asocdtls = $asocObj->getDetails('*'," AND iBuyerOrganizationID=$curORGID AND iSupplierAssocationID=".$podtls[0]['iSupplierOrganizationID']);
	$poAttachments = $poAttachmentObj->getDetails('*',' AND iPurchaseOrderID="'.$iPurchaseOrderID.'"');

	  $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Rejected' ");
	  $rjtsts = $stsdtls[0]['iStatusID'];
	if($podtls[0]['iStatusID'] == $rjtsts ) {
		if($podtls[0]['iSupplierOrganizationID']==$curORGID) {
			header("Location: ".SITE_URL_DUM."purchaseorderview/$iPurchaseOrderID");
			exit;
		}
		$lang = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'];
		$msg = $stsdtls[0]['vStatusMsg_'.$lang];
	} else if($podtls[0]['eSaved'] == 'Yes') {
      $msg = $smarty->get_template_vars('LBL_SAVED');
   } else if($poad!='yes') {
		header("Location: ".SITE_URL_DUM."purchaseorderview/$iPurchaseOrderID");
		exit;
	}
	if($curORGID == $podtls[0]['iSupplierOrganizationID']) {
		header("Location: ".SITE_URL_DUM."polist/all");
		exit;
	}
}
if($iPurchaseOrderID=='' && isset($_SESSION['Data'])) {
	$podtls[0] = $_SESSION['Data'];
   unset($_SESSION['Data']);
}

if($view != 'edit') {
	$upermits = $orgUserPermObj->getUserPermits($sess_id);
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Create' ");
	$sts = $stsdtls[0]['iStatusID'];
	if(! in_array($sts, $upermits['po'])) {
	  header("Location: ".SITE_URL_DUM."polist/all");
	}
}

$currency = $orgprefObj->getDetails('vCurrency'," AND iOrganizationID=$curORGID");
if(trim($currency[0]['vCurrency'])!='') {
	$currency = @explode(',',$currency[0]['vCurrency']);
     $currency=@implode("','",$currency);
     //$csql = "Select iCurrencyID,vCode from ".PRJ_DB_PREFIX."_currency_master  where vCode in('".$currency."')";
     $currency = $generalobj->getCurrency("vCode in('".$currency."')");


}
//prints($currency);
$elitx = (isset($podtls[0]['eLineItemTax']))? $podtls[0]['eLineItemTax'] : '';
$lineItemTax = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_purchase_order_heading", "eLineItemTax","Data[eLineItemTax]", "eLineItemTax","setT()", $elitx, " class='' ");
// prints($msg); exit;

function phoneCode($field)
{
     global $podtls;
     $phoneData=@explode("-",$podtls[0][$field]);
     if(count($phoneData)==1)
     {
        $podtls[0][$field]=$phoneData[0];
     }else{
        $podtls[0][$field.'Code']=$phoneData[0];
        $podtls[0][$field]=$phoneData[1];
     }
}

phoneCode('vBillToContactTelephone');
phoneCode('vShipToContactTelephone');



# Invoice Code DropDownBox Data [START]
$stsdtls = $statusmasterObj->getDetails('*'," AND vStatus_en='Accepted' AND eFor='Invoice' ");
$sid = $sts = $stsdtls[0]['iStatusID'];

$where = " AND iStatusID=$sts ";
$where .= " AND iBuyerOrganizationID=$curORGID ";

$invoiceCodeData = $invOrdObj->getDetails("vInvoiceCode as vTitle,iInvoiceID as Id",$where);
# Invoice Code DropDownBox Data [END]


# PO Code DropDownBox Data [START]
//$stsdtls = $statusmasterObj->getDetails('*'," AND vStatus_en='Accepted' AND eFor='PO' ");
//$sts = $stsdtls[0]['iStatusID'];
//$where = " AND iStatusID=$sts ";
$where = " AND iBuyerOrganizationID=$curORGID ";
$POCodeData = $pohObj->getDetails("vPOCode as vTitle,iPurchaseOrderID as Id",$where);
# PO Code DropDownBox Data [END]

// prints($podtls);exit;
$smarty->assign('poad',$poad);
$smarty->assign('podtls',$podtls);
$smarty->assign('asocdtls',$asocdtls);
$smarty->assign('lineItemTax',$lineItemTax);
$smarty->assign('stateArr',$stateArr);
$smarty->assign('OrgCode',$OrgCode);
$smarty->assign('orgname',$orgname);
$smarty->assign('orgdtls',$orgdtls);
$smarty->assign('sorgdtls',$sorgdtls);
$smarty->assign('invdl',$invdl);
if(isset($var_msg)) {
	$smarty->assign('var_msg',$var_msg);
}
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('view',$view);
$smarty->assign('msg',$msg);
$smarty->assign('mmsg',$mmsg);
$smarty->assign('currency',$currency);
$smarty->assign('iPurchaseOrderID',$iPurchaseOrderID);
$smarty->assign('invoiceCodeData',$invoiceCodeData);
$smarty->assign('POCodeData',$POCodeData);
$smarty->assign('sid',$sid);
$smarty->assign('vldmsg',$vldmsg);
$smarty->assign('poAttachments',$poAttachments);
//prints($podtls[0]);
?>