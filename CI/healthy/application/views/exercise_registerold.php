<!-- CONTENT -->
<div id="content" class="ninecol last">
<?php if (!isset($exercise)): ?>
    <?php echo form_open_multipart('/admin/common/register_exercise', array('id'=>'frmSave'));?>
<?php else: ?>
    <?php echo form_open_multipart('/admin/common/modify_exercise', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="exname">Exercise Name<span class="regdot"></span></label></td>
                            <td><input class="medium" id="exname" name="exname" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="extype">Exercise Type<span class="regdot"></span></label></td>
                            <td>
                                <select id="extype" name="extype" class="" required="required">
                                    <option value="">Please select</option>
                                    <option value="1">Running</option>
                                    <option value="2">Bike</option>
                                    <option value="3">Weight</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="kcal">Calory<span class="regdot"></span></label></td>
                            <td>
                                <input class="big" id="kcal" name="kcal" required="required" placeholder="">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="excode">Exercise Target</span></label></td>
                            <td>
                                <select id="excode" name="excode" class="" required="required">
                                    <option value="">Please select</option>
                                <?php foreach ($extarget as $ex): ?>
                                    <option value="<?php echo $ex->Code ?>"><?php echo $ex->Name ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="exseq" name="exseq" value="">
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
        if ($("#exname").val() == "") {
            alert("Please enter exercise name.");
            $("#exname").focus();
            return;
        }
        if ($("#extype").val() == "") {
            alert("Please select exercise type.");
            $("#extype").focus();
            return;
        }
        if ($("#kcal").val() == "") {
            alert("Please enter calory.");
            $("#kcal").focus();
            return;
        }
        if ($("#extype").val() == 3 && $("#excode").val() == "") {
            alert("Please select region code.");
            $("#excode").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {
            formSubmit();
        }
    }

    function formSubmit()
    {
        $("#extype").prop("disabled", false);
        $("#excode").prop("disabled", false);

        $("#frmSave").submit();
    }

</script>

<?php if (isset($exercise)): ?>
<script type='text/javascript'>
    $(document).ready(function() {

        $("#exseq").val('<?php echo $exercise->Seq ?>');
        $("#exname").val('<?php echo $exercise->Name ?>');
        $("#extype").val('<?php echo $exercise->Type ?>');
        $("#kcal").val('<?php echo $exercise->KCal ?>');
        $("#excode").val('<?php echo $exercise->ExCode ?>');

        $("#extype").prop("disabled", true);

        if ($("#extype").val() != 3)
            $("#excode").prop("disabled", true);
    }); 
</script>
<?php endif; ?>