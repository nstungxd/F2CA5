//created by pradip ku dash on 24-oct-08
function rLblank(obj,val)
{
	if(val == 1)
	{
  		if(obj.id == 'vEmail'){
        if(obj.value != ''){
          if(obj.value=='Email'){
    		  obj.value='';
          }else if(obj.value !='Email'){
            obj.value=obj.value;
          }
        }else{
          obj.value ='Email';
        }

      }else if(obj.id == 'vPassword'){
        if(obj.value != ''){
          if(obj.value=='Password'){
      		  obj.value='';
          }else if(obj.value !='Password'){
            obj.value=obj.value;
          }
        }else{
          obj.value ='Password';
        }
      }
  }
	//oldObject = document.getElementById('vPassword');
  //changeInputType1(oldObject);
}
function chkDigitZipcode(events)
{
	var unicodes=events.charCode? events.charCode :events.keyCode;
	//alert(unicodes);
	if (unicodes!=8)
	{ //backspace
	        if( (unicodes>47 && unicodes<58 || unicodes == 127 || unicodes == 9)){
	        	return true;
			}else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}
function checkemail(obj)
{
  if(obj.id == 'vEmail')
  {
    obj.value ='Email';
  }else if(obj.id == 'vPassword')
  {
    obj.value ='Password';
  }
}
function getFocused(obj,func){
  if(func == '0'){
    changeInputType(obj);
  }else{
    changeInputType1(obj);
  }
}
//check only Quantity
function chkQty(events)
{

	var unicodes=events.charCode? events.charCode :events.keyCode;
	//alert(unicodes);
	if (unicodes!=8)
	{ //backspace
	    if( (unicodes>47 && unicodes<58 || unicodes == 9)){
	            return true;
			}else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}
function changeInputType(oldObject){
if(oldObject.type == 'text'){
    if(oldObject.value == 'Password' || oldObject.value == ''){
      var newObject = document.createElement('input');
      newObject.type = "password";
      if(oldObject.size) newObject.size = oldObject.size;
      newObject.value = "";
      if(oldObject.name) newObject.name = oldObject.name;
      if(oldObject.id) newObject.id = oldObject.id;
      if(oldObject.className) newObject.className = oldObject.className;
      newObject.style.width= "147px";
      if(oldObject.tabIndex) newObject.tabIndex = oldObject.tabIndex;
      if(oldObject.onblur) newObject.onblur= oldObject.onblur;
      if(oldObject.onfocus) newObject.onfocus= oldObject.onfocus;
      if(oldObject.onkeypress) newObject.onkeypress= oldObject.onkeypress;

      oldObject.parentNode.replaceChild(newObject,oldObject);
    }
  }

}
function changeInputType1(oldObject){

  if(oldObject.type != 'text'){
    if(oldObject.value == ''){
      var newObject = document.createElement('input');
      newObject.type = "text";
      if(oldObject.size) newObject.size = oldObject.size;
      newObject.value = "Password";
      if(oldObject.name) newObject.name = oldObject.name;
      if(oldObject.id) newObject.id = oldObject.id;
      if(oldObject.className) newObject.className = oldObject.className;
      newObject.style.width= "147px";
      if(oldObject.tabIndex) newObject.tabIndex = oldObject.tabIndex;
      if(oldObject.onblur) newObject.onblur= oldObject.onblur;
      if(oldObject.onfocus) newObject.onfocus= oldObject.onfocus;
      if(oldObject.onkeypress) newObject.onkeypress= oldObject.onkeypress;
      oldObject.parentNode.replaceChild(newObject,oldObject);
      $('btnLogin').focus();
    }
  }
}
function displayImg(obj){
 var ext= obj.value.split(".");
 if((ext[1].toLowerCase() != 'jpg') && (ext[1].toLowerCase() != 'gif')){
    alert("Supported Files Types .jpg and .gif");
    return false;
 }else{
    if(obj.files){
		  var data = obj.files.item(0).getAsDataURL();
	  }else{
		  var data = obj.value;
	  }
	  $('imgb').src = data;
 }
}

function getTabbed(events){
  var unicodes=events.charCode? events.charCode :events.keyCode;

  if(unicodes == 9){
    $('btnLogin').focus();
  }
}
function chkValidPhone(events)
{
var unicodes=events.charCode? events.charCode :events.keyCode;
//alert(unicodes);
/*return false;*/
	if (unicodes!=8)
	{ //backspace
	        if( (unicodes>46 && unicodes<58) || unicodes == 46 || unicodes == 45 || unicodes == 40 || unicodes == 41 || unicodes == 43 || unicodes == 32 || unicodes == 9 || unicodes == 91 || unicodes == 93 || unicodes == 36)
	            return true;
			else
				return false;
	}

}
//check only digit
function chkDigit(events){
  var unicodes=events.charCode? events.charCode :events.keyCode;
  //alert(unicodes);
	if (unicodes!=8)
	{ //backspace
	        if((unicodes>47 && unicodes<58)){
	            return true;
			}else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}
function chkPrice(obj,events)
{
	//alert(obj.value);
	var unicodes=events.charCode? events.charCode :events.keyCode;
	//alert(unicodes);
	var getdot =0;
	if (unicodes!=8)
	{ //backspace
	        if((unicodes>47 && unicodes<58 || unicodes == 46 || unicodes == 9)){
				for(i=0;i<obj.value.length;i++){
					if(obj.value[i] == "."){
						getdot = getdot+1;
					}
				}
				if(getdot > 0 && unicodes == 46){
					if(events.charCode == 0)
						return true;
					else
						return false;
				}else{
					return true;
				}
			}else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}

function chkDot(obj)
{
	var val = 	obj.value.split(".");
	//alert(parseInt(obj.value));
	if(parseInt(obj.value) > 0){
		obj.value = obj.value;
	}else if(isNaN(val[1]) || val[1] <= 0){
		obj.value = "0.00";
	}
}

//checked limit of words in a text field
function limitText(limitField,limitNum)
{
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
		return false;
	}
	return true;
}

function fillState(control, statcode, val)
{

	control.options.length = 0;
	control.options[0] = new Option("---- Select state -----");
	control.options[0].value = "";
	for(i=0,j=1; i<stateArr.length; i++)
	{
		if(stateArr[i][0] == val)
		{
			if(statcode == stateArr[i][3])
			{
				control.options[j] = new Option( stateArr[i][2]);
				control.options[j].value = stateArr[i][3];
				control.options[j].selected = true;
			}
			else
			{
				control.options[j] = new Option( stateArr[i][2]);
				control.options[j].value = stateArr[i][3];
			}
			j++;
		}
	}
	control.options[j] = new Option("Other");
	control.options[j].value = "Other";
	if(statcode == "Other")
	{
		control.options[j].selected = true;

	}
}

//Added by pradip
function chkValidChar(events)
{
var unicodes=events.charCode? events.charCode :events.keyCode;
//alert(unicodes);
	if (unicodes!=8)
	{
	     if((unicodes > 96 && unicodes < 123) ||(unicodes > 64 && unicodes < 91) || unicodes == 32 || (unicodes > 47 && unicodes < 58)){
		 	return true;
		 }else{
			if(events.charCode == 0)
					return true;
				else
					return false;
		}
	}
}
function chkValidPassword(events)
{
var unicodes=events.charCode? events.charCode :events.keyCode;

/*alert(unicodes);
return false;*/
	if (unicodes!=8)
	{//backspace
	        if((unicodes == 32))
	            return false;
			else
				return true;
	}
}

function chkCharUser(events)
{
var unicodes=events.charCode? events.charCode :events.keyCode;
/*return false;*/
	if (unicodes!=8)
	{ //backspace
	        if((unicodes>31 && unicodes<46) || unicodes == 94 || unicodes == 61 || unicodes == 95 || unicodes == 64 || unicodes == 96)
	            return false;
			else
				return true;
	}
}

//zip code validation
function chkZip(events)
{
	var codes=events.charCode? events.charCode :events.keyCode;
	//alert(codes);
	/*return false;*/
	if (codes!=8 && codes!=9){ //backspace
	        if( (codes>47 && codes<58) || (codes>64 && codes<91) || (codes>96 && codes<122) || (codes == 32))
	            return true;
			else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}

function chkSpace(events)
{
	var unicodes=events.charCode? events.charCode :events.keyCode;
	//alert(unicodes);
	if (unicodes!=8)
	{ //backspace
	        if(unicodes!=32)
	            return true;
			else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}

function noCTRL(e)
{
	var forbiddenKeys = new Array('c','x','v');
	var keyCode = (e.keyCode) ? e.keyCode : e.which;
	if(e.ctrlKey) {
		for(i = 0; i < forbiddenKeys.length; i++) {
			if(forbiddenKeys[i] == String.fromCharCode(keyCode).toLowerCase()) {
			return false;
			}
		}
	}
}

//devloped by pradip
function ChkFormat(events,val,type,id)
{
	//alert(navigator.appName);
	if(navigator.appName == 'Microsoft Internet Explorer'){
		var chkdigit = '3';
	}else{
		var chkdigit = '2';
	}
	var chktype = type;
	var chkid =id;
	var unicodes=events.charCode? events.charCode :events.keyCode;
	//alert(unicodes);
	var firstlength = val.length;
	if(unicodes!=8){
		if( (unicodes>47 && unicodes<58 ||  unicodes == 9 )){
			if(firstlength >= chkdigit && chktype == 'phone'){
				if(unicodes>47 && unicodes<58){
					if(chkid == 'vPhone1'){
						$('vPhone2').focus();
					}
					else if(chkid == 'vPhone2'){
						$('vPhone3').focus();
					}
					else if(chkid == 'vPhone3'){

					}
				}
			}else if (firstlength >= chkdigit && chktype == 'mobile'){
				if(unicodes>47 && unicodes<58){
					if(chkid == 'vMobile1'){
						$('vMobile2').focus();
					}
					else if(chkid == 'vMobile2'){
						$('vMobile3').focus();
					}else if(chkid == 'vMobile3'){

					}
				}
			}else if (firstlength >= chkdigit && chktype == 'fax'){
				if(unicodes>47 && unicodes<58){
					if(chkid == 'vFax1'){
						$('vFax2').focus();
					}else if(chkid == 'vFax2'){
						$('vFax3').focus();
					}else if(chkid == 'vFax3'){

					}
				}
			}
			return true;
		}else{
			if(events.charCode == 0)
					return true;
			else
				return false;
		}
	}
}

function resChkAll(chk,totno){
	for(i=0;i<totno;i++)
	{
		if(chk == true)
		$("ch"+i).checked = "true";
		else
		$("ch"+i).checked = false;
	}

}

function focuses(id)
{
	document.getElementById(id).focus();
}

/* To get relative Combo */
/*function getRelativeCombo(id,selectedCat,combId,comboText,genArr)
{
	//alert(id);
	var val =id;
	var control	= document.getElementById(""+combId+"");
	control.options.length = 0;
	control.options[0] = new Option("---"+comboText+"---");
	control.options[0].value = "";

	for(i=0,j=0; i< genArr.length; i++)
	{
		//alert(genArr[i][2]+"===>"+val);
		if(genArr[i][2] == val)
		{
			if(selectedCat == genArr[i][0])
			{
			 //alert(genArr[i][0]);
				control.options[j+1] = new Option(genArr[i][1]);
				control.options[j+1].value = genArr[i][0];
				control.options[j+1].selected = true;
			} else {
				control.options[j+1] = new Option(genArr[i][1]);
				control.options[j+1].value = genArr[i][0];
			}
			j++;
		}
	}
}*/
function getRelativeCombo(val,selectedCat,combId,comboText,genArr)
{
	var control	= document.getElementById(""+combId+"");
	control.options.length = 0;
	var options = "";
	options = "<option value=''>---"+comboText+"---</option>";
	for(i=0,j=0; i < genArr.length; i++)
	{
		//alert(genArr[i][2]+"===>"+val);
		if(genArr[i][2] == val)
		{
			if(selectedCat == genArr[i][0])
			{
				options = options + "<option value='"+genArr[i][0]+"' selected='selected'>"+genArr[i][1]+"</option>";
				//alert(genArr[i][0]);
			} else {
				options = options + "<option value='"+genArr[i][0]+"'>"+genArr[i][1]+"</option>";
			}
			j++;
		}
	}
	// control.innerHTML = options;
	$(control).html(options);
}

//for zip,state,and city will be null if country not selected
function getRelativeState(id,selectedCat,combId,comboText,genArr,ext){
	var val = id;
   // alert(val);
	if(ext && ext !='')
	var extval = $(ext).value;
	var control	=$(""+combId+"");
	if(id == ''){
      $('vZip').value = '';
      $('vCity').value = '';
  }
	//alert(control.options.length);
	control.options.length = 0;
	control.options[0] = new Option(comboText);
	control.options[0].value = "";
	for(i=0,j=0; i< genArr.length; i++)
	{
		if(ext && ext !=''){
			if(genArr[i][2] == val && extval == genArr[i][3])
			{

				if(selectedCat == genArr[i][0])
				{
					control.options[j+1] = new Option(genArr[i][1]);
					control.options[j+1].value = genArr[i][0];
					control.options[j+1].selected = true;
				}else
				{
					control.options[j+1] = new Option(genArr[i][1]);
					control.options[j+1].value = genArr[i][0];
					//alert(control.options[j+1].value);
				}
				j++;
			}
		} else {
			if(genArr[i][2] == val)
			{
				if(selectedCat == genArr[i][0])
				{
					control.options[j+1] = new Option(genArr[i][1]);
					control.options[j+1].value = genArr[i][0];
					control.options[j+1].selected = true;
				} else {
					control.options[j+1] = new Option(genArr[i][1]);
					control.options[j+1].value = genArr[i][0];
					//alert(control.options[j+1].value);
				}
				j++;
			}
		}
	}
}

function trim(s)
{
 	return s.replace(/^\s+|\s+$/g, '');
}

function noCTRL(e)
{
	var forbiddenKeys = new Array('c','x','v');
	var keyCode = (e.keyCode) ? e.keyCode : e.which;
	if(e.ctrlKey) {
		for(i = 0; i < forbiddenKeys.length; i++) {
			if(forbiddenKeys[i] == String.fromCharCode(keyCode).toLowerCase()) {
			return false;
			}
		}
	}
}

function getclearAddvance(obj) {
	var msg = $(obj.id).value;

	if(msg == '')
		msg = 'ZIP Code or City, State';
	$('msg').value = msg;
	if(obj.value == msg){
		obj.value='';
	}
}

function getDefaultValue(obj) {
   if(obj.value == "") {
      if(obj.id == 'vEmail') {
         //obj.value = $('msg').value;
         obj.value = "Email";
      } else if(obj.id == 'vPassword') {
         obj.value = "Password";
      } else {
         obj.value = $('msg').value;
      }
	}
	$('msg').value = '';
}

function ChkFormatPhone(events,val,type,id)
{
	//alert(navigator.appName);
	if(navigator.appName == 'Microsoft Internet Explorer') {
		var chkdigit = '3';
	} else {
		var chkdigit = '2';
	}
	var chktype = type;
	var chkid =id;
	var unicodes=events.charCode? events.charCode :events.keyCode;
	//alert(unicodes);
	var firstlength = val.length;
	if(unicodes!=8 && unicodes!=9){
		if((unicodes>47 && unicodes<58 ||  unicodes == 9 )) {
			if(firstlength >= chkdigit && chktype == 'phone') {
				if(unicodes>47 && unicodes<58) {
					var newchkid = chkid.substr(0,(chkid.length-1));
					if($(newchkid+'2')) {
						$(newchkid+'2').focus();
					}
					/*$(newchkid+'2').focus();
					if(chkid == 'vPhone1'){

					}else if(chkid == 'vPhone2'){

					}else if(chkid == 'vMobile1'){
						$('vMobile2').focus();
					}*/
				}
			} else if (firstlength >= chkdigit && chktype == 'ophone') {
				if(unicodes>47 && unicodes<58) {
					var newchkid = chkid.substr(0,(chkid.length-1));
					if($(newchkid+'2')){
						$(newchkid+'2').focus();
					}
					/*if(chkid == 'vOPhone1'){
						$('vOPhone2').focus();
					}else if(chkid == 'vOPhone2'){

					}else if(chkid == 'vMobile1'){
						$('vMobile2').focus();
					}*/
				}
			}
			return true;
		}else{
			if(events.charCode == 0)
					return true;
			else
				return false;
		}
	}
}

function chkValidUserName(events)
{
var unicodes=events.charCode? events.charCode :events.keyCode;
//alert(unicodes);
	if (unicodes!=8)
	{
	     if((unicodes >= 96 && unicodes <= 122) ||(unicodes >= 48 && unicodes < 57)){
		 	return true;
		 }else{
			if(events.charCode == 0)
					return true;
				else
					return false;
		}
	}
}

function chkalphanum(events)
{
var unicodes=events.charCode? events.charCode :events.keyCode;
//alert(unicodes);
	if (unicodes!=8)
	{
	   if((unicodes >= 96 && unicodes <= 122) || (unicodes >= 48 && unicodes <= 57) || (unicodes >= 65 && unicodes <= 90)){
		 	return true;
		}else{
			if(events.charCode == 0)
					return true;
				else
					return false;
		}
	}
}

function GetSectionCombo(sectionArr,combId,selectedCat){
	var control	=	$(""+combId+"");
	control.options.length = 0;
	control.options[0] = new Option("--- Filter Column ---");
	control.options[0].value = "";

	var selectedval  = $('transferedfirld').value;
	if(selectedval != ''){
		selectedval = selectedval.substr(0,(selectedval.length-1));
		selectedval = selectedval.split(',');
	}

	for(i=0,j=0; i<sectionArr.length; i++)
	{
		for(k=0;k<selectedval.length;k++){

			if(selectedval[k] == sectionArr[i][0]){
				if(selectedCat == sectionArr[i][0])
				{
				 //alert(genArr[i][0]);
					control.options[j+1] = new Option(sectionArr[i][1]);
					control.options[j+1].value = sectionArr[i][0];
					control.options[j+1].selected = true;
				}else
				{
					control.options[j+1] = new Option(sectionArr[i][1]);
					control.options[j+1].value = sectionArr[i][0];
				}
				j++;
			}
		}
	}
}

function passwordChk(vl)
{
	var uch="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	var lch="abcdefghijklmnopqrstuvwxyz";
	var nch="0123456789";

	var n='2';
	var uc='2';
	var lc='2';

	for(var ln=0 ;ln<vl.length; ln++)
	{
		var c = vl.charAt(ln);
		if(nch.indexOf(c) != -1)
		{
			n='3';
		}
		else if(uch.indexOf(c) != -1)
		{
			uc='3';
		}
		else if(lch.indexOf(c) != -1)
		{
			lc='3';
		}
	}
	if(n=='2' || lc=='2' || uc=='2')
	{
		return false;
	}
	return true;
}

function refreshsamepage()
{
	window.location = window.location;
}

/*
function translate(el,currentlang)
{
   if($('#language'))
   {
//      $('#language').change(function(e)
//      {
//         $('#frmlanguage').submit();
//      });

      $('#textToTranslate').translate( 'es', 'en',
      {
        not: 'select',
        start: function()   {   $('#throbber').show()    },
        complete: function(){   $('#throbber').hide()    },
        error: function()   {   $('#throbber').hide()    }
      })

      $('#'+el).translate('en',currentlang,{not: 'label,select'});
   }
}
*/

function sh_el(vl)
{
	var el = document.getElementById(vl);
   // alert(el.style.display);
	if(el.style.display == 'none' || el.style.display == 'block')
	{
		$('#'+vl).slideDown();
      $('#'+vl).show();
//      $('#'+vl+' p').removeClass('hidden');
      $('#'+vl+' ul').removeClass('hidden');
	}
}

function openpopup(url)
{
  window.open (url,'mywindow','left=300,top=100,width=590,scrollbars=yes,height=350,toolbar=no,resizable=1');
}

function getChkVal(url,project,tool)
{
   var delparm='';
   var delitem='';

   itm = $('#pad input:checked');
   itm.each(function (intIndex)
   {
//      if($(this).attr('checked'))
//      {
      if(intIndex < itm.length-1)
      {
         delitem+=$(this).val()+',';
      }
      else if(intIndex == itm.length-1)
      {
         delitem+=$(this).val();
      }
//      }
   });

    if(tool != '')
   {
      delparm="&pid="+project+"&ids="+delitem+"&tool="+tool;
   }
   else
   {
      delparm="&ids="+delitem;
   }
   //alert(url+delparm);
   CallColoerBox(url+delparm,500,320,'options');
}

/*
//checked limit of words in a text field
function limitText(limitField,limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
		return false;
	}
}*/

function chkDigitMobcode(events)
{
	var unicodes=events.charCode? events.charCode :events.keyCode;
	//alert(unicodes);
	if (unicodes!=8)
	{ //backspace
	        if( (unicodes>47 && unicodes<58 || unicodes == 40 || unicodes == 41 || unicodes == 43 || unicodes == 45)){
	        	return true;
			}else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}

$(document).ready(function()
{
	if($('.tltp').length>0) {
		$('.tltp').focus(function() {
			if($.trim($(this).val())==$(this).attr('title')) {
				$(this).val('');
			}
		});
		$('.tltp').blur(function() {
			if($.trim($(this).val())=='') {
				$(this).val($(this).attr('title'));
			}
		});
		$.each($('.tltp'), function(i,el) {
			if($.trim($(this).val())=='') {
				$(this).val($(this).attr('title'));
			}
		});
	}
});
