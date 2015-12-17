<?php
if(!isset($b2bpbObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_BProduct_Association.php");
	$b2bpbObj = new Buyer2_Buyer_BProduct_Association();
}
if(!isset($b2bpbvObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_BProduct_Association_ToVerify.php");
	$b2bpbvObj = new Buyer2_Buyer_BProduct_Association_ToVerify();
}

$iAssociationId = GetVar('id');
// $msg = GetVar('msg');
$mod = '';

$flds = " b2bpbv.*, org.vCompanyName as vBuyer2, org.vCompCode, bpo.vProductName as vProduct, bpo.vProductCode, bo.vCompanyName as vBuyer, bo.vCompCode as vB2Code ";
$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_bproduct_organization bpo on bpo.iProductId=b2bpbv.iProductId
            LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2bpbv.iBuyer2Id
            LEFT JOIN ".PRJ_DB_PREFIX."_organization_master bo on bo.iOrganizationID=b2bpbv.iBuyerId ";
$vb2bprdtls = $b2bpbvObj->getJoinTableInfo($jtbl, $flds, " AND b2bpbv.iAssociationId=$iAssociationId ", ' b2bpbv.iVerifiedID DESC ', '', ' LIMIT 0,1');
// pr($vb2bprdtls); exit;
$vrq = $b2bpbvObj->isVerifyReq($vb2bprdtls);

$vsts = '';
if($vrq=='vreq') {
   $vsts = $b2bpbvObj->chkRecVrf($vb2bprdtls);
   if($vsts=='nr' || $vsts=='om') {
      header('Location: '.SITE_URL_DUM.'b2bprodtbasoclist');
      exit;
   }
} else if($vrq=='nr') {
   $flds = " b2bpb.*, org.vCompanyName as vBuyer2, org.vCompCode, bpo.vProductName as vProduct, bpo.vProductCode, bo.vCompanyName as vBuyer, bo.vCompCode as vB2Code ";
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_bproduct_organization bpo on bpo.iProductId=b2bpb.iProductId
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2bpb.iBuyer2Id
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master bo on bo.iOrganizationID=b2bpb.iBuyerId ";
   $vb2bprdtls = $b2bpbObj->getJoinTableInfo($jtbl, $flds, " AND iAssociationId=$iAssociationId ");
   $vrq = $b2bpbvObj->isVerifyReq($vb2bprdtls);
   if($vrq=='vreq') {
      $vsts = $b2bpbvObj->chkRecVrf($vb2bprdtls);
      if($vsts=='nr' || $vsts=='om') {
         header('Location: '.SITE_URL_DUM.'b2bprodtbasoclist');
         exit;
      }
   } else if($vrq=='nr') {
      header('Location: '.SITE_URL_DUM.'b2bprodtbasoclist');
      exit;
   }
}

if($vb2bprdtls[0]['eStatus']=='Delete' && $vb2bprdtls[0]['eNeedToVerify']!='Yes') {
  header('Location: '.SITE_URL_DUM.'b2bprodtbasoclist/rnme');
  exit;
}
// pr($vb2bprdtls); exit;
$vmsg = $b2bpbvObj->getStatusMessage($vb2bprdtls[0]['eStatus'],$vb2bprdtls[0]['eNeedToVerify']);

$smarty->assign('mod',$mod);
$smarty->assign('vrq',$vrq);
$smarty->assign('vsts',$vsts);
$smarty->assign('vmsg',$vmsg);
$smarty->assign('arr',$vb2bprdtls);
$smarty->assign('iAssociationId',$iAssociationId);
?>