<!-- CONTENT -->
<div id="content" class="ninecol last">
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="oldpwd">Old Password</label></td>
                            <td><input type="password" class="medium" id="oldpwd" name="oldpwd" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;"><label for="newpwd">New Password</label></td>
                            <td><input type="password" class="medium" id="newpwd" name="newpwd" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;"><label for="confpwd">Confirm Password</label></td>
                            <td><input type="password" class="medium" id="confpwd" name="confpwd" required="required" placeholder=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel">
            <div class="title no-border">
                <div class="headline first" style="float:right">
                    <input type="button" class="button-green" onclick="onChange();" style="cursor: pointer; width: 100px;" value="Save" />
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    function onChange()
    {
        var oldpwd = $("#oldpwd").val();
        var newpwd = $("#newpwd").val();
        var confpwd = $("#confpwd").val();

        if ($("#oldpwd").val() == "") {
            alert("Please enter old password.");
            $("#oldpwd").focus();
            return;
        }
        if ($("#newpwd").val() == "") {
            alert("Please enter new password.");
            $("#newpwd").focus();
            return;
        }
        if ($("#confpwd").val() == "") {
            alert("Please enter confirm password.");
            $("#confpwd").focus();
            return;
        }
        if ($("#confpwd").val() != $("#newpwd").val()) {
            alert("Please confirm password.");
            $("#confpwd").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {
            $.post("<?php echo $baseDir; ?>/admin/caccount/change_account", {
                    oldpwd : oldpwd,
                    newpwd : newpwd
                }, function(data) {
                    if (data == "") {
                        logout();
                    }
                    else alert(data);
            });
        }
    }

</script>