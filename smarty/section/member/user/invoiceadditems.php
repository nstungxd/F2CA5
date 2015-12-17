<?php
include(S_SECTIONS."/member/memberaccess.php");
if(!isset($orgObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($invLineObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceDetailLine.php");
	$invLineObj =	new InvoiceDetailLine();
}
if(!isset($orgUserObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invOrdObj =	new InvoiceOrderHeading();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj =	new StatusMaster();
}
if(!isset($countryObj)) {
   include_once(SITE_CLASS_APPLICATION."class.Country.php");
   $countryObj =	new Country();
}

$invid = $_GET['id'];
//$msg=$_REQUEST['msg'];
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'])) {
	$msg = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
	unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
}
if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} else {
	$msg = '';
}

### CREATE SERVER SIDE VALIDATION MESSAGE ###
$vldmsg = '';
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '') {
   if(!isset($validation)) {
		include(SITE_CLASS_GEN."class.validation.php");
		$validation=new Validation();
	}
   $vldmsg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
}
#### ENDS HERE ###
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

$invad = (isset($_SESSION['invadd']))? $_SESSION['invadd'] : '';
// unset($_SESSION['invadd']);

$invoiceTypes = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_invoice_detail_line", "eInvoiceType","eInvoiceType[]", "eInvoiceType","","","class='drop-down required' ",$smarty->get_template_vars('LBL_SELECT_INV_TYPE'),"---".$smarty->get_template_vars('LBL_SELECT_INV_TYPE')."----");

$orgdtls = $orgObj->select($curORGID);
$orgname = $orgdtls[0]['vCompanyName'];
$OrgCode = $orgdtls[0]['vOrganizationCode'];

if(trim($invid) != '' && is_numeric($invid)) {
	$view = 'edit';
}
$view = (isset($view))? $view : '';
$invdtls = array();
$invitems = array();
if($view == 'edit') {
	$invdtls = $invOrdObj->select($invid);
	$isdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
	$isdtls = $isdtls[0]['iStatusID'];
	if($invdtls[0]['iBuyerOrganizationID']!=$curORGID && $invdtls[0]['iSupplierOrganizationID']!=$curORGID) {
		header("Location: ".SITE_URL_DUM."invoicelist/all");
		exit;
	} else if($invdtls[0]['iBuyerOrganizationID']==$curORGID && $invdtls[0]['iStatusID']<$isdtls && $invdtls[0]['eCreateByBuyer']!='Yes') { 	// && ! ($invdtls[0]['eCreateByBuyer']=='Yes' && ($invdtls[0]['iaStatusID']==0 || $invdtls[0]['iStatusID']==$rjtsts) )
		header("Location: ".SITE_URL_DUM."invoicelist/all");
		exit;
	}
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Rejected'");
	$sts = $stsdtls[0]['iStatusID'];
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Create'");
	$crsts = $stsdtls[0]['iStatusID'];
	// $invdtls[0]['iStatusID'] != $sts && $invdtls[0]['iStatusID'] != $crsts
	if($invad!='yes' && $invdtls[0]['iStatusID']!=$sts && $invdtls[0]['eSaved']!='Yes') { 	// $invdtls[0]['iStatusID']!=$sts
		header("Location: ".SITE_URL_DUM."invoiceviewitems/$invid");
		exit;
	}
	$fields = " idl.*, poh.vPOCode, pol.vItemCode as vPOItemCode ";
	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_heading poh on idl.iPurchaseOrderID=poh.iPurchaseOrderID
				LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_line pol on idl.iRelatedPurchaseOrderLineID=pol.iOrderLineID ";
	$invitems = $invLineObj->getJoinTableInfo($jtbl,$fields," AND idl.iInvoiceID=$invid ");
}
$invoiceTypes = $gdbobj->mysqlEnumValues(PRJ_DB_PREFIX."_invoice_detail_line","eInvoiceType");
$cntrydt = $countryObj->getDetails('*'," AND BINARY vCountryCode='".$invdtls[0]['vBillToCountry']."'");

//
if (!isset($unitofmeasureObj)) {
    include_once(SITE_CLASS_APPLICATION . 'class.UnitOfMeasure.php');
    $unitofmeasureObj = new UnitOfMeasure();
}
$uom = $unitofmeasureObj->getDetails("iUnitId,vUnitOfMeasure","AND eStatus = 'Active'");
//

// prints($cntrydt); exit;
// pr($invitems); exit;
$smarty->assign('invid',$invid);
$smarty->assign('cntrydt',$cntrydt);
$smarty->assign('invitems',$invitems);
$smarty->assign('invdtls',$invdtls);
$smarty->assign('msg',$msg);
$smarty->assign('view',$view);
$smarty->assign('OrgCode',$OrgCode);
$smarty->assign('orgname',$orgname);
$smarty->assign('invoiceTypes',$invoiceTypes);
$smarty->assign('vldmsg',$vldmsg);
$smarty->assign('uom', $uom);
?>