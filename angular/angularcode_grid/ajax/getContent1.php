<?php
include('../includes/setting.php');
$statdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

$typeTable = $_POST['typeTable'];
$predicateColumn = $_POST['predicateColumn'];
$reverseColumn = $_POST['reverseColumn'];

if($reverseColumn == 'true') $reverseColumn=' desc';
else $reverseColumn=' asc';

$orderquery = " order by cStartPoint asc";
$orderquery1 = " order by cLang asc";
$orderquery2 = " order by cHighlight asc";
$orderquery3 = " order by cEndPoint asc";
if($typeTable == '0') $orderquery = " order by ".$predicateColumn." ".$reverseColumn;
if($typeTable == '1') $orderquery1 = " order by ".$predicateColumn." ".$reverseColumn;
if($typeTable == '2') $orderquery2 = " order by ".$predicateColumn." ".$reverseColumn;
if($typeTable == '3') $orderquery3 = " order by ".$predicateColumn." ".$reverseColumn;

$arr = null;
$arr1 =null;
$arr2 = null;
$arr3 = null;
if($typeTable == '0' || $typeTable == '')
{
$query="select s.name as startPoint,count(*) as cStartPoint from log_route r
left join startpoint s on s.startpoint_id  = r.startPoint where time > DATE('".$statdate."') and time < DATE('".$enddate."')  group by r.startPoint".$orderquery;
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);


if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}
}

if($typeTable == '1' || $typeTable == '')
{
$query1="select lang,count(*) as cLang from log_route where time > DATE('".$statdate."') and time < DATE('".$enddate."')  group by lang".$orderquery1;
$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);


if($result1->num_rows > 0) {
	while($row1 = $result1->fetch_assoc()) {
		$arr1[] = $row1;
	}
}
}

if($typeTable == '2' || $typeTable == '')
{
$query2="SELECT highlight, count(*) as cHighlight FROM log_highlight where time > DATE('".$statdate."') and time < DATE('".$enddate."')  group by highlight".$orderquery2;
$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);


if($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        $arr2[] = $row2;
    }
}
}

if($typeTable == '3' || $typeTable == '')
{
$query3="SELECT r.endPoint,o.name,count(r.id) as cEndPoint FROM log_route r
left join object o on o.id = r.endPoint
where time > DATE('".$statdate."') and time < DATE('".$enddate."') 
group by  r.endPoint".$orderquery3;

$result3 = $mysqli->query($query3) or die($mysqli->error.__LINE__);


if($result3->num_rows > 0) {
    while($row3 = $result3->fetch_assoc()) {
        $arr3[] = $row3;
    }
}
}
$json_response = json_encode(array($arr,$arr1,$arr2,$arr3,$statdate,$enddate));

// # Return the response
echo $json_response;
?>