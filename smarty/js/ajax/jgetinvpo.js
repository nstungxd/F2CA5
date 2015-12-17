function findPOValue(li) {
	if( li == null ) return alert("No match!");
	if( !!li.extra ) var sValue = li.extra[0];
	else var sValue = li.selectValue;

	var totVal = sValue;
	var totValID;
	var totValRes;
	totVal = totVal.split('</span>');
	totValID = totVal[0].replace("<span style='display:none'>","");
	totValRes = totVal[1];
	var iOrgId=totValID.split('_');
	totValID=iOrgId[0];
	iOrgId=iOrgId[1];
	$('#iPurchaseOrderID').val(totValID);
     var inv = $('#iInvoiceID').val();

     var url = SITE_URL+"index.php?file=m-aj_getDetails";
     var pars = "&table="+PRJ_DB_PREFIX+"_purchase_order_heading"+"&iId=iPurchaseOrderID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=&js=setinv";
	 //alert(url+pars); return false;
	$('#spn').load(url+pars);
     //SITE_URL+"index.php?file=or-aj_getOrganization&orgid="+$('#iSupplierOrganizationID').val()+"&orgtype=buyer"
	// $.ajax({type:"post", url:url, data:pars, success:getDetails});
	//alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
	//$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
}

function selectPOItem(li) {
	findPOValue(li);
}
function findInvValue(li)
{
	if( li == null ) return alert("No match!");
	if( !!li.extra ) var sValue = li.extra[0];
	else var sValue = li.selectValue;

	var totVal = sValue;
	var totValID;
	var totValRes;

	totVal = totVal.split('</span>');
	totValID = totVal[0].replace("<span style='display:none'>","");
	totValRes = totVal[1];
	var iOrgId=totValID.split('_');
	totValID=iOrgId[0];
	iOrgId=iOrgId[1];
	$('#iInvoiceID').val(totValID);

	var inv = $('#iInvoiceID').val();
	var url = SITE_URL+"index.php?file=m-aj_getDetails";
     var jtbl=escape("bioh left join b2b_purchase_order_heading bpoh on bioh.iPurchaseOrderID=bpoh.iPurchaseOrderID");
     var fields=escape('bioh.*,bpoh.vPOCode,bioh.vBuyerName as vBuyerCompanyName,bioh.vBuyerContactParty as vBuyerContactName');
     //var pars = "&table="+PRJ_DB_PREFIX+"_invoice_order_heading"+"&iId=iPurchaseOrderID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=&js=setinv";
	var pars = "&table="+PRJ_DB_PREFIX+"_inovice_order_heading"+"&iId=bioh.iInvoiceID"+"&id="+totValID+"&jtbl="+jtbl+"&fields="+fields+"&where=&js=setinv";

//alert(url+pars); return false;
	$('#spn').load(url+pars);
	// $.ajax({type:"post", url:url, data:pars, success:getDetails});
	//alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
	//$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
}
function selectInvItem(li) {
	findInvValue(li);
}

function fillInvData(id)
{
   if(id == '' || id == undefined)
		return ;

	var totValID = id;
	$('#iInvoiceID').val(totValID);
     var fields="all";
     var url = SITE_URL+"index.php?file=m-aj_getDetails";
     var pars = "&table="+PRJ_DB_PREFIX+"_inovice_order_heading"+"&iId=iInvoiceID"+"&id="+totValID+"&jtbl=&fields="+fields+"&where=&js=setinv";
     //alert(url+pars); return false;
	$('#spn').load(url+pars);

}
$(document).ready(function() {
	$("#purchaseOrder").autocomplete(
		SITE_URL+"index.php?file=u-aj_getInvPo",
		{
			delay:10,
			minChars:1,
			matchSubset:1,
			matchContains:1,
			cacheLength:10,
			onItemSelect:selectPOItem,
			onFindValue:findPOValue,
			formatItem:formatItem,
			autoFill:false
		}
	);

          $("#vInvoiceCode").autocomplete(
		SITE_URL+"index.php?file=u-aj_getPoInv",
		{
			delay:10,
			minChars:1,
			matchSubset:1,
			matchContains:1,
			cacheLength:10,
			onItemSelect:selectInvItem,
			onFindValue:findInvValue,
			formatItem:formatItem,
			autoFill:false
		}
	);
});

function fillPOData(id)
{
   if(id == '' || id == undefined)
		return ;

	var totValID = id;
	$('#iPurchaseOrderID').val(totValID);
     var fields="all";
     var url = SITE_URL+"index.php?file=m-aj_getDetails";
     var pars = "&table="+PRJ_DB_PREFIX+"_purchase_order_heading"+"&iId=iPurchaseOrderID"+"&id="+totValID+"&jtbl=&fields="+fields+"&where=&js=setinv";
     //alert(url+pars); return false;
	$('#spn').load(url+pars);

}
// SITE_URL+"index.php?file=or-aj_getInvPo&orgid="+$('#iSupplierOrganizationID').val(),
