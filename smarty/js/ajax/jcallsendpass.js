function callsendpass()
{
  $("fmsg").innerHTML = '';
   if($F('vFEmail') == '')
  {
    $("fmsg").innerHTML = '<font color="red">Please Enter Email</font>';
     $('vFEmail').select();
     return false;
  }
	var isE = isEmail($F('vFEmail'));
	if(isE == true)
	{
		var url = SITE_URL+"index.php?file=mem-aj_changePass";
		var pars = '&mail='+$F('vFEmail');
		//alert(url+pars);
		var myAjax = new Ajax.Request(
			url, 
			{
				method: 'get', 
				parameters: pars, 
				onComplete: getnewsresponse
			});
	}
	else
	{
	 //document.getElementById("customerid").style.display= '';
	 $("fmsg").innerHTML = '<font color="red">Please Enter Valid Email Address</font>';
		$('vFEmail').focus();
		//return false;
	}
}

function getnewsresponse(originalRequest)
{
	//put returned XML
	if(originalRequest.responseText.indexOf('invalid') == -1)
	{
		var xmlDocument = originalRequest.responseXML;
		var message = xmlDocument.getElementsByTagName('msg').item(0).firstChild.data;
		$("fmsg").style.display= '';
		if(message == 1)
		{
		  $("fmsg").innerHTML = '<font color="red">Your Password has been sent to your email address.</font>'; 
      	  return false;
    }
    else
    {
      $("fmsg").innerHTML = '<font color="red">Email Address provided is not available.</font>';
      //alert("User is not Available");
      return false;
    }
	}	
}
function isEmail(str){
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
function getclear(obj){

	if(obj.value == 'Email Address' ){
		obj.value='';
	}
}
function getDefaultValue(obj){
	if(obj.value == ""){
		obj.value = 'Email Address';
	}
}
