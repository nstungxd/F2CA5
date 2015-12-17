<div class="middle-container">
    <h1>{$LBL_VIEW} {$LBL_RFQ2}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                  <li><a href="{$SITE_URL_DUM}b2rfq2view/{$iRFQ2Id}" ><em>{$LBL_VIEW} {$LBL_RFQ2}</em></a></li>
						  <li><a href="{$SITE_URL_DUM}rfq2bidhistory/{$iRFQ2Id}" class="current"><em>{$LBL_RFQ2} {$LBL_BIDS}</em></a>
						  </li>                  
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg">&nbsp;
                    {if $usertype neq 'orgadmin'}{if $vreq eq 'y' && $permitted eq 'y'}{if $dtls[0].eDelete eq 'Yes'}{$LBL_NEED_TO_VERIFY_FOR_DELETE}{else}{$LBL_NEED_TO_VERIFY}{/if}{elseif $vreq eq 'y'}{$LBL_NEED_TO_VERIFY_BY_OTHERS}{/if}{/if}
                </div>
                <div>{if $dtls[0].iRFQ2Id >0}<span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}rfq2bidhistory/{$iRFQ2Id}')" >{$LBL_VIEW_BID_HISTORY}</a></b></span>{else}&nbsp;{/if}</div>
               <div id="r2bh">
                <div>
						  <div><span class="blue-ore">{$LBL_FILTER} {$LBL_RFQ2} {$LBL_BID}: &nbsp; </span> &nbsp; <input type="text" name="filterrfq2bid" id="filterrfq2bid" style="width:390px";></div>
						  <div>&nbsp;</div>
                       <table cellspacing="3" cellspadding="3" border="0" width="100%">			    
                           <tr>
                               <td><b>{$LBL_RFQCODE}</b></td>
                               <td><b>{$LBL_BIDNUM}</b></td>
                               <td><b>{$LBL_BIDADVANCE}</b></td>
                               <td><b>{$LBL_BIDPRICE}</b></td>
                               <td><b>{$LBL_BIDDATE}</b></td>
                               <td><b>{$LBL_CREATED_BY}</b></td>
                               <td><b>{$LBL_STATUS}</b></td>
                               <td></td>
                           </tr>
                           {section name=i loop=$bidarr}
                           <tr class=listrfq2bid>
                               <td>{$bidarr[i].vRFQ2Code}</td>
                               <td>{$bidarr[i].vBidNum}</td>
                               <td>{$bidarr[i].fBidAdvanceTotal}</td>
                               <td>{$bidarr[i].fBidPriceTotal}</td>
                               <td>{$bidarr[i].dBidDate|calcLTzTime|DateTime:9} {$bidarr[i].dBidDate|calcLTzTime|DateTime:15}</td>
                               <td>{$bidarr[i].vFirstName}&nbsp;{$bidarr[i].vLastName}</td>
                               <td style="text-transform:capitalize;">
										  {if $bidarr[i].eSaved eq 'Yes'}
												{$LBL_SAV}
										  {elseif $bidarr[i].eDelete eq 'Yes'}
												{$LBL_DELETE}
										  {elseif $bidarr[i].eStatus eq 'current'}
												{$LBL_CURRENT}
										  {elseif $bidarr[i].eStatus eq 'outbidded'}
												{$LBL_OUTBIDDED}
										  {else}
												{$bidarr[i].eStatus}
										  {/if}
										 </td>
                               <td><a href="{$SITE_URL_DUM}viewsrfq2bid/{$bidarr[i].iBidId}"><img src="{$SITE_URL_DUM}/images/sm_images/icon-edit.gif" title="View Detail"></a></td>
                           </tr>
                           {/section}
                       </table>
                   </div>
                <div>&nbsp;</div>
			{*if $usertype neq 'orgadmin'}{if $vreq eq 'y' && $permitted eq 'y'}
			 <a class="btllbl" style="width:59px; textarea-decoration:none;" onclick="$('#view').val('verify'); $('#frmadd').submit();"><b>{$LBL_VERIFY}</b></a>
			 <a class="btllbl" style="width:59px; textarea-decoration:none;" onclick="$('#view').val('reject'); $('#frmadd').submit();"><b>{$LBL_REJECT}</b></a>
			{/if}{/if*}	
			<div align="center">
				<a class="btllbl" style="textarea-decoration:none;" href="{$SITE_URL_DUM}b2rfq2view/{$iRFQ2Id}"><b>{$LBL_BACK}</b></a>
			</div>
        </div>
		  <div style="clear:both;">&nbsp;</div>
        </div>
    </div>
</div>
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$("#filterrfq2bid").bind("blur keyup", function(event) {
	    if($.trim($(this).val())=='') {
				$('.listrfq2bid').show();
		  } else {
				$('.listrfq2bid:not(:icontains('+$.trim($(this).val())+'))').hide();
				$('.listrfq2bid:icontains('+$.trim($(this).val())+')').show();
		  }
	 });
});
</script>
{/literal}