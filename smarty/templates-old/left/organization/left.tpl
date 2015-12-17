<div class="left-menu">
    <h1>{$LBL_NAVIGATION}</h1>
    <dl>{$LBL_DASHBOARD}</dl>
		  <ul {if '/(.*)(oadashboard)(.*)/'|preg_match:$currentUrl || '/(.*)(inbox)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
				<li><a href="{$SITE_URL_DUM}oadashboard" {if '/(.*)(oadashboard)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_DASHBOARD}</a></li>
				<li><a href="{$SITE_URL_DUM}inbox" {if '/(.*)(inbox)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_INBOX} <strong>({$totInboxres})</strong></a></li>
         </ul>
         <dl>{$LBL_ORGANIZATION}</dl>
         {assign var="orgur" value='createorganization'}
			{assign var="olink" value='createorganization/'}
         <ul {if $currentUrl eq $SITE_URL_DUM|cat:'createorganization' || '/(.*)(createorganizationpref)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationview)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationprefview)(.*)/'|preg_match:$currentUrl || $currentUrl|strripos:$olink !== false} {else}style="display:none;"{/if}>
            <li><a href="{$SITE_URL_DUM}createorganization/{$curORGID}" {if $currentUrl eq $SITE_URL_DUM|cat:$orgur || $currentUrl|strripos:$olink !== false || '/(.*)(createorganizationpref)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationview)(.*)/'|preg_match:$currentUrl || '/(.*)(createorganizationpref)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_EDIT_ORG_INFO}</a></li>
         </ul>
        <dl>{$LBL_ASSOCIATION}</dl>
		   <ul {if '/(.*)(createassociation)(.*)/'|preg_match:$currentUrl || '/(.*)(associationview)(.*)/'|preg_match:$currentUrl || '/(.*)(associationlist)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
		   <li><a href="{$SITE_URL_DUM}createassociation" {if '/(.*)(createassociation)(.*)/'|preg_match:$currentUrl || '/(.*)(associationview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_CREATE_MODIFY}</a></li>
		   {assign var="linkurl" value=$SITE_URL_DUM|cat:'associationlist'}
		   <li><a href="{$SITE_URL_DUM}associationlist" {if $currentUrl eq $SITE_URL_DUM|cat:'associationlist' && $currentUrl|strpos:$linkurl !== false}class="active"{/if}>{$LBL_ASSO_LIST}</a></li>
		   <li><a href="{$SITE_URL_DUM}verifyassociationlist" {if '/(.*)(verifyassociationlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY_ASSOCIATION}</a></li>
		   </ul>

		  {if $ENABLE_AUCTION eq 'Yes'}
		  <dl>{$LBL_NEW_ASSOCIATIONS}</dl>
		  <ul {if '/(.*)(b2)(.*)(asoc)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
		  {if $uorg_type neq 'Supplier'}
				<li><a href="{$SITE_URL_DUM}b2buyerasoclist" {if ('/(.*)(b2buyerasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2buyerasocvlist')===false) || '/(.*)(b2buyerasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2buyerasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_BUYER}</a></li>
				{if $uorg_type eq 'Buyer2'}<li><a href="{$SITE_URL_DUM}b2buyerasocvlist" {if '/(.*)(b2buyerasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_BUYER}</a></li>{/if}
				<li><a href="{$SITE_URL_DUM}b2bprdtbasoclist" {if ('/(.*)(b2bprodtbasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2bprdtbasocvlist')===false) || '/(.*)(b2bprdtbasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2bprodtbasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_BPRODUCT_BUYER}</a></li>
				{if $uorg_type eq 'Buyer2'}<li><a href="{$SITE_URL_DUM}b2bprdtbasocvlist" {if '/(.*)(b2bprdtbasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_BPRODUCT_BUYER}</a></li>{/if}
		  {/if}
		  {if $uorg_type neq 'Buyer'}
				<li><a href="{$SITE_URL_DUM}b2supplierasoclist" {if ('/(.*)(b2supplierasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2supplierasocvlist')===false) || '/(.*)(b2supplierasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2supplierasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_SUPPLIER}</a></li>
				{if $uorg_type eq 'Buyer2'}<li><a href="{$SITE_URL_DUM}b2supplierasocvlist" {if '/(.*)(b2supplierasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_SUPPLIER}</a></li>{/if}
				<li><a href="{$SITE_URL_DUM}b2sprdtsasoclist" {if ('/(.*)(b2sprodtsasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2sprdtsasocvlist')===false) || '/(.*)(b2sprdtsasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2sprodtsasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_SPRODUCT_SUPPLIER}</a></li>
				{if $uorg_type eq 'Buyer2'}<li><a href="{$SITE_URL_DUM}b2sprdtsasocvlist" {if '/(.*)(b2sprdtsasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_SPRODUCT_SUPPLIER}</a></li>{/if}
		  {/if}
		  </ul>
		  {/if}

         <dl>{$LBL_USER}</dl>
		   <ul {if '/(.*)(createorganizationuser)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationuserview)(.*)/'|preg_match:$currentUrl || '/(.*)(userrights)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationuserlist)(.*)/'|preg_match:$currentUrl || '/(.*)(assignrights)(.*)/'|preg_match:$currentUrl || '/(.*)(creategroup)(.*)/'|preg_match:$currentUrl || '/(.*)(grouplist)(.*)/'|preg_match:$currentUrl || '/(.*)(groupview)(.*)/'|preg_match:$currentUrl || '/(.*)(verifyrights)(.*)/'|preg_match:$currentUrl || '/(.*)(listrights)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
		   <li><a href="{$SITE_URL_DUM}createorganizationuser" {if '/(.*)(createorganizationuser)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationuserview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_CREATE_USER}</a></li>
		   {assign var="linkurl" value=$SITE_URL_DUM|cat:'organizationuserlist'}
		   <li><a href="{$SITE_URL_DUM}organizationuserlist" {if $currentUrl|strpos:$linkurl !== false}class="active"{/if}>{$LBL_USER_LIST}</a></li>
		   <li><a href="{$SITE_URL_DUM}verifyorganizationuserlist" {if '/(.*)(verifyorganizationuserlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY_USER}</a></li>
		   <li><a href="{$SITE_URL_DUM}assignrights" {if '/(.*)(assignrights)(.*)/'|preg_match:$currentUrl || '/(.*)(userrights)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_ASSIGN_RIGHTS_USER}</a></li>
		   <li><a href="{$SITE_URL_DUM}listrights" {if '/(.*)(listrights)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_USER_RIGHTS}</a></li>
		   <li><a href="{$SITE_URL_DUM}verifyrights" {if $currentUrl eq $SITE_URL_DUM|cat:'verifyrights'}class="active"{/if}>{$LBL_VERIFY_USER_RIGHTS}</a></li>
		   <li><a href="{$SITE_URL_DUM}creategroup" {if '/(.*)(creategroup)(.*)/'|preg_match:$currentUrl || '/(.*)(groupview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_CREATE_GROUP}</a></li>
		   {assign var="linkurl" value=$SITE_URL_DUM|cat:'grouplist'}
		   <li><a href="{$SITE_URL_DUM}grouplist" {if $currentUrl|strpos:$linkurl !== false}class="active"{/if}>{$LBL_GROUP_LIST}</a></li>
		   <li><a href="{$SITE_URL_DUM}verifygrouplist" {if '/(.*)(verifygrouplist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_GROUP}</a></li>
		   {*}<li><a href="{$SITE_URL_DUM}assigngrouprights">{$LBL_ASSIGN_RIGHTS_GROUP}</a></li>{*}
		   </ul>

			<dl>{$LBL_PURCHASE_ORDER}</dl>
         {assign var="povu" value='polist'}
         <ul {if $currentUrl eq $SITE_URL_DUM|cat:'polist/all' || $currentUrl|strripos:$povu gt 0 || '/(.*)(purchaseorderview)(.*)/'|preg_match:$currentUrl || '/(.*)(poprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(poviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
              <li><a href="{$SITE_URL_DUM}polist/all">{$LBL_VIEW}</a></li>
			{*section name="i" loop=$postatus}
            {assign var="poUrl" value=$SITE_URL_DUM|cat:'polist/'}
            {assign var="poUrl" value=$poUrl|cat:$postatus[i].iStatusID}
                    {if $postatus[i].vStatus_en neq 'Create'}
                         <li><a href="{$SITE_URL_DUM}polist/{$postatus[i].iStatusID}" {if $currentUrl eq $poUrl}class="active"{/if}>{$postatus[i].vStatus}</a></li>
                    {/if}
			{/section*}
         </ul>
         <dl>{$LBL_INVOICE}</dl>
         {assign var="invu" value='invoicelist'}
			<ul {if $currentUrl eq $SITE_URL_DUM|cat:'invoicelist/all' || $currentUrl|strripos:$invu gt 0 || '/(.*)(invoiceview)(.*)/'|preg_match:$currentUrl || '/(.*)(invprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(invoiceviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
               <li><a href="{$SITE_URL_DUM}invoicelist/all">{$LBL_VIEW}</a></li>
			{*section name="i" loop=$invstatus}
            {assign var="invUrl" value=$SITE_URL_DUM|cat:'invoicelist/'}
            {assign var="invUrl" value=$invUrl|cat:$invstatus[i].iStatusID}
                    {if $invstatus[i].vStatus_en neq 'Create'}
                         <li><a href="{$SITE_URL_DUM}invoicelist/{$invstatus[i].iStatusID}" {if $currentUrl eq $invUrl}class="active"{/if}>{$invstatus[i].vStatus}</a></li>
                    {/if}
			{/section*}
		  </ul>

		  {if $ENABLE_AUCTION eq 'Yes'}
		  <dl id='ia'>{$LBL_RFQ2}</dl>
		  <ul {if '/(.*)(rfq2list)(.*)/'|preg_match:$currentUrl || '/(.*)(rfq2watchlist)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
				<ld>{$LBL_RFQ2} <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
				<li><a href="{$SITE_URL_DUM}rfq2list" {if '/(.*)(rfq2list)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_RFQ2_LIST}</a></li>
				<br/>
				<ld>{$LBL_RFQ2} {$LBL_BIDS}<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
				<li><a href="{$SITE_URL_DUM}rfq2bidlist" {if '/(.*)(rfq2bidlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_RFQ2} {$LBL_BIDS}</a></li>
				<br/>
				<ld>{$LBL_RFQ2} {$LBL_AWARD}<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
				<li><a href="{$SITE_URL_DUM}rfq2awardlist" {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2awardlist'}class="active"{/if}>{$LBL_RFQ2} {$LBL_AWARD}</a></li>
		  </ul>

		  {*<dl id='ia'>{$LBL_RFQ2} {$LBL_BIDS}</dl>
		  <ul {if '/(.*)(rfq2bid)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
				<ld>{$LBL_RFQ2} {$LBL_BIDS}<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
				<li><a href="{$SITE_URL_DUM}rfq2bidlist" {if '/(.*)(rfq2bidlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_RFQ2} {$LBL_BIDS}</a></li>
		  </ul>

		  <dl id='ia'>{$LBL_RFQ2} {$LBL_AWARD}</dl>
		  <ul {if '/(.*)(rfq2award)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
				<ld>{$LBL_RFQ2} {$LBL_AWARD}<span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
				<li><a href="{$SITE_URL_DUM}rfq2awardlist" {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2awardlist'}class="active"{/if}>{$LBL_RFQ2} {$LBL_AWARD}</a></li>
		  </ul>*}
		  {/if}

	 <dl id='pf'>{$LBL_REPORTS}</dl>
	 <ul {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}reportsrpt" {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_REPORTS}</a></li>
    </ul>

        <dl>{$LBL_PREFERENCE}</dl>
        <ul {if $currentUrl eq $SITE_URL_DUM|cat:'oaeditprofile' || $currentUrl eq $SITE_URL_DUM|cat:'changepass' || $currentUrl eq $SITE_URL_DUM|cat:'logout'} {else}style="display:none;"{/if}>
            <li><a href="{$SITE_URL_DUM}oaeditprofile" {if $currentUrl eq $SITE_URL_DUM|cat:'oaeditprofile'}class="active"{/if}>{$LBL_EDIT_PROFILE}</a></li>
            <li><a class="colorbox cboxElement" {if $currentUrl eq $SITE_URL_DUM|cat:'changepass'}class="active"{/if} href="{$SITE_URL_DUM}changepass/{$iUserId}" onmouseover="CallColoerBox(this.href,630,315,'file');">{$LBL_CHANGE_PASSWORD}</a></li>
            <li><a href="{$SITE_URL_DUM}logout" {if $currentUrl eq $SITE_URL_DUM|cat:'logout'}class="active"{/if}>{$LBL_LOGOUT}</a></li>
        </ul>
</div>
{literal}
<script>
var curURl = '{/literal}{$currentUrl}{literal}';
$('.left-menu ul').each(function(){
    var chkSel =0;
    $(this).children('li').each(function(){
       if($(this).children('a').attr('href') == curURl){
         $(this).children('a').addClass('active');
         chkSel++;
       }else{
         // $(this).children('a').removeClass('active');
       }
    });
   if(chkSel > 0){
      $(this).show();
   }else{
      // $(this).hide();
   }
});
/*
$('.left-menu ul').children('li').children('a').click(function(){
   urlhref = $(this).attr('href');
   if(urlhref.search('changepass') != -1)
       return true;

   url = SITE_URL_DUM+"session.php?seturl="+urlhref;
   pars='';
   $.post(url, pars, function(resp){
      //alert(resp);
      if(resp !='ok'){
         return false;
      }else{
           //return true;

           //CallColoerBox(urlhref,550,315,'file');
         window.location = urlhref;
      }
   });
   return false;
   //$('#mid_content').load(url);
})
*/
// $('.left-menu dl').each(function(){
//   $(this).click(function(){
      //alert($(this).next('ul').attr('style'));
//      $(this).next('ul').toggle('slow');
      /*if($(this).next('ul').attr('style') == 'display: none;' || $(this).next('ul').attr('style') == 'DISPLAY: none'){
         $(this).next('ul').show('slow');
      }else{
         $(this).next('ul').hide('slow');
      }*/
//   });
//});
</script>
{/literal}