<?php if (isset($group) && $group != null){ ?>
<div id="content" class="ninecol last">
    <?php if (isset($group)): ?>
    <?php echo form_open_multipart('/admin/cgroup/save_member_group', array('id'=>'frmSave'));?>
    <?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                    <tr>
                        <td><label for="pro1" id="labelpro1">Group<span class="regdot"></span></label></td>
                        <td><?php echo $group->Name ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><label for="member">Center</label></td>
                        <td>
                           <select id="CenterCode" name="CenterCode" class="" required="required">
                                <option value="" selected>Please select</option>
                                <?php foreach ($centers as $center): ?>
                                <option value="<?php echo $center->CenterCode ?>"><?php echo $center->CenterNm ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><label for="member">Member</label></td>
                        <td>
                            <select id="member" name="member[]" size="3" class="multiselect" required="required" multiple="multiple">
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" id="seq" name="seq" value="<?php echo $seq ?>">
                <input type="hidden" id="page" name="page" value="<?php echo $page ?>">
                <input type="hidden" id="adminseq" name="adminseq" value="<?php echo $adminseq ?>">
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
        if ($("#member").val() == "") {
            alert("Please select member.");
            $("#member").focus();
            return;
        }
        if ($("#CenterCreate").val() == "") {
                alert("Please select Center.");
                $("#CenterCreate").focus();
                return;
            }
        if (confirm("Are you sure to save this?")) {
            formSubmit();
        }

    }
    function onChangeCenterCode()
        {
            var centercode = $('#CenterCode').val();
            $.post("<?php echo $baseDir; ?>/admin/cgroup/search_user", {
                    centercode : centercode
                }, function(data) {
                    $("#member").html(data);

            });
        }
    function formSubmit()
    {
        $("#member").prop("disabled", false);
        $("#frmSave").submit();
    }
    </script>
    <script type='text/javascript'>
    $(document).ready(function() {

    <?php if (!perm_is_admin($permission)): ?>
        $("#CenterCode").val('<?php echo $centercode ?>');
        $("#CenterCode").prop("disabled", true);
        onChangeCenterCode();
        <?php endif; ?>
        
        <?php if (perm_is_admin($permission)): ?>
        $("#CenterCode").val('<?php echo $group->CenterCode ?>');
        onChangeCenterCode();
        <?php endif; ?>

    });
    $("#CenterCode").change(function(event) {
        onChangeCenterCode();
    });
</script>
        <?php } ?>