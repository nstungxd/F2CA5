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
$oc = GetVar('oc');
$whr = GetVar('whr');
$fr = GetVar('fr');

if(!isset($sprdtObj)) {
   include_once(SITE_CLASS_APPLICATION."productorganization/class.SProductOrganization.php");
   $sprdtObj =	new SProductOrganization();
}

if(trim($snm)!='' && trim($scd)=='') {
   $whr .= " AND spo.vProductName LIKE '%$snm%' ";
} else if(trim($scd)!='' && trim($snm)=='') {
   $whr .= " AND spo.vProductCode LIKE '%$scd%' ";
} else if(trim($scd)!='' && trim($snm)!='') {
   $whr .= " AND (spo.vProductName LIKE '%$snm%' OR spo.vProductCode LIKE '%$scd%') ";
}
if(trim($iBuyer2Id)!='' && $iBuyer2Id>0) {
   $whr .= " AND spo.iProductId IN (Select iProductId from ".PRJ_DB_PREFIX."_buyer2_sproduct_association where iBuyer2Id=$iBuyer2Id AND NOT (eStatus='Delete' AND eNeedToVerify='No'))";
}
if(trim($sid)!='' && $sid>0) {
   $whr .= " OR spo.iProductId=$sid ";
}
// echo $whr; exit;
$sprdt = $sprdtObj->getDetails("*", " AND spo.eAvailability='association' $whr ", " spo.vProductName ASC ");
// prints($sprdt); exit;

if(is_array($sprdt) && count($sprdt)>0) {
   $ln = count($sprdt);
   $html .= "<select id='$fid' name='$fnm' class='$cls' onchange='return $oc;' style='$styl' title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_SPRODUCT')."'>";
   for($l=0;$l<$ln;$l++) {
      $sel = "";
      if($sid>0 && $sprdt[$l]['iProductId']==$sid) {
         $sel = "selected='selected'";
      }
      $html .= "<option value='".$sprdt[$l]['iProductId']."' $sel >".$sprdt[$l]['vProductName']." (".$sprdt[$l]['vProductCode'].")"."</option>";
   }
   $html .= "</select>";
} else {
   $html .= "<select id='$fid' name='$fnm' class='$cls' onchange='return $oc;' style='$styl' title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_SPRODUCT')."'>";
   $html .= "<option value=''>---".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_SPRODUCT')."---</option>";
   $html .= "</select>";
}
echo $html;
?>
<?php exit; ?>