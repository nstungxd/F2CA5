<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include("www/include/global.php");
$data['baseDir'] = $baseDir;

/*
|--------------------------------------------------------------------------
| Administrator Main Controller
|--------------------------------------------------------------------------
| Define administrator main controller
|
*/
class scadmin extends CI_Controller {
var $logged_in_user;
function __construct(){
	parent::__construct();
    
	if (($this->auth->isLoggedIn())&&($this->uri->segment(2)!=='logout')) {
		 return gopage('admin/ccenter');
	}
	$this->load->library('form_validation');
}
/*
|--------------------------------------------------------------------------
| Common functions
|--------------------------------------------------------------------------
| 
|
*/
private function doLogin()
{
	$this->form_validation->set_rules('username', 'UserID','trim|required|callback_cb_idPassword["password"]');
	$this->form_validation->set_rules('password', 'Password','trim|required');
	
	if ($this->form_validation->run($this)==FALSE) {
		return FALSE;
	}else{
		$this->auth->setLoginInfo($this->logged_in_user);
		return gopage('admin/caccount');
	}
}

/***
* Callback for checking email and password. Returns true if there is an email and password combination
* 
* @param mixed $email
* @param mixed $passPostKey
*/
function cb_idPassword($id, $pass) 
{
	$this->load->model('admin');
	$result = $this->admin->confirm($id, $this->input->post('password'));
	if (is_null($result)){
		$this->form_validation->set_message('cb_idPassword', 'Please check User ID and password again.');
		return FALSE;
	}

	// global $TABLE;
	// $sql = "UPDATE ".$TABLE['admin']." SET administrator_count=administrator_count+1, administrator_date='".now()."' WHERE administrator_userid='".$id."'";
	// $this->dbop->execQuery($sql);

	$this->logged_in_user = $result;
	return TRUE;
}

/*
|--------------------------------------------------------------------------
| Basic controller functions
|--------------------------------------------------------------------------
| 
|
*/	
public function index()
{
	// gopage('scadmin/login');
	$this->login();
}

public function login()
{
	global $data;
	if($this->input->post()) {
		$this->doLogin();
	}
	$this->load->admin_view("login", $data);
}

public function logout()
{
	$this->auth->logout();
	gopage('admin');
}

}
?>