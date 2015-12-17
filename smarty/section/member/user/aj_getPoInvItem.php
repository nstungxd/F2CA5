<?php
include(S_SECTIONS."/member/memberaccess.php");

/**
 * @author hidden
 * @copyright 2010
*/

if(!isset($InvOrderLineObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceDetailLine.php");
	$InvOrderLineObj =	new InvoiceDetailLine();
}

$key = $_GET['q'];
$type = $_GET['type'];
$iInvId = $_GET['iInvId'];
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
	$where .= " AND iInvoiceID=$iInvId ";
//}
// echo $where; exit;
$res = $InvOrderLineObj->getDetails("vItemCode as vTitle,iInvoiceLineID as Id",$where);
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