<?php

/*include(S_SECTIONS."/member/memberaccess.php");

$handle = fopen("file.csv", 'r');

while(($data = fgetcsv($handle, 1000, ",")) !== false){
   $Data[]= $data;
}
fclose($handle);
//Prints($Data);exit;
exit;
*/

if(!($doimportinv=='Yes' && $invCreate=='Yes')) {
	if($sess_usertype_short == 'SM') {
		header('Location: '.SITE_URL_DUM."smdashboard");
		exit;
	} else {
		header('Location: '.SITE_URL_DUM."invoicelist/all");
		exit;
	}
}

$msg = $_GET['msg'];

if($msg == 'invimportsucc') {
	$msg = $smarty->get_template_vars('LBL_INV_IMPORT_SUCC');
} else if($msg == 'invimporterr') {
	$msg = $smarty->get_template_vars('LBL_INV_IMPORT_ERR');
} else { $msg=''; }
$ml = "n";
$arr_loaded_ext = get_loaded_extensions();
if(in_array('mcrypt',$arr_loaded_ext)){
	$ml = "y";
}
$smarty->assign('ml',$ml);
$smarty->assign('msg',$msg);
?>