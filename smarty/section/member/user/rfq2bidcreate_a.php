<?php
$iBidId = PostVar('iBidId');
$view = PostVar('view');
$Data = PostVar('Data');
$sub = "";
$typ = "";
// pr($_FILES);
// pr($_POST); exit;

if(!isset($r2bdObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Bids.php");
	$r2bdObj = new Rfq2Bids();
}
if(!isset($r2bdflObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2BidFiles.php");
	$r2bdflObj = new RFQ2BidFiles();
}
if(!isset($rfq2Obj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
	$rfq2Obj = new RFQ2Master();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
}
if(!isset($orgObj)) {
   include_once(SITE_CLASS_APPLICATION.'user/class.Organization.php');
   $orgObj = new Organization();
}
if(!isset($orgprefObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj = new OrganizationPreference();
}
if(!isset($orgUserPermObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	$orgUserPermObj = new OrganizationUserPermission();
}
if(!isset($fluplObj)) {
	include_once(SITE_CLASS_GEN."class.imagecrop.php");
	$fluplObj = new imagecrop();
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

if(trim($Data['iRFQ2Id'])!='' && $Data['iRFQ2Id']>0)
{
	if(trim($view)=='' || trim($view)=='add')
	{
		$Data = $r2bdObj->iacalcBidAmount($Data);

		// check for conditions & limits
		$rfq2dtls = $rfq2Obj->select($Data['iRFQ2Id']);
		$r2csts = $rfq2Obj->getB2Rfq2Status($rfq2dtls[0]['iRFQ2Id']);
		// if(strtotime(calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s'))-strtotime($rfq2dtls[0]['dEndDate'])>=0 || $rfq2dtls[0]['eAuctionStatus']!='Live') { 	//
		if($r2csts!='live' || $rfq2dtls[0]['eAuctionStatus']!='Live') { 	//
			header("Location: ".SITE_URL_DUM."b2rfq2view/".$Data['iRFQ2Id']."/nl");
			exit;
		}

		// check for h/l
		$cvbd = array('a'=>'y','p'=>'y','b'=>'y','msg'=>'');
		// if($rfq2dtls[0]['eAuctionType']!='Auction')
		if($rfq2dtls[0]['eAuctionType']=='Auction')
		{
			$cvbd = $r2bdObj->chkAuctionBidAmount($rfq2dtls[0]['eBidCriteria'],$Data['iRFQ2Id'],'0',$Data['fBidAdvanceTotal'],$Data['fBidPriceTotal'],$Data['fBidAmount']);
			// pr($cvbd); exit;
			// pr($Data); exit;
		} else {
			$dup_dtls = $r2bdObj->getDetails('*'," AND iRFQ2Id=".$Data['iRFQ2Id']." AND iBuyer2Id=$curORGID AND eDelete!='Verified' ");
			if(is_array($dup_dtls) && count($dup_dtls)>0 && isset($dup_dtls[0]['iBidId']) && $dup_dtls[0]['iBidId']>0) {
				// $generalobj->getPostForm($_POST,'rae',SITE_URL_DUM."b2rfq2view/".$Data['iRFQ2Id']);
				header("Location: ".SITE_URL_DUM."b2rfq2view/".$Data['iRFQ2Id']."/rae");
				exit;
			}
			$cvbd = $r2bdObj->chkTenderBidAmount($rfq2dtls[0]['eBidCriteria'],$Data['iRFQ2Id'],'0',$Data['fBidAdvanceTotal'],$Data['fBidPriceTotal'],$Data['fBidAmount'],$curORGID);
			// pr($cvbd); exit;
		}
		if($cvbd['b']=='n' || $cvbd['a']=='n'|| $cvbd['p']=='n') {
			// header("Location: ".SITE_URL_DUM."b2rfq2view/$Data['iRFQ2Id']/$vbd_msg");
			$generalobj->getPostForm($_POST,$cvbd['msg'],SITE_URL_DUM."b2rfq2view/".$Data['iRFQ2Id']);
			exit;
		}

		$Data['vBidNum'] = $r2bdObj->getUniqueCode('');
		$orgprf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$curORGID);
		if($orgprf[0]['eRFQ2BidVerifyReq']=='Yes' ||  $Data['eSaved']=='Yes')
		{
			$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Create' ");
			$Data['iStatusID'] = $sts[0]['iStatusID'];
			$Data['eStatus'] = 'pending';
			if($Data['eSaved']!='Yes') {
				$sub = "New RFQ2 Bid";
				$typ = "Create";
				$body = Array("#CREATED_BY#","#RFQ2CODE#","#BIDNUM#","#ADVANCE#","#PRICE#","#LINK#");
				$body_arr = Array("#NAME#","#CREATED_BY#","#RFQ2CODE#","#BIDNUM#","#ADVANCE#","#PRICE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
			}
		} else {
			$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Verify' ");
			$Data['iStatusID'] = $sts[0]['iStatusID'];
			$Data['eStatus'] = 'current';
			$sub = "New Bid For RFQ2";
			$typ = "Create";
		}
		// pr($Data); exit;
		$Data['iBuyer2Id'] = $curORGID;
		$Data['iCreatedById'] = $sess_id;
		$Data['iModifiedById'] = $sess_id;
		$Data['dBidDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		// $Data['eStatus'] = 'pending';
		$res = $id = $r2bdObj->insert($Data);
		if($res)
		{
			$files = $_FILES['files'];
			for($i=0; $i<count($files['name']); $i++)
			{
				$flnm = '';
				if(($files['error'][$i]==0) && ($files['size'][$i] > 0)) {
					$fileUpload['name'] = $files['name'][$i];
					$fileUpload['tmp_name'] = $files['tmp_name'][$i];
					$flnm = $fluplObj->UploadFile('rfq2bid','docs',$id,$fileUpload,'');
					$fdata['vFile'] = $flnm;
					$fdata['iBidId'] = $id;
					if(strrpos($flnm, '.') !== false) {
						$fdata['vExt'] = substr($flnm, (strrpos($flnm,'.')+1));
					} else {
						$fdata['vExt'] = '';
					}
					$fdata['dADate'] = calcGTzTime(date('Y-m-d H:i:s'));
					if(trim($flnm)!='') {
						$rs = $r2bdflObj->insert($fdata);
					}
				}
			}
			$msg = 'ras';
			//
		} else { $msg = 'raer'; }
		//
	}
	else if(trim($view)=='edit')
	{
		if(trim($iBidId)!='' && $iBidId>0)
		{
			$bd_dtls = $r2bdObj->select($iBidId);
			$Data = $r2bdObj->iacalcBidAmount($Data);

			// check for conditions & limits
			$rfq2dtls = $rfq2Obj->select($Data['iRFQ2Id']);
			$r2csts = $rfq2Obj->getB2Rfq2Status($rfq2dtls[0]['iRFQ2Id']);
			// if(strtotime(calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s'))-strtotime($rfq2dtls[0]['dEndDate'])>=0 || $rfq2dtls[0]['eAuctionStatus']!='Live') { 	//
			if($r2csts!='live' || $rfq2dtls[0]['eAuctionStatus']!='Live') { 	//
				header("Location: ".SITE_URL_DUM."b2rfq2view/".$Data['iRFQ2Id']."/nl");
				exit;
			}

			// check for h/l
			$cvbd = array('a'=>'y','p'=>'y','b'=>'y','msg'=>'');
			if($rfq2dtls[0]['eAuctionType']=='Auction')
			{
				$cvbd = $r2bdObj->chkAuctionBidAmount($rfq2dtls[0]['eBidCriteria'],$Data['iRFQ2Id'],$iBidId,$Data['fBidAdvanceTotal'],$Data['fBidPriceTotal'],$Data['fBidAmount']);
				// pr($cvbd); exit;
				//
				/*$chkbid = $r2bdObj->getDetails('*, MAX(r2bd.fBidAdvanceTotal) as maxadvance, MIN(r2bd.fBidPriceTotal) as minprice, MAX(r2bd.fBidAmount) as maxbidamount'," AND r2bd.iRFQ2Id=".$Data['iRFQ2Id']." AND r2bd.eStatus='current' AND iBidId!='$iBidId'"," r2bd.iBidId DESC "," r2bd.iBidId "," LIMIT 0,1 ");
				// pr($chkbid); exit;
				if(is_array($chkbid) && count($chkbid)>0)
				{
					if($rfq2dtls[0]['eBidCriteria']=='Advance') {
						if($Data['fBidAdvanceTotal']<=$chkbid[0]['maxadvance']) {
							$vbd['a'] = 'n';
							$vbd_msg = "al"; 	// "Advance amount is not higher than other bids";
						}
						//
					} else if($rfq2dtls[0]['eBidCriteria']=='Price') {
						if($Data['fBidPriceTotal']>=$chkbid[0]['minprice']) {
							$vbd['p'] = 'n';
							$vbd_msg = "pl"; 	// "Price amount is not higher than other bids";
						}
					} else {
						if($Data['fBidAdvanceTotal']<=$chkbid[0]['maxadvance']) {
							$vbd['a'] = 'n';
							$vbd_msg = "bl"; 	// "Bid amount is not higher than other bids";
						}
						if($Data['fBidPriceTotal']>=$chkbid[0]['minprice']) {
							$vbd['p'] = 'n';
							$vbd_msg = "bl"; 	// "Bid amount is not higher than other bids";
						}
						if($Data['fBidAmount']<=$chkbid[0]['maxbidamount']) {
							$vbd['b'] = 'n';
							$vbd_msg = "bl"; 	// "Bid amount is not higher than other bids";
						}
					}
					//
				}*/
				// pr($vbd); exit;
				// pr($Data); exit;
			} else {
				$cvbd = $r2bdObj->chkTenderBidAmount($rfq2dtls[0]['eBidCriteria'],$Data['iRFQ2Id'],$iBidId,$Data['fBidAdvanceTotal'],$Data['fBidPriceTotal'],$Data['fBidAmount'],$curORGID);
				// pr($cvbd); exit;
			}
			if($cvbd['b']=='n' || $cvbd['a']=='n'|| $cvbd['p']=='n') {
				// header("Location: ".SITE_URL_DUM."b2rfq2view/$Data['iRFQ2Id']/$vbd_msg");
				$generalobj->getPostForm($_POST,$cvbd['msg'],SITE_URL_DUM."b2rfq2view/".$Data['iRFQ2Id']);
				exit;
			}

			if(!isset($bd_dtls[0]['vBidNum']) || trim($bd_dtls[0]['vBidNum'])=='') {
				$Data['vBidNum'] = $r2bdObj->getUniqueCode('');
			}
			//
			$orgprf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$curORGID);
			if($orgprf[0]['eRFQ2BidVerifyReq']=='Yes' ||  $Data['eSaved']=='Yes')
			{
				$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Create' ");
				$Data['iStatusID'] = $sts[0]['iStatusID'];
				$Data['eStatus'] = 'pending';
				if($Data['eSaved']!='Yes') {
					$sub = "RFQ2 Bid Modified";
					$typ = "Modified";
					$body = Array("#MODIFIED_BY#","#RFQ2CODE#","#BIDNUM#","#ADVANCE#","#PRICE#","#LINK#");
					$body_arr = Array("#NAME#","#MODIFIED_BY#","#RFQ2CODE#","#BIDNUM#","#ADVANCE#","#PRICE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
				}
			} else {
				$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Verify' ");
				$Data['iStatusID'] = $sts[0]['iStatusID'];
				$Data['eStatus'] = 'current';
				$sub = "New Bid For RFQ2";
				$typ = "Create";
			}
			// pr($Data); exit;
			$Data['iModifiedById'] = $sess_id;
			$res = $r2bdObj->updateData($Data," iBidId=$iBidId ");
			$id = $iBidId;
			if($res)
			{
				$files = $_FILES['files'];
				$dfid = PostVar('deleteFiles');
				if(trim($dfid)!='')
				{
					$dfl = $r2bdflObj->getDetails('*'," AND iBidFileId IN ($dfid) ");
					$drs = $r2bdflObj->del(" iBidFileId IN ($dfid) ");
					if($drs) {
						if(is_array($dfl) && count($dfl)>0) {
							for($l=0;$l<count($dfl);$l++) {
								@ unlink($cfgimg['rfq2bid']['docs']['path'].$dfl[$l]['iBidId'].'/'.$dfl[$l]['vFile']);
							}
						}
					}
				}
				for($i=0; $i<count($files['name']); $i++)
				{
					$flnm = '';
					if(($files['error'][$i]==0) && ($files['size'][$i] > 0)) {
						$fileUpload['name'] = $files['name'][$i];
						$fileUpload['tmp_name'] = $files['tmp_name'][$i];
						$flnm = $fluplObj->UploadFile('rfq2bid','docs',$id,$fileUpload,'');
						$fdata['vFile'] = $flnm;
						$fdata['iBidId'] = $id;
						if(strrpos($flnm, '.') !== false) {
							$fdata['vExt'] = substr($flnm, (strrpos($flnm,'.')+1));
						} else {
							$fdata['vExt'] = '';
						}
						$fdata['dADate'] = calcGTzTime(date('Y-m-d'), 'Y-m-d');
						if(trim($flnm)!='') {
							$rs = $r2bdflObj->insert($fdata);
						}
					}
				}
				$msg = 'res';
				//
			} else { $msg = 'reer'; }
			//
		}
		//
	}
}

if($view=='verify' && trim($iBidId)!='' && $iBidId>0)
{
	// pr($_POST); exit;
	$dt = $r2bdObj->select($iBidId);
	$id = $iBidId;
	if(is_array($dt) && count($dt)>0)
	{
		$updt['iVerifiedById'] = $sess_id;
		if(isset($dt[0]['eDelete']) && $dt[0]['eDelete']=='Yes') {
			$updt['eDelete'] = 'Verified';
		} else {
			$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Verify' ");
			$updt['iStatusID'] = $sts[0]['iStatusID'];
		}
		$updt['eStatus'] = $r2bdObj->chkAuctionBidStatus($iBidId);
		// pr($updt); exit;
		$res = $r2bdObj->updateData($updt," iBidId=$iBidId ");
		if($res)
		{
			if((!isset($dt[0]['eDelete']) || $dt[0]['eDelete']!='Yes') && $updt['eStatus']=='current') {
				$sub = 'New Bid For RFQ2';
			}
			$vrfydt['iVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			$vrfydt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			$vrfydt['dVerifyDate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
			$vrfydt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
			$vrfydt['vAction'] = 'Verify';
			$ivid = $userActionObj->getDetails('iVerifiedID'," AND iItemID=$iBidId AND eSubject='RFQ2 Bid' "," iVerifiedID DESC ");
			if(isset($ivid[0]['iVerifiedID']) && trim($ivid[0]['iVerifiedID'])!='' && $ivid[0]['iVerifiedID']>0) {
				$ivid = $ivid[0]['iVerifiedID'];
				$rs = $userActionObj->updateData($vrfydt," iVerifiedID=$ivid ");
			}
			$msg = "rvs";
		} else {	$msg = "rver";	}
	} else {	$msg = "rver";	}
}
else if($view=='reject' && trim($iBidId)!='' && $iBidId>0)
{
	$dtls = $r2bdObj->select($iBidId);
	$id = $iBidId;
	if(is_array($dtls) && count($dtls)>0)
	{
		$updt['iRejectedBy'] = $sess_id;
		if(isset($dtls[0]['eDelete']) && $dtls[0]['eDelete']=='Yes') {
			$updt['eDelete'] = 'No';
		} else {
			$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Rejected' ");
			$updt['iStatusID'] = $sts[0]['iStatusID'];
		}
		$updt['eStatus'] = 'rejected';
		$updt['tReasonToReject'] = Postvar('tReasonToReject');
		$res = $r2bdObj->updateData($updt," iBidId=$iBidId ");
		if($res)
		{
			$vrfydt['iVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			$vrfydt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			$vrfydt['dVerifyDate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
			$vrfydt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
			$vrfydt['vAction'] = 'Rejected';
			$ivid = $userActionObj->getDetails('iVerifiedID'," AND iItemID=$iBidId AND eSubject='RFQ2 Bid' "," iVerifiedID DESC ");
			if(isset($ivid[0]['iVerifiedID']) && trim($ivid[0]['iVerifiedID'])!='' && $ivid[0]['iVerifiedID']>0) {
				$ivid = $ivid[0]['iVerifiedID'];
				$rs = $userActionObj->updateData($vrfydt," iVerifiedID=$ivid ");
			}
			//
			$db_email = $emailObj->getDetails('*', " AND vType='RFQ2 Bid Rejected' AND eSection='Member' ");
			if(is_array($db_email) && count($db_email)>0)
			{
				$link = SITE_URL."viewsrfq2bid/".$id;
				$body_arr = Array("#REJECTED_BY#","#RFQ2CODE#","#BIDNUM#","#ADVANCE#","#PRICE#","#LINK#");
				$post = Array($sess_user_name."($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link);

				$rplarr = Array("Hello #USER#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
				$tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
				$emailContent_en = trim(str_replace($body,$post, $tbody_en));
				$tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
				$emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

				$dt = array();
				$dt['iItemID'] = $id;
				$dt['iOrganizationID'] = $dtls[0]['iBuyer2Id'];
				$dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
				$dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
				$dt['tMailContent_en'] = $emailContent_en;
				$dt['tMailContent_fr'] = $emailContent_fr;
				$dt['eSubject'] = "RFQ2 Bid";
				$dt['eType'] = 'Rejected';
				$dt['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
				$dt['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
				$dt['dActionDate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
				$userActionObj->setAllVar($dt);
				$userActionObj->insert();
				//
				$emailArr = array();
				$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Create' ");
				$csts = $sts[0]['iStatusID'];
				$emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iBuyer2Id'],"$csts%",'','vRFQ2BidPermits'," AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
				$body_arr = Array("#USER#","#REJECTED_BY#","#RFQ2CODE#","#BIDNUM#","#ADVANCE#","#PRICE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
				if((is_array($emailArr) && count($emailArr) > 0)) {
					for($i=0;$i<count($emailArr);$i++) {
						$smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
						$email = $emailArr[$i]['vEmail'];
						$post_arr = Array($smname, $sess_user_name."($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link,$MAIL_FOOTER,SITE_URL);
						$sendMail->Send("RFQ2 Bid Rejected","Member",$email,$body_arr,$post_arr);
					}
				}
			}
			$msg = "rrs";
		} else {	$msg = "rrer";	}
	} else {	$msg = "rrer";	}
}

if($res && trim($sub)!='' && $sub!='New Bid For RFQ2')
{
	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on r2bd.iStatusID=sm.iStatusID
					LEFT JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id ";
	$where .= " AND r2bd.iBidId=$id ";
	$fields = " r2bd.*, rfq2.*, sm.vStatus_en as vStatus, r2bd.eSaved ";
	$dtls = $r2bdObj->getJoinTableInfo($jtbl, $fields, $where,'','','','');
	//
	$orgdtls = $orgObj->select($dtls[0]['iBuyer2Id']);
	if(is_array($dtls) && count($dtls)>0 && is_array($orgdtls) && count($orgdtls)>0)
	{
		$db_email = $emailObj->getDetails('*', " AND vType='$sub' AND eSection='Member' ");
		$link = SITE_URL."viewsrfq2bid/".$id;
		// $body
		$post = Array($sess_user_name."($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link);

		$rplarr = Array("Hello #NAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
		$tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
		$emailContent_en = trim(str_replace($body,$post, $tbody_en));
		$tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
		$emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

		$dt['iItemID'] = $id;
		$dt['iOrganizationID'] = $dtls[0]['iBuyer2Id'];
		$dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
		$dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
		$dt['tMailContent_en'] = $emailContent_en;
		$dt['tMailContent_fr'] = $emailContent_fr;
		$dt['eSubject'] = "RFQ2 Bid";
		$dt['eType'] = $typ;
		$dt['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		$dt['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		$dt['dActionDate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
		$userActionObj->setAllVar($dt);
		$userActionObj->insert();
		//
		$emailArr = array();
		$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Verify' ");
		$vsts = $sts[0]['iStatusID'];
		$emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iBuyer2Id'],"%$vsts%",'','vRFQ2BidPermits'," AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
		// $body_arr = Array("#NAME#","#CREATED_BY#","#RFQ2CODE#","#BIDNUM#","#ADVANCE#","#PRICE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
		if((is_array($emailArr) && count($emailArr) > 0)) {
			for($i=0;$i<count($emailArr);$i++) {
				$smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
				$email = $emailArr[$i]['vEmail'];
				$post_arr = Array($smname, $sess_user_name."($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link,$MAIL_FOOTER,SITE_URL);
				$sendMail->Send("$sub","Member",$email,$body_arr,$post_arr);
			}
		}
	}
	//
}
//
if($res && trim($sub)!='' && $sub=='New Bid For RFQ2' && $id>0)
{
	$bdtls = $r2bdObj->select($id);
	if(is_array($bdtls) && count($bdtls)>0)
	{
		//set rfq2 best bid
		$udt = Array('fBestBidAdvance'=>$bdtls[0]['fBidAdvanceTotal'], 'fBestBidPrice'=>$bdtls[0]['fBidPriceTotal'], 'fBestBidAmount'=>$bdtls[0]['fBidAmount']);
		$rs = $rfq2Obj->updateData($udt," iRFQ2Id=".$bdtls[0]['iRFQ2Id']." ");
		// set status of all other bids for rfq2 as outbided,
		$rs = $r2bdObj->setAuctionAllBidStatus($id);
		$rfq2dtls = $rfq2Obj->select($bdtls[0]['iRFQ2Id']);
		$orgdtls = $orgObj->select($dtls[0]['iBuyer2Id']);
		if($rfq2dtls[0]['eAuctionType']=='Auction')
		{
			// send email to users of those org with create status
			$emailArr = array();
			$sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Create' ");
			$csts = $sts[0]['iStatusID'];
			$orgin = "Select DISTINCT r2pb.iBuyer2Id from ".PRJ_DB_PREFIX."_rfq2_product_buyer2 r2pb where iRFQ2Id=".$bdtls[0]['iRFQ2Id']."";
			$b2orgs = $dbobj->MySQLSelect($orgin);
			$emailArr = $orgUsrObj->getPermittedUsers($orgin,"$csts%",'','vRFQ2BidPermits'," AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ",'y');
			// pr($emailArr); exit;
			//
			$db_email = $emailObj->getDetails('*', " AND vType='$sub' AND eSection='Member' ");
			// $link = SITE_URL."b2rfq2view/".$id;
			$body = Array("#CREATED_BY#","#RFQ2CODE#","#BIDNUM#","#ADVANCE#","#PRICE#");
			$post = Array($orgdtls[0]['vCompanyName'].'('.$orgdtls[0]['vOrganizationCode'].')', $bdtls[0]['vRFQ2Code'], $bdtls[0]['vBidNum'], $bdtls[0]['fBidAdvanceTotal'], $bdtls[0]['fBidPriceTotal']);
			if(is_array($db_email) && count($db_email)>0 && is_array($b2orgs) && count($b2orgs)>0)
			{
				$rplarr = Array("Hello #NAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
				$tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
				$emailContent_en = trim(str_replace($body,$post, $tbody_en));
				$tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
				$emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

				$dt = array();
				$dt['iItemID'] = $id;
				$dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
				$dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
				$dt['tMailContent_en'] = $emailContent_en;
				$dt['tMailContent_fr'] = $emailContent_fr;
				$dt['eSubject'] = "RFQ2 Bid";
				$dt['eType'] = $typ;
				$dt['iCreatedBy'] = $bdtls[0]['iCreatedById']; 	// $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
				$dt['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
				$dt['dActionDate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
				for($l=0;$l<count($b2orgs);$l++)
				{
					$dt['iOrganizationID'] = $b2orgs[$l]['iBuyer2Id'];
					//
					$userActionObj->setAllVar($dt);
					$userActionObj->insert();
				}
				//
				$body_arr = Array("#NAME#","#CREATED_BY#","#RFQ2CODE#","#BIDNUM#","#ADVANCE#","#PRICE#","#MAIL_FOOTER#","#SITE_URL#");
				if((is_array($emailArr) && count($emailArr) > 0)) {
					for($i=0;$i<count($emailArr);$i++) {
						$smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
						$email = $emailArr[$i]['vEmail'];
						$post_arr = Array($smname, $orgdtls[0]['vCompanyName'].'('.$orgdtls[0]['vOrganizationCode'].')', $bdtls[0]['vRFQ2Code'], $bdtls[0]['vBidNum'], $bdtls[0]['fBidAdvanceTotal'], $bdtls[0]['fBidPriceTotal'], $MAIL_FOOTER,SITE_URL);
						$sendMail->Send("$sub","Member",$email,$body_arr,$post_arr);
					}
				}
			}
		}
		//
	}
}
//
// if tender, check for limit and high/low from current org bid (can't add more than one)
header("Location: ".SITE_URL_DUM."b2rfq2bidlist/$msg");
exit;
?>