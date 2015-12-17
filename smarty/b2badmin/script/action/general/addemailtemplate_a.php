<?php  
/**
 * Action file for add/Update of Email Template
 *
 * @package		addemailtemplate_a.php
 * @section		action/general
 * @author		Jack Scott
 */

if(!isset($emailTempObj)) {
    include_once(SITE_CLASS_APPLICATION."class.EmailTemplate.php");
    $emailTempObj =	new EmailTemplate();
}

$view = PostVar("view");
$Data = PostVar("Data");
$iFormatId =PostVar("iFormatId");
$actionfile  = GetVar("file");
$lang= $gdbobj->getLanguage();
//$Data["tBody"] = trim(stripslashes($Data["tBody"]));

for($i=0;$i<count($lang);$i++) {
     $Data['tBody_'.$lang[$i]['vLanguageCode']] = trim(stripslashes($Data['tBody_'.$lang[$i]['vLanguageCode']]));
}

/** This is for Check Duplicate Record-------------------------------------------*/
$generalobj->getRequestVars();
$redirect_file="index.php?file=$file&view=$view&iFormatId=$iFormatId";
$generalobj->checkDuplicate('iFormatId', PRJ_DB_PREFIX."_email_template", Array('vSub'=>$Data['vSub']), $redirect_file, SUBJECT_ALREADY_EXISTS, $iFormatId);

if($view == "add"){

     //prints($Data);exit;
     $emailTempObj->setAllVar($Data);
	$result = $emailTempObj->insert();

	if($result)$var_msg = "Record Added Successfully.";else $var_msg="Eror-in Add.";
}else if($view == "edit") {

     //prints($Data);exit;
     $arr = $emailTempObj->select($iFormatId);
     $emailTempObj->setAllVar($arr);
     $emailTempObj->setAllVar($Data);
     $where = " iFormatId = '".$iFormatId."'";
	$result = $emailTempObj->update($where);
     
	if($result)$var_msg = "Record Updated Successfully.";else $var_msg="Eror-in Update.";
}
header("Location:index.php?file=".$actionfile."&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>