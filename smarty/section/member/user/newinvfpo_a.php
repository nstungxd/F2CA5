<?php
$poid = (isset($_POST['iPOID']))? $_POST['iPOID'] : '';
$view = (isset($_POST['view']))? $_POST['view'] : '';
//
if($view == 'crtinv' && trim($poid)!='' && $poid>0)
{
	if(!isset($pohObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
		$pohObj =	new PurchaseOrderHeading();
	}
	if(!isset($orgObj)) {
		include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
		$orgObj = new Organization();
	}
	if(!isset($orgprefObj)) {
		include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
		$orgprefObj =	new OrganizationPreference();
	}
	if(!isset($statusmasterObj)) {
		include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
		$statusmasterObj =	new StatusMaster();
	}
	if(!isset($iohObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
		$iohObj = new InvoiceOrderHeading();
	}
	if(!isset($invLineObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.InvoiceDetailLine.php");
		$invLineObj =	new InvoiceDetailLine();
	}
	if(!isset($poLineObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderLine.php");
		$poLineObj =	new PurchaseOrderLine();
	}
	if(!isset($orgUsrObj)) {
	  require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	  $orgUsrObj = new OrganizationUser();
	}
	if(!isset($secManObj)) {
		require_once(SITE_CLASS_APPLICATION."securitymanager/class.SecurityManager.php");
		$secManObj = new SecurityManager();
	}
	if(!isset($emailObj)) {
		include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
		$emailObj = new EmailTemplate();
	}
	if(!isset($userActionObj)) {
		  include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
		  $userActionObj = new UserActionVerification();
	}
	if(!isset($sendMail)) {
		include(SITE_CLASS_GEN."class.sendmail.php");
		$sendMail = new SendPHPMail();
	}
	if(!isset($imgObj)) {
		include_once(SITE_CLASS_GEN."class.imagecrop.php");
		$imgObj = new imagecrop();
	}
	if(!isset($poAttachmentObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderAttachment.php");
		$poAttachmentObj = new PurchaseOrderAttachment();
	}
	if(!isset($poprefObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.PoOtherInformation.php");
		$poprefObj = new PoOtherInformation();
	}
	if(!isset($ioprefObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOtherInformation.php");
		$ioprefObj = new InvoiceOtherInformation();
	}

	// pr($_POST); exit;
	$iPurchaseOrderID = $poid;
	$acptsts = $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Accepted' ");
	$invdt = $pohObj->select($iPurchaseOrderID);
	// prints($invdt); exit;

	$totusrs = $orgUsrObj->getDetails(" COUNT(*) as tot "," AND iOrganizationID=$curORGID AND eUserType='User'");
	$totusrs = $totusrs[0]['tot'];

	$ordt = $orgUsrObj->getDetails('*'," AND iOrganizationID=$curORGID AND eUserType='Admin' AND eStatus='Active'");
	$org = $orgObj->select($curORGID);
	$smdt = $secManObj->getDetails('*'," AND iASMID=".$org[0]['iASMID']." AND eStatus='Active'");

	if(is_array($smdt) && is_array($ordt)) {
		$emailArr = array_merge($smdt,$ordt);
	} else if(is_array($smdt)) {
		$emailArr = $smdt;
	} else if(is_array($ordt)) {
		$emailArr = $ordt;
	}

		if($acptsts[0]['iStatusID']==$invdt[0]['iStatusID'] && (trim($invdt[0]['iInvoiceID'])=='' || trim($invdt[0]['iInvoiceID'])<1))
		{
			// $vInvoiceCode = $generalobj->getUniqueCode(PRJ_DB_PREFIX."_inovice_order_heading","vInvoiceCode");
			$vInvoiceCode = $iohObj->getUniqueCode();
			// $invdt = $pohObj->select($iPurchaseOrderID);
			$splrorg = $orgObj->select($invdt[0]['iSupplierOrganizationID']);
			$splrpf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$invdt[0]['iSupplierOrganizationID']);
			$invdt[0]['vInvoiceSupplierCode'] = $splrorg[0]['vOrganizationCode'];
			$invdt[0]['vSupplierName'] = $splrorg[0]['vCompanyName'];
			$invdt[0]['vInvoiceCode'] = $vInvoiceCode;
			$invdt[0]['vInvSupplierCode'] = $vInvoiceCode;
			$vInvoiceNumber = "INV".$vInvoiceCode."-".trim($invdt[0]['vInvoiceSupplierCode']);
			$invdt[0]['vInvoiceNumber'] = $vInvoiceNumber;
			$invdt[0]['fOtherTax1'] = $invdt[0]['fOther_tax_1'];
			$invdt[0]['vAssociatePOBuyerCode'] = $invdt[0]['vBuyerCode'];
			$invdt[0]['vBuyerName'] = $invdt[0]['vBuyerCompanyName'];
			$invdt[0]['vBuyerContactParty'] = $invdt[0]['vBuyerContactName'];
			$invdt[0]['tInvoiceDescription'] = $invdt[0]['tOrderDescription'];
			$invdt[0]['fInvoiceTotal'] = $invdt[0]['fPOTotal'];
			$invdt[0]['vFromIP'] = $_SERVER['REMOTE_ADDR'];
			$invdt[0]['dCreatedDate'] = $invdt[0]['dIssueDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
			$invdt[0]['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			$invdt[0]['vExtPOCode'] = $invdt[0]['vPoBuyerCode'];
			$invdt[0]['eInvoiceType'] = 'Services';
			$invdt[0]['iaStatusID'] = 0;
			unset($invdt[0]['fOther_tax_1']);
			unset($invdt[0]['vPONumber']);
			unset($invdt[0]['vPOCode']);
			unset($invdt[0]['tCarrier']);
			unset($invdt[0]['dOrderDate']);
			unset($invdt[0]['dVerifyDate']);
			// unset($invdt[0]['iModifiedByID']);
			unset($invdt[0]['vBuyerCompanyName']);
			unset($invdt[0]['vBuyerContactName']);
			unset($invdt[0]['tOrderDescription']);
			unset($invdt[0]['iInvoiceID']);
			unset($invdt[0]['fPOTotal']);
			$invdt = $invdt[0];
			// pr($invdt); exit;

			$byrorg = $orgObj->select($invdt['iBuyerOrganizationID']);
			// $byrpf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$invdt['iBuyerOrganizationID']);
			$byrpf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$curORGID);
			$invstatus = $byrpf[0]['vInvoiceAcceptanceLevel'];
			$totusrs = $orgUsrObj->getDetails(" COUNT(*) as tot "," AND iOrganizationID=$curORGID AND eUserType='User'");
			$totusrs = $totusrs[0]['tot'];
			//if($totusrs > 1) {
				/*if($byrpf[0]['eReqVerifyInvAcpt'] == 'Yes') {
					$invdt['iStatusID'] = '0';
				} else {
					if(trim($invstatus) != '') {
						$invstatus = @explode(',',$invstatus);
						sort($invstatus);
						$invdt['iStatusID'] = $invstatus[0];
					}
				}*/
				$icstsdtls = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
				$invdt['iStatusID'] = $icstsdtls[0]['iStatusID'];
				$invdt['eCreateByBuyer'] = 'Yes';
				$invdt['eSaved'] = 'Yes';
			/*} else {
				$invisusts = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
				$invdt['iStatusID'] = $invisusts[0];
			}*/

			// prints($invdt); exit;
			$iohObj->setAllVar($invdt);
			$in = $iohObj->insert();
			$popref = $poprefObj->getDetails('*'," AND iPurchaseOrderID=$iPurchaseOrderID ");
			$popref[0]['iInvoiceID'] = $in;
			unset($popref[0]['iPurchaseOrderID']);
			$iprf = $ioprefObj->insert($popref);
			$poitems = $poLineObj->getDetails('*'," AND iPurchaseOrderID=$iPurchaseOrderID");
			// prints($poitems); exit;
			for($l=0;$l<count($poitems);$l++)
			{
				$invItems = $poitems[$l];
				$invItems['iRelatedPurchaseOrderLineID'] = $invItems['iOrderLineID'];
				$invItems['eInvoiceType'] = $invItems['eOrderType'];
				unset($invItems['eOrderType']);
				unset($invItems['iOrderLineID']);
				unset($invItems['dETA']);
				unset($invItems['iRelatedInvoiceLineID']);
				// $vItemCode = $invItems['vItemCode'];
				// prints($vItemCode); exit;
				// $invitmdtl = $invLineObj->getDetails('*'," AND vItemCode=$vItemCode");
				/*if(count($invitmdtl) > 0) {
					$vItemCode = $generalobj->getUniqueCode(PRJ_DB_PREFIX."_invoice_detail_line","vItemCode");
				}*/
				$vItemCode = $invLineObj->getUniqueCode();
				$vInvItemLineNumber = $generalobj->UniqueID("",PRJ_DB_PREFIX."_invoice_detail_line","iLineNumber",$charlimit="10");
				$invItems['vItemCode'] = $vItemCode;
				$invItems['iLineNumber'] = $vInvItemLineNumber;
				$invItems['dCreatedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
				# $invItems['eInvoiceType'] = 'Services';
				$invItems['iInvoiceID'] = $in;
				// prints($invItems); exit;
				$invLineObj->setAllVar($invItems);
				$itm = $invLineObj->insert();
			}
		}

// mails
		if($in > 0)
		{
			$sub1 = "New Invoice Created By Buyer";
			$type = "Create";
			$actn = "Create";
			$sub2 = "New Invoice Created By Buyer";

			$dt['iItemID'] = $in;
			$dt['eSubject'] = $sub1;
			$dt['eType'] = $type;
			$where = "AND vType='$sub1' AND eSection='Member'" ;
			$db_email = $emailObj->getDetails('*',$where);
			$invdt = $iohObj->select($in);

			$orgpref = $orgprefObj->getStatusDetails($invdt[0]['iSupplierOrganizationID']);
			$orginvstatus = $orgpref['inv'];

			$orgusrs = $orgUsrObj->getDetails('*'," AND iOrganizationID=".$invdt[0]['iSupplierOrganizationID']);

			$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
			$rjtsts = $stsdtls[0]['iStatusID'];
			$stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
			$acptsts = $stsdtls;
			$lang = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'];
			$stsdtls =  $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg"," AND eFor='Invoice' AND vStatus_en='Issued' ");
			$isusts = $stsdtls;

			/*if($invdt[0]['iStatusID'] != $isusts[0]['iStatusID']) {
				if(count($orgusrs) > 1 && $invdt[0]['iStatusID'] != $acptsts[0]['iStatusID'] ) {
					for($l=0;$l<count($orginvstatus);$l++) {
						$nxtlevel = '1';
						if($invdt[0]['iStatusID'] == $orginvstatus[$l]['iStatusID']) {
							if(isset($orginvstatus[$l+1]))
								$nxtstatus = $orginvstatus[$l+1];
							else
								$nxtstatus = $orginvstatus[$l];
						}
					}
				} else {
					$nxtstatus = $isusts[0];
				}
			}*/

			if($invdt[0]['iPurchaseOrderID']>0) {
				$orgpref = $orgprefObj->getStatusDetails($invdt[0]['iBuyerOrganizationID'],'acceptance');
				$mchpref = $orgprefObj->getStatusDetails($invdt[0]['iSupplierOrganizationID']);
				$mth = array();
				for($l=0;$l<count($mchpref['inv']);$l++) {
					$mth[] = $mchpref['inv'][$l]['iStatusID'];
				}
				$orginvstatus = $orgpref['inv'];
				for($l=0; $l<count($orginvstatus); $l++) {
					if($orginvstatus[$l]['iStatusID'] > $invdt[0]['iStatusID'] && in_array($orginvstatus[$l]['iStatusID'],$mth)) {
						$nxtstatus = $orginvstatus[$l];
						break;
					}
				}
			} else {
				$nxtstatus['iStatusID'] = '0';
			}

			$sts = $nxtstatus['iStatusID'];		//	$invdt[0]['iStatusID'];
			$susrarr = $orgUsrObj->getPermittedUsers($invdt[0]['iSupplierOrganizationID'],$sts,'inv','isu');
			$busrarr = $orgUsrObj->getPermittedUsers($invdt[0]['iBuyerOrganizationID'],$sts,'inv','acpt');

			// $usrarr = $orgUsrObj->getPermittedUsers($invdt[0]['iBuyerOrganizationID'],$sts,'inv','acpt');

			$link = SITE_URL."invoiceview/".$in;
			$body = Array("#ADDED_BY#","#INVCODE#","#SUPPLIERORG#","#SUPORGCODE#","#BUYERORG#","#BUYORGCODE#","#LINK#");
			$post = Array($sess_user_name."($sess_usertype_short)",$invdt[0]['vInvoiceCode'],$invdt[0]['vSupplierName'],$invdt[0]['vInvoiceSupplierCode'],$invdt[0]['vBuyerName'],$invdt[0]['vAssociatePOBuyerCode'],$link);

			$rplarr = Array("Hello #USER#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
			$tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
			$emailContent_en = trim(str_replace($body,$post, $tbody_en));
			$tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
			$emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

			$dt['iOrganizationID'] = $curORGID; 	// $invdt[0]['iSupplierOrganizationID'];
			$dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
			$dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
			$dt['tMailContent_en'] = $emailContent_en;
			$dt['tMailContent_fr'] = $emailContent_fr;
			$dt['eSubject'] = "Invoice";
			$dt['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			$dt['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			$dt['dActionDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
			$userActionObj->setAllVar($dt);
			$userActionObj->insert();
			$dt['iOrganizationID'] = $invdt[0]['iSupplierOrganizationID'];
			$userActionObj->setAllVar($dt);
			$userActionObj->insert();

			if(!isset($poaObj)) {
				include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderAttachment.php");
				$poaObj = new PurchaseOrderAttachment();
			}
			$po_attach = $poaObj->getDetails('*'," AND iPurchaseOrderID=$iPurchaseOrderID");
			// $po_attach = $poaObj->getDetails('*'," AND iPurchaseOrderID=39");
			//prints($po_attach); exit;
			if(is_array($po_attach) && count($po_attach)>0) {
//				$semi_rand = md5(time());
//				$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

//				$h_append .= "Content-Type: multipart/mixed;\r\n" . " boundary=\"{$mime_boundary}\"";

			// prints($po_attach); exit;
			for($l=0; $l<count($po_attach);$l++) {
				$filepath = $generalobj->GetImagePath(array('section'=>'PO','type'=>'docs','id'=>$iPurchaseOrderID,'name'=>$po_attach[$l]['vFile']));
				// prints($filepath); exit;
				if(file_exists($filepath)) {
					$attachments[$l]['path'] = $filepath;
					$attachments[$l]['name'] = $po_attach[$l]['vFile'];
				}
// file attachment
//			$fileatt = $filepath; // Path to the file
//			$fileatt_type = "application/octet-stream"; // File Type
//			$fileatt_name = $po_attach[$l]['vFile']; 	// Filename that will be used for the file as the attachment

			/*$email_from = ""; // Who the email is from
			$email_subject = ""; // The Subject of the email
			$email_txt = ""; // Message that the email has in it

			$email_to = ""; // Who the email is too

			$headers = "From: ".$email_from;*/

//			$file = fopen($fileatt,'rb');
//			$data = fread($file,filesize($fileatt));
//			fclose($file);
			// prints($data); exit;
//			$data = chunk_split(base64_encode($data));

//			$attach_pre .= "\n\n" .	"--{$mime_boundary}\n" . "Content-Type:text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n";

//			$attach .= "--{$mime_boundary}\n" . "Content-Type: {$fileatt_type};\n" . " name=\"{$fileatt_name}\"\n" . "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";

			/*$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$files[$x]\"\n" .
				"Content-Disposition: attachment;\n" . " filename=\"$files[$x]\"\n" .
				"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
				$message .= "--{$mime_boundary}\n";*/
//
			}
		}
		// $attach = "";
			// prints($attach); exit;
			// prints($invdt); exit;
			$body_arr = Array("#USER#","#ADDED_BY#","#INVCODE#","#SUPPLIERORG#","#SUPORGCODE#","#BUYERORG#","#BUYORGCODE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
			// prints($usrarr); exit;
			if(is_array($emailArr) && count($emailArr) > 0) {
				for($i=0;$i<count($emailArr);$i++) {
					// echo $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName']; exit;
					 $smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
					 $email = $emailArr[$i]['vEmail'];
					 $post_arr = Array($smname,$sess_user_name."($sess_usertype_short)",$invdt[0]['vInvoiceCode'],$invdt[0]['vSupplierName'],$invdt[0]['vInvoiceSupplierCode'],$invdt[0]['vBuyerName'],$invdt[0]['vAssociatePOBuyerCode'],$link,$MAIL_FOOTER,SITE_URL);
					 $sendMail->SendWithAttachments($sub1,"Member",$email,$body_arr,$post_arr,$SITE_NAME,$sub1,'No',$attachments);
				}
			}
			if(is_array($susrarr) && count($susrarr) > 0) {
				for($i=0;$i<count($susrarr);$i++) {
					 $smname = $susrarr[$i]['vFirstName'].' '.$susrarr[$i]['vLastName'];
					 $email = $susrarr[$i]['vEmail'];
					 $post_arr = Array($smname,$SITE_NAME,$invdt[0]['vInvoiceCode'],$invdt[0]['vSupplierName'],$invdt[0]['vInvoiceSupplierCode'],$invdt[0]['vBuyerName'],$invdt[0]['vAssociatePOBuyerCode'],$link,$MAIL_FOOTER,SITE_URL);
					 $sendMail->SendWithAttachments($sub2,"Member",$email,$body_arr,$post_arr,$SITE_NAME,$sub2,'No',$attachments);
				}
			}
			if(is_array($busrarr) && count($busrarr) > 0) {
				for($i=0;$i<count($busrarr);$i++) {
					 $smname = $busrarr[$i]['vFirstName'].' '.$busrarr[$i]['vLastName'];
					 $email = $busrarr[$i]['vEmail'];
					 $post_arr = Array($smname,$SITE_NAME,$invdt[0]['vInvoiceCode'],$invdt[0]['vSupplierName'],$invdt[0]['vInvoiceSupplierCode'],$invdt[0]['vBuyerName'],$invdt[0]['vAssociatePOBuyerCode'],$link,$MAIL_FOOTER,SITE_URL);
					 $sendMail->SendWithAttachments($sub2,"Member",$email,$body_arr,$post_arr,$SITE_NAME,$sub2,'No',$attachments);
				}
			}
		}
//

//	exit;
	$msg = 'invc';
	// $redirecturl = SITE_URL_DUM."invacptlist/".$msg;
	$redirecturl = SITE_URL_DUM."invoicecreate/".$in;
	// $redirecturl = SITE_URL_DUM."binvoiceocreatefpo/".$in;
	// $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
	header("Location:".$redirecturl);
	exit;
}
//
?>