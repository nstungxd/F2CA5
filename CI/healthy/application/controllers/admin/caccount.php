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
class caccount extends MY_Controller {

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
	$this->myaccount();
}

public function myaccount()
{
	global $data;
	global $TABLE;

	$data['account'] = $this->auth->getUser();
	$data['menuindex'] = array(1, 1);

	$this->load->admin_view("myaccount", $data);
}

/*
|--------------------------------------------------------------------------
| Modelling functions
|--------------------------------------------------------------------------
| 
|
*/
function change_account()
{
	global $TABLE;

	$oldpwd = $this->get_post("oldpwd", "");
	$newpwd = $this->get_post("newpwd", "");

	$account = $this->auth->getUser();
	if ($account->AdminPW == $oldpwd) {
		$this->dbop->update($TABLE['admin'], array(
			"AdminPW" => $newpwd
		), array("Seq"=>$account->Seq));
	}
	else {
		echo "The password is not correct.";
	}
}
}
?>