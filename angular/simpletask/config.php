<?php
session_start();
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("doctor", $conn);
mysql_query("set names 'utf8'");
date_default_timezone_set('Australia/Canberra');
?>