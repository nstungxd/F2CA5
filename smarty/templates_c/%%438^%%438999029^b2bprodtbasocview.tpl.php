<?php /* Smarty version 2.6.0, created on 2015-06-22 09:12:37
         compiled from member/organization/b2bprodtbasocview.tpl */ ?>
<div class="middle-container">
    <h1><?php echo $this->_tpl_vars['LBL_ASSOCIATION_VIEW']; ?>
</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a class="current"><em><?php echo $this->_tpl_vars['LBL_BUYER2_BPRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</em></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg" style="height:510px;">
                <form id="frmadd" name="frmadd" method="post" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=or-b2bprodtbasoc_a">
                    <input type="hidden" id="mod" name="mod" value="<?php echo $this->_tpl_vars['mod']; ?>
" />
                    <input type="hidden" id="iAssociationId" name="iAssociationId" value="<?php echo $this->_tpl_vars['iAssociationId']; ?>
" />
                    <div>&nbsp;</div>
                    <div>
                                                <?php if ($this->_tpl_vars['msg'] != ''): ?>
                                                                        <?php endif; ?>
                        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr>
                                <td>&nbsp;</td>
                                <td align="right">
                                    <?php if ($this->_tpl_vars['vrq'] == 'vreq' && $this->_tpl_vars['vsts'] != 'ucv'): ?>
                                    <span class="msg"><?php echo $this->_tpl_vars['MSG_NEED_VERIFICATION_FROM_OTHERS']; ?>
</span>
                                    <?php elseif ($this->_tpl_vars['vrq'] == 'vreq' && $this->_tpl_vars['vsts'] == 'ucv'): ?>
                                    <span class="msg"><?php echo $this->_tpl_vars['vmsg']; ?>
</span>
                                    <?php endif; ?>
                                    <div><span style="float:right;"><b><a class="" href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
index.php?file=or-b2bprdtbhistory&id=<?php echo $this->_tpl_vars['iAssociationId']; ?>
')" ><?php echo $this->_tpl_vars['LBL_VIEW_HISTORY']; ?>
</a></b></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['vBuyer2']; ?>
 (<?php echo $this->_tpl_vars['arr'][0]['vCompCode']; ?>
)</td>
                            </tr>
                            <tr>
                                <td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_BPRODUCT']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['vProduct']; ?>
 (<?php echo $this->_tpl_vars['arr'][0]['vProductCode']; ?>
)</td>
                            </tr>
                            <tr>
                                <td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['vBuyer']; ?>
 (<?php echo $this->_tpl_vars['arr'][0]['vB2Code']; ?>
)</td>
                            </tr>
                            <tr>
                                <td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_CODE']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['vACode']; ?>
</td>
                            </tr>
                                                        <tr class="fval">
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_FEE']; ?>
 &nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fFeeFlat']; ?>
</td>
                            </tr>
                                                        <tr class="fperc">
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_FEE']; ?>
 (%)&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fFeePc']; ?>
</td>
                            </tr>
                                                        <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_ADVANCE']; ?>
 (%)&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fAdvancePc']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_MINIMUM_VALUE']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fMinValue']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_MAXIMUM_VALUE']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fMaxValue']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_AUTO_ACCEPT_LIMIT']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fAutoAcceptLimit']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_AUTO_ACCEPT_ADVANCE']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fAutoAcceptAdvance']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_AUTO_ACCEPT_PRICE']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fAutoAcceptPrice']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_DAYS']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['iDays']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_TOTAL_GLOBAL_LIMIT']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fTotalGlobalLimit']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_TOTAL_OUTSTANDING_AMOUNT']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['fTotalOutstandingAmt']; ?>
</td>
                            </tr>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_NARRATIVE']; ?>
&nbsp; : </td>
                                <td><?php echo $this->_tpl_vars['arr'][0]['vNarrative']; ?>
</td>
                            </tr>
                            <?php if ($this->_tpl_vars['vrq'] == 'vreq' && $this->_tpl_vars['vsts'] == 'ucv'): ?>
                            <tr>
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 : </td>
                                <td><textarea name="tReasonToReject" id="tReasonToReject" style="width:300px; height:70px;"></textarea></td>
                            </tr>
                            <?php endif; ?>
                            <tr><td colspan="2" align="right">&nbsp;</td></tr>
                            <tr>
                                <td valign="top">&nbsp;</td>
                                <td>
                                    <?php if ($this->_tpl_vars['vrq'] == 'vreq' && $this->_tpl_vars['vsts'] == 'ucv'): ?>
                                    <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('verify');"><?php echo $this->_tpl_vars['LBL_VERIFY']; ?>
</b></span>
                                    <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('reject');"><?php echo $this->_tpl_vars['LBL_REJECT']; ?>
</b></span>
                                    <?php endif; ?>
                                    <?php if ($this->_tpl_vars['vrq'] == 'vreq'): ?>
                                    <span class="btllbl" style=""><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2bprdtbasocvlist"><b id="btnSubmit"><?php echo $this->_tpl_vars['LBL_CANCEL']; ?>
</b></a></span>
                                    <?php else: ?>
                                    <span class="btllbl" style=""><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2bprodtbasoclist"><b id="btnSubmit"><?php echo $this->_tpl_vars['LBL_CANCEL']; ?>
</b></a></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>&nbsp;</div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo '
<script type="text/javascript">
    function submitfrm(md) {
        $(\'#mod\').val(md);
        $(\'#frmadd\')[0].submit();
    }
</script>
'; ?>