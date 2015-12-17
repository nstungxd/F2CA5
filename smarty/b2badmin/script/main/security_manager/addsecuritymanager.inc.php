<?php
/**
 * Add/Update File For Security Manager
 * @package		addsecuritymanager.inc.php
 * @Section		security_manager
*/

if(!isset($secManObj)) {
  include_once(SITE_CLASS_APPLICATION.'securitymanager/class.SecurityManager.php');
  $secManObj = new SecurityManager();
}
$gdbobj->getRequestVars();

if(!isset($adminUserObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.AdminUser.php');
     $adminUserObj = new AdminUser();
}

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
$iSMID = GetVar("iSMID");
$file  = GetVar("file");
$arr = Array();

if(count($_POST) > 0) {
          $arr[0] = $_POST;
} else {
     if($view == 'edit') {
        $arr = $secManObj->select($iSMID);
		  //prints($arr); exit;
		  $vPassword = $generalobj->decrypt($arr[0]['vPassword']);
                 // echo $vPassword;
        $adminarr = $adminUserObj->select($arr[0]['iAdminID']);
     } else {
        $view = "add";
     }
}

$seqCombArr1 = array(
	 "ID"				=>	"iSecretQuestion1ID",
	 "Name" 			=>	"Data[iSecretQuestion1ID]",
	 "Type"			=>	"Query",
	 "tableName"   =>	"".PRJ_DB_PREFIX."_sec_question",
	 "fieldId" 		=>	"iQuestionId",
	 "fieldName"	=>	"vQuestion_en",
	 "extVal"		=>	'',
	 "selectedVal" =>	(isset($arr[0]['iSecretQuestion1ID']))? $arr[0]['iSecretQuestion1ID'] : '',
	 "width"  		=>	'210px',
	 "height"  		=>	'',
	 "onchange" 	=>	'',
	 "selectText" 	=>	"---Select security question---",
	 "where" 		=>	" eStatus = 'Active'",
	 "multiple_select" 	=>	"",
	 "orderby" 		=>	'vQuestion_en',
	 "validationmsg"	=>	'Select security question.',
	 "extra"			=>	"tabIndex=9 title='Select Security Question'",
	 'class' 		=> 'required'
  );
$seqCombArr2 = array(
	 "ID"				=>	"iSecretQuestion2ID",
	 "Name" 			=>	"Data[iSecretQuestion2ID]",
	 "Type"			=>	"Query",
	 "tableName"   =>	"".PRJ_DB_PREFIX."_sec_question",
	 "fieldId" 		=>	"iQuestionId",
	 "fieldName"	=>	"vQuestion_en",
	 "extVal"		=>	'',
	 "selectedVal" =>	(isset($arr[0]['iSecretQuestion2ID']))? $arr[0]['iSecretQuestion2ID'] : '',
	 "width"  		=>	'210px',
	 "height"  		=>	'',
	 "onchange" 	=>	'',
	 "selectText" 	=>	"---Select security question---",
	 "where" 		=>	" eStatus = 'Active'",
	 "multiple_select" 	=>	"",
	 "orderby" 		=>	'vQuestion_en',
	 "validationmsg"	=>	'Select security question.',
	 "extra"			=>	"tabIndex=11"
  );
$answer1 = (isset($arr[0]['vAnswer']) && trim($arr[0]['vAnswer'])!='')? '##########' : '';
$answer2 = (isset($arr[0]['vAnwser']) && trim($arr[0]['vAnwser'])!='')? '##########' : '';
//Get State Array
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;
$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");
//prints($db_state);exit;
//end here
$arr[0]['vFirstName'] = (isset($arr[0]['vFirstName']))? $arr[0]['vFirstName'] : '';
$arr[0]['vLastName'] = (isset($arr[0]['vLastName']))? $arr[0]['vLastName'] : '';
$arr[0]['vEmail'] = (isset($arr[0]['vEmail']))? $arr[0]['vEmail'] : '';
$arr[0]['vUserName'] = (isset($arr[0]['vUserName']))? $arr[0]['vUserName'] : '';
$arr[0]['vPassword'] = (isset($arr[0]['vPassword']))? $arr[0]['vPassword'] : '';
$arr[0]['eStatus'] = (isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : '';
$arr[0]['vAddressLine1'] = (isset($arr[0]['vAddressLine1']))? $arr[0]['vAddressLine1'] : '';
$arr[0]['vAddressLine2'] = (isset($arr[0]['vAddressLine2']))? $arr[0]['vAddressLine2'] : '';
$arr[0]['vAddressLine3'] = (isset($arr[0]['vAddressLine3']))? $arr[0]['vAddressLine3'] : '';
$arr[0]['vCountry'] = (isset($arr[0]['vCountry']))? $arr[0]['vCountry'] : '';
$arr[0]['vCity'] = (isset($arr[0]['vCity']))? $arr[0]['vCity'] : '';
$arr[0]['vZipcode'] = (isset($arr[0]['vZipcode']))? $arr[0]['vZipcode'] : '';
$arr[0]['vDefaltLan'] = (isset($arr[0]['vDefaltLan']))? $arr[0]['vDefaltLan'] : '';
$arr[0]['eEmailNotification'] = (isset($arr[0]['eEmailNotification']))? $arr[0]['eEmailNotification'] : '';
?>
<script language="JavaScript1.2" >
	stateArr = new Array(<?php  echo  $stateArr;?>);
</script>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $file?>&view=action" method="post">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iSMID","iSMID",$iSMID,"Hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<?php  if($view == 'edit') { ?>
<tr>
   <td>
        <?php  include_once("addsmtop.inc.php")?>
   </td>
</tr>
<?php   } ?>
<tr>
   <td  valign="top"><span class="reqmsg" style="float:right;"><?php  if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') { echo "User is already exists"; } } ?></span>
      <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
         <tr>
            <td class="heading">Personal Information</td>
         </tr>
         <tr>
            <td valign="top">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <?php   if($view == 'edit') { ?>
                  <tr>
                    <td height="22" class="td-bg" align="right" width="25%" valign="top">User Name</td>
						  <td class="white-bg"  width="25%" valign="top"><input type="text" name="Data[vUserName]" id="vUserName" class="required" value="<?php  echo  $arr[0]['vUserName']?>" minlength="5" onkeypress='return chkValidUserName(event);' style="width:210px;" tabIndex="6" /></td>
						  <td width="25%" height="22" align="right" class="td-bg">&nbsp;</td>
						  <td width="25%" class="white-bg" >&nbsp;</td>
                  </tr>
                  <?php   } ?>
                  <!--<tr>
                     <td  width="25%" height="22"  align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;<label for="type">Type:</label></td>
			<td width="25%" class="white-bg" >
                        <?php  //=$gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_security_manager", "eType","Data[eType]", "type","", "".$arr[0]['eType']."","style='width:216px' tabIndex=1; class='required' ","Select Admin Type","---Select Admin Type----");?>
 			</td>
			<td width="25%" height="22" align="right" class="td-bg">&nbsp;</td>
			<td width="25%" class="white-bg" >&nbsp;</td>
                  </tr>-->
                  <tr>
                     <td height="22" width="25%" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;First name</td>
			<td  class="white-bg" width="25%">
                        <?php  echo $generalobj->PrintElement("Data[vFirstName]","vFirstName",$arr[0]['vFirstName'],"text","Enter first name"," onkeypress='return chkValidChar(event);' class='required' style=width:210px tabIndex=2; Maxlength=20;","Enter first name");?>
			</td>
			<td  height="22" width="25%" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Last name</td>
			<td  class="white-bg" width="25%">
                        <?php  echo $generalobj->PrintElement("Data[vLastName]","vLastName",$arr[0]['vLastName'],"text","Enter last name"," onkeypress='return chkValidChar(event);' class='required' style=width:210px tabIndex=3  Maxlength=20;","Enter last name");?>
			</td>
                  </tr>
                  <tr>
                     <td height="22"  align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;<label for="email">Email</label></td>
                     <td class="white-bg" >
                        <?php   // echo $generalobj->PrintElement("Data[vEmail]","vEmail",$arr[0]['vEmail'],"text","Enter valid email address","style=width:210px tabIndex=4 Maxlength=50 onkeypress='return chkSpace(event);'");?>
                        <input type="text" name="Data[vEmail]" id="vEmail" class="required email" Maxlength="50" onkeypress='return chkSpace(event);' style="width:210px;" value="<?php  echo  $arr[0]['vEmail']?>" tabIndex="4" />
                     </td>

			<?php  if($view == 'add') { ?>
			<td height="22"  align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Confirm Email</td>
			<td class="white-bg" >
                        <?php  echo $generalobj->PrintElement("vConEmail","vConEmail","","text","Enter Confirm Email address","onkeydown='return noCTRL(event);' oncontextmenu='return false;' onkeypress='return chkSpace(event);' equalTo='#vEmail' style=width:210px tabIndex=5 Maxlength=50;","Enter Confirm Email address");?>
			</td>
			<?php   } else { ?>
				<td height="22"  align="right" class="td-bg" ><font class="reqmsg"></font>&nbsp;</td>
				<td class="white-bg" ></td>
                            <?php  }?>
                  </tr>
                  <?php  if($view == 'add'){?>
                  <tr>
                        <!-- onkeypress='return chkCharUser(event);' -->
                        <!-- onblur='return chkDuplicate(this.value,this.id,\"iAdminId\",\"".PRJ_DB_PREFIX."_security_manager\",\"iAdminId\");return false;' -->
			<td height="22" class="td-bg" align="right" valign="top"><font class="reqmsg">*</font>&nbsp;<label for="username">User Name</label></td>
			<td class="white-bg">
                        <?php  //echo $generalobj->PrintElement("Data[vUserName]","vUserName",$arr[0]['vUserName'],"text","Enter username"," onkeypress='return chkValidUserName(event);' style=width:210px tabIndex=6 Maxlength=20; ");?>
                        <input type="text" name="Data[vUserName]" id="vUserName" class="required" value="<?php  echo  $arr[0]['vUserName']?>" minlength="5" onkeypress='return chkValidUserName(event);' style="width:210px;" tabIndex="6" />
			</td>
			<td class="td-bg">&nbsp;</td>
			<td class="white-bg">&nbsp;</td>
                  </tr>
                  <?php } ?>
                  <?php if($view == 'add') { ?>
                     <tr><!-- onkeypress='return chkValidPassword(event);' -->
                        <td height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Password</td>
                        <td class="white-bg">
                           <?php   echo $generalobj->PrintElement("vPassword","vPassword",$arr[0]['vPassword'],"password","Enter password","  onkeypress='return chkSpace(event);' class='required password'  onkeypress='return chkValidPassword(event);' style='width:210px;' tabIndex='7' minlength='5' maxlength='10'; class='required'","Enter password");?>
                        </td>
                        <td height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Confirm Password</td>
                        <td class="white-bg">
                           <?php   echo $generalobj->PrintElement("vConPassword","vConPassword","","password","Enter Confirm Password","onkeydown='return noCTRL(event);' oncontextmenu='return false;'  onkeypress='return chkValidPassword(event);' equalTo='#vPassword' style=width:210px tabIndex=8 Maxlength=10;","Enter Confirm Password");?>
                        </td>
<!--			</tr>
                     <tr>
                        <td class="td-bg">&nbsp;</td>
                        <td height="22"  colspan="3"  class="white-bg" valign="top"><font class="reqmsg">(Password length should be 6 or  greater than 6.)</font></td>
			</tr>
-->
                  <?php } ?>
                      <!--<tr>
                        <td height="22" align="right" class="td-bg" valign="top" ></td>
                        </tr>-->
						  <tr>
							 <td height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Security Question 1</td>
							 <td class="white-bg" >
								<?php echo $gdbobj->DynamicDropDown($seqCombArr1); ?>
							 </td>
							 <td height="22"  align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Answer 1</td>
							 <td class="white-bg" ><input type="text" id="vAnswer" name="Data[vAnswer]" class="required" value="<?php echo $answer1; ?>" title="Enter Answer" /></td>
							</tr>
						  
						  <tr>
							 <td height="22" align="right" class="td-bg">Security Question 2</td>
							 <td class="white-bg" >
								<?php echo $gdbobj->DynamicDropDown($seqCombArr2); ?>
							 </td>
							 <td height="22"  align="right" class="td-bg">&nbsp;Answer 2</td>
							 <td class="white-bg" ><input type="text" id="vAnwser" name="Data[vAnwser]" value="<?php echo $answer2; ?>" /></td>
							</tr>
						  
                     <tr>
                        <td height="22" align="right" class="td-bg">Status </td>
                        <td class="white-bg" >
								  <?php if($arr[0]['eStatus'] == '') { $arr[0]['eStatus'] = 'Inactive'; } ?>
                           <?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_security_manager", "eStatus","Data[eStatus]", "eStatus","", "".$arr[0]['eStatus'].""," tabIndex=11");?>
                        </td>
                        <td height="22"  align="right" class="td-bg">&nbsp;<!--Verification Status--></td>
                        <td class="white-bg" >&nbsp;
<!--									<?php  // if(($arr[0]['eVerify'] != 'Verified') && ($arr[0]['iAdminID'] != $_SESSION['B2B_SESS_USERID'])) { ?>
										<?php  //=$gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_security_manager", "eVerify","Data[eVerify]", "eVerify","", "".$arr[0]['eVerify'].""," tabIndex=9");?>
									<?php  // } else { ?>
										<b><?php  //=$arr[0]['eVerify']?></b>
									<?php  // } ?>
-->
								</td>
							</tr>
                     <!--<tr>
                        <td height="22" align="right" class="td-bg">Status </td>
                        <td class="white-bg" >
                           <input type="hidden" id="eStatus" name="Data[eStatus]" value="<?php  //=$arr[0]['eStatus']?>">
                           <strong><?php  //=$arr[0]['eStatus']?></strong>
                        </td>
                        <td height="22"  align="right" class="td-bg">&nbsp;</td>
                        <td class="white-bg" >&nbsp;</td>
			</tr>-->
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
                        <?php   echo $generalobj->PrintElement("Data[vAddressLine1]","vAddressLine1",$arr[0]['vAddressLine1'],"text","Enter Address Line1"," oncontextmenu='return false;' class='required' style=width:210px tabIndex=11 Maxlength=40;","Enter Address Line1");?>
                     </td>
                     <td height="22" width="25%" align="right" class="td-bg" valign="top">Address Line 2</td>
                     <td class="white-bg" width="25%">
                        <?php   echo $generalobj->PrintElement("Data[vAddressLine2]","vAddressLine2",$arr[0]['vAddressLine2'],"text","Enter Address Line2"," oncontextmenu='return false;'  style=width:210px tabIndex=11 Maxlength=40;","Enter Address Line2");?>
                     </td>
                  </tr>
                  <tr>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top">&nbsp;Address Line 3</td>
                     <td width="25%"  class="white-bg">
                        <?php   echo $generalobj->PrintElement("Data[vAddressLine3]","vAddressLine3",$arr[0]['vAddressLine3'],"text","Enter Address Line3"," oncontextmenu='return false;' style=width:210px tabIndex=12 Maxlength=40;","Enter Address Line3");?>
                     </td>
                     <td height="22"  align="right" class="td-bg">&nbsp;</td>
                        <td class="white-bg" >&nbsp;</td>
                  </tr>
                  <tr>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Country</td>
                     <td width="25%" class="white-bg" valign="top">
                        <select name ="Data[vCountry]" id="vCountry" class="required" title="Select Country" style="width:218px" tabindex="13" onchange="getRelativeCombo(this.value,'','vState','-- Select State --',stateArr);">
                             <option value=""> --- Select Country --- </option>
                           <?php   for($i=0;$i<count($db_country);$i++) { ?>
                              <option value="<?php  echo  $db_country[$i]['vCountryCode'] ?>" <?php if($arr[0]['vCountry'] == $db_country[$i]['vCountryCode']){?> selected <?php  }?> ><?php  echo  $db_country[$i]['vCountry']?></option>
                           <?php   } ?>
                        </select>
                     </td>
                     <td align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;State</td>
                     <td width="25%" class="white-bg" valign="top">
                        <input type="hidden" name="selstate" id="selstate" value="<?php  echo  $arr[0]['vState']?>">
                        <select name ="Data[vState]" id="vState" style="width:218px" tabindex="14" class="required" title="Select State">
                           <option value="">Select State</option>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;City</td>
                     <td class="white-bg" valign="top">
                        <?php  echo $generalobj->PrintElement("Data[vCity]","vCity",$arr[0]['vCity'],"text","Enter city","onkeypress='return chkValidChar(event);' class='required' style=width:210px tabIndex=15 Maxlength=30;","Enter city");?>
            			</td>
            			<td width="25%" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Zip code</td>
            			<td width="25%" class="white-bg" valign="top">
                                    <?php  echo $generalobj->PrintElement("Data[vZipcode]","vZipcode",$arr[0]['vZipcode'],"text","Enter zip code","style='width:210px' tabIndex=16 class='required digits' valign='top' maxlength=7");?>
            			</td>
               	</tr>
                  <!--<tr>
                     <td align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Phone</td>
			<td class="white-bg">
                        <?php   //echo $generalobj->PrintElement("vPhone1","vPhone1",$vPhone1,"text","Enter phone1"," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:60px' tabIndex=16  Maxlength=3");?>&nbsp;-&nbsp;<?php   //echo $generalobj->PrintElement("vPhone2","vPhone2",$vPhone2,"text","Enter phone2"," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:110px' Maxlength=8");?> -->
                         <!--<input type="text" name="Data[vPhone]" id="vPhone" class="required digits" value="<?php  echo  $arr[0]['vPhone']?>" style="width:210px;" maxlength="10" tabIndex="16" />
			</td>
			<td width="25%" align="right" class="td-bg">Mobile</td>
			<td width="25%" class="white-bg">-->
<!--                        <?php  // echo $generalobj->PrintElement("vMobile1","vMobile1",$vMobile1,"text",""," autocomplete='off'onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:60px' tabIndex=19 Maxlength=3");?>&nbsp;-&nbsp;<?php   //echo $generalobj->PrintElement("vMobile2","vMobile2",$vMobile2,"text",""," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:110px' tabIndex=20 Maxlength=8");?> -->
                       <!-- <input type="text" name="Data[vMobile]" id="vMobile" value="<?php  echo  $arr[0]['vMobile']?>" style="width:210px;" maxlength="10" tabIndex="17"/>
			</td>
                  </tr>
                  <tr>
                     <td align="right" class="td-bg">Fax</td>
                     <td class="white-bg">-->
<!--                        <?php  //echo $generalobj->PrintElement("vFax1","vFax1",$vFax1,"text",""," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:60px' tabIndex=22 Maxlength=3");?>&nbsp;-&nbsp;<?php  //echo $generalobj->PrintElement("vFax2","vFax2",$vFax2,"text",""," autocomplete='off' onkeypress='return ChkFormat(event,this.value,\"phone\",this.id);' style='width:110px' tabIndex=23 Maxlength=8");?> -->
                       <!-- <input type="text" name="Data[vFax]" id="vFax" value="<?php  echo  $arr[0]['vFax']?>" style="width:210px;" maxlength="10" tabIndex="18"/>
			</td>
			<td class="td-bg" >&nbsp;</td>
			<td class="white-bg" >&nbsp;</td>
                  </tr>-->


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
   <td width="49%" valign="top">
      <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
         <tr>
            <td class="heading">Additional Information</td>
         </tr>
         <tr>
            <td valign="top">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg"></font>&nbsp;Send Online Email Notification</td>
                         <td width="25%"class="white-bg" >
                               <?php
                               if($arr[0]['eEmailNotification'] == 'Yes')
                                   $email='checked';
                                ?>
                              <input type="checkbox" id="eEmailNotification" value="Yes" name="Data[eEmailNotification]" <?php if(isset($email))echo$email;?> >
                        </td>
                             <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Default language</td>
                          <?php
                                 $sql="select vLanguage,vLanguageCode from b2b_language";
                                 $res=$dbobj->MySQLSelect($sql);
                                 //prints($res);exit;
                              ?>
										<?php if($arr[0]['vDefaltLan'] == '') { $arr[0]['vDefaltLan'] = 'en'; } ?>
                          <td class="white-bg" width="25%" >
                              <select name="Data[vDefaltLan]">
                               <?php  for($i=0;$i<count($res);$i++) { ?>
                                   <option <?php  echo  ($arr[0]['vDefaltLan']==$res[$i]['vLanguageCode'])? "selected":"" ?> value="<?php  echo  ($res[$i]['vLanguageCode'])?>"><?php  echo  ($res[$i]['vLanguage'])?></option>
                              <?php  }?>
                              </select>
                        </td>

                    </tr>
              <?php  if($view == 'edit') { ?>
                  <tr>
			<td width="25%" height="22" align="right" class="td-bg" valign="top">Created date</td>
			<td width="25%" class="white-bg" valign="top">
                        <strong><?php  echo  DateTime($arr[0]['dAddedDate']);?></strong>
			</td>
			<td width="25%" height="22" align="right" class="td-bg" valign="top">Created from IP</td>
			<td width="25%" class="white-bg">
                        <strong><?php  echo  $arr[0]['vIP'];?></strong>
			</td>
                  </tr>
                  <tr>
                     <td width="25%" height="22" align="right" class="td-bg">Last access date/time</td>
			<td width="25%" class="white-bg">
                        <strong> <?php   if($arr[0]['dLastAccessDate'] != '')
                                       $lastaccess =  DateTime($arr[0]['dLastAccessDate'],"2");
                                    else
                                       $lastaccess =  "---";
                           echo $lastaccess;?>
                        </strong>
			</td>
                     <td width="25%" height="22" align="right" class="td-bg">Added By</td>
			<td width="25%" class="white-bg">
                        <strong><?php  echo  $adminarr[0]['vFirstName'].' '.$adminarr[0]['vLastName'];?></strong>
			</td>
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
   <td valign="top" align="center">
	<!-- onclick="checkvalid(this.form);return false;" -->
     <input type="hidden" name="dpr" id="dpr" value="nod" />
     <input type="image"  id="btnSave" alt="Save" title="Save" style="cursor:pointer" onclick="return submitFrm();" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex="17">
      <img alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="resetform();return false;" tabIndex="18">
      <img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=se-securitymanager&view=index&AX=Yes');" tabIndex="19" onblur="$('#vFirstName').focus();">
   </td>
</tr>
</table>
</form>

<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript">
<?php  //if($view == 'edit'){?>
   getRelativeCombo($('#vCountry').val(),'<?php echo (isset($arr[0]['vState']))? $arr[0]['vState'] : ''; ?>','vState','-- Select State --',stateArr);
<?php  //}?>
var LBL_EMAIL_TAKEN="This email is already in use.";
var LBL_SURE_TO_PROCEED="Do you still want to proceed?";
function resetform()
{
   $('#frmadd')[0].reset();
   getRelativeCombo($('#vCountry').val(),'<?php echo (isset($arr[0]['vState']))? $arr[0]['vState'] : ''; ?>','vState','-- Select State --',stateArr);
}
function submitFrm()
{
	var vldfrm = $('#frmadd').valid();
	if(!vldfrm) {
		return false;
	}
	var email = $('#vEmail').val();
	pars = "&id=iSMID"+"&iSMID="+$('#iSMID').val()+"&field=vEmail"+"&vEmail="+$('#vEmail').val()+"&table=<?php  echo  PRJ_DB_PREFIX?>_security_manager";
	$.post(ADMIN_URL+"index.php?file=aj-chkdupdata", pars, function(resp)
	{
		if(resp == 'dup') {
			var ans = confirm(LBL_EMAIL_TAKEN+LBL_SURE_TO_PROCEED);
			if(ans) {
				$('#dpr').val('dpl');
				// $('#emlval').val(email);
				// alert('yes');
				$('#frmadd').submit();
			}
		}
		else if(resp != false)
		{
			$('#dpr').val('nod');
			// alert('ndp');
			$('#frmadd').submit();
		}
	});
	return false;
	//$('div[htmlfor=vPhone]').attr("style","float:right;")
	//$('#tdvPhone').attr("style","position:absolute;left:51.7%");
}
$("#frmadd").validate({
	rules:{
				/*"Data[vEmail]": {
               remote:{
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data:{
                         val:function() {
									return $("#iSMID").val();
								},
								id:function() {
									return "iSMID";
								},
								field:function() {
									return "vEmail";
								},
								table:function() {
									return "<?php  echo  PRJ_DB_PREFIX?>_security_manager";
								}
						}
				}
			},*/
         "Data[vUserName]": {
               remote:{
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data:{
                        val:function() {
									return $("#iSMID").val();
								},
								id:function() {
									return "iSMID";
								},
								field:function() {
									return "vUserName";
								},
								table:function() {
									return "<?php  echo  PRJ_DB_PREFIX?>_security_manager";
								}
							}
					}
			}
	},
   messages:{
		vPassword: {minlength: 'Atleast five characters required'},
		"Data[vPassword]": {minlength: 'Atleast five characters required'},
		"Data[vEmail]": {
			required: 'Enter Email Address',
			email: "Please enter a valid email address, example: you@yourdomain.com",
			remote: jQuery.validator.format("This email is already taken, please enter a different address.")
		},
		vConEmail: { equalTo: "Enter same value as 'Email Address'" },
		"Data[vUserName]": {
			required: 'Enter Username',
               minlength: 'Atleast five characters required',
			remote: jQuery.validator.format("This username is already taken, please enter a different username.")
		},
		vConPassword: { equalTo: "Enter same value as 'Password'" },
		"Data[vZip]": {required: 'Enter Zip Code'},
		"Data[vPhone]": {required: 'Enter Phone Number', digits: 'Enter Valid Phone Number (Only Digits)'}
	}
});
</script>