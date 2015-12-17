<?php include('logincheck.php'); ?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Raw PHP: Select Fields</title>
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
<font size="4"><b>Check which fields you want to use </b>(primary key 
should be in the textbox)<b>:</b></font><p><br /><br />


<?php
function getFieldType($thevalue){

    switch ($thevalue) :
        case  3: return 'Integer'; 
        case  246: return 'Numeric or Decimal or Fixed';
        case  1: return 'TinyInt or Bool';
        case  2: return 'SmallInt';
        case  9: return 'MediumInt';
        case  8: return 'BigInt or Serial';
        case  4: return 'Float';
        case  5: return 'Double';
        case  12: return 'Datetime';
        case 10: return 'Date';
        case 7: return 'TimeStamp';
        case 11: return 'Time';
        case 13: return 'Year';
        case 254: return 'Char or Enum or Set or Binary';
        case 253: return 'VarBinary or VarChar';
        case  252: return 'Text or TinyText or MediumText or LongText or TinyBlog or Blob or MediumBlob';
      
    endswitch;
}

function getFieldDataType($thevalue){

    switch ($thevalue) :

       
        case  1: return 'i';
        case  2: return 'i';
        case  3: return 'i'; 
        case  4: return 'd';
        case  5: return 'd';  
        case 7: return 's';
        case  8: return 'i';   
        case  9: return 'i';
        case 10: return 's';
        case 11: return 's';
        case  12: return 's';
        case 13: return 's';
        case  246: return 'i';
        case  252: return 's';
        case 253: return 's';
        case 254: return 's'; 
       
    endswitch;
}


?>



<?php


// connect to the database
include('connectgenerator.php');


/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}




print "<form method='get' action='createcode.php'>";


print "<input type='hidden' name='Tbl' value='".@$_GET["Tbl"]."' />";



$qColumns = "SELECT * from ".@$_GET["Tbl"];

if ($rsCol = mysqli_query($link, $qColumns)) {

    /* Get field information for all columns */
    $finfo = mysqli_fetch_fields($rsCol);

    foreach ($finfo as $colval) {
       printf("<br/><b>Name:     %s\n", $colval->name."</b>");
         if ($colval->flags & 4) {
     echo '<br/>Unique key flag is set';
  } 
    if ($colval->flags & 2) {
     echo '<br/>Primary key: <input type="text" size="15" name="PrimaryKey" value="'.$colval->name.'" />';
  } 
      if ($colval->flags & 512) {
     echo '<br/>Autoincrement';
  }   
  if ($colval->flags & 1){
    print("<br/>Field can't be null\n");  
    }  
     if ($colval->flags & 32768){
    print("<br/>Is Numeric\n");  
    } 
     if ($colval->type == 10){
    print("<br/>Is Date\n");  
    } 
     if ($colval->type == 12){
    print("<br/>Is Datetime\n");  
    } 
      if ($colval->type == 7){
    print("<br/>Is Tmestamp\n"); 
     
    }      if ($colval->type == 11){
    print("<br/>Is Time\n");  
    } 
     if ($colval->type == 13){
    print("<br/>Is Year\n");  
    } 

        printf("<br/>length: %d\n", $colval->length);
        printf("<br/>def: %d\n", $colval->def);
        //printf("<br/>charsetnr: %d\n", $val->charsetnr);
        printf("<br/>decimals: %d\n", $colval->decimals);
        //printf("<br/>Flags:    %d\n", $val->flags);
        printf("<br/>Type:     %d\n\n", $colval->type);

    $FieldDataType=getFieldDataType($colval->type); 
    echo "<b>". getFieldType($colval->type)."</b>";  
  
echo"<br />Select field: <input type='checkbox' name='".$colval->name."' value='".$colval->name."|". $FieldDataType."' />";
    
        
        echo "<br><br>";
        $FieldDataType=empty( $FieldDataType ); 
    }
    mysqli_free_result($rsCol);







       }


/* close connection */
mysqli_close($link);
?>


<input type="submit" value="Submit" name="Submit">
</form>

</body>
</html>