<?php
/**
 * Action file for add/Update of securitymanager
 *
 * @package		addsecuritymanager_a.php
 * @section		action/security_manager
 * @author		Jack Scott
*/
if(!isset($rptreportObj)) {
  include_once(SITE_CLASS_APPLICATION.'class.UnitOfMeasure.php');
  $unitofmeasureObj = new UnitOfMeasure();
}
$view = PostVar("view");
$Data = PostVar("Data");
$iReportId = PostVar("iUnitId");
$date = date("Y-m-d H:i:s");
$iAdminID = $_SESSION['B2B_SESS_USERID'];

/** This is for Check Duplicate Record------------------------------------------- */
$generalobj->getRequestVars();
$redirect_file = "index.php?file=$file&view=$view&iUnitId=$iUnitId";
// $generalobj->checkDuplicate('iSMID', PRJ_DB_PREFIX . "_security_manager", Array('vUserName' => $Data['vUserName']), $redirect_file, USER_ALREADY_EXISTS, $iSMID);
if($view == "add") {
	// $Data['iAdminID'] = $_SESSION['B2B_SESS_USERID'];
	//prints($Data);exit;
	$id = 0;
	$Data['dADate'] = $date;
	if(is_array($Data) && count(array_filter($Data))>0) {
		$id = $unitofmeasureObj->insert($Data);
	}
	if($id) {
		$var_msg = "Record Added Successfully.";
		unset($Data);
	} else {
		$var_msg = "Eror-in Add.";
	}
} else if ($view == "edit") {
	// $arr = $secManObj->select($iReportId);
	$where = " iUnitId = '" . $iUnitId . "'";
	$res = $unitofmeasureObj->updateData($Data, $where);
	if ($res) {
		$var_msg = "Record Updated Successfully.";
	} else {
		$var_msg = "Eror-in Update.";
	}
}
header("Location:index.php?file=ge-unitofmeasure&view=index&AX=Yes&var_msg=$var_msg"); exit;
?>