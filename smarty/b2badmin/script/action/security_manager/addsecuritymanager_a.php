<?php

/**
 * Action file for add/Update of securitymanager
 *
 * @package		addsecuritymanager_a.php
 * @section		action/security_manager
 * @author		Jack Scott
 */
//sendmail class incude
include(SITE_CLASS_GEN . "class.sendmail.php");

//initialization of senmail class object
$sendMail = new SendPHPMail;

if (!isset($secManObj)) {
     include_once(SITE_CLASS_APPLICATION . 'securitymanager/class.SecurityManager.php');
     $secManObj = new SecurityManager();
}

if (!isset($adminUserObj)) {
     include_once(SITE_CLASS_APPLICATION . 'class.AdminUser.php');
     $adminUserObj = new AdminUser();
}

//prints($_POST);exit;
// print_r($Data);exit;
$view = PostVar("view");
$Data = PostVar("Data");
$dupl = PostVar('dpr');
if (!isset($Data['eEmailNotification']))
     $Data['eEmailNotification'] = 'No';

$Data_access = PostVar("Data_access");
$vPassword = $generalobj->encrypt(PostVar('vPassword'));

$iSMID = PostVar("iSMID");
$curr_date = date("Y-m-d h:i:s");
$iAdminID = $_SESSION['B2B_SESS_USERID'];

/** This is for Check Duplicate Record------------------------------------------- */
$generalobj->getRequestVars();
$redirect_file = "index.php?file=$file&view=$view&iSMID=$iSMID";
$generalobj->checkDuplicate('iSMID', PRJ_DB_PREFIX . "_security_manager", Array('vUserName' => $Data['vUserName']), $redirect_file, USER_ALREADY_EXISTS, $iSMID);
if(isset($Data['vAnswer']) && trim($Data['vAnswer'])!='##########') {
   $Data['vAnswer'] = trim($Data['vAnswer']);
} else { unset($Data['vAnswer']); }
if(isset($Data['vAnwser']) && trim($Data['vAnwser'])!='##########') {
   $Data['vAnwser'] = trim($Data['vAnwser']);
} else { unset($Data['vAnwser']); }
if ($view == "add") {
     $Data['dAddedDate'] = date("Y-m-d H:i:s");
     $Data['vIP'] = $_SERVER['REMOTE_ADDR'];
     $Data['iAdminID'] = $_SESSION['B2B_SESS_USERID'];
     $Data['vPassword'] = $vPassword;

     //prints($Data);exit;
     $secManObj->setAllVar($Data);
     $id = $secManObj->insert();

     if ($id) {
          $var_msg = "Record Added Successfully.";
          $NAME = $Data['vFirstName'] . " " . $Data['vLastName'];

          $link = $Data['vEmail'];
          $password = PostVar('vPassword');

          //set the values of the body of email format
          $body_arr = Array("#NAME#", "#SITE_NAME#", "#USERNAME#", "#EMAIL#", "#MAIL_FOOTER#", "#SITE_URL#");

//		$admins = $adminUserObj->getDetails('*'," AND eStatus='Active' AND iAdminId!=".$_SESSION['B2B_SESS_USERID']);
//		for($l=0;$l<count($admins);$l++)
//		{
          $post_arr = Array($NAME, $SITE_NAME, $Data['vUserName'], $link, $MAIL_FOOTER, SITE_URL_DUM);
          //send mail to the Admins
          $sendMail->Send("New Security Manager Added", "Admin", $ADMIN_EMAIL, $body_arr, $post_arr);
//		}
          //set the values of the body of email format
          $body_arr = Array("#NAME#", "#SITE_NAME#", "#USERNAME#", "#PASSWORD#", "#EMAIL#", "#MAIL_FOOTER#", "#SITE_URL#");
          $post_arr = Array($NAME, $SITE_NAME, $Data['vUserName'], $password, $link, $MAIL_FOOTER, SITE_URL_DUM);
          // prints($post_arr); exit;
          //send mail to the desired member
          $sendMail->Send("Registration", "Member", $link, $body_arr, $post_arr);
          $eml = $Data['vEmail'];
          unset($Data);

          // dpr email for duplication of email in rec
          if ($dupl == 'dpl') {
               $emailArr = $adminUserObj->getDetails('vFirstName,vLastName,vEmail', " AND iAdminID !='" . $iAdminID . "'");
                $link = SITE_URL_DUM."b2badmin/index.php?file=se-securitymanager&view=edit&iSMID=".$id;
               for ($i = 0; $i < count($emailArr); $i++) {
                    $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                    $email = $emailArr[$i]['vEmail'];

                    //set the values of the body of email format
                    $body_arr = Array("#NAME#", "#REC#", "#EMAIL#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
                    $post_arr = Array($smname, 'Securiy Manager', $eml, $link, $MAIL_FOOTER, SITE_URL_DUM);

                    //send mail to the Admin
                    $sendMail->Send("Email Duplication", "Member", $email, $body_arr, $post_arr);
               }
          }

     } else {
          $var_msg = "Eror-in Add.";
     }
} else if ($view == "edit") {
     $arr = $secManObj->select($iSMID);
     /* 	$dif = array_diff($Data, $arr[0]);
       if(count($dif) > 0)
       {
       if(!(count($dif) == 1 && $Data['eVerify'] == 'Verified'))
       {
       $Data['eVerify'] = 'Modified';
       $Data['iAdminID'] = $_SESSION['B2B_SESS_USERID'];
       }
       }
      */
     $pass = $generalobj->encrypt($Data['vPassword']);
     $Data['vPassword'] = $pass;
     $Data = array_merge($Data, array("dLastAccessDate" => $curr_date));
     $where = " iSMID = '" . $iSMID . "'";
     $res = $secManObj->updateData($Data, $where);
     if ($res) {
          $var_msg = "Record Updated Successfully.";
          /* 		$body_arr = Array("#NAME#","#SITE_NAME#","#USERNAME#","#MAIL_FOOTER#","#SITE_URL#");
            $admins = $adminUserObj->getDetails('*'," AND eStatus='Active' AND iAdminId!=".$_SESSION['B2B_SESS_USERID']);
            for($l=0;$l<count($admins);$l++)
            {
            $post_arr = Array($NAME,$SITE_NAME,$arr[0]['vUserName'],$MAIL_FOOTER,SITE_URL_DUM);
            //send mail to the Admins
            $sendMail->Send("Security Manager Details Changed","Admin",$admins[$l]['vEmail'],$body_arr,$post_arr);
            }
           */
     } else {
          $var_msg = "Eror-in Update.";
     }
}

header("Location:index.php?file=se-securitymanager&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>