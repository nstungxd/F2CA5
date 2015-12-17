<?php
$staticarr = $stPageObj->getStaticPageDetail("*","AND vFile = 'Contact Us'");

$smarty->assign("content",$staticarr[0]['tContent_'.LANG]);
$smarty->assign("topwelcometext",$staticarr_top[0]['tContent_'.LANG]);
?>