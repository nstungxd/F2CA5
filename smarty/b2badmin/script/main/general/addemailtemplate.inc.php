<?php  
/**
 * Add/Update File For Email Template
 *
 * @package		addemailtemplate.inc.php
 * @Section		general
 * @author		Jack Scott
*/
if(!isset($emailTempObj)) {
    include_once(SITE_CLASS_APPLICATION."class.EmailTemplate.php");
    $emailTempObj =	new EmailTemplate();
}
$gdbobj->getRequestVars();

$view  = GetVar("view");
$iFormatId = GetVar("iFormatId");
$actionfile  = GetVar("file");
$arr = Array();
$bdt = array();

if(count($_POST) > 0) {
          $arr[0] = $_POST;
} else {
     if($view == 'edit'){
          $arr = $emailTempObj->getDetails("*","AND iFormatId = '$iFormatId'");
          //prints($arr);exit;
          $bodytext = strip_tags(stripslashes($arr[0]['tBody_en']));
          //$bdt = array();
          $bt = preg_match_all('/\#(.*)\#/',$bodytext,$bdt);
          //prints($bdt);exit;
     } else {
          $view = "add";
     }
}

$arr[0]['eSection'] = (isset($arr[0]['eSection']))? $arr[0]['eSection'] : '';
$arr[0]['vType'] = (isset($arr[0]['vType']))? $arr[0]['vType'] : '';
$arr[0]['vSub_en'] = (isset($arr[0]['vSub_en']))? $arr[0]['vSub_en'] : '';
$arr[0]['vSub_fr'] = (isset($arr[0]['vSub_fr']))? $arr[0]['vSub_fr'] : '';
$bdt[0] = (isset($bdt[0]))? $bdt[0] : '';

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
<?php  echo $generalobj->PrintElement("iFormatId","iFormatId",$iFormatId,"Hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="49%" valign="top"><span class="reqmsg" style="float:right;"><?php  if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') { echo "Subject is already exists"; }} ?></span>
		<table width="100%" border="0" class="td-bg-border-staticpage" cellspacing="0" cellpadding="0">
		<tr>
			<td class="heading">Email Template Information</td>
		</tr>
		<tr>
			<td valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="25%" height="22" align="right" class="td-bg" >Section</td>
					<td width="25%" class="white-bg">
						<?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_email_template", "eSection", "Data[eSection]", "eSection", "", "".$arr[0]['eSection']."","tabindex=1")?>
					</td>
					<td align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Type</td>
					<td class="white-bg">
						<?php  echo $generalobj->PrintElement("Data[vType]","vType",$arr[0]['vType'],"text","Enter type of template"," class='required' style=width:220px tabIndex=3","Enter type of template");?>
					</td>
				</tr>
				<tr>
					<!--<td align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Subject</td>
					<td class="white-bg">
						<?php  //echo $generalobj->PrintElement("Data[vSub]","vSub",$arr[0]['vSub'],"text","Enter subject"," class='required' style=width:220px tabIndex=2");?>
					</td>-->
                                   <?php  for($i=0;$i<count($lang);$i++){?>
                                        <td align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Subject [<?php  echo  $lang[$i]['vLanguage']?>]</td>
                                   <?php  if($i % 2 == 0) {?>
                                   <?php   }?>
                                        <div>
                                        <td class="td-bg" valign="top">
                                             <input type="text" name="Data[vSub_<?php  echo  $lang[$i]['vLanguageCode']?>]" id="vSub_<?php  echo  $lang[$i]['vLanguageCode']?>" value="<?php  echo  $arr[0]['vSub_'.$lang[$i]['vLanguageCode'].'']?>" title="Enter subject in <?php  echo  $lang[$i]['vLanguage']?>" class="required" style="width:220px;" tabIndex="2">
                                        </td>
                                        </div>
                                   <?php  if($i % 2 == 1) {?>
                                   <?php   }?>
                                   <?php   }?>
				</tr>
                    <tr>
					<td align="right" class="td-bg" valign="top" style="padding:10px;">&nbsp;Variables Used</td>
					<td class="white-bg" colspan="3">
                                      <div style="border:1px solid #cecece; margin-top:5px; margin-bottom:5px; padding:5px; width:93%;">
                                       <?php   for($l=0;$l<count($bdt[0]);$l++) {
                                              $bdt[0][$l] = (isset($bdt[0][$l]))? $bdt[0][$l] : ''; 
                                       ?>
                                         <div style="width:150px;display:inline-block;padding:5px;"><b><?php  echo  $bdt[0][$l]?></b></div>
                                       <?php   } ?>
                                      </div>
                                   </td>
				</tr>

				<tr>
					<td valign="top">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<!--<table width="70%" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td height="22" colspan="4" align="left" class="td-bg-border" ><font class="reqmsg">*</font>&nbsp;<strong>Email template</strong></td>
							</tr>
							<tr>
								<td  align="center" colspan="4" >
									<textarea name="Data[tBody]" id="tBody" class="required" rows="7" cols="50"><?php  echo  stripslashes($arr[0]['tBody'])?></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="4">&nbsp;</td>
							</tr>
						</table>-->

                              <table width="70%" align="center" border="0" cellpadding="0" cellspacing="0">
                                   <?php  for($i=0;$i<count($lang);$i++){
                                   $tContent= "'tContent_".$lang[0]['vLanguageCode']."',";
                                   
                                   $arr[0]['tBody_'.$lang[$i]['vLanguageCode']] = (isset($arr[0]['tBody_'.$lang[$i]['vLanguageCode']]))? $arr[0]['tBody_'.$lang[$i]['vLanguageCode']] : '';
                                   ?>
                                   <tr>
								<td height="22" colspan="4" align="left" class="td-bg-border" >
									<strong>Email Template [<?php  echo  $lang[$i]['vLanguage']?>]</strong>
								</td>
							</tr>
                                   <?php  if($i % 2 == 0) {?>
                                   <tr>
                                   <?php   }?>
                                        <div width="100%">
                                        <td align="center" colspan="4"><div id="msg_<?php  echo  $lang[$i]['vLanguageCode']?>" class="error"></div>
                                             <textarea name="Data[tBody_<?php  echo  $lang[$i]['vLanguageCode']?>]" id="tBody_<?php  echo  $lang[$i]['vLanguageCode']?>" class="required" tabIndex="2" rows="7" cols="50" title="Enter Content in <?php  echo  $lang[$i]['vLanguage']?>"><?php  echo  stripslashes($arr[0]['tBody_'.$lang[$i]['vLanguageCode']]);?></textarea>
                                        </td>
                                        </div>
                                   <?php  if($i % 2 == 1) {?>
                                   </tr>
                                   <?php   }?>
                                   <?php   }?>
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
		<input type="Image" style="cursor:pointer" alt="Save" id="btnSave" name="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabindex="5">
		<img alt="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="resetform();return false;" tabindex="6">
		<img style="cursor:pointer" alt="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=ge-emailtemplate&view=index&AX=Yes');" tabindex="7" onblur="$('#eSection').focus();">
	</td>
</tr>
</table>
</form>
<script type="text/javascript">//<![CDATA[
window.CKEDITOR_BASEPATH='<?php  echo  CK_EDITOR_URL?>';
//]]></script>
<script type="text/javascript" src="<?php  echo  CK_EDITOR_URL?>ckeditor.js"></script>
<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript">
function resetform()
{
	$('#frmadd')[0].reset();
}

$(document).ready(function(){
     <?php  for($i=0;$i<count($lang);$i++){?>
   CKEDITOR.replace( 'Data[<?php  echo  'tBody_'.$lang[$i]['vLanguageCode']?>]', { "filebrowserBrowseUrl": "<?php  echo  $ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?php  echo  $ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?php  echo  $ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?php  echo  $ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?php  echo  $ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?php  echo  $ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash",toolbar : 'MyToolBar'
 });

     <?php   }?>
});
//$oFCKeditor->Config['EditorAreaCSS'] = '../my.css' ;
//$oFCKeditor->Config['ToolbarComboPreviewCSS'] = '../my.css' ;

$("#btnOk").hover(function(){
     <?php  for($i=0;$i<count($lang);$i++){?>
	     CKEDITOR.instances.tBody_<?php echo $lang[$i]['vLanguageCode'];?>.updateElement();
        var text = CKEDITOR.instances.tBody<?php echo "_".$lang[$i]['vLanguageCode'];?>.getData();
     <?php   }?>
});

$('#frmadd').validate( {
         rules: {
          "Data[vSub]": {
               remote: {
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data: {
                         val:function() {
               return $("#iFormatId").val();
               },
               id:function() {
               return "iFormatId";
               },
               field:function() {
               return "vSub";
               },
               table:function() {
               return "<?php  echo  PRJ_DB_PREFIX?>_email_template";
               }
          }
     }
}/*,
          editor: {
               required: true
               }*/
},
     messages: {
			"Data[tBody]": { required:"Enter content for email template" },
         "Data[vSub]": {
               required: 'Enter Subject',
			remote: jQuery.validator.format("This subject is already taken, please enter a different subject.")
               }/*,
          editor: {
               required: 'Enter Email Template'
               }*/
     }
});
</script>