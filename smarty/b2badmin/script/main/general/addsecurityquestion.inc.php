<?php
/**
 * Add/Update File For Security Question
 * @package		addsecurityquestion.inc.php
 * @Section		general
 */

if(!isset($secQueObj)) {
     include_once(SITE_CLASS_APPLICATION."class.SecQuestion.php");
     $secQueObj =	new SecQuestion();
}
$gdbobj->getRequestVars();

$view  = GetVar("view");
$iQuestionId = GetVar("iQuestionId");
$actionfile  = GetVar("file");
$arr = array();
if(count($_POST) > 0) {
     $arr[0] = $_POST;
} else {
     if($view == 'edit') {
          $arr = $secQueObj->select($iQuestionId);
          //prints($arr);//exit;
     } else {
          $view = "add";
     }
}
$lang= $gdbobj->getLanguage();
?>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $actionfile?>&view=action" method="post" enctype="multipart/form-data">
     <?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
     <?php  echo $generalobj->PrintElement("iQuestionId","iQuestionId",$iQuestionId,"Hidden");?>
     <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
               <td width="100%" valign="top"><span class="reqmsg" style="float:right;"><?php  if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') {
                              echo "Question is already exists";
                         } } ?></span>
                    <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
                         <tr>
                              <td class="heading">Question Information</td>
                         </tr>
                         <tr>
                              <td valign="top" colspan="2">
                                   <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                        <?php  for($i=0;$i<count($lang);$i++) {
                                             $vValue= "'vValue_".$lang[0]['vLanguageCode']."',";
                                             ?>
                                             <?php  if($i % 2 == 0) {?>
                                        <tr>
                                                       <?php   }?>
                                             <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Question <b>[<?php  echo  $lang[$i]['vLanguage']?>]</b></td>
                                             <td width="25%" class="white-bg">
                                             <?php $arvq = (isset($arr[0]['vQuestion_'.$lang[$i]['vLanguageCode']]))? $arr[0]['vQuestion_'.$lang[$i]['vLanguageCode']] : '' ?>
                                             <?php  echo $generalobj->PrintElement("Data[vQuestion_".$lang[$i]['vLanguageCode']."]","vQuestion_".$lang[$i]['vLanguageCode']."",$arvq,'text',"Enter Question in ".$lang[$i]['vLanguage']." "," class='input1 required' ");?>
                                             </td>
                                                  <?php  if($i % 2 == 1) {?>
                                        </tr>
                                                  <?php   }?>
                                             <?php   }?>
                                        <tr>
                                             <td width="50%" height="22" align="right" class="td-bg">&nbsp;Status</td>
                                             <td width="50%" class="white-bg">
                                             <?php $ares = (isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : '' ?>
                                             <?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_sec_question", "eStatus", "Data[eStatus]", "eStatus", "", $ares,"class='input1'")?>
                                             </td>
                                             <td class="td-bg" colspan="2"></td>
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
               <td valign="top" align="center" colspan="2">
                    <input type="image" style="cursor:pointer"  alt="Save" title="Save" id="btnSave" name="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex="4">
                    <input type="image" alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="reset();return false;" tabIndex="5">
                    <img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=<?php  echo  $actionfile?>&view=index&AX=Yes');" tabIndex="6" onblur="$('#vCountry').focus();">
               </td>
          </tr>
     </table>
</form>

<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript">
     $('#frmadd').validate( {

          rules: {

               "Data[vQuestion_<?php  echo  $lang[0]['vLanguageCode']?>]": {
                    required: true
               }
          },
          messages: {
               "Data[vQuestion_<?php  echo  $lang[0]['vLanguageCode']?>]": {
                    required: "Enter Question  in <?php  echo  $lang[0]['vLanguage']?>"
               }

          }
     });
</script>