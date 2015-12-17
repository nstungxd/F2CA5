<?php
$parameter = $_GET['tParameters'];
$rptfls = array();
// $inetreportsfiles = (isset($sess_usertype_short) && (trim($sess_usertype_short)=='OA' || trim($sess_usertype_short)=='OU'))? $inetreportsfiles.'/adminrpt' : $inetreportsfiles.'/userrpt';
// $rptfiles = scandir(SPATH_ROOT.$inetreportsfiles);
if(! isset($rptReportsObj)) {
   include_once(SITE_CLASS_APPLICATION."class.RPTReports.php");
   $rptReportsObj = new RPTReports();
}
if(!isset($pursesordObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
   $pursesordObj = new PurchaseOrderHeading();
}
if(!isset($invoiceObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
   $invoiceObj = new InvoiceOrderHeading();
}
if($parameter == "po") {
   $rptfiles = $rptReportsObj->getDetails('*'," AND eType='$sess_usertype_short' AND eStatus='Active' AND tParameters LIKE '%po_id%'");
} else if($parameter == "inv") {
   $rptfiles = $rptReportsObj->getDetails('*'," AND eType='$sess_usertype_short' AND eStatus='Active' AND tParameters LIKE '%invoice_id%'");
} else {
	$rptfiles = $rptReportsObj->getDetails('*'," AND eType='$sess_usertype_short' AND eStatus='Active'");
}
// pr($rptfiles);exit;
$iID = $_GET['id'];
$prms = array();
$rptdesc = array();
if(is_array($rptfiles) && count($rptfiles)>0)
{
	$shoc = "none";
	$shuc = "none";
	//
	if($sess_usertype_short == 'SM') {
		$orgcary = array(
			"ID"					=>	"promptorganization_id",
			"Name" 				=>	"promptorganization_id",
			"Type"				=>	"Query",
			"tableName" 		=>	PRJ_DB_PREFIX."_organization_master",
			"fieldId" 			=>	"iOrganizationID",
			"fieldName"			=>	"vCompanyName",
			"extVal"				=>	'',
			"selectedVal" 		=>	'',
			"width"  			=>	'230px',
			"height"  			=>	'',
			"onchange" 			=>	'',
			"selectText" 		=>	"--- ".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_ORGANIZATION')." ---",
			"where" 				=>	"eStatus ='Active' ",
			"multiple_select" =>	"",
			"orderby" 			=>	'',
			"extra"				=>	"title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_ORGANIZATION')."'",
			"validationmsg"	=> "",
			"class" 				=> "required"
		);
		$org_combo = $gdbobj->DynamicDropDown($orgcary);
		$org_combo = str_replace('"','\"',$org_combo);
		$org_combo = "<span class='porg' style='display:inline-block;'>".$org_combo."</span><span style='float:right; padding-right:70px;'>".$smarty->get_template_vars('LBL_FILTER_LIST_BY')." : <input type='text' name='orgfilter' id='orgfilter' style='width:100px;' /></span>";
		$shoc = '';
	} else {
		$org_combo = "<input type='text' name='promptorganization_id' id='promptorganization_id' class='required' value='".$curORGID."' />";
	}
	//
	if($sess_usertype_short != 'OU') {
		$wh = '';
		if($sess_usertype_short == 'OA') {
			$wh = "AND iOrganizationID = $curORGID";
		}
		$usercary = array(
			"ID"					=>	"promptuser_id",
			"Name" 				=>	"promptuser_id",
			"Type"				=>	"Query",
			"tableName" 		=>	PRJ_DB_PREFIX."_organization_user",
			"fieldId" 			=>	"iUserID",
			"fieldName"			=>	"vUserName",
			"extVal"				=>	'',
			"selectedVal" 		=>	'',
			"width"  			=>	'230px',
			"height"  			=>	'',
			"onchange" 			=>	'',
			"selectText" 		=>	"--- ".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_USER')." ---",
			"where" 				=>	" eStatus = 'Active' $wh ",
			"multiple_select" =>	"",
			"orderby" 			=>	'',
			"extra"				=>	"title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_USER')."'",
			"validationmsg"	=> "",
			"class" 				=> "required"
		);
		$user_combo = $gdbobj->DynamicDropDown($usercary);
		$user_combo = str_replace('"','\"',$user_combo);
		$user_combo = "<span class='puser' style='display:inline-block;'>".$user_combo."</span><span style='float:right; padding-right:70px;'>".$smarty->get_template_vars('LBL_FILTER_LIST_BY')." : <input type='text' name='usrfilter' id='usrfilter' style='width:100px;' /></span>";
		$shuc = '';
	} else {
		$user_combo = "<input type='text' name='promptuser_id' id='promptuser_id' class='required' value='".$sess_id."' />";
	}
	//
	if($sess_usertype_short != 'SM') {
		$wh = "(iSupplierOrganizationID = $curORGID OR iBuyerOrganizationID = $curORGID)";
		$invcary = array(
			"ID"					=>	"promptinvoice_id",
			"Name" 				=>	"promptinvoice_id",
			"Type"				=>	"Query",
			"tableName" 		=>	PRJ_DB_PREFIX."_inovice_order_heading",
			"fieldId" 			=>	"iInvoiceID",
			"fieldName"			=>	"vInvSupplierCode",
			"extVal"				=>	'',
			"selectedVal" 		=>	'',
			"width"  			=>	'230px',
			"height"  			=>	'',
			"onchange" 			=>	'',
			"selectText" 		=>	"--- ".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_INVOICE')." ---",
			"where" 				=>	" $wh ",
			"multiple_select" =>	"",
			"orderby" 			=>	'',
			"extra"				=>	"title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_INVOICE')."'",
			"validationmsg"	=> "",
			"class" 				=> "required"
		);
		if($parameter == "inv")
		{
			$res = $invoiceObj->getDetails('iInvoiceID,vInvSupplierCode',"and iInvoiceID=$iID AND (iSupplierOrganizationID = $curORGID OR iBuyerOrganizationID = $curORGID)");
			$inv_combo = $res[0]['vInvSupplierCode'];
			$inv_combo = "<span class='pinv' style='display:inline-block;'>".$inv_combo."</span><input type='hidden' name='promptinvoice_id' id='promptinvoice_id' value='".$res[0]['iInvoiceID']."'>";
		} else {
			$inv_combo = $gdbobj->DynamicDropDown($invcary);
			$inv_combo = str_replace('"','\"',$inv_combo);
			$inv_combo = "<span class='pinv' style='display:inline-block;'>".$inv_combo."</span><span style='float:right; padding-right:70px;'>".$smarty->get_template_vars('LBL_FILTER_LIST_BY')." : <input type='text' name='invfilter' id='invfilter' style='width:100px;' /></span>";
		}


        }
	//
	if($sess_usertype_short != 'SM') {
		$wh = "(iSupplierOrganizationID = $curORGID OR iBuyerOrganizationID = $curORGID)";
		$pocary = array(
			"ID"					=>	"promptpo_id",
			"Name" 				=>	"promptpo_id",
			"Type"				=>	"Query",
			"tableName" 		=>	PRJ_DB_PREFIX."_purchase_order_heading",
			"fieldId" 			=>	"iPurchaseOrderID",
			"fieldName"			=>	"vPoBuyerCode",
			"extVal"				=>	'',
			"selectedVal" 		=>	'',
			"width"  			=>	'230px',
			"height"  			=>	'',
			"onchange" 			=>	'',
			"selectText" 		=>	"--- ".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_PURCHASE_ORDER')." ---",
			"where" 				=>	" $wh ",
			"multiple_select" =>	"",
			"orderby" 			=>	'',
			"extra"				=>	"title='".$smarty->get_template_vars('LBL_SELECT').' '.$smarty->get_template_vars('LBL_PURCHASE_ORDER')."'",
			"validationmsg"	=> "",
			"class" 				=> "required"
		);
		if($parameter == "po")
		{
		   $res = $pursesordObj->getDetails('iPurchaseOrderID,vPoBuyerCode',"and iPurchaseOrderID=$iID AND (iSupplierOrganizationID = $curORGID OR iBuyerOrganizationID = $curORGID)");
		   $po_combo = $res[0]['vPoBuyerCode'];
		   $po_combo = "<span class='pinv' style='display:inline-block;'>".$po_combo."</span><input type='hidden' name='promptpo_id' id='promptpo_id' value='".$res[0]['iPurchaseOrderID']."'>";
		} else {
		   $po_combo = $gdbobj->DynamicDropDown($pocary);
		   $po_combo = str_replace('"','\"',$po_combo);
		   $po_combo = "<span class='ppo' style='display:inline-block;'>".$po_combo."</span><span style='float:right; padding-right:70px;'>".$smarty->get_template_vars('LBL_FILTER_LIST_BY')." : <input type='text' name='pofilter' id='pofilter' style='width:100px;' /></span>";
		}

	}
	//
	for($l=0;$l<count($rptfiles);$l++) {
		// if(is_file(SPATH_ROOT.$inetreportsfiles.'/'.$rptfiles[$l])) { 	// && file_exists(SPATH_ROOT.$inetreportsfiles.'/'.$rptfiles[$l])
		// if(is_file($rptfiles[$l]['tPath']) && file_exists($rptfiles[$l]['tPath'])) { 	// && file_exists(SPATH_ROOT.$inetreportsfiles.'/'.$rptfiles[$l])
			$params = @ explode(',',$rptfiles[$l]['tParameters']);
			$params = array_filter($params);
			$params = array_unique($params);
			$prms[$rptfiles[$l]['iReportId']] = "<el pth='".$rptfiles[$l]['tPath']."' style='display:;'>";
			$rptdesc[$rptfiles[$l]['iReportId']] = (trim($rptfiles[$l]['tDescription'])!='')? stripslashes($rptfiles[$l]['tDescription']) : '---';
			if(count($params)>0) {
				for($j=0;$j<count($params);$j++) {
					// $prms .= "<div><label style='display:inline-block; width:190px;'>$params[$j]:</label> <span style='display:inline-block;'><input type='text' name='parameters[".$params[$j]."]' id='".$params[$j]."' class='required' title='".$smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_VALUE')."' /></span></div><br/>";
					if($params[$j] == 'organization_id') {
						$prms[$rptfiles[$l]['iReportId']] .= "<div style='display:$shoc;'><label style='display:inline-block; width:190px;'>$params[$j]:</label> $org_combo<br/><br/></div>";
					} else if($params[$j] == 'user_id') {
						$prms[$rptfiles[$l]['iReportId']] .= "<div style='display:$shuc;'><label style='display:inline-block; width:190px;'>$params[$j]:</label> $user_combo<br/><br/></div>";
					} else if($params[$j] == 'invoice_id') {
						if($sess_usertype_short != 'SM') {
							$prms[$rptfiles[$l]['iReportId']] .= "<div style='display:;'><label style='display:inline-block; width:190px;'>".$smarty->get_template_vars('LBL_INVOICE').":</label> $inv_combo<br/><br/></div>";
						}
					} else if($params[$j] == 'po_id') {
						if($sess_usertype_short != 'SM') {
							$prms[$rptfiles[$l]['iReportId']] .= "<div style='display:;'><label style='display:inline-block; width:190px;'>".$smarty->get_template_vars('LBL_PURCHASE_ORDER').":</label> $po_combo<br/><br/></div>";
						}
					} elseif($params[$j] == 'from_date') {
						if($sess_usertype_short != 'SM') {
							$prms[$rptfiles[$l]['iReportId']] .="<div style='margin-bottom:5px;'><label style='display:inline-block; width:190px;'>".$smarty->get_template_vars('LBL_FROM_DATE')." :</label><input type='text' name='prompt$params[$j]' class='required' title='".$smarty->get_template_vars('LBL_PLS_FROM_DATE')."' readonly id='prompt$params[$j]' style='width:139px'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";
						}
					} elseif($params[$j] == 'to_date') {
						if($sess_usertype_short != 'SM') {
							$prms[$rptfiles[$l]['iReportId']] .="<div><label style='display:inline-block; width:190px;'>".$smarty->get_template_vars('LBL_TO_DATE')." :</label><input type='text' name='prompt$params[$j]' title='".$smarty->get_template_vars('LBL_PLS_TO_DATE')."' class='required' readonly id='prompt$params[$j]' style='width:139px'/></div>";
						}
					} else {
						$prms[$rptfiles[$l]['iReportId']] .= "<div><label style='display:inline-block; width:190px;'>$params[$j]:</label> <span style='display:inline-block;'><input type='text' name='prompt".$params[$j]."' id='prompt".$params[$j]."' class='required' title='".$smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_VALUE')."' /></span><br/><br/></div>";
					}
				}
				// $prms[$rptfiles[$l]['iReportId']] .= "<div style='display:$shoc;'><label style='display:inline-block; width:190px;'>$params[$j]:</label> <span class='porg' style='display:inline-block;'>$org_combo</span></div><br/>";
				// $prms[$rptfiles[$l]['iReportId']] .= "<div style='display:$shuc;'><label style='display:inline-block; width:190px;'>$params[$j]:</label> <span class='puser' style='display:inline-block;'>$user_combo</span></div><br/>";
			} else {
				$prms[$rptfiles[$l]['iReportId']] .= $smarty->get_template_vars('LBL_NO_REPORT_PARAMETERS_AVAILABLE');
			}

			$prms[$rptfiles[$l]['iReportId']] .= "</el>";
			$rptfls[] = array('iReportId'=>$rptfiles[$l]['iReportId'], 'name' => $rptfiles[$l]['vReportName'], 'path' => $rptfiles[$l]['tPath'],'params' => $params, 'ptext' => $prms[$rptfiles[$l]['iReportId']]); 	// substr($rptfiles[$l],0,-4);
		// }
	}
	//exit;
	//$prms[$rptfiles[$l]['iReportId']] .= "<div style='display:none;'><label style='display:inline-block; width:190px;'>$params[$j]:</label> <span style='display:inline-block;'><input type='text' name='promptuser_id' id='promptuser_id' class='required' title='".$sess_id."' /></span></div><br/>";
	//$prms[$rptfiles[$l]['iReportId']] .= "<div style='display:none;'><label style='display:inline-block; width:190px;'>$params[$j]:</label> <span style='display:inline-block;'><input type='text' name='promptorganization_id' id='promptorganization_id' class='required' title='".$curORGID."' /></span></div><br/>";
}
// echo $INET_SERVER_URL; exit;
// pr($_SESSION); exit;
// pr($rptfls); exit;
// exit;

$inetserverurl = (! isset($INET_SERVER_URL) || trim($INET_SERVER_URL)=='')? '' : trim($INET_SERVER_URL,'\/');
$smarty->assign("prms", @ join("\", \"", $prms));
// echo @ join("\", \"", $prms); exit;
$smarty->assign("rptdesc", @ join("\", \"", $rptdesc));
// echo @ join("\", \"", $rptdesc); exit;
$smarty->assign("rptfls", $rptfls);
$smarty->assign("inetserverurl", $inetserverurl);

?>