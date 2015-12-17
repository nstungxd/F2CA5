<div id="nav-col">
<section id="col-left" class="col-left-nano">
<div id="col-left-inner" class="col-left-nano-content">
<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
    <img alt="" src="img/samples/scarlet-159.png"/>

    <div class="user-box">
									<span class="name">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        {$sess_user_name}
                                            <i class="fa fa-angle-down"></i>
                                        </a>
										<ul class="dropdown-menu">
                                            <li><a href="{$SITE_URL_DUM}oueditprofile"><i class="fa fa-user"></i>Edit
                                                Profile</a></li>
                                            <li><a href="{$SITE_URL_DUM}changepass/{$iUserId}"><i class="fa fa-cog"></i>Change
                                                Password</a></li>
                                            <li><a href="{$SITE_URL_DUM}logout"><i
                                                    class="fa fa-power-off"></i>Logout</a></li>
                                        </ul>
									</span>
									<span class="status">
										<i class="fa fa-circle"></i> Online
									</span>
    </div>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
<ul class="nav nav-pills nav-stacked">
<li class="nav-header nav-header-first hidden-sm hidden-xs">
{$LBL_NAVIGATION}
</li>
<li {if '/(.*)(oudashboard)(.*)/'|preg_match:$currentUrl || '/(.*)(inbox)(.*)/'|preg_match:$currentUrl} class="active"{/if}>
    <a href="#" class="dropdown-toggle">
        <i class="fa fa-dashboard"></i>
        <span>{$LBL_DASHBOARD}</span>
        <i class="fa fa-angle-right drop-icon"></i>
    </a>
    <ul class="submenu"  {if '/(.*)(oudashboard)(.*)/'|preg_match:$currentUrl || '/(.*)(inbox)(.*)/'|preg_match:$currentUrl}{else}style="display:none;"{/if}>
        <li>
            <a href="{$SITE_URL_DUM}oudashboard"
               {if '/(.*)(oudashboard)(.*)/'|preg_match:$currentUrl}class="active"{/if}>
            {$LBL_DASHBOARD}
            </a>
        </li>
        <li>
            <a href="{$SITE_URL_DUM}inbox" {if '/(.*)(inbox)(.*)/'|preg_match:$currentUrl}class="active"{/if}>
            {$LBL_INBOX} <strong>({$totInboxres})</strong>
            </a>
        </li>
    </ul>

</li>


<!-- Anatoly -->
{if $orgtype neq 'Supplier'}

<li {if '/(.*)(polist)(.*)/'|preg_match:$currentUrl || '/(.*)(purchaseorderview)(.*)/'|preg_match:$currentUrl || '/(.*)(poprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(poviewitems)(.*)/'|preg_match:$currentUrl} class="active" {/if}>
    <a href="#" class="dropdown-toggle">
        <i class="fa fa-inbox"></i>
        <span>{$LBL_PO_ISSUANCE}</span>
        <i class="fa fa-angle-right drop-icon"></i>
    </a>
    {assign var="povu" value='polist'}
    <ul class="submenu" {if '/(.*)(polist)(.*)/'|preg_match:$currentUrl || '/(.*)(purchaseorderview)(.*)/'|preg_match:$currentUrl || '/(.*)(poprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(poviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li>
            <a href="{$SITE_URL_DUM}polist/all"
               {if $currentUrl eq $SITE_URL_DUM|cat:'polist/all'}class="active"{/if}>
                {$LBL_VIEW}
            </a>
        </li>
        {if $poOrgStatus|is_array && $poOrgStatus|@count gt 0}
            {foreach from=$poOrgStatus item="status"}
                {assign var="poUrl" value=$SITE_URL_DUM|cat:'polist/'}
                {assign var="poUrl" value=$poUrl|cat:$status.iStatusID}
                <li>
                    <a href="{$SITE_URL_DUM}polist/{$status.iStatusID}"
                       {if $currentUrl|strpos:$poUrl !== false}class="active"{/if}>{$status.vStatus|htmlentities}
                        >
                        Issue
                    </a>
                </li>
            {/foreach}
        {/if}
    {*if $orgtype eq 'Supplier'}
    <li><a href="{$SITE_URL_DUM}polist/isu">{$LBL_ISSUED_PO}</a></li>
    <li><a href="{$SITE_URL_DUM}polist/acpt">{$LBL_ACCEPTED_PO}</a></li>
    {/if*}
    </ul>
</li>
{/if}

{if $orgtype neq 'Buyer'}

<li {if '/(.*)(invoicelist)(.*)/'|preg_match:$currentUrl || $currentUrl|strripos:$invu gt 0 || '/(.*)(invoiceview)(.*)/'|preg_match:$currentUrl || '/(.*)(invprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(invoiceviewitems)(.*)/'|preg_match:$currentUrl} class="active" {/if}>
    <a href="#" class="dropdown-toggle">
        <i class="fa fa-inbox"></i>
        <span>{$LBL_INVOICE_ISSUANCE}</span>
        <i class="fa fa-angle-right drop-icon"></i>
    </a>
    {assign var="invu" value='invoicelist'}
    <ul class="submenu" {if '/(.*)(invoicelist)(.*)/'|preg_match:$currentUrl || $currentUrl|strripos:$invu gt 0 || '/(.*)(invoiceview)(.*)/'|preg_match:$currentUrl || '/(.*)(invprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(invoiceviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}invoicelist/all"
               {if $currentUrl eq $SITE_URL_DUM|cat:'invoicelist/all'}class="active"{/if}>{$LBL_VIEW}</a>
        </li>
        {if $invOrgStatus|is_array && $invOrgStatus|@count gt 0}
            {foreach from=$invOrgStatus item="status"}
                {assign var="invUrl" value=$SITE_URL_DUM|cat:'invoicelist/'}
                {assign var="invUrl" value=$invUrl|cat:$status.iStatusID}
                <li><a href="{$SITE_URL_DUM}invoicelist/{$status.iStatusID}"
                       {if $currentUrl|strpos:$invUrl !== false}class="active"{/if}>{$status.vStatus|htmlentities}</a>
                </li>
            {/foreach}
        {/if}
    {*if $orgtype eq 'Buyer'}
    <li><a href="{$SITE_URL_DUM}invoicelist/isu">{$LBL_ISSUED_INVOICES}</a></li>
    <li><a href="{$SITE_URL_DUM}invoicelist/acpt">{$LBL_ACCEPTED_INVOICES}</a></li>
    {/if*}
    </ul>
</li>
{/if}

{if $orgtype neq 'Buyer'}
<li {if '/(.*)(poacptlist)(.*)/'|preg_match:$currentUrl || '/(.*)(purchaseorderview)(.*)/'|preg_match:$currentUrl || '/(.*)(poprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(poviewitems)(.*)/'|preg_match:$currentUrl} class="active" {/if}>
    <a href="#" class="dropdown-toggle">
        <i class="fa fa-file-o"></i>
        <span>{$LBL_PO_ACCEPTANCE}</span>
        <i class="fa fa-angle-right drop-icon"></i>
    </a>
    {assign var="povu" value='poacptlist'}
    <ul class="submenu" {if '/(.*)(poacptlist)(.*)/'|preg_match:$currentUrl || '/(.*)(purchaseorderview)(.*)/'|preg_match:$currentUrl || '/(.*)(poprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(poviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}poacptlist/all"
               {if $currentUrl eq $SITE_URL_DUM|cat:'poacptlist/all'}class="active"{/if}>{$LBL_VIEW}</a>
        </li>
        {if $poOrgAcpt|is_array && $poOrgAcpt|@count gt 0}
            {foreach from=$poOrgAcpt item="status"}
                {if $status.vStatus neq $LBL_ISSUE && $status.vStatus neq 'Issue' && $status.vStatus neq 'Délivré' && $status.vStatus neq 'Issued'}
                    {assign var="poUrl" value=$SITE_URL_DUM|cat:'poacptlist/'}
                    {assign var="poUrl" value=$poUrl|cat:$status.iStatusID}
                    <li><a href="{$SITE_URL_DUM}poacptlist/{$status.iStatusID}"
                           {if $currentUrl|strpos:$poUrl !== false}class="active"{/if}>{$status.vStatus|htmlentities}</a>
                    </li>
                {/if}
            {/foreach}
        {/if}
    </ul>
</li>
{/if}

{if $orgtype neq 'Supplier'}

<li {if '/(.*)(invacptlist)(.*)/'|preg_match:$currentUrl || $currentUrl|strripos:$invu gt 0 || '/(.*)(invoiceview)(.*)/'|preg_match:$currentUrl || '/(.*)(invprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(invoiceviewitems)(.*)/'|preg_match:$currentUrl} class="active" {/if}>
    <a href="#" class="dropdown-toggle">
        <i class="fa fa-file-o"></i>
        <span>{$LBL_PO_ACCEPTANCE}</span>
        <i class="fa fa-angle-right drop-icon"></i>
    </a>
    {assign var="invu" value='invacptlist'}
    <ul class="submenu" {if '/(.*)(invacptlist)(.*)/'|preg_match:$currentUrl || $currentUrl|strripos:$invu gt 0 || '/(.*)(invoiceview)(.*)/'|preg_match:$currentUrl || '/(.*)(invprefview)(.*)/'|preg_match:$currentUrl || '/(.*)(invoiceviewitems)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}invacptlist/all"
               {if $currentUrl eq $SITE_URL_DUM|cat:'invacptlist/all'}class="active"{/if}>{$LBL_VIEW}</a>
        </li>
        {if $invOrgAcpt|is_array && $invOrgAcpt|@count gt 0}
            {foreach from=$invOrgAcpt item="status"}
                {if $status.vStatus neq $LBL_ISSUE && $status.vStatus neq 'Issue' && $status.vStatus neq 'Délivré' && $status.vStatus neq 'Issued'}
                    {assign var="invUrl" value=$SITE_URL_DUM|cat:'invacptlist/'}
                    {assign var="invUrl" value=$invUrl|cat:$status.iStatusID}
                    <li><a href="{$SITE_URL_DUM}invacptlist/{$status.iStatusID}"
                           {if $currentUrl|strpos:$invUrl !== false}class="active"{/if}>{$status.vStatus|htmlentities}</a>
                    </li>
                {/if}
            {/foreach}
        {/if}
    {*if $orgtype eq 'Buyer'}
    <li><a href="{$SITE_URL_DUM}invoicelist/isu">{$LBL_ISSUED_INVOICES}</a></li>
    <li><a href="{$SITE_URL_DUM}invoicelist/acpt">{$LBL_ACCEPTED_INVOICES}</a></li>
    {/if*}
    </ul>
</li>
{/if}

{if $ENABLE_AUCTION eq 'Yes'}

<li {if '/(.*)(rfq2)(.*)/'|preg_match:$currentUrl} class="active" {/if}>
    <a href="#" class="dropdown-toggle">
        <i class="fa fa-file-o"></i>
        <span>{$LBL_RFQ2}</span>
        <i class="fa fa-angle-right drop-icon"></i>
    </a>
    {assign var="invu" value='invacptlist'}
    <ul class="submenu" {if '/(.*)(rfq2)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2list' || $currentUrl eq $SITE_URL_DUM|cat:'rfq2vlist' || $currentUrl eq $SITE_URL_DUM|cat:'rfq2rlist'}class="active"{/if}>
            <a href="#" class="dropdown-toggle">
                <span>{$LBL_RFQ2}</span>
                <i class="fa fa-angle-right drop-icon"></i>
            </a>
            <ul class="submenu">
                <li><a href="{$SITE_URL_DUM}rfq2list"
                       {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2list'}class="active"{/if}>{$LBL_RFQ2_LIST}</a></li>
                <li><a href="{$SITE_URL_DUM}rfq2vlist"
                       {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2vlist'}class="active"{/if}>{$LBL_VERIFY_RFQ2}</a></li>
                <li><a href="{$SITE_URL_DUM}rfq2rlist"
                       {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2rlist'}class="active"{/if}>{$LBL_REJECTED} {$LBL_RFQ2}</a>
                </li>
            </ul>
        </li>
        <li {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2bidlist'}class="active"{/if}>
            <a href="#" class="dropdown-toggle">
                <span>{$LBL_RFQ2} {$LBL_BIDS}</span>
                <i class="fa fa-angle-right drop-icon"></i>
            </a>
            <ul class="submenu">
                <li><a href="{$SITE_URL_DUM}rfq2bidlist"
                       {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2bidlist'}class="active"{/if}>{$LBL_RFQ2} {$LBL_BIDS}</a>
                </li>
            </ul>
        </li>
        <li {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2awardlist'}class="active"{/if}>
            <a href="#" class="dropdown-toggle">
                <span>{$LBL_RFQ2} {$LBL_AWARD}</span>
                <i class="fa fa-angle-right drop-icon"></i>
            </a>
            <ul class="submenu">
                <li><a href="{$SITE_URL_DUM}rfq2awardlist"
                       {if $currentUrl eq $SITE_URL_DUM|cat:'rfq2awardlist'}class="active"{/if}>{$LBL_RFQ2} {$LBL_AWARD}</a>
                </li>
            </ul>
        </li>
    </ul>
</li>


{/if}

<li {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl}class="active"{/if}>
    <a href="#" class="dropdown-toggle">
        <i class="fa fa-file-o"></i>
        <span>{$LBL_REPORTS}</span>
        <i class="fa fa-angle-right drop-icon"></i>
    </a>
    <ul class="submenu" {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}reportsrpt"
               {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_REPORTS}</a></li>
    </ul>
</li>
<li {if '/(.*)(oueditprofile)(.*)/'|preg_match:$currentUrl || '/(.*)(changepass)(.*)/'|preg_match:$currentUrl || $currentUrl eq $SITE_URL_DUM|cat:'logout'} class="active" {/if}>
    <a href="#" class="dropdown-toggle">
        <i class="fa fa-file-o"></i>
        <span>{$LBL_PREFERENCE}</span>
        <i class="fa fa-angle-right drop-icon"></i>
    </a>
    <ul class="submenu" {if '/(.*)(oueditprofile)(.*)/'|preg_match:$currentUrl || '/(.*)(changepass)(.*)/'|preg_match:$currentUrl || $currentUrl eq $SITE_URL_DUM|cat:'logout'} {else}style="display:none;"{/if}>
        <li><a href="{$SITE_URL_DUM}oueditprofile"
               {if '/(.*)(oueditprofile)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_EDIT_PROFILE}</a>
        </li>
        <li><a href="{$SITE_URL_DUM}changepass/{$iUserId}"
               {if $currentUrl eq $SITE_URL_DUM|cat:'editprofile'}class="active"{/if}
               onmouseover="CallColoerBox(this.href,630,315,'file');">{$LBL_CHANGE_PASSWORD}</a>
        </li>
        <li><a href="{$SITE_URL_DUM}logout"
               {if $currentUrl eq $SITE_URL_DUM|cat:'logout'}class="active"{/if}>{$LBL_LOGOUT}</a>
        </li>
    </ul>
</li>

</ul>
</div>
</div>
</section>
<div id="nav-col-submenu"></div>
</div>
{literal}
<script>
var curURl = '{/literal}{$currentUrl}{literal}';
</script>
{/literal}