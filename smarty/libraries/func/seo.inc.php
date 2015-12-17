<?php  
//SEO FILE to generate meta tag
function seo_create_title($str, $length = 100)
{
	// Strip HTML and Truncate to create a title, Google truncates Titles to 40 characters.
	$title = truncate_string(seo_simple_strip_tags($str), $length);
	if (strlen($str) > strlen($title)) {
		$title .= "...";
	}
	return $title;
}

function seo_create_meta_description($str, $length = 2000)
{
	// Strip HTML and Truncate to create a META description, Google doesn't care about META tags.
	$meta_description = truncate_string(seo_simple_strip_tags($str), $length);
	if (strlen($str) > strlen($meta_description)) {
		$meta_description .= "...";
	}
	return $meta_description;
}

function seo_create_meta_keywords($str, $length = 2000) {
	// Strip HTML and Truncate to create a META keywords, Google doesn't care about META tags.
	$exclude = array('description','save','$ave','month!','year!','hundreds','dollars','per','month','year',
		'and','or','but','at','in','on','to','from','is','a','an','am','for','of','the');
	$splitstr = @explode(" ", truncate_string(seo_simple_strip_tags(str_replace(array(",",".")," ", $str)), $length));
	$new_splitstr = array();
	foreach ($splitstr as $spstr) {
		if (strlen($spstr) > 2 && !(in_array(strtolower($spstr), $new_splitstr)) && !(in_array(strtolower($spstr), $exclude))) {
			$new_splitstr[] = strtolower($spstr);
		}
	}
	return @implode(", ", $new_splitstr);
}

function seo_simple_strip_tags($str)
// Simple Strip HTML Tags function for seo functions above.
{
	$untagged = "";
	$skippingtag = false;
	for ($i = 0; $i < strlen($str); $i++) {
		if (!$skippingtag) {
			if ($str[$i] == "<") {
				$skippingtag = true;
			} else {
				if ($str[$i]==" " || $str[$i]=="\n" || $str[$i]=="\r" || $str[$i]=="\t") {
					$untagged .= " ";
				} else {
					$untagged .= $str[$i];
				}
			}
		} else {
			if ($str[$i] == ">") {
				$untagged .= " ";
				$skippingtag = false;
			}
		}
	}
	$untagged = preg_replace("/[\n\r\t\s ]+/i", " ", $untagged); // remove multiple spaces, returns, tabs, etc.
	if (substr($untagged,-1) == ' ') { $untagged = substr($untagged,0,strlen($untagged)-1); } // remove space from end of string
	if (substr($untagged,0,1) == ' ') { $untagged = substr($untagged,1,strlen($untagged)-1); } // remove space from start of string
	if (substr($untagged,0,12) == 'DESCRIPTION ') { $untagged = substr($untagged,12,strlen($untagged)-1); } // remove 'DESCRIPTION ' from start of string
	return $untagged;
}

// This function will truncate a string to a specified length.
function truncate_string($string, $length = 70)
{
  if (strlen($string) > $length) {
	$split = preg_split("/\n/", wordwrap($string, $length));
	return ($split[0]);
  }
  return ($string);
}
?>