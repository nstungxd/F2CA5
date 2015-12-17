<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Loader extends CI_Loader
{
    function __construct()
    {
        parent::__construct();
    }

    public function admin_view($view, $vars = array(), $return = FALSE)
    {
        $ci = &get_instance();

        $vars["adminseq"] = $ci->auth->getAdminSeq();
        $vars["adminname"] = $ci->auth->getUserName();
        $vars["permission"] = $ci->auth->getPermission();
        $vars["centercode"] = $ci->auth->getCenterCode();
        $vars["UserSeq"] = $ci->auth->getId();

        
        // $currSection = $ci->uri->segment(2);
        
        // $vars['section'] = $currSection;
        // $vars['subsection'] = $ci->uri->segment(3);
        // $vars['section4'] = $ci->uri->segment(4);
        // $vars['section5'] = $ci->uri->segment(5);
        
        $result = '';
        if($ci->uri->segment(2) != null && $ci->uri->segment(2) != 'login')
        {
            // $vars['count_users'] = $ci->users_model->countRows();
            // $user_id = $ci->auth->getUser()->id;
            // $vars['user'] = $ci->users_model->getRecord($user_id);
            
            $result .= $this->_ci_load(array('_ci_view' => 'header', '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        }
        $result .= $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        if($ci->uri->segment(2) != null && $ci->uri->segment(2) != 'login')
        {
            $result .= $this->_ci_load(array('_ci_view' => 'footer', '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        }
        return $result;
    }

}