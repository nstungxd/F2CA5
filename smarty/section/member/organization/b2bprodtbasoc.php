<?php
if(!isset($b2bpbObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_BProduct_Association.php");
	$b2bpbObj = new Buyer2_Buyer_BProduct_Association();
}

$iAssociationId = GetVar('id');
// $msg = GetVar('msg');
$msg = '';
if(isset($_SESSION[PRJ_CONST_PREFIX.'_action_msg']) && trim($_SESSION[PRJ_CONST_PREFIX.'_action_msg'])!='') {
   $msg = $_SESSION[PRJ_CONST_PREFIX.'_action_msg'];
   unset($_SESSION[PRJ_CONST_PREFIX.'_action_msg']);
}


if($msg == 'ras') {
   $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'aerr') {
   $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'uerr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} elseif($msg == 'rvs') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_SUCC');
} elseif($msg == 'verr') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_ERR');
} elseif($msg == 'rds') {
   $msg = $smarty->get_template_vars('MSG_DEL_SUCC');
} elseif($msg == 'derr') {
   $msg = $smarty->get_template_vars('MSG_DEL_ERR');
} elseif($msg == 'rss') {
   $msg = $smarty->get_template_vars('MSG_STATUS_SUCC');
} elseif($msg == 'rserr') {
   $msg = $smarty->get_template_vars('MSG_STATUS_ERR');
} else {
   $msg='';
}

$arr = array();
if(trim($iAssociationId)!='' && $iAssociationId>0) {
   $mod = 'edit';
   $flds = " b2bpb.*, org.vCompanyName as vBuyer2, org.vCompCode as vB2Code, bpo.vProductName as vProduct, bpo.vProductCode, bo.vCompanyName as vBuyer, bo.vCompCode as vBCode ";
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_bproduct_organization bpo on bpo.iProductId=b2bpb.iProductId
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=b2bpb.iBuyer2Id
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master bo on bo.iOrganizationID=b2bpb.iBuyerId";
   $arr = $b2bpbObj->getJoinTableInfo($jtbl, $flds, " AND iAssociationId=$iAssociationId ");
   if(!(is_array($arr) && count($arr)>0)) {
      header('Location: '.SITE_URL_DUM.'b2bprodtbasoclist');
      exit;
   } else if(! (isset($arr[0]['eStatus']) && (($arr[0]['eStatus']=='Active' || $arr[0]['eStatus']=='Inactive') && $arr[0]['eNeedToVerify']!='Yes'))) {
      header('Location: '.SITE_URL_DUM.'b2bprodtbasocview/'.$iAssociationId);
      exit;
   }
	if($arr[0]['eStatus']=='Delete' && $arr[0]['eNeedToVerify']!='Yes') {
		header('Location: '.SITE_URL_DUM.'b2bprodtbasoclist/rnme');
		exit;
	}
} else {
   $mod = 'add';
	$arr = $post_data = array();
	if(isset($_SESSION[PRJ_CONST_PREFIX.'_postdata'])) {
		$post_data = unserialize($_SESSION[PRJ_CONST_PREFIX.'_postdata']);
		unset($_SESSION[PRJ_CONST_PREFIX.'_postdata']);
	}
	if(isset($post_data['Data']) && count($post_data['Data'])>0) {
		$arr[0] = $post_data['Data'];
		if(isset($arr[0]['iBuyer2Id']) && $arr[0]['iBuyer2Id']>0) {
			if(!isset($orgObj)) {
				include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
				$orgObj =	new Organization();
			}
			$buyer2 = $orgObj->getDetails('vCompanyName, vCompCode'," AND iOrganizationID='".$arr[0]['iBuyer2Id']."'");
			$arr[0]['vBuyer2'] = $buyer2[0]['vCompanyName'];
         $arr[0]['vB2Code'] = $buyer2[0]['vCompCode'];
		}
      if(isset($arr[0]['iProductId']) && $arr[0]['iProductId']>0) {
			if(!isset($bpoObj)) {
				include_once(SITE_CLASS_APPLICATION."productorganization/class.BProductOrganization.php");
				$bpoObj =	new BProductOrganization();
			}
			$product = $bpoObj->getDetails('vProductName, vProductCode'," AND iProductId='".$arr[0]['iProductId']."'");
			$arr[0]['vProduct'] = $product[0]['vProductName'];
         $arr[0]['vProductCode'] = $product[0]['vProductCode'];
		}
		$arr[0]['iBuyerId'] = 0;
	}
	// pr($arr); exit;
}

// For OAs
// pr($_SESSION); exit;
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']!='Buyer2' && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USRTYPE']!='SM') {
	if($iAssociationId>0) {
		header("Location: ".SITE_URL_DUM."b2bprodtbasocview/$iAssociationId");
	} else {
		header("Location: ".SITE_URL_DUM."b2bprodtbasoclist");
	}
	exit;
} else if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']=='Buyer2') {
	if(trim($iAssociationId)=='' || $iAssociationId<1) {
		if(!isset($orgObj)) {
			include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
			$orgObj = new Organization();
		}
		$b2orgdtls = $orgObj->select($curORGID);
		if(is_array($b2orgdtls) && count($b2orgdtls)>0) {
			$arr[0]['iBuyer2Id'] = $curORGID;
			$arr[0]['vBuyer2'] = (isset($b2orgdtls[0]['vCompanyName']))? $b2orgdtls[0]['vCompanyName'] : '';
			$arr[0]['vB2Code'] = (isset($b2orgdtls[0]['vCompCode']))? $b2orgdtls[0]['vCompCode'] : '';
		}
	}
}
if(isset($arr[0]['iBuyer2Id']) && trim($arr[0]['iBuyer2Id'])!='' && $arr[0]['iBuyer2Id']>0 && $arr[0]['iBuyer2Id']!=$curORGID && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USRTYPE']!='SM') {
	header("Location: ".SITE_URL_DUM."b2bprodtbasoclist");
	exit;
}

$smarty->assign('mod', $mod);
$smarty->assign('arr', $arr);
$smarty->assign('msg', $msg);
$smarty->assign('arr', $arr);
$smarty->assign('post_data', $post_data);
$smarty->assign('iAssociationId', $iAssociationId);
?>