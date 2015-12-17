<script src="<?php  echo  S_JQUERY?>effects.core.js"></script>
<script src="<?php  echo  S_JQUERY?>effects.shake.js"></script>
<script language="JavaScript" src="<?php  echo  A_M_AJAX_JS?>signin.js"></script>
<form name="frmlogin" id="frmlogin" method="post">
<div id="login_div">
<table width="702" border="0" class="login-border" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td valign="top">
        <table width="702" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="login-topstrip">&nbsp;</td>
        </tr>
        <tr>
            <td class="login-middlebg">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="40%" valign="top" class="vr-dottedline">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="100" align="center" valign="top"><img hspace = "15" height = "64" src="<?php  echo  ADMIN_IMAGES?>exchainge.png"/></td>
                            </tr>
                            <tr>
                                <td height="200" align="center"><img src="<?php  echo  ADMIN_IMAGES?>login-icon.gif" /></td>
                            </tr>
                            <tr>
                                <td align="center"><div id="fpass"><a href="#" title="Forgot Password" class="redlink-big" onclick="openFpass();return false;">Forgot Password ?</a></div> </td>
                            </tr>
                        </table>
                    </td>
                    <td width="60%" valign="top" class="login-padding">
					<div id="divSignin" style="display:none">
                        <table width="100%" border="0" class="login-greymatter" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="26%" height="60" align="right" valign="top"><img src="<?php  echo  ADMIN_IMAGES?>login-icon1.gif" width="49" height="48" hspace="11" /></td>
                            <td width="74%" valign="top">Use a valid <strong>USERNAME</strong> and <strong>PASSWORD</strong> to gain access to the administration console.</td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top">
                                <table cellpadding="0" align="center"  cellspacing="0" border="0" width="367">
                                <tr>
                                    <td width="10"><img src="<?php  echo  ADMIN_IMAGES?>login-topleftcorner.gif" width="10" height="9" /></td>
                                    <td colspan="3" width="100%" class="logintopborder"><img src="<?php  echo  ADMIN_IMAGES?>blank.gif" /></td>
                                    <td width="10"><img src="<?php  echo  ADMIN_IMAGES?>login-toprightcorner.gif" width="10" height="9" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="loginleftrightborder">
                                        <table width="100%" class="login-greymatter" border="0" align="center" cellpadding="3" cellspacing="3">
                                        <tr>
                                            <td height="35" align="left" class="signin" colspan="2">&nbsp; SIGN IN <div id="msg" align="right" class="reqmsg"></div></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" align="right" class="blue-textbold">Username: </td>
                                            <td width="65%" align="left">
                                                <input type="text" name="vUserName" id="vUserName"  size="27" <?php if(isset($_COOKIE[''.PRJ_CONST_PREFIX.'_LOGIN_COOKIE']) && $_COOKIE[''.PRJ_CONST_PREFIX.'_LOGIN_COOKIE']!='') { ?> value="<?php echo $_COOKIE[''.PRJ_CONST_PREFIX.'_LOGIN_COOKIE']; ?>"<?php } else { ?> value="" <?php } ?> />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" class="blue-textbold">Password: </td>
                                            <td align="left">
                                                <input type="password" name="vPassword"  id="vPassword"  size="27" <?php if(isset($_COOKIE[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']) && $_COOKIE[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']  !=''){?>value="<?php echo $_COOKIE[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']; ?>"<?php } else {?> value="" <?php } ?> />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" class="blue-textbold">Login Parameter: </td>
                                            <td align="left">
                                                <input type="text" name="loginParameter"  id="loginParameter"  size="27" <?php if(isset($_COOKIE[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']) && $_COOKIE[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']  !=''){?>value="<?php echo $_COOKIE[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']; ?>"<?php } else {?> value="" <?php } ?> />
                                            </td>
                                        </tr>
                                     <!--    <tr>
                                            <td align="right">Color Theme : </td>
                                            <td align="left" valign="middle"><select style="width:210px;" id="selTheme" size="1">
                                                <option>Select Color Theme</option>
<option selected value="1">Grey</option>
                                            </select></td>
                                        </tr> -->
                                        <tr>
                                            <td align="right">
                                                <input type="checkbox" name="chk" id="chk" <?php if(isset($_COOKIE[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']) && $_COOKIE[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE'] !=''){?> checked <?php  }?> /></td>
                                            <td align="left" valign="middle">Remember me on this Computer </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td height="30" align="left">
											<input type="Image" src="<?php  echo  ADMIN_IMAGES?>btn-login.gif" border="0" alt="" onclick="checkauthLogin();return false;" title="Login" /></td>
                                        </tr>
                                        </table>

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="10"><img src="<?php  echo  ADMIN_IMAGES?>login-bottleftcorner.gif" width="10" height="17" /></td>
                                    <td width="183" class="loginbottbg">&nbsp;</td>
                                    <td width="25"><img src="<?php  echo  ADMIN_IMAGES?>login-bottcurve.gif" alt="" border="0" /></td>
                                    <td width="141" class="loginbottbg1">&nbsp;</td>
                                    <td valign="bottom"><img src="<?php  echo  ADMIN_IMAGES?>login-bottrightcorner.gif" /></td>
                                </tr>
								<!-- <tr>
									<td colspan="4" align="right"><a href="../csr"><span class="login-greymatter" ><strong>Sign in as Customer Service Representative</strong></span></a></td>
								</tr> -->
                                </table>
                            </td>
                        </tr>
                        </table>
                    </div>
					<div id="divforgotpass" style="display:none">
                        <table width="100%" border="0" class="login-greymatter" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="26%" height="60" align="right" valign="top"><img src="<?php  echo  ADMIN_IMAGES?>login-icon1.gif" width="49" height="48" hspace="11" /></td>
                            <td width="74%" valign="top">Use a valid <strong>USER NAME</strong> to Reply from the administration .</td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top">
                                <table cellpadding="0" align="center"  cellspacing="0" border="0" width="367">
                                <tr>
                                    <td width="10"><img src="<?php  echo  ADMIN_IMAGES?>login-topleftcorner.gif" width="10" height="9" /></td>
                                    <td colspan="3" width="100%" class="logintopborder"><img src="<?php  echo  ADMIN_IMAGES?>blank.gif" width="1" height="1" /></td>
                                    <td width="10"><img src="<?php  echo  ADMIN_IMAGES?>login-toprightcorner.gif" width="10" height="9" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="loginleftrightborder" height="175" valign="top">
                                        <table width="90%" class="login-greymatter" border="0" align="right" cellpadding="3" cellspacing="3">
                                        <tr>
                                            <td height="20" colspan="2"  class="signin" align="left" valign="top">Forgot Password</td>
                                        </tr>
													 <tr id="smsgrow" style="display:none">
														  <td height="35"  colspan="2" align="center"><div id="smsg" class="reqmsg"></div></td>
													 </tr>
													 <tr id="fmsgrow" style="display:none">
                                            <td height="35"  colspan="2"  align="center"><div id="fmsg" class="reqmsg" ></div></td>
                                        </tr>
                                        <tr id="funame">
                                            <td width="31%" align="right" class="blue-textbold">Username: </td>
                                            <td width="69%" align="left">
                                                <input type="text" id="vFUserName" name="vFUserName"  size="24" value=""/>
                                            </td>
                                        </tr>
										<tr id="funamebtn">
                                            <td>&nbsp;</td>
											<td height="55" valign="bottom"  class="errormsg" align="left"><a href="#" onclick="checkUname('uname');return false" style="cursor:pointer"><input type="Image" src="<?php  echo  ADMIN_IMAGES?>btn-send.gif" alt="" border="0" /></a></td></td>
                                        </tr>
										</table>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="10"><img src="<?php  echo  ADMIN_IMAGES?>login-bottleftcorner.gif" width="10" height="17" /></td>
                                    <td width="183" class="loginbottbg">&nbsp;</td>
                                    <td width="25"><img src="<?php  echo  ADMIN_IMAGES?>login-bottcurve.gif" width="25" height="39" /></td>
                                    <td width="141" class="loginbottbg1">&nbsp;</td>
                                    <td valign="bottom"><img src="<?php  echo  ADMIN_IMAGES?>login-bottrightcorner.gif" /></td>
                                </tr>
                                </table>

                            </td>
                        </tr>
                        </table>
                    </div>
					<div id="divseqques" style="display:none">
                        <table width="100%" border="0" class="login-greymatter" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="26%" height="60" align="right" valign="top"><img src="<?php  echo  ADMIN_IMAGES?>login-icon1.gif" width="49" height="48" hspace="11" /></td>
                             <td width="74%" valign="top"><strong>Enter your Answer </strong> to get the  Password .</td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top">
                                <table cellpadding="0" align="center"  cellspacing="0" border="0" width="367">
                                <tr>
                                    <td width="10"><img src="<?php  echo  ADMIN_IMAGES?>login-topleftcorner.gif" width="10" height="9" /></td>
                                    <td colspan="3" width="100%" class="logintopborder"></td>
                                    <td width="10"><img src="<?php  echo  ADMIN_IMAGES?>login-toprightcorner.gif" width="10" height="9" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="loginleftrightborder" height="175" valign="top">
                                        <table width="90%" class="login-greymatter" border="0" align="center" cellpadding="3" cellspacing="3">
                                        <tr>
                                            <td height="20" colspan="2"  class="signin" align="left">Security Question</td>
                                        </tr>
										<tr id="smsgrow" style="display:none">
                                            <td height="35"  colspan="2" align="center"><div id="smsg" class="reqmsg"></div></td>
                                        </tr>
										<tr id="seqinfo">
											<td>
												<table width="100%" cellpadding="3" cellspacing="3">
													<tr>
			                                            <td width="35%" align="right" class="blue-textbold" valign="top">Question &nbsp;: </td>
			                                            <td width="65%" align="left" valign="top">
			                                               <div id="vquest" ></div>
														</td>
			                                        </tr>
													<tr>
			                                            <td  align="right" class="blue-textbold"> Your Answer&nbsp;: </td>
			                                            <td  align="left">
			                                                <input type="text" id="vAnswer" name="vAnswer"  size="30" value=""/>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td>&nbsp;</td>
			                                            <td height="30" align="left"><a href="#" title="Login" onclick="checkUname('seqque');return false"><input type="Image" src="<?php  echo  ADMIN_IMAGES?>btn-send-o.gif" border="0" alt="" /></a></td>
			                                        </tr>
												</table>
											</td>
										</tr>

										</table>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="10"><img src="<?php  echo  ADMIN_IMAGES?>login-bottleftcorner.gif" width="10" height="17" /></td>
                                    <td width="183" class="loginbottbg">&nbsp;</td>
                                    <td width="25"><img src="<?php  echo  ADMIN_IMAGES?>login-bottcurve.gif" width="25" height="39" /></td>
                                    <td width="141" class="loginbottbg1">&nbsp;</td>
                                    <td valign="bottom"><img src="<?php  echo  ADMIN_IMAGES?>login-bottrightcorner.gif" /></td>
                                </tr>
                                </table>
							</td>
                        </tr>
                        </table>
                    </div>
					</td>
                </tr>
                </table>
            </td>
        </tr>
        </table>
    </td>
</tr>
</table>
</div>
</form>
<script>
$(document).ready(function () {
	set();
});
function set()
{
	$('#divSignin').slideDown('slow');
	setTimeout("$('#vUserName').focus();",1000);
}

function openFpass(){
	$('#divSignin').slideUp('slow');;
	setTimeout("showFPass();",1000);
}
function showFPass(){
	$('#fpass').html("<a title='Back to Login' class='redlink-big' href='index.php'>Back to Login</a>");
	$('#divforgotpass').slideDown('slow');
}
function seqques(){
	$('#divforgotpass').slideUp('slow');
	setTimeout("showseqQues();",1000);
}
function showseqQues(){
	$('#divseqques').slideDown('slow');
}
</script>
