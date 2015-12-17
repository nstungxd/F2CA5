<?php /* Smarty version 2.6.0, created on 2012-05-31 12:02:33
         compiled from member/user/purchaseorderview.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlentities', 'member/user/purchaseorderview.tpl', 16, false),array('modifier', 'DateTime', 'member/user/purchaseorderview.tpl', 90, false),array('modifier', 'trim', 'member/user/purchaseorderview.tpl', 261, false),array('modifier', 'count', 'member/user/purchaseorderview.tpl', 268, false),)), $this); ?>
<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_VIEW_PURCHASE_ORDER']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseorderview/<?php echo $this->_tpl_vars['iPurchaseOrderID'];  if ($this->_tpl_vars['var_msg'] == 'pop'): ?>/pop<?php endif; ?>" class="current"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_PO_HEADER']; ?>
</em></a></li>
                    <?php if ($this->_tpl_vars['imgdt'] != 'yes'): ?>
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poprefview/<?php echo $this->_tpl_vars['iPurchaseOrderID'];  if ($this->_tpl_vars['var_msg'] == 'pop'): ?>/pop<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</em></a></li>
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poviewitems/<?php echo $this->_tpl_vars['iPurchaseOrderID'];  if ($this->_tpl_vars['var_msg'] == 'pop'): ?>/pop<?php endif; ?>" ><em><?php echo $this->_tpl_vars['LBL_VIEW_PO_ITEM']; ?>
</em></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg"><?php if ($this->_tpl_vars['usertype'] != 'orgadmin'): ?>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['nxtstatus']['vStatusMsg'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp));  endif; ?>
                    <?php if ($this->_tpl_vars['nxtstatus']['vStatusMsg'] == ''): ?>
                    <?php if ($this->_tpl_vars['invstat'] == 'ureview'): ?>
                    <?php echo $this->_tpl_vars['LBL_INV_STATUS_UNDER_REVIEW']; ?>

                    <?php elseif ($this->_tpl_vars['invstat'] == 'rjct'): ?>
                    <?php echo $this->_tpl_vars['LBL_INV_STATUS_REJECTED']; ?>

                    <?php elseif ($this->_tpl_vars['invstat'] == 'isu'): ?>
                    <?php echo $this->_tpl_vars['LBL_INV_STATUS_ISSUED']; ?>

                    <?php elseif ($this->_tpl_vars['invstat'] == 'acpt'): ?>
                    <?php echo $this->_tpl_vars['LBL_INV_STATUS_ACCEPTED']; ?>

                    <?php elseif ($this->_tpl_vars['invstat'] == 'prt'): ?>
                    <?php echo $this->_tpl_vars['LBL_INV_STATUS_PARTIAL_INVOICE']; ?>

                    <?php elseif ($this->_tpl_vars['invstat'] == 'act'): ?>
                    <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
: <?php echo $this->_tpl_vars['LBL_ACCEPTED']; ?>

                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div><span style="float:right;"><b><a class="" href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poviewhistory/<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
')" ><?php echo $this->_tpl_vars['LBL_VIEW_HISTORY']; ?>
</a></b></span></div>
                <div class="clear"></div>
                <div>
                    <form name="frmadd" id="frmadd" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-purchaseordercreate_a" method="post">
                        <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" value="<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
" />
                        <input type="hidden" name="iPOID" id="iPOID" value="<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
" />
                        <input type="hidden" name="nstatus" id="nstatus" value="<?php echo $this->_tpl_vars['nxtstatus']['iStatusID']; ?>
" />
                        <input type="hidden" name="edelete" id="edelete" value="<?php echo $this->_tpl_vars['poData']['eDelete']; ?>
" />
                        <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b><?php echo $this->_tpl_vars['var_msg']; ?>
</b></font></td></tr>
                            <tr>
                                <td width="225"><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMP_NAME']; ?>
</td>
                                <td>:</td>
                                <td class="blue-ore"><?php echo $this->_tpl_vars['poData']['vBuyerCompanyName']; ?>
</td>
                            </tr>
                            <tr>
                                <td width="225"><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
 </td>
                                <td>:</td>
                                <td class="blue-ore">
                                    <?php echo $this->_tpl_vars['poData']['vBuyerCode']; ?>

                                </td>
                            </tr>
                            <?php if ($this->_tpl_vars['imgdt'] != 'yes'): ?>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['poData']['vSupplierName']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
  </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['poData']['vSupplierContactParty']; ?>

                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PO_BUYER_CODE']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['poData']['vPoBuyerCode']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PO_CODE']; ?>
  </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['poData']['vPOCode']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_ORDER_DATE']; ?>
 </td>
                                <td>:</td>
                                <td>
                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['poData']['dOrderDate'])) ? $this->_run_mod_handler('DateTime', true, $_tmp, '10') : DateTime($_tmp, '10')); ?>

                                </td>
                            </tr>
                            <?php if ($this->_tpl_vars['imgdt'] != 'yes'): ?>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_ORDER_DESCRIPTION']; ?>
 </td>
                                <td valign="top">:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['poData']['tOrderDescription']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_OPENING_UNIT']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['iOpeningUnit']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_ORDER_NUMBER']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vSupplierOrderNum']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_CARRIER']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['tCarrier']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_LINE_ITEM_TAX']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['eLineItemTax']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_VAT']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['fVAT']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_OTHER_TAX']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['fOther_tax_1']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_PARTY']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vShipToParty']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
1  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vShipToAddressLine1']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
2 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vShipToAddressLine2']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CITY']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vShipToCity']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
  </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['poData']['vShipToCountry']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vShipToState']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vShipToZipCode']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vShipToContactParty']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_SHIP_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vShipToContactTelephone']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
  <?php echo $this->_tpl_vars['LBL_PARTY']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vBillToParty']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
1  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vBillToAddLine1']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
2 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vBillToAddLine2']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CITY']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vBillToCity']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
  </td>
                                <td>:</td>
                                <td>
                                    <?php echo $this->_tpl_vars['poData']['vBillToCountry']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vBillToState']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vBillToZipCode']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_PARTY']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vBillToContactParty']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_BILL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_CONTACT_TELEPHONE']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vBillToContactTelephone']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
  </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['vCurrency']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PO_TOTAL']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['fPOTotal']; ?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LBL_PRE_PAYMENT']; ?>
 </td>
                                <td>:</td>
                                <td><?php echo $this->_tpl_vars['poData']['fPrepayment']; ?>
</td>
                            </tr>
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
                            <?php elseif (((is_array($_tmp=$this->_tpl_vars['poData']['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && $this->_tpl_vars['poData']['eStatus'] == $this->_tpl_vars['rjtsts']): ?>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3" readonly="readonly"><?php echo ((is_array($_tmp=$this->_tpl_vars['poData']['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</textarea></td>
                            </tr>
                            <?php endif; ?>
                            <?php if (count($this->_tpl_vars['poAttachments']) > 0): ?>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_UPLOADED_FILES']; ?>
</td>
                                <td valign="top">:</td>
                                <td>
                                    <div id="files_list" class="file_upload">
                                        <ul style="list-style-type: none">
                                            <?php if (count($_from = (array)$this->_tpl_vars['poAttachments'])):
    foreach ($_from as $this->_tpl_vars['poAttach']):
?>
                                            <li>
                                                <a href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL']; ?>
upload/attachment_docs/po/<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
/<?php echo $this->_tpl_vars['poAttach']['vFile']; ?>
')" > <?php echo $this->_tpl_vars['poAttach']['vFile']; ?>
</a>
                                            </li>
                                            <?php endforeach; unset($_from); endif; ?>
                                        </ul>

                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="bottom" align="center" colspan="3">
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="rst_btn" border="0" style="cursor:pointer; vertical-align:middle;" <?php if ($this->_tpl_vars['curORGID'] == $this->_tpl_vars['poData']['iSupplierOrganizationID']): ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poacptlist/<?php echo $GLOBALS['_SESSION']['polvl']; ?>
';"<?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist/<?php echo $GLOBALS['_SESSION']['polvl']; ?>
';"<?php endif; ?> />
                                         <?php if ($this->_tpl_vars['permitted'] == 'Yes' && $this->_tpl_vars['usertype'] != 'orgadmin'): ?>
                                         <?php if ($this->_tpl_vars['auth'] != 'y'): ?>
                                         <?php if ($this->_tpl_vars['act'] == 'y'): ?>
                                         <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-accept.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        <?php elseif ($this->_tpl_vars['isue'] == 'y'): ?>
                                        <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-issue.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        <?php else: ?>
                                        <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-verify.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-authorise.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        <?php endif; ?>
                                        <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
                                        <?php endif; ?>
                                        <?php if ($this->_tpl_vars['crt_inv'] == 'yes'): ?>
                                        <span style="cursor:pointer;" onclick="$('#view').val('crtinv');$('#frmadd').submit();"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
createinvoice-btn.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></span>
                                        <?php endif; ?>
                                        <?php if ($this->_tpl_vars['poData']['iStatusID'] == $this->_tpl_vars['acptsts'][0]['iStatusID'] && $this->_tpl_vars['poData']['iaStatusID'] == $this->_tpl_vars['acptsts'][0]['iStatusID'] && ((is_array($_tmp=$this->_tpl_vars['poData']['iaStatusID'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && $this->_tpl_vars['poData']['iaStatusID'] > 0): ?>
                                        <a title="<?php echo $this->_tpl_vars['LBL_PRINT']; ?>
" style="cursor:pointer" class="colorboxfile" rel="<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-print.gif" alt="" id="print_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></a>
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
</div>
<?php echo '
<script type="text/javascript">
    $(".colorboxfile").live("click",function() {
        var id = $(this).attr(\'rel\');
        $.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/po/"+id+"/pop"});
    });
</script>
'; ?>