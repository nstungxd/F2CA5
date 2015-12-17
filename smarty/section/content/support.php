<?php
$staticarr = $gdbobj->getInfoTable("".PRJ_DB_PREFIX."_static_pages","vFile","Support");
$smarty->assign("content",$staticarr[0]['tContent']);
?>