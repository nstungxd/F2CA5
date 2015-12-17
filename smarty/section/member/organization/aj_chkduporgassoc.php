<?php

include(S_SECTIONS."/member/memberaccess.php");

//prints($_GET);exit;
$val = GetVar('val');
$field = GetVar('field');
$Data = GetVar('Data');
$id = GetVar('id');
//$ownerid = GetVar('ownerid');
//$ownerfield = GetVar('ownerfield');
$table = GetVar('table');
//prints($Data); exit;
$valid = 'true';
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

echo $valid;
exit;
?>
