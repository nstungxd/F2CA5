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
class cmember extends MY_Controller {

function __construct()
{
	parent::__construct();
	if(!$this->auth->isLoggedIn())
    	show_404();
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
}

public function register()
{
	global $data;
	global $TABLE;

	$this->load->model("center");

	$data['page'] = $this->get_post('page', 0);
	$data['menuindex'] = array(5, 1);
	$data['centers'] = $this->center->all();

	$this->load->admin_view("member_register", $data);
}

public function lists()
{
	global $data;
	global $TABLE;

	$this->load->model("center");
	$data["page"] = $this->get_post("page", 0);
	$data['menuindex'] = array(5, 2);
	$data['centers'] = $this->center->all();

	$this->load->admin_view("member", $data);
}

public function membermodify()
{
	global $data;
	global $TABLE;

	$data['menuindex'] = array(5, 1);

	$this->load->model("user");
	$this->load->model("center");

	$seq = $this->get_post("seq");

	$data['centers'] = $this->center->all();
	$data['member'] = $this->user->get($seq);
	$data['page'] = $this->get_post('page', 0);

	$this->load->admin_view("member_register", $data);
}

public function exercises()
{
	global $data;
	global $TABLE;

	$this->load->model("center");

	$data["page"] = $this->get_post("page", 0);
	$data['menuindex'] = array(5, 3);
	$data['centers'] = $this->center->all();

	$this->load->admin_view("userexercise", $data);
}

public function userexregister()
{
	global $data;
	global $TABLE;

	$this->load->model("center");
	$this->load->model("exercise");

	$data['page'] = $this->get_post('page', 0);
	$data['menuindex'] = array(5, 3);
	$data['centers'] = $this->center->all();
	$data['exercises'] = $this->exercise->all();

	$this->load->admin_view("userexercise_register", $data);
}

public function userexmodify()
{
	global $data;
	global $TABLE;

	$this->load->model("center");
	$this->load->model("exercise");
	$this->load->model("userexercise");
	$this->load->model("user");

	$seq = $this->get_post("seq");

	$data['page'] = $this->get_post('page', 0);
	$data['menuindex'] = array(5, 3);
	$data['centers'] = $this->center->all();
	$data['exercises'] = $this->exercise->all();
	$data['userex'] = $this->userexercise->get(array("Seq"=>$seq));
	$data['user'] = $this->user->get($data['userex']->UserSeq);

	$this->load->admin_view("userexercise_register", $data);
}

/*
|--------------------------------------------------------------------------
| Modelling functions
|--------------------------------------------------------------------------
| 
|
*/
public function search_member()
{
	global $data;
	global $TABLE;
	
	$page = $this->input->post('page');
	$keyvalue = $this->input->post('keyvalue', "");
	$centercode = $this->input->post('centercode', "");
	
	// Make SQL
	$where = '1';

	if ($centercode != "")
		$where = $where . ' AND (A.CenterCode=\''. $centercode. '\')';

	if ($keyvalue != "")
		$where = $where . ' AND ((A.UserNm LIKE \'%' . $keyvalue . '%\') OR (A.Email LIKE \'%' . $keyvalue . '%\'))';

	$sql = sprintf('
		SELECT
			A.*,
			B.CenterNm
		FROM
			%s AS A
		INNER JOIN %s AS B
		ON A.CenterCode=B.CenterCode
		WHERE %s
		ORDER BY
			A.CenterCode, A.UserNm, A.Seq',
		$TABLE['user'],
		$TABLE['center'],
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

	$html[] = $this->load->view('items/list_member', $data, true);
	$html[] = pagination($tpage, $page, 'onSelectPage');
	$html[] = $tcount;
	echo implode('|||', $html);
}

function register_member()
{
	global $data;
	global $TABLE;
	
	// Set validation rules
	$this->form_validation->set_rules('centercode', 'Center Code', 'required');
	$this->form_validation->set_rules('userid', 'User ID', 'required');
	$this->form_validation->set_rules('userpwd', 'Password', 'required');
	
	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("member_register", $data);
	}
	// If validation is successed
	else
	{
		try {

			$seq = $this->dbop->insert($TABLE['user'], array(
					"CenterCode" => $this->post("centercode", ""),
					"UserNm" => $this->post("name", ""),
					"UserID" => $this->post("userid", ""),
					"UserPW" => encpassword($this->post("userpwd", "")),
					"BirthDt" => $this->post("birthdt", ""),
					"Sex" => $this->post("sex", "1"),
					"Phone" => $this->post("phone", ""),
					"Email" => $this->post("email", ""),
					"Height" => $this->post("height", "")
				));

			gopage("admin/cmember/lists?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

function delete_member()
{
	global $data;
	global $TABLE;
	
	$seq = $this->input->post('seq');
	$this->dbop->delete($TABLE['user'], array("Seq" => $seq));
}

function modify_member()
{
	global $data;
	global $TABLE;
	
	// Set validation rules
	$this->form_validation->set_rules('centercode', 'Center Code', 'required');
	$this->form_validation->set_rules('userid', 'User ID', 'required');
	$this->form_validation->set_rules('userpwd', 'Password', 'required');
	
	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("member_register", $data);
	}
	// If validation is successed
	else
	{
		try {

			$seq = $this->post("seq", "");
			
			$seq = $this->dbop->update($TABLE['user'], array(
					"CenterCode" => $this->post("centercode", ""),
					"UserNm" => $this->post("name", ""),
					"UserID" => $this->post("userid", ""),
					"UserPW" => encpassword($this->post("userpwd", "")),
					"BirthDt" => $this->post("birthdt", ""),
					"Sex" => $this->post("sex", "1"),
					"Phone" => $this->post("phone", ""),
					"Email" => $this->post("email", ""),
					"Height" => $this->post("height", "")
				), array("Seq"=>$seq));

			gopage("admin/cmember/lists?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

public function search_exercises()
{
	global $data;
	global $TABLE;
	
	$page = $this->post('page');
	$keyvalue = $this->post('keyvalue', "");
	$centercode = $this->post('centercode', "");
	$trainer = $this->post('trainer', "");
	
	// Make SQL
	$where = '1';

	if ($centercode != "")
		$where = $where . ' AND (B.CenterCode=\''. $centercode. '\')';

	if ($keyvalue != "")
		$where = $where . ' AND ((B.UserNm LIKE \'%' . $keyvalue . '%\') OR (C.Name LIKE \'%' . $keyvalue . '%\'))';

	if ($trainer != "")
		$where = $where . ' AND (A.TrainerSeq=\''. $trainer. '\')';

	$sql = sprintf('
		SELECT
			A.*,
			B.UserNm,
			D.CenterNm,
			C.Name AS ExName,
			C.Type AS ExType,
			E.Name AS Trainer
		FROM
			%s AS A
		LEFT JOIN %s AS B
		ON A.UserSeq=B.Seq
		LEFT JOIN %s AS D
		ON B.CenterCode=D.CenterCode
		LEFT JOIN %s AS C
		ON A.ExerciseSeq=C.Seq
		LEFT JOIN %s AS E
		ON A.TrainerSeq=E.Seq
		WHERE %s
		ORDER BY
			B.CenterCode, B.UserNm, C.Name',
		$TABLE['userexercise'],
		$TABLE['user'],
		$TABLE['center'],
		$TABLE['exercise'],
		$TABLE['trainer'],
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

	$html[] = $this->load->view('items/list_userexercise', $data, true);
	$html[] = pagination($tpage, $page, 'onSelectPage');
	$html[] = $tcount;
	echo implode('|||', $html);
}

function delete_exercise()
{
	global $data;
	global $TABLE;
	
	$seq = $this->input->post('seq');
	$this->dbop->delete($TABLE['userexercise'], array("Seq" => $seq));
}

function search_trainer()
{
	global $data;
	global $TABLE;
	
	$centercode = $this->post('centercode', "");
	$this->load->model("trainer");
	$trainers = $this->trainer->lists(array("CenterCode"=>$centercode));

	echo "<option value='' selected>Please select</option>";
	foreach ($trainers as $t) {
		echo "<option value='".$t->Seq."'>".$t->Name."</option>";
	}
}

function search_member_list()
{
	global $data;
	global $TABLE;
	
	$centercode = $this->post('centercode', "");
	$this->load->model("user");
	$members = $this->user->lists(array("CenterCode"=>$centercode));

	echo "<option value='' selected>Please select</option>";
	foreach ($members as $m) {
		echo "<option value='".$m->Seq."'>".$m->UserNm."</option>";
	}
}

function register_userex()
{
	global $data;
	global $TABLE;
	
	// Set validation rules
	$this->form_validation->set_rules('centercode', 'Center Code', 'required');
	$this->form_validation->set_rules('trainer', 'Trainer', 'required');
	$this->form_validation->set_rules('user', 'User', 'required');
	$this->form_validation->set_rules('exercise', 'Exercise', 'required');
	
	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("userexercise_register", $data);
	}
	// If validation is successed
	else
	{
		try {

			$seq = $this->dbop->insert($TABLE['userexercise'], array(
					"UserSeq" => $this->post("user", ""),
					"ExerciseSeq" => $this->post("exercise", ""),
					"TrainerSeq" => $this->post("trainer", ""),
					"Pro1" => $this->post("pro1", ""),
					"Pro2" => $this->post("pro2", ""),
					"Pro3" => $this->post("pro3", "")
				));

			gopage("admin/cmember/exercises?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

function modify_userex()
{
	global $data;
	global $TABLE;
	
	// Set validation rules
	$this->form_validation->set_rules('centercode', 'Center Code', 'required');
	$this->form_validation->set_rules('trainer', 'Trainer', 'required');
	$this->form_validation->set_rules('user', 'User', 'required');
	$this->form_validation->set_rules('exercise', 'Exercise', 'required');
	
	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("userexercise_register", $data);
	}
	// If validation is successed
	else
	{
		try {

			$seq = $this->post("seq", "");

			$this->dbop->update($TABLE['userexercise'], array(
					"UserSeq" => $this->post("user", ""),
					"ExerciseSeq" => $this->post("exercise", ""),
					"TrainerSeq" => $this->post("trainer", ""),
					"Pro1" => $this->post("pro1", ""),
					"Pro2" => $this->post("pro2", ""),
					"Pro3" => $this->post("pro3", "")
				), array("Seq"=>$seq));

			gopage("admin/cmember/exercises?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

function get_exercise_pro_label()
{
	global $data;
	global $TABLE;
	
	try {
		$exseq = $this->post('exseq', "");
		$this->load->model("exercise");
		$ex = $this->exercise->get(array("Seq"=>$exseq));

		if ($ex != null) {
			$label[] = v2k_ex_pro1($ex->Type);
			$label[] = v2k_ex_pro2($ex->Type);
			$label[] = v2k_ex_pro3($ex->Type);
		}
		else {
			$label[] = "Pro1";
			$label[] = "Pro2";
			$label[] = "Pro3";
		}
	}
	catch (Exception $e) {
		$label[] = "Pro1";
		$label[] = "Pro2";
		$label[] = "Pro3";
	}

	echo implode('|||', $label);
}

}
?>