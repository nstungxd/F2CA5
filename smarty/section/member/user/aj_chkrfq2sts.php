<?php
if(!isset($rfq2Obj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
	$rfq2Obj = new RFQ2Master();
}
$iRFQ2Id = PostVar('iRFQ2Id');
$rfq2dtls = $rfq2Obj->getB2Rfq2Status($iRFQ2Id);
if($rfq2dtls == 'live') {
?>
<a id="btnSave" name="save" class="btllbl" style="textarea-decoration:none;" onclick="$('#eSaved').val('Yes'); return frmsubmit();" ondblclick="return false;" title="<?php echo $smarty->get_template_vars('LBL_SAVE')?>" ><b><?php echo $smarty->get_template_vars('LBL_SAVE')?></b></a>
<a id="btnSubmit" name="submit" class="btllbl" style="textarea-decoration:none;" onclick="$('#eSaved').val('No'); return frmsubmit();" ondblclick="return false;" title="<?php echo $smarty->get_template_vars('LBL_SUBMIT')?>" ><b><?php echo $smarty->get_template_vars('LBL_SUBMIT')?></b></a>
<a id="btnreset" name="reset" class="btllbl" style="textarea-decoration:none;" onclick="frmreset();" title="<?php echo $smarty->get_template_vars('LBL_RESET')?>" ><b><?php echo $smarty->get_template_vars('LBL_RESET')?></b></a>
<?php } else { echo 'nts';	} exit; ?>