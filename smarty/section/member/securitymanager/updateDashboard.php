<?php  
include(S_SECTIONS."/member/memberaccess.php");

if(!isset($secManObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.SecurityManager.php');
     $secManObj = new SecurityManager();
}
$order = $_POST['order'];
$Data['tDashboard'] = $order;

$secManObj->setAllVar($Data);
$where = " iSMID = '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
$res = $secManObj->updateData($Data,$where);
exit();
?>