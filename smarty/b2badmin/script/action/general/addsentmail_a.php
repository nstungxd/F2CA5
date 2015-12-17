<?php  
$view 		= PostVar("view");
$iMsgID 	= PostVar("iMsgID");
$chkCount 	= PostVar("chkCount");
//echo "<pre>";
//print_r($_POST);exit;
if($view == "delete"){
	for($i=0;$i<$_POST['no'];$i++)
 	{
		if($_POST["ch".$i])
		{
			$iId=$_POST["ch".$i];
			$id = $dbobj->MySQLDelete("".PRJ_DB_PREFIX."_admin_message_alert"," iMsgID = '".$iId."'");
		}
	}
	if($id)$var_msg = $chkCount." conversation has been deleted.";else $var_msg="Error - in Delete.";
}
header("Location:index.php?file=ge-sentmails&view=edit&AX=Yes&var_msg=$var_msg");
exit;
?>