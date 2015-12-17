<?php
//define here datetime formate functions
function DateTime($text,$format='')
{
	if($text =="" || $text =="0000-00-00 00:00:00")
		return "---";

	switch($format)
	{
		case "0":
			return date('d M, Y',strtotime($text));
			break;
		//us formate
		case "1":
			return date('M j, Y',strtotime($text));
			break;

		case "2":
			return date('M j, y  [G:i] ',strtotime($text));
			break;

		case "3":
			return date("M j, Y", strtotime($text));
			break;

		case "4":
			return date('Y,n,j,G,',$text).intval(date('i',$text)).','.intval(date('s',$text));
			break;

		case "5":
			return date('l, F j, Y',$text);
			break;

		case "6":
			return date('g:i:s',$text);
			break;

		case "7":
			return date('D, F j, Y  h:i A',strtotime($text));	// Thu, March 26, 2010 08:34 PM
			break;

		case "8":
					/*$dateval = @explode('/',$text);
					//$text = $dateval[0]."/".$dateval[1]."/".$dateval[2];
					if($_SESSION['SESSION_DATE'] == 'mm/dd/yy')
					{
						$text = $dateval[2]."-".$dateval[0]."-".$dateval[1];
					}
					else
					{
						$text = $dateval[2]."-".$dateval[1]."-".$dateval[0];
					}*/
					//echo  date('Y-m-d',strtotime($text));exit;
			return date('Y-m-d',strtotime($text));
			break;
		case "9":
			return date('F j, Y',strtotime($text));
			break;
		case "10":
			if($text == '0000-00-00') {
				return '---';
			} else {
				return date('d/m/y',strtotime($text));
			}
			break;
		case "11":
			return date('m/d/y',strtotime($text));
			break;
		case "12":
			return date('H:i',strtotime($text));
			break;
            case "13":
                     return date('l j, F Y',strtotime($text));
                     break;
            case "14":
                     return date("j M, Y", strtotime($text));
                     break;
            case "15":
                     return date('h:i a',strtotime($text));
                     break;
            case "16":
			return date('Y-m-d H:i:s',strtotime($text));
			break;
            default :
			return date('d/m/Y',strtotime($text));
			break;
	}
}

//Function Used in Login History
function Time_Format($text)
{
	if($text =="" || $text =="0000-00-00 00:00:00")
		return "---";
	else
		return date('M j, y [G:i]',strtotime($text));
}
function getNextDate($addmonth,$fromdate,$extdays="")
{
	$frmdate=strtotime($fromdate);
	$day=Date("d",$frmdate);
	$month=Date("m",$frmdate);
	$year=Date("Y",$frmdate);
	if($extdays != '')
		$adddays = $extdays;
	$nextmonth = mktime(0, 0, 0,$month+$addmonth,$day+$adddays,$year);
	$date3=date("Y-m-d",$nextmonth);
	return $date3;
}

function getInboxDate($date) {
   $date_date = date('Y-m-d',strtotime($date));
   $date_time = date('h:i:s a',strtotime($date));
   $today = date('Y-m-d');
   //echo $today."==>".$date_date;
   if($today == $date_date){
      $retdate =$date_time;
   }else{
      $retdate =DateTime($date,2);
   }
   return $retdate;
}

function getTzOffset()
{
	global $DEFAULT_TIME;
	if($DEFAULT_TIME!='' && $DEFAULT_TIME!='UTC')
	{
		// @ date_default_timezone_set("$DEFAULT_TIME");
		// @ date_default_timezone_set('UTC');
		// echo date_default_timezone_get();
		$gdate = gmdate('Y-m-d H:i:s');
		if(trim($DEFAULT_TIME)!='') {
			@ date_default_timezone_set("$DEFAULT_TIME");
		}
		$ldate = date('Y-m-d H:i:s');
		return strtotime($gdate) - strtotime($ldate); 	// = $tzo
	}
	// echo strtotime($gdate) - strtotime($ldate);
	// echo date('Y-m-d H:i:s',strtotime($date));
	return 0;
}

function calcGTzTime($ldate, $format='Y-m-d H:i:s')
{
	return gmdate($format, strtotime($ldate));
	if(trim($ldate)!='' && strpos($ldate,'0000-00-00')===false) {
		$tzo = getTzOffset();
		return date($format, strtotime($ldate) + $tzo);
	}
	return $ldate;
}

function calcLTzTime($gdate, $format='Y-m-d H:i:s')
{
	if(trim($gdate)!='' && strpos($gdate,'0000-00-00')===false) {
		$tzo = getTzOffset();
		return date($format, strtotime($gdate) - $tzo);
	}
	return $gdate;
}

function calcGTzTimeFmo($ldate, $format='Y-m-d H:i:s', $mofst) 	// by min offset
{
	if(trim($ldate)!='' && strpos($ldate,'0000-00-00')===false && trim($mofst)!='') {
		return date($format, strtotime($ldate . " +$mofst minutes"));
	}
	return $ldate;
}

function calcLTzTimeFmo($gdate, $format='Y-m-d H:i:s',$mofst) 	// by min offset
{
	if(trim($gdate)!='' && strpos($gdate,'0000-00-00')===false && trim($mofst)!='') {
		return date($format, strtotime($gdate . " -$mofst minutes"));
	}
	return $gdate;
}

function mintouts($min)
{
	$uts['hr'] = (int) (-$min/60);
	$uts['min'] = $min%60;
	$nuts = mktime($uts['hr'], $uts['min']);
	return $nuts;
}
?>