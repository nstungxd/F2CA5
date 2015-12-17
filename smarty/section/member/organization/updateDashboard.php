<?php  

include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgUsrObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationUser.php");
	$orgUsrObj = new OrganizationUser();
}
$order = $_POST['order'];
$Data['tDashboard'] = $order;

//$orgObj->setAllVar($Data);
$where = " iUserID = '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
$res = $orgUsrObj->updateData($Data,$where);
exit();
?>