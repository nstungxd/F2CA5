<?php /* Smarty version 2.6.0, created on 2012-05-31 12:32:06
         compiled from member/user/invoiceviewitems.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'member/user/invoiceviewitems.tpl', 24, false),array('modifier', 'trim', 'member/user/invoiceviewitems.tpl', 27, false),array('modifier', 'stripslashes', 'member/user/invoiceviewitems.tpl', 45, false),array('modifier', 'formatMoney', 'member/user/invoiceviewitems.tpl', 56, false),array('modifier', 'toFixed', 'member/user/invoiceviewitems.tpl', 351, false),array('function', 'assign', 'member/user/invoiceviewitems.tpl', 26, false),)), $this); ?>
<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_INVOICE_ITEM']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceview/<?php echo $this->_tpl_vars['iInvoiceID'];  if ($this->_tpl_vars['msg'] == 'pop'): ?>/pop<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_INV_HEADER']; ?>
</em></a></li>
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invprefview/<?php echo $this->_tpl_vars['iInvoiceID'];  if ($this->_tpl_vars['msg'] == 'pop'): ?>/pop<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</em></a></li>
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceviewitems/<?php echo $this->_tpl_vars['iInvoiceID'];  if ($this->_tpl_vars['msg'] == 'pop'): ?>/pop<?php endif; ?>" class="current"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_LINE_ITEM']; ?>
</em></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div>&nbsp;</div>
                <div id="oldDiv">
                    <?php if ($this->_tpl_vars['msg'] != '' && $this->_tpl_vars['msg'] != 'pop' && $this->_tpl_vars['usertype'] != 'orgadmin'): ?>
                    <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
                    <?php endif; ?>
                    <form name="frmadd" id="frmadd" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-invoiceadditems_a"  method="post">
                        <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="<?php echo $this->_tpl_vars['invid']; ?>
" />
                        <input type="hidden" name="iSupplierOrganizationID" id="iSupplierOrganizationID" value="<?php echo $this->_tpl_vars['curORGID']; ?>
" />
                        <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
                        <input type="hidden" value="0" id="mdiv" />
                        <?php if (count($this->_tpl_vars['invoiceData']) != 0): ?>
                        <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['invoiceData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <?php echo smarty_function_assign(array('var' => 'cnt','value' => $this->_sections['i']['index']+1), $this);?>

                        <?php if (((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) == 'Discount'): ?>
                        <div id="Div<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iInvoiceLineID']; ?>
" name="rctbl">
                            <h2><!--<img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/>--> <?php echo $this->_tpl_vars['LBL_INVOICE_ITEM']; ?>
-<?php echo $this->_tpl_vars['cnt']; ?>
</h2>
                            <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0" bgcolor="#eeefee" >
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="15%"><?php echo $this->_tpl_vars['LBL_LINE_TYPE']; ?>
 : </td>
                                                <td width="15%"><span id="invtype"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType']; ?>
</span></td>
                                                <td width="10%"><?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
 : </td>
                                                <td width="20%" align="left"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['vItemCode']; ?>
</td>
                                                <td width="15%" valign="top"></td>
                                                <td width="15%" valign="top"></td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
 : </td>
                                                <td colspan="5">
                                                    <textarea cols="100" rows="3" style="background-color:#eeefee;" readonly="readonly"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="30px"><?php echo $this->_tpl_vars['LBL_RATE']; ?>
 : </td>
                                                <td width="30px"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                                <td width="30px"><?php echo $this->_tpl_vars['LBL_LINE_TOTAL']; ?>
 : </td>
                                                <td width="30px"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                                <td width="19%"></td>
                                                <td width="19%"></td>
                                                                                            </tr>
                                                                                        <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
                            <div>&nbsp;</div>
                        </div>
                        <?php elseif (((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) == 'Charge'): ?>
                        <div id="Div<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iInvoiceLineID']; ?>
" name="rctbl">
                            <h2><!--<img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/>--> <?php echo $this->_tpl_vars['LBL_INVOICE_ITEM']; ?>
-<?php echo $this->_tpl_vars['cnt']; ?>
</h2>
                            <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0" bgcolor="#eeefee" >
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="15%"><?php echo $this->_tpl_vars['LBL_LINE_TYPE']; ?>
 : </td>
                                                <td width="15%"><span id="invtype"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType']; ?>
</span></td>
                                                <td width="10%"><?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
 : </td>
                                                <td width="20%" align="left"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['vItemCode']; ?>
</td>
                                                <td width="15%" valign="top"></td>
                                                <td width="15%" valign="top"></td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
 : </td>
                                                <td colspan="5">
                                                    <textarea cols="100" rows="3" style="background-color:#eeefee;" readonly="readonly"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="30px"><?php echo $this->_tpl_vars['LBL_RATE']; ?>
 : </td>
                                                <td width="30px"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                                <td width="30px"><?php echo $this->_tpl_vars['LBL_LINE_TOTAL']; ?>
 : </td>
                                                <td width="30px"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                                <td width="19%"></td>
                                                <td width="19%"></td>
                                                                                            </tr>
                                                                                        <tr><td>&nbsp;</td></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
                            <div>&nbsp;</div>
                        </div>
                        <?php else: ?>
                        <div id="Div<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iInvoiceLineID']; ?>
" name="rctbl">
                            <h2><!--<img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/>--> <?php echo $this->_tpl_vars['LBL_INVOICE_ITEM']; ?>
-<?php echo $this->_tpl_vars['cnt']; ?>
</h2>
                            <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0" bgcolor="#eeefee" >
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="17%"><?php echo $this->_tpl_vars['LBL_LINE_TYPE']; ?>
 : </td>
                                                <td width="16%"><span id="invtype"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType']; ?>
</span></td>
                                                <td width="10%"><?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
 : </td>
                                                <td width="10%" align="left"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['vItemCode']; ?>
</td>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="17%" valign="top"><?php echo $this->_tpl_vars['LBL_UNIT_MEASURE']; ?>
 :</td>
                                                <td width="16%" valign="top"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['vUnitOfMeasure']; ?>
</td>
                                                <td width="10%"><?php echo $this->_tpl_vars['LBL_PART_NO']; ?>
 : </td>
                                                <td width="10%" align="left"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['vPartNo']; ?>
</td>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
 : </td>
                                                <td colspan="5">
                                                    <textarea cols="100" rows="3" style="background-color:#eeefee;" readonly="readonly"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="15%"><?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
 : </td>
                                                <td width="15%"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iQuantity']; ?>
</td>
                                                <td width="10%"><?php echo $this->_tpl_vars['LBL_PRICE']; ?>
 : </td>
                                                <td width="20%"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                                <td width="15%"><?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
 : </td>
                                                <td width="15%"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </td>
                                                <td><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fVAT']; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 : </td>
                                                <?php echo smarty_function_assign(array('var' => 'vat','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fVAT']/100)), $this);?>

                                                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['vat'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                                <td><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </td>
                                                <td><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fOtherTax1']; ?>
</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 : </td>
                                                <?php echo smarty_function_assign(array('var' => 'otax','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fOtherTax1']/100)), $this);?>

                                                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['otax'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                                <td><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </td>
                                                <td><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fWithHoldingTax']; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 : </td>
                                                <?php echo smarty_function_assign(array('var' => 'wtax','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fWithHoldingTax']/100)), $this);?>

                                                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['wtax'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->_tpl_vars['LBL_LINE_TOTAL']; ?>
 : </td>
                                                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</td>
                                                <td><?php echo $this->_tpl_vars['LBL_RECEIPT']; ?>
 : </td>
                                                <td><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['tReceipt']; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
 : </td>
                                                <td><?php echo $this->_tpl_vars['invdtls'][0]['vCurrency']; ?>
</td>
                                            </tr>
                                            <?php if (((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eSublineType'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
                                            <tr><td colspan="3">&nbsp;</td></tr>
                                            <tr>
                                                <td colspan="2"><span><b><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eSublineType']; ?>
:-</b></span></td>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
 : </span></td>
                                                <td><?php if ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eSublineType'] == ''): ?>0<?php else:  echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iSubQuantity'];  endif; ?></td>
                                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_RATE']; ?>
 : </span></td>
                                                <td><?php if ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eSublineType'] == ''): ?>0<?php else:  echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubRate'];  endif; ?></td>
                                                <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="<?php if ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eSublineType'] == ''): ?>0<?php else:  echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubAmount'];  endif; ?>" /></td>
                                            </tr>
                                            <?php endif; ?>
                                            <tr><td>&nbsp;</td></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
                            <div>&nbsp;</div>
                        </div>
                        <?php endif; ?>
                        <?php endfor; else: ?>
                        <div><?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>
</div>
                        <?php endif; ?>
                        <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0">
                            <tr>
                                <td colspan="6" id="lines" valign="top">
                                    <div><b><hr style="height:0px; color:#eeeeee;"/><?php echo $this->_tpl_vars['LBL_LINE_ITEMS']; ?>
<hr style="height:0px; color:#eeeeee;" /></b></div>
                                    <div style="height:190px; overflow-y:scroll;">
                                        <b>
                                            <span style="display:inline-block; height:10px; width:6px; padding:1px; margin:0px;">&nbsp;</span>
                                            <!--<span style="display:inline-block; height:10px; width:50px; padding:1px; margin:0px;"><?php echo $this->_tpl_vars['LBL_LINE_TYPE']; ?>
</span>-->
                                            <span style="display:inline-block; height:10px; width:100px; padding:1px; margin:0px;"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
</span>
                                            <span style="display:inline-block; height:10px; width:60px; padding:1px; margin:0px;"><?php echo $this->_tpl_vars['LBL_PART_NO']; ?>
</span>
                                            <span style="display:inline-block; height:10px; width:70px; padding:1px; margin:0px;">UOM</span>
                                            <span style="display:inline-block; height:10px; width:45px; padding:1px; margin:0px; text-align:right;">Qty</span>
                                            <span style="display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_PRICE']; ?>
 / <?php echo $this->_tpl_vars['LBL_RATE']; ?>
</span>
                                            <span style="display:inline-block; height:10px; width:120px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
</span>
                                            <span style="display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_VAT']; ?>
</span>
                                            <!--<span style="display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
</span>-->
                                            <span style="display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;">WH <?php echo $this->_tpl_vars['LBL_TAX']; ?>
</span>
                                            <span style="display:inline-block; height:10px; width:155px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_LINE_TOTAL']; ?>
</span>
                                            <span style="display:inline-block; height:10px; padding:1px; margin:0px;">&nbsp;</span>
                                        </b>
                                        <div id="dlines">
                                            <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['invoiceData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                            <?php if (((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) == 'Discount'): ?>
                                            <div id="spnd<?php echo $this->_sections['i']['index']; ?>
">
                                                <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/arrow-orange.gif' /></span>
                                                <span style='display:none; height:10px; width:50px; padding:1px; margin:0px;display: none;' class="ot"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:100px; padding:1px; margin:0px;' class="td"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['tDescription']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;'><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['vPartNo']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um"></span>
                                                <span style='display:inline-block; height:10px; width:45px; padding:1px; margin:0px; text-align:right;' class="iq"></span>
                                                <span style='display:inline-block; height:10px; width:90px; padding:1px; margin:0px; text-align:right;' class="fp"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
%</span>
                                                <span style='display:inline-block; height:10px; width:110px; padding:1px; margin:0px; text-align:right;' class="fa"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="fv"><?php echo smarty_function_assign(array('var' => 'vt','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fVAT']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['vt'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox"><?php echo smarty_function_assign(array('var' => 'ot','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fOtherTax1']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['ot'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="wt"><?php echo smarty_function_assign(array('var' => 'wt','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fWithHoldingTax']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['wt'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; width:155px; padding:1px; margin:0px; text-align:right;' class="lt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; padding:1px;  padding-left:10px; margin:0px; text-align:right;' class="at">
                                                    &nbsp; <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-edit.gif' onclick='shwtbl(<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iInvoiceLineID']; ?>
);' style="cursor:pointer;"/>
                                                </span>
                                            </div>
                                            <?php elseif (((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) == 'Charge'): ?>
                                            <div id="spnd<?php echo $this->_sections['i']['index']; ?>
">
                                                <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/arrow-orange.gif' /></span>
                                                <span style='display:none; height:10px; width:50px; padding:1px; margin:0px;' class="ot"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:100px; padding:1px; margin:0px;' class="td"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['tDescription']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;'><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['vPartNo']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um"></span>
                                                <span style='display:inline-block; height:10px; width:45px; padding:1px; margin:0px; text-align:right;' class="iq"></span>
                                                <span style='display:inline-block; height:10px; width:90px; padding:1px; margin:0px; text-align:right;' class="fp"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
%</span>
                                                <span style='display:inline-block; height:10px; width:110px; padding:1px; margin:0px; text-align:right;' class="fa"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="fv"><?php echo smarty_function_assign(array('var' => 'vt','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fVAT']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['vt'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox"><?php echo smarty_function_assign(array('var' => 'ot','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fOtherTax1']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['ot'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="wt"><?php echo smarty_function_assign(array('var' => 'wt','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fWithHoldingTax']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['wt'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; width:155px; padding:1px; margin:0px; text-align:right;' class="lt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                                <span style='display:inline-block; height:10px; padding:1px;  padding-left:10px; margin:0px; text-align:right;' class="at">
                                                    &nbsp; <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-edit.gif' onclick='shwtbl(<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iInvoiceLineID']; ?>
);' style="cursor:pointer;"/>
                                                </span>
                                            </div>
                                            <?php else: ?>
                                            <div id="spnd<?php echo $this->_sections['i']['index']; ?>
">
                                                <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/arrow-orange.gif' /></span>
                                                <span style='display:none; height:10px; width:50px; padding:1px; margin:0px;' class="ot"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eInvoiceType']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:100px; padding:1px; margin:0px;' class="td"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['tDescription']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;'><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['vPartNo']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['vUnitOfMeasure']; ?>
</span>
                                                <span style='display:inline-block; height:10px; width:45px; padding:1px; margin:0px; text-align:right;' class="iq"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iQuantity'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, false) : formatMoney($_tmp, false)); ?>
 <input type="hidden" name="iQuantity<?php echo $this->_sections['i']['index']; ?>
" id="iQuantity<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iQuantity']; ?>
" /> </span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="fp"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
 <input type="hidden" name="fPrice<?php echo $this->_sections['i']['index']; ?>
" id="fPrice<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fPrice']; ?>
" /> </span>
                                                <span style='display:inline-block; height:10px; width:120px; padding:1px; margin:0px; text-align:right;' class="fa"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
 <input type="hidden" name="fAmount<?php echo $this->_sections['i']['index']; ?>
" id="fAmount<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']; ?>
" /> </span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="fv"><?php echo smarty_function_assign(array('var' => 'vt','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fVAT']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['vt'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
 <input type="hidden" name="fVAT<?php echo $this->_sections['i']['index']; ?>
" id="fVAT<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fVAT']; ?>
" /> </span>
                                                <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox"><?php echo smarty_function_assign(array('var' => 'ot','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fOtherTax1']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['ot'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
 <input type="hidden" name="fOtherTax1<?php echo $this->_sections['i']['index']; ?>
" id="fOtherTax1<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fOtherTax1']; ?>
" /> </span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="wt"><?php echo smarty_function_assign(array('var' => 'wt','value' => ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fWithHoldingTax']*$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['wt'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
 <input type="hidden" name="fWithHoldingTax<?php echo $this->_sections['i']['index']; ?>
" id="fWithHoldingTax<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fWithHoldingTax']; ?>
" /> </span>
                                                <span style='display:inline-block; height:10px; width:155px; padding:1px; margin:0px; text-align:right;' class="lt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
 <input type="hidden" name="fLineTotal<?php echo $this->_sections['i']['index']; ?>
" id="fLineTotal<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fLineTotal']; ?>
" /> </span>
                                                <span style='display:inline-block; height:10px; padding:1px;  padding-left:10px; margin:0px; text-align:right;' class="at">
                                                    &nbsp; <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-edit.gif' onclick='shwtbl(<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iInvoiceLineID']; ?>
);' style="cursor:pointer;"/>
                                                </span>
                                                <div class="subli" style="display:<?php if ($this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eSublineType'] != 'Discount' && $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eSublineType'] != 'Charge'): ?>none<?php endif; ?>; padding-left:10px;">
                                                    <!---->
													<span style='display:inline-block; height:10px; margin:0px; padding:0px;' class='ar'></span>
                                                    <span style='display:inline-block; height:10px; width:151px; margin:0px; text-align:left;' class="sltyp"><?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eSublineType']; ?>
</span> <input type="hidden" name="eSublineType<?php echo $this->_sections['i']['index']; ?>
" id="eSublineType<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['eSublineType']; ?>
" />
                                                    <span class="slqt" style="display:inline-block; height:10px; width:135px; margin:0px; text-align:right;"><span class="sqt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iSubQuantity'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, false) : formatMoney($_tmp, false)); ?>
</span> <input type="hidden" name="iSubQuantity<?php echo $this->_sections['i']['index']; ?>
" id="iSubQuantity<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['iSubQuantity']; ?>
" /> </span> &nbsp;&nbsp;&nbsp;
                                                    <span class="slrt" style="display:inline-block; height:10px; width:81px; margin:0px; text-align:right;"><span class="srt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubRate'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
%</span> <input type="hidden" name="fSubRate<?php echo $this->_sections['i']['index']; ?>
" id="fSubRate<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubRate']; ?>
" /> </span> &nbsp;&nbsp;&nbsp;
                                                    <!---->
                                                    <span class="sltl" style="display:inline-block; height:10px; width:99px; margin:0px; text-align:right;"><span class="stl"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span> <input type="hidden" name="fSubAmount<?php echo $this->_sections['i']['index']; ?>
" id="fSubAmount<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubAmount']; ?>
" /> </span>
                                                    <span class="slvt" style="display:inline-block; height:10px; width:82px; margin:0px; text-align:right;"><span class="slv"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubVat'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span></span>
                                                    <span class="slot" style="display:inline-block; height:10px; width:50px; margin:0px; text-align:right;display:none;"><span class="slo"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubOtherTax'])) ? $this->_run_mod_handler('toFixed', true, $_tmp, true) : toFixed($_tmp, true)); ?>
</span></span>
                                                    <span class="slwt" style="display:inline-block; height:10px; width:82px; margin:0px; text-align:right;"><span class="slw"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubWHTax'])) ? $this->_run_mod_handler('toFixed', true, $_tmp, true) : toFixed($_tmp, true)); ?>
</span></span>
                                                    <span class="sltt" style="display:inline-block; height:10px; width:157px; margin:0px; text-align:right;"><span class="slf"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData'][$this->_sections['i']['index']]['fSubTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span></span>
                                                    <!---->
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div>&nbsp;</div>
                                            <?php endfor; else: ?>
                                            <div id="nli" align="center"><br /><b><?php echo $this->_tpl_vars['LBL_NO_LINE_ITEMS']; ?>
</b></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr><td colspan="6"><hr style="height:0px; color:#eeeeee;" />&nbsp;</td></tr>

                            <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b><?php echo $this->_tpl_vars['LBL_SUB_TOTAL']; ?>
</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="subt" style="display:inline-block;width:21%;">0</span><input type="hidden" name="subtotal" id="subtotal" /></td></tr>
                            <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b><?php echo $this->_tpl_vars['LBL_VAT']; ?>
</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="vatt" style="display:inline-block;width:21%;">0</span><input type="hidden" name="vattotal" id="vattotal" /></td></tr>
                            <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="otht" style="display:inline-block;width:21%;">0</span><input type="hidden" name="othertaxtotal" id="othertaxtotal" /></td></tr>
                            <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="wtht" style="display:inline-block;width:21%;">0</span><input type="hidden" name="whtaxtotal" id="whtaxtotal" /></td></tr>
                            <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b><?php echo $this->_tpl_vars['LBL_CHARGE']; ?>
</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="chgt" style="display:inline-block;width:21%;">0</span><input type="hidden" name="charge" id="charge" /></td></tr>
							<tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b><?php echo $this->_tpl_vars['LBL_DISCOUNT']; ?>
</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="dist" style="display:inline-block;width:21%;">0</span><input type="hidden" name="discount" id="discount" /></td></tr>
                            <tr><td colspan="6" align="right" style="padding-right:19px; width:90%; border-top:1px solid #9a9a9a;"><span style="display:inline-block;width:70%;"><b><?php echo $this->_tpl_vars['LBL_NET_AMOUNT']; ?>
</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="namt" style="display:inline-block;width:21%;font-weight:bold;">0</span><input type="hidden" name="nettotal" id="nettotal" /></td></tr>
                            <tr><td colspan="6"><hr style="height:0px; color:#eeeeee;" />&nbsp;</td></tr>
                            <?php else: ?>
                            <div id="nli" align="center"><br /><b><?php echo $this->_tpl_vars['LBL_NO_LINE_ITEMS']; ?>
</b></div>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['view'] != 'edit' && $this->_tpl_vars['usertype'] != 'orgadmin'): ?>
                            <tr>
                                <td valign="bottom"></td>
                                <td>&nbsp;</td>
                                <td valign="bottom" align="center" colspan="2">
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" />
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </form>
                </div>
                <span style="display:block;text-align:center;height:30px;">
                    <?php if ($this->_tpl_vars['view'] != 'edit' && $this->_tpl_vars['usertype'] != 'orgadmin'): ?> <?php elseif ($this->_tpl_vars['msg'] != 'pop'): ?>
                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" />
                    <?php endif; ?>
                </span>
            </div>
            <div>&nbsp;</div>
        </div>
    </div>
</div>
<span id="spn" style="display:hidden;"></span>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_CONTENT_JS']; ?>
money_format.js"></script>
<?php echo '
<script type="text/javascript">
    $(document).ready(function() {
        $(".plusminus-img").click( function() {
            $(this).parent().parent(\'div\').children(\'table\').toggle();
            if($(this).attr(\'src\') == SITE_IMAGES+\'sm_images/minus-icon.gif\') {
                $(this).attr(\'src\',SITE_IMAGES+\'sm_images/plus-icon.gif\');
            } else {
                $(this).attr(\'src\',SITE_IMAGES+\'sm_images/minus-icon.gif\');
            }

        });
    });


    $(\'div [name="rctbl"]\').hide();
    function shwtbl(vl) {
        $(\'div [name="rctbl"]\').hide();
        $(\'#Div\'+vl).show();
        $(function() {
            var ead=10;
            $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
        });
    }

    function setsublines()
    {
        if($(\'div[id^="spnd"] > .subli\').length > 0) {
            $.each($(\'div[id^="spnd"] > .subli\'),function(i,el) {
                var idx = $(this).parent().attr(\'id\').replace(\'spnd\',\'\');
                //
                pr = false;
                if($(\'#spnd\'+idx+\' > .subli\').length > 0) {
                    pr = $(\'#spnd\'+idx+\' > .subli\');
                    if($(\'.sqt\',pr).length > 0) {
                        $(\'.sqt\',pr).attr(\'innerHTML\', money_format(\'%i\',$(\'#iSubQuantity\'+idx).val(),\'no\'));
                        // alert($(\'.srt\',pr).length);
                    }
                    if($.trim($(\'#fSubRate\'+idx).val()) != \'\' && !isNaN(parseInt($(\'#fSubRate\'+idx).val(), 10))) {
                        var subtype = $.trim($(\'#eSublineType\'+idx).val().toLowerCase());
                        // alert(subtype);
                        if(subtype != \'\') {
                            // alert(idx);
                            var subquantity = parseFloat($.trim($(\'#iSubQuantity\'+idx).val()), 10);
                            var linetotal = parseFloat($.trim($(\'#fLineTotal\'+idx).val()), 10);
                            var subrate = parseFloat($.trim($(\'#fSubRate\'+idx).val()), 10);
                            var quantity = parseFloat($.trim($(\'#iQuantity\'+idx).val()), 10);
                            var price = parseFloat($.trim($(\'#fPrice\'+idx).val()), 10);
                            var vat = parseFloat($.trim($(\'#fVAT\'+idx).val()), 10);
                            var otax = parseFloat($.trim($(\'#fOtherTax1\'+idx).val()), 10);
                            var whtax = parseFloat($.trim($(\'#fWithHoldingTax\'+idx).val()), 10);
                            var qno = (subquantity > quantity)? quantity : subquantity;
                            var sum = (qno * price);
                            var amt = sum;
                            // alert(subtype);
                            if(subtype == \'charge\') {
                                var amt1 = (sum * subrate / 100);
                                amt = amt1 + ((sum * vat / 100) * subrate / 100) + ((sum * otax / 100) * subrate / 100) - ((sum * whtax / 100) * subrate / 100);
                            } else {
                                var amt1 = (-(sum * subrate / 100));
                                amt = amt1 - ((sum * vat / 100) * subrate / 100) - ((sum * otax / 100) * subrate / 100) + ((sum * whtax / 100) * subrate / 100);
                            }
                            // amt = amt + ramt;
                            // amt = parseFloat(amt,10).toFixed(2);
                            if(!isNaN(amt1) && amt1.toString() != \'NaN\') {
                                if(pr){
                                    $(\'.stl\', pr).attr(\'innerHTML\', money_format(\'%i\',(Math.abs(amt1))));
                                }
                            }
                            if(!isNaN(amt) && amt.toString() != \'NaN\') {
                                $(\'#fSubAmount\'+idx).val(amt);
                                if(pr){
                                    $(\'.slf\',pr).attr(\'innerHTML\', money_format(\'%i\',(Math.abs(amt))));
                                }
                            }
                            $(\'.slv\',pr).attr(\'innerHTML\', money_format(\'%i\',((sum * vat / 100) * subrate / 100)));
                            $(\'.slo\',pr).attr(\'innerHTML\', (parseFloat((sum * otax / 100) * subrate / 100)).toFixed(2));
                            $(\'.slw\',pr).attr(\'innerHTML\', (parseFloat((sum * whtax / 100) * subrate / 100)).toFixed(2));
                        }
                    }
                }
                //
            });
        }
    }
    setsublines();

    function settotal()
    {
        var subt = 0;
        var dist = 0;
        var chgt = 0;
        var vatt = 0;
        var otht = 0;
        var wtht = 0;
        var namt = 0;
        //
        if($(\'#dlines > div[id^="spnd"]\').length < 1) {
            $(\'#subt\').attr(\'innerHTML\', 0);
            $(\'#dist\').attr(\'innerHTML\', 0);
            $(\'#chgt\').attr(\'innerHTML\', 0);
            $(\'#vatt\').attr(\'innerHTML\', 0);
            $(\'#otht\').attr(\'innerHTML\', 0);
            $(\'#wtht\').attr(\'innerHTML\', 0);
            $(\'#namt\').attr(\'innerHTML\', 0);
            //
            $(\'#subtotal\').val(0);
            $(\'#discount\').val(0);
            $(\'#charge\').val(0);
            $(\'#vattotal\').val(0);
            $(\'#othertaxtotal\').val(0);
            $(\'#whtaxtotal\').val(0);
            $(\'#nettotal\').val(0);
        }
        // $(\'div[id*="Div"]\').find(\'[name="fSubRate\\[\\]"]\').trigger(\'blur\');
        $.each($(\'#dlines > div[id^="spnd"]\'), function(i, el)
        {
            setsublines($(this).attr(\'id\').replace(\'spnd\',\'\'));
            if($.trim($(this).find(\'.ot\').attr(\'innerHTML\').toLowerCase()) == \'discount\') {
                // dist = dist + parseFloat($(this).find(\'.fa\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'));
                // namt = namt - parseFloat($(this).find(\'.fa\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'));
                dist = dist + parseFloat($(this).find(\'.lt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'), 10);
                if(!isNaN(parseFloat($(this).find(\'.lt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\')))) {
                    namt = namt - parseFloat($(this).find(\'.lt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'), 10);
                }
				//
				var slv = parseFloat($(\'.fv\', $(this)).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
				if(!isNaN(slv)) {
					vatt = vatt - slv;
				}
				var slo = parseFloat($(\'.ox\', $(this)).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
				if(!isNaN(slo)) {
					otht = otht - slo;
				}
				var slw = parseFloat($(\'.wt\', $(this)).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
				if(!isNaN(slw)) {
					wtht = wtht - slw;
				}
            } else if($.trim($(this).find(\'.ot\').attr(\'innerHTML\').toLowerCase()) == \'charge\') {
                // chgt = chgt + parseFloat($(this).find(\'.fa\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'));
                chgt = chgt + parseFloat($(this).find(\'.lt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'), 10);
                /*if(!isNaN(parseFloat($(this).find(\'.fv\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\')))) {
                                vatt = vatt + parseFloat($(this).find(\'.fv\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'));
                        }
                        if(!isNaN(parseFloat($(this).find(\'.ox\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\')))) {
                                otht = otht + parseFloat($(this).find(\'.ox\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'));
                        }
                        if(!isNaN(parseFloat($(this).find(\'.wt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\')))) {
                                wtht = wtht + parseFloat($(this).find(\'.wt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'));
                        }*/
                if(!isNaN(parseFloat($(this).find(\'.lt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\')))) {
                    namt = namt + parseFloat($(this).find(\'.lt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'), 10);
                }
				//
				var slv = parseFloat($(\'.fv\', $(this)).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
				if(!isNaN(slv)) {
					vatt = vatt + slv;
				}
				var slo = parseFloat($(\'.ox\', $(this)).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
				if(!isNaN(slo)) {
					otht = otht + slo;
				}
				var slw = parseFloat($(\'.wt\', $(this)).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
				if(!isNaN(slw)) {
					wtht = wtht + slw;
				}
            } else {
                subt = subt + parseFloat($(this).find(\'.fa\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'));
                if(!isNaN(parseFloat($(this).find(\'.fv\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\')))) {
                    vatt = vatt + parseFloat($(this).find(\'.fv\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'), 10);
                }
                if(!isNaN(parseFloat($(this).find(\'.ox\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\')))) {
                    otht = otht + parseFloat($(this).find(\'.ox\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'), 10);
                }
                if(!isNaN(parseFloat($(this).find(\'.wt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\')))) {
                    wtht = wtht + parseFloat($(this).find(\'.wt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'), 10);
                }
                if(!isNaN(parseFloat($(this).find(\'.lt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\')))) {
                    namt = namt + parseFloat($(this).find(\'.lt\').attr(\'innerHTML\').replace(new RegExp(\',\', \'g\'),\'\'), 10);
                }
                var subli = $(\'.subli\', $(this));
                if(subli.length > 0) {
                    var sltl = parseFloat($(\'.stl\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                    if($(\'.slf\', subli).length > 0) {
                        var slf = parseFloat($(\'.slf\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                    }
                    if($(\'.sltyp\', subli).length > 0) {
                        var sltyp = $(\'.sltyp\', subli).html().replace(new RegExp(\'-\', \'g\'),\'\').toLowerCase();
						var sltyp_ary = sltyp.split(\' \');
						sltyp = sltyp_ary[0];
                    }
                    if($.trim(sltyp.toLowerCase()) == \'discount :\' || $.trim(sltyp.toLowerCase()) == \'discount:\' || $.trim(sltyp.toLowerCase()) == \'discount\') {
                        dist = dist + Math.abs(sltl);
                        var slv = parseFloat($(\'.slv\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                        if(!isNaN(slv)) {
                            vatt = vatt - slv;
                        }
                        var slo = parseFloat($(\'.slo\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                        if(!isNaN(slo)) {
                            otht = otht - slo;
                        }
                        var slw = parseFloat($(\'.slw\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                        if(!isNaN(slw)) {
                            wtht = wtht - slw;
                        }
                        namt = namt - slf;
                    } else if($.trim(sltyp.toLowerCase()) == \'charge :\' || $.trim(sltyp.toLowerCase()) == \'charge:\' || $.trim(sltyp.toLowerCase()) == \'charge\') {
                        chgt = chgt + Math.abs(sltl);
                        var slv = parseFloat($(\'.slv\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                        if(!isNaN(slv)) {
                            vatt = vatt + slv;
                        }
                        var slo = parseFloat($(\'.slo\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                        if(!isNaN(slo)) {
                            otht = otht + slo;
                        }
                        var slw = parseFloat($(\'.slw\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                        if(!isNaN(slw)) {
                            wtht = wtht + slw;
                        }
                        namt = namt + slf;
                    }
                    if(!isNaN(sltl)) {
                        // subt = subt + sltl;
                        // subt = subt + sltl;
                        // namt = namt + sltl;
                    }
                    if(!isNaN(slf)) {
                        // namt = namt + slf;
                    }
                }
            }
            //
            $(\'#subt\').attr(\'innerHTML\', $.trim(money_format(\'%i\',subt).replace("USD","")));
            $(\'#dist\').attr(\'innerHTML\', $.trim(money_format(\'%i\',dist).replace("USD","")));
            $(\'#chgt\').attr(\'innerHTML\', $.trim(money_format(\'%i\',chgt).replace("USD","")));
            $(\'#vatt\').attr(\'innerHTML\', $.trim(money_format(\'%i\',vatt).replace("USD","")));
            $(\'#otht\').attr(\'innerHTML\', $.trim(money_format(\'%i\',otht).replace("USD","")));
            $(\'#wtht\').attr(\'innerHTML\', $.trim(money_format(\'%i\',wtht).replace("USD","")));
            $(\'#namt\').attr(\'innerHTML\', $.trim(money_format(\'%i\',namt).replace("USD","")));
            //
            $(\'#subtotal\').val(subt);
            $(\'#discount\').val(dist);
            $(\'#charge\').val(chgt);
            $(\'#vattotal\').val(vatt);
            $(\'#othertaxtotal\').val(otht);
            $(\'#whtaxtotal\').val(wtht);
            $(\'#nettotal\').val(namt);
            //
            // setsublines($(this).attr(\'id\').replace(\'spnd\',\'\'));
            // $(\'#iSubQuantity\'+idx).trigger(\'blur\');
            //
        });
    }
    settotal();
</script>
'; ?>
