<div class="middle-container">
    <h1>{$LBL_VIEW_PURCHASE_ORDER}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}purchaseorderview/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}" class="current"><em>{$LBL_VIEW} {$LBL_PO_HEADER}</em></a></li>
                    {if $imgdt neq 'yes'}
                    <li><a href="{$SITE_URL_DUM}poprefview/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_PREFERENCES}</em></a></li>
                    <li><a href="{$SITE_URL_DUM}poviewitems/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}" ><em>{$LBL_VIEW_PO_ITEM}</em></a></li>
                    {/if}
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg">{if $usertype neq 'orgadmin'}&nbsp;{$nxtstatus.vStatusMsg|htmlentities}{/if}
                    {if $nxtstatus.vStatusMsg eq ''}
                    {if $invstat eq 'ureview'}
                    {$LBL_INV_STATUS_UNDER_REVIEW}
                    {elseif $invstat eq 'rjct'}
                    {$LBL_INV_STATUS_REJECTED}
                    {elseif $invstat eq 'isu'}
                    {$LBL_INV_STATUS_ISSUED}
                    {elseif $invstat eq 'acpt'}
                    {$LBL_INV_STATUS_ACCEPTED}
                    {elseif $invstat eq 'prt'}
                    {$LBL_INV_STATUS_PARTIAL_INVOICE}
                    {elseif $invstat eq 'act'}
                    {$LBL_STATUS}: {$LBL_ACCEPTED}
                    {/if}
                    {/if}
                </div>
                <div><span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}poviewhistory/{$iPurchaseOrderID}')" >{$LBL_VIEW_HISTORY}</a></b></span></div>
                <div class="clear"></div>
                <div>
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-purchaseordercreate_a" method="post">
                        <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" value="{$iPurchaseOrderID}" />
                        <input type="hidden" name="iPOID" id="iPOID" value="{$iPurchaseOrderID}" />
                        <input type="hidden" name="nstatus" id="nstatus" value="{$nxtstatus.iStatusID}" />
                        <input type="hidden" name="edelete" id="edelete" value="{$poData.eDelete}" />
                        <input type="hidden" name="view" id="view" value="{$view}" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b>{$var_msg}</b></font></td></tr>
                            <tr>
                                <td width="225">{$LBL_BUYER} {$LBL_COMP_NAME}</td>
                                <td>:</td>
                                <td class="blue-ore">{$poData.vBuyerCompanyName}</td>
                            </tr>
                            <tr>
                                <td width="225">{$LBL_BUYER} {$LBL_CODE} </td>
                                <td>:</td>
                                <td class="blue-ore">
                                    {$poData.vBuyerCode}
                                </td>
                            </tr>
                            {if $imgdt neq 'yes'}
                            <tr>
                                <td>{$LBL_SUPPLIER} {$LBL_COMPANY} </td>
                                <td>:</td>
                                <td>
                                    {$poData.vSupplierName}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_SUPPLIER} {$LBL_CONTACT_PARTY}  </td>
                                <td>:</td>
                                <td>
                                    {$poData.vSupplierContactParty}
                                </td>
                            </tr>
                            {/if}
                            <tr>
                                <td>{$LBL_PO_BUYER_CODE} </td>
                                <td>:</td>
                                <td>
                                    {$poData.vPoBuyerCode}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_PO_CODE}  </td>
                                <td>:</td>
                                <td>
                                    {$poData.vPOCode}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_ORDER_DATE} </td>
                                <td>:</td>
                                <td>
                                    {$poData.dOrderDate|DateTime:'10'}
                                </td>
                            </tr>
                            {if $imgdt neq 'yes'}
                            <tr>
                                <td valign="top">{$LBL_ORDER_DESCRIPTION} </td>
                                <td valign="top">:</td>
                                <td>
                                    {$poData.tOrderDescription}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_OPENING_UNIT}  </td>
                                <td>:</td>
                                <td>{$poData.iOpeningUnit}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SUPPLIER} {$LBL_ORDER_NUMBER}  </td>
                                <td>:</td>
                                <td>{$poData.vSupplierOrderNum}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_CARRIER} </td>
                                <td>:</td>
                                <td>{$poData.tCarrier}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_LINE_ITEM_TAX}  </td>
                                <td>:</td>
                                <td>{$poData.eLineItemTax}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_VAT}  </td>
                                <td>:</td>
                                <td>{$poData.fVAT}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_OTHER_TAX} </td>
                                <td>:</td>
                                <td>{$poData.fOther_tax_1}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_PARTY}  </td>
                                <td>:</td>
                                <td>{$poData.vShipToParty}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_ADDR_LINE}1  </td>
                                <td>:</td>
                                <td>{$poData.vShipToAddressLine1}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_ADDR_LINE}2 </td>
                                <td>:</td>
                                <td>{$poData.vShipToAddressLine2}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_CITY}  </td>
                                <td>:</td>
                                <td>{$poData.vShipToCity}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_COUNTRY}  </td>
                                <td>:</td>
                                <td>
                                    {$poData.vShipToCountry}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_STATE}  </td>
                                <td>:</td>
                                <td>{$poData.vShipToState}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_ZIP_CODE}  </td>
                                <td>:</td>
                                <td>{$poData.vShipToZipCode}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_CONTACT_PARTY}  </td>
                                <td>:</td>
                                <td>{$poData.vShipToContactParty}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_CONTACT_TELEPHONE}  </td>
                                <td>:</td>
                                <td>{$poData.vShipToContactTelephone}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO}  {$LBL_PARTY}  </td>
                                <td>:</td>
                                <td>{$poData.vBillToParty}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ADDR_LINE}1  </td>
                                <td>:</td>
                                <td>{$poData.vBillToAddLine1}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ADDR_LINE}2 </td>
                                <td>:</td>
                                <td>{$poData.vBillToAddLine2}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CITY} </td>
                                <td>:</td>
                                <td>{$poData.vBillToCity}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_COUNTRY}  </td>
                                <td>:</td>
                                <td>
                                    {$poData.vBillToCountry}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_STATE} </td>
                                <td>:</td>
                                <td>{$poData.vBillToState}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ZIP_CODE}  </td>
                                <td>:</td>
                                <td>{$poData.vBillToZipCode}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CONTACT_PARTY}  </td>
                                <td>:</td>
                                <td>{$poData.vBillToContactParty}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}  </td>
                                <td>:</td>
                                <td>{$poData.vBillToContactTelephone}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_CURRENCY}  </td>
                                <td>:</td>
                                <td>{$poData.vCurrency}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_PO_TOTAL} </td>
                                <td>:</td>
                                <td>{$poData.fPOTotal}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRE_PAYMENT} </td>
                                <td>:</td>
                                <td>{$poData.fPrepayment}</td>
                            </tr>
                            {else}
                            <tr>
                                <td colspan="3"><hr/></td>
                            </tr>
                            <tr>
                                <td ><b>{$LBL_OTHER_DETAILS} : </b></td>
                                <td >&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="3" align="center"><div id="img" class="img-details"><img src="{$img}" /></div></td>
                            </tr>
                            {/if}
                            {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                            </tr>
                            {elseif $poData.tReasonToReject|trim neq '' && $poData.eStatus eq $rjtsts}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3" readonly="readonly">{$poData.tReasonToReject|trim}</textarea></td>
                            </tr>
                            {/if}
                            {if $poAttachments|@count gt 0}
                            <tr>
                                <td valign="top">{$LBL_UPLOADED_FILES}</td>
                                <td valign="top">:</td>
                                <td>
                                    <div id="files_list" class="file_upload">
                                        <ul style="list-style-type: none">
                                            {foreach from=$poAttachments item="poAttach"}
                                            <li>
                                                <a href="javascript:openpopup('{$SITE_URL}upload/attachment_docs/po/{$iPurchaseOrderID}/{$poAttach.vFile}')" > {$poAttach.vFile}</a>
                                            </li>
                                            {/foreach}
                                        </ul>

                                    </div>
                                </td>
                            </tr>
                            {/if}
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="bottom" align="center" colspan="3">
                                    <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="rst_btn" border="0" style="cursor:pointer; vertical-align:middle;" {if $curORGID eq $poData.iSupplierOrganizationID}onclick="location.href='{$SITE_URL_DUM}poacptlist/{$smarty.session.polvl}';"{else}onclick="location.href='{$SITE_URL_DUM}polist/{$smarty.session.polvl}';"{/if} />
                                         {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                                         {if $auth neq 'y'}
                                         {if $act eq 'y'}
                                         <img src="{$SITE_IMAGES}btn-accept.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        {elseif $isue eq 'y'}
                                        <img src="{$SITE_IMAGES}btn-issue.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        {else}
                                        <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        {/if}
                                        {else}
                                        <img src="{$SITE_IMAGES}btn-authorise.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        {/if}
                                        <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
                                        {/if}
                                        {if $crt_inv eq 'yes'}
                                        <span style="cursor:pointer;" onclick="$('#view').val('crtinv');$('#frmadd').submit();"><img src="{$SITE_IMAGES}createinvoice-btn.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></span>
                                        {/if}
                                        {if $poData.iStatusID eq $acptsts[0].iStatusID && $poData.iaStatusID eq $acptsts[0].iStatusID && $poData.iaStatusID|trim neq '' && $poData.iaStatusID >0}
                                        <a title="{$LBL_PRINT}" style="cursor:pointer" class="colorboxfile" rel="{$iPurchaseOrderID}"><img src="{$SITE_IMAGES}btn-print.gif" alt="" id="print_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></a>
                                        {/if}
                                        {*if $crt_inv eq 'yes'}
                                        &nbsp;<span style="background:url({$SITE_IMAGES}bg.png) repeat; padding:3px; border:1px solid #cccccc;"><span onclick="$('#view').val('crtinv');$('#frmadd').submit();" style="cursor:pointer; color:#256292;"><b>{$LBL_CREATE_INV}</b></span></span>
                                        <!--<img src="{$SITE_IMAGES}bg.png" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" />-->
                                        {/if*}
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
{literal}
<script type="text/javascript">
    $(".colorboxfile").live("click",function() {
        var id = $(this).attr('rel');
        $.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/po/"+id+"/pop"});
    });
</script>
{/literal}