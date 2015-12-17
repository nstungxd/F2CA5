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
class cequipment extends MY_Controller {

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
	$this->load->model("exercise");

	$data['page'] = $this->get_post('page', 0);
	$data['menuindex'] = array(2,5, 1);
	$data['centers'] = $this->center->all();
	$data['exercises'] = $this->exercise->all();

	$this->load->admin_view("equipment_register", $data);
}

public function lists()
{
	global $data;
	global $TABLE;

	$this->load->model("center");
	$data["page"] = $this->get_post("page", 0);
	$data['menuindex'] = array(2,5, 2);
	$data['centers'] = $this->center->all();

	$this->load->admin_view("equipment", $data);
}

public function equipmentmodify()
{
	global $data;
	global $TABLE;

	$data['menuindex'] = array(2,5, 1);

	$this->load->model("equipment");
	$this->load->model("center");
	$this->load->model("exercise");

	$seq = $this->get_post("seq");

	$data['centers'] = $this->center->all();
	$data['exercises'] = $this->exercise->all();

	$data['equipment'] = $this->equipment->get(array("Seq"=>$seq));
	$data['page'] = $this->get_post('page', 0);

	$this->load->admin_view("equipment_register", $data);
}

/*
|--------------------------------------------------------------------------
| Modelling functions
|--------------------------------------------------------------------------
| 
|
*/
public function search_equipment()
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
		$where = $where . ' AND ((A.EqName LIKE \'%' . $keyvalue . '%\'))';

	$sql = sprintf('
		SELECT
			A.*,
			B.CenterNm,
			C.Name AS ExName
		FROM
			%s AS A
		INNER JOIN %s AS B
		ON A.CenterCode=B.CenterCode
		INNER JOIN %s AS C
		ON A.ExerciseSeq=C.Seq
		WHERE %s
		ORDER BY
			A.CenterCode, A.ExerciseSeq, A.Seq',
		$TABLE['equipment'],
		$TABLE['center'],
		$TABLE['exercise'],
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

	$html[] = $this->load->view('items/list_equipment', $data, true);
	$html[] = pagination($tpage, $page, 'onSelectPage');
	$html[] = $tcount;
	echo implode('|||', $html);
}

function register_equipment()
{
	global $data;
	global $TABLE;
	
	// Set validation rules
	$this->form_validation->set_rules('centercode', 'Center Code', 'required');
	$this->form_validation->set_rules('exseq', 'Exercise', 'required');
	$this->form_validation->set_rules('nfc', 'NFC Code', 'required');
	
	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("equipment_register", $data);
	}
	// If validation is successed
	else
	{
		try {

			$seq = $this->dbop->insert($TABLE['equipment'], array(
					"CenterCode" => $this->post("centercode", ""),
					"EqName" => $this->post("eqname", ""),
					"ExerciseSeq" => $this->post("exseq", ""),
					"NFCCode" => $this->post("nfc", ""),
					"EqNum" => $this->post("eqnum", ""),
					"USEYN" => "1"
				));

			gopage("admin/cequipment/lists?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

function delete_equipment()
{
	global $data;
	global $TABLE;
	
	$seq = $this->input->post('seq');
	$this->dbop->delete($TABLE['equipment'], array("Seq" => $seq));
}

function modify_equipment()
{
	global $data;
	global $TABLE;
	
	// Set validation rules
	$this->form_validation->set_rules('centercode', 'Center Code', 'required');
	$this->form_validation->set_rules('exseq', 'Exercise', 'required');
	$this->form_validation->set_rules('nfc', 'NFC Code', 'required');
	
	// If validation is failed
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->admin_view("equipment_register", $data);
	}
	// If validation is successed
	else
	{
		try {

			$seq = $this->post("seq", "");

			$this->dbop->update($TABLE['equipment'], array(
					"CenterCode" => $this->post("centercode", ""),
					"EqName" => $this->post("eqname", ""),
					"ExerciseSeq" => $this->post("exseq", ""),
					"NFCCode" => $this->post("nfc", ""),
					"EqNum" => $this->post("eqnum", ""),
					"USEYN" => "1"
				), array("Seq"=>$seq));

			gopage("admin/cequipment/lists?page=".$this->post("page", 0));
		}
		catch (Exception $e) {}
	}
}

}
?>