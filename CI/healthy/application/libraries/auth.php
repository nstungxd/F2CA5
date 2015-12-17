<?php
class auth{

	function __construct(){
		$this->ci = &get_instance();
		$this->ci->load->library('session');
	}
    /**
    * Sets login information
    * 
    * @param array $user_info
    */
	function setLoginInfo($user_info){
		$this->ci->session->set_userdata('hl_user',$user_info);
		$this->ci->session->set_userdata('hl_logged_in',true);
	}
    /**
    * Logs a user out
    * 
    * @param mixed 
    */
	function logout($user_info=false) {
		$this->ci->session->unset_userdata('hl_user');
		$this->ci->session->unset_userdata('hl_logged_in');
	}

    /**
    * Gets current user array
    * 
    */
	function getUser(){
		return $this->ci->session->userdata('hl_user');
	}
    
    /**
    * Checks if user is logged in
    * 
    */
	function isLoggedIn(){
		return $this->ci->session->userdata('hl_logged_in');
	}

	function getId(){
		$user = $this->ci->session->userdata('hl_user');
		if ($user != null)
			return $user->Seq;
		return "";
	}

	function getUserName(){
		$user = $this->ci->session->userdata('hl_user');
		if ($user != null)
			return $user->AdminID;
		return "";
	}

	function getCenterCode(){
		$user = $this->ci->session->userdata('hl_user');
		if ($user != null && !is_null($user->CenterCode))
			return $user->CenterCode;
		return "";
	}

	function getPermission(){
		if ($this->isAboveAdmin())
			return "ADMIN";
		else if ($this->isAboveCenter())
			return "CENTER";
		else if ($this->isAboveTrainer())
			return "TRAINER";

		return "";
	}

	function getAdminSeq(){
		$user = $this->ci->session->userdata('hl_user');
		if ($user != null && !is_null($user->AdminSeq))
			return $user->AdminSeq;
		return "";
	}

	function isAboveAdmin(){
		$user = $this->ci->session->userdata('hl_user');
		if ($user != null && $user->Permission == 0)
			return true;
		return false;
	}

	function isAboveCenter(){
		$user = $this->ci->session->userdata('hl_user');
		if ($user != null && ($user->Permission == 0 || $user->Permission == 1))
			return true;
		return false;
	}

	function isAboveTrainer(){
		$user = $this->ci->session->userdata('hl_user');
		if ($user != null && ($user->Permission == 0 || $user->Permission == 1 || $user->Permission == 2))
			return true;
		return false;
	}
}	