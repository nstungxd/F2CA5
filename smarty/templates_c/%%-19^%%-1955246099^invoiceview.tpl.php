<?php /* Smarty version 2.6.0, created on 2012-05-31 12:31:51
         compiled from member/user/invoiceview.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlentities', 'member/user/invoiceview.tpl', 21, false),array('modifier', 'calcLTzTime', 'member/user/invoiceview.tpl', 107, false),array('modifier', 'DateTime', 'member/user/invoiceview.tpl', 107, false),array('modifier', 'stripslashes', 'member/user/invoiceview.tpl', 115, false),array('modifier', 'trim', 'member/user/invoiceview.tpl', 396, false),array('modifier', 'count', 'member/user/invoiceview.tpl', 400, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
jquery.dynDateTime.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
css/calendar-blue.css" />
<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_INVOICE']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceview/<?php echo $this->_tpl_vars['iInvoiceID'];  if ($this->_tpl_vars['msg'] == 'pop'): ?>/pop<?php endif; ?>" class="current"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_INV_HEADER']; ?>
</em></a></li>
                    <?php if ($this->_tpl_vars['imgdt'] != 'yes'): ?>
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invprefview/<?php echo $this->_tpl_vars['iInvoiceID'];  if ($this->_tpl_vars['msg'] == 'pop'): ?>/pop<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</em></a></li>
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceviewitems/<?php echo $this->_tpl_vars['iInvoiceID'];  if ($this->_tpl_vars['msg'] == 'pop'): ?>/pop<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_INVOICE_ITEM']; ?>
</em></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg">&nbsp;
                    <?php if ($this->_tpl_vars['msg'] != 'pop'): ?>
                    <?php if ($this->_tpl_vars['usertype'] != 'orgadmin'):  echo ((is_array($_tmp=$this->_tpl_vars['nxtstatus']['vStatusMsg'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp));  endif; ?>
                    <?php if ($this->_tpl_vars['nxtstatus']['vStatusMsg'] == ''): ?>
                    <?php if ($this->_tpl_vars['postat'] == 'ureview'): ?>
                    <?php echo $this->_tpl_vars['LBL_PO_STATUS_UNDER_REVIEW']; ?>

                    <?php elseif ($this->_tpl_vars['postat'] == 'rjct'): ?>
                    <?php echo $this->_tpl_vars['LBL_PO_STATUS_REJECTED']; ?>

                    <?php elseif ($this->_tpl_vars['postat'] == 'isu'): ?>
                    <?php echo $this->_tpl_vars['LBL_PO_STATUS_ISSUED']; ?>

                    <?php elseif ($this->_tpl_vars['postat'] == 'acpt'): ?>
                    <?php echo $this->_tpl_vars['LBL_PO_STATUS_ACCEPTED']; ?>

                    <?php elseif ($this->_tpl_vars['postat'] == 'prt'): ?>
                    <?php echo $this->_tpl_vars['LBL_PO_STATUS_PARTIAL_PO']; ?>

                    <?php elseif ($this->_tpl_vars['postat'] == 'act'): ?>
                    <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
: <?php echo $this->_tpl_vars['LBL_ACCEPTED']; ?>

                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div>&nbsp;
                    <?php if ($this->_tpl_vars['msg'] != 'pop'): ?>
                    <span style="float:right;"><b>
                            <a class="" href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceviewhistory/<?php echo $this->_tpl_vars['iInvoiceID']; ?>
')" ><?php echo $this->_tpl_vars['LBL_VIEW_HISTORY']; ?>
</a>
                        </b></span>
                    <?php endif; ?>
                </div>
                <div>
                    <form name="frmadd" id="frmadd" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-invoicecreate_a"  method="post">
                        <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="<?php echo $this->_tpl_vars['iInvoiceID']; ?>
" />
                        <input type="hidden" name="nstatus" id="nstatus" value="<?php echo $this->_tpl_vars['nxtstatus']['iStatusID']; ?>
" />
                        <input type="hidden" name="edelete" id="edelete" value="<?php echo $this->_tpl_vars['invoiceData']['eDelete']; ?>
" />
                        <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b><?php echo $this->_tpl_vars['var_msg']; ?>
</b></font></td></tr>
                            <tr>
                                <td width="190"><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMP_NAME']; ?>
</td>
                                <td width="1">:</td>
                                <td class="blue-ore" width="390"><?php echo $this->_tpl_vars['invoiceData']['vSupplierName']; ?>
</td>
                            </tr>
                            <tr>
                                <td width="190"><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
 </td>
                                <td  width="1">:</td>
                                <td class="blue-ore">
                                    <?php echo $this->_tpl_vars['invoiceData']['vInvoiceSupplierCode']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td width="150"><?php echo $this->_tpl_vars['LBL_INV_SUPPLIER_CODE']; ?>
 </td>
                                <td  width="1">:</td>
                                <td class="blue-ore">
                                    <?php echo $this->_tpl_vars['invoiceData']['vInvSupplierCode']; ?>

                                </td>
                            </tr>
                                                        <tr>
                                <td><?php echo $this->_tpl_vars['LBL_RELATED_PO_CODE']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vExtPOCode']; ?>
</td>
                            </tr>
                                                        <?php if ($this->_tpl_vars['imgdt'] != 'yes'): ?>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
  </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['invoiceData']['vBuyerName']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
  </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['invoiceData']['vBuyerContactParty']; ?>

                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_INV_CODE']; ?>
  </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['invoiceData']['vInvoiceCode']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_ISSUE_DATE']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['invoiceData']['dIssueDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>

                                </td>
                            </tr>
                            <?php if ($this->_tpl_vars['imgdt'] != 'yes'): ?>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_INVOICE_DESCRIPTION']; ?>
 </td>
                                <td valign="top">:</td>
                                <td>
                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData']['tOrderDescription'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_OPENING_UNIT']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['iOpeningUnit']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_ORDER_NUMBER']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vSupplierOrderNum']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_INVOICE_TYPE']; ?>
  </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['invoiceData']['eInvoiceType']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_CARRIER']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['tCarrier']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_LINE_ITEM_TAX']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['eLineItemTax']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_VAT']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['fVAT']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['fOtherTax1']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_FREIGHT']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vFreight']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_MISCELLANEOUS']; ?>
 </td>
                                <td valign="top">:</td>
                                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData']['tMiscellaneous'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_INVOICE_TOTAL']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['fInvoiceTotal']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_DISCOUNT_BASELINE']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData']['dCashDiscountBaseline'])) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_MAXCASH_DISCOUNTDAYS']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['invoiceData']['iMaxCashDiscountDays']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_MAXCASH_DISCOUNTPERCENT']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['invoiceData']['fMaxCashDiscountPercentage']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_NORMALCASH_DISCOUNTDAYS']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['invoiceData']['iNormalCashDiscountDays']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_NORMALCASH_DISCOUNTPERCNET']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['invoiceData']['iNormalCashDiscountPercentage']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
  <?php echo $this->_tpl_vars['LBL_PARTY']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBillToParty']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
1  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBillToAddLine1']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
2 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBillToAddLine2']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CITY']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBillToCity']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
  </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['invoiceData']['vBillToCountry']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBillToState']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBillToZipCode']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBillToContactParty']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBillToContactTelephone']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vCurrency']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_VAT_ID']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vVatId']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BANK']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBankName']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BANK_CODE']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBankCode']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BRANCH']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBranchName']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BRANCH_CODE']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vBranchCode']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
 <?php echo $this->_tpl_vars['LBL_TITLE']; ?>
</td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vAccountName']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
 <?php echo $this->_tpl_vars['LBL_NUMBER']; ?>
</td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vAccountNumber']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_IBAN']; ?>
</td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['vIBAN']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_INVOICE_TOTAL']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['fInvoiceTotal']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PRE_PAYMENT']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['invoiceData']['fPrePayment']; ?>
</td>
                            </tr>
                            <?php if ($this->_tpl_vars['ntacpt'] == 'y'): ?>
                            <tr>
                                <td> <?php echo $this->_tpl_vars['LBL_ACCEPTED_VAT']; ?>
&nbsp;</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[dAcceptedVat]" class="input-rag id="fVAT" style="width:228px;" value="<?php echo $this->_tpl_vars['invoiceData']['fVAT']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_INVOICE_PAYABLE']; ?>
 (<?php echo $this->_tpl_vars['LBL_ACCEPTED']; ?>
) <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
" />
                            </td>
                        </tr>
                        <tr>
                            <td> <?php echo $this->_tpl_vars['LBL_ACCEPTED_TAX']; ?>
&nbsp;</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="Data[dAcceptedOtherTax]" class="input-rag id="fOtherTax1" style="width:228px;" value="<?php echo $this->_tpl_vars['invoiceData']['fOtherTax1']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_INVOICE_PAYABLE']; ?>
 (<?php echo $this->_tpl_vars['LBL_ACCEPTED']; ?>
) <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
" />
                        </td>
                    </tr>
                    <tr>
                        <td> <?php echo $this->_tpl_vars['LBL_ACCEPTED_WITH_HOLDING_TAX']; ?>
&nbsp;</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="Data[dAcceptedWHTax]" class="input-rag "  id="fWithHoldingTax" style="width:228px;" value="<?php echo $this->_tpl_vars['invoiceData']['fWithHoldingTax']; ?>
" />
                        </td>
                    </tr>
                    <tr>
                        <td> <?php echo $this->_tpl_vars['LBL_ACCEPTED_NET_PAYMENT_DATE']; ?>
&nbsp;</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="Data[dAcceptedNetPaymentDate]" readonly class="input-rag" id="dNetPaymentdate" value="<?php echo $this->_tpl_vars['invoiceData']['dNetPaymentdate']; ?>
"style="width:139px; vertical-align:middle;" />
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $this->_tpl_vars['LBL_INVOICE_PAYABLE']; ?>
 (<?php echo $this->_tpl_vars['LBL_ACCEPTED']; ?>
) <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
 &nbsp;<font class="reqmsg">*</font></td>
                        <td>:</td>
                        <td><input type="text" name="Data[fAcceptedAmount]" class="input-rag required id="fAcceptedAmount" style="width:228px;" value="<?php echo $this->_tpl_vars['invoiceData']['fAcceptedAmount']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_INVOICE_PAYABLE']; ?>
 (<?php echo $this->_tpl_vars['LBL_ACCEPTED']; ?>
) <?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
" /></td>
                    </tr>
                    <?php elseif ($this->_tpl_vars['invoiceData']['iaStatusID'] > 0): ?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['LBL_ACCEPTED_VAT']; ?>
&nbsp;</td>
                        <td>:</td>
                        <td><?php echo $this->_tpl_vars['invoiceData']['dAcceptedVat']; ?>
</td>
                    </tr>
                    <tr>
                        <td><?php echo $this->_tpl_vars['LBL_ACCEPTED_TAX']; ?>
&nbsp;</td>
                        <td>:</td>
                        <td><?php echo $this->_tpl_vars['invoiceData']['dAcceptedOtherTax']; ?>
</td>
                    </tr>
                    <tr>
                        <td><?php echo $this->_tpl_vars['LBL_ACCEPTED_WITH_HOLDING_TAX']; ?>
&nbsp;</td>
                        <td>:</td>
                        <td><?php echo $this->_tpl_vars['invoiceData']['dAcceptedWHTax']; ?>
</td>
                    </tr>
                    </tr>
                    <tr>
                        <td><?php echo $this->_tpl_vars['LBL_ACCEPTED_NET_PAYMENT_DATE']; ?>
&nbsp;</td>
                        <td>:</td>
                        <td><?php if ($this->_tpl_vars['invoiceData']['dAcceptedNetPaymentDate'] != '0000-00-00'):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['invoiceData']['dAcceptedNetPaymentDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10));  else: ?>---<?php endif; ?></td>
                    </tr>


                    <?php if ($this->_tpl_vars['invoiceData']['fAcceptedAmount'] > 0): ?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['LBL_ACCEPTED_AMOUNT']; ?>
  </td>
                        <td>:</td>
                        <td><?php echo $this->_tpl_vars['invoiceData']['fAcceptedAmount']; ?>
</td>
                    </tr>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="3"><hr/></td>
                    </tr>
                    <tr>
                        <td ><b><?php echo $this->_tpl_vars['LBL_OTHER_DETAILS']; ?>
 : </b></td>
                        <td >&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="3" align="center"><div id="img" class="img-details"><img src="<?php echo $this->_tpl_vars['img']; ?>
" /></div></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['permitted'] == 'Yes' && $this->_tpl_vars['usertype'] != 'orgadmin'): ?>
                    <tr>
                        <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
                        <td valign="top">:</td>
                        <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                    </tr>
                    <?php elseif ($this->_tpl_vars['invoiceData']['iStatusID'] == $this->_tpl_vars['rjtsts']): ?>
                    <tr>
                        <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
                        <td valign="top">:</td>
                        <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3" readonly="readonly"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData']['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</textarea></td>
                    </tr>
                    <?php endif; ?>

                    <?php if (count($this->_tpl_vars['invAttachments']) > 0): ?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['LBL_UPLOADED_FILES']; ?>
</td>
                        <td>:</td>
                        <td>
                            <div id="files_list" class="file_upload">
                                <ul style="list-style-type: none">
                                    <?php if (count($_from = (array)$this->_tpl_vars['invAttachments'])):
    foreach ($_from as $this->_tpl_vars['invAttach']):
?>
                                    <li>
                                        <a href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL']; ?>
upload/attachment_docs/invoice/<?php echo $this->_tpl_vars['iInvoiceID']; ?>
/<?php echo $this->_tpl_vars['invAttach']['vFile']; ?>
')" > <?php echo $this->_tpl_vars['invAttach']['vFile']; ?>
</a>
                                    </li>
                                    <?php endforeach; unset($_from); endif; ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <?php if ($this->_tpl_vars['msg'] != 'pop'): ?>
                    <tr>
                        <td valign="bottom" align="center" colspan="3">
                            <!--<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" <?php if ($this->_tpl_vars['curORGID'] == $this->_tpl_vars['invoiceData']['iBuyerOrganizationID']): ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invacptlist/<?php echo $GLOBALS['_SESSION']['invlvl']; ?>
';"<?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicelist/<?php echo $GLOBALS['_SESSION']['invlvl']; ?>
';"<?php endif; ?> />-->
                            <?php if ($this->_tpl_vars['permitted'] == 'Yes' && $this->_tpl_vars['usertype'] != 'orgadmin'): ?>
                            <?php if ($this->_tpl_vars['auth'] != 'y'): ?>
                            <?php if ($this->_tpl_vars['act'] == 'y'): ?>
                            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-accept.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                            <?php elseif ($this->_tpl_vars['isue'] == 'y'): ?>
                            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-issue.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                            <?php else: ?>
                            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                            <?php endif; ?>
                            <?php else: ?>
                            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-authorise.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                            <?php endif; ?>
                            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
                            <?php endif; ?>
                            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" <?php if ($this->_tpl_vars['curORGID'] == $this->_tpl_vars['invoiceData']['iBuyerOrganizationID']): ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invacptlist/<?php echo $GLOBALS['_SESSION']['invlvl']; ?>
';"<?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicelist/<?php echo $GLOBALS['_SESSION']['invlvl']; ?>
';"<?php endif; ?> />
                                 <?php if ($this->_tpl_vars['invoiceData']['iStatusID'] == $this->_tpl_vars['acptsts'][0]['iStatusID'] && $this->_tpl_vars['invoiceData']['iaStatusID'] == $this->_tpl_vars['acptsts'][0]['iStatusID'] && ((is_array($_tmp=$this->_tpl_vars['invoiceData']['iaStatusID'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && $this->_tpl_vars['invoiceData']['iaStatusID'] > 0): ?>
                                 <a title="<?php echo $this->_tpl_vars['LBL_PRINT']; ?>
" style="cursor:pointer" class="colorboxfile" rel="<?php echo $this->_tpl_vars['iInvoiceID']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-print.gif" alt="" id="print_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></a>
                                <?php endif; ?>
                                                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
            </form>
        </div>
        <div>&nbsp;</div>
    </div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery-ui-timepicker.js"></script>
<?php echo '
<script type="text/javascript">
    jQuery(document).ready(function()
    {
        $(".colorboxfile").live("click",function() {
            var id = $(this).attr(\'rel\');
            $.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/inv/"+id+"/pop"});
        });
        $("#dNetPaymentdate").attr(\'readonly\',\'readonly\');
        $("#dNetPaymentdate").datepicker({
            dateFormat: \'yy-mm-dd\',
            showOn: "both",
            buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
            buttonImageOnly: true,
            onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); },
            onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); }
        });

    });
    $("#frmadd").validate({
        rules: {
            //
        },
        messages: {
            "Data[fAcceptedAmount]": { decimals: LBL_NUMERIC_ONLY, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO }
        }
    });

</script>
'; ?>