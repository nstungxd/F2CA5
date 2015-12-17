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
		extc = " AND iBuyerOrganizationID="+corg;
		elid = "vPOCode";
		elname = "vPOCode";
	} else if(type == 'inv') {
		val = $('#inv').val();
		cval = 'vInvoiceCode';
		elm = 'invcombo';
		extc = " AND iBuyerOrganizationID="+corg+" AND iStatusID="+sid+" AND iInvoiceID NOT IN (Select iInvoiceID from b2b_purchase_order_heading)";
		elid = "iInvoiceID";
		elname = "Data[iInvoiceID]";
	} else if(type == 'org') {
		val = $('#compcode').val();
		cval = 'iOrganizationID';
		oid = 'iSupplierOrganizationID';
		elm = 'compcombo';
	} else if(type == 'usr') {
		val = $('#uname').val();
		cval = 'iUserID';
		oid = 'iSupplierOrganizationID';
		elm = 'usrcombo';
		if($.trim($('#iSupplierOrganizationID').val()) == '') {
			return false;
		}
		extc = " AND iOrganizationID="+$('#iSupplierOrganizationID').val();
	}/* else if(type == 'asoc') {
		val = $('#asoc').val();
		cval = 'vAssociationCode';
		oid = 'iSupplierOrganizationID';
		elm = 'asoccombo';
	}*/
	if($.trim(val)=='') {
		return false;
	}
	pars = "&corg="+corg+"&type="+type+"&val="+val+"&cval="+cval+"&extc="+extc+"&oid="+oid+"&elname="+elname+"&elid="+elid+"&frm=po";
	url = SITE_URL+"index.php?file=m-aj_getCombo";
	$.post(url, pars, function(resp)
	{
      $('#'+elm).attr('innerHTML',resp);
	});
}