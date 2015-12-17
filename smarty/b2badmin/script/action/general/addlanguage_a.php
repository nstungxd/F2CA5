<?php  
/**
 * Action file for add/Update of Country
 * @Created Date :3rd-july-08.
 * @package		addcountry_a.php
 * @section		action/general
 * @author		Pradip Kumar Dash
 */

$view = PostVar("view");
$Data = PostVar("Data");
$iLanguageId = PostVar("iLanguageId");
$actionfile  = GetVar("file");
if($view == "add")
{
	//Array of Tables and their related fields which we needs to enter into DB when any new language get created.
	$altertable = array("b2b_email_notification" => array("vSubject#varchar","tContent#text"),"b2b_email_template" => array("vSub#varchar","tBody#text"),"b2b_lang_lable" => array("vValue#varchar"),"b2b_seq_question" => array("vQuestion#varchar"),"b2b_status_master" => array("vStatusMsg#varchar"),"b2b_user_action_verification" => array("vMailSubject#varchar","tMailContent#text"));
	
	foreach($altertable as $table => $field) {
		//Add Column According to fields
		foreach($field as $field_name){
			$newfield_name = explode("#",$field_name);
			$newfield = $newfield_name[0];
			$fieldtype = $newfield_name[1];
			if($fieldtype == "varchar"){
				$alterQuery = "ALTER TABLE ".$table." ADD ".$newfield."_".$Data['vLanguageCode']." ".$fieldtype."(255) NOT NULL AFTER ".$newfield."_en"; 
			}elseif($fieldtype == "text"){
				$alterQuery = "ALTER TABLE ".$table." ADD ".$newfield."_".$Data['vLanguageCode']." ".$fieldtype." NOT NULL AFTER ".$newfield."_en";
			}
			$dbobj->MySQLSelect($alterQuery);
		
		}
	}
	$id = $dbobj->MySQLQueryPerform("".PRJ_DB_PREFIX."_language",$Data,'insert');
	if($id)
	$var_msg = "Record Added Successfully.";else $var_msg="Eror-in Add.";
}
else if($view == "edit")
{
	$where = " iLanguageId = '".$iLanguageId."'";
	$id = $dbobj->MySQLQueryPerform("".PRJ_DB_PREFIX."_language",$Data,'update',$where);

	if($id)$var_msg = "Record Updated Successfully.";else $var_msg="Eror-in Update.";
}else if($view == "delete"){

//Drop process can be done here..	
$altertable = array("b2b_email_notification" => array("vSubject#varchar","tContent#text"),"b2b_email_template" => array("vSub#varchar","tBody#text"),"b2b_lang_lable" => array("vValue#varchar"),"b2b_seq_question" => array("vQuestion#varchar"),"b2b_status_master" => array("vStatusMsg#varchar"),"b2b_user_action_verification" => array("vMailSubject#varchar","tMailContent#text"));
	
	foreach($altertable as $table => $field) {
		//Add Column According to fields
		foreach($field as $field_name){
			$newfield_name = explode("#",$field_name);
			$newfield = $newfield_name[0];
			$fieldtype = $newfield_name[1];
			$alterQuery = "ALTER TABLE ".$table." DROP ".$newfield."_".$Data['vLanguageCode'];
			//$dbobj->MySQLSelect($alterQuery);
		}
	}
}
header("Location:index.php?file=".$actionfile."&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>