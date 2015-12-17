<?php
if(!isset($b2bpaObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_BProduct_Association.php");
	$b2bpaObj = new Buyer2_BProduct_Association();
}
if(!isset($b2bpavObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_BProduct_Association_ToVerify.php");
	$b2bpavObj = new Buyer2_BProduct_Association_ToVerify();
}

$iAssociationId = GetVar('id');
// $msg = GetVar('msg');
$mod = '';

$flds = " b2bpav.*, org.vCompanyName as vBuyer2, org.vCompCode, bpo.vProductName as vProduct, bpo.vProductCode ";
$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_bproduct_organization bpo on bpo.iProductId=b2bpav.iProductId
            LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2bpav.iBuyer2Id ";
$vb2bprdtls = $b2bpavObj->getJoinTableInfo($jtbl, $flds, " AND b2bpav.iAssociationId=$iAssociationId ", ' b2bpav.iVerifiedID DESC ', '', ' LIMIT 0,1');
$vrq = $b2bpavObj->isVerifyReq($vb2bprdtls);

$vsts = '';
/*if($vrq=='vreq') {
   $vsts = $b2bpavObj->chkRecVrf($vb2bprdtls);
   if($vsts=='nr' || $vsts=='om') {
      header('Location: '.SITE_URL_DUM.'b2bprodtasoclist');
      exit;
   }
} else */if($vrq=='nr') {
   $flds = " b2bpa.*, org.vCompanyName as vBuyer2, org.vCompCode, bpo.vProductName as vProduct, bpo.vProductCode ";
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_bproduct_organization bpo on bpo.iProductId=b2bpa.iProductId
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2bpa.iBuyer2Id ";
   $vb2bprdtls = $b2bpaObj->getJoinTableInfo($jtbl, $flds, " AND iAssociationId=$iAssociationId ");
   $vrq = $b2bpavObj->isVerifyReq($vb2bprdtls);
   /*if($vrq=='vreq') {
      $vsts = $b2bpavObj->chkRecVrf($vb2bprdtls);
      if($vsts=='nr' || $vsts=='om') {
         header('Location: '.SITE_URL_DUM.'b2bprodtasoclist');
         exit;
      }
   } else if($vrq=='nr') {
      header('Location: '.SITE_URL_DUM.'b2bprodtasoclist');
      exit;
   }*/
}
// pr($vb2bprdtls); exit;

$smarty->assign('mod', $mod);
$smarty->assign('vrq', $vrq);
$smarty->assign('vsts', $vsts);
$smarty->assign('arr', $vb2bprdtls);
$smarty->assign('iAssociationId', $iAssociationId);
?>