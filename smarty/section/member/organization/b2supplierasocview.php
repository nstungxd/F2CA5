<?php
if(!isset($b2saObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Supplier_Association.php");
	$b2saObj = new Buyer2_Supplier_Association();
}
if(!isset($b2savObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Supplier_Association_ToVerify.php");
	$b2savObj = new Buyer2_Supplier_Association_ToVerify();
}

$iAssociationId = GetVar('id');
// $msg = GetVar('msg');
$mod = '';

$flds = " b2sav.*, org.vCompanyName as vBuyer2, org.vCompCode, so.vCompanyName as vSupplier, so.vCompCode ";
$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master so on so.iOrganizationID=b2sav.iSupplierId
            LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2sav.iBuyer2Id ";
$vb2spdtls = $b2savObj->getJoinTableInfo($jtbl, $flds, " AND b2sav.iAssociationId=$iAssociationId ", ' b2sav.iVerifiedID DESC ', '', ' LIMIT 0,1');
// pr($vb2spdtls); exit;
$vrq = $b2savObj->isVerifyReq($vb2spdtls);

$vsts = '';
if($vrq=='vreq') {
   $vsts = $b2savObj->chkRecVrf($vb2spdtls);
   if($vsts=='nr' || $vsts=='om') {
      header('Location: '.SITE_URL_DUM.'b2supplierasoclist');
      exit;
   }
} else if($vrq=='nr') {
   $flds = " b2bpa.*, org.vCompanyName as vBuyer2, org.vCompCode, bo.vCompanyName as vSupplier, bo.vCompCode ";
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master bo on bo.iOrganizationID=b2bpa.iSupplierId
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2bpa.iBuyer2Id ";
   $vb2spdtls = $b2saObj->getJoinTableInfo($jtbl, $flds, " AND iAssociationId=$iAssociationId ");
   $vrq = $b2savObj->isVerifyReq($vb2spdtls);
   if($vrq=='vreq') {
      $vsts = $b2savObj->chkRecVrf($vb2spdtls);
      if($vsts=='nr' || $vsts=='om') {
         header('Location: '.SITE_URL_DUM.'b2buyserasoclist');
         exit;
      }
   } else if($vrq=='nr') {
      header('Location: '.SITE_URL_DUM.'b2supplierasoclist');
      exit;
   }
}

if($vb2spdtls[0]['eStatus']=='Delete' && $vb2spdtls[0]['eNeedToVerify']!='Yes') {
  header('Location: '.SITE_URL_DUM.'b2supplierasoclist/rnme');
  exit;
}
// pr($vb2spdtls); exit;
$vmsg = $b2savObj->getStatusMessage($vb2spdtls[0]['eStatus'],$vb2spdtls[0]['eNeedToVerify']);

$smarty->assign('mod',$mod);
$smarty->assign('vrq',$vrq);
$smarty->assign('vsts',$vsts);
$smarty->assign('vmsg',$vmsg);
$smarty->assign('arr',$vb2spdtls);
$smarty->assign('iAssociationId',$iAssociationId);
?>