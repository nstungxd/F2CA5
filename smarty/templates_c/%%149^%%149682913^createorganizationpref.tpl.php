<?php /* Smarty version 2.6.0, created on 2015-06-23 18:13:01
         compiled from member/organization/createorganizationpref.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'member/organization/createorganizationpref.tpl', 43, false),array('modifier', 'htmlentities', 'member/organization/createorganizationpref.tpl', 154, false),array('modifier', 'in_array', 'member/organization/createorganizationpref.tpl', 154, false),array('modifier', 'trim', 'member/organization/createorganizationpref.tpl', 194, false),array('function', 'assign', 'member/organization/createorganizationpref.tpl', 266, false),)), $this); ?>
<div class="middle-container">
     <h1><span><?php echo $this->_tpl_vars['LBL_CREATE_ORG']; ?>
</span></h1>
     <div class="middle-containt">
          <div class="statistics-main-box-white">
               <div>
                    <ul id="inner-tab">
                         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
createorganization/<?php echo $this->_tpl_vars['iOrganizationID']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'or-createorganization'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_ORG_INFO']; ?>
</EM></a></li>
                         <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
createorganizationpref/<?php echo $this->_tpl_vars['iOrganizationID']; ?>
/<?php echo $this->_tpl_vars['iAdditionalInfoID']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'or-createorganizationpref'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</EM></a></li>
                    </ul>
               </div>
               <div class="clear"></div>
               <div class="inner-gray-bg">
                    <div style="height:10px;"></div>
                    <div>
                        <?php if ($this->_tpl_vars['msg'] != ''): ?>
                                                                 <?php endif; ?>
                         <form name="frmadd" id="frmadd" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=or-createorganizationpref_a" method="post">
                         <input type="hidden" name="iOrganizationID" id="iOrganizationID"value="<?php echo $this->_tpl_vars['iOrganizationID']; ?>
" />
                         <input type="hidden" name="iAdditionalInfoID" id="iAdditionalInfoID"value="<?php echo $this->_tpl_vars['iAdditionalInfoID']; ?>
" />
                         <input type="hidden" name="iASMID" id="iASMID"value="<?php echo $this->_tpl_vars['iASMID']; ?>
" />
                         <input type="hidden" name="view" id="view"value="<?php echo $this->_tpl_vars['view']; ?>
" />
                         <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                              <tr>
                                   <td width="205"><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
 : </td>
                                   <td class="blue-ore"><?php if ($this->_tpl_vars['orgdtls'][0]['vCompanyName'] != ''):  echo $this->_tpl_vars['orgdtls'][0]['vCompanyName']; ?>
,<?php endif; ?> <span><?php echo $this->_tpl_vars['orgdtls'][0]['vOrganizationCode']; ?>
</span></td>
                              </tr>
                              <?php if ($this->_tpl_vars['orgdtls'][0]['eOrganizationType'] != 'Buyer2'): ?>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_SOURCE_DOC']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tSourcingDocument]" id="tSourcingDocument"  class="text-area" style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tSourcingDocument'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_GLOBAL_AGREEMENT']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tGlobalAgreement]" id="tGlobalAgreement"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tGlobalAgreement'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> <?php echo $this->_tpl_vars['LBL_PAYMENT_TERMS']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tPaymentTerms]" id="tPaymentTerms"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tPaymentTerms'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> <?php echo $this->_tpl_vars['LBL_FOB']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tFOB]" id="tFOB"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tFOB'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> <?php echo $this->_tpl_vars['LBL_DELIVERY_TERMS']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tDeliveryTerms]" id="tDeliveryTerms"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tDeliveryTerms'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_SHIP_CONTROL']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tShippingControl]" id="tShippingControl"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tShippingControl'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_COND_PAYMENT']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tConditionsForPayment]" id="tConditionsForPayment"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tConditionsForPayment'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_PENALTIES']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tPenalties]" id="tPenalties"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tPenalties'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_SPEC_INSTRUCT']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tSpecialInstruction]" id="tSpecialInstruction"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tSpecialInstruction'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">Note :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tNote]" id="tNote"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tNote'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_TERMS_COND']; ?>
 :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tTermsAndConditions]" id="tTermsAndConditions"  class="text-area"  style="width:495px; height:78px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['tTermsAndConditions'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <?php endif; ?>
                              <tr>
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_CURR']; ?>
&nbsp;<font class="reqmsg">*</font> :</td>
                                   <td>
                                        <select name="Data[vCurrency][]" id="vCurrency" class="required" style="width:100px; height:100px;" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_CURR']; ?>
" multiple="multiple" >
                                        <?php if (isset($this->_sections['c'])) unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['currency']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
                                           <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCurrency'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCurrency'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['arr'][0]['vCurrency']) : in_array($_tmp, $this->_tpl_vars['arr'][0]['vCurrency']))): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCurrency']; ?>
</option>
                                        <?php endfor; endif; ?>
                                        </select>
                                                                           </td>
                              </tr>
                              <?php if ($this->_tpl_vars['orgdtls'][0]['eOrganizationType'] != 'Buyer2'): ?>
                              <tr>
                                 <td ><?php echo $this->_tpl_vars['LBL_SECURE_IMPORT']; ?>
&nbsp;:</td>
                                 <td >
                                    <?php if ($this->_tpl_vars['bylvl'] == 'Yes'): ?>
                                    <input  type="checkbox" name="Data[eSecureImportPO]" id="eSecureImportPO" <?php if ($this->_tpl_vars['arr'][0]['eSecureImportPO'] == 'Yes'): ?>checked="checked"<?php endif; ?> value="Yes" />
                                    <label style="padding-right:20px"> <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
</label>
                                    <?php endif; ?>
                                    <?php if ($this->_tpl_vars['suplvl'] == 'Yes'): ?>
                                    <input type="checkbox" name="Data[eSecureImportInvoice]" id="eSecureImportInvoice" <?php if ($this->_tpl_vars['arr'][0]['eSecureImportInvoice'] == 'Yes'): ?>checked="checked"<?php endif; ?> value="Yes" />
                                    <?php echo $this->_tpl_vars['LBL_INVOICE']; ?>

                                    <?php endif; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td ><?php echo $this->_tpl_vars['LBL_SECURE_EXPORT']; ?>
&nbsp;:</td>
                                 <td>
                                                                        <input  type="checkbox" name="Data[eSecureExportPO]" id="eSecureExportPO" <?php if ($this->_tpl_vars['arr'][0]['eSecureExportPO'] == 'Yes'): ?>checked="checked"<?php endif; ?> value="Yes" />
                                    <label style="padding-right:20px"> <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
</label>
                                                                                                            <input type="checkbox" name="Data[eSecureExportInvoice]" id="eSecureExportInvoice" <?php if ($this->_tpl_vars['arr'][0]['eSecureExportInvoice'] == 'Yes'): ?>checked="checked"<?php endif; ?> value="Yes" />
                                    <?php echo $this->_tpl_vars['LBL_INVOICE']; ?>

                                                                     </td>
                              </tr>
                              <tr>
                                   <td><?php echo $this->_tpl_vars['LBL_ENCRYPTION_METHOD']; ?>
&nbsp;:</td>
                                   <td><?php echo $this->_tpl_vars['cryptAlgo']; ?>
</td>
                              </tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_ENCRYPTIONKEY']; ?>
&nbsp;:</td>
                                 <td>
                                   <input type="text" name="Data[vEncryptionKey]" style="width:190px" id="vEncryptionKey" class="input" title="<?php echo $this->_tpl_vars['LBL_ENTER_ENCRYPTION_KEY']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arr'][0]['vEncryptionKey'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
" />
                                                                     </td>
                              </tr>
                              <tr>
                                   <td colspan="2" height="5"></td>
                              </tr>
                                                            <tr>
                                   <td><?php echo $this->_tpl_vars['LBL_CREATE_METHOD_ALLOWED']; ?>
&nbsp;<font class="reqmsg">*</font> :</td>
                                   <td>
                                      <?php if ($this->_tpl_vars['bylvl'] == 'Yes'): ?>
                                      <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
: <?php echo $this->_tpl_vars['crMethodPO']; ?>
 &nbsp; &nbsp; &nbsp;
                                      <?php endif; ?>
                                      <?php if ($this->_tpl_vars['suplvl'] == 'Yes'): ?>
                                      <?php echo $this->_tpl_vars['LBL_INVOICE']; ?>
: <?php echo $this->_tpl_vars['crMethodINV']; ?>

                                      <?php endif; ?>
                                   </td>
                              </tr>
                                                            <tr>
                                   <td colspan="2" height="5"></td>
                              </tr>
                                                            <?php if ($this->_tpl_vars['bylvl'] == 'Yes'): ?>
                              <tr id="trBuyer">
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_BUYER_RIGHTS']; ?>
 : </td>
                                   <td>
                                   <table>
                                   <tr>
                                      <td><?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
&nbsp;<font class="reqmsg"></font> :</td>
                                      <td>
                                         <input type="checkbox" name="Data[eReqVerificationPo]" value="Yes" <?php if ($this->_tpl_vars['arr'][0]['eReqVerificationPo'] == 'Yes'): ?> checked <?php endif; ?>  /> <?php echo $this->_tpl_vars['LBL_PO_ISSUANCE']; ?>
 &nbsp;&nbsp;&nbsp;
                                         <input type="checkbox" name="Data[eReqVerifyInvAcpt]" value="Yes" <?php if ($this->_tpl_vars['arr'][0]['eReqVerifyInvAcpt'] == 'Yes'): ?> checked <?php endif; ?>  /> <?php echo $this->_tpl_vars['LBL_INVOICE_ACCEPTANCE']; ?>
 &nbsp;&nbsp;&nbsp;
                                      </td>
                                   </tr>
                                   <tr>
                                   <td>
                                        <?php echo $this->_tpl_vars['LBL_ORDER_STATUS_LEVEL']; ?>
 : <br/>
                                        <select multiple="multiple" name="vOrderStatusLevel[]" id="vOrderStatusLevel" style="width:176px; height:50px;" >
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
                                                <?php if (((is_array($_tmp=$this->_tpl_vars['POarr'][$this->_sections['i']['index']]['status'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['lvls']) : in_array($_tmp, $this->_tpl_vars['lvls']))): ?>
                                                <option value="<?php echo $this->_tpl_vars['POarr'][$this->_sections['i']['index']]['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['POarr'][$this->_sections['i']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['selPOarr']) : in_array($_tmp, $this->_tpl_vars['selPOarr']))): ?>selected<?php endif; ?>><?php echo smarty_function_assign(array('var' => 'level','value' => "vStatus_".($this->_tpl_vars['LANG'])), $this); echo $this->_tpl_vars['POarr'][$this->_sections['i']['index']][$this->_tpl_vars['level']]; ?>
</option>
                                                <?php endif; ?>
                                             <?php endfor; endif; ?>
                                        </select>
                                   </td>
                                   <td>
                                        <?php echo $this->_tpl_vars['LBL_INV_ACCEPTANCE_LEVEL']; ?>
 : <br/>
                                        <select multiple="multiple" name="vInvoiceAcceptanceLevel[]" id="vInvoiceAcceptanceLevel" style="width:176px; height:50px;" >
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
                                                <?php if (((is_array($_tmp=$this->_tpl_vars['invarr'][$this->_sections['i']['index']]['status'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['lvls']) : in_array($_tmp, $this->_tpl_vars['lvls']))): ?>
                                                <option value="<?php echo $this->_tpl_vars['invarr'][$this->_sections['i']['index']]['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['invarr'][$this->_sections['i']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['acptInvArr']) : in_array($_tmp, $this->_tpl_vars['acptInvArr']))): ?>selected<?php endif; ?>><?php echo smarty_function_assign(array('var' => 'level','value' => "vStatus_".($this->_tpl_vars['LANG'])), $this); echo $this->_tpl_vars['invarr'][$this->_sections['i']['index']][$this->_tpl_vars['level']]; ?>
</option>
                                                <?php endif; ?>
                                             <?php endfor; endif; ?>
                                        </select>
                                   </td>
                                   </tr>
                                   </table>
                                   </td>
                              </tr>
                              <?php endif; ?>
                              <?php if ($this->_tpl_vars['suplvl'] == 'Yes'): ?>
                              <tr id="trSupplier">
                                   <td valign="top"><?php echo $this->_tpl_vars['LBL_SUPPLIER_RIGHTS']; ?>
 : </td>
                                   <td>
                                   <table>
                                   <tr>
                                      <td><?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
&nbsp;<font class="reqmsg"></font> :</td>
                                      <td>
                                         <input type="checkbox" name="Data[eReqVerificationInv]" value="Yes" <?php if ($this->_tpl_vars['arr'][0]['eReqVerificationInv'] == 'Yes'): ?> checked <?php endif; ?> /> <?php echo $this->_tpl_vars['LBL_INVOICE_ISSUANCE']; ?>
 &nbsp;&nbsp;&nbsp;
                                         <input type="checkbox" name="Data[eReqVerifyPoAcpt]" value="Yes" <?php if ($this->_tpl_vars['arr'][0]['eReqVerifyPoAcpt'] == 'Yes'): ?> checked <?php endif; ?>  /> <?php echo $this->_tpl_vars['LBL_PO_ACCEPTANCE']; ?>

                                      </td>
                                   </tr>
                                   <tr>
                                   <td>
                                        <?php echo $this->_tpl_vars['LBL_INV_STATUS_LEVEL']; ?>
 : <br/>
                                        <select multiple="multiple" name="vInvoiceStatusLevel[]" id="vInvoiceStatusLevel" style="width:176px; height:50px;" >
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
                                                <?php if (((is_array($_tmp=$this->_tpl_vars['invarr'][$this->_sections['i']['index']]['status'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['lvls']) : in_array($_tmp, $this->_tpl_vars['lvls']))): ?>
                                                <option value="<?php echo $this->_tpl_vars['invarr'][$this->_sections['i']['index']]['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['invarr'][$this->_sections['i']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['selinvarr']) : in_array($_tmp, $this->_tpl_vars['selinvarr']))): ?>selected<?php endif; ?>><?php echo smarty_function_assign(array('var' => 'level','value' => "vStatus_".($this->_tpl_vars['LANG'])), $this); echo $this->_tpl_vars['invarr'][$this->_sections['i']['index']][$this->_tpl_vars['level']]; ?>
</option>
                                                <?php endif; ?>
                                             <?php endfor; endif; ?>
                                        </select>
                                   </td>
                                   <td>
                                        <?php echo $this->_tpl_vars['LBL_ORD_ACCEPTANCE_LEVEL']; ?>
 : <br/>
                                        <select multiple="multiple" name="vOrderAcceptanceLevel[]" id="vOrderAcceptanceLevel" style="width:176px; height:50px;" >
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
                                                <?php if (((is_array($_tmp=$this->_tpl_vars['POarr'][$this->_sections['i']['index']]['status'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['lvls']) : in_array($_tmp, $this->_tpl_vars['lvls']))): ?>
                                                <option value="<?php echo $this->_tpl_vars['POarr'][$this->_sections['i']['index']]['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['POarr'][$this->_sections['i']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['acptOrdArr']) : in_array($_tmp, $this->_tpl_vars['acptOrdArr']))): ?>selected<?php endif; ?>><?php echo smarty_function_assign(array('var' => 'level','value' => "vStatus_".($this->_tpl_vars['LANG'])), $this); echo $this->_tpl_vars['POarr'][$this->_sections['i']['index']][$this->_tpl_vars['level']]; ?>
</option>
                                                <?php endif; ?>
                                             <?php endfor; endif; ?>
                                        </select>
                                   </td>
                                   </tr>
                                   </table>
                                   </td>
                              </tr>
                              <?php endif; ?>
                                                            <?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
&nbsp; :</td>
                                 <td><label><input type="checkbox" name="Data[eRFQ2VerifyReq]" id="eRFQ2VerifyReq" value="Yes" <?php if ($this->_tpl_vars['arr'][0]['eRFQ2VerifyReq'] == 'Yes'): ?>checked="checked"<?php endif; ?> /> &nbsp; <?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
</label></td>
                              </tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_AWARD']; ?>
&nbsp; :</td>
                                 <td><label><input type="checkbox" name="Data[eRFQ2AwardVerifyReq]" id="eRFQ2AwardVerifyReq" value="Yes" <?php if ($this->_tpl_vars['arr'][0]['eRFQ2AwardVerifyReq'] == 'Yes'): ?>checked="checked"<?php endif; ?> /> &nbsp; <?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
</label></td>
                              </tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_AWARD_STATUS_LEVELS']; ?>
&nbsp; :</td>
                                 <td>
                                 <select id="vRFQ2AwardStatusLevel" name="vRFQ2AwardStatusLevel[]" multiple="multiple" style="width:100px;">
                                    <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['awardStatus']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                    <option value="<?php echo $this->_tpl_vars['awardStatus'][$this->_sections['l']['index']]['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['awardStatus'][$this->_sections['l']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['rfq2awrdstssel']) : in_array($_tmp, $this->_tpl_vars['rfq2awrdstssel']))): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['awardStatus'][$this->_sections['l']['index']]['vStatus']; ?>
</option>
                                    <?php endfor; endif; ?>
                                 </select>
                                 </td>
                              </tr>
                              <?php endif; ?>
                              <?php elseif ($this->_tpl_vars['orgdtls'][0]['eOrganizationType'] == 'Buyer2'): ?>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_BID']; ?>
&nbsp; :</td>
                                 <td><label><input type="checkbox" name="Data[eRFQ2BidVerifyReq]" id="eRFQ2BidVerifyReq" value="Yes" <?php if ($this->_tpl_vars['arr'][0]['eRFQ2BidVerifyReq'] == 'Yes'): ?>checked="checked"<?php endif; ?> /> &nbsp; <?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
</label></td>
                              </tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_AWARD_ACCEPTANCE']; ?>
&nbsp; :</td>
                                 <td><label><input type="checkbox" name="Data[eRFQ2AwardAcceptVerifyReq]" id="eRFQ2AwardAcceptVerifyReq" value="Yes" <?php if ($this->_tpl_vars['arr'][0]['eRFQ2AwardAcceptVerifyReq'] == 'Yes'): ?>checked="checked"<?php endif; ?> /> &nbsp; <?php echo $this->_tpl_vars['LBL_VERIFICATION_REQUIRED']; ?>
</label></td>
                              </tr>
                              <tr>
                                 <td valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_AWARD_ACCEPTANCE_STATUS_LEVELS']; ?>
&nbsp; :</td>
                                 <td>
                                 <select id="vRFQ2AwardAcceptLevel" name="vRFQ2AwardAcceptLevel[]" multiple="multiple" style="width:100px;">
                                    <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['awardAcceptStatus']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                    <option value="<?php echo $this->_tpl_vars['awardAcceptStatus'][$this->_sections['l']['index']]['iStatusID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['awardAcceptStatus'][$this->_sections['l']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['rfq2awrdacptsel']) : in_array($_tmp, $this->_tpl_vars['rfq2awrdacptsel']))): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['awardAcceptStatus'][$this->_sections['l']['index']]['vStatus']; ?>
</option>
                                    <?php endfor; endif; ?>
                                 </select>
                                 </td>
                              </tr>
                              <?php endif; ?>
                              <tr>
                                   <td colspan="2" height="5"></td>
                              </tr>
                              <tr>
                                   <td>&nbsp;</td>
                                   <td>
                                        <img id="btnSubmit" name="Submit" title="Submit" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-submit.gif" alt="" onclick="return frmSubmit();" style="cursor:pointer; vertical-align:middle;" border="0" /> &nbsp; <img id="reset_btn" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reset.gif" alt="" border="0" onclick="resetform();return false;" style="cursor:pointer; vertical-align:middle;" /> &nbsp; <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-cancel.gif" alt="" border="0" onClick="window.location=SITE_URL_DUM+'organizationlist';" style="cursor:pointer; vertical-align:middle;" />
                                   </td>
                              </tr>
                         </table>
                         </form>
                    </div>
                    <div>&nbsp;</div>
               </div>
          </div>
     </div>
<input id="vldms" name="vldms" style="display:none;" value="" />
</div>

<script type="text/javascript">//<![CDATA[
// window.CKEDITOR_BASEPATH='<?php echo $this->_tpl_vars['CK_EDITOR_URL']; ?>
';
//]]>
</script>
<!--<script type="text/javascript" src="<?php echo $this->_tpl_vars['CK_EDITOR_URL']; ?>
ckeditor.js"></script>-->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<!--<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS']; ?>
jckeditorpref.js"></script>-->

<?php echo '
<script type="text/javascript">
var vld = $("#frmadd").validate({
     rules: {
        "Data[vEncryptionKey]": {
           required: function() {
              if($(\'#eSecureImportPO\').attr(\'checked\') == true || $(\'#eSecureImportInvoice\').attr(\'checked\') == true || $(\'#eSecureExportPO\').attr(\'checked\') == true || $(\'#eSecureExportInvoice\').attr(\'checked\') == true) {
                 return true;
              } else {
                 return false;
              }
           }
        },
        "Data[eCryptAlgo]": {
           required: function() {
              if($(\'#eSecureImportPO\').attr(\'checked\') == true || $(\'#eSecureImportInvoice\').attr(\'checked\') == true || $(\'#eSecureExportPO\').attr(\'checked\') == true || $(\'#eSecureExportInvoice\').attr(\'checked\') == true) {
                 return true;
              } else {
                 return false;
              }
           }
        }
     },
     messages:{
        "Data[vCurrency]": {
           digits: "Please Enters only Digits"
        }
     }
});
//changeStatus($(\'#eReqVerification\').val());
//var buyerDefault= $(\'#trBuyer\').html();
//var supplierDefault=$(\'#trSupplier\').html();
function resetform()
{
	$(\'#frmadd\')[0].reset();
   vld.resetForm();
}
function changeStatus(vRight)
{
     var vRight;
     if(vRight == \'Yes\')
     {
          //$(\'#trBuyer\').html(buyerDefault);
          $(\'#trBuyer\').show();
         // $(\'#trSupplier\').html(supplierDefault);
          $(\'#trSupplier\').show();
     }
    else
    {
         $(\'#trBuyer\').hide();
         $(\'#trSupplier\').hide();
         $(\'#trSupplier select option\').removeAttr("selected");
         $(\'#trBuyer select option\').removeAttr("selected");

   }
}
function frmSubmit()
{
   $(\'#frmadd\').submit();
   $(document).ready( function() {
     $(function() {
        var ead=10;
        $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
     });
   });
}
</script>
'; ?>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jorgpref.js"></script>
<?php if ($this->_tpl_vars['msg'] != ''):  echo '
<script type="text/javascript">
$(document).ready(function() {
	var msg = \'';  echo $this->_tpl_vars['msg'];  echo '\';
   if(msg!= \'\' && msg != undefined && $(\'#vldms\').val()!=msg) {
	  alert(msg);
     $(\'#vldms\').val(msg);
   }
});
</script>
'; ?>

<?php endif; ?>