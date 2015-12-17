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

if(!isset($bprdtObj)) {
   include_once(SITE_CLASS_APPLICATION."productorganization/class.BProductOrganization.php");
   $bprdtObj =	new BProductOrganization();
}

if(trim($snm)!='' && trim($scd)=='') {
   $whr .= " AND bpo.vProductName LIKE '%$snm%' ";
} else if(trim($scd)!='' && trim($snm)=='') {
   $whr .= " AND bpo.vProductCode LIKE '%$scd%' ";
} else if(trim($scd)!='' && trim($snm)!='') {
   $whr .= " AND (bpo.vProductName LIKE '%$snm%' OR bpo.vProductCode LIKE '%$scd%') ";
}
if(trim($iBuyer2Id)!='' && $iBuyer2Id>0) {
   $whr .= " AND bpo.iProductId NOT IN (Select iProductId from ".PRJ_DB_PREFIX."_buyer2_bproduct_association where iBuyer2Id=$iBuyer2Id AND NOT (eStatus='Delete' AND eNeedToVerify='No'))";
}
if(trim($sid)!='' && $sid>0) {
   $whr .= " OR bpo.iProductId=$sid ";
}
// echo $whr; exit;
$bprdt = $bprdtObj->getDetails("*", " AND bpo.eAvailability='association' $whr ", " bpo.vProductName ASC ");
// prints($bprdt); exit;

if(is_array($bprdt) && count($bprdt)>0) {
   $ln = count($bprdt);
   $html .= "<select id='$fid' name='$fnm' class='$cls' $ea style='$styl' title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_BPRODUCT')."'>";
   for($l=0;$l<$ln;$l++) {
      $sel = "";
      if($sid>0 && $bprdt[$l]['iProductId']==$sid) {
         $sel = "selected='selected'";
      }
      $html .= "<option value='".$bprdt[$l]['iProductId']."' $sel >".$bprdt[$l]['vProductName']." (".$bprdt[$l]['vProductCode'].")"."</option>";
   }
   $html .= "</select>";
} else {
   $html .= "<select id='$fid' name='$fnm' class='$cls' $ea style='$styl' title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_BPRODUCT')."'>";
   $html .= "<option value=''>---".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_BPRODUCT')."---</option>";
   $html .= "</select>";
}
echo $html;
?>
<?php exit; ?>