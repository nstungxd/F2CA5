<?php
	$type = $_POST['type'];
	$val = $_POST['val'];
	$cval = $_POST['cval'];
	$extc = $_POST['extc'];
	$extc = stripcslashes($extc);
	$oid = $_POST['oid'];
	$frm = $_POST['frm'];
	$elid = $_POST['elid'];
	$elname = $_POST['elname'];
	$wh = $_POST['corg'];
	$table = "";
	$flds = "";
	$cndtfld = "";
	$otype = "";
	$utype = "";
	$lblvl = "";
	$cfn = "";
	$corg = $curORGID;
	$wh = "";
	if($frm == 'po') {
		$cfn = "fillPoData";
	} else if($frm == 'inv') {
            if($type == 'po') {
                $cfn = "fillPOData";
            } else {
                $cfn = "fillInvData";
            }
	}
	if($oid == 'iBuyerOrganizationID') {
		$otype = "buyer";
		$utype = "iBuyerID";
		$lblvl = "LBL_BUYER";
	} else if($oid == 'iSupplierOrganizationID') {
		$otype = "supplier";
		$utype = "iSupplierID";
		$lblvl = "LBL_SUPPLIER";
	}
	if(trim($type)!='') {
		switch($type)
		{
			case 'po':
				$table = PRJ_DB_PREFIX."_purchase_order_heading";
				$flds = "iPurchaseOrderID, vPoBuyerCode";
				$cndtfld = "vPoBuyerCode";
				break;
			case 'inv':
				$table = PRJ_DB_PREFIX."_inovice_order_heading";
				$flds = "iInvoiceID, vInvSupplierCode";
				$cndtfld = "vInvSupplierCode";
				break;
			case 'org':
				$table = PRJ_DB_PREFIX."_organization_master";
				$flds = "iOrganizationID, vCompanyName, vCompCode";
				// $cndtfld = "vCompCode";
				$cndtfld = "vCompanyName";
				break;
			case 'sorg':
				$table = PRJ_DB_PREFIX."_organization_master";
				$flds = "iOrganizationID, vCompanyName, vCompCode";
				// $cndtfld = "vCompCode";
				$cndtfld = "vCompanyName";
				$wh = " AND eOrganizationType='Supplier' ";
				break;
			case 'sborg':
				$table = PRJ_DB_PREFIX."_organization_master";
				$flds = "iOrganizationID, vCompanyName, vCompCode";
				// $cndtfld = "vCompCode";
				$cndtfld = "vCompanyName";
				$wh = " AND eOrganizationType IN ('Supplier','Both') ";
				break;
			case 'usr':
				$table = PRJ_DB_PREFIX."_organization_user";
				$flds = "iUserID, CONCAT(vFirstName,' ',vFirstName)";
				$cndtfld = "CONCAT(vFirstName,' ',vFirstName)";
				break;
		}
		if (trim($val)!='') {
			if(($frm=='po' && $oid=='iSupplierOrganizationID')) {
				$wh = " AND iOrganizationID!=$corg AND iOrganizationID IN (Select iSupplierAssocationID from ".PRJ_DB_PREFIX."_organization_association where iBuyerOrganizationID=$corg AND eStatus!='Need to Verify' AND eStatus!='Inactive') ";
			} else if($frm=='inv' && $oid=='iBuyerOrganizationID') {
				$wh = " AND iOrganizationID!=$corg AND iOrganizationID IN (Select iBuyerOrganizationID from ".PRJ_DB_PREFIX."_organization_association where iSupplierAssocationID=$corg AND eStatus!='Need to Verify' AND eStatus!='Inactive') ";
			} else if($frm=='inv' && $oid=='iSupplierOrganizationID') {
				$wh = " AND iOrganizationID!=$corg AND iOrganizationID IN (Select iSupplierAssocationID from ".PRJ_DB_PREFIX."_organization_association where iBuyerOrganizationID=$corg AND eStatus!='Need to Verify' AND eStatus!='Inactive') ";
			}
			$sql = "Select $flds from $table where $cndtfld LIKE '%$val%' AND $cndtfld!='' $wh $extc ";
			// echo $sql;
			$rslt = $dbobj->sql_query($sql);
		}
	}
	$combo = "";
	if($type=='inv')
	{
		$combo = "<select name='".$elname."' id='".$elid."' class='form-control' onchange='".$cfn."(this.options[this.selectedIndex].id);' ><option value=''>---".$smarty->get_template_vars('LBL_SELECT_INVOICE')."---</option>";
		for($l=0;$l<count($rslt);$l++) {
			$combo .= "<option value='".$rslt[$l][$cval]."' id='".$rslt[$l]['iInvoiceID']."'>".$rslt[$l][$cndtfld]."</option>";
		}
		$combo .= "</select>";
	}
	else if($type=='po')
	{
		if($frm=='inv') {
			$combo = "<select name='".$elname."' id='".$elid."' class='form-control' onchange='".$cfn."(this.options[this.selectedIndex].id); chkpc(this.id);' class='' title='".$smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_PURCHASE_ORDER')."' ><option value=''>---".$smarty->get_template_vars('LBL_SELECT_PO')."---</option>";
		} else {
			$combo = "<select name='".$elname."' id='".$elid."' class='form-control' onchange='".$cfn."(this.options[this.selectedIndex].id)' class='' title='".$smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_PURCHASE_ORDER')."' ><option value=''>---".$smarty->get_template_vars('LBL_SELECT_PO')."---</option>";
		}
		for($l=0;$l<count($rslt);$l++) {
			$combo .= "<option value='".$rslt[$l][$cval]."' id='".$rslt[$l]['iPurchaseOrderID']."'>".$rslt[$l][$cndtfld]."</option>";
		}
		//$combo .= "<option value='1' id='1'>pocode</option>";
		//$combo .= "<option value='2' id='2'>pcd</option>";
		$combo .= "</select>";
	}
	else if($type=='org' || $type=='sorg' || $type=='sborg')
	{
		if($type=='org') {
			$combo = "<select name='Data[$oid]' id='$oid' class='form-control' title='".$smarty->get_template_vars($lblvl)." ".$smarty->get_template_vars('LBL_BUYER')." ".$smarty->get_template_vars('LBL_COMPANY')."' onchange='return getorgbilldetails(this.value);' ><option value=''>---".$smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars($lblvl)." ".$smarty->get_template_vars('LBL_COMPANY')."---</option>"; 	// $(\"#".$utype."\").load(SITE_URL+\"index.php?file=u-aj_getUser&icompid=\"+this.value+\"&htmlTag=option&orgtype=".$otype."\");
		} else {
			$combo = "<select name='Data[$oid]' id='$oid' class='form-control' title='".$smarty->get_template_vars($lblvl)." ".$smarty->get_template_vars('LBL_BUYER')." ".$smarty->get_template_vars('LBL_COMPANY')."' onchange='return getorgbilldetails(".$curORGID.");' ><option value=''>---".$smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars($lblvl)." ".$smarty->get_template_vars('LBL_COMPANY')."---</option>";
		}
		for($l=0;$l<count($rslt);$l++) {
			$combo .= "<option value='".$rslt[$l][$cval]."' id='".$rslt[$l]['iOrganizationID']."'>".$rslt[$l][$cndtfld]."</option>";
		}
		$combo .= "</select>";
	}
	else if($type=='usr')
	{
		$combo = "<select name='Data[$utype]' id='$utype'  class='form-control' title='".$smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars($lblvl)." ".$smarty->get_template_vars('LBL_CONTACT_PARTY')."' ><option value=''>---".$smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars($lblvl)." ".$smarty->get_template_vars('LBL_CONTACT_PARTY')."---</option>";
		for($l=0;$l<count($rslt);$l++) {
			$combo .= "<option value='".$rslt[$l][$cval]."' id='".$rslt[$l]['iUserID']."'>".$rslt[$l][$cndtfld]."</option>";
		}
		$combo .= "</select>";
	}
	// prints($rslt);
	echo $combo;
	exit;

 /* if($frm=='inv' && $type=='po') {
		if(!is_array($rslt) || count($rslt)<1) {?>
			<script type="text/javascript">
				if(document.getElementById('ep')) {
					$('#ep').show();
				}
			</script>
		<?php  }
		else if(count($rslt)>1) {?>
			<script type="text/javascript">
				if(document.getElementById('ep')) {
					$('#ep').hide();
				}
			</script>
		<?php  }
	}*/
?>