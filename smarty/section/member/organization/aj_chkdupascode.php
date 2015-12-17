<?php
include(S_SECTIONS."/member/memberaccess.php");

$boid = $_POST['borgid'];
$ascode = $_POST['ascode'];
if(trim($ascode)!='' && $boid>0) {
   $sql = "select * from ".PRJ_DB_PREFIX."_organization_association where vSupplierCode='$ascode' AND iBuyerOrganizationID='$boid' ";
   $dtl = $dbobj->MySqlSelect($sql);
   if(is_array($dtl) && count($dtl)>0) {
      echo "exists";
   }
}
exit;
?>