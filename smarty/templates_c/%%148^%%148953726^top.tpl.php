<?php /* Smarty version 2.6.0, created on 2015-06-11 13:31:38
         compiled from top/securitymanager/top.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strpos', 'top/securitymanager/top.tpl', 23, false),)), $this); ?>
<form name="frmlanguage" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=c-language" method="post" style="margin:0px; padding:0px;">
	<input type="Hidden" name="lang_code" id="lang_code" />
<div id="top-part">
	<div class="logo">
      <a href="#"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
exchainge.png" alt="" align="left" height="52" width="74" /></a>
      <span class="lang_flags" style="padding:0px; color:#c0cec0;"><span onclick="changLang('en');" style="cursor:pointer; padding:0px;" >EN</span>&nbsp;/&nbsp;<span onclick="changLang('fr');" style="cursor:pointer; padding:0px;" >FR</span></span>
      <!--<span style="display: inline-block; padding-top: 19px;"><a class="lg" href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
logout"><b>Logout</b></a></span>-->
	</div>
	<div class="header">
		<!--<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/img-text.png" alt="" width="281" height="29" />-->
		<font size="6"><b><?php echo $this->_tpl_vars['LBL_SECURITY_MANAGER']; ?>
</b></font>
		<br />
		<span> <strong> </span>
	</div>
	<div class="tab-bottline">
		<div style="float:right; height:19px; padding-top:9px; padding-right:5px;">
        <strong><?php echo $this->_tpl_vars['LBL_WELCOME']; ?>
 ,</strong>
        <span class="orange-text"><?php echo $this->_tpl_vars['sess_user_name']; ?>
 (<?php echo $this->_tpl_vars['sess_usertype_short']; ?>
)</span>
        &nbsp;<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
logout"><?php echo $this->_tpl_vars['LBL_LOGOUT']; ?>
</a>
   	</div>
		<ul id="top-navi">
			<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
smdashboard" class="<?php if ($this->_tpl_vars['file'] == 'sm-smdashboard'): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_SUMMARY']; ?>
</em></a></li>
			<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationlist" class="<?php if (( ((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'organization') : strpos($_tmp, 'organization')) != false || ((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'org') : strpos($_tmp, 'org')) != false ) && ((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'user') : strpos($_tmp, 'user')) == false): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_ORGANIZATIONS']; ?>
</em></a></li>
			<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
associationlist" class="<?php if (((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'association') : strpos($_tmp, 'association')) != false): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_ASSOCIATIONS']; ?>
</em></a></li>
			<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationuserlist" class="<?php if (((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'user') : strpos($_tmp, 'user')) != false): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_USERS']; ?>
</em></a></li>
		</ul>
	</div>
</div>
</form>
<?php echo '
<script type="text/javascript">
function changLang(val) {
   document.frmlanguage.lang_code.value = val;
	document.frmlanguage.submit();
}
</script>
'; ?>