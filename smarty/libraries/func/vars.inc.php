<?php

/**
 * This is vars general file, PostVar,GetVar,SessionVar etc..
 *
 * @package		vars.inc.php
 * @func		  general
 * @author		andrew07_dev@hotmail.com
 */

/**
 * Get the posted variable with no magic quotes in the values.
 * @param	$name	Name of posted field
 * @returns	Value of specified posted field.
 */
function PostVar($name, $default_value = false) {
    if (!isset($_POST)) {
        return false;
    }
    if (isset($_POST[$name])) {
        if (!get_magic_quotes_gpc()) {
            return InjectSlashes($_POST[$name]);
        }
        return $_POST[$name];
    }
    return $default_value;
}

/**
 * Get the File variable with no magic quotes in the values.
 * @param	$name	Name of posted field
 * @returns	Value of specified filevar field.
 */
function FileVar($name, $default_value = false) {
    if (!isset($_FILES))
        return false;
    if (isset($_FILES[$name]['name'])) {
        if (!get_magic_quotes_gpc())
            return InjectSlashes($_FILES[$name]['name']);
        return $_FILES[$name]['name'];
    }
    return $default_value;
}

/**
 * Get the posted variable with no magic quotes in the values.
 * @param	$name	Name of posted field
 * @returns	Value of specified get field.
 */
function GetVar($name, $default_value = false) {
    if (!isset($_GET)) {
        return false;
    }
    if (isset($_GET[$name])) {
        if (!get_magic_quotes_gpc()) {
            return InjectSlashes($_GET[$name]);
        }
        return $_GET[$name];
    }
    return $default_value;
}

/**
 * Not recommended but available, Request variable is either a GET, POST or COOKIE value
 * @param	$name	Name of posted field
 * @returns	Value of specified request field.
 */
function RequestVar($name, $default_value = true) {
    if (!isset($_REQUEST))
        return false;
    if (isset($_REQUEST[$name])) {
        if (!get_magic_quotes_gpc())
            return InjectSlashes($_REQUEST[$name]);
        return $_REQUEST[$name];
    }
    return $default_value;
}

/**
 * cookie variable with no magic quotes in the values.
 * @param	$name	Name of posted field
 * @returns	Value of specified cookie field.
 */
function CookieVar($name, $default_value = true) {
    if (!isset($_COOKIE))
        return $default_value;

    if (isset($_COOKIE[$name])) {
        if (!get_magic_quotes_gpc())
            return InjectSlashes($_COOKIE[$name]);
        return $_COOKIE[$name];
    }
    return $default_value;
}

/**
 * SessionVar variable with no magic quotes in the values.
 * @param	$name	Name of posted field
 * @returns	Value of specified session var
 */
function SessionVar($name, $default_value = false) {
    if (!isset($_SESSION)) {
        return $default_value;
    } else if (isset($_SESSION[$name])) {
        return $_SESSION[$name];
    }
    return $default_value;
}

/**
 * ServerVar variable
 * @param	$name	Name of posted field
 * @returns	Value of specified server var
 */
function ServerVar($name, $default_value = false) {
    if (isset($_SERVER[$name]))
        return $_SERVER[$name];
    return $default_value;
}

/**
 * Inject Slashes if magicquotes of
 * @returns	Value with addslashes (use when inserting data to db)
 */
function InjectSlashes($value) {
    if (is_array($value)) {
        reset($value);
        while (list($key, $val) = each($value))
            $value[$key] = InjectSlashes($val);
        return $value;
    }
    return addslashes($value);
}

/**
 * EliminateSlashes get_magic_quotes_gpc() == true
 * @returns	Value with eliminate slashesh use when retriving values
 */
function EliminateSlashes($value) {
    if (is_array($value)) {
        reset($value);
        while (list($key, $val) = each($value))
            $value[$key] = EliminateSlashes($val);
        return $value;
    }
    return stripslashes($value);
}

### Replace Special character to '-'

function replace_specialChar($vTitle) {
    $rs_catname = $vTitle;
    $spstr = "�#�#�#�#�#�#�#�#�#�#�#�#�#�#�##�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�";
    $spArr = @explode("#", $spstr);
    $i = 0;
    foreach ($spArr as $arr) {
        $rs_catname = str_replace($arr, "-", $rs_catname);
        $i++;
    }
    //print_r($rs_catname);exit;
    $rs_catname = str_replace("#", "-", $rs_catname);
    $rs_catname = str_replace(" ", "-", str_replace("&", "and", $rs_catname));
    return $rs_catname;
}

## Get Special Character from htmlentities of that character

function ChangeToSpecialChar($vTitle) {
    $rs_catname = $vTitle;
    $spstr = "&iexcl;#&cent;#&pound;#&yen;#&sect;#&uml;#&copy;#&laquo;#&not;#&reg;#&deg;#&plusmn;#&acute;#&micro;#&para;##&middot;#&cedil;#&raquo;#&iquest;#&Agrave;#&Aacute;#&Acirc;#&Atilde;#&Auml;#&Aring;#&AElig;#&Ccedil;#&Egrave;#&Eacute;#&Ecirc;#&Euml;#&Igrave;#&Iacute;#&Icirc;#&Iuml;#&Ntilde;#&Ograve;#&Oacute;#&Ocirc;#&Ouml;#&Oslash;#&Ugrave;#&Uacute;#&Ucirc;#&Uuml;#&szlig;#&agrave;#&aacute;#&atilde;#&acirc;#&atilde;#&auml;#&aring;#&aelig;#&ccedil;#&egrave;#&eacute;#&ecirc;#&euml;#&igrave;#&iacute;#&icirc;#&iuml;#&ntilde;#&ograve;#&oacute;#&ocirc;#&otilde;#&ouml;#&divide;#&oslash;#&ugrave;#&uacute;#&ucirc;#&uuml;#&yuml;#&sbquo;#&fnof;#&bdquo;#&hellip;#&dagger;#&Dagger;#&circ;#&permil;#&lsaquo;#&OElig;#&lsquo;#&lsquo;#&rsquo;#&ldquo;#&rdquo;#&bull;#&ndash;#&mdash;#&tilde;#&trade;#&rsaquo;#&oelig;#&Yuml;";
    $toReplaceStr = "�#�#�#�#�#�#�#�#�#�#�#�#�#�#�##�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�#�";
    $spArr = @explode("#", $spstr);
    $tospArr = @explode("#", $toReplaceStr);

    $i = 0;
    foreach ($spArr as $arr) {
        $rs_catname = str_replace($arr, $tospArr[$i], $rs_catname);
        $i++;
    }
    //print_r($rs_catname);exit;
    //$rs_catname = str_replace(" ","-",str_replace("&","and",$rs_catname));
    return $rs_catname;
}

/**
 * replace given string to another in a string
 * Used on restaurant detail page.
 */
function FrontgetReplace($str, $frlp, $trlp) {
    $reqstr = str_replace($frlp, $trlp, $str);
    return $reqstr;
}

/**
 * Create cache files for Front End Use
 * */
function include_caching($file) {
    $cachefile = SITE_CACHES_FILES . $file;
    $cachetime = 5 * 60; //secondes
    if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
        include($cachefile);
    } else {
        $fp = fopen($cachefile, 'w');
        fwrite($fp, ob_get_contents());
        fclose($fp);
        ob_end_flush();
    }
}

/*   Make Size Format */

function MakeSize($str, $type) {
    $rStr = @explode("x", $str);
    if ($type == 'inch') {
        $reqSize = $rStr[0] . '"' . "x" . $rStr[1] . '"';
    } elseif ($type == 'feet') {
        $reqSize = $rStr[0] . "'" . 'x' . $rStr[1] . "'";
    }
    return $reqSize;
}

/**
 * @Return the Price
 * */
function make_price($price) {
    $price = number_format($price, 2, '.', '');
    return '$' . $price;
}

/**
 * replace given string to another in a string
 * Used on restaurant detail page.
 */
function FrontgetReqRep($str, $relpace) {
    $reqstr = @explode($relpace, $str);
    return $reqstr[0];
}

/**
 * Convert Size on Feet to Inch
 */
function ConvertFeettoInch($size, $sizetype) {
    $vSize = @explode("x", $size);
    if ($sizetype == 'feet') {
        $h = $vSize[0] * 12;
        $w = $vSize[1] * 12;
    } else {
        $h = $vSize[0];
        $w = $vSize[1];
    }
    $reqsize = $h . "x" . $w;
    return $reqsize;
}

function getPOSTGETParam() {
    global $_POST, $_GET;
    #####	Return POST PARAM String
    $tempval = (isset($_POST['tempval'])) ? stripslashes($_POST['tempval']) : '';
    if (isset($_POST['tempval']) && $_POST['tempval'] != "") {
        $tempval = stripslashes($_POST['tempval']);
        $tempval_arr = explode("&", $tempval);
        $tempval = "";
        for ($i = 0; $i < count($tempval_arr); $i++) {
            list($key, $value) = explode("=", $tempval_arr[$i]);
            if ($key != "checkedArr") {
                if ($key == "eStatus" && ($value == 'Active' || $value == 'Inactive' || $value == 'Pending' || $value == 'Approved' || $value == 'Blocked' || $value == 'Suspended' || $value == 'Delete')) {
                    $tempval .="&$key=Showall";
                }
                else
                    $tempval .="&$key=" . stripslashes($value);
            }
        }
    }

    #####	Return GET PARAM String
    foreach ($_GET as $key => $value) {
        if ($key != "PHPSESSID" && $key != "file" && $key != "checkedArr") {
            if ($key == "eStatus" && ($value == 'Active' || $value == 'Inactive' || $value == 'Pending' || $value == 'Approved' || $value == 'Blocked' || $value == 'Suspended' || $value == 'Delete' )) {
                $tempval .="&$key=Search";
            } else {
                if (is_array($value)) {
                    for ($k = 0; $k < count($value); $k++) {
                        $tempval.="&" . $key . "[]=" . $value[$k];
                    }
                }
                else
                    $tempval.="&$key=" . stripslashes($value);
            }
        }
    }
    return $tempval;
}

function repNull($var, $repBy = "-") {
    if ($var == "") {
        $var = $repBy;
    } else {
        $var = $var;
    }
    return $var;
}

function Prints($arr) {
    echo "<pre>";
    print_r($arr);
    echo "<hr>";
}

function pr($arr) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    echo "<br/>";
    echo "<hr/>";
}

function Removenewline($desc, $len) {
    $htmltDesc = strip_tags($desc);
    $htmltDesc = str_replace("<p>", ' ', $htmltDesc);
    $htmltDesc = str_replace("<\/p>", ' ', $htmltDesc);
    //$htmltDesc = strip_tags($htmltDesc);
    //var_dump($htmltDesc);
    //$htmltDesc = str_replace("<",'',$htmltDesc);
    $htmltDesc = html_entity_decode($htmltDesc);
    if (strlen($htmltDesc) > $len) {
        return substr($htmltDesc, 0, $len) . "...";
    } else {
        return substr($htmltDesc, 0, $len);
    }
}

function make_score($score) {
    if ($score != '') {
        $score = number_format($score, 2, '.', '');
    } else {
        $score = '0.00';
    }
    return $score;
}

function joinHttp($url) {
    $getHttp = substr($url, 0, 7);
    if ($getHttp == 'http://') {
        $requrl = $url;
    } else {
        $requrl = "http://" . $url;
    }
    return $requrl;
}

/**
 * DBGeneral::removedimenstionmal()
 * @param 	$arr
 * @return	$newArr
 * @author  cyrus dev
 */
function ReformArr($arr) {
    $new_arr = array();
    $i = 0;
    if ($arr != "") {
        foreach ($arr as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $new_arr[] = $val1;
                $i++;
            }
        }
    }
    return $new_arr;
}

function Recompile($arr) {
    $new_arr = array();
    $i = 0;
    if ($arr != "") {
        foreach ($arr as $key => $val) {
            $new_arr[$i] = $arr[$key];
            $i++;
        }
    }
    return $new_arr;
}

function rearrange_array($arr) {
    if (is_array($arr) && count($arr) > 0) {
        $new_arr = array();
        $stv[] = array();
        foreach ($arr as $k => $v) {
            $stv[] = $k;
        }
        $st = min($stv);
        $ed = max($stv);
        //$ed = (count($arr)+$st);
        for ($l = $st; $l < (count($arr) + $st); $l++) {
            if (isset($arr[$l])) {
                $new_arr[$l] = $arr[$l];
            }
        }
        return $new_arr;
    }
    return $arr;
}

function JoinBreak($text) {
    $text = str_replace(" ", "<br/>", $text);
    return $text;
}

function truncates($text, $limit, $havebr = 'No') {
    $text = substr($text, 0, $limit);
    return $text;
}

/* * *
 * @Return Unique Code
 * @para 	$prefix,$length,$list,$table,$field
 * @return	code
 */

function UniqueID($prefix, $table, $field, $minlength = "4") {
    global $dbobj;
    $sql = "select MAX($field) as ID from $table";
    $db_sql = $dbobj->MySQLSelect($sql);

    if (!$db_sql) {
        $code = "001";
    } else {
        $code = str_replace($prefix, '', $db_sql[0]['ID']);
        $code = $code + 1;
    }

    if (strlen($code) < 3) {
        $code = str_pad($code, $minlength, "0", STR_PAD_LEFT);
    }
    //print_r($code);
    //exit;
    return $prefix . $code;
}

/* * *
 * @Return DATE DIFFERENCE
 * @para 	$date
 * @return	$days
 */

function getDaysCount($date, $count = "") {
    global $dbobj;
    if ($count == "") {
        $count = "prev";
    }
    $days = 0;

    switch ($count) {
        case'next':
            $sql = 'SELECT DATEDIFF("' . $date . '",NOW()) as diff';
            break;
        case'prev':
            $sql = 'SELECT DATEDIFF(NOW(),"' . $date . '") as diff';
            break;
    }
    $db_sql = $dbobj->MySQLSelect($sql);

    $days = $db_sql[0]['diff'];
    if ($days != '') {
        $days = $db_sql[0]['diff'];
    } else {
        $days = 0;
    }
    return $days;
}

/* * *
 * @Return TIME DIFFERENCE in MINUTE
 * @para 	$date
 * @return	$days
 */

function getTimeDif($date) {
    global $dbobj;
    $days = 0;
    $sql = 'SELECT (TIMESTAMPDIFF(MINUTE,"' . $date . '","' . DATE("Y-m-d H:i:s") . '")) as diff';
    $db_sql = $dbobj->MySQLSelect($sql);
    $days = $db_sql[0]['diff'];
    if ($days != '') {
        $days = $db_sql[0]['diff'];
    } else {
        $days = 0;
    }
    //echo  $days;
    return $days;
}

function MakeArray($string, $identifier = ",") {
    $arr = array();
    if ($string != '') {
        $arr = @explode($identifier, $string);
    }
    return $arr;
}

function StringToArray($string, $arr) {
    //Prints($arr);
    if (count($arr) <= 0) {
        $arr = array();
    }
    $CurArr[] = $string;
    $Newarr = array_merge($CurArr, $arr);
    //Prints($Newarr);
    return $Newarr;
}

function formatMoney($number, $fractional = false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    /*$number_exp = explode(".",$number);
    if($number_exp[1] == "00"){
        $number = $number_exp[0];
    }*/    
    
    return $number;
}

function toFixed($no, $ad = '2') {
    $no = sprintf('%.' . $ad . 'f', $no);
    /*$no_exp = explode(".",$no);
    if($no_exp[1] == "00"){
        $no = $no_exp[0];
    }*/
    return $no;
}

function multi21Array($ary, $fld) {
    $rary = array();
    if (is_array($ary) && count($ary) > 0) {
        @ array_walk_recursive($ary, create_function('$val, $key, $obj', 'if($key=="' . $fld . '") { array_push($obj[0], $val); } '), array(0 => &$rary));
    }
    return $rary;
}

function genPswd($length = '10') {
    $list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    // mt_srand((double)microtime()*1000000);
    $newstring = "";
    if ($length > 0) {
        while (strlen($newstring) < $length) {
            $newstring .= $list[mt_rand(0, strlen($list) - 1)];
        }
    }
    $code = $newstring;
    return $code;
}

function popupWindow($ary = array()) {
    if (is_array($ary) && count($ary) > 0) {
        $url = (isset($ary['url'])) ? $ary['url'] : '';
        $name = (isset($ary['name'])) ? $ary['name'] : 'popup';
        $left = (isset($ary['left'])) ? "left=" . $ary['left'] . "," : "left=150,";
        $top = (isset($ary['top'])) ? "top=" . $ary['top'] . "," : "top=150,";
        $height = (isset($ary['height'])) ? "height=" . $ary['height'] . "," : "height=550,";
        $width = (isset($ary['width'])) ? "width=" . $ary['width'] . "," : "width=550,";
        $scrollbars = (isset($ary['scrollbars'])) ? "scrollbars=" . $ary['scrollbars'] . "," : "scrollbars=no,";
        $toolbar = (isset($ary['toolbar'])) ? "toolbar=" . $ary['toolbar'] . "," : "toolbar=no,";
        $resizable = (isset($ary['resizable'])) ? "resizable=" . $ary['resizable'] : "resizable=0";
        if (trim($url) != '') {
            return "window.open ('$url', '$name', '$left $top $height $width $scrollbars $toolbar $resizable');";
        }
        return '';
    }
}

function imageSize($imgfile) {
    $size = @ getimagesize($imgfile);
    if (is_array($size) && count($size) > 0) {
        return array('width' => $size[0], 'height' => $size[1], 'bits' => $size['bits'], 'channels' => $size['channels'], 'mime' => $size['mime']);
    }
    return '';
}

function getIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function http_parse_query($array = NULL, $convention = '%s') {
    if (count($array) == 0) {
        return '';
    } else {
        if (function_exists('http_build_query')) {
            $query = http_build_query($array);
        } else {
            $query = '';
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $new_convention = sprintf($convention, $key) . '[%s]';
                    $query .= http_parse_query($value, $new_convention);
                } else {
                    $key = urlencode($key);
                    $value = urlencode($value);
                    $query .= sprintf($convention, $key) . "=$value&";
                }
            }
        }
        return $query;
    }
}

?>