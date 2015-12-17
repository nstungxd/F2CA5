<?php

$site_url = (isset($argv[1]))? $argv[1] : '';
$fl = (isset($argv[2]))? $argv[2] : '';

define('SPATH_BASE', dirname(dirname(dirname(__FILE__))) );
define('SITE_URL', $site_url);
define('SITE_URL_DUM', $site_url);

include_once(dirname(dirname(dirname(__FILE__))).'/web.config.php');

if(!isset($sendMail) || !is_object($sendMail)) {
	include(SITE_CLASS_GEN."class.sendmail.php");
	$sendMail = new SendPHPMail('live');
}

function getvals(&$vl, $key) {
	$vl = utf8_decode($vl);
}

function getvalues(&$val, $key) {
	if(in_array($key, array('fromname','sub','subject','body'))) {
		$val = utf8_decode($val);
	} else if($key == 'postArr') {
		array_walk($val, 'getvals');
	}
}

# echo "<pre>";

$files = explode(',', $fl);
$files = array_filter($files);

if(count($files) >0) {
	for($ln=0; $ln<count($files); $ln++) {
		# echo $files[$ln].',';
		$contents = file_get_contents($files[$ln]);
		if(trim($contents) == '') { continue; }
		$contents = json_decode($contents, 1);
		if(!is_array($contents) || count($contents) < 1) { continue; }
		# print_r($contents);
		for($l=0; $l<count($contents); $l++) {
			@ array_walk($contents[$l], "getvalues");
			if(isset($contents[$l]['attachments'])) {
				@ $sendMail->SendWithAttachments($contents[$l]['type'], $contents[$l]['vSection'], $contents[$l]['ToEmail'], $contents[$l]['bodyArr'], $contents[$l]['postArr'], $contents[$l]['from'], $contents[$l]['sub'], $contents[$l]['returnContentOnly'], $contents[$l]['attachments'], 'n');
			} else {
				@ $sendMail->mail_phpmailer($contents[$l]['to'], $contents[$l]['subject'], $contents[$l]['body'], $contents[$l]['from'], $contents[$l]['format'], $contents[$l]['cc'], $contents[$l]['bcc'], $contents[$l]['fromname'], $contents[$l]['toall'], 'n');
			}
		}
		//
		@ unlink($files[$ln]);
	}
	$sendMail->closeSMTPConnection();
	@ file_put_contents(SPATH_ROOT.'/tmp/ml.lg', '');
}
# echo "</pre>";
unset($sendMail);
exit;

?>