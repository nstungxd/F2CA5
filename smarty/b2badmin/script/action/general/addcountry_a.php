<?php  
/**
 * Action file for add/Update of Country
 * @Created Date :3rd-july-08.
 * @package		addcountry_a.php
 * @section		action/general
 * @author		Pradip Kumar Dash
 */

if(!isset($countryObj)) {
    include_once(SITE_CLASS_APPLICATION."class.Country.php");
    $countryObj =	new Country();
}

$view = PostVar("view");
$Data = PostVar("Data");
$iCountryId = PostVar("iCountryId");
$actionfile  = GetVar("file");

/** This is for Check Duplicate Record-------------------------------------------*/
$generalobj->getRequestVars();
$redirect_file="index.php?file=$file&view=$view&iCountryId=$iCountryId";
$generalobj->checkDuplicate('iCountryId', PRJ_DB_PREFIX."_country_master", Array('vCountry'=>$Data['vCountry']), $redirect_file, COUNTRY_ALREADY_EXISTS, $iCountryId);

if($view == "add") {
     //prints($Data);exit;
     $countryObj->setAllVar($Data);
	$id = $countryObj->insert();

     if($id)$var_msg = "Record Added Successfully.";else $var_msg="Eror-in Add.";
}
else if($view == "edit") {
     $arr = $countryObj->select($iCountryId);
     $countryObj->setAllVar($arr);
     $countryObj->setAllVar($Data);
     $where = " iCountryId = '".$iCountryId."'";
	$id = $countryObj->update($where);

	if($id)$var_msg = "Record Updated Successfully.";else $var_msg="Eror-in Update.";
}
header("Location:index.php?file=".$actionfile."&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>