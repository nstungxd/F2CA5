$(document).ready(function()
{
	function change_captcha() {
	 	$('#captchaimg').attr('src', SITE_URL+'index.php?file=m-getcaptcha&rnd=' + Math.random());
	}
	change_captcha();
	$('img#refresh').click(change_captcha);
	//
	$('#frmorgreg').validate({
		ignore: ':hidden',
		rules: {
			"vUserName": {
				remote: {
					 url:SITE_URL+"index.php?file=u-aj_chkdupdata",
					 type:"get",
					 data: {
						val:function() {
							return '';
						},
						id:function() {
							return "iUserID";
						},
						field:function() {
							return "vUserName";
						},
						vUserName:function() {
							return $("#vUserName").val();
						},
						extfld: function() {
							return "iOrganizationID";
						},
						extval: function() {
							return $("#iOrganizationID").val();
						},
						table:function() {
							return PRJ_DB_PREFIX + "_organization_user";
						}
					}
				}
			},
			"vCompanyName": {
				remote: {
					 url:SITE_URL+"index.php?file=u-aj_chkdupdata",
					 type:"get",
					 data: {
						val:function() {
							return '';
						},
						id:function() {
							return "iOrganizationID";
						},
						field:function() {
							return "vCompanyName";
						},
						vCompanyName:function() {
							return $("#vCompanyName").val();
						},
						table:function() {
							return PRJ_DB_PREFIX + "_organization_master";
						}
					}
				}
			},
			"vCompCode": {
				remote: {
					 url:SITE_URL+"index.php?file=u-aj_chkdupdata",
					 type:"get",
					 data: {
						val:function() {
							return '';
						},
						id:function() {
							return "iOrganizationID";
						},
						field:function() {
							return "vCompCode";
						},
						vCompCode:function() {
							return $("#vCompCode").val();
						},
						table:function() {
							return PRJ_DB_PREFIX + "_organization_master";
						}
					}
				}
			},
			"vCompanyRegNo": {
				remote: {
					 url:SITE_URL+"index.php?file=or-aj_chkdupdata",
					 type:"get",
					 data: {
						val:function() {
							return '';
						},
						id:function() {
							return "iOrganizationID";
						},
						field:function() {
							return "vCompanyRegNo";
						},
						vCompanyRegNo:function() {
							return $("#vCompanyRegNo").val();
						},
						country:function() {
							return $("#vCountry").val();
						},
						orgtype:function() {
							return $("#eOrganizationType").val();
						},
						table:function() {
							return PRJ_DB_PREFIX + "_organization_master";
						}
					}
				}
			},
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
			},
			"vPhone": {
				required: true
			}
		},
		messages: {
			"vUserName": {
				required: LBL_ENTER_USER_NAME,
				remote: jQuery.validator.format(LBL_USERNAME_TAKEN)
			},
			"vCompanyRegNo": {
				remote: jQuery.validator.format(LBL_COMPANY_REG_NO)
			},
			"vCompanyName": {
				remote: jQuery.validator.format(LBL_COMPANY_NAME)
			},
			"vCompCode": {
				alphaNum : LBL_ONLY_APLHA_NUM,
				remote: jQuery.validator.format(LBL_COMP_CODE_TAKEN)
			},
			"vEmail": {
				required: LBL_EMAIL_ADDRESS,
				email: LBL_VALID_EMAIL_ADDRESS,
				remote: jQuery.validator.format(LBL_EMAIL_TAKEN)
			},
			"vPassword": { minlength: LBL_FIVE_CHAR_REQUIRED },
			"vConPassword": { equalto: MSG_CON_PASS },
			"vZipcode": {required: LBL_ZIPCODE},
			"eOrganizationType": {required: LBL_ORGANIZATION_TYPE},
			"scode": { remote: jQuery.validator.format(LBL_CODE_NOT_MATCHED) }
		}
	});
	function frmsubmit()
	{
		var vld = $('#frmorgreg').valid();
		if(! vld) {
			change_captcha();
			if($('#frmorgreg').validate().element('#scode')) { $('#scode').val(''); }
			return false;
		}
		$('#frmorgreg')[0].submit();
		$('#frmorgreg').unbind('click');
	}
	$('#fpsend').click(frmsubmit);
	//
	function fillbankdtls() {
		var url = SITE_URL+"index.php?file=or-aj_fillbankdtls";
		var pars = "&bankid="+$('#iBankId').val()+"&flds=vSwiftCode&tflds=vBankCode";
		$.ajax({type:"get", url:url, data:pars, success:function(resp) {
				$('.ajscript').attr('innerHTML','');
				$('.ajscript').append(resp);
			}
		});
	}
	$('#iBankId').change(fillbankdtls);
	fillbankdtls();
});