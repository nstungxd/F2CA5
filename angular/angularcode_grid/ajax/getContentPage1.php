<?php
include('../includes/setting.php');

$query="SELECT r.id,r.startPoint,
s.name as startpoint_name,
r.endPoint,
j.name as destination_name,
r.building,
b.name as build_name,r.level,r.type,r.lang,r.time

FROM log_route r
left join building b on b.id = r.building
left join object j on j.id = r.endPoint
left join startpoint s on s.startpoint_id = r.startPoint order by r.id desc limit 500";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}
$query1="SELECT r.id FROM log_route r";
$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
# JSON-encode the response
$json_response = json_encode(array($arr,$result1->num_rows));

// # Return the response
echo $json_response;
?>