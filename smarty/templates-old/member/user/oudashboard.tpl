{assign var="field" value="vStatus_"|cat:$LANG}
<div class="middle-container">
<h1>{$LBL_DASHBOARD}</h1>
<div class="middle-containt sortable" id="one">
   <div class="statistics-main-box" id="foo_1">
   <div class="statistics-box">
		<h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>{$LBL_STATISTICS}</h2>
      <div class="statistics-text">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
 			<tr>
      		<td>&nbsp;</td>
      		{section name="l" loop=$sts}
      		<td height="25px" width="50px" align="center" class="listing-name-blue-1">
					{$sts[l].vStatus|htmlentities}
				</td>
      		{/section}
      		<td width="50px" align="center" class="listing-name-blue-1">{$LBL_TOTAL}</td>
			</tr>
			{if $orgtype neq 'Supplier'}
			<tr>
      		<td class="listing-name-grey-border-to-1">{$LBL_PO_ISSUANCE}</td>
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $crstatisu[0].pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','Create','{$crpo}','isu')">{/if}{$crstatisu[0].pocnt}{if $crstatisu[0].pocnt >0}</a>{/if}</td>
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $vstatistics[0].pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','Verify','{$povisu}','isu')">{/if}{$vstatistics[0].pocnt}{if $vstatistics[0].pocnt >0}</a>{/if}</td>
      		{assign var="poisusts" value=$isustats.poisu}
      		{foreach key="ky" item="itm" from=$poisusts}
      		{if $itm.eFor eq 'PO'}
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">
      			<!--{*assign var='id' value=*}-->
					{if $itm.pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','{$itm.vStatus_en}','{$ky}','isu')">{/if}{$itm.pocnt}{if $itm.pocnt >0}</a>{/if}
				</td>
				{/if}
      		{/foreach}
      		<td align="center" class="listing-name-grey-total-1">{if $tisu[0].tpoisu >0}{/if}<b>{$tisu[0].tpoisu}</b>{if $tisu[0].tpoisu >0}{/if}</td>
			</tr>
			{/if}

			{if $orgtype neq 'Buyer'}
			<tr>
      		<td class="listing-name-grey-border-to-1">{$LBL_INVOICE_ISSUANCE}</td>
                {assign var="invisutotal" value=0}
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $crstatisu[0].iocnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','Create','{$crio}','isu')">{assign var="invisutotal" value=`$crstatisu[0].iocnt+$invisutotal`}{/if}{$crstatisu[0].iocnt}</a></td>
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $vstatistics[0].iocnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','Verify','{$iovapt}','isu')">{assign var="invisutotal" value=`$vstatistics[0].iocnt+$invisutotal`}{/if}{$vstatistics[0].iocnt}{if $vstatistics[0].iocnt >0}</a>{/if}</td>
      		{assign var="ioisusts" value=$isustats.invisu}
      		{foreach key="ky" item="itm" from=$ioisusts}
				{*if $itm.vStatus_en neq 'Verify'*}
      		{if $itm.eFor eq 'Invoice'}
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">
					{if $itm.incnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','{$itm.vStatus_en}','{$ky}','isu')">{assign var="invisutotal" value=`$itm.incnt+$invisutotal`}{/if}{$itm.incnt}{if $itm.incnt >0}</a>{/if}
				</td>
				{*/if*}
				{/if}
      		{/foreach}
      		<td align="center" class="listing-name-grey-total-1"><b>{*if $tisu[0].tioisu >0}{/if}{$tisu[0].tioisu}{if $tisu[0].tioisu >0}{/if*}{$invisutotal}</b></td>
			</tr>
			{/if}

			{if $orgtype neq 'Buyer'}
			<tr>
      		<td class="listing-name-grey-border-to-1">{$LBL_PO_ACCEPTANCE}</td>
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $crstatact[0].pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','Create','{$crpo}','acpt')">{/if}{$crstatact[0].pocnt}{if $crstatact[0].pocnt >0}</a>{/if}</td>
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $avstatistics[0].pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','Verify','{$povisu}','acpt')">{/if}{$avstatistics[0].pocnt}{if $avstatistics[0].pocnt >0}</a>{/if}</td>
      		{assign var="poactsts" value=$acptstats.poacpt}
      		{foreach key="ky" item="itm" from=$poactsts}
      		{if $itm.eFor eq 'PO'}
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">
					{if $itm.pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','{$itm.vStatus_en}','{$ky}','acpt')">{/if}{$itm.pocnt}{if $itm.pocnt >0}</a>{/if}
				</td>
				{/if}
      		{/foreach}
      		<td align="center" class="listing-name-grey-total-1">{if $tact[0].tpoact >0}<a href="{$SITE_URL_DUM}poacptlist/all">{/if}<b>{if $tact[0].tpoact >0}{$tact[0].tpoact}{else}0{/if}</b>{if $tact[0].tpoact >0}</a>{/if}</td>
			</tr>
			{/if}

			{if $orgtype neq 'Supplier'}
			<tr>
      		<td class="listing-name-grey-border-to-1">{$LBL_INVOICE_ACCEPTANCE}</td>
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $crstatact[0].iocnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','Create','{$crio}','acpt')">{/if}{$crstatact[0].iocnt}</a></td>
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $avstatistics[0].iocnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','Verify','{$iovapt}','acpt')">{/if}{$avstatistics[0].iocnt}{if $avstatistics[0].iocnt >0}</a>{/if}</td>
      		{assign var="ioactsts" value=$acptstats.invacpt}
      		{foreach key="ky" item="itm" from=$ioactsts}
      		{if $itm.eFor eq 'Invoice'}
      		<td height="29" align="center" class="listing-name-grey-border-nomber-1">
					{if $itm.incnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','{$itm.vStatus_en}','{$ky}','acpt')">{/if}{$itm.incnt}{if $itm.incnt >0}</a>{/if}
				</td>
				{/if}
      		{/foreach}
      		<td align="center" class="listing-name-grey-total-1">{if $tact[0].tioact >0}{/if}<b>{$tact[0].tioact}</b>{if $tact[0].tioact >0}{/if}</td>
			</tr>
			{/if}
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

   <div class="statistics-main-box" id="foo_4">
   <div class="statistics-box">
		<h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>{$LBL_RFQ2}&nbsp;{$LBL_STATISTICS}</h2>
      <div class="statistics-text">
		{assign var="field" value="vStatus_"|cat:$LANG}
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
	       <tr>
				<td>&nbsp;</td>
				{section name="l" loop=$rfq2sts}
				<td height="25px" width="50px" align="center" class="listing-name-blue-1">
					{if $rfq2sts[l].vStatus|htmlentities eq "Accepted"}
						{$LBL_ISSUED}
					{else}
						{$rfq2sts[l].vStatus|htmlentities}
					{/if}
				</td>
      		{/section}
      		<td width="50px" align="center" class="listing-name-blue-1">{$LBL_TOTAL}</td>
		</tr>
		<tr>
			<td class="listing-name-grey-border-to-1">{$LBL_RFQ2}</td>
			{assign var='st' value=0}
			   {section name="l" loop=$rfq2sts}
				<td height="29" align="center" class="listing-name-grey-border-nomber-1">
					{assign var="vl" value=$rfq2sts[l].vStatus_en}
					{if $r2stats.$vl neq ''}
					{if $r2stats.$vl neq 0}
					     <a href="{$SITE_URL_DUM}rfq2list/{if $vl neq 'Rejected'}{$st}{else}{$rfq2sts[l].iStatusID}{/if}">{$r2stats.$vl}</a>
					  {else}
					  {$r2stats.$vl}
					  {/if}
					     {assign var='st' value=$rfq2sts[l].iStatusID}
					{else} x {/if}
				</td>
			   {/section}
			<td align="center" class="listing-name-grey-total-1">
			   {if $r2stats.ttol neq ''}{$r2stats.ttol}{else}0{/if}
			</td>
		</tr>
		<tr>
			<td class="listing-name-grey-border-to-1">{$LBL_AWARD}</td>
				{assign var="tot" value=0}
			   {section name="l" loop=$rfq2sts}
			   <td height="29" align="center" class="listing-name-grey-border-nomber-1">
					{if $rfq2sts[l].iStatusID|in_array:$aworgsts || $rfq2sts[l].vStatus_en eq 'Accepted' || $rfq2sts[l].vStatus_en eq 'Verify'}
                                                {if $rfq2sts[l].vStatus_en eq 'Create'}                                                    
                                                    <a href="{$SITE_URL_DUM}rfq2awardlist/1">{$saved_award[0].tot}</a>
                                                    {assign var="tot" value=`$tot+$saved_award[0].tot`}
                                                {elseif $rfq2sts[l].vStatus_en eq 'Verify'}
                                                    {assign var="vvl" value=$rfq2sts[l].iStatusID}
                                                    {if $rfq2sts[l].iStatusID|in_array:$aworgsts}
                                                        {if $award.$vl neq ''}
                                                        {if $award.$vl > 0}
                                                        <a href="{$SITE_URL_DUM}rfq2awardlist/{$rfq2sts[l].iStatusID}">{$award.$vl}</a>
                                                        {assign var="tot" value=`$tot+$award.$vl`}
                                                        {else}
                                                        {$award.$vl}
                                                        {/if}
                                                        {else} 0 {/if}
                                                    {else} x {/if}
						{elseif $rfq2sts[l].vStatus_en eq 'Rejected'}
                                                    {assign var="cvl" value=$rfq2sts[l].iStatusID}
                                                    <a href="{$SITE_URL_DUM}rfq2awardlist/{$rfq2sts[l].iStatusID}">{$award.$cvl}</a>
                                                    {assign var="tot" value=`$tot+$award.$cvl`}
                                                {elseif $rfq2sts[l].vStatus_en eq 'Accepted'}
                                                    <a href="{$SITE_URL_DUM}rfq2awardlist/2">{$award.$vvl}</a>
                                                    {assign var="tot" value=`$tot+$award.$vvl`}
                                                {else}
                                                    {if $award.$vl neq ''}
                                                    {if $award.$vl > 0}
                                                    <a href="{$SITE_URL_DUM}rfq2awardlist/{$rfq2sts[l].iStatusID}">{$award.$vl}</a>
                                                    {assign var="tot" value=`$tot+$award.$vl`}
                                                    {else}
                                                    {$award.$vl}
                                                    {/if}
                                                    {else} 0 {/if}
                                                {/if}
                                                {assign var="vl" value=$rfq2sts[l].iStatusID}
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
		<h2 style="background:#ececec; border-bottom:1px solid #cecece;">{*<img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>*}{$LBL_RFQ2}&nbsp;{$LBL_COUNTS}</h2>
		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="170px">&nbsp;</td>
				{section name=l loop=$cntsts}
				<td height="25px" align="center" class="listing-name-blue-1">{$cntsts[l]}</td>
				{/section}
			</tr>
			<tr>
				<td class="listing-name-grey-border-to-1" height="25">{$LBL_RFQ2}</td>
				{assign var='ln' value=0}

				{section name="l" loop=$cntsts}
				    {if $cntsts[l] eq 'Not Started'}
				       {assign var='rfq2ls' value=0}
				    {/if}
				    {if $cntsts[l] eq 'Live'}
				       {assign var='rfq2ls' value=1}
				    {/if}
				    {if $cntsts[l] eq 'Completed'}
				       {assign var='rfq2ls' value=2}
				    {/if}
				    {if $cntsts[l] eq 'Cancelled'}
				       {assign var='rfq2ls' value=2}
				    {/if}
					<td height="25" align="center" class="{if $smarty.section.l.index+1 eq $cntsts|@count}listing-name-grey-total-1{else}listing-name-grey-border-nomber-1{/if}">
						{if $cntsts[l]|in_array:$r2sts}{if $cntsts[l] neq 'Awarded'}<a href="{$SITE_URL_DUM}rfq2list/{$rfq2ls}/rfq2count">{$rfq2stats[$ln].cnt}</a>{else}{$rfq2stats[$ln].cnt}{/if}{assign var='ln' value=`$ln+1`}{else} 0 {/if}
					</td>
				{/section}
			</tr>
			<tr><td colspan="11" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
		</table>
      </div>
   </div>
	<div class="login-box">
      <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_RFQ2}</h2>
        <div class="organization-text">
         {section name=l loop=$latestrfq2}
         <span style="display:inline-block; width:230px;"><b style="font-size:12.9px;">{$LBL_RFQ2_CODE}:</b> <a href="{$SITE_URL_DUM}rfq2view/{$latestrfq2[l].iRFQ2Id}"><b style="font-size:12.9px;">{$latestrfq2[l].vRFQ2Code}</b></a></span>
			<p>
            <label style="display:inline-block; width:170px;">{$LBL_INVOICE_CODE}: {$latestrfq2[l].vInvoiceCode} </label> &nbsp; <label>{$LBL_TYPE}: {$latestrfq2[l].eAuctionType}</label> <br/>
            <label style="display:inline-block; width:170px;">{$LBL_START_DATE}: {$latestrfq2[l].dStartDate|calcLTzTime|DateTime:10} </label> &nbsp; <label>{$LBL_END_DATE}:</label>{$latestrfq2[l].dEndDate|calcLTzTime|DateTime:10}<br/>
            <label>{$LBL_STATUS}:</label> {$latestrfq2[l].eAuctionStatus}
         </p>
			{sectionelse}
			<p>
				{$LBL_NO_REC_AVAILABLE}
			</p>
			{/section}
			<em style="padding-left:230px">
			<a href="{$SITE_URL_DUM}rfq2list">{$LBL_VIEW_MORE}</a>
			</em>
      </div>
   </div>
   </div>

   <div class="organization-main-box column" id="foo_2">
      <div class="organization-box">
      <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_BIDS}</h2>
        <div class="organization-text">
         {section name=l loop=$resbid}
         <span style="display:inline-block; width:370px;">
			<b style="font-size:12.9px;">{$LBL_BID_NO}:</b> <a href="{$SITE_URL_DUM}rfq2bidview/{$resbid[l].iBidId}"><b style="font-size:12.9px;">{$resbid[l].vBidNum}</b></a>
			</span>
			<span>{$resbid[l].dBidDate|calcLTzTime|DateTime:10}</span>
         <p>
            <label>{$LBL_RFQ2_CODE}:</label> {$resbid[l].vRFQ2Code}<br/>
            <label>{$LBL_BID} {$LBL_ADVANCE}:</label> {$resbid[l].fBidAdvanceTotal}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
            <label>{$LBL_BID} {$LBL_PRICE}:</label> {$resbid[l].fBidPriceTotal}<br/>
         </p>
			{sectionelse}
			<p>
				{$LBL_NO_REC_AVAILABLE}
			</p>
			{/section}
			<em>
			<a href="{$SITE_URL_DUM}rfq2bidlist">{$LBL_VIEW_MORE}</a>
			</em>
      </div>
   </div>
	 <div class="organization-to-verify-box"><h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_AWARDS}</h2>
	    <div class="organization-to-verify-text">
	       <div class="organization-text">
	       {section name=l loop=$latestaward}
	       <p>
		  <span style="display:inline-block; width:370px;">
			<b style="font-size:12.9px;">{$LBL_AWARD_NO}:</b>&nbsp;<a href="{$SITE_URL_DUM}rfq2awardview/{$latestaward[l].iAwardId}"><b style="font-size:12.9px;">{$latestaward[l].vAwardNum}</b></a></span>
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
		<em><a href="{$SITE_URL_DUM}rfq2awardlist">{$LBL_VIEW_MORE}</a></em>
	    </div>
	 </div>
   </div>
	</div>

   <div class="organization-main-box column" id="foo_3">
   <div class="organization-box">
      <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_PURCHASE_ORDER}</h2>
      <div class="organization-text">
         {section name=l loop=$latestpo}
         <h3><a href="{$SITE_URL_DUM}purchaseorderview/{$latestpo[l].iPurchaseOrderID}">{$latestpo[l].vPoBuyerCode}</a></h3>
         <p>
            {$latestpo[l].supplierorg} {*$latestpo[l].vCompanyName*}, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				{$LBL_CREATED_DATE} : <span>{$latestpo[l].addDate|calcLTzTime|DateTime:'0'}</span> <br />
            {$latestpo[l].vCity}, {$latestpo[l].vState}, {$latestpo[l].vCountry} &nbsp; <br />
            {*}Contact Party :<a href="mailto:info@abccorprjsanf.com"> <span>Party Name</span></a><br />{*}
            {$LBL_STATUS} : <span>Active</span>
         </p>
			{sectionelse}
			<p>
				{$LBL_NO_REC_AVAILABLE}
			</p>
			{/section}
            {if $orgtype eq 'Supplier'}
                <em><a href="{$SITE_URL_DUM}poacptlist">{$LBL_VIEW_MORE}</a></em>
            {else}
                <em><a href="{$SITE_URL_DUM}polist">{$LBL_VIEW_MORE}</a></em>
            {/if}
      </div>
   </div>
   <div class="organization-to-verify-box"><h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_INVOICE_ORDER}</h2>
   <div class="organization-to-verify-text">
      {section name=l loop=$latestio}
      <h3><a href="{$SITE_URL_DUM}invoiceview/{$latestio[l].iInvoiceID}">{$latestio[l].vInvSupplierCode}</a></h3>
      <p>
         {$latestio[l].buyerorg} {*$latestio[l].buyerorg*}, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
			{$LBL_CREATED_DATE} : <span>{$latestio[l].addDate|calcLTzTime|DateTime:'0'}</span> <br />
         {$latestio[l].vCity}, {$latestio[l].vState}, {$latestio[l].vCountry} &nbsp; <br />
         {*}Contact Party :<a href="mailto:info@abccorprjsanf.com"> <span>Party Name</span></a><br />{*}
         {$LBL_STATUS} : <span>Active</span>
      </p>
		{sectionelse}
		<p>
			{$LBL_NO_REC_AVAILABLE}
		</p>
		{/section}
        {if $orgtype eq 'Buyer'}
            <em><a href="{$SITE_URL_DUM}invacptlist">{$LBL_VIEW_MORE}</a></em>
        {else}
            <em><a href="{$SITE_URL_DUM}invoicelist">{$LBL_VIEW_MORE}</a></em>
        {/if}
   </div>
   </div>
</div>

<div class="association-main-box column" id="foo_5">
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
         <td align="right">{*}<em><a href="{$SITE_URL_DUM}inbox" class="viewmorelink">{$LBL_VIEW_MORE}</a></em>{*}</td>
      </tr>
   </table>
   </div>
</div>
</div>
{literal}
<script type="text/javascript">
var cookie = '{/literal}{$tDashboard}{literal}';
</script>
{/literal}
<script type="text/javascript" src="{$SITE_JS_AJAX}jOuDashboard.js" async="async"></script>