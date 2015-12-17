<form name="frmlanguage" action="{$SITE_URL}index.php?file=c-language" method="post" style="margin:0px; padding:0px;">
	<input type="Hidden" name="lang_code" id="lang_code" />
<div id="top-part">
	<div class="logo">
      <a href="#"><img src="{$SITE_IMAGES}exchainge.png" alt="" align="left" height="52" width="74"/></a>
		<span class="lang_flags" style="padding:0px; color:#c0cec0;"><span onclick="changLang('en');" style="cursor:pointer; padding:0px;" >EN</span>&nbsp;/&nbsp;<span onclick="changLang('fr');" style="cursor:pointer; padding:0px;" >FR</span></span>
      <!--<span style="display: inline-block; padding-top: 19px;"><a class="lg" href="{$SITE_URL_DUM}logout"><b>Logout</b></a></span>-->
	</div>
	<div class="header">
		<!--<img src="{$SITE_IMAGES}sm_images/img-text.png" alt="" width="281" height="29" />-->
		<font size="6"><b>{$LBL_ORGANIZATION} {$LBL_ADMINISTRATOR}</b></font>
		<br />
		<span> <strong>Pellentesque ac orci massa, id congue diam.</strong> Phasellus aliquet lobortis nisi, eu ullamco nunc varius non.</span>
	</div>
	<div class="tab-bottline">
		<div style="float:right; height:19px; padding-top:9px; padding-right:5px;">
        <strong>{$LBL_WELCOME},</strong>
        <span class="orange-text">{$sess_user_name} ({$sess_usertype_short})</span>
        &nbsp;<a href="{$SITE_URL_DUM}logout">{$LBL_LOGOUT}</a>
   	</div>
		<ul id="top-navi">
			<li><a href="{$SITE_URL_DUM}oadashboard" class="{if $file eq 'or-oadashboard'}current{/if}"><em>{$LBL_SUMMARY}</em></a></li>
			{*}<li><a href="{$SITE_URL_DUM}organizationlist" class="{if ($file|strpos:'organization' neq false || $file|strpos:'org' neq false) && $file|strpos:'user' eq false}current{/if}"><em>{$LBL_ORGANIZATIONS}</em></a></li>{*}
			{if $uorg_type eq 'Buyer2'}
				<li><a href="{$SITE_URL_DUM}b2bprodtasoclist" class="{if $file|strpos:'association' neq false}current{/if}"><em>{$LBL_ASSOCIATIONS}</em></a></li>
				<li><a href="{$SITE_URL_DUM}b2rfq2list" class="{if $file|strpos:'b2rfq2list' neq false}current{/if}"><em>{$LBL_RFQ2}</em></a></li>
			{else}
				<li><a href="{$SITE_URL_DUM}associationlist" class="{if $file|strpos:'association' neq false}current{/if}"><em>{$LBL_ASSOCIATIONS}</em></a></li>
				<li><a href="{$SITE_URL_DUM}polist/all" class="{if $file|strpos:'purchaseorder' neq false || $file|strpos:'po' neq false}current{/if}"><em>{$LBL_PURCHASE_ORDER}</em></a></li>
				<li><a href="{$SITE_URL_DUM}invoicelist/all" class="{if $file|strpos:'invoice' neq false}current{/if}"><em>{$LBL_INVOICE}</em></a></li>
				{if $ENABLE_AUCTION eq 'Yes'}<li><a href="{$SITE_URL_DUM}rfq2list" class="{if $file|strpos:'rfq2' neq false}current{/if}"><em>{$LBL_RFQ2}</em></a></li>{/if}
			{/if}
			<li><a href="{$SITE_URL_DUM}organizationuserlist"  class="{if $file|strpos:'user' neq false}current{/if}"><em>{$LBL_USERS}</em></a></li>
		</ul>
	</div>
</div>
</form>
{literal}
<script>

function changLang(val) {
   document.frmlanguage.lang_code.value = val;
	document.frmlanguage.submit();
}
</script>
{/literal}