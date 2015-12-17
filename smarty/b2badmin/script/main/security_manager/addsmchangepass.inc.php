<?php  
/**
 * Add/Update File For Admin change password
 *
 * @package		addadminchangepassword.inc.php
 * @Section		general
 * @author		Andrew Dev
*/

if(SessionVar(''.PRJ_CONST_PREFIX.'_SESS_A_ROLE') != 'Premier Admin') {
   if($iAdminId != SessionVar(''.PRJ_CONST_PREFIX.'_SESS_USERID')) {
      header("Location:index.php?file=ge-noaccess&view=add&AX=Yes");
      exit;
   }
}

if(!isset($secManObj)) {
  include_once(SITE_CLASS_APPLICATION.'securitymanager/class.SecurityManager.php');
  $secManObj = new SecurityManager();
}
$gdbobj->getRequestVars();

$view  = GetVar("view");
$iSMID = GetVar("iSMID");
$validation ="'vPassword','vconfirmPass'";
$arr = $secManObj->select($iSMID);
//echo $arr[0]['vEmail'];exit;
//prints($arr);exit;
//$adminarr = $adminUserObj->select($arr[0]['vEmail']);
?>

<form name="frmadd" id="frmadd" action="index.php?file=se-smchangepass&view=action" method="post" enctype="multipart/form-data">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iSMID","iSMID",$iSMID,"Hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<?php  if(GetVar('var_msg') !='') { ?>
<tr>
   <td height="35" align="center" >
      <div style="width:100%; float: left;">
         <ul id="top-tabstrips" style="margin:0; padding:0; width:250px;">
            <li><em><?php print GetVar('var_msg');?></em></li>
         </ul>
      </div>
   </td>
</tr>
<?php   } ?>
<?php  if($view == 'edit') { ?>
<tr>
   <td>
      <?php  include_once("addsmtop.inc.php")?>
   </td>
</tr>
<?php  }?>
<tr>
   <td width="49%" valign="top">
      <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
         <tr>
            <td class="heading">Reset Password</td>
         </tr>
         <tr>
         <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="22" width="50%" align="right" class="td-bg"><font class="reqmsg"></font></td>
                  <td class="white-bg" colspan="3">
                    <input type="hidden" name="vEmail" value="<?php  echo  $arr[0]['vEmail']?>" />
                    <input type="hidden" name="vFirstName" value="<?php  echo  $arr[0]['vFirstName']?>" />
                    <input type="hidden" name="vLastName" value="<?php  echo  $arr[0]['vLastName']?>" />
                  </td>
               </tr>
                <tr>
                  <td height="22" width="50%" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;New Password</td>
                  <td class="white-bg" colspan="3">
                     <?php  echo $generalobj->PrintElement("vPassword","vPassword","","password","Enter new password.","onkeypress='return chkSpace(event);' class='required' minlength='5' style=width:210px tabIndex=1 Maxlength=10;");?>
                  </td>
               </tr>
               <tr>
                  <td class="td-bg">&nbsp;</td>
                  <td height="22"  colspan="3"  class="white-bg"><font class="reqmsg">(Password length should be atleast 5.)</font></td>
               </tr>
               <tr>
                  <td height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Confirm Password</td>
                  <td class="white-bg" colspan="3">
                     <?php  echo $generalobj->PrintElement("vConPassword","vConPassword","","password","Enter Confirm Password.","onkeypress='return chkSpace(event);' onkeydown='return noCTRL(event);' oncontextmenu='return false;' style=width:210px equalTo='#vPassword' tabIndex=2 Maxlength=10;");?>
                  </td>
               </tr>
            </table>
         </td>
         </tr>
      </table>
   </td>
</tr>
<tr>
   <td valign="top">&nbsp;</td>
</tr>
<tr>
	<td valign="top" align="center">
		<input type="Image" alt="Save" title="Save" id="btnSave" name="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex=3>
		<input type="image" alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="reset();return false;" tabIndex=4>
		<img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=se-securitymanager&view=index&AX=Yes');" tabIndex="5" onblur="$('#vPassword').focus();">
	</td>
</tr>
</table>
</form>

<script language="JavaScript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript">
function resetform() {
	$('#frmadd')[0].reset();
}

$("#frmadd").validate( {
   messages: {
         vPassword: { required: 'Enter Password', minlength: 'Password must be atleast of 5 characters' },
         vConPassword: { equalTo: "Enter same value as 'Password'" }
   }
});
</script>