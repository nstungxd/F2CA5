<?php include('logincheck.php'); ?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Raw PHP: Select Table</title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	font-size: x-small;
}
.codetext{
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	font-size: x-small;
	font-style: normal;
	background-color: #FFFF00;
}

</style>

</head>

<body>

<h2>SELECT ONE TABLE</h2>
<form action="showfields.php" method="get">
<?php


// connect to the database
include('connectgenerator.php');

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

    if ( $rs = $link->query("SHOW TABLES FROM $db") ) {

     while ( $r = $rs->fetch_array()) {
     print "<b>$r[0]</b>: " ; //gives table name
   //  print "<br />";


	print "<input type='checkbox' name='Tbl' value='".$r[0]."'><br />\n";
	

    }
   
}


        $rs->free();



/* close connection */
mysqli_close($link);
?>
<input type="submit" value="Submit" name="Submit">
</form>
</body>
</html>
