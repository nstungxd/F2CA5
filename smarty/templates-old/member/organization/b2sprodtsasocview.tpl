<div class="middle-container">
    <h1>{$LBL_ASSOCIATION_VIEW}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a class="current"><em>{$LBL_BUYER2_SPRODUCT_SUPPLIER} {$LBL_ASSOCIATION}</em></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg" style="height:510px;">
                <form id="frmadd" name="frmadd" method="post" action="{$SITE_URL}index.php?file=or-b2sprodtsasoc_a">
                    <input type="hidden" id="mod" name="mod" value="{$mod}" />
                    <input type="hidden" id="iAssociationId" name="iAssociationId" value="{$iAssociationId}" />
                    <div>&nbsp;</div>
                    <div>
                        {*<span id="prc" style="display:none; float:right;"> <img src="{$SITE_IMAGES}sm_images/progress.gif" /> Processing ... </span>*}
                        {if $msg neq ''}
                        {*<div class="msg">{$msg}</div>*}
                        {*literal}
                        <script>
                            $(document).ready(function() {
                                var msg='{/literal}{$msg}{literal}';
                                if(msg!= '' && msg != undefined)
                                    alert(msg);
                            });
                        </script>
                        {/literal*}
                        {/if}
                        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr>
                                <td>&nbsp;</td>
                                <td align="right">
                                    {if $vrq eq 'vreq' && $vsts neq 'ucv'}
                                    <span class="msg">{$MSG_NEED_VERIFICATION_FROM_OTHERS}</span>
                                    {elseif $vrq eq 'vreq' && $vsts eq 'ucv'}
                                    <span class="msg">{$vmsg}</span>
                                    {/if}
                                    <div><span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}index.php?file=or-b2sprdtshistory&id={$iAssociationId}')" >{$LBL_VIEW_HISTORY}</a></b></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="190px" valign="top">{$LBL_BUYER2}&nbsp; : </td>
                                <td>{$arr[0].vBuyer2} ({$arr[0].vCompCode})</td>
                            </tr>
                            <tr>
                                <td width="190px" valign="top">{$LBL_SPRODUCT}&nbsp; : </td>
                                <td>{$arr[0].vProduct} ({$arr[0].vProductCode})</td>
                            </tr>
                            <tr>
                                <td width="190px" valign="top">{$LBL_SUPPLIER}&nbsp; : </td>
                                <td>{$arr[0].vSupplier} ({$arr[0].vSCode})</td>
                            </tr>
                            <tr>
                                <td width="190px" valign="top">{$LBL_CODE}&nbsp; : </td>
                                <td>{$arr[0].vACode}</td>
                            </tr>
                            {*if $arr[0].fFeeFlat>0*}
                            <tr class="fval">
                                <td valign="top">{$LBL_FEE} &nbsp; : </td>
                                <td>{$arr[0].fFeeFlat}</td>
                            </tr>
                            {*else*}
                            <tr class="fperc">
                                <td valign="top">{$LBL_FEE} (%)&nbsp; : </td>
                                <td>{$arr[0].fFeePc}</td>
                            </tr>
                            {*/if*}
                            <tr>
                                <td valign="top">{$LBL_ADVANCE} (%)&nbsp; : </td>
                                <td>{$arr[0].fAdvancePc}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_MINIMUM_VALUE}&nbsp; : </td>
                                <td>{$arr[0].fMinValue}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_MAXIMUM_VALUE}&nbsp; : </td>
                                <td>{$arr[0].fMaxValue}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_AUTO_ACCEPT_LIMIT}&nbsp; : </td>
                                <td>{$arr[0].fAutoAcceptLimit}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_AUTO_ACCEPT_ADVANCE}&nbsp; : </td>
                                <td>{$arr[0].fAutoAcceptAdvance}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_AUTO_ACCEPT_PRICE}&nbsp; : </td>
                                <td>{$arr[0].fAutoAcceptPrice}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_DAYS}&nbsp; : </td>
                                <td>{$arr[0].iDays}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_TOTAL_GLOBAL_LIMIT}&nbsp; : </td>
                                <td>{$arr[0].fTotalGlobalLimit}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_TOTAL_OUTSTANDING_AMOUNT}&nbsp; : </td>
                                <td>{$arr[0].fTotalOutstandingAmt}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_NARRATIVE}&nbsp; : </td>
                                <td>{$arr[0].vNarrative}</td>
                            </tr>
                            {if $vrq eq 'vreq' && $vsts eq 'ucv'}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} : </td>
                                <td><textarea name="tReasonToReject" id="tReasonToReject" style="width:300px; height:70px;"></textarea></td>
                            </tr>
                            {/if}
                            <tr><td colspan="2" align="right">&nbsp;</td></tr>
                            <tr>
                                <td valign="top">&nbsp;</td>
                                <td>
                                    {if $vrq eq 'vreq' && $vsts eq 'ucv'}
                                    <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('verify');">{$LBL_VERIFY}</b></span>
                                    <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('reject');">{$LBL_REJECT}</b></span>
                                    {/if}
                                    {if $vrq eq 'vreq'}
                                    <span class="btllbl" style=""><a href="{$SITE_URL_DUM}b2sprdtsasocvlist"><b id="btnSubmit">{$LBL_CANCEL}</b></a></span>
                                    {else}
                                    <span class="btllbl" style=""><a href="{$SITE_URL_DUM}b2sprdtsasoclist"><b id="btnSubmit">{$LBL_CANCEL}</b></a></span>
                                    {/if}
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
{literal}
<script type="text/javascript">
    function submitfrm(md) {
        $('#mod').val(md);
        $('#frmadd')[0].submit();
    }
</script>
{/literal}