<!-- CONTENT -->
<link type="text/css" rel="stylesheet" href="<?php echo $baseDir; ?>/www/css/calendar.css" />
<script language="javascript" src="<?php echo $baseDir; ?>/www/js/calendar-1.5.js"></script>

<div id="content" class="ninecol last">
<?php if (!isset($member)): ?>
    <?php echo form_open_multipart('/admin/cmember/register_member', array('id'=>'frmSave'));?>
<?php else: ?>
    <?php echo form_open_multipart('/admin/cmember/modify_member', array('id'=>'frmSave'));?>
<?php endif; ?>
    <div class="panel-wrapper">
        <div class="panel">
            <div class="content">
                <table class='register' style="background: #F7F7F7;">
                    <tbody>
                        <tr>
                            <td style="width: 20%;"><label for="centercode">Center<span class="regdot"></span></label></td>
                            <td>
                                <select id="centercode" name="centercode" class="" required="required">
                                    <option value="" selected>Please select</option>
                                <?php foreach ($centers as $center): ?>
                                    <option value="<?php echo $center->CenterCode ?>"><?php echo $center->CenterNm ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="userid">User ID<span class="regdot"></span></label></td>
                            <td><input class="medium" id="userid" name="userid" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="userpwd">Password<span class="regdot"></span></label></td>
                            <td><input type="password" class="medium" id="userpwd" name="userpwd" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="name">User Name<span class="regdot"></span></label></td>
                            <td><input class="medium" id="name" name="name" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="birthdt">Birthday<span class="regdot"></span></label></td>
                            <td><input class="datetime medium" id="birthdt" name="birthdt" required="required" placeholder="" style="cursor:pointer"></td>
                        </tr>
                        <tr>
                            <td><label for="sex">Sex</label></td>
                            <td>
                                <p class="pradio"><input type="radio" name="sex" id="sex" value="1" /></p>
                                <p class="pradiotext">Male&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                <p class="pradio"><input type="radio" name="sex" id="sex" value="2" /></p>
                                <p class="pradiotext">Female</p>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="phone">Phone</label></td>
                            <td><input class="medium" id="phone" name="phone" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input class="medium" id="email" name="email" required="required" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="height">Height (cm)</label></td>
                            <td><input class="medium" id="height" name="height" required="required" placeholder="">(cm)</td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="seq" name="seq" value="">
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

    var cal_3 = new Calendar({
        element: 'birthdt',
        weekNumbers: false,
        startDay: 1,
        onOpen: function (element) {
            //do something
        }
    });

    function onRegister()
    {
        if ($("#centercode").val() == "") {
            alert("Please select center code.");
            $("#centercode").focus();
            return;
        }

        if ($("#userid").val() == "") {
            alert("Please enter User ID.");
            $("#userid").focus();
            return;
        }

        if ($("#userpwd").val() == "") {
            alert("Please enter password.");
            $("#userpwd").focus();
            return;
        }

        if ($("#name").val() == "") {
            alert("Please enter trainer name.");
            $("#name").focus();
            return;
        }

        if ($("#sex").val() == "") {
            alert("Please choose trainer gender.");
            $("#sex").focus();
            return;
        }

        if (confirm("Are you sure to save this?")) {
            formSubmit();
        }
    }

    function formSubmit()
    {
        $("#centercode").prop("disabled", false);
        $("#frmSave").submit();
    }

</script>

<script type='text/javascript'>
    $(document).ready(function() {
<?php if (isset($member)): ?>        
        $("#seq").val('<?php echo $member->Seq ?>');
        $("#centercode").val('<?php echo $member->CenterCode ?>');
        $("#userid").val('<?php echo $member->UserID ?>');
        $("#userpwd").val('<?php echo $member->UserPW ?>');
        $("#name").val('<?php echo $member->UserNm ?>');
        $("#birthdt").val('<?php echo $member->BirthDt ?>');
        $('input:radio[name="sex"][value="<?php echo $member->Sex ?>"]').prop('checked', true);
        $("#phone").val('<?php echo $member->Phone ?>');
        $("#email").val('<?php echo $member->Email ?>');
        $("#height").val('<?php echo $member->Height ?>');
<?php endif; ?>
<?php if (perm_is_center($permission)): ?>
        $("#centercode").val('<?php echo $centercode ?>');
        $("#centercode").prop("disabled", true);
<?php endif; ?>
    }); 
</script>
