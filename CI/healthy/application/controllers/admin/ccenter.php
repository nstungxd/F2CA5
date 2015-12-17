<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include("www/include/global.php");
$data['baseDir'] = $baseDir;
$data['cpp'] = $cpp;
$data['menuindex'] = 4;

/*
|--------------------------------------------------------------------------
| Customer controller for Inzone Management Sites
|--------------------------------------------------------------------------
|
| Description
|
*/
class ccenter extends MY_Controller {

function __construct()
{
	parent::__construct();
	// if(!$this->auth->isLoggedIn())
 //        show_404();
}
/*
|--------------------------------------------------------------------------
| Rendering functions to VIEW
|--------------------------------------------------------------------------
| 
|
*/
public function index()
{
	$this->register();
}

public function register()
{
	global $data;
	global $TABLE;
    $this->load->model("workout");
    
	$data['page'] = $this->get_post('page', 0);
	$data['menuindex'] = array(3, 1);
    $data['workouts'] = $this->workout->all();

	$this->load->admin_view("center_register", $data);
}

public function lists()
{
	global $data;
	global $TABLE;

	$data["page"] = $this->get_post("page", 0);
	$data['menuindex'] = array(3, 2);

	$this->load->admin_view("center", $data);
}

public function centermodify()
{
	global $data;
	global $TABLE;
    $this->load->model("workout");

	$data['menuindex'] = array(3, 1);

	$this->load->model("center");
	$seq = $this->get_post("seq");
	$data['center'] = $this->center->get($seq);
	$data['page'] = $this->get_post('page', 0);
    $data['workouts'] = $this->workout->all();


	$this->load->admin_view("center_register", $data);
}

public function details()
{
	// global $data;
	// global $TABLE;

	// $seq = $this->get_post('seq', 0);
	// $data['regions'] = $this->dbop->all($TABLE["regions"]);

	// $sql = sprintf('
	// 	SELECT
	// 		A.*,
	// 		B.name AS regionname
	// 	FROM
	// 		%s AS A
	// 	LEFT JOIN
	// 		%s AS B
	// 	ON A.region_id=B.id
	// 	WHERE A.id=\'%s\'',
	// 	$TABLE['shops'],
	// 	$TABLE['regions'],
	// 	$shopidx);
	// $data['shop'] = $this->dbop->row($sql);
	// $data['shopphotos'] = $this->dbop->get_where($TABLE["shop_photos"], array("shop_id"=>$shopidx));
	// $data['index'] = 1;

	// $this->load->admin_view("center_details", $data);	
}
/*
|--------------------------------------------------------------------------
| Modelling functions
|--------------------------------------------------------------------------
| 
|
*/
public function search_center()
{
	global $data;
	global $TABLE;
	
	$page = $this->input->post('page');
	$keyvalue = $this->input->post('keyvalue', "");
	
	// Make SQL
	$where = '1';
	if ($keyvalue != "")
		$where = $where . ' AND (CenterNm LIKE \'%' . $keyvalue . '%\')';

	$sql = sprintf('
		SELECT
			A.*,B.Name as WorkoutName
		FROM
			%s as A
		LEFT JOIN %s as B on B.Seq = A.WorkoutSeq
		WHERE %s
		ORDER BY
			A.CenterCode, A.Seq',
		$TABLE['center'],
        $TABLE['workout'],
		$where);

	// Get results
	$results = $this->dbop->execSQL($sql);

	// Page Count
	$tcount = count($results);

	$tpage = floor(($tcount + $data['cpp'] - 1) / $data['cpp']) - 1;
	$stind = $page*$data['cpp'];
	$enind = min($tcount, ($page+1)*$data['cpp']);
	
	// Parsing
	$resarr = array();
	for ($i=$stind; $i<$enind; $i++)
	{
		$resarr[] = array('idx' => $i+1, 'data' => $results[$i]);
	}

	// Output
	$data['totalpage'] = $tpage;
	$data['page'] = $page;
	$data['results'] = $resarr;

	$html[] = $this->load->view('items/list_center', $data, true);
	$html[] = pagination($tpage, $page, 'onSelectPage');
	$html[] = $tcount;
	echo implode('|||', $html);
}

function register_center()
{
	global $data;
	global $TABLE;
			
	// Set validation rules
	$this->form_validation->set_rules('centercode', 'Center Code', 'required');
	$this->form_validation->set_rules('centername', 'Center Name', 'required');
    $this->form_validation->set_rules('workout', 'workout', 'required');
	
	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("center_register", $data);
	}
	// If validation is successed
	else
	{
		try {
			$loc = upload_center("logophoto");
			$locurl = "";
			if (!is_null($loc)) {
				$locurl = '/www/upload/center/'.$loc['file_name'];
			}

			$seq = $this->dbop->insert($TABLE['center'], array(
					"CenterCode" => $this->post("centercode", ""),
					"CenterNm" => $this->post("centername", ""),
					"Adress" => $this->post("addr", ""),
					"WebSite" => $this->post("website", ""),
                    "WorkoutSeq" => $this->post("workout", ""),
					"OpenDT" => now(),
					"Logo" => $locurl,
					"UserID" => $this->post("userid", ""),
					"UserPW" => $this->post("userpwd", "")
				));

			$this->dbop->insert($TABLE['admin'], array(
					"AdminID" => $this->post("userid", ""),
					"AdminPW" => $this->post("userpwd", ""),
					"Permission" => "1",
					"CenterCode" => $this->post("centercode", ""),
					"AdminSeq" => $seq
				));

			gopage("admin/ccenter/lists?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

function gen_centercode()
{
	global $TABLE;
	$c = $this->dbop->countall($TABLE['center'])+1;
	echo "E".sprintf("%07d", $c);
}

function check_centercode()
{
	$centercode = $this->get_post("centercode", "");

	global $TABLE;
	$sp = $this->dbop->get_where($TABLE['center'], array("CenterCode" => $centercode));
	if (count($sp) > 0) echo "This center code is already registered.";
	else echo "";
}

function delete_center()
{
	global $data;
	global $TABLE;
    $this->load->model("center");


	$seq = $this->input->post('seq');
    $center = $this->center->get($seq);

    if ($this->dbop->count($TABLE['user'], array('CenterCode' => $center->CenterCode)) > 0)
    {
        echo "Center have exist member. Delete failed";
    }
    else if ($this->dbop->count($TABLE['workoutas'], array('CenterSeq' => $seq)) > 0)
    {
        echo "Group have been assigned workout. Delete failed";
    }
    else $this->dbop->delete($TABLE['center'], array("Seq" => $seq));
}

function modify_center()
{
	global $data;
	global $TABLE;
	
	$seq = $this->get_post("seq", -1);

	// Set validation rules
	$this->form_validation->set_rules('centercode', 'Center Code', 'required');
	$this->form_validation->set_rules('centername', 'Center Name', 'required');
    $this->form_validation->set_rules('workout', 'workout', 'required');
	
	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("center_register", $data);
	}
	// If validation is successed
	else
	{
		try {
			$this->dbop->update($TABLE['center'], array(
					"CenterCode" => $this->post("centercode", ""),
					"CenterNm" => $this->post("centername", ""),
					"Adress" => $this->post("addr", ""),
					"WebSite" => $this->post("website", ""),
                    "WorkoutSeq" => $this->post("workout", ""),
					"OpenDT" => now(),
					"UserID" => $this->post("userid", ""),
					"UserPW" => $this->post("userpwd", "")
				), array("Seq"=>$seq));

			$this->dbop->update($TABLE['admin'], array(
					"AdminID" => $this->post("userid", ""),
					"AdminPW" => $this->post("userpwd", ""),
					"Permission" => "1",
					"CenterCode" => $this->post("centercode", "")
				), array("AdminSeq"=>$seq, "Permission"=>"1"));

			if ($this->post("ischnimg", "0") == "1") {
				$loc = upload_center("logophoto");
				$locurl = "";
				if (!is_null($loc)) {
					$locurl = '/www/upload/center/'.$loc['file_name'];

					$this->dbop->update($TABLE['center'], array(
						"Logo" => $locurl
					), array("Seq"=>$seq));
				}
			}

			gopage("admin/ccenter/lists?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

function modify_notice()
{
	global $data;
	global $TABLE;
	
	$noticeid = $this->input->get_post("noticeid");
	$page = $this->input->get_post("page");

	try {
		$this->dbop->update($TABLE['notice'], array(
				"region_id" => $this->input->post("region"),
				"title" => $this->input->post("title"),
				"message" => $this->input->post("message")
			), array("id"=>$noticeid));
		gopage("admin/community?page=".$page);
	}
	catch (Exception $e) {}
}


}
?>