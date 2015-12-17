<table width="100%" border="0" cellspacing="1" cellpadding="0">
	{section name=ln loop=$orglist}
   {if $smarty.section.ln.index % 2 eq 0}
      {assign var="rowclass" value="golden"}
   {else}
      {assign var="rowclass" value=""}
   {/if}
	<tr class="{$rowclass}">
		<td width="30" height="26" align="center">
			<input type="checkbox" class="radib-btn" name="organizations[]" id="iOrganizationID" value="{$orglist[ln].iOrganizationID}" />
		</td>
		<td width="158" align="left">{$orglist[ln].vCompanyName}</td>
		<td width="119" align="center">{$orglist[ln].vOrganizationCode}</td>
		<td width="159" align="center">{$orglist[ln].eOrganizationType}</td>
		<td width="123" align="center">{$orglist[ln].vCountry}</td>
		<td align="center" width="62">
            {if $orglist[ln].eStatus eq 'Active'}
               <img src="{$SITE_IMAGES}sm_images/icon.gif" alt="" border="0" />
            {elseif $orglist[ln].eStatus eq 'Need to Verify'}
               <img src="{$SITE_IMAGES}sm_images/exclaim.gif" alt="" border="0" height="19" width="19" />{*}icon-need-to-verify.png{*}
            {elseif $orglist[ln].eStatus eq 'Modified'}
               <img src="{$SITE_IMAGES}sm_images/icon-modified.png" alt="" border="0" height="19" width="19" />
            {elseif $orglist[ln].eStatus eq 'Inactive'}
               <img src="{$SITE_IMAGES}sm_images/icon-inactive.gif" alt="" border="0" />
				{elseif $orglist[ln].eStatus eq 'Delete'}
               <img src="{$SITE_IMAGES}sm_images/icon-cancel.gif" alt="" border="0" />
            {/if}
		</td>
	  <td width="94" align="center">
			<a href="{$SITE_URL_DUM}createorganization/{$orglist[ln].iOrganizationID}"><img src="{$SITE_IMAGES}sm_images/icon-pen.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" /></a> &nbsp;
			<a href="{$SITE_URL_DUM}organizationview/{$orglist[ln].iOrganizationID}"><img src="{$SITE_IMAGES}sm_images/icon-edit.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" /></a> &nbsp;
			<img src="{$SITE_IMAGES}sm_images/icon-delete.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" onClick="Delete('delete','{$orglist[ln].iOrganizationID}')"/>
	  </td>
	</tr>
	{/section}
</table>
<input type="hidden" name="pg" id="pg" value=""/>
<div class="pagging-bg">
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		     {if $count eq '0'}
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
      {include file="commonicon.tpl"}
   </td>
</tr>
</table>
