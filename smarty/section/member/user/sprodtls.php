<?php
$iProductId = GetVar('id');
$dtls = array();
if(trim($iProductId)!='' && $iProductId>0) {
if(!isset($sProductOrgObj)) {
	include_once(SITE_CLASS_APPLICATION.'productorganization/class.SProductOrganization.php');
	$sProductOrgObj = new SProductOrganization();
}
$flds = "spo.iProductId, spo.vProductName, spo.vProductCode, 'sproduct' as eProductType, spo.eAvailability, (select vBankName from ".PRJ_DB_PREFIX."_bank_master bm where bm.iBankId=spo.iBankId) as vBankName, spo.vBankAccount";
$dtls = $sProductOrgObj->getDetails($flds," AND iProductId='$iProductId' ");
}
if(!(is_array($dtls) && count($dtls)>0)) {
	$dtls = 'nrf';
}
$smarty->assign("dtls",$dtls);
?>