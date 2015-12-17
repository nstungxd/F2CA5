<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include("www/include/global.php");
$data['baseDir'] = $baseDir;
$data['cpp'] = $cpp;
$data['menuindex'] = 10;

/*
|--------------------------------------------------------------------------
| Customer controller for Inzone Management Sites
|--------------------------------------------------------------------------
|
| Description
|
*/
class ccategory extends MY_Controller {

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
    public function lists_category()
    {
	    global $data;
        global $TABLE;

        
        $data["page"] = $this->get_post("page", 0);
        $data['menuindex'] = array(2, 1);
        

        $this->load->admin_view("category", $data);
    }
     public function search_category()
    {
        global $data;
        global $TABLE;

        $page = $this->input->post('page');
        $keyvalue = $this->input->post('keyvalue', "");
        


        // Make SQL
        $where = '1';

        if ($keyvalue != "")
            $where = $where . ' AND ((A.Name LIKE \'%' . $keyvalue . '%\') OR (B.Name LIKE \'%' . $keyvalue . '%\') OR (C.Name LIKE \'%' . $keyvalue . '%\'))';

        $sql = sprintf('
		SELECT
			A.Seq,A.Name,A.CreateBy,A.DateModified,C.Name as NameCreateby
		FROM
			%s AS A
		LEFT JOIN %s as C on C.Seq =A.CreateBy
		WHERE %s
		ORDER BY
			A.Name',
            $TABLE['category'],
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

        $html[] = $this->load->view('items/list_category', $data, true);
        $html[] = pagination($tpage, $page, 'onSelectPage');
        $html[] = $tcount;
        echo implode('|||', $html);


    }
    public function categoryregister()
    {
        global $data;
        global $TABLE;

        $data['page'] = $this->get_post('page', 0);
        $data['menuindex'] = array(2, 1);
        
        $this->load->admin_view("category_register", $data);
    }
    public function categorymodify()
    {
        global $data;
        global $TABLE;

        
        $this->load->model("category");

        $seq = $this->get_post("seq");

        $data['page'] = $this->get_post('page', 0);
        $data['menuindex'] = array(2, 1);
        

        $data['category'] = $this->category->get($seq);


        $this->load->admin_view("category_register", $data);
    }

    function register_category()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('Name', 'Name', 'required');
        

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("category_register", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->dbop->insert($TABLE['category'], array(
                    "Name" => $this->post("Name", ""),
                    "CreateBy" => $this->post("adminseq", ""),
                    "DateModified" => now()
                ));

                gopage("admin/ccategory/lists_category?page=".$this->post("page", 0));
            }
            catch (Exception $e) {}
        }
    }
    function modify_category()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('Name', 'Name', 'required');
        

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("category_register", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->post("cseq", "");

                $this->dbop->update($TABLE['category'], array(
                        "Name" => $this->post("Name", ""),
                        "CreateBy" =>$this->post("adminseq", ""),
                        "DateModified" => now()
                    ), array("Seq"=>$seq));

                gopage("admin/ccategory/lists_category?page=".$this->post("page", 0));
            }
            catch (Exception $e) {}
        }
    }
    function delete_category()
    {
        global $data;
        global $TABLE;

        $seq = $this->input->post('seq');
        if ($this->dbop->count($TABLE['exercise'], array('Type' => $seq)) > 0)
        {
            echo "Category have been used in exercise. Delete failed";
        }
        else if ($this->dbop->count($TABLE['category_detail'], array('CategorySeq' => $seq)) > 0)
        {
            echo "Category have exist value. Delete failed";
        }
        else $this->dbop->delete($TABLE['category'], array("Seq" => $seq));
    }
    function details()
    {
        global $data;
        global $TABLE;

        $seq = $this->get_post("seq");

        //$this->load->model("center");
        $data["page"] = $this->get_post("page", 0);
        $data['menuindex'] = array(2, 1);
        $data["seq"] = $seq;
        //$data['centers'] = $this->center->all();

        $this->load->admin_view("category_member", $data);


    }
    public function search_category_member()
    {
        global $data;
        global $TABLE;

        $page = $this->input->post('page');
        $seq = $this->input->post('seq');
        $keyvalue = $this->input->post('keyvalue', "");


        // Make SQL
        $where = 'A.CategorySeq = '.$seq;

        if ($keyvalue != "")
            $where = $where . ' AND ((A.Name LIKE \'%' . $keyvalue . '%\')';

        $sql = sprintf('
		SELECT
			A.Seq,A.Name,A.DateModified
		FROM
			%s AS A
		WHERE %s
		ORDER BY
			A.Name',
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

        $html[] = $this->load->view('items/list_category_member', $data, true);
        $html[] = pagination($tpage, $page, 'onSelectPage');
        $html[] = $tcount;
        echo implode('|||', $html);


    }
    public function add_member_category()
    {
        global $data;
        global $TABLE;

        
        $this->load->model("category");



        $data['page'] = $this->get_post('page', 0);
        $data['seq'] = $this->get_post('seq', 1);
        $data['menuindex'] = array(2, 1);


        $data['category'] = $this->category->get($data['seq']);

        $this->load->admin_view("add_member_category", $data);
    }
    function save_member_category()
    {
        global $data;
        global $TABLE;

        // Set validation rules
        $this->form_validation->set_rules('member', 'member', 'required');

        // If validation is failed
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->admin_view("add_member_category", $data);
        }
        // If validation is successed
        else
        {
            try {

                $seq = $this->post("seq", "");
                $member= $this->post("member", "");
                $adminseq= $this->post("adminseq", "");
                

                $this->dbop->insert($TABLE['category_detail'], array(
                    "Name" => $member,
                    "CategorySeq" => $seq,
                    "DateModified" => now()
                ));

                gopage("admin/ccategory/details?page=".$this->post("page", 0).'&seq='.$seq);
            }
            catch (Exception $e) {}
        }
    }
    function delete_member_category()
    {
        try {

            global $data;
            global $TABLE;

            $seq = $this->input->post('seq');
            if ($this->dbop->count($TABLE['workout_detail'], array('Input1' => $seq)) > 0)
            {
                echo "Workout have been used this type. Delete failed";
            }
            else if ($this->dbop->count($TABLE['workout_detail'], array('Input2' => $seq)) > 0)
            {
                echo "Workout have been used this type. Delete failed";
            }
            else if ($this->dbop->count($TABLE['workout_detail'], array('Input3' => $seq)) > 0)
            {
                echo "Workout have been used this type. Delete failed";
            }
            else $this->dbop->delete($TABLE['category_detail'], array("Seq" => $seq));
        }
        catch (Exception $e) {}
    }
    
}
?>