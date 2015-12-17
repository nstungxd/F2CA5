<?php

include(S_SECTIONS . "/member/memberaccess.php");

/**
 * @author hidden
 * @copyright 2010
 */
if (!isset($UsrObj)) {
     require_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUser.php");
     $UsrObj = new OrganizationUser;
}
if (!isset($pohObj)) {
     include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
     $pohObj = new PurchaseOrderHeading();
}
if (!isset($statusmasterObj)) {
     include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
     $statusmasterObj = new StatusMaster();
}

$key = $_GET['q'];
$type = $_GET['type'];
$iId = $_GET['iId'];
$name = trim($_GET['name']);
$iOrganizationID = trim($_GET['icompid']);
$htmlTag = $_GET['htmltag'];
$val = $_GET['val'];
// prints($_GET); exit;

$stsdtls = $statusmasterObj->getDetails('*', " AND vStatus_en='Accepted' AND eFor='PO' ");
$sts = $stsdtls[0]['iStatusID'];
// prints($stsdtls); exit;
/*
  if($sess_usertype == 'securitymanager')
  $where=" AND bom.iASMID='".$sess_id."'";
  else
  $where = " AND bom.iOrganizationID = '".$sess_id."'";
 */
$where = " AND iStatusID=$sts ";
if ($key != '' && $htmlTag == '') {
     $where.=' AND vPOCode LIKE "%' . $key . '%" ';
}
// echo $curORGID; exit;
//if($iOrganizationID != '')
//{
$where .= " AND iSupplierOrganizationID=$curORGID ";
//}
// echo $where; exit;
$res = $pohObj->getDetails("vPOCode as vTitle,iPurchaseOrderID as Id", $where);
// prints($res);exit;
unset($res['tot']);
$html = '';
if (count($res) > 0 && is_array($res)) {
     $i = 0;
     if ($htmlTag == "option")
          $html = "<option value=''>---" . $smarty->get_template_vars('LBL_SELECT') . " " .$smarty->get_template_vars('LBL_PURCHASE_ORDER')."---</option>";

     foreach ($res as $arr) {
          if ($htmlTag == 'option') {
               if ($val == $arr['Id'])
                    $selected = "selected";
               else
                    $selected="";
               $html.="<option value='$arr[Id]' $selected >" . $arr['vTitle'] . "</option>";
          }else
               $html.="<span style='display:none'>" . $arr['Id'] . "</span>" . $arr['vTitle'];
          if ($i < count($res)) {
               $html.="\n";
          }
     }
} else {
     if($htmlTag == 'option')
          $html.= "<option value=''>---" . $smarty->get_template_vars('LBL_SELECT') . " " .$smarty->get_template_vars('LBL_PURCHASE_ORDER')."---</option>";
     else
          $html.="<span style='display:none'></span>No record found";
}
echo $html;
exit;
?>