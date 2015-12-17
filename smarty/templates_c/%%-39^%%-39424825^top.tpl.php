<?php /* Smarty version 2.6.0, created on 2015-06-11 15:00:30
         compiled from top/user/top.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strpos', 'top/user/top.tpl', 24, false),)), $this); ?>
<form name="frmlanguage" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=c-language" method="post" style="margin:0px; padding:0px;">
	<input type="Hidden" name="lang_code" id="lang_code" />
<div id="top-part">
	<div class="logo">
      <a href="#"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
exchainge.png" alt="" align="left" height="52" width="74"/></a>
		<span class="lang_flags" style="padding:0px; color:#c0cec0;"><span onclick="changLang('en');" style="cursor:pointer; padding:0px;" >EN</span>&nbsp;/&nbsp;<span onclick="changLang('fr');" style="cursor:pointer; padding:0px;" >FR</span></span>
		      <!--<span style="display: inline-block; padding-top: 19px;"><a class="lg" href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
logout"><b>Logout</b></a></span>-->
	</div>
	<div class="header">
		<!--<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/img-text.png" alt="" width="281" height="29" />-->
		<font size="6"><b><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
 <?php echo $this->_tpl_vars['LBL_USER']; ?>
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
oudashboard"  class="<?php if ($this->_tpl_vars['file'] == 'u-oudashboard' || $this->_tpl_vars['file'] == 'm-inbox'): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_SUMMARY']; ?>
</em></a></li>
			<?php if ($this->_tpl_vars['uorg_type'] == 'Buyer' || $this->_tpl_vars['uorg_type'] == 'Both'): ?><li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist/all" class="<?php if (((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'purchaseorder') : strpos($_tmp, 'purchaseorder')) != false || ((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'po') : strpos($_tmp, 'po')) != false): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
</em></a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['uorg_type'] == 'Supplier' || $this->_tpl_vars['uorg_type'] == 'Both'): ?><li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicelist/all" class="<?php if (((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'invoice') : strpos($_tmp, 'invoice')) != false): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_INVOICE']; ?>
</em></a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?><li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2list" class="<?php if (((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'rfq2') : strpos($_tmp, 'rfq2')) != false): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</em></a></li><?php endif; ?>
         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
oueditprofile" class="<?php if ($this->_tpl_vars['file'] == 'u-oueditprofile'): ?>current<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</em></a></li>
		</ul>
	</div>
</div>
</form>
<?php echo '
<script>

function changLang(val) {
   document.frmlanguage.lang_code.value = val;
	document.frmlanguage.submit();
}
</script>
'; ?>