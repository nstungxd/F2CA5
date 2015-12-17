function getURLVar( name )
{
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var tmpURL = window.location.href;
  var results = regex.exec( tmpURL );
  if( results == null )
    return "";
  else
    return results[1];
}

function decode64(input) {
	var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	var output = "";
	var chr1, chr2, chr3;
	var enc1, enc2, enc3, enc4;
	var i = 0;

   // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
   input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

   do {
      enc1 = keyStr.indexOf(input.charAt(i++));
      enc2 = keyStr.indexOf(input.charAt(i++));
      enc3 = keyStr.indexOf(input.charAt(i++));
      enc4 = keyStr.indexOf(input.charAt(i++));

      chr1 = (enc1 << 2) | (enc2 >> 4);
      chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
      chr3 = ((enc3 & 3) << 6) | enc4;

      output = output + String.fromCharCode(chr1);

      if (enc3 != 64) {
         output = output + String.fromCharCode(chr2);
      }
      if (enc4 != 64) {
         output = output + String.fromCharCode(chr3);
      }
   } while (i < input.length);

   return output;
}

function getCheckedId()
{var x=0;
	var checked_Arr = "";
	for(i=0;i < document.frmlist.elements.length;i++)
	{
		if(document.frmlist.elements[i].id != 'checkbox' && document.frmlist.elements[i].checked == true)
		{
			checked_Arr+= document.frmlist.elements[i].value+",";
			x++;
		}
	}
	checked_Arr = checked_Arr.substring(0,checked_Arr.length -1);
	return checked_Arr;
}
function getSelectedArr(eStatus,fielName)
{
	var checedArr="";
	var ans;
	var msg;
	checkedArr = getCheckedId();
	if(checkedArr != "")
	{
		if(eStatus == 'Delete'){
			switch(fielName){
				default:
				msg = "Confirm deletion of selected record(s) ?";
				break;
			}
			ans = confirm(msg);
		}else
			ans = confirm("Confirm change the status of selected record(s) ?");
		if(ans == true)
		{
			document.frmlist.action.value=eStatus;
			return checkedArr;
		}else{
			$("#vStatus option[0]").attr("selected",true);
			return "";
		}
	}else{
		if(eStatus == 'Delete'){
			alert("Please select record(s) to delete");
			$("#vStatus option[0]").attr("selected",true);
			return ""; //checkedArr
		}else{
			alert("Please select record(s) to change status");
         $("#vStatus option[0]").attr("selected",true);
			return ""; // checkedArr
		}
	}
}

function getCheckAll(chk,totno,srt)
{
	var x=0;
	if(chk == true)
	{
		for(i=0;i < document.frmlist.elements.length;i++)
		{
			sid = (document.frmlist.elements[i].id);
			sid = sid.substring(0,2);
			if(sid == 'ch')
			{
				if(document.frmlist.elements[i].id != 'checkbox' && document.frmlist.elements[i].checked != true)
				{
					 $('#arraychk').value = $('#arraychk').value +document.frmlist.elements[i].value + ",";
					 document.frmlist.elements[i].checked = true;
				}
			}
		}
				 $('#arraychkall').value = $('#arraychkall').value + srt + ",";
	}
	else
	{
		for(i=0;i < document.frmlist.elements.length;i++)
		{
			sid = (document.frmlist.elements[i].id);
			sid = sid.substring(0,2);
			if(sid == 'ch')
			{
				if(document.frmlist.elements[i].id != 'checkbox' && document.frmlist.elements[i].checked == true)
				{
					$('#arraychk').val(($('#arraychk').val()).replace(document.frmlist.elements[i].value+',',''));
					document.frmlist.elements[i].checked = false;
				}

			}
		}
			$('#arraychkall').val(($('#arraychkall').val()).replace(srt+',',''));
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
function getChkboxArr(chkid,chk)
{
	var arr1;
	var x=0;
	if(chk == true)
	{
		if($('#arraychk') && chkid)
		{

			 $('#arraychk').val($('#arraychk').val() + chkid + ",");
		}
	}
	else
	{
		if($('#arraychk') && chkid)
		{
				$('#arraychk').val(($('#arraychk').val()).replace(chkid+',',''));
		}
	}
	return x;
}
function openSearch()
{
	$('#divSearchBox').show();
}
function closeSearch()
{
	$('#divSearchBox').hide();
}

function RedirectURL(URL,ExtraParam)
{
	if(!ExtraParam)ExtraParam='';
	window.location=URL+ExtraParam;
	return false;
}

function changeAlphaClass(id){
	for(i=65;i<=90;i++){
		if(id == 'alch_1'){
			if($("#alch_"+i).className == 'serching-active'){
				$("#alch_"+i).className= "searching";
			}else{
				$("#alch_"+i).className= $("#alch_"+i).className;
			}
			$('#'+id+'').className= "serching-active";
		}else{
			if($('#alch_1').className == "serching-active"){
				$('#alch_1').className = "searching";
			}else{
				$('#alch_1').className = $('#alch_1').className;
			}
			if(id == "alch_"+i)	{
				$('#'+id+'').className= "serching-active";
			}else{
				if($("#alch_"+i).className == 'serching-active')
					$("#alch_"+i).className= "searching";
			}
		}
	}
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
	if(unicodes!=8 && unicodes!=9){
		if( (unicodes>47 && unicodes<58 ||  unicodes == 9 )){
			if(firstlength >= chkdigit && chktype == 'phone'){
				if(unicodes>47 && unicodes<58){
					var newchkid = chkid.substr(0,(chkid.length-1));
					if($(newchkid+'2')){
						$(newchkid+'2').focus();
					}
				}
			}else if (firstlength >= chkdigit && chktype == 'ophone'){
				if(unicodes>47 && unicodes<58){
					var newchkid = chkid.substr(0,(chkid.length-1));
					if($(newchkid+'2')){
						$(newchkid+'2').focus();
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

function openMenu()
{
	var layer = $('#divQuickMenu');
	layer.show('slow');
	var iframe = $('#iframe');
	iframe.css({"display":'block',width:layer.width(),height:layer.height(),left:layer.position().left,top:layer.position().top});
	$('#divQuickMenu').show();
	return false;
}

function getQuickMenu(){
	$('#maximize').hide();
	$('#minimize').show();
	$("#openqickview").slideDown("slow");
}


function hideQuickMenu()
{
	$('#maximize').show();
	$('#minimize').hide('slow');
	$("#openqickview").slideUp("slow");
}
//to hide menus open all menus
function hideDIV()
{
	$('#divQuickMenu').hide('slow');
}
function checkDelete(msg)
{
	var y=0;var ans;
	y = getCheckCount();
	if(y>0)
	{ans = confirm("Confirm deletion of selected "+msg+"(s) ?");
		if(ans == true)
		{
			document.frmlist.view.value='delete';
			document.frmlist.chkCount.value=y;
			document.frmlist.submit();
			return true;
		}
		else
		{return false;}
	}
	else
	{alert("Please select a "+msg+"(s) to delete.");return false;}
}
function getCheckCount()
{
	var x=0;
	for(i=0;i < document.frmlist.elements.length;i++)
	{if (document.frmlist.elements[i].id == 'iId' && document.frmlist.elements[i].checked == true)
			{x++;}
	}
	return x;
}
function checkAll(val)
{
	for(i=0;i<document.frmlist.elements.length;i++)
	{
	  	if(document.frmlist.elements[i].id == 'iId')
  		{
			if(document.frmlist.elements[i]);
			document.frmlist.elements[i].checked = val;
		}
	}
}

function chkValidChar(events)
{
	var unicodes=events.charCode? events.charCode :events.keyCode;
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

function chkValidUserName(events) {
	var unicodes=events.charCode? events.charCode :events.keyCode;
	if (unicodes!=8)
	{
	     if((unicodes > 96 && unicodes <= 122) || (unicodes >= 48 && unicodes < 57)){ 	// || (unicodes >= 65 && unicodes <= 90)
		 	return true;
		 }else{
			if(events.charCode == 0)
					return true;
				else
					return false;
		}
	}
}
function chkValidPassword(events) {
	var unicodes=events.charCode? events.charCode :events.keyCode;
	if (unicodes!=8) {
	        if((unicodes == 32))
	            return false;
			else
				return true;
	}
}

function chkCharUser(events)
{
	var unicodes=events.charCode? events.charCode :events.keyCode;
	if (unicodes!=8) {
	        if((unicodes>31 && unicodes<46) || unicodes == 94 || unicodes == 61 || unicodes == 95 || unicodes == 64 || unicodes == 96)
	            return false;
			else
				return true;
	}
}

function chkValidPhone(events) {
	var unicodes=events.charCode? events.charCode :events.keyCode;
	if (unicodes!=8) {
	        if( (unicodes>47 && unicodes<58) || unicodes == 46 || unicodes == 45 || unicodes == 40 || unicodes == 41 || unicodes == 43 || unicodes == 32 || unicodes == 9 || unicodes == 91 || unicodes == 93)
	            return true;
			else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}

function ChkGrtZero(obj) {
	if(obj.value != '') {
		var val = 	obj.value.split(".");
		if(parseInt(obj.value) > 0){
			obj.value = obj.value;
		}else if(isNaN(val[1]) || val[1] <= 0){
			obj.value = "1";
		}
  	}
}

//check only digit
function chkDigit(events) {
	var unicodes=events.charCode? events.charCode :events.keyCode;
	if (unicodes!=8) {
	        if( (unicodes>47 && unicodes<58 || unicodes == 46 || unicodes == 9)){
	            return true;
			}else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}

//check only Quantity
function chkQty(events) {
	var unicodes=events.charCode? events.charCode :events.keyCode;
	if (unicodes!=8) {
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

function SelectAllList(CTRL) {
	CONTROL = $('#'+CTRL+' option');
	CONTROL.attr("selected","selected");
}
function DeselectAllList(CTRL) {
	CONTROL = $('#'+CTRL+' option');
	CONTROL.attr("selected","");
}

function chkPrice(events,obj) {
	var unicodes=events.charCode?events.charCode:events.keyCode;
	var getdot =0;
	if (unicodes!=8) {
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
function trim(s) {
 	return s.replace(/^\s+|\s+$/g, '');
}

function dispCal(val){
	if(val == 'log.dLoginDate'){
	 	$("#keyword").readOnly = true;
	 	Date.format = 'yyyy-mm-dd';
	 	$('#keyword').datePicker({startDate:'1996-01-01'});
	}else{
		$('#keyword').dpClose();
		$("#keyword").readOnly = false;
	}
}

//checked limit of words in a text field
function limitText(limitField,limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
		return false;
	}
}
/* Get Dislay Calender on searchbox */
function dispCalnem(val1,file,table){
	var val = val1.split('.');

	//ge-newsletter dLastSentDate
	if((file == 'ge-admin' && val[1] == 'dDate')||(file == 'ge-loginhistory' && val[1] == 'dLoginDate')||
  (file == 'ge-loginhistory' && val[1] == 'dLogoutDate')||
  (file == 'ge-whoisonline' && val[1] == 'vTimeLastClick' || val[1]=='vTimeEntry') ||
   (file == 'or-order' || val[1] == 'dAddedDate') ||(file == 'ge-contactus' || val[1] == 'dDate') || (file == 'ge-newsletter' && val[1] == 'dLastSentDate') || (file == 'pr-project' && val[1] == 'dCreateDate'))
	{
		html = '';
		if(file == 'ge-loginhistory' && val[1] == 'dLoginDate' || (file == 'ge-loginhistory' && val[1] == 'dLogoutDate'))
		{
			html += '<div>From:<input type="text" class="input-new" id="keyword" name="keyword"/></div>';
			html += '<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To:<input type="text" class="input-new" id="keyword1" name="keyword1"/></div>';

		}
		else
		{
			html += '<div><input type="text" class="input-new" id="keyword" name="keyword"/></div>';
		}
		$('#keywordtextbox').html(html);

		var strarr = datesId.split(',');
		for(i=0;i<strarr.length;i++){
		if(strarr[i] == val1){
			if($('#dateicon')){
				$('#dateicon').hide();
			}
			if(file == 'ge-loginhistory' && val[1] == 'dLoginDate' || (file == 'ge-loginhistory' && val[1] == 'dLogoutDate'))
			{
				$("#keyword").readOnly = true;
				Date.format = 'yyyy-mm-dd';
				$('#keyword').datePicker({startDate:'1996-01-01'});
				$("#keyword1").readOnly = true;
				Date.format = 'yyyy-mm-dd';
				$('#keyword1').datePicker({startDate:'1996-01-01'});
			}
			else
			{
				$("#keyword").readOnly = true;
				if((file == 'ge-admin' || val[1] == 'dDate') || (file == 'ge-testimonials' || val[1] == 'dAddedDate')||(file == 'or-order' || val[1] == 'dAddedDate') ||(file == 'ge-newsletter' || val[1] == 'dLastSentDate') ||(file == 'ge-request' || val[1] == 'dRequestDate') ||
  (file == 'ge-whoisonline' && val[1] == 'vTimeLastClick' || val[1]=='vTimeEntry'))
				{
					Date.format = 'yyyy-mm-dd';
					$('#keyword').datePicker({startDate:'1996-01-01'});
				}
				else
				{
					Date.format = 'yyyy-mm-dd';
					$('#keyword').datePicker({startDate:'1996-01-01'});
				}
			}
			return false;
		}else{
			$("#keyword").value = '';
			$("#keyword").readOnly = false;
			if($('#dateicon')){
				$('#dateicon').hide();
			}
		}
	}
	}
	else
	{
	var	pars = '&field='+val[1]+'&table='+table;
	var url = ADMIN_URL+"index.php?file=aj-searchbox";
    //alert(url+pars);
	$.ajax({
	   type: "GET",
	   url: url,
	   data: pars,
	   success: function(data){
	     showResponse(data);
	   }
	 });
	/*
	//alert(url+pars);
	var myAjax = new Ajax.Request(
			url,
			{
				method: 'get',
				parameters: pars,
				onSuccess: this.showResponse
			}
		);*/
	}
}


function showResponse(originalRequest) {
	html = '';
	var list = new Array();
	var xmlDocument = originalRequest;
	var total	=xmlDocument.getElementsByTagName('total').item(0).firstChild.data;
	if(total > 1)
	{
		html += '<select style="width:140px" id="keyword" name="keyword" class="input-new">';
		for(i=0;i<total;i++ )
		{
				list[i] = xmlDocument.getElementsByTagName('enumval').item(i).firstChild.data
				if (list[i] == 'isDelete'){
        html +='<option value="'+list[i]+'">Deleted</option>';
      }else{
				   html +='<option value="'+list[i]+'">'+list[i]+'</option>';
				}
		}
			html +='</select>';

	}
	else
	{
			html += '<input type="text" class="input-new" id="keyword" name="keyword"/>';
	}
	$('#keywordtextbox').html(html);
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

function displayImg(obj){
 //alert(obj.value);
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

/* To get relative Combo */
function getRelativeCombo(id,selectedCat,combId,comboText,genArr,ext){
	//alert(genArr);
	var val = id;
	if(ext && ext !='')
		var extval = $(ext).value;
	//alert(extval);

	var control = document.getElementById(""+combId+"");
	//alert(control.options.length);
	control.options.length = 0;
	control.options[0] = new Option(comboText);
	control.options[0].value = "";
//	alert(genArr.length);
//	alert(genArr[0][2]+"===>"+val);
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
		}else{

			if(genArr[i][2] == val)
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
		}
	}
}


/* To get relative Combo Temporarily*/
function getRelativeCombo1(id,selectedCat,combId,comboText,genArr,ext){
	//alert(id);
	var val = id;
	if(ext && ext !='')
		var extval = $(ext).value;
	var control	=$(""+combId+"");
	//alert(control.options.length);
	control.options.length = 0;
	control.options[0] = new Option(comboText);
	control.options[0].value = "";
//	alert(genArr.length);
//	alert(genArr[0][2]+"===>"+val);
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
		}else{
			if(genArr[i][2] == val)
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
		}
	}
}

function openimage(id){
  var productid = id;

  window.open (SITE_URL_DUM+'upload/product/images/'+id+'/4_xmltoImg.jpg','mywindow','left=300,top=100,width=350,scrollbars=no,height=350,toolbar=no,resizable=0');

}

/* Delete image From */
function imagedelete(frm,type,id)
{
	//alert(type);
	if(type == 'swf'){
		$('#view').val("SWFDelete");
	}else{
		$('view').val("Delete");
	}
	$('#delImgtype').val(type);

	if(id != ''){
		$('#delImgId').val(id);
	}
	if(type == 'swf'){
		var ans = confirm("Confirm Deletion of SWF ?");
	}else{
		var ans = confirm("Confirm Deletion of Image ?");
	}

	if(ans == true)
		frm.submit();
	else
		return false;
}

function chkZip(events) {
	var codes=events.charCode? events.charCode :events.keyCode;
	if (codes!=8 && codes!=9) {
	        if( (codes>47 && codes<58) || (codes>64 && codes<91) || (codes>96 && codes<122) )
	            return true;
			else
				return false;
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

//check only digit
function chkStateCode(events)
{
	var unicodes=events.charCode? events.charCode :events.keyCode;
	if (unicodes!=8)
	{ //backspace
	        if( (unicodes>64 && unicodes<91 || unicodes == 9))
	            return true;
			else{
				if(events.charCode == 0)
					return true;
				else
					return false;
			}
	}
}

function removeHTMLTags(str){
	strInputCode = str.replace(/&(lt|gt);/g, function (strMatch, p1){
	 	return (p1 == "lt")? "<" : ">";
	});
	var strTagStrippedText = strInputCode.replace(/<\/?[^>]+(>|$)/g, "");
	var repStr = strTagStrippedText.replace(/^[\s(&nbsp;)]+/g,'').replace(/[\s(&nbsp;)]+$/g,'');
	return repStr;
}

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