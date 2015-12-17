<?php
	// pr($_POST); // exit;
	$type = PostVar('type');
	// $val = PostVar('val');
	$dseltxt = PostVar('dseltxt');
	$extc = stripcslashes($extc);
	$elnm = PostVar('elnm');
	$table = "";
	$flds = "";
	$corg = $curORGID;
	$cusr = $sess_id;
	$cutyp = $sess_usertype_short;
	$wh = "";

	if(trim($type)!='')
	{
		switch($type)
		{
			case 'po':
				$table = PRJ_DB_PREFIX."_purchase_order_heading";
				$flds = "iPurchaseOrderID as kyas, vPoBuyerCode as vlas";
				// $cndtfld = "vPoBuyerCode";
				$organization_id = PostVar('promptorganization_id');
				if(trim($organization_id) != '') {
					$wh .= " AND (iSupplierOrganizationID=$organization_id OR iBuyerOrganizationID=$organization_id) ";
				}
				break;
			case 'inv':
				$table = PRJ_DB_PREFIX."_inovice_order_heading";
				$flds = "iInvoiceID as kyas, vInvSupplierCode as vlas";
				// $cndtfld = "vInvSupplierCode";
				$organization_id = PostVar('promptorganization_id');
				if(trim($organization_id) != '') {
					$wh .= " AND (iSupplierOrganizationID=$organization_id OR iBuyerOrganizationID=$organization_id) ";
				}
				break;
			case 'org':
				$table = PRJ_DB_PREFIX."_organization_master";
				$flds = "iOrganizationID as kyas, vCompanyName, vCompCode as vlas";
				// $cndtfld = "vCompCode";
				$cndtfld = "vCompanyName";
				break;
			case 'usr':
				$table = PRJ_DB_PREFIX."_organization_user";
				$flds = "iUserID as kyas, vUserName as vlas";
				// $cndtfld = "vUserName";
				$organization_id = PostVar('promptorganization_id');
				if(trim($organization_id) != '') {
					$wh .= " AND iOrganizationID=$organization_id ";
				}
				break;
		}
		// if(trim($val)!='') {
			$sql = "Select $flds from $table where 1 $wh $extc ";
			$rslt = $dbobj->sql_query($sql);
			// echo $sql;
			// pr($rslt); exit;
		// }
	}
	$combo = "";
	$combo = "<select name='".$elnn."' id='".$elnm."' style='width: 230px;' onchange='' ><option value=''>---".$dseltxt."---</option>";
	for($l=0; $l < count($rslt); $l++) {
		$combo .= "<option value='".$rslt[$l]['kyas']."' id='".$rslt[$l]['kyas']."'>".$rslt[$l]['vlas']."</option>";
	}
	$combo .= "</select>";
	// prints($rslt);
	ob_clean();
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