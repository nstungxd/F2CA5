<?php
if(!isset($b2baObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_Association.php");
	$b2baObj = new Buyer2_Buyer_Association();
}
if(!isset($b2bavObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_Association_ToVerify.php");
	$b2bavObj = new Buyer2_Buyer_Association_ToVerify();
}

$iAssociationId = GetVar('id');
// $msg = GetVar('msg');
$mod = '';

$flds = " b2bav.*, org.vCompanyName as vBuyer2, org.vCompCode, bo.vCompanyName as vBuyer, bo.vCompCode ";
$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master bo on bo.iOrganizationID=b2bav.iBuyerId
            LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2bav.iBuyer2Id ";
$vb2bydtls = $b2bavObj->getJoinTableInfo($jtbl, $flds, " AND b2bav.iAssociationId=$iAssociationId ", ' b2bav.iVerifiedID DESC ', '', ' LIMIT 0,1');
// pr($vb2bydtls); exit;
$vrq = $b2bavObj->isVerifyReq($vb2bydtls);

$vsts = '';
if($vrq=='vreq') {
   $vsts = $b2bavObj->chkRecVrf($vb2bydtls);
   if($vsts=='nr' || $vsts=='om') {
      header('Location: '.SITE_URL_DUM.'b2buyerasoclist');
      exit;
   }
} else if($vrq=='nr') {
   $flds = " b2bpa.*, org.vCompanyName as vBuyer2, org.vCompCode, bo.vCompanyName as vBuyer, bo.vCompCode ";
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master bo on bo.iOrganizationID=b2bpa.iBuyerId
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2bpa.iBuyer2Id ";
   $vb2bydtls = $b2baObj->getJoinTableInfo($jtbl, $flds, " AND iAssociationId=$iAssociationId ");
   $vrq = $b2bavObj->isVerifyReq($vb2bydtls);
   if($vrq=='vreq') {
      $vsts = $b2bavObj->chkRecVrf($vb2bydtls);
      if($vsts=='nr' || $vsts=='om') {
         header('Location: '.SITE_URL_DUM.'b2buyserasoclist');
         exit;
      }
   } else if($vrq=='nr') {
      header('Location: '.SITE_URL_DUM.'b2buyerasoclist');
      exit;
   }
}

if($vb2bydtls[0]['eStatus']=='Delete' && $vb2bydtls[0]['eNeedToVerify']!='Yes') {
  header('Location: '.SITE_URL_DUM.'b2buyerasoclist/rnme');
  exit; 
}
// pr($vb2bydtls); exit;
$vmsg = $b2bavObj->getStatusMessage($vb2bydtls[0]['eStatus'],$vb2bydtls[0]['eNeedToVerify']);

$smarty->assign('mod',$mod);
$smarty->assign('vrq',$vrq);
$smarty->assign('vsts',$vsts);
$smarty->assign('vmsg',$vmsg);
$smarty->assign('arr',$vb2bydtls);
$smarty->assign('iAssociationId',$iAssociationId);
?>