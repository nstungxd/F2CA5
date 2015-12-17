<?php
include(S_SECTIONS."/member/memberaccess.php");

// prints($_POST); exit;
$orgid = $_GET['orgid'];
$type = $_GET['type'];
$frm = $_GET['frm'];

if($orgid != '' && $orgid>0) {
	$sql = "select * from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=$orgid ";
	$dtls = $dbobj->MySqlSelect($sql);
	/*if(isset($dtls[0]['iBankId']) && $dtls[0]['iBankId']>0) {
		if(!isset($bnkObj)) {
			include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
			$bnkObj = new BankMaster();
		}
		$bnk_dtls = $bnkObj->getDetails('*', " AND iBankId=".$dtls[0]['iBankId']);
	}*/
}
// print $sql;
// pr($bnk_dtls); exit;

if(is_array($dtls) && count($dtls)>0) {
	$phoneData=explode("-",$dtls[0]['vPhone']);
	if(count($phoneData) >=2 )
	{
		$dtls[0]['vBillToContactTelephone'] = $phoneData[1];
		$dtls[0]['vBillToContactTelephoneCode'] = $phoneData[0];
		$dtls[0]['vShipToContactTelephone'] = $phoneData[1];
		$dtls[0]['vShipToContactTelephoneCode'] = $phoneData[0];
	}

	if($frm=='po') {
	?>
		<script type="text/javascript">
			$('#vShipToAddressLine1').val('<?php echo $dtls[0]['vAddressLine1']?>');
			$('#vShipToAddressLine2').val('<?php echo $dtls[0]['vAddressLine2']?>');
			$('#vShipToCity').val('<?php echo $dtls[0]['vCity']?>');
			$("#vShipToCountry option[value='<?php echo $dtls[0]['vCountry']?>']").attr("selected","selected");
			getRelativeCombo($('#vShipToCountry').val(),"<?php echo $dtls[0]['vCountry']?>",'vShipToState','---Select Ship To State---',stateArr);
			$("#vShipToState option[value='<?php echo $dtls[0]['vState']?>']").attr("selected","selected");
			$('#vShipToZipCode').val('<?php echo $dtls[0]['vZipcode']?>');
			$('#vShipToContactTelephone').val('<?php echo $dtls[0]['vShipToContactTelephone']?>');
			$('#vShipToContactTelephoneCode').val('<?php echo $dtls[0]['vShipToContactTelephoneCode']?>');

			$('#vBillToAddLine1').val('<?php echo $dtls[0]['vAddressLine1']?>');
			$('#vBillToAddLine2').val('<?php echo $dtls[0]['vAddressLine2']?>');
			$('#vBillToCity').val('<?php echo $dtls[0]['vCity']?>');
			$("#vBillToCountry option[value='<?php echo $dtls[0]['vCountry']?>']").attr("selected","selected");
			getRelativeCombo($('#vBillToCountry').val(),"<?php echo $dtls[0]['vCountry']?>",'vBillToState','---Select Bill To State---',stateArr);
			$("#vBillToState option[value='<?php echo $dtls[0]['vState']?>']").attr("selected","selected");
			$('#vBillToZipCode').val('<?php echo $dtls[0]['vZipcode']?>');
			$('#vBillToContactTelephone').val('<?php echo $dtls[0]['vBillToContactTelephone']?>');
			$('#vBillToContactTelephoneCode').val('<?php echo $dtls[0]['vBillToContactTelephoneCode']?>');
		</script>
	<?php }
	else if($frm=='inv') {
	?>
		<script type="text/javascript">
			$('#vBillToAddLine1').val('<?php echo $dtls[0]['vAddressLine1']?>');
			$('#vBillToAddLine2').val('<?php echo $dtls[0]['vAddressLine2']?>');
			$('#vBillToCity').val('<?php echo $dtls[0]['vCity']?>');
			$("#vBillToCountry option[value='<?php echo $dtls[0]['vCountry']?>']").attr("selected","selected");
			getRelativeCombo($('#vBillToCountry').val(),"<?php echo $dtls[0]['vCountry']?>",'vBillToState','---Select Bill To State---',stateArr);
			$("#vBillToState option[value='<?php echo $dtls[0]['vState']?>']").attr("selected","selected");
			$('#vBillToZipCode').val('<?php echo $dtls[0]['vZipcode']?>');
			$('#vBillToContactTelephone').val('<?php echo $dtls[0]['vBillToContactTelephone']?>');
			$('#vBillToContactTelephoneCode').val('<?php echo $dtls[0]['vBillToContactTelephoneCode']?>');
		</script>
	<?php }
}
exit;

/*
// if(is_array($dtls) && count($dtls) > 0) {
//	for($ln=0;$ln<count($dtls);$ln++) {
$phoneData=explode("-",$dtls[0]['vBillToContactTelephone']);
if(count($phoneData) >=2 )
{
    $dtls[0]['vBillToContactTelephone']=$phoneData[1];
    $dtls[0]['vBillToContactTelephoneCode']=$phoneData[0];
}
		if(is_array($dtls[0])) {
//			foreach($dtls[0] as $ky => $vl) {
	if(trim($js) == 'setinv')
	{
?>
			<script type="text/javascript">
                 //$('#purchaseOrder').val('<?php echo $dtls[0]['vPOCode']?>');
                   // $('#iPurchaseOrderID').val('<?php echo $dtls[0]['iPurchaseOrderID']?>');

            $('#vBuyerName').val('<?php echo $dtls[0]['vBuyerCompanyName']?>');
				$('#iBuyerOrganizationID').val('<?php echo $dtls[0]['iBuyerOrganizationID']?>');
				$('#vBuyerContactParty').val('<?php echo $dtls[0]['vBuyerContactName']?>');
				$('#iBuyerID').val('<?php echo $dtls[0]['iBuyerID']?>');
				$('#iOpeningUnit').val('<?php echo $dtls[0]['iOpeningUnit']?>');
				$('#vSupplierOrderNum').val('<?php echo $dtls[0]['vSupplierOrderNum']?>');
				$('#eLineItemTax').val('<?php echo $dtls[0]['eLineItemTax']?>');
				$('#fVAT').val('<?php echo $dtls[0]['fVAT']?>');
				$('#fOthertax1').val('<?php echo $dtls[0]['fOther_tax_1']?>');
				$('#tCarrier').val('<?php echo $dtls[0]['tCarrier']?>');
				$('#vCurrency').val('<?php echo $dtls[0]['vCurrency']?>');
				$('#fInvoiceTotal').val('<?php echo $dtls[0]['fPOTotal']?>');
				$('#fPrepayment').val('<?php echo $dtls[0]['fPrepayment']?>');

				$('#vBillToParty').val('<?php echo $dtls[0]['vBillToParty']?>');
				$('#vBillToAddLine1').val('<?php echo $dtls[0]['vBillToAddLine1']?>');
				$('#vBillToAddLine2').val('<?php echo $dtls[0]['vBillToAddLine2']?>');
				$('#vBillToCity').val('<?php echo $dtls[0]['vBillToCity']?>');
				$("#vBillToCountry option[value='<?php echo $dtls[0]['vBillToCountry']?>']").attr("selected","selected");
				getRelativeCombo($('#vBillToCountry').val(),"<?php echo $dtls[0]['vBillToCountry']?>",'vBillToState','---Select Bill To State---',stateArr);
				$("#vBillToState option[value='<?php echo $dtls[0]['vBillToState']?>']").attr("selected","selected");
				$('#vBillToZipCode').val('<?php echo $dtls[0]['vBillToZipCode']?>');
				$('#vBillToContactParty').val('<?php echo $dtls[0]['vBillToContactParty']?>');
				$('#vBillToContactTelephone').val('<?php echo $dtls[0]['vBillToContactTelephone']?>');
            $('#vBillToContactTelephoneCode').val('<?php echo $dtls[0]['vBillToContactTelephoneCode']?>');

            var iBuyerOrganizationID="<?php echo $dtls[0]['iBuyerOrganizationID']?>";
            $('#iBuyerOrganizationID').load(SITE_URL+"index.php?file=or-aj_getOrganization&orgid="+$('#iSupplierOrganizationID').val()+"&orgtype=buyer"+"&htmlTag=option"+"&val="+iBuyerOrganizationID+"&extc=invb");
            var iBuyerID="<?php echo $dtls[0]['iBuyerID']?>";
            $('#iBuyerID').load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+iBuyerOrganizationID+"&htmlTag=option"+"&val="+iBuyerID+"&orgtype=buyer");
	           //$('#save').attr('checked', true);
	           // alert($('#iBuyerOrganizationID1').html());
	           //$("div:addNew").("input:fVAT").val('<?php echo $dtls[0]['fVAT']?>');

			</script>
<?php  
	}
	else if(trim($js) == 'setpo')
	{
		// prints($dtls);
?>
		<script type="text/javascript">
                   //  $('#vInvoiceCode').val('<?php echo $dtls[0]['vInvoiceCode']?>');
                    //$('#iInvoiceID').val('<?php echo $dtls[0]['iInvoiceID']?>');

				$('#vSupplierName').val('<?php echo $dtls[0]['vSupplierName']?>');
				$('#iSupplierOrganizationID').val('<?php echo $dtls[0]['iSupplierOrganizationID']?>');
				$('#supplierID').val('<?php echo $dtls[0]['vSupplierContactParty']?>');
				$('#iSupplierID').val('<?php echo $dtls[0]['iSupplierID']?>');
				$('#iOpeningUnit').val('<?php echo $dtls[0]['iOpeningUnit']?>');
				$('#vSupplierOrderNum').val('<?php echo $dtls[0]['vSupplierOrderNum']?>');
				$('#eLineItemTax').val('<?php echo $dtls[0]['eLineItemTax']?>');
				$('#fVAT').val('<?php echo $dtls[0]['fVAT']?>');
				$('#fOther_tax_1').val('<?php echo $dtls[0]['fOthertax1']?>');
				$('#tCarrier').val('<?php echo $dtls[0]['tCarrier']?>');
				$('#vCurrency').val('<?php echo $dtls[0]['vCurrency']?>');
				$('#fPOTotal').val('<?php echo $dtls[0]['fInvoiceTotal']?>');
				$('#fPrepayment').val('<?php echo $dtls[0]['fPrepayment']?>');

				$('#vBillToParty').val('<?php echo $dtls[0]['vBillToParty']?>');
				$('#vBillToAddLine1').val('<?php echo $dtls[0]['vBillToAddLine1']?>');
				$('#vBillToAddLine2').val('<?php echo $dtls[0]['vBillToAddLine2']?>');
				$('#vBillToCity').val('<?php echo $dtls[0]['vBillToCity']?>');
				$("#vBillToCountry option[value='<?php echo $dtls[0]['vBillToCountry']?>']").attr("selected","selected");
				getRelativeCombo($('#vBillToCountry').val(),"<?php echo $dtls[0]['vBillToCountry']?>",'vBillToState','---Select Bill To State---',stateArr);
				$("#vBillToState option[value='<?php echo $dtls[0]['vBillToState']?>']").attr("selected","selected");
				$('#vBillToZipCode').val('<?php echo $dtls[0]['vBillToZipCode']?>');
				$('#vBillToContactParty').val('<?php echo $dtls[0]['vBillToContactParty']?>');
				$('#vBillToContactTelephone').val('<?php echo $dtls[0]['vBillToContactTelephone']?>');
				$('#vBillToContactTelephoneCode').val('<?php echo $dtls[0]['vBillToContactTelephoneCode']?>');
            var iSupplierOrganizationID="<?php echo $dtls[0]['iSupplierOrganizationID']?>";
            $('#iSupplierOrganizationID').load(SITE_URL+"index.php?file=or-aj_getOrganization&orgid="+$('#iBuyerOrganizationID').val()+"&assoc="+$('#vAssocCode').val()+"&orgtype=supplier"+"&htmlTag=option"+"&val="+iSupplierOrganizationID+"&extc=invs");
            var iSupplierID="<?php echo $dtls[0]['iSupplierID']?>";
            $('#iSupplierID').load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+iSupplierOrganizationID+"&htmlTag=option"+"&val="+iSupplierID+"&orgtype=supplier");


			</script>
<?php  
	}
//			}
		}
//	}
//}
*/
/*$msg = $smarty->get_template_vars('LBL_NO_REC_AVAILABLE');
// prints($dtls); exit;

if(is_array($dtls) && count($dtls) > 0) {
	for($ln=0;$ln<count($dtls);$ln++) {
		if(is_array($dtls[$ln])) {
			foreach($dtls[$ln] as $ky => $vl) {
				$content .= "<".htmlspecialchars($ky).">".htmlspecialchars($vl)."</".htmlspecialchars($ky).">";
			}
		}
	}
} else {
	$content .= '<msg>'.$msg.'</msg>';
}
// print_r($content); exit;
include_once(SITE_CLASS_GEN."class.xmlparser.php");
$parseObj = new xmlparser('UTF-8');
$xmlcontent ='<?xml version="2.0" encoding="UTF-8"?><list>';
$xmlcontent .= $content;
$xmlcontent .= '</list>';
$arr_xml = $parseObj->xml2php($xmlcontent);
$xml = $parseObj->php2xml($arr_xml);
$parseObj->output_xml($xml);
ob_clean();
ob_flush();
 */
exit;
?>