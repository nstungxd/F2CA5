<?php /* Smarty version 2.6.0, created on 2012-05-31 11:43:13
         compiled from member/user/purchaseordercreate.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'member/user/purchaseordercreate.tpl', 174, false),array('modifier', 'htmlentities', 'member/user/purchaseordercreate.tpl', 334, false),array('modifier', 'trim', 'member/user/purchaseordercreate.tpl', 376, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<?php echo '
<script type="text/javascript" >
    var stateArr = new Array(';  echo $this->_tpl_vars['stateArr'];  echo ');
    //alert(stateArr);
</script>
'; ?>


<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_CREATE_PURCHASE_ORDER']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                                        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseordercreate" class="current"><em><?php echo $this->_tpl_vars['LBL_PO_HEADER']; ?>
</em></a></li>
                    <li><?php if ($this->_tpl_vars['view'] == 'edit'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
popref/<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
" ><?php else: ?><a><?php endif; ?><em><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</em></a></li>
                    <li><?php if ($this->_tpl_vars['view'] == 'edit'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseorderadditems/<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
" ><?php else: ?><a><?php endif; ?><em><?php echo $this->_tpl_vars['LBL_LINE_ITEM']; ?>
</em></a></li>
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
index.php?file=u-purchaseordercreate_a"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" value="<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
" />
                        <input type="hidden" name="iPOID" id="iPOID" value="<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
" />
                        <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
                        <input type="hidden" name="Data[eFrom]" id="eFrom" value="" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b><?php echo $this->_tpl_vars['var_msg']; ?>
</b></font></td></tr>
                            <tr>
                                <td width="225"><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMP_NAME']; ?>
</td>
                                <td>:</td>
                                <td class="blue-ore"><?php echo $this->_tpl_vars['orgname']; ?>
</td>
                            </tr>
                            <tr>
                                <td width="225"><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
 </td>
                                <td>:</td>
                                <td class="blue-ore">
                                    <?php echo $this->_tpl_vars['OrgCode']; ?>

                                    <input type="hidden" name="iBuyerOrganizationID" id="iBuyerOrganizationID" value="<?php echo $this->_tpl_vars['curORGID']; ?>
" />
                                </td>
                            </tr>
                                                                                                                                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <!-- <input type="text" name="Data[vSupplierName]" class="input-rag" id="vSupplierName" tabindex="4" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER_NAME']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vSupplierName']; ?>
" />
                                      <input type="hidden" name="Data[iSupplierOrganizationID]" id="iSupplierOrganizationID" class="required" value="<?php echo $this->_tpl_vars['podtls'][0]['iSupplierOrganizationID']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER_NAME']; ?>
"/>
                                      &nbsp;<?php echo $this->_tpl_vars['LBL_AUTO_COMPLATE']; ?>
-->
                                    <span id="compcombo" style="float:left;">
                                        <select name="Data[iSupplierOrganizationID]" class="required" id="iSupplierOrganizationID" style="width:230px" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
" onchange="return getorgbilldetails(this.value)">                                             <option value="">---<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
---</option>
                                            <?php if ($this->_tpl_vars['view'] == 'edit'): ?>
                                            <option value="<?php echo $this->_tpl_vars['sorgdtls'][0]['iOrganizationID']; ?>
" selected="selected"><?php echo $this->_tpl_vars['sorgdtls'][0]['vCompanyName']; ?>
</option>
                                            <?php endif; ?>
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="compcode" id="compcode" value="(<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
)" onfocus="if(this.value=='(<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
)')this.value='';" onblur="if(this.value=='')this.value='(<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
)';" style="width:170px; height:17px;" />
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background:#f8f8f8;border:none;" onclick="return getComboVal('org');" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PO_BUYER_CODE']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vPoBuyerCode]" class="input-rag required" id="vPoBuyerCode" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PO_BUYER_CODE']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vPoBuyerCode']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[vSupplierContactParty]" class="input-rag" id="supplierID" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vSupplierContactParty']; ?>
" />
                                                                                                        </td>
                            </tr>

                            <!--       <tr>
                                       <td><?php echo $this->_tpl_vars['LBL_ORDER_DATE']; ?>
 </td>
                                       <td>:</td>
                                       <td>
                                           <input type="text" name="Data[dOrderDate]" readonly class="input-rag" id="dOrderDate" tabindex="6" style="width:190px;" value="<?php echo $this->_tpl_vars['podtls'][0]['dOrderDate']; ?>
" />
                                           &nbsp;<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-calander.gif" />
                                       </td>
                                   </tr>       -->
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_ORDER_DESCRIPTION']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[tOrderDescription]" class="input-rag" id="tOrderDescription" style="width:228px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['podtls'][0]['tOrderDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_REFERENCE_NUMBER']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vRegisterNumber]" class="input-rag" id="vRegisterNumber" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_REFERENCE_NUMBER']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vRegisterNumber']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_OPENING_UNIT']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[iOpeningUnit]" class="input-rag" id="iOpeningUnit" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_OPENING_UNIT']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['iOpeningUnit']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_ORDER_NUMBER']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vSupplierOrderNum]" class="input-rag"  id="vSupplierOrderNum" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_ORDER_NUMBER']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vSupplierOrderNum']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_CARRIER']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[tCarrier]" class="input-rag" id="tCarrier" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['tCarrier']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_LINE_ITEM_TAX']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>                                    <?php echo $this->_tpl_vars['lineItemTax']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fVAT]" class="input-rag decimals" id="fVAT" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_VAT']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['fVAT']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fOther_tax_1]" class="input-rag decimals" id="fOther_tax_1" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['fOther_tax_1']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_PARTY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToParty]" class="input-rag required" id="vShipToParty" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_PARTY']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vShipToParty']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
1 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToAddressLine1]" class="input-rag required" id="vShipToAddressLine1" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vShipToAddressLine1']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
2 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToAddressLine2]" class="input-rag" id="vShipToAddressLine2" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vShipToAddressLine2']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CITY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToCity]" class="input-rag required" id="vShipToCity" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CITY']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vShipToCity']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[vShipToCountry]" id="vShipToCountry" class="drop-down required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
&nbsp;<?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
" onchange="getRelativeCombo(this.value,'<?php echo $this->_tpl_vars['podtls'][0]['vShipToState']; ?>
','vShipToState','-- <?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
 --',stateArr);fillCountryCode(this);" style="width:230px;">
                                        <option value=""> --- <?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
 --- </option>
                                        <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['db_country']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <option title="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['iCountryISD']; ?>
" value="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']; ?>
" <?php if ($this->_tpl_vars['podtls'][0]['vShipToCountry'] == $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']): ?> selected <?php endif; ?> ><?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountry']; ?>
</option>
                                        <?php endfor; endif; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><!--<input type="text" name="Data[vShipToState]" class="input-rag required" id="vShipToState" tabindex="27" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
" style="width:228px;" />-->
                                    <select name ="Data[vShipToState]" id="vShipToState" style="width:230px" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
" class="required" >
                                        <option value=""><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
 </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToZipCode]" class="input-rag required" id="vShipToZipCode" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vShipToZipCode']; ?>
" maxlength="10" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToContactParty]" class="input-rag required" id="vShipToContactParty" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vShipToContactParty']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td valign="top"><input type="text" name="vShipToContactTelephoneCode"  value="<?php echo $this->_tpl_vars['podtls'][0]['vShipToContactTelephoneCode']; ?>
" class="countryCode input-rag" id="vShipToContactTelephoneCode" style="width:30px;" maxlength="3" onkeypress="return chkValidPhone(event)" title="<?php echo $this->_tpl_vars['LBL_TELEPHONE_CODE']; ?>
"/>
                                    <input type="text" name="Data[vShipToContactTelephone]" class="input-rag required" id="vShipToContactTelephone" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE']; ?>
" onkeypress="return chkValidPhone(event)" style="width:190px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vShipToContactTelephone']; ?>
" maxlength="15" />
                                </td></tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
  <?php echo $this->_tpl_vars['LBL_PARTY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToParty]" class="input-rag required" id="vBillToParty" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
  <?php echo $this->_tpl_vars['LBL_PARTY']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vBillToParty']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
1 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToAddLine1]" class="input-rag required" id="vBillToAddLine1" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vBillToAddLine1']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
2 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToAddLine2]" class="input-rag" id="vBillToAddLine2" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vBillToAddLine2']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CITY']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToCity]" class="input-rag required" id="vBillToCity" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CITY']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vBillToCity']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[vBillToCountry]" id="vBillToCountry" class="drop-down required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
&nbsp;<?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
" onchange="getRelativeCombo(this.value,'<?php echo $this->_tpl_vars['podtls'][0]['vBillToState']; ?>
','vBillToState','-- <?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
 --',stateArr);fillCountryCode(this);" style="width:230px;">
                                        <option value=""> --- <?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
 --- </option>
                                        <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['db_country']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <option value="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']; ?>
"  title="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['iCountryISD']; ?>
"  currency="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['iCurrencyID']; ?>
" <?php if ($this->_tpl_vars['podtls'][0]['vBillToCountry'] == $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']): ?> selected <?php endif; ?> ><?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountry']; ?>
</option>
                                        <?php endfor; endif; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><!--<input type="text" name="Data[vBillToState]" class="input-rag required" id="vBillToState" tabindex="36" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
" style="width:228px;" />-->
                                    <select name ="Data[vBillToState]" id="vBillToState" style="width:230px" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
" class="required" >
                                        <option value=""><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
 </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToZipCode]" class="input-rag required" id="vBillToZipCode" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vBillToZipCode']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToContactParty]" class="input-rag required" id="vBillToContactParty" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['vBillToContactParty']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td valign="top"><input type="text" name="vBillToContactTelephoneCode"  value="<?php echo $this->_tpl_vars['podtls'][0]['vBillToContactTelephoneCode']; ?>
" class="countryCode input-rag" id="vBillToContactTelephoneCode" style="width:30px;" maxlength="3" onkeypress="return chkValidPhone(event)" title="<?php echo $this->_tpl_vars['LBL_TELEPHONE_CODE']; ?>
"/>
                                    <input type="text" name="Data[vBillToContactTelephone]" class="input-rag required" id="vBillToContactTelephone" style="width:190px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE']; ?>
" onkeypress="return chkValidPhone(event)" value="<?php echo $this->_tpl_vars['podtls'][0]['vBillToContactTelephone']; ?>
" maxlength="15" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[vCurrency]" id="vCurrency" class="required" style="width:96px;" title="Enter Currency" >
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
                                        <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
" id="<?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['iCurrencyID']; ?>
_1" <?php if ($this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode'] == $this->_tpl_vars['podtls'][0]['vCurrency']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode']; ?>
</option>
                                        <?php endfor; endif; ?>
                                    </select>
                                                                    </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PO_TOTAL']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fPOTotal]" class="input-rag decimals" id="fPOTotal" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PO_TOTAL']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['fPOTotal']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PRE_PAYMENT']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fPrepayment]" class="input-rag decimals" id="fPrepayment" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PRE_PAYMENT']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['podtls'][0]['fPrepayment']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_ATTACH_DOCUMENT']; ?>
</td>
                                <td valign="top">:</td>
                                <td>
                                    <span id="uplad_file_span"><input type="file" name="upload" id="upload" /></span>
                                    <div id="files_list" class="file_upload">
                                        <ul style="list-style-type: none">
                                            <?php if (count($_from = (array)$this->_tpl_vars['poAttachments'])):
    foreach ($_from as $this->_tpl_vars['poAttach']):
?>
                                            <li>
                                                <a href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
upload/attachment_docs/po/<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
/<?php echo $this->_tpl_vars['poAttach']['vFile']; ?>
')" > <?php echo $this->_tpl_vars['poAttach']['vFile']; ?>
</a> &nbsp; <input type="button" value="Delete" onclick="deleteFile($(this).parent(),'<?php echo $this->_tpl_vars['poAttach']['iAttachmentID']; ?>
');">
                                            </li>
                                            <?php endforeach; unset($_from); endif; ?>
                                        </ul>
                                        <input type="hidden" id="deleteFiles" name="deleteFiles" />
                                    </div>
                                </td>
                            </tr>
                            <?php if ($this->_tpl_vars['podtls'][0]['eSaved'] != 'No' || $this->_tpl_vars['poad'] == 'yes'): ?>
                            <tr>
                                <td></td>
                                <td ></td>
                                <td >
                                    <input type="hidden" name="Data[eSaved]"  id="eSaved" value="<?php echo $this->_tpl_vars['podtls'][0]['eSaved']; ?>
" />
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php if (((is_array($_tmp=$this->_tpl_vars['podtls'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && $this->_tpl_vars['podtls'][0]['eStatus'] == $this->_tpl_vars['rjtsts']): ?>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;"><?php echo ((is_array($_tmp=$this->_tpl_vars['podtls'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</div></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="2" height="5"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-next.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes'); $('#eFrom').val('Next'); return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                    <a href="javascript:reset()" ><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reset.gif" alt="" border="0"   style="vertical-align:middle;"/></a>
                                    <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist/<?php echo $GLOBALS['_SESSION']['polvl']; ?>
" ><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-cancel.gif" alt="" border="0" style="vertical-align:middle;"/></a> &nbsp;
                                    <?php if ($this->_tpl_vars['podtls'][0]['eSaved'] != 'No' && $this->_tpl_vars['view'] != ''): ?> <!--|| $poad eq 'yes'-->
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
save-btn.gif" alt="" border="0"  id="btnSave" name="Save" title="save" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes'); return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                    <?php endif; ?>
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

<script language="JavaScript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="<?php echo $this->_tpl_vars['SITE_CSS']; ?>
jquery.autocomplete.css" />

<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
jquery.dynDateTime.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
css/calendar-blue.css"  />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jgetpoinv.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jpocreate.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_CONTENT_JS']; ?>
multifile.js"></script>
<?php echo '
<script type="text/javascript">
    var corg = \'';  echo $this->_tpl_vars['curORGID'];  echo '\';
    var sid = \'';  echo $this->_tpl_vars['sid'];  echo '\';
    var view = \'';  echo $this->_tpl_vars['view'];  echo '\';
    var org = $(\'#vSupplierName\').val();

    function submitFrm()
    {
        $(\'#frmadd\').submit();
        $(document).ready( function() {
            $(function() {
                var ead=10;
                $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
            });
        });
    }
    function reset(){
        $("#frmadd")[0].reset();
    }
    if(view != \'edit\') {
        $("#frmadd").validate({
            rules: {
                "Data[vShipToContactTelephone]":{
                    required: function(){
                        if($.trim($(\'#vShipToContactTelephoneCode\').val()) == \'\'){
                            $(\'#vShipToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_COUNTRY_CODE'];  echo '");
                        }else {
                            $(\'#vShipToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE'];  echo '");
                        }
                    }
                },
                "Data[vBillToContactTelephone]":{
                    required: function(){
                        if($.trim($(\'#vBillToContactTelephoneCode\').val()) == \'\'){
                            $(\'#vBillToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_COUNTRY_CODE'];  echo '");
                        }else {
                            $(\'#vBillToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE'];  echo '");
                        }
                    }
                },
                "Data[vPoBuyerCode]": {
                    remote:{
                        url:SITE_URL+"index.php?file=u-aj_chkdupdata"+"&extfld=iBuyerOrganizationID&extval="+corg,
                        type:"get",
                        data:{
                            val:function() {
                                return $("#iPurchaseOrderID").val();
                            },
                            id:function() {
                                return "iPurchaseOrderID";
                            },
                            field:function() {
                                return "vPoBuyerCode";
                            },
                            table:function() {
                                return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_purchase_order_heading";
                            }
                        }
                    }
                }
            },
            messages: {
                "Data[fPOTotal]": {
                    decimals: LBL_DIGITS_ONLY
                },
                "Data[fPrepayment]": {
                    decimals: LBL_DIGITS_ONLY
                },
                "Data[fVAT]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fOther_tax_1]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[vPoBuyerCode]": {
                    required: LBL_ENTER_PO_BUYER_CODE,
                    remote: jQuery.validator.format(LBL_PO_BUYER_CODE_INUSE)
                }
            }
        });
    } else {
        $("#iSupplierID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+"';  echo $this->_tpl_vars['podtls'][0]['iSupplierOrganizationID'];  echo '"+"&htmlTag=option&orgtype=supplier"+"&val=';  echo $this->_tpl_vars['podtls'][0]['iSupplierID'];  echo '")

        $("#frmadd").validate({
            rules:{
                "Data[vShipToContactTelephone]":{
                    required: function(){
                        if($.trim($(\'#vShipToContactTelephoneCode\').val()) == \'\'){
                            $(\'#vShipToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_COUNTRY_CODE'];  echo '");
                        }else {
                            $(\'#vShipToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE'];  echo '");
                        }
                    }
                },"Data[vBillToContactTelephone]":{
                    required: function(){
                        if($.trim($(\'#vBillToContactTelephoneCode\').val()) == \'\'){
                            $(\'#vBillToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_COUNTRY_CODE'];  echo '");
                        }else {
                            $(\'#vBillToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE'];  echo '");
                        }
                    }
                }
            }

        });
    }
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
        $(\'#iSupplierID\').val(totValID);
        //	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }
    function selectUsrItem(li) {
        findUserValue(li);
    }
    function setuser()
    {
        $("#supplierID").autocomplete(
        SITE_URL+"index.php?file=u-aj_getUser&icompid="+$(\'#iSupplierOrganizationID\').val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectUsrItem,
            onFindValue:findUserValue,
            formatItem:formatItem,
            autoFill:false
        });
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
        $(\'#iSupplierOrganizationID\').val(totValID);
        $(\'#supplierID\').val(\'\');
        //$(\'#result\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != \'\') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    function setSuplierOrg()
    {
        $("#vSupplierName").autocomplete(
        SITE_URL+"index.php?file=or-aj_getOrganization&orgid="+$(\'#iBuyerOrganizationID\').val()+"&assoc="+$(\'#vAssocCode\').val()+"&orgtype=supplier",
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
    }

    function findAsocValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split(\'</span>\');
        totValID = totVal[0].replace("<span style=\'display:none\'>","");
        totValRes = totVal[1];
        var vAsocCode=totValID.split(\'_\');
        totValID=vAsocCode[0];
        vAsocCode=vAsocCode[1];
        $(\'#vAssocCode\').val(totValID);
        // alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        // $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
        $(\'#vSupplierName\').unbind().autocomplete();
        $(\'#supplierID\').unbind().autocomplete();
        setSuplierOrg();
    }
    function selectAsocItem(li) {
        findAsocValue(li);
    }

    function setAsocs() {
        $("#vAssociationCode").autocomplete(
        SITE_URL+"index.php?file=or-aj_getAssociation&orgid="+$(\'#iBuyerOrganizationID\').val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectAsocItem,
            onFindValue:findAsocValue,
            formatItem:formatItem,
            autoFill:false
        }
    );
    }

    // if(org == \'\') {
    $(document).ready(function() {
        setAsocs();
        // $(\'#vSupplierName\').unbind().autocomplete();
        setSuplierOrg();
        $(\'#vAssociationCode\').blur(function(event){
            if($.trim($(\'#vAssociationCode\').val()) == \'\') {
                $(\'#vAssocCode\').val(\'\');
                $(\'#vSupplierName\').unbind().autocomplete();
                // $(\'#supplierID\').unbind().autocomplete();
                setSuplierOrg();
            }
        });
		//
		// getRelativeCombo($(\'#vSupplierCountry\').val(),"';  echo $this->_tpl_vars['userData']['vSupplierState'];  echo '",\'vSupplierState\',\'---';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
---<?php echo '\',stateArr);
		getRelativeCombo($(\'#vShipToCountry\').val(),"';  echo $this->_tpl_vars['podtls'][0]['vShipToState'];  echo '",\'vShipToState\',\'---';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
---<?php echo '\',stateArr);
		getRelativeCombo($(\'#vBillToCountry\').val(),"';  echo $this->_tpl_vars['podtls'][0]['vBillToState'];  echo '",\'vBillToState\',\'---';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
---<?php echo '\',stateArr);
		//$(\'#iSupplierOrganizationID\').load(SITE_URL+"index.php?file=or-aj_getOrganization"+"&assoc="+$(\'#vAssocCode\').val()+"&orgtype=supplier"+"&htmlTag=option"+"&val="+\'';  echo $this->_tpl_vars['podtls'][0]['iSupplierOrganizationID'];  echo '\');
		// fillPoData($(\'#vPOCode option:selected\').attr(\'id\'));
		// fillPoData($(\'#iInvoiceID option:selected\').attr(\'id\'));
		//
    });
    // }
    // setSuplierOrg();

    jQuery(document).ready(function() {
        jQuery("#dOrderDate").dynDateTime({
            showsTime: true,
            ifFormat: "%Y-%m-%d %H:%M:00",
            daFormat: "%l;%M %p, %e %m,  %Y",
            align: "TL",
            electric: false,
            singleClick: false,
            button:".next()",
            displayArea: ".siblings(\'.dtcDisplayArea\')"
        });
    });

    function fillCountryCode(obj)
    {    var opt=obj.options[obj.selectedIndex];
        if(obj.id == \'vShipToCountry\')
        {
            $(\'#vShipToContactTelephoneCode\').val(opt.title);
        }else{
            var currency=opt.getAttribute("currency");
            $(\'#vBillToContactTelephoneCode\').val(opt.title);
            $(\'#vCurrency option[id="\'+currency+\'_1"]\').attr("selected","selected");
        }
    }
    var fileArr=new Array();
    function deleteFile(obj,fileid)
    {
        fileArr.push(fileid);
        $(\'#deleteFiles\').val(fileArr);
        obj.html("");
    }
    if(document.getElementById(\'upload\'))
    {
        var multiSelect = new MultiSelector( document.getElementById(\'files_list\'), 3);
        multiSelect.addElement(document.getElementById(\'upload\'));
    }
    function setT()
    {
        if($(\'#eLineItemTax\').val()==\'Yes\') {
            $(\'#fVAT\').val(\'\');
            $(\'#fOther_tax_1\').val(\'\');
            $(\'#fVAT\').attr(\'disabled\',\'disabled\');
            $(\'#fOther_tax_1\').attr(\'disabled\',\'disabled\');
            $(\'#fVAT\').css(\'background-color\',\'#eeeeee\');
            $(\'#fOther_tax_1\').css(\'background-color\',\'#eeeeee\');
        } else {
            $(\'#fVAT\').attr(\'disabled\',\'\');
            $(\'#fOther_tax_1\').attr(\'disabled\',\'\');
            $(\'#fVAT\').css(\'background-color\',\'#ffffff\');
            $(\'#fOther_tax_1\').css(\'background-color\',\'#ffffff\');
        }
    }
    $(document).ready(function(){
        setT();
    });
    function getorgbilldetails(vl) {
        pars = "&orgid="+vl+"&type=sup"+"&frm=po";
        url = SITE_URL+"index.php?file=m-aj_getOrgBillDetails";
        $(\'#sn\').load(url+pars);
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