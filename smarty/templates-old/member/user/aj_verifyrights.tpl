<table width="100%" border="0" cellspacing="1" cellpadding="1">
	{section name=ln loop=$userlist}
   {if $smarty.section.ln.index % 2 eq 0}
      {assign var="rowclass" value="golden"}
   {else}
      {assign var="rowclass" value=""}
   {/if}
   <tr class="{$rowclass}">
		<!--<td width="30" height="26" class="golden" align="center">
			<input type="checkbox" class="radib-btn" name="users[]" id="iUserID" value="{$userlist[ln].iUserID}" />
		</td>-->
		<td width="158" height="26" align="left" style="padding-left:2px;">{$userlist[ln].vFirstName} {$userlist[ln].vLastName}</td>
      <td width="100" align="center" style="padding-left:2px;"><strong>{$userlist[ln].OrgName}</strong></td>
		<td width="119" align="center">{'@'|str_replace:" @":$userlist[ln].vEmail}</td>
		<td width="90" align="center">{$userlist[ln].eUserType}</td>
		<td width="80" align="center">{$userlist[ln].vCountry}</td>
		<td width="62" align="center">
         {*if $userlist[ln].eStatus eq 'Active'}
            <img src="{$SITE_IMAGES}sm_images/icon.gif" alt="" border="0" />
         {elseif $userlist[ln].eStatus eq 'Need to Verify'}
            <img src="{$SITE_IMAGES}sm_images/exclaim.gif" alt="" border="0" />
         {elseif $userlist[ln].eStatus eq 'Modified'}
            <img src="{$SITE_IMAGES}sm_images/icon-modified.png" alt="" border="0" />
         {elseif $userlist[ln].eStatus eq 'Inactive'}
            <img src="{$SITE_IMAGES}sm_images/icon-inactive.gif" alt="" border="0" />
         {elseif $userlist[ln].eStatus eq 'Delete'}
            <img src="{$SITE_IMAGES}sm_images/icon-cancel.gif" alt="" border="0" />
         {/if*}
			<img src="{$SITE_IMAGES}sm_images/exclaim.gif" alt="" border="0" />
      </td>
	  <td width="94" align="center">
			<a href="{$SITE_URL_DUM}userrights/{$userlist[ln].iUserID}"><img src="{$SITE_IMAGES}sm_images/icon-edit.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp;
	  </td>
	</tr>
	{/section}
</table>
<input type="hidden" name="pg" id="pg" value=""/>
<div class="pagging-bg">
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			{if $count eq 0}
			<td align="center" height="27"><!--Showing 1 - 30 Records Of 3838-->{$pgmsg}</td>
			{else}
			<td align="left" height="27">{$pgmsg}</td>
			{/if}
			<td align="right"  class="detail-graybg" style="padding-right:12px;">
				{$paging}
				<!--Pages : &nbsp;&nbsp;<span>1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">Next</a>-->
			</td>
		</tr>
	</table>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
   <td colspan="5">
      {*include file="commonicon.tpl"*}
   </td>
</tr>
</table>