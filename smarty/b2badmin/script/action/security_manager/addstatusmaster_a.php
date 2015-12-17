<?php  
/**
 * Action file for add/Update of Language
 *
 * @package		addlanguage_a.php
 * @section		action/general
 * @author		Snehasis Mohapatra
 */
require_once(SITE_FUNC."language.inc.php");

if(!isset($stMstrObj)) {
    include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
    $stMstrObj =	new StatusMaster();
}
$lang= $gdbobj->getLanguage();
$language= 'vStatus_'.$lang[0]['vLanguageCode'];

$view = PostVar("view");
$Data = PostVar("Data");
$iStatusID =PostVar("iStatusID");
$actionfile  = GetVar("file");

$fieldsName = array("vStatus");
$multiData  = $dbobj->getAlterTable(''.PRJ_DB_PREFIX.'_status_master',$fieldsName,$Data);

/** This is for Check Duplicate Record-------------------------------------------   //
$generalobj->getRequestVars();
$redirect_file="index.php?file=$file&view=$view&iStatusID=$iStatusID";
$generalobj->checkDuplicate('iStatusID', PRJ_DB_PREFIX."_status_master", Array("$language"=>$Data["$language"]), $redirect_file, STATUS_ALREADY_EXISTS, $iStatusID);
*/

if($view == "add"){
     //prints($Data);exit;
     $stMstrObj->setAllVar($Data);
	$result = $stMstrObj->insert();

	if($result)$var_msg = "Record Added Successfully.";else $var_msg="Eror-in Add.";
}else if($view == "edit"){

     //prints($Data);exit;
     $arr = $stMstrObj->select($iStatusID);
     $stMstrObj->setAllVar($arr);
     $stMstrObj->setAllVar($Data);
     $where = " iStatusID = '".$iStatusID."'";
	$result = $stMstrObj->update($where);
	if($result)$var_msg = "Record Updated Successfully.";else $var_msg="Eror-in Update.";
}
generate_language_file();

header("Location:index.php?file=".$actionfile."&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>