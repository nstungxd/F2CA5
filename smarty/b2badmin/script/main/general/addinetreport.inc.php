<?php
/**
 * Add/Update File For Security Manager
 * @package		addsecuritymanager.inc.php
 * @Section		security_manager
*/
if(!isset($rptreportObj)) {
  include_once(SITE_CLASS_APPLICATION.'class.RPTReports.php');
  $rptreportObj = new RPTReports();
}
$gdbobj->getRequestVars();
$view = GetVar("view");
$iReportId = GetVar("iReportId");
$file = GetVar("file");
$arr = Array();

if(count($_POST) > 0) {
	$arr[0] = $_POST;
} else {
	if($view == 'edit') {
		$arr = $rptreportObj->select($iReportId);
		// prints($arr); exit;
   } else {
		$view = "add";
   }
}
$arr[0]['eType'] = (isset($arr[0]['eType']))? $arr[0]['eType'] : '';
$arr[0]['eStatus'] = (isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : 'Active';
?>
<form name="frmadd" id="frmadd" action="index.php?file=<?php echo $file?>&view=action" method="post">
<?php echo $generalobj->PrintElement("view","view",$view,"Hidden"); ?>
<?php echo $generalobj->PrintElement("iReportId","iReportId",$iReportId,"Hidden"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
   <td  valign="top"><span class="reqmsg" style="float:right;"><?php  if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') { echo "Report is already exists"; } } ?></span>
      <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
         <tr>
            <td class="heading">Report Information</td>
         </tr>
         <tr>
            <td valign="top">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                     <td height="22" width="25%" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Report Name</td>
							<td  class="white-bg" width="25%">
                        <input type="text" id="vReportName" name="Data[vReportName]" value="<?php echo $arr[0]['vReportName']; ?>" title="Enter Report Name" class='required' />
							</td>
							<td height="22" width="25%" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;For User Of Type</td>
							<td class="white-bg" width="25%">
								<?php echo $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_rptreports", "eType","Data[eType]", "eType", "", $arr[0]['eType'], " class='required' title='Select User Type' ", "","--- Select ---", array()); ?>
							</td>
                  </tr>
                  <tr>
                     <td height="22"  align="right" class="td-bg" valign="top">&nbsp;Description</td>
                     <td class="white-bg" >
                        <textarea name="Data[tDescription]" id="tDescription" title="Enter Description" class='' style="height:59px; width:230px;" ><?php echo (isset($arr[0]['tDescription']) && $arr[0]['tDescription']!='')? stripslashes($arr[0]['tDescription']) : '';?></textarea>
                     </td>
							<td height="22" align="right" class="td-bg" >&nbsp;Parameters</td>
							<td class="white-bg">
								<textarea name="Data[tParameters]" id="tParameters" title="Enter Parameters" class='' onkeypress='// return chkValidUserName(event);' style="height:59px; width:230px;" ><?php echo (isset($arr[0]['tParameters']) && $arr[0]['tParameters']!='')? stripslashes($arr[0]['tParameters']) : '';?></textarea>
							</td>
                  </tr>
                  <tr>
							<td height="22" class="td-bg" align="right" valign="top"><font class="reqmsg">*</font>&nbsp;Path</td>
							<td class="white-bg">
                        <input type="text" name="Data[tPath]" id="tPath" class="required" value="<?php echo $arr[0]['tPath']?>" title='Enter Path' onkeypress='//return chkValidUserName(event);' style="width:210px;" />
							</td>
							<td height="22" align="right" class="td-bg">Status</td>
							<td class="white-bg" >
								<?php echo $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_rptreports", "eStatus","Data[eStatus]", "eStatus","", "".$arr[0]['eStatus'].""," "); ?>
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
	<!-- onclick="checkvalid(this.form);return false;" -->
		<input type="hidden" name="dpr" id="dpr" value="nod" />
		<input type="image"  id="btnSave" alt="Save" title="Save" style="cursor:pointer" onclick="return submitFrm();" src="<?php echo ADMIN_IMAGES; ?>btn-save.gif" tabIndex="17" />
      <img alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="resetform();return false;" tabIndex="18" />
      <img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=ge-inetreport&view=index&AX=Yes');" tabIndex="19" onblur="$('#vFirstName').focus();" />
   </td>
</tr>
</table>
</form>
<script type="text/javascript" src="<?php echo S_JQUERY; ?>jquery.validate.js"></script>
<script type="text/javascript">
function resetform() {
   $('#frmadd')[0].reset();
}
function submitFrm() {
	var vldfrm = $('#frmadd').valid();
	if(!vldfrm) { return false; }
	$('#frmadd')[0].submit();
}
$("#frmadd").validate({
	rules:{ },
   messages:{ }
});
</script>