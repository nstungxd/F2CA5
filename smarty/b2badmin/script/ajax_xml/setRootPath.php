<?php  
$wd_was = getcwd();
chdir("../../../cpanel");
include("web.config.php");
chdir($wd_was);
ob_clean();
?>