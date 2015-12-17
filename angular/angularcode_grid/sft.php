<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
</head>
<body>
<?php
$arr = array('', 2, 3, 4);
include('includes/setting.php');
$searchphrase = "3";
$table = "building";
$sql_search = "select * from " . $table . " where ";
$sql_search_fields = Array();
$sql = "SHOW COLUMNS FROM " . $table;
$rs = $mysqli->query($sql);
    if($rs->num_rows > 0) {
        while($r = $rs->fetch_assoc()) {

            $colum = $r["Field"];
            $sql_search_fields[] = $colum . " like('%" . $searchphrase . "%')";
        }
    }
print_r($sql_search_fields);
$sql_search .= implode(" OR ", $sql_search_fields);
$rs2 = $mysqli->query($sql_search);
print_r($sql_search);
$out = $rs2->num_rows . "\n";
echo "Number of search hits in $table " . $out."<br />";
    while($results = $rs2->fetch_assoc()) {
    print $results["id"]."<br />";
}
?>
</body>
</html>