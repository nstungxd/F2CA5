<div id="content" class="ninecol last">
    <?php if (isset($category)): ?>
    <?php echo form_open_multipart('/admin/ccategory/save_member_category', array('id'=>'frmSave'));?>
    <?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                    <tr>
                        <td><label for="pro1" id="labelpro1">Group<span class="regdot"></span></label></td>
                        <td><?php echo $category->Name ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><label for="member">New value</label></td>
                        <td>
                            <input class="medium" id="member" name="member" required="required" placeholder="">
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
        if (confirm("Are you sure to save this?")) {
            formSubmit();
        }

    }
    function formSubmit()
    {
        $("#member").prop("disabled", false);
        $("#frmSave").submit();
    }
    </script>