<?php  
/**
 * Action file for add/Update of admin
 * @package		addaccess_a.php
 * @section		action/general
 */

include_once(SITE_CLASS_APPLICATION.'class.AdminUser.php');
$adminUserObj = new AdminUser();

include_once(SITE_CLASS_APPLICATION.'class.AccessPerModule.php');
$accModObj = new AccessPerModule();

$mode = PostVar('mode');
$Data = PostVar('Data');
$actionfile = PostVar('actionfile');
$listArr = PostVar('listing');
$addArr = PostVar('add');
$updateArr = PostVar('update');
$DeleteArr = PostVar('delete');
$activeArr = PostVar('active');
$inactiveArr = PostVar('inactive');
$blockArr = PostVar('block');
$searchArr = PostVar('search');

$arr = $adminUserObj->select($Data['iAdminId']);
//prints($arr);exit;
$Data['eAdminType'] = $arr[0]['eType'];

if(count($_POST) > 0){
	if(count($listArr) > 0){
		$Data['tListing'] = @implode(",",$listArr);
	}else{
		$Data['tListing'] = "";
	}
	if(count($addArr) > 0){
		$Data['tAdd'] = @implode(",",$addArr);
	}else{
		$Data['tAdd'] = "";
	}
	if(count($updateArr) > 0){
		$Data['tUpdate'] = @implode(",",$updateArr);
	}else{
		$Data['tUpdate'] = "";
	}
	if(count($DeleteArr) > 0){
		$Data['tDelete'] = @implode(",",$DeleteArr);
	}else{
		$Data['tDelete'] = "";
	}
	if(count($activeArr) > 0){
		$Data['tActive'] = @implode(",",$activeArr);
	}else{
		$Data['tActive'] = "";
	}
	if(count($inactiveArr) > 0){
		$Data['tInactive'] = @implode(",",$inactiveArr);
	}else{
		$Data['tInactive'] = "";
	}
	if(count($blockArr) > 0){
		$Data['tBlock'] = @implode(",",$blockArr);
	}else{
		$Data['tBlock'] = "";
	}
	if(count($searchArr) > 0){
		$Data['tSearch'] = @implode(",",$searchArr);
	}else{
		$Data['tSearch'] = "";
	}
	
	//Prints($Data);exit;
     $where = " AND iAdminId = '".$Data['iAdminId']."'";
     $accModObj->delete($where);
     $accModObj->setAllVar($Data);
	$id = $accModObj->insert();
     unset($Data);
	if($id)$var_msg = "Access Rights Added / Updated  Successfully.";else $var_msg="Eror-in Add / Update.";
}

header("Location:index.php?file=".$actionfile."&view=edit&AX=Yes&var_msg=$var_msg");
exit;
?>