<?php /* Smarty version 2.6.0, created on 2015-06-22 09:13:00
         compiled from member/organization/organizationprefview.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'member/organization/organizationprefview.tpl', 40, false),array('modifier', 'trim', 'member/organization/organizationprefview.tpl', 162, false),array('modifier', 'in_array', 'member/organization/organizationprefview.tpl', 204, false),array('function', 'assign', 'member/organization/organizationprefview.tpl', 202, false),)), $this); ?>
<div class="middle-container">
     <h1><span><?php echo $this->_tpl_vars['LBL_CREATE_ORG']; ?>
</span></h1>
     <div class="middle-containt">
          <div class="statistics-main-box-white">
               <div>
                    <ul id="inner-tab">
                         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationview/<?php echo $this->_tpl_vars['iOrganizationID']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'or-createorganization'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_ORG_INFO']; ?>
</EM></a></li>
                         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationprefview/<?php echo $this->_tpl_vars['iOrganizationID']; ?>
/<?php echo $this->_tpl_vars['iAdditionalInfoID']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'or-organizationprefview'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</EM></a></li>
                    </ul>
               </div>
               <div class="clear"></div>
               <div class="inner-gray-bg">
                    <?php if ($this->_tpl_vars['msg'] != '' && $this->_tpl_vars['Oarr'][0]['eStatus'] != 'Active' && $this->_tpl_vars['Oarr'][0]['eStatus'] != 'Inactive'): ?>
                         <div class="msg">
                              <?php echo $this->_tpl_vars['msg']; ?>
<br/>                                                       </div>
                    <?php endif; ?>
                    <div style="height:10px;"></div>
                    <div>
                                                  <form name="orgverify" id="orgverify" method="post" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=or-createorganization_a">
                         <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                              <tr>
                                   <td width="160" ><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
 : </td><td></td>
                                   <td  colspan="3"  class="blue-ore">
                                        <?php if ($this->_tpl_vars['orgdtls'][0]['vCompanyName'] != ''):  echo $this->_tpl_vars['orgdtls'][0]['vCompanyName']; ?>
 <span>(<?php echo $this->_tpl_vars['orgdtls'][0]['vOrganizationCode']; ?>
)</span><?php endif; ?>
                                                                           </td>
                              </tr>
                              <?php if ($this->_tpl_vars['orgdtls'][0]['eOrganizationType'] != 'Buyer2'): ?>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_SOURCE_DOC']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tSourcingDocument'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_GLOBAL_AGREEMENT']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tGlobalAgreement'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> <?php echo $this->_tpl_vars['LBL_PAYMENT_TERMS']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tPaymentTerms'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> <?php echo $this->_tpl_vars['LBL_FOB']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tFOB'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> <?php echo $this->_tpl_vars['LBL_DELIVERY_TERMS']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tDeliveryTerms'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_SHIP_CONTROL']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tShippingControl'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_COND_PAYMENT']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tConditionsForPayment'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_PENALTIES']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tPenalties'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_SPEC_INSTRUCT']; ?>
</td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tSpecialInstruction'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">Note </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tNote'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_TERMS_COND']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tTermsAndConditions'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                   </td>
                              </tr>
                              <?php endif; ?>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_CURR']; ?>
&nbsp; </td>
                                   <td valign="top">:</td>
                                   <td>
                                        <?php echo $this->_tpl_vars['arr'][0]['vCurrency']; ?>

                                   </td>
                              </tr>
                              <?php if ($this->_tpl_vars['orgvf'][0]['eOrganizationType'] != 'Buyer2'): ?>
                              <tr><td colspan="3" align="left">&nbsp;</td></tr>
                              <tr>
                                   <td valign="top">Create Method Allowed&nbsp; </td>
                                   <td valign="top">:</td>
                                   <td>
                                      <?php if ($this->_tpl_vars['bylvl'] == 'Yes'): ?>
                                      <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
: <?php echo $this->_tpl_vars['arr'][0]['eCreateMethodAllowedPO']; ?>
 &nbsp; &nbsp; &nbsp;
                                      <?php endif; ?>
                                      <?php if ($this->_tpl_vars['suplvl'] == 'Yes'): ?>
                                      <?php echo $this->_tpl_vars['LBL_INVOICE']; ?>
: <?php echo $this->_tpl_vars['arr'][0]['eCreateMethodAllowedInv']; ?>

                                      <?php endif; ?>
                                   </td>
                              </tr>
                              <tr>
                                   <td><?php echo $this->_tpl_vars['LBL_SECURE_IMPORT']; ?>
</td>
                                   <td>:</td>
                                   <td>
                                      <?php if ($this->_tpl_vars['bylvl'] == 'Yes'): ?>
                                      <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
: <?php echo $this->_tpl_vars['arr'][0]['eSecureImportPO']; ?>
 &nbsp; &nbsp; &nbsp;
                                      <?php endif; ?>
                                      <?php if ($this->_tpl_vars['suplvl'] == 'Yes'): ?>
                                      <?php echo $this->_tpl_vars['LBL_INVOICE']; ?>
: <?php echo $this->_tpl_vars['arr'][0]['eSecureImportInvoice']; ?>

                                      <?php endif; ?>
                                   </td>
                              </tr>
                              <tr>
                                   <td><?php echo $this->_tpl_vars['LBL_SECURE_EXPORT']; ?>
</td>
                                   <td>:</td>
                                   <td>
                                      <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
: <?php echo $this->_tpl_vars['arr'][0]['eSecureExportPO']; ?>
 &nbsp; &nbsp; &nbsp; <?php echo $this->_tpl_vars['LBL_INVOICE']; ?>
: <?php echo $this->_tpl_vars['arr'][0]['eSecureExportInvoice']; ?>

                                   </td>
                              </tr>
                              <tr>
                                   <td><?php echo $this->_tpl_vars['LBL_ENCRYPTION_METHOD']; ?>
&nbsp;</td>
                                   <td valign="top">:</td>
                                   <td><?php if ($this->_tpl_vars['arr'][0]['eCryptAlgo'] != ''):  echo $this->_tpl_vars['arr'][0]['eCryptAlgo'];  else: ?>---<?php endif; ?></td>
                              </tr>
                              <tr>
                                   <td><?php echo $this->_tpl_vars['LBL_ENCRYPTIONKEY']; ?>
</td>
                                   <td>:</td>
                                   <td><?php if (((is_array($_tmp=$this->_tpl_vars['arr'][0]['vEncryptionKey'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''):  echo $this->_tpl_vars['arr'][0]['vEncryptionKey'];  else: ?>---<?php endif; ?></td>
                              </tr>
                              

                              <?php if ($this->_tpl_vars['bylvl'] == 'Yes'): ?>
                             <tr><td colspan="3" align="left">&nbsp;</td></tr>
                              <tr><td colspan="3" align="left"><?php echo $this->_tpl_vars['LBL_BUYER_RIGHTS']; ?>
</td></tr>
                              <tr>
                                 <td valign="top">Verification Required</td>
                                 <td valign="top">:</td>
                                 <td align="left">
                                    PO Issuance&nbsp;:&nbsp;<?php echo $this->_tpl_vars['arr'][0]['eReqVerificationPo']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;
                                    Invoice Acceptance&nbsp;:&nbsp;<?php echo $this->_tpl_vars['arr'][0]['eReqVerifyInvAcpt']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;
                                 </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_ORDER_STATUS_LEVEL']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                   <?php echo smarty_function_assign(array('var' => 'fl','value' => 'n'), $this);?>

                                   <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['POarr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                         <?php if (((is_array($_tmp=$this->_tpl_vars['POarr'][$this->_sections['i']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['selPOarr']) : in_array($_tmp, $this->_tpl_vars['selPOarr'])) && $this->_tpl_vars['POarr'][$this->_sections['i']['index']]['eType'] == 'Optional'): ?>
                                         <?php echo smarty_function_assign(array('var' => 'level','value' => "vStatus_".($this->_tpl_vars['LANG'])), $this);?>

                                         <?php if ($this->_tpl_vars['fl'] == 'y'): ?>,<?php endif; ?>
                                             <?php echo $this->_tpl_vars['POarr'][$this->_sections['i']['index']][$this->_tpl_vars['level']]; ?>

                                             <?php echo smarty_function_assign(array('var' => 'fl','value' => 'y'), $this);?>

                                         <?php endif; ?>
                                   <?php endfor; endif; ?>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_INV_ACCEPTANCE_LEVEL']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td><span>
                                        <?php echo smarty_function_assign(array('var' => 'fl','value' => 'n'), $this);?>

                                        <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['invarr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                             <?php if (((is_array($_tmp=$this->_tpl_vars['invarr'][$this->_sections['i']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['acptInvArr']) : in_array($_tmp, $this->_tpl_vars['acptInvArr'])) && $this->_tpl_vars['invarr'][$this->_sections['i']['index']]['eType'] == 'Optional'): ?>
                                             <?php echo smarty_function_assign(array('var' => 'level','value' => "vStatus_".($this->_tpl_vars['LANG'])), $this);?>

                                             <?php if ($this->_tpl_vars['fl'] == 'y'): ?>,<?php endif; ?>
                                                  <?php echo $this->_tpl_vars['invarr'][$this->_sections['i']['index']][$this->_tpl_vars['level']]; ?>

                                                  <?php echo smarty_function_assign(array('var' => 'fl','value' => 'y'), $this);?>

                                             <?php endif; ?>
                                        <?php endfor; endif; ?>
                                        </span>
                                   </td>
                              </tr>
                              <?php endif; ?>
                              <?php if ($this->_tpl_vars['suplvl'] == 'Yes'): ?>
                              <tr><td colspan="3" align="left">&nbsp;</td></tr>
                              <tr><td colspan="3" align="left"><?php echo $this->_tpl_vars['LBL_SUPPLIER_RIGHTS']; ?>
</td></tr>
                              <tr>
                                 <td valign="top">Verification Required</td>
                                 <td valign="top">:</td>
                                 <td align="left">
                                    Invoice Issuance&nbsp;:&nbsp;<?php echo $this->_tpl_vars['arr'][0]['eReqVerificationInv']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;
                                    PO Acceptance&nbsp;:&nbsp;<?php echo $this->_tpl_vars['arr'][0]['eReqVerifyPoAcpt']; ?>

                                 </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_INV_STATUS_LEVEL']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td><span>
                                        <?php echo smarty_function_assign(array('var' => 'fl','value' => 'n'), $this);?>

                                        <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['invarr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                             <?php if (((is_array($_tmp=$this->_tpl_vars['invarr'][$this->_sections['i']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['selinvarr']) : in_array($_tmp, $this->_tpl_vars['selinvarr'])) && $this->_tpl_vars['invarr'][$this->_sections['i']['index']]['eType'] == 'Optional'): ?>
                                             <?php echo smarty_function_assign(array('var' => 'level','value' => "vStatus_".($this->_tpl_vars['LANG'])), $this);?>

                                             <?php if ($this->_tpl_vars['fl'] == 'y'): ?>,<?php endif; ?>
                                                <?php echo $this->_tpl_vars['invarr'][$this->_sections['i']['index']][$this->_tpl_vars['level']]; ?>

                                                <?php echo smarty_function_assign(array('var' => 'fl','value' => 'y'), $this);?>

                                             <?php endif; ?>
                                        <?php endfor; endif; ?>
                                        </span>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_ORD_ACCEPTANCE_LEVEL']; ?>
 </td>
                                   <td valign="top">:</td>
                                   <td>
                                   <?php echo smarty_function_assign(array('var' => 'fl','value' => 'n'), $this);?>

                                   <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['POarr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                         <?php if (((is_array($_tmp=$this->_tpl_vars['POarr'][$this->_sections['i']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['acptOrdArr']) : in_array($_tmp, $this->_tpl_vars['acptOrdArr'])) && $this->_tpl_vars['POarr'][$this->_sections['i']['index']]['eType'] == 'Optional'): ?>
                                         <?php echo smarty_function_assign(array('var' => 'level','value' => "vStatus_".($this->_tpl_vars['LANG'])), $this);?>

                                         <?php if ($this->_tpl_vars['fl'] == 'y'): ?>,<?php endif; ?>
                                             <?php echo $this->_tpl_vars['POarr'][$this->_sections['i']['index']][$this->_tpl_vars['level']]; ?>

                                                                                          <?php echo smarty_function_assign(array('var' => 'fl','value' => 'y'), $this);?>

                                         <?php endif; ?>
                                   <?php endfor; endif; ?>
                                   </td>
                              </tr>
                              <?php endif; ?>
                              <?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
                              <tr><td colspan="2">&nbsp;</td></tr>
                              <tr><td colspan="2"><?php echo $this->_tpl_vars['LBL_AUCTION_TENDER_RIGHTS']; ?>
&nbsp;</td></tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
&nbsp;</td><td> :</td>
                                 <td><?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
 : <b><?php echo $this->_tpl_vars['arr'][0]['eRFQ2VerifyReq']; ?>
</b></td>
                              </tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_AWARD']; ?>
&nbsp;</td><td> :</td>
                                 <td><?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
 : <b><?php echo $this->_tpl_vars['arr'][0]['eRFQ2AwardVerifyReq']; ?>
</b></td>
                              </tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_AWARD_STATUS_LEVELS']; ?>
&nbsp;</td><td valign="top"> :</td>
                                 <td valign="top"><?php echo $this->_tpl_vars['rfq2awrdsts']; ?>
</td>
                              </tr>
                              <?php endif; ?>
                              <?php elseif ($this->_tpl_vars['orgvf'][0]['eOrganizationType'] == 'Buyer2'): ?>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_BID']; ?>
&nbsp;</td><td> :</td>
                                 <td><?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
 : <b><?php echo $this->_tpl_vars['arr'][0]['eRFQ2BidVerifyReq']; ?>
</b></td>
                              </tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_AWARD_ACCEPTANCE']; ?>
&nbsp;</td><td> :</td>
                                 <td><?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
 : <b><?php echo $this->_tpl_vars['arr'][0]['eRFQ2AwardAcceptVerifyReq']; ?>
</b></td>
                              </tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_AWARD_ACCEPTANCE_STATUS_LEVELS']; ?>
&nbsp;</td><td valign="top"> :</td>
                                 <td valign="top"><?php echo $this->_tpl_vars['rfq2awrdacptsts']; ?>
</td>
                              </tr>
                              <?php endif; ?>
                              <?php if ($this->_tpl_vars['verify'] == 'yes'): ?>
                              <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                              </tr>
                              <?php endif; ?>
                                                            <tr>
                                   <td colspan="2" height="5"><input type="hidden" name="view" id="view" value="verify" /><input type="hidden" name="iOrgId" id="iOrgId" value="<?php echo $this->_tpl_vars['iOrganizationID']; ?>
" /></td>
                              </tr>
                              <tr>
                                   <td valign="top">&nbsp;</td>
                                   <td colspan="2">
                                        <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" />
                                        <?php if ($this->_tpl_vars['verify'] == 'yes'): ?>
                                                                                  <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#orgverify').submit();" />
                                         <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#orgverify').submit();" />
                                                                                                                           <?php endif; ?>
                                   </td>
                                   <td valign="top" align="right">&nbsp;
                                        <?php if ($this->_tpl_vars['Oarr'][0]['eStatus'] == 'Modified'): ?>
                                           <a class="colorbox" href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
index.php?file=or-aj_orgprfoverview&orgid=<?php echo $this->_tpl_vars['iOrganizationID']; ?>
&id=<?php echo $this->_tpl_vars['OiAdditionalInfoID']; ?>
" onmouseover="CallColoerBox(this.href,520,520,'file');">Click Here to view Original</a>
                                        <?php endif; ?>
                                   </td>
                              </tr>
                         </table>
                         </form>
                         </div>
                    </div>
                    <div>&nbsp;</div>
               </div>
          </div>
     </div>
</div>