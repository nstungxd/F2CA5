<?php
/**
 * @author hidden
 * @copyright 2010
 */

include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization;
	//$sess_id
}
if(!isset($asocObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
	$asocObj = new OrganizationAssociation();
}

$vl = $_GET['q'];
$orgid = $_GET['orgid'];
// $type = $_GET['type'];
// $orgtype = $_GET['orgtype'];
// $iId = $_GET['iId'];
// prints($_GET); exit;
$res = array();
if($orgid != 'undefined' && trim($orgid) != '' && $orgid > 0 && $vl != 'undefined' && trim($vl) != '') {
   $where = " AND vAssociationCode LIKE '%".$vl."%' AND iBuyerOrganizationID=$orgid";
	$res = $asocObj->getDetails(' DISTINCT vAssociationCode as vTitle,vAssociationCode as Id',$where);
}
/*else if($vl != 'undefined' && trim($vl) != '') {
   $where = " AND vAssociationCode REGEXP '^".$vl."'";
}*/

// echo $where; exit;
/*if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
	$where .= " AND (iOrganizationID='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."')";
}*/
/*if(trim($orgtype) != '') {
	$where .= " AND (eOrganizationType='$orgtype' OR eOrganizationType='Both')";
}*/
//echo $where;exit;

// $res = $asocObj->getDetails('vAssociationCode as vTitle,vAssociationCode as Id',$where);
//prints($res);exit;
$html="";
if(count($res) > 0) {
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