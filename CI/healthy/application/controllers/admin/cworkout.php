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
class cworkout extends MY_Controller {

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
    public function lists()
    {
        global $data;
        global $TABLE;

        $this->load->model("center");
        
        $data["page"] = $this->get_post("page", 0);
        $data['menuindex'] = array(7, 1);
        $data['centers'] = $this->center->all();

        $this->load->admin_view("workout", $data);
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
    public function search_workout()
    {
        global $data;
        global $TABLE;

        $page = $this->input->post('page');
        $keyvalue = $this->input->post('keyvalue', "");
        $centercode = $this->post('centercode', "");
        $adminseq = $this->post('adminseq', "");

        // Make SQL
        $where = '1';
        if ($centercode != "")
		    $where = $where . ' AND (A.CenterCode=\''. $centercode. '\')';
        if ($keyvalue != "")
            $where = $where . ' AND ((A.Name LIKE \'%' . $keyvalue . '%\') OR (C.Name LIKE \'%' . $keyvalue . '%\'))';

        $sql = sprintf('
		SELECT
			A.Seq,A.CenterCode,A.Name,A.CreateBy,A.DateModified ,C.Name as NameCreateby, D.CenterNm as NameCenter
		FROM
			%s AS A
		LEFT JOIN %s as C on C.Seq =A.CreateBy
		LEFT JOIN %s as D on D.CenterCode =A.CenterCode
		WHERE %s
		ORDER BY
			A.Seq desc',
            $TABLE['workout'],
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
        $data['adminseq'] = $adminseq;

        $html[] = $this->load->view('items/list_workout', $data, true);
        $html[] = pagination($tpage, $page, 'onSelectPage');
        $html[] = $tcount;
        echo implode('|||', $html);
    }
    public function workoutregister()
    {
        global $data;
        global $TABLE;

        $this->load->model("center");



        $data['page'] = $this->get_post('page', 0);
        $data['menuindex'] = array(7, 2);
        $data['centers'] = $this->center->all();

        $this->load->admin_view("workout_register", $data);
    }
    public function workoutmodify()
    {
        global $data;
        global $TABLE;

       $this->load->model("trainer");
        $this->load->model("workout");
        $this->load->model("center");

        $seq = $this->get_post("seq");

        $data['page'] = $this->get_post('page', 0);
        $data['menuindex'] = array(7, 2);
        $data['centers'] = $this->center->all();

        $data['workout'] = $this->workout->get($seq);


        $this->load->admin_view("workout_register", $data);
    }
    function register_workout()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('CenterCreate', 'CenterCreate', 'required');
        $this->form_validation->set_rules('trainerCreate', 'trainerCreate', 'required');


        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("workout_register", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->dbop->insert($TABLE['workout'], array(
                    "Name" => $this->post("Name", ""),
                    "CenterCode" => $this->post("CenterCreate", ""),
                    "CreateBy" => $this->post("trainerCreate", ""),
                    "DateModified" => now()
                ));

                gopage("admin/cworkout/lists?page=".$this->post("page", 0));
            }
            catch (Exception $e) {}
        }
    }
    function modify_workout()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('CenterCreate', 'CenterCreate', 'required');
        $this->form_validation->set_rules('trainerCreate', 'trainerCreate', 'required');
        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("workout_register", $data);
        }
        // If validation is successed
        else
        {
            try {

               $wseq = $this->get_post("wseq");

                $this->dbop->update($TABLE['workout'], array(
                    "Name" => $this->post("Name", ""),
                    "CenterCode" => $this->post("CenterCreate", ""),
                    "CreateBy" => $this->post("trainerCreate", ""),
                    "DateModified" => now()
                ), array("Seq"=>$wseq));

                gopage("admin/cworkout/lists?page=".$this->post("page", 0));
            }
            catch (Exception $e) {}
        }
    }
    function delete_workout()
    {
        global $data;
        global $TABLE;

        $seq = $this->input->post('seq');

        if ($this->dbop->count($TABLE['user'], array('WorkoutSeq' => $seq)) > 0)
        {
            echo "Workout have been assigned to default workout member. Delete failed";
        }
        else if ($this->dbop->count($TABLE['center'], array('WorkoutSeq' => $seq)) > 0)
        {
            echo "Workout have been assigned to default workout center. Delete failed";
        }
        else if ($this->dbop->count($TABLE['groups'], array('WorkoutSeq' => $seq)) > 0)
        {
            echo "Workout have been assigned to default workout group. Delete failed";
        }
        else if ($this->dbop->count($TABLE['workoutas'], array('WorkoutSeq' => $seq)) > 0)
        {
            echo "Workout have been assigned. Delete failed";
        }
        else if ($this->dbop->count($TABLE['workout_detail'], array('WorkoutSeq' => $seq)) > 0)
        {
            echo "Workout have exist value. Delete failed";
        }
        else $this->dbop->delete($TABLE['workout'], array("Seq" => $seq));
    }
    function details()
    {
        global $data;
        global $TABLE;
        $this->load->model("workout");
        
        $seq = $this->get_post("seq");

        //$this->load->model("center");
        $data["page"] = $this->get_post("page", 0);
        $data['menuindex'] = array(7, 1);
        $data["seq"] = $seq;
        //$data['centers'] = $this->center->all();
        $data['workout'] = $this->workout->get($seq);
        
        $this->load->admin_view("workout_exercise", $data);


    }
    public function search_workout_execise()
    {
        global $data;
        global $TABLE;

        $page = $this->input->post('page');
        $seq = $this->input->post('seq');
        $check_owner = $this->input->post('check_owner');


        // Make SQL
        $where = 'A.WorkoutSeq = '.$seq;


        $sql = sprintf('
		SELECT
			A.*,
			B.Name as ExerciseName,
			C.Name as InputName1,
			D.Name as InputName2,
			E.Name as InputName3

		FROM
			%s AS A
		LEFT JOIN %s as B on B.Seq =A.ExerciseSeq
		LEFT JOIN %s as C on C.Seq =A.Input1
		LEFT JOIN %s as D on D.Seq =A.Input2
		LEFT JOIN %s as E on E.Seq =A.Input3
		WHERE %s
		ORDER BY
			A.Position',
            $TABLE['workout_detail'],
            $TABLE['exercise'],
            $TABLE['category_detail'],
            $TABLE['category_detail'],
            $TABLE['category_detail'],
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
        $data['check_owner'] = $check_owner;

        $html[] = $this->load->view('items/list_workout_execise', $data, true);
        $html[] = pagination($tpage, $page, 'onSelectPage');
        $html[] = $tcount;
        echo implode('|||', $html);


    }
    public function add_workout_execise()
    {
        global $data;
        global $TABLE;

        $this->load->model("exercise");
        $this->load->model("workout");



        $data['page'] = $this->get_post('page', 0);
        $data['seq'] = $this->get_post('seq', 1);
        $data['menuindex'] = array(7, 2);
        $data['exercises'] = $this->exercise->all();

        $data['workout'] = $this->workout->get($data['seq']);

        $this->load->admin_view("add_workout_execise", $data);
    }
    function save_workout_execise()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('execise', 'execise', 'required');

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("add_workout_execise", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->post("seq", "");
                $execise= $this->post("execise", "");
                

                $this->dbop->insert($TABLE['workout_detail'], array(
                    "WorkoutSeq" => $seq,
                    "ExerciseSeq" => $execise,
                    "Input1" => $this->post("input1", ""),
                    "Input2" => $this->post("input2", ""),
                    "Input3" => $this->post("input3", ""),
                    "Value1" => $this->post("value1", ""),
                    "Value2" => $this->post("value2", ""),
                    "Value3" => $this->post("value3", ""),
                ));

                gopage("admin/cworkout/details?page=".$this->post("page", 0).'&seq='.$seq);
            }
            catch (Exception $e) {}
        }
    }
    function delete_workout_execise()
    {
        try {

            global $data;
            global $TABLE;

            $seq = $this->input->post('seq');
            $this->dbop->delete($TABLE['workout_detail'], array("Seq" => $seq));


        }
        catch (Exception $e) {}
    }
    public function search_input()
    {
        global $data;
        global $TABLE;

        $this->load->model("exercise");
        $this->load->model("category_detail");
        
        $seq = $this->input->post('execise', "");
        
        $execise = $this->exercise->get(array("Seq"=>$seq));
        
        
        $category_detail = $this->category_detail->lists(array("CategorySeq"=>$execise->Type));

        $data['results'] = $category_detail;

        $html[] = $this->load->view('items/list_input_workout', $data, true);
        echo implode('|||', $html);
    }
    public function reorder()
    {
        global $data;
        global $TABLE;
        
        $execise = $this->input->post('reorder', "");
        $arr = explode(",", $execise);

        $i=0;
        foreach ($arr as $val) {
            $i++;
            $this->dbop->update($TABLE['workout_detail'], array(
                    "Position" => $i
                ), array("Seq"=>$val));
        }
    }
    public function duplicate_workout()
    {
        global $data;
        global $TABLE;

        $seq = $this->input->post('zseq', "");
        $zadminseq = $this->input->post('zadminseq', "");

        $exname = $this->input->post('exname', "");

        $where = 'A.Seq = '.$seq.'';


        $sql = sprintf('
            SELECT
                A.*
            FROM
                %s AS A
            WHERE %s limit 1',
            $TABLE['workout'],
            $where);

        // Get results
        $results = $this->dbop->execSQL($sql);

        foreach ($results as $res) {
            if($zadminseq == 0) $createby = $res-> CreateBy;
            else $createby =$zadminseq;
            $seqc = $this->dbop->insert($TABLE['workout'], array(
                "Name" => $exname,
                "CreateBy" => $createby,
                "CenterCode" =>$res-> CenterCode,
                "DateModified" => now()
            ));
        }

        $where = 'A.WorkoutSeq = '.$seq.'';


        $sql = sprintf('
            SELECT
                A.*
            FROM
                %s AS A
            WHERE %s limit 1',
            $TABLE['workout_detail'],
            $where);

        // Get results
        $results = $this->dbop->execSQL($sql);
        foreach ($results as $res) {
            $this->dbop->insert($TABLE['workout_detail'], array(
                "WorkoutSeq" => $seqc,
                "ExerciseSeq" => $res->ExerciseSeq,
                "Input1" => $res->Input1,
                "Input2" => $res->Input2,
                "Input3" => $res->Input3,
                "Value1" => $res->Value1,
                "Value2" => $res->Value2,
                "Value3" => $res->Value3,
            ));
        }



        gopage("admin/cworkout/lists?page=".$this->post("page", 0));
    }
}
