/**
 * This javascript  Class file is useful to List Images in Gallery By Display Order
 *
 * @package		ajax_gallery.js
 * @section		js/ajax
 * @author		Snehasis Mohapatra
 */
var Gallery = Class.create();
Gallery.prototype ={
		initialize:function(options)
		{
			this.options 	= options;
			this.type		=	this.options['type'];
			this.id			=	this.options['id'];
			if(this.options['setasmain'])
			this.setasMain	=	this.options['setasmain'];
			else
			this.setasMain = '';
			this.redirectType =	this.options['redirectType'];
			if(this.redirectType == 'delete'){
				this.fileName =	this.options['fileName'];
				this.parentId =	this.options['parentId'];
				this.tempId =	this.options['tempId'];
				this.parentfile =	this.options['parentfile'];
				this.primId =	this.options['primId'];
				this.imageid =	this.options['imageid'];
				this.deleteImg(this.fileName,this.parentId,this.tempId,this.parentfile,this.primId,this.imageid);
			}else
				this.getGallery();
		},
		getGallery:function()
		{
			var pars='';
			var setasMain = $F('setasMain');
			if(this.setasMain != ''){
				pars+= '&setasMain=Yes&mainId='+setasMain;
				$('new_disporder').value = '';
			}
			var orderArr  = $F('new_disporder');
			var url = ADMIN_URL+"index.php?file=aj-getGallery";
				pars+= '&type='+this.type+'&id='+this.id;

			if(orderArr != '')
				pars+= '&orderArr='+orderArr;
			//alert(url+pars);
			var myAjax = new Ajax.Request(
					url,
					{
						method: 'get', 
						parameters: pars, 
						onSuccess: this.DisplayGallery
					});
		},
		DisplayGallery:function(originalRequest)
		{
			if(originalRequest.responseText.indexOf('invalid') == -1){
				var xmlDocument = originalRequest.responseXML; 
				var no 			= xmlDocument.getElementsByTagName('imageid').length;
				var type 		= xmlDocument.getElementsByTagName('type').item(0).firstChild.data;
				var id 			= xmlDocument.getElementsByTagName('id').item(0).firstChild.data;
				var primid 		= xmlDocument.getElementsByTagName('primid').item(0).firstChild.data;
				var tempId 		= $('tempId').value;
				var filename 	= $('filename').value;
				var parentId 	= $('parentId').value;
				var parentfile 	= $('parentfile').value;
				var html;
				html = "";
					if(no > 0){
						for(i=0;i<no ;i++){
							var imageid 		= xmlDocument.getElementsByTagName('imageid').item(i).firstChild.data;
							var imgpath 		= xmlDocument.getElementsByTagName('imgpath').item(i).firstChild.data;
							var imgname 		= xmlDocument.getElementsByTagName('imgname').item(i).firstChild.data;
							var imgdisporder 	= xmlDocument.getElementsByTagName('imgdisporder').item(i).firstChild.data;
							var emain 			= xmlDocument.getElementsByTagName('emain').item(i).firstChild.data;
							var imgratio 		= xmlDocument.getElementsByTagName('imgratio').item(i).firstChild.data;	
							var imgstatus 		= xmlDocument.getElementsByTagName('imgstatus').item(i).firstChild.data;	
							
							var itemid = parseInt(i)+1;
							if(navigator.appName != 'Microsoft Internet Explorer')
								var st = '46';
							else
								var st = '30';
							html +='<div style="float:left;margin-left:'+st+'px;" id="item_'+imageid+'" class="lineitem">';
								html +='<table  border="0" cellpadding="0" cellpadding="0" align="center">';
								
								html +='<tr>';
									html +='<td align="center"><img src="'+imgpath+'"/></td>';
								html +='</tr>';
								html +='<tr>';
									html +='<td align="center"><div class="grey-matter" style="line-height:22px;">'+imgname+'</div></td>';
								html +='</tr>';
								html +='<tr>';
									html +='<td align="center"><a href="index.php?file='+filename+'&view=edit&'+parentId+'='+tempId+'&parent='+parentfile+'&'+primid+'='+imageid+'" class="whitelink-normal" tabIndex="40">Edit</a>&nbsp;&nbsp;<a href="#" onclick="new Gallery({fileName:\''+filename+'\',parentId:\''+parentId+'\',tempId:\''+tempId+'\',parentfile:\''+parentfile+'\',primId:\''+primid+'\',imageid:\''+imageid+'\',redirectType:\'delete\'});" class="whitelink-normal" tabIndex="40">Delete</a></td>';
								html +='</tr>';
								html +='<tr>';
									html +='<td align="center"><div class="grey-matter" style="line-height:22px;">Image Ratio:'+imgratio+'</div></td>';
								html +='</tr>';
								html +='<tr>';
									html +='<td align="center"><div class="grey-matter" style="line-height:12px;">Status : '+imgstatus+'</div></td>';
								html +='</tr>';	
								html +='</table>';
							html +='</div>';
						}
					}else{
						html +='<table width="100%" class="gallery-text" border="0" cellpadding="0" cellspacing="0" ><tr><td align="center">';
							html +='No Images Found';
						html +='</td></tr></table>';
					}
				$('gal_list').innerHTML = html;
				sections = ['gal_list'];
				Sortable.create('gal_list',{tag:'div', containment: sections,only:'lineitem',constraint:false,hoverclass:'over',
				onChange:function(element)
				{
					var orderArr	=	Sortable.serialize(element.parentNode);
					for(i=0;i<no;i++)
					{
						orderArr = orderArr.replace("gal_list[]=","");
						orderArr = orderArr.replace("&",",");
					}
					$('new_disporder').value = orderArr;
				},
				onUpdate:function(element){
						new Gallery({type :type,id : id});
					}
				});
			}
		},
		deleteImg:function(filename,parentId,tempId,parentfile,primid,imageid)
		{
			var ans;
			ans = confirm("Are you sure to Delete the Image ?");
			if(ans == true)
			{
				window.location ='index.php?file='+filename+'&view=action&'+parentId+'='+tempId+'&parent='+parentfile+'&'+primid+'='+imageid+'&mode=delete';
			}else{
				return false;
			}
		}
}
