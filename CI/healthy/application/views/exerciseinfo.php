<!-- CONTENT -->
<div id="content" class="ninecol last">
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="exname">Warmup URL</label></td>
                            <td>
                                <input class="super" id="warmupurl" name="warmupurl" required="required" placeholder="">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="exname">Warmup Description</label></td>
                            <td>
                                <textarea class="super" id="warmupdesc" name="warmupdesc" style="height: 150px;">
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%;"><label for="exname">Cooldown URL</label></td>
                            <td>
                                <input class="super" id="cooldownurl" name="cooldownurl" required="required" placeholder="">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="exname">Cooldown Description</label></td>
                            <td>
                                <textarea class="super" id="cooldowndesc" name="cooldowndesc" style="height: 150px;">
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
        if ($("#warmupurl").val() == "") {
            alert("Please enter warmup URL.");
            $("#warmupurl").focus();
            return;
        }
        if ($("#warmupdesc").val() == "") {
            alert("Please select warmup description.");
            $("#warmupdesc").focus();
            return;
        }
        if ($("#cooldownurl").val() == "") {
            alert("Please enter cooldown URL.");
            $("#cooldownurl").focus();
            return;
        }
        if ($("#cooldowndesc").val() == "") {
            alert("Please enter cooldown description.");
            $("#cooldowndesc").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {
            var warmupurl = $("#warmupurl").val();
            var warmupdesc = $("#warmupdesc").val();
            var cooldownurl = $("#cooldownurl").val();
            var cooldowndesc = $("#cooldowndesc").val();

            $.post("<?php echo $baseDir; ?>/admin/common/update_exinfo", {
                    warmupurl : warmupurl,
                    warmupdesc : warmupdesc,
                    cooldownurl : cooldownurl,
                    cooldowndesc : cooldowndesc
                }, function(data) {
                    alert(data);
                    document.href.reload();
            });
        }
    }
</script>

<script type='text/javascript'>
    $(document).ready(function() {
<?php if (isset($warmup)): ?>
        $("#warmupurl").val('<?php echo $warmup->c_value ?>');
        $("#warmupdesc").val('<?php echo $warmup->c_description ?>');
<?php endif; ?>
<?php if (isset($cooldown)): ?>
        $("#cooldownurl").val('<?php echo $cooldown->c_value ?>');
        $("#cooldowndesc").val('<?php echo $cooldown->c_description ?>');
<?php endif; ?>
    }); 
</script>
