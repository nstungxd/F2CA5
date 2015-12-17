<?php
include('../includes/setting.php');
$nextday =  date('Y-m-d', strtotime('+1 days'));
$today =  date('Y-m-d');
$yesterdaypre =  date('Y-m-d', strtotime('-2 days'));
$day8ago =  date('Y-m-d', strtotime('-8 days'));
$day7ago =  date('Y-m-d', strtotime('-7 days'));
$day6ago =  date('Y-m-d', strtotime('-6 days'));

//$query="select s.name as startPoint,count(*) as cStartPoint from log_route r left join startpoint s on s.startpoint_id  = r.startPoint where r.time > DATE('".$today."') and r.time < DATE('".$nextday."') group by r.startPoint order by cStartPoint asc";
$query="select s.name as startPoint,(select COUNT(*) from log_route r where r.startpoint=s.startpoint_id and r.time > DATE('".$today."') and r.time < DATE('".$nextday."')) cStartPoint from startpoint s order by cStartPoint asc";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

//$query1="select s.name as startPoint,count(*) as cStartPoint from log_route r left join startpoint s on s.startpoint_id  = r.startPoint where r.time > DATE('".$yesterdaypre."') and r.time < DATE('".$today."') group by r.startPoint order by cStartPoint asc";
$query1="select s.name as startPoint,(select COUNT(*) from log_route r where r.startpoint=s.startpoint_id and r.time > DATE('".$yesterdaypre."') and r.time < DATE('".$today."')) cStartPoint from startpoint s order by cStartPoint asc";
$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);

$arr1 = array();
if($result1->num_rows > 0) {
    while($row1 = $result1->fetch_assoc()) {
        $arr1[] = $row1;
    }
}


//$query2="select s.name as startPoint,count(*) as cStartPoint from log_route r left join startpoint s on s.startpoint_id  = r.startPoint where r.time > DATE('".$day8ago."') and r.time < DATE('".$nextday."') group by r.startPoint order by cStartPoint asc";
$query2="select s.name as startPoint,(select COUNT(*) from log_route r where r.startpoint=s.startpoint_id and r.time > DATE('".$day7ago."') and r.time < DATE('".$day6ago."')) cStartPoint from startpoint s order by cStartPoint asc";
$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);

$arr2 = array();
if($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        $arr2[] = $row2;
    }
}

# JSON-encode the response
$json_response = json_encode(array($arr,$arr1,$arr2));

// # Return the response
echo $json_response;
?>