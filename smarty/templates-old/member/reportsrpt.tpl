<div class="middle-container">
	<h1>{$LBL_REPORTS}</h1>
	<div class="middle-containt">
		<div class="statistics-main-box-white">
			<div class="clear"></div>
			<div class="inner-gray-bg">
            	<div align="center"><h3>{if $inetserverurl|trim eq ''}<br/>{$LBL_INET_SERVER_URL_UNAVAILABLE}<br/><br/>{/if}</h3></div>
					{if $inetserverurl|trim neq ''}
               <div>
					<form id="frmrpt" name="frmrpt" method="post" action="{$inetserverurl}{*$SITE_URL}index.php?file=m-inetreports*}">
					<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
						<tr>
							<td width="190px" valign="top">{$LBL_SELECT} {$LBL_AVAILABLE} {$LBL_REPORT} &nbsp; * : </td>
							<td>
								{if $rptfls|is_array && $rptfls|@count >0}
								<select id="rptfile" name="report">
								{section name="l" loop=$rptfls}
									<option id="{$rptfls[l].iReportId}" lp="{$smarty.section.l.index}" value="{$rptfls[l].path}">{$rptfls[l].name}</option>
								{/section}
								</select>
								{else}
									{$LBL_NO_REPORT_FILES_AVAILABLE}
								{/if}
							</td>
						</tr>
						<tr>
							<td valign="top">{$LBL_DESCRIPTION}&nbsp; :</td>
							<td><div id="rptdesc" style="display:inline-block; width:390px; word-wrap:break-word;">---</div></td>
						</tr>
						<tr>
							<td valign="top">{$LBL_TYPE}&nbsp; :</td>
							<td>
								<select id="init" name="init" style="width:100px;">
									<option value="pdf">PDF</option>
									<option value="png">PNG</option>
								</select>
							</td>
						</tr>
						<tr>
							<td valign="top" colspan="2"><u>{$LBL_PARAMETERS}&nbsp;</u> :</td>
						</tr>
						<tr>
							<td colspan="2">
								<div id="prms">
									{*if $rptfls|is_array && $rptfls|@count >0}
										{section name="l" loop=$rptfls}
											{$rptfls[l].ptext}
										{/section}
									{/if*}
								</div>
							</td>
						</tr>
					</table>
					<div>&nbsp;</div>
					<div align="center">
						<a id="btncancel" name="btncancel" href="{$SITE_URL_DUM}" class="btllbl" style="" title="{$LBL_CANCEL}" ><b>{$LBL_CANCEL}</b></a>
						<a id="printnew" name="printnew"  class="btllbl" style="" title="{$LBL_PRINT_NEW}" ><b>{$LBL_PRINT_NEW}</b></a>
						<a id="btnsubmit" name="btnsubmit" class="btllbl pointer" style="" title="{$LBL_SUBMIT}" ><b>{$LBL_SUBMIT}</b></a>
						{*<img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" />*}
					</div>
					</form>
				</div>
				<div id="rptvw">&nbsp;</div>
				<div>&nbsp;</div>
				{/if}
			</div>
      </div>
	</div>
	<span id="preview" style="display:none;"></span>
</div>
<script type="text/javascript" src="{$S_JQUERY}jquery.listboxfilter.js" ></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript">
var prms = ["{/literal}{$prms}{literal}"];
var rptdesc = ["{/literal}{$rptdesc}{literal}"];
$(document).ready(function()
{
	$("#orgfilter").bigoFilter("#promptorganization_id", {property: 'text'});
	$("#usrfilter").bigoFilter("#promptuser_id", {property: 'text'});
	$("#pofilter").bigoFilter("#promptpo_id", {property: 'text'});
	$("#invfilter").bigoFilter("#promptinvoice_id", {property: 'text'});
	$("#rfq2filter").bigoFilter("#promptrfq2_id", {property: 'text'});
	$("#rfq2bidfilter").bigoFilter("#promptrfq2_bid_id", {property: 'text'});
	$("#rfq2bidawardfilter").bigoFilter("#promptrfq2_bid_award_id", {property: 'text'});
	function getorgusers() {
		if($.trim($('#promptorganization_id').val()) == '') {
			if($('#promptuser_id option').length >0) {
				$('#promptuser_id option[value!=""]').remove();
			}
		} else if($('#promptuser_id option').length >0) {
			var url = SITE_URL+"index.php?file=m-aj_getRptCombos";
			var pars = $('#frmrpt').serialize()+'&type=usr&dseltxt='+'{/literal}{$LBL_SELECT} {$LBL_USER}{literal}';
			$.ajax({type:"post", url:url, data:pars, success:function(resp) {
				$('.puser').attr('innerHTML',resp);
			}});
		}
	}
	$('#promptorganization_id').live("change", getorgusers);
	function setprms() {
		var lp = $('#rptfile option:selected').attr('lp');
		$('#prms').attr('innerHTML', prms[lp]);
		$('#rptdesc').attr('innerHTML', rptdesc[lp]);
		//
		// $('#prms > el').hide();
		// $('#prms > el[pth="'+$('#rptfile').val()+'"]').show();
		$("#promptfrom_date").datepicker({
			dateFormat: 'yy-mm-dd',
			// timeFormat: 'hh:mm:ss',
			showOn: "both",
			buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
			buttonImageOnly: true,
			onSelect: function(dateText, inst) {
				 $(document).ready(function(dateText, inst) {
					  var ead = 10;
					  $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
				 });
			},
			onClose: function() {
				 $(document).ready(function(dateText, inst) {
					  var ead = 10;
					  $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
				 });
			}
		});
		//});
		// $("#tDate").live("click",function() {
			$("#promptto_date").datepicker({
				dateFormat: 'yy-mm-dd',
				// timeFormat: 'hh:mm:ss',
				showOn: "both",
				buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
				buttonImageOnly: true,
				onSelect: function(dateText, inst) {
					 $(document).ready(function(dateText, inst) {
						  var ead = 10;
						  $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
					 });
				},
				onClose: function() {
					 $(document).ready(function(dateText, inst) {
						  var ead = 10;
						  $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
					 });
				}
			});
	}
	setprms();
	$('#rptfile').change(setprms);
	$('#frmrpt').validate({
		"ignore":":hidden"
	});
	function frmsubmit(rpt) {
		var vld = $('#frmrpt').valid();
		if(! vld) {
			return false;
		}
		if($('#rptfile').length >0 && $('#rptfile').val()!='') {
			// var href = $('#frmrpt').attr('action')+'&rptfile='+$('#rptfile').val()+'&init='+$('#init').val();
			// var href = '{/literal}{$SITE_URL}{literal}index.php?file=m-getinetreports&'+$('#frmrpt').serialize();
			var url = "{/literal}{$SITE_URL}{literal}"+"index.php?file=m-getinetreports";
			var prms = $('#frmrpt').serialize()+"&nwrpt=y";
			$.ajax({type:"post", url:url, data:prms, success:function(resp) {
				rslt = $.parseJSON(resp);
				// alert(rslt['file']);
				if($.trim(rslt['file'])=='') {
					alert(LBL_REPORT_NOT_AVAILABLE);
					return false;
				}
				$.colorbox({ width:"790px", height:"550px", iframe:true, href:rslt['file'] });
			} });
			// var href = $('#frmrpt').attr('action')+'/?'+$('#frmrpt').serialize();
			// $.colorbox({ width:"790px", height:"550px", iframe:true, href:href });
			// $(".btnsubmit").trigger('click');
			// $('#frmrpt')[0].submit();
			return true;
		}
		alert('No Report Selected');
		return false;
	}
	//$('#btnsubmit').click(frmsubmit('n'));
	//$('#printnew').click(frmsubmit('y'));
	$("#btnsubmit").click(function() {
		frmsubmit('n');
	});
	$("#printnew").click(function() {
		frmsubmit('y');
	});
});
</script>
{/literal}
