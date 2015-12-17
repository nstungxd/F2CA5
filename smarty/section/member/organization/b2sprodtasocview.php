<?php
if(!isset($b2spaObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_SProduct_Association.php");
	$b2spaObj = new Buyer2_SProduct_Association();
}
if(!isset($b2spavObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_SProduct_Association_ToVerify.php");
	$b2spavObj = new Buyer2_SProduct_Association_ToVerify();
}

$iAssociationId = GetVar('id');
// $msg = GetVar('msg');
$mod = '';

$flds = " b2spav.*, org.vCompanyName as vBuyer2, org.vCompCode, spo.vProductName as vProduct, spo.vProductCode ";
$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_sproduct_organization spo on spo.iProductId=b2spav.iProductId
            LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2spav.iBuyer2Id ";
$vb2sprdtls = $b2spavObj->getJoinTableInfo($jtbl, $flds, " AND b2spav.iAssociationId=$iAssociationId ", ' b2spav.iVerifiedID DESC ', '', ' LIMIT 0,1');
$vrq = $b2spavObj->isVerifyReq($vb2sprdtls);

$vsts = '';
if($vrq=='vreq') {
   $vsts = $b2spavObj->chkRecVrf($vb2sprdtls);
   if($vsts=='nr' || $vsts=='om') {
      header('Location: '.SITE_URL_DUM.'b2sprodtasoclist');
      exit;
   }
} else if($vrq=='nr') {
   $flds = " b2spa.*, org.vCompanyName as vBuyer2, org.vCompCode, spo.vProductName as vProduct, spo.vProductCode ";
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_sproduct_organization spo on spo.iProductId=b2spa.iProductId
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2spa.iBuyer2Id ";
   $vb2sprdtls = $b2spaObj->getJoinTableInfo($jtbl, $flds, " AND iAssociationId=$iAssociationId ");
   $vrq = $b2spavObj->isVerifyReq($vb2sprdtls);
   if($vrq=='vreq') {
      $vsts = $b2spavObj->chkRecVrf($vb2sprdtls);
      if($vsts=='nr' || $vsts=='om') {
         header('Location: '.SITE_URL_DUM.'b2sprodtasoclist');
         exit;
      }
   } else if($vrq=='nr') {
      header('Location: '.SITE_URL_DUM.'b2sprodtasoclist');
      exit;
   }
}

if($vb2sprdtls[0]['eStatus']=='Delete' && $vb2sprdtls[0]['eNeedToVerify']!='Yes') {
  header('Location: '.SITE_URL_DUM.'b2sprodtasoclist/rnme');
  exit; 
}
// pr($vb2sprdtls); exit;
$vmsg = $b2spavObj->getStatusMessage($vb2sprdtls[0]['eStatus'],$vb2sprdtls[0]['eNeedToVerify']);

$smarty->assign('mod',$mod);
$smarty->assign('vrq',$vrq);
$smarty->assign('vsts',$vsts);
$smarty->assign('vmsg',$vmsg);
$smarty->assign('arr',$vb2sprdtls);
$smarty->assign('iAssociationId',$iAssociationId);
?>