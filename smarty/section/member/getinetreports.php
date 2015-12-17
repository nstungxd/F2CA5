<?php
$postvals = $_POST;
$nwrpt = (isset($postvals['nwrpt']))? $postvals['nwrpt'] : '';
// pr($postvals); exit;
if(isset($postvals['nwrpt'])) {
	unset($postvals['nwrpt']);
}
$params = http_build_query($postvals);
$ext = (isset($_POST['init']))? $_POST['init'] : 'png';
$reportname = (isset($_POST['report']))? basename($_POST['report']) : '';
$inetserverurl = (! isset($INET_SERVER_URL) || trim($INET_SERVER_URL)=='')? '' : trim($INET_SERVER_URL,'\/');
$fldir = SPATH_ROOT.$inetreportsfiles."/reports/".$curORGID;
$flpath = $fldir.'/'.md5($params).'.'.$ext;
$flurl = SITE_URL.$inetreportsfiles."/reports/".$curORGID.'/'.md5($params).'.'.$ext;

$fltyp = 'png';
$mime = 'image/png';
switch($ext)
{
	case 'png':
		$fltyp = 'img';
		$mime = 'image/png';
		break;
	case 'pdf':
		$fltyp = 'file';
		$mime = 'application/pdf';
		break;
	default:
		$fltyp = 'file';
		$mime = 'application/octet-stream';
		break;
}

if(file_exists($flpath) && $nwrpt != 'y') {
	echo json_encode(array('file'=>$flurl,'type'=>$fltyp,'ext'=>$ext)); exit;
}
// echo $inetserverurl.'/?'.$params; exit;
$cnts = file_get_contents($inetserverurl.'/?'.$params);
// $chk_cnts = strip_tags($cnts);
$flurl = "";
if(trim($cnts) != '' && $curORGID > 0) {
	// echo md5($params).'<br/>';
	$fldir = SPATH_ROOT.$inetreportsfiles."/reports/".$curORGID;
	if(! file_exists($fldir)) {
		mkdir($fldir, 0777);
	}
	$fl = fopen($fldir.'/'.md5($params).'.'.$ext, 'w');
	fwrite($fl, $cnts);
	fclose($fl);
	if(file_exists($flpath)) {
		$flurl = SITE_URL.$inetreportsfiles."/reports/".$curORGID.'/'.md5($params).'.'.$ext;
		//
		/*if(!isset($reportfilesObj)) {
			include_once(SITE_CLASS_APPLICATION."class.ReportFiles.php");
			$reportfilesObj = new ReportFiles();
		}*/
		// getDetails
	}
}
// $flcnts = file_get_contents($flpath.'/'.md5($params).$ext);
// echo $flcnts; exit;
echo json_encode(array('file'=>$flurl,'type'=>$fltyp,'ext'=>$ext));
exit;
?>
