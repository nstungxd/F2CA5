<?php
$iProductId = PostVar('iProductId');
$iInvoiceID = PostVar('iInvoiceID');
$eType = PostVar('eType');
$iPurchaseOrderID = PostVar('iPurchaseOrderID');
$elid = PostVar('elid');
$elnm = PostVar('elnm');
$ocf = PostVar('ocf');
$ext = stripcslashes(PostVar('ext'));
$dflt = stripcslashes(PostVar('dflt'));

if(!isset($invOrdObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invOrdObj =	new InvoiceOrderHeading();
}
if (!isset($purOrdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $purOrdObj = new PurchaseOrderHeading();
}

$orgas = "";
if($eType == "Invoice"){
    $invdtls = $invOrdObj->getDetails('iBuyerOrganizationID,iSupplierOrganizationID'," AND iInvoiceID=$iInvoiceID ");
}else if($eType == "PO"){
    $invdtls = $purOrdObj->getDetails('iBuyerOrganizationID,iSupplierOrganizationID', " AND iPurchaseOrderID=$iPurchaseOrderID ");
}
if($invdtls[0]['iBuyerOrganizationID']==$curORGID) {
	$orgas = "Buyer";
} else if($invdtls[0]['iSupplierOrganizationID']==$curORGID) {
	$orgas = "Supplier";
}
$orgas = (trim($orgas)!='')? $orgas : $uorg_type;

$dtls = array();
if($curORGID>0 && $orgas!='') {
	if($orgas == 'Buyer') {
		$ipids = preg_replace('/\w-/','',$iProductId);
		// $dtls = $orgObj->getDetails("iOrganizationID, vCompanyName, vOrganizationCode"," AND eOrganizationType='Buyer2' AND eStatus='Active' AND iOrganizationID IN (Select iBuyer2Id from ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association where iBuyerId=$curORGID AND iProductId IN ($ipids) ) ");
		$sql = "SELECT orgm.iOrganizationID, orgm.vCompanyName, orgm.vOrganizationCode, b2bpb.iProductId, fAdvancePc, fFeePc FROM ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association b2bpb LEFT JOIN ".PRJ_DB_PREFIX."_organization_master orgm ON b2bpb.iBuyer2Id=orgm.iOrganizationID WHERE orgm.eOrganizationType='Buyer2' AND b2bpb.iBuyerId=$curORGID AND b2bpb.iProductId IN ($ipids)";
		$dtls = $dbobj->MySQLSelect($sql);
	} else if($orgas == 'Supplier') {
		$ipids = preg_replace('/\w-/','',$iProductId);
		// $dtls = $orgObj->getDetails("iOrganizationID, vCompanyName, vOrganizationCode"," AND eOrganizationType='Buyer2' AND eStatus='Active' AND iOrganizationID IN (Select iBuyer2Id from ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association where iSupplierId=$curORGID AND iProductId IN ($ipids) ) ");
		$sql = "SELECT orgm.iOrganizationID, orgm.vCompanyName, orgm.vOrganizationCode, b2sps.iProductId, fAdvancePc, fFeePc FROM ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association b2sps LEFT JOIN ".PRJ_DB_PREFIX."_organization_master orgm ON b2sps.iBuyer2Id=orgm.iOrganizationID WHERE orgm.eOrganizationType='Buyer2' AND b2sps.iSupplierId=$curORGID AND b2sps.iProductId IN ($ipids)";
		// echo $sql; exit;
		$dtls = $dbobj->MySQLSelect($sql);
	} else if($orgas == 'Both') {
		$ipids = @ explode(',',$iProductId);
		$len = count($ipids);
		$bpid = array();
		$spid = array();
		for($l=0; $l<$len; $l++) {
			$pids = @ explode('-', $ipids[$l]);
			if($pids[0] == 'b') {
				$bpid[] = $pids[1];
			} else if($pids[0] == 's') {
				$spid[] = $pids[1];
			}
		}
		if(is_array($bpid)) {
			$bpid = array_filter(array_unique($bpid));
			$bpid = @ implode(',',$bpid);
		}
		if(trim($bpid)=='') { $bpid=0; }
		if(is_array($spid)) {
			$spid = array_filter(array_unique($spid));
			$spid = @ implode(',',$spid);
		}
		if(trim($spid)=='') { $spid=0; }
		$sql = "Select DISTINCT iOrganizationID, vCompanyName, vOrganizationCode from ".PRJ_DB_PREFIX."_organization_master
					where eStatus='Active' AND eOrganizationType='Buyer2' AND 
					(iOrganizationID IN (Select iBuyer2Id from ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association where iBuyerId=$curORGID AND iProductId IN ($bpid))
					OR
					iOrganizationID IN (Select iBuyer2Id from ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association where iSupplierId=$curORGID AND iProductId IN ($spid)) )
					ORDER BY vCompanyName ASC";
		// echo $sql; exit;
		$dtls = $dbobj->MySQLSelect($sql);
	}
}
 //pr($dtls); exit;
?>
<select id="<?php echo $elid; ?>" name="<?php echo $elnm; ?>" <?php echo $ext; ?> onchange="<?php echo $ocf; ?>" multiple="multiple">
<?php echo $dflt; ?>
<?php
if(is_array($dtls) && count($dtls)>0) {
	$len = count($dtls);
	for($l=0; $l<$len; $l++) {
?>
	<option value="<?php echo $dtls[$l]['iOrganizationID']; ?>" prdt="<?php echo $dtls[$l]['iProductId']; ?>"><?php echo $dtls[$l]['vCompanyName'].' ('.$dtls[$l]['vOrganizationCode'].')'; ?></option>
<?php
	}
}
?>
</select>
<div><a class="b2sal" style="cursor:pointer;"><?php echo $smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_ALL'); ?></a></div>
<input type="hidden" name="fAdvancePc_hidden" id="fAdvancePc_hidden" value="<?php echo $dtls[0]['fAdvancePc'] ;?>"/>
<input type="hidden" name="fFeePc_hidden" id="fFeePc_hidden" value="<?php echo $dtls[0]['fFeePc'] ?>"/>
<div id="advance_price_values" style="display: none;">
<?php
if(is_array($dtls) && count($dtls)>0) {
	$len = count($dtls);
	for($l=0; $l<$len; $l++) {
?>
    <span id="advance_price_values_<?php echo $dtls[$l]['iOrganizationID']?>"><?php echo $dtls[$l]['fAdvancePc']?>,<?php echo $dtls[$l]['fFeePc']?></span>
<?php
	}
}
?>
</div>
<?php exit; ?>