function getBuyer2Combo(sid)
{
	var url = SITE_URL+"index.php?file=or-aj_getbuyer2combo";
	var pars = "&fid=iBuyer2Id&fnm=Data[iBuyer2Id]"+"&snm="+$('#b2nm').val()+"&scd="+$('#b2cd').val()+"&sid="+sid+"&cls=required&oc=ps()&styl=width:300px;&whr=&fr=";
	// alert(url+pars); return false;
	// $('#Buyer2Org').load(url+pars);
	$.ajax({url:url, data:pars, type:'get', dataType:'html', async:true, success: function(resp, status, jqxhr) {
		if($.trim(resp)!='') {
			// $('#Buyer2Org').attr('innerHTML','');
			// $('#Buyer2Org').html('');
			$('#b2org').html(resp);
			ps();
		}
	}});
}

function getBProductCombo(sid)
{
	var url = SITE_URL+"index.php?file=or-aj_getb2bproductcombo";
	var pars = "&b2orgid="+$('#iBuyer2Id').val()+"&fid=iProductId&fnm=Data[iProductId]"+"&snm="+$('#pnm').val()+"&scd="+$('#pcd').val()+"&sid="+sid+"&cls=required&oc=bs()&styl=width:300px;&whr=&fr=";
	// alert(url+pars); return false;
	$.ajax({url:url, data:pars, type:'get', dataType:'html', async:true, success: function(resp, status, jqxhr) {
		if($.trim(resp)!='') {
			$('#bprdt').html(resp);
			bs();
		}
	}});
}

function getBuyerCombo(sid)
{
	var url = SITE_URL+"index.php?file=or-aj_getb2bproductbuyercombo";
	var pars = "&b2orgid="+$('#iBuyer2Id').val()+"&pid="+$('#iProductId').val()+"&fid=iBuyerId&fnm=Data[iBuyerId]"+"&snm="+$('#bnm').val()+"&scd="+$('#bcd').val()+"&sid="+sid+"&cls=required&ea=&styl=width:300px;&whr=&fr=";
	// alert(url+pars); return false;
	$.ajax({url:url, data:pars, type:'get', dataType:'html', async:true, success: function(resp, status, jqxhr) {
		if($.trim(resp)!='') {
			$('#borg').html(resp);
		}
	}});
}

$('#iProductId').live("change", function() {
	var url = SITE_URL+"index.php?file=or-aj_getb2bpdtlsfa";
	var pars = "&b2orgid="+$('#iBuyer2Id').val()+"&prdtid="+$('#iProductId').val()+"&flds=fAdvancePc,fMinValue,fMaxValue,fGlobalLimit,fOutstandingAmt,fFeePc,fFeeFlat";
	// alert(url+pars); return false;
	$.ajax({url:url, data:pars, type:'post', dataType:'html', async:true, success: function(resp, status, jqxhr) {
		if($.trim(resp)!='') {
			// $('.stb2bpfls').html('');
			// $('.stb2bpfls').append(resp);
			var rsp = resp.split('|,|');
			$('#fAdvancePc').val(rsp[0]);
			$('#fMinValue').val(rsp[1]);
			$('#fMaxValue').val(rsp[2]);
			$('#fTotalGlobalLimit').val(rsp[3]);
			$('#fTotalOutstandingAmt').val(rsp[4]);
		}
	}});
});