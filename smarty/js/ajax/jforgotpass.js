$(document).ready(function()
{
	$('#frmfp').validate({
		ignore: ':hidden',
		rules: {
			"scode": {
				remote: {
					 url:SITE_URL+"index.php?file=m-aj_chkscode",
					 type:"post",
					 data: {
						val:function() {
							return $("#scode").val();
						},
						id:function() {
							return "scode";
						},
						field:function() {
							return "scode";
						}
					}
				}
			}
		},
		messages: {
			"scode": { remote: jQuery.validator.format(LBL_CODE_NOT_MATCHED) }
		}
	});
	function chkuser()
	{
		var vld = $('#frmfp').valid();
		if(! vld) { return false; }
		var url = SITE_URL+'index.php?file=m-aj_chkfpuser';
		var pars = $('#frmfp').serialize();
		$.ajax({type:"post", url:url, data:pars, success:function(resp) {
			$('#sq').attr('innerHTML',resp);
			$('#cap').show();
			$('.continue').hide();
			$('.send').show();
		}});
	}
	$('#cont').click(chkuser);
	//
	function change_captcha() {
	 	$('#captchaimg').attr('src', SITE_URL+'index.php?file=m-getcaptcha&rnd=' + Math.random());
	}
	change_captcha();
	$('img#refresh').click(change_captcha);
	$('#fpsend').click(function()
	{
		var vld = $('#frmfp').valid();
		if(! vld) { change_captcha(); return false; }
		var url = SITE_URL+"index.php?file=m-aj_forgotpass";
		var pars = $('#frmfp').serialize();
		$.ajax({type:"get", url:url, data:pars, success:function(resp) {
			if(resp == LBL_WRONG_USER_DETAILS) {
				$('#msg').html('');
				$('#msg').append(resp);
				change_captcha();
				if($('#frmfp').validate().element('#scode')) { $('#scode').val(''); }
			} else {
				$('#msg').html('');
				$('#msg').append(resp);
				change_captcha();
				$('#cap').hide();
				$('#sq').html('');
				$('#frmfp')[0].reset();
			}
			return false;
		}});
	});
});