<?php /* Smarty version 2.6.0, created on 2015-06-22 13:06:24
         compiled from member/user/invoiceadditems.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'member/user/invoiceadditems.tpl', 80, false),array('modifier', 'formatMoney', 'member/user/invoiceadditems.tpl', 99, false),array('modifier', 'toFixed', 'member/user/invoiceadditems.tpl', 595, false),array('modifier', 'number_format', 'member/user/invoiceadditems.tpl', 600, false),array('modifier', 'is_array', 'member/user/invoiceadditems.tpl', 716, false),array('modifier', 'count', 'member/user/invoiceadditems.tpl', 716, false),array('function', 'assign', 'member/user/invoiceadditems.tpl', 105, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="<?php echo $this->_tpl_vars['SITE_CSS']; ?>
jquery.autocomplete.css" />
<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_CREATE_INVOICE_ITEM']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicecreate/<?php echo $this->_tpl_vars['invid']; ?>
"><em><?php echo $this->_tpl_vars['LBL_CREATE_INVOICE']; ?>
</em></a></li>
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invpref/<?php echo $this->_tpl_vars['invid']; ?>
"><em><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</em></a></li>
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceadditems/<?php echo $this->_tpl_vars['invid']; ?>
" class="current"><em><?php echo $this->_tpl_vars['LBL_ADD_ITEM']; ?>
</em></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg" style="height:910px;">
                <div>&nbsp;</div>
                <div id="oldv">
                    <?php if ($this->_tpl_vars['msg'] != ''): ?>
                                                            <?php endif; ?>
                    <form name="frmadd" id="frmadd" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-invoiceadditems_a"  method="post">
                        <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="<?php echo $this->_tpl_vars['invid']; ?>
" />
                        <input type="hidden" name="iSupplierOrganizationID" id="iSupplierOrganizationID" value="<?php echo $this->_tpl_vars['curORGID']; ?>
" />
                        <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
                        <input type="hidden" name="eSaved" id="eSaved" value="<?php echo $this->_tpl_vars['invdtls'][0]['eSaved']; ?>
" />
                        <input type="hidden" value="0" id="mdiv" />
                        <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0">
                            <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['invitems']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <tr>
                                <td>
                                    <div id="Div<?php echo $this->_sections['i']['index']; ?>
">
                                        <table id="tbl<?php echo $this->_sections['i']['index']; ?>
" width="100%" border="0" cellspacing="5" cellpadding="0">
                                                                                        <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType'] == 'Discount'): ?>
                                            <tr>
                                                <td width="108"><?php echo $this->_tpl_vars['LBL_LINE_TYPE']; ?>
 : &nbsp;<font class="reqmsg">*</font></td>
                                                <td width="319">
                                                    <span id="invtype">                                                        <select name="invoiceType[]" id="eInvoiceType<?php echo $this->_sections['i']['index']; ?>
" class="required" >
                                                            <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['invoiceTypes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                            <option value="<?php echo $this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']]; ?>
" <?php if ($this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']] == $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']]; ?>
</option>
                                                            <?php endfor; endif; ?>
                                                        </select>
                                                    </span>
                                                </td>
                                                <!--<td width="122"><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
 : &nbsp;</td>
                                                <td>
                                                    <b><?php echo $this->_tpl_vars['invdtls'][0]['vCurrency']; ?>
</b>
                                                    <input type="hidden" name="itemCode[]" id="vItemCode<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vItemCode']; ?>
" readonly="readonly" />
                                                </td>-->
                                                <td width="122"><?php echo $this->_tpl_vars['LBL_PART_NO']; ?>
 : </td>
                                                <td>
                                                    <b><?php echo $this->_tpl_vars['invdtls'][0]['vPartNo']; ?>
</b>
                                                    <input type="text" name="vPartNo[]" id="vPartNo<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PART_NO']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vPartNo']; ?>
" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
 : </td>
                                                <td><textarea name="tDescription[]" id="tDescription<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:188px; height: 73px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                                <td valign="top"><span class="ndcf"><?php echo $this->_tpl_vars['LBL_UNIT_MEASURE']; ?>
 :&nbsp;<font class="reqmsg"></font></span></td>
                                                <td valign="top" class="uoms">
                                                                                                        <select name="vUnitOfMeasure[]" id="vUnitOfMeasure<?php echo $this->_sections['i']['index']; ?>
" class="" style="width:190px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_UNIT_MEASURE']; ?>
">
                                                                                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['uom']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                        <option value="<?php echo $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']; ?>
" <?php if ($this->_tpl_vars['poitems'][$this->_sections['i']['index']]['vUnitOfMeasure'] == $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']; ?>
</option>
                                                        <?php endfor; endif; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <table width="100%" border="0">
                                                        <tr>
                                                            <td style="display:none;"><span class="ndcf"><?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                                            <td style="display:none;"><input type="text" name="iQuantity[]" id="iQuantity<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required digits" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iQuantity']; ?>
" /></td>
                                                            <td width="12.5%"><span class="dcr"><?php echo $this->_tpl_vars['LBL_RATE']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                                            <td width="149"><input type="text" name="fPrice[]" id="fPrice<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PRICE']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" /></td>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                                            <td><input type="text" name="fAmount[]" id="fAmount<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly="readonly" /></td>
                                                        </tr>
                                                        <tr>
                                                            <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iInvoiceLineID'] < 1): ?>
                                                            <?php echo smarty_function_assign(array('var' => 'fVAT','value' => $this->_tpl_vars['cntrydt'][0]['fVat']), $this);?>

                                                            <?php echo smarty_function_assign(array('var' => 'fOtherTax','value' => $this->_tpl_vars['cntrydt'][0]['fOtherTax']), $this);?>

                                                            <?php echo smarty_function_assign(array('var' => 'fWithHoldingTax','value' => $this->_tpl_vars['cntrydt'][0]['fwhTax']), $this);?>

                                                            <?php else: ?>
                                                            <?php echo smarty_function_assign(array('var' => 'fVAT','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fVAT']), $this);?>

                                                            <?php echo smarty_function_assign(array('var' => 'fOtherTax','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fOtherTax1']), $this);?>

                                                            <?php echo smarty_function_assign(array('var' => 'fWithHoldingTax','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fWithHoldingTax']), $this);?>

                                                            <?php endif; ?>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): &nbsp;<font class="reqmsg">*</font></span></td>
                                                            <td><input type="text" name="fVAT[]" id="fVAT<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_VAT']; ?>
" value="<?php echo $this->_tpl_vars['fVAT']; ?>
" /></td>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                                            <?php echo smarty_function_assign(array('var' => 'vat','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fVAT']/100)), $this);?>

                                                            <td><input type="text" name="vat[]" id="vat<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_VAT']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['vat'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly='readonly' /></td>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </span></td>
                                                            <td><input type="text" name="fOtherTax1[]" id="fOtherTax1<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo $this->_tpl_vars['fOtherTax']; ?>
" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 : </span></td>
                                                            <?php echo smarty_function_assign(array('var' => 'otax','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fOtherTax']/100)), $this);?>

                                                            <td><input type="text" name="othertax1[]" id="othertax1<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['otax'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly='readonly' /></td>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </span></td>
                                                            <td><input type="text" name="fWithHoldingTax[]" id="fWithHoldingTax<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fWithHoldingTax']; ?>
" /></td>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 : </span></td>
                                                            <?php echo smarty_function_assign(array('var' => 'wtax','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fWithHoldingTax']/100)), $this);?>

                                                            <td><input type="text" name="withholdingtax" id="withholdingtax<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['wtax'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly='readonly' /></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_LINE_TOTAL']; ?>
 : </span></td>
                                                            <td><input type="text" name="fLineTotal[]" id="fLineTotal<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly="readonly" /></td>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_RECEIPT']; ?>
 : </span></td>
                                                            <td><input type="text" name="tReceipt[]" id="tReceipt<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tReceipt']; ?>
" /></td>
                                                            <td><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
 : &nbsp;</td>
                                                            <td>
                                                                <b><?php echo $this->_tpl_vars['invdtls'][$this->_sections['i']['index']]['vCurrency']; ?>
</b>
                                                                <input type="hidden" name="itemCode[]" id="vItemCode<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vItemCode']; ?>
" readonly="readonly" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6" align='right'>
                                                                <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('<?php echo $this->_sections['i']['index']; ?>
')" />                                                            </td>
                                                        </tr>
                                                        <tr><td colspan="3">&nbsp;</td></tr>
                                                        <tr>
                                                            <td colspan="2"><span class="ndcf"><b><?php echo $this->_tpl_vars['LBL_DISCOUNT']; ?>
 / <?php echo $this->_tpl_vars['LBL_CHARGE']; ?>
 :- </b> &nbsp; <select id="eSublineType<?php echo $this->_sections['i']['index']; ?>
" name="eSublineType[]"><option value="">None</option><option value="Discount" <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] == 'Discount'): ?>selected="selected"<?php endif; ?> >Discount</option><option value="Charge" <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] == 'Charge'): ?>selected="selected"<?php endif; ?>>Charge</option></select></span></td>
                                                            <td colspan="4">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
 : </span></td>
                                                            <td><input type="text" name="iSubQuantity[]" id="iSubQuantity<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="0" /></td>
                                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_RATE']; ?>
 : </span></td>
                                                            <td><input type="text" name="fSubRate[]" id="fSubRate<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="0" /></td>
                                                            <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="0" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6" align='right'>
                                                                <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('<?php echo $this->_sections['i']['index']; ?>
')" />                                                            </td>
                                                        </tr>
                                                        <tr><td>&nbsp;</td></tr>
                                                        <tr>
                                                            <td colspan="6"><hr style="border-style: dashed;"/></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <?php elseif ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType'] == 'Charge'): ?>
                            <tr>
                                <td width="108"><?php echo $this->_tpl_vars['LBL_LINE_TYPE']; ?>
 : &nbsp;<font class="reqmsg">*</font></td>
                                <td width="319">
                                    <span id="invtype">                                        <select name="invoiceType[]" id="eInvoiceType<?php echo $this->_sections['i']['index']; ?>
" class="required" >
                                            <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['invoiceTypes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                            <option value="<?php echo $this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']]; ?>
" <?php if ($this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']] == $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select>
                                    </span>
                                </td>
                                <!--<td width="122"><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
 : &nbsp;</td>
                                <td>
                                    <b><?php echo $this->_tpl_vars['invdtls'][0]['vCurrency']; ?>
</b>
                                    <input type="hidden" name="itemCode[]" id="vItemCode<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vItemCode']; ?>
" readonly="readonly" />
                                </td>-->
                                <td width="122"><?php echo $this->_tpl_vars['LBL_PART_NO']; ?>
 : </td>
                                <td>
                                    <b><?php echo $this->_tpl_vars['invdtls'][0]['vPartNo']; ?>
</b>
                                    <input type="text" name="vPartNo[]" id="vPartNo<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PART_NO']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vPartNo']; ?>
" />
                                </td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
 : </td>
                                <td><textarea name="tDescription[]" id="tDescription<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:188px; height: 73px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                <td valign="top"><span class="ndcf"><?php echo $this->_tpl_vars['LBL_UNIT_MEASURE']; ?>
 :&nbsp;<font class="reqmsg"></font></span></td>
                                <td valign="top" class="uoms">
                                                                        <select name="vUnitOfMeasure[]" id="vUnitOfMeasure<?php echo $this->_sections['i']['index']; ?>
" class="" style="width:190px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_UNIT_MEASURE']; ?>
">
                                                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['uom']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <option value="<?php echo $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']; ?>
" <?php if ($this->_tpl_vars['poitems'][$this->_sections['i']['index']]['vUnitOfMeasure'] == $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']; ?>
</option>
                                        <?php endfor; endif; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td style="display:none;"><span class="ndcf"><?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                            <td style="display:none;"><input type="text" name="iQuantity[]" id="iQuantity<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required digits" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iQuantity']; ?>
" /></td>
                                            <td width="12.5%"><span class="dcr"><?php echo $this->_tpl_vars['LBL_RATE']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                            <td width="149"><input type="text" name="fPrice[]" id="fPrice<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PRICE']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" /></td>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                            <td><input type="text" name="fAmount[]" id="fAmount<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly="readonly" /></td>
                                        </tr>
                                        <tr>
                                            <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iInvoiceLineID'] < 1): ?>
                                            <?php echo smarty_function_assign(array('var' => 'fVAT','value' => $this->_tpl_vars['cntrydt'][0]['fVat']), $this);?>

                                            <?php echo smarty_function_assign(array('var' => 'fOtherTax','value' => $this->_tpl_vars['cntrydt'][0]['fOtherTax']), $this);?>

                                            <?php echo smarty_function_assign(array('var' => 'fWithHoldingTax','value' => $this->_tpl_vars['cntrydt'][0]['fwhTax']), $this);?>

                                            <?php else: ?>
                                            <?php echo smarty_function_assign(array('var' => 'fVAT','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fVAT']), $this);?>

                                            <?php echo smarty_function_assign(array('var' => 'fOtherTax','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fOtherTax1']), $this);?>

                                            <?php echo smarty_function_assign(array('var' => 'fWithHoldingTax','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fWithHoldingTax']), $this);?>

                                            <?php endif; ?>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): &nbsp;<font class="reqmsg">*</font></span></td>
                                            <td><input type="text" name="fVAT[]" id="fVAT<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_VAT']; ?>
" value="<?php echo $this->_tpl_vars['fVAT']; ?>
" /></td>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                            <?php echo smarty_function_assign(array('var' => 'vat','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fVAT']/100)), $this);?>

                                            <td><input type="text" name="vat[]" id="vat<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_VAT']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['vat'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly='readonly' /></td>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </span></td>
                                            <td><input type="text" name="fOtherTax1[]" id="fOtherTax1<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo $this->_tpl_vars['fOtherTax']; ?>
" /></td>
                                        </tr>
                                        <tr>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 : </span></td>
                                            <?php echo smarty_function_assign(array('var' => 'otax','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fOtherTax']/100)), $this);?>

                                            <td><input type="text" name="othertax1[]" id="othertax1<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['otax'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly='readonly' /></td>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </span></td>
                                            <td><input type="text" name="fWithHoldingTax[]" id="fWithHoldingTax<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fWithHoldingTax']; ?>
" /></td>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 : </span></td>
                                            <?php echo smarty_function_assign(array('var' => 'wtax','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fWithHoldingTax']/100)), $this);?>

                                            <td><input type="text" name="withholdingtax" id="withholdingtax<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['wtax'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly='readonly' /></td>
                                        </tr>
                                        <tr>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_LINE_TOTAL']; ?>
 : </span></td>
                                            <td><input type="text" name="fLineTotal[]" id="fLineTotal<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly="readonly" /></td>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_RECEIPT']; ?>
 : </span></td>
                                            <td><input type="text" name="tReceipt[]" id="tReceipt<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tReceipt']; ?>
" /></td>
                                            <td><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
 : &nbsp;</td>
                                            <td>
                                                <b><?php echo $this->_tpl_vars['invdtls'][$this->_sections['i']['index']]['vCurrency']; ?>
</b>
                                                <input type="hidden" name="itemCode[]" id="vItemCode<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vItemCode']; ?>
" readonly="readonly" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align='right'>
                                                <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('<?php echo $this->_sections['i']['index']; ?>
')" />                                            </td>
                                        </tr>
                                        <tr><td colspan="3">&nbsp;</td></tr>
                                        <tr>
                                            <td colspan="2"><span class="ndcf"><b><?php echo $this->_tpl_vars['LBL_DISCOUNT']; ?>
 / <?php echo $this->_tpl_vars['LBL_CHARGE']; ?>
 :- </b> &nbsp; <select id="eSublineType<?php echo $this->_sections['i']['index']; ?>
" name="eSublineType[]"><option value="">None</option><option value="Discount" <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] == 'Discount'): ?>selected="selected"<?php endif; ?> >Discount</option><option value="Charge" <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] == 'Charge'): ?>selected="selected"<?php endif; ?>>Charge</option></select></span></td>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
 : </span></td>
                                            <td><input type="text" name="iSubQuantity[]" id="iSubQuantity<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iSubQuantity']; ?>
" /></td>
                                            <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_RATE']; ?>
 : </span></td>
                                            <td><input type="text" name="fSubRate[]" id="fSubRate<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubRate']; ?>
" /></td>
                                            <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubAmount']; ?>
" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align='right'>
                                                <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('<?php echo $this->_sections['i']['index']; ?>
')" />                                            </td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <td colspan="6"><hr style="border-style:dashed;"/></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                </div>
                </td>
                </tr>
                <?php else: ?>
                <tr>
                    <td width="108"><?php echo $this->_tpl_vars['LBL_LINE_TYPE']; ?>
 : &nbsp;<font class="reqmsg">*</font></td>
                    <td width="319">
                        <span id="invtype">                            <select name="invoiceType[]" id="eInvoiceType<?php echo $this->_sections['i']['index']; ?>
" class="required" >
                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['invoiceTypes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                <option value="<?php echo $this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']]; ?>
" <?php if ($this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']] == $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']]; ?>
</option>
                                <?php endfor; endif; ?>
                            </select>
                        </span>
                    </td>
                    <!--<td width="122"><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
 : &nbsp;</td>
                    <td>
                        <b><?php echo $this->_tpl_vars['invdtls'][0]['vCurrency']; ?>
</b>
                        <input type="hidden" name="itemCode[]" id="vItemCode<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vItemCode']; ?>
" readonly="readonly" />
                    </td>-->
                    <td width="122"><?php echo $this->_tpl_vars['LBL_PART_NO']; ?>
 : </td>
                    <td>
                        <b><?php echo $this->_tpl_vars['invdtls'][0]['vPartNo']; ?>
</b>
                        <input type="text" name="vPartNo[]" id="vPartNo<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PART_NO']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vPartNo']; ?>
" />
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
 : </td>
                    <td><textarea name="tDescription[]" id="tDescription<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:188px; height: 73px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                    <td valign="top"><span class="ndcf"><?php echo $this->_tpl_vars['LBL_UNIT_MEASURE']; ?>
 :&nbsp;<font class="reqmsg"></font></span></td>
                    <td valign="top" class="uoms">
                                                <select name="vUnitOfMeasure[]" id="vUnitOfMeasure<?php echo $this->_sections['i']['index']; ?>
" class="" style="width:190px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_UNIT_MEASURE']; ?>
">
                                                        <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['uom']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <option value="<?php echo $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']; ?>
" <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vUnitOfMeasure'] == $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']; ?>
</option>
                            <?php endfor; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="100%" border="0">
                            <tr>
                                <td width="108"><span class="ndcf"><?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                <td width="154"><input type="text" name="iQuantity[]" id="iQuantity<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required digits" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iQuantity']; ?>
" /></td>
                                <td width="111"><span class="dcr"><?php echo $this->_tpl_vars['LBL_PRICE']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                <td width="149"><input type="text" name="fPrice[]" id="fPrice<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PRICE']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" /></td>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                <td><input type="text" name="fAmount[]" id="fAmount<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iInvoiceLineID'] < 1): ?>
                                <?php echo smarty_function_assign(array('var' => 'fVAT','value' => $this->_tpl_vars['cntrydt'][0]['fVat']), $this);?>

                                <?php echo smarty_function_assign(array('var' => 'fOtherTax','value' => $this->_tpl_vars['cntrydt'][0]['fOtherTax']), $this);?>

                                <?php echo smarty_function_assign(array('var' => 'fWithHoldingTax','value' => $this->_tpl_vars['cntrydt'][0]['fwhTax']), $this);?>

                                <?php else: ?>
                                <?php echo smarty_function_assign(array('var' => 'fVAT','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fVAT']), $this);?>

                                <?php echo smarty_function_assign(array('var' => 'fOtherTax','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fOtherTax1']), $this);?>

                                <?php echo smarty_function_assign(array('var' => 'fWithHoldingTax','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fWithHoldingTax']), $this);?>

                                <?php endif; ?>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): &nbsp;<font class="reqmsg">*</font></span></td>
                                <td><input type="text" name="fVAT[]" id="fVAT<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_VAT']; ?>
" value="<?php echo $this->_tpl_vars['fVAT']; ?>
" /></td>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 : &nbsp;<font class="reqmsg">*</font></span></td>
                                <?php echo smarty_function_assign(array('var' => 'vat','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fVAT']/100)), $this);?>

                                <td><input type="text" name="vat[]" id="vat<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_VAT']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['vat'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly='readonly' /></td>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </span></td>
                                <td><input type="text" name="fOtherTax1[]" id="fOtherTax1<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo $this->_tpl_vars['fOtherTax']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 : </span></td>
                                <?php echo smarty_function_assign(array('var' => 'otax','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fOtherTax']/100)), $this);?>

                                <td><input type="text" name="othertax1[]" id="othertax1<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['otax'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly='readonly' /></td>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </span></td>
                                <td><input type="text" name="fWithHoldingTax[]" id="fWithHoldingTax<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fWithHoldingTax']; ?>
" /></td>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 : </span></td>
                                <?php echo smarty_function_assign(array('var' => 'wtax','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fWithHoldingTax']/100)), $this);?>

                                <td><input type="text" name="withholdingtax" id="withholdingtax<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['wtax'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly='readonly' /></td>
                            </tr>
                            <tr>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_LINE_TOTAL']; ?>
 : </span></td>
                                <td><input type="text" name="fLineTotal[]" id="fLineTotal<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
" readonly="readonly" /></td>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_RECEIPT']; ?>
 : </span></td>
                                <td><input type="text" name="tReceipt[]" id="tReceipt<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tReceipt']; ?>
" /></td>
                                <td><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
 : &nbsp;</td>
                                <td>
                                    <b><?php echo $this->_tpl_vars['invdtls'][$this->_sections['i']['index']]['vCurrency']; ?>
</b>
                                    <input type="hidden" name="itemCode[]" id="vItemCode<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vItemCode']; ?>
" readonly="readonly" />
                                </td>
                            </tr>
                            <tr><td colspan="6">&nbsp;</td></tr>
                            <tr>
                                <td colspan="2"><span class="ndcf"><b><?php echo $this->_tpl_vars['LBL_DISCOUNT']; ?>
 / <?php echo $this->_tpl_vars['LBL_CHARGE']; ?>
 :- </b> &nbsp; <select id="eSublineType<?php echo $this->_sections['i']['index']; ?>
" name="eSublineType[]"><option value="">None</option><option value="Discount" <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] == 'Discount'): ?>selected="selected"<?php endif; ?> >Discount</option><option value="Charge" <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] == 'Charge'): ?>selected="selected"<?php endif; ?>>Charge</option></select></span></td>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
 : </span></td>
                                <td><input type="text" name="iSubQuantity[]" id="iSubQuantity<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] == ''): ?>0<?php else:  echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iSubQuantity'];  endif; ?>" /></td>
                                <td><span class="ndcf"><?php echo $this->_tpl_vars['LBL_RATE']; ?>
 : </span></td>
                                <td><input type="text" name="fSubRate[]" id="fSubRate<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="<?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] == ''): ?>0<?php else:  echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubRate'];  endif; ?>" /></td>
                                <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="<?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] == ''): ?>0<?php else:  echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubAmount'];  endif; ?>" /></td>
                            </tr>
                            <tr>
                                <td colspan="6" align='right'>
                                    <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('<?php echo $this->_sections['i']['index']; ?>
')" /><!---->
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td colspan="6"><hr style="border-style: dashed;"/></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </table>
            </div>
            </td>
            </tr>
            <?php endif; ?>
            <?php endfor; else: ?>
            <tr>
                <td>
                    <div id="Div0">
                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                                        <tr>
                                <td width="108"><?php echo $this->_tpl_vars['LBL_LINE_TYPE']; ?>
 : &nbsp;<font class="reqmsg">*</font></td>
                                <td width="281">
                                    <span id="invtype">                                        <select name="invoiceType[]" id="eInvoiceType<?php echo $this->_sections['i']['index']; ?>
" class="required" >
                                            <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['invoiceTypes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                            <option value="<?php echo $this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']]; ?>
" <?php if ($this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']] == $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['invoiceTypes'][$this->_sections['l']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select>
                                    </span>
                                </td>
                                                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
 : </td>
                                <td><textarea name="tDescription[]" id="tDescription<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:188px; height: 73px;"  ><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_UNIT_MEASURE']; ?>
 :&nbsp;<font class="reqmsg"></font></td>
                                <td valign="top" class="uoms">
                                                                        <select name="vUnitOfMeasure[]" id="vUnitOfMeasure<?php echo $this->_sections['i']['index']; ?>
" class="" style="width:190px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_UNIT_MEASURE']; ?>
">
                                                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['uom']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <option value="<?php echo $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']; ?>
" <?php if ($this->_tpl_vars['poitems'][$this->_sections['i']['index']]['vUnitOfMeasure'] == $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['uom'][$this->_sections['l']['index']]['vUnitOfMeasure']; ?>
</option>
                                        <?php endfor; endif; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td width="108"><?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
 : &nbsp;<font class="reqmsg">*</font></td>
                                            <td width="154"><input type="text" name="iQuantity[]" id="iQuantity<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required digits" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_QUANTITY']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iQuantity']; ?>
" /></td>
                                            <td width="111"><?php echo $this->_tpl_vars['LBL_PRICE']; ?>
 : &nbsp;<font class="reqmsg">*</font></td>
                                            <td width="149"><input type="text" name="fPrice[]" id="fPrice<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PRICE']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fPrice']; ?>
" /></td>
                                            <td><?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
 : &nbsp;<font class="reqmsg">*</font></td>
                                            <td><input type="text" name="fAmount[]" id="fAmount<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']; ?>
" readonly='readonly' /></td>
                                        </tr>
                                        <tr>
                                            <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iInvoiceLineID'] < 1): ?>
                                            <?php echo smarty_function_assign(array('var' => 'fVAT','value' => $this->_tpl_vars['cntrydt'][0]['fVat']), $this);?>

                                            <?php echo smarty_function_assign(array('var' => 'fOtherTax','value' => $this->_tpl_vars['cntrydt'][0]['fOtherTax']), $this);?>

                                            <?php echo smarty_function_assign(array('var' => 'fWithHoldingTax','value' => $this->_tpl_vars['cntrydt'][0]['fwhTax']), $this);?>

                                            <?php else: ?>
                                            <?php echo smarty_function_assign(array('var' => 'fVAT','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fVAT']), $this);?>

                                            <?php echo smarty_function_assign(array('var' => 'fOtherTax','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fOtherTax1']), $this);?>

                                            <?php echo smarty_function_assign(array('var' => 'fWithHoldingTax','value' => $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fWithHoldingTax']), $this);?>

                                            <?php endif; ?>
                                            <td><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): &nbsp;<font class="reqmsg">*</font></td>
                                            <td><input type="text" name="fVAT[]" id="fVAT<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_VAT']; ?>
" value="<?php echo $this->_tpl_vars['fVAT']; ?>
" /></td>
                                            <td><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 : &nbsp;<font class="reqmsg">*</font></td>
                                            <?php echo smarty_function_assign(array('var' => 'vat','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fVAT']/100)), $this);?>

                                            <td><input type="text" name="vat[]" id="vat<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_VAT']; ?>
" value="<?php echo $this->_tpl_vars['vat']; ?>
" readonly='readonly' /></td>
                                            <td><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </td>
                                            <td><input type="text" name="fOtherTax1[]" id="fOtherTax1<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo $this->_tpl_vars['fOtherTax']; ?>
" /></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 : </td>
                                            <?php echo smarty_function_assign(array('var' => 'otax','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fOtherTax']/100)), $this);?>

                                            <td><input type="text" name="othertax1[]" id="othertax1<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo $this->_tpl_vars['otax']; ?>
" readonly='readonly' /></td>
                                            <td><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 <?php echo $this->_tpl_vars['LBL_RATE']; ?>
 (%): </td>
                                            <td><input type="text" name="fWithHoldingTax[]" id="fWithHoldingTax<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fWithHoldingTax']; ?>
" /></td>
                                            <td><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 : </td>
                                            <?php echo smarty_function_assign(array('var' => 'wtax','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']*$this->_tpl_vars['fWithHoldingTax']/100)), $this);?>

                                            <td><input type="text" name="withholdingtax" id="withholdingtax<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
" value="<?php echo $this->_tpl_vars['wtax']; ?>
" readonly='readonly' /></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->_tpl_vars['LBL_LINE_TOTAL']; ?>
 : </td>
                                            <td><input type="text" name="fLineTotal[]" id="fLineTotal<?php echo $this->_sections['i']['index']; ?>
" class="input-rag decimals" style="width:117px;" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fLineTotal']; ?>
" readonly="readonly" /></td>
                                            <td><?php echo $this->_tpl_vars['LBL_RECEIPT']; ?>
 : </td>
                                            <td><input type="text" name="tReceipt[]" id="tReceipt<?php echo $this->_sections['i']['index']; ?>
" class="input-rag" style="width:117px;" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tReceipt']; ?>
" /></td>
                                            <td><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
 : &nbsp;</td>
                                            <td>
                                                <b><?php echo $this->_tpl_vars['invdtls'][$this->_sections['i']['index']]['vCurrency']; ?>
</b>
                                                <input type="hidden" name="itemCode[]" id="vItemCode<?php echo $this->_sections['i']['index']; ?>
" class="input-rag required" style="width:188px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ITEM_CODE']; ?>
" value="<?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vItemCode']; ?>
" readonly="readonly" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align='right'>
                                                <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('<?php echo $this->_sections['i']['index']; ?>
')" />                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><hr style="border-style: dashed;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td>
                    <table width="100%" border="0" cellspacing="5" cellpadding="0">
                        <tr>
                            <td colspan="6">
                                <div id="addNew">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right">
                                <img id="adb" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/add-btn.png" onclick="ad='y'; addRw();" alt="" border="0" /> &nbsp;
                                <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-addnew.gif" onclick="ad='y'; addRow();"  alt="" border="0" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" id="lines" valign="top">
                                <div><b><hr style="height:0px; color:#eeeeee;"/><?php echo $this->_tpl_vars['LBL_LINE_ITEMS']; ?>
<hr style="height:0px; color:#eeeeee;" /></b></div>
                                <div style="height:190px; overflow-y:scroll;">
                                    <b>
                                        <span style="display:inline-block; height:10px; w	idth:6px; padding:1px; margin:0px;">&nbsp;</span>
                                        <!--<span style="display:inline-block; height:10px; width:50px; padding:1px; margin:0px;"><?php echo $this->_tpl_vars['LBL_LINE_TYPE']; ?>
</span>-->
                                        <span style="display:inline-block; height:10px; width:120px; padding:1px; margin:0px;"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
</span>
                                        <span style="display:inline-block; height:10px; width:60px; padding:1px; margin:0px;"><?php echo $this->_tpl_vars['LBL_PART_NO']; ?>
</span>
                                        <span style="display:inline-block; height:10px; width:70px; padding:1px; margin:0px;">UOM</span>
                                        <span style="display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;">Qty</span>
                                        <span style="display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_PRICE']; ?>
 / <?php echo $this->_tpl_vars['LBL_RATE']; ?>
</span>
                                        <span style="display:inline-block; height:10px; width:125px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
</span>
                                        <span style="display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_VAT']; ?>
</span>
                                        <!--<span style="display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
</span>-->
                                        <span style="display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;">WH Tax</span>
                                        <span style="display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;"><?php echo $this->_tpl_vars['LBL_LINE_TOTAL']; ?>
</span>
                                        <span style="display:inline-block; height:10px; padding:1px; margin:0px;">&nbsp;</span>
                                    </b>
                                    <div id="dlines">
                                        <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['invitems']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType'] == 'Discount'): ?>
                                        <div id="spnd<?php echo $this->_sections['i']['index']; ?>
">
                                            <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/arrow-orange.gif' /></span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px;display: none;' class="ot"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType']; ?>
</span>
                                            <span style='display:inline-block; height:10px; width:117px; padding:1px; margin:0px;' class="td"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;' class="um"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vPartNo']; ?>
</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um"></span>
                                            <span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class="iq"></span>
                                            <span style='display:inline-block; height:10px; width:84px; padding:1px; margin:0px; text-align:right;' class="fp"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="fa"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class="fv"></span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox"></span>
                                            <span style='display:inline-block; height:10px; width:82px; padding:1px; margin:0px; text-align:right;' class="wt"></span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="lt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; padding:1px; margin:0px; text-align:right;' class="at">
                                                &nbsp; <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-pen.gif' onclick='edt="y"; shwtbl(<?php echo $this->_sections['i']['index']; ?>
);' />&nbsp;<img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-cancel.gif' onclick='deltbl(<?php echo $this->_sections['i']['index']; ?>
);' />
                                            </span>
                                            <div id="subli" style="display:none; padding:3px; padding-left:19px;">
                                                <!---->
                                                <span style='display:inline-block; height:10px; width:181px; margin:0px; text-align:left;' class="sltyp"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType']; ?>
 </span>
                                                <span class="slqt" style="display:inline-block; height:10px; width:119px; margin:0px; text-align:right;"><span class="sqt"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iSubQuantity']; ?>
</span></span> &nbsp;&nbsp;&nbsp;
                                                <span class="slrt" style="display:inline-block; height:10px; width:76px; margin:0px; text-align:right;"><span class="srt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubRate'])) ? $this->_run_mod_handler('toFixed', true, $_tmp) : toFixed($_tmp)); ?>
%</span></span> &nbsp;&nbsp;&nbsp;
                                                <!---->
                                                <span class="sltl" style="display:inline-block; height:10px; width:105px; margin:0px; text-align:right;"><span class="stl"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubAmount'])) ? $this->_run_mod_handler('toFixed', true, $_tmp, true) : toFixed($_tmp, true)); ?>
</span></span>
                                                <span class="slvt" style="display:inline-block; height:10px; width:76px; margin:0px; text-align:right;"><span class="slv"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubVat']; ?>
</span></span>
                                                <span class="slot" style="display:inline-block; height:10px; width:54px; margin:0px; text-align:right;display: none;"><span class="slo"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubOtherTax']; ?>
</span></span>
                                                <span class="slwt" style="display:inline-block; height:10px; width:86px; margin:0px; text-align:right;"><span class="slw"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubWHTax'])) ? $this->_run_mod_handler('number_format', true, $_tmp, true) : number_format($_tmp, true)); ?>
</span></span>
                                                <span class="sltt" style="display:inline-block; height:10px; width:118px; margin:0px; text-align:right;"><span class="slf"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubTotal']; ?>
</span></span>
                                                <!---->
                                            </div>
                                        </div>
                                        <?php elseif ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType'] == 'Charge'): ?>
                                        <div id="spnd<?php echo $this->_sections['i']['index']; ?>
">
                                            <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/arrow-orange.gif' /></span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px;display: none;' class="ot"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType']; ?>
</span>
                                            <span style='display:inline-block; height:10px; width:117px; padding:1px; margin:0px;' class="td"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;' class="um"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vPartNo']; ?>
</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um"></span>
                                            <span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class="iq"></span>
                                            <span style='display:inline-block; height:10px; width:84px; padding:1px; margin:0px; text-align:right;' class="fp"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="fa"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class="fv"></span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox"></span>
                                            <span style='display:inline-block; height:10px; width:82px; padding:1px; margin:0px; text-align:right;' class="wt"></span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="lt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; padding:1px; margin:0px; text-align:right;' class="at">
                                                &nbsp; <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-pen.gif' onclick='edt="y"; shwtbl(<?php echo $this->_sections['i']['index']; ?>
);' />&nbsp;<img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-cancel.gif' onclick='deltbl(<?php echo $this->_sections['i']['index']; ?>
);' />
                                            </span>
                                            <div id="subli" style="display:none; padding:3px; padding-left:19px;">
                                                <!---->
                                                <span style='display:inline-block; height:10px; width:175px; margin:0px; text-align:left;' class="sltyp"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType']; ?>
 </span>
                                                <span class="slqt" style="display:inline-block; height:10px; width:119px; margin:0px; text-align:right;"><span class="sqt"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iSubQuantity']; ?>
</span></span> &nbsp;&nbsp;&nbsp;
                                                <span class="slrt" style="display:inline-block; height:10px; width:74px; margin:0px; text-align:right;"><span class="srt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubRate'])) ? $this->_run_mod_handler('toFixed', true, $_tmp) : toFixed($_tmp)); ?>
%</span></span> &nbsp;&nbsp;&nbsp;
                                                <!---->
                                                <span class="sltl" style="display:inline-block; height:10px; width:104px; margin:0px; text-align:right;"><span class="stl"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubAmount'])) ? $this->_run_mod_handler('toFixed', true, $_tmp, true) : toFixed($_tmp, true)); ?>
</span></span>
                                                <span class="slvt" style="display:inline-block; height:10px; width:72px; margin:0px; text-align:right;"><span class="slv"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubVat']; ?>
</span></span>
                                                <span class="slot" style="display:inline-block; height:10px; width:54px; margin:0px; text-align:right;display: none;"><span class="slo"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubOtherTax']; ?>
</span></span>
                                                <span class="slwt" style="display:inline-block; height:10px; width:84px; margin:0px; text-align:right;"><span class="slw"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubWHTax']; ?>
</span></span>
                                                <span class="sltt" style="display:inline-block; height:10px; width:117px; margin:0px; text-align:right;"><span class="slf"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubTotal']; ?>
</span></span>
                                                <!---->
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div id="spnd<?php echo $this->_sections['i']['index']; ?>
">
                                            <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/arrow-orange.gif' /></span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px;display:none;' class="ot"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eInvoiceType']; ?>
</span>
                                            <span style='display:inline-block; height:10px; width:117px; padding:1px; margin:0px;' class="td"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['tDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;' class="um"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vPartNo']; ?>
</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['vUnitOfMeasure']; ?>
</span>
                                            <span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class="iq"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iQuantity'])) ? $this->_run_mod_handler('number_format', true, $_tmp, false) : number_format($_tmp, false)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:74px; padding:1px; margin:0px; text-align:right;' class="fp"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fPrice'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:125px; padding:1px; margin:0px; text-align:right;' class="fa"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class="fv"><?php echo smarty_function_assign(array('var' => 'vt','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fVAT']*$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['vt'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox"><?php echo smarty_function_assign(array('var' => 'ot','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fOtherTax1']*$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['ot'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:82px; padding:1px; margin:0px; text-align:right;' class="wt"><?php echo smarty_function_assign(array('var' => 'wt','value' => ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fWithHoldingTax']*$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fAmount']/100)), $this); echo ((is_array($_tmp=$this->_tpl_vars['wt'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="lt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fLineTotal'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
</span>
                                            <span style='display:inline-block; height:10px; padding:1px; margin:0px; text-align:right;' class="at">
                                                &nbsp; <img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-pen.gif' onclick='edt="y"; shwtbl(<?php echo $this->_sections['i']['index']; ?>
);' />&nbsp;<img src='<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-cancel.gif' onclick='deltbl(<?php echo $this->_sections['i']['index']; ?>
);' />
                                            </span>
                                            <div id="subli" style="display:<?php if ($this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] != 'Discount' && $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType'] != 'Charge'): ?>none<?php endif; ?>; padding:3px; padding-left:12px;">
                                                <!---->
                                                <span style='display:inline-block; height:10px; width:175px; margin:0px; text-align:left;' class="sltyp"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['eSublineType']; ?>
 </span>
                                                <span class="slqt" style="display:inline-block; height:10px; width:119px; margin:0px; text-align:right;"><span class="sqt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['iSubQuantity'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, false) : formatMoney($_tmp, false)); ?>
</span></span> &nbsp;&nbsp;&nbsp;
                                                <span class="slrt" style="display:inline-block; height:10px; width:74px; margin:0px; text-align:right;"><span class="srt"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubRate'])) ? $this->_run_mod_handler('formatMoney', true, $_tmp, true) : formatMoney($_tmp, true)); ?>
%</span></span> &nbsp;&nbsp;&nbsp;
                                                <!---->
                                                <span class="sltl" style="display:inline-block; height:10px; width:104px; margin:0px; text-align:right;"><span class="stl"><?php echo ((is_array($_tmp=$this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubAmount'])) ? $this->_run_mod_handler('toFixed', true, $_tmp, true) : toFixed($_tmp, true)); ?>
</span></span>
                                                <span class="slvt" style="display:inline-block; height:10px; width:72px; margin:0px; text-align:right;"><span class="slv"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubVat']; ?>
</span></span>
                                                <span class="slot" style="display:inline-block; height:10px; width:54px; margin:0px; text-align:right;display: none;"><span class="slo"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubOtherTax']; ?>
</span></span>
                                                <span class="slwt" style="display:inline-block; height:10px; width:84px; margin:0px; text-align:right;"><span class="slw"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubWHTax']; ?>
</span></span>
                                                <span class="sltt" style="display:inline-block; height:10px; width:117px; margin:0px; text-align:right;"><span class="slf"><?php echo $this->_tpl_vars['invitems'][$this->_sections['i']['index']]['fSubTotal']; ?>
</span></span>
                                                <!---->
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <!--<div>&nbsp;</div>-->
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
                        <tr>
                            <td height="35" valign="bottom">&nbsp;</td>
                            <td valign="bottom" colspan="5" align="center">
                                                                <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif"  alt="" border="0" id="btnBack" name="Back" style="vertical-align:middle;cursor: pointer;" onclick="back();" />&nbsp;
                                <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reset.gif"  alt=" " border="0" id="btnReset" name="Reset" style="vertical-align:middle;cursor: pointer;" onclick="resetform();return false;" />&nbsp;
                                <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
save-btn.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="$('#eSaved').val('Yes'); return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                                <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-submit.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="$('#eSaved').val('No'); return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            </table>
            </form>
        </div>
    </div>
    <div>&nbsp;</div>
</div>
</div>
<span id="spn" style="display:hidden;"></span>
<span id="vldms" style="display:none;"></span>
</div>
<?php if (((is_array($_tmp=$this->_tpl_vars['invitems'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['invitems']) > 1): ?>
<?php echo smarty_function_assign(array('var' => 'cnt','value' => count($this->_tpl_vars['invitems'])), $this);?>

<?php endif; ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_CONTENT_JS']; ?>
money_format.js"></script>
<?php echo '
<script type="text/javascript">
    var sbt = \'n\';
    var cnt = \'';  echo $this->_tpl_vars['cnt'];  echo '\';
    var currency = \'';  echo $this->_tpl_vars['invdtls'][0]['vCurrency'];  echo '\';
    var vat = \'';  echo $this->_tpl_vars['cntrydt'][0]['fVat'];  echo '\';
    var otax = \'';  echo $this->_tpl_vars['cntrydt'][0]['fOtherTax'];  echo '\';
    var wtax = \'';  echo $this->_tpl_vars['cntrydt'][0]['fwhTax'];  echo '\';
    var ad = \'n\';
    var edt = \'n\';

    function closeRow(vl) {
        if(document.getElementById(\'vUnitOfMeasure\'+vl)) {
            // if($("#frmadd").validate().element(\'#vUnitOfMeasure\'+vl)==false || $("#frmadd").validate().element(\'#fAmount\'+vl)==false || $("#frmadd").validate().element(\'#fLineTotal\'+vl)==false) {
            if(!document.getElementById(\'spnd\'+vl)) {
                deltbl(vl);
            } else {
                if($("#frmadd").validate().element(\'#vUnitOfMeasure\'+vl)==false || $("#frmadd").validate().element(\'#fAmount\'+vl)==false || $("#frmadd").validate().element(\'#fLineTotal\'+vl)==false) {
                    //
                } else {
                    $(\'#Div\'+vl).hide();
                }
            }
        }
    }

    function setsublines(idx)
    {
        pr = false;
        if($(\'#spnd\'+idx+\' > #subli\').length > 0) {
            pr = $(\'#spnd\'+idx+\' > #subli\');
            if($(\'.sqt\',pr).length > 0) {
                $(\'.sqt\',pr).attr(\'innerHTML\', money_format(\'%i\',$(\'#iSubQuantity\'+idx).val(),\'no\'));
                // alert($(\'.srt\',pr).length);
            }
        } else {
            return false;
        }
        if($.trim($(\'#fSubRate\'+idx).val()) != \'\' && !isNaN(parseInt($(\'#fSubRate\'+idx).val(), 10))) {
            var subtype = $.trim($(\'#eSublineType\'+idx).val());
            // alert(subtype);
            if(subtype == \'\') {
                return false;
            }
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

            if(subtype == \'Charge\') {
                var amt1 = (sum * subrate / 100);
                amt = amt1 + ((sum * vat / 100) * subrate / 100) + ((sum * otax / 100) * subrate / 100) - ((sum * whtax / 100) * subrate / 100);
            } else {
                var amt1 = (-(sum * subrate / 100));
                amt = amt1 - ((sum * vat / 100) * subrate / 100) - ((sum * otax / 100) * subrate / 100) + ((sum * whtax / 100) * subrate / 100);
            }
            // amt = amt + ramt;
            // alert(amt);
            // amt = parseFloat(amt,10).toFixed(2);
            if(!isNaN(amt1) && amt1.toString() != \'NaN\') {
                if(pr) {
                    // $(\'.stl\', pr).attr(\'innerHTML\', Math.abs(amt1));
                    var stl = Math.abs(amt1);
                    //$(\'.stl\', pr).attr(\'innerHTML\', ((stl > parseInt(stl,10))? stl.toFixed(2) : stl));
                    $(\'.stl\', pr).attr(\'innerHTML\', money_format(\'%i\',stl));
                }
            }
            if(!isNaN(amt) && amt.toString() != \'NaN\') {
                $(\'#fSubAmount\'+idx).val(amt);
                if(pr) {
                    // $(\'.slf\',pr).attr(\'innerHTML\', Math.abs(amt));
                    var slf = Math.abs(amt);
                    //$(\'.slf\',pr).attr(\'innerHTML\', ((slf > parseInt(slf,10))? slf.toFixed(2) : slf));
                    $(\'.slf\',pr).attr(\'innerHTML\', money_format(\'%i\',slf));
                }
            }
            var slv = ((sum * vat / 100) * subrate / 100);
            //slv = (slv > parseInt(slv,10))? slv.toFixed(2) : slv;
            slv = money_format(\'%i\',slv);
            $(\'.slv\',pr).attr(\'innerHTML\', slv);
            var slo = ((sum * otax / 100) * subrate / 100);
            //slo = (slo > parseInt(slo,10))? slo.toFixed(2) : slo;
            slo = slo.toFixed(2);
            $(\'.slo\',pr).attr(\'innerHTML\', slo);
            var slw = ((sum * whtax / 100) * subrate / 100);
            //slw = (slw > parseInt(slw,10))? slw.toFixed(2) : slw;
            slw = slw.toFixed(2);
            $(\'.slw\',pr).attr(\'innerHTML\', slw);
            // $(\'#fPrice\'+idx).trigger(\'blur\');
        }
    }

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
            if($.trim($(this).find(\'.ot\').attr(\'innerHTML\')) == \'Discount\') {
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
            } else if($.trim($(this).find(\'.ot\').attr(\'innerHTML\')) == \'Charge\') {
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
                var subli = $(\'#subli\', $(this));
                if(subli.length > 0) {
                    var sltl = parseFloat($(\'.stl\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                    if($(\'.slf\', subli).length > 0) {
                        var slf = parseFloat($(\'.slf\', subli).html().replace(new RegExp(\',\', \'g\'),\'\'), 10);
                    }
                    if($(\'.sltyp\', subli).length > 0) {
                        var sltyp = $(\'.sltyp\', subli).html().replace(new RegExp(\'-\', \'g\'),\'\').toLowerCase();
                    }
                    //alert($.trim(sltyp))
                    if($.trim(sltyp) == \'discount\' || $.trim(sltyp) == \'discount\') {
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
                    } else if($.trim(sltyp) == \'charge\' || $.trim(sltyp) == \'charge\') {
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
			namt_int = parseFloat(parseInt(namt) + \'.9\');
			namt = (parseInt(namt) > parseFloat(namt_int))? round(namt) : namt;
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

	function getlitotal()
	{
		var lit = 0;
		$.each($(\'[id^=spnd]\'), function(i, el) {
			id = $(this).attr(\'id\').replace(\'spnd\',\'\');
			if($(\'.ot\', $(this)).html()!=\'Discount\' && $(\'.ot\', $(this)).html()!=\'Charge\') {
				lt = $(\'.lt\', $(this)).html();
				lt = parseFloat(parseFloat(lt.replace(new RegExp(\',\', \'g\'),\'\'),10).toFixed(2));
				lit = lit + lt;
			}
		});
		return lit;
	}

	function gettxtotal(vl)
	{
		var lit = 0;
		$.each($(\'[id^=spnd]\'), function(i, el) {
			id = $(this).attr(\'id\').replace(\'spnd\',\'\');
			if($(\'.ot\', $(this)).html()!=\'Discount\' && $(\'.ot\', $(this)).html()!=\'Charge\') {
				lt = $(vl, $(this)).html();
				lt = parseFloat(parseFloat(lt.replace(new RegExp(\',\', \'g\'),\'\'),10).toFixed(2));
				lit = lit + lt;
			}
		});
		return lit;
	}

    $(document).ready(function()
    {
		$(\'#btnReset\').click(function() {
			$(\'#frmadd\')[0].reset();
			$.each($(\'div[id^=Div]\'),function() {
				id = $(this).attr(\'id\').replace(\'Div\',\'\');
				if(parseInt(id) >= cnt) {
					$(this).remove();
					$(\'#spnd\'+id).remove();
				}
			});
			$.each($(\'select[name="invoiceType\\[\\]"]\'), function() {
				$(this).trigger(\'change\');
			});
			$.each($(\'select[name="eInvoiceType\\[\\]"]\'), function() {
				$(this).trigger(\'change\');
			});
			$.each($(\'select[name="fPrice\\[\\]"]\'), function() {
				$(this).trigger(\'blur\');
			});
		});

        $(\'input[name="fPrice\\[\\]"]\').blur(function() {
            var rq = $(this).attr(\'id\').replace(\'fPrice\',\'\');
            var type = $(\'#eInvoiceType\'+rq).val();
            if($.trim(type)==\'Discount\' || $.trim(type)==\'Charge\') {
                var p = parseFloat($(this).val().replace(new RegExp(\',\', \'g\'),\'\')).toFixed(2);
                $(\'#spnd\'+rq+\'>.iq\').attr(\'innerHTML\',\'\');
                $(\'#spnd\'+rq+\'>.fp\').attr(\'innerHTML\', money_format(\'%i\',parseFloat(p))+\'%\');
                $(\'#spnd\'+rq+\'>.fv\').attr(\'innerHTML\',\'\');
                $(\'#spnd\'+rq+\'>.ox\').attr(\'innerHTML\',\'\');
                $(\'#spnd\'+rq+\'>.wt\').attr(\'innerHTML\',\'\');
                $(\'#spnd\'+rq+\'>.fa\').attr(\'innerHTML\',\'\');
                //var subtotal = parseFloat($(\'#subt\').html().replace(new RegExp(\',\', \'g\'),\'\'));
                //var lt = parseFloat(subtotal * p / 100).toFixed(2);
//				litotal = getlitotal();
//              var lt = parseFloat(litotal * p / 100).toFixed(2); 	// subtotal
                //$(\'#fLineTotal\'+rq).val(lt);
				//lt = $.trim(money_format(\'%i\', parseFloat(lt)).replace("USD",""));
                //$(\'#spnd\'+rq+\'>.lt\').attr(\'innerHTML\',lt);
				var subtotal = parseFloat($(\'#subt\').html().replace(new RegExp(\',\', \'g\'),\'\'));
				var st = parseFloat(subtotal * p / 100).toFixed(2); 	// litotal
				if(!isNaN(st)) {
					$(\'#fAmount\'+rq).val(st);
				}
				st = $.trim(money_format(\'%i\', parseFloat(st)).replace("USD",""));
				$(\'#spnd\'+rq+\'>.fa\').attr(\'innerHTML\', st);
				st = parseFloat(st);
				//
				var fv = gettxtotal(\'.fv\');
				if(!isNaN(p)) { $(\'#fVAT\'+rq).val(p); }
				fv = parseFloat(fv * p / 100).toFixed(2);
				$(\'#spnd\'+rq+\'>.fv\').attr(\'innerHTML\', fv);
				fv = parseFloat(fv);
				//
				var ox = gettxtotal(\'.ox\');
				if(!isNaN(p)) { $(\'#fOtherTax1\'+rq).val(p); }
				ox = parseFloat(ox * p / 100).toFixed(2);
				$(\'#spnd\'+rq+\'>.ox\').attr(\'innerHTML\', ox);
				ox = parseFloat(ox);
				//
				var wt = gettxtotal(\'.wt\');
				if(!isNaN(p)) { $(\'#fWithHoldingTax\'+rq).val(p); }
				wt = parseFloat(wt * p / 100).toFixed(2);
				$(\'#spnd\'+rq+\'>.wt\').attr(\'innerHTML\', wt);
				wt = parseFloat(wt);
				//
				var lt = parseFloat((st + fv + ox - wt));
				if(!isNaN(lt)) {
					$(\'#fLineTotal\'+rq).val(lt.toFixed(2));
				}
				lt = $.trim(money_format(\'%i\', lt).replace("USD",""));
				$(\'#spnd\'+rq+\'>.lt\').attr(\'innerHTML\', lt);
            } else {
                var q = parseInt($(\'#iQuantity\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var p = parseFloat($(this).val().replace(new RegExp(\',\', \'g\'),\'\')).toFixed(2);
                var sum = parseInt(q)*parseFloat(p);
				if(!isNaN(sum)) {
                    $(\'#fAmount\'+rq).val($.trim(money_format(\'%i\',sum).replace("USD","")));
                }

                var v = parseFloat($(\'#fVAT\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var t = parseFloat($(\'#fOtherTax1\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var w = parseFloat($(\'#fWithHoldingTax\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                    sm = sm + a;
                    if(!isNaN(v)) { sm = sm + (a*v/100); $(\'#vat\'+rq).val(a*v/100); }
                    if(!isNaN(t)) { sm = sm + (a*t/100); $(\'#othertax1\'+rq).val(a*t/100); }
                    if(!isNaN(w)) { sm = sm - (a*w/100); $(\'#withholdingtax\'+rq).val(a*w/100); }
                    if(!isNaN(sm)) {
                        $(\'#fLineTotal\'+rq).val($.trim(money_format(\'%i\',sm).replace("USD","")));
                    }
                }
                //sum = (parseFloat(sum,10) > parseInt(sum,10))? sum.toFixed(2) : sum;
                //sm = (parseFloat(sm,10) > parseInt(sm,10))? sm.toFixed(2) : sm;
                // $(\'#fAmount\'+rq).val(parseInt(q)*parseFloat(p));
                if(document.getElementById(\'spnd\'+rq)) {
                    $(\'#spnd\'+rq+\'>.iq\').attr(\'innerHTML\',money_format(\'%i\',q,\'no\'));
                    $(\'#spnd\'+rq+\'>.fp\').attr(\'innerHTML\',money_format(p));
                    $(\'#spnd\'+rq+\'>.fv\').attr(\'innerHTML\',money_format(\'%i\',parseFloat($(\'#vat\'+rq).val())));
                    $(\'#spnd\'+rq+\'>.ox\').attr(\'innerHTML\',parseFloat($(\'#othertax1\'+rq).val()).toFixed(2));
                    $(\'#spnd\'+rq+\'>.wt\').attr(\'innerHTML\',parseFloat($(\'#withholdingtax\'+rq).val()).toFixed(2));
                    var fa = $.trim(money_format(\'%i\',sum).replace("USD",""));
                    /*if(fa.indexOf(\'.\') != -1 && parseInt(fa.substring(fa.lastIndexOf(\'.\')+1, fa.length),10) == 0) {
                       fa = fa.substring(0, fa.length-3);
                    }*/
					$(\'#spnd\'+rq+\'>.fa\').attr(\'innerHTML\', fa);
                    var lt = $.trim(money_format(\'%i\',sm).replace("USD",""));
                    /*if(lt.indexOf(\'.\') != -1 && parseInt(lt.substring(lt.lastIndexOf(\'.\')+1, lt.length),10) == 0) {
                       lt = lt.substring(0, lt.length-3);
                    }*/
                    $(\'#spnd\'+rq+\'>.lt\').attr(\'innerHTML\', lt);
                }
                $.each($(\'div[id*="Div"]\'), function(l) {
                    var sbtyp = $(this).find(\'[name="invoiceType\\[\\]"]\');
                    if(sbtyp.val() == \'Discount\' || sbtyp.val() == \'Charge\') {
                        $(this).find(\'[name="fPrice\\[\\]"]\').trigger(\'blur\');
                    }
                });
            }
            settotal();
        });
        $(\'input[name="iQuantity\\[\\]"]\').blur(function() {
            var rq = $(this).attr(\'id\').replace(\'iQuantity\',\'\');
            $(\'#fPrice\'+rq).trigger(\'blur\');
            /*var p = parseFloat($(\'#fPrice\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var q = parseInt($(this).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var sum = parseInt(q)*parseFloat(p);
                if(!isNaN(sum)) {
                        $(\'#fAmount\'+rq).val($.trim(money_format(\'%i\',sum).replace("USD","")));
                }

                var v = parseFloat($(\'#fVAT\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var t = parseFloat($(\'#fOtherTax1\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var w = parseFloat($(\'#fWithHoldingTax\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                        sm = sm + a;
                        if(!isNaN(v)) { sm = sm + (a*v/100); $(\'#vat\'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sm = sm + (a*t/100); $(\'#othertax1\'+rq).val(a*t/100); }
                        if(!isNaN(w)) { sm = sm - (a*w/100); $(\'#withholdingtax\'+rq).val(a*w/100); }
                        if(!isNaN(sm)) {
                                $(\'#fLineTotal\'+rq).val($.trim(money_format(\'%i\',sm).replace("USD","")));
                        }
                }

                if(document.getElementById(\'spnd\'+rq)) {
                        $(\'#spnd\'+rq+\'>.iq\').attr(\'innerHTML\',q);
                        $(\'#spnd\'+rq+\'>.fp\').attr(\'innerHTML\',p);
                        $(\'#spnd\'+rq+\'>.fv\').attr(\'innerHTML\',$(\'#vat\'+rq).val());
                        $(\'#spnd\'+rq+\'>.ox\').attr(\'innerHTML\',$(\'#othertax1\'+rq).val());
                        $(\'#spnd\'+rq+\'>.wt\').attr(\'innerHTML\',$(\'#withholdingtax\'+rq).val());
                        $(\'#spnd\'+rq+\'>.fa\').attr(\'innerHTML\',$.trim(money_format(\'%i\',sum).replace("USD","")));
                        $(\'#spnd\'+rq+\'>.lt\').attr(\'innerHTML\',$.trim(money_format(\'%i\',sm).replace("USD","")));
                }
                settotal();*/
        });

        $(\'input[name="fOtherTax1\\[\\]"]\').change(function() {
            var rq = $(this).attr(\'id\').replace(\'fOtherTax1\',\'\');
            $(\'#fPrice\'+rq).trigger(\'blur\');
            /*var a  = parseFloat($(\'#fAmount\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var v = parseFloat($(\'#fVAT\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var t = parseFloat($(this).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var w = parseFloat($(\'#fWithHoldingTax\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $(\'#vat\'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $(\'#othertax1\'+rq).val(a*t/100); }
                        if(!isNaN(w)) { sum = sum - (a*w/100); $(\'#withholdingtax\'+rq).val(a*w/100); }
                        if(!isNaN(sum)) {
                                $(\'#fLineTotal\'+rq).val($.trim(money_format(\'%i\',sum).replace("USD","")));
                        }
                }

                if(document.getElementById(\'spnd\'+rq)) {
                        // $(\'#spnd\'+rq+\'>.ox\').attr(\'innerHTML\',t);
                        $(\'#spnd\'+rq+\'>.ox\').attr(\'innerHTML\',$(\'#othertax1\'+rq).val());
                        $(\'#spnd\'+rq+\'>.lt\').attr(\'innerHTML\',$.trim(money_format(\'%i\',sum).replace("USD","")));
                }
                settotal();*/
        });
        $(\'input[name="fVAT\\[\\]"]\').change(function() {
            var rq = $(this).attr(\'id\').replace(\'fVAT\',\'\');
            $(\'#fPrice\'+rq).trigger(\'blur\');
            /*var a  = parseFloat($(\'#fAmount\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var t = parseFloat($(\'#fOtherTax1\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var w = parseFloat($(\'#fWithHoldingTax\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var v = parseFloat($(this).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $(\'#vat\'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $(\'#othertax1\'+rq).val(a*t/100); }
                        if(!isNaN(w)) { sum = sum - (a*w/100); $(\'#withholdingtax\'+rq).val(a*w/100); }
                        if(!isNaN(sum)) {
                                $(\'#fLineTotal\'+rq).val($.trim(money_format(\'%i\',sum).replace("USD","")));
                        }
                }

                if(document.getElementById(\'spnd\'+rq)) {
                        // $(\'#spnd\'+rq+\'>.fv\').attr(\'innerHTML\',v);
                        $(\'#spnd\'+rq+\'>.fv\').attr(\'innerHTML\',$(\'#vat\'+rq).val());
                        $(\'#spnd\'+rq+\'>.lt\').attr(\'innerHTML\',$.trim(money_format(\'%i\',sum).replace("USD","")));
                }
                settotal();*/
        });

        $(\'input[name="fWithHoldingTax\\[\\]"]\').change(function() {
            var rq = $(this).attr(\'id\').replace(\'fWithHoldingTax\',\'\');
            $(\'#fPrice\'+rq).trigger(\'blur\');
            /*var a  = parseFloat($(\'#fAmount\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var t = parseFloat($(\'#fOtherTax1\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var v = parseFloat($(\'#fVAT\'+rq).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var w = parseFloat($(this).val().replace(new RegExp(\',\', \'g\'),\'\'));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $(\'#vat\'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $(\'#othertax1\'+rq).val(a*t/100); }
                        if(!isNaN(w)) { sum = sum - (a*w/100); $(\'#withholdingtax\'+rq).val(a*w/100); }
                        if(!isNaN(sum)) {
                                $(\'#fLineTotal\'+rq).val($.trim(money_format(\'%i\',sum).replace("USD","")));
                        }
                }
                if(document.getElementById(\'spnd\'+rq)) {
                        // $(\'#spnd\'+rq+\'>.wt\').attr(\'innerHTML\',w);
                        $(\'#spnd\'+rq+\'>.wt\').attr(\'innerHTML\',$(\'#withholdingtax\'+rq).val());
                        $(\'#spnd\'+rq+\'>.lt\').attr(\'innerHTML\',$.trim(money_format(\'%i\',sum).replace("USD","")));
                }
                settotal();*/
        });

        $(\'textarea[name="tDescription\\[\\]"]\').change(function() {
            var rq = $(this).attr(\'id\').replace(\'tDescription\',\'\');
            if(document.getElementById(\'spnd\'+rq)) {
                if($.trim($(this).val()) != \'\') $(\'#spnd\'+rq+\'>.td\').attr(\'innerHTML\',$.trim($(this).val()));
            }
        });

        $(\'[name="vUnitOfMeasure\\[\\]"]\').change(function() {
            var rq = $(this).attr(\'id\').replace(\'vUnitOfMeasure\',\'\');
            if(document.getElementById(\'spnd\'+rq)) {
                // if($.trim($(this).val()) != \'\')
                $(\'#spnd\'+rq+\'>.um\').attr(\'innerHTML\',$.trim($(this).val()));
            }
        });

        $(\'select[name="invoiceType\\[\\]"]\').change(function() {
            var rq = $(this).attr(\'id\').replace(\'eInvoiceType\',\'\');
            if(document.getElementById(\'spnd\'+rq)) {
                if($.trim($(this).val()) != \'\') $(\'#spnd\'+rq+\'>.ot\').attr(\'innerHTML\',$.trim($(this).val()));
            }
            //
            if($(this).val() == \'Discount\' || $(this).val() == \'Charge\') {
				$(\'#spnd\'+rq+\'>.ot\').attr(\'innerHTML\', \'\');
                // alert($(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').closest(\'input\').length);
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').hide();
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').hide();
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').next(\'td\').hide();
                // $(this).closest(\'table[id^="tbl"]\').find(\'input[id^="iQuantity"]\').parent(\'td\').attr(\'width\',\'1\');
                $(this).closest(\'table[id^="tbl"]\').find(\'.dcr\').parent(\'td\').attr(\'width\',\'12.5%\'); 	//
                $(this).closest(\'table[id^="tbl"]\').find(\'.dcr\').html(\'Rate : &nbsp;<font class="reqmsg">*</font>\');
                $(this).closest(\'table[id^="tbl"]\').find(\'[name="eSublineType\\[\\]"]\').val(\'\');
                $(this).closest(\'table[id^="tbl"]\').find(\'[name="eSublineType\\[\\]"]\').trigger(\'change\');
            } else {
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').show();
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').show();
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').next(\'td\').show();
                // $(this).closest(\'table[id^="tbl"]\').find(\'input[id^="iQuantity"]\').parent(\'td\').attr(\'width\',\'154px\');
                $(this).closest(\'table[id^="tbl"]\').find(\'.dcr\').parent(\'td\').attr(\'width\',\'111\');
                $(this).closest(\'table[id^="tbl"]\').find(\'.dcr\').html(\'Price : &nbsp;<font class="reqmsg">*</font>\');
            }
            var id = $(this).attr(\'id\').replace(\'eInvoiceType\',\'\');
            $(\'#fPrice\'+rq).trigger(\'blur\');
            $(\'div[id*="Div"]\').find(\'[name="fPrice\\[\\]"]\').trigger(\'blur\');
            //
        });
        //
        $.each($(\'select[name="invoiceType\\[\\]"]\'), function() {
            /*if($(this).val() == \'Discount\' || $(this).val() == \'Charge\') {
                        // alert($(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').length);
                        $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').hide();
                        $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').next(\'td\').hide();
                        $(this).closest(\'table[id^="tbl"]\').find(\'input[id^="iQuantity"]\').parent(\'td\').attr(\'width\',\'1\');
                } else {
                        $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').show();
                        $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').next(\'td\').show();
                        $(this).closest(\'table[id^="tbl"]\').find(\'input[id^="iQuantity"]\').parent(\'td\').attr(\'width\',\'154px\');
                }*/
            if($(this).val() == \'Discount\' || $(this).val() == \'Charge\') {
                // alert($(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').closest(\'input\').length);
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').hide();
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').hide();
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').next(\'td\').hide();
                // $(this).closest(\'table[id^="tbl"]\').find(\'input[id^="iQuantity"]\').parent(\'td\').attr(\'width\',\'1\');
                $(this).closest(\'table[id^="tbl"]\').find(\'.dcr\').parent(\'td\').attr(\'width\',\'12.5%\'); 	//
                $(this).closest(\'table[id^="tbl"]\').find(\'.dcr\').html(\'Rate : &nbsp;<font class="reqmsg">*</font>\');
                $(this).closest(\'table[id^="tbl"]\').find(\'[name="eSublineType\\[\\]"]\').val(\'\');
                $(this).closest(\'table[id^="tbl"]\').find(\'[name="eSublineType\\[\\]"]\').trigger(\'change\');
            } else {
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').show();
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').show();
                $(this).closest(\'table[id^="tbl"]\').find(\'.ndcf\').parent(\'td\').next(\'td\').show();
                // $(this).closest(\'table[id^="tbl"]\').find(\'input[id^="iQuantity"]\').parent(\'td\').attr(\'width\',\'154px\');
                $(this).closest(\'table[id^="tbl"]\').find(\'.dcr\').parent(\'td\').attr(\'width\',\'111\');
                $(this).closest(\'table[id^="tbl"]\').find(\'.dcr\').html(\'Price : &nbsp;<font class="reqmsg">*</font>\');
            }
        });
        // alert($(\'select[name="invoiceType\\[\\]"] option:selected[value="Discount"]\').length);
    });

    function shwtbl(vl) {
        var vl = parseInt(vl);
        var dvnm = \'\';

        $(\'div [id*="Div"]\').hide();
        $(\'#Div\'+vl).show();
        cr = vl;

        for(var h=0; h<i; h++) {
            if(document.getElementById(\'vUnitOfMeasure\'+h) && h!=vl) {
                if($("#frmadd").validate().element(\'#vUnitOfMeasure\'+h)==false || $("#frmadd").validate().element(\'#fAmount\'+h)==false || $("#frmadd").validate().element(\'#fLineTotal\'+h)==false) {
                    $(\'#Div\'+h).attr(\'innerHTML\',\'\');
                }
            }
        }
    }
    function deltbl(vl) {
        // alert(vl);
        if($(\'#tbl\'+vl)) {
            $(\'#Div\'+vl).attr(\'innerHTML\',\'\');
        }
        if($(\'#spnd\'+vl)) {
            $(\'#spnd\'+vl).attr(\'innerHTML\',\'\');
            $(\'#spnd\'+vl).remove();
        }

        if(cr == vl) {
            if($(\'#tbl\'+(vl-1))) {
                // $(\'#Div\'+(vl-1)).show();
            } else if($(\'#tbl\'+(vl+1))) {
                // $(\'#Div\'+(vl+1)).show();
            } else {
                // addrow();
            }
        }

        $(\'#Div\'+vl).hide();
        if($(\'div [id*="spnd"]\').length<1) {
            if(document.getElementById(\'nli\')) {
                $(\'#nli\').show();
            } else {
                $(\'#dlines\').attr(\'innerHTML\',"<div id=\'nli\' align=\'center\'><br /><b>';  echo $this->_tpl_vars['LBL_NO_LINE_ITEMS'];  echo '</b></div>");
            }
        } else {
            $(\'#nli\').hide();
        }

        $(document).ready( function() {
            $(function() {
                var ead=10;
                $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
            });
        });
        settotal();
        $.each($(\'div[id*="Div"]\'), function(l) {
            var sbtyp = $(this).find(\'[name="invoiceType\\[\\]"]\');
            if(sbtyp.val() == \'Discount\' || sbtyp.val() == \'Charge\') {
                $(this).find(\'[name="fPrice\\[\\]"]\').trigger(\'blur\');
            }
        });
    }

    ';  if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['invitems']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '
    function findPOValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split(\'</span>\');
        totValID = totVal[0].replace("<span style=\'display:none\'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split(\'_\');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
        $(\'#iRelatedPurchaseOrderLineID0\'+\'';  echo $this->_sections['i']['index'];  echo '\').val(totValID); 	//
        var url = SITE_URL+"index.php?file=m-aj_getItemDetails";
        var pars = "&table="+PRJ_DB_PREFIX+"_purchase_order_line"+"&iId=iOrderLineID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=";
        //alert(url+pars); return false;
        $(\'#spn\').load(url+pars);
        // $.ajax({type:"post", url:url, data:pars, success:getDetails});
        //alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }

    function selectPOItem(li) {
        findPOValue(li);
    }

    /*$(document).ready(function() {
        $("#POItemCode").autocomplete(
                SITE_URL+"index.php?file=u-aj_getInvPoItem&iPOId="+$(\'#iPurchaseOrderID\').val(),
                {
                        delay:10,
                        minChars:1,
                        matchSubset:1,
                        matchContains:1,
                        cacheLength:10,
                        onItemSelect:selectPOItem,
                        onFindValue:findPOValue,
                        formatItem:formatItem,
                        autoFill:false
                }
        );
});
     */
    // SITE_URL+"index.php?file=or-aj_getInvPo&orgid="+$(\'#iSupplierOrganizationID\').val(),


    function formatItem(row) {
        var totVal = row[0];
        var totValID;
        var totValRes;
        totVal = totVal.split(\'</span>\');
        totValID = totVal[0].replace("<span style=\'display:none\'>");
        totValRes = totVal[1];
        return totValRes;
    }
    function findUserValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split(\'</span>\');
        totValID = totVal[0].replace("<span style=\'display:none\'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split(\'_\');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
        //	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }
    function selectUsrItem(li) {
        findUserValue(li);
    }

    function setuser()
    {
        $("#POItemCode0"+\'';  echo $this->_sections['i']['index'];  echo '\').autocomplete(
        SITE_URL+"index.php?file=u-aj_getInvPoItem&iPOId="+$("#iPurchaseOrderID0"+\'';  echo $this->_sections['i']['index'];  echo '\').val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectPOItem,
            onFindValue:findPOValue,
            formatItem:formatItem,
            autoFill:false
        }
    );
    }

    function findValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split(\'</span>\');
        totValID = totVal[0].replace("<span style=\'display:none\'>","");
        totValRes = totVal[1];
        $("#iPurchaseOrderID0"+\'';  echo $this->_sections['i']['index'];  echo '\').val(totValID);
        //$(\'#result\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != \'\') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    $("#purchaseOrder0"+\'';  echo $this->_sections['i']['index'];  echo '\').autocomplete(
    SITE_URL+"index.php?file=u-aj_getInvPo",
    {
        delay:10,
        minChars:1,
        matchSubset:1,
        matchContains:1,
        cacheLength:10,
        onItemSelect:selectItem,
        onFindValue:findValue,
        formatItem:formatItem,
        autoFill:false
    }
);
    ';  endfor; else:  echo '
    function findPOValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split(\'</span>\');
        totValID = totVal[0].replace("<span style=\'display:none\'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split(\'_\');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
        $(\'#iRelatedPurchaseOrderLineID00\').val(totValID); 	//
        var url = SITE_URL+"index.php?file=m-aj_getItemDetails";
        var pars = "&table="+PRJ_DB_PREFIX+"_purchase_order_line"+"&iId=iOrderLineID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=";
        //alert(url+pars); return false;
        $(\'#spn\').load(url+pars);
        // $.ajax({type:"post", url:url, data:pars, success:getDetails});
        //alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }

    function selectPOItem(li) {
        findPOValue(li);
    }

    /*$(document).ready(function() {
        $("#POItemCode").autocomplete(
                SITE_URL+"index.php?file=u-aj_getInvPoItem&iPOId="+$(\'#iPurchaseOrderID\').val(),
                {
                        delay:10,
                        minChars:1,
                        matchSubset:1,
                        matchContains:1,
                        cacheLength:10,
                        onItemSelect:selectPOItem,
                        onFindValue:findPOValue,
                        formatItem:formatItem,
                        autoFill:false
                }
        );
});
     */
    // SITE_URL+"index.php?file=or-aj_getInvPo&orgid="+$(\'#iSupplierOrganizationID\').val(),


    function formatItem(row) {
        var totVal = row[0];
        var totValID;
        var totValRes;
        totVal = totVal.split(\'</span>\');
        totValID = totVal[0].replace("<span style=\'display:none\'>");
        totValRes = totVal[1];
        return totValRes;
    }
    function findUserValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split(\'</span>\');
        totValID = totVal[0].replace("<span style=\'display:none\'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split(\'_\');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
        //	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }
    function selectUsrItem(li) {
        findUserValue(li);
    }

    function setuser()
    {
        $("#POItemCode00").autocomplete(
        SITE_URL+"index.php?file=u-aj_getInvPoItem&iPOId="+$("#iPurchaseOrderID00").val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectPOItem,
            onFindValue:findPOValue,
            formatItem:formatItem,
            autoFill:false
        }
    );
    }

    function findValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split(\'</span>\');
        totValID = totVal[0].replace("<span style=\'display:none\'>","");
        totValRes = totVal[1];
        $("#iPurchaseOrderID00").val(totValID);
        //$(\'#result\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != \'\') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    $("#purchaseOrder00").autocomplete(
    SITE_URL+"index.php?file=u-aj_getInvPo",
    {
        delay:10,
        minChars:1,
        matchSubset:1,
        matchContains:1,
        cacheLength:10,
        onItemSelect:selectItem,
        onFindValue:findValue,
        formatItem:formatItem,
        autoFill:false
    }
);
    ';  endif;  echo '

    function resetform()
    {
        $(\'#frmadd\')[0].reset();
    }

    var validator = $("#frmadd").validate({
        /*		rules:{
                        "vItemCode[]": {
                                remote: {
                                        url:SITE_URL+"index.php?file=u-aj_chkdupdata",
               type:"get",
               data:{
                                                val:function() {
                                                        return $("#iInvoiceLineID").val();
                                                },
                                                id:function() {
                                                        return "iInvoiceLineID";
                                                },
                                                field:function() {
                                                        return "vItemCode";
                                                },
                                                table:function() {
                                                        return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_invoice_detail_line";
                                                }
                                        }
                                }
                        }
                },*/
        messages:{
            "eInvoiceType[]": {
                required: LBL_SELECT_INV_TYPE
            },
            /*"vItemCode[]": {
                  required: LBL_ENTER_ITEM_CODE,
                                                remote: jQuery.validator.format(LBL_ITEM_CODE_IN_USE)
               },*/
            "vUnitOfMeasure[]": {
                required: LBL_ENTER_UNIT_OF_MEASURE
            },
            "iQuantity[]": {
                digits: LBL_DIGITS_ONLY
            },
            "fPrice[]": {
                decimals: LBL_DIGITS_ONLY
            },
            "fAmount[]": {
                decimals: LBL_DIGITS_ONLY
            },
            "fVAT[]": {
                decimals: LBL_DIGITS_ONLY
            },
            "fWithHoldingTax[]": {
                decimals: LBL_DIGITS_ONLY
            }
        }
    });


    function chkValid(allel)
    {
        rtn = \'no\';
        $.each(allel,function(i,el){
            var vld = $("#frmadd").validate().element(\'#\'+$(this).attr(\'id\'));
            if(vld === false) {
                rtn = \'yes\';
            }
        });
        return rtn;
    }

    function frmsubmit()
    {
        if(document.getElementById(\'eInvoiceType\'+cr) && !document.getElementById(\'spnd\'+cr)) {
            deltbl(cr);
        }

        var rtn = \'no\';
        var err = \'\';
        allel = $("[name=\'eInvoiceType\\[\\]\']");
        rtn = chkValid(allel);
        if(rtn == \'yes\') { err = rtn; }

        /*	allel = $("[name=vItemCode\\[\\]]");
        rtn = chkValid(allel);
        if(rtn == \'yes\') { err = rtn; } */

        /* allel = $("[name=\'vUnitOfMeasure\\[\\]\']");
        rtn = chkValid(allel);
        if(rtn == \'yes\') { err = rtn; } */

        /* allel = $("[name=\'iQuantity\\[\\]\']");
        rtn = chkValid(allel);
        if(rtn == \'yes\') { err = rtn; } */

        allel = $("[name=\'fPrice\\[\\]\']");
        rtn = chkValid(allel);
        if(rtn == \'yes\') { err = rtn; }

        allel = $("[name=\'fAmount\\[\\]\']");
        rtn = chkValid(allel);
        if(rtn == \'yes\') { err = rtn; }

        allel = $("[name=\'fVAT\\[\\]\']");
        rtn = chkValid(allel);
        if(rtn == \'yes\') { err = rtn; }

        allel = $("[name=\'fWithHoldingTax\\[\\]\']");
        rtn = chkValid(allel);
        if(rtn == \'yes\') { err = rtn; }

        if(err == \'yes\') {
            return false;
        }

        if(! ($("#frmadd").valid())) {
            return false;
        } else {
            // $(\'#addNew\').attr(\'innerHTML\',\'\');
            $("#frmadd").submit();
        }
    }
</script>
'; ?>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jgetinvpoitem.js"></script>
<?php if ($this->_tpl_vars['vldmsg'] != ''): ?>
<?php echo '
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

<?php endif; ?>