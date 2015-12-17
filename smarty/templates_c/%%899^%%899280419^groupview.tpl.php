<?php /* Smarty version 2.6.0, created on 2015-06-11 13:32:06
         compiled from member/user/groupview.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'member/user/groupview.tpl', 112, false),array('modifier', 'is_array', 'member/user/groupview.tpl', 112, false),array('modifier', 'in_array', 'member/user/groupview.tpl', 116, false),array('modifier', 'trim', 'member/user/groupview.tpl', 346, false),array('function', 'assign', 'member/user/groupview.tpl', 113, false),)), $this); ?>
-<form name="frmcreategroup" id="frmcreategroup" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-creategroup_a" method="POST">
<input type="hidden" name="iGroupID" id="iGroupID" value="<?php echo $this->_tpl_vars['iGroupID']; ?>
" />
<input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
<div class="middle-container">
       <h1><?php echo $this->_tpl_vars['LBL_GROUP_VIEW']; ?>
</h1>
       <div class="middle-containt">
       <div class="statistics-main-box-white">
       <div>
          <ul id="inner-tab">
				  <li><a href="#" class="current"><EM><?php echo $this->_tpl_vars['LBL_GROUP']; ?>
</EM></a></li>
		    </ul>
          </div>
            <div class="clear"></div><div class="inner-gray-bg">
           <?php if ($this->_tpl_vars['msg'] != '' && $this->_tpl_vars['OgrpData'][0]['eStatus'] != 'Active' || $this->_tpl_vars['verify'] == 'yes'): ?>
                    <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
                                   <?php endif; ?>
            	<div>&nbsp;</div>
					<div><span style="float:right;"><b><a class="" href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL']; ?>
groupviewhistory/<?php echo $this->_tpl_vars['iGroupID']; ?>
')" ><?php echo $this->_tpl_vars['LBL_VIEW_HISTORY']; ?>
</a></b></span></div>
                <div>
                    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                    <tr>
                      <td width="100px" valign="top"><?php echo $this->_tpl_vars['LBL_ORGANIZATIONS']; ?>
&nbsp; </td>
                      <td width="1px">:</td>
                      <td>
                      <table width="228" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                              <!-- class="securitymanager-white-bg" -->
                            <td height="20">
                                <?php echo $this->_tpl_vars['orgdata'][0]['vCompanyName']; ?>

                            </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td valign="top"><?php echo $this->_tpl_vars['LBL_GROUP_NAME']; ?>
&nbsp; </td>
                      <td width="1px">:</td>
                      <td><?php echo $this->_tpl_vars['grpData'][0]['vGroupName']; ?>
</td>
                    </tr>
                                        						  <tr>
                        <td colspan="2" valign="top"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/spacer.gif" width="1" height="1" alt="" border="0" /></td>
                     </tr>
                              <tr>
                               <td valign="top"><?php echo $this->_tpl_vars['LBL_ASSIGN_RIGHTS']; ?>
&nbsp; </td>
                                <td >&nbsp;</td>
										  <td colspan="2">&nbsp;</td>
										</tr>
                              <?php if ($this->_tpl_vars['orgdata'][0]['eOrganizationType'] != 'Buyer2'): ?>
										<?php if ($this->_tpl_vars['orgdata'][0]['eOrganizationType'] != 'Supplier'): ?>
										<tr>
											  <td>&nbsp;</td><br/>
											  <td valign="top" colspan="3"><b><u><?php echo $this->_tpl_vars['LBL_BUYER_RIGHTS']; ?>
</u>:</b></td>
										</tr>
										<tr>
											  <td colspan="2">&nbsp;</td>
											  <td valign="top" colspan="2"><b><?php echo $this->_tpl_vars['LBL_PO_CREATION']; ?>
:</b>
												  <span style="padding:45px;">
													 <label style="display:inline-block; width:170px;"><b><?php echo $this->_tpl_vars['LBL_FREE_FORM_CREATION']; ?>
: </b><?php if ($this->_tpl_vars['ecreate']['po'] == 'Yes'):  echo $this->_tpl_vars['ecreate']['po'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></label>
													 <label style="display:inline-block; width:110px;"><b><?php echo $this->_tpl_vars['LBL_IMPORT']; ?>
: </b><?php if ($this->_tpl_vars['eimport']['po'] == 'Yes'):  echo $this->_tpl_vars['eimport']['po'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></label>
													 <label style="display:inline-block; width:100px;"><b><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
: </b><?php if ($this->_tpl_vars['everify']['po'] == 'Yes'):  echo $this->_tpl_vars['LBL_YES'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></label>
											     <span>
											  </td>
										</tr>
										<tr>
											  <td colspan="2">&nbsp;</td>
											  <td  width="300">
												                                        <b><?php echo $this->_tpl_vars['LBL_ORDER_STATUS_LEVEL']; ?>
</b>
												                                    </td>
											 <td width="300">
											                                        <b><?php echo $this->_tpl_vars['LBL_INV_ACPT_LEVEL']; ?>
</b>
											                                    </td>
                              </tr>
                               <tr>
                                    <td width="130" valign="top">&nbsp;</td>
                                    <td></td>
                                    <td width="300" valign="top">
													<?php if (count($this->_tpl_vars['poUserStatus']) > 0 && ((is_array($_tmp=$this->_tpl_vars['poUserStatus'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp))): ?>
													<?php echo smarty_function_assign(array('var' => 'po_count','value' => count($this->_tpl_vars['poUserStatus'])), $this);?>

													<?php echo smarty_function_assign(array('var' => 'cm','value' => 'n'), $this);?>

													<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['status']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
														<?php if (((is_array($_tmp=$this->_tpl_vars['status'][$this->_sections['i']['index']]['Id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['poUserStatus']) : in_array($_tmp, $this->_tpl_vars['poUserStatus'])) && $this->_tpl_vars['status'][$this->_sections['i']['index']]['eType'] == 'Optional' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Create' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Accepted' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Verify'): ?>
														<?php if ($this->_tpl_vars['cm'] == 'y'): ?>,<?php endif; ?>
														 <?php echo $this->_tpl_vars['status'][$this->_sections['i']['index']]['title']; ?>

														 <?php echo smarty_function_assign(array('var' => 'cm','value' => 'y'), $this);?>

														 														<?php endif; ?>
													<?php endfor; endif; ?>
													<?php endif; ?>
													<?php if ($this->_tpl_vars['cm'] != 'y'): ?>
													<?php echo $this->_tpl_vars['LBL_NO_PO_ISSUANCE_RIGTS']; ?>

													<?php endif; ?>
                                   </td>
												<td valign="top" width="300">
													 <?php if (count($this->_tpl_vars['invUserAcpt']) > 0 && ((is_array($_tmp=$this->_tpl_vars['invUserAcpt'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp))): ?>
													<?php echo smarty_function_assign(array('var' => 'inv_count','value' => count($this->_tpl_vars['invUserAcpt'])), $this);?>

													<?php echo smarty_function_assign(array('var' => 'cm','value' => 'n'), $this);?>

													<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['status']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
													  <?php if (((is_array($_tmp=$this->_tpl_vars['status'][$this->_sections['i']['index']]['Id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['invUserAcpt']) : in_array($_tmp, $this->_tpl_vars['invUserAcpt'])) && $this->_tpl_vars['status'][$this->_sections['i']['index']]['eType'] == 'Optional' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Create' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Issued' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Verify'): ?>
															<?php if ($this->_tpl_vars['cm'] == 'y'): ?>,<?php endif; ?>
														 <?php echo $this->_tpl_vars['status'][$this->_sections['i']['index']]['title']; ?>
														 														 <?php echo smarty_function_assign(array('var' => 'cm','value' => 'y'), $this);?>

													  <?php endif; ?>
													<?php endfor; endif; ?>
													<?php endif; ?>
													<?php if ($this->_tpl_vars['cm'] != 'y'): ?>
													<?php echo $this->_tpl_vars['LBL_NO_INVOICE_ACCEPTANCE_RIGHTS']; ?>

													<?php endif; ?>
                                   </td>
                              </tr>
										 <tr>
											  <td>&nbsp;</td>
											  <td colspan="3" style="padding-left:7px;"><b><?php echo $this->_tpl_vars['LBL_INVOICE_FROM_PO_SUPPLIER_ONBEHALF']; ?>
 : </b> <?php if ($this->_tpl_vars['grpData'][0]['eInvFPO'] == 'Yes'): ?> <?php echo $this->_tpl_vars['grpData'][0]['eInvFPO']; ?>
 <?php else: ?> <?php echo $this->_tpl_vars['LBL_NO']; ?>
 <?php endif; ?> </td>
										 </tr>
										 <?php endif; ?>
										<tr><td colspan="4">&nbsp;</td></tr>
										<?php if ($this->_tpl_vars['orgdata'][0]['eOrganizationType'] != 'Buyer'): ?>
										<tr>
											  <td>&nbsp;</td><br>
											  <td valign=="top" colspan="3"><b><u><?php echo $this->_tpl_vars['LBL_SUPPLIER_RIGHTS']; ?>
</u>:</b></td>
										</tr>
										<tr>
											  <td colspan="2">&nbsp;</td>
											  <td valign="top" colspan="2"><b><?php echo $this->_tpl_vars['LBL_INV_CREATION']; ?>
:</b>
												  <span style="padding:21px;">
													 <label style="display:inline-block; width:170px;"><b><?php echo $this->_tpl_vars['LBL_FREE_FORM_CREATION']; ?>
: </b><?php if ($this->_tpl_vars['ecreate']['inv'] == 'Yes'):  echo $this->_tpl_vars['ecreate']['inv'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></label>
													 <label style="display:inline-block; width:110px;"><b><?php echo $this->_tpl_vars['LBL_IMPORT']; ?>
: </b><?php if ($this->_tpl_vars['eimport']['inv'] == 'Yes'):  echo $this->_tpl_vars['eimport']['inv'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></label>
													 <label style="display:inline-block; width:100px;"><b><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
: </b><?php if ($this->_tpl_vars['everify']['inv'] == 'Yes'):  echo $this->_tpl_vars['LBL_YES'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></label>
											     <span>
											  </td>
										</tr>
										<tr>
                                <td width="130" valign="top"> &nbsp; </td>
                                <td >&nbsp;</td>
                                  <td  width="300">
											                                        <b><?php echo $this->_tpl_vars['LBL_INV_STATUS_LEVEL']; ?>
</b>
											                                    </td>
                                  <td width="300">
											                                        <b><?php echo $this->_tpl_vars['LBL_ORDER_ACPT_LEVEL']; ?>
</b>
											                                    </td>
                              </tr>
										 <tr>
                                    <td width="130" valign="top">&nbsp;</td>
                                    <td></td>
                                    <td width="300" valign="top">
													<?php if (count($this->_tpl_vars['invUserStatus']) > 0 && ((is_array($_tmp=$this->_tpl_vars['invUserStatus'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp))): ?>
													<?php echo smarty_function_assign(array('var' => 'inv_count','value' => count($this->_tpl_vars['invUserStatus'])), $this);?>

													<?php echo smarty_function_assign(array('var' => 'cm','value' => 'n'), $this);?>

													<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['status']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
													  <?php if (((is_array($_tmp=$this->_tpl_vars['status'][$this->_sections['i']['index']]['Id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['invUserStatus']) : in_array($_tmp, $this->_tpl_vars['invUserStatus'])) && $this->_tpl_vars['status'][$this->_sections['i']['index']]['eType'] == 'Optional' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Create' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Accepted' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Verify'): ?>
															<?php if ($this->_tpl_vars['cm'] == 'y'): ?>,<?php endif; ?>
														 <?php echo $this->_tpl_vars['status'][$this->_sections['i']['index']]['title']; ?>
														 														 <?php echo smarty_function_assign(array('var' => 'cm','value' => 'y'), $this);?>

													  <?php endif; ?>
													<?php endfor; endif; ?>
													<?php endif; ?>
													<?php if ($this->_tpl_vars['cm'] != 'y'): ?>
													<?php echo $this->_tpl_vars['LBL_NO_INVOICE_ISSUANCE_RIGTS']; ?>

													<?php endif; ?>
                                   </td>
                                   <td valign="top" width="300">
													 <?php if (count($this->_tpl_vars['poUserAcpt']) > 0 && ((is_array($_tmp=$this->_tpl_vars['poUserAcpt'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp))): ?>
													<?php echo smarty_function_assign(array('var' => 'inv_count','value' => count($this->_tpl_vars['poUserAcpt'])), $this);?>

													<?php echo smarty_function_assign(array('var' => 'cm','value' => 'n'), $this);?>

													<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['status']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
													  <?php if (((is_array($_tmp=$this->_tpl_vars['status'][$this->_sections['i']['index']]['Id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['poUserAcpt']) : in_array($_tmp, $this->_tpl_vars['poUserAcpt'])) && $this->_tpl_vars['status'][$this->_sections['i']['index']]['eType'] == 'Optional' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Create' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Issued' && $this->_tpl_vars['status'][$this->_sections['i']['index']]['status'] != 'Verify'): ?>
															<?php if ($this->_tpl_vars['cm'] == 'y'): ?>,<?php endif; ?>
														 <?php echo $this->_tpl_vars['status'][$this->_sections['i']['index']]['title']; ?>
														 														 <?php echo smarty_function_assign(array('var' => 'cm','value' => 'y'), $this);?>

													  <?php endif; ?>
													<?php endfor; endif; ?>
													<?php endif; ?>
													<?php if ($this->_tpl_vars['cm'] != 'y'): ?>
													<?php echo $this->_tpl_vars['LBL_NO_PO_ACCEPTANCE_RIGTS']; ?>

													<?php endif; ?>
                                   </td>
                              </tr>
										<?php endif; ?>
										<?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
										<tr><td colspan="2">&nbsp;</td></tr>
                              <tr>
										  <td>&nbsp;</td>
										  <td valign="top" colspan="3">
                                <span style="display:inline-block; width:130px;"><b><u><?php echo $this->_tpl_vars['LBL_RFQ2_RIGHTS']; ?>
</u>:</b></span>
                                <span style="display:inline-block; width:100px;"><?php echo $this->_tpl_vars['LBL_CREATE']; ?>
: <?php if (((is_array($_tmp=$this->_tpl_vars['crfq2awrdsts'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['rfq2s']) : in_array($_tmp, $this->_tpl_vars['rfq2s']))):  echo $this->_tpl_vars['LBL_YES'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></span>
										  <?php if ($this->_tpl_vars['ores'][0]['eRFQ2VerifyReq'] == 'Yes'): ?>
                                <span style="display:inline-block; width:100px;"><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
: <?php if (((is_array($_tmp=$this->_tpl_vars['vrfq2awrdsts'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['rfq2s']) : in_array($_tmp, $this->_tpl_vars['rfq2s']))):  echo $this->_tpl_vars['LBL_YES'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></span>
										  <?php endif; ?>
                                <br /> <br />
                                </td>
									   </tr>
                              <tr>
											  <td>&nbsp;</td>
											  <td valign="top" colspan="3">
                                   <span style="display:inline-block; width:130px;"><b><u><?php echo $this->_tpl_vars['LBL_RFQ2_AWARD_RIGHTS']; ?>
</u>:</b></span>
                                   <?php echo smarty_function_assign(array('var' => 'an','value' => 'n'), $this);?>

                                   <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['rfq2awrdsts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
                                       <?php if (((is_array($_tmp=$this->_tpl_vars['rfq2awrdsts'][$this->_sections['l']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['rfq2awrd']) : in_array($_tmp, $this->_tpl_vars['rfq2awrd']))): ?>
                                          <?php if ($this->_tpl_vars['an'] == 'y'): ?>,<?php endif; ?> <?php echo $this->_tpl_vars['rfq2awrdsts'][$this->_sections['l']['index']]['vStatus']; ?>

                                          <?php echo smarty_function_assign(array('var' => 'an','value' => 'y'), $this);?>

                                       <?php endif; ?>
                                   <?php endfor; endif; ?>
                                   <br /> <br />
                                   </td>
										</tr>
										<?php endif; ?>
                              <?php elseif ($this->_tpl_vars['orgdata'][0]['eOrganizationType'] == 'Buyer2'): ?>
                                 <tr>
											  <td>&nbsp;</td>
											  <td valign="top" colspan="3">
                                   <span style="display:inline-block; width:170px;"><b><u><?php echo $this->_tpl_vars['LBL_BID_RIGHTS']; ?>
</u>:</b></span>
                                   <span style="display:inline-block; width:100px;"><?php echo $this->_tpl_vars['LBL_CREATE']; ?>
: <?php if (((is_array($_tmp=$this->_tpl_vars['crfq2awrdsts'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['rfq2bid']) : in_array($_tmp, $this->_tpl_vars['rfq2bid']))):  echo $this->_tpl_vars['LBL_YES'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></span>
											  <?php if ($this->_tpl_vars['ores'][0]['eRFQ2BidVerifyReq'] == 'Yes'): ?>
                                   <span style="display:inline-block; width:100px;"><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
: <?php if (((is_array($_tmp=$this->_tpl_vars['vrfq2awrdsts'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['rfq2bid']) : in_array($_tmp, $this->_tpl_vars['rfq2bid']))):  echo $this->_tpl_vars['LBL_YES'];  else:  echo $this->_tpl_vars['LBL_NO'];  endif; ?></span>
											  <?php endif; ?>
                                   <br /> <br />
                                   </td>
										   </tr>
                                 <tr>
											  <td>&nbsp;</td>
											  <td valign="top" colspan="3">
                                      <span style="display:inline-block; width:170px;"><b><u><?php echo $this->_tpl_vars['LBL_AWARD_ACCEPTANCE_RIGHTS']; ?>
</u>:</b></span>
                                      <?php echo smarty_function_assign(array('var' => 'an','value' => 'n'), $this);?>

												  <?php if (((is_array($_tmp=$this->_tpl_vars['rfq2awrdacpt'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && ((is_array($_tmp=$this->_tpl_vars['arfq2awrdsts'][0]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['rfq2awrdacpt']) : in_array($_tmp, $this->_tpl_vars['rfq2awrdacpt']))): ?>
													  <?php echo $this->_tpl_vars['LBL_ACCEPT']; ?>

													  <?php echo smarty_function_assign(array('var' => 'an','value' => 'y'), $this);?>

												  <?php endif; ?>
                                      <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['rfq2awrdacptsts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
                                          <?php if (((is_array($_tmp=$this->_tpl_vars['rfq2awrdacptsts'][$this->_sections['l']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['rfq2awrdacpt']) : in_array($_tmp, $this->_tpl_vars['rfq2awrdacpt'])) && $this->_tpl_vars['rfq2awrdacptsts'][$this->_sections['l']['index']]['vStatus_en'] != 'Accepted'): ?>
                                             <?php if ($this->_tpl_vars['an'] == 'y'): ?>,<?php endif; ?> <?php echo $this->_tpl_vars['rfq2awrdacptsts'][$this->_sections['l']['index']]['vStatus']; ?>

                                             <?php echo smarty_function_assign(array('var' => 'an','value' => 'y'), $this);?>

                                          <?php endif; ?>
                                      <?php endfor; endif; ?>
                                      <br /> <br />
                                   </td>
										   </tr>
                              <?php endif; ?>
                                        <tr>
                      <td valign="top">&nbsp;</td>
                    </tr>
						  <?php if ($this->_tpl_vars['verify'] == 'yes'): ?>
							<tr>
							  <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
							  <td valign="top">:</td>
							  <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
							</tr>
							<?php endif; ?>
						  <?php if ($this->_tpl_vars['vgrpData'][0]['iRejectedById'] > 0 && ((is_array($_tmp=$this->_tpl_vars['vgrpData'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
							<tr>
							  <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
							  <td valign="top">:</td>
							  <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;"><?php echo ((is_array($_tmp=$this->_tpl_vars['vgrpData'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</div></td>
							</tr>
							<?php endif; ?>
                    <tr>
                      <td valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td colspan="2">
									 									 <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;"  <?php if ($this->_tpl_vars['verify'] == 'yes'): ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifygrouplist';"<?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
grouplist';"<?php endif; ?> />
                            <?php if ($this->_tpl_vars['verify'] == 'yes'): ?>
										 <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmcreategroup').submit();" />
										 <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmcreategroup').submit();" />
                            <?php endif; ?>
                      </td>
                      <td valign="top" align="right">&nbsp;
							   <?php if ($this->_tpl_vars['OgrpData'][0]['eStatus'] == 'Modified'): ?>
                           <a class="colorbox" href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
index.php?file=u-aj_groupoverview&id=<?php echo $this->_tpl_vars['OgrpData'][0]['iGroupID']; ?>
" onmouseover="CallColoerBox(this.href,700,320,'file');">Click Here to view Original</a>
                        <?php endif; ?>
                      </td>
                    </tr>
                    </table>
                </div>
                <div>&nbsp;</div>
            </div>
       </div>
       </div>
     </div>
</form>