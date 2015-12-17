<?php  
define( '_HFINXEC', 1);

$parts = dirname(__FILE__);
$parts_org =$parts;
$parts_orgArr = explode( "/", $parts_org);
$partsarr = strstr($parts, '/cpanel');
$DirFile = str_replace($partsarr,"",$parts);

//Set here Base Path
define('SPATH_BASE',$DirFile);
include_once("".SPATH_BASE."/cpanel/web.config.php");
$id = $_GET['id'];
?>
<html>
<head>
<title>Choose Contact</title>
</head>
<link href="<?php  echo  ADMIN_URL?>theme/gr_style.css" rel="stylesheet" type="text/css" />
<body>
<form id="frmadd" name="frmadd">
    <input type="hidden" id="iMemberId" name="iMemberId" value="">
    <input type="hidden" name="vEmailTo" id="vEmailTo" value="">
    <input type="hidden" name="eType" id="eType" value="Member">
	
	<input type="hidden" name="AdminId" id="AdminId" value="<?php  echo  $id?>">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center" style="background-color:#FFFBF7;" class="bmatter-bold">
        <tr>
            <td style="color:#000000;font-size:18px;font-weight:bold;"><B>Choose Members</B><td>
            <td><div id="showLoad" style="display:none"><img src="<?php  echo  ADMIN_URL?>images/loader.gif"></div><td> 
        </tr>
		<!--<tr valign="middle">
            <td colspan="3" >&nbsp;&nbsp;&nbsp;Select type:
                <select name="eType" id="eType" onChange="LoadContacts(this.value);" class="input1">				
				<option value="Member">Member</option>
				</select>
            </td>
        </tr>-->
		<tr valign="middle">
            <td colspan="3">
			<center>
            <?php   for($i=65;$i<=90;$i++)
			{
				if($i == 82)
				echo "<br>";
				echo  '<a href="javascript:void(0);" onclick="document.getElementById(\'keyword\').value=\'\';document.getElementById(\'alphasearch\').value=\''.chr($i).'\';LoadContacts(\''.chr($i).'\')" >'.chr($i).'</a>&nbsp;|&nbsp;';
			}?>
			</td>
        </tr>
		<tr valign="middle">
            <td colspan="3" style="padding-left:300px">
			    <a href="#" onClick="LoadContacts('showall');" style="CURSOR:POINTER"  title="Show all" >Show All </a>
			</td>
        </tr>

		<tr valign="middle">
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr valign="middle">
            <td colspan="3">
			    <input type="hidden" id="alphasearch" name="alphasearch" />
                <input  onfocus="SearchKey();" class="search-box" onKeyUp="LoadContacts(this.value);" autocomplete="off"  name="keyword" id="keyword" value="Search Contacts" size="52"/>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="bmatter-bold"><div id="divShow" class="scrollbar"></div>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-left:10px;">To</td>
        </tr>
        <tr valign="top">
            <td valign="top" colspan="3" style="padding-left:10px;"><textarea class="input1" name="vTo" id="vTo" rows="5" style="WIDTH:350px;" onKeyPress="return choosecontact(event);"></textarea><td> 
        </tr>
        <tr>
            <td align="right" colspan="3" height="30px;">
                <input type="image" src="<?php  echo  ADMIN_URL?>images/btn-done.gif" name="btnAddall" value="Done" onClick="refreshWin();">
				<input type="image" src="<?php  echo  ADMIN_URL?>images/btn-cancle.gif" value="Cancel" onClick="window.close();" >
                
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<SCRIPT type="text/javascript"> 
function SearchKey()
{
	document.getElementById("keyword").value='';
	document.getElementById("alphasearch").value='';
}
var SITE_URL_DUM = '<?php  echo  SITE_URL_DUM?>';

LoadContacts('');
function LoadContacts(val)
{
	var extra='';
	var typSearch='';
	document.getElementById("vTo").value = "";
	var etype =  document.getElementById("eType").value;
	var keywrd = document.getElementById("keyword").value;
	//alrt(keywrd);
	var id=top.opener.document.getElementById("iMToId").value;
	
	if(val!='')
		keywrd ="&typSearch="+val;
	if(document.getElementById("alphasearch").value != "")
	{
		extra+="&alphasearch="+document.getElementById("alphasearch").value;
	}
	//alert(val);
	//alert(document.getElementById("keyword").value);
	if(keywrd !='Search Contacts' ||  keywrd !=''){	
		extra+="&keyword="+document.getElementById("keyword").value;		
	}
	
	if(val =='showall' || val==''){
		var url = SITE_URL+"cpanel/index.php?file=aj-loadcontact&eType="+etype+""+typSearch+"&id="+id;
	}else{
		var url = SITE_URL+"cpanel/index.php?file=aj-loadcontact&eType="+etype+""+extra+typSearch+"&id="+id;
	}
	
	//alert(url);
	 //return false;
	if(id != ''||(keywrd !='Search Contacts' &&  keywrd !='') || val !='' || val =='' || val =='showall' || (val =='showall' && id != '')){
		document.getElementById("showLoad").style.display = '';		
		if (window.XMLHttpRequest)
		{
			http=new XMLHttpRequest()
			http.open("GET",url,true)
			http.onreadystatechange=showContacts
			http.send(null)
		}
		// code for IE
		else if (window.ActiveXObject)
		{
			http=new ActiveXObject("Microsoft.XMLHTTP")
			if (http)
			{
				http.open("GET",url,true)
				http.onreadystatechange=showContacts
				http.send()
			}
		}
	}else{
		document.getElementById("divShow").innerHTML = '';
	}
}

function showContacts()
{
	if (http.readyState == 4)
	{	
      	isWorking = false;
    	if (http.responseText.indexOf('invalid') == -1)
		{
    		var xmlDocument = http.responseXML; 
			//alert(http.responseText);
			var totrec = xmlDocument.getElementsByTagName('totrec').item(0).firstChild.data;
			var html='';
			html+='<table   border="0"  style=" border: 1px solid #555555;" cellpadding="0" bgcolor="#ffffff" cellspacing="0" width="100%">';
			strr = "";
			//alert(totrec);
			for(i=0;i<totrec;i++)
			{
				var memIdArr = top.opener.document.getElementById("iMToId").value;
				var vid = xmlDocument.getElementsByTagName('id').item(i).firstChild.data;
				var vname = xmlDocument.getElementsByTagName('name').item(i).firstChild.data;
				var vemail = xmlDocument.getElementsByTagName('email').item(i).firstChild.data;
				//emailStr = cleanBadCharacters(vname)+" <"+vemail+" >";
				emailStr = cleanBadCharacters(vname);
				strr+=cleanBadCharacters(vname)+"<"+vemail+">";
				strr+=',';
				html+='<tr>';
					html+='<td>';
					html+='<table border="0" width="100%" onclick="getSelect(\'div'+vid+'\',\''+emailStr+'\',\''+vid+'\');"  style="CURSOR:POINTER" onmouseover="this.style.backgroundColor=\'#EDEDED\'" onmouseout="this.style.backgroundColor=\'#ffffff\'">';
						if(in_array(memIdArr,vid) != 0){
							var clas = 'bmatter1';
							var str = '';
							var str1 = '';
							voldTo 		=	document.getElementById("vTo").value;
							toEmailId	=	document.getElementById("vEmailTo").value;		
							if(voldTo!=''){
								str+= voldTo;
								str+= ',';
							}
							str+= emailStr;
							if(toEmailId != ''){
								str1 += toEmailId;
								str1+= ',';
							}
							str1 += vid;
							
							document.getElementById("vTo").value = str;		
							document.getElementById("vEmailTo").value = str1;			
						}else{
							var clas = 'bmatter-contact';
						}
						html+='<tr>';						
							html+='<td class="'+clas+'" id="div'+vid+'">'+vname+'</td>';
						html+='</tr>';						
						html+='<tr>';
							html+='<td class="graylink" >'+vemail+'</td>';
						html+='</tr>';
						html+='</table>';
					html+='</td>';
				html+='</tr>';
				if(i!=(totrec-1))
				html+='<tr ><td><hr size="1"></hr></td></tr>';
			}
			html+='</table>';
			//alert(html);
			document.getElementById("divShow").innerHTML = html;
			document.getElementById("showLoad").style.display = "none";
		}
	}	
}
function cleanBadCharacters(outputstr)
{
	var txtPre = outputstr.replace(/[^a-zA-Z 0-9]+/g,'') 
	if (txtPre.length > 50)
	{
		resultStr = txtPre.substr(0,50) + "&nbsp;...";
	}
	else
	{
		resultStr = txtPre;
	}
	return resultStr;
}

function getSelect(id,val,memid)
{

	if(document.getElementById(id).className == 'bmatter-contact')
	{
		document.getElementById(id).className ="bmatter1";	
		var str = '';
		var str1 = '';		
		voldTo 		=	document.getElementById("vTo").value;
		toEmailId	=	document.getElementById("vEmailTo").value;
		
		if(voldTo!=''){
			str+= voldTo;
			str+= ',';
		}
		str+= val;
		if(toEmailId != ''){
			str1 += toEmailId;
			str1+= ',';
		}
		str1 += memid;
		
		document.getElementById("vTo").value = str;	
		document.getElementById("vEmailTo").value = str1;			
	}else{
		var sstrid = '';		
		document.getElementById(id).className ="bmatter-contact";
		vToval =document.getElementById("vTo").value;
		arr = vToval.split(",");	
		toEmailId	=	document.getElementById("vEmailTo").value;
		sstrid = toEmailId.split(",");		
		
		for(j=0; j<sstrid.length; j++)
		{
			
			if(sstrid[j] == memid){
				
				sstrid.splice(j,1);
				break;  
			}	
		}
		for(k=0; k<arr.length; k++)
		{
			if(arr[k] == val){
				arr.splice(k,1);
				break;  
			}	
		}
		top.opener.document.getElementById("iMToId").value = sstrid;
		document.getElementById("vEmailTo").value = sstrid;
		document.getElementById("vTo").value = arr; 
	}	
}
function refreshWin()
{
	var str = '';
	parTo  = top.opener.document.getElementById("vTo").value;
	top.opener.document.getElementById("iMToId").value;
	/*if(parTo !=''){
		//alert(parTo);			
		str+= parTo;
		str+= ',';			
	}*/
	str+= document.getElementById("vTo").value;
	
	var type = document.getElementById("eType").value;
	top.opener.document.getElementById("vTo").value= str;
	
	if(type == 'Member'){		
		/*if(top.opener.document.getElementById("iMToId").value != ''){
			top.opener.document.getElementById("iMToId").value+= ","+document.getElementById("vEmailTo").value;*/
		//}else{
			top.opener.document.getElementById("iMToId").value= document.getElementById("vEmailTo").value;
		//}
	}
	
	window.close();
}

function in_array(arr,compval){
	var loarr = arr.split(',');
	var nosofmatched = 0;
	for(k=0;k<parseInt(loarr.length);k++){		
		if(loarr[k] == compval){
			nosofmatched++;	
		}	
	}	
	return nosofmatched;
	
}
function choosecontact(events){
	var unicodes=events.charCode? events.charCode :events.keyCode;
	if(unicodes)
	{  
		return false; 
	}

}

</SCRIPT>