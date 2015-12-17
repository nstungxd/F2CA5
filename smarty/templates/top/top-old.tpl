<form name="frmlanguage" action="{$SITE_URL}index.php?file=c-language" method="post" style="margin:0px; padding:0px;">
	<input type="Hidden" name="lang_code" id="lang_code" />
<div id="top-menu">
	<ul id="nav-tabstrips">
     {if $curSessid neq ''}<li><a href="{$SITE_URL_DUM}" class="{if $file eq 'c-home' || $file eq ''}current{/if}"><em>{$LBL_DASHBOARD}</em></a></li>{else}<li><a href="{$SITE_URL_DUM}home" class="{if $file eq 'c-home' || $file eq ''}current{/if}"><em>{$LBL_HOME}</em></a></li>{/if}
	  <li><a href="{$SITE_URL_DUM}aboutus" class="{if $file eq 'c-aboutus'}current{/if}"><em>{$LBL_ABOUT_US}</em></a></li>
	  <li><a href="{$SITE_URL_DUM}contactus" class="{if $file eq 'c-contactus'}current{/if}"><em>{$LBL_CONTACT_US}</em></a></li>
	  <li><a href="{$SITE_URL_DUM}privacypolicy" class="{if $file eq 'c-privacypolicy'}current{/if}"><em>{$LBL_PRIVACY_POLICY}</em></a></li>
	</ul>
   {*}<span class="lang_flags"><img src="{$SITE_IMAGES}flag-icon.png" onclick="javascript:changLang('en');" alt="" border="0" style="cursor:pointer;" />&nbsp;<em><img src="{$SITE_IMAGES}flag-icon-1.png" onclick="javascript:changLang('fr');" alt="" border="0" style="cursor:pointer;" /></em></span>{*}
	<span class="lang_flags" style="color:#c0cac0;"><span onclick="changLang('en');" style="cursor:pointer;" >EN</span>&nbsp;/&nbsp;<span onclick="changLang('fr');" style="cursor:pointer;" >FR&nbsp;&nbsp;</span></span>
</div>
<div class="clear" style="height:1px;"></div>
<div class="relative">
	<img src="{$SITE_IMAGES}hn-shadow.png" class="home-banner-img" height="170px" />
</div>
<div class="banner-left" align="center">
	<div class="logo"><img src="{$SITE_IMAGES}exchainge-cloud2.png" alt="" border="0" height="79px" /></div>
</div>
<div class="banner-right welcome-text">
{'/\<p\>|\<\/p\>/i'|preg_replace:'':$topwelcometext}
</div>
<div class="clear" style="height:3px;">&nbsp;</div>
</form>
{literal}
<script>
function changLang(val) {
   document.frmlanguage.lang_code.value = val;
	document.frmlanguage.submit();
}
</script>
{/literal}