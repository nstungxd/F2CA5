<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $CI =& get_instance();

        if (!$this->auth->isLoggedIn()) {
            gopage('admin');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Common functions
    |--------------------------------------------------------------------------
    | 
    |
    */
    function get($id, $init="")
    {
        $v = $this->input->get($id);
        if ($v == "") $v = $init;
        return $v;
    }

    function post($id, $init="")
    {
        $v = $this->input->post($id);
        if ($v == "") $v = $init;
        return $v;
    }

    function get_post($id, $init="")
    {
        $v = $this->input->get_post($id);
        if ($v == "") $v = $init;
        return $v;
    }
}
