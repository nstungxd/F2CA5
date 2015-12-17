<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include("www/include/global.php");
$data['baseDir'] = $baseDir;
$data['cpp'] = $cpp;
$data['menuindex'] = 4;


class cgroup extends MY_Controller {
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
        $data['menuindex'] = array(6, 1);
        $data['centers'] = $this->center->all();

        $this->load->admin_view("group", $data);
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

        if ($centercode != "")
		    $where = $where . ' AND (A.CenterCode=\''. $centercode. '\')';
        if ($keyvalue != "")
            $where = $where . ' AND ((A.Name LIKE \'%' . $keyvalue . '%\') OR (B.Name LIKE \'%' . $keyvalue . '%\') OR (C.Name LIKE \'%' . $keyvalue . '%\'))';
        if ($trainer != "")
            $where = $where . ' AND (A.TrainerSeq=\''. $trainer. '\')';
        $sql = sprintf('
		SELECT
			A.Seq,A.Name,A.TrainerSeq,A.CreateBy,A.DateModified,B.Name as Trainer , C.Name as NameCreateby,D.CenterNm as NameCenter
		FROM
			%s AS A
		LEFT JOIN %s as B on B.Seq =A.TrainerSeq
		LEFT JOIN %s as C on C.Seq =A.CreateBy
		LEFT JOIN %s as D on D.CenterCode =A.CenterCode
		WHERE %s
		ORDER BY
			A.DateModified desc',
            $TABLE['groups'],
            $TABLE['trainer'],
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

        $html[] = $this->load->view('items/list_group', $data, true);
        $html[] = pagination($tpage, $page, 'onSelectPage');
        $html[] = $tcount;
        echo implode('|||', $html);


    }
    public function groupregister()
    {
        global $data;
        global $TABLE;

        $this->load->model("trainer");
        $this->load->model("center");



        $data['page'] = $this->get_post('page', 0);
        $data['menuindex'] = array(6, 2);
        $data['trainer'] = $this->trainer->all();
        $data['centers'] = $this->center->all();

        $this->load->admin_view("group_register", $data);
    }
    public function groupmodify()
    {
        global $data;
        global $TABLE;

        $this->load->model("trainer");
        $this->load->model("groups");
        $this->load->model("center");

        $seq = $this->get_post("seq");

        $data['page'] = $this->get_post('page', 0);
        $data['menuindex'] = array(6, 2);
        $data['centers'] = $this->center->all();


        $data['group'] = $this->groups->get($seq);


        $this->load->admin_view("group_register", $data);
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
    function search_user()
    {
        global $data;
        global $TABLE;

        $centercode = $this->post('centercode', "");
        $this->load->model("user");
        $users = $this->user->lists(array("CenterCode"=>$centercode,"GroupSeq"=>null));

        
        foreach ($users as $t) {
            echo "<option value='".$t->Seq."'>".$t->UserNm."</option>";
        }
    }
    function register_group()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('trainerLink', 'trainerLink', 'required');
        $this->form_validation->set_rules('trainerCreate', 'trainerCreate', 'required');
        $this->form_validation->set_rules('CenterCreate', 'CenterCreate', 'required');

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("group_register", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->dbop->insert($TABLE['groups'], array(
                    "Name" => $this->post("Name", ""),
                    "TrainerSeq" => $this->post("trainerLink", ""),
                    "CreateBy" => $this->post("trainerCreate", ""),
                    "CenterCode" => $this->post("CenterCreate", ""),
                    "DateModified" => now()
                ));

                gopage("admin/cgroup/lists?page=".$this->post("page", 0));
            }
            catch (Exception $e) {}
        }
    }
    function modify_group()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('trainerLink', 'trainerLink', 'required');
        $this->form_validation->set_rules('trainerCreate', 'trainerCreate', 'required');
        $this->form_validation->set_rules('CenterCreate', 'CenterCreate', 'required');

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("group_register", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->post("gseq", "");

                $this->dbop->update($TABLE['groups'], array(
                        "Name" => $this->post("Name", ""),
                        "TrainerSeq" => $this->post("trainerLink", ""),
                        "CreateBy" => $this->post("trainerCreate", ""),
                        "CenterCode" => $this->post("CenterCreate", ""),
                        "DateModified" => now()
                    ), array("Seq"=>$seq));

                gopage("admin/cgroup/lists?page=".$this->post("page", 0));
            }
            catch (Exception $e) {}
        }
    }
    function delete_group()
    {
        global $data;
        global $TABLE;

        $seq = $this->input->post('seq');


        if ($this->dbop->count($TABLE['user'], array('GroupSeq' => $seq)) > 0)
        {
            echo "Group have exist member. Delete failed";
        }
        else if ($this->dbop->count($TABLE['workoutas'], array('GroupSeq' => $seq)) > 0)
        {
            echo "Group have been assigned workout. Delete failed";
        }
        else $this->dbop->delete($TABLE['groups'], array("Seq" => $seq));

    }
    function details()
    {
        global $data;
        global $TABLE;
        $this->load->model("groups");
        
        $seq = $this->get_post("seq");

        //$this->load->model("center");
        $data["page"] = $this->get_post("page", 0);
        $data['menuindex'] = array(6, 1);
        $data["seq"] = $seq;
        //$data['centers'] = $this->center->all();
        $data['group'] = $this->groups->get($seq);
        $this->load->admin_view("group_member", $data);


    }

    public function search_group_member()
    {
        global $data;
        global $TABLE;

        $page = $this->input->post('page');
        $seq = $this->input->post('seq');
        $keyvalue = $this->input->post('keyvalue', "");


        // Make SQL
        $where = 'A.GroupSeq = '.$seq;

        if ($keyvalue != "")
            $where = $where . ' AND ((A.UserNM LIKE \'%' . $keyvalue . '%\') OR (C.Name LIKE \'%' . $keyvalue . '%\'))';

        $sql = sprintf('
		SELECT
			A.Seq,A.UserNM,A.CreateBy,A.DateModified,C.Name as NameCreateby,D.CenterNm as NameCenter
		FROM
			%s AS A
		LEFT JOIN %s as C on C.Seq =A.CreateBy
		LEFT JOIN %s as D on D.CenterCode =A.CenterCode
		WHERE %s
		ORDER BY
			A.UserNM',
            $TABLE['user'],
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

        $html[] = $this->load->view('items/list_group_member', $data, true);
        $html[] = pagination($tpage, $page, 'onSelectPage');
        $html[] = $tcount;
        echo implode('|||', $html);


    }
    public function add_member_group()
    {
        global $data;
        global $TABLE;

        $this->load->model("user");
        $this->load->model("groups");
        $this->load->model("center");



        $data['page'] = $this->get_post('page', 0);
        $data['seq'] = $this->get_post('seq', 1);
        $data['menuindex'] = array(6, 2);
        $data['centers'] = $this->center->all();



        $data['group'] = $this->groups->get($data['seq']);

        $this->load->admin_view("add_member_group", $data);
    }
    function save_member_group()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        /*$this->form_validation->set_rules('member', 'member', 'required');

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("add_member_group", $data);
        }
        // If validation is successed
        else
        {*/
            try {

                $seq = $this->post("seq", "");
                $member_arr= $this->post("member", "");
                $adminseq= $this->post("adminseq", "");
                $account = $this->auth->getUser();
                foreach ($member_arr as $val) {
                    $this->dbop->update($TABLE['user'], array(
                                            "GroupSeq" => $seq,
                                            "CreateBy" => $adminseq,
                                            "DateModified" => now()
                                        ), array("Seq"=>$val));

                }

                gopage("admin/cgroup/details?page=".$this->post("page", 0).'&seq='.$seq);
            }
            catch (Exception $e) {}
        //}
    }
    function  delete_member_group()
    {
        try {

            global $data;
            global $TABLE;

            $seq = $this->input->post('seq');


            $this->dbop->update($TABLE['user'], array(
                "GroupSeq" => null,
                "CreateBy" => null,
                "DateModified" => null
            ), array("Seq"=>$seq));


        }
        catch (Exception $e) {}
    }

}
