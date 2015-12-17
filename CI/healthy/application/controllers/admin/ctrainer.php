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
class ctrainer extends MY_Controller {

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
}

public function register()
{
	global $data;
	global $TABLE;

	$this->load->model("center");

	$data['page'] = $this->get_post('page', 0);
	$data['menuindex'] = array(4, 1);
	$data['centers'] = $this->center->all();

	$this->load->admin_view("trainer_register", $data);
}

public function lists()
{
	global $data;
	global $TABLE;

	$this->load->model("center");
	$data["page"] = $this->get_post("page", 0);
	$data['menuindex'] = array(4, 2);
	$data['centers'] = $this->center->all();

	$this->load->admin_view("trainer", $data);
}

public function trainermodify()
{
	global $data;
	global $TABLE;

	$data['menuindex'] = array(4, 1);

	$this->load->model("trainer");
	$this->load->model("center");

	$seq = $this->get_post("seq");

	$data['centers'] = $this->center->all();
	$data['trainer'] = $this->trainer->get($seq);
	$data['page'] = $this->get_post('page', 0);

	$this->load->admin_view("trainer_register", $data);
}

/*
|--------------------------------------------------------------------------
| Modelling functions
|--------------------------------------------------------------------------
| 
|
*/
public function search_trainer()
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
		$where = $where . ' AND (A.Name LIKE \'%' . $keyvalue . '%\')';

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
			A.CenterCode, A.Name, A.Seq',
		$TABLE['trainer'],
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

	$html[] = $this->load->view('items/list_trainer', $data, true);
	$html[] = pagination($tpage, $page, 'onSelectPage');
	$html[] = $tcount;
	echo implode('|||', $html);
}

function register_trainer()
{
	global $data;
	global $TABLE;
	
	// Set validation rules
	$this->form_validation->set_rules('centercode', 'Center Code', 'required');
	$this->form_validation->set_rules('userid', 'User ID', 'required');
	$this->form_validation->set_rules('userpwd', 'Password', 'required');
	$this->form_validation->set_rules('name', 'Trainer Name', 'required');
	
	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("trainer_register", $data);
	}
	// If validation is successed
	else
	{
		try {

			$seq = $this->dbop->insert($TABLE['trainer'], array(
					"CenterCode" => $this->post("centercode", ""),
					"Name" => $this->post("name", ""),
					"UserID" => $this->post("userid", ""),
					"UserPW" => $this->post("userpwd", ""),
					"RegDate" => now(),
					"Sex" => $this->post("sex", "1")
				));

			$this->dbop->insert($TABLE['admin'], array(
					"AdminID" => $this->post("userid", ""),
					"AdminPW" => $this->post("userpwd", ""),
					"Permission" => "2",
					"CenterCode" => $this->post("centercode", ""),
					"AdminSeq" => $seq
				));

			gopage("admin/ctrainer/lists?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

function delete_trainer()
{
	global $data;
	global $TABLE;
	
	$seq = $this->input->post('seq');
	$this->dbop->delete($TABLE['trainer'], array("Seq" => $seq));
}

function modify_trainer()
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
		$this->load->admin_view("trainer_register", $data);
	}
	// If validation is successed
	else
	{
		try {

			$seq = $this->post("seq", "");
			
			$this->dbop->update($TABLE['trainer'], array(
					"CenterCode" => $this->post("centercode", ""),
					"Name" => $this->post("name", ""),
					"UserID" => $this->post("userid", ""),
					"UserPW" => $this->post("userpwd", ""),
					"RegDate" => now(),
					"Sex" => $this->post("sex", "1")
				), array("Seq"=>$seq));

			$this->dbop->update($TABLE['admin'], array(
					"AdminID" => $this->post("userid", ""),
					"AdminPW" => $this->post("userpwd", ""),
					"CenterCode" => $this->post("centercode", "")
				), array("AdminSeq"=>$seq, "Permission"=>"2"));

			gopage("admin/ctrainer/lists?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

}
?>