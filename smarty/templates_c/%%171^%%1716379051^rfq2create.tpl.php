<?php /* Smarty version 2.6.0, created on 2015-06-24 07:39:34
         compiled from member/user/rfq2create.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'calcLTzTime', 'member/user/rfq2create.tpl', 113, false),array('modifier', 'DateTime', 'member/user/rfq2create.tpl', 113, false),array('modifier', 'trim', 'member/user/rfq2create.tpl', 196, false),array('modifier', 'date_format', 'member/user/rfq2create.tpl', 196, false),array('modifier', 'cat', 'member/user/rfq2create.tpl', 222, false),array('modifier', 'stripslashes', 'member/user/rfq2create.tpl', 233, false),array('modifier', 'strtolower', 'member/user/rfq2create.tpl', 274, false),array('modifier', 'substr', 'member/user/rfq2create.tpl', 274, false),array('function', 'assign', 'member/user/rfq2create.tpl', 220, false),)), $this); ?>
<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_CREATE_RFQ2']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicecreate" class="current"><EM><?php echo $this->_tpl_vars['LBL_CREATE_RFQ2']; ?>
</EM></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div>&nbsp;</div>
                <div>
                    <?php if ($this->_tpl_vars['msg'] != ''): ?>
                    <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
                    <?php endif; ?>
                    <form name="frmadd" id="frmadd" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-rfq2create_a"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="iRFQ2Id" id="iRFQ2Id" value="<?php echo $this->_tpl_vars['irfq2id']; ?>
" />
                        <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
                        <input type="hidden" name="gmtoffset" id="gmtoffset" value="" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b><?php echo $this->_tpl_vars['var_msg']; ?>
</b></font></td></tr>
                            <tr>
                                <td width="190" valign="top">Create RFQ2 for</td>
                                <td valign="top">:</td>
                                <td valign="top">
                                    <span style="float:left;">
                                        <input type="radio" name="eFor" id="eForInvoice" value="Invoice" <?php if ($this->_tpl_vars['dtls'][0]['eFrom'] == 'Invoice' || $this->_tpl_vars['dtls'][0]['eFrom'] == ''): ?> checked="checked" <?php endif; ?> />&nbsp;<?php echo $this->_tpl_vars['LBL_INVOICE']; ?>

                                               <input type="radio" name="eFor" id="eForPO" value="PO" <?php if ($this->_tpl_vars['dtls'][0]['eFrom'] == 'PO'): ?> checked="checked" <?php endif; ?> />&nbsp;<?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>

                                    </span>
                                </td>
                            </tr>
                            <?php if ($this->_tpl_vars['invoices'] != ''): ?>
                            <tr id="invoice_tr">
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_INVOICE']; ?>
</td>
                                <td valign="top">:</td>
                                <td valign="top">
                                    <span style="float:left;"><?php echo $this->_tpl_vars['invoices']; ?>
</span>
                                    <span style="float:right; padding-right:70px;">
                                        <?php echo $this->_tpl_vars['LBL_FILTER_LIST_BY']; ?>
 : <input type="text" name="invfilter" id="invfilter" style="width:100px;" />
                                    </span>
                                </td>
                            </tr>
                            <?php else: ?>
                            <input type="hidden" id="iInvoiceID" name="Data[iInvoiceID]" value="<?php echo $this->_tpl_vars['dtls'][0]['iInvoiceID']; ?>
" />
                            <?php endif; ?>                            

                            <?php if ($this->_tpl_vars['pos'] != ''): ?>
                            <tr id="po_tr">
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
</td>
                                <td valign="top">:</td>
                                <td valign="top">
                                    <span style="float:left;"><?php echo $this->_tpl_vars['pos']; ?>
</span>
                                    <span style="float:right; padding-right:70px;">
                                        <?php echo $this->_tpl_vars['LBL_FILTER_LIST_BY']; ?>
 : <input type="text" name="invfilterpo" id="invfilterpo" style="width:100px;" />
                                    </span>
                                </td>
                            </tr>
                            <?php else: ?>
                            <input type="hidden" id="iPurchaseOrderID" name="Data[iPurchaseOrderID]" value="<?php echo $this->_tpl_vars['dtls'][0]['iPurchaseOrderID']; ?>
" />
                            <?php endif; ?>
                            <tr id="heading_title_invoice">
                                <td colspan="3"><u><b><?php echo $this->_tpl_vars['LBL_INVOICE_DETAILS']; ?>
</b></u></td>
                            </tr>
                            <tr id="heading_title_po">
                                <td colspan="3"><u><b><?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER_DETAILS']; ?>
</b></u></td>
                            </tr>                            
                            <tr>
                                <td colspan="3">
                                    <div style="float:right; display:none;" class="ldri"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" /><?php echo $this->_tpl_vars['LBL_LOADING_INVOICE_DETAILS']; ?>
</div>
                                    <div style="float:right; display:none;" class="ldripo"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" /><?php echo $this->_tpl_vars['LBL_LOADING_PURCHASE_ORDER_DETAILS']; ?>
</div>
                                    <div id="irfq2dtls_bx">
                                        <?php if ($this->_tpl_vars['dtls'][0]['vInvoiceCode'] != ''): ?>
                                        <table cellpadding="1" cellspacing="1" border="0">
                                            <tr>
                                                <td width="230"><?php echo $this->_tpl_vars['LBL_INV_CODE']; ?>
</td>
                                                <td>:</td>
                                                <td class="blue-ore"><?php echo $this->_tpl_vars['dtls'][0]['vInvoiceCode']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['vBuyerName']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['vSupplierName']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_BANK']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['vBankName']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_BANK_CODE']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['vBankCode']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['vAccountName']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
 <?php echo $this->_tpl_vars['LBL_NUMBER']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['vAccountNumber']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_INVOICE_PAYABLE_DATE']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php if ($this->_tpl_vars['dtls'][0]['dNetPaymentdate'] != '0000-00-00'):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dNetPaymentdate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10));  else: ?>---<?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_ACCEPTED']; ?>
 <?php echo $this->_tpl_vars['LBL_DATE']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php if ($this->_tpl_vars['dtls'][0]['dAcceptedNetPaymentDate'] != '0000-00-00'):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dAcceptedNetPaymentDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10));  else: ?>---<?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_INVOICE_PAYABLE']; ?>
 (<?php echo $this->_tpl_vars['LBL_ACCEPTED']; ?>
) <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
</td>
                                                <td>:</td>
                                                <td class="ipaam"><?php echo $this->_tpl_vars['dtls'][0]['fAcceptedAmount']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_INVOICE_TOTAL']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['fInvoiceTotal']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['vCurrency']; ?>
</td>
                                            </tr>
                                        </table>
                                        <?php endif; ?>
                                        <?php if ($this->_tpl_vars['dtls'][0]['vPOCode'] != ''): ?>                                        
                                        <table cellpadding="1" cellspacing="1" border="0">
                                            <tr>
                                                <td width="230"><?php echo $this->_tpl_vars['LBL_PO_CODE']; ?>
</td>
                                                <td>:</td>
                                                <td class="blue-ore"><?php echo $this->_tpl_vars['dtls'][0]['vPOCode']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['vBuyerCompanyName']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['poh_vSupplierName']; ?>
</td>
                                            </tr>                                            
                                            <tr>
                                                <td ><?php echo $this->_tpl_vars['LBL_INVOICE_TOTAL']; ?>
</td>
                                                <td>:</td>
                                                <td class=""><?php echo $this->_tpl_vars['dtls'][0]['fPOTotal']; ?>
</td>
                                            </tr>                                            
                                        </table>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr><td colspan="3" style="border-top:1px solid #cccccc;">&nbsp;</td></tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
</td>
                                <td valign="top">:</td>
                                <td class="" valign="top">
                                    <?php if ($this->_tpl_vars['view'] != 'add'): ?>
                                    <input type="hidden" id="vRFQ2Code" name="Data[vRFQ2Code]" value="<?php echo $this->_tpl_vars['dtls'][0]['vRFQ2Code']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
" class="required" />
                                    <?php echo $this->_tpl_vars['dtls'][0]['vRFQ2Code']; ?>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_TYPE']; ?>
</td>
                                <td valign="top">:</td>
                                <td class="" valign="top"><?php echo $this->_tpl_vars['rfq2type']; ?>
</td>
                            </tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_IMMEDIATE_START']; ?>
</td>
                                <td valign="top">:</td>                                
                                <td valign="top"><input type="checkbox" id="eInstantStart" name="Data[eInstantStart]" value="Yes" <?php if ($this->_tpl_vars['dtls'][0]['eInstantStart'] == 'Yes'): ?> checked <?php endif; ?> /></td>
                            </tr>
                            <tr id="relative_enddate_checkbox_tr">
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_RELATIVE_END']; ?>
</td>
                                <td valign="top">:</td>
                                <td valign="top"><input type="checkbox" id="eRelativeEndTime" name="Data[eRelativeEndTime]" value="Yes" <?php if ($this->_tpl_vars['dtls'][0]['eRelativeEndTime'] == 'Yes'): ?>checked<?php endif; ?> /></td>
                            </tr>
                            <tr id="startdate_tr">
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_START_DATE']; ?>
 <font class="reqmsg">*</font> </td>
                                <td valign="top">:</td>
                                <td valign="top">
                                                                                                            <input type="text" id="dStartDate" class="save required" name="Data[dStartDate]" value="<?php if (((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dStartDate'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && ((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dStartDate'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '0000-00-00' && ((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dStartDate'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '0000-00-00 00:00:00'):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dStartDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M'));  endif; ?>" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_START_DATE']; ?>
" style="width:139px" />
                                </td>
                            </tr>
                            <tr id="enddate_tr">
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_END_DATE']; ?>
 <font class="reqmsg">*</font> </td>
                                <td valign="top">:</td>
                                <td valign="top">
                                    <span style="float:left;">
                                                                                                                        <input type="text" id="dEndDate" name="Data[dEndDate]" class="save required" value="<?php if (((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dEndDate'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && ((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dEndDate'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '0000-00-00' && ((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dEndDate'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '0000-00-00 00:00:00'):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['dtls'][0]['dEndDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M'));  endif; ?>" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_END_DATE']; ?>
" style="width:139px" />
                                    </span>
                                </td>
                            </tr>
                            <tr id="enddate_relative_tr" style="display: none;">
                                <td width="190" valign="top">End After</td>
                                <td valign="top">:</td>
                                <td valign="top">
                                    <span style="float:left;">
                                        <?php echo $this->_tpl_vars['LBL_HOURS']; ?>
 <input type="text" id="iEndAfterHrs" name="Data[iEndAfterHrs]" style="width:40px" value="<?php echo $this->_tpl_vars['dtls'][0]['iEndAfterHrs']; ?>
" />
                                        <?php echo $this->_tpl_vars['LBL_MINUTES']; ?>

                                        <input type="hidden" id="iEndAfterMin_saved" name="iEndAfterMin_saved" style="width:40px" value="<?php echo $this->_tpl_vars['dtls'][0]['iEndAfterMin']; ?>
" />
                                        <select style="width: 45px;" id="iEndAfterMin" name="Data[iEndAfterMin]">
                                            <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=60) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                            <?php echo smarty_function_assign(array('var' => 'time_val','value' => $this->_sections['i']['index']), $this);?>

                                            <?php if ($this->_tpl_vars['time_val'] < 10): ?>
                                            <?php echo smarty_function_assign(array('var' => 'time_val','value' => ((is_array($_tmp='0')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_sections['i']['index']) : smarty_modifier_cat($_tmp, $this->_sections['i']['index']))), $this);?>

                                            <?php endif; ?>
                                            <option value="<?php echo $this->_tpl_vars['time_val']; ?>
" <?php if ($this->_tpl_vars['time_val'] == $this->_tpl_vars['dtls'][0]['iEndAfterMin']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['time_val']; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_INSTRUCTIONS_CONDITIONS']; ?>
</td>
                                <td valign="top">:</td>
                                <td class="" valign="top"><textarea id="tInstruction" name="Data[tInstruction]" style="width:390px; height:100px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['dtls'][0]['tInstruction'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
</td>
                                <td valign="top">:</td>
                                <td class="" valign="top"><textarea id="tDescription" name="Data[tDescription]" style="width:390px; height:100px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['dtls'][0]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_BID_EVALUATION_CRITERIA']; ?>
</td>
                                <td valign="top">:</td>
                                <td class="" valign="top"><?php echo $this->_tpl_vars['bidtype']; ?>
</td>
                            </tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_AVAILABILITY']; ?>
</td>
                                <td valign="top">:</td>
                                <td class="" valign="top">
                                    <label style="display:inline-block; width:119px;"><input type="radio" id="eAssociateBuyer2" name="eAssociateBuyer2" value="association" checked="checked" /> <span style="display:inline-block; width:100px; float:right;">Association</span></label> &nbsp;
                                    <label style="display:inline-block; width:119px;"><input type="radio" id="eAssociateBuyer2" name="eAssociateBuyer2" value="country" disabled="disabled" /> <span style="display:inline-block; width:100px; float:right;">Country</span></label> &nbsp;
                                    <label style="display:inline-block; width:119px;"><input type="radio" id="eAssociateBuyer2" name="eAssociateBuyer2" value="Scheme" disabled="disabled" /> <span style="display:inline-block; width:100px; float:right;">Scheme</span></label> &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div id="b2asoc_bx">
                                        <table cellpadding="1" cellspacing="1" width="100%">
                                            <tr>
                                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
 <?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
</td>
                                                <td valign="top">&nbsp;: &nbsp;</td>
                                                <td class="" valign="top">
                                                    <input class="tltp" type="text" name="prdt_nm" id="prdt_nm" value="" title="<?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_NAME']; ?>
" /> <input class="tltp" type="text" name="prdt_cd" id="prdt_cd" value="" title="<?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
" />
                                                    <a id="prdt_srch" class="btllbl" style="" onclick="srchprdt();" title="<?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
" ><b><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</b></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
 <font class="reqmsg">*</font> </td>
                                                <td valign="top">&nbsp;: &nbsp;</td>
                                                <td class="" valign="top">
                                                    <span id="prdtlist" style="float:left;">
                                                        <select id="iProductId" name="Data[iProductId]" size="10" class="save required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
" onchange="return getb2s();">
                                                            <option value="" disabled="disabled">- <?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
 -</option>
                                                            <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['rfq2prdt']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                            <option value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['rfq2prdt'][$this->_sections['l']['index']]['ePType'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 1) : substr($_tmp, 0, 1)); ?>
-<?php echo $this->_tpl_vars['rfq2prdt'][$this->_sections['l']['index']]['iProductId']; ?>
" selected="selected" ><?php echo $this->_tpl_vars['rfq2prdt'][$this->_sections['l']['index']]['vProductName']; ?>
 (<?php echo $this->_tpl_vars['rfq2prdt'][$this->_sections['l']['index']]['vProductCode']; ?>
)</option>
                                                            <?php endfor; endif; ?>
                                                        </select>
                                                    </span>
                                                    <span id="prdtl" style="display:none; position: absolute; z-index:100; padding:3px; background:#ffffff; border:1px solid #eeeeee;"></span>
                                                    <span style="float:right; padding-right:70px;">
                                                        <?php echo $this->_tpl_vars['LBL_FILTER_LIST_BY']; ?>
 : <input type="text" name="prdtfilter" id="prdtfilter" style="width:100px;" />
                                                    </span>
                                                    <br/><br/>
                                                    <span id="pdsc" style="float:right; padding-right:70px;">
                                                        <span style="margin-left:10px;"><b><?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
:</b><br/></span>
                                                        <span id="pdesc" style="display:inline-block; width:190px; height:70px; margin-left:10px; z-index:-1; border:1px solid #cccccc; overflow:scroll;">&nbsp;</span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr><td colspan="3">&nbsp;</td></tr>
                                            <tr>
                                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
</td>
                                                <td valign="top">&nbsp;: &nbsp;</td>
                                                <td class="" valign="top">
                                                    <span id="b2list" style="float:left;">
                                                        <select id="Buyer2Id" name="Data[Buyer2Id][]" size="10" class="" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
" multiple="multiple" >
                                                            <option value="" disabled="disabled">- <?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
 -</option>
                                                        </select>
                                                        <div><a class="b2sal" style="cursor:pointer;"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_ALL']; ?>
</a></div>
                                                    </span>
                                                    <span id="b2dtl" style="display:none; position: absolute; z-index:100; padding:3px; background:#ffffff; border:1px solid #eeeeee;"></span>
                                                    <span style="float:right; padding-right:70px;">
                                                        <?php echo $this->_tpl_vars['LBL_FILTER_LIST_BY']; ?>
 : <input type="text" name="b2filter" id="b2filter" style="width:100px;" /> <br/>
                                                        <span style="display:none;" class="ldrb2"><br/><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" /><?php echo $this->_tpl_vars['LBL_LOADING']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
</span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td style="height:50px;">
                                                    &nbsp;
                                                    <img id="b2a" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
down-arrows.png" height="30px" style="cursor:pointer;" />
                                                    <span style="display:inline-block;width:30px;">&nbsp;</span>
                                                    <img id="b2r" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
up-arrows.png" height="30px" style="cursor:pointer;" />
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
 <font class="reqmsg">*</font> </td>
                                                <td valign="top">&nbsp;: &nbsp;</td>
                                                <td class="" valign="top">
                                                    <span id="ib2list" style="float:left;">
                                                        <select id="iBuyer2Id" name="Data[iBuyer2Id][]" size="10" class="save required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
" multiple="multiple" onchange="">
                                                            <option value="" disabled="disabled">- <?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
 -</option>
                                                            <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['rfq2b2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                            <option value="<?php echo $this->_tpl_vars['rfq2b2'][$this->_sections['l']['index']]['iOrganizationID']; ?>
" prdt="<?php echo $this->_tpl_vars['rfq2b2'][$this->_sections['l']['index']]['iProductId']; ?>
"><?php echo $this->_tpl_vars['rfq2b2'][$this->_sections['l']['index']]['vCompanyName']; ?>
 (<?php echo $this->_tpl_vars['rfq2b2'][$this->_sections['l']['index']]['vOrganizationCode']; ?>
)</option>
                                                            <?php endfor; endif; ?>
                                                        </select>
                                                    </span>
                                                    <span id="b2dtls" style="display:none; position: absolute; z-index:100; padding:3px; background:#ffffff; border:1px solid #eeeeee;"></span>
                                                    <span style="float:right; padding-right:70px;">
                                                        <?php echo $this->_tpl_vars['LBL_FILTER_LIST_BY']; ?>
 : <input type="text" name="ib2filter" id="ib2filter" style="width:100px;" />
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_DAYS']; ?>
 <font class="reqmsg">*</font> </td>
                                <td valign="top">:</td>
                                <td class="" valign="top">
                                    <span style="display:inline-block; float:left; padding-right:10px;">
                                        <input type="text" id="iDays" name="Data[iDays]" value="<?php echo $this->_tpl_vars['dtls'][0]['iDays']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_DAYS']; ?>
" style="float:left;" />
                                    </span>                                    
                                </td>
                            </tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_ADVANCE']; ?>
 <font class="reqmsg">*</font> </td>
                                <td valign="top">:</td>
                                <td class="" valign="top">
                                    <span style="display:inline-block; float:left; padding-right:10px;">
                                        <label style="float:right;">%</label><input type="text" id="fAdvanceMinPc" name="Data[fAdvanceMinPc]" class="decimals" value="<?php echo $this->_tpl_vars['dtls'][0]['fAdvanceMinPc']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ADVANCE']; ?>
 (%)" style="float:left;" />
                                    </span>
                                    <span style="display:inline-block; float:left;">
                                        <input type="text" id="fAdvanceMinAmt" name="Data[fAdvanceMinAmt]" class="save required decimals min" min="0" value="<?php echo $this->_tpl_vars['dtls'][0]['fAdvanceMinAmt']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ADVANCE']; ?>
 <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
" />
                                                                            </span> &nbsp;
                                    <span class="at" style="font-weight:bold;display: none;"></span>
                                    <input type="hidden" id="fAdvanceTotal" name="Data[fAdvanceTotal]" value="<?php echo $this->_tpl_vars['dtls'][0]['fAdvanceTotal']; ?>
" />
                                </td>
                            </tr>
                            <tr>
                                <td width="190" valign="top"><?php echo $this->_tpl_vars['LBL_PRICE']; ?>
 <font class="reqmsg">*</font> </td>
                                <td valign="top">:</td>
                                <td class="" valign="top">
                                    <span style="display:inline-block; float:left; padding-right:10px;"><label style="float:right;">%</label><input type="text" id="fPriceMaxPc" name="Data[fPriceMaxPc]" class="decimals" value="<?php echo $this->_tpl_vars['dtls'][0]['fPriceMaxPc']; ?>
" style="float:left;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PRICE']; ?>
 (%)" /></span>
                                    <span style="display:inline-block; float:left;"><input type="text" id="fPriceMaxAmt" name="Data[fPriceMaxAmt]" class="save required decimals min" min="0" value="<?php echo $this->_tpl_vars['dtls'][0]['fPriceMaxAmt']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PRICE']; ?>
 <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
" /></span>
                                    &nbsp; <span class="pt" style="font-weight:bold;display: none;"></span>
                                    <input type="hidden" id="fPriceTotal" name="Data[fPriceTotal]" value="<?php echo $this->_tpl_vars['dtls'][0]['fPriceTotal']; ?>
" />
                                </td>
                            </tr>
                                                        <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_ATTACH_DOCUMENT']; ?>
</td>
                                <td valign="top">:</td>
                                <td>
                                    <input type="file" name="upload" id="upload" style="height:23px;" />
                                    <div id="files_list" class="file_upload">
                                        <ul style="list-style-type: none">
                                            <?php if (count($_from = (array)$this->_tpl_vars['rfq2files'])):
    foreach ($_from as $this->_tpl_vars['rfq2files']):
?>
                                            <li>
                                                <a href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
upload/attachment_docs/rfq2/<?php echo $this->_tpl_vars['irfq2id']; ?>
/<?php echo $this->_tpl_vars['rfq2files']['vFile']; ?>
')" > <?php echo $this->_tpl_vars['rfq2files']['vFile']; ?>
</a><input type="button" value="Delete" onclick="deleteFile($(this).parent(),'<?php echo $this->_tpl_vars['rfq2files']['iRfq2FileId']; ?>
');" />
                                            </li>
                                            <?php endforeach; unset($_from); endif; ?>
                                        </ul>
                                        <input type="hidden" name="deleteFiles" id="deleteFiles"/>
                                    </div>
                                </td>
                            </tr>
                                                        <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="hidden" name="Data[eSaved]"  id="eSaved" value="" />
                                </td>
                            </tr>
                                                        <?php if (((is_array($_tmp=$this->_tpl_vars['dtls'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && $this->_tpl_vars['dtls'][0]['eStatus'] == $this->_tpl_vars['rjtsts']): ?>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;"><?php echo ((is_array($_tmp=$this->_tpl_vars['dtls'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</div></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="2" height="5"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2"><a href="javascript:void(0)">
                                        <?php if ($this->_tpl_vars['dtls'][0]['eSaved'] != 'No'): ?>                                         <a id="btnSave" name="save" class="btllbl" style="" onclick="$('#eSaved').val('Yes'); setsave(); return frmsubmit();" title="<?php echo $this->_tpl_vars['LBL_SAVE']; ?>
" ><b><?php echo $this->_tpl_vars['LBL_SAVE']; ?>
</b></a>
                                        <?php endif; ?>
                                        <a id="btnSubmit" name="submit" class="btllbl" style="" onclick="$('#eSaved').val('No'); setsubmit(); return frmsubmit();" title="<?php echo $this->_tpl_vars['LBL_SUBMIT']; ?>
" ><b><?php echo $this->_tpl_vars['LBL_SUBMIT']; ?>
</b></a>
                                        <a id="btnreset" name="reset" class="btllbl" style="" onclick="frmreset();" title="<?php echo $this->_tpl_vars['LBL_RESET']; ?>
" ><b><?php echo $this->_tpl_vars['LBL_RESET']; ?>
</b></a>
                                        <a id="btncancel" name="cancel" href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2list" class="btllbl" style="" title="<?php echo $this->_tpl_vars['LBL_CANCEL']; ?>
" ><b><?php echo $this->_tpl_vars['LBL_CANCEL']; ?>
</b></a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div>&nbsp;</div>
            </div>
        </div>
    </div>
    <span id="sn" style="display:hidden;"></span>
    <span id="spn" style="display:hidden;"></span>
    <span id="vldms" style="display:none;"></span>
</div>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery-ui-timepicker.js"></script>
<!--<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
jquery.dynDateTime.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
css/calendar-blue.css"  />-->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_CONTENT_JS']; ?>
multifile.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.listboxfilter.js" ></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
livequery.js" ></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_CONTENT_JS']; ?>
jfdatetime.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jrfq2create.js"></script>

<?php echo '
<script type="text/javascript">
    var corg = \'';  echo $this->_tpl_vars['curORGID'];  echo '\';
    // var sid = \'';  echo $this->_tpl_vars['sid'];  echo '\';
    $(document).ready(function(){
        var selected_type = $(\'input:radio[name=eFor]:checked\').val();
        fromClick(selected_type);
        instantStartClicked();
        relativeStartClicked();
        $("#eForInvoice").bind("click", function() {
            fromClick(\'Invoice\');
        });
        $("#iEndAfterHrs").live("blur", function() {
            getDays();
        });
        $("#iEndAfterMin").live("change", function() {
            getDays();
        });
        $("#eForPO").bind("click", function() {
            fromClick(\'PO\');
        });
        $("#eInstantStart").live("click", function() {
            instantStartClicked();            
        });
        $("#eRelativeEndTime").live("click", function() {
            relativeStartClicked();            
        });
        $("#fAdvanceMinPc").live("blur", function() {
            if($(\'#fAdvanceMinPc\').val() == "" || $(\'#fAdvanceMinPc\').val() == "0"){
                $(\'#fAdvanceMinPc\').val(\'0\');
                $(\'#fAdvanceMinAmt\').val(\'0\');
            }
        });
        $("#fAdvanceMinAmt").live("blur", function() {
            if($(\'#fAdvanceMinAmt\').val() == "" || $(\'#fAdvanceMinAmt\').val() == "0"){
                $(\'#fAdvanceMinAmt\').val(\'0\');
            }
        });
        $("#fPriceMaxPc").live("blur", function() {
            if($(\'#fPriceMaxPc\').val() == "" || $(\'#fPriceMaxPc\').val() == "0"){
                $(\'#fPriceMaxPc\').val(\'0\');
                $(\'#fPriceMaxAmt\').val(\'0\');
            }
        });
        $("#fPriceMaxAmt").live("blur", function() {
            if($(\'#fPriceMaxAmt\').val() == "" || $(\'#fPriceMaxAmt\').val() == "0"){
                $(\'#fPriceMaxAmt\').val(\'0\');
            }
        });
        
        function instantStartClicked(){
            var eInstantStartChecked = $(\'input[name="Data[eInstantStart]"]:checked\').length > 0;
            if(eInstantStartChecked){
                $(\'#startdate_tr\').hide();
                $(\'#enddate_tr\').hide();
                $(\'#relative_enddate_checkbox_tr\').hide();
                $(\'#enddate_relative_tr\').show();
            }else{
                $(\'#startdate_tr\').show();
                $(\'#enddate_tr\').show();
                $(\'#relative_enddate_checkbox_tr\').show();
                $(\'#enddate_relative_tr\').hide();
            }
        }
        
        function relativeStartClicked(){
            var eRelativeEndTimeChecked = $(\'input[name="Data[eRelativeEndTime]"]:checked\').length > 0;
            if(eRelativeEndTimeChecked){
                $(\'#enddate_tr\').hide();
                $(\'#enddate_relative_tr\').show();
            }else{
                $(\'#enddate_tr\').show();
                $(\'#enddate_relative_tr\').hide();
            }
        }

        $(\'#gmtoffset\').val(gmtoffset);
        var sd = \'';  echo $this->_tpl_vars['dtls'][0]['dStartDate'];  echo '\'; 	// $(\'#dStartDate\').val();
        var ed = \'';  echo $this->_tpl_vars['dtls'][0]['dEndDate'];  echo '\'; 	// $(\'#dEndDate\').val();
        if($.trim(sd)!=\'\' && $.trim(sd)!=\'0000-00-00\' && $.trim(sd)!=\'0000-00-00 00:00:00\' && $.trim(ed)!=\'\' && $.trim(ed)!=\'0000-00-00\' && $.trim(ed)!=\'0000-00-00 00:00:00\') {
            sd = strtotime(sd);
            ed = strtotime(ed);
            sd = date(\'Y-m-d H:i:s\', strtotime(\'+\'+(-gmtoffset)+\' minutes\',sd));
            ed = date(\'Y-m-d H:i:s\', strtotime(\'+\'+(-gmtoffset)+\' minutes\',ed));
            $(\'#dStartDate\').val(sd);
            $(\'#dEndDate\').val(ed);
        }
    });
    
    function fromClick(type){
        if(type == "Invoice" || type == ""){
            $(\'#invoice_tr\').show();
            $(\'#po_tr\').hide();
            $(\'#eAuctionType option:eq(0)\').attr(\'selected\', \'selected\');
            $(\'#eAuctionType\').attr(\'disabled\', false);
            $(\'#heading_title_invoice\').show();
            $(\'#heading_title_po\').hide();
            //$(\'#irfq2dtls_bx\').show();
            $(\'#iInvoiceID\').trigger(\'change\');
            $(\'#eInstantStart\').attr(\'disabled\',false);
            $(\'#iDays\').attr(\'value\',\'0\');
        }else if(type == "PO"){
            $(\'#invoice_tr\').hide();
            $(\'#po_tr\').show();
            //$(\'#eAuctionType > option > #\').attr(\'selected\',true);
            //$(\'#eAuctionType option:eq(1)\').attr(\'selected\', \'selected\');
            //$(\'#eAuctionType\').attr(\'disabled\', true);
            $(\'#heading_title_invoice\').hide();
            $(\'#heading_title_po\').show();
            //$(\'#irfq2dtls_bx\').show();            
            $(\'#iPurchaseOrderID\').trigger(\'change\');            
            //$(\'#eInstantStart\').attr(\'checked\',\'checked\');
            //$(\'#eInstantStart\').trigger(\'click\');
            //$(\'#relative_enddate_checkbox_tr\').hide();
            //$(\'#startdate_tr\').hide();
            //$(\'#enddate_tr\').hide();
            //$(\'#eInstantStart\').attr(\'disabled\',true);
            if($(\'#iEndAfterHrs\').val() == ""){
                $(\'#iEndAfterHrs\').val(\'00\');
            }
            //$(\'#iEndAfterHrs\').attr(\'readonly\',\'readonly\');
            if($(\'#iEndAfterMin_saved\').val() == ""){
                $(\'#iEndAfterMin option:eq(0)\').attr(\'selected\',\'selected\');
            }            
            //$(\'#iEndAfterMin\').attr(\'disabled\',\'disabled\');
            $(\'#enddate_relative_tr\').show();
            $(\'#iDays\').attr(\'value\',\'45\');
        }
        
    }
    
    if(document.getElementById(\'upload\'))
    {
        var multiSelect = new MultiSelector( document.getElementById(\'files_list\'), 5);
        multiSelect.addElement(document.getElementById(\'upload\'));
    }
    var fileArr = new Array();
    function deleteFile(obj,fileid)
    {
        fileArr.push(fileid);
        $(\'#deleteFiles\').val(fileArr);
        obj.html("");
    }

    jQuery.validator.addMethod("datengtd", function(value, element, params)
    {
        var val = element.value;
        var val = element.value;
        if(val.indexOf(\' \')!=-1) {
            var v = val.split(\' \');
            val = v[0];
        }
        var vl = val.split(\'-\');
        var vdt = vl[2]+\'/\'+vl[1]+\'/\'+vl[0];
        vl[0] = parseInt(vl[0],10);
        vl[1] = parseInt(vl[1],10);
        vl[2] = parseInt(vl[2],10);
        vl[1] = vl[1] - 1;
        var vdate = new Date(vl[0],vl[1],vl[2]);
        var tday = new Date();
        if(params[0]==\'birthdate\') {
            tday.setFullYear(tday.getFullYear()-params[1]);
        }
        // alert(vdate.getTime()+\'>\'+tday.getTime());
        if(vdate.getTime() <= tday.getTime()) {
            return true;
        } else {
            return false;
        }
    });
    jQuery.validator.addMethod("dategtd", function(value, element)
    {
        if($.trim(value)==\'\') {
            return true;
        }
        /*var val = element.value;
   var vl = val.split(\'-\');
   vl[0] = parseInt(vl[0],10);
   vl[1] = parseInt(vl[1],10);
   vl[2] = parseInt(vl[2],10);
   vl[1] = vl[1] - 1;
        var vdt = vl[2]+\'/\'+vl[1]+\'/\'+vl[0];
        var tday = new Date();
        var tdt = tday.getDate()+\'/\'+tday.getMonth()+\'/\'+tday.getFullYear();
        alert(Date.parse(vdt)+\'>\'+Date.parse(tdt));
        alert(Number(Date.parse(vdt)) > Number(Date.parse(tday)));
        // if(Date.parse(vdt) > Date.parse(tday)) {
         */
        var val = element.value;
        if(val.indexOf(\' \')!=-1) {
            var v = val.split(\' \');
            val = v[0];
        }
        var vl = val.split(\'-\');
        var vdt = vl[2]+\'/\'+vl[1]+\'/\'+vl[0];
        vl[0] = parseInt(vl[0],10);
        vl[1] = parseInt(vl[1],10);
        vl[2] = parseInt(vl[2],10);
        vl[1] = vl[1] - 1;
        var vdate = new Date(vl[0],vl[1],vl[2]);
        var tday = new Date();
        var tdt = tday.getDate()+\'/\'+tday.getMonth()+\'/\'+tday.getFullYear();
        var tdate = new Date(tday.getFullYear(),tday.getMonth(),tday.getDate());
        // alert(vdate.getTime()+\'>=\'+tday.getTime());
        // if(vdate.getTime() >= tday.getTime()) {
        if(vdate.getTime() >= tdate.getTime()) {
            return true;
        } else {
            return false;
        }
    });

    jQuery.validator.addMethod("dategtdt", function(value, element,params)
    {
        if($.trim(value)==\'\') {
            return true;
        }
        /*var val = element.value;
   var vl = val.split(\'-\');
   vl[0] = parseInt(vl[0],10);
   vl[1] = parseInt(vl[1],10);
   vl[2] = parseInt(vl[2],10);
   vl[1] = vl[1] - 1;
        var vdt = vl[2]+\'/\'+vl[1]+\'/\'+vl[0];
        var tday = new Date();
        var tdt = tday.getDate()+\'/\'+tday.getMonth()+\'/\'+tday.getFullYear();
        alert(Date.parse(vdt)+\'>\'+Date.parse(tdt));
        alert(Number(Date.parse(vdt)) > Number(Date.parse(tday)));
        // if(Date.parse(vdt) > Date.parse(tday)) {*/
        var val = element.value;
        if(val.indexOf(\' \')!=-1) {
            var v = val.split(\' \');
            val = v[0];
            tvl = v[1].split(\':\');
        }
        var vl = val.split(\'-\');
        var vdt = vl[2]+\'/\'+vl[1]+\'/\'+vl[0];
        vl[0] = parseInt(vl[0],10);
        vl[1] = parseInt(vl[1],10);
        vl[2] = parseInt(vl[2],10);
        vl[1] = vl[1] - 1;
        var vdate = new Date(vl[0],vl[1],vl[2],tvl[0],tvl[1]);
        var tday = new Date();
        var tdt = tday.getDate()+\'/\'+tday.getMonth()+\'/\'+tday.getFullYear();
        var tdate = new Date(tday.getFullYear(),tday.getMonth(),tday.getDate(),tday.getHours(),tday.getMinutes());
        // alert((vdate.getTime() - tdate.getTime())/(1000*60));
        // if(vdate.getTime() >= tday.getTime()) {
        // if(vdate.getTime() - tdate.getTime() > 0) {
        // if((vdate.getTime() - tdate.getTime())/(1000*3600) > parseInt(params[0])) {
        if((vdate.getTime() - tdate.getTime())/(1000*60) > parseInt(params[0])) {
            return true;
        } else {
            return false;
        }
    });

    var frmvalidator = $(\'#frmadd\').validate({
        ignore:\':hidden\',
        rules: {
            "Data[vRFQ2Code]": {
                remote: {
                    url:SITE_URL+"index.php?file=u-aj_chkdupdata",
                    type:"get",
                    data: {
                        val:function() {
                            return $("#iRFQ2Id").val();
                        },
                        id:function() {
                            return "iRFQ2Id";
                        },
                        field:function() {
                            return "vRFQ2Code";
                        },
                        vRFQ2Code:function() {
                            return $("#vRFQ2Code").val();
                        },
                        table:function() {
                            return PRJ_DB_PREFIX + "_rfq2_master";
                        }
                    }
                }
            },
            "Data[dStartDate]": {
                dategtd: true
            },
            "Data[dEndDate]": {
                // mindate: { param: \'dStartDate\' }
                dategtdt: { param: [\'0\'] },
                mindatetime: { param: [\'dStartDate\',\'0\'] }
            }
        },
        messages: {
            "Data[vRFQ2Code]": { remote: jQuery.validator.format(LBL_RFQ2_CODE_INUSE) },
            "Data[dStartDate]": { dategtd: LBL_START_DATE_LESS_THAN_TODAY },
            "Data[dEndDate]": { mindatetime: LBL_END_DATE_GREATER_THAN_START_DATE, dategtdt: LBL_END_DATE_LESS_THAN_CURRENT_TIME },
            "Data[fAdvanceMinPc]": { decimals: LBL_MUST_BE_NUMERIC },
            "Data[fAdvanceMinAmt]": { decimals: LBL_MUST_BE_NUMERIC, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO },
            "Data[fPriceMaxPc]": { decimals: LBL_MUST_BE_NUMERIC },
            "Data[fPriceMaxAmt]": { decimals: LBL_MUST_BE_NUMERIC, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO }
        }
    });

    function frmsubmit()
    {
        $(\'#iBuyer2Id option[value!=""]\').attr("selected","selected");
        var selected_val = $(\'input:radio[name=eFor]:checked\').val();
        if(selected_val == "Invoice"){
            $(\'#iInvoiceID\').rules(\'add\',\'required\');
            $(\'#iPurchaseOrderID\').rules(\'remove\',\'required\');
            $(\'#iPurchaseOrderID\').removeClass(\'required\');
        }else if(selected_val == "PO"){
            $(\'#iInvoiceID\').rules(\'remove\',\'required\');
            $(\'#iInvoiceID\').removeClass(\'required\');
            $(\'#iPurchaseOrderID\').rules(\'add\',\'required\');
        }
        var eInstantStartChecked = $(\'input[name="Data[eInstantStart]"]:checked\').length > 0;
        if(eInstantStartChecked){
            $(\'#dStartDate\').rules(\'remove\',\'required\');
            $(\'#dStartDate\').removeClass(\'required\');
            $(\'#dEndDate\').rules(\'remove\',\'required\');
            $(\'#dEndDate\').removeClass(\'required\');
        }        
        var vld = $(\'#frmadd\').valid();
        $(document).ready( function() {
            $(function() {
                var ead=100;
                $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
            });
        });
        if(! vld) {
            return false;
        }
        $(\'#frmadd\').submit();
        $(document).ready( function() {
            $(function() {
                var ead=100;
                $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
            });
        });
    }
    function frmreset() {
        $(\'#frmadd\')[0].reset();
        $(\'#invfilter\').val(\'\');
        $(\'#invfilterpo\').val(\'\');
    }

    function setsave() {
        $(\'.save\').removeClass(\'required\');
        // frmvalidator.resetForm();
        var settings = $(\'#frmadd\').validate().settings;
        $.extend(true, settings, {
            rules: {
                "Data[vRFQ2Code]": {
                    remote: {
                        url:SITE_URL+"index.php?file=u-aj_chkdupdata",
                        type:"get",
                        data: {
                            val:function() {
                                return $("#iRFQ2Id").val();
                            },
                            id:function() {
                                return "iRFQ2Id";
                            },
                            field:function() {
                                return "vRFQ2Code";
                            },
                            vRFQ2Code:function() {
                                return $("#vRFQ2Code").val();
                            },
                            table:function() {
                                return PRJ_DB_PREFIX + "_rfq2_master";
                            }
                        }
                    }
                },
                "Data[dStartDate]": {
                    dategtd: true
                },
                "Data[dEndDate]": {
                    // mindate: { param: \'dStartDate\' }
                    dategtdt: { param: [\'0\'] },
                    mindatetime: { param: [\'dStartDate\',\'0\'] }
                }
            }
        });
    }

    function setsubmit() {
        $(\'.save\').addClass(\'required\');
        // frmvalidator.resetForm();
        var settings = $(\'#frmadd\').validate().settings;
        $.extend(true, settings, {
            rules: {
                "Data[vRFQ2Code]": {
                    remote: {
                        url:SITE_URL+"index.php?file=u-aj_chkdupdata",
                        type:"get",
                        data: {
                            val:function() {
                                return $("#iRFQ2Id").val();
                            },
                            id:function() {
                                return "iRFQ2Id";
                            },
                            field:function() {
                                return "vRFQ2Code";
                            },
                            vRFQ2Code:function() {
                                return $("#vRFQ2Code").val();
                            },
                            table:function() {
                                return PRJ_DB_PREFIX + "_rfq2_master";
                            }
                        }
                    }
                },
                "Data[dStartDate]": {
                    dategtd: true
                },
                "Data[dEndDate]": {
                    // mindate: { param: \'dStartDate\' }
                    dategtdt: { param: [\'0\'] },
                    mindatetime: { param: [\'dStartDate\',\'0\'] }
                }
            }
        });
    }

    jQuery(document).ready(function() {
        $("#prdtfilter").bigoFilter("#iProductId", {property: \'text\'});
        $("#b2filter").bigoFilter("#Buyer2Id", {property: \'text\'});
        $("#ib2filter").bigoFilter("#iBuyer2Id", {property: \'text\'});
        if($(\'#iInvoiceID\').length>0) {
            $("#invfilter").bigoFilter("#iInvoiceID", {property: \'text\'});
            $(\'#iInvoiceID\').change(function() {
                $(\'#iProductId option[value!=""]\').remove();
                $(\'#Buyer2Id option[value!=""]\').remove();
                $(\'#iBuyer2Id option[value!=""]\').remove();
                //
                var url = SITE_URL+"index.php?file=u-aj_invrfq2dtls";
                var pars = "&invoiceid="+$(this).val();
                // if(parseInt($(this).val())>0) {
                $(\'.ldri\').show();
                $.ajax({type:"POST", url:url, data:pars, success:function(resp) {
                        $(\'#irfq2dtls_bx\').html(\'\');
                        $(\'#irfq2dtls_bx\').html(resp);
                        $(\'.ldri\').hide();
                        setamtsfpc();
                        setpcfamts();
                        $(\'#heading_title_invoice\').show();
                        $(\'#heading_title_po\').hide();
                        $(\'#irfq2dtls_bx\').show();
                        getDays();                                                
                    }
                });
                // } else {
                //    $(\'.ldri\').hide();
                // }
                // $(\'.ldri\').hide();
            });
        }
        if($(\'#iPurchaseOrderID\').length>0) {
            $("#invfilterpo").bigoFilter("#iPurchaseOrderID", {property: \'text\'});            
            $(\'#iPurchaseOrderID\').change(function() {
                $(\'#iProductId option[value!=""]\').remove();
                $(\'#Buyer2Id option[value!=""]\').remove();
                $(\'#iBuyer2Id option[value!=""]\').remove();
                //
                var url = SITE_URL+"index.php?file=u-aj_invrfq2dtls";
                var pars = "&poid="+$(this).val();
                // if(parseInt($(this).val())>0) {
                $(\'.ldripo\').show();
                $.ajax({type:"POST", url:url, data:pars, success:function(resp) {
                        $(\'#irfq2dtls_bx\').html(\'\');
                        $(\'#irfq2dtls_bx\').html(resp);
                        $(\'.ldripo\').hide();
                        setamtsfpc();
                        setpcfamts();
                        $(\'#heading_title_invoice\').hide();
                        $(\'#heading_title_po\').show();
                        $(\'#irfq2dtls_bx\').show();
                    }
                });
                // } else {
                //    $(\'.ldripo\').hide();
                // }
                // $(\'.ldripo\').hide();
            });
        }

        $("#dStartDate").attr(\'readonly\',\'readonly\');
        $("#dStartDate").datetimepicker({
            dateFormat: \'yy-mm-dd\',
            timeFormat: \'hh:mm:ss\',
            showOn: "both",
            buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
            buttonImageOnly: true,
            onSelect: function(dateText, inst) {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
                });
                getDays();
            },
            onClose: function() {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
                });
            }
        });
        /*jQuery("#dStartDate").dynDateTime({
                showsTime: true,
                ifFormat: "%Y-%m-%d %H:%M:%S",
                daFormat: "%Y-%m-%d %H:%M:%S",
                // daFormat: "%l;%M %p, %e %m, %Y",
                align: "TL",
                electric: false,
                singleClick: false,
      button:".prev()"//,
                // displayArea:".siblings(\'.dtcDisplayArea\')"
        });*/
        $("#dEndDate").attr(\'readonly\',\'readonly\');
        $("#dEndDate").datetimepicker({
            dateFormat: \'yy-mm-dd\',
            timeFormat: \'hh:mm:ss\',
            showOn: "both",
            buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
            buttonImageOnly: true,
            onSelect: function(dateText, inst) {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
                });
                $("#dEndDate").focus();
                $("#dEndDate").blur();
                getDays();
                // $("#dEndDate").trigger(\'blur\');
            },
            onClose: function() {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
                });
                // $("#dEndDate").focus();
                $("#dEndDate").trigger(\'blur\'); 	// blur();
                // $("#frmadd").validate.element(\'#dEndDate\');
            }
        });
        /*jQuery("#dEndDate").dynDateTime({
                showsTime: true,
                ifFormat: "%Y-%m-%d %H:%M:%S",
                daFormat: "%Y-%m-%d %H:%M:%S",
                align: "TL",
                electric: false,
                singleClick: false,
      button:".prev()"
        });*/
    });
    function getDays(){
        var dNetPaymentdate = $(\'#dNetPaymentdate\').val();
        var dEndDate = $(\'#dEndDate\').val();        
        var eRelativeEndTimeChecked = $(\'input[name="Data[eRelativeEndTime]"]:checked\').length > 0;
        var rfq2_startdate = $(\'#dStartDate\').val();
        if(eRelativeEndTimeChecked && rfq2_startdate != ""){
            var rfq2_startdate = $(\'#dStartDate\').val();
            if(rfq2_startdate.indexOf(\' \')!=-1) {
                var v_new_s = rfq2_startdate.split(\' \');
                val_new_s = v_new_s[0];
                tvl_new_s = v_new_s[1].split(\':\');
            }
            var tl_new_s = val_new_s.split(\'-\');
            var tdt_new_s = tl_new_s[2]+\'/\'+tl_new_s[1]+\'/\'+tl_new_s[0];
            tl_new_s[0] = parseInt(tl_new_s[0],10);
            tl_new_s[1] = parseInt(tl_new_s[1],10);
            tl_new_s[2] = parseInt(tl_new_s[2],10);
            tl_new_s[1] = tl_new_s[1] - 1;
            var tdate_new_s = new Date(tl_new_s[0],tl_new_s[1],tl_new_s[2]);            
        }
        
        if(dNetPaymentdate != "" && dEndDate != ""){
            var vl_new = dNetPaymentdate.split(\'-\');
            var vdt_new = vl_new[2]+\'/\'+vl_new[1]+\'/\'+vl_new[0];
            vl_new[0] = parseInt(vl_new[0],10);
            vl_new[1] = parseInt(vl_new[1],10);
            vl_new[2] = parseInt(vl_new[2],10);
            vl_new[1] = vl_new[1] - 1;
            var vdate_new = new Date(vl_new[0],vl_new[1],vl_new[2]);
            //alert(vdate_new.getTime())
                        
            var rfq2_enddate = $(\'#dEndDate\').val();
            if(rfq2_enddate.indexOf(\' \')!=-1) {
                var v_new = rfq2_enddate.split(\' \');
                val_new = v_new[0];
                tvl_new = v_new[1].split(\':\');
            }
            var tl_new = val_new.split(\'-\');
            var tdt_new = tl_new[2]+\'/\'+tl_new[1]+\'/\'+tl_new[0];
            tl_new[0] = parseInt(tl_new[0],10);
            tl_new[1] = parseInt(tl_new[1],10);
            tl_new[2] = parseInt(tl_new[2],10);
            tl_new[1] = tl_new[1] - 1;
            var tdate_new = new Date(tl_new[0],tl_new[1],tl_new[2]);                        
                        
            var idays_val = vdate_new.getTime() - tdate_new.getTime();
            var days_val = idays_val /(1000*60*60*24);
            $(\'#iDays\').val(days_val);
        }
        
        if(eRelativeEndTimeChecked && tdate_new_s.getTime() != "" && dNetPaymentdate != "" && dNetPaymentdate != "0000-00-00" &&  typeof dNetPaymentdate != \'undefined\'){
            var vl_new = dNetPaymentdate.split(\'-\');
            var vdt_new = vl_new[2]+\'/\'+vl_new[1]+\'/\'+vl_new[0];
            vl_new[0] = parseInt(vl_new[0],10);
            vl_new[1] = parseInt(vl_new[1],10);
            vl_new[2] = parseInt(vl_new[2],10);
            vl_new[1] = vl_new[1] - 1;
            var vdate_new = new Date(vl_new[0],vl_new[1],vl_new[2]);
            
            var a = tdate_new_s.getHours() + $(\'#iEndAfterHrs\').val();
            var b = tdate_new_s.getMinutes() + $(\'#iEndAfterMin\').val();            
            
            var end_date_rel =  new Date(tdate_new_s.getFullYear(),tdate_new_s.getMonth(),tdate_new_s.getDate(),a,b);
            var end_date_rel_new =  new Date(end_date_rel.getFullYear(),end_date_rel.getMonth(),end_date_rel.getDate());
            //alert(vdate_new)
            //alert(end_date_rel_new)
            //alert(vdate_new.getTime())
            //alert(end_date_rel_new.getTime())            
            
            var idays_val = vdate_new.getTime() - end_date_rel_new.getTime();
            var days_val = idays_val /(1000*60*60*24);
            //alert(idays_val)
            //alert(days_val)
            $(\'#iDays\').val(days_val);            
        }
    }
</script>
'; ?>


<?php if ($this->_tpl_vars['vldmsg'] != ''):  echo '
<script>
    $(document).ready(function() {
        var vldmsg = \'';  echo $this->_tpl_vars['vldmsg'];  echo '\';
        if(vldmsg!= \'\' && vldmsg != undefined && $(\'#vldms\').attr(\'innerHTML\')!=vldmsg) {
            alert(vldmsg);
            $(\'#vldms\').attr(\'innerHTML\',vldmsg);
        }
    });
</script>
'; ?>


<?php endif;  if ($this->_tpl_vars['mmsg'] != ''):  echo '
<script>
    $(document).ready(function() {
        var mmsg=\'';  echo $this->_tpl_vars['mmsg'];  echo '\';
        if(mmsg!= \'\' && mmsg != undefined)
            alert(mmsg);
    });
</script>
'; ?>

<?php endif; ?>