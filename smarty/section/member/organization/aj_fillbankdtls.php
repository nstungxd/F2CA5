<?php
if(!isset($bnkObj)) {
   include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
   $bnkObj = new BankMaster();
}
$bankid = GetVar('bankid');
$flds = GetVar('flds');
$tflds = GetVar('tflds');
$fld_ary = @explode(',',$flds);
$tfld_ary = @explode(',',$tflds);
$dtls = array();
$t = "";
if(trim($bankid)!='' && $bankid>0 && trim($flds)!='') {
   $dtls = $bnkObj->getDetails($flds," AND iBankId=$bankid ");
}
if(isset($dtls[0]) && is_array($dtls[0]) && count($dtls[0])>0 && is_array($fld_ary) && count($fld_ary)>0 && is_array($tfld_ary) && count($tfld_ary)>0) {
   $t .= "<script type='text/javascript'>";
   for($l=0; $l<count($tfld_ary); $l++) {
      $t .= "$('#".$tfld_ary[$l]."').val('".$dtls[0][$fld_ary[$l]]."');";
   }
   $t .= "</script>";
}
echo $t;
exit;
?>