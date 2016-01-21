<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div id="content-header" class="clearfix">
                <div class="pull-left">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>{$LBL_CHANGE_PASSWORD}</span></li>
                    </ol>

                    <h1>{$LBL_CHANGE_PASSWORD}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="main-box">
            <header class="main-box-header clearfix">

            </header>

        {if $msg neq ''}
            {literal}
            <script>
                    $(document).ready(function() {
            var msg='{/literal}{$msg}{literal}';
            if(msg!= '' && msg != undefined)
                alert(msg);
        });
        </script>
        {/literal}
        {/if}
            <input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}" />
            <center class="main-box-body clearfix">
                <div id="errors" style="padding-left:0px;"></div>
                <form id="chpas" name="chpas" class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label class="col-md-3 control-label">{$LBL_OLD} {$LBL_PASSWORD} *</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="vOldPassword" id="vOldPassword" onkeypress="return chkSpace(event);"  placeholder="{$LBL_ENTER} {$LBL_OLD} {$LBL_PASSWORD}">
                            <div id="vOldPassword_validate"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="vPassword" class="col-md-3 control-label">{$LBL_NEW} {$LBL_PASSWORD} *</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="Data[vPassword]" id="vPassword"  minlength="5" placeholder="{$LBL_ENTER} {$LBL_NEW} {$LBL_PASSWORD}" onkeypress="return chkSpace(event);" data-indicator="pwindicator">
                            <div id="pwindicator" class="pwdindicator">
                                <div class="bar"></div>
                                <div class="pwdstrength-label"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vConPassword" class="col-md-3 control-label">{$LBL_CONFIRM} {$LBL_PASSWORD} *</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" onkeydown="return noCTRL(event);" oncontextmenu="return false;" equalTo='#vPassword' name="vConPassword" id="vConPassword" placeholder="{$LBL_ENTER} {$LBL_CONFIRM} {$LBL_PASSWORD}">
                        </div>
                    </div>
                    <div class="form-group">
                        <center class="col-md-12">
                            <button type="submit" name="changepassword" id="changepassword" class="btn btn-primary">{$LBL_SUBMIT}</button>
                            <button type="button" name="changepassword" class="btn btn-primary" onClick="window.location.reload()">{$LBL_RESET}</button>

                        </center>
                    </div>
                </form>
            </center>
        </div>
    </div>



</div>

<script src="{$SITE_JS}jquery.js"></script>
<script src="{$SITE_JS}bootstrap.js"></script>
<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>


<!-- this page specific scripts -->
<script src="{$SITE_JS}jquery.maskedinput.min.js"></script>
<script src="{$SITE_JS}select2.min.js"></script>
<script src="{$SITE_JS}modernizr.custom.js"></script>
<script src="{$SITE_JS}classie.js"></script>
<script src="{$SITE_JS}modalEffects.js"></script>
<script src="{$SITE_JS}jquery.pwstrength.js"></script>
<!-- theme scripts -->
<script src="{$SITE_JS}scripts.js"></script>
<script src="{$SITE_JS}pace.min.js"></script>
<script language="JavaScript" src="{$S_JQUERY}jquery.validate.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.passwordstrength.js"></script>
{literal}
<script type="text/javascript">
        $(document).ready(function() {
$('#vPassword').pwstrength({
			label: '.pwdstrength-label'
		});
    $("#chpas").validate({
        rules: {
            vOldPassword: {
                remote: {
                    url:SITE_URL+"index.php?file=m-aj_chkoldpass",
                    type:"get",
                    data: {
                        id:function() {
                            return $("#iUserId").val();
                        },
                        val:function() {
                            return $("#vOldPassword").val();
                        }
                    }
                }
            }
        },
        messages: {
            "Data[vPassword]": { minlength: '<i class="fa fa-exclamation-triangle"></i>'+MSG_PASSWORD_LENGTH },
            vConPassword: { equalTo: '<i class="fa fa-exclamation-triangle"></i>'+MSG_PASSWORD_MISMATCH },
            vOldPassword: { remote: jQuery.validator.format('<i class="fa fa-exclamation-triangle"></i>'+LBL_INCORRECT_OLD_PASSWORD) }
        }
        /*errorPlacement: function(error, element) {
            error.appendTo("div#errors");

            *//*var name = $(element).attr("name");
            error.appendTo($("#" + name + "_validate"));*//*
        }*/
    });
    //
        $('#vPassword').passwordStrength({targetElement:'#psi', targetTextElement:'#pst', psimsg:["{/literal}{$LBL_WEAK}{literal}","{/literal}{$LBL_MEDIUM}{literal}","{/literal}{$LBL_STRONG}{literal}","{/literal}{$LBL_VERY_STRONG}{literal}"]});
    $('#changepassword').click(function() {
        var vld = $('#chpas').valid();
        if(!vld) { return false; }
        $('#chpas')[0].submit();
    });
});
</script>
{/literal}