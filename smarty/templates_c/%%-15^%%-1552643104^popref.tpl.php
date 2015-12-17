<?php /* Smarty version 2.6.0, created on 2012-05-31 11:59:32
         compiled from member/user/popref.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'member/user/popref.tpl', 47, false),)), $this); ?>
<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_CREATE_PURCHASE_ORDER']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseordercreate/<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
"><em><?php echo $this->_tpl_vars['LBL_PO_HEADER']; ?>
</em></a></li>
                    <li><a class="current" ><em><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
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
index.php?file=u-popref_a"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" value="<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
" />
                        <input type="hidden" name="iPOID" id="iPOID" value="<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
" />
                        <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
                        <input type="hidden" name="eSaved" id="eSaved" value="<?php echo $this->_tpl_vars['podtls'][0]['eSaved']; ?>
" />
                        <input type="hidden" name="Data[eFrom]" id="eFrom" value="" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b><?php echo $this->_tpl_vars['var_msg']; ?>
</b></font></td></tr>
                            <tr>
                                <td  width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_SOURCE_DOC']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><textarea name="Data[tSourcingDocument]" id="tSourcingDocument" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tSourcingDocument'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_GLOBAL_AGREEMENT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tGlobalAgreement]" id="tGlobalAgreement" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tGlobalAgreement'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_PAYMENT_TERMS']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tPaymentTerms]" id="tPaymentTerms" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tPaymentTerms'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_FOB']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tFOB]" id="tFOB" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tFOB'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_DELIVERY_TERMS']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tDeliveryTerms]" id="tDeliveryTerms" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tDeliveryTerms'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_SHIP_CONTROL']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tShippingControl]" id="tShippingControl" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tShippingControl'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_COND_PAYMENT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tConditionsForPayment]" id="tConditionsForPayment" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tConditionsForPayment'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_PENALTIES']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tPenalties]" id="tPenalties" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tPenalties'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_SPEC_INSTRUCT']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tSpecialInstruction]" id="tSpecialInstruction" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tSpecialInstruction'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_NOTE']; ?>
 </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tNote]" id="tNote" cols="100" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['poprefdt'][0]['tNote'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2" height="5"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">
                                    <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseordercreate/<?php echo $this->_tpl_vars['iPurchaseOrderID']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif"  alt="" border="0" id="btnBack" name="Back" style="vertical-align:middle;cursor: pointer;" /></a>&nbsp;
                                                                        <a href="javascript:reset()" ><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reset.gif" alt="" border="0"   style="vertical-align:middle;"/></a>
                                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-next.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes');$('#eFrom').val('Next');; return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                                                        <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
save-btn.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes'); return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                                                    </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div>&nbsp;</div>
            </div>
        </div>
    </div>
    <span id="spn" style="display:hidden;"></span>
    <span id="vldms" style="display:none;"></span>
</div>

<?php echo '
<script type="text/javascript">
    var corg = \'';  echo $this->_tpl_vars['curORGID'];  echo '\';
    var sid = \'';  echo $this->_tpl_vars['sid'];  echo '\';
    var view = \'';  echo $this->_tpl_vars['view'];  echo '\';
    function submitFrm() {
        $(\'#frmadd\').submit();
    }
    function reset(){
        $("#frmadd")[0].reset();
    }
</script>
'; ?>


<?php if ($this->_tpl_vars['vldmsg'] != ''):  echo '
<script type="text/javascript">
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

<?php if ($this->_tpl_vars['mmsg'] != ''):  echo '
<script type="text/javascript">
    $(document).ready(function() {
        var mmsg=\'';  echo $this->_tpl_vars['mmsg'];  echo '\';
        if(mmsg!= \'\' && mmsg != undefined)
            alert(mmsg);
    });
</script>
'; ?>

<?php endif; ?>