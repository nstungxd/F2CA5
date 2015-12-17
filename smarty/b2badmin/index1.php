<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php  echo  $CPANEL_TITLE?> </title>
<link href="<?php  echo  ADMIN_THEME?>loginstyle.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="<?php  echo  S_JQUERY?>jquery.js"></script>
<script type="text/javascript">
	var ADMIN_URL	= '<?php  echo  ADMIN_URL?>';	
	var ADMIN_AJAX_URL = '<?php  echo  ADMIN_AJAX_URL?>';	
        var ADMIN_IMAGES = '<?php  echo  ADMIN_IMAGES?>';

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42379708-6', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<input type="Hidden" name="acesstype" id="acesstype" value="cpanel">
<table width="1002" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="middle" ><?php include_once(SAPATH_ROOT."script/general/login.inc.php");?></td>
</tr>
</table>
</body>
</html>
