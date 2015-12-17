<?php
//ErrorDocument 404 /clinicalcafe/index.php?file=c-404error

//RewriteRule ^index index.php

####CONTENT Section URLS
//RewriteRule ^home/?(.*)	  		index.php?file=c-home&msg=$1
//RewriteRule ^home  		  		index.php?file=c-home
$statval  = 0;

$fileStr = (isset($_SERVER['PATH_INFO']))? $_SERVER['PATH_INFO']: '';
$fileStr = substr($fileStr,1);
$fileArr = @explode("/",$fileStr);
$filename = $fileArr[$statval];

require_once("rephtaccesscontent.php");
if(isset($$filename)) {
	$fileval = $$filename;
	$filevalArr  = @explode("&",$fileval);
	if(count($filevalArr) > 0) {
	foreach($filevalArr as $farr)
	{
			if($farr != ''){
				$filArr = @explode("=",$farr);
				$reqval = str_replace("$","",$filArr[1]);
				if(ctype_digit($reqval)){
					$vName_f  = $filArr[0];
					$vValue_f  = (isset($fileArr[$reqval]))? $fileArr[$reqval] : '';
					global $$vName_f;
					$$vName_f=$vValue_f;
					$_GET[''.$filArr[0].'']	= (isset($fileArr[$reqval]))? $fileArr[$reqval] : '';
				}else{
					$vName_f  = $filArr[0];
					$vValue_f  = $filArr[1];
					global $$vName_f;
					$$vName_f=$vValue_f;
					$_GET[''.$filArr[0].'']	= $filArr[1];
				}
			}
		}
	}
}
?>