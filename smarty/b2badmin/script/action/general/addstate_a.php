<?php  
/**
 * Action file for add/Update of State
 * @Created Date :3rd-july-08.
 * @package		addstate_a.php
 * @section		action/general
 */

if(!isset($stateObj)) {
    include_once(SITE_CLASS_APPLICATION."class.State.php");
    $stateObj =	new State();
}
if(!isset($countryObj)) {
    include_once(SITE_CLASS_APPLICATION."class.Country.php");
    $countryObj =	new Country();
}

$view = PostVar("view");
$Data = PostVar("Data");
$iStateId = PostVar("iStateId");

$cntcode = $countryObj->getCountryDetail("vCountryCode","AND iCountryId = '$Data[iCountryId]'");

$Data['vCountryCode']=$cntcode[0]['vCountryCode'];

/** This is for Check Duplicate Record-------------------------------------------*/
$generalobj->getRequestVars();
$redirect_file="index.php?file=$file&view=$view&iStateId=$iStateId";
$generalobj->checkDuplicate('iStateId', PRJ_DB_PREFIX."_state_master", Array('vState'=>$Data['vState']), $redirect_file, STATE_ALREADY_EXISTS, $iStateId);

if($view == "add")
{
     //prints($Data);exit;
     $stateObj->setAllVar($Data);
	$id = $stateObj->insert();
	if($id)$var_msg = "Record Added Successfully.";else $var_msg="Eror-in Add.";
}
else if($view == "edit")
{
     //prints($Data);exit;
     $arr = $stateObj->select($iStateId);
     $stateObj->setAllVar($arr);
     $stateObj->setAllVar($Data);
     $where = " iStateId = '".$iStateId."'";
	$id = $stateObj->update($where);

	if($id)$var_msg = "Record Updated Successfully.";else $var_msg="Eror-in Update.";
}

header("Location:index.php?file=ge-state&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>