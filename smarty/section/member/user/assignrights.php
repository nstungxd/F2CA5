<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include(S_SECTIONS."/member/memberaccess.php");

if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
     $orgname = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGNAME'];
}
### CREATE SERVER SIDE VALIDATION MESSAGE ###
$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] : '';
if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '') {
   include(SITE_CLASS_GEN."class.validation.php");
   $validation=new Validation();
    $msg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
    unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);


}

$orgdata[0] = (isset($_SESSION['Data']))? $_SESSION['Data'] : '';
unset($_SESSION['Data']);
$usertype=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'];
$orgid=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID'];
//print "<hr>"."<hr>";
//print_r($orgdata);
#### ENDS HERE ###         

$msg = (isset($msg))? $msg : '';
$orgname = (isset($orgname))? $orgname : '';
$smarty->assign('msg',$msg);
$smarty->assign('orgname',$orgname);
$smarty->assign('orgdata',$orgdata);   
$smarty->assign('usertype',$usertype);
$smarty->assign('orgid',$orgid);
?>
