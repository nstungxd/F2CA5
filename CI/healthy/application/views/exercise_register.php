<!-- CONTENT -->
<div id="content" class="ninecol last">
<?php if (!isset($exercise)): ?>
    <?php echo form_open_multipart('/admin/common/register_exercise', array('id'=>'frmSave'));?>
<?php else: ?>
    <?php echo form_open_multipart('/admin/common/modify_exercise', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="exname">Exercise Name<span class="regdot"></span></label></td>
                            <td><input class="medium" id="exname" name="exname" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="extype">Exercise Type<span class="regdot"></span></label></td>
                            <td>
                                <select id="extype" name="extype" class="" required="required">
                                <option value="" selected>Please select category</option>
                                <?php foreach ($categorys as $category): ?>
                                <option value="<?php echo $category->Seq ?>"><?php echo $category->Name ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="kcal">Calorie<span></span></label></td>
                            <td>
                                <input class="big" id="kcal" name="kcal" placeholder="0" value="0">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="excode">Exercise Target</span></label></td>
                            <td>
                                <select id="excode" name="excode" class="" required="required">
                                    <option value="">Please select</option>
                                <?php foreach ($extarget as $ex): ?>
                                    <option value="<?php echo $ex->Code ?>"><?php echo $ex->Name ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
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
                        
                    </tbody>
                </table>
                <div id=tbl-data>
                    
                </div>
                <input type="hidden" id="exseq" name="exseq" value="">
                <input type="hidden" id="ischnimg" name="ischnimg" value="0">
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
        if ($("#exname").val() == "") {
            alert("Please enter exercise name.");
            $("#exname").focus();
            return;
        }
        if ($("#extype").val() == "") {
            alert("Please select exercise type.");
            $("#extype").focus();
            return;
        }
        if ($("#extype").val() == 3 && $("#excode").val() == "") {
            alert("Please select region code.");
            $("#excode").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {
            formSubmit();
        }
    }

    function formSubmit()
    {
        $("#extype").prop("disabled", false);
        $("#excode").prop("disabled", false);

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


<script type='text/javascript'>
    $(document).ready(function() {

        <?php if (isset($exercise)): ?>
        $("#exseq").val('<?php echo $exercise->Seq ?>');
        $("#exname").val('<?php echo $exercise->Name ?>');
        $("#extype").val('<?php echo $exercise->Type ?>');
        $("#kcal").val('<?php echo $exercise->KCal ?>');
        $("#excode").val('<?php echo $exercise->ExCode ?>');

        $("#extype").prop("disabled", true);

        /*if ($("#extype").val() != 3)*/
            $("#excode").prop("disabled", true);
        $("#oLogoPhoto").css('background-image', 'url(<?php echo $baseDir.$exercise->Logo ?>)');
        <?php endif; ?>



    });
    
    
</script>
