<?php
$staticarr = $stPageObj->getStaticPageDetail("*","AND vFile = 'About Us'");

$smarty->assign("topwelcometext",$staticarr_top[0]['tContent_'.LANG]);
$smarty->assign("content",$staticarr[0]['tContent_'.LANG]);
?>