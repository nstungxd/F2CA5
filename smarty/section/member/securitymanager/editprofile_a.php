<?php

//sendmail class incude
include(S_SECTIONS."/member/memberaccess.php");
include(SITE_CLASS_GEN."class.sendmail.php");

//initialization of senmail class object
$sendMail=new SendPHPMail;

if(!isset($secManObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.SecurityManager.php');
     $secManObj = new SecurityManager();
}
$iSMID = PostVar("iSMID");
$Data = PostVar("Data");
//prints($_SESSION);exit;
     include(SITE_CLASS_GEN."class.validation.php");
	 $validation=new Validation();


     ### SERVER SIDE VALIDATION ####


         $RequiredFiledArr = array(
                                    'vFirstName'         =>$smarty->get_template_vars('LBL_ENTER_FIRST_NAME'),
                                     'vLastName'          =>$smarty->get_template_vars('LBL_ENTER_LAST_NAME'),
                                      'vCountry'           =>$smarty->get_template_vars('LBL_ENTER_COUNTRY'),
                                     'vState'             =>$smarty->get_template_vars('LBL_ENTER_STATE'),
                                     'vZipcode'           =>$smarty->get_template_vars('LBL_ZIPCODE'),
                                     'vEmail'             =>$smarty->get_template_vars('LBL_EMAIL_ADDRESS'),
                                      'vCity'             =>$smarty->get_template_vars('LBL_ENTER_CITY'),
                                    'vAddressLine1'      =>$smarty->get_template_vars('LBL_ENTER_ADDRESSLINE1'),
             );

	 $resArr = $validation->isEmpty($RequiredFiledArr);
         //prints($resArr);exit;
	          
           if($resArr) {
               //echo "hi"; exit;
		 header("Location:".$_SERVER['HTTP_REFERER']."");
		 exit;
	    }


if(!isset($Data['eEmailNotification']))
     $Data['eEmailNotification']='No';
//prints($Data);exit;
$Data_access = PostVar("Data_access");

$curr_date = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

	$arr = $secManObj->select($iSMID);
	$secManObj->setAllVar($arr);
	$Data	=	array_merge($Data,array("dLastAccessDate" => $curr_date));

//	$sql="select vLanguageCode from b2b_language where vLanguage='".$Data['vDefaltLan']."'";
//	$res=$dbobj->MySQLSelect($sql);
//	$_SESSION['SESS_B2B_LANG'] = $res[0]['vLanguageCode'];
	
	$secManObj->setAllVar($Data);
	$where = " iSMID = '".$iSMID."'";
	$res = $secManObj->update($where);
	
	if($res)$var_msg = "rus";else $var_msg="ruserr.";
     unset($Data);
    $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
     header("Location:".SITE_URL_DUM."editprofile/".$var_msg);
     exit;
?>
