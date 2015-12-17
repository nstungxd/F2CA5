<?php
	include(S_SECTIONS."/member/memberaccess.php");
   $mode = (isset($_POST['mod']))? $_POST['mod'] : '';
   $val = (isset($_POST['val']))? $_POST['val'] : '';
   $poStatus = (isset($_POST['poStatus']))? $_POST['poStatus'] : '';

   $vPONumber = (isset($_POST['vPONumber']))? $_POST['vPONumber'] : '';
   $vPOCode = (isset($_POST['vPOCode']))? $_POST['vPOCode'] : '';
   $buyername = (isset($_POST['buyername']))? $_POST['buyername'] : '';
   $vSupplierName = (isset($_POST['vSupplierName']))? $_POST['vSupplierName'] : '';
   $fPOTotal = (isset($_POST['fPOTotal']))? $_POST['fPOTotal'] : '';
   $iNetPaymentDays = (isseT($_POST['iNetPaymentDays']))? $_POST['iNetPaymentDays'] : '';
   $fDate = (isset($_POST['fDate']))? $_POST['fDate'] : '';
   $tDate = (isset($_POST['tDate']))? $_POST['tDate'] : '';
   $status = (isset($_POST['status']))? $_POST['status'] : '';

	$page = (isset($_POST['page']))? $_POST['page'] : '';
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
	// $where .= " AND poh.iInvoiceID>0 ";
	$crsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Create' ");
	$crsts = $crsts[0]['iStatusID'];
	$vsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Verify' ");
	$vsts = $vsts[0]['iStatusID'];
	$iusts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Issue'");
	$iusts = $iusts[0]['iStatusID'];
	$isusts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Issued'");
	$isusts = $isusts[0]['iStatusID'];
	$acptsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Accepted' ");
	$acptsts = $acptsts[0]['iStatusID'];
	$rsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Rejected' ");
	$rsts = $rsts[0]['iStatusID'];
	$where .= " AND (poh.iStatusID>=$isusts OR poh.iaStatusID=$rsts) ";
	$where .= " AND poh.iSupplierOrganizationID=$curORGID ";
	if($mode == 'srch')	{
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
			$whr .= " AND poh.dCreateDate >= '$fDate'";
		}
      if(trim($tDate) != '') {
			$whr .= " AND poh.dCreateDate <= '$tDate'";
		}
      if(trim($status) != '') {
			if(strtolower(trim($status))=='saved') {
				$whr .= " AND poh.eSaved='Yes'";
			} else {
				$whr .= " AND sm.vStatus_".LANG." LIKE '%$status%'";
			}
		}
	}

	$poOrgAcptIds = $crsts.",".$opf[0]['vOrderAcceptanceLevel'];
	if(trim($poOrgAcptIds)!='') {
		if(strpos($poOrgAcptIds,',')!==false) {
			$poacpt = @explode(',',$poOrgAcptIds);
		} else {
			$poacpt = $poOrgAcptIds;
		}
	} else {
		$poacpt = array();
	}
	// prints($orgposl); exit;
	$iprvsts = '';
     if($poStatus != 'all' && $poStatus != '')
     {
          if(!isset($statusmasterObj)) {
               include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
               $statusmasterObj =	new StatusMaster();
          }

			$orgposl = @explode(",",$opf[0]['vOrderAcceptanceLevel']);
			// prints($orgposl); exit;
			if($poStatus==$crsts) {
				$poStatus = 0;
				$where .= " AND poh.iStatusID=$isusts AND poh.iaStatusID=0 ";
			} else if($poStatus==$vsts) {
				$poStatus = $crsts;
				$where .= " AND poh.iaStatusID=$crsts ";
			} else if($poStatus!=$isusts && $poStatus!=$acptsts && $poStatus!=$rsts) {
				for($l=0;$l<count($orgposl);$l++) {
					if($orgposl[$l]==$poStatus) {
						if(isset($orgposl[$l-1])) {
							$iprvsts = $orgposl[$l-1];
							$poStatus = $iprvsts;
						}
					}
				}
				if($iprvsts=='' && $opf[0]['eReqVerifyPoAcpt']=='No') {
					$iprvsts = $crsts;
					$poStatus = $iprvsts;
				}
				if($poStatus==$iusts) {
					$poStatus = $iprvsts = $vsts;
					$where .= " AND poh.iaStatusID=$vsts ";
				}
				if(in_array($iprvsts,$poacpt)) {
					$where .= " AND poh.iaStatusID=".$iprvsts;
				} else {
					$where .= " AND poh.iaStatusID=''";
				}
			} else {
				if($poStatus==$iusts) {
					$poStatus = $iprvsts = $vsts;
					$where .= " AND poh.iaStatusID=$vsts ";
				}
				if(in_array($poStatus,$poacpt)) {
					$where .= " AND poh.iaStatusID=".$poStatus;
				} else {
					$where .= " AND poh.iaStatusID=''";
				}
			}
         // $where .= " AND poh.iaStatusID=".$poStatus;
			// echo $where; exit;
          $poDetail = $statusmasterObj->getStatusDetails($poStatus,'PO');
          if($poDetail[0]['vStatus'] == 'Issuance')
          {
              $iAuthIDs=$statusmasterObj->getDetails("group_concat(iStatusID) as authIDs","AND vStatus_en like('%auth%') and efor='PO'");
            //  print_r($iAuthIDs);
              $iAuthIDs=$iAuthIDs[0]['authIDs'];
              if($iAuthIDs != '')
              $where .= " OR sm.iStatusID in(".$iAuthIDs.")";
          }
     }
     //print "A".$poUserStatusIds;
     //print $poUserStatusIds;
	if($orgtype == 'Supplier' && ($poStatus == $isusts || $poStatus == $acptsts || ($poStatus=='' && $orgtype == 'Supplier'))) {
		if(trim($poStatus) == '') {
		  // $where = " AND poh.iSupplierOrganizationID=$curORGID AND poh.iStatusID IN ($isusts,$acptsts) ";
		  $where = " AND poh.iSupplierOrganizationID=$curORGID AND poh.iaStatusID IN ($poOrgAcptIds) ";
		} else if(is_numeric($poStatus) && $poStatus>0 && in_array($poStatus,$poacpt)) {
			if($poStatus == $isusts || $poStatus == $acptsts) {
				$where = " AND poh.iSupplierOrganizationID=$curORGID AND poh.iaStatusID=$poStatus ";
			}
		}
		/*if($invsts == 'isu') {
		  $isusts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issued' ");
		  $isusts = $isusts[0]['iStatusID'];
		  $where = " AND ioh.iSupplierOrganizationID=$curORGID AND ioh.iStatusID=$isusts ";
		} else if($invsts == 'acpt') {
		  $acptsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
		  $acptsts = $acptsts[0]['iStatusID'];
		  $where = " AND ioh.iSupplierOrganizationID=$curORGID AND ioh.iStatusID=$acptsts ";
		}*/
	} else if($orgtype == 'Both' && ($poStatus == $isusts || $poStatus == $acptsts || $poStatus=='')) {
			$where .= " AND poh.iSupplierOrganizationID=$curORGID ";
		   if(trim($poStatus) == '') {
			 // $where .= " OR (poh.iSupplierOrganizationID=$curORGID AND poh.iStatusID IN ($isusts,$acptsts)) ";
			 $where .= " AND poh.iaStatusID IN (0,"."$poOrgAcptIds) ";
		   } else if(is_numeric($poStatus) && $poStatus>0 && in_array($poStatus,$poacpt)) {
			 if($poStatus == $isusts || $poStatus == $acptsts ) {
				$where .= " OR (poh.iSupplierOrganizationID=$curORGID AND poh.iaStatusID=$poStatus) ";
			}
		}
	} else {
		$where .= " AND poh.iaStatusID in (".'0,'.$poOrgAcptIds.") AND poh.iSupplierOrganizationID=$curORGID ";
	}
	// prints($poUserStatusIds); exit;
	// echo $where; exit;
	if($_POST['poStatus']=='0') {
		$where = " AND poh.iaStatusID=0 AND poh.iSupplierOrganizationID=$curORGID ";
	}
   ### SORTING ###
   $cursort = $_POST['cursort'];
   $cursorttype = $_POST['cursorttype'];
   if($cursort != ''){
      if($cursorttype == '1'){
         $cursort_type = 'ASC';
      }else{
         $cursort_type = 'DESC';
      }
      $orderBy = " $cursort $cursort_type";
   } else {
      $orderBy = " poh.dCreateDate DESC ";
   }
   ## ENDS HERE ###

	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
   // $where .= " AND poh.iStatusID>=$isusts "; 	// AND poh.iaStatusID!=$rsts
   $where .= " AND (poh.iStatusID>=$isusts OR poh.iaStatusID=$rsts) ";
	$where = $where . $whr;
	// echo $where; exit;
     //and poh.iStatusID in (".$poUserStatusIds.")
	$jtbl = '';
   $jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on sm.iStatusID = poh.iaStatusID ";
   $jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_organization_user ou on ou.iUserID =  poh.iBuyerID";
	$activegroup = $poObj->getJoinTableInfo($jtbl," poh.*,(select org.vCompanyName from b2b_organization_master org where org.iOrganizationID=poh.iSupplierOrganizationID) as vSupplierName,sm.vStatus_".LANG." as status,CONCAT(ou.vFirstName,' ',ou.vLastName) as buyername, DATEDIFF(NOW(),poh.dCreateDate) as days ",$where,$orderBy,'',$limit,'yes');
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
	$smarty->assign('acptsts',$acptsts);
	$smarty->assign('poObj',$poObj);
	$smarty->assign('curORGID',$curORGID);
   $smarty->assign('activegroup',$activegroup);
	//$smarty->assign('orglist',$orglist);
	$smarty->assign('count',$count);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
     //print_r($_SESSION);
?>