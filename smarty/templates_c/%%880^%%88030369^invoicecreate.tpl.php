<?php /* Smarty version 2.6.0, created on 2015-06-22 13:05:22
         compiled from member/user/invoicecreate.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'member/user/invoicecreate.tpl', 106, false),array('modifier', 'count', 'member/user/invoicecreate.tpl', 106, false),array('modifier', 'stripslashes', 'member/user/invoicecreate.tpl', 196, false),array('modifier', 'calcLTzTime', 'member/user/invoicecreate.tpl', 260, false),array('modifier', 'substr', 'member/user/invoicecreate.tpl', 275, false),array('modifier', 'htmlentities', 'member/user/invoicecreate.tpl', 374, false),array('modifier', 'trim', 'member/user/invoicecreate.tpl', 465, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<?php echo '
<script type="text/javascript" >
    var stateArr = new Array(';  echo $this->_tpl_vars['stateArr'];  echo ');
    //alert(stateArr);
</script>
'; ?>


<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_CREATE_INVOICE']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicecreate" class="current"><EM><?php echo $this->_tpl_vars['LBL_CREATE_INVOICE']; ?>
</EM></a></li>
                    <li><?php if ($this->_tpl_vars['view'] == 'edit'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invpref/<?php echo $this->_tpl_vars['iInvoiceID']; ?>
" ><?php else: ?><a><?php endif; ?><em><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</em></a></li>
                    <li><?php if ($this->_tpl_vars['view'] == 'edit'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceadditems/<?php echo $this->_tpl_vars['iInvoiceID']; ?>
" ><?php else: ?><a><?php endif; ?><EM><?php echo $this->_tpl_vars['LBL_ADD_ITEM']; ?>
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
index.php?file=u-invoicecreate_a"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="<?php echo $this->_tpl_vars['iInvoiceID']; ?>
" />
                        <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
                        <input type="hidden" name="frmbuyer" id="frmbuyer" value="<?php echo $this->_tpl_vars['frmbuyer']; ?>
" />
                        <input type="hidden" name="Data[eFrom]" id="eFrom" value="" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b><?php echo $this->_tpl_vars['var_msg']; ?>
</b></font></td></tr>
                                                        <?php if ($this->_tpl_vars['frmbuyer'] == 'n' && $this->_tpl_vars['invdtls'][0]['eCreateByBuyer'] != 'Yes'): ?>
                            <tr>
                                <td width="225"><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMP_NAME']; ?>
</td>
                                <td>:</td>
                                <td class="blue-ore"><?php echo $this->_tpl_vars['orgname']; ?>
</td>
                            </tr>
                            <tr>
                                <td width="225"><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
 </td>
                                <td>:</td>
                                <td class="blue-ore">
                                    <?php echo $this->_tpl_vars['OrgCode']; ?>

                                    <input type="hidden" name="Data[vInvoiceSupplierCode]" id="vInvoiceSupplierCode" value="<?php echo $this->_tpl_vars['OrgCode']; ?>
" />
                                    <input type="hidden" name="iSupplierOrganizationID" id="iSupplierOrganizationID" value="<?php echo $this->_tpl_vars['curORGID']; ?>
" />
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td width="225"><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMP_NAME']; ?>
</td>
                                <td>:</td>
                                <td class="blue-ore">
                                    <span id="scompcombo" style="float:left;">
                                        <select name="Data[iSupplierOrganizationID]" id="iSupplierOrganizationID" style="width: 230px;" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
" onchange="// return getorgbilldetails(this.value)" >                                             <option value="">---<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
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
                                    <input type="text" name="scompcode" id="scompcode" value="(<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
)" onfocus="if(this.value=='(<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
)')this.value='';" onblur="if(this.value=='')this.value='(<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
)';" style="width:170px; height:17px;" />
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background:#f8f8f8;border:none;" onclick="return getComboVal('sborg');" />
                                </td>
                            </tr>
                            <?php endif; ?>
                                                        <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PO_CODE']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <!--<input type="text" name="purchaseOrder" class="input-rag" id="purchaseOrder" tabindex="2" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vPOCode']; ?>
" />
                                    <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" onchange="fillInvData(this.options[this.selectedIndex].id)" class="" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
" value="<?php echo $this->_tpl_vars['invdtls'][0]['iPurchaseOrderID']; ?>
" />
                                    &nbsp;<?php echo $this->_tpl_vars['LBL_AUTO_COMPLATE']; ?>
-->
                                    <span id="pocombo" style="float:left;">
                                        <select name="Data[iPurchaseOrderID]" id="iPurchaseOrderID" style="width: 230px;" onchange="fillPOData(this.options[this.selectedIndex].id)" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
" >                                             <option value="">---<?php echo $this->_tpl_vars['LBL_SELECT_PO']; ?>
---</option>
                                            <?php if (((is_array($_tmp=$this->_tpl_vars['podl'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['podl']) > 0): ?>
                                            <option value="<?php echo $this->_tpl_vars['podl'][0]['iPurchaseOrderID']; ?>
" selected="selected"><?php echo $this->_tpl_vars['podl'][0]['vPOCode']; ?>
</option>
                                            <?php endif; ?>
                                                                                    </select>
                                    </span>&nbsp;
                                    <input type="text" name="poc" id="poc" value="(<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PO_BUYER_CODE']; ?>
)" onfocus="if(this.value=='(<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PO_BUYER_CODE']; ?>
)')this.value='';" onblur="if(this.value=='')this.value='(<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PO_BUYER_CODE']; ?>
)';" style="width:170px; height:17px;" />
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="return getComboVal('po');" />
                                </td>
                            </tr>
                            <tr id="ep">
                                <td><?php echo $this->_tpl_vars['LBL_EXTERNAL_PO_CODE']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[vExtPOCode]" id="vExtPOCode" value="<?php echo $this->_tpl_vars['invdtls'][0]['vExtPOCode']; ?>
" />
                                </td>
                            </tr>
                                                        <?php if ($this->_tpl_vars['frmbuyer'] == 'n' && $this->_tpl_vars['invdtls'][0]['eCreateByBuyer'] != 'Yes'): ?>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <!--<input type="text" name="Data[vBuyerName]" class="input-rag" id="vBuyerName" tabindex="3" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER_NAME']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vBuyerName']; ?>
" />
                                    <input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" class="required" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER_NAME']; ?>
" value="<?php echo $this->_tpl_vars['invdtls'][0]['iBuyerOrganizationID']; ?>
" />
                                            &nbsp;<?php echo $this->_tpl_vars['LBL_AUTO_COMPLATE']; ?>
-->
                                    <span id="compcombo" style="float:left;">
                                        <select name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" style="width:230px;" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
" onchange="return getorgbilldetails(this.value)" >                                             <option value="">---<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
---</option>
                                            <?php if ($this->_tpl_vars['view'] == 'edit'): ?>
                                            <option value="<?php echo $this->_tpl_vars['borgdtls'][0]['iOrganizationID']; ?>
" selected="selected"><?php echo $this->_tpl_vars['borgdtls'][0]['vCompanyName']; ?>
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
                            <?php else: ?>
                            <tr>
                                <td width="225"><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
</td>
                                <td>:</td>
                                <td class="blue-ore"><?php echo $this->_tpl_vars['borgname']; ?>
</td>
                            </tr>
                            <tr>
                                <td width="225"><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
 </td>
                                <td>:</td>
                                <td class="blue-ore">
                                    <?php echo $this->_tpl_vars['bOrgCode']; ?>

                                    <input type="hidden" name="Data[vAssociatePOBuyerCode]" id="vAssociatePOBuyerCode" value="<?php echo $this->_tpl_vars['bOrgCode']; ?>
" />
                                    <input type="hidden" name="iBuyerOrganizationID" id="iBuyerOrganizationID" value="<?php echo $this->_tpl_vars['curORGID']; ?>
" />
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_INV_SUPPLIER_CODE']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vInvSupplierCode]" class="input-rag required" id="vInvSupplierCode" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_INV_SUPPLIER_CODE']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vInvSupplierCode']; ?>
" /></td>
                            </tr>

                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
 &nbsp;<font class="reqmsg">*</font></td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[vBuyerContactParty]" class="input-rag" id="vBuyerContactParty" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vBuyerContactParty']; ?>
" />
                                                                                                        </td>
                            </tr>
                                                        <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_INVOICE_DESCRIPTION']; ?>
 </td>
                                <td valign="top">:</td>
                                <td>
                                    <textarea name="Data[tInvoiceDescription]" class="" id="tInvoiceDescription" style="width:228px;" rows="3" ><?php echo ((is_array($_tmp=$this->_tpl_vars['invdtls'][0]['tInvoiceDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_REFERENCE_NUMBER']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vRegisterNumber]" class="input-rag" id="vRegisterNumber" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_REFERENCE_NUMBER']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vRegisterNumber']; ?>
" /></td>
                            </tr>

                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_OPENING_UNIT']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[iOpeningUnit]" class="input-rag" id="iOpeningUnit" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_OPENING_UNIT']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['iOpeningUnit']; ?>
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
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vSupplierOrderNum']; ?>
" /></td>
                            </tr>
                                                        <tr>
                                <td><?php echo $this->_tpl_vars['LBL_LINE_ITEM_TAX']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['lineItemTax']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_VAT']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fVAT]" class="input-rag decimals" id="fVAT" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_VAT']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['fVAT']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fOtherTax1]" class="input-rag decimals" id="fOthertax1" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['fOtherTax1']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fWithHoldingTax]" class="input-rag decimals" id="fWithHoldingTax" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['fWithHoldingTax']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_FREIGHT']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vFreight]" class="input-rag " id="vFreight" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vFreight']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_MISCELLANEOUS']; ?>
 </td>
                                <td valign="top">:</td>
                                <td><textarea name="Data[tMiscellaneous]" id="tMiscellaneous" style="width:228px;" rows="3" ><?php echo ((is_array($_tmp=$this->_tpl_vars['invdtls'][0]['tMiscellaneous'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_DISCOUNT_BASELINE_DATE']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[dCashDiscountBaseline]" class="input-rag " id="dCashDiscountBaseline" style="width:139px;" value="<?php if ($this->_tpl_vars['invdtls'][0]['dCashDiscountBaseline'] != '0000-00-00 00:00:00'):  echo ((is_array($_tmp=$this->_tpl_vars['invdtls'][0]['dCashDiscountBaseline'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp));  endif; ?>" readonly="readonly" />
                                                                    </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_MAXCASH_DISCOUNTDAYS']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iMaxCashDiscountDays]" class="input-rag digits" id="iMaxCashDiscountDays" style="width:190px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['iMaxCashDiscountDays']; ?>
" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_MAXCASH_DISCOUNTPERCENT']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[fMaxCashDiscountPercentage]" class="input-rag decimals max" id="fMaxCashDiscountPercentage" style="width:190px;" max="100" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invdtls'][0]['fMaxCashDiscountPercentage'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 5) : substr($_tmp, 0, 5)); ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_MAXCASH_DISCOUNTPERCENT']; ?>
" maxlength="5" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_NORMALCASH_DISCOUNTDAYS']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iNormalCashDiscountDays]" class="input-rag digits" id="iNormalCashDiscountDays" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['iNormalCashDiscountDays']; ?>
" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_NORMALCASH_DISCOUNTPERCNET']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iNormalCashDiscountPercentage]" class="input-rag decimals max" max="100" id="iNormalCashDiscountPercentage" style="width:228px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invdtls'][0]['iNormalCashDiscountPercentage'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 5) : substr($_tmp, 0, 5)); ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_NORMALCASH_DISCOUNTPERCNET']; ?>
" maxlength="5" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_NET_PAYMENT_DAYS']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iNetPaymentDays]" class="input-rag digits" id="iNetPaymentDays" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['iNetPaymentDays']; ?>
" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_NET_PAYMENT_DATE']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[dNetPaymentdate]" class="input-rag " id="dNetPaymentdate" style="width:139px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['invdtls'][0]['dNetPaymentdate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)); ?>
" readonly="readonly" />
                                                                    </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
  <?php echo $this->_tpl_vars['LBL_PARTY']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToParty]" class="input-rag required" id="vBillToParty" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
  <?php echo $this->_tpl_vars['LBL_PARTY']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vBillToParty']; ?>
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
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vBillToAddLine1']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
2 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToAddLine2]" class="input-rag" id="vBillToAddLine2" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vBillToAddLine2']; ?>
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
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vBillToCity']; ?>
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
" onchange="getRelativeCombo(this.value,'<?php echo $this->_tpl_vars['invdtls'][0]['vBillToState']; ?>
','vBillToState','-- <?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
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
                                        <option  title="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['iCountryISD']; ?>
" currency="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['iCurrencyID']; ?>
" value="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']; ?>
" <?php if ($this->_tpl_vars['invdtls'][0]['vBillToCountry'] == $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']): ?> selected <?php endif; ?> ><?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountry']; ?>
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
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vBillToZipCode']; ?>
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
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['vBillToContactParty']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td  valign="top">
                                    <input type="text" name="vBillToContactTelephoneCode"  value="<?php echo $this->_tpl_vars['invdtls'][0]['vBillToContactTelephoneCode']; ?>
" class="input-rag" id="vBillToContactTelephoneCode" style="width:30px;" maxlength="3" onkeypress="return chkValidPhone(event)" title="<?php echo $this->_tpl_vars['LBL_COUNTRY_CODE']; ?>
"/>
                                    <input type="text" name="Data[vBillToContactTelephone]" class="input-rag required" id="vBillToContactTelephone" onkeypress="return chkValidPhone(event)" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE']; ?>
" style="width:190px;" maxlength="15" value="<?php echo $this->_tpl_vars['invdtls'][0]['vBillToContactTelephone']; ?>
" />

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
_1" <?php if ($this->_tpl_vars['currency'][$this->_sections['c']['index']] == $this->_tpl_vars['invdtls'][0]['vCurrency']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode']; ?>
</option>
                                        <?php endfor; endif; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_VAT_ID']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vVatId]" class="input-rag" id="vVatId" style="width:228px;" value="<?php if ($this->_tpl_vars['invdtls'][0]['vVatId'] != ''):  echo $this->_tpl_vars['invdtls'][0]['vVatId'];  else:  echo $this->_tpl_vars['orgdtls'][0]['vVatId'];  endif; ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BANK']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[iBankId]" id="iBankId" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BANK']; ?>
">
                                        <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['bnk_dtls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <option value="<?php echo $this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['iBankId']; ?>
" <?php if ($this->_tpl_vars['invdtls'][0]['iBankId'] > 0):  if ($this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['iBankId'] == $this->_tpl_vars['invdtls'][0]['iBankId']): ?>selected="selected"<?php endif;  elseif ($this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['iBankId'] == $this->_tpl_vars['orgdtls'][0]['iBankId']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['vBankName']; ?>
</option>
                                        <?php endfor; endif; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BANK_CODE']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBankCode]" class="input-rag" id="vBankCode" style="width:228px;" value="<?php if ($this->_tpl_vars['invdtls'][0]['vBankCode'] != ''):  echo $this->_tpl_vars['invdtls'][0]['vBankCode'];  else:  echo $this->_tpl_vars['orgdtls'][0]['vBankCode'];  endif; ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BRANCH']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBranchName]" class="input-rag" id="vBranchName" style="width:228px;" value="<?php if ($this->_tpl_vars['invdtls'][0]['vBranchName'] != ''):  echo $this->_tpl_vars['invdtls'][0]['vBranchName'];  else:  echo $this->_tpl_vars['orgdtls'][0]['vBranchName'];  endif; ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BRANCH_CODE']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBranchCode]" class="input-rag" id="vBranchCode" style="width:228px;" value="<?php if ($this->_tpl_vars['invdtls'][0]['vBranchCode'] != ''):  echo $this->_tpl_vars['invdtls'][0]['vBranchCode'];  else:  echo $this->_tpl_vars['orgdtls'][0]['vBranchCode'];  endif; ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
 <?php echo $this->_tpl_vars['LBL_TITLE']; ?>
</td>
                                <td>:</td>
                                <td><input type="text" name="Data[vAccountName]" class="input-rag" id="vAccountName" style="width:228px;" value="<?php if ($this->_tpl_vars['invdtls'][0]['vAccountName'] != ''):  echo $this->_tpl_vars['invdtls'][0]['vAccountName'];  else:  echo $this->_tpl_vars['orgdtls'][0]['vAccount1Title'];  endif; ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
 <?php echo $this->_tpl_vars['LBL_NUMBER']; ?>
</td>
                                <td>:</td>
                                <td><input type="text" name="Data[vAccountNumber]" class="input-rag" id="vAccountNumber" style="width:228px;" value="<?php if ($this->_tpl_vars['invdtls'][0]['vAccountNumber'] != ''):  echo $this->_tpl_vars['invdtls'][0]['vAccountNumber'];  else:  echo $this->_tpl_vars['orgdtls'][0]['vAccount1Number'];  endif; ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_IBAN']; ?>
</td>
                                <td>:</td>
                                <td><input type="text" name="Data[vIBAN]" class="input-rag" id="vIBAN" style="width:228px;" value="<?php if ($this->_tpl_vars['invdtls'][0]['vIBAN'] != ''):  echo $this->_tpl_vars['invdtls'][0]['vIBAN'];  else:  echo $this->_tpl_vars['bnkdtl'][0]['vIBAN'];  endif; ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_INVOICE_TOTAL']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fInvoiceTotal]" class="input-rag decimals" id="fInvoiceTotal" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['fInvoiceTotal']; ?>
" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PRE_PAYMENT']; ?>
 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fPrePayment]" class="input-rag decimals" id="fPrePayment" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PRE_PAYMENT']; ?>
" style="width:228px;" value="<?php echo $this->_tpl_vars['invdtls'][0]['fPrePayment']; ?>
" /></td>
                            </tr>
                                                        <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_ATTACH_DOCUMENT']; ?>
</td>
                                <td valign="top">:</td>
                                <td> <input type="file" name="upload" id="upload" />
                                    <div id="files_list" class="file_upload">
                                        <ul style="list-style-type: none">
                                            <?php if (count($_from = (array)$this->_tpl_vars['invAttachments'])):
    foreach ($_from as $this->_tpl_vars['invAttach']):
?>
                                            <li>
                                                <a href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
upload/attachment_docs/invoice/<?php echo $this->_tpl_vars['iInvoiceID']; ?>
/<?php echo $this->_tpl_vars['invAttach']['vFile']; ?>
')" > <?php echo $this->_tpl_vars['invAttach']['vFile']; ?>
</a><input type="button" value="Delete" onclick="deleteFile($(this).parent(),'<?php echo $this->_tpl_vars['invAttach']['iAttachmentID']; ?>
');"/>
                                            </li>
                                            <?php endforeach; unset($_from); endif; ?>
                                        </ul>
                                        <input type="hidden" name="deleteFiles" id="deleteFiles"/>
                                    </div>
                                </td>
                            </tr>
                            <?php if ($this->_tpl_vars['invdtls'][0]['eSaved'] != 'No' || $this->_tpl_vars['invad'] == 'yes'): ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="hidden" name="Data[eSaved]"  id="eSaved" value="<?php echo $this->_tpl_vars['invdtls'][0]['eSaved']; ?>
" />
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php if (((is_array($_tmp=$this->_tpl_vars['invdtls'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && $this->_tpl_vars['invdtls'][0]['eStatus'] == $this->_tpl_vars['rjtsts']): ?>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;"><?php echo ((is_array($_tmp=$this->_tpl_vars['invdtls'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</div></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="2" height="5"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2"><a href="javascript:void(0)">
                                        <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-next.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes'); $('#eFrom').val('Next'); return submitFrm();" style="vertical-align:middle;"/></a>
                                    <a ><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reset.gif" alt="" border="0"  onclick="resetFrm();" style="vertical-align:middle;"/></a>
                                    <a ><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-cancel.gif" alt="" border="0" onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invacptlist/<?php echo $GLOBALS['HTTP_SESSION_VARS']['invlvl']; ?>
'" style="vertical-align:middle;"/></a>&nbsp;
                                    <?php if ($this->_tpl_vars['invdtls'][0]['eSaved'] != 'No' && $this->_tpl_vars['view'] != ''): ?> <!-- || $invad eq 'yes'-->
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
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery-ui-timepicker.js"></script>
<!--<script type="text/javascript" src="css/calendar-blue.css"  />-->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jgetinvpo.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jinvoicecreate.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_CONTENT_JS']; ?>
multifile.js"></script>
<?php echo '
<script type="text/javascript">
    var corg = \'';  echo $this->_tpl_vars['curORGID'];  echo '\';
    var sid = \'';  echo $this->_tpl_vars['sid'];  echo '\';

    if(document.getElementById(\'upload\'))
    {
        var multiSelect = new MultiSelector( document.getElementById(\'files_list\'), 3);
        multiSelect.addElement(document.getElementById(\'upload\'));
    }
    var fileArr=new Array();
    function deleteFile(obj,fileid)
    {
        fileArr.push(fileid);
        $(\'#deleteFiles\').val(fileArr);
        obj.html("");
    }

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
    function resetFrm() {
        $(\'#frmadd\')[0].reset();
    }

    if(view != \'edit\') {
        $("#frmadd").validate({
            rules:{
                "Data[vExtPOCode]": {
                    remote: {
                        url:SITE_URL+"index.php?file=u-aj_chkdupdata"+"&extfld=iSupplierOrganizationID&extval="+corg,
                        type:"get",
                        data:{
                            val:function() {
                                return $("#iInvoiceID").val();
                            },
                            id:function() {
                                return "iInvoiceID";
                            },
                            field:function() {
                                return "vExtPOCode";
                            },
                            table:function() {
                                return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_inovice_order_heading";
                            }
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
                "Data[vInvSupplierCode]": {
                    remote:{
                        url:SITE_URL+"index.php?file=u-aj_chkdupdata"+"&extfld=iSupplierOrganizationID&extval="+corg,
                        type:"get",
                        data:{
                            val:function() {
                                return $("#iInvoiceID").val();
                            },
                            id:function() {
                                return "iInvoiceID";
                            },
                            field:function() {
                                return "vInvSupplierCode";
                            },
                            table:function() {
                                return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_inovice_order_heading";
                            }
                        }
                    }
                }
            },
            messages:{
                "Data[fInvoiceTotal]":{
                    decimals: LBL_NUMERIC_ONLY
                },
                /*"Data[fAcceptedAmount]":{
                                                 decimals: LBL_NUMERIC_ONLY, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO
                                         },*/
                "Data[fPrePayment]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fVAT]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fOtherTax1]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fWithHoldingTax]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[iMaxCashDiscountDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[fMaxCashDiscountPercentage]": {
                    decimals: LBL_DIGITS_ONLY,
                    max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
                },
                "Data[iNormalCashDiscountDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[iNormalCashDiscountPercentage]": {
                    decimals: LBL_DIGITS_ONLY,
                    max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
                },
                "Data[iNetPaymentDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[vInvSupplierCode]": {
                    required: LBL_ENTER_INV_SUPPLIER_CODE,
                    remote: jQuery.validator.format(LBL_INV_SUPPLIER_CODE_INUSE)
                },
                "Data[vExtPOCode]": {
                    remote: jQuery.validator.format(LBL_CODE_INUSE)
                }
            }
        });
    } else {
        $("#iBuyerID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+\'';  echo $this->_tpl_vars['invdtls'][0]['iBuyerOrganizationID'];  echo '\'+"&htmlTag=option&orgtype=buyer"+"&val=';  echo $this->_tpl_vars['invdtls'][0]['iBuyerID'];  echo '")
        $("#frmadd").validate( {
            rules: {
                "Data[vBillToContactTelephone]": {
                    required: function() {
                        if($.trim($(\'#vBillToContactTelephoneCode\').val()) == \'\') {
                            $(\'#vBillToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_COUNTRY_CODE'];  echo '");
                        } else {
                            $(\'#vBillToContactTelephone\').attr("title","';  echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE'];  echo '");
                        }
                    }
                }
            },
            messages: {
                "Data[fInvoiceTotal]":{
                    decimals: LBL_NUMERIC_ONLY
                },
                /*"Data[fAcceptedAmount]": {
                                                  decimals: LBL_NUMERIC_ONLY, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO
                                         },*/
                "Data[fPrePayment]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fVAT]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fOtherTax1]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fWithHoldingTax]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[iMaxCashDiscountDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[fMaxCashDiscountPercentage]": {
                    decimals: LBL_DIGITS_ONLY,
                    max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
                },
                "Data[iNormalCashDiscountDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[iNormalCashDiscountPercentage]": {
                    decimals: LBL_DIGITS_ONLY,
                    max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
                },
                "Data[iNetPaymentDays]": {
                    digits: LBL_DIGITS_ONLY
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
        $(\'#iBuyerID\').val(totValID);
        //	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }
    function selectUsrItem(li) {
        findUserValue(li);
    }
    function setuser()
    {
        $("#vBuyerContactParty").autocomplete(
        SITE_URL+"index.php?file=u-aj_getUser&icompid="+$(\'#iBuyerOrganizationID\').val(),
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
        $(\'#iBuyerOrganizationID\').val(totValID);
        $(\'#vBuyerContactParty\').val(\'\');
        $(\'#iBuyerID\').val(\'\');
        //$(\'#result\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != \'\') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    // if(org == \'\') {
    $(document).ready(function() {
        $("#vBuyerName").autocomplete(
        SITE_URL+"index.php?file=or-aj_getOrganization&orgid="+$(\'#iSupplierOrganizationID\').val()+"&orgtype=buyer",
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
        });
    });
    // }

    jQuery(document).ready(function()
    {
        $("#dCashDiscountBaseline").attr(\'readonly\',\'readonly\');
        // $("#dtpCashDiscountBaseline").datepicker({
        $("#dCashDiscountBaseline").datepicker({
            // altField: \'#dCashDiscountBaseline\',
            dateFormat: \'yy-mm-dd\',
            // timeFormat: \'hh:mm:ss\',
            showOn: "button",
            buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
            buttonImageOnly: true,
            onSelect: function(dateText, inst) {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
                });
            },
            onClose: function() {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
                });
            }
        });
        //
        $("#dNetPaymentdate").attr(\'readonly\',\'readonly\');
        $("#dNetPaymentdate").datepicker({
            dateFormat: \'yy-mm-dd\',
            // timeFormat: \'hh:mm:ss\',
            showOn: "both",
            buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
            buttonImageOnly: true,
            onSelect: function(dateText, inst) {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
                });
            },
            onClose: function() {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
                });
            }
        });
        /*var cal2Pos=$(\'#cal2\').position();
        jQuery("#dCashDiscountBaseline").dynDateTime({
            showsTime: true,
            ifFormat: "%Y-%m-%d",
            daFormat: "%l;%M %p, %e %m, %Y",
            align: "TL",
            electric: false,
            singleClick: false,
            button:".next()",
            displayArea: ".siblings(\'.dtcDisplayArea\')"
            //position:[cal2Pos.left-230,0]
        });
        var cal3Pos=$(\'#cal3\').position();
        jQuery("#dNetPaymentdate").dynDateTime({
            showsTime: true,
            ifFormat: "%Y-%m-%d",
            daFormat: "%l;%M %p, %e %m, %Y",
            align: "TL",
            electric: false,
            singleClick: false,
            button:".next()",
            displayArea: ".siblings(\'.dtcDisplayArea\')"
            // position:[cal3Pos.left-230,10]
        });*/
    });
    //$(element).offset();
    function fillCountryCode(obj)
    {    var opt=obj.options[obj.selectedIndex];
        var currency=opt.getAttribute("currency");
        $(\'#vBillToContactTelephoneCode\').val(opt.title);
        $(\'#vCurrency option[id="\'+currency+\'_1"]\').attr("selected","selected");
    }
    function setT()
    {
        if($(\'#eLineItemTax\').val()==\'Yes\') {
            $(\'#fVAT\').val(\'\');
            $(\'#fOthertax1\').val(\'\');
            $(\'#fWithHoldingTax\').val(\'\');
            $(\'#fVAT\').attr(\'disabled\',\'disabled\');
            $(\'#fOthertax1\').attr(\'disabled\',\'disabled\');
            $(\'#fWithHoldingTax\').attr(\'disabled\',\'disabled\');
            $(\'#fVAT\').css(\'background-color\',\'#eeeeee\');
            $(\'#fOthertax1\').css(\'background-color\',\'#eeeeee\');
            $(\'#fWithHoldingTax\').css(\'background-color\',\'#eeeeee\');

        } else {
            $(\'#fVAT\').attr(\'disabled\',\'\');
            $(\'#fOthertax1\').attr(\'disabled\',\'\');
            $(\'#fWithHoldingTax\').attr(\'disabled\',\'\');
            $(\'#fVAT\').css(\'background-color\',\'#ffffff\');
            $(\'#fOthertax1\').css(\'background-color\',\'#ffffff\');
            $(\'#fWithHoldingTax\').css(\'background-color\',\'#ffffff\');
        }
    }
    $(document).ready(function() {
        setT();
		//
		// getRelativeCombo($(\'#vSupplierCountry\').val(),"';  echo $this->_tpl_vars['userData']['vSupplierState'];  echo '",\'vSupplierState\',\'---';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
---<?php echo '\',stateArr);
		// getRelativeCombo($(\'#vShipToCountry\').val(),"';  echo $this->_tpl_vars['userData']['vShipToState'];  echo '",\'vShipToState\',\'---';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
---<?php echo '\',stateArr);
		getRelativeCombo($(\'#vBillToCountry\').val(),"';  echo $this->_tpl_vars['invdtls'][0]['vBillToState'];  echo '",\'vBillToState\',\'---';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
---<?php echo '\',stateArr);
		// $(\'#iBuyerOrganizationID\').load(SITE_URL+"index.php?file=or-aj_getOrganization"+"&orgtype=buyer"+"&htmlTag=option"+"&val="+\'';  echo $this->_tpl_vars['invdtls'][0]['iBuyerOrganizationID'];  echo '\');
		// fillInvData($(\'#vInvoiceCode option:selected\').attr(\'id\'));
		fillInvData($(\'#iPurchaseOrderID option:selected\').attr(\'id\'));
		//
    });
    function getorgbilldetails(vl) {
        pars = "&orgid="+vl+"&type=sup"+"&frm=inv";
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