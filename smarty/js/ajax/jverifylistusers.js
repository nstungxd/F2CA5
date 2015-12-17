$('#checkbox').click( function ()
{
	users = $('input:checkbox[name="users\[\]"]');
	if($(this).attr('checked'))
	{
		$.each(users, function (ln,el) {
			$(this).attr('checked','checked');
		});
	}
	else
	{
		$.each(users, function (ln,el) {
			$(this).attr('checked','');
		});
	}
});
function getuserlist(vl,pg,cursort)
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
	listusers(pg);
}
function listusers(pg)
{
	pars = "";
	vl = $('#mod').val();
	if(vl == 'all' || $.trim(vl) == '')
	{
		var val = $('#search_text').val();
		pars += "&val="+val+"&mod="+vl+"&eUserType="+$.trim($('#eUserType').val());
	}
	else if(vl == 'srch')
	{
		var val = $.trim($('#vUserName').val());
		pars += "&mod=srch"+"&vUserName="+$.trim($('#vUserName').val())+"&vEmail="+$.trim($('#vEmail').val())+"&eUserType="+$.trim($('#eUserType').val())+"&vCountry="+$.trim($('#vCountry').val())+"&vCompanyName="+$.trim($('#vCompanyName').val());
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
	url = SITE_URL+"index.php?file=u-aj_verifyorganizationuserlist";
	$('#mod').val(vl);
	// alert(url+pars);
	$.post(url, pars, function(resp)
	{
      $('#updating').hide();
      $('#userlist').attr('innerHTML',resp);
      //$.getScript(SITE_URL_DUM+'js/ajax/coreajax.js');
      //window.setTimeout("$('#updating').hide();", 1000);
		$(document).ready( function() {
			$(function() {
				$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15});
			});
		});
	});
}
getuserlist('all',1);

function Delete(mode,val)
{
     if(mode == 'deleteall') {
          var sel = 0;
          var orgsval = '';
          var orgs = document.getElementsByName('users[]');

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
     if(mode == 'delete') {
          pars += "&val="+val+"&mode="+mode;
     } else if(mode == 'deleteall') {
          pars += "&val="+orgsval+"&mode="+mode;
     }

     url = SITE_URL+"index.php?file=u-aj_organizationuserlist_a";
	 //alert(url+pars);
	$.post(url, pars, function(resp)
	{
      //$('#updating').hide();
      $('#dispmsg').attr('innerHTML',resp);
      //window.setTimeout("$('#updating').hide();", 1000);
	});
     getuserlist('all',1);
}