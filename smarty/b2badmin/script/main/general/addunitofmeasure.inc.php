<?php
/**
 * Add/Update File For Security Manager
 * @package		addsecuritymanager.inc.php
 * @Section		security_manager
 */
if (!isset($unitofmeasureObj)) {
    include_once(SITE_CLASS_APPLICATION . 'class.UnitOfMeasure.php');
    $unitofmeasureObj = new UnitOfMeasure();
}
$gdbobj->getRequestVars();
$view = GetVar("view");
$iUnitId = GetVar("iUnitId");
$file = GetVar("file");
$arr = Array();

if (count($_POST) > 0) {
    $arr[0] = $_POST;
} else {
    if ($view == 'edit') {
        $arr = $unitofmeasureObj->select($iUnitId);
        // prints($arr); exit;
    } else {
        $view = "add";
    }
}
$arr[0]['eStatus'] = (isset($arr[0]['eStatus'])) ? $arr[0]['eStatus'] : 'Active';
?>
<form name="frmadd" id="frmadd" action="index.php?file=<?php echo $file ?>&view=action" method="post">
    <?php echo $generalobj->PrintElement("view", "view", $view, "Hidden"); ?>
    <?php echo $generalobj->PrintElement("iUnitId", "iUnitId", $iUnitId, "Hidden"); ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td  valign="top"><span class="reqmsg" style="float:right;"><?php if (isset($arr[0]['var_msg'])) {
        if ($arr[0]['var_msg'] != '') {
            echo "Record already exists";
        }
    } ?></span>
                <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="heading">Unit Information</td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td height="22" width="25%" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Unit Name</td>
                                    <td  class="white-bg" width="25%" valign="top" style="padding:1px;">
                                        <input type="text" id="vUnitOfMeasure" name="Data[vUnitOfMeasure]" value="<?php echo $arr[0]['vUnitOfMeasure']; ?>" title="Enter Unit Name" class='required' />
                                    </td>
                                    <td height="22"  align="right" class="td-bg" valign="top">&nbsp;Description</td>
                                    <td class="white-bg" >
                                        <textarea name="Data[tDescription]" id="tDescription" title="Enter Description" class='' style="height:59px; width:230px;" ><?php echo (isset($arr[0]['tDescription']) && $arr[0]['tDescription'] != '') ? stripslashes($arr[0]['tDescription']) : ''; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="22" align="right" class="td-bg">Status</td>
                                    <td class="white-bg" >
                                        <?php echo $gdbobj->getEnumSelect("" . PRJ_DB_PREFIX . "_rptreports", "eStatus", "Data[eStatus]", "eStatus", "", "" . $arr[0]['eStatus'] . "", " "); ?>
                                    </td>
                                    <td height="22" class="td-bg" align="right" ><font class="reqmsg"></font>&nbsp;<?php if($view == 'edit') { ?>Added Date<?php } ?></td>
                                    <td class="white-bg">&nbsp;<?php if($view == 'edit') { ?><?php echo date('d/m/Y', strtotime($arr[0]['dADate'])); ?><?php } ?></td>
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
                <img alt="Reset" title="Reset" style="cursor:pointer" src="<?php echo ADMIN_IMAGES ?>btn-reset.gif" onclick="resetform();return false;" tabIndex="18" />
                <img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php echo ADMIN_IMAGES ?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=ge-unitofmeasure&view=index&AX=Yes');" tabIndex="19" onblur="$('#vUnitOfMeasure').focus();" />
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
        rules: {
            "Data[vUnitOfMeasure]": {
                remote: {
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data: {
                        val:function() {
                           return $("#iUnitId").val();
                        },
                        id:function() {
                           return "iUnitId";
                        },
                        field:function() {
                           return "vUnitOfMeasure";
                        },
                        table:function() {
                           return "<?php echo PRJ_DB_PREFIX; ?>_unitofmeasure";
                        }
                    }
                }
            }
        },
        messages: {
            "Data[vUnitOfMeasure]": {
                required: 'Enter Unit Name',
                remote: jQuery.validator.format("This unit already exists.")
            }
        }
    });
</script>