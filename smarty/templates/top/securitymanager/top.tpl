<form name="frmlanguage" action="{$SITE_URL}index.php?file=c-language" method="post" style="margin:0px; padding:0px;">
	<input type="Hidden" name="lang_code" id="lang_code" />
<div id="top-part">
	<div class="logo">
      <a href="#"><img src="{$SITE_IMAGES}exchainge.png" alt="" align="left" height="52" width="74" /></a>
      <span class="lang_flags" style="padding:0px; color:#c0cec0;"><span onclick="changLang('en');" style="cursor:pointer; padding:0px;" >EN</span>&nbsp;/&nbsp;<span onclick="changLang('fr');" style="cursor:pointer; padding:0px;" >FR</span></span>
      <!--<span style="display: inline-block; padding-top: 19px;"><a class="lg" href="{$SITE_URL_DUM}logout"><b>Logout</b></a></span>-->
	</div>
	<div class="header">
		<!--<img src="{$SITE_IMAGES}sm_images/img-text.png" alt="" width="281" height="29" />-->
		<font size="6"><b>{$LBL_SECURITY_MANAGER}</b></font>
		<br />
		<span> <strong> </span>
	</div>
	<div class="tab-bottline">
		<div style="float:right; height:19px; padding-top:9px; padding-right:5px;">
        <strong>{$LBL_WELCOME} ,</strong>
        <span class="orange-text">{$sess_user_name} ({$sess_usertype_short})</span>
        &nbsp;<a href="{$SITE_URL_DUM}logout">{$LBL_LOGOUT}</a>
   	</div>
		<ul id="top-navi">
			<li><a href="{$SITE_URL_DUM}smdashboard" class="{if $file eq 'sm-smdashboard'}current{/if}"><em>{$LBL_SUMMARY}</em></a></li>
			<li><a href="{$SITE_URL_DUM}organizationlist" class="{if ($file|strpos:'organization' neq false || $file|strpos:'org' neq false) && $file|strpos:'user' eq false}current{/if}"><em>{$LBL_ORGANIZATIONS}</em></a></li>
			<li><a href="{$SITE_URL_DUM}associationlist" class="{if $file|strpos:'association' neq false}current{/if}"><em>{$LBL_ASSOCIATIONS}</em></a></li>
			<li><a href="{$SITE_URL_DUM}organizationuserlist" class="{if $file|strpos:'user' neq false}current{/if}"><em>{$LBL_USERS}</em></a></li>
		</ul>
	</div>
</div>
</form>
{literal}
<script type="text/javascript">
function changLang(val) {
   document.frmlanguage.lang_code.value = val;
	document.frmlanguage.submit();
}
</script>
{/literal}