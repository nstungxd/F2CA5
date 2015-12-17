<?php
$html = "";
$iBuyer2Id = GetVar('b2orgid');
$fid = GetVar('fid');
$fnm = GetVar('fnm');
$snm = GetVar('snm');
$scd = GetVar('scd');
$sid = GetVar('sid');
$cls = GetVar('cls');
$styl = GetVar('styl');
$ea = GetVar('ea');
$whr = GetVar('whr');
$fr = GetVar('fr');

if(!isset($orgObj)) {
   include_once(SITE_CLASS_APPLICATION."productorganization/class.Organization.php");
   $orgObj = new Organization();
}

if(trim($snm)!='' && trim($scd)=='') {
   $whr .= " AND vCompanyName LIKE '%$snm%' ";
} else if(trim($scd)!='' && trim($snm)=='') {
   $whr .= " AND vCompCode LIKE '%$scd%' ";
} else if(trim($scd)!='' && trim($snm)!='') {
   $whr .= " AND (vCompanyName LIKE '%$snm%' OR vCompCode LIKE '%$scd%') ";
}
if(trim($iBuyer2Id)!='' && $iBuyer2Id>0) {
   $whr .= " AND iOrganizationID NOT IN (Select iSupplierId from ".PRJ_DB_PREFIX."_buyer2_supplier_association where iBuyer2Id=$iBuyer2Id AND NOT (eStatus='Delete' AND eNeedToVerify='No'))";
}
if(trim($sid)!='' && $sid>0) {
   $whr .= " OR iOrganizationID=$sid ";
}
$whr .= " AND (eOrganizationType='Supplier' || eOrganizationType='Both') ";
// echo $whr; exit;
$borg = $orgObj->getDetails("*", " AND eStatus='Active' AND eNeedToVerify!='Yes' $whr ", " vCompanyName ASC ");
// prints($borg); exit;

if(is_array($borg) && count($borg)>0) {
   $ln = count($borg);
   $html .= "<select id='$fid' name='$fnm' class='$cls' $ea style='$styl' title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_SUPPLIER')."'>";
   for($l=0;$l<$ln;$l++) {
      $sel = "";
      if($sid>0 && $borg[$l]['iOrganizationID']==$sid) {
         $sel = "selected='selected'";
      }
      $html .= "<option value='".$borg[$l]['iOrganizationID']."' $sel >".$borg[$l]['vCompanyName']." (".$borg[$l]['vCompCode'].")"."</option>";
   }
   $html .= "</select>";
} else {
   $html .= "<select id='$fid' name='$fnm' class='$cls' $ea style='$styl' title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_SUPPLIER')."'>";
   $html .= "<option value=''>---".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_SUPPLIER')."---</option>";
   $html .= "</select>";
}
echo $html;
?>
<?php exit; ?>