<!-- CONTENT -->
<div id="content" class="ninecol last">
<?php if (!isset($food)): ?>
    <?php echo form_open_multipart('/admin/common/register_food', array('id'=>'frmSave'));?>
<?php else: ?>
    <?php echo form_open_multipart('/admin/common/modify_food', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="foodname">Food Name<span class="regdot"></span></label></td>
                            <td><input class="medium" id="foodname" name="foodname" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="kcal">Calory<span class="regdot"></span></label></td>
                            <td>
                                <input class="big" id="kcal" name="kcal" required="required" placeholder="">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="foodseq" name="foodseq" value="">
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
        if ($("#foodname").val() == "") {
            alert("Please enter food name.");
            $("#foodname").focus();
            return;
        }
        if ($("#kcal").val() == "") {
            alert("Please enter calory.");
            $("#kcal").focus();
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

<?php if (isset($food)): ?>
<script type='text/javascript'>
    $(document).ready(function() {
        $("#foodseq").val('<?php echo $food->Seq ?>');
        $("#foodname").val('<?php echo $food->FoodName ?>');
        $("#kcal").val('<?php echo $food->KCal ?>');
    }); 
</script>
<?php endif; ?>