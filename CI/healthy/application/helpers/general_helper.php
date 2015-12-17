<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * 
 *
 * @package		CodeIgniter
 * @author		***
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Global Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		***
 */

/**
 * @desc        General Helper.
 * @author      Zhongge Han for Second Opinion
 * @copyright   2014
 * @version     1.0
 */
 
 // ------------------------------------------------------------------------
// Get SQL Result
function get_sql_result($sql)
{
    $CI =& get_instance(); 
	$query = $CI->db->query($sql);
	return $query->result();
}

// ------------------------------------------------------------------------
function get_sql_query($sql)
{
    $CI =& get_instance(); 
	$query = $CI->db->query($sql);
}

// ------------------------------------------------------------------------
function get_sql_value($sql)
{
    $CI =& get_instance(); 
	$query = $CI->db->query($sql);
	$result =  $query->result();
	if(count($result) <= 0) return false;
	return $result[0];
}

// ------------------------------------------------------------------------
function json_capsule($arr)
{
	//$data = json_encode($arr);
	$data = json_encode($arr, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	$json_result = "{\"result\":[";
	$json_result .= $data;
	$json_result .= "]}";
	//tolog($json_result);
	
	return $json_result;
}

// ------------------------------------------------------------------------
function cut_str($str, $l = null, $s = 0) {
	$len = strlen(utf8_decode($str));
	$temp = uc_substr($str, $s, $l);
	// 한두개 문자가 잘리우면 그대로 출력한다.
	if ($len < strlen(utf8_decode($temp)) + 2) return $str;
	// 3개 이상의 문자가 잘리우면 잘라서 출력한다.
	return $temp. "...";
}

// ------------------------------------------------------------------------
function uc_substr($str, $s, $l = null) {
	return join("", array_slice(
		preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $s, $l));
}

// ------------------------------------------------------------------------
function is_login()
{
	if(!isset($_SESSION['USERSESS']) || $_SESSION['USERSESS']['user_id'] == "")
		return false;
	return true;
}

// ------------------------------------------------------------------------
function get_localtime($date)
{
	//$time_str = substr($date, 11, 5);
	$time_str = date("h:i a", strtotime($date));
	return $time_str;
}

// ------------------------------------------------------------------------
if (!function_exists('tolog'))
{
	function tolog($data)
	{		
		$data = "[STOCK][IP:".$_SERVER['REMOTE_ADDR']."]".$data;
		log_message('error', $data);
	}
}

// ------------------------------------------------------------------------
if (!function_exists('json_capsule'))
{
	// JSON CAPSULE
	function json_capsule($data)
	{
		$json_result = "{\"result\":[";
		$json_result .= json_encode($data);
		$json_result .= "]}";
		tolog($json_result);
		
		return $json_result;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('encpassword'))
{
	function encpassword($p)
	{		
		return md5($p);
	}
}
// ------------------------------------------------------------------------
if (!function_exists('gopage'))
{
	function gopage($url)
	{
//		$url = "/healthy/".$url;
		$url = "/".$url;
		echo "<script>document.location.href = '".$url."'; </script>";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('v2k_shop_state'))
{
	function v2k_shop_state($v)
	{
		if ($v == "on") return "가맹점";
		else if ($v == "off") return "해지";
		return "";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('upload_center'))
{
	function upload_center($up)
	{
		try {
			/* Target PATH */
			$path = '/www/upload/center';
//		$target_path = $_SERVER["DOCUMENT_ROOT"]."/healthy".$path;
			$target_path = $_SERVER["DOCUMENT_ROOT"].$path;
			if (!is_dir($target_path))
			{
				mkdir($target_path, 0777);
			}

			// Configuration of FILE UPLOAD 
			$config['upload_path'] = '.'.$path;
			$config['encrypt_name'] = true;
			$config['allowed_types'] = 'gif|jpg|png|bmp';
			$config['max_size']	= '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';

			$ci = &get_instance();
			$ci->load->library('upload', $config);

			if ($ci->upload->do_upload($up))
			{
				/* Insert photo */
				return $ci->upload->data();
			}
		}
		catch (Exception $e) {}
		return null;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('upload_goods'))
{
	function upload_goods($up)
	{
		try {
			/* Target PATH */
			$path = '/www/upload/shop';
			$target_path = $_SERVER["DOCUMENT_ROOT"]."/stock".$path;
			if (!is_dir($target_path))
			{
				mkdir($target_path, 0777);
			}

			// Configuration of FILE UPLOAD 
			$config['upload_path'] = '.'.$path;
			$config['encrypt_name'] = true;
			$config['allowed_types'] = '*';
			$config['max_size']	= '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';

			$ci = &get_instance();
			$ci->load->library('upload', $config);

			if ($ci->upload->do_upload($up))
			{
				/* Insert photo */
				return $ci->upload->data();
			}
		}
		catch (Exception $e) {}
		return null;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('loadExcel'))
{
	function loadExcel($fname)
	{
		try {
			require_once '/www/plugins/PHPExcel.php';
			require_once '/www/plugins/PHPExcel/IOFactory.php';

			$objPHPExcel = PHPExcel_IOFactory::load($fname);

			$sheets = array();
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			    $worksheetTitle     = $worksheet->getTitle();
			    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
			    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			    $nrColumns = ord($highestColumn) - 64;

			    $data = array();
			    for ($row = 1; $row <= $highestRow; ++ $row) {
			    	$record = array();
			        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
			            $cell = $worksheet->getCellByColumnAndRow($col, $row);
			            $val = $cell->getValue();
			            $record[] = $val;
			            // $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
			        }
			        $data[] = $record;
			    }

			    $sheets[] = array("title"=>$worksheetTitle, "row"=>$highestRow, "col"=>$highestColumnIndex, "data"=>$data);
			}
			return $sheets;
		}
		catch (Exception $e) {tolog($e->getMessage());}
		return null;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('calcHealthGrade'))
{
	function calcHealthGrade($grade1, $grade2, $grade3, $grade4, $grade5, $grade6, $grade7, $grade8, $grade9)
	{
		$health = 0;

		// 물섭취량
		if ($grade1 == "0") $health += 50;
		else $health += 100;

		// 아침
		if ($grade2 == "0") $health += 70;	// 소식
		else if ($grade2 == "1") $health += 100;	// 보통
		else if ($grade2 == "2") $health += 90;	// 과식
		else if ($grade2 == "3") $health += 80;	// 결식

		// 점심
		if ($grade3 == "0") $health += 70;	// 소식
		else if ($grade3 == "1") $health += 100;	// 보통
		else if ($grade3 == "2") $health += 90;	// 과식
		else if ($grade3 == "3") $health += 80;	// 결식

		// 저녁
		if ($grade4 == "0") $health += 70;	// 소식
		else if ($grade4 == "1") $health += 100;	// 보통
		else if ($grade4 == "2") $health += 90;	// 과식
		else if ($grade4 == "3") $health += 80;	// 결식

		// 간식
		if ($grade5 == "0") $health += 70;	// 먹지 않음
		else $health += 100;	// 먹음

		// 음주
		if ($grade6 == "0") $health += 100;	// 0병
		else if ($grade6 == "1") $health += 90;	// 1/2병
		else if ($grade6 == "2") $health += 70;	// 1병이상

		// 흡연
		if ($grade7 == "0") $health += 100;	// 0갑
		else if ($grade7 == "1") $health += 90;	// 1/2갑
		else if ($grade7 == "2") $health += 70;	// 1갑이상

		// 수면
		if ($grade8 <= 7) $health += 80;	// 7시간 이하
		else if ($grade8 == 8) $health += 100;	// 8시간
		else if ($grade8 > 8) $health += 90;	// 8시간 이상

		// 운동
		if ($grade9 <= "0") $health += 80;	// 운동미실시
		else $health += 100;	// 운동실시

		$health = round($health / 9);

		return $health;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('v2k_extype'))
{
	function v2k_extype($v)
	{
		if ($v == 1) return "Running";
		else if ($v == 2) return "Bike";
		else if ($v == 3) return "Weight";

		return "--";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('v2k_excode'))
{
	function v2k_excode($v)
	{
		if ($v != null) return $v;
		// if ($v == 1) return "Abdominal";
		// else if ($v == 2) return "Chest";
		// else if ($v == 3) return "Arm";
		// else if ($v == 4) return "Leg";
		// else if ($v == 5) return "Shoulder";

		return "--";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('v2k_gender'))
{
	function v2k_gender($v)
	{
		if ($v == "1") return "Male";
		else return "Female";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('perm_is_admin'))
{
	function perm_is_admin($v)
	{
		if ($v == "ADMIN") return true;
		else return false;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('perm_is_center'))
{
	function perm_is_center($v)
	{
		if ($v == "CENTER") return true;
		else return false;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('perm_is_trainer'))
{
	function perm_is_trainer($v)
	{
		if ($v == "TRAINER") return true;
		else return false;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('perm_above_center'))
{
	function perm_above_center($v)
	{
		if (perm_is_admin($v) || perm_is_center($v)) return true;
		else return false;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('perm_above_trainer'))
{
	function perm_above_trainer($v)
	{
		if (perm_is_admin($v) || perm_is_center($v) || perm_is_trainer($v)) return true;
		else return false;
	}
}

// ------------------------------------------------------------------------
if (!function_exists('v2k_ex_pro1'))
{
	function v2k_ex_pro1($v)
	{
		if ($v=="1") return "Min";
		else if ($v=="2") return "Min";
		else if ($v=="3") return "Set";
		return "Pro1";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('v2k_ex_pro2'))
{
	function v2k_ex_pro2($v)
	{
		if ($v=="1") return "kcal";
		else if ($v=="2") return "kcal";
		else if ($v=="3") return "time";
		return "Pro2";
	}
}

// ------------------------------------------------------------------------
if (!function_exists('v2k_ex_pro3'))
{
	function v2k_ex_pro3($v)
	{
		if ($v=="1") return "km/h";
		else if ($v=="2") return "Watt";
		else if ($v=="3") return "kg";
		return "Pro3";
	}
}
// ------------------------------------------------------------------------

/* End of file global_helper.php */
/* Location: ./system/helpers/global_helper.php */