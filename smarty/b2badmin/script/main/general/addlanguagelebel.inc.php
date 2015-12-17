<?php
/**
 * Add/Update File For Language Label
 *
 * @package		addlanguagelebel.inc.php
 * @section		main/general
 * @author		Snehasis Mohapatra
*/

if(!isset($langLabObj)) {
    include_once(SITE_CLASS_APPLICATION."class.LanguageLable.php");
    $langLabObj =	new LanguageLable();
}
$gdbobj->getRequestVars();

$view  = GetVar("view");
$iLabelId = GetVar("iLabelId");
$actionfile  = GetVar("file");
$arr = Array();

if(count($_POST) > 0) {
          $arr[0] = $_POST;
} else {
     if($view == 'edit') {
          $arr = $langLabObj->getLangLableDetail("*","AND iLabelId = '$iLabelId'");
          //prints($arr);exit;
     } else {
          $view = "add";
     }
}
$arr[0]['eStatus'] = (isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : '';
$arr[0]['vName'] = (isset($arr[0]['vName']))? $arr[0]['vName'] : '';
$arr[0]['vValue_en'] = (isset($arr[0]['vValue_en']))? $arr[0]['vValue_en'] : '';
$arr[0]['vValue_fr'] = (isset($arr[0]['vValue_fr']))? $arr[0]['vValue_fr'] : '';

$lang= $gdbobj->getLanguage();
?>
<?php /*
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("language", "1");

    var ScriptLoaded=false;
    function initialize() {
      ScriptLoaded=true;
    }
    google.setOnLoadCallback(initialize);
    function translateText() {
	   if(ScriptLoaded) {
	     text_trans  = document.getElementById('vValue_<?php  echo  $lang[0]['vLanguageCode']?>').value;
	     <?php   for($j=1;$j<count($lang);$j++) {?>
	     var lang = '<?php  echo  $lang[$j]['vLanguageCode']?>';
		  google.language.translate(text_trans, "<?php  echo  $lang[0]['vLanguageCode']?>", lang, function(result) {
          if (!result.error) {
            var container = document.getElementById("vValue_<?php  echo  $lang[$j]['vLanguageCode']?>");
            container.value = result.translation;
          }
        });
        <?php   }?>
      }
    }
</script> */ ?>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $actionfile?>&view=action" method="post" enctype="multipart/form-data">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iLabelId","iLabelId",$iLabelId,"Hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="49%" valign="top"><span class="reqmsg" style="float:right;"><?php   if(isset($arr[0]['var_msg'])){if($arr[0]['var_msg'] != '') { echo "Lable is already exists"; }} ?></span>
		<table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
		<tr>
			<td class="heading">Language Label Information</td>
		</tr>
		<tr>
			<td valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Label Name</td>
					<td width="25%" class="white-bg" valign="top">
						<?php  echo $generalobj->PrintElement("Data[vName]","vName",$arr[0]['vName'],'text','Enter Label Name',"class='required' tabIndex=1");?>
						<div class="aj-loading" style="position:absolute; text-align:center; margin-left:310px; display:none;"><img src="images/ajax_load.gif" /></div>
					</td>
					<td height="22" align="right" class="td-bg">Status</td>
					<td class="white-bg">
						<?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_lang_lable", "eStatus", "Data[eStatus]", "eStatus", "", "".$arr[0]['eStatus']."","tabIndex=2")?>
					</td>
				</tr>
				<?php  for($i=0;$i<count($lang);$i++) {
				$vValue= "'vValue_".$lang[0]['vLanguageCode']."',";
				?>
				<?php  if($i % 2 == 0) {?>
				<tr>
				<?php   }?>
					<td width="25%" height="22" align="right" class="td-bg" valign="top"><?php  if($i == 0){?><font class="reqmsg">*</font>&nbsp;<?php  }?>Set Label Value <b>[<?php  echo  $lang[$i]['vLanguage']?>]</b></td>
					<td width="25%" class="white-bg">
						<?php  echo $generalobj->PrintTextArea("Data[vValue_".$lang[$i]['vLanguageCode']."]","vValue_".$lang[$i]['vLanguageCode']."",$arr[0]['vValue_'.$lang[$i]['vLanguageCode']],"onBlur='//translateText();' tabIndex=3 cols=35 rows=5","Enter Label value in ".$lang[$i]['vLanguage']." ");?>
					</td>
				<?php  if($i % 2 == 1) {?>
				</tr>
				<?php   }?>
				<?php   }?>
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
		<img style="cursor:pointer" alt="btnSave"  id="btnSave" name="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex="5" onclick="return frmsubmit();" />
		<input type="image" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="resetform();" tabIndex="6" />
		<img style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=<?php  echo  $actionfile?>&view=index&AX=Yes');" tabIndex=7 onblur="$('#vName').focus();" />
	</td>
</tr>
</table>
</form>
<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript">
$('#frmadd').validate( {
         rules: {
          "Data[vName]": {
               remote: {
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data: {
                         val:function() {
               return $("#iLabelId").val();
               },
               id:function() {
               return "iLabelId";
               },
               field:function() {
               return "vName";
               },
               table:function() {
               return "<?php  echo  PRJ_DB_PREFIX?>_lang_lable";
               }
          }
     }
},
          "Data[vValue_<?php  echo  $lang[0]['vLanguageCode']?>]": {
               required: true
               }
},
     messages: {
          "Data[vName]": {
               required: 'Enter Lable Name',
			remote: jQuery.validator.format("This name is already taken, please enter a different name.")
               },
               "Data[vValue_<?php  echo  $lang[0]['vLanguageCode']?>]": {
               required: "Enter Label value in <?php  echo  $lang[0]['vLanguage']?>"
               }
     }
});

/*new Validator({
        formId: 'frmadd',
	  	  btnId:'btnSave',
        isRequired: ['vName',<?php  echo  substr($vValue,0,-1);?>],
		  isDuplicate:['vName','vName','<?php  echo  PRJ_DB_PREFIX?>_lang_lable','iLabelId']
	});*/
function frmsubmit() {
	 var frmvld = $('#frmadd').valid();
	 if(! frmvld) {
      return false;
   }
   $('#frmadd').submit();
}
function resetform() {
	$('#frmadd')[0].reset();
}
$(document).ready(function() {
	$('#vValue_en').bind('blur',function() {
		var src = 'en';
		var des = $('[id^="vValue"]').not('#vValue_en');
		var dest = '';
		if(des.length > 0) {
			var dcode = ''
			$.each(des,function(i,el) {
				if($.trim($('#vValue_en').val()) == '') { $(this).val(''); }
				dcode = (typeof $(this)!='undefined' && $(this)!=null && typeof $(this).attr('id')!='undefined' && $(this).attr('id')!=null)? $(this).attr('id').replace('vValue_','') : '';
				if(dcode != '') {
					dest += (dest == '')? dcode : ','+ dcode;
				}
			});
		}
		if($.trim($('#vValue_en').val()) != '') {
			var url = ADMIN_URL+"index.php?file=aj-trans",
			pars = {'text':$('#vValue_en').val(), 'src':'en', 'dest':dest};
			$('.aj-loading').show();
			$.ajax({type:"post", url:url, data:pars, success:function(data) {
				var dtls = $.parseJSON(data);
				// console.log(dtls);
				$.each(dtls,function(k,v) {
					$('#vValue_'+k).val(v);
				});
				// for(var l in dtls) { alert(l); }
				$('.aj-loading').hide();
			} });
		}
	});
});
</script>