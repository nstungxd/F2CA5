<?php

include(S_SECTIONS."/member/memberaccess.php");

/**
 * @author hidden
 * @copyright 2010
 */
if(!isset($UsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$UsrObj = new OrganizationUser;
}
$orgname = $_GET['orgname'];
$key = $_GET['q'];
$type = $_GET['type'];
$iId = $_GET['iId'];
$name = trim($_GET['name']);
$iOrganizationID = trim($_GET['icompid']);
$htmlTag=$_GET['htmlTag'];
$val=$_GET['val'];
$orgtype=$_GET['orgtype'];
// prints($_GET); exit;
/*
if($sess_usertype == 'securitymanager')
     $where=" AND bom.iASMID='".$sess_id."'";
else
     $where = " AND bom.iOrganizationID = '".$sess_id."'";
 */
$where = "";
if($htmlTag == ''){
     if($key != '') {
        $where.=' AND (vFirstName LIKE ("%'.$key.'%") OR vLastName LIKE ("%'.$key.'%"))';
     }
}
if($iOrganizationID != '')
{
	$where .= " AND iOrganizationID=$iOrganizationID ";
}

if(trim($type) != '') {
	$where .= " AND eUserType='$type' ";
}
if($orgname != '')
{
   $where.=' AND (vFirstName LIKE ("%'.$orgname.'%") OR vLastName LIKE ("%'.$orgname.'%"))';
}
if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
   // $where .= " AND iOrganizationID NOT IN (Select iOrganizationID from ".PRJ_DB_PREFIX."_organization_master where eOrganizationType!='Buyer2')";
}
// echo $where; exit;
$res = $UsrObj->getDetails_PG("CONCAT(vFirstName,' ',vLastName) as vTitle,iUserID as Id,iOrganizationID as iOrganizationID",$where);
//prints($res);exit;
unset ($res['tot']);
$html='';
if($orgtype == 'supplier')
    $typeMsg=$smarty->get_template_vars('LBL_SUPPLIER')." ".$smarty->get_template_vars('LBL_CONTACT_PARTY');
elseif($orgtype == 'buyer')
    $typeMsg=$smarty->get_template_vars('LBL_BUYER')." ".$smarty->get_template_vars('LBL_CONTACT_PARTY');
elseif($orgtype == 'user')
    $typeMsg=$smarty->get_template_vars('LBL_ORG_USER');
if(count($res) > 0) {
   $i=0;
   if($htmlTag == "option")
     $html="<option value=''>---".$smarty->get_template_vars('LBL_SELECT')." ".$typeMsg."---</option>";
   foreach($res as $arr) {
          if($htmlTag == 'option'){
               if($val == $arr['Id'])
               {
                    $selected="selected";
               }
               else $selected="";
               $html.="<option title='$arr[vTitle]' value='$arr[Id]' $selected>".$arr['vTitle']."</option>";

          }
          else
               $html.="<span style='display:none'>".$arr['Id'].'_'.$arr['iOrganizationID']."</span>".$arr['vTitle'];
          if($i < count($res)){
               $html.="\n";
      }
   }
}else{
     if($htmlTag == 'option')
          $html.="<option value=''>---".$smarty->get_template_vars('LBL_SELECT')." ".$typeMsg."---</option>";
     else
          $html.="<span style='display:none'></span>No record found";
}
echo $html;
exit;
?>