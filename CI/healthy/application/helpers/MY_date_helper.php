<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * Redeclare the default helper of CodeIgniter
 *
 * @package		CodeIgniter
 * @author		***
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * File Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		***
 */

// ------------------------------------------------------------------------
if (!function_exists('datetime'))
{	
	function datetime($datetime)
	{
		return date("Y-m-d H:i:s", $datetime);
	}
}

// ------------------------------------------------------------------------
if (!function_exists('now'))
{
	function now()
	{
		return date("Y-m-d H:i:s");
	}
}

// ------------------------------------------------------------------------
if (!function_exists('today'))
{
	function today()
	{
		return date("Y-m-d");
	}
}

// ------------------------------------------------------------------------
if (!function_exists('nowyear'))
{
	function nowyear()
	{
		return date("Y");
	}
}

// ------------------------------------------------------------------------
if (!function_exists('nowmonth'))
{
	function nowmonth()
	{
		return date("n");
	}
}

// ------------------------------------------------------------------------
if (!function_exists('nowtime'))
{
	function nowtime()
	{
		return date("H:i:s");
	}
}

// ------------------------------------------------------------------------
if (!function_exists('todaystart'))
{
	function todaystart()
	{
		return date("Y-m-d 00:00:00");
	}
}

// ------------------------------------------------------------------------
if (!function_exists('todayend'))
{
	function todayend()
	{
		return date("Y-m-d 23:59:59");
	}
}

// ------------------------------------------------------------------------
if (!function_exists('daybefore'))
{
	function daybefore($d)
	{
		return date("Y-m-d", time()-$d*24*60*60);
	}
}

// ------------------------------------------------------------------------
if (!function_exists('dayafter'))
{
	function dayafter($d)
	{
		return date("Y-m-d", time()+$d*24*60*60);
	}
}

// ------------------------------------------------------------------------
if (!function_exists('daystart'))
{
	function daystart()
	{
		return date("Y-m-d", 0);
	}
}

// ------------------------------------------------------------------------
if (!function_exists('todate'))
{
	function todate($date)
	{
		return date("Y.m.d", strtotime($date));
	}
}

// ------------------------------------------------------------------------
if (!function_exists('tobegintime'))
{
	function tobegintime($date)
	{
		return todate($date)." 00:00:00";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('toendtime'))
{
	function toendtime($date)
	{
		return todate($date)." 23:59:59";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('year'))
{
	function year($date)
	{
		return date("Y", strtotime($date));
	}
}

// ------------------------------------------------------------------------
if (!function_exists('monthbefore'))
{
	function monthbefore($m)
	{
		$str = "-".$m." month";
		return date('Y-m-1', strtotime($str));
	}
}

// ------------------------------------------------------------------------
if (!function_exists('reserve_matchdate'))
{
	function reserve_matchdate()
	{
		// 오늘의 매칭시간 - 10시 기준
		// 10시 이전이면 당일 10시로.., 10시 이후이면 다음날 10시로
		$nb10 = time() - 10*60*60 + 24*60*60;
		return date("Y-m-d", $nb10)." 10:00:00";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('reserve_date'))
{
	function reserve_date($date)
	{
		// $date를 기준으로 한 매칭시간
		// $date가 10시 이전이면 $date날자의 10시, 10시 이후이면 $date다음날 10시
		$nb10 = strtotime($date) - 10*60*60 + 24*60*60;
		return date("Y-m-d", $nb10)." 10:00:00";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('real_matchdate'))
{
	function real_matchdate()
	{
		// 오늘의 매칭시간 - 10시 기준
		$nb10 = time() - 10*60*60;
		return date("Y-m-d", $nb10)." 10:00:00";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('reserve_matchdate_manual'))
{
	function reserve_matchdate_manual()
	{
		// 수동매칭시 매칭날자설정
		// 10시 이전이면 전날 10시로.., 10시 이후이면 당일 10시로
		$nb10 = time() - 10*60*60;
		return date("Y-m-d", $nb10)." 10:00:00";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('dateAtime'))
{
	function dateAtime($date, $time)
	{
		return $date." ".$time;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('date_custom1'))
{
	function date_custom1($date)
	{
		$datetime = strtotime($date);
		$str = date('m.d|A|H:i', $datetime);
		$date = explode("|", $str);
		$hour = date("H", $datetime);
		if ($hour < 12) $date[1] = "오전";
		else $date[1] = "오후";
		$str = implode($date, " ");
		return $str;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('month'))
{
	function month($date)
	{
		return date("Y-m", strtotime($date));
	}
}

// ------------------------------------------------------------------------
if (!function_exists('monthstart'))
{
	function monthstart($date)
	{
		return date('Y-m-1', strtotime($date));
	}
}

// ------------------------------------------------------------------------
if (!function_exists('monthend'))
{
	function monthend($date)
	{
		return date("Y-m-t", strtotime($date));
	}
}

// ------------------------------------------------------------------------
if (!function_exists('monthbefore2'))
{
	function monthbefore2($m, $date)
	{
		$str = "-".$m." month";
		return date('Y-m', strtotime($str, strtotime($date)));
	}
}

// ------------------------------------------------------------------------
/* End of file date_helper.php */
/* Location: ./system/helpers/date_helper.php */
?>