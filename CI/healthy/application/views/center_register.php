<!-- CONTENT -->
<div id="content" class="ninecol last">
<?php if (!isset($center)): ?>
    <?php echo form_open_multipart('/admin/ccenter/register_center', array('id'=>'frmSave'));?>
<?php else: ?>
    <?php echo form_open_multipart('/admin/ccenter/modify_center', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="centercode">Center Code<span class="regdot"></span></label></td>
                            <td>
                                <input class="medium" id="centercode" name="centercode" required="required" placeholder="">
                                <input type="button" class="button-red" onclick="javascript:onGenCode();" style="cursor: pointer; width: 100px;" value="Generate" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="centername">Center Name<span class="regdot"></label></td>
                            <td><input class="medium" id="centername" name="centername" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="addr">Address</label></td>
                            <td><input class="medium" id="addr" name="addr" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="website">Web Site</label></td>
                            <td><input class="medium" id="website" name="website" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="website">Default Workout</label></td>
                            <td><select id="workout" name="workout" class="" required="required">
                                <option value="" selected>Please select workout</option>
                                <?php foreach ($workouts as $workout): ?>
                                <option value="<?php echo $workout->Seq ?>"><?php echo $workout->Name ?></option>
                                <?php endforeach; ?>
                            </select></td>
                        </tr>
                        <tr>
                            <td><label>Logo</label></td>
                            <td>
                                <div class="oPhotoPanel margin-auto">
                                    <div class="oPhoto thumbnail" id="oLogoPhoto" style="background-image: url(<?php echo $baseDir ?>/www/img/nophoto.png)">
                                    </div>
                                    <input type="file" class="oPhotoUpload" id="oLogoPhotoUpload" name="logophoto" onchange="viewLogoPhoto(this)" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="userid">User ID<span class="regdot"></label></td>
                            <td><input class="medium" id="userid" name="userid" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="userpwd">Password<span class="regdot"></label></td>
                            <td><input type="password" class="medium" id="userpwd" name="userpwd" required="required" placeholder=""></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="seq" name="seq" value="">
                <input type="hidden" id="ischnimg" name="ischnimg" value="0">
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

    function onGenCode()
    {
        $.post("<?php echo $baseDir; ?>/admin/ccenter/gen_centercode", {
            }, function(data) {
                $("#centercode").val(data);
        });
    }

    function onRegister()
    {
        if ($("#centercode").val() == "") {
            alert("Please enter center code.");
            $("#centercode").focus();
            return;
        }

        if ($("#centername").val() == "") {
            alert("Please enter center name.");
            $("#centername").focus();
            return;
        }
        if ($("#workout").val() == "") {
            alert("Please select workout default.");
            $("#workout").focus();
            return;
        }

        if ($("#userid").val() == "") {
            alert("Please enter user id.");
            $("#userid").focus();
            return;
        }

        if ($("#userpwd").val() == "") {
            alert("Please enter password.");
            $("#userpwd").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {

<?php if (!isset($center)): ?>
            checkCentercode();
<?php else: ?>
            formSubmit();
<?php endif; ?>
        }
    }

    function checkCentercode()
    {
        $.post("<?php echo $baseDir; ?>/admin/ccenter/check_centercode", {
                centercode : $("#centercode").val()
            }, function(data) {
                if (data == "") formSubmit();
                else {
                    alert(data);
                    $("#centercode").focus();
                }
        });
    }

    function formSubmit()
    {
        $("#frmSave").submit();
    }

    function viewLogoPhoto(obj)
    {
        dispPhoto(obj, $("#oLogoPhoto"));
    }

    /* DISP PHOTO */
    function dispPhoto(inobj, outobj)
    {
        var filesSelected = inobj.files;// document.getElementById("oMainPhotoUpload").files;
        if (filesSelected.length > 0)
        {
            var fileToLoad = filesSelected[0];
            if (fileToLoad.type.match("image.*"))
            {
                var fileReader = new FileReader();
                fileReader.onload = function(fileLoadedEvent) 
                {
                    outobj.css('background-image', 'url(' + fileLoadedEvent.target.result + ')');
                };
                fileReader.readAsDataURL(fileToLoad);

                $("#ischnimg").val("1");

            }
            else
            {
                izd_alert("Please select image file.");
            }
        }
    }

    $("#oLogoPhoto").click(function () {
        $("#oLogoPhotoUpload").trigger("click");
    });

</script>

<?php if (isset($center)): ?>
<script type='text/javascript'>
    $(document).ready(function() {
        $("#seq").val('<?php echo $center->Seq ?>');
        $("#centercode").val('<?php echo $center->CenterCode ?>');
        $("#centername").val('<?php echo $center->CenterNm ?>');
        $("#addr").val('<?php echo $center->Adress ?>');
        $("#website").val('<?php echo $center->WebSite ?>');
        $("#website").val('<?php echo $center->WorkoutSeq ?>');
        $("#oLogoPhoto").css('background-image', 'url(<?php echo $baseDir.$center->Logo ?>)');
        $("#userid").val('<?php echo $center->UserID ?>');
        $("#userpwd").val('<?php echo $center->UserPW ?>');
        $("#workout").val('<?php echo $center->WorkoutSeq ?>');

    }); 
</script>
<?php endif; ?>