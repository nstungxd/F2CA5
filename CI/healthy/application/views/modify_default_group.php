<div id="content" class="ninecol last">
<?php if (isset($group)): ?>
    <?php echo form_open_multipart('/admin/cassign/save_default_group', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                    <tr>
                        <td><label for="pro1" id="labelpro1">Name<span class="regdot"></span></label></td>
                        <td><?php echo $group->Name ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><label for="workout">Default Workout</label></td>
                        <td>
                            <select id="workout" name="workout" class="multiselect" size="3" required="required">
                                <?php foreach ($workouts as $workout): ?>
                                <option value="<?php echo $workout->Seq ?>"><?php echo $workout->Name ?></option>
                                <?php endforeach; ?>
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
            if ($("#workout").val() == "" || $("#workout").val()== null) {
                alert("Please select workout.");
                $("#workout").focus();
                return;
            }
            if (confirm("Are you sure to save this?")) {
                formSubmit();
            }
        }
        function formSubmit()
        {
            $("#workout").prop("disabled", false);
            $("#frmSave").submit();
        }


    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            <?php if (isset($group)): ?>
            $("#gseq").val('<?php echo $group->Seq ?>');
            $("#workout").val('<?php echo $group->WorkoutSeq ?>');
            <?php endif; ?>
        });
    </script>