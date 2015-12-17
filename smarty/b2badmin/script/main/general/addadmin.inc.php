<?php
/**
 * Add/Update File For Admin
 * @package		addadmin.inc.php
 * @Section		general
*/
if(!isset($adminUserObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.AdminUser.php');
     $adminUserObj = new AdminUser();
}
$gdbobj->getRequestVars();

if(!isset($countryObj)) {
    include_once(SITE_CLASS_APPLICATION."class.Country.php");
    $countryObj =	new Country();
}
if(!isset($stateObj)) {
    include_once(SITE_CLASS_APPLICATION."class.State.php");
    $stateObj =	new State();
}
if(!isset($cntstObj)) {
    include_once(SITE_CLASS_GEN."class.countrystate.php");
    $cntstObj =	new CountryState();
}

$view  = GetVar("view");
$iAdminId = GetVar("iAdminId");
$file  = GetVar("file");
$arr = Array();

if(count($_POST) > 0) {

          $arr[0] = $_POST;
} else {
   if($view == 'edit') {
      $arr = $adminUserObj->select($iAdminId);
      //prints($arr);exit;
		$vPhone = explode("-",$arr[0]['vPhone']);
      $vPhone1 = $vPhone[0];
      $vPhone2 = (isset($vPhone[1]))? $vPhone[1] : '';

      $phoneData=@explode("-",$arr[0]['vMobile']);
      if(count($phoneData)==1) {
         $arr[0]['vMobile']=$phoneData[0];
      } else {
         $arr[0]['vMobileCode']=$phoneData[0];
         $arr[0]['vMobile']=$phoneData[1];
      }
      //prints($arr);
   } else {
      $view = "add";
   }
}

$arr[0]['iQuestionId'] = (isset($arr[0]['iQuestionId']))? $arr[0]['iQuestionId'] : '';
$arr[0]['var_msg'] = (isset($arr[0]['var_msg']))? $arr[0]['var_msg'] : '';

/* Array For Creating Security Question Combo */
$seqCombArr = array(
			"ID"			=>	"iQuestionId",
			"Name" 		=>	"Data[iQuestionId]",
			"Type"			=>	"Query",
			"tableName"          =>	"".PRJ_DB_PREFIX."_seq_question",
			"fieldId" 		=>	"iQuestionId",
			"fieldName"		=>	"vQuestion",
			"extVal"		=>	'',
			"selectedVal" 	=>	$arr[0]['iQuestionId'],
			"width"  		=>	'216px',
			"height"  		=>	'',
			"onchange" 		=>	'',
			"selectText" 		=>	"---Select security question---",
			"where" 		=>	" eStatus = 'Active'",
			"multiple_select" 	=>	"",
			"orderby" 		=>	'vQuestion',
			"validationmsg"	=>	'Select security question.',
			"extra"		=>	"tabIndex=24"
     );
//Get State Array
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];

$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");
//prints($db_state);exit;
//end here
?>
<script language="JavaScript1.2" >
	stateArr = new Array(<?php  echo  $stateArr;?>);
</script>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $file?>&view=action" method="post">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iAdminId","iAdminId",$iAdminId,"Hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<?php  if($view == 'edit') { ?>
<tr>
   <td>
        <?php  include_once("addadmintop.inc.php")?>
   </td>
</tr>
<?php   } ?>
<tr>
   <td  valign="top"><span class="reqmsg" style="float:right;"><?php   if($arr[0]['var_msg'] != '') { echo "User is already exists"; } ?></span>
      <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
         <tr>
              <td class="heading">Personal Information</td>
         </tr>
         <tr>
            <td valign="top">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <?php  if($view == 'edit') { ?>
                  <tr>
                    <td height="22" class="td-bg" align="right" width="25%" valign="top">User Name</td>
						  <td class="white-bg"  width="25%" valign="top"><strong><?php  echo  $arr[0]['vUsername']?></strong></td>
						  <td width="25%" height="22" align="right" class="td-bg">&nbsp;</td>
						  <td width="25%" class="white-bg" >&nbsp;</td>
                  </tr>
                  <?php } ?>
                  <!--<tr>
                     <td  width="25%" height="22"  align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;<label for="type">Type:</label></td>
			<td width="25%" class="white-bg" >
                        <?php  //=$gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_administrator", "eType","Data[eType]", "type","", "".$arr[0]['eType']."","style='width:216px' tabIndex=1; class='required' ","Select Admin Type","---Select Admin Type----");?>
 			</td>
			<td width="25%" height="22" align="right" class="td-bg">&nbsp;</td>
			<td width="25%" class="white-bg" >&nbsp;</td>
                  </tr>-->
                  <tr>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;First name</td>
			<td width="25%" class="white-bg">
                        <?php  echo $generalobj->PrintElement("Data[vFirstName]","vFirstName",(isset($arr[0]['vFirstName']))? $arr[0]['vFirstName'] : '',"text","Enter first name"," onkeypress='return chkValidChar(event);' class='required' style=width:210px tabIndex=2; Maxlength=20;","Enter first name");?>
			</td>
			<td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Last name</td>
			<td width="25%" class="white-bg">
                        <?php  echo $generalobj->PrintElement("Data[vLastName]","vLastName",(isset($arr[0]['vLastName']))? $arr[0]['vLastName'] : '',"text","Enter last name"," onkeypress='return chkValidChar(event);' class='required' style=width:210px tabIndex=3  Maxlength=20;","Enter last name");?>
			</td>
                  </tr>
                  <tr>
                     <td width="25%" height="22"  align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;<label for="email">Email</label></td>
                     <td width="25%" class="white-bg" >
                        <?php   // echo $generalobj->PrintElement("Data[vEmail]","vEmail",$arr[0]['vEmail'],"text","Enter valid email address","style=width:210px tabIndex=4 Maxlength=50 onkeypress='return chkSpace(event);'");?>
                        <input type="text" name="Data[vEmail]" id="vEmail" class="required email" Maxlength="50" onkeypress='return chkSpace(event);' style="width:210px;" value="<?php  echo  (isset($arr[0]['vEmail']))? $arr[0]['vEmail'] : '';?>" tabIndex="4" />
                     </td>

			<?php  if($view == 'add') { ?>
			<td width="25%" height="22"  align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Confirm Email</td>
			<td width="25%" class="white-bg" >
                        <?php  echo $generalobj->PrintElement("vConEmail","vConEmail","","text","Enter Confirm Email address","onkeydown='return noCTRL(event);' oncontextmenu='return false;' onkeypress='return chkSpace(event);' equalTo='#vEmail' style=width:210px tabIndex=5 Maxlength=50;","Enter Confirm Email address");?>
			</td>
			<?php   } else { ?>
                        <td width="25%" class="white-bg" colspan="3"></td>
			<?php   } ?>
                  </tr>
                  <?php  if($view == 'add'){?>
                  <tr>
                        <!-- onkeypress='return chkCharUser(event);' -->
                        <!-- onblur='return chkDuplicate(this.value,this.id,\"iAdminId\",\"".PRJ_DB_PREFIX."_administrator\",\"iAdminId\");return false;' -->
			<td width="25%" height="22" class="td-bg" align="right" valign="top"><font class="reqmsg">*</font>&nbsp;<label for="username">User Name</label></td>
			<td width="25%" class="white-bg">
                        <?php  //echo $generalobj->PrintElement("Data[vUsername]","vUsername",$arr[0]['vUsername'],"text","Enter username"," onkeypress='return chkValidUserName(event);' style=width:210px tabIndex=6 Maxlength=20; ");?>
                        <input type="text" name="Data[vUsername]" id="vUsername" class="required" minlength="5" value="<?php  echo  (isset($arr[0]['vUsername']))? $arr[0]['vUsername'] : '';?>" onkeypress='return chkValidUserName(event);' style="width:210px;" tabIndex=6/>
			</td>
			<td width="25%" class="td-bg">&nbsp;</td>
			<td width="25%" class="white-bg">&nbsp;</td>
                  </tr>
                  <?php   } ?>
                  <?php  if($view == 'add') { ?>
                     <tr><!-- onkeypress='return chkValidPassword(event);' -->
                        <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Password</td>
                        <td width="25%" class="white-bg">
                           <?php  echo $generalobj->PrintElement("vPassword","vPassword",(isset($arr[0]['vPassword']))? $arr[0]['vPassword'] : '',"password","Enter password","  onkeypress='return chkSpace(event);' class='required password'  onkeypress='return chkValidPassword(event);' style='width:210px;' tabIndex='7' minlength='5' Maxlength='10'; class='required'","Enter password");?>
                        </td>
                        <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Confirm Password</td>
                        <td width="25%" class="white-bg">
                           <?php  echo $generalobj->PrintElement("vConPassword","vConPassword","","password","Enter Confirm Password","onkeydown='return noCTRL(event);' oncontextmenu='return false;'  onkeypress='return chkValidPassword(event);' equalTo='#vPassword' style=width:210px tabIndex=8 Maxlength=10;","Enter Confirm Password");?>
                        </td>
			</tr>
<!--                     <tr>
                        <td width="25%" class="td-bg">&nbsp;</td>
                        <td width="25%" height="22"  colspan="3"  class="white-bg" valign="top"><font class="reqmsg">(Password length should be 6 or  greater than 6.)</font></td>
			</tr>
-->
                  <?php   } ?>
                  <?php   if($_SESSION['B2B_SESS_USERID'] != $iAdminId || $view == 'add') { ?>
                     <tr>
                        <td width="25%" height="22" align="right" class="td-bg">Status </td>
                        <td width="25%" class="white-bg" >
                           <?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_administrator", "eStatus","Data[eStatus]", "eStatus","", "".(isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : ''.""," tabIndex=9");?>
                        </td>
                        <td width="25%" height="22"  align="right" class="td-bg">&nbsp;</td>
                        <td width="25%" class="white-bg" >&nbsp;</td>
			</tr>
                  <?php   } else { ?>
                     <tr>
                        <td width="25%" height="22" align="right" class="td-bg">Status </td>
                        <td width="25%" class="white-bg" >
                           <input type="hidden" id="eStatus" name="Data[eStatus]" value="<?php  echo  $arr[0]['eStatus']?>">
                           <strong><?php  echo  $arr[0]['eStatus']?></strong>
                        </td>
                        <td width="25%" height="22"  align="right" class="td-bg">&nbsp;</td>
                        <td width="25%" class="white-bg" >&nbsp;</td>
			</tr>
                  <?php   } ?>
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
   <td valign="top">
      <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
         <tr>
            <td class="heading">Contact Information</td>
         </tr>
         <tr>
            <td valign="top">
               <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Address Line 1</td>
                     <td width="25%"  class="white-bg">
                        <?php  echo $generalobj->PrintElement("Data[vAddress1]","vAddress1",(isset($arr[0]['vAddress1']))? $arr[0]['vAddress1'] : '',"text","Enter Address1"," oncontextmenu='return false;' class='required' style=width:210px tabIndex=10 Maxlength=40;","Enter Address1");?>
                     </td>
                     <td height="22" width="25%" align="right" class="td-bg" valign="top">Address Line 2</td>
                     <td class="white-bg" width="25%">
                        <?php  echo $generalobj->PrintElement("Data[vAddress2]","vAddress2",(isset($arr[0]['vAddress2']))? $arr[0]['vAddress2'] : '',"text","Enter Address2"," oncontextmenu='return false;'  style=width:210px tabIndex=11 Maxlength=40;","Enter Address2");?>
                     </td>
                  </tr>
                  <tr>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Country</td>
                     <td width="25%" class="white-bg" valign="top">
                        <select name ="Data[vCountry]" id="vCountry" class="required" title="Select Country" style="width:218px" tabindex="12" onchange="getRelativeCombo(this.value,'','vState','-- Select State --',stateArr);getISD(this.value);">
                             <option value=""> --- Select Country --- </option>
                           <?php
                                    $arr[0]['vCountry'] = (isset($arr[0]['vCountry']))? $arr[0]['vCountry'] : '';
                              for($i=0;$i<count($db_country);$i++) { ?>
                              <option value="<?php  echo  $db_country[$i]['vCountryCode'] ?>" <?php if($arr[0]['vCountry'] == $db_country[$i]['vCountryCode']){?> selected <?php  }?> ><?php  echo  $db_country[$i]['vCountry']?></option>
                           <?php   } ?>
                        </select>
                     </td>
                     <td align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;State</td>
                     <td width="25%" class="white-bg" valign="top">
                        <input type="hidden" name="selstate" id="selstate" value="<?php  echo  $arr[0]['vState']?>">
                        <select name ="Data[vState]" id="vState" style="width:218px" tabindex="13" class="required" title="Select State">
                           <option value="">Select State</option>
                           <!--<option value="<?php  echo  $state[0]['vStateCode']?>" selected><?php  echo  $state[0]['vState']?></option>-->
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;City</td>
                     <td class="white-bg" valign="top">
                        <?php  echo $generalobj->PrintElement("Data[vCity]","vCity",(isset($arr[0]['vCity']))? $arr[0]['vCity'] : '',"text","Enter city","onkeypress='return chkValidChar(event);' class='required' style=width:210px tabIndex=14 Maxlength=30;","Enter city");?>
			</td>
			<td width="25%" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Zip code</td>
			<td width="25%" class="white-bg" valign="top">
                        <?php  echo $generalobj->PrintElement("Data[vZip]","vZip",(isset($arr[0]['vZip']))? $arr[0]['vZip'] : '',"text","Enter zip code","style='width:210px' tabIndex=15 class='required digits' valign='top' maxlength=7");?>
			</td>
                  </tr>
                  <tr>
                     <td align="right" class="td-bg" valign="top">&nbsp;Phone</td>
                     <td class="white-bg" valign="top">
<!--                        <?php   //echo $generalobj->PrintElement("vPhone1","vPhone1",$vPhone1,"text","Enter phone1"," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:60px' tabIndex=16  Maxlength=3");?>&nbsp;-&nbsp;<?php   echo $generalobj->PrintElement("vPhone2","vPhone2",$vPhone2,"text","Enter phone2"," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:110px' Maxlength=8");?> -->
                          <input type="text" name="vPhone1" id="vPhone1" class="" value="<?php  echo  (isset($vPhone1))? $vPhone1 : '';?>" onblur="change()" onkeypress="return chkDigitMobcode(event);" style="width:30px;" maxlength="3" tabIndex="16" />
                          <input type="text" name="vPhone2" id="vPhone2" class="" value="<?php  echo  (isset($vPhone2))? $vPhone2 : '';?>" onblur="change()" onkeypress="return chkDigitMobcode(event);" style="width:173px;" maxlength="15" tabIndex="17" />
                   <div id="errmsg" style="color:red;"></div>
			</td>
			<td width="25%" align="right" class="td-bg">Mobile</td>
               <td width="25%" class="white-bg" valign="top">
<!--                        <?php  // echo $generalobj->PrintElement("vMobile1","vMobile1",$vMobile1,"text",""," autocomplete='off'onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:60px' tabIndex=19 Maxlength=3");?>&nbsp;-&nbsp;<?php   echo $generalobj->PrintElement("vMobile2","vMobile2",$vMobile2,"text",""," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:110px' tabIndex=20 Maxlength=8");?> -->
                     <input type="text" name="vMobileCode" id="vMobileCode" value="<?php  echo  (isset($arr[0]['vMobileCode']))? $arr[0]['vMobileCode'] : '';?>" style="width:30px;" onblur="change()" onkeypress="return chkDigitMobcode(event);" maxlength="3" tabIndex="18"/>
                    <input type="text" name="Data[vMobile]" id="vMobile" value="<?php  echo  (isset($arr[0]['vMobile']))? $arr[0]['vMobile'] : '';?>" style="width:173px;" onblur="change()" onkeypress="return chkDigitMobcode(event);" maxlength="15" tabIndex="19"/>
                     <div id="errmsgmobile" style="color:red;"></div>
			</td>
                  </tr>
                  <tr>
                     <td align="right" class="td-bg">Fax</td>
                     <td class="white-bg">
<!--                        <?php  //echo $generalobj->PrintElement("vFax1","vFax1",$vFax1,"text",""," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:60px' tabIndex=22 Maxlength=3");?>&nbsp;-&nbsp;<?php  echo $generalobj->PrintElement("vFax2","vFax2",$vFax2,"text",""," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:110px' tabIndex=23 Maxlength=8");?> -->
                        <input type="text" name="Data[vFax]" id="vFax" value="<?php  echo  (isset($arr[0]['vFax']))? $arr[0]['vFax'] : '';?>" style="width:210px;" onkeypress="return chkDigitZipcode(event);" maxlength="10" tabIndex="20"/>
			</td>
			<td class="td-bg" >&nbsp;</td>
			<td class="white-bg" >&nbsp;</td>
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
<?php  if($view == 'edit') { ?>
<tr>
   <td width="49%" valign="top">
      <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
         <tr>
            <td class="heading">Additional Information</td>
         </tr>
         <tr>
            <td valign="top">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
			<td width="25%" height="22" align="right" class="td-bg" valign="top">Created date</td>
			<td width="25%" class="white-bg" valign="top">
                        <strong><?php  echo  DateTime($arr[0]['dDate']);?></strong>
			</td>
			<td width="25%" height="22" align="right" class="td-bg" valign="top">Created from IP</td>
			<td width="25%" class="white-bg">
                        <strong><?php  echo  $arr[0]['vFromIP'];?></strong>
			</td>
                  </tr>
                  <tr>
                     <td width="25%" height="22" align="right" class="td-bg">Last access date/time</td>
			<td width="25%" class="white-bg">
                        <strong> <?php   if($arr[0]['dLastAccess'] != '')
                                       $lastaccess =  DateTime($arr[0]['dLastAccess'],"2");
                                    else
                                       $lastaccess =  "---";
                           echo $lastaccess;?>
                        </strong>
			</td>
                     <td width="25%" height="22" align="right" class="td-bg">Total login</td>
			<td width="25%" class="white-bg">
                        <strong><?php  echo  $arr[0]['iTotLogin'];?></strong>
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
<?php   } ?>
<tr>
   <td valign="top" align="center">
	<!-- onclick="checkvalid(this.form);return false;" -->
      <input type="image"  id="btnSave" alt="Save" title="Save" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex="25" onclick="return frmsubmit();" />
      <img alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="resetform();return false;" tabIndex="26">
      <img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=<?php  echo  $file?>&view=index&AX=Yes');" tabIndex="27" onblur="$('#type').focus();">
   </td>
</tr>
</table>
</form>

<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.autotab.js"></script>
<script type="text/javascript">
<?php  //if($view == 'edit'){?>
	getRelativeCombo($('#vCountry').val(),'<?php  echo  isset($arr[0]['vState'])?$arr[0]['vState']:"";?>','vState','-- Select State --',stateArr);
<?php  //}?>
function change() {
     var val1 = $('#vPhone1').val();
     var val2 = $('#vPhone2').val();
    // var val3 = $('#vPhone3').val();

     if(val1.length == 0 || val2.length == 0) {
          $('#errmsg').attr('innerHTML','Enter Proper Phone Number');
          return false;
     } else if($('#vMobileCode').val().length == 0 || $('#vMobile').val().length == 0 ) {
          $('#errmsgmobile').attr('innerHTML','Enter Proper Mobile Number');
          $('#errmsg').attr('innerHTML','');
          return false;
     } else {
          $('#errmsg').attr('innerHTML','');
          $('#errmsgmobile').attr('innerHTML','');
          return true;
     }
}

function getISD(val) {
     var url = ADMIN_URL+"index.php?file=aj-countrycode",

   pars = '&val='+val;
   //alert(url+pars);
   //return false;
     $.ajax({
             type:"GET", url:url,
             data:pars,
             success:function setarchmsg(code) {
                    $('#vPhone1').val(code);
                    $('#vMobileCode').val(code);
             }
     });
   return false;
}

$('#vPhone1').autotab({ target: 'vPhone2', format: 'numeric' });
$('#vPhone2').autotab({ target: 'vPhone3', format: 'numeric', previous: 'vPhone1' });
$('#vPhone3').autotab({ previous: 'vPhone2', format: 'numeric' });

function resetform() {
	$('#frmadd')[0].reset();
     getRelativeCombo($('#vCountry').val(),'<?php  echo  isset($arr[0]['vState'])?$arr[0]['vState']:"";?>','vState','-- Select State --',stateArr);
}

$("#frmadd").validate( {
     rules: {
				"Data[vEmail]": {
               remote: {
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data: {
                         val:function() {
               return $("#iAdminId").val();
               },
               id:function() {
               return "iAdminId";
               },
               field:function() {
               return "vEmail";
               },
               table:function() {
               return "<?php  echo  PRJ_DB_PREFIX?>_administrator";
               }
          }
     }
},
          "Data[vUsername]": {
               remote: {
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data: {
                         val:function() {
               return $("#iAdminId").val();
               },
               id:function() {
               return "iAdminId";
               },
               field:function() {
               return "vUsername";
               },
               table:function() {
               return "<?php  echo  PRJ_DB_PREFIX?>_administrator";
               }
          }
     }
}
},
	messages: {
		vPassword: {minlength: 'Atleast five characters required'},
		"Data[vEmail]": {
			required: 'Enter Email Address',
			email: "Please enter a valid email address, example: you@yourdomain.com",
			remote: jQuery.validator.format("This email is already taken, please enter a different address.")
		},
		vConEmail: { equalTo: "Enter same value as 'Email Address'" },
		"Data[vUsername]": {
			required: 'Enter Username',
               minlength: 'Atleast five characters required',
			remote: jQuery.validator.format("This username is already taken, please enter a different username.")
		},
		vConPassword: { equalTo: "Enter same value as 'Password'" },
		"Data[vZip]": {required: 'Enter Zip Code'},
 	}
});
function frmsubmit()
{
	var vldfrm = $('#frmadd').valid();
	if(!vldfrm) {
		return false;
	}
	$('#frmadd')[0].submit();
}
</script>