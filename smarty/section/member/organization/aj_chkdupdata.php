<?php
include(S_SECTIONS."/member/memberaccess.php");

// pr($_GET); exit;
$val = GetVar('val');
$field = GetVar('field');
$Data = GetVar('Data');
$id = GetVar('id');
$country = GetVar('country');
$orgtype = GetVar('orgtype');
$chkf = GetVar('chkf');
$chkfvl = GetVar('chkfvl');
$extc = GetVar('extc');
$chkfo = GetVar('chkfo');
$chkfvlo = GetVar('chkfvlo');
//$ownerid = GetVar('ownerid');
//$ownerfield = GetVar('ownerfield');
$table = GetVar('table');

if($field == 'vEmail') {
   echo "true";
   exit;
}
$extcndt = "";
if($field=='vCompanyRegNo' && $table==PRJ_DB_PREFIX.'_organization_master') {
	if(trim($country)!='') {
		$extcndt = " AND BINARY vCountry LIKE '$country' ";
	}
	if(trim($orgtype)!='') {
		$extcndt .= " AND eOrganizationType = '$orgtype' ";
	}
}
if(trim($chkf)!='' && trim($chkfvl)!='') {
   $extcndt .= " AND $chkf='$chkfvl' ";
}
if(trim($chkfo)!='' && trim($chkfvlo)!='') {
   $extcndt .= " AND $chkfo='$chkfvlo' ";
}
if(trim($extc)!='') {
	$extcndt .= trim(stripcslashes($extc));
}
//prints($Data); exit;
$valid = 'true';
$Data[$field] = trim($Data[$field]);
if($val != '' && $val != 'undefined') {
	if($Data[$field]!= '') {
		$sql = "select $id,$field as field from $table where $field='".$Data[$field]."' $extcndt";
		// echo $sql;exit;
		$db_exist = $dbobj->MySqlSelect($sql);
		//prints($db_exist);exit;
   } else if(isset($_GET[$field]) && trim($_GET[$field])!='') {
		$sql = "select $id,$field as field from $table where $field='".trim($_GET[$field])."' $extcndt";
		// echo $sql; exit;
		$db_exist = $dbobj->MySqlSelect($sql);
	}
	/*if($field == 'vCompanyRegNo') {
		if(count($db_exist)<2 || (count($db_exist)==2 && ($db_exist[0][$id]==$val || $db_exist[1][$id]==$val))) {
			$valid = 'true';
		} else {
			$valid = 'false';
		}
	} else {*/
		if((isset($db_exist[0][$id]) && $db_exist[0][$id] == $val && count($db_exist)==1) || count($db_exist)==0) {
			$valid = 'true';
		} else {
			$valid = 'false';
		}
	//}
} else {
	// pr($_GET); exit;
   if($Data[$field]!= '') {
		$sql = "select $id,$field as field from $table where $field='".$Data[$field]."' $extcndt";
		// echo $sql;exit;
		$db_exist = $dbobj->MySqlSelect($sql);
   } else if(isset($_GET[$field]) && trim($_GET[$field])!='') {
		$sql = "select $id,$field as field from $table where $field='".trim($_GET[$field])."' $extcndt";
		// echo $sql; exit;
		$db_exist = $dbobj->MySqlSelect($sql);
	}
   //prints($db_exist);exit;
	/*if($field == 'vCompanyRegNo') {
		if(count($db_exist)<2) {
			$valid = 'true';
		} else {
			$valid = 'false';
		}
	} else {*/
		if(count($db_exist) > 0) {
			$valid = 'false';
		} else {
			$valid = 'true';
		}
	//}
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
			if($org_exist[0]['id'] == $val && $org_exist[0]['iId'] == $id) {
				$valid = 'true';
			} else {
				$valid = 'false';
			}
		} else {
			$valid = 'false';
		}
	}
}
// echo $sql;
echo $valid;
exit;
?>