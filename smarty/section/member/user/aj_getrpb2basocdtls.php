<?php
$iProductId = PostVar('iProductId');
$iBuyer2Id = PostVar('iBuyer2Id');
$iInvoiceID = PostVar('iInvoiceID');
$ipids = preg_replace('/\w-/','',$iProductId);

if(!isset($invOrdObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invOrdObj =	new InvoiceOrderHeading();
}

$orgas = "";
$invdtls = $invOrdObj->getDetails('iBuyerOrganizationID,iSupplierOrganizationID'," AND iInvoiceID=$iInvoiceID ");
if($invdtls[0]['iBuyerOrganizationID']==$curORGID) {
	$orgas = "Buyer";
} else if($invdtls[0]['iSupplierOrganizationID']==$curORGID) {
	$orgas = "Supplier";
}
$orgas = (trim($orgas)!='')? $orgas : $uorg_type; 

$dtls = array();
if($curORGID>0 && $orgas!='') {
	if($orgas == 'Buyer') {
		if(!isset($b2bpbObj)) {
			include_once(SITE_CLASS_APPLICATION.'organization/class.Buyer2_Buyer_BProduct_Association.php');
			$b2bpbObj = new Buyer2_Buyer_BProduct_Association();
		}
		$dtls = $b2bpbObj->getDetails("*"," AND iBuyerId=$curORGID AND iBuyer2Id=$iBuyer2Id AND iProductId=$ipids ");
	} else if($orgas == 'Supplier') {
		if(!isset($b2spsObj)) {
			include_once(SITE_CLASS_APPLICATION.'organization/class.Buyer2_Supplier_SProduct_Association.php');
			$b2spsObj = new Buyer2_Supplier_SProduct_Association();
		}
		$dtls = $b2spsObj->getDetails("*"," AND iSupplierId=$curORGID AND iBuyer2Id=$iBuyer2Id AND iProductId=$ipids ");
	} else if($orgas == 'Both') {
		$sql = "(Select DISTINCT * from ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association where iBuyerId=$curORGID AND iBuyer2Id=$iBuyer2Id AND iProductId=$ipids)
					UNION
					(Select DISTINCT * from ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association where iSupplierId=$curORGID AND iBuyer2Id=$iBuyer2Id AND iProductId=$ipids)
					ORDER BY vACode ASC";
		// echo $sql; exit;
		$dtls = $dbobj->MySQLSelect($sql);
	}
	// pr($dtls); exit;
}
//
if(is_array($dtls) && count($dtls)>0) {
?>
<table cellpadding="0" cellspacing="0" style="background:#f7f7f7; font-size:12px;">
<tr>
	<td colspan="2" align="left" valign="top"><b><u><?php echo $smarty->get_template_vars('LBL_ASSOCIATION').' '.$smarty->get_template_vars('LBL_DETAILS'); ?></u>:-</b></td>
</tr>
<tr>
	<td width="190px" valign="top"><?php echo $smarty->get_template_vars('LBL_CODE'); ?>: </td>
	<td align="center"><?php echo $dtls[0]['vACode']; ?></td>
</tr>
<?php // if($dtls[0]['fFeeFlat'] > 0) { ?>
<tr class="fval">
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_FEE'); ?> : </td>
	<td><?php echo $dtls[0]['fFeeFlat']; ?></td>
</tr>
<?php // } else { ?>
<tr class="fperc">
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_FEE'); ?> (%) : </td>
	<td><?php echo $dtls[0]['fFeePc']; ?></td>
</tr>
<?php // } ?>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_ADVANCE'); ?> (%) : </td>
	<td><?php echo $dtls[0]['fAdvancePc']; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_MINIMUM_VALUE'); ?>: </td>
	<td><?php echo $dtls[0]['fMinValue']; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_MAXIMUM_VALUE'); ?>: </td>
	<td><?php echo $dtls[0]['fMaxValue']; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_AUTO_ACCEPT_LIMIT'); ?>: </td>
	<td><?php echo $dtls[0]['fAutoAcceptLimit']; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_TOTAL_GLOBAL_LIMIT'); ?>: </td>
	<td><?php echo $dtls[0]['fTotalGlobalLimit']; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_TOTAL_OUTSTANDING_AMOUNT'); ?>: </td>
	<td><?php echo $dtls[0]['fTotalOutstandingAmt']; ?></td>
</tr>
</table>
<?php
} else {
	echo $smarty->get_template_vars("LBL_NO_DETAILS_AVAILABLE");
}
?>
<?php exit; ?>