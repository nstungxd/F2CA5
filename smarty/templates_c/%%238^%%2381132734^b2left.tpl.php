<?php /* Smarty version 2.6.0, created on 2015-06-26 10:56:18
         compiled from left/user/b2left.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'preg_match', 'left/user/b2left.tpl', 4, false),array('modifier', 'cat', 'left/user/b2left.tpl', 22, false),)), $this); ?>
<div class="left-menu">
    <h1><?php echo $this->_tpl_vars['LBL_NAVIGATION']; ?>
</h1>
          <dl><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
</dl>
    <ul <?php if (((is_array($_tmp='/(.*)(oudashboard)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(inbox)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
oudashboard" <?php if (((is_array($_tmp='/(.*)(oudashboard)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
</a></li>
         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
inbox" <?php if (((is_array($_tmp='/(.*)(inbox)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_INBOX']; ?>
 <strong>(<?php echo $this->_tpl_vars['totInboxres']; ?>
)</strong></a></li>
    </ul>

	 <?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
    <dl id='ia'><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</dl>
    <ul <?php if (((is_array($_tmp='/(.*)(b2rfq2)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
		  <ld><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2list" <?php if (((is_array($_tmp='/(.*)(b2rfq2list)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2_LIST']; ?>
</a></li>
		  <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2watchlist" <?php if (((is_array($_tmp='/(.*)(b2rfq2watchlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2_WATCH_LIST']; ?>
</a></li>
		  <br/>
		  <ld><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
 <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2bidlist" <?php if (((is_array($_tmp='/(.*)(b2rfq2bidlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</a></li>
		  <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2bidvlist" <?php if (((is_array($_tmp='/(.*)(b2rfq2bidvlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
 <?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</a></li>
		  <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2bidrlist" <?php if (((is_array($_tmp='/(.*)(b2rfq2bidrlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_REJECTED']; ?>
 <?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</a></li>
		  <br/>
		  <ld><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_AWARD']; ?>
 <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2awardlist" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'b2rfq2awardlist') : smarty_modifier_cat($_tmp, 'b2rfq2awardlist'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_AWARD']; ?>
</a></li>
    </ul>

        <?php endif; ?>

	 
    <dl id='pf'><?php echo $this->_tpl_vars['LBL_PREFERENCE']; ?>
</dl>
    <ul <?php if (((is_array($_tmp='/(.*)(oueditprofile)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(changepass)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || $this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'logout') : smarty_modifier_cat($_tmp, 'logout'))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
oueditprofile" <?php if (((is_array($_tmp='/(.*)(oueditprofile)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_EDIT_PROFILE']; ?>
</a></li>
         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
changepass/<?php echo $this->_tpl_vars['iUserId']; ?>
" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'editprofile') : smarty_modifier_cat($_tmp, 'editprofile'))): ?>class="active"<?php endif; ?> onmouseover="CallColoerBox(this.href,630,315,'file');"><?php echo $this->_tpl_vars['LBL_CHANGE_PASSWORD']; ?>
</a></li>
         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
logout" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'logout') : smarty_modifier_cat($_tmp, 'logout'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_LOGOUT']; ?>
</a></li>
    </ul>
</div>
<?php echo '
<script>
var curURl = \'';  echo $this->_tpl_vars['currentUrl'];  echo '\';
</script>
'; ?>