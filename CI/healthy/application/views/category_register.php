<div id="content" class="ninecol last">
<?php if (!isset($category)): ?>
    <?php echo form_open_multipart('/admin/ccategory/register_category', array('id'=>'frmSave'));?>
    <?php else: ?>
    <?php echo form_open_multipart('/admin/ccategory/modify_category', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                    <tr>
                        <td><label for="pro1" id="labelpro1">Category name<span class="regdot"></span></label></td>
                        <td><input class="medium" id="Name" name="Name" required="required" placeholder="Category name"></td>
                    </tr>
                    
                    
                    </tbody>
                </table>
                <input type="hidden" id="cseq" name="cseq" value="">
                <input type="hidden" id="page" name="page" value="<?php echo $page ?>">
                <input type="hidden" id="adminseq" name="adminseq" value="<?php echo(empty($adminseq)?  -1 :  $adminseq) ?>">
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
            if (confirm("Are you sure to save this?")) {
                formSubmit();
            }
        }
        function formSubmit()
        {
            $("#frmSave").submit();
        }
    </script>
    <script type='text/javascript'>
    $(document).ready(function() {
    <?php if (isset($category)): ?>
        $("#cseq").val('<?php echo $category->Seq ?>');
        $("#Name").val('<?php echo $category->Name ?>');
        <?php endif; ?>

    });
</script>