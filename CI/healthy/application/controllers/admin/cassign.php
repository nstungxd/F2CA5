<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    include("www/include/global.php");
    $data['baseDir'] = $baseDir;
    $data['cpp'] = $cpp;
    $data['menuindex'] = 4;


class cassign extends MY_Controller {
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
    public function lists_group()
    {
        global $data;
        global $TABLE;

        $this->load->model("groups");
        $this->load->model("center");
        
        $data["page"] = $this->get_post("page", 0);
        $data['menuindex'] = array(7, 4);
        $data['groups'] = $this->groups->all();
        $data['centers'] = $this->center->all();

        $this->load->admin_view("assign_list_group", $data);
    }
    public function search_group()
    {
        global $data;
        global $TABLE;

        $page = $this->input->post('page');
        $keyvalue = $this->input->post('keyvalue', "");
        $trainer = $this->post('trainer', "");
        $centercode = $this->post('centercode', "");


        // Make SQL
        $where = '1';

        if ($keyvalue != "")
            $where = $where . ' AND ((A.Name LIKE \'%' . $keyvalue . '%\') OR (B.Name LIKE \'%' . $keyvalue . '%\') OR (C.Name LIKE \'%' . $keyvalue . '%\'))';
        if ($centercode != "")
		    $where = $where . ' AND (A.CenterCode=\''. $centercode. '\')';
        if ($trainer != "")
            $where = $where . ' AND (A.CreateBy=\''. $trainer. '\')';

        $sql = sprintf('
		SELECT
			A.Seq,A.Name,A.TrainerSeq,A.CreateBy,A.DateModified,B.Name as Trainer , C.Name as NameCreateby,D.Name as DefaultWorkout,E.CenterNm as CenterName
		FROM
			%s AS A
		LEFT JOIN %s as B on B.Seq =A.TrainerSeq
		LEFT JOIN %s as C on C.Seq =A.CreateBy
		LEFT JOIN %s as D on D.Seq =A.WorkoutSeq
		LEFT JOIN %s as E on E.CenterCode =A.CenterCode
		WHERE %s
		ORDER BY
			A.Name',
            $TABLE['groups'],
            $TABLE['trainer'],
            $TABLE['trainer'],
            $TABLE['workout'],
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

        $html[] = $this->load->view('items/list_assign_group', $data, true);
        $html[] = pagination($tpage, $page, 'onSelectPage');
        $html[] = $tcount;
        echo implode('|||', $html);


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
    public function group()
    {
        global $data;
        global $TABLE;

        $this->load->model("workout");
        $this->load->model("groups");



        $data['page'] = $this->get_post('page', 0);
        $data['seq'] = $this->get_post('seq', 1);
        $data['menuindex'] = array(7, 4);
        $data['workouts'] = $this->workout->all();

        $data['group'] = $this->groups->get($data['seq']);

        $this->load->admin_view("assign_group", $data);
    }
    public function groupdefault()
    {

        global $data;
        global $TABLE;

        $this->load->model("workout");
        $this->load->model("groups");

        $seq = $this->get_post("seq");

        $data['page'] = $this->get_post('page', 0);
        $data['menuindex'] = array(7, 4);
        $data['workouts'] = $this->workout->all();

        $data['group'] = $this->groups->get($seq);


        $this->load->admin_view("modify_default_group", $data);
    }
    public function centerdefault()
    {

        global $data;
        global $TABLE;

        $this->load->model("workout");
        $this->load->model("center");

        $seq = $this->get_post("seq");

        $data['page'] = $this->get_post('page', 0);
        $data['menuindex'] = array(7, 6);
        $data['workouts'] = $this->workout->all();

        $data['center'] = $this->center->get($seq);


        $this->load->admin_view("modify_default_center", $data);
    }
    public function save_default_group()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('workout', 'workout', 'required');

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("modify_default_group", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->post("gseq", "");

                $this->dbop->update($TABLE['groups'], array(
                        "WorkoutSeq" => $this->post("workout", ""),
                        "DateModified" => now()
                    ), array("Seq"=>$seq));

                gopage("admin/cassign/lists_group?page=".$this->post("page", 0));
            }
            catch (Exception $e) {}
        }
    }
    public function save_default_center()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('workout', 'workout', 'required');

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("modify_default_center", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->post("cseq", "");

                $this->dbop->update($TABLE['center'], array(
                        "WorkoutSeq" => $this->post("workout", "")
                    ), array("Seq"=>$seq));

                gopage("admin/cassign/lists_center?page=".$this->post("page", 0));
            }
            catch (Exception $e) {}
        }
    }
	 public function save_default_member()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('workout', 'workout', 'required');

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("modify_default_member", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->post("mseq", "");

                $this->dbop->update($TABLE['user'], array(
                        "WorkoutSeq" => $this->post("workout", "")
                        //"DateModified" => now()
                    ), array("Seq"=>$seq));

		
                gopage("admin/cassign/lists_member?page=".$this->post("page", 0));
            }
            catch (Exception $e) {}
        }
    }
	public function memberdefault()
    {

        global $data;
        global $TABLE;

        $this->load->model("workout");
        $this->load->model("user");

        $seq = $this->get_post("seq");

        $data['page'] = $this->get_post('page', 0);
        $data['menuindex'] = array(7,5);
        $data['workouts'] = $this->workout->all();

        $data['user'] = $this->user->get($seq);


        $this->load->admin_view("modify_default_member", $data);
    }
    public function calendar_group()
    {
        global $data;
        global $TABLE;


        $seq = $this->input->post('seq');
        $mnth = $this->input->post('mnth');
        $yrs = $this->input->post('yrs');

        $sD = date("Y-m-d",mktime(0,0,0,$mnth,1,$yrs));
        $eD = date("Y-m-d",mktime(0,0,0,$mnth+1,1,$yrs));


        // Make SQL
        $where = '1';

        if ($seq != "")
            $where = $where . " AND (A.GroupSeq = '$seq')";
        if ($mnth != "" && $yrs != "")
            $where = $where . " AND (A.WorkoutDate between '" . $sD . "' AND '".$eD."')";
        $sql = sprintf('
		SELECT
			A.WorkoutDate,A.DateModified,A.GroupSeq,A.UserSeq,A.CenterSeq,A.WorkoutSeq, B.Name as BName,C.Name as WorkoutName
		FROM
			%s AS A
	    LEFT JOIN %s as B on B.Seq = A.GroupSeq
	    LEFT JOIN %s as C on C.Seq = A.WorkoutSeq
		WHERE %s
		ORDER BY
			A.WorkoutDate',
            $TABLE['workoutas'],
            $TABLE['groups'],
            $TABLE['workout'],
            $where);

        // Get results
        $results = $this->dbop->execSQL($sql);

        $data['mnth'] = $mnth;
        $data['yrs'] = $yrs;
        $data['results'] = $results;

        $html[] = $this->load->view('items/calendar_group', $data, true);
        echo implode('|||', $html);
    }
    public function add_group()
    {
        global $data;
        global $TABLE;
        $this->load->model("groups");
        $this->load->model("workout");
        try {
        $wo = $this->input->post('wo', "");
        $seq = $this->input->post('seq', "");
        $days = $this->input->post('days', "");
        $mnth = $this->input->post('mnth', "");
        $yrs = $this->input->post('yrs', "");
        $now = now();
        $dt = date("Y-m-d",mktime(0,0,0,$mnth,$days,$yrs));
        $ins = $this->dbop->insert($TABLE['workoutas'], array(
					"WorkoutDate" => $dt,
					"GroupSeq" => $seq,
                    "UserSeq" => null,
                    "CenterSeq" => null,
					"DateModified" => $now,
                    "WorkoutSeq" => $wo
				));
        $rs = '<p> Group : '.$this->groups->get($seq)->Name.'</p>';
        $rs .= '<p> Workout : '.$this->workout->get($wo)->Name.'</p>';
        $rs .= '<p> DateTime Modified : '.$now.'</p>';
        echo $rs;
        }
        catch (Exception $e) {}
    }
    public function remove_group()
    {
        global $data;
        global $TABLE;

        try {
            $seq = $this->input->post('seq', "");
            $days = $this->input->post('days', "");
            $mnth = $this->input->post('mnth', "");
            $yrs = $this->input->post('yrs', "");

            $dt = date("Y-m-d",mktime(0,0,0,$mnth,$days,$yrs));
            $seq = $this->dbop->delete($TABLE['workoutas'], array(
                "WorkoutDate" => $dt,
                "GroupSeq" => $seq
            ));
        }
        catch (Exception $e) {}
    }
    public function lists_member()
    {
        global $data;
        global $TABLE;

        $this->load->model("center");
        $data["page"] = $this->get_post("page", 0);
        $data['menuindex'] = array(7, 5);
        $data['centers'] = $this->center->all();

        $this->load->admin_view("assign_list_member", $data);
    }
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
                B.CenterNm,
				C.Name as DefaultWorkout
            FROM
                %s AS A
            LEFT JOIN %s AS B
            ON A.CenterCode=B.CenterCode
			LEFT JOIN %s AS C
            ON A.WorkoutSeq=C.Seq
            WHERE %s
            ORDER BY
                A.CenterCode, A.UserNm, A.Seq',
            $TABLE['user'],
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

        $html[] = $this->load->view('items/list_assign_member', $data, true);
        $html[] = pagination($tpage, $page, 'onSelectPage');
        $html[] = $tcount;
        echo implode('|||', $html);
    }
    public function member()
    {
        global $data;
        global $TABLE;

        $this->load->model("workout");
        $this->load->model("user");



        $data['page'] = $this->get_post('page', 0);
        $data['seq'] = $this->get_post('seq', 1);
        $data['menuindex'] = array(7, 5);
        $data['workouts'] = $this->workout->all();

        $data['user'] = $this->user->get($data['seq']);

        $this->load->admin_view("assign_member", $data);
    }
    public function calendar_member()
    {
        global $data;
        global $TABLE;


        $seq = $this->input->post('seq');
        $mnth = $this->input->post('mnth');
        $yrs = $this->input->post('yrs');

        $sD = date("Y-m-d",mktime(0,0,0,$mnth,1,$yrs));
        $eD = date("Y-m-d",mktime(0,0,0,$mnth+1,1,$yrs));


        // Make SQL
        $where = '1';

        if ($seq != "")
            $where = $where . " AND (A.UserSeq = '$seq')";
        if ($mnth != "" && $yrs != "")
            $where = $where . " AND (A.WorkoutDate between '" . $sD . "' AND '".$eD."')";
        $sql = sprintf('
		SELECT
			A.WorkoutDate,A.DateModified,A.GroupSeq,A.UserSeq,A.CenterSeq,A.WorkoutSeq, B.UserNm as BName,C.Name as WorkoutName
		FROM
			%s AS A
	    LEFT JOIN %s as B on B.Seq = A.UserSeq
	    LEFT JOIN %s as C on C.Seq = A.WorkoutSeq
		WHERE %s
		ORDER BY
			A.WorkoutDate',
            $TABLE['workoutas'],
            $TABLE['user'],
            $TABLE['workout'],
            $where);

        // Get results
        $results = $this->dbop->execSQL($sql);

        $data['mnth'] = $mnth;
        $data['yrs'] = $yrs;
        $data['results'] = $results;

        $html[] = $this->load->view('items/calendar_member', $data, true);
        echo implode('|||', $html);
    }
    public function add_member()
    {
        global $data;
        global $TABLE;
        $this->load->model("user");
        $this->load->model("workout");
        try {
        $wo = $this->input->post('wo', "");
        $seq = $this->input->post('seq', "");
        $days = $this->input->post('days', "");
        $mnth = $this->input->post('mnth', "");
        $yrs = $this->input->post('yrs', "");
        $now = now();
        $dt = date("Y-m-d",mktime(0,0,0,$mnth,$days,$yrs));
        $ins = $this->dbop->insert($TABLE['workoutas'], array(
					"WorkoutDate" => $dt,
					"GroupSeq" => null,
                    "UserSeq" => $seq,
                    "CenterSeq" => null,
					"DateModified" => $now,
                    "WorkoutSeq" => $wo
				));
        $rs = '<p> Member : '.$this->user->get($seq)->UserNm.'</p>';
        $rs .= '<p> Workout : '.$this->workout->get($wo)->Name.'</p>';
        $rs .= '<p> DateTime Modified : '.$now.'</p>';
        echo $rs;
        }
        catch (Exception $e) {}
    }
    public function remove_member()
    {
        global $data;
        global $TABLE;

        try {
            $seq = $this->input->post('seq', "");
            $days = $this->input->post('days', "");
            $mnth = $this->input->post('mnth', "");
            $yrs = $this->input->post('yrs', "");

            $dt = date("Y-m-d",mktime(0,0,0,$mnth,$days,$yrs));
            $seq = $this->dbop->delete($TABLE['workoutas'], array(
                "WorkoutDate" => $dt,
                "UserSeq" => $seq
            ));
        }
        catch (Exception $e) {}
    }
    public function lists_center()
    {
        global $data;
        global $TABLE;
        $this->load->model("center");
        
        $data["page"] = $this->get_post("page", 0);
        $data['menuindex'] = array(7, 6);
        $data['centers'] = $this->center->all();
        
        $this->load->admin_view("assign_list_center", $data);
    }
    public function search_center()
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
            $where = $where . ' AND (A.CenterNm LIKE \'%' . $keyvalue . '%\')';

        $sql = sprintf('
            SELECT
                A.*,
				B.Name as DefaultWorkout
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

        $html[] = $this->load->view('items/list_assign_center', $data, true);
        $html[] = pagination($tpage, $page, 'onSelectPage');
        $html[] = $tcount;
        echo implode('|||', $html);
    }
    public function center()
    {
        global $data;
        global $TABLE;

        $this->load->model("workout");
        $this->load->model("center");



        $data['page'] = $this->get_post('page', 0);
        $data['seq'] = $this->get_post('seq', 1);
        $data['menuindex'] = array(7, 6);
        $data['workouts'] = $this->workout->all();

        $data['center'] = $this->center->get($data['seq']);

        $this->load->admin_view("assign_center", $data);
    }
    public function calendar_center()
    {
        global $data;
        global $TABLE;


        $seq = $this->input->post('seq');
        $mnth = $this->input->post('mnth');
        $yrs = $this->input->post('yrs');

        $sD = date("Y-m-d",mktime(0,0,0,$mnth,1,$yrs));
        $eD = date("Y-m-d",mktime(0,0,0,$mnth+1,1,$yrs));


        // Make SQL
        $where = '1';

        if ($seq != "")
            $where = $where . " AND (A.CenterSeq = '$seq')";
        if ($mnth != "" && $yrs != "")
            $where = $where . " AND (A.WorkoutDate between '" . $sD . "' AND '".$eD."')";
        $sql = sprintf('
		SELECT
			A.WorkoutDate,A.DateModified,A.GroupSeq,A.UserSeq,A.CenterSeq,A.WorkoutSeq, B.CenterNm as BName,C.Name as WorkoutName
		FROM
			%s AS A
	    LEFT JOIN %s as B on B.Seq = A.CenterSeq
	    LEFT JOIN %s as C on C.Seq = A.WorkoutSeq
		WHERE %s
		ORDER BY
			A.WorkoutDate',
            $TABLE['workoutas'],
            $TABLE['center'],
            $TABLE['workout'],
            $where);

        // Get results
        $results = $this->dbop->execSQL($sql);

        $data['mnth'] = $mnth;
        $data['yrs'] = $yrs;
        $data['results'] = $results;

        $html[] = $this->load->view('items/calendar_center', $data, true);
        echo implode('|||', $html);
    }
    public function add_center()
    {
        global $data;
        global $TABLE;
        $this->load->model("center");
        $this->load->model("workout");
        try {
        $wo = $this->input->post('wo', "");
        $seq = $this->input->post('seq', "");
        $days = $this->input->post('days', "");
        $mnth = $this->input->post('mnth', "");
        $yrs = $this->input->post('yrs', "");
        $now = now();
        $dt = date("Y-m-d",mktime(0,0,0,$mnth,$days,$yrs));
        $ins = $this->dbop->insert($TABLE['workoutas'], array(
					"WorkoutDate" => $dt,
					"GroupSeq" => null,
                    "UserSeq" => null,
                    "CenterSeq" => $seq,
					"DateModified" => $now,
                    "WorkoutSeq" => $wo
				));
        $rs = '<p> Center : '.$this->center->get($seq)->CenterNm.'</p>';
        $rs .= '<p> Workout : '.$this->workout->get($wo)->Name.'</p>';
        $rs .= '<p> DateTime Modified : '.$now.'</p>';
        echo $rs;
        }
        catch (Exception $e) {}
    }
    public function remove_center()
    {
        global $data;
        global $TABLE;

        try {
            $seq = $this->input->post('seq', "");
            $days = $this->input->post('days', "");
            $mnth = $this->input->post('mnth', "");
            $yrs = $this->input->post('yrs', "");

            $dt = date("Y-m-d",mktime(0,0,0,$mnth,$days,$yrs));
            $seq = $this->dbop->delete($TABLE['workoutas'], array(
                "WorkoutDate" => $dt,
                "CenterSeq" => $seq
            ));
        }
        catch (Exception $e) {}
    }


}