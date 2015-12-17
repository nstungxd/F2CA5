<?php
if(!isset($generalobj)) {
	require_once(SITE_CLASS_GEN."class.general.php");
	$generalobj = new General();
}
$src = PostVar('src');
$dest = PostVar('dest');
$text = PostVar('text');
$dest = @ explode(',', $dest);
$res = '';
if(is_array($dest) && count($dest) >0) {
	$dest = array_filter($dest);
	for($l=0; $l<count($dest); $l++) {
		$response = $generalobj->languageTranslation($src, $dest[$l], $text, 'y', 'y');
		if($response != '') {
			$res[$dest[$l]] = utf8_encode($response);
		}
		// sleep(3);
	}
}
echo json_encode((array)$res);
exit;
?>