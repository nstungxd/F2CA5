function getBuyer2Combo(sid)
{
   var url = SITE_URL+"index.php?file=or-aj_getbuyer2combo";
   var pars = "&fid=iBuyer2Id&fnm=Data[iBuyer2Id]"+"&snm="+$('#b2nm').val()+"&scd="+$('#b2cd').val()+"&sid="+sid+"&cls=required&oc=ps()&styl=width:300px;&whr=&fr=";
	// alert(url+pars); return false;
   $.ajax({url:url, data:pars, type:'get', dataType:'html', async:true, success: function(resp, status, jqxhr) {
      if($.trim(resp)!='') {
         $('#b2org').html(resp);
         ps();
      }
   }});
}

function getSProductCombo(sid)
{
   var url = SITE_URL+"index.php?file=or-aj_getb2sproductcombo";
   var pars = "&b2orgid="+$('#iBuyer2Id').val()+"&fid=iProductId&fnm=Data[iProductId]"+"&snm="+$('#pnm').val()+"&scd="+$('#pcd').val()+"&sid="+sid+"&cls=required&oc=bs()&styl=width:300px;&whr=&fr=";
	// alert(url+pars); return false;
   $.ajax({url:url, data:pars, type:'get', dataType:'html', async:true, success: function(resp, status, jqxhr) {
      if($.trim(resp)!='') {
         $('#bprdt').html(resp);
         bs();
      }
   }});
}

function getSupplierCombo(sid)
{
   var url = SITE_URL+"index.php?file=or-aj_getb2sproductsuppliercombo";
   var pars = "&b2orgid="+$('#iBuyer2Id').val()+"&pid="+$('#iProductId').val()+"&fid=iSupplierId&fnm=Data[iSupplierId]"+"&snm="+$('#bnm').val()+"&scd="+$('#bcd').val()+"&sid="+sid+"&cls=required&ea=&styl=width:300px;&whr=&fr=";
	// alert(url+pars); return false;
   $.ajax({url:url, data:pars, type:'get', dataType:'html', async:true, success: function(resp, status, jqxhr) {
      if($.trim(resp)!='') {
         $('#borg').html(resp);
      }
   }});
}
