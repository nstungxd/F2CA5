function checkpc()
{
	if($('#iPurchaseOrderID option').length > 1) {
		$('#ep').hide();
		if(document.getElementById('vExtPOCode')) {
			// $('#vExtPOCode').val('');
		}
	} else {
		$('#ep').show();
	}
}
function chkpc(elid)
{
	var pcd = $('#'+elid+" option:selected").text();
	// alert($('#'+elid+" option:selected").text());
	if(elid!='') {
		$('#ep').hide();
		$('#vExtPOCode').val(pcd);
		document.getElementById('vExtPOCode').value = pcd;
		//$('#ep').attr('readonly','readonly');
	} /*else {
		$('#ep').hide();
	}*/
	// alert($('#vExtPOCode').val());
}
function getComboVal(type)
{
	var val = '';
	var elm = '';
	var extc = '';
	var oid = '';
	var elid = '';
	var elname = '';
	if(type == 'po') {
		val = $('#poc').val();
		cval = 'iPurchaseOrderID';
		elm = 'pocombo';
		extc = " AND (iSupplierOrganizationID="+corg+" OR iBuyerOrganizationID="+corg+") AND iStatusID="+sid+" AND iPurchaseOrderID NOT IN (Select iPurchaseOrderID from b2b_inovice_order_heading)";
		elid = "iPurchaseOrderID";
		elname = "Data[iPurchaseOrderID]";
	} else if(type == 'inv') {
		val = $('#inv').val();
		cval = 'vInvoiceCode';
		elm = 'invcombo';
		extc = " AND iSupplierOrganizationID="+corg;
		elid = "vInvoiceCode";
		elname = "vInvoiceCode";
	} else if(type == 'org') {
		val = $('#compcode').val();
		cval = 'iOrganizationID';
		oid = 'iBuyerOrganizationID';
		elm = 'compcombo';
	} else if(type == 'sorg' || type == 'sborg') {
		val = $('#scompcode').val();
		cval = 'iOrganizationID';
		oid = 'iSupplierOrganizationID';
		elm = 'scompcombo';
	} else if(type == 'usr') {
		val = $('#uname').val();
		cval = 'iUserID';
		oid = 'iBuyerOrganizationID';
		elm = 'usrcombo';
		if($.trim($('#iBuyerOrganizationID').val()) == '') {
			return false;
		}
		extc = " AND iOrganizationID="+$('#iBuyerOrganizationID').val();
	}
	if($.trim(val)=='') {
		return false;
	}
	pars = "&corg="+corg+"&type="+type+"&val="+val+"&cval="+cval+"&extc="+extc+"&oid="+oid+"&elname="+elname+"&elid="+elid+"&frm=inv";
	url = SITE_URL+"index.php?file=m-aj_getCombo";
	// $('#'+elm).load(url+pars);
	$.post(url, pars, function(resp)
	{
      $('#'+elm).html(resp);
      checkpc();
	});
}