<?php
session_start();
$conn = mysql_connect("localhost", "admin_amtvportal", "amtvportal");
mysql_select_db("admin_amtvportal", $conn);
mysql_query("set names 'utf8'");
date_default_timezone_set('Australia/Canberra');
?>
