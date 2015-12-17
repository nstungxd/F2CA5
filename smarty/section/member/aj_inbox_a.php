<?php  
include(S_SECTIONS."/member/memberaccess.php");

if(!isset($inboxDelObj)){
	include_once(SITE_CLASS_APPLICATION."class.UserDeletedInbox.php");
	$inboxDelObj = new UserDeletedInbox();
}
$val = $_POST['val'];
//Prints($_SESSION['SESS_B2B_USER_TYPE_SHORT']);exit;
$eUserType = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
$iUserId =$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];

if($val != ''){
   $valArr = @explode(',',$val);
   foreach($valArr as $key=>$value){
		$dmdtl = $inboxDelObj->getDetails('*'," AND iInboxId=$value AND eUserType='$eUserType' AND iUserId=$iUserId ");
		if(is_array($dmdtl) && count($dmdtl)>0) {
				$Data = array('eViewed' => 'No');
				// $inboxDelObj->setAllVar($Data);
				// $vrfres = $inboxDelObj->insert();
				$vrfres = $inboxDelObj->updateData($Data," iDelInboxId=".$dmdtl[0]['iDelInboxId']." ");
		} else {
				$Data = array(
                     'iUserId'   => $iUserId,
                     'eUserType' => $eUserType,
                     'iInboxId'  => $value,
							'eViewed' 	=> 'No'
                     );
				$inboxDelObj->setAllVar($Data);
				$vrfres = $inboxDelObj->insert();
		}
   }
   if($vrfres){
      $msg= $smarty->get_template_vars('MSG_INBOX_MSG_DELETED_SUCC');;
   }else{
      $msg= $smarty->get_template_vars('MSG_INBOX_MSG_DELETE_ERROR');;
   }
}
echo ($msg);exit;
?>