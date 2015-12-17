<?php
// $val = $data['vValue'];
$sql = "select vName, vValue, vDefValue from ".PRJ_DB_PREFIX."_configuration where vName='ENABLE_AUCTION'";
$auction_ed_ary = $dbobj->MySQLselect($sql);
$auc_modules = "'Product Organization','Buyer Products','Supplier Products','Banks'";
if(is_array($auction_ed_ary) && count($auction_ed_ary)>0) {
   if($auction_ed_ary[0]['vValue']!=$auction_ed) {
      if($auction_ed_ary[0]['vValue']=='Yes')
      {
         $sql = "Update ".PRJ_DB_PREFIX."_modules SET eStatus='Active' where vModuleName IN ($auc_modules)";
         $rs = $dbobj->sql_query($sql);
      }
      else
      {
         $sql = "Update ".PRJ_DB_PREFIX."_modules SET eStatus='Inactive' where vModuleName IN ($auc_modules)";
         $rs = $dbobj->sql_query($sql);
      }
   }
}
?>