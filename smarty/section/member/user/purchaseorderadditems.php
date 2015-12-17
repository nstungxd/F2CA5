<?php
include(S_SECTIONS."/member/memberaccess.php");

if(!isset($pohObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
	$pohObj =	new PurchaseOrderHeading();
}
if(!isset($poLineObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderLine.php");
	$poLineObj =	new PurchaseOrderLine();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj =	new StatusMaster();
}
if(!isset($countryObj)) {
   include_once(SITE_CLASS_APPLICATION."class.Country.php");
   $countryObj =	new Country();
}

$poid = $_GET['id'];
//$msg=$_REQUEST['msg'];
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'])) {
	$msg = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
	unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
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

if($sess_usertype_short=='OU' && $poCreate!='Yes') {
   header("Location: ".SITE_URL_DUM."polist/all");
	exit;
}

$poad = (isset($_SESSION['poadd']))? $_SESSION['poadd'] : '';
// unset($_SESSION['poadd']);

if(trim($poid) != '' && is_numeric($poid)) {
	$view = 'edit';
}
if($view == 'edit') {
	$podtls = $pohObj->select($poid);
	$isdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
	$isdtls = $isdtls[0]['iStatusID'];
	if($podtls[0]['iBuyerOrganizationID']!=$curORGID && $podtls[0]['iSupplierOrganizationID']!=$curORGID) {
		header("Location: ".SITE_URL_DUM."polist/all");
		exit;
	} else if($podtls[0]['iSupplierOrganizationID']==$curORGID && $podtls[0]['iStatusID']<$isdtls) {
		header("Location: ".SITE_URL_DUM."polist/all");
		exit;
	}
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Rejected' ");
	$sts = $stsdtls[0]['iStatusID'];
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Create'");
	$crsts = $stsdtls[0]['iStatusID'];
	$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
    $isusts = $stsdtls[0]['iStatusID'];
	$poitems = $poLineObj->getDetails('*'," AND iPurchaseOrderID=$poid ");
	// && $podtls[0]['iStatusID'] != $crsts && $podtls[0]['iStatusID'] != $isusts
	// && (count($poitems)>0 && is_array($poitems) )
	// (count($poitems)>0 && is_array($poitems)) || ($podtls[0]['iStatusID']!=$sts && $podtls[0]['iStatusID']!=$crsts && $podtls[0]['iStatusID']!=$isusts) &&
	// prints($podtls); exit;
	if($poad!='yes' && $podtls[0]['iStatusID']!=$sts && $podtls[0]['eSaved']!='Yes') { 	// $podtls[0]['iStatusID']!=$sts
		header("Location: ".SITE_URL_DUM."poviewitems/$poid");
		exit;
	}
}
// setlocale(LC_MONETARY, 'en_US.UTF-8'); 	// 'en_US.UTF-8' or 'en_US.ISO-8559-1'
$orderTypes = $gdbobj->mysqlEnumValues(PRJ_DB_PREFIX."_purchase_order_line","eOrderType");
$cntrydt = $countryObj->getDetails('*'," AND BINARY vCountryCode='".$podtls[0]['vBillToCountry']."'");
//
if (!isset($unitofmeasureObj)) {
    include_once(SITE_CLASS_APPLICATION . 'class.UnitOfMeasure.php');
    $unitofmeasureObj = new UnitOfMeasure();
}
$uom = $unitofmeasureObj->getDetails("iUnitId,vUnitOfMeasure","AND eStatus = 'Active'");
// prints($poitems); exit;
$smarty->assign('poid',$poid);
$smarty->assign('podtls',$podtls);
$smarty->assign('msg',$msg);
$smarty->assign('view',$view);
$smarty->assign('orderTypes',$orderTypes);
$smarty->assign('cntrydt',$cntrydt);
$smarty->assign('poitems',$poitems);
$smarty->assign('vldmsg',$vldmsg);
$smarty->assign('uom',$uom);
?>