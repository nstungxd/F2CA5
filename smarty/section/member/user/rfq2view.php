<?php
$id = GetVar('id');
$msg = GetVar('msg');
$username = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];

if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
}
if(!isset($orgObj)) {
   include_once(SITE_CLASS_APPLICATION.'user/class.Organization.php');
   $orgObj = new Organization();
}
if(!isset($orgprefObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj =	new OrganizationPreference();
}
if(!isset($orgUserObj)) {
   include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUser.php');
   $orgUserObj = new OrganizationUser();
}
if(!isset($orgUserPermObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	$orgUserPermObj =	new OrganizationUserPermission();
}
/*if(!isset($ioaObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderAttachment.php");
	$ioaObj = new InvoiceOrderAttachment();
}*/
if(!isset($rfq2Obj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
	$rfq2Obj = new RFQ2Master();
}
if(!isset($rpb2Obj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.Rfq2ProductBuyer2.php");
	$rpb2Obj = new Rfq2ProductBuyer2();
}
if(!isset($rfq2fObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Files.php");
	$rfq2fObj = new Rfq2Files();
}

$rs = $rfq2Obj->setAllRfq2Ststus();
$lang = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'];
$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on rfq2.iStatusID=sm.iStatusID
         LEFT JOIN ".PRJ_DB_PREFIX."_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID 
          LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_heading poh on rfq2.iPurchaseOrderID=poh.iPurchaseOrderID ";
$where .= " AND rfq2.iRFQ2ID=$id ";
$fields = " *,ioh.iInvoiceID, vStatusMsg_".LANG." as vStatusMsg, vStatus_".LANG." as vStatus, rfq2.eSaved, rfq2.eDelete, poh.vSupplierName as poh_vSupplierName ";
$dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where,'','','','');
// pr($dtls); exit;
if(! (is_array($dtls) && count($dtls)>0 && isset($dtls[0]['iRFQ2Id']) && $dtls[0]['iRFQ2Id']>0)) {
	header("Location: ".SITE_URL_DUM."rfq2list");
	exit;
}
if(($dtls[0]['vStatus']=='Rejected' || $dtls[0]['eSaved']=='Yes') && $dtls[0]['eDelete']!='Yes' && strtolower($dtls[0]['eAuctionStatus'])!='cancelled' && $dtls[0]['iOrganizationID']==$curORGID && $sess_usertype_short == 'OU') { 	// && $orgprf[0]['eRFQ2VerifyReq']=='Yes'
	header("Location: ".SITE_URL_DUM."rfq2create/$id");
	exit;
}

/* if(isset($dtls[0]['iInvoiceID']) && $dtls[0]['iInvoiceID']>0) {
	$invattach = $ioaObj->getDetails('*'," AND iInvoiceID='".$dtls[0]['iInvoiceID']."'");
	$invattachs = array();
	if(is_array($invattach) && count($invattach)>0) {
	   for($l=0;$l<count($invattach);$l++) {
		   if(file_exists($cfgimg['INV']['docs']['path'].$dtls[0]['iInvoiceID'].'/'.$invattach[$l]['vFile'])) {
			   $invattachs[] = $cfgimg['INV']['docs']['url'].$dtls[0]['iInvoiceID'].'/'.$invattach[$l]['vFile'];
			}
		}
   }
}*/

$rfq2file = $rfq2fObj->getDetails('*'," AND iRFQ2Id='".$dtls[0]['iRFQ2Id']."'");
$rfq2files = array();
if(is_array($rfq2file) && count($rfq2file)>0) {
	for($l=0; $l<count($rfq2file); $l++) {
		if(file_exists($cfgimg['rfq2']['docs']['path'].$dtls[0]['iRFQ2Id'].'/'.$rfq2file[$l]['vFile'])) {
			$rfq2files[] = $cfgimg['rfq2']['docs']['url'].$dtls[0]['iInvoiceID'].'/'.$rfq2file[$l]['vFile'];
		}
	}
}
$rfq2pb2_dtls = $rpb2Obj->getDetails('*'," AND iRFQ2Id='".$dtls[0]['iRFQ2Id']."'");
// pr($rfq2pb2_dtls); exit;
$product_dtls = array();
$buyer2_dtls = array();
if(is_array($rfq2pb2_dtls) && count($rfq2pb2_dtls)>0) {
   if(isset($rfq2pb2_dtls[0]['iProductId']) && $rfq2pb2_dtls[0]['iProductId']>0) {
	  if(isset($rfq2pb2_dtls[0]['ePType']) && $rfq2pb2_dtls[0]['ePType']=='BProduct') {
		  if(!isset($bproductObj)) {
			 include_once(SITE_CLASS_APPLICATION.'productorganization/class.BProductOrganization.php');
			 $bproductObj = new BProductOrganization();
		 }
		 $product_dtls = $bproductObj->select($rfq2pb2_dtls[0]['iProductId']);
	  } else if(isset($rfq2pb2_dtls[0]['ePType']) && $rfq2pb2_dtls[0]['ePType']=='SProduct') {
		  if(!isset($sproductObj)) {
			 include_once(SITE_CLASS_APPLICATION.'productorganization/class.SProductOrganization.php');
			 $sproductObj = new SProductOrganization();
		 }
		 $product_dtls = $sproductObj->select($rfq2pb2_dtls[0]['iProductId']);  
	  }
	}
	$buyer2ids = multi21Array($rfq2pb2_dtls,'iBuyer2Id');
	$buyer2ids = array_unique($buyer2ids);
	$buyer2ids = array_filter($buyer2ids);
	$b2ids = '';
	if(is_array($buyer2ids) && count($buyer2ids)>0) {
	   $b2ids = @implode(',',$buyer2ids);
	}
	$buyer2_dtls = $orgObj->getDetails('*'," AND iOrganizationID IN ($b2ids) ");
	// pr($buyer2_dtls); exit;
}
// pr($product_dtls); exit;
// pr($dtls); exit;
$vreq = 'n';
$permitted = 'n';
$orgprf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$dtls[0]['iOrganizationID']);
if((($dtls[0]['vStatus_en']=='Create' && $orgprf[0]['eRFQ2VerifyReq']=='Yes') || $dtls[0]['eDelete']=='Yes') && $sess_usertype_short == 'OU') {
   $vreq = 'y';
	if($dtls[0]['iModifiedById']!=$sess_id && $dtls[0]['iOrganizationID']==$curORGID) {
		$rfq2vp = $orgUserPermObj->getUserRfq2Permits($sess_id);
		if(isset($rfq2vp['Verify']) && $rfq2vp['Verify']=='y') { $permitted = 'y'; }
	}
}
// echo date('Y-m-d H:i:s', strtotime($dtls[0]['dEndDate'] . '+330 minutes'));
// echo $sess_id; exit;
// echo $permitted; exit;
$smarty->assign('iRFQ2Id', $id);
$smarty->assign('msg', $msg);
$smarty->assign('dtls', $dtls);
$smarty->assign('product_dtls', $product_dtls);
$smarty->assign('buyer2_dtls', $buyer2_dtls);
$smarty->assign('invattachs', $invattachs);
$smarty->assign('rfq2pb2_dtls', $rfq2pb2_dtls);
$smarty->assign('curORGID', $curORGID);
$smarty->assign('vreq', $vreq);
$smarty->assign('permitted', $permitted);
?>