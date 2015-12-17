<?php
if(!isset($rfq2watchlistObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Watchlist.php");
	$rfq2watchlistObj = new Rfq2Watchlist();
}
$userid = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
$rfq2id = $_POST['iRFQ2Id'];
// print_r($rfq2id);
for($i=0;$i<count($rfq2id);$i++) {
   $where = "AND iRFQ2Id=$rfq2id[$i] AND iUserID=$userid"; 
   $row = $rfq2watchlistObj->getDetails('*',$where,"","","");
   if(count($row)==0) {
      $Data = array('iUserID'=>$userid,'iRFQ2Id'=>$rfq2id[$i]);
      $rs = $rfq2watchlistObj->insert($Data);
		if($rs) {
			$msg = $smarty->get_template_vars('MSG_RFQ2_ADDED_TO_WATCHLIST_SUCC').':m';
		} else {
			$msg = $smarty->get_template_vars('MSG_RFQ2_ADD_TO_WATCHLIST_ERR').':m';
		}
   } else {
      $msg = $smarty->get_template_vars('MSG_RFQ2_ALREADY_IN_WATCHLIST').':m';
   }
}
echo $msg;
exit;
?>