<?php
if(!isset($sProductOrgObj)) {
   include_once(SITE_CLASS_APPLICATION.'productorganization/class.SProductOrganization.php');
   $sProductOrgObj = new SProductOrganization();
}
include(SITE_CLASS_GEN . "class.sendmail.php");
$sendMail = new SendPHPMail();

//prints($_POST);exit;
$view = PostVar("view");
$Data = PostVar("Data");
/* $dupl = PostVar('dpr');
if(!isset($Data['eEmailNotification'])) {
   $Data['eEmailNotification'] = 'No';
}*/
//$Data_access = PostVar("Data_access");
$iProductId = PostVar("iProductId");
$curr_date = date("Y-m-d h:i:s");
// $iAdminID = $_SESSION['B2B_SESS_USERID'];

/** This is for Check Duplicate Record------------------------------------------- */
$generalobj->getRequestVars();
$redirect_file = "index.php?file=$file&view=$view&iProductId=$iProductId";
$generalobj->checkDuplicate('iProductId', PRJ_DB_PREFIX . "_sproduct_organization", Array('vProductCode' => $Data['vProductCode']), $redirect_file, 'Record Already Exists', $iProductId);
if ($view == "add")
{
   // $Data['dAddedDate'] = date("Y-m-d H:i:s");
   // $Data['vIP'] = $_SERVER[REMOTE_ADDR];
   // $Data['iAdminID'] = $_SESSION['B2B_SESS_USERID'];
   $sProductOrgObj->setAllVar($Data);
   $id = $sProductOrgObj->insert();
   if($id) {
      $var_msg = "Record Added Successfully.";
      unset($Data);
   } else {
      $var_msg = "Eror-in Add.";
   }
} else if ($view == "edit") {
   // $Data = array_merge($Data, array("dLastAccessDate" => $curr_date));
   $where = " iProductId='".$iProductId."'";
   $res = $sProductOrgObj->updateData($Data, $where);
   if ($res) {
      $var_msg = "Record Updated Successfully.";
   } else {
      $var_msg = "Eror-in Update.";
   }
}
header("Location:index.php?file=po-sproductorg&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>