<?php
$html = "";
$fid = (isset($_GET['fid']))? $_GET['fid'] : '';
$fnm = (isset($_GET['fnm']))? $_GET['fnm'] : '';
$snm = (isset($_GET['snm']))? $_GET['snm'] : '';
$scd = (isset($_GET['scd']))? $_GET['scd'] : '';
$sid = (isset($_GET['sid']))? $_GET['sid'] : '';
$cls = (isset($_GET['cls']))? $_GET['cls'] : '';
$styl = (isset($_GET['styl']))? $_GET['styl'] : '';
$oc = (isset($_GET['oc']))? $_GET['oc'] : '';
$whr = (isset($_GET['whr']))? $_GET['whr'] : '';
$fr = (isset($_GET['fr']))? $_GET['fr'] : '';

if(!isset($orgObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
   $orgObj =	new Organization();
}

if(trim($snm)!='' && trim($scd)=='') {
   $whr .= " AND vCompanyName LIKE '%$snm%' ";
} else if(trim($scd)!='' && trim($snm)=='') {
   $whr .= " AND vCompCode LIKE '%$scd%' ";
} else if(trim($scd)!='' && trim($snm)!='') {
   $whr .= " AND (vCompanyName LIKE '%$snm%' OR vCompCode LIKE '%$scd%') ";
}

$b2orgs = $orgObj->getDetails("*", " AND eOrganizationType='Buyer2' AND eStatus='Active' $whr ", " vCompanyName ASC ");
// prints($b2orgs); exit;

if(is_array($b2orgs) && count($b2orgs)>0) {
   $ln = count($b2orgs);
   $html .= "<select id='$fid' name='$fnm' class='$cls' onchange='return $oc;' style='$styl' title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_BUYER2')."'>";
   for($l=0;$l<$ln;$l++) {
      $html .= "<option value='".$b2orgs[$l]['iOrganizationID']."'>".$b2orgs[$l]['vCompanyName']." (".$b2orgs[$l]['vCompCode'].")"."</option>";
   }
   $html .= "</select>";
} else {
   $html .= "<select id='$fid' name='$fnm' class='$cls' onchange='return $oc;' style='$styl' title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_BUYER2')."'>";
   $html .= "<option value=''>---".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_BUYER2')."---</option>";
   $html .= "</select>";
}
echo $html;
?>
<?php exit; ?>
<!--<script type="text/javascript">
function alt() {
   alert('hello');
}
alert('hello');
</script>-->