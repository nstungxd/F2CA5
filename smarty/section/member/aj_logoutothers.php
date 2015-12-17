<?php
$uip = $_SERVER['REMOTE_ADDR'];
$sessid = session_id();
//$rsql = "Select * from ".PRJ_DB_PREFIX."_recent_online where iCustomerId=$sess_id AND eType='$sess_usertype_short' AND vTimeLastClick > DATE_SUB(NOW(), INTERVAL 2500 SECOND) AND eSetLogout!='Yes' AND vSessionId!='$sessid'"; // session timeout value check
//$ml = $dbobj->MySqlSelect($rsql);
$ml = $lhObj->getDetails(' iAdminId,dLoginDate,dLogoutDate,vIP,vSessionId '," AND (iAdminId=$sess_id AND eType='$sess_usertype_short' AND vSessionId!='".session_id()."' AND dLogoutDate='0000-00-00 00:00:00')");
$mlusr = '';
// echo $sessid;
// prints($ml); exit;
if(is_array($ml) && count($ml)>0) {
	for($ln=0;$ln<count($ml);$ln++) {
		//$mltplsignin = $lhObj->getDetails(' iAdminId,dLoginDate,dLogoutDate,vIP,vSessionId '," AND (iAdminId=$sess_id AND eType='$sess_usertype_short' AND vSessionId='".$ml[$ln]['vSessionId']."' AND dLogoutDate='0000-00-00 00:00:00')"); 	// user logout check
		$rsql = "Select * from ".PRJ_DB_PREFIX."_recent_online where iCustomerId='$sess_id' AND eType='$sess_usertype_short' AND vSessionId='".$ml[$ln]['vSessionId']."' AND eSetLogout!='Yes'"; 	// AND vTimeLastClick > DATE_SUB(NOW(), INTERVAL 2500 SECOND) 	// session timeout value check
		// echo $rsql."<br/>"; // exit;
		// prints($mltplsignin); exit;
		$mltplsignin = $dbobj->MySqlSelect($rsql);
		if(is_array($mltplsignin) && count($mltplsignin)>0) {
			$mlusr = 'yes';
			$sql = "Update ".PRJ_DB_PREFIX."_recent_online set eSetLogout='Yes' where iWhoId='".$mltplsignin[0]['iWhoId']."'";
			// echo $sql; exit;
			$res=$dbobj->sql_query($sql);
		}
	}
}
header("Location:".$_SERVER['HTTP_REFERER']."");
exit;
?>