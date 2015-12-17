<?php

include(S_SECTIONS."/member/memberaccess.php");

$id = $_POST['id'];
$iId = $_POST[$id];
$flds = $_POST['flds'];
$tbl = $_POST['table'];

if(trim($flds) != '') {
	if(strpos($flds,',') !== false) {
		echo $flds; exit;
		$flds = @explode(',',$flds);
	} else {
		$fls[0] = $flds;
		$flds = $fls;
	}
}

$vl = "";
$val = array();
$fields = array();
$cndt = "(";
if(is_array($flds) && count($flds)>0) {
	for($l=0;$l<count($flds);$l++) {
		if(trim($_POST[$flds[$l]]) != '') {
			if($cndt != "(") {
				$cndt .= " OR ";
			}
			$cndt .= " ".$flds[$l]."='".$_POST[$flds[$l]]."' ";
		}
		if(trim($vl) != '') {
			$vl .= ",";
		}
		if(is_numeric($_POST[$flds[$l]])) {
			$vl .= $_POST[$flds[$l]];
		} else {
			$vl .= "'".$_POST[$flds[$l]]."'";
		}
		if(trim($_POST[$flds[$l]]) != '') {
			$val[] = $_POST[$flds[$l]];
		}
		if(trim($flds[$l]) != '') {
			$fields[] = $flds[$l];
		}
	}
}
$cndt .= ")";

if(count($val) < 1) {
	echo "nodup";
	exit;
}
$cnt = '';
$cnt .= "(";
for($l=0;$l<count($val);$l++){
	if($cnt != "(") {
		$cnt .= " OR ";
	}
	$cnt .= " ".$flds[$l]." IN ($vl) ";
}
$cnt .= ")";
$wh = '';
if(trim($iId)>0 && trim($iId)!='') {
	$wh = " AND $id!=$iId ";
}
if(is_array($fields) && count($fields)>0) {
	$fld = @implode(',',$fields);
	$fld = ",".$fld;
} else {
	$fld = "";
}

$sql = "Select $id $fld from $tbl where $cnt $wh ";
$dt_exist = $dbobj->MySqlSelect($sql);

if($tbl != PRJ_DB_PREFIX."_organization_user") {
	$sql = "select iUserID, vEmail from ".PRJ_DB_PREFIX."_organization_user where vEmail IN ($vl)"; 	// $cndt
	$usr_exist = $dbobj->MySqlSelect($sql);
} else {
	$usr_exist = array();
}

if($tbl != PRJ_DB_PREFIX."_organization_master") {
	$sql = "select iOrganizationID, vEmail from ".PRJ_DB_PREFIX."_organization_master where vEmail IN ($vl)";
	$or_exist = $dbobj->MySqlSelect($sql);
} else {
	$or_exist = array();
}

if($tbl != PRJ_DB_PREFIX."_security_manager") {
	$sql = "select iSMID, vEmail from ".PRJ_DB_PREFIX."_security_manager where vEmail IN ($vl)";
	$sm_exist = $dbobj->MySqlSelect($sql);
} else {
	$sm_exist = array();
}

if($tbl != PRJ_DB_PREFIX."_administrator") {
	$sql = "select iAdminId, vEmail from ".PRJ_DB_PREFIX."_administrator where vEmail IN ($vl)";
	$adm_exist = $dbobj->MySqlSelect($sql);
} else {
	$adm_exist = array();
}

if(count($adm_exist)>0 || count($sm_exist)>0 || count($or_exist)>0 || count($usr_exist)>0 || count($dt_exist)>0)
{
	$rslt = 'dup';
} else {
	$rslt = 'nodup';
}

echo $rslt;
exit;

// prints($_GET);exit;
/*
$val = GetVar('val');
$field = GetVar('field');
$Data = GetVar('Data');
$id = GetVar('id');
$table = GetVar('table');
$extfld = GetVar('extfld');
$extval = GetVar('extval');
*/

/*if($field == 'vEmail')
{
     echo "true";
     exit;
}
*/

/*
if(! is_array($Data)){
	$Data[$field] = $_GET[$field][0];
}
$Data[$field] = trim($Data[$field]);
// prints($_GET); exit;
if(trim($extfld)!='' && trim($extval)!='') {
	$cndt = " AND $extfld=trim($extval)";
}
$valid = 'true';
if($val != '' && $val != 'undefined') {
     if($Data[$field]!= '') {
           $sql = "select $id,$field as field from $table where $field='".$Data[$field]."' $cndt";
           // echo $sql;exit;
           $db_exist = $dbobj->MySqlSelect($sql);
           // prints($db_exist);exit;
     }
    if($db_exist[0][$id] == $val || count($db_exist)==0) {
            $valid = 'true';
    } else {
            $valid = 'false';
    }
} else {
     if($Data[$field]!= '') {
          $sql = "select $id,$field as field from $table where $field='".$Data[$field]."' $cndt";
          //echo $sql;exit;
          $db_exist = $dbobj->MySqlSelect($sql);
     }
      // prints($db_exist);exit;
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
			if($usr_exist[0]['id'] == $val && $usr_exist[0]['iId'] == $id) {
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
*/
?>