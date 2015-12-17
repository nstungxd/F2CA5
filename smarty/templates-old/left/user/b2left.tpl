<div class="left-menu">
    <h1>{$LBL_NAVIGATION}</h1>
          <dl>{$LBL_DASHBOARD}</dl>
    <ul {if '/(.*)(oudashboard)(.*)/'|preg_match:$currentUrl || '/(.*)(inbox)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
         <li><a href="{$SITE_URL_DUM}oudashboard" {if '/(.*)(oudashboard)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_DASHBOARD}</a></li>
         <li><a href="{$SITE_URL_DUM}inbox" {if '/(.*)(inbox)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_INBOX} <strong>({$totInboxres})</strong></a></li>
    </ul>

	 {if $ENABLE_AUCTION eq 'Yes'}
    <dl id='ia'>{$LBL_RFQ2}</dl>
    <ul {if '/(.*)(b2rfq2)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
		  <ld>{$LBL_RFQ2} <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}b2rfq2list" {if '/(.*)(b2rfq2list)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_RFQ2_LIST}</a></li>
		  <li><a href="{$SITE_URL_DUM}b2rfq2watchlist" {if '/(.*)(b2rfq2watchlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_RFQ2_WATCH_LIST}</a></li>
		  <br/>
		  <ld>{$LBL_RFQ2} {$LBL_BIDS} <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}b2rfq2bidlist" {if '/(.*)(b2rfq2bidlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_RFQ2} {$LBL_BIDS}</a></li>
		  <li><a href="{$SITE_URL_DUM}b2rfq2bidvlist" {if '/(.*)(b2rfq2bidvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_RFQ2} {$LBL_BIDS}</a></li>
		  <li><a href="{$SITE_URL_DUM}b2rfq2bidrlist" {if '/(.*)(b2rfq2bidrlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_REJECTED} {$LBL_RFQ2} {$LBL_BIDS}</a></li>
		  <br/>
		  <ld>{$LBL_RFQ2} {$LBL_AWARD} <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}b2rfq2awardlist" {if $currentUrl eq $SITE_URL_DUM|cat:'b2rfq2awardlist'}class="active"{/if}>{$LBL_RFQ2} {$LBL_AWARD}</a></li>
    </ul>

    {*<dl id='ia'>{$LBL_RFQ2} {$LBL_BIDS}</dl>
    <ul {if '/(.*)(b2rfq2bid)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
		  <ld>{$LBL_RFQ2} {$LBL_BIDS} <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}b2rfq2bidlist" {if '/(.*)(b2rfq2bidlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_RFQ2} {$LBL_BIDS}</a></li>
		  <li><a href="{$SITE_URL_DUM}b2rfq2bidvlist" {if '/(.*)(b2rfq2bidvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_RFQ2} {$LBL_BIDS}</a></li>
		  <li><a href="{$SITE_URL_DUM}b2rfq2bidrlist" {if '/(.*)(b2rfq2bidrlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_REJECTED} {$LBL_RFQ2} {$LBL_BIDS}</a></li>
    </ul>

	 <dl id='ia'>{$LBL_RFQ2} {$LBL_AWARD}</dl>
    <ul {if '/(.*)(b2rfq2award)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
		  <ld>{$LBL_RFQ2} {$LBL_AWARD} <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}b2rfq2awardlist" {if $currentUrl eq $SITE_URL_DUM|cat:'b2rfq2awardlist'}class="active"{/if}>{$LBL_RFQ2} {$LBL_AWARD}</a></li>
	 </ul>*}
    {/if}

	 {*<dl id='pf'>{$LBL_REPORTS}</dl>
	 <ul {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}reportsrpt" {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_REPORTS}</a></li>
    </ul>*}

    <dl id='pf'>{$LBL_PREFERENCE}</dl>
    <ul {if '/(.*)(oueditprofile)(.*)/'|preg_match:$currentUrl || '/(.*)(changepass)(.*)/'|preg_match:$currentUrl || $currentUrl eq $SITE_URL_DUM|cat:'logout'} {else}style="display:none;"{/if}>
         <li><a href="{$SITE_URL_DUM}oueditprofile" {if '/(.*)(oueditprofile)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_EDIT_PROFILE}</a></li>
         <li><a href="{$SITE_URL_DUM}changepass/{$iUserId}" {if $currentUrl eq $SITE_URL_DUM|cat:'editprofile'}class="active"{/if} onmouseover="CallColoerBox(this.href,630,315,'file');">{$LBL_CHANGE_PASSWORD}</a></li>
         <li><a href="{$SITE_URL_DUM}logout" {if $currentUrl eq $SITE_URL_DUM|cat:'logout'}class="active"{/if}>{$LBL_LOGOUT}</a></li>
    </ul>
</div>
{literal}
<script>
var curURl = '{/literal}{$currentUrl}{literal}';
</script>
{/literal}