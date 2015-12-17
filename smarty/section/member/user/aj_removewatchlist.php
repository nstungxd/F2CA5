<?php
$userid = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
$rfqarr = PostVar('iRFQ2Id');
if(!isset($rfq2watchlistObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Watchlist.php");
	$rfq2watchlistObj = new Rfq2Watchlist();
}
$rfq2ids = "";
if(is_array($rfqarr) && count($rfqarr)>0) {
	$rfq2ids = @ implode(',', $rfqarr);
}
$msg = $smarty->get_template_vars('MSG_RFQ2_REM_FROM_WATCHLIST_ERR').':m';
if(trim($rfq2ids)!='') {
   $where = " iRFQ2Id IN ($rfq2ids) AND iUserID=$userid ";
   $rs = $rfq2watchlistObj->del($where);
	if($rs) {
		$msg = $smarty->get_template_vars('MSG_RFQ2_REM_FROM_WATCHLIST_SUCC').':m';
	}
}
echo $msg;
exit;
?>