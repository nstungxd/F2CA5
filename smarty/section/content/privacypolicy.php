<?php
$staticarr = $stPageObj->getStaticPageDetail("*","AND vFile = 'Privacy Policy'");

$smarty->assign("content",$staticarr[0]['tContent_'.LANG]);
$smarty->assign("topwelcometext",$staticarr_top[0]['tContent_'.LANG]);
?>