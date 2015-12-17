<?php  

include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgUserObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUserObj =	new OrganizationUser();
}
$order = $_POST['order'];
$Data['tDashboard'] = $order;

$orgUserObj->setAllVar($Data);
$where = " iUserID = '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
$res = $orgUserObj->updateData($Data,$where);
exit();
?>