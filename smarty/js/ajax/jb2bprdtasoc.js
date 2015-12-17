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
   var url = SITE_URL+"index.php?file=or-aj_getbproductcombo";
   var pars = "&b2orgid="+$('#iBuyer2Id').val()+"&fid=iProductId&fnm=Data[iProductId]"+"&snm="+$('#pnm').val()+"&scd="+$('#pcd').val()+"&sid="+sid+"&cls=required&ea=&styl=width:300px;&whr=&fr=";
	// alert(url+pars); return false;
   // $('#Buyer2Org').load(url+pars);
   $.ajax({url:url, data:pars, type:'get', dataType:'html', async:true, success: function(resp, status, jqxhr) {
      if($.trim(resp)!='') {
         // $('#Buyer2Org').attr('innerHTML','');
         // $('#Buyer2Org').html('');
         $('#bprdt').html(resp);
      }
   }});
}
