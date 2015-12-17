function forgotPass()
{
   var username = $.trim($('#usrname').val());
   var orgcode = $.trim($('#orcode').val());

   if($.trim(username) == '')
   {
      $('#fp_msg').attr('innerHTML',LBL_ENTER_USERNAME);
      return false;
   }

	var url = SITE_URL+"index.php?file=m-aj_forgotpass";
	var pars = '&username='+username+'&orgcode='+orgcode;
	//alert(url+pars);return false;
	// var myAjax = new Ajax.Request(url, {method:'get',	parameters:pars,	onComplete:getnewsresponse });
   $.ajax({type:"GET", url:url, data:pars, success:getfpmessage});
}

function getfpmessage(originalRequest)
{
	//put returned XML
//	if(originalRequest.responseText.indexOf('invalid') == -1)
//	{
		// var xmlDocument = originalRequest.responseXML;

      var xmlDocument = originalRequest;
		var message = xmlDocument.getElementsByTagName('msg').item(0).firstChild.data;

		if(message == 1)
		{
         $('#fp_msg').attr('innerHTML',LBL_LOGIN_INFO_SENT);
			return false;
		}
		else
		{
         $('#fp_msg').attr('innerHTML',LBL_USER_NOT_AVAILABLE);
         return false;
		}
//	}
}

function isEmail(str)
{
	//alert(str);
	var nstr = trim(str);
	//if(isRequired(nstr)) return false;
	var re = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i
	return re.test(nstr);
}

function trim(s)
{
 	return s.replace(/^\s+|\s+$/g, '');
}

function getclear(obj)
{

	if(obj.val() == 'Email Address' )
   {
		obj.val('');
	}
}

function getDefaultValue(obj)
{
	if(obj.val() == "")
   {
		obj.val('Email Address');
	}
}
