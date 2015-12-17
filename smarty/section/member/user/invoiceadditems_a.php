<?php
if(!isset($invLineObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceDetailLine.php");
	$invLineObj =	new InvoiceDetailLine();
}
if(!isset($orgObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($invOrdObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invOrdObj =	new InvoiceOrderHeading();
}
if(!isset($orgprefObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj =	new OrganizationPreference();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
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

$eInvoiceType = $_POST['invoiceType'];
$iInvoiceID = $_POST['iInvoiceID'];

if(is_array($_POST['vItemCode']) && is_array($_POST['itemCode'])) {
	$vItemCode = array_merge($_POST['itemCode'],$_POST['vItemCode']);
} else if(is_array($_POST['itemCode'])) {
	$vItemCode = $_POST['itemCode'];
} else if(is_array($_POST['vItemCode'])) {
	$vItemCode = $_POST['vItemCode'];
}

if(is_array($eInvoiceType)) {

### SERVER SIDE VALIDATION ####
include(SITE_CLASS_GEN."class.validation.php");
$validation=new Validation();
$RequiredFiledArr = array(
								  'invoiceType' 				=> $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_INVOICE_TYPE'),
								  'vUnitOfMeasure'           => $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_UNIT_MEASURE'),
								  // 'iQuantity'           		=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_QUANTITY'),
								  'fPrice'           			=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PRICE'),
								  'fAmount' 						=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_AMOUNT'),
								  'fVAT' 							=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_VAT'),
								  'fWithHoldingTax' 			=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_WITH_HOLDING_TAX')
						  );
$resArr = $validation->isEmptyMul($RequiredFiledArr);
$nvldmsg = array(
					  'iQuantity' 			=> $smarty->get_template_vars('LBL_QUANTITY')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC'),
					  'fPrice' 				=> $smarty->get_template_vars('LBL_PRICE')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC'),
					  'fAmount' 				=> $smarty->get_template_vars('LBL_PRICE')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC'),
					  'fVAT' 					=> $smarty->get_template_vars('LBL_VAT')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC'),
					  'fWithHoldingTax' 	=> $smarty->get_template_vars('LBL_WITH_HOLDING_TAX')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC')
				  );
if(count($nvldmsg)>0) {
  $nvld_ary = $validation->isNumMul($nvldmsg,'empty');
}
// prints($nvld_ary); exit;
// prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']); exit;
// $resArr = $validation->isEmpty($RequiredFiledArr);
if($resArr || $nvld_ary=='er') {
	header("Location:".$_SERVER['HTTP_REFERER']."");
	exit;
}
### ENDS HERE ###
$invdt = $invOrdObj->select($iInvoiceID);
$cnitm = $invLineObj->getDetails("*"," AND iInvoiceID=$iInvoiceID ");
$subt = 0;
$dist = 0;
$chgt = 0;
$tvat = 0;
$otax = 0;
$whtax = 0;
$ltl = 0;
$ilineItemCode = array();
$ilineItemCode = $vItemCode;
// pr($_POST);
for($i=0; $i < count($eInvoiceType); $i++)
{
	$Data = array();
	$Data['eInvoiceType'] = trim($eInvoiceType[$i]);
	$Data['vItemCode'] = $vItemCode[$i];
	$Data['tDescription'] = $_POST['tDescription'][$i];
	$Data['vUnitOfMeasure'] = $_POST['vUnitOfMeasure'][$i];
        $Data['vPartNo'] = $_POST['vPartNo'][$i];
	$Data['iQuantity'] = $_POST['iQuantity'][$i];
	$Data['fPrice'] = str_replace(",","",$_POST['fPrice'][$i]);
	$Data['fAmount'] = str_replace(",","",$_POST['fAmount'][$i]);
	$Data['fVAT'] = str_replace(",","",$_POST['fVAT'][$i]);
	$Data['fOtherTax1'] = str_replace(",","",$_POST['fOtherTax1'][$i]);
	$Data['fLineTotal'] = str_replace(",","",$_POST['fLineTotal'][$i]);
	$Data['fWithHoldingTax'] = str_replace(",","",$_POST['fWithHoldingTax'][$i]);
	$Data['iPurchaseOrderID'] = $_POST['iPurchaseOrderID'][$i];
	$Data['iRelatedPurchaseOrderLineID'] = $_POST['iRelatedPurchaseOrderLineID'][$i];
	$Data['tReceipt'] = $_POST['tReceipt'][$i];
	$Data['iInvoiceID'] = $_POST['iInvoiceID'];
   $view = $_POST['view'];
	// prints($Data); exit;
	if($Data['eInvoiceType'] == 'Discount') {
		if(is_numeric($Data['fLineTotal'])) { $dist += $Data['fLineTotal']; $ltl = $ltl - $Data['fLineTotal']; }
		$Data['eSublineType'] = '';
		$Data['iSubQuantity'] = 0;
		$Data['fSubRate'] = 0;
		$Data['fSubAmount'] = 0;
	} else if($Data['eInvoiceType'] == 'Charge') {
		if(is_numeric($Data['fLineTotal'])) { $chgt += $Data['fLineTotal']; $ltl = $ltl + $Data['fLineTotal']; }
		$Data['eSublineType'] = '';
		$Data['iSubQuantity'] = 0;
		$Data['fSubRate'] = 0;
		$Data['fSubAmount'] = 0;
		// if(is_numeric($Data['fVAT'])) { $tvat += $Data['fVAT']; }
		// if(is_numeric($Data['fOtherTax1'])) { $otax += $Data['fOtherTax1']; }
		// if(is_numeric($Data['fWithHoldingTax'])) { $whtax += $Data['fWithHoldingTax']; }
		// if(is_numeric($Data['fLineTotal'])) { $ltl += $Data['fLineTotal']; }
	} else {
		if(is_numeric($Data['fAmount'])) { $subt += $Data['fAmount']; }
		if(is_numeric($Data['fVAT'])) { $tvat += $Data['fVAT']; }
		if(is_numeric($Data['fOtherTax1'])) { $otax += $Data['fOtherTax1']; }
		if(is_numeric($Data['fWithHoldingTax'])) { $whtax += $Data['fWithHoldingTax']; }
		if(is_numeric($Data['fLineTotal'])) { $ltl += $Data['fLineTotal']; }
		if(isset($_POST['eSublineType'][$i]) && trim($_POST['eSublineType'][$i]) != '') {
			$Data['eSublineType'] = trim($_POST['eSublineType'][$i]);
			if(trim($_POST['eSublineType'][$i]) == 'Discount') {
				$Data['iSubQuantity'] = intval($_POST['iSubQuantity'][$i]);
				$Data['fSubRate'] = floatval($_POST['fSubRate'][$i]);
				$Data['fSubAmount'] = floatval($_POST['fSubAmount'][$i]);
				$subt = $subt + intval($_POST['fSubAmount'][$i]);
				// $ltl = $ltl + intval($_POST['fSubAmount'][$i]);
			} else if(trim($_POST['eSublineType'][$i]) == 'Charge') {
				$Data['iSubQuantity'] = intval($_POST['iSubQuantity'][$i]);
				$Data['fSubRate'] = floatval($_POST['fSubRate'][$i]);
				$Data['fSubAmount'] = floatval($_POST['fSubAmount'][$i]);
				$subt = $subt + intval($_POST['fSubAmount'][$i]);
				// $ltl = $ltl + intval($_POST['fSubAmount'][$i]);
			} else {
				$Data['iSubQuantity'] = 0;
				$Data['fSubRate'] = 0;
				$Data['fSubAmount'] = 0;
			}
		} else {
			$Data['iSubQuantity'] = 0;
			$Data['fSubRate'] = 0;
			$Data['fSubAmount'] = 0;
		}
	}

	if($Data['fLineTotal']<=0) { 	// $Data['fAmount']<=0 ||
	  	continue;
 	}
	// pr($Data); // exit;
   if($view == '' || $view == 'add')
	{
		$ilineItemCode[] = $vItmCode = $invLineObj->getUniqueCode();
		$Data['vItemCode'] = $vItmCode;
		$vInvItemLineNumber = $generalobj->UniqueID("",PRJ_DB_PREFIX."_invoice_detail_line","iLineNumber",$charlimit="10");
		$Data['iLineNumber'] = $vInvItemLineNumber;
		$Data['dCreatedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		$invLineObj->setAllVar($Data);
		$id = $invLineObj->insert();
		if($id) { $msg = "ras"; } else { $msg="raserr"; }
   } else if($view == 'edit') {
		$invdtls = $invLineObj->getDetails('*'," AND vItemCode='".$Data['vItemCode']."'");
		if(count($invdtls) > 0 && is_array($invdtls)) {
			$ilineItemCode[] = $Data['vItemCode'];
			$where = " vItemCode='".$Data['vItemCode']."'";
			unset($Data['vItemCode']);
			$id = $invLineObj->updateData($Data,$where);
		} else {
			$ilineItemCode[] = $vItmCode = $invLineObj->getUniqueCode();
			$Data['vItemCode'] = $vItmCode;
			$vInvItemLineNumber = $generalobj->UniqueID("",PRJ_DB_PREFIX."_invoice_detail_line","iLineNumber",$charlimit="10");
			$Data['iLineNumber'] = $vInvItemLineNumber;
			$Data['dCreatedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
			$invLineObj->setAllVar($Data);
			$id = $invLineObj->insert();
		}
		if($id) { $msg = "rus"; } else { $msg="ruserr"; }
	}
}
// echo "$subt<br/>$dist<br/>$chgt<br/>$ltl";
// exit;
	$eSaved = $_POST['eSaved'];
	if($eSaved!='') {
		$dtl['eSaved'] = $eSaved;
		$wh_cn = "iInvoiceID=$iInvoiceID";
		$rs = $invOrdObj->updateData($dtl,$wh_cn);
		if($rs && $eSaved!='Yes') {
			$sub1 = "New Invoice Created";
			$type = "Create";
			$actn = "Create";
			$sub2 = "New Invoice";
		}
		//
		/*if($rs && trim($sub1)!='')
		{
		  $dt = array();
		  $dt['iItemID'] = $id = $iInvoiceID;
		  $dt['eSubject'] = $sub1;
		  $dt['eType'] = $type;
		  $dt['vAction'] = $actn;
		  $where = "AND vType='$sub1' AND eSection='Member'" ;
		  $db_email = $emailObj->getDetails('*',$where);
		  $invdt = $invOrdObj->select($id);

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

		  if($invdt[0]['iStatusID'] != $isusts[0]['iStatusID']) {
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
		  }

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
		  }

		  $sts = $nxtstatus['iStatusID'];		//	$invdt[0]['iStatusID'];
		  $usrarr = $orgUsrObj->getPermittedUsers($invdt[0]['iSupplierOrganizationID'],$sts,'inv');

		  $link = SITE_URL_DUM."invoiceview/".$id;
		  if($sub1 == 'New Invoice Created') {
			  $body = Array("#ADDED_BY#","#INVCODE#","#SUPPLIERORG#","#SUPORGCODE#","#BUYERORG#","#BUYORGCODE#","#LINK#");
		  } else {
			  $body = Array("#MODIFIED_BY#","#INVCODE#","#SUPPLIERORG#","#SUPORGCODE#","#BUYERORG#","#BUYORGCODE#","#LINK#");
		  }
		  $post = Array($sess_user_name."($sess_usertype_short)",$invdt[0]['vInvSupplierCode'],$invdt[0]['vSupplierName'],$invdt[0]['vInvoiceSupplierCode'],$invdt[0]['vBuyerName'],$invdt[0]['vAssociatePOBuyerCode'],$link);

		  $rplarr = Array("Hello #NAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
		  $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
		  $emailContent_en = trim(str_replace($body,$post, $tbody_en));
		  $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
		  $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

		  if($vorgid>0) {
			  $dt['iOrganizationID'] = $curORGID; 	// $vorgid; 	// $invdt[0]['iBuyerOrganizationID'];
		  } else {
			  $dt['iOrganizationID'] = $curORGID; 	// $invdt[0]['iSupplierOrganizationID'];
		  }
		  $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
		  $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
		  $dt['tMailContent_en'] = $emailContent_en;
		  $dt['tMailContent_fr'] = $emailContent_fr;
		  $dt['eSubject'] = "Invoice";
		  $dt['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		  $dt['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		  $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		  //$userActionObj->setAllVar($dt);
		  $userActionObj->insert($dt);
		  // prints($dt); exit;

		  if($sfmail == 'yes') {
			  if(!isset($ioaObj)) {
				  include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderAttachment.php");
				  $ioaObj = new InvoiceOrderAttachment();
			  }
			  $inv_attach = $ioaObj->getDetails('*'," AND iInvoiceID=$id"); 	// $iInvoiceID
			  if(is_array($inv_attach) && count($inv_attach)>0) {
				  for($l=0; $l<count($inv_attach);$l++) {
					  $filepath = $generalobj->GetImagePath(array('section'=>'INV','type'=>'docs','id'=>$id,'name'=>$inv_attach[$l]['vFile']));
					  // prints($filepath); exit;
					  if(file_exists($filepath)) {
						  $attachments[$l]['path'] = $filepath;
						  $attachments[$l]['name'] = $inv_attach[$l]['vFile'];
					  }
					  // $sendMail->SendWithAttachments($sub1,"Member",$email,$body_arr,$post_arr,$SITE_NAME,$sub2,'No',$attachments);
				  }
			  }
		  }

		  if($sub1 == 'New Invoice Created') {
			  $body_arr = Array("#NAME#","#ADDED_BY#","#INVCODE#","#SUPPLIERORG#","#SUPORGCODE#","#BUYERORG#","#BUYORGCODE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
		  } else {
			  $body_arr = Array("#NAME#","#MODIFIED_BY#","#INVCODE#","#SUPPLIERORG#","#SUPORGCODE#","#BUYERORG#","#BUYORGCODE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
		  }
		  if(is_array($emailArr) && count($emailArr) > 0) {
			  for($i=0;$i<count($emailArr);$i++) {
					$smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
					$email = $emailArr[$i]['vEmail'];
					$post_arr = Array($smname,$sess_user_name."($sess_usertype_short)",$invdt[0]['vInvSupplierCode'],$invdt[0]['vSupplierName'],$invdt[0]['vInvoiceSupplierCode'],$invdt[0]['vBuyerName'],$invdt[0]['vAssociatePOBuyerCode'],$link,$MAIL_FOOTER,SITE_URL);
					if($sfmail == 'yes' && is_array($attachments) && count($attachments)>0) {
					  $sendMail->SendWithAttachments($sub1,"Member",$email,$body_arr,$post_arr,$SITE_NAME,$sub1,'No',$attachments);
					} else {
					  $sendMail->Send($sub1,"Member",$email,$body_arr,$post_arr);
					}
			  }
		  }
		  if(is_array($usrarr) && count($usrarr) > 0) {
			  for($i=0;$i<count($usrarr);$i++) {
					$smname = $usrarr[$i]['vFirstName'].' '.$usrarr[$i]['vLastName'];
					$email = $usrarr[$i]['vEmail'];
					$post_arr = Array($smname,$sess_user_name."($sess_usertype_short)",$invdt[0]['vInvSupplierCode'],$invdt[0]['vSupplierName'],$invdt[0]['vInvoiceSupplierCode'],$invdt[0]['vBuyerName'],$invdt[0]['vAssociatePOBuyerCode'],$link,$MAIL_FOOTER,SITE_URL);
					if($sfmail == 'yes' && is_array($attachments) && count($attachments)>0) {
					  $sendMail->SendWithAttachments($sub2,"Member",$email,$body_arr,$post_arr,$SITE_NAME,$sub2,'No',$attachments);
					} else {
					  $sendMail->Send($sub2,"Member",$email,$body_arr,$post_arr);
					}
			  }
		  }
	  }*/
		//
	}
	$lineitmCode = "0";
	if(is_array($ilineItemCode) && count($ilineItemCode)>0) {
		$lineitmCode = @implode("','",$ilineItemCode);
	}
	$d = $invLineObj->del(" AND vItemCode NOT IN ('$lineitmCode') AND iInvoiceID=$iInvoiceID ");

	$idt = array();
	if($invdt[0]['eLineItemTax']=='Yes' || (!($invdt[0]['fVat']>0) && $tvat>0)) {
		$idt['fVat'] = $tvat;
		// $pdt['fOther_tax_1'] = $otax;
	}
	if($invdt[0]['eLineItemTax']=='Yes' || (!($invdt[0]['fOthertax1']>0) && $otax>0)) {
		// $pdt['fVat'] = $tvat;
		$idt['fOthertax1'] = $otax;
	}
	if($invdt[0]['eLineItemTax']=='Yes' || (!($invdt[0]['fWithHoldingTax']>0) && $whtax>0)) {
		// $pdt['fVat'] = $tvat;
		$idt['fWithHoldingTax'] = $whtax;
	}
	$idt['fSubTotal'] = $subt;
	$idt['fDiscount'] = $dist;
	$idt['fCharge'] = $chgt;
	$u = $invOrdObj->updateData($idt," iInvoiceID=$iInvoiceID ");
	// check for total
	/*if($invdt[0]['fInvoiceTotal']>0) {
		if(trim($ltl)!=trim($invdt[0]['fInvoiceTotal'])) {
			$msg = "tmm";
			header("Location:".SITE_URL_DUM."invoicecreate/$iInvoiceID/$msg");
			exit;
		}
	} else {*/
		if($ltl>0) {
			$idt['fInvoiceTotal'] = trim($ltl);
		} else {
			$idt['fInvoiceTotal'] = 0;
		}
		$u = $invOrdObj->updateData($idt," iInvoiceID=$iInvoiceID ");
	// }
} else {
	$lineitmCode = "0";
	if(is_array($ilineItemCode) && count($ilineItemCode)>0) {
		$lineitmCode = @implode("','",$ilineItemCode);
	}
	$d = $invLineObj->del(" AND vItemCode NOT IN ('$lineitmCode') AND iInvoiceID=$iInvoiceID ");
	$eSaved = $_POST['eSaved'];
	if($eSaved=='Yes') {
		$dtl['eSaved'] = $eSaved;
		$wh_cn = "iInvoiceID=$iInvoiceID";
		$rs = $invOrdObj->updateData($dtl,$wh_cn);
	}
}

if(isset($_SESSION['invadd'])) {
	unset($_SESSION['invadd']);
}
if($msg != 'raserr' && $msg != 'ruserr') {
	if(is_array($cnitm) && count($cnitm)>0) {
		$msg = 'rus';
	} else {
		$msg = 'ras';
	}
}
$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
$isusts =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
$isusts = $isusts[0]['iStatusID'];
if($invdt[0]['iStatusID'] >= $isusts && $curORGID == $invdtl[0]['iBuyerOrganizationID']) {
	header("Location:".SITE_URL_DUM."invacptlist/$msg");
} else {
	if($invdt[0]['iBuyerOrganizationID']==$curORGID && $invdt[0]['eCreateByBuyer']=='Yes') {
		header("Location:".SITE_URL_DUM."invacptlist/$msg");
	} else {
		header("Location:".SITE_URL_DUM."invoicelist/$msg");
	}
}
exit;
?>