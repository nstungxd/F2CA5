<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>{$SITE_SEO_TITLE}</title>
<link href="{$SITE_CSS}{$cssfile}" rel="stylesheet" type="text/css" />
<meta name="keywords" content="{$META_KEYWORD}"/>
<meta name="description" content="{$META_DESCRIPTION}"/>
{$META_OTHER}
<base href="{$SITE_URL_DUM}"/>
<!--{*<link rel="icon" href="{$SITE_IMAGES}url.ico" type="image/x-icon" />
<link rel="shortcut icon" href="{$SITE_IMAGES}url.ico" type="image/x-icon" />*}-->
<link href="{$SITE_CSS}jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$S_JQUERY}jquery.js"></script>
<!--{*<script type="text/javascript" src="{$S_JQUERY}jquery-ui.min.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery_plugins.js"></script>*}-->
<script type="text/javascript" src="{$SITE_CONTENT_JS}jgeneral.js"></script>
</head>
{literal}
<script type="text/javascript" async="async">
var d = new Date()
var gmtoffset = d.getTimezoneOffset();
// console.log(gmtoffset);
/*var cf = '';
function aresp(resp)
{
	//alert(resp);
	if(resp=='stop')
	{
		//alert("Multi browsing in this site is not allowed !");
		cf = 'n';
		//window.close();
	}
}
function chkpg()
{
	var prc = '{/literal}{$prc}{literal}';
	// alert(prc);
	if($.trim(prc) != '')
	{
		var url = SITE_URL+"index.php?file=m-aj_chkpage";
		var pars = "&prc="+prc;
		//alert(url+pars);
		$.ajax({type:"POST", url:url, data:pars, async:false, success:aresp});
	}
	if(cf=='n') {
		//alert("Close this tab/window");
		//window.close();
		//return false;
	}
	// return false;
}*/
//window.onload = chkpg;
//window.onbeforeunload = chkpg;
function njs() {
   $('#nojs').attr('innerHTML','');
}
</script>
{/literal}

{include file="jsvars.tpl"}
{if $file|@in_array:$notincludeindex}
<body class="pop">
<div>
	{include file="$section/$page.tpl"}
</div>
</body>
{else}
<body id="{$bodyid}" class="body" onload="njs();" >
<div id="{$dvid}">
   <div>
      {if !$file|@in_array:$notUserTop}
			{if $uorg_type eq 'Buyer2'}
				{include file="top/$usersec/"|cat:"b2top.tpl"}
			{else}
				{include file="top/$usersec/"|cat:"top.tpl"}
			{/if}
      {else}
         {include file="top/"|cat:"top.tpl"}
      {/if}
	</div>
	<div id="{$mdivid}" class="osX">
		{if $file neq 'c-home' && $file neq 'c-login' && $file neq '' && $file neq 'c-aboutus' && $file neq 'c-contactus' && $file neq 'c-privacypolicy' && $file neq 'c-forgotpass' && $file neq 'm-orgregister'}
		<div class="jScrollPaneContainer" style="height:371px; width:1170px;">
		{/if}
		<div id="pane2" class="" {*if $file eq 'c-home' || $file eq 'c-login' || $file eq ''}style="height:339px;"{/if*}>
      {if !$file|@in_array:$notUserLeft}
			{if $uorg_type eq 'Buyer2'}
				{include file="left/$usersec/"|cat:"b2left.tpl"}
			{else}
				{include file="left/$usersec/"|cat:"left.tpl"}
			{/if}
      {/if}
      <div id="mid_content">
         {include file="$section/$page.tpl"}
      </div>
		{include file="right/$usersec/"|cat:"right.tpl"}
		<div class="clear"></div>
		</div>
		{if $file neq 'c-home' && $file neq 'c-login' && $file neq ''}
		</div>
		{/if}
	</div>
	</div>
	<div class="clear" style="height:1px;">&nbsp;</div>
</div>
<div class="clear" style="height:3px;">&nbsp;</div>
{include file="bottom/$usersec/"|cat:"bottom.tpl"}
<div class="clear" style="height:1px;">&nbsp;</div>
<div id="flmsg" class="flmsg" style="z-index:300">
	{if $multipleLogins eq 'yes'}
   <div class="draggable" style="background:#aceef7; width:350px; float:right;">
		<div class="droppable" style="color:#ff0000; padding:3px; height:37px;">
			<center><span class="" style=""><p class="" style="height:9px;"><b>{$MSG_ANOTHER_LOGIN}<br/>{*$MSG_LOGOUT_FROM_OTHER_PLACES*}</b></p></span></center>
			<span style=""><center>
			<form method="post" action="{$SITE_URL}index.php?file=m-aj_logoutothers" style="display:inline;">
				<input class="flbtn" type="submit" name="lgout" id="lgout" value="{$LBL_LOGOUT_FROM_OTHER_PLACES}" style="" />
				<span style="float:right; padding-top:3px;"><img src="{$SITE_IMAGES}sm_images/icon-cancel.gif" title="{$LBL_CLOSE}" onclick="closemsg('flmsg');" /></span>
			</form></center>
			</span>
		</div>
	</div>
	{/if}
</div>
<span id="nojs"><noscript><meta http-equiv="REFRESH" content="0; URL={$SITE_URL_DUM}nojavascript.php"/></noscript></span>
</body>
{/if}
</html>
{literal}
<script type="text/javascript" async="async">
function CallColoerBox(href,width,height,type)
{
   $(document).ready(function() {
      if(type == 'image') {
         $(".single").colorbox();
      } else if(type == 'slideshow') {
         $("a[rel='slides']").colorbox({slideshow:true});
      } else if(type == 'options') {
         $(".colorbox").colorbox({width:""+width+"px", height:""+height+"px", iframe:true,href:""+href+""});
      } else {
         $("a[href='"+href+"']").colorbox({width:""+width+"px", height:""+height+"px", iframe:true});
      }
   });
}
</script>
{/literal}
{if $file neq 'c-home' && $file neq 'c-login' && $file neq '' && $file neq 'c-aboutus' && $file neq 'c-contactus' && $file neq 'c-privacypolicy' && $file neq 'c-forgotpass' && $file neq 'm-orgregister'}
{literal}
<script type="text/javascript" async="async">
$(document).ready(function() {
	$('.left-menu dl').each(function() {
		$(this).click(toggleleft);
	});
	$('#flmsg').fadeIn('slow');
	/*	$('.draggable').draggable({
		containment: 'parent',
		opacity: 0.70
	});*/
	$(function() {
		var ead=10;
		$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
	});
   $("div.middle-container").bind("resize", function() {
		var ead=10;
		$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
	});
/*	$("div.middle-containt").bind("resize", function() {
		// $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-containt'});
	});
*/
	/*if($.browser.msie) {
		$('div.middle-container').live("resize", function() {
			$(document).ready( function() {
				var ead = 10;
				$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
			});
		});
	} else if($.browser.webkit) {
		//
	} else {
		$('div.middle-container').bind('DOMAttrModified', function(event) {
			$(document).ready( function() {
				var ead = 10;
				$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
			});
		});
	}*/
	$("div.middle-container").watch('width,height', function() {
      $(document).ready( function() {
			var ead = 10;
			$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
		});
   });
});
function toggleleft ()
{
	$(this).next('ul').toggle('slow');
//	alert($('div.middle-container').height());
//	alert($('#pane2').height());
//	alert($('div.jScrollPaneContainer').height());
	if($('#jScrollPaneContainer').height()<=(parseInt($('div.left-menu').height())+90) || !($('#jScrollPaneContainer').height()))
	{
		//$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container'});
		var ust = '{/literal}{$sess_usertype_short}{literal}';
		if(ust=='OU') {
			ead=190;
		} else {
			ead=170;
		}
		// var ead=70;
		$(document).ready( function() {
			$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.left-menu', eladd:ead});
		});
	}
//	alert($('div.jScrollPaneContainer').height());
}
function closemsg(el) {
	$('#'+el).fadeOut('slow');
}
</script>
{/literal}
{/if}
{*if $file eq 'c-home' || $file eq 'c-login' || $file eq '' || $file eq 'c-aboutus' || $file eq 'c-contactus' || $file eq 'c-privacypolicy' && $file neq 'c-forgotpass' && $file neq 'm-orgregister'}
{literal}
<script type="text/javascript" async="async">
$('#pane2').css('height',parseInt(document.body.offsetWidth)-970);
$('#pane2').css('overflow-y','auto');
// alert($('#pane2').css('height'));
// alert(document.body.offsetWidth);
// $('#mid_content').css('overflow-y','scroll');
</script>
{/literal}
{/if*}