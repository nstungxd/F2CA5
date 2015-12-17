<?php
date_default_timezone_set('Australia/Canberra');
require("dal_pb.php");
if (!isset($_GET["id"])) {
     echo '<script type="text/javascript">'
            , 'window.location.href="index.php?id=2";'
            , '</script>';
}
$e_template= "1";
$pr = getPracticeById($_GET["id"]);
    $rowCount = mysql_num_rows($pr);
    if($rowCount > 0)
    {
        while ($r1 = mysql_fetch_array($pr)) {
            $e_template = $r1['template_id'];
        }
    }
if($e_template == '1')
    include("template1.php");
else include("template2.php");
?>