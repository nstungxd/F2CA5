<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
$id = GetVar('id');
$msg = GetVar('msg');
//echo SITE_CLASS_APPLICATION;exit;
if(!isset($bidobj)) {
	include_once(SITE_CLASS_APPLICATION."user/"."class.Rfq2Bids.php");
	$bidobj = new Rfq2Bids();
}
$bidarr = $bidobj->getviewbidhistory($id,$curORGID);
//prints($bidarr);exit;
$smarty->assign('bidarr',$bidarr);
$smarty->assign('iRFQ2Id',$id);
?>
