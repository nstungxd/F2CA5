<?php /* Smarty version 2.6.0, created on 2012-05-30 22:30:33
         compiled from member/changepass.tpl */ ?>
<div id="Password_details">
<h3 align="center"><b><?php echo $this->_tpl_vars['LBL_CHANGE_PASSWORD']; ?>
</b></h3>
<form id="chpas" name="chpas" method="post" action="">
<input type="hidden" name="iUserId" id="iUserId" value="<?php echo $this->_tpl_vars['iUserId']; ?>
" />

<div style="padding-left:30px;">
	<?php if ($this->_tpl_vars['msg'] != ''): ?>
		<?php echo '
			<script>
			$(document).ready(function() {
				var msg=\'';  echo $this->_tpl_vars['msg'];  echo '\';
				if(msg!= \'\' && msg != undefined)
				alert(msg);
			});
			</script>
		'; ?>

	<?php endif; ?>
	<div>
		<label class="lbl" for="pass" style="width:159px;font-size: 14px"><?php echo $this->_tpl_vars['LBL_OLD']; ?>
 <?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
</label>
      <label>:</label>
		<input type="password" name="vOldPassword" id="vOldPassword" class="required"  value="" onkeypress="return chkSpace(event);" style="width:210px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_OLD']; ?>
 <?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
" >
		<div htmlfor="vOldPassword" generated="true" class="err" style="position:absolute; padding-left:171px;"></div>
		<br/>
	</div>
	<br/>
	<div>
		<label class="lbl" for="pass" style="width:159px;font-size: 14px"><?php echo $this->_tpl_vars['LBL_NEW']; ?>
 <?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
</label>
		<label>:</label>
      <input type="password" name="Data[vPassword]" id="vPassword" class="required" minlength="5" value="" onkeypress="return chkSpace(event);" style="width:210px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_NEW']; ?>
 <?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
" >
		<span class="" style="position:absolute; font-size:10px; margin-left:10px;"><?php echo $this->_tpl_vars['LBL_PASSWORD_STRENGTH']; ?>
<span id="pst"></span><div id="psi" class="is0" style=""></div></span>
		<div htmlfor="vPassword" generated="true" class="err" style="position:absolute; padding-left:171px;"></div>
		<br/>
	</div>
	<br/>
	<div>
		<label class="lbl" for="confpass" style="width:159px;font-size: 14px"><?php echo $this->_tpl_vars['LBL_CONFIRM']; ?>
 <?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
</label>
		<label>:</label>
      <input type="password" name="vConPassword" id="vConPassword" value="" onkeydown="return noCTRL(event);" oncontextmenu="return false;" equalTo='#vPassword' style="width:210px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_CONFIRM']; ?>
 <?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
" >
	</div>
	<br/>
	<div>
		<label class="lbl" style="width:167px;">&nbsp;</label>
		<a class="btllbl" style="textarea-decoration:none;" name="changepassword" id="changepassword" title="<?php echo $this->_tpl_vars['LBL_CHANGE_PASSWORD']; ?>
" onclick="// $('#chpas').submit();"><b><?php echo $this->_tpl_vars['LBL_SUBMIT']; ?>
</b></a>
	</div>
</div>
</form>
</div>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.passwordstrength.js"></script>
<?php echo '
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
	$(\'#vPassword\').passwordStrength({targetElement:\'#psi\', targetTextElement:\'#pst\', psimsg:["';  echo $this->_tpl_vars['LBL_WEAK'];  echo '","';  echo $this->_tpl_vars['LBL_MEDIUM'];  echo '","';  echo $this->_tpl_vars['LBL_STRONG'];  echo '","';  echo $this->_tpl_vars['LBL_VERY_STRONG'];  echo '"]});
	$(\'#changepassword\').click(function() {
		var vld = $(\'#chpas\').valid();
		if(!vld) { return false; }
		$(\'#chpas\')[0].submit();
	});
});
</script>
'; ?>