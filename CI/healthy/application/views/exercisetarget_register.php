<!-- CONTENT -->
<div id="content" class="ninecol last">
<?php if (!isset($extarget)): ?>
    <?php echo form_open_multipart('/admin/common/register_extarget', array('id'=>'frmSave'));?>
<?php else: ?>
    <?php echo form_open_multipart('/admin/common/modify_extarget', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="code">Target Code<span class="regdot"></span></label></td>
                            <td><input class="medium" id="code" name="code" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="name">Target Name<span class="regdot"></span></label></td>
                            <td>
                                <input class="big" id="name" name="name" required="required" placeholder="">
                            </td>
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
        if ($("#code").val() == "") {
            alert("Please enter target code.");
            $("#code").focus();
            return;
        }
        if ($("#name").val() == "") {
            alert("Please enter target name.");
            $("#name").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {
            formSubmit();
        }
    }

    function formSubmit()
    {
        $("#frmSave").submit();
    }

</script>

<?php if (isset($extarget)): ?>
<script type='text/javascript'>
    $(document).ready(function() {
        $("#seq").val('<?php echo $extarget->Seq ?>');
        $("#code").val('<?php echo $extarget->Code ?>');
        $("#name").val('<?php echo $extarget->Name ?>');
        $("#code").prop("readonly", "readonly");
    }); 
</script>
<?php endif; ?>