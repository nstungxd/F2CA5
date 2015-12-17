<?php
// pr($_POST); exit;
$iInvoiceID = PostVar('iInvoiceID');
$iProductId = PostVar('iProductId');
$availability = PostVar('availability');
$typ = preg_replace('/-\d/','',$iProductId);
$ipids = preg_replace('/\w-/','',$iProductId);
if(trim($typ)!='' && $ipids>0) {
	if($typ=='b') {
		if(!isset($bProductOrgObj)) {
			include_once(SITE_CLASS_APPLICATION.'productorganization/class.BProductOrganization.php');
			$bProductOrgObj = new BProductOrganization();
		}
		$flds = "bpo.iProductId, bpo.vProductName, bpo.vProductCode, 'sproduct' as eProductType, bpo.eAvailability, (select vBankName from ".PRJ_DB_PREFIX."_bank_master bm where bm.iBankId=bpo.iBankId) as vBankName, bpo.vBankAccount";
		$dtls = $bProductOrgObj->getDetails($flds," AND iProductId='$ipids' ");
	} else if($typ=='s') {
		if(!isset($sProductOrgObj)) {
			include_once(SITE_CLASS_APPLICATION.'productorganization/class.SProductOrganization.php');
			$sProductOrgObj = new SProductOrganization();
		}
		$flds = "spo.iProductId, spo.vProductName, spo.vProductCode, 'sproduct' as eProductType, spo.eAvailability, (select vBankName from ".PRJ_DB_PREFIX."_bank_master bm where bm.iBankId=spo.iBankId) as vBankName, spo.vBankAccount";
		// echo "Select ". $flds ." from "." where AND iProductId='$ipids'"; exit;
		$dtls = $sProductOrgObj->getDetails($flds," AND spo.iProductId='$ipids' ");
	}
}
if(is_array($dtls) && count($dtls)>0 && isset($dtls[0]['iProductId']) && $dtls[0]['iProductId']>0) {
?>
<table cellpadding="0" cellspacing="0" style="background:#f7f7f7; font-size:12px;">
<tr>
	<td colspan="2" align="left" valign="top"><b><u><?php echo $smarty->get_template_vars('LBL_PRODUCT').' '.$smarty->get_template_vars('LBL_DETAILS'); ?></u>:-</b></td>
</tr>
<tr>
	<td width="190px" valign="top"><?php echo $smarty->get_template_vars('LBL_PRODUCT'); ?>: </td>
	<td align="left"><?php echo $dtls[0]['vProductName']. '('.$dtls[0]['vProductCode'].')'; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_AVAILABILITY'); ?>: </td>
	<td align="left"><?php echo $dtls[0]['eAvailability']; ?></td>
</tr>
<?php if(strtolower($availability)=='scheme') { ?>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_FEE'); ?>(%): </td>
	<td align="left"><?php echo ($dtls[0]['fFeePc'])? $dtls[0]['fFeePc'] : '---'; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_FEE_FLAT'); ?>: </td>
	<td align="left"><?php echo ($dtls[0]['fFeeFlat'])? $dtls[0]['fFeeFlat'] : '---'; ?></td>
</tr>
<? } ?>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_BANK'); ?>: </td>
	<td><?php echo $dtls[0]['vBankName']; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $smarty->get_template_vars('LBL_ACCOUNT_NUMBER'); ?>: </td>
	<td><?php echo $dtls[0]['vBankAccount']; ?></td>
</tr>
</table>
<?php	
} else {
	echo $smarty->get_template_vars("LBL_NO_DETAILS_AVAILABLE");
}
exit;
?>