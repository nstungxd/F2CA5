function getb2sprdtassovlist(vl,pg,cursort)
{
   $('#updating').show();
	$('#mod').val(vl);
   if(cursort == $('#cursort').val()){
      if($('#cursorttype').val() == 1){
         $('#cursorttype').val('0');
      }else{
         $('#cursorttype').val('1');
      }
   }else{
      $('#cursorttype').val('0');
   }

   $('#cursort').val(cursort);
	listb2sprdtassocsv(pg);
}

function listb2sprdtassocsv(pg)
{
	pars = "";
	vl = $('#mod').val();
	if(vl == 'all' || $.trim(vl) == '')
	{
		var val = $('#search_text').val();
		pars += "&val="+val+"&mod="+vl;
	}
	else if(vl == 'srch')
	{
		pars += "&mod=srch"+"&buyer2="+$.trim($('#buyer2').val())+"&product="+$.trim($('#product').val())+"&code="+$.trim($('#code').val());
	}
	if(pg == 'prv')
	{
		pg = pg-1;
	}
	if(pg == 'nxt')
	{
		pg = pg+1;
	}
	pars += "&page="+pg;		// $('#pg').val();
	// $('#updating').show();
   if($('#cursort')){
      pars += "&cursort="+$('#cursort').val();
   }

   if($('#cursorttype')){
      pars += "&cursorttype="+$('#cursorttype').val();
   }
	url = SITE_URL+"index.php?file=or-aj_b2sprdtassocvlist";
	$('#mod').val(vl);
	//alert(url+pars);
	$.post(url, pars, function(resp)
	{
      $('#updating').hide();
      $('#assoclist').attr('innerHTML',resp);
      //$.getScript(SITE_URL_DUM+'js/ajax/coreajax.js');
      //window.setTimeout("$('#updating').hide();", 1000);
		$(document).ready( function() {
			$(function() {
				$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15});
			});
		});
	});
}
getb2sprdtassovlist('all',1);