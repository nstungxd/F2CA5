<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<div class="security-bg" style="width:100%;">
			<div class="organization" style="">
				<a><img border="0" class="valignmidd iconsize" alt="" src="{$SITE_IMAGES}help.png"> &nbsp; Forgot Password</a>
				<div id="msg" class="msg err" align="center"></div>
				<div id="fpdv" style="padding-left:59px;" align="center">
					<form name="frmfp" id="frmfp" method="post">
						<div style="margin:10px;">
							<span class="username" style="">{$LBL_COMP_CODE} : &nbsp; </span> &nbsp; 
							<div class="user-input-bg" style="display:inline-block; padding-left:1px; width:293px;">
								<input type="text" name="orcode" id="orcode" class="user-input" style="width:279px; padding:0px; margin:0px;" />
							</div>
						</div>
						<div style="margin:10px; padding-left:37px;">
							<span class="username" style="">{$LBL_USERNAME} : &nbsp; </span> &nbsp; 
							<div class="user-input-bg" style="display:inline-block; padding-left:1px; width:293px;">
								<input type="text" name="unm" id="unm" class="user-input required" style="width:279px; padding:0px; margin:0px;" title="{$LBL_ENTER_USERNAME}" />
								<div htmlfor="unm" generated="true" class="err" style="position:absolute; display:none;"></div>
							</div>
						</div>
						<div id="sq" style="margin:10px;"></div>
						<div id='cap' style='margin:10px; display:none;'>
							<div style='margin-left:100px;'><img id='captchaimg' src="" /> &nbsp; <img id='refresh' src="{$SITE_IMAGES}refresh.jpg" height="39px" /></div>
								<span class='username' style=''>{$LBL_SECURITY_CODE} : &nbsp; </span> &nbsp;
								<div class='user-input-bg' style='display:inline-block; padding-left:1px; width:293px;'>
									<input type='text' name='scode' id='scode' class='user-input required' style='width:279px; padding:0px; margin:0px;' title="{$LBL_ENTER_SECURITY_CODE}" />
								<div htmlfor='scode' generated='true' class='err' style='position:absolute; display:none;'></div>
							</div>
							<div style='margin:10px;'>
								<span class="username" style="">{$LBL_NEW} {$LBL_PASSWORD} : &nbsp;&nbsp; </span>
								<div class="user-input-bg" style="display:inline-block; padding-left:1px; width:293px;">
									<input type="password" name="password" id="password" class="user-input required" style="width:279px; padding:0px; margin:0px;" title="{$LBL_ENTER} {$LBL_NEW} {$LBL_PASSWORD}" />
									<div htmlfor="password" generated="true" class="err" style="position:absolute; display:none;"></div>
								</div>
								<span class="username" style="position:absolute; margin:5px;">{$LBL_PASSWORD_STRENGTH}<span id="pst"></span><div id="psi" class="is0" style="margin:3px;"></div></span>
							</div>
							<div style='margin:10px;'>
								<span class="username" style="">{$LBL_CONFIRM} {$LBL_PASSWORD} :&nbsp;</span>
								<div class="user-input-bg" style="display:inline-block; padding-left:1px; padding-right:19px; width:293px;">
									<input type="password" name="conpassword" id="conpassword" onkeydown="return noCTRL(event);" oncontextmenu="return false;" equalTo='#password' class="user-input" style="width:279px; padding:0px; margin:0px;" title="{$MSG_PASSWORD_MISMATCH|stripslashes}" >
								<div htmlfor="conpassword" generated="true" class="err" style="position:absolute; display:none;"></div>
						   </div>
							</div>
						</div>
						<div style="height:10px; line-height:10px;">&nbsp;</div>
						<div class="remember" style="margin:10px;">
							<span class="continue" style=""><img id="cont" src="{$SITE_IMAGES}btn-continue.gif" alt="" border="0" class="valignmidd pointer" onkeypress="return chkEnter(event,'yes','chkuser()')" /> &nbsp; </span> &nbsp; 
							<span class="send" style="display:none;"> <img id="fpsend" src="{$SITE_IMAGES}btn-send.gif" alt="" border="0" class="valignmidd pointer" onkeypress="return chkEnter(event,'yes','forgotPass()')" /> &nbsp; </span>  &nbsp;
							<span style="display:inline-block; width:50px;"> &nbsp; </span>
						</div>
						<div style="height:15px;">&nbsp;</div>
					</form>
				</div>
			</div>
		</div>
    </td>
  </tr>
</table>
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.passwordstrength.js"></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jforgotpass.js"></script>
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$('#password').passwordStrength({targetElement:'#psi', targetTextElement:'#pst', psimsg:["{/literal}{$LBL_WEAK}{literal}","{/literal}{$LBL_MEDIUM}{literal}","{/literal}{$LBL_STRONG}{literal}","{/literal}{$LBL_VERY_STRONG}{literal}"]});
});
</script>
{/literal}