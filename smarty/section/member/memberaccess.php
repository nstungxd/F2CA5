<?php
//Include member class
 /*  if(!$memobj)
   {
      require_once(SITE_CLASS_APPLICATION."class.member.php");
      $memobj = new Member();
   }

   $smarty->assign('memobj',$memobj);
*/
   //Check whether the login session created or not
//prints($_SESSION);exit;

   $lgfl_ary = array('','c-logout','c-home','c-aboutus','c-contactus','c-privacypolicy','c-forgotpass','m-getcaptcha','m-aj_chkscode','m-orgregister','u-aj_chkdupdata','or-aj_chkdupdata','c-registrationactivation','m-aj_forgotpass');
   if(SessionVar('SESS_'.PRJ_CONST_PREFIX.'_ID') == '' && !in_array($file,$lgfl_ary))
   {
      $msg = "sessexp";
      header("Location:".SITE_URL_DUM."logout/".$msg);
      exit;
   } else if(SessionVar('SESS_'.PRJ_CONST_PREFIX.'_ID') != '') {
		$mdtls = $usrobj->select($sess_id);
		if($sess_usertype_short == 'SM') {
			if($mdtls[0]['eStatus'] != 'Active') {
				header("Location: ".SITE_URL_DUM."logout");
				exit;
			}
		} else {
			if(($mdtls[0]['eStatus'] == 'Inactive' && $mdtls[0]['eNeedToVerify'] == 'Yes') || $mdtls[0]['eStatus'] == 'Delete') {
				header("Location: ".SITE_URL_DUM."logout");
				exit;
			}
		}
	}

   //$where = " AND iUserId = '".$iAccHolderId."'";
   //$userPlanDetail = $memobj->GetUserPlan($where);

/*
   // GET USER DETAILS
   $UserDetail = $wpmobj->getUserDetails('*,(SELECT SUM(vSize) FROM '.PRJ_DB_PREFIX.'_files WHERE iUserId = "'.$iUserId.'") as totfilesize,(SELECT count(iProjId) FROM '.PRJ_DB_PREFIX.'_project WHERE iAccountHolderId = "'.$iUserId.'") as totProjs',$iUserId,'iUserId');
   //Prints($UserDetail);exit;


   $FinishStorageLimit = 'No';
   $FinishProjectLimit = 'No';
   $FinishCreditLimit = 'No';

   if($userPlanDetail[0][iPlanID] != '4')
   {
      if($userPlanDetail[0]['totbytes'] <= $UserDetail[0]['totfilesize'])
      {
         $FinishStorageLimit = 'Yes';
      }
      if($userPlanDetail[0]['eProjLimit'] != 'Unlimited')
      {
         if($userPlanDetail[0]['eProjLimit'] <= $UserDetail[0]['totProjs'])
         {
            $FinishProjectLimit = 'Yes';
         }
      }
   }
   else
   {
      $iPlanCredits = $userPlanDetail[0]['iCredits'];
      $where_credits =  " AND iUserId = '".$iUserId."'";
      $userCurrentCredits = $memobj->GetUserCurrentCredits($where_credits);
      $remainCredits = $iPlanCredits - $userCurrentCredits;
      if($remainCredits <= 0)
      {
        $FinishCreditLimit = 'Yes';
      }
   }

   //Prints($userPlanDetail);exit;
*/
?>