<?php  
include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgUserObj)) {
  include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
  $orgUserObj = new OrganizationUser();
}

if(!isset($secquesObj)) {
  include_once(SITE_CLASS_APPLICATION."class.SecQuestion.php");
  $secquesObj = new SecQuestion();
}

//prints($_GET);exit;
$num = $_GET['n'];
$iUserId = $_GET['id'];
//prints($iUserId); exit;

if($_POST)
{
	$iUserId = PostVar('iUserId');
	$num = PostVar('qnum');
	$ans = PostVar('answer');
	// $vPassword = $generalobj->encrypt($Data['vPassword']);

	$fld = '';
	if($num == 1) {
		$fld = 'vAnswer';
	} else if($num == 2) {
		$fld = 'vAnwser';
	}

	$where = "iUserId=$iUserId";
	$data = Array($fld=>$ans);
	$id = $dbobj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user",$data,'update',$where);
	// $orgUsrObj->updateData($data,$where);	// $secManObj->changePAssword($iMemberId,$vPassword);

	if($id > 0)
	{
		echo '<br /><h1 align="center"><b>'.$smarty->get_template_vars('LBL_SECANS_CHANGED').'</b></h1>';
?>
		<script type="text/javascript">
			setTimeout("window.parent.jQuery.fn.colorbox.close();",3000);
         //window.parent.sh_el('dv_timesheet');
      </script>
<?php  
	}
	else
	{
		echo '<br /><h1 align="center"><b>'.$smarty->get_template_vars('LBL_PASS_CHANGE_ERR').'</b></h1>';
?>
		<script type="text/javascript">
			setTimeout("window.parent.jQuery.fn.colorbox.close();",3000);
         //window.parent.sh_el('dv_timesheet');
      </script>
<?php  
	}
/*
	$html = '';
	if($Id > 0){
	   $html .= $smarty->get_template_vars('MSG_CHANGE_PASS');
	}else{
	   $html .= $smarty->get_template_vars('MSG_CHANGE_PASS_ERR');
	}

   if($html != '')
	{
?>
		<script type="text/javascript">
			SITE_URL_DUM = '<?php  echo SITE_URL_DUM?>';
         var msg = '<?php echo $html?>';
         redirectdashboard();
         function redirectdashboard()
			{
				window.parent.document.getElementById('alert').innerHTML = msg;
            window.parent.jQuery.fn.colorbox.close();
         }
		</script>
<?php  
	exit();
   }
 */
	exit;
}
$usrdtls = $orgUserObj->select($iUserId);
if($num == 1) {
	$ques = $secquesObj->select($usrdtls[0]['iSecretQuestion1ID']);
} else if($num == 2) {
	$ques = $secquesObj->select($usrdtls[0]['iSecretQuestion2ID']);
}
$lang = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'];
$ques = $ques[0]['vQuestion_'.$lang];

$smarty->assign('num',$num);
$smarty->assign('ques',$ques);
$smarty->assign('iUserId',$iUserId);
?>