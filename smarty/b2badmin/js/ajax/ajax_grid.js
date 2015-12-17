/**
 * Ajax Listing General Class
 * @version 1.0
 * 26th March 2008
 */

//decode field arr
setDecodefieldArrField();
//decode table arr
setDecodeTableArrField();
//get primary id
var up_de_id = Field_arr[0][0].toString().toLowerCase().split(".");
up_de_id = up_de_id[1];
//Declaring the class
//to store the search criterias for appending in edit links-hardik
var editArgu="";

//defining the rest of the class implementation
var AjaxListing = Class.create({
  	//initialize settings for validation
	init: function(options)
	{
		if($("#showLoading"))
		$("#showLoading").show();
		this.options = options;

		//set options
		this.eStatus = this.options["eStatus"];

		if(this.eStatus != 'Alpha'){
			if(this.eStatus == 'Num'){
				var alphatextbox = '<input type="text" class="input-new" id="keyword" name="keyword"/>';
				$('#keywordtextbox').html(alphatextbox);
				$('#sOption').val($('#alphafield').val());
				this.chId  = this.options["chId"];
				changeAlphaClass(this.chId);
			}
			this.alpha = "";
		}else{
			var alphatextbox = '<input type="text" class="input-new" id="keyword" name="keyword"/>';
			$('#keywordtextbox').html(alphatextbox);
			$('#sOption').val($('alphafield').val());
			this.alpha = this.options["alpha"];
			this.chId  = this.options["chId"];
			changeAlphaClass(this.chId);
			$('#keyword').val(this.alpha);
		}

		this.sorton = this.options["sorton"];
		//this.stat = this.options["stat"];

		if(this.options["stat"] != undefined){
			this.stat = this.options["stat"];
		}else{
			this.stat = $('#sort_odr').val();
		}
		if(this.eStatus == 'Sort'){
			$('#sorton_param').val(this.sorton);
			$('#stat_param').val(this.stat);
		}else{
			if($('#sorton_param').val() != ''){
				this.sorton = $('#sorton_param').val();
			}
			if($('#stat_param').val() != ''){
				this.stat = $('#stat_param').val();
			}
		}
		if(this.stat == undefined)
			this.stat="1";

		this.start = this.options["st"];
		this.file = getURLVar('file').split("-")[1];
		this.recLimit = $('#vRecLimit').val();
		this.sOption = $('#sOption').val();
		this.keyword = $('#keyword').val();
		if(this.sOption == 'log.dLoginDate' || this.sOption ==  'log.dLogoutDate' )
		{
			this.keyword1 = $('#keyword1').val();
			if(this.keyword1 < this.keyword) {
				alert("From Date must be less then To Date");
				return false;
			}
		}

		//ends here
		//make arguements
		this.Argus = this.defineArgus();
      if(this.Argus == false)
      {
         return false;
      }
      //alert(this.Argus);
		//send ajax request with url
		this.sendAjaxRequest();
	},
	//For making arguesments according to status wise
	defineArgus :function ()
	{
		if(this.eStatus == 'ShowAll' || this.eStatus == ''){
			if($("#showLoading"))
				$("#showLoading").hide();
		}

      if(this.eStatus != '' && this.eStatus != 'ShowAll' && this.eStatus != 'Search' && this.eStatus != 'Sort' && this.eStatus != 'Alpha' && this.eStatus != 'Num')
      {
			checkedArr = getSelectedArr(this.eStatus,this.file);
         //alert(checkedArr);
			if(checkedArr == '')
         {
				if($("#showLoading"))
				$("#showLoading").hide();
				return false;
			}
		}

		this.extraArgu = '';
		if(this.eStatus == 'Alpha'){
			if(this.keyword !='')
				this.extraArgu += "&keyword="+this.keyword;
		}

		if(this.eStatus == 'Num'){
				this.extraArgu += "&keyword=0-9";
		}
		if(this.eStatus == 'Search'){
			if(this.keyword !='')
			{
				if(this.keyword1 != '')
				{
					this.extraArgu +="&keyword1="+this.keyword1;
				}
				this.extraArgu += "&keyword="+this.keyword+"&option="+this.sOption;
			}
		}

        // Used 		:- iUserId
		// Search by 	:- iUserId
		if($('#'+'iUserId')){
			if($('#'+'iUserId').val() != '' && $('#'+'iUserId').val() !='undefined'){
                var iUserId = $('#'+'iUserId').val();
				this.extraArgu += "&iUserId="+iUserId;
			}
		}

		switch(this.eStatus)
		{
			case "Search":

				if(this.sorton == '')
				{
					var main = $('#innerlist');

					main.addClass('blink');
					$('#divrecmsg').html('<font class="clrecmsg">Processing, please wait.....</font>');
				}
				this.Argus = "&eStatus=Search&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&stat="+this.stat+"&tabfile="+this.file+this.extraArgu;
				if(this.file == 'cust' && $("#sOption").options[$("#sOption").selectedIndex].text == "WebLogin")
				this.Argus +="&WebLogin="+this.keyword;
				break;
			case "ShowAll":
				$('#keyword').val("");
				this.Argus = "&eStatus=ShowAll&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&stat="+this.stat+"&tabfile="+this.file;
				break;
			case "Sort":
			    this.Argus = "&eStatus=Sort&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&stat="+this.stat+"&tabfile="+this.file+this.extraArgu;
				break;
			case "Alpha":
			    this.Argus = "&eStatus=Alpha&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&stat="+this.stat+"&tabfile="+this.file+this.extraArgu;
				break;
			case "Num":
			    this.Argus = "&eStatus=Num&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&stat="+this.stat+"&tabfile="+this.file+this.extraArgu;
				break;
			case "Active":
				this.Argus = "&eStatus=Active&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&checkedArr="+checkedArr+"&stat="+this.stat+"&tabfile="+this.file;
				break;
			case "Inactive":
			    this.Argus = "&eStatus=Inactive&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&checkedArr="+checkedArr+"&stat="+this.stat+"&tabfile="+this.file;
				break;
			case "isDelete":
				this.Argus = "&eStatus=isDelete&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&checkedArr="+checkedArr+"&stat="+this.stat+"&tabfile="+this.file;
				break;
			case "Reject":
				this.Argus = "&eStatus=Reject&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&checkedArr="+checkedArr+"&stat="+this.stat+"&tabfile="+this.file;
				break;
                       case "Approve":
				this.Argus = "&eStatus=Approve&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&checkedArr="+checkedArr+"&stat="+this.stat+"&tabfile="+this.file;
				break;
			case "Block":
				this.Argus = "&eStatus=Block&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&checkedArr="+checkedArr+"&stat="+this.stat+"&tabfile="+this.file;
				break;
			case "Show":
				this.Argus = "&eStatus=Show&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&checkedArr="+checkedArr+"&stat="+this.stat+"&tabfile="+this.file;
				break;
			case "Delete":
			    this.Argus = "&eStatus=Delete&start="+this.start+"&rec_limit="+this.recLimit+"&sorton="+this.sorton+"&checkedArr="+checkedArr+"&stat="+this.stat+"&tabfile="+this.file;
				break;

		}
		return this.Argus ;
	},
	//send Ajax Request

	sendAjaxRequest:function()
	{
		var pars = this.Argus ;
		var url = ADMIN_URL+"index.php?file=aj-html_list";
		//store this parameters to append in edit links-hardik
	    if($('#editArguVar') && $('#editArguVar').val()){
		      pars=$('#editArguVar').val();
		      $('#editArguVar').val("");
	    }
    	editArgu=pars;
		//alert(url+pars);
		//return false;
		$.ajax({
			   type: "GET",
			   url: url,
			   data: pars,
			   success: this.showResponse
		 });
	},

	//Show Response
	showResponse :function (originalRequest){
		var xmlDocument = originalRequest;
		var no 			= xmlDocument.getElementsByTagName(up_de_id).length;
		//alert(no);
		var displayrec 	= xmlDocument.getElementsByTagName('displayrec').item(0).firstChild.data;

		var totrec 		= xmlDocument.getElementsByTagName('totrec').item(0).firstChild.data;

		var start 		= xmlDocument.getElementsByTagName('start').item(0).firstChild.data;

		var recmsg 		= xmlDocument.getElementsByTagName('recmsg').item(0).firstChild.data;
		//alert(recmsg);
		var statusmsg 	= xmlDocument.getElementsByTagName('statusmsg').item(0).firstChild.data;
		var var_limit 	= xmlDocument.getElementsByTagName('var_limit').item(0).firstChild.data;
		var sort_img 	= xmlDocument.getElementsByTagName('sort_img').item(0).firstChild.data;
		var sorton 		= xmlDocument.getElementsByTagName('sorton').item(0).firstChild.data;
		var stat 		= xmlDocument.getElementsByTagName('stat').item(0).firstChild.data;
	//	var sort 		= xmlDocument.getElementsByTagName('sort').item(0).firstChild.data;
		//alert(sort);

		var fileName = $('#vfileName').val();
		var updatelink = $('#updatelink').val();
		var addlink = $('#addlink').val();
		var addUrl = $('#addUrl').val();
		var sessadminId = $('#sessadminid').val();
		var arr = new Array();
		var chkstr= $('#arraychk').val();
		arr = chkstr.split(",");
		var chkallstr= $('#arraychkall').val();
		arrall = chkallstr.split(",");
		//alert(stat);
		if(stat == 0){
			var stat1= 1;
		}else{
			var stat1= 0;
		}
		//alert(navigator.appName);
		if(navigator.appName != 'Microsoft Internet Explorer')
		{
			var tlimit = var_limit.split(",");
			var tli = tlimit[0].split(" ");
			var tot = totrec - tli[2];
			//alert(tot);
			if(parseInt(tot) > 14)
				var cls = 'getwidths';
			else
				var cls = 'getwidthsw';
		}else{
			var cls = 'getwidth';
		}
		//alert(cls);
		var html;
		html = "";
		html += '<table width="100%" border="0" id="tlist" cellspacing="0" cellpadding="0">';
		html += '<tr>';
			html += '<td>';
				html += '<div class="'+cls+'" style="height:20px;" id="heading">';
					html += '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
					html += '<tr class="grey-gradient">';
					var allchk = "";
					if($('#checkbox'))
					{
						for(c = 0 ;c<arrall.length;c++)
						{

							if(start == arrall[c])
							{
								allchk = "checked";
							}
						}
					}
						if(getURLVar('file') != 'gen-staticPages' && getURLVar('file') != 'ge-admin')
						{
							html += '<td align="center"  class="border-right"><div ><input type="checkbox" name="checkbox" value="checkbox" '+allchk+' id="checkbox" onclick="return getCheckAll(this.checked,'+parseInt(displayrec)+','+start+');"/></div></td>';
						}
						else
						{
							html += '<td align="center"><span style="display:inline-block;width:19px;">&nbsp;</span></td>';
						}
						var cnt=0;
						//alert(stat);
						//alert(Field_arr[2][1]);
						for(x=0;x<Field_arr.length;x++)	// Display heading
						{
							if(getURLVar('file') == 'ge-admin' && Field_arr[x][0] == 'concat(adm.vFirstName," ",adm.vLastName)' && sorton == 0){
								if($('sort_odr')){
									if($('sort_odr').value == '0'){
										var imgs = '<img src="'+ADMIN_IMAGES+'desc_order.gif">';
									}else{
										var imgs = '<img src="'+ADMIN_IMAGES+'asc_order.gif">';
									}
								}
							}else if($('#sort_field').val() == Field_arr[x][0] && sorton == 0 ){
									if($('#sort_odr').val() == '0'){
										var imgs = '<img src="'+ADMIN_IMAGES+'desc_order.gif">';
									}else{
										var imgs = '<img src="'+ADMIN_IMAGES+'asc_order.gif">';
									}
							}else{
								var imgs = '';
							}
							if(Field_arr[x][3] != '0')
							{
								if(x == Field_arr.length-1)
									var trclass ='';
								else
									var trclass ='border-right';

								if(sorton ==  Field_arr[x][3]){

									html += '<div><td class="'+trclass+'" width="'+Field_arr[x][6]+'"><div align="'+Field_arr[x][5]+'" style="margin-bottom:7px;padding:0px 5px;"><a href="#" title="'+Field_arr[x][2]+'" class="whitelink-bold" onclick="new AjaxListing({eStatus: \'Sort\', sorton: '+Field_arr[x][3]+', st: '+start+' ,stat : '+stat1+'});return false;">'+Field_arr[x][2]+'</a><img src="'+sort_img+'" style="border:0;"></div></td></div>';
								}else
								{
									html += '<td  class="'+trclass+'" width="'+Field_arr[x][6]+'"><div align="'+Field_arr[x][5]+'" style="margin-bottom:7px;padding:0px 5px;"><a href="#" title="'+Field_arr[x][2]+'" class="whitelink-bold" onclick="new AjaxListing({eStatus: \'Sort\', sorton: '+Field_arr[x][3]+', st: '+start+' ,stat : '+stat1+'});return false;">'+Field_arr[x][2]+'</a>'+imgs+'</div></td>';
								}

						}
					}
					html += '</tr>';
					html += '</table>';
				html +='</div>';
			html += '</td>';

			if(navigator.appName != 'Microsoft Internet Explorer')
			{
			var tlimit = var_limit.split(",");
			var tli = tlimit[0].split(" ");
			var tot = totrec - tli[2];
			//alert(totrec+"--"+tlimit[1]+"--"+tot);
			if(totrec > 10 && tlimit[1] != 10 && tot < 14)
			{
				html += '<td width="1px;" class="grey-gradient"></td>';
			}
			else
			{
				if(parseInt(tot) >= 14 && tlimit[1] != 10)
				{
						html += '<td width="1px;" ></td>';
				}
				else
					html += '<td class="grey-gradient"></td>';

			}
		}

		html += '</tr>';

		html+='<tr>';
			html+='<td colspan="'+Field_arr.length+'" valign="top">';

			if(parseInt(displayrec) > 14)
				var sty = 'width:100%; height:300px; overflow:hidden;overflow-y:auto';
			html +='<div id="scrollbarlist" style="'+sty+'">';

			var checked_Arr = new Array()
			var sorttdclass = "";
				if(parseInt(displayrec)>0)
				{
						html+='<table width="100%" border="0" id="innerlist" class="table-bg" cellspacing="1" cellpadding="0">';
						for(j=0;j<parseInt(displayrec);j++)
						{
							//alert(up_de_id);
				if(up_de_id){
								xmlFieldId = up_de_id;
								xmlFieldId = xmlDocument.getElementsByTagName(xmlFieldId).item(j).firstChild.data;
							}

						  var subchk = "";

									for(c = 0 ;c<arr.length;c++)
									{
										if(xmlFieldId == arr[c])
										{
											subchk = "checked";
										}
									}

							html+='<tr onmouseover="this.style.backgroundColor=\'#F8F8F8\'" onmouseout="this.style.backgroundColor=\'#FFFFFF\'" bgcolor="#FFFFFF">';
							if(getURLVar('file') == 'ge-admin')
							{
								xmlFieldvll = xmlDocument.getElementsByTagName('eType').item(j).firstChild.data;
							}
							if(getURLVar('file') == 'ge-admin') // && (xmlFieldId == sessadminId || xmlFieldvll == 'Premier Admin' )
							{
								html+='<td style="width:5px" align="center" class="white-bglist"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>';
								//html+='<td style="width:5px" align="center" class="white-bglist">&nbsp;</td>';
							}
							else if(getURLVar('file') == 'gen-staticPages')
							{
								html+='';
							}
							else
							{
								html+='<td style="width:5px" align="center" class="white-bglist"><span><input type="checkbox" style="border:none" onclick="getChkboxArr(this.value ,this.checked)" id="ch'+xmlFieldId+'" '+subchk+' name="ch'+j+'" value="'+xmlFieldId+'"></span></td>';
							}

							for(x=0;x<Field_arr.length;x++)
							{
								if(Field_arr[x][3] != '0')
								{
									var xmlField = "";
									xmlField = Field_arr[x][1].toString().toLowerCase();

									xmlFieldValue = xmlDocument.getElementsByTagName(xmlField).item(j).firstChild.data;
									if(getURLVar('parent') != ''){
										var parentUrl = "&parent="+getURLVar('parent');
									}else{
										var parentUrl = '';
									}

									if(sorton ==  Field_arr[x][3] || ($('sort_field').value == Field_arr[x][0] && sorton == 0) || Field_arr[x][0] == 'concat(adm.vFirstName," ",adm.vLastName)' && sorton == 0){
										sorttdclass = "sortedcol";
									}else{
										sorttdclass = "";
									}
										if(Field_arr[x][8] != "0"){
                                    if(updatelink == 'Yes' && getURLVar('file') != 'ge-loginhistory' && getURLVar('file') != 'ge-whoisonline') {
										  		 if(getURLVar('file') == 'ge-user'){
										  		  html += '<td  width="'+Field_arr[x][6]+'"  class="'+sorttdclass+'" style="padding:0px 5px;"><div align="'+Field_arr[x][5]+'"><a href="index.php?file='+getURLVar('file')+'&view=edit&'+Field_arr[0][1]+'='+xmlFieldId+''+parentUrl+'" class="whitelink-normal">'+xmlFieldValue+'</a></div></td>';
										  		 }else{
										  		  html += '<td  width="'+Field_arr[x][6]+'"  class="'+sorttdclass+'" style="padding:0px 5px;"><div align="'+Field_arr[x][5]+'"><a href="index.php?file='+getURLVar('file')+'&view=edit&'+Field_arr[0][1]+'='+xmlFieldId+''+parentUrl+editArgu+'" class="whitelink-normal">'+xmlFieldValue+'</a></div></td>';
										  		 }
                                    } else {
                                       if(getURLVar('file') == 'ge-user'){
										  		  html += '<td  width="'+Field_arr[x][6]+'"  class="'+sorttdclass+'" style="padding:0px 5px;"><div align="'+Field_arr[x][5]+'">'+xmlFieldValue+'</div></td>';
										  		 }else{
										  		  html += '<td  width="'+Field_arr[x][6]+'"  class="'+sorttdclass+'" style="padding:0px 5px;"><div align="'+Field_arr[x][5]+'">'+xmlFieldValue+'</div></td>';
										  		 }
                                    }
										}else{
										  if(xmlFieldValue == 'isDelete'){
                                            html += '<td  width="'+Field_arr[x][6]+'" class="'+sorttdclass+'"style="padding:0px 5px;"><div align="'+Field_arr[x][5]+'" class="indent-left">Deleted</div></td>';
                                        }else{
										  	html += '<td  width="'+Field_arr[x][6]+'" class="'+sorttdclass+'"style="padding:0px 5px;"><div align="'+Field_arr[x][5]+'" class="indent-left">'+xmlFieldValue+'</div></td>';
											}
										}
								}

							}
						html+='</tr>';
						}
						html += '</table>';
					}
					else
					{
						html+='<table class="grey-norec-middle-bg" id="innerlist" width="100%" border="0" cellspacing="1" cellpadding="0">'
						html+='<tr>'
						html+='<td align="center" height="100">';
							html+='<table width="434" border="1" class="grey-border" align="center" cellpadding="0" cellspacing="0">';
							html+='<tr>';
								html+='<td valign="top">';
	                        		html+='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	                                html+='<tr>';
	                                	html+='<td width="25%" height="70" align="center"><img src="'+ADMIN_IMAGES+'exclamatory-icon.gif"  /></td>';
										html+='<td width="75%">';
											html+='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
												var norecmsg = "No "+fileName+" Found ! ";
	                                        html+='<tr>';
												html+='<td class="black-head" align="left">'+norecmsg+'</td>';
											html+='</tr>';
											html+='<tr>';
												html+='<td><hr size="1" /></td>';
											html+='</tr>';
										if(addUrl != ''){
											html+='<tr>';

												if(addlink == "Yes")
												{
													html+='<td valign="top" style="line-height:18px;" align="left">You can create a '+fileName+' now. Click the link below :<br /><a href="index.php?file='+addUrl+'&view=add" class="redlink-bold" align="left">Create a '+fileName+'</a></td>';
												}
											html+='</tr>';
											}
											html+='</table>';
										html+='</td>';
									html+='</tr>';
									html+='</table>';
								html+='</td>';
							html+='</tr>';
							html+='</table>';
						html+='</td>';
						html+='</tr>';
						html+='<table>';
						html += '</div>';
					}
					html += '</td>';
			html += '</tr>';
			html += '</table>';
			//alert(html);
			$('#listing').html(html);
			var d = $('#scrollbarlist');
			var r=d.height();
			var d1 = $('#tlist');
			var r1=d1.height();
			var heading = $('#heading');
			var ilist = $('#innerlist');

			var iheight=ilist.height();

			if(r > 300)
			{
				if(navigator.appName != 'Microsoft Internet Explorer')
				{
					heading.addClass('getwidths');
				}

				d.removeClass('height');
				d.addClass('divscrollbar');
			}
			if(r1 > r)
			{
				//alert($('listing'));
				if(navigator.appName != 'Microsoft Internet Explorer')
				{
					heading.removeClass('getwidths');
					heading.addClass('getwidth');
				}
				d.removeClass('divscrollbar');
				$('#listing').css({"height":r1+"px"});
			}

			if(r1 < r)
			{
				if(navigator.appName != 'Microsoft Internet Explorer')
				{
					heading.removeClass('getwidths');
					heading.addClass('getwidth');
				}
				d.removeClass('divscrollbar');
				$('#listing').css({ height:r1+'px' });
			}else
			{
				if(r1 > 300)
				{
					if(navigator.appName != 'Microsoft Internet Explorer')
					{
						heading.addClass('getwidths');
					}
					d.removeClass('height');

						var tlimit = var_limit.split(",");
						var tli = tlimit[0].split(" ");
						var tot = totrec - tli[2];
						if(tot <= 14)
						{
							if(navigator.appName != 'Microsoft Internet Explorer') {
								$('#listing').css({ height:r+20+'px' });
							}else {
								$('#listing').css({ height:'305px' });
							}
						}else{
              				$('#listing').css({ height:'315px' });
            			}
          			d.addClass('divscrollbar');
				}
				else
				{
					if(r == 300)
					{
						if($('vRecLimit').value == 10)
						{
							if(navigator.appName != 'Microsoft Internet Explorer')
							{
								heading.removeClass('getwidths');
								heading.addClass('getwidth');
							}
							d.removeClass('divscrollbar');
							d.addClass('height');
						}
					}
				}
			}
			if(r == 235)
			{
				d.removeClass('height');
				if(totrec != 10)
				{
					if($('vRecLimit').value != 10)
					{
						if(navigator.appName != 'Microsoft Internet Explorer')
							heading.addClass('getwidths');
						d.addClass('divscrollbar');
					}
				}
				else
				{
					if(navigator.appName != 'Microsoft Internet Explorer')
					{
						heading.removeClass('getwidths');
						heading.addClass('getwidth');
					}
					d.removeClass('divscrollbar');
					//d.addClassName('height');
				}
			}
			//alert(statusmsg);
			if(statusmsg != 'Search'){
				$('#msgrow').attr("style", "display:;");
				$('#msg').html('<ul id="top-tabstrips"><li><em>'+statusmsg+'</em></li></ul>');
				setTimeout("$('#msgrow').hide();",5000);
			}else{
				//$('#msgrow').hide();
			}

			tot_pages = Math.ceil(totrec/$('#vRecLimit').val()) ;
			$('#divtotpages').html(tot_pages);

			cPBox(tot_pages);
			//$('vgoto').value=start;
			$('#pgeno').html(start);
			//$('pgeno').value= parseInt($('pgeno').value);
			var main = $('#listing');
			main.removeClass('blink');
			$('#divrecmsg').html("<font class='clrecmsg'>"+recmsg+"</font>");
			$("#vStatus option:first").attr('selected','selected');
			if($("#showLoading"))
				$("#showLoading").hide();

	}
});

//decode field arr
function setDecodefieldArrField()
{
	for(i=0;i<Field_arr.length;i++)
	{
		for(j=0;j<Field_arr[i].length;j++)
		{
			Field_arr[i][j] = decode64(Field_arr[i][j]);
		}
	}
}
function Search()
{
	//alert();
}
//decode table Arr
function setDecodeTableArrField()
{
	for(i=0;i<TableArr.length;i++)
	{
		for(j=0;j<TableArr[i].length;j++)
		{
			TableArr[i][j] = decode64(TableArr[i][j]);
		}
	}
}
function changePage(typ)
{
   //alert(typ);
	if(typ == 'next')
	{
		if($('#divtotpages').html() != $('#pgeno').html() )
		{
			new AjaxListing({eStatus:'Search', sorton:'' ,st: parseInt($('#pgeno').html())+1});
         $('#pagenumber').val(parseInt($('#pgeno').html())+1);
			$('#pgeno').html(parseInt($('#pgeno').html())+1);
		}
	}
	else if (typ == 'last')
	{
		new AjaxListing({eStatus:'Search', sorton:'' ,st: parseInt($('#divtotpages').html())});
      $('#pagenumber').val(parseInt($('#divtotpages').html()));
		$('#pgeno').html(parseInt($('#divtotpages').html()));
	}
	else if(typ == 'prevlast')
	{
		new AjaxListing({eStatus:'Search', sorton:'' ,st: 1});
      $('#pagenumber').val(parseInt(1));
		$('#pgeno').html(1);
	}
	else if(typ == 'prev')
	{
		if($('#pgeno').html() != 1)
		{

         new AjaxListing({eStatus:'Search', sorton:'' ,st: parseInt($('#pgeno').html())-1});
         $('#pagenumber').val(parseInt($('#pgeno').html())-1);
			$('#pgeno').html(parseInt($('#pgeno').html())-1);
		}
	}
	else if(typ == 'goto')
	{
	   //alert()
      $('#pagenumber').val(parseInt($('#vgoto').val()));
		new AjaxListing({eStatus:'Search', sorton:'' ,st: parseInt($('#vgoto').val())});
		$('#vgoto').val(parseInt($('vgoto').value));
	}
	else if(typ == 'ongoto')
	{
	   $('#pagenumber').val(parseInt($('#pgeno').val()));
		new AjaxListing({eStatus:'Search', sorton:'' ,st: parseInt($('#pgeno').val())});
		$('#pgeno').val(parseInt($('#pgeno').val()));
	}
}

function cPBox(pages)
{
	var cHtml='';
	var pageNumber = $('#pagenumber').val();
	//alert(pages);
	if(pages != '0'){
	cHtml+="<select id='vgoto' name='vgoto' class='input' onchange='changePage(\"goto\");'>";
		for(i=1; i<=pages; i++){
			if(parseInt(pageNumber) == parseInt(i)){
				var selected = "selected";
			}else{
				var selected = "";
			}
			cHtml+="<option "+selected+" value='"+i+"'>"+i+"</option>";
		}
	cHtml+="</select>";
	}else{
		cHtml+="No Pages";
	}
	$('#pgBox').html(cHtml);
}