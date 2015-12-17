<?php
if(!isset($b2spsObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Supplier_SProduct_Association.php");
	$b2spsObj = new Buyer2_Supplier_SProduct_Association();
}
if(!isset($b2spsvObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Supplier_SProduct_Association_ToVerify.php");
	$b2spsvObj = new Buyer2_Supplier_SProduct_Association_ToVerify();
}

$iAssociationId = GetVar('id');
// $msg = GetVar('msg');
$mod = '';

$flds = " b2spsv.*, org.vCompanyName as vBuyer2, org.vCompCode, spo.vProductName as vProduct, spo.vProductCode, so.vCompanyName as vSupplier, so.vCompCode as vSCode ";
$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_sproduct_organization spo on spo.iProductId=b2spsv.iProductId
            LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2spsv.iBuyer2Id
            LEFT JOIN ".PRJ_DB_PREFIX."_organization_master so on so.iOrganizationID=b2spsv.iSupplierId ";
$vb2bprdtls = $b2spsvObj->getJoinTableInfo($jtbl, $flds, " AND b2spsv.iAssociationId=$iAssociationId ", ' b2spsv.iVerifiedID DESC ', '', ' LIMIT 0,1');
// pr($vb2bprdtls); exit;
$vrq = $b2spsvObj->isVerifyReq($vb2bprdtls);

$vsts = '';
if($vrq=='vreq') {
   $vsts = $b2spsvObj->chkRecVrf($vb2bprdtls);
   if($vsts=='nr' || $vsts=='om') {
      header('Location: '.SITE_URL_DUM.'b2sprodtsasoclist');
      exit;
   }
} else if($vrq=='nr') {
   $flds = " b2sps.*, org.vCompanyName as vBuyer2, org.vCompCode, spo.vProductName as vProduct, spo.vProductCode, so.vCompanyName as vSupplier, so.vCompCode as vSCode ";
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_sproduct_organization spo on spo.iProductId=b2sps.iProductId
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2sps.iBuyer2Id
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master so on so.iOrganizationID=b2sps.iSupplierId ";
   $vb2bprdtls = $b2spsObj->getJoinTableInfo($jtbl, $flds, " AND iAssociationId=$iAssociationId ");
   $vrq = $b2spsvObj->isVerifyReq($vb2bprdtls);
   if($vrq=='vreq') {
      $vsts = $b2spsvObj->chkRecVrf($vb2bprdtls);
      if($vsts=='nr' || $vsts=='om') {
         header('Location: '.SITE_URL_DUM.'b2sprodtsasoclist');
         exit;
      }
   } else if($vrq=='nr') {
      header('Location: '.SITE_URL_DUM.'b2sprodtsasoclist');
      exit;
   }
}

if($vb2bprdtls[0]['eStatus']=='Delete' && $vb2bprdtls[0]['eNeedToVerify']!='Yes') {
  header('Location: '.SITE_URL_DUM.'b2sprodtsasoclist/rnme');
  exit;
}
// pr($vb2bprdtls); exit;
$vmsg = $b2spsvObj->getStatusMessage($vb2bprdtls[0]['eStatus'],$vb2bprdtls[0]['eNeedToVerify']);

$smarty->assign('mod',$mod);
$smarty->assign('vrq',$vrq);
$smarty->assign('vsts',$vsts);
$smarty->assign('vmsg',$vmsg);
$smarty->assign('arr',$vb2bprdtls);
$smarty->assign('iAssociationId',$iAssociationId);
?>