<?php  
/*
 * @package  xmlparser
---------------------------------------------------------------------------------
 * Description:
   Parse xml file and make it struct in xml
---------------------------------------------------------------------------------
 **/
class xmlparser
{
	function xml2php($xmlcontent)
	{
	  $xml_parser = xml_parser_create();
	  xml_parse_into_struct($xml_parser, $xmlcontent, $arr_vals);
	  xml_parser_free($xml_parser);
	  return $arr_vals;
	}

	function php2xml($array_haystack)
	{
		ob_clean();
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
/*      $xml = "<?xml version=\"2.0\" encoding=\"UTF-8\"?>\n"; */
		if ((!empty($array_haystack)) AND (is_array($array_haystack)))
		{
			foreach ($array_haystack as $xml_key => $xml_value)
			{
				switch ($xml_value["type"])
				{
					case "open":
						$xml .= str_repeat("\t", $xml_value["level"] - 1);
						$xml .= "<" . strtolower($xml_value["tag"]);
						$xml .= (!isset($xml_value["attributes"]))? ">\n": false;
					break;
					case "complete":
						$xml .= str_repeat("\t", $xml_value["level"] - 1);
						$xml .= "<" . strtolower($xml_value["tag"]);
						if(!isset($xml_value["attributes"]))
						{
							$xml .= ">";
							$xml .= $xml_value["value"];
							$xml .= "</" . strtolower($xml_value["tag"]);
							$xml .= ">\n";
						}
					break;
					case "close":
						$xml .= str_repeat("\t", $xml_value["level"] - 1);
						$xml .= "</" . strtolower($xml_value["tag"]);
						$xml .= (!isset($xml_value["attributes"]))? ">\n": false;
					break;
					default:
					break;
				}
				if (isset($xml_value["attributes"]))
				{
					foreach ($xml_value["attributes"] as $atribute_key => $atribute_value)
					{
						$xml .= sprintf(' %s="%s"', strtolower($atribute_key), $atribute_value);
					}
					if($xml_value["type"] == "complete")
					{
						$xml .= ">";
						$xml .= strtolower($xml_value["value"]);
						$xml .= "</" . strtolower($xml_value["tag"]);
						$xml .= ">\n";
					}
				}
		}
	}
	return $xml;
	}

	/**
	 * Output content as XML
	 *
	 * @param string $content
	 */
	function output_xml($content)
	{
	    ob_clean();
        header("Content-Type: application/xml; charset=UTF-8");
        //header("Content-Type: application/xml; charset=ISO-8859-1");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: ". gmdate("D, d M Y H:i:s") ." GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		print $content;
	}
}
?>