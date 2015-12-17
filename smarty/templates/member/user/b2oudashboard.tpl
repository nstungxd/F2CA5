<div class="middle-container">
<h1>{$LBL_DASHBOARD}</h1>
<div class="middle-containt sortable" id="one">

<div class="statistics-main-box" id="foo_1">
   <div class="statistics-box"><h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>{$LBL_STATISTICS}</h2>
      <div class="statistics-text">
		{assign var="field" value="vStatus_"|cat:$LANG}
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
	      <tr><td> &nbsp;</td>
			{section name="l" loop=$sts}
			<td height="25px" width="50px" align="center" class="listing-name-blue-1">
		     {if $sts[l].vStatus|htmlentities eq "Accepted"}
			{$LBL_AUTHORISED}
		     {else}
		     {$sts[l].vStatus|htmlentities}
		     {/if}
			</td>
      	{/section}
      	<td width="50px" align="center" class="listing-name-blue-1">{$LBL_TOTAL}</td>
		</tr>
		<tr>
			<td class="listing-name-grey-border-to-1">{$LBL_BIDS}</td>
			{assign var='st' value=0}
			{section name="l" loop=$sts}
			   <td height="29" align="center" class="listing-name-grey-border-nomber-1">
					{assign var="vl" value=$sts[l].vStatus_en}
					{if $sts[l].vStatus_en=='Auth1' || $sts[l].vStatus_en=='Auth2' || $sts[l].vStatus_en=='Auth3'} x 
					{elseif $bidstatistic.$vl neq ''} {*&& $bidstatistic.$vl neq 'x'*}
					{if $bidstatistic.$vl neq 'x'}<a href="{$SITE_URL_DUM}b2rfq2bidlist/{if $vl neq 'Rejected'}{$st}{else}{$sts[l].iStatusID}{/if}/b2">{/if}{$bidstatistic.$vl}{if $bidstatistic.$vl neq 'x'}</a>{/if}
					{assign var='st' value=$sts[l].iStatusID}
					{else}0{/if}
			   </td>
			{/section}
			<td align="center" class="listing-name-grey-total-1">
			   {if $bidstatistic.ttol neq ''}{$bidstatistic.ttol}{else}0{/if}
			</td>
		</tr>
		<tr>
			<td class="listing-name-grey-border-to-1">{$LBL_AWARD}</td>
				{assign var="tot" value=0}
				{assign var='st' value=0}
				{section name="l" loop=$sts}
					<td height="29" align="center" class="listing-name-grey-border-nomber-1">
						{if $sts[l].iStatusID|in_array:$aworgsts}
							{assign var="vl" value=$sts[l].vStatus_en}
							{assign var="vll" value=$sts[l].iStatusID}
							{if $vl|strtolower eq 'rejected' || $vl|strtolower eq 'accepted'}{assign var="st" value=$vll}{/if}
							{if $award.$st neq ''}
							{if $award.$st neq 0}
							<a href="{$SITE_URL_DUM}b2rfq2awardlist/{*if $vl neq 'Rejected'*}{$st}{*else}{$sts[l].iStatusID}{/if*}">{$award.$st}</a>
							{assign var="tot" value=`$tot+$award.$st`}
							{else}
							{$award.$st}
							{/if}
							{assign var='st' value=$sts[l].iStatusID}
							{else} 0 {/if}
						{else} x {/if}
					</td>
				{/section}
			<td align="center" class="listing-name-grey-total-1">
			   {if $tot neq ''}{$tot}{else}0{/if}
			</td>
		</tr>
		<tr><td colspan="11" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
      </table>
		<div style="height:3px;">&nbsp;</div>
		<h2 style="background:#ececec; border-bottom:1px solid #cecece;">{$LBL_RFQ2}&nbsp;{$LBL_COUNTS}</h2>
		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="170px">&nbsp;</td>
				<td height="25px" align="center" class="listing-name-blue-1">{$LBL_LIVE}</td>
				<td height="25px" align="center" class="listing-name-blue-1">{$LBL_COMPLETED}</td>
				<td height="25px" align="center" class="listing-name-blue-1">{$LBL_AWARDED}</td>
			</tr>
			<tr>
				<td class="listing-name-grey-border-to-1" height="25">{$LBL_RFQ2}</td>				
				<td class="listing-name-grey-border-to-1" align="center"  height="25">{if $getRfq2countarr.Live neq ''}<a href="{$SITE_URL_DUM}b2rfq2list/1/rfq2count">{$getRfq2countarr.Live}</a>{else}0{/if}</td>
				<td class="listing-name-grey-border-to-1" align="center" height="25">{if $getRfq2countarr.Completed neq ''}<a href="{$SITE_URL_DUM}b2rfq2list/2/rfq2count">{$getRfq2countarr.Completed}</a>{else}0{/if}</td>
				<td class="listing-name-grey-total-1" align="center" height="25">{if $getRfq2countarr.Awarded neq ''}{$getRfq2countarr.Awarded}{else}0{/if}</td>
			</tr>
			<tr><td colspan="11" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
		</table>
		<div style="height:3px;">&nbsp;</div>
		<h2 style="background:#ececec; border-bottom:1px solid #cecece;">{*<img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>*}{$LBL_BID}&nbsp;{$LBL_COUNTS}</h2>
		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="170px">&nbsp;</td>
				{*section name=l loop=$cntsts*}
				<td height="25px" align="center" class="listing-name-blue-1">{$LBL_CURRENT}</td>
				<td height="25px" align="center" class="listing-name-blue-1">{$LBL_OUTBIDDED}</td>
				<td height="25px" align="center" class="listing-name-blue-1">{$LBL_AWARDED}</td>
				{*/section*}
			</tr>
			<tr>
				<td class="listing-name-grey-border-to-1" height="25">{$LBL_BIDS}</td>
				{assign var='ln' value=0}
				{section name="l" loop=$bsts}
				{if $bsts[l] eq 'current'}
				{assign var='stsid' value=1}
				{else}
				{assign var='stsid' value=2}
				{/if}
					<td height="25" align="center" class="{if $smarty.section.l.index+1 eq $bsts|@count}listing-name-grey-total-1{else}listing-name-grey-border-nomber-1{/if}">
						{if $bsts[l]|in_array:$b2sts}{if $bsts[l] neq "awarded"}<a href="{$SITE_URL_DUM}b2rfq2bidlist/{$stsid}/bidcount">{$bidstats[$ln].cnt}</a>{else}{$bidstats[$ln].cnt}{/if}{assign var='ln' value=`$ln+1`}{else} 0 {/if}
					</td>
				{/section}
			</tr>
			<tr><td colspan="11" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
		</table>
      </div>
   </div>
	<div class="login-box">
			<h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_LAST_3_LOGIN}</h2>
			<div class="login-text">
			{section name=l loop=$lastlogins}
				 <p>
					 {$LBL_LAST_LOGIN} : {$lastlogins[l].dLoginDate|calcLTzTime|DateTime:7} <br/>
					 {$LBL_IP_ADDRESS} : {$lastlogins[l].vIP}
				 </p>
			{sectionelse}
				<p>
					 {$LBL_NO_REC_AVAILABLE}
				</p>
			{/section}
		</div>
		</div>
</div>
	
<div class="organization-main-box column" id="foo_2">
   <div class="organization-box">
      <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_BIDS}</h2>
        <div class="organization-text">
         {section name=l loop=$resbid}
         <span style="display:inline-block; width:370px;"><b style="font-size:12.9px;">{$LBL_BID_NO}: <a href="{$SITE_URL_DUM}viewsrfq2bid/{$resbid[l].iBidId}"><b style="font-size:12.9px;">{$resbid[l].vBidNum}</b></a></b></span><span display:inline-block;>{$resbid[l].dBidDate|calcLTzTime|DateTime:10}</span>
         <p>
            <label style="display:inline-block; width:90px;"><b>{$LBL_RFQ2_CODE}:</b></label> {$resbid[l].vRFQ2Code}<br/>
            <label style="display:inline-block; width:90px;"><b>{$LBL_BID} {$LBL_ADVANCE}:</b></label> {$resbid[l].fBidAdvanceTotal}<br/>
            <label style="display:inline-block; width:90px;"><b>{$LBL_BID} {$LBL_PRICE}:</b></label> {$resbid[l].fBidPriceTotal}<br/>
            <label style="display:inline-block; width:90px;"><b>{$LBL_STATUS}:</b></label> {$resbid[l].eStatus} <br/>
         </p>
			{sectionelse}
			<p>
				{$LBL_NO_REC_AVAILABLE}
			</p>
			{/section}
         <em><a href="{$SITE_URL_DUM}b2rfq2bidlist">{$LBL_VIEW_MORE}</a></em>
      </div>
   </div>
   <div class="organization-to-verify-box"><h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>{$LBL_AWARDS}</h2>
   <div class="organization-to-verify-text">
      {section name=l loop=$latestaward}
		<p>
			<span style="display:inline-block; width:359px;"><b style="font-size:12.9px;">{$LBL_AWARD_NO}:</b>&nbsp;<a href="{$SITE_URL_DUM}b2rfq2awardview/{$latestaward[l].iAwardId}"><b style="font-size:12.9px;">{$latestaward[l].vAwardNum}</b></a></span>
			<span>{$latestaward[l].dADate|calcLTzTime|DateTime:10}</span><br>
		  <label>{$LBL_RFQ2_CODE}:</label>&nbsp;{$latestaward[l].vRFQ2Code}<br>
		  <label>{$LBL_BUYER2}:</label>&nbsp;{$latestaward[l].vCompanyName}<br>
		  <label>{$LBL_ADVANCE_TOTAL}:</label>&nbsp;{$latestaward[l].fBidAdvanceTotal}<br>
		  <label>{$LBL_PRICE_TOTAL}:</label>&nbsp;{$latestaward[l].fBidPriceTotal}<br>
		  <label>{$LBL_STATUS}:</label>&nbsp;{$latestaward[l].vStatus_en}
	       </p> 
		{sectionelse}
		<p>
			{$LBL_NO_REC_AVAILABLE}
		</p>
		{/section}
		{if $latestaward|@count >0}
      <em><a href="{$SITE_URL_DUM}b2rfq2awardlist">{$LBL_VIEW_MORE}</a></em>
		{/if}
   </div>
   </div>
</div>
	
<div class="association-main-box column" id="foo_5">
   <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_RFQ2}</h2>
   <div class="clear">
      <table width="98%" border="0" align="center" cellpadding="0" class="user-text" cellspacing="0">
	 {section name=l loop=$latestrfq2}
	   
	 <div class="association-text">
		 <span style="display:inline-block; width:370px;"><b style="font-size:12.9px;">{$LBL_RFQ2_CODE}:</b> <a href="{$SITE_URL_DUM}b2rfq2view/{$latestrfq2[l].iRFQ2Id}"><b style="font-size:12.9px;">{$latestrfq2[l].vRFQ2Code}</b></a></span>	 
         <p>
            <label>{$LBL_INVOICE_CODE}:</label> {$latestrfq2[l].vInvoiceCode}<br/>
            <label>{$LBL_AUCTION_TYPE}:</label> {$latestrfq2[l].eAuctionType}<br/>
            <label>{$LBL_START_DATE}:</label> {$latestrfq2[l].dStartDate|calcLTzTime}&nbsp;<br/>
	    <label>{$LBL_END_DATE}:</label>{$latestrfq2[l].dEndDate|calcLTzTime}<br/>
            <label>{$LBL_AUCTION_STATUS}:</label> {$latestrfq2[l].eAuctionStatus}
         </p>
	    
	 </div>
	{sectionelse}
		<div class="association-text">
			<p>
		{$LBL_NO_REC_AVAILABLE}
			</p>
		</div>
	{/section}
	<div class="clear" align="right">
	 <em><a href="{$SITE_URL_DUM}b2rfq2list" class="viewmorelink">{$LBL_VIEW_MORE}&nbsp;&nbsp;</a></em>
	</div>
      </table>
   </div>
</div>   
   
   
<div class="association-main-box column" id="foo_3">
   <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_INBOX} ({$totInboxres})</h2>
   <div class="clear">
      <table width="98%" border="0" align="center" cellpadding="0" class="user-text" cellspacing="0">
      <!--
      <tr>
         <td width="42" height="30" align="center">&nbsp;</td>
         <td width="598">&nbsp;</td>
         <td width="87" align="center"><a href="#"><img src="{$SITE_IMAGES}sm_images/btn-delete-1.gif" alt="" border="0" /></a></td>
      </tr>
-->
       {if $res|@count gt 0}
         {assign var="field" value="vMailSubject_"|cat:$LANG}
         {section name=in loop=$res}
         <tr>
            <td height="30" width="10" align="left" class="user-gray-bot-bor">
               <!--<span class="golden"><input type="checkbox" class="radib-btn" name="checkbox2" id="checkbox2" style="vertical-align:middle;" /></span>-->
            </td>
            <td class="user-gray-bot-bor" height="30" width="79%"><strong><a href="{$SITE_URL_DUM}inboxdetail/{$res[in].iVerifiedID}">{$res[in].$field}</a></strong></td>
            <td align="right" class="user-gray-bot-bor"><strong>{$res[in].dActionDate|calcLTzTime|getInboxDate}</strong></td>
         </tr>
         {/section}
			<tr>
				<td colspan="3" align="right">{if $totInboxres gt $res|@count}<em><a href="{$SITE_URL_DUM}inbox" class="viewmorelink">{$LBL_VIEW_MORE}</a></em>{/if}</td>
			</tr>
      {else}
      <tr>
         <td height="30" colspan="3" align="center" class="user-gray-bot-bor">
            <strong>{$LBL_NO_RECENT_MESSAGES}</strong>
         </td>
      </tr>
      {/if}
      <tr>
         <td align="center">&nbsp;</td>
         <td>&nbsp;</td>
         <td align="right">{*<em><a href="{$SITE_URL_DUM}inbox" class="viewmorelink">{$LBL_VIEW_MORE}</a></em>*}</td>
      </tr>
   </table>
   </div>
</div>

</div>
</div>
{literal}
<script>
var cookie = '{/literal}{$tDashboard}{literal}';
</script>
{/literal}
<script type="text/javascript" src="{$SITE_JS_AJAX}jOuDashboard.js"></script>