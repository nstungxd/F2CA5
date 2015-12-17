<?php  
/**
 * Action file for add/Update of Country
 * @Created Date :3rd-july-08.
 * @package		addcountry_a.php
 * @section		action/general
 * @author		Pradip Kumar Dash
 */

if(!isset($currencyObj)) {
    include_once(SITE_CLASS_APPLICATION."class.Currency.php");
    $currencyObj =	new Currency();
}

$view = PostVar("view");
$Data = PostVar("Data");
$iCurrencyID = PostVar("iCurrencyID");
$actionfile  = GetVar("file");

/** This is for Check Duplicate Record-------------------------------------------*/
$generalobj->getRequestVars();
$redirect_file="index.php?file=$file&view=$view&iCurrencyID=$iCurrencyID";
$generalobj->checkDuplicate('iCurrencyID', PRJ_DB_PREFIX."_currency_master", Array('vCode'=>$Data['vCode']), $redirect_file, COUNTRY_ALREADY_EXISTS, $iCurrencyID);

if($view == "add") {
    //prints($Data);exit;
    $currencyObj->setAllVar($Data);
	 $id = $currencyObj->insert();
    if($id)$var_msg = "Record Added Successfully.";else $var_msg="Eror-in Add.";
}
else if($view == "edit") {
    $arr = $currencyObj->select($iCurrencyID);
    $currencyObj->setAllVar($arr);
    $currencyObj->setAllVar($Data);
    $where = " iCurrencyID = '".$iCurrencyID."'";
	 $id = $currencyObj->update($where);
	 if($id)$var_msg = "Record Updated Successfully.";else $var_msg="Eror-in Update.";
}
header("Location:index.php?file=".$actionfile."&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>