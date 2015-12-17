<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("application/views/include/header.inc"); ?>
<!-- Calendar -->
<!--
<link type="text/css" rel="stylesheet" href="<?php echo $baseDir; ?>/www/css/admin/calendar.css" />
<script language="javascript" src="<?php echo $baseDir; ?>/www/js/admin/calendar-1.5.js"></script>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/js/admin/ajaxloader.js"></script>
-->
</head>
<body>
<!-- MAIN MENU
================================================== -->
<div class="container row" style="background: #333;">
	<div id="user-permission" class="threecol" style="">
		<span style="color:#FFF; font-size: 11px;">Permission: </span>
		<span style="color:#E4FF00; font-size: 14px;"><?php echo $permission?></span>
	</div>
	<div id="user-account" class="threecol last" style="float: right; margin-right: 20px;">
	<?php
		echo "<a href='javascript:logout();'>LOGOUT</a><span>|</span><span style='color:#FFF'>WELCOME, <strong>$adminname</strong></span>";
	?>
	</div>
</div>
<div id="header-wrapper" class="container row">
	<div id="user-options">
		<div class="logo fourcol">
		</div>
		<div class="sixcol last fixed">
		</div>
	</div>
</div>

<!-- MAIN CONTAINER
================================================== -->
<div class="container row">
	<!-- SIDE BAR -->
	<div id="sidebar" class="threecol">
<?php include("application/views/sidebar.php"); ?>
	</div>