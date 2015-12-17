<?php  
/**
 * Action file for add/Update of Country
 * @Created Date :3rd-july-08.
 * @package		addcountry_a.php
 * @section		action/general
 * @author		Pradip Kumar Dash
 */

if(!isset($secQueObj)) {
    include_once(SITE_CLASS_APPLICATION."class.SecQuestion.php");
    $secQueObj =	new SecQuestion();
}

$view = PostVar("view");
$Data = PostVar("Data");
$iQuestionId = PostVar("iQuestionId");
$actionfile  = GetVar("file");

/** This is for Check Duplicate Record-------------------------------------------*/
$generalobj->getRequestVars();
$redirect_file="index.php?file=$file&view=$view&iQuestionId=$iQuestionId";
$generalobj->checkDuplicate('iQuestionId', PRJ_DB_PREFIX."_sec_question", Array('tQuestion'=>$Data['tQuestion']), $redirect_file, COUNTRY_ALREADY_EXISTS, $iQuestionId);

if($view == "add") {
     //prints($Data);exit;
     $secQueObj->setAllVar($Data);
	$id = $secQueObj->insert();

     if($id)
          $var_msg = "Record Added Successfully.";
     else $var_msg="Eror-in Add.";
}
else if($view == "edit") {
     $secQueObj->setAllVar($Data);
     $where = " iQuestionId = '".$iQuestionId."'";
	$id = $secQueObj->update($where);

	if($id)
          $var_msg = "Record Updated Successfully.";
     else $var_msg="Eror-in Update.";
}
header("Location:index.php?file=".$actionfile."&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>