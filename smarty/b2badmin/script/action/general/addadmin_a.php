<?php  

/**
 * Action file for add/Update of admin
 *
 * @package		addadmin_a.php
 * @section		action/general
 * @author		Jack Scott
 */
include_once(SITE_CLASS_APPLICATION . 'class.AdminUser.php');
$adminUserObj = new AdminUser();

//prints($_POST);exit;
//prints($Data);exit;
$view = PostVar("view");
$Data = PostVar("Data");
$dupl = PostVar('dpr');
$Data_access = PostVar("Data_access");
$vPassword = md5(PostVar('vPassword'));
$iAdminId = PostVar("iAdminId");
$curr_date = date("Y-m-d h:i:s");
$Data['eType'] = "Premier Admin";
$vPhone1 = PostVar("vPhone1");
$vPhone2 = PostVar("vPhone2");


/* $vMobile1 = PostVar("vMobile1");
  $vMobile2 = PostVar("vMobile2");
  $vMobile3 = PostVar("vMobile3");

  $vFax1 = PostVar("vFax1");
  $vFax2 = PostVar("vFax2");
  $vFax3 = PostVar("vFax3");
 */
$vPhone = $vPhone1 . "-" . $vPhone2 . "-" . $vPhone3;
//$vMobile = $vMobile1."-".$vMobile2."-".$vMobile3;
//$vFax = $vFax1."-".$vFax2."-".$vFax3;

$Data = array_merge($Data, array("vPhone" => $vPhone));
$Data['vMobile'] = $_POST['vMobileCode'] . "-" . $Data['vMobile'];
//$Data	=	array_merge($Data,array("vPhone" => $vPhone,"vMobile" => $vMobile,"vFax" => $vFax));

/** This is for Check Duplicate Record------------------------------------------- */
$generalobj->getRequestVars();
$redirect_file = "index.php?file=$file&view=$view&iAdminId=$iAdminId";
$generalobj->checkDuplicate('iAdminId', PRJ_DB_PREFIX . "_administrator", Array('vUsername' => $Data['vUsername'], 'vEmail' => $Data['vEmail']), $redirect_file, USER_ALREADY_EXISTS, $iAdminId);

if ($view == "add") {
     $Data['dDate'] = date("Y-m-d H:i:s");
     $Data['vFromIP'] = $_SERVER[REMOTE_ADDR];
     $Data['vPassword'] = $vPassword;

     //prints($Data);exit;
     $adminUserObj->setAllVar($Data);
     $id = $adminUserObj->insert();
     if ($id) {
          $var_msg = "Record Added Successfully.";
          $eml = $Data['vEmail'];
          unset($Data);
          // dpr email for duplication of email in rec
          if ($dupl == 'dpl') {
               $emailArr = $adminUserObj->getDetails('vFirstName,vLastName,vEmail', " AND iAdminID !='" . $iAdminID . "'");
               $link = SITE_URL_DUM."b2badmin/index.php?file=ge-admin&view=edit&iAdminId=".$id;
               for ($i = 0; $i < count($emailArr); $i++) {
                    $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                    $email = $emailArr[$i]['vEmail'];

                    //set the values of the body of email format
                    $body_arr = Array("#NAME#", "#REC#", "#EMAIL#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
                    $post_arr = Array($smname, 'Admin', $eml, $link, $MAIL_FOOTER, SITE_URL_DUM);

                    //send mail to the Admin
                    $sendMail->Send("Email Duplication", "Member", $email, $body_arr, $post_arr);
               }
          }
          // dpr email for duplication of email in rec
     } else {
          $var_msg = "Eror-in Add.";
     }
} else if ($view == "edit") {
     $arr = $adminUserObj->select($iAdminId);
     $adminUserObj->setAllVar($arr);

     $Data = array_merge($Data, array("dLastAccess" => $curr_date));

     //prints($Data);exit;
     $adminUserObj->setAllVar($Data);
     $where = " iAdminId = '" . $iAdminId . "'";
     $res = $adminUserObj->update($where);
     if ($res

          )$var_msg = "Record Updated Successfully.";else
          $var_msg="Eror-in Update.";
}

header("Location:index.php?file=ge-admin&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>