<!-- CONTENT -->
<div id="content" class="ninecol last">
<?php if (!isset($trainer)): ?>
    <?php echo form_open_multipart('/admin/ctrainer/register_trainer', array('id'=>'frmSave'));?>
<?php else: ?>
    <?php echo form_open_multipart('/admin/ctrainer/modify_trainer', array('id'=>'frmSave'));?>
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
                            <td><label for="userid">User ID<span class="regdot"></span></label></td>
                            <td><input class="medium" id="userid" name="userid" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="userpwd">Password<span class="regdot"></span></label></td>
                            <td><input type="password" class="medium" id="userpwd" name="userpwd" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="name">Trainer Name<span class="regdot"></span></label></td>
                            <td><input class="medium" id="name" name="name" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="sex">Sex</label></td>
                            <td>
                                <p class="pradio"><input type="radio" name="sex" id="sex" value="1" /></p>
                                <p class="pradiotext">Male&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                <p class="pradio"><input type="radio" name="sex" id="sex" value="2" /></p>
                                <p class="pradiotext">Female</p>
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
        if ($("#centercode").val() == "") {
            alert("Please select center code.");
            $("#centercode").focus();
            return;
        }

        if ($("#userid").val() == "") {
            alert("Please enter User ID.");
            $("#userid").focus();
            return;
        }

        if ($("#userpwd").val() == "") {
            alert("Please enter password.");
            $("#userpwd").focus();
            return;
        }

        if ($("#name").val() == "") {
            alert("Please enter trainer name.");
            $("#name").focus();
            return;
        }

        if ($("#sex").val() == "") {
            alert("Please choose trainer gender.");
            $("#sex").focus();
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
<?php if (isset($trainer)): ?>
        $("#seq").val('<?php echo $trainer->Seq ?>');
        $("#centercode").val('<?php echo $trainer->CenterCode ?>');
        $("#userid").val('<?php echo $trainer->UserID ?>');
        $("#userpwd").val('<?php echo $trainer->UserPW ?>');
        $("#name").val('<?php echo $trainer->Name ?>');
        $('input:radio[name="sex"][value="<?php echo $trainer->Sex ?>"]').prop('checked', true);
<?php endif; ?>
<?php if (perm_is_center($permission)): ?>
        $("#centercode").val('<?php echo $centercode ?>');
        $("#centercode").prop("disabled", true);
<?php endif; ?>
    }); 
</script>
