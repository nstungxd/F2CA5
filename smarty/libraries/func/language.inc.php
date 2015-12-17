<?php  
function include_language_file($langcode) {
	include_once(SITE_LABEL_PATH."/".$langcode.".php");
}

function includeLang($langcode)
{
	global $smarty,$DEFAULT_LANGUAGE;
	if($langcode == "") {
		$langcode = $DEFAULT_LANGUAGE;
		header("Location:index.php");
		exit;
	}
	include_once(SITE_LABEL_PATH."/".$langcode.".php");
}

function generate_language_file()
{
	global $dbobj;
	$separator = "\n";
	$gdbobj=new DBGeneral();
	$db_lang	= $gdbobj->getLanguage();
	for($i=0;$i<count($db_lang);$i++)
	{
		$get_label	=	"SELECT vName,vValue_".$db_lang[$i]['vLanguageCode']." from ".PRJ_DB_PREFIX."_lang_lable";
		$res_label	=	$dbobj->MySQLSelect($get_label);
		$content	=	"";
		$content	= "<?php ".$separator.$separator;
		for($j=0;$j<count($res_label);$j++){
			$content	.=	'$smarty->assign("'.$res_label[$j]['vName'].'","'.trim(strip_tags($res_label[$j]['vValue_'.$db_lang[$i]['vLanguageCode'].''])).'");';
			$content	.= $separator;
		}
		$content	.= $separator."?>";
      //$gdbobj->createdynfolder(SITE_LABEL_PATH);
		$filename	=	SITE_LABEL_PATH.$db_lang[$i]['vLanguageCode'].".php";
		// echo $filename; exit;
		if (!$handle = fopen($filename, 'w+')) {
	     	echo "Cannot open file ($filename)";
	     	exit;
	  	}

	  // Write $somecontent to our opened file.
	  if (fwrite($handle, $content) === FALSE) {
	    	echo "Cannot write to file ($filename)";
	    	exit;
	  }
	}
}
?>