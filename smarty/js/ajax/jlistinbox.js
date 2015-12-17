$('#checkbox').click( function ()
{
	orgs = $('input:checkbox[name="inbox\[\]"]');

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
function getgrouplist(vl,pg,cursort)
{
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
	listgroup(pg);
}
function listgroup(pg)
{
	pars = "";
	vl = $('#mod').val();

	if(pg == 'prv')
	{
		pg = pg-1;
	}
	if(pg == 'nxt')
	{
		pg = pg+1;
	}
	pars += "&page="+pg;		// $('#pg').val();
	 $('#updating').show();
   if($('#cursort')){
      pars += "&cursort="+$('#cursort').val();
   }

   if($('#cursorttype')){
      pars += "&cursorttype="+$('#cursorttype').val();
   }

   if($('#search_key')){
      if($('#search_key').val() !='')
      pars += "&search_key="+$('#search_key').val();
   }
   if($('#from')){
      if($('#from').val() !='')
      pars += "&from="+$('#from').val();
   }
   if($('#to')){
      if($('#to').val() !='')
      pars += "&to="+$('#to').val();
   }
	url = SITE_URL+"index.php?file=m-aj_inbox";
	$('#mod').val(vl);
	// alert(url+pars);
   $.post(url, pars, function(resp)
   {
        $('#grouplist').html(resp);
        $('#updating').hide();
      //$('#updating').hide();
      //$('#grouplist').attr('innerHTML',resp);
      //$.getScript(SITE_URL_DUM+'js/ajax/coreajax.js');
      //window.setTimeout("$('#updating').hide();", 1000);
   	$(document).ready( function() {
   		$(function() {
   			$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15});
   		});
   	});
   });
}
getgrouplist('all',1);

function Delete(mode,val)
{

     if(mode == 'deleteall') {
          var sel = 0;
          var orgsval = '';
          var orgs = document.getElementsByName('inbox[]');

          if(orgs.length == 0)
          {
               return false;
          }

          for(var l=0; l<orgs.length;l++)
          {
                //alert(orgs[l].id);
                if(orgs[l].checked)
                {
                   //alert(orgs[l].value);
                   orgsval += orgs[l].value+",";
                }
                else
                {
                   sel = sel+1;
                }
          }
          if(sel == orgs.length)
          {
                //$('#imgProcess').addClass('hidden');
                alert(MSG_SELECT_ATLEAST_ONE_REC);
                return false;
          } else {
                if(orgsval.lastIndexOf(',') == orgsval.length-1)
                {
                   orgsval = orgsval.substring(0,orgsval.length-1);
                }
          }
          //alert(orgsval);
     }
     pars = "";
     $('#updating').show();
     if(mode == 'delete') {
          pars += "&val="+val+"&mode="+mode;
     } else if(mode == 'deleteall') {
          pars += "&val="+orgsval+"&mode="+mode;
     }

   url = SITE_URL+"index.php?file=m-aj_inbox_a";
	 //alert(url+pars);//return false;
	$.post(url, pars, function(resp)
	{
      //$('#updating').hide();
      //$('#dispmsg').attr('innerHTML',resp);
        $('#dispmsg').html(resp);
      getgrouplist('all',1);
      window.setTimeout("$('#updating').hide();", 1000);
	});

}