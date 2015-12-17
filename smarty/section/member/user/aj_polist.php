<?php
	include(S_SECTIONS."/member/memberaccess.php");
   $mode = $_POST['mod'];
   $val = $_POST['val'];
   $poStatus=$_POST['poStatus'];

   $vPONumber = (isset($_POST['vPONumber']))? $_POST['vPONumber'] : '';
   $vPOCode = (isset($_POST['vPOCode']))? $_POST['vPOCode'] : '';
   $buyername = (isset($_POST['buyername']))? $_POST['buyername'] : '';
   $vSupplierName = (isset($_POST['vSupplierName']))? $_POST['vSupplierName'] : '';
   $fPOTotal = (isset($_POST['fPOTotal']))? $_POST['fPOTotal'] : '';
   $iNetPaymentDays = (isset($_POST['iNetPaymentDays']))? $_POST['iNetPaymentDays'] : '';
   $fDate = (isset($_POST['fDate']))? $_POST['fDate'] : '';
   $tDate = (isset($_POST['tDate']))? $_POST['tDate'] : '';
   $status = (isset($_POST['status']))? $_POST['status'] : '';

	$page = $_POST['page'];
	if(trim($page) == '' || trim($page) < 1) {
	  $page = 1;
   }
	// prints($_POST); exit;
	if(!isset($poObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
		$poObj = new PurchaseOrderHeading();
	}

   if(!isset($orgGroupObj)) {
      include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
      $orgGroupObj =	new OrganizationGroup();
   }

	$whr = "";
	$where = "";
	$crsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Create' ");
	$crsts = $crsts[0]['iStatusID'];
	$vsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Verify' ");
	$vsts = $vsts[0]['iStatusID'];
	$isusts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Issued' ");
	$isusts = $isusts[0]['iStatusID'];
	$iusts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Issue' ");
	$iusts = $iusts[0]['iStatusID'];
	$acptsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Accepted' ");
	$acptsts = $acptsts[0]['iStatusID'];
	$rsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Rejected' ");
	$rsts = $rsts[0]['iStatusID'];
	if($sess_usertype_short == 'OU') {
		// $where .= " AND (poh.iInvoiceID=0 OR poh.iInvoiceID='') ";
		$where .= " AND poh.iBuyerOrganizationID=$curORGID ";
	}
	if($mode == 'srch') {
      if(trim($vPONumber) != '') {
			$whr = " AND poh.vPONumber LIKE '%$vPONumber%'";
		}
		if(trim($vPOCode) != '') {
			$whr .= " AND poh.vPoBuyerCode LIKE '%$vPOCode%'";
		}
      if(trim($buyername) != '') {
			$whr .= " AND poh.vBuyerCompanyName LIKE '%$buyername%'";
		}
      if(trim($vSupplierName) != '') {
			$whr .= " AND (select org.vCompanyName from b2b_organization_master org where org.iOrganizationID=poh.iSupplierOrganizationID) LIKE '%$vSupplierName%'";
		}
      if(trim($fPOTotal) != '') {
			$whr .= " AND poh.fPOTotal LIKE '%$fPOTotal%'";
		}
      if(trim($iNetPaymentDays) != '') {
			$whr .= " AND DATEDIFF(NOW(),poh.dCreateDate) LIKE '%$iNetPaymentDays%'";
		}
      if(trim($fDate) != '') {
			$whr .= " AND poh.dCreateDate>='$fDate'";
		}
      if(trim($tDate) != '') {
			$whr .= " AND poh.dCreateDate<='$tDate'";
		}
      if(trim($status) != '') {
			if(strtolower(trim($status))=='saved') {
				$whr .= " AND poh.eSaved='Yes'";
			} else {
				$whr .= " AND sm.vStatus_".LANG." LIKE '%$status%'";
			}
		}
	}

	$poOrgStatusIds = $crsts.",".$opf[0]['vOrderStatusLevel'];
	if(trim($poOrgStatusIds)!='') {
		if(strpos($poOrgStatusIds,',')!==false) {
			$pousts = @explode(',',$poOrgStatusIds);
		} else {
			$pousts = $poOrgStatusIds;
		}
	} else {
		$pousts = array();
	}
	$iprvsts = '';
     if($poStatus != 'all' && $poStatus != '')
     {
			if(!isset($statusmasterObj)) {
				  include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
				  $statusmasterObj =	new StatusMaster();
			}

			// prints($opf[0]['vOrderStatusLevel']); exit;
			$orgposl = @explode(",",$opf[0]['vOrderStatusLevel']);

			if($poStatus==$crsts) {
				$poStatus = $crsts;
				$where .= " AND poh.eSaved='Yes'";
			} else if($poStatus==$vsts) {
				$poStatus = $crsts;
				$where .= " AND poh.iStatusID=$crsts AND poh.eSaved!='Yes'";
			} else if($poStatus!=$isusts && $poStatus!=$acptsts && $poStatus!=$rsts) {
				$where .= " AND poh.eSaved!='Yes' ";
				for($l=0;$l<count($orgposl);$l++) {
					if($orgposl[$l]==$poStatus) {
						if(isset($orgposl[$l-1])) {
							$iprvsts = $orgposl[$l-1];
							// $poStatus = $iprvsts;
						}
					}
				}
				if($opf[0]['eReqVerificationPo']=='No' && $poStatus==$iusts) {
					$iprvsts = $crsts;
					$poStatus = $iprvsts;
				}
				if(in_array($iprvsts,$pousts)) {
					$where .= " AND poh.iStatusID=".$iprvsts;
				} else {
					$where .= " AND poh.iStatusID=''";
				}
			} else {
				if(in_array($poStatus,$pousts)) {
					$where .= " AND poh.iStatusID=".$poStatus . " AND poh.eSaved!='Yes' ";
				} else {
					$where .= " AND poh.iStatusID=''";
				}
			}
			// echo $where; exit;
			$poDetail = $statusmasterObj->getStatusDetails($poStatus,'PO');
			if($poDetail[0]['vStatus'] == 'Issuance')
			{
				 $iAuthIDs=$statusmasterObj->getDetails("group_concat(iStatusid) as authIDs","AND vStatus_en like('%auth%') and efor='PO'");
			  //  print_r($iAuthIDs);
				 $iAuthIDs=$iAuthIDs[0]['authIDs'];
				 if($iAuthIDs != '')
				 $where .= " OR sm.iStatusID in(".$iAuthIDs.")";
			}
     }
     //print "A".$poUserStatusIds;
     //print $poUserStatusIds;

/*	if($orgtype == 'Supplier' && ($poStatus == $isusts || $poStatus == $acptsts || ($poStatus=='' && $orgtype == 'Supplier'))) {
		if(trim($poStatus) == '') {
		  $where = " AND poh.iSupplierOrganizationID=$curORGID AND poh.iStatusID IN ($isusts,$acptsts) ";
		} else if(is_numeric($poStatus) && $poStatus>0) {
			if($poStatus == $isusts || $poStatus == $acptsts) {
				$where = " AND poh.iSupplierOrganizationID=$curORGID AND poh.iStatusID=$poStatus ";
			}
		}
//		if($invsts == 'isu') {
//		  $isusts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issued' ");
//		  $isusts = $isusts[0]['iStatusID'];
//		  $where = " AND ioh.iSupplierOrganizationID=$curORGID AND ioh.iStatusID=$isusts ";
//		} else if($invsts == 'acpt') {
//		  $acptsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
//		  $acptsts = $acptsts[0]['iStatusID'];
//		  $where = " AND ioh.iSupplierOrganizationID=$curORGID AND ioh.iStatusID=$acptsts ";
//		}
	} else if($orgtype == 'Both' && ($poStatus == $isusts || $poStatus == $acptsts || $poStatus=='')) {
			$where .= " AND poh.iBuyerOrganizationID=$curORGID ";
		   if(trim($poStatus) == '') {
			 $where .= " OR (poh.iSupplierOrganizationID=$curORGID AND poh.iStatusID IN ($isusts,$acptsts)) ";
		   } else if(is_numeric($poStatus) && $poStatus>0) {
			 if($poStatus == $isusts || $poStatus == $acptsts) {
				$where .= " OR (poh.iSupplierOrganizationID=$curORGID AND poh.iStatusID=$poStatus) ";
			}
		}
	} else {
		$where .= " AND poh.iStatusID in (".$poOrgStatusIds.") AND poh.iBuyerOrganizationID=$curORGID ";
	}
*/
	if($sess_usertype_short == 'OU') {
		$where .= " AND poh.iStatusID in (".'0,'.$poOrgStatusIds.") AND poh.iBuyerOrganizationID=$curORGID ";
	} else if($sess_usertype_short == 'OA') {
		$postar = array();
		$posts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' ");
		for($l=0;$l<count($posts);$l++) {
			$postar[] = $posts[$l]['iStatusID'];
		}
		$polvlst = @implode(',',$postar);
		$where .= " AND poh.iStatusID in (".'0,'.$polvlst.") AND poh.iBuyerOrganizationID=$curORGID ";
	}
	if($sess_usertype_short == 'OA') {
		$where .= " OR (poh.iSupplierOrganizationID=$curORGID AND poh.iStatusID>=$isusts AND poh.iaStatusID!=$rsts) "; 	// AND (Select Count(iInvoiceID) from b2b_inovice_order_heading where iPurchaseOrderID=poh.iPurchaseOrderID)>0)
	}
// OR (poh.iSupplierOrganizationID=12 AND (Select Count(iInvoiceID) from b2b_inovice_order_heading where iPurchaseOrderID=poh.iPurchaseOrderID)>0)
	// echo $where; exit;
	if($_POST['poStatus']=='0') {
		$where = " AND poh.iStatusID=0 AND poh.iBuyerOrganizationID=$curORGID ";
	}
   ### SORTING ###
   $cursort = $_POST['cursort'];
   $cursorttype = $_POST['cursorttype'];
   if($cursort != ''){
      if($cursorttype == '1') {
         $cursort_type = 'ASC';
      } else {
         $cursort_type = 'DESC';
      }
      $orderBy = " $cursort $cursort_type";
   } else {
      $orderBy = " poh.dCreateDate DESC ";
   }
	// echo $orderBy; exit;
   ## ENDS HERE ###

	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
   // print $where;
	$where = $where . $whr;
	// echo $where; exit;
     //and poh.iStatusID in (".$poOrgStatusIds.")
 	$jtbl = "";
   $jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on (IF(poh.iSupplierOrganizationID=$curORGID,sm.iStatusID = poh.iaStatusID,sm.iStatusID = poh.iStatusID)) ";
   $jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_organization_user ou on ou.iUserID =  poh.iBuyerID";
   $fields = " poh.*,(select org.vCompanyName from b2b_organization_master org where org.iOrganizationID=poh.iSupplierOrganizationID) as vSupplierName,sm.vStatus_".LANG." as status,CONCAT(ou.vFirstName,' ',ou.vLastName) as buyername, DATEDIFF(NOW(),poh.dCreateDate) as days ";
	$activegroup = $poObj->getJoinTableInfo($jtbl,$fields,$where,$orderBy,'',$limit,'yes');
   // prints($activegroup);exit;
	//$orglist = $orgGroupObj->getDetails_PG('*',$where,$orderBy,'',$limit);
	$count = $activegroup['tot'];
	unset($activegroup['tot']);

   if(!isset($pgajxobj)) {
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
		$pgajxobj = new Paging($count,$page,"listgroup",$REC_LIMIT_FRONT);
	}
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");
	//echo $paging; exit;

	  $rejectStatusID=$statusmasterObj->getDetails('iStatusID',' AND vStatus_en="Rejected" AND eFor="PO"');
	  $rejectStatusID=$rejectStatusID[0]['iStatusID'];
	  $deletepo = "";
	  if($poStatus == $rejectStatusID)
	  {
	      $deletepo='Yes';
	  }
	  //print $deletePo;
	// pr($activegroup); exit;
	$smarty->assign('activegroup',$activegroup);
	//$smarty->assign('orglist',$orglist);
	$smarty->assign('isusts',$isusts);
	$smarty->assign('count',$count);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
	$smarty->assign("poObj",$poObj);
	$smarty->assign("acptsts",$acptsts);
   $smarty->assign('deletepo',$deletepo)
   //print_r($_SESSION);
?>