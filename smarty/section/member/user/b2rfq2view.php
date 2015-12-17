<?php
$id = GetVar('id');
$msg = GetVar('msg');
$username = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];
$view = '';

$vmsg = PostVar('var_msg');
//$msg = (trim($msg)!='')? $msg : GetVar('msg');
if($vmsg=='al') {
	$vmsg = $smarty->get_template_vars('LBL_BID_ADVANCE_NOT_HIGHER');
} else if($vmsg=='pl') {
	$vmsg = $smarty->get_template_vars('LBL_BID_PRICE_NOT_LESSER');
} else if($vmsg=='bl') {
	$vmsg = $smarty->get_template_vars('MSG_LESSER_BID_ADVANCE_PRICE');
} else if($vmsg=='nl') {
	$vmsg = $smarty->get_template_vars('MSG_RFQ2_NOT_LIVE');
} else if($msg=='rae') {
	$vmsg = $smarty->get_template_vars('MSG_BID_ALREADY_EXISTS');
	$msg = '';
}

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
	$orgUserPermObj =new OrganizationUserPermission();
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
if(!isset($r2bdObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Bids.php");
	$r2bdObj = new Rfq2Bids();
}
if(!isset($r2bdflObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2BidFiles.php");
	$r2bdflObj = new RFQ2BidFiles();
}

if($id>0)
{
	$lang = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'];
	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on rfq2.iStatusID=sm.iStatusID
				LEFT JOIN ".PRJ_DB_PREFIX."_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID
                                LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_heading poh on rfq2.iPurchaseOrderID=poh.iPurchaseOrderID ";
	$where .= " AND rfq2.iRFQ2ID=$id ";
	$fields = " *, ioh.iInvoiceID,poh.vSupplierName as poh_vSupplierName,poh.fPOTotal, poh.iPurchaseOrderID, vStatusMsg_".LANG." as vStatusMsg, vStatus_".LANG." as vStatus, rfq2.eSaved, rfq2.eDelete ";
	$dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where,'','','','');
	
	if(! (is_array($dtls) && count($dtls)>0 && isset($dtls[0]['iRFQ2Id']) && $dtls[0]['iRFQ2Id']>0)) {
		header("Location: ".SITE_URL_DUM."b2rfq2list");
		exit;
	}
	if(($dtls[0]['vStatus']!='Verify' || $dtls[0]['eSaved']=='Yes' || $dtls[0]['eDelete']=='Yes')) { 	// && $orgprf[0]['eRFQ2VerifyReq']=='Yes'
		header("Location: ".SITE_URL_DUM."b2rfq2list");
		exit;
	}
	$rs = $rfq2Obj->setAllRfq2Ststus();
	$b2rfq2sts = $rfq2Obj->getB2Rfq2Status($dtls[0]['iRFQ2Id']);
	// echo $b2rfq2sts; exit;
	
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
		if(! in_array($curORGID,$buyer2ids)) {
			header("Location: ".SITE_URL_DUM."b2rfq2list");
			exit;
		}
	} else {
		header("Location: ".SITE_URL_DUM."b2rfq2list");
		exit;
	}
	
	$bdtls = $r2bdObj->getDetails('*'," AND iRFQ2Id=".$dtls[0]['iRFQ2Id']." AND iBuyer2Id=$curORGID"," iBidId DESC ",""," LIMIT 0,1 ");
	// pr($dtls); exit;	 
         $allow_bid = 'y';
         if($bdtls[0]['eStatus'] == "current" && $dtls[0]['eAuctionType'] == "Tender"){
             $allow_bid = 'n';
         }
	if(is_array($bdtls) && count($bdtls)>0 && isset($bdtls[0]['iBidId']) && $bdtls[0]['iBidId']>0 && $bdtls[0]['iBuyer2Id']==$curORGID && $bdtls[0]['eSaved']=='Yes') {
		$view = 'edit';
		$rfq2bidfiles = $r2bdflObj->getDetails("*"," AND iBidId=".$bdtls[0]['iBidId']);
		// pr($rfq2bidfiles); exit;
		$rfq2bidfilearr = array();
		if(is_array($rfq2bidfiles) && count($rfq2bidfiles)>0) {
			for($l=0; $l<count($rfq2bidfiles); $l++) {
				if(is_file($cfgimg['rfq2bid']['docs']['path'].$rfq2bidfiles[$l]['iBidId'].'/'.$rfq2bidfiles[$l]['vFile'])) {
					$bidfiles = $rfq2bidfiles[$l]['vFile'];
					$no = strpos($bidfiles,"_","_");
					$bidfiles = substr($bidfiles,$no+1);
					$no = strpos($bidfiles,"_","_");
					$bidfiles = substr($bidfiles,$no+1);
					$rfq2bidfilearr[$l]['iFileId'] = $rfq2bidfiles[$l]['iBidFileId'];
					$rfq2bidfilearr[$l]['vFileName'] = $bidfiles;
					$rfq2bidfilearr[$l]['vFile'] = $cfgimg['rfq2bid']['docs']['url'].$rfq2bidfiles[$l]['iBidId'].'/'.$rfq2bidfiles[$l]['vFile'];
				}
			}
		}
		$smarty->assign('rfq2bidfiles',$rfq2bidfilearr);
	}
	
	$rfq2file = $rfq2fObj->getDetails('*'," AND iRFQ2Id='".$dtls[0]['iRFQ2Id']."'");	
	$rfq2filearr = array();
	if(is_array($rfq2file) && count($rfq2file)>0) {
		for($l=0; $l<count($rfq2file); $l++) {			
         if(is_file($cfgimg['rfq2']['docs']['path'].$rfq2file[$l]['iRFQ2Id'].'/'.$rfq2file[$l]['vFile'])) {
            $bidfiles = $rfq2file[$l]['vFile'];                           
            $no = strpos($bidfiles,"_","_");
            $bidfiles = substr($bidfiles,$no+1);
            $no = strpos($bidfiles,"_","_");
            $bidfiles = substr($bidfiles,$no+1);                        
            $rfq2filearr[$l]['namefiles'] = $bidfiles;
			   $rfq2filearr[$l]['rfq2files'] = $cfgimg['rfq2']['docs']['url'].$rfq2file[$l]['iRFQ2Id'].'/'.$rfq2file[$l]['vFile'];
         }
		}
	}
	// pr($dtls); exit;
	// pr($b2rfq2sts); exit;
	if($dtls[0]['eAuctionType']=='Tender' && isset($bdtls[0]['iBidId']) && $bdtls[0]['iBidId']>0) {
		$view = 'edit';
		$smarty->assign('view', $view);
	}
	$smarty->assign('rfq2filearr',$rfq2filearr);
	$smarty->assign('dtls', $dtls);
	$smarty->assign('bdtls', $bdtls);
	$smarty->assign('b2rfq2sts', $b2rfq2sts);
        $smarty->assign('allow_bid', $allow_bid);        
	$smarty->assign('product_dtls', $product_dtls);
	// $smarty->assign('invattachs', $invattachs);
	$smarty->assign('rfq2pb2_dtls', $rfq2pb2_dtls);
	$smarty->assign('curORGID', $curORGID);
} else {
	if($sess_usertype == 'orgadmin') {
		header("Location: ".SITE_URL_DUM."b2rfq2list");
		exit;
	}
	
	$acptsts = $statusmasterObj->getDetails('iStatusID'," AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Verify' ");
	$acptsts = $acptsts[0]['iStatusID'];
	$rfq2CombAry = array(
		"ID"				   =>	"iRFQ2Id",
		"Name" 				=>	"Data[iRFQ2Id]",
		"Type"				=>	"Query",
		"tableName" 		=>	"".PRJ_DB_PREFIX."_rfq2_master",
		"fieldId" 			=>	"iRFQ2Id",
		"fieldName"			=>	"vRFQ2Code",
		"extVal"			   =>	'',
		"selectedVal" 		=>	'',
		"width"  			=>	'210px',
		"height"  			=>	'',
		"onchange" 			=>	'',
		"selectText" 		=>	"--- ".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_RFQ2')." ---",
		"where" 			   =>	" iStatusID='$acptsts' AND (Select count(rpb2.iRfq2ProductB2Id) from ".PRJ_DB_PREFIX."_rfq2_product_buyer2 rpb2 where rpb2.iRFQ2Id=iRFQ2Id AND iBuyer2Id=$curORGID)>0 AND (eAuctionStatus='Live' OR (eAuctionStatus NOT IN ('Completed','Cancelled') AND dStartDate<=NOW() AND dEndDate>=NOW())) ",
		"multiple_select" =>	"",
		"orderby" 			=>	'vRFQ2Code',
		"validationmsg"	=>	'',
		"extra"				=>	" title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_RFQ2')."' ",
		"class" 				=> "required"
	);
	$rfq2s = $gdbobj->DynamicDropDown($rfq2CombAry);
	$smarty->assign('rfq2s', $rfq2s);
}
if($sess_usertype_short=='OU' && $uorg_type=='Buyer2' && $uorg_type!='SM') {
   $ur2p = $orgUserPermObj->getUserR2Permits($sess_id,'%,RFQ2 Bid,%','vRFQ2BidPermits');
   $smarty->assign('ur2p',$ur2p);
}
$smarty->assign('iRFQ2Id', $id);
$smarty->assign('msg', $msg);
$smarty->assign('vmsg', $vmsg);
$smarty->assign('view', $view);
// check for live rfq2 and bid can only be added/edited for those
?>