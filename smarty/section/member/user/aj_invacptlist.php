<?php
	include(S_SECTIONS."/member/memberaccess.php");

	$mode = (isset($_POST['mod']))? $_POST['mod'] : '';
	$val = (isset($_POST['val']))? $_POST['val'] : '';
   $invStatus = (isset($_POST['invStatus']))? $_POST['invStatus'] : '';

	$vInvoiceNumber = (isset($_POST['vInvoiceNumber']))? $_POST['vInvoiceNumber'] : '';
	$vInvoiceCode = (isset($_POST['vInvoiceCode']))? $_POST['vInvoiceCode'] : '';
   $buyername = (isset($_POST['buyername']))? $_POST['buyername'] : '';
   $vSupplierName = (isset($_POST['vSupplierName']))? $_POST['vSupplierName'] : '';
   $fInvoiceTotal = (isset($_POST['fInvoiceTotal']))? $_POST['fInvoiceTotal'] : '';
   $iNetPaymentDays = (isset($_POST['iNetPaymentDays']))? $_POST['iNetPaymentDays'] : '';
   $fDate = (isset($_POST['fDate']))? $_POST['fDate'] : '';
   $tDate = (isset($_POST['tDate']))? $_POST['tDate'] : '';
   $status = (isset($_POST['status']))? $_POST['status'] : '';
	$invsts = (isset($_POST['invsts']))? $_POST['invsts'] : '';
	// echo $status; exit;
	$page = (isset($_POST['page']))? $_POST['page'] : '';
	if(trim($page) == '' || trim($page) < 1) {
	  $page = 1;
   }
	//Prints($_POST); exit;
	if(!isset($invOrdderObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
		$invOrdderObj = new InvoiceOrderHeading();
	}

   if(!isset($orgGroupObj)) {
      include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
      $orgGroupObj =	new OrganizationGroup();
   }

  $whr = "";
	$where = "";
	// $where .= " AND ioh.iPurchaseOrderID>0 ";
	$crsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Create' ");
	$crsts = $crsts[0]['iStatusID'];
	$vsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Verify' ");
	$vsts = $vsts[0]['iStatusID'];
	$iusts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issue'");
	$iusts = $iusts[0]['iStatusID'];
  	$isusts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issued'");
  	$isusts = $isusts[0]['iStatusID'];
  	$acptsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
  	$acptsts = $acptsts[0]['iStatusID'];
  	$rsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
  	$rsts = $rsts[0]['iStatusID'];
  	$where .= " AND (ioh.iStatusID>=$isusts OR ioh.iaStatusID=$rsts) ";
	$where .= " AND ioh.iBuyerOrganizationID=$curORGID "; 	// AND ioh.iStatusID>=$isusts AND
	if($mode == 'srch')	{
      if(trim($vInvoiceNumber) != '') {
			$whr = " AND ioh.vInvoiceNumber LIKE '%$vInvoiceNumber%'";
		}
		if(trim($vInvoiceCode) != '') {
			$whr .= " AND ioh.vInvSupplierCode LIKE '%$vInvoiceCode%'";
		}
      if(trim($buyername) != '') {
			$whr .= " AND ioh.vBuyerName LIKE '%$buyername%'";
		}
      if(trim($vSupplierName) != '') {
			$whr .= " AND ioh.vSupplierName LIKE '%$vSupplierName%'";
		}
      if(trim($fInvoiceTotal) != '') {
			$whr .= " AND ioh.fInvoiceTotal LIKE '%$fInvoiceTotal%'";
		}
      if(trim($iNetPaymentDays) != '') {
			$whr .= " AND ioh.iNetPaymentDays LIKE '%$iNetPaymentDays%'";
		}
      if(trim($fDate) != '') {
			$whr .= " AND ioh.dCreatedDate>='$fDate'";
		}
      if(trim($tDate) != '') {
			$whr .= " AND ioh.dCreatedDate<='$tDate'";
		}
      if(trim($status) != '') {
		  if(strtolower(trim($status))=='saved') {
			 $whr .= " AND ioh.eSaved='Yes'";
		  } else {
			 $whr .= " AND sm.vStatus_".LANG." LIKE '%$status%'";
		  }
		}
	}

	$invOrgAcptIds = $crsts.",".$opf[0]['vInvoiceAcceptanceLevel'];
	if(trim($invOrgAcptIds)!='') {
		if(strpos($invOrgAcptIds,',')!==false) {
			$invacpt = @explode(',',$invOrgAcptIds);
		} else {
			$invacpt = $invOrgAcptIds;
		}
	} else {
		$invacpt = array();
	}
	$iprvsts = '';
     if($invStatus != 'all' && $invStatus != '')
     {
          if(!isset($statusmasterObj)) {
               include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
               $statusmasterObj =	new StatusMaster();
          }

			$orgposl = @explode(",",$opf[0]['vInvoiceAcceptanceLevel']);
			if($invStatus==$crsts) {
				$invStatus = 0;
				$where .= " AND ioh.iStatusID=$isusts AND ioh.iaStatusID=0 ";
			} else if($invStatus==$vsts) {
				$invStatus = $crsts;
				$where .= " AND ioh.iaStatusID=$crsts AND ioh.eSaved!='Yes' ";
			} else if($invStatus!=$isusts && $invStatus!=$acptsts && $invStatus!=$rsts) {
				for($l=0;$l<count($orgposl);$l++) {
					if($orgposl[$l]==$invStatus) {
						if(isset($orgposl[$l-1])) {
							$iprvsts = $orgposl[$l-1];
							// $poStatus = $iprvsts;
						}
					}
				}
				if($iprvsts=='' && $opf[0]['eReqVerifyInvAcpt']=='No') {
					$iprvsts = $crsts;
					$invStatus = $iprvsts;
				}
				if($invStatus==$iusts) {
					$invStatus = $iprvsts = $vsts;
					$where .= " AND ioh.iaStatusID=$vsts ";
				}
				if(in_array($iprvsts,$invacpt)) {
					$where .= " AND ioh.iaStatusID=".$iprvsts;
				} else {
					$where .= " AND ioh.iaStatusID=''";
				}
			} else {
				if($invStatus==$iusts) {
					$invStatus = $iprvsts = $vsts;
					$where .= " AND ioh.iaStatusID=$vsts ";
				}
				if(in_array($invStatus,$invacpt)) {
					$where .= " AND ioh.iaStatusID=".$invStatus;
				} else {
					$where .= " AND ioh.iaStatusID=''";
				}
			}
         $invDetail = $statusmasterObj->getStatusDetails($invStatus,'Invoice');
         if($invDetail[0]['vStatus'] == 'Issuance')
         {
              $iAuthIDs=$statusmasterObj->getDetails("group_concat(iStatusID) as authIDs","AND vStatus_en like('%auth%') and efor='Invoice'");
            //  print_r($iAuthIDs);
              $iAuthIDs=$iAuthIDs[0]['authIDs'];
              if($iAuthIDs != '')
              $where .= " OR sm.iStatusID in(".$iAuthIDs.")";
         }
     }

	  if($orgtype == 'Buyer' && ($invStatus == $isusts || $invStatus == $acptsts || $invStatus=='')) {
		if(trim($invStatus) == '') {
		  // $where = " AND ioh.iBuyerOrganizationID=$curORGID AND ioh.iStatusID IN ($isusts,$acptsts) ";
		  $where = " AND ioh.iBuyerOrganizationID=$curORGID AND ioh.iaStatusID IN (0,$invOrgAcptIds) ";
		} else if(is_numeric($invStatus) && $invStatus>0 && in_array($invStatus,$invacpt)) {
			if($invStatus == $isusts || $invStatus == $acptsts) {
				$where = " AND ioh.iBuyerOrganizationID=$curORGID AND ioh.iaStatusID=$invStatus ";
			}
		}
		  /*if($invsts == 'isu') {
			 $isusts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issued' ");
			 $isusts = $isusts[0]['iStatusID'];
			 $where = " AND ioh.iBuyerOrganizationID=$curORGID AND ioh.iStatusID=$isusts ";
		  } else if($invsts == 'acpt') {
			 $acptsts = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
			 $acptsts = $acptsts[0]['iStatusID'];
			 $where = " AND ioh.iBuyerOrganizationID=$curORGID AND ioh.iStatusID=$acptsts ";
		  }*/
	  } else if($orgtype == 'Both' && ($invStatus == $isusts || $invStatus == $acptsts || $invStatus=='')) {
		  $where .= " AND ioh.iBuyerOrganizationID=$curORGID ";
		  if(trim($invStatus) == '') {
			 // $where .= " OR (ioh.iBuyerOrganizationID=$curORGID AND ioh.iStatusID IN ($isusts,$acptsts)) ";
			 $where .= " AND ioh.iaStatusID IN (0,"."$invOrgAcptIds) ";
		  } else if(is_numeric($invStatus) && $invStatus>0 && in_array($invStatus,$invacpt)) {
			 if($invStatus == $isusts || $invStatus == $acptsts) {
				$where .= " OR (ioh.iBuyerOrganizationID=$curORGID AND ioh.iaStatusID=$invStatus) ";
			 }
		  }
	  } else {
		  $where .= " AND ioh.iaStatusID in (".'0,'.$invOrgAcptIds.") AND ioh.iBuyerOrganizationID=$curORGID ";
	  }
    // echo $where; exit;
	 if($_POST['invStatus']=='0') {
		$where = " AND ioh.iaStatusID=0 AND ioh.iBuyerOrganizationID=$curORGID ";
	 }
   ### SORTING ###
   $cursort = stripslashes($_POST['cursort']);
   $cursorttype = stripslashes($_POST['cursorttype']);

   if($cursort != '') {
      if($cursorttype == '1') {
         $cursort_type = 'ASC';
      } else {
         $cursort_type = 'DESC';
      }
      $orderBy = " $cursort $cursort_type";
   } else {
      $orderBy = " ioh.dCreatedDate DESC ";
   }
   ## ENDS HERE ###

	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
	// $where .= " AND ioh.iStatusID>=$isusts "; 	// AND ioh.iaStatusID!=$rsts
	$where .= " AND (ioh.iStatusID>=$isusts OR ioh.iaStatusID=$rsts) ";
	$where = $where . $whr;
   // echo $where;
     $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_heading poh on ioh.iPurchaseOrderID=poh.iPurchaseOrderID";
     $jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on sm.iStatusID = ioh.iaStatusID";
     $jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_organization_user ou on ou.iUserID = ioh.iBuyerID";
	// echo $where; exit;
	$activegroup = $invOrdderObj->getJoinTableInfo($jtbl,"ioh.*,ioh.vInvoiceNumber,ioh.vInvoiceCode,ioh.fInvoiceTotal,sm.vStatus_".LANG." as status,CONCAT(ou.vFirstName,' ',ou.vLastName) as buyername",$where,$orderBy,'',$limit,'yes');
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
	$smarty->assign('curORGID',$curORGID);
   $smarty->assign('activegroup',$activegroup);
	//$smarty->assign('orglist',$orglist);
	$smarty->assign('count',$count);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);

?>