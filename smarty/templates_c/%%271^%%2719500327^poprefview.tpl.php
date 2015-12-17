<?php /* Smarty version 2.6.0, created on 2015-06-21 18:47:24
         compiled from member/user/poprefview.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'member/user/poprefview.tpl', 45, false),array('modifier', 'trim', 'member/user/poprefview.tpl', 98, false),)), $this); ?>
<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_VIEW_PURCHASE_ORDER']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseorderview/<?php echo $this->_tpl_vars['iPurchaseOrderID'];  if ($this->_tpl_vars['var_msg'] == 'pop'): ?>/pop<?php endif; ?>"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_PO_HEADER']; ?>
</em></a></li>
                                        <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poprefview/<?php echo $this->_tpl_vars['iPurchaseOrderID'];  if ($this->_tpl_vars['var_msg'] == 'pop'): ?>/pop<?php endif; ?>" class="current"><em><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</em></a></li>
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poviewitems/<?php echo $this->_tpl_vars['iPurchaseOrderID'];  if ($this->_tpl_vars['var_msg'] == 'pop'): ?>/pop<?php endif; ?>" ><em><?php echo $this->_tpl_vars['LBL_VIEW_PO_ITEM']; ?>
</em></a></li>
                                    </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg"><?php if ($this->_tpl_vars['usertype'] != 'orgadmin'): ?>&nbsp;<?php echo $this->_tpl_vars['nxtstatus']['vStatusMsg'];  endif; ?>
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
                                <td  width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_SOURCE_DOC']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tSourcingDocument'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_GLOBAL_AGREEMENT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tGlobalAgreement'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_PAYMENT_TERMS']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tPaymentTerms'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_FOB']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tFOB'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_DELIVERY_TERMS']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tDeliveryTerms'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_SHIP_CONTROL']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tShippingControl'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_COND_PAYMENT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tConditionsForPayment'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_PENALTIES']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tPenalties'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_SPEC_INSTRUCT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tSpecialInstruction'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_NOTE']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tNote'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                            </tr>
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
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"><?php echo ((is_array($_tmp=$this->_tpl_vars['poData']['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</textarea></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="bottom" align="center" colspan="3">
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="rst_btn" border="0" style="cursor:pointer; vertical-align:middle;" <?php if ($this->_tpl_vars['poData']['iInvoiceID'] > 0): ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poacptlist/<?php echo $GLOBALS['HTTP_SESSION_VARS']['polvl']; ?>
';"<?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist/<?php echo $GLOBALS['HTTP_SESSION_VARS']['polvl']; ?>
';"<?php endif; ?> />
                                         <?php if ($this->_tpl_vars['permitted'] == 'Yes' && $this->_tpl_vars['usertype'] != 'orgadmin'): ?>
                                         <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-verify.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
                                        <?php endif; ?>
                                        <?php if ($this->_tpl_vars['crt_inv'] == 'yes'): ?>
                                        <span style="cursor:pointer;" onclick="$('#view').val('crtinv');$('#frmadd').submit();"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
createinvoice-btn.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></span>
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