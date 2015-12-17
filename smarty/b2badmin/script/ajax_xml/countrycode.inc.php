<?php
//prints($_GET);exit;
$val = GetVar('val');

if(!isset($countryObj)) {
    include_once(SITE_CLASS_APPLICATION."class.Country.php");
    $countryObj =	new Country();
}

if($val != '') {
   $where = "AND BINARY vCountryCode LIKE '$val'";
   $arr = $countryObj->getCountryDetail("iCountryISD as code",$where);
   // prints($arr);exit;
   $arr[0]['iCountryISD'] = (isset($arr[0]['iCountryISD']))? $arr[0]['iCountryISD'] : '';
   $code = (isset($arr[0]['code']))? $arr[0]['code'] : $arr[0]['iCountryISD'];
} else {
   $code = '';
}

echo "$code";
//exit;
?>
