<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $CPANEL_TITLE?> </title>
<link href="<?php echo ADMIN_THEME?>gr_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo S_JQUERY; ?>jquery.js" ></script>
<!--{*<script type="text/javascript" src="<?php echo S_JQUERY; ?>jquery_plugins.js" async="async"></script>*}-->
<script type="text/javascript" src="<?php echo A_G_JS?>jgeneral.js"></script>
<script type="text/javascript">
var clockLocalStartTime = new Date();
var clockServerStartTime = new Date(<?php echo(DateTime(time(),'4'))?>);
</script>
<script type="text/javascript">
	var SITE_URL = '<?php echo SITE_URL; ?>';
   var SITE_URL_DUM = '<?php echo SITE_URL_DUM; ?>';
	var ADMIN_URL = '<?php echo ADMIN_URL; ?>';
	/* // var CSR_ADMIN_URL	= '<?php /* if(isset(CSR_ADMIN_URL)) { echo CSR_ADMIN_URL; } */?>'; */
	var ADMIN_AJAX_URL = '<?php echo ADMIN_AJAX_URL; ?>';
   var ADMIN_IMAGES = '<?php echo ADMIN_IMAGES; ?>';
</script>
<script type="text/javascript" src="<?php echo A_G_JS; ?>jclock.js"></script>
</head>
<body id="mainbody" onload="" onunload="clockOnUnload()">
<div name="showLoading" id="showLoading" style="position: absolute; display:none; left:450px; z-index:10; width:75px; height:50px; top:250px">
   <table width="160%" border="0" style="border: 2px solid #e4e4e4" align="center" cellpadding="3" cellspacing="0" height="50px">
      <tr><td align="CENTER"  height="30" valign="center" ><img src="<?php echo ADMIN_IMAGES?>ajax-loader3.gif"  style="border:0"/></td></tr>
   </table>
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
//if($file)
//{
?>
<tr><td valign="top" class="top-bg" height="80"><?php include_once(SAPATH_ROOT."top/top.inc.php"); ?></td></tr>
<?php
//}
?>
<tr><td valign="top" class="inner-padding"><?php include_once(SAPATH_ROOT."script/general/common.inc.php"); ?></td></tr>
</table>
</body>
</html>
<iframe id="iframe" frameborder="0"></iframe>
<div id="divQuickMenu" style="position:absolute;display:none; left:300px; width:700px; top:70px;">
<table border="0" cellpadding="0" cellspacing="0" width="80%">
<tr><td valign="top" ><?php print $menubobj->openAllMenu(); ?></td></tr>
</table>
</div>
<script type="text/javascript" async="async">
$(document).ready(function() {
	clockInit(clockLocalStartTime, clockServerStartTime); 
   clockOnLoad();
});
</script>
<script type="text/javascript" language="javascript" charset="utf-8">
  //new Draggable('divQuickMenu',{handle:'handle2'});
</script>