<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	 <td colspan="3"><u><b>{$LBL_INVOICE_DETAILS}</b></u></td>
</tr>
<tr><td colspan="3" height="1px" style="border-top:1px solid #cccccc; line-height:1px; height:1px;">&nbsp;</td></tr>
<tr>
	 <td width="190">{$LBL_INV_CODE} </td>
	 <td  width="1">:</td>
	 <td class="blue-ore">
		  <a target="_blank" style="text-decoration:underline; cursor:pointer;" onclick="openpopup('{$SITE_URL_DUM}invoiceview/{$dtls[0].iInvoiceID}/pop');">{$dtls[0].vInvoiceCode}</a>
	 </td>
</tr>
<tr>
	 <td >{$LBL_BUYER}</td>
	 <td>:</td>
	 <td class="">{$dtls[0].vBuyerName}</td>
</tr>
<tr>
	 <td >{$LBL_SUPPLIER}</td>
	 <td>:</td>
	 <td class="">{$dtls[0].vSupplierName}</td>
</tr>
<tr>
	 <td >{$LBL_BANK}</td>
	 <td>:</td>
	 <td class="">{$dtls[0].vBankName}</td>
</tr>
<tr>
	 <td >{$LBL_BANK_CODE}</td>
	 <td>:</td>
	 <td class="">{$dtls[0].vBankCode}</td>
</tr>
<tr>
	 <td >{$LBL_ACCOUNT}</td>
	 <td>:</td>
	 <td class="">{$dtls[0].vAccountName}</td>
</tr>
<tr>
	 <td >{$LBL_ACCOUNT} {$LBL_NUMBER}</td>
	 <td>:</td>
	 <td class="">{$dtls[0].vAccountNumber}</td>
</tr>
<tr>
	 <td >{$LBL_INVOICE_PAYABLE_DATE}</td>
	 <td>:</td>
	 <td class="">{if $dtls[0].dNetPaymentdate neq '0000-00-00'}{$dtls[0].dNetPaymentdate|DateTime:10}{else}---{/if}</td>
</tr>
<tr>
	 <td >{$LBL_ACCEPTED} {$LBL_DATE}</td>
	 <td>:</td>
	 <td class="">{if $dtls[0].dAcceptedDate neq '0000-00-00'}{$dtls[0].dAcceptedDate|DateTime:10}{else}---{/if}</td>
</tr>
<tr>
	 <td >{$LBL_INVOICE_PAYABLE} ({$LBL_ACCEPTED}) {$LBL_AMOUNT}</td>
	 <td>:</td>
	 <td class="ipaam">{$dtls[0].fAcceptedAmount}</td>
</tr>
<tr>
	 <td >{$LBL_INVOICE_TOTAL}</td>
	 <td>:</td>
	 <td class="">{$dtls[0].fInvoiceTotal}</td>
</tr>
<tr>
	 <td >{$LBL_CURRENCY}</td>
	 <td>:</td>
	 <td class="">{$dtls[0].vCurrency}</td>
</tr>

{*if $invattachs|is_array && $invattachs|@count>0}
<tr>
	 <td width="150">{$LBL_ATTACHMENTS} </td>
	 <td  width="1">:</td>
	 <td class="">
		  {section name="l" loop=$invattachs}
			  {if $smarty.section.l.index>0}, {/if}
			  <a {*href="{$invattachs[l]}"} class="colorbox" onmouseover="// CallColoerBox(this.href,750,500,'options');" onclick="return openpopup('{$invattachs[l]}');" style="cursor:pointer;">{$LBL_FILE}-{$smarty.section.l.index+1}</a>
		  {/section}
	 </td>
</tr>
{/if*}

{*<tr>
	 <td colspan="2">&nbsp;</td>
	 <td class="" align="right">
		  <a href="{$SITE_URL_DUM}invoiceview/{$dtls[0].iInvoiceID}" target="_blank">{$LBL_VIEW} {$LBL_INVOICE_DETAILS}</a>
	 </td>
</tr>*}
<tr><td colspan="3" style="border-top:1px solid #cccccc;">&nbsp;</td></tr>

<tr>
	 <td>{$LBL_TYPE}  </td>
	 <td>:</td>
	 <td>{$dtls[0].eAuctionType}</td>
</tr>
<tr>
	 <td>{$LBL_BID_CRITERIA}</td>
	 <td>:</td>
	 <td>{$dtls[0].eBidCriteria}</td>
</tr>
<tr>
	 <td>{$LBL_START_DATE}</td>
	 <td>:</td>
	 <td>{$dtls[0].dStartDate|DateTime:10}</td>
</tr>
<tr>
	 <td>{$LBL_END_DATE}</td>
	 <td>:</td>
	 <td>{$dtls[0].dEndDate|DateTime:10}</td>
</tr>
<tr>
	 <td>{$LBL_ADVANCE}</td>
	 <td>:</td>
	 <td>{$dtls[0].fAdvanceMinPc}% ({$dtls[0].fAdvanceMinAmt})</td>
</tr>
<tr>
	 <td>{$LBL_PRICE}</td>
	 <td>:</td>
	 <td>{$dtls[0].fPriceMaxPc}% ({$dtls[0].fPriceMaxAmt})</td>
</tr>
{*<tr>
	 <td>{$LBL_BID_INTERVAL_AMOUNT}</td>
	 <td>:</td>
	 <td>{$dtls[0].fIntervalPrice}</td>
</tr>*}
<tr>
	 <td>{$LBL_INSTRUCTIONS_CONDITIONS}</td>
	 <td>:</td>
	 <td style="word-wrap:break-word;">{if $dtls[0].tInstruction|trim neq ''}{$dtls[0].tInstruction}{else}---{/if}</td>
</tr>
<tr>
	 <td>{$LBL_DESCRIPTION}</td>
	 <td>:</td>
	 <td style="word-wrap:break-word;">{if $dtls[0].tDescription|trim neq ''}{$dtls[0].tDescription}{else}---{/if}</td>
</tr>
<tr>
	 <td>{$LBL_PRODUCT_TYPE}</td>
	 <td>:</td>
	 <td>{$rfq2pb2_dtls[0].ePType}</td>
</tr>
<tr>
	 <td>{$LBL_PRODUCT}</td>
	 <td>:</td>
	 <td>{$product_dtls[0].vProductName} ({$product_dtls[0].vProductCode})</td>
</tr>
</table>