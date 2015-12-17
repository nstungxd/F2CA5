<?php /* Smarty version 2.6.0, created on 2015-06-11 13:03:32
         compiled from top/top.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'preg_replace', 'top/top.tpl', 21, false),)), $this); ?>
<form name="frmlanguage" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=c-language" method="post" style="margin:0px; padding:0px;">
	<input type="Hidden" name="lang_code" id="lang_code" />
<div id="top-menu">
	<ul id="nav-tabstrips">
     <?php if ($this->_tpl_vars['curSessid'] != ''): ?><li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'c-home' || $this->_tpl_vars['file'] == ''): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
</em></a></li><?php else: ?><li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
home" class="<?php if ($this->_tpl_vars['file'] == 'c-home' || $this->_tpl_vars['file'] == ''): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_HOME']; ?>
</em></a></li><?php endif; ?>
	  <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
aboutus" class="<?php if ($this->_tpl_vars['file'] == 'c-aboutus'): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_ABOUT_US']; ?>
</em></a></li>
	  <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
contactus" class="<?php if ($this->_tpl_vars['file'] == 'c-contactus'): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_CONTACT_US']; ?>
</em></a></li>
	  <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
privacypolicy" class="<?php if ($this->_tpl_vars['file'] == 'c-privacypolicy'): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_PRIVACY_POLICY']; ?>
</em></a></li>
	</ul>
   	<span class="lang_flags" style="color:#c0cac0;"><span onclick="changLang('en');" style="cursor:pointer;" >EN</span>&nbsp;/&nbsp;<span onclick="changLang('fr');" style="cursor:pointer;" >FR&nbsp;&nbsp;</span></span>
</div>
<div class="clear" style="height:1px;"></div>
<div class="relative">
	<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
hn-shadow.png" class="home-banner-img" height="170px" />
</div>
<div class="banner-left" align="center">
	<div class="logo"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
exchainge-cloud2.png" alt="" border="0" height="79px" /></div>
</div>
<div class="banner-right welcome-text">
<?php echo ((is_array($_tmp='/\<p\>|\<\/p\>/i')) ? $this->_run_mod_handler('preg_replace', true, $_tmp, '', $this->_tpl_vars['topwelcometext']) : preg_replace($_tmp, '', $this->_tpl_vars['topwelcometext'])); ?>

</div>
<div class="clear" style="height:3px;">&nbsp;</div>
</form>
<?php echo '
<script>
function changLang(val) {
   document.frmlanguage.lang_code.value = val;
	document.frmlanguage.submit();
}
</script>
'; ?>