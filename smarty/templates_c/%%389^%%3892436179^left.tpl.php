<?php /* Smarty version 2.6.0, created on 2015-06-20 22:16:22
         compiled from left/user/left.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'preg_match', 'left/user/left.tpl', 4, false),array('modifier', 'cat', 'left/user/left.tpl', 13, false),array('modifier', 'is_array', 'left/user/left.tpl', 14, false),array('modifier', 'count', 'left/user/left.tpl', 14, false),array('modifier', 'strpos', 'left/user/left.tpl', 18, false),array('modifier', 'htmlentities', 'left/user/left.tpl', 18, false),array('modifier', 'strripos', 'left/user/left.tpl', 32, false),array('function', 'assign', 'left/user/left.tpl', 11, false),)), $this); ?>
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

    <?php if ($this->_tpl_vars['orgtype'] != 'Supplier'): ?>
    <dl id='pi'><?php echo $this->_tpl_vars['LBL_PO_ISSUANCE']; ?>
</dl>
    <?php echo smarty_function_assign(array('var' => 'povu','value' => 'polist'), $this);?>

    <ul <?php if (((is_array($_tmp='/(.*)(polist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(purchaseorderview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist/all" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'polist/all') : smarty_modifier_cat($_tmp, 'polist/all'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
</a></li>
        <?php if (((is_array($_tmp=$this->_tpl_vars['poOrgStatus'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['poOrgStatus']) > 0): ?>
         <?php if (count($_from = (array)$this->_tpl_vars['poOrgStatus'])):
    foreach ($_from as $this->_tpl_vars['status']):
?>
            <?php echo smarty_function_assign(array('var' => 'poUrl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'polist/') : smarty_modifier_cat($_tmp, 'polist/'))), $this);?>

            <?php echo smarty_function_assign(array('var' => 'poUrl','value' => ((is_array($_tmp=$this->_tpl_vars['poUrl'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['status']['iStatusID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['status']['iStatusID']))), $this);?>

            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist/<?php echo $this->_tpl_vars['status']['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['poUrl']) : strpos($_tmp, $this->_tpl_vars['poUrl'])) !== false): ?>class="active"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['status']['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a></li>
         <?php endforeach; unset($_from); endif; ?>
        <?php endif; ?>
            </ul>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['orgtype'] != 'Buyer'): ?>
    <dl id='ii'><?php echo $this->_tpl_vars['LBL_INVOICE_ISSUANCE']; ?>
</dl>
    <?php echo smarty_function_assign(array('var' => 'invu','value' => 'invoicelist'), $this);?>

        <ul <?php if (((is_array($_tmp='/(.*)(invoicelist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strripos', true, $_tmp, $this->_tpl_vars['invu']) : strripos($_tmp, $this->_tpl_vars['invu'])) > 0 || ((is_array($_tmp='/(.*)(invoiceview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invoiceviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicelist/all" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'invoicelist/all') : smarty_modifier_cat($_tmp, 'invoicelist/all'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
</a></li>
        <?php if (((is_array($_tmp=$this->_tpl_vars['invOrgStatus'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['invOrgStatus']) > 0): ?>
         <?php if (count($_from = (array)$this->_tpl_vars['invOrgStatus'])):
    foreach ($_from as $this->_tpl_vars['status']):
?>
            <?php echo smarty_function_assign(array('var' => 'invUrl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'invoicelist/') : smarty_modifier_cat($_tmp, 'invoicelist/'))), $this);?>

            <?php echo smarty_function_assign(array('var' => 'invUrl','value' => ((is_array($_tmp=$this->_tpl_vars['invUrl'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['status']['iStatusID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['status']['iStatusID']))), $this);?>

            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicelist/<?php echo $this->_tpl_vars['status']['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['invUrl']) : strpos($_tmp, $this->_tpl_vars['invUrl'])) !== false): ?>class="active"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['status']['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a></li>
         <?php endforeach; unset($_from); endif; ?>
        <?php endif; ?>
            </ul>
    <?php endif; ?>

	 <?php if ($this->_tpl_vars['orgtype'] != 'Buyer'): ?>
    <dl id='pa'><?php echo $this->_tpl_vars['LBL_PO_ACCEPTANCE']; ?>
</dl>
    <?php echo smarty_function_assign(array('var' => 'povu','value' => 'poacptlist'), $this);?>

    <ul <?php if (((is_array($_tmp='/(.*)(poacptlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(purchaseorderview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poacptlist/all" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'poacptlist/all') : smarty_modifier_cat($_tmp, 'poacptlist/all'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
</a></li>
        <?php if (((is_array($_tmp=$this->_tpl_vars['poOrgAcpt'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['poOrgAcpt']) > 0): ?>
         <?php if (count($_from = (array)$this->_tpl_vars['poOrgAcpt'])):
    foreach ($_from as $this->_tpl_vars['status']):
?>
         	<?php if ($this->_tpl_vars['status']['vStatus'] != $this->_tpl_vars['LBL_ISSUE'] && $this->_tpl_vars['status']['vStatus'] != 'Issue' && $this->_tpl_vars['status']['vStatus'] != 'Délivré' && $this->_tpl_vars['status']['vStatus'] != 'Issued'): ?>
            <?php echo smarty_function_assign(array('var' => 'poUrl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'poacptlist/') : smarty_modifier_cat($_tmp, 'poacptlist/'))), $this);?>

            <?php echo smarty_function_assign(array('var' => 'poUrl','value' => ((is_array($_tmp=$this->_tpl_vars['poUrl'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['status']['iStatusID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['status']['iStatusID']))), $this);?>

            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poacptlist/<?php echo $this->_tpl_vars['status']['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['poUrl']) : strpos($_tmp, $this->_tpl_vars['poUrl'])) !== false): ?>class="active"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['status']['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a></li>
            <?php endif; ?>
         <?php endforeach; unset($_from); endif; ?>
        <?php endif; ?>
    </ul>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['orgtype'] != 'Supplier'): ?>
    <dl id='ia'><?php echo $this->_tpl_vars['LBL_INVOICE_ACCEPTANCE']; ?>
</dl>
    <?php echo smarty_function_assign(array('var' => 'invu','value' => 'invacptlist'), $this);?>

    <ul <?php if (((is_array($_tmp='/(.*)(invacptlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strripos', true, $_tmp, $this->_tpl_vars['invu']) : strripos($_tmp, $this->_tpl_vars['invu'])) > 0 || ((is_array($_tmp='/(.*)(invoiceview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invoiceviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invacptlist/all" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'invacptlist/all') : smarty_modifier_cat($_tmp, 'invacptlist/all'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
</a></li>
        <?php if (((is_array($_tmp=$this->_tpl_vars['invOrgAcpt'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['invOrgAcpt']) > 0): ?>
         <?php if (count($_from = (array)$this->_tpl_vars['invOrgAcpt'])):
    foreach ($_from as $this->_tpl_vars['status']):
?>
         	<?php if ($this->_tpl_vars['status']['vStatus'] != $this->_tpl_vars['LBL_ISSUE'] && $this->_tpl_vars['status']['vStatus'] != 'Issue' && $this->_tpl_vars['status']['vStatus'] != 'Délivré' && $this->_tpl_vars['status']['vStatus'] != 'Issued'): ?>
            <?php echo smarty_function_assign(array('var' => 'invUrl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'invacptlist/') : smarty_modifier_cat($_tmp, 'invacptlist/'))), $this);?>

            <?php echo smarty_function_assign(array('var' => 'invUrl','value' => ((is_array($_tmp=$this->_tpl_vars['invUrl'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['status']['iStatusID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['status']['iStatusID']))), $this);?>

            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invacptlist/<?php echo $this->_tpl_vars['status']['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['invUrl']) : strpos($_tmp, $this->_tpl_vars['invUrl'])) !== false): ?>class="active"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['status']['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a></li>
            <?php endif; ?>
         <?php endforeach; unset($_from); endif; ?>
        <?php endif; ?>
            </ul>
    <?php endif; ?>
	 
    <?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
    <dl ><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</dl>
	 <?php echo smarty_function_assign(array('var' => 'invu','value' => 'invacptlist'), $this);?>

    <ul <?php if (((is_array($_tmp='/(.*)(rfq2)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
		  <ld><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2list" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'rfq2list') : smarty_modifier_cat($_tmp, 'rfq2list'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2_LIST']; ?>
</a></li>
		  <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2vlist" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'rfq2vlist') : smarty_modifier_cat($_tmp, 'rfq2vlist'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY_RFQ2']; ?>
</a></li>
		  <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2rlist" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'rfq2rlist') : smarty_modifier_cat($_tmp, 'rfq2rlist'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_REJECTED']; ?>
 <?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</a></li>
		  <br/>
		  <ld><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2bidlist" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'rfq2bidlist') : smarty_modifier_cat($_tmp, 'rfq2bidlist'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</a></li>
		  <br/>
		  <ld><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_AWARD']; ?>
<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2awardlist" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'rfq2awardlist') : smarty_modifier_cat($_tmp, 'rfq2awardlist'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_AWARD']; ?>
</a></li>
    </ul>

        <?php endif; ?>
	 
	 <dl id='pf'><?php echo $this->_tpl_vars['LBL_REPORTS']; ?>
</dl>
	 <ul <?php if (((is_array($_tmp='/(.*)(reportsrpt)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
reportsrpt" <?php if (((is_array($_tmp='/(.*)(reportsrpt)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_REPORTS']; ?>
</a></li>
    </ul>
	 
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
/*$(\'.left-menu ul\').each(function(){
    var chkSel =0;
    $(this).children(\'li\').each(function(){
       if($(this).children(\'a\').attr(\'href\') == curURl){
         $(this).children(\'a\').addClass(\'active\');
         chkSel++;
       }else{
         $(this).children(\'a\').removeClass(\'active\');
       }
    });
   if(chkSel > 0){
      $(this).show();
   }else{
      $(this).hide();
   }
});
*/
/*
$(\'.left-menu ul\').children(\'li\').children(\'a\').click(function(){
  urlhref = $(this).attr(\'href\');
  if(urlhref.search(\'changepass\') != -1)
       return true;
  url = urlhref;
   pars=\'\';
   $.post(url, pars, function(resp){
      //alert(resp);
      if(resp !=\'ok\'){
         return false;
      }else{
         window.location = urlhref;
      }
   });
   return false;
   //$(\'#mid_content\').load(url);
})
$(document).ready( function() {
//
});
*/

//$(\'.left-menu dl\').each(function(){
//   $(this).click(function(){
      //alert($(this).next(\'ul\').attr(\'style\'));
//      $(this).next(\'ul\').toggle(\'slow\');
      /*if($(this).next(\'ul\').attr(\'style\') == \'display: none;\' || $(this).next(\'ul\').attr(\'style\') == \'DISPLAY: none\'){
         $(this).next(\'ul\').show(\'slow\');
      }else{
         $(this).next(\'ul\').hide(\'slow\');
      }*/
//   });
// });
</script>
'; ?>