<?php /* Smarty version 2.6.0, created on 2012-05-31 15:42:59
         compiled from left/organization/left.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'preg_match', 'left/organization/left.tpl', 4, false),array('modifier', 'cat', 'left/organization/left.tpl', 11, false),array('modifier', 'strripos', 'left/organization/left.tpl', 11, false),array('modifier', 'strpos', 'left/organization/left.tpl', 18, false),array('function', 'assign', 'left/organization/left.tpl', 9, false),)), $this); ?>
<div class="left-menu">
    <h1><?php echo $this->_tpl_vars['LBL_NAVIGATION']; ?>
</h1>
    <dl><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
</dl>
		  <ul <?php if (((is_array($_tmp='/(.*)(oadashboard)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(inbox)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
oadashboard" <?php if (((is_array($_tmp='/(.*)(oadashboard)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
</a></li>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
inbox" <?php if (((is_array($_tmp='/(.*)(inbox)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_INBOX']; ?>
 <strong>(<?php echo $this->_tpl_vars['totInboxres']; ?>
)</strong></a></li>
         </ul>
         <dl><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
</dl>
         <?php echo smarty_function_assign(array('var' => 'orgur','value' => 'createorganization'), $this);?>

			<?php echo smarty_function_assign(array('var' => 'olink','value' => 'createorganization/'), $this);?>

         <ul <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'createorganization') : smarty_modifier_cat($_tmp, 'createorganization')) || ((is_array($_tmp='/(.*)(createorganizationpref)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(organizationview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(organizationprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strripos', true, $_tmp, $this->_tpl_vars['olink']) : strripos($_tmp, $this->_tpl_vars['olink'])) !== false): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
createorganization/<?php echo $this->_tpl_vars['curORGID']; ?>
" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orgur']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orgur'])) || ((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strripos', true, $_tmp, $this->_tpl_vars['olink']) : strripos($_tmp, $this->_tpl_vars['olink'])) !== false || ((is_array($_tmp='/(.*)(createorganizationpref)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(organizationview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(createorganizationpref)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_EDIT_ORG_INFO']; ?>
</a></li>
         </ul>
        <dl><?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</dl>
		   <ul <?php if (((is_array($_tmp='/(.*)(createassociation)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(associationview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(associationlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
createassociation" <?php if (((is_array($_tmp='/(.*)(createassociation)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(associationview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_CREATE_MODIFY']; ?>
</a></li>
		   <?php echo smarty_function_assign(array('var' => 'linkurl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'associationlist') : smarty_modifier_cat($_tmp, 'associationlist'))), $this);?>

		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
associationlist" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'associationlist') : smarty_modifier_cat($_tmp, 'associationlist')) && ((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['linkurl']) : strpos($_tmp, $this->_tpl_vars['linkurl'])) !== false): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_ASSO_LIST']; ?>
</a></li>
		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifyassociationlist" <?php if (((is_array($_tmp='/(.*)(verifyassociationlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY_ASSOCIATION']; ?>
</a></li>
		   </ul>

		  <?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
		  <dl><?php echo $this->_tpl_vars['LBL_NEW_ASSOCIATIONS']; ?>
</dl>
		  <ul <?php if (((is_array($_tmp='/(.*)(b2)(.*)(asoc)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
		  <?php if ($this->_tpl_vars['uorg_type'] != 'Supplier'): ?>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2buyerasoclist" <?php if (( ((is_array($_tmp='/(.*)(b2buyerasoc)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) && strpos ( $this->_tpl_vars['currentUrl'] , 'b2buyerasocvlist' ) === false ) || ((is_array($_tmp='/(.*)(b2buyerasoclist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(b2buyerasocview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_BUYER2_BUYER']; ?>
</a></li>
				<?php if ($this->_tpl_vars['uorg_type'] == 'Buyer2'): ?><li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2buyerasocvlist" <?php if (((is_array($_tmp='/(.*)(b2buyerasocvlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2_BUYER']; ?>
</a></li><?php endif; ?>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2bprdtbasoclist" <?php if (( ((is_array($_tmp='/(.*)(b2bprodtbasoc)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) && strpos ( $this->_tpl_vars['currentUrl'] , 'b2bprdtbasocvlist' ) === false ) || ((is_array($_tmp='/(.*)(b2bprdtbasoclist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(b2bprodtbasocview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_BUYER2_BPRODUCT_BUYER']; ?>
</a></li>
				<?php if ($this->_tpl_vars['uorg_type'] == 'Buyer2'): ?><li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2bprdtbasocvlist" <?php if (((is_array($_tmp='/(.*)(b2bprdtbasocvlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2_BPRODUCT_BUYER']; ?>
</a></li><?php endif; ?>
		  <?php endif; ?>
		  <?php if ($this->_tpl_vars['uorg_type'] != 'Buyer'): ?>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2supplierasoclist" <?php if (( ((is_array($_tmp='/(.*)(b2supplierasoc)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) && strpos ( $this->_tpl_vars['currentUrl'] , 'b2supplierasocvlist' ) === false ) || ((is_array($_tmp='/(.*)(b2supplierasoclist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(b2supplierasocview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_BUYER2_SUPPLIER']; ?>
</a></li>
				<?php if ($this->_tpl_vars['uorg_type'] == 'Buyer2'): ?><li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2supplierasocvlist" <?php if (((is_array($_tmp='/(.*)(b2supplierasocvlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2_SUPPLIER']; ?>
</a></li><?php endif; ?>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2sprdtsasoclist" <?php if (( ((is_array($_tmp='/(.*)(b2sprodtsasoc)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) && strpos ( $this->_tpl_vars['currentUrl'] , 'b2sprdtsasocvlist' ) === false ) || ((is_array($_tmp='/(.*)(b2sprdtsasoclist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(b2sprodtsasocview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_BUYER2_SPRODUCT_SUPPLIER']; ?>
</a></li>
				<?php if ($this->_tpl_vars['uorg_type'] == 'Buyer2'): ?><li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2sprdtsasocvlist" <?php if (((is_array($_tmp='/(.*)(b2sprdtsasocvlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2_SPRODUCT_SUPPLIER']; ?>
</a></li><?php endif; ?>
		  <?php endif; ?>
		  </ul>
		  <?php endif; ?>

         <dl><?php echo $this->_tpl_vars['LBL_USER']; ?>
</dl>
		   <ul <?php if (((is_array($_tmp='/(.*)(createorganizationuser)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(organizationuserview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(userrights)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(organizationuserlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(assignrights)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(creategroup)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(grouplist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(groupview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(verifyrights)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(listrights)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
createorganizationuser" <?php if (((is_array($_tmp='/(.*)(createorganizationuser)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(organizationuserview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_CREATE_USER']; ?>
</a></li>
		   <?php echo smarty_function_assign(array('var' => 'linkurl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'organizationuserlist') : smarty_modifier_cat($_tmp, 'organizationuserlist'))), $this);?>

		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationuserlist" <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['linkurl']) : strpos($_tmp, $this->_tpl_vars['linkurl'])) !== false): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_USER_LIST']; ?>
</a></li>
		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifyorganizationuserlist" <?php if (((is_array($_tmp='/(.*)(verifyorganizationuserlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY_USER']; ?>
</a></li>
		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
assignrights" <?php if (((is_array($_tmp='/(.*)(assignrights)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(userrights)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_ASSIGN_RIGHTS_USER']; ?>
</a></li>
		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
listrights" <?php if (((is_array($_tmp='/(.*)(listrights)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_USER_RIGHTS']; ?>
</a></li>
		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifyrights" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'verifyrights') : smarty_modifier_cat($_tmp, 'verifyrights'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY_USER_RIGHTS']; ?>
</a></li>
		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
creategroup" <?php if (((is_array($_tmp='/(.*)(creategroup)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(groupview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_CREATE_GROUP']; ?>
</a></li>
		   <?php echo smarty_function_assign(array('var' => 'linkurl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'grouplist') : smarty_modifier_cat($_tmp, 'grouplist'))), $this);?>

		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
grouplist" <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['linkurl']) : strpos($_tmp, $this->_tpl_vars['linkurl'])) !== false): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_GROUP_LIST']; ?>
</a></li>
		   <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifygrouplist" <?php if (((is_array($_tmp='/(.*)(verifygrouplist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
 <?php echo $this->_tpl_vars['LBL_GROUP']; ?>
</a></li>
		   		   </ul>

			<dl><?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
</dl>
         <?php echo smarty_function_assign(array('var' => 'povu','value' => 'polist'), $this);?>

         <ul <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'polist/all') : smarty_modifier_cat($_tmp, 'polist/all')) || ((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strripos', true, $_tmp, $this->_tpl_vars['povu']) : strripos($_tmp, $this->_tpl_vars['povu'])) > 0 || ((is_array($_tmp='/(.*)(purchaseorderview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
              <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist/all"><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
</a></li>
			         </ul>
         <dl><?php echo $this->_tpl_vars['LBL_INVOICE']; ?>
</dl>
         <?php echo smarty_function_assign(array('var' => 'invu','value' => 'invoicelist'), $this);?>

			<ul <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'invoicelist/all') : smarty_modifier_cat($_tmp, 'invoicelist/all')) || ((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strripos', true, $_tmp, $this->_tpl_vars['invu']) : strripos($_tmp, $this->_tpl_vars['invu'])) > 0 || ((is_array($_tmp='/(.*)(invoiceview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invoiceviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
               <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicelist/all"><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
</a></li>
					  </ul>

		  <?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
		  <dl id='ia'><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</dl>
		  <ul <?php if (((is_array($_tmp='/(.*)(rfq2list)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(rfq2watchlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
				<ld><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2list" <?php if (((is_array($_tmp='/(.*)(rfq2list)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2_LIST']; ?>
</a></li>
				<br/>
				<ld><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2bidlist" <?php if (((is_array($_tmp='/(.*)(rfq2bidlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
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

        <dl><?php echo $this->_tpl_vars['LBL_PREFERENCE']; ?>
</dl>
        <ul <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'oaeditprofile') : smarty_modifier_cat($_tmp, 'oaeditprofile')) || $this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'changepass') : smarty_modifier_cat($_tmp, 'changepass')) || $this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'logout') : smarty_modifier_cat($_tmp, 'logout'))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
oaeditprofile" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'oaeditprofile') : smarty_modifier_cat($_tmp, 'oaeditprofile'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_EDIT_PROFILE']; ?>
</a></li>
            <li><a class="colorbox cboxElement" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'changepass') : smarty_modifier_cat($_tmp, 'changepass'))): ?>class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
changepass/<?php echo $this->_tpl_vars['iUserId']; ?>
" onmouseover="CallColoerBox(this.href,630,315,'file');"><?php echo $this->_tpl_vars['LBL_CHANGE_PASSWORD']; ?>
</a></li>
            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
logout" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'logout') : smarty_modifier_cat($_tmp, 'logout'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_LOGOUT']; ?>
</a></li>
        </ul>
</div>
<?php echo '
<script>
var curURl = \'';  echo $this->_tpl_vars['currentUrl'];  echo '\';
$(\'.left-menu ul\').each(function(){
    var chkSel =0;
    $(this).children(\'li\').each(function(){
       if($(this).children(\'a\').attr(\'href\') == curURl){
         $(this).children(\'a\').addClass(\'active\');
         chkSel++;
       }else{
         // $(this).children(\'a\').removeClass(\'active\');
       }
    });
   if(chkSel > 0){
      $(this).show();
   }else{
      // $(this).hide();
   }
});
/*
$(\'.left-menu ul\').children(\'li\').children(\'a\').click(function(){
   urlhref = $(this).attr(\'href\');
   if(urlhref.search(\'changepass\') != -1)
       return true;

   url = SITE_URL_DUM+"session.php?seturl="+urlhref;
   pars=\'\';
   $.post(url, pars, function(resp){
      //alert(resp);
      if(resp !=\'ok\'){
         return false;
      }else{
           //return true;

           //CallColoerBox(urlhref,550,315,\'file\');
         window.location = urlhref;
      }
   });
   return false;
   //$(\'#mid_content\').load(url);
})
*/
// $(\'.left-menu dl\').each(function(){
//   $(this).click(function(){
      //alert($(this).next(\'ul\').attr(\'style\'));
//      $(this).next(\'ul\').toggle(\'slow\');
      /*if($(this).next(\'ul\').attr(\'style\') == \'display: none;\' || $(this).next(\'ul\').attr(\'style\') == \'DISPLAY: none\'){
         $(this).next(\'ul\').show(\'slow\');
      }else{
         $(this).next(\'ul\').hide(\'slow\');
      }*/
//   });
//});
</script>
'; ?>