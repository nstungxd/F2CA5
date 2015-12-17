{assign var="field" value="vMailSubject_"|cat:$LANG}
<table width="100%" border="0" cellspacing="1" cellpadding="0">
	{section name=ln loop=$activegroup}
	{*}<tr {if $activegroup[ln].dActionDate gt $lastLoginDate && !$activegroup[ln].iVerifiedID|@in_array:$curViewedInbox} class="inbox-unread" {else} class="golden" {/if}>{*}
	<tr {if $activegroup[ln].iVerifiedID|@in_array:$readm} class="golden" {else} class="inbox-unread" {/if}>
		<td width="5" height="26" align="center">
			<input type="checkbox" class="radib-btn" name="inbox[]" id="inbox" value="{$activegroup[ln].iVerifiedID}" />
		</td>
      <td height="26" width="158" align="left"><a href="{$SITE_URL_DUM}inboxdetail/{$activegroup[ln].iVerifiedID}">{$activegroup[ln].$field}</a></td>
		<td width="119" align="center">{$activegroup[ln].dActionDate|calcLTzTime|getInboxDate}</td>
	</tr>
	{/section}
</table>
<input type="hidden" name="pg" id="pg" value=""/>
<div class="pagging-bg">
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td height="27"><!--Showing 1 - 30 Records Of 3838-->{$pgmsg}</td>
			<td align="right"  class="detail-graybg" style="padding-right:12px;">
				{$paging}
				<!--Pages : &nbsp;&nbsp;<span>1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">Next</a>-->
			</td>
		</tr>
	</table>
</div>
{literal}
<script type="text/javascript">
   $('#invoice_count').html('{/literal}{$activegroup|@count}{literal}');
</script>
{/literal}