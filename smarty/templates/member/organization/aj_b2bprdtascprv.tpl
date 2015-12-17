<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div><h3 align="center">{$LBL_BUYER2_BPRODUCT} {$LBL_ASSOCIATION}</h3></div>
      <div class="clear"></div>
		<div class="inner-gray-bg">
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
            <tr>
               <td width="159px" valign="top">{$LBL_BUYER2}&nbsp; : </td>
               <td>{$arr[0].vBuyer2} ({$arr[0].vCompCode})</td>
			  	</tr>
            <tr>
               <td valign="top">{$LBL_BPRODUCT}&nbsp; : </td>
               <td>{$arr[0].vProduct} ({$arr[0].vProductCode})</td>
			  	</tr>
            <tr>
               <td valign="top">{$LBL_CODE}&nbsp; : </td>
               <td>{$arr[0].vACode}</td>
			  	</tr>
            <tr>
               <td valign="top">{$LBL_GLOBAL_LIMIT}&nbsp; : </td>
               <td>{$arr[0].fGlobalLimit}</td>
            </tr>
            {if $arr[0].fFeePc>0}
            <tr class="fperc">
               <td valign="top">{$LBL_FEE} (%)&nbsp; : </td>
               <td>{$arr[0].fFeePc}</td>
            </tr>
            {else}
            <tr class="fval" style="display:none;">
               <td valign="top">{$LBL_FEE} &nbsp; : </td>
               <td>{$arr[0].fFeeFlat}</td>
            </tr>
            {/if}
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
               <td valign="top">{$LBL_NARRATIVE}&nbsp; : </td>
               <td>{$arr[0].vNarrative}</td>
            </tr>
            <tr>
               <td valign="top">{$LBL_ACCOUNT}1&nbsp; : </td>
               <td>{$arr[0].vAccount1}</td>
            </tr>
            <tr>
               <td valign="top">{$LBL_ACCOUNT}2 : </td>
               <td>{if $arr[0].vAccount2|trim neq ''}{$arr[0].vAccount2}{else}---{/if}</td>
            </tr>
            <tr>
               <td valign="top">{$LBL_ACCOUNT}3 : </td>
               <td>{if $arr[0].vAccount3|trim neq ''}{$arr[0].vAccount3}{else}---{/if}</td>
            </tr>
            <tr>
               <td valign="top">{$LBL_ACCOUNT}4 : </td>
               <td>{if $arr[0].vAccount4|trim neq ''}{$arr[0].vAccount4}{else}---{/if}</td>
            </tr>
            <tr>
               <td valign="top">{$LBL_ACCOUNT}5 : </td>
               <td>{if $arr[0].vAccount5|trim neq ''}{$arr[0].vAccount5}{else}---{/if}</td>
            </tr>
            <tr>
               <td valign="top">{$LBL_ACCOUNT}6 : </td>
               <td>{if $arr[0].vAccount6|trim neq ''}{$arr[0].vAccount6}{else}---{/if}</td>
            </tr>
            <tr>
               <td valign="top">{$LBL_ACCOUNT}7 : </td>
               <td>{if $arr[0].vAccount7|trim neq ''}{$arr[0].vAccount7}{else}---{/if}</td>
            </tr>
            <tr>
               <td valign="top">{$LBL_ACCOUNT}8 : </td>
               <td>{if $arr[0].vAccount8|trim neq ''}{$arr[0].vAccount8}{else}---{/if}</td>
            </tr>
            {if $vrq eq 'vreq' && $vsts eq 'ucv'}
               <tr>
                  <td valign="top">{$LBL_REASON_TO_REJECT} : </td>
                  <td><textarea name="tReasonToReject" id="tReasonToReject" style="width:300px; height:70px;"></textarea></td>
               </tr>
            {/if}
			</table>
		</div>
	</div>
</div>