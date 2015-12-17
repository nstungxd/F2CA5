<?php
include('../includes/setting.php');

$query="select s.name as startPoint,count(*) as cStartPoint from log_route r
left join startpoint s on s.startpoint_id  = r.startPoint
group by r.startPoint order by cStartPoint asc";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}

$query1="select lang,count(*) as cLang from log_route group by lang order by cLang asc";
$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);

$arr1 = array();
if($result1->num_rows > 0) {
	while($row1 = $result1->fetch_assoc()) {
		$arr1[] = $row1;
	}
}


$query2="SELECT highlight, count(*) as cHighlight FROM log_highlight group by highlight order by cHighlight asc";
$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);

$arr2 = array();
if($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        $arr2[] = $row2;
    }
}


$query3="SELECT r.endPoint,o.name,count(r.id) as cEndPoint FROM log_route r
left join object o on o.id = r.endPoint
group by  r.endPoint
order by cEndPoint asc";
$result3 = $mysqli->query($query3) or die($mysqli->error.__LINE__);

$arr3 = array();
if($result3->num_rows > 0) {
    while($row3 = $result3->fetch_assoc()) {
        $arr3[] = $row3;
    }
}

# JSON-encode the response
$json_response = json_encode(array($arr,$arr1,$arr2,$arr3));

// # Return the response
echo $json_response;
?>