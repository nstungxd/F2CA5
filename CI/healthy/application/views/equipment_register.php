<!-- CONTENT -->
<div id="content" class="ninecol last">
<?php if (!isset($equipment)): ?>
    <?php echo form_open_multipart('/admin/cequipment/register_equipment', array('id'=>'frmSave'));?>
<?php else: ?>
    <?php echo form_open_multipart('/admin/cequipment/modify_equipment', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="centercode">Center<span class="regdot"></span></label></td>
                            <td>
                                <select id="centercode" name="centercode" class="" required="required">
                                    <option value="" selected>Please select</option>
                                <?php foreach ($centers as $center): ?>
                                    <option value="<?php echo $center->CenterCode ?>"><?php echo $center->CenterNm ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="exseq">Exercise<span class="regdot"></span></label></td>
                            <td>
                                <select id="exseq" name="exseq" class="" required="required">
                                    <option value="" selected>Please select</option>
                                <?php foreach ($exercises as $exercise): ?>
                                    <option value="<?php echo $exercise->Seq ?>"><?php echo $exercise->Name ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="eqname">Name</label></td>
                            <td><input class="medium" id="eqname" name="eqname" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="eqnum">Equipment Number</label></td>
                            <td><input class="medium" id="eqnum" name="eqnum" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="nfc">NFC Code<span class="regdot"></span></label></td>
                            <td><input class="medium" id="nfc" name="nfc" required="required" placeholder=""></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="seq" name="seq" value="">
                <input type="hidden" id="page" name="page" value="<?php echo $page ?>">
            </div>
        </div>
<?php echo form_close(); ?>
        <div class="panel">
            <div class="title no-border">
                <div class="headline first" style="float:right">
                    <input type="button" class="button-green" onclick="onRegister();" style="cursor: pointer; width: 100px;" value="Save" />
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    var cpage = "<?php echo $page ?>";

    function onRegister()
    {
        if ($("#centercode").val() == "") {
            alert("Please select center code.");
            $("#centercode").focus();
            return;
        }

        if ($("#exseq").val() == "") {
            alert("Please select exercise.");
            $("#exseq").focus();
            return;
        }

        if ($("#nfc").val() == "") {
            alert("Please enter NFC code.");
            $("#nfc").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {
            formSubmit();
        }
    }

    function formSubmit()
    {
        $("#centercode").prop("disabled", false);
        $("#frmSave").submit();
    }

</script>

<script type='text/javascript'>
    $(document).ready(function() {
<?php if (isset($equipment)): ?>
        $("#seq").val('<?php echo $equipment->Seq ?>');
        $("#centercode").val('<?php echo $equipment->CenterCode ?>');
        $("#eqname").val('<?php echo $equipment->EqName ?>');
        $("#exseq").val('<?php echo $equipment->ExerciseSeq ?>');
        $("#nfc").val('<?php echo $equipment->NFCCode ?>');
        $("#eqnum").val('<?php echo $equipment->EqNum ?>');
<?php endif; ?>
<?php if (perm_is_center($permission)): ?>
        $("#centercode").val('<?php echo $centercode ?>');
        $("#centercode").prop("disabled", true);
<?php endif; ?>
    }); 
</script>
