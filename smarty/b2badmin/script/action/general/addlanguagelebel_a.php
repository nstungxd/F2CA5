<?php  
/**
 * Action file for add/Update of Language
 *
 * @package		addlanguage_a.php
 * @section		action/general
 * @author		Snehasis Mohapatra
 */
require_once(SITE_FUNC."language.inc.php");

if(!isset($langLabObj)) {
    include_once(SITE_CLASS_APPLICATION."class.LanguageLable.php");
    $langLabObj =	new LanguageLable();
}

$view = PostVar("view");
$Data = PostVar("Data");
$iLabelId =PostVar("iLabelId");
$actionfile  = GetVar("file");

$fieldsName = array("vValue");
$multiData  = $dbobj->getAlterTable(''.PRJ_DB_PREFIX.'_lang_lable',$fieldsName,$Data);
$Data['dDate'] = date("Y-m-d H:i:s");

/** This is for Check Duplicate Record-------------------------------------------*/
$generalobj->getRequestVars();
$redirect_file="index.php?file=$file&view=$view&iLabelId=$iLabelId";
$generalobj->checkDuplicate('iLabelId', PRJ_DB_PREFIX."_lang_lable", Array('vName'=>$Data['vName']), $redirect_file, LABLE_ALREADY_EXISTS, $iLabelId);

if($view == "add"){
     //prints($Data);exit;
  $langLabObj->setAllVar($Data);
	$result = $langLabObj->insert();

	if($result)$var_msg = "Record Added Successfully.";else $var_msg="Eror-in Add.";
}else if($view == "edit"){

     //prints($Data);exit;
     $arr = $langLabObj->select($iLabelId);
     $langLabObj->setAllVar($arr);
     $langLabObj->setAllVar($Data);
     $where = " iLabelId = '".$iLabelId."'";
	$result = $langLabObj->update($where);
	if($result)$var_msg = "Record Updated Successfully.";else $var_msg="Eror-in Update.";
}
generate_language_file();

header("Location:index.php?file=".$actionfile."&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>