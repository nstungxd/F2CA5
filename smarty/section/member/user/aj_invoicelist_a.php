<?php

include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_POST['mode'];
	$val = $_POST['val'];
     //prints($_POST); exit;

     if(!isset($orgObj)) {
          require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
          $orgObj = new Organization();
     }
     if(!isset($invObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
		$invObj = new InvoiceOrderHeading();
     }
     if(!isset($emailObj)) {
          include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
          $emailObj = new EmailTemplate();
     }
     if(!isset($sendMail)) {
          include_once(SITE_CLASS_GEN."class.sendmail.php");
          $sendMail = new SendPHPMail();
     }
     if(!isset($orgUserObj)) {
        include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUser.php');
        $orgUserObj = new OrganizationUser();
    }

$sess_user_name = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_NAME'];
$sess_usertype_short = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];

if(!isset($userActionObj)) {
	  include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
	  $userActionObj = new UserActionVerification();
}
   if($mode == 'delete'){

          $where = "AND iInvoiceID IN ($val)";
          //$fields="ioh.*,(select org.vCompanyName from b2b_organization_master org where org.iOrganizationID=ioh.iBuyerOrganizationID) as vBuyerName";
          $fields="*";

          $arr = $invObj->getJoinTableInfo("",$fields,$where);
          $userId=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
          $orgId=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID'];
          $where=" AND iOrganizationID='$orgId'";

          $emailArr= $orgUserObj->getDetails('vFirstName,vLastName,vEmail',$where);
          $where="";
          foreach($arr as $k=>$v) {
                    $data['eDelete'] = 'Yes';
                    $data['iModifiedByID'] = $userId;
                //    $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
                  //  $data['dModifiedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                    $invObj->setAllVar($data);
                    $where = "iInvoiceID IN (".$v['iInvoiceID'].")";
                    $res = $invObj->updateData($data, $where);

                    $link = SITE_URL_DUM."invoiceview/".$v['iInvoiceID'];
                    $INVCODE=$v['vInvoiceCode'];
                    $INVNUMBER=$v['vInvoiceNumber'];;
                    $SUPPLIER=$v['vSupplierName'];
                    if($SUPPLIER == '')
                        $SUPPLIER = "---";
                    $BUYER=$v['vBuyerName'];

                    $where = "AND vType='Invoice Deleted' AND eSection='Member'" ;
                    $db_email = $emailObj->getDetails('*',$where);

                   $body = Array("#DELETE_BY#","#INVNUMBER#","#INVCODE#","#SUPPLIER#","#BUYER#","#LINK#");
                   $post = Array($sess_user_name."($sess_usertype_short)",$INVNUMBER,$INVCODE,$SUPPLIER,$BUYER,$link);

                   $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
                   $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
                   $emailContent_en = trim(str_replace($body,$post, $tbody_en));
                   $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
                   $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

                   $dt['iItemID'] = $v['iInvoiceID'];
                   $dt['eType'] = 'Delete';
                   $dt['iOrganizationID'] = $orgId;
                   $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
                   $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
                   $dt['tMailContent_en'] = $emailContent_en;
                   $dt['tMailContent_fr'] = $emailContent_fr;
                   $dt['iCreatedBy'] = $userId;
                   $dt['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
                   $dt['eSubject'] = "PO";
                   $dt['dActionDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

                    // if((is_array($emailArr) && count($emailArr) > 0) || (is_array($usrarr) && count($usrarr)>0)) {
                   $userActionObj->setAllVar($dt);
                    // pritns($dt); exit;
                   $userActionObj->insert();


                    $where = 'AND vType="Invoice Deleted" AND eSection = "Member"' ;
                    $db_email = $emailObj->getDetails('*',$where);
                    $link = SITE_URL_DUM."invoiceview/".$v['iInvoiceID'];



                    for($i=0;$i<count($emailArr);$i++)
                    {
                          $smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
                          $email = $emailArr[$i]['vEmail'];

                          $body_arr = Array("#SMNAME#","#INVNUMBER#","#INVCODE#","#SUPPLIER#","#BUYER#","#LINK#","#DELETE_BY#","#MAIL_FOOTER#","#SITE_URL#");
                          $post_arr = Array($smname,$INVNUMBER,$INVCODE,$SUPPLIER,$BUYER,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
                          $sendMail->Send("Invoice Deleted","Member",$email,$body_arr,$post_arr);
                    }
                    unset($Data);
                    unset($_POST);

                    if($res)$var_msg = $smarty->get_template_vars('MSG_DEL_SENT_SUCC');else$var_msg = $smarty->get_template_vars('MSG_DEL_SENT_ERR');

          }
   }
     echo $var_msg;
     exit;
?>
