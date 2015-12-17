<?php  
/**
 * Add/Update File For language
 * @Created Date :3rd-july-08.
 * @package		addlanguage.inc.php
 * @Section		general
*/

$view  = GetVar("view");
$iLanguageId = GetVar("iLanguageId");
$actionfile  = GetVar("file");
$arr = Array();

if($view == 'edit')
{
	$arr = $gdbobj->getInfoTable("".PRJ_DB_PREFIX."_language","iLanguageId",$iLanguageId);
}
else
{
	$view = "add";                                                          
}

$arr[0]['eStatus'] = (isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : '';
$arr[0]['vLanguage'] = (isset($arr[0]['vLanguage']))? $arr[0]['vLanguage'] : '';
$arr[0]['vLanguageCode'] = (isset($arr[0]['vLanguageCode']))? $arr[0]['vLanguageCode'] : '';
?>
<script language="JavaScript" src="<?php  echo  A_G_VALIDATION_JS?>jvalidator.js"></script>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $actionfile?>&view=action" method="post" enctype="multipart/form-data">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iLanguageId","iLanguageId",$iLanguageId,"Hidden");?>
<?php  echo $generalobj->PrintElement("firstStatus","firstStatus",$arr[0]['eStatus'],"hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="49%" valign="top">
		<table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
		<tr>
			<td class="heading">Country Information</td>
		</tr>
		<tr>
			<td valign="top" colspan="2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="50%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Language</td>
					<td width="50%" class="white-bg"><?php  echo $generalobj->PrintElement("Data[vLanguage]","vLanguage",$arr[0]['vLanguage'],"Text","Enter language"," style=width:220px tabIndex=1");?></td>
				</tr>
				<tr>
					<td  align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Language code</td>
					<td class="white-bg"><?php  echo $generalobj->PrintElement("Data[vLanguageCode]","vLanguageCode",$arr[0]['vLanguageCode'],"Text","Enter language code"," style=width:220px tabIndex=2 Maxlength=3;");?></td>
				</tr>
				<tr>
					<td height="22" align="right" class="td-bg">Status</td>
					<td class="white-bg" colspan="3"><?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_language","eStatus","Data[eStatus]","eStatus","","".$arr[0]['eStatus']."","tabIndex=3")?></td>
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
	<td valign="top" align="center" colspan="2">
		<input type="image" style="cursor:pointer"  alt="Save" title="Save" id="btnSave" name="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex="4">
		<input type="image" alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="reset();return false;" tabIndex="5">
		<img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=<?php  echo  $actionfile?>&view=index&AX=Yes');" tabIndex="6">
	</td>
</tr>
</table>
</form>
<script type="text/javascript">
$('vLanguage').focus();
new Validator({
        formId: 'frmadd',
		btnId:'btnSave',
        isRequired: ['vLanguage','vLanguageCode'],
		isDuplicate:['vLanguage','vLanguage','<?php  echo  PRJ_DB_PREFIX?>_language','iLanguageId']
	});
</script>