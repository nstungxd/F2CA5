<?php  
/**
 * Action file for add/Update of Static Pages
 *
 * @package		addstaticPages_a.php
 * @section		action/general
 */

if(!isset($stPageObj)) {
    include_once(SITE_CLASS_APPLICATION."class.StaticPage.php");
    $stPageObj =	new StaticPage();
}

$view = PostVar("view");
$Data = PostVar("Data");
$iSPageId =PostVar("iSPageId");
$actionfile  = GetVar("file");

$lang= $gdbobj->getLanguage();

for($i=0;$i<count($lang);$i++) {
     $Data['tContent_'.$lang[$i]['vLanguageCode']] = trim(stripslashes($Data['tContent_'.$lang[$i]['vLanguageCode']]));
}

/** This is for Check Duplicate Record-------------------------------------------*/
$generalobj->getRequestVars();
$redirect_file="index.php?file=$file&view=$view&iSPageId=$iSPageId";
$generalobj->checkDuplicate('iSPageId', PRJ_DB_PREFIX."_static_pages", Array('vFile'=>$Data['vFile']), $redirect_file, PAGE_ALREADY_EXISTS, $iSPageId);

if($view == "add"){
     //prints($Data);exit;
     $stPageObj->setAllVar($Data);
	$result = $stPageObj->insert();

     if($result)$var_msg = "Record Added Successfully.";else $var_msg="Eror-in Add.";
}else if($view == "edit"){

     //prints($Data);exit;
     $arr = $stPageObj->select($iSPageId);
     $stPageObj->setAllVar($arr);
     $stPageObj->setAllVar($Data);
     $where = " iSPageId = '".$iSPageId."'";
	$result = $stPageObj->update($where);
     
	if($result)$var_msg = "Record Updated Successfully.";else $var_msg="Eror-in Update.";
}

header("Location:index.php?file=".$actionfile."&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>