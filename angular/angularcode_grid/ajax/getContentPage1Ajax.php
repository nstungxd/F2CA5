<?php
include('../includes/setting.php');
$currentPage = $_POST['currentPage'];
$entryLimit = $_POST['entryLimit'];
if($entryLimit == '0') $limit='';
else $limit = ' limit '.($currentPage-1)*$entryLimit.",".$entryLimit ;

$predicate = $_POST['predicate'];
$reverse = $_POST['reverse'];
if($reverse == 'true') $reverse=' desc';
else $reverse=' asc';
$order = ' order by r.id desc';
if($predicate!='') $order = ' order by '.$predicate.$reverse;

$minfilter = $_POST['minfilter'];
$maxfilter = $_POST['maxfilter'];
$filterdate =" where r.time > DATE('".$minfilter."') and r.time < DATE('".$maxfilter."')";

$textsearch = $_POST['textsearch'];
$filterType = $_POST['filterType'];
$arrColumn = array("r.id", "r.startPoint", "s.name","r.endPoint","j.name","r.building","b.name","r.level","r.type","r.lang");
$filtertext="";
$sql_search_fields = Array();
if($textsearch!= "")
{
    if($filterType != "$")
        $filtertext = " and ".$filterType." like('%" . $textsearch . "%')";
    else
    {
        $filtertext = " and ";
        foreach ($arrColumn as $itemcolumn)
        {
            $sql_search_fields[] = $itemcolumn." like('%" . $textsearch . "%')";
        }
         $filtertext .= implode(" OR ", $sql_search_fields);
    }
}

$query="SELECT r.id,r.startPoint,s.name as startpoint_name,r.endPoint,j.name as destination_name,r.building,b.name as build_name,r.level,r.type,r.lang,r.time FROM log_route r left join building b on b.id = r.building left join object j on j.id = r.endPoint left join startpoint s on s.startpoint_id = r.startPoint".$filterdate.$filtertext.$order.$limit;
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;
	}
}
$query1="SELECT r.id,r.startPoint,s.name as startpoint_name,r.endPoint,j.name as destination_name,r.building,b.name as build_name,r.level,r.type,r.lang,r.time FROM log_route r left join building b on b.id = r.building left join object j on j.id = r.endPoint left join startpoint s on s.startpoint_id = r.startPoint".$filterdate.$filtertext;
$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
# JSON-encode the response
$json_response = json_encode(array($arr,$result1->num_rows,$currentPage,$entryLimit,$query));

// # Return the response
echo $json_response;
?>