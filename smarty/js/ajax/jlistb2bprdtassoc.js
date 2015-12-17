$('#checkbox').click( function ()
{
	orgs = $('input:checkbox[name="associations\[\]"]');

	if($(this).attr('checked'))
	{
		$.each(orgs, function (ln,el) {
			$(this).attr('checked','checked');
		});
	}
	else
	{
		$.each(orgs, function (ln,el) {
			$(this).attr('checked','');
		});
	}
});

function getb2bprdtassoclist(vl,pg,cursort)
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
	listb2bprdtassocs(pg);
}

function listb2bprdtassocs(pg)
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

	if($.trim($('#sltyp').val()) != '') {
		pars += "&styp="+$('#sltyp').val();
	}

	url = SITE_URL+"index.php?file=or-aj_b2bprdtassoclist";
	$('#mod').val(vl);
	// alert(url+pars);
	$.post(url, pars, function(resp)
	{
      $('#updating').hide();
      $('#assoclist').attr('innerHTML',resp);
      //$.getScript(SITE_URL_DUM+'js/ajax/coreajax.js');
      //window.setTimeout("$('#updating').hide();", 1000);
		//$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15});
		$(document).ready( function() {
			$(function() {
				$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15});
			});
		});
	});
}

function status(mode,val)
{
   if(mode == 'deleteall' || mode == 'status') 
   {
      var sel = 0;
      var orgsval = '';
      var orgs = document.getElementsByName('associations[]');

      if(orgs.length == 0) {
         return false;
      }
      
      for(var l=0; l<orgs.length;l++)
      {
          //alert(orgs[l].id);
          if(orgs[l].checked) {
             //alert(orgs[l].value);
             orgsval += orgs[l].value+",";
          } else {
             sel = sel+1;
          }
      }
      
      if(sel == orgs.length) {
          //$('#imgProcess').addClass('hidden');
          alert(MSG_SELECT_ATLEAST_ONE_REC);
          return false;
      } else {
          $('#updating').show();
          $('#dispmsg').hide();
          if(orgsval.lastIndexOf(',') == orgsval.length-1)
          {
             orgsval = orgsval.substring(0,orgsval.length-1);
          }
      }
      //alert(orgsval);
   }
   
   pars = "";
   if(mode == 'delete') {
       pars += "&val="+val+"&mode="+mode;
   } else if(mode == 'deleteall' || mode == 'status') {
       pars += "&val="+orgsval+"&mode="+mode;
   }
   
   if(mode == 'deleteall' || mode == 'delete'){
      var con = confirm(''+MSG_CONFIRM_DELETE+'');
   
      if(!con){
   		$('#updating').hide();
         return false;
      }
   }

   url = SITE_URL+"index.php?file=or-aj_b2bprdtassoclist_a";
	// alert(url+pars);
	$.post(url, pars, function(resp) {
      $('#updating').hide();
      $('#dispmsg').show();
      $('#dispmsg').attr('innerHTML',resp);
      //window.setTimeout("$('#updating').hide();", 1000);
      getb2bprdtassoclist('all',1);
	});
   // getb2bprdtassoclist('all',1);
}

getb2bprdtassoclist('all',1);
