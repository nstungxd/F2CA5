<?php
include(S_SECTIONS."/member/memberaccess.php");

/**
 * @author hidden
 * @copyright 2010
*/

if(!isset($PurOrderLineObj)) {
	include_once(SITE_CLASS_APPLICATION."class.purchaseorderline.php");
	$PurOrderLineObj =	new purchaseorderline();
}

$key = $_GET['q'];
$type = $_GET['type'];
$iPOId = $_GET['iPOId'];
$name = trim($_GET['name']);
$iOrganizationID = trim($_GET['icompid']);
// prints($_GET); exit;
/*
if($sess_usertype == 'securitymanager')
     $where=" AND bom.iASMID='".$sess_id."'";
else
     $where = " AND bom.iOrganizationID = '".$sess_id."'";
*/
$where = "";
if($key != '') {
   $where.=' AND vItemCode LIKE "%'.$key.'%" ';
}
// echo $curORGID; exit;
//if($iOrganizationID != '')
//{
	$where .= " AND iPurchaseOrderID=$iPOId ";
//}
// echo $where; exit;
$res = $PurOrderLineObj->getDetails("vItemCode as vTitle,iOrderLineID as Id",$where);
 //prints($res);exit;
unset ($res['tot']);
$html='';
if(count($res) > 0 && is_array($res)) {
   $i=0;
   foreach($res as $arr) {
      $html.="<span style='display:none'>".$arr['Id']."</span>".$arr['vTitle'];
      if($i < count($res)){
         $html.="\n";
      }
   }
}else{
   $html.="<span style='display:none'></span>No record found";
}
echo $html;
exit;
?>