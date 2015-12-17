<div class="middle-container">
<h1>{$LBL_ASSOCIATION_VIEW}</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div>
			<ul id="inner-tab">
				<li><a class="current"><em>{$LBL_BUYER2_BUYER} {$LBL_ASSOCIATION}</em></li>
		   </ul>
      </div>
		<div class="clear"></div>
		<div class="inner-gray-bg" style="height:390px;">
      <form id="frmadd" name="frmadd" method="post" action="{$SITE_URL}index.php?file=or-b2buyerasoc_a">
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
                     <div><span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}index.php?file=or-b2buyerhistory&id={$iAssociationId}')" >{$LBL_VIEW_HISTORY}</a></b></span></div>
                  </td>
               </tr>
               <tr>
                  <td width="190px" valign="top">{$LBL_BUYER2}&nbsp; : </td>
                  <td>{$arr[0].vBuyer2} ({$arr[0].vCompCode})</td>
				  	</tr>
               <tr>
                  <td width="190px" valign="top">{$LBL_BUYER}&nbsp; : </td>
                  <td>{$arr[0].vBuyer} ({$arr[0].vCompCode})</td>
				  	</tr>
               <tr>
                  <td width="190px" valign="top">{$LBL_CODE}&nbsp; : </td>
                  <td>{$arr[0].vACode}</td>
				  	</tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}1 {$LBL_TITLE} : </td>
                  <td>{$arr[0].vAccount1}</td>
               </tr>
					<tr>
                  <td valign="top">{$LBL_ACCOUNT}1 {$LBL_CODE}&nbsp; : </td>
                  <td>{$arr[0].vAcc1Code}</td>
               </tr>
					<tr>
                  <td valign="top">{$LBL_CURRENCY}1&nbsp; : </td>
                  <td>{$arr[0].vCurrency1}</td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}2 {$LBL_TITLE} : </td>
                  <td>{if $arr[0].vAccount2|trim neq ''}{$arr[0].vAccount2}{else}---{/if}</td>
               </tr>
					<tr>
                  <td valign="top">{$LBL_ACCOUNT}2 {$LBL_CODE}&nbsp; : </td>
                  <td>{$arr[0].vAcc2Code}</td>
               </tr>
					<tr>
                  <td valign="top">{$LBL_CURRENCY}2&nbsp; : </td>
                  <td>{$arr[0].vCurrency2}</td>
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
								<span class="btllbl" style=""><a href="{$SITE_URL_DUM}b2buyerasocvlist"><b id="btnSubmit">{$LBL_CANCEL}</b></a></span>
							{else}
	                     <span class="btllbl" style=""><a href="{$SITE_URL_DUM}b2buyerasoclist"><b id="btnSubmit">{$LBL_CANCEL}</b></a></span>
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