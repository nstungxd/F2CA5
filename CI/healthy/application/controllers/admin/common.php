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
class common extends MY_Controller {

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
	$this->exercise();
}

public function exercise() 
{
	global $data;
	global $TABLE;

	$this->load->model("center");

	$data["page"] = $this->get_post("page", 0);
	$data['menuindex'] = array(2, 2);

	$this->load->admin_view("exercise", $data);
}

public function exregister()
{
	global $data;
	global $TABLE;

	$this->load->model("exercisetarget");
    $this->load->model("category");

	$data['page'] = $this->get_post('page', 0);
	$data['from'] = $this->get_post('from', "");
	$data['menuindex'] = array(2, 2);
	$data['extarget'] = $this->exercisetarget->all();
    $data['categorys'] = $this->category->all();

	$this->load->admin_view("exercise_register", $data);
}

public function exmodify()
{
	global $data;
	global $TABLE;

	$data['menuindex'] = array(2, 2);

	$this->load->model("exercisetarget");
	$this->load->model("exercise");
    $this->load->model("category");
    
	$seq = $this->get_post('seq');
	$data['exercise'] = $this->exercise->get(array("Seq"=>$seq));
	$data['page'] = $this->get_post('page', 0);
	$data['from'] = $this->get_post('from', "");
	$data['extarget'] = $this->exercisetarget->all();
    $data['categorys'] = $this->category->all();

	$this->load->admin_view("exercise_register", $data);
}

public function food() 
{
	global $data;
	global $TABLE;

	$data["page"] = $this->get_post("page", 0);
	$data['menuindex'] = array(2, 6);

	$this->load->admin_view("food", $data);
}

public function foodregister()
{
	global $data;
	global $TABLE;

	$data['page'] = $this->get_post('page', 0);
	$data['from'] = $this->get_post('from', "");
	$data['menuindex'] = array(2, 6);

	$this->load->admin_view("food_register", $data);
}

public function foodmodify()
{
	global $data;
	global $TABLE;

	$data['menuindex'] = array(2, 6);

	$this->load->model("food");
	$seq = $this->get_post('seq');
	$data['food'] = $this->food->get(array("Seq"=>$seq));
	$data['page'] = $this->get_post('page', 0);
	$data['from'] = $this->get_post('from', "");

	$this->load->admin_view("food_register", $data);
}

public function exerciseinfo()
{
	global $data;
	global $TABLE;

	$this->load->model("constant");
	$data['warmup'] = $this->constant->get(array("c_name"=>'warmup'));
	$data['cooldown'] = $this->constant->get(array("c_name"=>'cooldown'));
	$data['menuindex'] = array(2, 3);

	$this->load->admin_view("exerciseinfo", $data);
}

public function extarget() 
{
	global $data;
	global $TABLE;

	$data["page"] = $this->get_post("page", 0);
	$data['menuindex'] = array(2, 4);

	$this->load->admin_view("exercisetarget", $data);
}

public function extargetregister()
{
	global $data;
	global $TABLE;

	$data['page'] = $this->get_post('page', 0);
	$data['menuindex'] = array(2, 4);

	$this->load->admin_view("exercisetarget_register", $data);
}

public function extargetmodify()
{
	global $data;
	global $TABLE;

	$data['menuindex'] = array(2, 4);

	$this->load->model("exercisetarget");
	$seq = $this->get_post('seq');
	$data['extarget'] = $this->exercisetarget->get(array("Seq"=>$seq));
	$data['page'] = $this->get_post('page', 0);

	$this->load->admin_view("exercisetarget_register", $data);
}

public function policy()
{
	global $data;
	global $TABLE;

	$this->load->model("constant");
	$data['policy'] = $this->constant->get(array("c_name"=>'policy'));
	$data['agreement'] = $this->constant->get(array("c_name"=>'agreement'));
	$data['menuindex'] = array(2, 7);

	$this->load->admin_view("policy", $data);
}

/*
|--------------------------------------------------------------------------
| Modelling functions
|--------------------------------------------------------------------------
| 
|
*/
public function search_exercise()
{
	global $data;
	global $TABLE;
	
	$page = $this->input->post('page');
	$keyvalue = $this->input->post('keyvalue', "");
	
	// Make SQL
	$where = '1';
	if ($keyvalue != "")
		$where = $where . ' AND (A.Name LIKE \'%' . $keyvalue . '%\')';

	$sql = sprintf('
		SELECT
			A.*,
			B.Name AS ExName,
			C.Name AS CategoryName
		FROM
			%s AS A
			LEFT JOIN %s AS B ON A.ExCode=B.Code
			LEFT JOIN %s AS C ON A.Type=C.Seq
		WHERE %s
		ORDER BY
			A.Seq desc',
		$TABLE['exercise'],
		$TABLE['exercisetarget'],
        $TABLE['category'],
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

	$html[] = $this->load->view('items/list_exercise', $data, true);
	$html[] = pagination($tpage, $page, 'onSelectPage');
	$html[] = $tcount;
	echo implode('|||', $html);
}

function register_exercise()
{
	global $data;
	global $TABLE;
			
	// Set validation rules
	$this->form_validation->set_rules('exname', 'Exercise Name', 'required');
	$this->form_validation->set_rules('extype', 'Exercise Type', 'required');
	$this->form_validation->set_rules('kcal', 'Calory', 'required');
	
	$data['page'] = $this->get_post("page");

	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("exercise_register", $data);
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
            
			$this->dbop->insert($TABLE['exercise'], array(
					"Name" => $this->post("exname", ""),
					"Type" => $this->post("extype", "1"),
					"KCal" => $this->post("kcal", "0"),
					"ExCode" => $this->post("excode", ""),
                    "CreateBy" => $this->post("adminseq", ""),
                    "DateModified" => now(),
                    "Logo" => $locurl,
				));

			gopage("admin/common/exercise?page=".$data['page']);
		}
		catch (Exception $e) {}
	}
}

function delete_exercise()
{
	global $data;
	global $TABLE;
	
	$seq = $this->input->post('seq');

    if ($this->dbop->count($TABLE['workout_detail'], array('ExerciseSeq' => $seq)) > 0)
    {
        echo "Exercise have been assigned to workout. Delete failed";
    }
	else $this->dbop->delete($TABLE['exercise'], array("Seq" => $seq));
}

function modify_exercise()
{
	global $data;
	global $TABLE;
	
	$exseq = $this->get_post("exseq");
	$page = $this->get_post("page");

	try {
		$this->dbop->update($TABLE['exercise'], array(
				"Name" => $this->post("exname", ""),
				"Type" => $this->post("extype", "1"),
				"KCal" => $this->post("kcal", "0"),
				"ExCode" => $this->post("excode", ""),
                "DateModified" => now()
			), array("Seq"=>$exseq));

        if ($this->post("ischnimg", "0") == "1") {
				$loc = upload_center("logophoto");
				$locurl = "";
				if (!is_null($loc)) {
					$locurl = '/www/upload/center/'.$loc['file_name'];

					$this->dbop->update($TABLE['exercise'], array(
						"Logo" => $locurl
					), array("Seq"=>$exseq));
				}
			}
        
		gopage("admin/common/exercise?page=".$page);
	}
	catch (Exception $e) {}
}

public function search_food()
{
	global $data;
	global $TABLE;
	
	$page = $this->input->post('page');
	$keyvalue = $this->input->post('keyvalue', "");
	
	// Make SQL
	$where = '1';
	if ($keyvalue != "")
		$where = $where . ' AND (FoodName LIKE \'%' . $keyvalue . '%\')';

	$sql = sprintf('
		SELECT
			A.*
		FROM
			%s AS A
		WHERE %s
		ORDER BY
			FoodName, Seq',
		$TABLE['food'],
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

	$html[] = $this->load->view('items/list_food', $data, true);
	$html[] = pagination($tpage, $page, 'onSelectPage');
	$html[] = $tcount;
	echo implode('|||', $html);
}

function register_food()
{
	global $data;
	global $TABLE;

	// Set validation rules
	$this->form_validation->set_rules('foodname', 'Food Name', 'required');
	$this->form_validation->set_rules('kcal', 'Calory', 'required');
	
	$data['page'] = $this->get_post("page");

	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("food_register", $data);
	}
	// If validation is successed
	else
	{
		try {
			$this->dbop->insert($TABLE['food'], array(
					"FoodName" => $this->post("foodname", ""),
					"KCal" => $this->post("kcal", "0")
				));

			gopage("admin/common/food?page=".$data['page']);
		}
		catch (Exception $e) {}
	}
}

function delete_food()
{
	global $data;
	global $TABLE;
	
	$seq = $this->input->post('seq');
	$this->dbop->delete($TABLE['food'], array("Seq" => $seq));
}

function modify_food()
{
	global $data;
	global $TABLE;
	
	$foodseq = $this->get_post("foodseq");
	$page = $this->get_post("page");

	try {
		$this->dbop->update($TABLE['food'], array(
				"FoodName" => $this->post("foodname", ""),
				"KCal" => $this->post("kcal", "0")
			), array("Seq"=>$foodseq));
		gopage("admin/common/food?page=".$page);
	}
	catch (Exception $e) {}
}

function update_exinfo()
{
	global $data;
	global $TABLE;
	
	$warmupurl = $this->get_post("warmupurl");
	$warmupdesc = $this->get_post("warmupdesc");
	$cooldownurl = $this->get_post("cooldownurl");
	$cooldowndesc = $this->get_post("cooldowndesc");

	$this->load->model("constant");
	try {
		$this->constant->update(
			array(
				"c_name" => "warmup"
			),
			array(
				"c_value"=>$warmupurl,
				"c_description"=>$warmupdesc
			));

		$this->constant->update(
			array(
				"c_name" => "cooldown"
			),
			array(
				"c_value"=>$cooldownurl,
				"c_description"=>$cooldowndesc
			));

		echo "Success to change data";
	}
	catch (Exception $e) {
		echo "Failed to change data";
	}
}

public function search_extarget()
{
	global $data;
	global $TABLE;
	
	$page = $this->input->post('page');
	$keyvalue = $this->input->post('keyvalue', "");
	
	// Make SQL
	$where = '1';
	if ($keyvalue != "")
		$where = $where . ' AND (Name LIKE \'%' . $keyvalue . '%\')';

	$sql = sprintf('
		SELECT
			A.*
		FROM
			%s AS A
		WHERE %s
		ORDER BY
			Name, Seq',
		$TABLE['exercisetarget'],
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

	$html[] = $this->load->view('items/list_extarget', $data, true);
	$html[] = pagination($tpage, $page, 'onSelectPage');
	$html[] = $tcount;
	echo implode('|||', $html);
}

function register_extarget()
{
	global $data;
	global $TABLE;

	// Set validation rules
	$this->form_validation->set_rules('code', 'Target Code', 'required');
	$this->form_validation->set_rules('name', 'Target Name', 'required');
	
	$data['page'] = $this->get_post("page");

	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("exercisetarget_register", $data);
	}
	// If validation is successed
	else
	{
		try {
			$this->dbop->insert($TABLE['exercisetarget'], array(
					"Name" => $this->post("name", ""),
					"Code" => $this->post("code", "")
				));

			gopage("admin/common/extarget?page=".$data['page']);
		}
		catch (Exception $e) {}
	}
}

function delete_extarget()
{
	global $data;
	global $TABLE;
	
	$seq = $this->input->post('seq');
	$this->dbop->delete($TABLE['exercisetarget'], array("Seq" => $seq));
}

function modify_extarget()
{
	global $data;
	global $TABLE;
	
	$seq = $this->get_post("seq");
	$page = $this->get_post("page");

	try {
		$this->dbop->update($TABLE['exercisetarget'], array(
				"Name" => $this->post("name", ""),
				"Code" => $this->post("code", "0")
			), array("Seq"=>$seq));
		gopage("admin/common/extarget?page=".$page);
	}
	catch (Exception $e) {}
}

function update_policy()
{
	global $data;
	global $TABLE;
	
	$agreement = $this->get_post("agreement");
	$policy = $this->get_post("policy");

	$this->load->model("constant");
	try {
		$this->constant->update(
			array(
				"c_name" => "agreement"
			),
			array(
				"c_value"=>$agreement
			));

		$this->constant->update(
			array(
				"c_name" => "policy"
			),
			array(
				"c_value"=>$policy
			));

		echo "Success to change data";
	}
	catch (Exception $e) {
		echo "Failed to change data";
	}
}
}
?>