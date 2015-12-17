<table cellpadding="0" cellspacing="0" style="background:#f7f7f7; font-size:14px; width:100%; padding:10px;">
{if $dtls|is_array && $dtls neq 'nrf'}
<tr>
	<td colspan="2" align="center" valign="top"><b><u>{$LBL_PRODUCT} {$LBL_DETAILS}</u></b></td>
</tr>
<tr><td colspan="2" align="center" valign="top">&nbsp;</td></tr>
<tr>
	<td width="190px" valign="top">{$LBL_PRODUCT}: </td>
	<td align="left">{$vProductName} {$dtls[0].vProductCode}</td>
</tr>
<tr>
	<td valign="top">{$LBL_AVAILABILITY}: </td>
	<td align="left">{$dtls[0].eAvailability}</td>
</tr>
<tr>
	<td valign="top">{$LBL_FEE}(%): </td>
	<td align="left">{if $dtls[0].fFeePc neq ''}{$dtls[0].fFeePc}{else}---{/if}</td>
</tr>
<tr>
	<td valign="top">{$LBL_FEE_FLAT}: </td>
	<td align="left">{if $dtls[0].fFeeFlat neq ''}{$dtls[0].fFeeFlat}{else}---{/if}</td>
</tr>
<tr>
	<td valign="top">{$LBL_BANK}: </td>
	<td>{$dtls[0].vBankName}</td>
</tr>
<tr>
	<td valign="top">{$LBL_ACCOUNT_NUMBER}: </td>
	<td>{$dtls[0].vBankAccount}</td>
</tr>
{else}
<tr>
	<td valign="top" colspan="2" style="width:100%; padding:10px;"><div align="center"><h2>{$LBL_NO_DETAILS_AVAILABLE}</h2></div></td>
</tr>
{/if}
</table>