<?php
if(!isset($bProductOrgObj)) {
   include_once(SITE_CLASS_APPLICATION.'productorganization/class.BProductOrganization.php');
   $bProductOrgObj = new BProductOrganization();
}
include(SITE_CLASS_GEN . "class.sendmail.php");
$sendMail = new SendPHPMail();

//prints($_POST);exit;
$view = PostVar("view");
$Data = PostVar("Data");
/* $dupl = PostVar('dpr');
if(!isset($Data['eEmailNotification'])) {
   $Data['eEmailNotification'] = 'No';
}*/
//$Data_access = PostVar("Data_access");
$iProductId = PostVar("iProductId");
$curr_date = date("Y-m-d h:i:s");
// $iAdminID = $_SESSION['B2B_SESS_USERID'];

/** This is for Check Duplicate Record------------------------------------------- */
$generalobj->getRequestVars();
$redirect_file = "index.php?file=$file&view=$view&iProductId=$iProductId";
$generalobj->checkDuplicate('iProductId', PRJ_DB_PREFIX . "_bproduct_organization", Array('vProductCode' => $Data['vProductCode']), $redirect_file, 'Record Already Exists', $iProductId);
if ($view == "add")
{
   // $Data['dAddedDate'] = date("Y-m-d H:i:s");
   // $Data['vIP'] = $_SERVER[REMOTE_ADDR];
   // $Data['iAdminID'] = $_SESSION['B2B_SESS_USERID'];
   $bProductOrgObj->setAllVar($Data);
   $id = $bProductOrgObj->insert();
   if($id)
   {
       $var_msg = "Record Added Successfully.";
       unset($Data);
       /*// dpr email for duplication of email in rec
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
       }*/
   } else {
      $var_msg = "Eror-in Add.";
   }
} else if ($view == "edit") {
   // $Data = array_merge($Data, array("dLastAccessDate" => $curr_date));
   $where = " iProductId='".$iProductId."'";
   $res = $bProductOrgObj->updateData($Data, $where);
   if ($res) {
      $var_msg = "Record Updated Successfully.";
   } else {
      $var_msg = "Eror-in Update.";
   }
}
header("Location:index.php?file=po-bproductorg&view=index&AX=Yes&var_msg=$var_msg");
exit;
?>