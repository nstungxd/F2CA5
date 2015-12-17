<?php
include(S_SECTIONS."/member/memberaccess.php");

//prints($_GET);exit;
$iUserId = $_GET['id'];
$msg = GetVar('msg');
//prints($iUserId); exit;

if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '' ) {
  include(SITE_CLASS_GEN."class.validation.php");
  $validation=new Validation();
   $msg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);

}

if($_POST)
{

        include(SITE_CLASS_GEN."class.validation.php");
         $validation=new Validation();
         $RequiredFiledArr = array(
                                    'vOldPassword'         =>$smarty->get_template_vars('LBL_ENTER_OLD_PASSWORD'),
                                     'vPassword'          =>$smarty->get_template_vars('LBL_ENTER_PASSWORD'),
                                     'vConPassword'          =>$smarty->get_template_vars('LBL_ENTER_CPASSWORD')

             );

	$resArr = $validation->isEmpty($RequiredFiledArr);
  	if($resArr) {
      $_SESSION['Data']=$Data;
      header("Location:".$_SERVER['HTTP_REFERER']."");
		exit;
	}
         //prints($resArr);exit;
             $vPassword['vPassword']=$Data['vPassword'];
             $cPassword['vPassword']=$_POST['vConPassword'];

             $vldmsg=array('vPassword' => $smarty->get_template_vars('MSG_PASS_NOT_EQUEL'));
             $pass = $validation->isEqual($vPassword, $cPassword, $vldmsg);

	 if($pass == 'er') {
             header("Location:".$_SERVER['HTTP_REFERER']."");
		 exit;
	 }




	$iMemberId = PostVar('iUserId');
	$vPassword = $generalobj->encrypt($Data['vPassword']);
	if($sess_usertype == 'securitymanager')
	{
		$where = "iSMID=$iMemberId";
		$data = Array('vPassword'=>$vPassword);
		$id = $dbobj->MySQLQueryPerform(PRJ_DB_PREFIX."_security_manager",$data,'update',$where);
		// $secManObj->updateData($data,$where);	// $secManObj->changePAssword($iMemberId,$vPassword);
	}
	else if($sess_usertype == 'orguser' || $sess_usertype == 'orgadmin')
	{
		$where = "iUserId=$iMemberId";
		$data = Array('vPassword'=>$vPassword);
		$id = $dbobj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user",$data,'update',$where);
		// $orgUsrObj->updateData($data,$where);	// $secManObj->changePAssword($iMemberId,$vPassword);
	}

	if($id > 0)
	{
		echo '<br /><h1 align="center"><b>'.$smarty->get_template_vars('LBL_PASS_CHANGED').'</b></h1>';
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
// $smarty->assign('iUserId',$iUserId);
$smarty->assign('msg',$msg);
?>