<?php
$iBidId = GetVar('id');
if(!isset($r2bdObj)) {
	include_once(SITE_CLASS_APPLICATION."user/"."class.Rfq2Bids.php");
	$r2bdObj = new Rfq2Bids();
}
if(!isset($rpb2Obj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.Rfq2ProductBuyer2.php");
	$rpb2Obj = new Rfq2ProductBuyer2();
}
if(!isset($rfq2Obj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
	$rfq2Obj = new RFQ2Master();
}
if(!isset($rfq2fObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Files.php");
	$rfq2fObj = new Rfq2Files();
}
if(!isset($invoiceorderObj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderAttachment.php");
    $invoiceorderObj = new InvoiceOrderAttachment();
}
if(!isset($r2bdflObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2BidFiles.php");
	$r2bdflObj = new RFQ2BidFiles();
}
if(!isset($orgUserPermObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	$orgUserPermObj =	new OrganizationUserPermission();
}
if(!isset($r2awObj)) {
	include_once(SITE_CLASS_APPLICATION."user/"."class.Rfq2Award.php");
	$r2awObj = new Rfq2Award();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
}

$award_created = $r2awObj->getDetails('*',' AND iBidId = "'.$iBidId.'" ');
//pr($award_created); exit;

$rs = $rfq2Obj->setAllRfq2Ststus();
$rfq2_awarded = 'n';
$jtbl = "INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id
            LEFT JOIN ".PRJ_DB_PREFIX."_inovice_order_heading ih ON rfq2.iInvoiceID=ih.iInvoiceID
                LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_heading ph ON rfq2.iPurchaseOrderID=ph.iPurchaseOrderID
				LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm ON sm.iStatusID=r2bd.iStatusID
				LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org ON org.iOrganizationID=r2bd.iBuyer2Id ";
$where = " AND r2bd.iBidId=$iBidId ";
$bdtls = $r2bdObj->getJoinTableInfo($jtbl," DISTINCT *, ph.vPOCode, ph.vSupplierName as ph_vSupplierName, ph.fPOTotal, rfq2.iOrganizationID, org.vCompanyName as vBuyer2, r2bd.eStatus, r2bd.eSaved, r2bd.eDelete, r2bd.iModifiedById, rfq2.fBestBidAdvance, rfq2.fBestBidPrice, rfq2.fBestBidAmount ","$where","","","","");
//pr($bdtls); exit;
if(is_array($bdtls) && count($bdtls)>0 && isset($bdtls[0]['iBidId']) && $bdtls[0]['iBidId']>0)
{
	$rfq2bidfiles = $r2bdflObj->getDetails("*"," AND iBidId=".$bdtls[0]['iBidId']);
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

	// prints($bdtls); exit;
	$invoiceorderfile = $invoiceorderObj->getdetails('*',"AND iInvoiceID='".$bdtls[0]['iInvoiceID']."'");
	$invoiceorderfilearr = array();
	if(is_array($invoiceorderfile) && count($invoiceorderfile)>0) {
		for($l=0; $l<count($invoiceorderfile); $l++) {			
			if(is_file($cfgimg['INV']['docs']['path'].$invoiceorderfile[0]['iInvoiceID'].'/'.$invoiceorderfile[0]['vFile'])) {
				$invoicefile = $invoiceorderfile[$l]['vFile'];                         
				$no = strpos($invoicefile,"_");
				$invoicefile = substr($invoicefile,$no+1);
				$no = strpos($invoicefile,"_");
				$invoicefile = substr($invoicefile,$no+1);                           
				$invoiceorderfilearr[$l]['filename'] = $invoicefile;
				$invoiceorderfilearr[$l]['fileurl'] = $cfgimg['INV']['docs']['url'].$invoiceorderfile[0]['iInvoiceID'].'/'.$invoiceorderfile[$l]['vFile']; 
			}
		}
	}
	
	$rsts = $statusmasterObj->getDetails('*'," AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Rejected' ");
	$rsts = $rsts[0]['iStatusID'];
	if(isset($bdtls[0]['iRFQ2Id']) && $bdtls[0]['iRFQ2Id']>0)
	{
		// $rfq2_dtls = $rfq2fObj->select($bdtls[0]['iRFQ2Id']);
		//prints($invoiceorderfilearr);exit;
		//$rfq2file = $rfq2fObj->getDetails('*'," AND iRFQ2Id='".$bdtls[0]['iRFQ2Id']."'");
		$rfq2file = $rfq2fObj->getDetails('*'," AND iRFQ2Id='".$bdtls[0]['iRFQ2Id']."'");
		$cfgimg['rfq2']['docs']['path'].$dtls[0]['iRFQ2Id'].'/'.$rfq2file[0]['vFile'];
		$rfq2files = array();
		if(is_array($rfq2file) && count($rfq2file)>0) {
			for($l=0; $l<count($rfq2file); $l++) {			
				if(is_file($cfgimg['rfq2']['docs']['path'].$rfq2file[0]['iRFQ2Id'].'/'.$rfq2file[0]['vFile'])) {
					$bidfiles = $rfq2file[$l]['vFile'];                           
					$no = strpos($bidfiles,"_","_");
					$bidfiles = substr($bidfiles,$no+1);
					$no = strpos($bidfiles,"_","_");
					$bidfiles = substr($bidfiles,$no+1);                        
					$rfq2files[$l][filename] = $bidfiles;
					$rfq2files[$l][fileurl] = $cfgimg['rfq2']['docs']['url'].$rfq2file[0]['iRFQ2Id'].'/'.$rfq2file[$l]['vFile']; 
				}
			}
		}
		// pr($rfq2files);exit;
		$rfq2pb2_dtls = $rpb2Obj->getDetails('*'," AND iRFQ2Id='".$bdtls[0]['iRFQ2Id']."'");
		//pr($rfq2pb2_dtls); 
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
					//pr($product_dtls);exit;
				}
			}
		}
		//
		$rfq2_dtls = $rfq2Obj->select($bdtls[0]['iRFQ2Id']);
		//
		$rsts = $statusmasterObj->getDetails('*'," AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Rejected' ");
		$rsts = $rsts[0]['iStatusID'];
		$jtbl = "INNER JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id
            LEFT JOIN ".PRJ_DB_PREFIX."_inovice_order_heading ih ON rfq2.iInvoiceID=ih.iInvoiceID
				LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm ON sm.iStatusID=r2bd.iStatusID
				LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org ON org.iOrganizationID=r2bd.iBuyer2Id ";
		$where = " AND r2bd.iRFQ2Id=".$bdtls[0]['iRFQ2Id']." AND r2bd.iBidId NOT IN (Select iBidId from ".PRJ_DB_PREFIX."_rfq2award_master where iStatusID=$rsts) AND r2bd.iBidId!=".$bdtls[0]['iBidId']." AND r2bd.eSaved!='Yes' AND r2bd.eStatus Not IN ('pending','rejected') "; 	// AND r2bd.iBidId!=".$bdtls[0]['iBidId']."
		$orderby = " fBidAmount DESC ";
		if($rfq2_dtls[0]['eBidCriteria']=='Advance') {
			$orderby = " fBidAdvanceTotal DESC ";
		} else if($rfq2_dtls[0]['eBidCriteria']=='Advance') {
			$orderby = " fBidPriceTotal ASC ";
		}
		$obid_dtls = $r2bdObj->getJoinTableInfo($jtbl," DISTINCT *, org.vCompanyName as vBuyer2, r2bd.eStatus, r2bd.eSaved, r2bd.eDelete, r2bd.iModifiedById, rfq2.eAuctionStatus as rStatus ","$where","$orderby","","","");
		// pr($obid_dtls); exit;
		$smarty->assign('obid_dtls',$obid_dtls);
		$awrdtls = $r2awObj->getDetails('*'," AND iRFQ2Id='".$bdtls[0]['iRFQ2Id']."' AND iStatusID!='$rsts' AND eSaved!='Yes' AND eDelete!='Verified' ");
		if(is_array($awrdtls) && count($awrdtls)>0) {
			$rfq2_awarded = 'y';
		}
		$smarty->assign('rfq2_awarded', $rfq2_awarded);
	}
	$rejdt = $r2awObj->chkAwardSts($bdtls[0]['iBidId'], $rsts);
	$smarty->assign('rejdt', $rejdt);
	//
	$acsts = $statusmasterObj->getDetails('*'," AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Accepted' ");
	$acsts = $acsts[0]['iStatusID'];
	$acpdt = $r2awObj->chkAwardSts($bdtls[0]['iBidId'], $acsts);
	$smarty->assign('acpdt', $acpdt);
}

// pr($bdtls); exit;
// if(trim($bdtls[0]['fBestBidAmount'])=='' || $bdtls[0]['fBestBidAmount']==0) {
if(isset($bdtls[0]['iRFQ2Id']) && $bdtls[0]['iRFQ2Id']>0) {
	$bestbid_id = $rfq2Obj->getCurrentBestBid($bdtls[0]['iRFQ2Id']);
	$smarty->assign('bestbid_id', $bestbid_id);
}

$vreq = 'n';
$permitted = 'n';
// pr($bdtls); exit;
// $orgprf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$dtls[0]['iOrganizationID']);
if(($bdtls[0]['vStatus_en']=='Verify' && $bdtls[0]['eStatus']!='Rejected' && $bdtls[0]['eStatus']!='pending') && $bdtls[0]['eSaved']!='Yes' && strtolower($bdtls[0]['eAuctionStatus'])=='completed') { 	// && $orgprf[0]['eRFQ2VerifyReq']=='Yes'
   $vreq = 'y';
	if($bdtls[0]['iModifiedById']!=$sess_id && $bdtls[0]['iOrganizationID']==$curORGID) {
		$rfq2vp = $orgUserPermObj->getUserR2Permits($sess_id,"%RFQ2 Award,%","vRFQ2AwardPermits");
		// if(isset($rfq2vp['Verify']) && $rfq2vp['Verify']=='y') { $permitted = 'y'; }
		if(isset($rfq2vp['Create']) && $rfq2vp['Create']=='y') { $permitted = 'y'; }
	}
}
// pr($permitted); exit;
// pr($bdtls); exit;
$smarty->assign('iBidId',$iBidId);
$smarty->assign('bidarr',$bdtls);
$smarty->assign('rfq2pb2_dtls',$rfq2pb2_dtls);
$smarty->assign('productdtls',$product_dtls);
$smarty->assign('rfq2files',$rfq2files);
$smarty->assign('invoiceorder',$invoiceorderfilearr);
$smarty->assign('vreq',$vreq);
$smarty->assign('permitted',$permitted);
$smarty->assign('award_created',$award_created);
?>