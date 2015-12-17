<?php
class Member
{
	//intialiaze here class variables and functions
	public function __construct() { }

	/**
   * Function::checkauthentication()
	 * get message information.
	*/
	public function checkauthentication($vUserName,$Password,$memtype='',$table='',$iPrId='iUserId',$orgcode='')
	{
		global $dbobj,$generalobj;
		$cndt = '';
		$extfield = '';
		if($table == '') {
		 $table = PRJ_DB_PREFIX."organization_user";
      }
		if($orgcode != '' && $memtype == 'orguser') {
			$cndt = " AND iOrganizationID=(Select iOrganizationID from ".PRJ_DB_PREFIX."_organization_master where vCompCode='".$orgcode."')";
			$extfield = ",eUserType,iOrganizationID, (SELECT eOrganizationType FROM ".PRJ_DB_PREFIX."_organization_master WHERE vCompCode='".$orgcode."') AS eOrganizationType ";
      }

      $sql = "SELECT $iPrId,vFirstname,vLastname,vEmail,vUserName,vPassword,eStatus,vDefaltLan $extfield FROM $table WHERE vUserName = '".$vUserName."' AND vPassword = '".$Password."' $cndt";
        
      // echo $sql; exit;
		$db_sql = $dbobj->MySQLSelect($sql);
      // prints($db_sql);exit;
		//$sql = "SELECT bl.vLanguageCode FROM b2b_security_manager as bsm, b2b_language as bl WHERE bsm.vUserName = '".$vUserName."' and bsm.vDefaltLan = bl.vLanguage";
		//$db_sql1= $dbobj->MySQLSelect($sql);
		if(count($db_sql) > 0) {
		   if($db_sql[0]['vActivationCode'] != "") {
                 $success =  "3";
			} else if($db_sql[0]['eStatus'] == "Inactive" || $db_sql[0]['eStatus'] == "Need to Verify") {
				$success=  "2";
			} else if($db_sql[0]['eStatus'] == "Block") {
				$success=  "4";
			} else {
				$success=  "1";
				if($table == PRJ_DB_PREFIX."_organization_user") {
					$chksql = "Select * from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=".$db_sql[0]['iOrganizationID'];
					$chkdt = $dbobj->MySQLSelect($chksql);
					if(is_array($chkdt) && count($chkdt)>0 && !($chkdt[0]['eStatus']=='Inactive' || $chkdt[0]['eStatus']=='Need to Verify'))
					{
						$success = "1";
					} else {
						if($chkdt[0]['eStatus']=='Need to Verify') {
							$success = "2";
						} else {
							$success = "4";
						}
					}
				}
				if(isset($db_sql[0]['eOrganizationType']) && $db_sql[0]['eOrganizationType']=='Buyer2') { 	// && isset($db_sql[0]['eUserType']) && $db_sql[0]['eUserType']=='User'
					// if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION!='Yes')
					// $success=  "4";
				}
				// echo $success; exit;
				if($success == "1")
				{
					$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']	= $db_sql[0][$iPrId];
					$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_NAME'] = $db_sql[0]['vFirstname']." ".$db_sql[0]['vLastname'];
					$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_EMAIL'] = $db_sql[0]['vEmail'];
					$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'] = $db_sql[0]['vUserName'];
					$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'] = $memtype; // $db_sql[0]['eAccountType'];
					$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'] = $db_sql[0]['vDefaltLan'];
					$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID'] = $db_sql[0]['iOrganizationID'];
					$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE'] = (isset($db_sql[0]['eOrganizationType']))? $db_sql[0]['eOrganizationType'] : '';
					if($memtype=='securitymanager') {
						$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USRTYPE'] = 'SM';
						$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE'] = 'SM';
					} else {
						if(isset($db_sql[0]['eUserType']) && $db_sql[0]['eUserType']=='Admin') {
							$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USRTYPE'] = 'OA';
						} else if(isset($db_sql[0]['eUserType']) && $db_sql[0]['eUserType']=='User') {
							$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USRTYPE'] = 'OU';
						}
					}

					switch($memtype){
						case 'orguser':
							if($db_sql[0]['eUserType'] == 'Admin') {
								$mtytpe = 'OA';
							} else {
								$mtytpe = 'OU';
							}
							break;
						case 'securitymanager':
							$mtytpe = 'SM';
							break;
					}

					$Data = array(
								'iAdminId'		=> $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'],
								'vName'			=> $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_NAME'],
								'vUsername'		=> $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'],
								'vSessionId' 	=> session_id(),
								'vIP'			   => $_SERVER['REMOTE_ADDR'],
								'dLoginDate'	=> calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s'),
								'eType'        => $mtytpe
							);
					  $iLogsId = $dbobj->MySQLQueryPerform(''.PRJ_DB_PREFIX.'_login_history',$Data,'insert');
					  $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LOG_ID'] = $iLogsId;
				}
 /*				$sql = "UPDATE $table SET dLastAccessDate ='".calcGTzTime(date('Y-m-j H-i-s'), 'Y-m-j H-i-s')."',
						 	iTotLogin = iTotLogin+1
							WHERE $iPrId = '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
					$dbobj->sql_query($sql);
 */
			}
		}
		else
		{
			$success=  "0";
		}
		return $success;
	}

	/**
     * Function::forgotpassword()
	 * get message information.
	 * added by Dipak Mewada
	 */
	//retirve password for forgot password func. of member
	public function forgotpassword($tableName,$iPrimaryId,$where,$orderby='')
	{
		global $dbobj;
		if($where =='')
			$where = "1=1";
		if($orderby!='')
			$order = 'ORDER BY '.$orderby.'';
			$listField = $dbobj->MySQLGetFields($tableName);
			$sql = "SELECT $iPrimaryId FROM $tableName where $where $order";
		$dbres = $dbobj->MySQLSelect($sql);
		return $dbres;
	}
	/**
     * Function::CheckPassword()
	 * added by Gautam Kevadia
	 */
	public function CheckPassword($oldPass,$id)
	{
		global $dbobj;
		$where = " WHERE vPassword = '".$oldPass."' AND iMemberId   = '".$id."'";
		$sql = "SELECT iMemberId as id FROM  ".PRJ_DB_PREFIX."_member ".$where."";
		$db_sql = $dbobj->MySQLselect($sql);
		return $db_sql;
	}
	/**
     * Function::getUserInfo()
	 * get all user information
	 * added by pradip kumar dash
	 */
	function getUserdetail($tablename,$fields,$primeid,$id)
	{
		global $dbobj;
		$sql = "SELECT ".$fields." FROM ".$tablename." where ".$primeid." = '".$id."' AND eStatus = 'Active'";
		//echo $sql;exit;
		$dbres = $dbobj->MySQLSelect($sql);
		return $dbres;
	}

  /**
   * Function::getmsginfo()
	 * get message information.
	 * added by pradip kumar dash
	 */
	public function getmsginfo($iMailId)
	{
		global $dbobj;
		$sql = "SELECT iMailId,iFromId,eFromType,iToId,eToType,vSubject,lBody,dMaildate,eRead  FROM ".PRJ_DB_PREFIX."_inbox WHERE iToId  = '".SessionVar(''.PRJ_CONST_PREFIX.'_SESS_USERID')."'  AND iMailId= '".$iMailId."' ";
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

  /**
   * Function::getsentmailinfo()
	 * get sent mail information.
	 * added by pradip kumar dash
	 */
	public function getsentmailinfo($iMailId)
	{
		global $dbobj;
		$sql = "SELECT iMailId,iFromId,eFromType,iToId,eToType,vSubject,lBody,dMaildate,eRead  FROM ".PRJ_DB_PREFIX."_inbox WHERE iFromId  = '".SessionVar(''.PRJ_CONST_PREFIX.'_SESS_USERID')."'  AND iMailId= '".$iMailId."' ";
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

  /**
   * get messages of the logged in member
  **/
	public function getmembermessage($var_limit)
	{
		global $dbobj;
		if($var_limit){
			$limit = $var_limit;
		}else{
			$limit = "";
		}

		$sql = "SELECT iMailId,iFromId,eFromType,iToId,eToType,vSubject,lBody,dMaildate,eRead
				FROM ".PRJ_DB_PREFIX."_inbox WHERE iToId  = '".SessionVar(''.PRJ_CONST_PREFIX.'_SESS_USERID')."' $limit ";
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

  //get the member sentmail
	public function getmembersentmail($var_limit)
	{
		global $dbobj;
		if($var_limit){
			$limit = $var_limit;
		}else{
			$limit = "";
		}

		$sql = "SELECT iMailId,iFromId,eFromType,iToId,eToType,vSubject,lBody,dMaildate,eRead
				FROM ".PRJ_DB_PREFIX."_inbox WHERE iFromId  = '".SessionVar(''.PRJ_CONST_PREFIX.'_SESS_USERID')."' $limit ";
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

  //get the member sentmail
	public function getmembersentmailinfo($iMailId)
	{
		global $dbobj;
		$sql = "SELECT iMailId,iFromId,eFromType,iToId,eToType,vSubject,lBody,dMaildate,eRead  FROM ".PRJ_DB_PREFIX."_inbox WHERE iFromId  = '".SessionVar(''.PRJ_CONST_PREFIX.'_SESS_USERID')."'  AND iMailId= '".$iMailId."' ";
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}


  /**
     * Function::ChkMemType()
	 * Check member access page according to is type(Member/Customer)
	 * added by Andrew Dev
	 */
	function ChkMemType($type){
		if(SessionVar(''.PRJ_CONST_PREFIX.'_SESS_USERTYPE') != $type){
			$msg = "notauthorized";
			header("Location:".SITE_URL_DUM."notauthorised");
			exit;
		}
	}


	//check whether the email is already exist
	public function checknewsletttermail($email)
	{
		global $dbobj;
		$sql = "SELECT iNletterId  FROM ".PRJ_DB_PREFIX."_newsletter WHERE vEmail  = '".$email."' ";
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

	//get subscribe to newsletter email
	public function subscribenewsletter($email)
	{
		global $dbobj;
		$data['vEmail'] = $email;
		$data['dAddeddate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		$ID  = $dbobj->MySQLQueryPerform(''.PRJ_DB_PREFIX.'_newsletter',$data);
		if($ID)
			return "true";
		else
			return "false";
	}
	function GetAllSecuityQuestion()
	{
		global $dbobj;

		$sql = "SELECT iQuestionId,vQuestion,eStatus  FROM  ".PRJ_DB_PREFIX."_seq_question where eStatus = 'Active' order by vQuestion ASC";
		$db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
	}
	function GetTestimonial($file)
	{
		global $dbobj;
	   if($file == 'left'){
	    $sql = "SELECT iTestimonialId,vName,tDesc,vAddress,eDisplayHome,iDisplayOrder,eStatus  FROM  ".PRJ_DB_PREFIX."_testimonial
      where eStatus = 'Active' and eDisplayHome ='Yes' order by dAddedDate ASC LIMIT 0,1";
     }else{
      $sql = "SELECT iTestimonialId,vName,tDesc,vAddress,eDisplayHome,iDisplayOrder,eStatus  FROM  ".PRJ_DB_PREFIX."_testimonial
      where eStatus = 'Active' order by dAddedDate ASC";
     }

		$db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

	public function SendComment($memname,$Data_mail,$MAIL_FOOTER)
	{
	  $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
					      <body>
					      <table width="610" border="0" cellspacing="0" cellpadding="0" style="border:3px solid #2C5CBA;">
                <tr>
                    <td height="83" background="'.SITE_IMAGES.'email-top-img.gif" align="center"><img src="'.SITE_IMAGES.'email-logo.gif" alt=""/></td>
                </tr>
                <tr>
                    <td style="padding:15px;">

                        <table width="100%" border="0" class="bmatter" align="center" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="padding-left:5px">Dear '.$memname.' ,</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td width="100%" colspan="3">'.nl2br($Data_mail).'</td>
                                </tr>
                            </td>
                        </tr>
                        <tr>
                          <td colspan="3"><strong>Regards,<br /></br style="line-height:15px">'.$MAIL_FOOTER.'</strong></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="25"><strong>'.SITE_URL_DUM.'</strong></td>
                        </tr>
                        </table>
                    </td>
                 </tr>
                 </table>
					      </body>
					       </html>';

			return $body;
  }


	function GetAllMembers(){
		global $dbobj;
		$sql = "SELECT iMemberId,concat(vFirstname,' ',vLastname) as name,vEmail,eStatus
				FROM ".PRJ_DB_PREFIX."_member
				WHERE eStatus = 'Active'
				AND eMemberType = 'Regular'";
		$db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

   function GetAllPlan($where=""){
      global $dbobj;
		$sql = "SELECT iPlanId,vTitle,eProjLimit,eFullSuiteTools,vStorage,eTopUpanytime,tDesc,vPrice,vFrontClass,eStatus,
            (vStorage * 1024 * 1024 * 1024) as totbytes
				FROM ".PRJ_DB_PREFIX."_plan
				WHERE eStatus = 'Active'
            ".$where."
            ORDER BY iPlanId";
      //echo $sql;
		$db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
   }

   public function GetUserPlan($where=""){
      global $dbobj;
		$sql = "SELECT up.iUserId,up.iPlanID,up.iCredits,up.iMPlanID,up.ePaymentStatus,up.vCardHolderName,up.vAddress1,up.vAddress2,up.vPostCode,p.vTitle,p.eProjLimit,p.eFullSuiteTools,p.vStorage,p.eTopUpanytime,p.vPrice,
               up.ePaymentStatus,up.dPurchaseDate,up.dStartDate,up.dEndDate,up.transId,DATEDIFF(up.dEndDate,NOW()) as daysleft,
               (vStorage * 1024 * 1024 * 1024) as totbytes
   				FROM ".PRJ_DB_PREFIX."_user_plan up,".PRJ_DB_PREFIX."_plan p
   				WHERE (up.ePaymentStatus = 'Paid' OR up.ePaymentStatus = 'Free Trial')
               AND p.iPlanId = up.iPlanId
               ".$where."
               ORDER BY up.iMPlanID DESC";
      //echo $sql;exit;
      $db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
   }

   public function getUserTax($where=""){
      global $dbobj;
		$sql = "SELECT iTaxId,vTitle,iPercentage
   				FROM ".PRJ_DB_PREFIX."_tax_rates tr
   				WHERE eStatus = 'Active'
               ".$where."
               ORDER BY iTaxId ASC";
      //echo $sql;exit;
      $db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
   }

   public function chkUserAccountExists($accountname) {
     global $dbobj;
      $sql = "SELECT iUserId,vFirstname,vLastname,vEmail,vUserName,vPassword,eStatus
              FROM ".PRJ_DB_PREFIX."_user
              WHERE vUserName = '".$accountname."'";
      $db_sql= $dbobj->MySQLSelect($sql);
      return  $db_sql;
   }

   public function GetUserCurrentCredits($where)
	{
      global $dbobj;
      $sql_u  = "SELECT vProjId FROM wpm_user WHERE 1 ".$where."";
      $db_sql_u= $dbobj->MySQLSelect($sql_u);
      $iProjIds =  $db_sql_u[0]['vProjId'];
      $iCredits = '0';
      if($iProjIds != '') {
         $sql = "SELECT
                  (SELECT COUNT(iInvoiceId) FROM ".PRJ_DB_PREFIX."_invoice WHERE iProjectId IN (".$iProjIds."))*(SELECT iCredits FROM wpm_tool_type WHERE vType = 'Invoice') as invoicetot,
                  (SELECT COUNT(iDiscussionId) FROM ".PRJ_DB_PREFIX."_discussion WHERE iProjectId IN (".$iProjIds."))*(SELECT iCredits FROM wpm_tool_type WHERE vType = 'Discussion') as discussiontot,
                  (SELECT COUNT(iEstimateId) FROM ".PRJ_DB_PREFIX."_estimate WHERE iProjectId IN (".$iProjIds."))*(SELECT iCredits FROM wpm_tool_type WHERE vType = 'Estimate') as estimatetot,
                  (SELECT COUNT(iExpenseId) FROM ".PRJ_DB_PREFIX."_expenses WHERE iProjectId IN (".$iProjIds."))*(SELECT iCredits FROM wpm_tool_type WHERE vType = 'Expense') as expensetot,
                  (SELECT COUNT(iToDoId) FROM ".PRJ_DB_PREFIX."_todo WHERE iProjectId IN (".$iProjIds."))*(SELECT iCredits FROM wpm_tool_type WHERE vType = 'ToDo') as todotot,
                  (SELECT COUNT(iWritepadId) FROM ".PRJ_DB_PREFIX."_writepad WHERE iProjectId IN (".$iProjIds."))*(SELECT iCredits FROM wpm_tool_type WHERE vType = 'Writepad') as writepadtot,
                  (SELECT COUNT(iTimeSheetId) FROM ".PRJ_DB_PREFIX."_timesheet WHERE iProjectId IN (".$iProjIds."))*(SELECT iCredits FROM wpm_tool_type WHERE vType = 'Timesheet') as timesheettot";
         $db_sql = $dbobj->MySQLSelect($sql);
         if(count($db_sql) > 0) {
            $iCredits+=$db_sql[0]['invoicetot'];
            $iCredits+=$db_sql[0]['discussiontot'];
            $iCredits+=$db_sql[0]['estimatetot'];
            $iCredits+=$db_sql[0]['expensetot'];
            $iCredits+=$db_sql[0]['todotot'];
            $iCredits+=$db_sql[0]['writepadtot'];
            $iCredits+=$db_sql[0]['timesheettot'];
         }
      }
      return  $iCredits;
   }
}
?>