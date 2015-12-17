msgObj = '';
var linkId='';
function chkLogin(pg)
{
    // var er = false;
    var pars = "";
    var fromuser = "";
    var fname = "";

    if(pg == 'user')
    {
        fromuser = 'Yes';
        pg = 'admin';
    }
    var fromAdmin = '';
    if($('#fromadmin'))
    {
        if($('#fromadmin').val() != '')
        {
            fromAdmin = $('#fromadmin').val();
        }
    }

    if(pg == 'login')                          //try from login page.
    {
        var unObj =$('#username');
        var orgcodeObj =$('#orgcode');
        var passObj = $('#password');
        msgObj = $('#login_msg');
    }
    else if (pg == 'top')
    {
        var unObj 	=$('#top_uname');
        var passObj = $('#top_pass');
        msgObj = $('#top_msg');

    }
    else if(pg == 'admin')
    {
        var unObj 	=$('#login_uname');
        var passObj = $('#login_pass');
        msgObj = $('#top_msg');
        if($('#fname'))
        {
            if($('#fname').val() != '')
            {
                fname = $('#fname').val();
            }
        }
    }

    msgObj.attr('innerHTML','');

    if(trim(unObj.val()) == "" || trim(unObj.val()) == "Username")
    {
        if(fromAdmin == 'Yes'){
            msgObj.attr('innerHTML','Please Enter Your Username');
        }else{
            msgObj.attr('innerHTML',LBL_ENTER_USERNAME);
        }

        unObj.value ="";
        unObj.focus();
        //er = true;
        return false;
    }

    if(trim(passObj.val()) == "" || trim(passObj.val()) == "Password")
    {
        if(fromAdmin =='Yes'){
            msgObj.attr('innerHTML','Please Enter Password');
        }else{
            msgObj.attr('innerHTML',LBL_ENTER_PASSWORD);
        }

        passObj.value ="";
        passObj.focus();
        //er = true;
        return false;
    }

    if($.trim(orgcodeObj.val()) == '' && orgcodeObj.val() != '')
    {
        msgObj.attr('innerHTML',LBL_ENTER_ORGCODE);
        return false;
    }

    /* if(er)
   {  return false;  }
*/
    if($('#fromadmin'))
    {
        if($('#fromadmin').val() != '')
        {
            fromAdmin = $('#fromadmin').val();
        }
    }
    var str = '';
    var loginParameter = $('#loginParameter').val();
    var url = SITE_URL+"index.php?file=m-aj_authentication";
    if($('#remember'))
    {
        chk = $('#remember').attr('checked'); // orgcode
        pars = '&username='+unObj.val()+'&pswd='+passObj.val()+'&chk='+chk+'&fromadmin='+fromAdmin+'&orgcode='+orgcodeObj.val()+'&fromuser='+fromuser+'&fname='+fname+str+'&loginParameter='+loginParameter;
    }
    else
    {
        pars = '&username='+unObj.val()+'&pswd='+passObj.val()+'&fromAdmin='+fromAdmin+'&fromuser='+fromuser+'&fname='+fname+str+'&loginParameter='+loginParameter;
    }
    // alert(url+pars);
    // return false;
    $.ajax({
        type:"post", 
        url:url, 
        data:pars, 
        success:getloginmessage
    });
}

function isEmail(str)
{
    var nstr = trim(str);
    //if(isRequired(nstr)) return false;
    var re = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i
    return re.test(nstr);
}
function trim(s)
{
    return s.replace(/^\s+|\s+$/g, '');
}

function getloginmessage(originalRequest)
{
    //alert(originalRequest);
    //    if(originalRequest.responseText.indexOf('invalid') == -1)
    //	{
    var xmlDocument = originalRequest; // .responseXML;
    var exist	=	xmlDocument.getElementsByTagName('succ').item(0).firstChild.data;
    var fname	=	xmlDocument.getElementsByTagName('fname').item(0).firstChild.data;
    var fromadmin	=	xmlDocument.getElementsByTagName('fromadmin').item(0).firstChild.data;

    if(exist == 0)
    {
        msgObj.attr('innerHTML','<font color="red">'+LBL_LOGIN_FAIL+'</font>');
        return false;
    }
    else if(exist == 1)
    {
        var msg ="loginsucc";
        if(fname != '' && fname != 'no' && fname != '-')
        {
            window.location=SITE_URL_DUM+fname;
            return false;
        }
        else if($('#linkurl'))
        {
            if($('#linkurl').val() !='')
            {
                window.location=SITE_URL_DUM+$('#linkurl').val();
                return false;
            }
        }
        else
        {
            window.location=SITE_URL_DUM;
            return false;
        }
    }
    else if(exist == 2)
    {
        if(fromadmin =='Yes'){
            msgObj.attr('innerHTML','<font color="red">Your account is currently Inactive.</font>');
        }else{
            msgObj.attr('innerHTML','<font color="red">'+LBL_ACCOUNT_INACTIVE+'</font>');
        }

    }
    else if(exist == 4)
    {
        if(fromadmin =='Yes'){
            msgObj.attr('innerHTML','<font color="red">Your account is temporarily block.</font>');
        }else{
            msgObj.attr('innerHTML','<font color="red">'+LBL_ACCOUNT_BLOCK+'</font>');
        }
    }
    else if(exist == 3)
    {
        if(fromadmin =='Yes'){
            msgObj.attr('innerHTML','<font color="red">Your account has not yet been verified. Please check your mail for verification link.</font>');
        }else{
            msgObj.attr('innerHTML','<font color="red">'+LBL_ACCOUNT_NOT_VARIFIED+'</font>');
        }
    }
//	}
}

function clickLogout(vSessId)
{
    var pars="";
    var url = SITE_URL+"index.php?file=mem-aj_logout";
    pars = '&vSessionId='+vSessId;
    var myAjax = new Ajax.Request(url, {
        method:'get', 
        parameters:pars, 
        onSuccess: getloginmessage
    });
    document.getElementById('onlineAnother').style.display ='none';
}

/* JForgorPassword JS*/
function forgotPass()
{
    var username = $.trim($('#usrname').val());
    var orgcode = $.trim($('#orcode').val());
    if($.trim(username) == '') {
        $('#fp_msg').attr('innerHTML',LBL_ENTER_USERNAME);
        return false;
    }
    var url = SITE_URL+"index.php?file=m-aj_sendfplink";
    var pars = '&username='+username+'&orgcode='+orgcode;
    //alert(url+pars);return false;
    // var myAjax = new Ajax.Request(url, {method:'get',	parameters:pars,	onComplete:getnewsresponse });
    $.ajax({
        type:"GET", 
        url:url, 
        data:pars, 
        success:function(resp) {
            $('#fp_msg').attr('innerHTML', resp);
            return false;
        }
    });
}

/*function getfpmessage(originalRequest)
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
}*/

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