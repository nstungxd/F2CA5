<?php
include('../includes/setting.php');


$typeTable = $_POST['typeTable'];
$predicateColumn = $_POST['predicateColumn'];
$reverseColumn = $_POST['reverseColumn'];
$nextday =  date('Y-m-d', strtotime('+1 days'));
$today =  date('Y-m-d');
$yesterdaypre =  date('Y-m-d', strtotime('-2 days'));
$day8ago =  date('Y-m-d', strtotime('-8 days'));
$day7ago =  date('Y-m-d', strtotime('-7 days'));
$day6ago =  date('Y-m-d', strtotime('-6 days'));

if($reverseColumn == 'true') $reverseColumn=' desc';
else $reverseColumn=' asc';

$orderquery = " order by cStartPoint asc";
$orderquery1 =" order by cStartPoint asc";
$orderquery2 =" order by cStartPoint asc";
if($typeTable == '0') $orderquery = " order by ".$predicateColumn." ".$reverseColumn;
if($typeTable == '1') $orderquery1 = " order by ".$predicateColumn." ".$reverseColumn;
if($typeTable == '2') $orderquery2 = " order by ".$predicateColumn." ".$reverseColumn;

$arr = null;
$arr1 =null;
$arr2 = null;

if($typeTable == '0' || $typeTable == '')
{
    $query="select s.name as startPoint,(select COUNT(*) from log_route r where r.startpoint=s.startpoint_id and r.time > DATE('".$today."') and r.time < DATE('".$nextday."')) cStartPoint from startpoint s".$orderquery;
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

    $arr = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
    }
}

if($typeTable == '1' || $typeTable == '')
{
    $query1="select s.name as startPoint,(select COUNT(*) from log_route r where r.startpoint=s.startpoint_id and r.time > DATE('".$yesterdaypre."') and r.time < DATE('".$today."')) cStartPoint from startpoint s".$orderquery1;
    $result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);

    $arr1 = array();
    if($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
            $arr1[] = $row1;
        }
    }
}

if($typeTable == '2' || $typeTable == '')
{
    $query2="select s.name as startPoint,(select COUNT(*) from log_route r where r.startpoint=s.startpoint_id and r.time > DATE('".$day7ago."') and r.time < DATE('".$day6ago."')) cStartPoint from startpoint s".$orderquery2;
    $result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);

    $arr2 = array();
    if($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            $arr2[] = $row2;
        }
    }
}


$json_response = json_encode(array($arr,$arr1,$arr2));

// # Return the response
echo $json_response;
?>