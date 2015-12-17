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
if(!isset($orgprefObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
   $orgprefObj =	new OrganizationPreference();
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
if(!isset($invprefObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOtherInformation.php");
	$invprefObj = new InvoiceOtherInformation();
}
$mmsg = '';
$msg = $_GET['msg'];
/*if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'tmm') {
     $mmsg = $smarty->get_template_vars('LBL_PO_TOTAL_MISMATCH');
} else{ $msg=''; }*/

$UserName=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];
//$msg=$_REQUEST['msg'];
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']!='') {
	$msg=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
	unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
}
$invad = (isset($_SESSION['invadd']))? $_SESSION['invadd'] : '';
$iInvoiceID = $_GET['id'];
$msg = '';
$orgdtls = $orgObj->select($curORGID);
if($orgdtls[0]['eCreateMethodAllowed'] == 'File Import' || $sess_usertype_short != 'OU') {
   if($sess_usertype_short == 'SM') {
      header("Location: ".SITE_URL_DUM."smdashboard/all");
	} else {
	  if(trim($iInvoiceID) != '' && is_numeric($iInvoiceID)) {
			  header("Location: ".SITE_URL_DUM."invoiceview/$iInvoiceID");
	  } else {
			 header("Location: ".SITE_URL_DUM."polist/all");
	  }
	}
   exit;
}
$binvp = '';
if($uorg_type=='Buyer') {
	// echo $uorg_type; exit;
	if(!isset($orgUserObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
		$orgUserObj =	new OrganizationUser();
	}
	$binvp = $invCreate = $orgUserObj->hasBuyerInvPermit($sess_id);
	$smarty->assign('invCreate',$invCreate);
}
if($sess_usertype_short=='OU' && $invCreate!='Yes') {
   header("Location: ".SITE_URL_DUM."invoicelist/all");
	exit;
}
if(trim($iInvoiceID) != '' && is_numeric($iInvoiceID)) {
	$view = 'edit';
}
$vldmsg = "";
/*
### CREATE SERVER SIDE VALIDATION MESSAGE ###
if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '') {
   include(SITE_CLASS_GEN."class.validation.php");
   $validation=new Validation();
   $vldmsg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
}
#### ENDS HERE ###
// prints($vldmsg); exit;
*/
//$sql="select vOrganizationCode, vCompanyName from b2b_organization_master org,b2b_organization_user user where org.iOrganizationId=user.iOrganizationId and user.vUserName='user'";
//$sql="select vOrganizationCode, vCompanyName from b2b_organization_master org where org.iOrganizationId=$curORGID";
//$res=$dbobj->MySqlSelect($sql); //$curORGID

$orgdtls = $orgObj->select($curORGID);
$orgname = $orgdtls[0]['vCompanyName'];
$OrgCode = $orgdtls[0]['vOrganizationCode'];
// prints($orgname);exit;

$invdtls = array();
if($view == 'edit') {
	// $invdtls = $invOrdObj->select($iInvoiceID);
	$fields = " ioh.*, poh.vPOCode ";
	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_heading poh on ioh.iPurchaseOrderID=poh.iPurchaseOrderID ";
	$invdtls = $invOrdObj->getJoinTableInfo($jtbl,$fields," AND ioh.iInvoiceID=$iInvoiceID ");
	$isdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
	$isdtls = $isdtls[0]['iStatusID'];
	if($invdtls[0]['iBuyerOrganizationID']!=$curORGID && $invdtls[0]['iSupplierOrganizationID']!=$curORGID) {
		header("Location: ".SITE_URL_DUM."invoicelist/all");
		exit;
	} else if($invdtls[0]['iBuyerOrganizationID']==$curORGID && $invdtls[0]['iStatusID']<$isdtls && $invdtls[0]['eCreateByBuyer']!='Yes') { 	// && ! ($invdtls[0]['eCreateByBuyer']=='Yes' && ($invdtls[0]['iaStatusID']==0 || $invdtls[0]['iStatusID']==$rjtsts) )
		header("Location: ".SITE_URL_DUM."invoicelist/all");
		exit;
	}
	$borgdtls = $orgObj->select($invdtls[0]['iBuyerOrganizationID']);
	if($invdtls[0]['iPurchaseOrderID']>0) {
	  $podl = $pohObj->select($invdtls[0]['iPurchaseOrderID']);
	}
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
	$rjtsts = $stsdtls[0]['iStatusID'];
	if($invdtls[0]['iStatusID'] == $rjtsts) {
		$lang = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'];
		$msg = $stsdtls[0]['vStatusMsg_'.$lang];
	} else if($invdtls[0]['eSaved'] == 'Yes') {
      $msg = $smarty->get_template_vars('LBL_SAVED');
   } else if($invad!='yes') {
		header("Location: ".SITE_URL_DUM."invoiceview/$iInvoiceID");
		exit;
	}

	$ioprefdt = $invprefObj->getDetails('*'," AND iInvoiceID=$iInvoiceID ");
	// prints($ioprefdt); exit;
	if(is_array($ioprefdt) && count($ioprefdt)>0) {
	  //
	} else {
	  $ioprefdt = $orgprefObj->getDetails('*'," AND iOrganizationID=".$invdtls[0]['iSupplierOrganizationID']." ");
	}
	// printS($ioprefdt); exit;
}

if($view != 'edit') {
	$upermits = $orgUserPermObj->getUserPermits($sess_id);
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Create' ");
	$sts = $stsdtls[0]['iStatusID'];
	//prints($upermits['inv']); exit;
	if(! in_array($sts, $upermits['inv']) && $binvp!='Yes') {
		header("Location: ".SITE_URL_DUM."invoicelist/all");
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
// $lineItemTax = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_invoice_order_heading", "eLineItemTax","Data[eLineItemTax]", "eLineItemTax","setT()", "".$iodtls[0]['eLineItemTax'].""," class='' tabindex='11'");
// prints($msg); exit;

/*function phoneCode($field)
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
}*/
//phoneCode('vBillToContactTelephone');
//phoneCode('vShipToContactTelephone');

/*
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
*/

// prints($podtls);exit;
$smarty->assign('ioprefdt',$ioprefdt);
$smarty->assign('invdtls',$invdtls);
if(isset($iodtls)) {
	$smarty->assign('iodtls',$iodtls);
}
// $smarty->assign('asocdtls',$asocdtls);
// $smarty->assign('lineItemTax',$lineItemTax);
// $smarty->assign('stateArr',$stateArr);
$smarty->assign('OrgCode',$OrgCode);
$smarty->assign('orgname',$orgname);
$smarty->assign('orgdtls',$orgdtls);
if(isset($sorgdtls)) {
	$smarty->assign('sorgdtls',$sorgdtls);
}
//$smarty->assign('invdl',$invdl);
if(isset($var_msg)) {
	$smarty->assign('var_msg',$var_msg);
}
//$smarty->assign('db_country',$db_country);
//$smarty->assign('db_state',$db_state);
$smarty->assign('view',$view);
$smarty->assign('msg',$msg);
$smarty->assign('mmsg',$mmsg);
$smarty->assign('currency',$currency);
$smarty->assign('iInvoiceID',$iInvoiceID);
//$smarty->assign('invoiceCodeData',$invoiceCodeData);
//$smarty->assign('POCodeData',$POCodeData);
if(isset($sid)) {
	$smarty->assign('sid',$sid);
}
$smarty->assign('vldmsg',$vldmsg);
//$smarty->assign('poAttachments',$poAttachments);
//prints($podtls[0]);
?>