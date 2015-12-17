<div id="content" class="ninecol last">
<?php if (!isset($group)): ?>
    <?php echo form_open_multipart('/admin/cgroup/register_group', array('id'=>'frmSave'));?>
    <?php else: ?>
    <?php echo form_open_multipart('/admin/cgroup/modify_group', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                    <tr>
                        <td><label for="pro1" id="labelpro1">Name<span class="regdot"></span></label></td>
                        <td><input class="medium" id="Name" name="Name" required="required" placeholder="Name group"></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><label for="trainerCreate">Center</label></td>
                        <td>
                            <select id="CenterCreate" name="CenterCreate" class="" required="required">
                                <option value="" selected>Please select</option>
                                <?php foreach ($centers as $center): ?>
                                <option value="<?php echo $center->CenterCode ?>"><?php echo $center->CenterNm ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><label for="trainerCreate">Trainer Create</label></td>
                        <td>
                            <select id="trainerCreate" name="trainerCreate" class="" required="required">
                                <option value="" selected>Please select</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><label for="trainerLink">Trainer Link<span class="regdot"></span></label></td>
                        <td>
                            <select id="trainerLink" name="trainerLink" class="" required="required">
                                <option value="" selected>Please select</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" id="gseq" name="gseq" value="">
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
            if ($("#Name").val() == "") {
                $("#Name").focus();
                return;
            }
            if ($("#CenterCreate").val() == "") {
                alert("Please select Center.");
                $("#CenterCreate").focus();
                return;
            }
            if ($("#trainerCreate").val() == "") {
                alert("Please select trainer create.");
                $("#trainerCreate").focus();
                return;
            }
            if ($("#trainerLink").val() == "") {
                alert("Please select trainer link.");
                $("#trainerLink").focus();
                return;
            }
            if (confirm("Are you sure to save this?")) {
                formSubmit();
            }
        }
        function formSubmit()
        {
            $("#trainerLink").prop("disabled", false);
            $("#trainerCreate").prop("disabled", false);
            $("#CenterCreate").prop("disabled", false);
            $("#frmSave").submit();
        }

        function onChangeCenterCode()
        {
            var centercode = $('#CenterCreate').val();
            $.post("<?php echo $baseDir; ?>/admin/cgroup/search_trainer", {
                    centercode : centercode
                }, function(data) {
                    $("#trainerLink").html(data);
                    $("#trainerCreate").html(data);


                    <?php if (isset($group)): ?>
                    $("#trainerLink").val('<?php echo $group->TrainerSeq ?>');
                    $("#trainerCreate").val('<?php echo $group->CreateBy ?>');
                     <?php endif; ?>
                
                    <?php if (!perm_is_admin($permission)): ?>
                    $("#trainerLink").val('<?php echo $adminseq ?>');
                    $("#trainerLink").prop("disabled", true);

                    $("#trainerCreate").val('<?php echo $adminseq ?>');
                    $("#trainerCreate").prop("disabled", true);
                    <?php endif; ?>

            });
        }
    </script>
<script type='text/javascript'>
    $(document).ready(function() {
    <?php if (isset($group)): ?>
        $("#gseq").val('<?php echo $group->Seq ?>');
        $("#CenterCreate").val('<?php echo $group->CenterCode ?>');
        $("#Name").val('<?php echo $group->Name ?>');
        onChangeCenterCode();
        <?php endif; ?>

    <?php if (!perm_is_admin($permission)): ?>
        $("#CenterCreate").val('<?php echo $centercode ?>');
        $("#CenterCreate").prop("disabled", true);
        onChangeCenterCode();
        <?php endif; ?>

    });

    $("#CenterCreate").change(function(event) {
        onChangeCenterCode();
    });
</script>