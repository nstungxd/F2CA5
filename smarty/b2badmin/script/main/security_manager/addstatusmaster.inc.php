<?php  
/**
 * Add/Update File For Language Label
 *
 * @package		addlanguagelebel.inc.php
 * @section		main/general
 * @author		Snehasis Mohapatra
*/

if(!isset($stMstrObj)) {
    include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
    $stMstrObj =	new StatusMaster();
}
$gdbobj->getRequestVars();

$view  = GetVar("view");
$iStatusID = GetVar("iStatusID");
$actionfile  = GetVar("file");

if(count($_POST) > 0) {
          $arr = Array();
          $arr[0] = $_POST;
} else {
     if($view == 'edit') {
          $arr = $stMstrObj->getDetails("*","AND iStatusID = '$iStatusID'");
          $db_order = $stMstrObj->getDetails("count(*)","");
          $order = $db_order[0]['count(*)'];
          //prints($arr);exit;
     } else {
          $view = "add";
          $db_order = $stMstrObj->getDetails("count(*)","");
          $order = $db_order[0]['count(*)'] + 1;
          //prints($order);exit;
     }
}
$lang= $gdbobj->getLanguage();
?>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $actionfile?>&view=action" method="post" enctype="multipart/form-data">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iStatusID","iStatusID",$iStatusID,"Hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="49%" valign="top"><span class="reqmsg" style="float:right;"><?php   if($arr[0]['var_msg'] != '') { echo "Status is already exists"; } ?></span>
		<table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
		<tr>
			<td class="heading">Status Information</td>
		</tr>
		<tr>
			<td valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				<tr>
					<td width="25%" height="22" align="right" class="td-bg" valign="top">&nbsp;For</td>
					<td width="25%" class="white-bg" valign="top">
                              <?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_status_master", "eFor", "Data[eFor]", "eFor", "", "".$arr[0]['eFor']."","tabIndex=1")?>
					</td>
					<td height="22" align="right" class="td-bg">Status</td>
					<td class="white-bg">
						<?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_status_master", "eStatus", "Data[eStatus]", "eStatus", "", "".$arr[0]['eStatus']."","tabIndex=2")?>
					</td>
				</tr>
				<?php  for($i=0;$i<count($lang);$i++){
				$vStatus= "'vStatus_".$lang[0]['vLanguageCode']."',";
				?>
				<?php  if($i % 2 == 0) {?>
				<tr>
				<?php   }?>
					<td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Status <b>[<?php  echo  $lang[$i]['vLanguage']?>]</b></td>
					<td width="25%" class="white-bg">
						<?php  echo $generalobj->PrintElement("Data[vStatus_".$lang[$i]['vLanguageCode']."]","vStatus_".$lang[$i]['vLanguageCode']."",$arr[0]['vStatus_'.$lang[$i]['vLanguageCode']],"text","Enter Status in ".$lang[$i]['vLanguage'].""," class='required' tabIndex=3","Enter Status in ".$lang[$i]['vLanguage']."");?>
					</td>
				<?php  if($i % 2 == 1) {?>
				</tr>
				<?php   }?>
				<?php   }?>
                    <?php  for($i=0;$i<count($lang);$i++){
				$vStatusMsg= "'vStatusMsg_".$lang[0]['vLanguageCode']."',";
				?>
				<?php  if($i % 2 == 0) {?>
				<tr>
				<?php   }?>
					<td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Status Message <b>[<?php  echo  $lang[$i]['vLanguage']?>]</b></td>
					<td width="25%" class="white-bg">
						<?php  echo $generalobj->PrintElement("Data[vStatusMsg_".$lang[$i]['vLanguageCode']."]","vStatusMsg_".$lang[$i]['vLanguageCode']."",$arr[0]['vStatusMsg_'.$lang[$i]['vLanguageCode']],"text","Enter Status Message in ".$lang[$i]['vLanguage'].""," class='required' tabIndex=3","Enter Status Message in ".$lang[$i]['vLanguage']."");?>
					</td>
				<?php  if($i % 2 == 1) {?>
				</tr>
				<?php   }?>
				<?php   }?>
                    <tr>
                         <td height="22" class="td-bg" align="right" valign="top"><font class="reqmsg">*</font>&nbsp;<label for="display">Display Order</label></td>
                         <td class="white-bg">
                               <select name ="Data[iDisplayOrder]" id="iDisplayOrder" class="required" tabindex="4">
                             <option value=""> --- Select Display Order --- </option>
                           <?php   for($i=1;$i<=$order;$i++) { ?>
                              <option value="<?php  echo  $i?>" <?php if($arr[0]['iDisplayOrder'] == $i){?> selected <?php  }?> ><?php  echo  $i?></option>
                           <?php   } ?>
                        </select>
                         </td>
                         <td class="td-bg">&nbsp;</td>
                         <td class="white-bg">&nbsp;</td>
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
		<input type="Image" style="cursor:pointer" alt="btnSave"  id="btnSave" name="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex=6>
		<input type="Image" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="resetform();return false;" tabIndex=7>
		<img style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=<?php  echo  $actionfile?>&view=index&AX=Yes');" tabIndex=8 onblur="$('#eFor').focus();">
	</td>
</tr>
</table>
</form>
<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript">
$('#frmadd').validate( {
         rules: {
          "Data[vStatus_<?php  echo  $lang[$i]['vLanguageCode']?>]": {
               required: true
          }
     },
     messages: {
          "Data[vStatus_<?php  echo  $lang[$i]['vLanguageCode']?>]": {
               required: 'Enter Status Name for <?php  echo  $lang[$i]['vLanguage']?>'
               },
          "Data[iDisplayOrder]": {
               required: 'Select Display Order'
          }
     }
});
/*new Validator({
        formId: 'frmadd',
	  	  btnId:'btnSave',
        isRequired: ['eFor',<?php  echo  substr($vStatus,0,-1);?>],
		  isDuplicate:['eFor','eFor','<?php  echo  PRJ_DB_PREFIX?>_status_master','iStatusID']
	});*/
function resetform(){
$('#frmadd')[0].reset();
}
</script>