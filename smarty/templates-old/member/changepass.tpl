<div id="Password_details">
<h3 align="center"><b>{$LBL_CHANGE_PASSWORD}</b></h3>
<form id="chpas" name="chpas" method="post" action="">
<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}" />

<div style="padding-left:30px;">
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
	<div>
		<label class="lbl" for="pass" style="width:159px;font-size: 14px">{$LBL_OLD} {$LBL_PASSWORD}</label>
      <label>:</label>
		<input type="password" name="vOldPassword" id="vOldPassword" class="required"  value="" onkeypress="return chkSpace(event);" style="width:210px;" title="{$LBL_ENTER} {$LBL_OLD} {$LBL_PASSWORD}" >
		<div htmlfor="vOldPassword" generated="true" ></div>
		<br/>
	</div>
	<br/>
	<div>
		<label class="lbl" for="pass" style="width:159px;font-size: 14px">{$LBL_NEW} {$LBL_PASSWORD}</label>
		<label>:</label>
      <input type="password" name="Data[vPassword]" id="vPassword" class="required" minlength="5" value="" onkeypress="return chkSpace(event);" style="width:210px;" title="{$LBL_ENTER} {$LBL_NEW} {$LBL_PASSWORD}" >
		<span class="" style="position:absolute; font-size:10px; margin-left:10px;">{$LBL_PASSWORD_STRENGTH}<span id="pst"></span><div id="psi" class="is0" style=""></div></span>
		<div htmlfor="vPassword" generated="true" ></div>
		<br/>
	</div>
	<br/>
	<div>
		<label class="lbl" for="vConPassword" style="width:159px;font-size: 14px">{$LBL_CONFIRM} {$LBL_PASSWORD}</label>
		<label>:</label>
      <input type="password" name="vConPassword" id="vConPassword" value="" onkeydown="return noCTRL(event);" oncontextmenu="return false;" equalTo='#vPassword' style="width:210px;" title="{$LBL_ENTER} {$LBL_CONFIRM} {$LBL_PASSWORD}" >
	</div>
	<br/>
	<div>
		<label class="lbl" style="width:167px;">&nbsp;</label>
		<a class="btllbl" style="textarea-decoration:none;" name="changepassword" id="changepassword" title="{$LBL_CHANGE_PASSWORD}" onclick="// $('#chpas').submit();"><b>{$LBL_SUBMIT}</b></a>
	</div>
</div>
</form>
</div>
<script language="JavaScript" src="{$S_JQUERY}jquery.validate.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.passwordstrength.js"></script>
{literal}
<script type="text/javascript">
$(document).ready(function() {
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
			"Data[vPassword]": { minlength: MSG_PASSWORD_LENGTH },
			vConPassword: { equalTo: MSG_PASSWORD_MISMATCH },
			vOldPassword: { remote: jQuery.validator.format(LBL_INCORRECT_OLD_PASSWORD) }
		}
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