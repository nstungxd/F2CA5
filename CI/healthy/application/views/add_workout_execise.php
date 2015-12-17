<div id="content" class="ninecol last">
    <?php if (isset($workout)): ?>
    <?php echo form_open_multipart('/admin/cworkout/save_workout_execise', array('id'=>'frmSave'));?>
    <?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                    <tr>
                        <td><label for="pro1" id="labelpro1">Workout<span class="regdot"></span></label></td>
                        <td><?php echo $workout->Name ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><label for="execise">Execise</label></td>
                        <td>
                            <select id="execise" name="execise" class="multiselect" size="3" required="required">
                                <?php foreach ($exercises as $exercise): ?>
                                <option value="<?php echo $exercise->Seq ?>"><?php echo $exercise->Name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div id="tbl-data"></div>

                
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
    var seq = "<?php echo $seq ?>";

    function onRegister()
    {
        if ($("#execise").val() == "" || $("#execise").val() == null) {
            alert("Please select execise.");
            $("#execise").focus();
            return;
        }
        if ($("#input1").val() != "" && $("#value1").val() == "") {
            alert("Please enter value for input type 1");
            $("#value1").focus();
            return;
        }
        if ($("#input2").val() != "" && $("#value2").val() == "") {
            alert("Please enter value for input type 2");
            $("#value2").focus();
            return;
        }
        if ($("#input3").val() != "" && $("#value3").val() == "") {
            alert("Please enter value for input type 3");
            $("#value3").focus();
            return;
        }


        if ($("#input1").val() == "" && $("#value1").val() != "") {
            alert("Please select input for value 1");
            $("#input1").focus();
            return;
        }
        if ($("#input2").val() == "" && $("#value2").val() != "") {
            alert("Please enter value for value 2");
            $("#input2").focus();
            return;
        }
        if ($("#input3").val() == "" && $("#value3").val() != "") {
            alert("Please enter value for value 3");
            $("#input3").focus();
            return;
        }
        if (confirm("Are you sure to save this?")) {
            formSubmit();
        }

    }
    function formSubmit()
    {
        $("#execise").prop("disabled", false);
        $("#frmSave").submit();
    }
    function doSearch()
        {
            var execise = $('#execise').val();
            $.post("<?php echo $baseDir; ?>/admin/cworkout/search_input", {
                execise : execise
            }, function(data) {
                var results = data.split("|||");
                $("#tbl-data").html(results[0]);
            });
        }
    $("#execise").change(function(event) {
        doSearch();
    });
</script>