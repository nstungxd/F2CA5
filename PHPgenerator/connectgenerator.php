<?php
// server info - update with your credentials
$server = 'localhost';
$user='root';
$pass='';
$db='yii';

// connect to the database
$link = new mysqli($server, $user, $pass, $db);

// show errors (remove this line if on a live site)
mysqli_report(MYSQLI_REPORT_ERROR);

?>