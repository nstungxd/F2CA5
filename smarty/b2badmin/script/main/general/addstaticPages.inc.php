<?php  
/**
 * Add/Update File For Static Pages
 *
 * @package		addstaticPages.inc.php
*/

if(!isset($stPageObj)) {
    include_once(SITE_CLASS_APPLICATION."class.StaticPage.php");
    $stPageObj =	new StaticPage();
}
$gdbobj->getRequestVars();

$view  = GetVar("view");
$iSPageId = GetVar("iSPageId");
$actionfile  = GetVar("file");
$arr = Array();

if(count($_POST) > 0) {
          $arr[0] = $_POST;
} else {
     if($view == 'edit'){
          $arr = $stPageObj->getStaticPageDetail("*","AND iSPageId = '$iSPageId'");
          //prints($arr);exit;
     } else {
          $view = "add";
     }
}

$arr[0]['vFile'] = (isset($arr[0]['vFile']))? $arr[0]['vFile'] : '';
 include_once (CK_EDITOR_PATH.'ckeditor.php');
 include_once (CK_EDITOR_PATH.'ckfinder/ckfinder.php');

 $ckeditor = new CKEditor();
 $ckeditor->basePath = CK_EDITOR_URL;
 $ckfinder = new CKFinder();
 $ckfinder->BasePath = SITE_FOLDER.'components/ckeditor/ckfinder/'; // Note: BasePath property in CKFinder class starts with capital letter
 $ckfinderpath = SITE_FOLDER.'components/ckeditor/ckfinder/';
 //echo $ckfinder->BasePath;exit;
 $ckfinder->SetupCKEditorObject($ckeditor);

$lang= $gdbobj->getLanguage();
?>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $actionfile?>&view=action" method="post" enctype="multipart/form-data">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iSPageId","iSPageId",$iSPageId,"Hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
<tr>
	<td width="49%" valign="top"><span class="reqmsg" style="float:right;"><?php  if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') { echo "Static page name is already exists"; }} ?></span>
		<table width="100%" border="0"  cellspacing="0" cellpadding="0"  class="td-bg-border-staticpage">
		<tr>
			<td class="heading">Static Pages Information</td>
		</tr>
		<tr>
			<td valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="25%" height="22" align="right" class="td-bg" ><?php  if($view == 'add'){?><font class="reqmsg">*</font>&nbsp;<?php  }?>Static page name</td>
					<td width="25%" class="white-bg"  >
						<?php  if($view == 'add') echo $generalobj->PrintElement("Data[vFile]","vFile","".$arr[0]['vFile']."","text",""," class='required' style=width:210px tabIndex=1");else echo "<b>".(isset($arr[0]['vFile']))?$arr[0]['vFile']:""."</b>";?>
					</td>
					<td width="25%" class="white-bg">&nbsp;</td>
					<td width="25%" class="white-bg">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<table width="70%" align="center" border="0" cellpadding="0" cellspacing="0">
                                   <?php  for($i=0;$i<count($lang);$i++){
                                   $tContent= "'tContent_".$lang[0]['vLanguageCode']."',";
                                   ?>
                                   <tr>
								<td height="22" colspan="4" align="left" class="td-bg-border" >
									<strong>Set Label Value [<?php  echo  $lang[$i]['vLanguage']?>]</strong>
								</td>
							</tr>
                                   <?php  if($i % 2 == 0) {?>
                                   <tr>
                                   <?php   }?>
                                        <div width="100%">
                                        <!--<td width="30%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Set Label Value</td>-->
                                        <td align="center" colspan="4"><div id="msg_<?php  echo  $lang[$i]['vLanguageCode']?>" class="error"></div>
                                             <?php  //echo $generalobj->PrintTextArea("Data[tContent_".$lang[$i]['vLanguageCode']."]","tContent_".$lang[$i]['vLanguageCode']."",$arr[0]['tContent_'.$lang[$i]['vLanguageCode']],"onBlur=translateText(); class='required' tabIndex=3 cols=50 rows=7","Enter Content in ".$lang[$i]['vLanguage']." ");?>
                                             <textarea name="Data[tContent_<?php  echo  $lang[$i]['vLanguageCode']?>]" id="tContent_<?php  echo  $lang[$i]['vLanguageCode']?>" class="required" tabIndex="2" rows="7" cols="50" title="Enter Content in <?php  echo  $lang[$i]['vLanguage']?>"><?php  echo  isset($arr[0]['tContent_'.$lang[$i]['vLanguageCode']])?stripslashes($arr[0]['tContent_'.$lang[$i]['vLanguageCode']]):"";?></textarea>
                                        </td>
                                        </div>
                                   <?php  if($i % 2 == 1) {?>
                                   </tr>
                                   <?php   }?>
                                   <?php   }?>
<!--							<tr>
								<td  align="center" colspan="4" width="100%" >
									<div id="msgContent" class="error"></div>
                           <textarea name="Data[tContent]" id="tContent" class="required" rows="7" cols="50"><?php  //=$arr[0]['tContent']?></textarea>
									<?php  
                              //$ckeditor->editor('Data[tContent]',$arr[0]['tContent'],'tContent');
                              //echo $generalobj->PrintTextArea("Data[tContent]","tContent",$arr[0]['tContent'],"rows='18' style='width:850px' class='ckeditor'  tabindex='2'");
                           ?>
								</td>
							</tr>
-->
							<tr>
								<td colspan="4">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>

				</table>
			</td>

		</tr>
		</table>
	</td>
</tr>
<tr>
	<td valign="top">&nbsp;</td>
</tr>
<tr>
	<td valign="top" align="center">
		<input type="Image" id="btnOk" style="cursor:pointer" name="btnSave" alt="btnSave" title="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabindex="3" >
		<img alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="resetform();return false;" tabindex="4">
		<img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=ge-staticPages&view=index&AX=Yes');" tabindex="5" onblur="$('#vFile').focus();">
	</td>
</tr>
</table>
</form>

<script type="text/javascript">//<![CDATA[
window.CKEDITOR_BASEPATH='<?php  echo  CK_EDITOR_URL?>';
//]]></script>
<script type="text/javascript" src="<?php  echo  CK_EDITOR_URL?>ckeditor.js?t=A1QD"></script>
<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript">
function resetform() {
	$('#frmadd')[0].reset();
}



$(document).ready(function(){
     <?php  for($i=0;$i<count($lang);$i++){?>
   CKEDITOR.replace( 'Data[<?php  echo  'tContent_'.$lang[$i]['vLanguageCode']?>]', { "filebrowserBrowseUrl": "<?php  echo  $ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?php  echo  $ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?php  echo  $ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?php  echo  $ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?php  echo  $ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?php  echo  $ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash",toolbar : 'MyToolBar'
 });

     <?php   }?>
});


$("#btnOk").hover(function(){
     <?php  for($i=0;$i<count($lang);$i++){?>
	     CKEDITOR.instances.tContent_<?php echo $lang[$i]['vLanguageCode'];?>.updateElement();
        var text = CKEDITOR.instances.tContent<?php echo "_".$lang[$i]['vLanguageCode'];?>.getData();
     <?php   }?>
});

$('#frmadd').validate({
   rules: {
		"Data[vFile]": {
			remote: {
				url:ADMIN_URL+"index.php?file=aj-chkdupdata",
				type:"get",
				data: {
					val:function() {
						return $("#iSPageId").val();
					},
					id:function() {
						return "iSPageId";
					},
					field:function() {
						return "vFile";
					},
					table:function() {
						return "<?php  echo  PRJ_DB_PREFIX?>_static_pages";
					}
				}
			}
		}
	},
	messages: {
		"Data[vFile]": {
			required: 'Enter Static page name',
			remote: jQuery.validator.format("This page name is already taken, please enter a different page name.")
		}
	}
});
</script>