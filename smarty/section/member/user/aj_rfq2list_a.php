<?php
if(!isset($rfq2Obj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
	$rfq2Obj = new RFQ2Master();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
}
if(!isset($userActionObj)) {
	include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
	$userActionObj = new UserActionVerification();
}
if(!isset($emailObj)) {
	include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
	$emailObj = new EmailTemplate();
}
if(!isset($sendMail)) {
	include(SITE_CLASS_GEN."class.sendmail.php");
	$sendMail = new SendPHPMail();
}

$ids = PostVar('val');
$mode = PostVar('mode');
if($mode=='delete' || $mode=='deleteall')
{
	if(trim($ids)!='')
	{	
		$rsts = $statusmasterObj->getDetails('iStatusID'," AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Rejected' ");
		$rsts = $rsts[0]['iStatusID'];
		$dt['iModifiedById'] = $sess_id;
		$dt['eDelete'] = 'Yes';
		$res = $rfq2Obj->updateData($dt," iRFQ2Id IN ($ids) AND iStatusID=$rsts ");
		//
		if($res)
		{
			$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on rfq2.iStatusID=sm.iStatusID
							LEFT JOIN ".PRJ_DB_PREFIX."_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID
							LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=rfq2.iOrganizationID ";
			$where .= " AND iRFQ2Id IN ($ids) AND iStatusID=$rsts ";
			$fields = " DISTINCT rfq2.*, ioh.*, org.*, sm.vStatus_en as vStatus, rfq2.eSaved ";
			$dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where,'','','','');
			if(is_array($dtls) && count($dtls)>0)
			{
				for($l=0;$l<count($dtls);$l++)
				{
					// $orgdtls = $orgObj->select($dtls[0]['iOrganizationID']);
					//if(is_array($dtls) && count($dtls)>0 && is_array($orgdtls) && count($orgdtls)>0)
					//{
						$db_email = $emailObj->getDetails('*', " AND vType='RFQ2 Deleted' AND eSection='Member' ");
						$link = SITE_URL."rfq2view/".$id;
						$body = Array("#CREATEDBY#","#RFQ2CODE#","#INVOICECODE#","#STARTDATE#","#ENDDATE#","#TYPE#","#LINK#");
						$post = Array($dtls[$l]['vCompanyName'].'('.$dtls[$l]['vOrganizationCode'].')', $dtls[$l]['vRFQ2Code'], $dtls[$l]['vInvoiceCode'], $dtls[$l]['dStartDate'], $dtls[$l]['dEndDate'], $link);
			
						$rplarr = Array("Hello #NAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
						$tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
						$emailContent_en = trim(str_replace($body,$post, $tbody_en));
						$tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
						$emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
			
						$dt['iItemID'] = $id;
						$dt['iOrganizationID'] = $dtls[$l]['iOrganizationID'];
						$dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
						$dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
						$dt['tMailContent_en'] = $emailContent_en;
						$dt['tMailContent_fr'] = $emailContent_fr;
						$dt['eSubject'] = "RFQ2";
						$dt['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
						$dt['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						$dt['dActionDate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
						$userActionObj->setAllVar($dt);
						$userActionObj->insert();
						//
						$emailArr = array();
						$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2,%' AND vStatus_en='Verify' ");
						$vsts = $sts[0]['iStatusID'];
						$emailArr = $orgUsrObj->getPermittedUsers($dtls[$l]['iOrganizationID'],"$vsts%",'','vRFQ2Permits'," AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
						$body_arr = Array("#NAME#","#CREATEDBY#","#RFQ2CODE#","#INVOICECODE#","#STARTDATE#","#ENDDATE#","#TYPE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
						if((is_array($emailArr) && count($emailArr) > 0)) {
							for($i=0;$i<count($emailArr);$i++) {
								$smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
								$email = $emailArr[$i]['vEmail'];
								$post_arr = Array($smname,$sess_user_name."($sess_usertype_short)",$dtls[$l]['vCompanyName'].'('.$dtls[$l]['vOrganizationCode'].')', $dtls[$l]['vRFQ2Code'], $dtls[$l]['vInvoiceCode'], $dtls[$l]['dStartDate'], $dtls[$l]['dEndDate'], $link,$MAIL_FOOTER,SITE_URL);
								$sendMail->Send("RFQ2 Deleted","Member",$email,$body_arr,$post_arr);
							}
						}
					//}
				}
				//
			}
			$msg = $smarty->get_template_vars('MSG_DEL_SENT_SUCC');
		} else {
			$msg = $smarty->get_template_vars('MSG_DEL_SENT_ERR');
		}
	}
}
echo $msg;
exit;
?>