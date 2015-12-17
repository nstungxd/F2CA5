<?php
$iProductId = GetVar('id');
$dtls = array();
if(trim($iProductId)!='' && $iProductId>0) {
if(!isset($bProductOrgObj)) {
	include_once(SITE_CLASS_APPLICATION.'productorganization/class.BProductOrganization.php');
	$bProductOrgObj = new BProductOrganization();
}
$flds = "bpo.iProductId, bpo.vProductName, bpo.vProductCode, 'sproduct' as eProductType, bpo.eAvailability, (select vBankName from ".PRJ_DB_PREFIX."_bank_master bm where bm.iBankId=bpo.iBankId) as vBankName, bpo.vBankAccount";
$dtls = $bProductOrgObj->getDetails($flds," AND iProductId='$iProductId' ");
}
if(!(is_array($dtls) && count($dtls)>0)) {
	$dtls = 'nrf';
}
$smarty->assign("dtls",$dtls);
?>