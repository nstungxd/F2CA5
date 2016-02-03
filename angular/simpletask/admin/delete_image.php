<?php
require("../dal_pb.php");
if (!isset($_SESSION['acc_type']) || !isset($_SESSION['id'])  || $_SESSION['acc_type']!='2' )
{
    echo '<script type="text/javascript">'
    , 'window.location.href="index.php";'
    , '</script>';
}
if (isset($_GET["id"])) {
    $dr = getImageSlideBy($_GET["id"]);
    $rowCount = mysql_num_rows($dr);
    if($rowCount > 0)
    {
        deleteImageSlide($_SESSION['id'],$_GET["id"]);
        echo '<script type="text/javascript">'
        , 'window.location.href="practice.php";'
        , '</script>';
    }

}
echo '<script type="text/javascript">'
, 'window.location.href="practice.php";'
, '</script>';
?>