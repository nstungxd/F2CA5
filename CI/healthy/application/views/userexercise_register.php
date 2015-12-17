<!-- CONTENT -->
<div id="content" class="ninecol last">
<?php if (!isset($userex)): ?>
    <?php echo form_open_multipart('/admin/cmember/register_userex', array('id'=>'frmSave'));?>
<?php else: ?>
    <?php echo form_open_multipart('/admin/cmember/modify_userex', array('id'=>'frmSave'));?>
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
                    <td style="width: 20%;"><label for="trainer">Trainer<span class="regdot"></span></label></td>
                    <td>
                        <select id="trainer" name="trainer" class="" required="required">
                            <option value="" selected>Please select</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><label for="user">User<span class="regdot"></span></label></td>
                    <td>
                        <select id="user" name="user" class="" required="required">
                            <option value="" selected>Please select</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><label for="exercise">Exercise<span class="regdot"></span></label></td>
                    <td>
                        <select id="exercise" name="exercise" class="" required="required">
                            <option value="" selected>Please select</option>
                            <?php foreach ($exercises as $ex): ?>
                            <option value="<?php echo $ex->Seq ?>"><?php echo $ex->Name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="pro1" id="labelpro1">Pro1</label></td>
                    <td><input class="medium" id="pro1" name="pro1" required="required" placeholder=""></td>
                </tr>
                <tr>
                    <td><label for="pro2" id="labelpro2">Pro2</label></td>
                    <td><input class="medium" id="pro2" name="pro2" required="required" placeholder=""></td>
                </tr>
                <tr>
                    <td><label for="pro3" id="labelpro3">Pro3</label></td>
                    <td><input class="medium" id="pro3" name="pro3" required="required" placeholder=""></td>
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

        if ($("#trainer").val() == "") {
            alert("Please select trainer.");
            $("#trainer").focus();
            return;
        }

        if ($("#user").val() == "") {
            alert("Please select member.");
            $("#user").focus();
            return;
        }

        if ($("#exercise").val() == "") {
            alert("Please select exercise.");
            $("#exercise").focus();
            return;
        }

        if ($("#pro1").val() == "") {
            $("#pro1").focus();
            return;
        }

        if ($("#pro2").val() == "") {
            $("#pro2").focus();
            return;
        }

        if ($("#pro3").val() == "") {
            $("#pro3").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {
            formSubmit();
        }
    }

    function formSubmit()
    {
        $("#centercode").prop("disabled", false);
        $("#trainer").prop("disabled", false);
        $("#frmSave").submit();
    }

    function onChangeCenterCode()
    {
        var centercode = $('#centercode').val();
        $.post("<?php echo $baseDir; ?>/admin/cmember/search_trainer", {
                centercode : centercode
            }, function(data) {
                $("#trainer").html(data);

<?php if (isset($userex)): ?>
        $("#trainer").val('<?php echo $userex->TrainerSeq ?>');
<?php endif; ?>

<?php if (perm_is_trainer($permission)): ?>
                $("#trainer").val('<?php echo $adminseq ?>');
                $("#trainer").prop("disabled", true);
<?php endif; ?>

        });

        $.post("<?php echo $baseDir; ?>/admin/cmember/search_member_list", {
                centercode : centercode
            }, function(data) {
                $("#user").html(data);

<?php if (isset($userex)): ?>
        $("#user").val('<?php echo $userex->UserSeq ?>');
<?php endif; ?>
        });
    }

    function onChangeExercise()
    {
        var exval = $("#exercise").val();
        $.post("<?php echo $baseDir; ?>/admin/cmember/get_exercise_pro_label", {
                exseq : exval
            }, function(data) {
                var results = data.split("|||");

                $("#labelpro1").text(results[0]);
                $("#labelpro2").text(results[1]);
                $("#labelpro3").text(results[2]);
        });
    }

    $("#centercode").change(function(event) {
        onChangeCenterCode();
    });

    $("#exercise").change(function(event) {
        onChangeExercise();
    });

</script>

<script type='text/javascript'>
    $(document).ready(function() {
<?php if (isset($userex)): ?>
        $("#seq").val('<?php echo $userex->Seq ?>');
        $("#centercode").val('<?php echo $user->CenterCode ?>');
        $("#exercise").val('<?php echo $userex->ExerciseSeq ?>');
        $("#pro1").val('<?php echo $userex->Pro1 ?>');
        $("#pro2").val('<?php echo $userex->Pro2 ?>');
        $("#pro3").val('<?php echo $userex->Pro3 ?>');
<?php endif; ?>
<?php if (!perm_is_admin($permission)): ?>
        $("#centercode").val('<?php echo $centercode ?>');
        $("#centercode").prop("disabled", true);
        onChangeCenterCode();
<?php endif; ?>
        
    });
</script>
