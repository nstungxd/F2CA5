<?php

include(S_SECTIONS."/member/memberaccess.php");

//prints($_GET);exit;
$val = GetVar('val');
$field = GetVar('field');
$Data = GetVar('Data');
$id = GetVar('id');
$table = GetVar('table');

if($field == 'vEmail')
{
   echo "true";
   exit;
}


//prints($Data); exit;
$valid = 'true';
$Data[$field] = trim($Data[$field]);
if($val != '') {
     if($Data[$field]!= '') {
           $sql = "select $id,$field as field from $table where $field='".$Data[$field]."'";
           //echo $sql;exit;
           $db_exist = $dbobj->MySqlSelect($sql);
           //prints($db_exist);exit;
     }
    if($db_exist[0][$id] == $val || count($db_exist)==0) {
            $valid = 'true';
    } else {
            $valid = 'false';
    }
} else {
     if($Data[$field]!= '') {
          $sql = "select $id,$field as field from $table where $field='".$Data[$field]."'";
          //echo $sql;exit;
          $db_exist = $dbobj->MySqlSelect($sql);
     }
      //prints($db_exist);exit;
	if(count($db_exist) > 0) {
		$valid = 'false';
	} else {
		$valid = 'true';
	}
}

if($field == 'vEmail') {
	$sql = "select iUserID as id , vEmail, 'iUserID' as iId from ".PRJ_DB_PREFIX."_organization_user where vEmail='".$Data[$field]."'"; 	// $cndt
	$usr_exist = $dbobj->MySqlSelect($sql);
	$sql = "select iOrganizationID as id, vEmail, 'iOrganizationID' as iId from ".PRJ_DB_PREFIX."_organization_master where vEmail='".$Data[$field]."'";
	$org_exist = $dbobj->MySqlSelect($sql);
	$sql = "select iSMID as id, vEmail, 'iSMID' as iId from ".PRJ_DB_PREFIX."_security_manager where vEmail='".$Data[$field]."'";
	$sm_exist = $dbobj->MySqlSelect($sql);
	$sql = "select iAdminId as id, vEmail, 'iAdminId' as iId from ".PRJ_DB_PREFIX."_administrator where vEmail='".$Data[$field]."'";
	$sadmin_exist = $dbobj->MySqlSelect($sql);
	if(count($usr_exist)>0 || count($org_exist)>0 || count($sm_exist)>0 || count($sadmin_exist)>0) {
		if($val != '' && $val != 'undefined') {
			// if($usr_exist[0]['id'] == $val || $org_exist[0]['id'] == $val || $sm_exist[0]['id'] == $val || $sadmin_exist[0]['id'] == $val) {
			if($sm_exist[0]['id'] == $val && $sm_exist[0]['iId'] == $id) {
				$valid = 'true';
			} else {
				$valid = 'false';
			}
		} else {
			$valid = 'false';
		}
	}
}

echo $valid;
exit;
?>
