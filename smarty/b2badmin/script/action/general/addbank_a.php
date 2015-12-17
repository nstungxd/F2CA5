<?php
if(!isset($bankObj)) {
   include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
   $bankObj = new BankMaster();
}

$view = PostVar("view");
$Data = PostVar("Data");
$iBankId = PostVar("iBankId");
$actionfile  = GetVar("file");

$vPhone1 = PostVar("vPhone1");
$vPhone2 = PostVar("vPhone2");
$vPhone = $vPhone1 . "-" . $vPhone2;
$Data = array_merge($Data, array("vPhone" => $vPhone));

$Data['dModifiedDate'] = date('Y-m-d H:i:s');
$Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];
/** This is for Check Duplicate Record-------------------------------------------*/
$generalobj->getRequestVars();
$redirect_file="index.php?file=$file&view=$view&iBankId=$iBankId";
$generalobj->checkDuplicate('iBankId', PRJ_DB_PREFIX."_bank_master", Array('vBankName'=>$Data['vBankName']), $redirect_file, "Bank Already Exists", $iBankId);

if($view == "add") {
   $Data['dAddedDate'] = date('Y-m-d H:i:s');
   // prints($Data); exit;
   $bankObj->setAllVar($Data);
	$id = $bankObj->insert();
   if($id) { $var_msg = "Record Added Successfully."; } else { $var_msg="Eror-in Add."; }
} else if($view == "edit") {
   // $arr = $bankObj->select($iBankId);
   // $bankObj->setAllVar($arr);
   // $bankObj->setAllVar($Data);
   // prints($Data); exit;
   $where = " iBankId='".$iBankId."' ";
	$id = $bankObj->updateData($Data, $where);
	if($id) { $var_msg = "Record Updated Successfully."; } else { $var_msg="Eror-in Update."; }
}
header("Location:index.php?file=".$actionfile."&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>