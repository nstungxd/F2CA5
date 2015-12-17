<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include(S_SECTIONS."/member/memberaccess.php");

 //print_r($_SESSION);exit;
$UserName=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];
//echo $UserName;exit;
//$msg=$_REQUEST['msg'];
$mmsg = '';
$msg = $_GET['msg'];
$iInvoiceID = $_GET['id'];
//
$frmbuyer = 'n';
if($uorg_type=='Buyer' || ($uorg_type!='Supplier' && $iInvoiceID==0 && $msg=='b')) {
   $msg = ($msg=='b')? '' : $msg;
	$frmbuyer = 'y';
	// $smarty->assign('frmbuyer',$frmbuyer);
}

//
/*if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} else*/if($msg == 'tmm') {
     $mmsg = $smarty->get_template_vars('LBL_INV_TOTAL_MISMATCH');
     $msg = '';
}/* else{ $msg=''; }*/
if((isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'])) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']!='') {
	$msg = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
	unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
}
if(!isset($countryObj)) {
     include_once(SITE_CLASS_APPLICATION."class.Country.php");
     $countryObj =	new Country();
}

if(!isset($stateObj)) {
     include_once(SITE_CLASS_APPLICATION."class.State.php");
     $stateObj =	new State();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj =	new StatusMaster();
}

if(!isset($cntstObj)) {
     include_once(SITE_CLASS_GEN."class.countrystate.php");
     $cntstObj =	new CountryState();
}
if(!isset($orgObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($invOrdObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invOrdObj =	new InvoiceOrderHeading();
}
if(!isset($orgUserPermObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	$orgUserPermObj =	new OrganizationUserPermission();
}

if(!isset($invAttachmentObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderAttachment.php");
	$invAttachmentObj =	new InvoiceOrderAttachment();
}
if(!isset($pohObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
	$pohObj =	new PurchaseOrderHeading();
}
if(!isset($bnkObj)) {
   include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
   $bnkObj = new BankMaster();
}

// prints($invUserStatusIds); exit;
if(trim($invUserStatusIds) != '') {
   $uinvprmt_ary = @explode(',',$invUserStatusIds);
}

$orgdtls = $orgObj->select($curORGID);
if($orgdtls[0]['eCreateMethodAllowed'] == 'File Import' || $sess_usertype_short != 'OU') {
   if($sess_usertype_short == 'SM') {
      header("Location: ".SITE_URL_DUM."smdashboard/all");
	} else {
		if(trim($iInvoiceID) != '' && is_numeric($iInvoiceID)) {
			header("Location: ".SITE_URL_DUM."invoiceview/$iInvoiceID");
	  } else {
	  		header("Location: ".SITE_URL_DUM."invoicelist/all");
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

$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode,iCountryISD,iCurrencyID","AND eStatus = 'Active'");
//prints($db_country);exit;
$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");

//$sql="select vOrganizationCode, vCompanyName from b2b_organization_master org,b2b_organization_user user where org.iOrganizationId=user.iOrganizationId and user.vUserName='user'";
//$sql="select vOrganizationCode, vCompanyName from b2b_organization_master org where org.iOrganizationId=$curORGID";
//$res=$dbobj->MySqlSelect($sql); //$curORGID
//$orgdtls = $orgObj->select($curORGID);
$sporgid = $curORGID;
$orgname = $orgdtls[0]['vCompanyName'];
$OrgCode = $orgdtls[0]['vOrganizationCode'];
// prints($orgname);exit;

if(trim($iInvoiceID) != '' && is_numeric($iInvoiceID) && $iInvoiceID>0) {
	$view = 'edit';
}

### CREATE SERVER SIDE VALIDATION MESSAGE ###
$vldmsg = '';
if((isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'])) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '') {
   include(SITE_CLASS_GEN."class.validation.php");
   $validation=new Validation();
   $vldmsg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
}
#### ENDS HERE ###
if(trim($iInvoiceID) == '')
{
  $invdtls[0]=$_SESSION['Data'];
  unset ($_SESSION['Data']);
}

$invad = (isset($_SESSION['invadd']))? $_SESSION['invadd'] : '';
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
	} else if($invdtls[0]['iBuyerOrganizationID']==$curORGID && $invdtls[0]['iStatusID']<$isdtls && $invdtls[0]['eCreateByBuyer']!='Yes') { 	//
		header("Location: ".SITE_URL_DUM."invoicelist/all");
		exit;
	}
	$borgdtls = $orgObj->select($invdtls[0]['iBuyerOrganizationID']);
	if($invdtls[0]['iPurchaseOrderID']>0) {
	  $podl = $pohObj->select($invdtls[0]['iPurchaseOrderID']);
	}
// $asocdtls = $asocObj->getDetails('*'," AND iBuyerOrganizationID=$curORGID AND iSupplierAssocationID=".$invdtls[0]['iSupplierOrganizationID']);

   $invAttachments = $invAttachmentObj->getDetails('*'," AND iInvoiceID='".$iInvoiceID."'");
   //prints($invAttachments);
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
	$rjtsts = $stsdtls[0]['iStatusID'];
	if($invdtls[0]['iStatusID'] == $rjtsts) {
		if($invdtls[0]['iBuyerOrganizationID']==$curORGID && $invdtls[0]['eSaved']!='Yes' && $invdtls[0]['eCreateByBuyer']!='Yes') { 	// && ! ($invdtls[0]['eCreateByBuyer']=='Yes' && ($invdtls[0]['iaStatusID']==0 || $invdtls[0]['iStatusID']==$rjtsts) )
			header("Location: ".SITE_URL_DUM."invoiceview/$iInvoiceID");
			exit;
		}
		$lang = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'];
		$msg = $stsdtls[0]['vStatusMsg_'.$lang];
	} else if($invdtls[0]['eSaved'] == 'Yes') {
      $msg = $smarty->get_template_vars('LBL_SAVED');
   } else if($invad!='yes') {
		header("Location: ".SITE_URL_DUM."invoiceview/$iInvoiceID");
		exit;
	}
	/*if($curORGID==$invdtls[0]['iBuyerOrganizationID'] && $invdtls[0]['eCreateByBuyer']!='Yes') { 	// && ! ($invdtls[0]['eCreateByBuyer']=='Yes' && ($invdtls[0]['iaStatusID']==0 || $invdtls[0]['iStatusID']==$rjtsts) )
		header("Location: ".SITE_URL_DUM."invoicelist/all");
		exit;
	}*/
	if($invdtls[0]['iBuyerOrganizationID']==$curORGID && $invdtls[0]['eCreateByBuyer']=='Yes') {
		$sporgid = $invdtls[0]['iSupplierOrganizationID'];
		$spldtls = $orgObj->select($sporgid);
		$orgname = $spldtls[0]['vCompanyName'];
		$OrgCode = $spldtls[0]['vOrganizationCode'];
		//
		$bpldtls = $orgObj->select($invdtls[0]['iBuyerOrganizationID']);
		$borgname = $bpldtls[0]['vCompanyName'];
		$bOrgCode = $bpldtls[0]['vOrganizationCode'];
   } /*else {
      $sporgid = $curORGID;
		$spldtls = $orgObj->select($sporgid);
		$orgname = $spldtls[0]['vCompanyName'];
		$OrgCode = $spldtls[0]['vOrganizationCode'];
	}*/
}
if($view != 'edit') {
	$upermits = $orgUserPermObj->getUserPermits($sess_id);
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Create' ");
	$sts = $stsdtls[0]['iStatusID'];
	// prints($upermits['inv']); exit;
	if(! in_array($sts, $upermits['inv']) && $binvp!='Yes') {
		header("Location: ".SITE_URL_DUM."invoicelist/all");
	}
	//
	$bpldtls = $orgObj->select($curORGID);
   $borgname = $bpldtls[0]['vCompanyName'];
   $bOrgCode = $bpldtls[0]['vOrganizationCode'];
} else if(($frmbuyer == 'y' || (isset($invdtls[0]['eCreateByBuyer']) && $invdtls[0]['eCreateByBuyer']=='Yes')) && ($uorg_type=='Buyer' || $uorg_type=='Both')) {
	  $sorgdtls = $orgObj->select($invdtls[0]['iSupplierOrganizationID']);
	  $frmbuyer = 'y';
	  $smarty->assign("sorgdtls",$sorgdtls);
}
$currency = $orgprefObj->getDetails('vCurrency'," AND iOrganizationID=$curORGID");

if(trim($currency[0]['vCurrency'])!='') {
	$currency = @explode(',',$currency[0]['vCurrency']);
     $currency=@implode("','",$currency);
     $csql = "Select iCurrencyID,vCode from ".PRJ_DB_PREFIX."_currency_master  where vCode in('".$currency."')";
     $currency = $generalobj->getCurrency("vCode in('".$currency."')");
     // $currency = $dbobj->MySqlSelect($csql);
}
$lineItemTax = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_inovice_order_heading", "eLineItemTax","Data[eLineItemTax]", "eLineItemTax","setT()", "".$invdtls[0]['eLineItemTax'].""," class='form-control' ");
$invoiceType = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_inovice_order_heading", "eInvoiceType","Data[eInvoiceType]", "eInvoiceType","", "".$invdtls[0]['eInvoiceType'].""," ");
// prints($invdtls); exit;

$phoneData=explode("-",$invdtls[0]['vBillToContactTelephone']);
if(count($phoneData)==1) {
   $invdtls[0]['vBillToContactTelephone']=$phoneData[0];
} else {
   $invdtls[0]['vBillToContactTelephoneCode']=$phoneData[0];
   $invdtls[0]['vBillToContactTelephone']=$phoneData[1];
}


# Invoice Code DropDownBox Data [START]
$stsdtls = $statusmasterObj->getDetails('*'," AND vStatus_en='Accepted' AND eFor='Invoice' ");
$sts = $stsdtls[0]['iStatusID'];

$where = " AND iStatusID=$sts ";
$where .= " AND iSupplierOrganizationID=$curORGID ";

$invoiceCodeData = $invOrdObj->getDetails("vInvoiceCode as vTitle,iInvoiceID as Id",$where);
# Invoice Code DropDownBox Data [END]

$stsdtls = $statusmasterObj->getDetails('*'," AND vStatus_en='Accepted' AND eFor='PO' ");
$sid = $sts = $stsdtls[0]['iStatusID'];
$where = " AND iStatusID=$sts ";
$where .= " AND iSupplierOrganizationID=$curORGID ";
$where .= " AND (Select count(iInvoiceID) from b2b_inovice_order_heading where iPurchaseOrderID=poh.iPurchaseOrderID)=0 ";

$POCodeData = $pohObj->getJoinTableInfo('',"poh.vPOCode as vTitle,poh.iPurchaseOrderID as Id",$where);
# PO Code DropDownBox Data [END]

$bnk_dtls = $bnkObj->getDetails('*', " AND eStatus='Active'");
if(trim($invdtls[0]['iBankId'])!='' && $invdtls[0]['iBankId']>0) {
   $bnkdtl = $bnkObj->getDetails('*', " AND iBankId=".$invdtls[0]['iBankId']);
} else if(trim($orgdtls[0]['iBankId'])!='' && $orgdtls[0]['iBankId']>0){
	$bnkdtl = $bnkObj->getDetails('*', " AND iBankId=".$orgdtls[0]['iBankId']);
}
// 

if($invdtls[0]['eCreateByBuyer']=='Yes' && $invdtls[0]['iSupplierOrganizationID']==$curORGID) {
   header("Location: ".SITE_URL_DUM."invoiceview/$iInvoiceID");
	exit;
}

$smarty->assign('sporgid',$sporgid);
$smarty->assign('iInvoiceID',$iInvoiceID);
$smarty->assign('invdtls',$invdtls);
$smarty->assign('invad',$invad);
$smarty->assign('stateArr',$stateArr);
$smarty->assign('OrgCode',$OrgCode);
$smarty->assign('orgname',$orgname);
$smarty->assign('orgdtls',$orgdtls);
$smarty->assign('borgdtls',$borgdtls);
$smarty->assign("borgname", $borgname);
$smarty->assign("bOrgCode", $bOrgCode);
$smarty->assign('podl',$podl);
$smarty->assign('msg',$msg);
$smarty->assign('mmsg',$mmsg);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('view',$view);
$smarty->assign('currency',$currency);
$smarty->assign('lineItemTax',$lineItemTax);
$smarty->assign('invoiceType',$invoiceType);
$smarty->assign('invoiceCodeData',$invoiceCodeData);
$smarty->assign('POCodeData',$POCodeData);
$smarty->assign('vldmsg',$vldmsg);
$smarty->assign('sid',$sid);
$smarty->assign('bnkdtl',$bnkdtl);
$smarty->assign('bnk_dtls',$bnk_dtls);
$smarty->assign('frmbuyer',$frmbuyer);
$smarty->assign('invAttachments',$invAttachments);
?>