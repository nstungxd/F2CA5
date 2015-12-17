<table width="100%" border="0" cellspacing="1" cellpadding="1">
	{section name=ln loop=$asocs}
   {if $smarty.section.ln.index % 2 eq 0}
      {assign var="rowclass" value="golden"}
   {else}
      {assign var="rowclass" value=""}
   {/if}
	<tr class="{$rowclass}">
		<td width="20" height="26" align="center">
			<input type="checkbox" class="radib-btn" name="associations[]" id="iAssociationID" value="{$asocs[ln].iAssociationId}" />
		</td>
		<td width="100" align="left">{$asocs[ln].vBuyer2}</td>
      <td width="80" align="left" style="padding-left:2px;">{$asocs[ln].vProduct}</td>
		<td width="70" align="center">{$asocs[ln].vACode}</td>
		<td width="62" align="center">
			{if $asocs[ln].eStatus eq 'Need to Verify' || ($asocs[ln].eNeedToVerify eq 'Yes' && $asocs[ln].eStatus neq 'Delete')}
            <img src="{$SITE_IMAGES}sm_images/exclaim.gif" alt="" border="0" />
         {elseif $asocs[ln].eStatus eq 'Active'}
            <img src="{$SITE_IMAGES}sm_images/icon.gif" alt="" border="0" />
         {elseif $asocs[ln].eStatus eq 'Modified'}
            <img src="{$SITE_IMAGES}sm_images/icon-modified.png" alt="" border="0" />
         {elseif $asocs[ln].eStatus eq 'Inactive'}
            <img src="{$SITE_IMAGES}sm_images/icon-inactive.gif" alt="" border="0" />
			{elseif $asocs[ln].eStatus eq 'Delete'}
            <img src="{$SITE_IMAGES}sm_images/icon-cancel.gif" alt="" border="0" />
         {/if}
		</td>
	   <td width="94" align="center">
			<a href="{$SITE_URL_DUM}b2sprodtasoc/{$asocs[ln].iAssociationId}"><img src="{$SITE_IMAGES}sm_images/icon-pen.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" /></a> &nbsp;
		   <a href="{$SITE_URL_DUM}b2sprodtasocview/{$asocs[ln].iAssociationId}"><img src="{$SITE_IMAGES}sm_images/icon-edit.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" /></a> &nbsp;
	      <img src="{$SITE_IMAGES}sm_images/icon-delete.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" onclick="status('delete','{$asocs[ln].iAssociationId}')"/>
	   </td>
	</tr>
	{/section}
</table>
<input type="hidden" name="pg" id="pg" value="" />
<div class="pagging-bg">
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			{if $count eq 0}
		  	<td align="center" height="27">{$pgmsg}</td>
			{else}
		  	<td align="left" height="27">{$pgmsg}</td>
			{/if}
			<td align="right"  class="detail-graybg" style="padding-right:12px;">
				{$paging}
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