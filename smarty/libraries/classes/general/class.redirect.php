<?php
/**
 * This Class is useful to check authenticate as well as redirection of files
 * @package		class.redirect.php
 * @general		general
*/

class Redirect
{

	private $usertype;					//user type
	private $AX;								//for ajax file if
	private $file;							//file
	private $view;							//view

	public function __construct(){
	 	$this->usertype = (isset($_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERTYPE']))? $_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERTYPE'] : '';
	}

	/**
	* @access	public
	* @To Redirect a Particular Section wise add/edit/listing files
	* @return	true/false
	*/

	public function getRedirect()
	{
		//extract globals
		extract($GLOBALS);
		// Set usertype
		if(isset($_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERTYPE'])){
			$this->usertype = $_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERTYPE'];
		}else{
			$this->usertype = "";
		}

		//get AX for ajax
		$this->AX = GetVar('AX');

		//set file var
		if(GetVar('file') == '')
			$this->file = "g-home";
		else
			$this->file = GetVar('file');
		$this->view = GetVar('view');
		$this->child = GetVar('child');
		//echo $this->file; exit;
		$pre = explode("-",$this->file);

		if($this->usertype  == '') {
			if($pre[0] == "aj" && ($_GET['file'] == 'aj-auth' || $_GET['file'] == 'aj-fpass')) {
				include_once(SAPATH_ROOT."script/ajax_xml/".$pre[1].".inc.php");
				exit();
			} else {
				//code to redirect to login page
				include_once(SAPATH_ROOT."index1.php");
			}
		} else {

            $fromLogin=(isset($_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN']))?$_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN']:"";
            unset( $_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN']);
            if($fromLogin == 'YES') {
                 if($_SERVER[HTTP_REFERER] != '') {
                 header("Location:".$_SERVER[HTTP_REFERER]);
                 exit;
                 }
            }

		 		if($this->AX == "Yes" && $this->view == 'index') {
					$script = SAPATH_ROOT."script/general/aj_list.inc.php";
				} else if($pre[0] == "aj") {
					include_once(SAPATH_ROOT."script/ajax_xml/".$pre[1].".inc.php");
					exit();
				} else if($this->view == 'edit' ||$this->view == 'add') {
					switch($pre[0]){
						case "se":
								$script = SAPATH_ROOT."script/main/security_manager/add".$pre[1].".inc.php";
								break;
                  case "po":
								$script = SAPATH_ROOT."script/main/productorganization/add".$pre[1].".inc.php";
								break;
						default:
								$script = SAPATH_ROOT."script/main/general/add".$pre[1].".inc.php";
								break;
					}
				} else if($this->view == 'action') {
					switch($pre[0]) {
					   case "se":
								$script = SAPATH_ROOT."script/action/security_manager/add".$pre[1]."_a.php";
								break;
						case "po":
								$script = SAPATH_ROOT."script/action/productorganization/add".$pre[1]."_a.php";
								break;
						default:
								$script = SAPATH_ROOT."script/action/general/add".$pre[1]."_a.php";
								break;
					}
				} else if($pre[0] == "se") {
					include_once(SAPATH_ROOT."script/main/security_manager/".$pre[1].".inc.php");
					exit();
				} else if($pre[0] == "po") {
					include_once(SAPATH_ROOT."script/main/security_manager/".$pre[1].".inc.php");
					exit();
				} else if ($pre[0] == "gen") {
					include_once(SAPATH_ROOT."script/general/".$pre[1].".inc.php");
					exit();
				} else {
					header("Location:index.php?file=ge-home&view=edit&AX=Yes");
					exit;
				}
				include_once("index2.php");
				exit();
		}
	}
}
?>