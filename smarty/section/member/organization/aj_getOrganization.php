<?php
/**
 * @author hidden
 * @copyright 2010
 */

include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgObj))
{
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization;
	//$sess_id
}

$key = $_GET['q'];
$type = $_GET['type'];
$orgtype = $_GET['orgtype'];
$iId = $_GET['iId'];
$val = $_GET['orgid'];
$assoc = $_GET['assoc'];
$htmlTag=$_GET['htmlTag'];
$val = $_GET['val'];
$isAssociation=$_GET['isAssoc'];
$extc = $_GET['extc'];
$where="";
if($htmlTag == '')
{
     $htmlTag="span";
     $style="style='display:none'";
     if($val != 'undefined' && trim($val) != '') {
     $where = " AND vCompanyName REGEXP '^".$key."' AND iOrganizationID != $val";
     } else {
          $where = " AND vCompanyName REGEXP '^".$key."'";
     }
}

if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
     $where .= " AND (iOrganizationID='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."')";

}else $orgWhere=" AND iOrganizationID != '$curORGID' ";

if(trim($orgtype) != '') {
	$where .= " AND (eOrganizationType='$orgtype' OR eOrganizationType='Both')";
}
if(trim($assoc) != '' && trim($assoc) != 'all') {
	$where .= " AND iOrganizationID IN (Select iSupplierAssocationID from ".PRJ_DB_PREFIX."_organization_association where vAssociationCode='$assoc' AND eStatus='Active' AND eNeedToVerify='No') ";
}
$where .= " AND eStatus='Active' AND eNeedToVerify!='Yes' ".$orgWhere;
 // echo $where;exit;
//print $where;
if($extc = 'invb') {
	$where .= " AND iOrganizationID IN (Select iBuyerOrganizationID from ".PRJ_DB_PREFIX."_organization_association where iSupplierAssocationID='".$_GET['orgid']."') ";
} else if($extc = 'invs') {
	$where .= " AND iOrganizationID IN (Select iSupplierAssocationID from ".PRJ_DB_PREFIX."_organization_association where iBuyerOrganizationID='".$_GET['orgid']."') ";
}
$res = $orgObj->getDetails('vOrganizationCode,vCompanyName as vTitle,vCompanyRegNo,iOrganizationID as Id',$where,"vCompanyName");
// prints($res);exit;

$html="";
 if($orgtype == 'supplier')
     $compName = $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_SUPPLIER')." ".$smarty->get_template_vars('LBL_COMPANY');
 elseif ($orgtype == 'buyer' && $isAssociation == '')
    $compName = $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_BUYER')." ".$smarty->get_template_vars('LBL_COMPANY');
 elseif($orgtype == 'buyer' && $isAssociation == 'yes')
    $compName = $smarty->get_template_vars('MSG_SELECT_BUYER_ORGANIZATION');
 elseif($orgtype == '' && $isAssociation == 'no')
    $compName = $smarty->get_template_vars('MSG_SELECT_ORGANIZATION');
if(count($res) > 0 && is_array($res)) {
   $i=0;
   if($htmlTag == "option")
   {
       $html="<option value=''>---".$compName."---</option>";
   }
	foreach($res as $arr) {
        if($htmlTag == 'option')
        {
             if($val == $arr['Id'])
               $selected="selected";
             else $selected="";
             $html.="<option value='$arr[Id]' $selected >".$arr['vTitle']."</option>";
        }else
               $html.="<span style='display:none'>".$arr['Id']."</span>".$arr['vTitle'];
      if($i < count($res)){
         $html.="\n";
      }
   }
}else{
     if($htmlTag == 'option')
          $html.="<option value=''>---".$compName."---</option>";
     else
          $html.="<span style='display:none'></span>No record found";
}
echo $html;
exit;
?>