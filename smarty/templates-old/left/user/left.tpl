<div class="left-menu">
    <h1>{$LBL_NAVIGATION}</h1>
        <dl>{$LBL_DASHBOARD}</dl>
    <ul {if '/(.*)(oudashboard)(.*)/'|preg_match:$currentUrl || '/(.*)(inbox)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}oudashboard" {if '/(.*)(oudashboard)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_DASHBOARD}</a></li>
        <li><a href="{$SITE_URL_DUM}inbox" {if '/(.*)(inbox)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_INBOX} <strong>({$totInboxres})</strong></a></li>
    </ul>

    {if $orgtype neq 'Supplier'}
    <dl id='pi'>{$LBL_PO_ISSUANCE}</dl>
    {assign var="povu" value='polist'}
    <ul {if '/(.*)(polist)(.*)/'|preg_match:$currentUrl || '/(.*)(purchaseorderview)(.*)/'|preg_match:$currentUrl || '/(.*)(poprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(poviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}polist/all" {if $currentUrl eq $SITE_URL_DUM|cat:'polist/all'}class="active"{/if}>{$LBL_VIEW}</a></li>
        {if $poOrgStatus|is_array && $poOrgStatus|@count gt 0}
         {foreach from=$poOrgStatus item="status"}
            {assign var="poUrl" value=$SITE_URL_DUM|cat:'polist/'}
            {assign var="poUrl" value=$poUrl|cat:$status.iStatusID}
            <li><a href="{$SITE_URL_DUM}polist/{$status.iStatusID}" {if $currentUrl|strpos:$poUrl !== false}class="active"{/if}>{$status.vStatus|htmlentities}</a></li>
         {/foreach}
        {/if}
        {*if $orgtype eq 'Supplier'}
        <li><a href="{$SITE_URL_DUM}polist/isu">{$LBL_ISSUED_PO}</a></li>
        <li><a href="{$SITE_URL_DUM}polist/acpt">{$LBL_ACCEPTED_PO}</a></li>
        {/if*}
    </ul>
    {/if}

    {if $orgtype neq 'Buyer'}
    <dl id='ii'>{$LBL_INVOICE_ISSUANCE}</dl>
    {assign var="invu" value='invoicelist'}
    {*}<ul {if $currentUrl eq $SITE_URL_DUM|cat:'invoicelist/all' || $currentUrl|strripos:$invu gt 0} {else}style="display:none;"{/if}>{*}
    <ul {if '/(.*)(invoicelist)(.*)/'|preg_match:$currentUrl || $currentUrl|strripos:$invu gt 0 || '/(.*)(invoiceview)(.*)/'|preg_match:$currentUrl || '/(.*)(invprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(invoiceviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}invoicelist/all" {if $currentUrl eq $SITE_URL_DUM|cat:'invoicelist/all'}class="active"{/if}>{$LBL_VIEW}</a></li>
        {if $invOrgStatus|is_array && $invOrgStatus|@count gt 0}
         {foreach from=$invOrgStatus item="status"}
            {assign var="invUrl" value=$SITE_URL_DUM|cat:'invoicelist/'}
            {assign var="invUrl" value=$invUrl|cat:$status.iStatusID}
            <li><a href="{$SITE_URL_DUM}invoicelist/{$status.iStatusID}" {if $currentUrl|strpos:$invUrl !== false}class="active"{/if}>{$status.vStatus|htmlentities}</a></li>
         {/foreach}
        {/if}
        {*if $orgtype eq 'Buyer'}
        <li><a href="{$SITE_URL_DUM}invoicelist/isu">{$LBL_ISSUED_INVOICES}</a></li>
        <li><a href="{$SITE_URL_DUM}invoicelist/acpt">{$LBL_ACCEPTED_INVOICES}</a></li>
        {/if*}
    </ul>
    {/if}

	 {if $orgtype neq 'Buyer'}
    <dl id='pa'>{$LBL_PO_ACCEPTANCE}</dl>
    {assign var="povu" value='poacptlist'}
    <ul {if '/(.*)(poacptlist)(.*)/'|preg_match:$currentUrl || '/(.*)(purchaseorderview)(.*)/'|preg_match:$currentUrl || '/(.*)(poprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(poviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}poacptlist/all" {if $currentUrl eq $SITE_URL_DUM|cat:'poacptlist/all'}class="active"{/if}>{$LBL_VIEW}</a></li>
        {if $poOrgAcpt|is_array && $poOrgAcpt|@count gt 0}
         {foreach from=$poOrgAcpt item="status"}
         	{if $status.vStatus neq $LBL_ISSUE && $status.vStatus neq 'Issue' && $status.vStatus neq 'Délivré' && $status.vStatus neq 'Issued'}
            {assign var="poUrl" value=$SITE_URL_DUM|cat:'poacptlist/'}
            {assign var="poUrl" value=$poUrl|cat:$status.iStatusID}
            <li><a href="{$SITE_URL_DUM}poacptlist/{$status.iStatusID}" {if $currentUrl|strpos:$poUrl !== false}class="active"{/if}>{$status.vStatus|htmlentities}</a></li>
            {/if}
         {/foreach}
        {/if}
    </ul>
    {/if}

    {if $orgtype neq 'Supplier'}
    <dl id='ia'>{$LBL_INVOICE_ACCEPTANCE}</dl>
    {assign var="invu" value='invacptlist'}
    <ul {if '/(.*)(invacptlist)(.*)/'|preg_match:$currentUrl || $currentUrl|strripos:$invu gt 0 || '/(.*)(invoiceview)(.*)/'|preg_match:$currentUrl || '/(.*)(invprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(invoiceviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}invacptlist/all" {if $currentUrl eq $SITE_URL_DUM|cat:'invacptlist/all'}class="active"{/if}>{$LBL_VIEW}</a></li>
        {if $invOrgAcpt|is_array && $invOrgAcpt|@count gt 0}
         {foreach from=$invOrgAcpt item="status"}
         	{if $status.vStatus neq $LBL_ISSUE && $status.vStatus neq 'Issue' && $status.vStatus neq 'Délivré' && $status.vStatus neq 'Issued'}
            {assign var="invUrl" value=$SITE_URL_DUM|cat:'invacptlist/'}
            {assign var="invUrl" value=$invUrl|cat:$status.iStatusID}
            <li><a href="{$SITE_URL_DUM}invacptlist/{$status.iStatusID}" {if $currentUrl|strpos:$invUrl !== false}class="active"{/if}>{$status.vStatus|htmlentities}</a></li>
            {/if}
         {/foreach}
        {/if}
        {*if $orgtype eq 'Buyer'}
        <li><a href="{$SITE_URL_DUM}invoicelist/isu">{$LBL_ISSUED_INVOICES}</a></li>
        <li><a href="{$SITE_URL_DUM}invoicelist/acpt">{$LBL_ACCEPTED_INVOICES}</a></li>
        {/if*}
    </ul>
    {/if}
	 
    {if $ENABLE_AUCTION eq 'Yes'}
    <dl >{$LBL_RFQ2}</dl>
	 {assign var="invu" value='invacptlist'}
    <ul {if '/(.*)(rfq2)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
		  <ld>{$LBL_RFQ2} <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}rfq2list" {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2list'}class="active"{/if}>{$LBL_RFQ2_LIST}</a></li>
		  <li><a href="{$SITE_URL_DUM}rfq2vlist" {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2vlist'}class="active"{/if}>{$LBL_VERIFY_RFQ2}</a></li>
		  <li><a href="{$SITE_URL_DUM}rfq2rlist" {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2rlist'}class="active"{/if}>{$LBL_REJECTED} {$LBL_RFQ2}</a></li>
		  <br/>
		  <ld>{$LBL_RFQ2} {$LBL_BIDS}<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}rfq2bidlist" {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2bidlist'}class="active"{/if}>{$LBL_RFQ2} {$LBL_BIDS}</a></li>
		  <br/>
		  <ld>{$LBL_RFQ2} {$LBL_AWARD}<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}rfq2awardlist" {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2awardlist'}class="active"{/if}>{$LBL_RFQ2} {$LBL_AWARD}</a></li>
    </ul>

    {*<dl id='ia'>{$LBL_RFQ2} {$LBL_BIDS}</dl>}
    <ul {if '/(.*)(rfq2bid)(.*)/'|preg_match:$currentUrl || '/(.*)(rfq2bid)(.*)/'|preg_match:$currentUrl || '/(.*)(rfq2bid)(.*)/'|preg_match:$currentUrl || '/(.*)(rfq2bid)(.*)/'|preg_match:$currentUrl || '/(.*)(rfq2bid)(.*)/'|preg_match:$currentUrl} {else}style="display:;"{/if}>
		  <ld>{$LBL_RFQ2} {$LBL_BIDS}<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}rfq2bidlist" {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2bidlist'}class="active"{/if}>{$LBL_RFQ2} {$LBL_BIDS}</a></li>
	 </ul>

    {*<dl id='ia'>{$LBL_RFQ2} {$LBL_AWARD}</dl>}
    <ul {if '/(.*)(rfq2award)(.*)/'|preg_match:$currentUrl} {else}style="display:;"{/if}>
		  <ld>{$LBL_RFQ2} {$LBL_AWARD}<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
        <li><a href="{$SITE_URL_DUM}rfq2awardlist" {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2awardlist'}{/if}>{$LBL_RFQ2} {$LBL_AWARD}</a></li>
	 </ul>*}
    {/if}
	 
	 <dl id='pf'>{$LBL_REPORTS}</dl>
	 <ul {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}reportsrpt" {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_REPORTS}</a></li>
    </ul>
	 
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
/*$('.left-menu ul').each(function(){
    var chkSel =0;
    $(this).children('li').each(function(){
       if($(this).children('a').attr('href') == curURl){
         $(this).children('a').addClass('active');
         chkSel++;
       }else{
         $(this).children('a').removeClass('active');
       }
    });
   if(chkSel > 0){
      $(this).show();
   }else{
      $(this).hide();
   }
});
*/
/*
$('.left-menu ul').children('li').children('a').click(function(){
  urlhref = $(this).attr('href');
  if(urlhref.search('changepass') != -1)
       return true;
  url = urlhref;
   pars='';
   $.post(url, pars, function(resp){
      //alert(resp);
      if(resp !='ok'){
         return false;
      }else{
         window.location = urlhref;
      }
   });
   return false;
   //$('#mid_content').load(url);
})
$(document).ready( function() {
//
});
*/

//$('.left-menu dl').each(function(){
//   $(this).click(function(){
      //alert($(this).next('ul').attr('style'));
//      $(this).next('ul').toggle('slow');
      /*if($(this).next('ul').attr('style') == 'display: none;' || $(this).next('ul').attr('style') == 'DISPLAY: none'){
         $(this).next('ul').show('slow');
      }else{
         $(this).next('ul').hide('slow');
      }*/
//   });
// });
</script>
{/literal}