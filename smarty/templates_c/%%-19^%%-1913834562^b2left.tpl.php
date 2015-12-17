<?php /* Smarty version 2.6.0, created on 2015-07-12 23:48:02
         compiled from left/user/b2left.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'preg_match', 'left/user/b2left.tpl', 28, false),array('modifier', 'cat', 'left/user/b2left.tpl', 61, false),array('modifier', 'is_array', 'left/user/b2left.tpl', 65, false),array('modifier', 'count', 'left/user/b2left.tpl', 65, false),array('modifier', 'strpos', 'left/user/b2left.tpl', 71, false),array('modifier', 'htmlentities', 'left/user/b2left.tpl', 71, false),array('modifier', 'strripos', 'left/user/b2left.tpl', 88, false),array('function', 'assign', 'left/user/b2left.tpl', 50, false),)), $this); ?>
<div id="nav-col">
					<section id="col-left" class="col-left-nano">
						<div id="col-left-inner" class="col-left-nano-content">
							<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
								<img alt="" src="img/samples/scarlet-159.png" />
								<div class="user-box">
									<span class="name">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											Scarlett J.
											<i class="fa fa-angle-down"></i>
										</a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
oueditprofile"><i class="fa fa-user"></i>Edit Profile</a></li>
											<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
changepass/<?php echo $this->_tpl_vars['iUserId']; ?>
"><i class="fa fa-cog"></i>Change Password</a></li>
											<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
logout"><i class="fa fa-power-off"></i>Logout</a></li>
										</ul>
									</span>
									<span class="status">
										<i class="fa fa-circle"></i> Online
									</span>
								</div>
							</div>
							<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
								<ul class="nav nav-pills nav-stacked">
									<li class="nav-header nav-header-first hidden-sm hidden-xs">
										<?php echo $this->_tpl_vars['LBL_NAVIGATION']; ?>

									</li>
									<li <?php if (((is_array($_tmp='/(.*)(oudashboard)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(inbox)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-dashboard"></i>
											<span><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
</span>
                                            <i class="fa fa-angle-right drop-icon"></i>
										</a>
                                        <ul class="submenu">
											<li>
												<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
oudashboard" <?php if (((is_array($_tmp='/(.*)(oudashboard)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>>
													<?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>

												</a>
											</li>
											<li>
												<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
inbox" <?php if (((is_array($_tmp='/(.*)(inbox)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>>
													<?php echo $this->_tpl_vars['LBL_INBOX']; ?>
 <strong>(<?php echo $this->_tpl_vars['totInboxres']; ?>
)</strong>
												</a>
											</li>
                                          </ul>
									</li>

									<!-- Anatoly -->
                                    <?php if ($this->_tpl_vars['orgtype'] != 'Supplier'): ?>
                                    <?php echo smarty_function_assign(array('var' => 'povu','value' => 'polist'), $this);?>

									<li <?php if (((is_array($_tmp='/(.*)(polist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(purchaseorderview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-inbox"></i>
											<span><?php echo $this->_tpl_vars['LBL_PO_ISSUANCE']; ?>
</span>
											<i class="fa fa-angle-right drop-icon"></i>
										</a>

                                        <ul class="submenu">
                                            <li>
                                                <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist/all"
                                                   <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'polist/all') : smarty_modifier_cat($_tmp, 'polist/all'))): ?>class="active"<?php endif; ?>>
                                                    <?php echo $this->_tpl_vars['LBL_VIEW']; ?>

                                                </a>
                                            </li>
                                            <?php if (((is_array($_tmp=$this->_tpl_vars['poOrgStatus'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['poOrgStatus']) > 0): ?>
                                                <?php if (count($_from = (array)$this->_tpl_vars['poOrgStatus'])):
    foreach ($_from as $this->_tpl_vars['status']):
?>
                                                    <?php echo smarty_function_assign(array('var' => 'poUrl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'polist/') : smarty_modifier_cat($_tmp, 'polist/'))), $this);?>

                                                    <?php echo smarty_function_assign(array('var' => 'poUrl','value' => ((is_array($_tmp=$this->_tpl_vars['poUrl'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['status']['iStatusID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['status']['iStatusID']))), $this);?>

                                                    <li>
                                                        <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist/<?php echo $this->_tpl_vars['status']['iStatusID']; ?>
"
                                                           <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['poUrl']) : strpos($_tmp, $this->_tpl_vars['poUrl'])) !== false): ?>class="active"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['status']['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>

                                                            >
                                                            Issue
                                                        </a>
                                                    </li>
                                                <?php endforeach; unset($_from); endif; ?>
                                            <?php endif; ?>
                                                                                </ul>
									</li>
                                    <?php endif; ?>

                                    <?php if ($this->_tpl_vars['orgtype'] != 'Buyer'): ?>
                                    <?php echo smarty_function_assign(array('var' => 'invu','value' => 'invoicelist'), $this);?>

                                    <li <?php if (((is_array($_tmp='/(.*)(invoicelist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strripos', true, $_tmp, $this->_tpl_vars['invu']) : strripos($_tmp, $this->_tpl_vars['invu'])) > 0 || ((is_array($_tmp='/(.*)(invoiceview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invoiceviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-inbox"></i>
											<span><?php echo $this->_tpl_vars['LBL_INVOICE_ISSUANCE']; ?>
</span>
											<i class="fa fa-angle-right drop-icon"></i>
										</a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicelist/all"
                                                   <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'invoicelist/all') : smarty_modifier_cat($_tmp, 'invoicelist/all'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
</a>
                                            </li>
                                            <?php if (((is_array($_tmp=$this->_tpl_vars['invOrgStatus'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['invOrgStatus']) > 0): ?>
                                                <?php if (count($_from = (array)$this->_tpl_vars['invOrgStatus'])):
    foreach ($_from as $this->_tpl_vars['status']):
?>
                                                    <?php echo smarty_function_assign(array('var' => 'invUrl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'invoicelist/') : smarty_modifier_cat($_tmp, 'invoicelist/'))), $this);?>

                                                    <?php echo smarty_function_assign(array('var' => 'invUrl','value' => ((is_array($_tmp=$this->_tpl_vars['invUrl'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['status']['iStatusID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['status']['iStatusID']))), $this);?>

                                                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicelist/<?php echo $this->_tpl_vars['status']['iStatusID']; ?>
"
                                                           <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['invUrl']) : strpos($_tmp, $this->_tpl_vars['invUrl'])) !== false): ?>class="active"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['status']['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a>
                                                    </li>
                                                <?php endforeach; unset($_from); endif; ?>
                                            <?php endif; ?>
                                                                                </ul>
									</li>
                                    <?php endif; ?>

                                    <?php if ($this->_tpl_vars['orgtype'] != 'Buyer'): ?>
                                    <?php echo smarty_function_assign(array('var' => 'povu','value' => 'poacptlist'), $this);?>

									<li <?php if (((is_array($_tmp='/(.*)(poacptlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(purchaseorderview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(poviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-file-o"></i>
											<span><?php echo $this->_tpl_vars['LBL_PO_ACCEPTANCE']; ?>
</span>
											<i class="fa fa-angle-right drop-icon"></i>
										</a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poacptlist/all"
                                                   <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'poacptlist/all') : smarty_modifier_cat($_tmp, 'poacptlist/all'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
</a>
                                            </li>
                                            <?php if (((is_array($_tmp=$this->_tpl_vars['poOrgAcpt'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['poOrgAcpt']) > 0): ?>
                                                <?php if (count($_from = (array)$this->_tpl_vars['poOrgAcpt'])):
    foreach ($_from as $this->_tpl_vars['status']):
?>
                                                    <?php if ($this->_tpl_vars['status']['vStatus'] != $this->_tpl_vars['LBL_ISSUE'] && $this->_tpl_vars['status']['vStatus'] != 'Issue' && $this->_tpl_vars['status']['vStatus'] != 'Délivré' && $this->_tpl_vars['status']['vStatus'] != 'Issued'): ?>
                                                        <?php echo smarty_function_assign(array('var' => 'poUrl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'poacptlist/') : smarty_modifier_cat($_tmp, 'poacptlist/'))), $this);?>

                                                        <?php echo smarty_function_assign(array('var' => 'poUrl','value' => ((is_array($_tmp=$this->_tpl_vars['poUrl'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['status']['iStatusID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['status']['iStatusID']))), $this);?>

                                                        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poacptlist/<?php echo $this->_tpl_vars['status']['iStatusID']; ?>
"
                                                               <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['poUrl']) : strpos($_tmp, $this->_tpl_vars['poUrl'])) !== false): ?>class="active"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['status']['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; unset($_from); endif; ?>
                                            <?php endif; ?>
                                        </ul>
									</li>
                                    <?php endif; ?>

                                    <?php if ($this->_tpl_vars['orgtype'] != 'Supplier'): ?>
                                    <?php echo smarty_function_assign(array('var' => 'invu','value' => 'invacptlist'), $this);?>

                                    <li <?php if (((is_array($_tmp='/(.*)(invacptlist)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strripos', true, $_tmp, $this->_tpl_vars['invu']) : strripos($_tmp, $this->_tpl_vars['invu'])) > 0 || ((is_array($_tmp='/(.*)(invoiceview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invprefview)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(invoiceviewitems)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-file-o"></i>
											<span><?php echo $this->_tpl_vars['LBL_PO_ACCEPTANCE']; ?>
</span>
											<i class="fa fa-angle-right drop-icon"></i>
										</a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invacptlist/all"
                                                   <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'invacptlist/all') : smarty_modifier_cat($_tmp, 'invacptlist/all'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
</a>
                                            </li>
                                            <?php if (((is_array($_tmp=$this->_tpl_vars['invOrgAcpt'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['invOrgAcpt']) > 0): ?>
                                                <?php if (count($_from = (array)$this->_tpl_vars['invOrgAcpt'])):
    foreach ($_from as $this->_tpl_vars['status']):
?>
                                                    <?php if ($this->_tpl_vars['status']['vStatus'] != $this->_tpl_vars['LBL_ISSUE'] && $this->_tpl_vars['status']['vStatus'] != 'Issue' && $this->_tpl_vars['status']['vStatus'] != 'Délivré' && $this->_tpl_vars['status']['vStatus'] != 'Issued'): ?>
                                                        <?php echo smarty_function_assign(array('var' => 'invUrl','value' => ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'invacptlist/') : smarty_modifier_cat($_tmp, 'invacptlist/'))), $this);?>

                                                        <?php echo smarty_function_assign(array('var' => 'invUrl','value' => ((is_array($_tmp=$this->_tpl_vars['invUrl'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['status']['iStatusID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['status']['iStatusID']))), $this);?>

                                                        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invacptlist/<?php echo $this->_tpl_vars['status']['iStatusID']; ?>
"
                                                               <?php if (((is_array($_tmp=$this->_tpl_vars['currentUrl'])) ? $this->_run_mod_handler('strpos', true, $_tmp, $this->_tpl_vars['invUrl']) : strpos($_tmp, $this->_tpl_vars['invUrl'])) !== false): ?>class="active"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['status']['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; unset($_from); endif; ?>
                                            <?php endif; ?>
                                                                                </ul>
									</li>
                                    <?php endif; ?>

                                    <?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
                                    <?php echo smarty_function_assign(array('var' => 'invu','value' => 'invacptlist'), $this);?>

                                    <li <?php if (((is_array($_tmp='/(.*)(rfq2)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-file-o"></i>
											<span><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</span>
											<i class="fa fa-angle-right drop-icon"></i>
										</a>
										<ul class="submenu">
											<li>
												<a href="#" class="dropdown-toggle">
													<span><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</span>
													<i class="fa fa-angle-right drop-icon"></i>
												</a>
												<ul class="submenu">
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
												</ul>
											</li>
											<li>
												<a href="#" class="dropdown-toggle">
													<span><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</span>
													<i class="fa fa-angle-right drop-icon"></i>
												</a>
												<ul class="submenu">
													<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2bidlist" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'rfq2bidlist') : smarty_modifier_cat($_tmp, 'rfq2bidlist'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</a></li>
												</ul>
											</li>
											<li>
												<a href="#" class="dropdown-toggle">
													<span><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_AWARD']; ?>
</span>
													<i class="fa fa-angle-right drop-icon"></i>
												</a>
												<ul class="submenu">
													<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2awardlist" <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'rfq2awardlist') : smarty_modifier_cat($_tmp, 'rfq2awardlist'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_AWARD']; ?>
</a></li>
												</ul>
											</li>
										</ul>
									</li>

                                    
                                    <?php endif; ?>
                                    
                                    <li <?php if (((is_array($_tmp='/(.*)(reportsrpt)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-file-o"></i>
											<span><?php echo $this->_tpl_vars['LBL_REPORTS']; ?>
</span>
											<i class="fa fa-angle-right drop-icon"></i>
										</a>
										<ul class="submenu">
                                            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
reportsrpt" <?php if (((is_array($_tmp='/(.*)(reportsrpt)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_REPORTS']; ?>
</a></li>
										</ul>
									</li>
                                    <li <?php if (((is_array($_tmp='/(.*)(oueditprofile)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || ((is_array($_tmp='/(.*)(changepass)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl'])) || $this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'logout') : smarty_modifier_cat($_tmp, 'logout'))): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-file-o"></i>
											<span><?php echo $this->_tpl_vars['LBL_PREFERENCE']; ?>
</span>
											<i class="fa fa-angle-right drop-icon"></i>
										</a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
oueditprofile"
                                                   <?php if (((is_array($_tmp='/(.*)(oueditprofile)(.*)/')) ? $this->_run_mod_handler('preg_match', true, $_tmp, $this->_tpl_vars['currentUrl']) : preg_match($_tmp, $this->_tpl_vars['currentUrl']))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_EDIT_PROFILE']; ?>
</a>
                                            </li>
                                            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
changepass/<?php echo $this->_tpl_vars['iUserId']; ?>
"
                                                   <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'editprofile') : smarty_modifier_cat($_tmp, 'editprofile'))): ?>class="active"<?php endif; ?>
                                                   onmouseover="CallColoerBox(this.href,630,315,'file');"><?php echo $this->_tpl_vars['LBL_CHANGE_PASSWORD']; ?>
</a>
                                            </li>
                                            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
logout"
                                                   <?php if ($this->_tpl_vars['currentUrl'] == ((is_array($_tmp=$this->_tpl_vars['SITE_URL_DUM'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'logout') : smarty_modifier_cat($_tmp, 'logout'))): ?>class="active"<?php endif; ?>><?php echo $this->_tpl_vars['LBL_LOGOUT']; ?>
</a>
                                            </li>
                                        </ul>
									</li>
									
								</ul>
							</div>
						</div>
					</section>
					<div id="nav-col-submenu"></div>
				</div>
<?php echo '
<script>
var curURl = \'';  echo $this->_tpl_vars['currentUrl'];  echo '\';
</script>
'; ?>