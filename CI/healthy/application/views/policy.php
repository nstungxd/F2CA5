<!-- CONTENT -->
<div id="content" class="ninecol last">
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="agreement">Agreement</label></td>
                            <td>
                                <textarea class="super" id="agreement" name="agreement" style="height: 150px;">
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="policy">Policy</label></td>
                            <td>
                                <textarea class="super" id="policy" name="policy" style="height: 150px;">
                                </textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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

    function onRegister()
    {
        if ($("#agreement").val() == "") {
            alert("Please enter agreement.");
            $("#agreement").focus();
            return;
        }
        if ($("#policy").val() == "") {
            alert("Please enter policy.");
            $("#policy").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {
            var agreement = $("#agreement").val();
            var policy = $("#policy").val();

            $.post("<?php echo $baseDir; ?>/admin/common/update_policy", {
                    agreement : agreement,
                    policy : policy
                }, function(data) {
                    alert(data);
                    document.href.reload();
            });
        }
    }
</script>

<script type='text/javascript'>
    $(document).ready(function() {
<?php if (isset($agreement)): ?>
        $("#agreement").val('<?php echo $agreement->c_value ?>');
<?php endif; ?>
<?php if (isset($policy)): ?>
        $("#policy").val('<?php echo $policy->c_value ?>');
<?php endif; ?>
    }); 
</script>
