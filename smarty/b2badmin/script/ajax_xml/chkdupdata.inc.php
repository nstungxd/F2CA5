<?php

//prints($_GET);exit;
// prints($_POST);exit;
$val = (isset($_REQUEST['val']))? $_REQUEST['val'] : '';
$field = $_REQUEST['field'];
$Data = (isset($_REQUEST['Data']))? $_REQUEST['Data'] : '';
$id = $_REQUEST['id'];
$table = $_REQUEST['table'];
$vl = (isset($_REQUEST[$field]))? $_REQUEST[$field] : '';
if ($Data == '') {
     $Data[$field] = $_REQUEST[$field];
}
//prints ($Data);
$valid = 'true';
if ($field == 'vEmail' && trim($vl)!='') {
   $cndt = '';
     if ($table != PRJ_DB_PREFIX . "_organization_user") {
          $sql = "select iUserID, vEmail from " . PRJ_DB_PREFIX . "_organization_user where vEmail IN ('$vl') $cndt ";  // $cndt
          $usr_exist = $dbobj->MySqlSelect($sql);
     } else {
          $usr_exist = array();
     }

     if ($table != PRJ_DB_PREFIX . "_organization_master") {
          $sql = "select iOrganizationID, vEmail from " . PRJ_DB_PREFIX . "_organization_master where vEmail IN ('$vl') $cndt ";
          $or_exist = $dbobj->MySqlSelect($sql);
     } else {
          $or_exist = array();
     }

     if ($table != PRJ_DB_PREFIX . "_security_manager") {
          $sql = "select iSMID, vEmail from " . PRJ_DB_PREFIX . "_security_manager where vEmail IN ('$vl') $cndt ";
          $sm_exist = $dbobj->MySqlSelect($sql);
     } else {
          $sm_exist = array();
     }

     if ($table != PRJ_DB_PREFIX . "_bank_master") {
          $sql = "select iSMID, vEmail from " . PRJ_DB_PREFIX . "_bank_master where vEmail IN ('$vl') $cndt ";
          $bm_exist = $dbobj->MySqlSelect($sql);
     } else {
          $bm_exist = array();
     }

     if ($table != PRJ_DB_PREFIX . "_administrator") {
          $sql = "select iAdminId, vEmail from " . PRJ_DB_PREFIX . "_administrator where vEmail IN ('$vl')";
          $adm_exist = $dbobj->MySqlSelect($sql);
     } else {
          $adm_exist = array();
     }

   // prints($_POST); exit;
	 if(isset($_POST[$id]) && $_POST[$id]>0) {
		$iid = $_POST[$id];
		// $cndt .= " AND iUserID!='".$_POST[$id]."'";
      $cndt .= " AND $id!='".$_POST[$id]."'";
	}
	 $sql = "select $iid, $id, vEmail from $table where vEmail IN ('$vl') $cndt ";
    // echo $sql; exit;
    $dt_exist = $dbobj->MySqlSelect($sql);
	 if(!is_array($dt_exist)) {
      $dt_exist = array();
    }
	  // prints($adm_exist); exit;
     if (count($adm_exist) > 0 || count($sm_exist) > 0 || count($or_exist) > 0 || count($usr_exist) > 0 || count($bm_exist)>0 || count($dt_exist) > 0) {
          echo 'dup';
          exit;
     }
}
if ($val != '') {
     if ($Data[$field] != '') {
          $sql = "select $id, $field as field from $table where $field='" . $Data[$field] . "'";
          //echo $sql;exit;
          $db_exist = $dbobj->MySqlSelect($sql);
          //prints($db_exist);exit;
     }
     if ($db_exist[0][$id] == $val || count($db_exist) == 0) {
          $valid = 'true';
     } else {
          $valid = 'false';
     }
} else {
     if ($Data[$field] != '') {
          $sql = "select $id, $field as field from $table where $field='" . $Data[$field] . "'";
          //echo $sql;exit;
          $db_exist = $dbobj->MySqlSelect($sql);
     }
     //prints($db_exist);exit;
     if (count($db_exist) > 0) {
          $valid = 'false';
     } else {
          $valid = 'true';
     }
}

echo $valid;
//exit;
?>
