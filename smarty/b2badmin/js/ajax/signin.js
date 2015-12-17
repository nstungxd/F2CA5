/**
 * This file is the Ajax file to Check login authentification for Admin.
 *
 * @package		login.js
 * @section		login
 * @author		Jack Scott
 */
function checkauthLogin() {
	var uname 	= $('#vUserName').val();
	var acesstype = $('#acesstype').val();

	if(uname == ""){
		alert("Please enter username");
		$('#vUserName').focus();
		return false;
	}
	var pass	=$('#vPassword').val();
	if(pass == ""){
		alert("Please enter password");
		$('#vPassword').focus();
		return false;
	}


     if($('input[name=chk]').attr('checked'))
     {
          var chk =$('#chk').val();
     }
     else
     {
          var chk = "No";
     }
	
	var loginparameter = $('#loginParameter').val();        
	var url = ADMIN_URL+"index.php?file=aj-auth";
	var pars = '&uname='+uname+'&pass='+pass+'&chk='+chk+'&acesstype='+acesstype+'&loginparameter='+loginparameter;
	//alert(url+pars);
	//return false;
	$.ajax({
		   type: "GET",
		   url: url,
		   data: pars,
		   success: showResponse
	 });
	/*
	var myAjax = new Ajax.Request(
			url, 
			{
				method: 'get', 
				parameters: pars, 
				onComplete: showResponse
			});
	*/	
}
function showResponse(originalRequest)
{
	var xmlDocument = originalRequest; 
	var succ = xmlDocument.getElementsByTagName('succ').item(0).firstChild.data;
	if(succ == "1")
	{
		$('#divSignin').slideUp('slow');
		setTimeout("Redirect()",2500);
		return false;
	}
	else if(succ == "2")
	{
		$('#login_div').effect("shake", {distance:8,direction:"left", times:4 }, 100);
		var msg = "Your login temporarily inactive. Please contact administrator."
		$('#msg').html(msg);
	}else{
		$('#login_div').effect("shake", {distance:8,direction:"left", times:4 }, 100);
		var msg = "Wrong Username/Password."
		$('#msg').html(msg);		
	}
}
function Redirect()
{
	var acesstype = $('#acesstype').val();
	window.location = ADMIN_URL+'index.php?file=ge-home&view=edit&AX=Yes';
}

function checkUname(type){
	var pars ='';
	var uname 	= $('#vFUserName').val();
	if(uname == ""){
		alert("Please enter username");
		$('#vFUserName').focus();
		return false;
	}
	
	var url = ADMIN_URL+"index.php?file=aj-fpass";
	
	if(uname != '')
		pars+= '&type='+type+'&uname='+uname;
	//alert(url+pars);
	//return false;
	
	$.ajax({
		   type: "GET",
		   url: url,
		   data: pars,
		   success: getChkUname
	 });
	 /*
	var myAjax = new Ajax.Request(
			url, 
			{
				method: 'get', 
				parameters: pars, 
				onComplete: getChkUname
			});*/
		
}
function getChkUname(originalRequest){
	var xmlDocument = originalRequest; 
	var succ 		= xmlDocument.getElementsByTagName('succ').item(0).firstChild.data;
	var type 		= xmlDocument.getElementsByTagName('type').item(0).firstChild.data;
     
	if(type == 'uname')
	{
		if(succ == '1'){
			//$('fpass').style.display= "";
			$('#smsgrow').show();
			$('#fmsgrow').hide();
			$('#funamebtn').hide();
			$('#funame').hide();
			$('#smsg').html("Your password has been sent to your email.Please check your email and login.");
			document.frmlogin.reset();
		}else{
			$('#smsgrow').show();
			$('#smsg').html("User Name does not exist.Please enter valid user name.");
			return false;
		}	
	}
}