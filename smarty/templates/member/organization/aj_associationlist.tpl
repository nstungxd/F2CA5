<table width="100%" border="0" cellspacing="1" cellpadding="1">
	{section name=ln loop=$activegroup}
   {if $smarty.section.ln.index % 2 eq 0}
      {assign var="rowclass" value="golden"}
   {else}
      {assign var="rowclass" value=""}
   {/if}
	<tr class="{$rowclass}">
		<td width="20" height="26" align="center">
			<input type="checkbox" class="radib-btn" name="associations[]" id="iAsociationID" value="{$activegroup[ln].iAsociationID}" />
		</td>
		<td width="100" align="center">{$activegroup[ln].vSupplierCode}</td>
      <td width="80" align="left" style="padding-left:2px;">{$activegroup[ln].vBuyerOrg}</td>
		<td width="70" align="center">{$activegroup[ln].vBuyerCode}</td>
      {*assign var="supplier" value=$activegroup[ln].vSupplierOrg|replace:",":"<br/>"*}
      {*}<td width="150" align="center" style="height:50px;"><div style="height:50px; overflow-y:scroll;"><p style="height:1px;">&nbsp;</p>{$supplier}</br/><p style="height:1px;">&nbsp;</p></div></td>{*}
		<td width="150" align="center">{$activegroup[ln].vSupplierOrg}</td>
		<td width="62" align="center">
			{if $activegroup[ln].eStatus eq 'Need to Verify' || ($activegroup[ln].eNeedToVerify eq 'Yes' && $activegroup[ln].eStatus neq 'Delete')}
            <img src="{$SITE_IMAGES}sm_images/exclaim.gif" alt="" border="0" />
         {elseif $activegroup[ln].eStatus eq 'Active'}
            <img src="{$SITE_IMAGES}sm_images/icon.gif" alt="" border="0" />
         {elseif $activegroup[ln].eStatus eq 'Modified'}
            <img src="{$SITE_IMAGES}sm_images/icon-modified.png" alt="" border="0" />
         {elseif $activegroup[ln].eStatus eq 'Inactive'}
            <img src="{$SITE_IMAGES}sm_images/icon-inactive.gif" alt="" border="0" />
			{elseif $activegroup[ln].eStatus eq 'Delete'}
            <img src="{$SITE_IMAGES}sm_images/icon-cancel.gif" alt="" border="0" />
         {/if}
		</td>
	  <td width="94" align="center">
			<a href="{$SITE_URL_DUM}createassociation/{$activegroup[ln].iAsociationID}"><img src="{$SITE_IMAGES}sm_images/icon-pen.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" /></a> &nbsp;
			<a href="{$SITE_URL_DUM}associationview/{$activegroup[ln].iAsociationID}"><img src="{$SITE_IMAGES}sm_images/icon-edit.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" /></a> &nbsp;
			<img src="{$SITE_IMAGES}sm_images/icon-delete.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" onClick="Delete('delete','{$activegroup[ln].iAsociationID}')"/>
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
      {include file="commonicon.tpl"}
   </td>
</tr>
</table>
