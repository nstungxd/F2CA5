<div id="content" class="ninecol last">
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
                        <td style="width: 20%;"><label for="member">Workout</label></td>
                        <td>
                            <select id="workout" name="workout" class="multiselect" size="3" required="required">
                                <?php foreach ($workouts as $workout): ?>
                                <option value="<?php echo $workout->Seq ?>"><?php echo $workout->Name ?></option>
                                <?php endforeach; ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="tbl-data">
                            </div>
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
    <script type="text/javascript">
        var cpage = "<?php echo $page ?>";
        var seq = "<?php echo $seq ?>";
        function doSearch(mnth,yrs)
        {
            $.post("<?php echo $baseDir; ?>/admin/cassign/calendar_group", {
                seq:seq,
                mnth : mnth,
                yrs : yrs
            }, function(data) {
                var results = data.split("|||");
                $("#tbl-data").html(results[0]);
            });
        }
        function changeColor(rownum,cellnum,days,month,year)
        {
            alert($("#workout").val());
            var a = $("tr:eq(" + rownum + ") > td:eq(" + cellnum + ")");
            if(a.attr("class") == 'info')
            {
                if ($("#workout").val() == "" || $("#workout").val() == null) {
                    alert("Please select workout.");
                    $("#workout").focus();
                    return;
                }
                var wo = $("#workout").val();
                $.post("<?php echo $baseDir; ?>/admin/cassign/add_group", {
                    wo:wo,
                    seq:seq,
                    days : days,
                    mnth : month,
                    yrs : year
                }, function(data) {
                    a.removeClass('choose');
                    a.addClass('choose');
                    a.removeClass('info');
                    a.attr('title', data);
                });
            }
            else if(a.attr("class") == 'choose')
            {
                $.post("<?php echo $baseDir; ?>/admin/cassign/remove_group", {
                    seq:seq,
                    days : days,
                    mnth : month,
                    yrs : year
                }, function(data) {
                    a.removeClass('info');
                    a.addClass('info');
                    a.removeClass('choose');
                    a.attr('title',' ');
                });
            }
        }

        $(document).ready(function() {
            //$('[data-toggle="tooltip"]').tooltip();
            var mnth = "<?php echo date("n") ?>";
            var yrs = "<?php echo date("Y") ?>";
            doSearch(mnth,yrs);
        });
    </script>