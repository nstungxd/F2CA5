<div class="midd-left-width">
   <div style="padding-left:10px;">
     <div class="midd-right-width">
 <div id="msg" class="msg">{$msg}</div>
   <div id="signup" class="security-bg">
      <div class="organization"><a style="display-inline-block; width:97%;"><img src="{$SITE_IMAGES}h&n-32x34.jpg"  alt="" border="0"  class="valignmidd" /> &nbsp; {$LBL_LOGIN_INFO}</a></div>
         <div id="login_msg" class="errormsg"></div>
         <div class="user">
            <form name="frmsignin" id="frmsignin" method="post">
            <div class="username">{$LBL_COMP_CODE} :</div>
            <div class="user-input-bg">
               <input type="text" name="orgcode" id="orgcode" class="user-input" style="width:90%;" onkeypress="return chkEnter(event,'','chkLogin(\'login\')')" tabindex="1"/>
            </div>
            <div class="username">{$LBL_USERNAME}   :</div>
            <div class="user-input-bg">
               <input type="text" name="username" id="username" class="user-input" style="width:90%;" value="{$smarty.cookies.b2b_usr}" onkeypress="return chkEnter(event,'','chkLogin(\'login\')')" tabindex="2" />
            </div>
            <div class="username">{$LBL_PASSWORD}    :</div>
            <div class="user-input-bg">
               <input type="password" name="password" id="password" class="user-input" style="width:90%;" value="{$gobj->decrypt($smarty.cookies.b2b_pswd)}" onkeypress="return chkEnter(event,'','chkLogin(\'login\')')" tabindex="3"/>
            </div>
            <div class="username">{$LBL_LOGIN_PARAMETER}    :</div>
            <div class="user-input-bg">
               <input type="text" name="loginParameter" id="loginParameter" class="user-input" style="width:90%;" onkeypress="return chkEnter(event,'','chkLogin(\'login\')')" tabindex="4"/>
            </div>
            <div class="remember">
               <label><input name="remember" id="remember" type="checkbox" value="me" class="valignmidd" {if $smarty.cookies.b2b_usr neq ''}checked="checked"{/if} tabindex="4"/>{$LBL_REMEMBER_ME} &nbsp; </label> &nbsp; &nbsp; &nbsp;
               &nbsp; &nbsp; &nbsp; <span class="pointer"><img src="{$SITE_IMAGES}btn-login.gif" alt="" border="0" class="valignmidd" onclick="return chkLogin('login');" tabindex="5" onkeypress="return chkEnter(event,'yes','chkLogin(\'login\')')" /></span>
            </div>
            <div class="forget-pass"><span><a href="{$SITE_URL_DUM}orgregister" class="forget-pass">{$LBL_REGISTER_ORGANIZATION}</a></span> &nbsp;<span class="pointer"><a {*href="$SITE_URL_DUM}forgotpass"*} onclick="fplogin('fp');" class="forget-pass" tabindex="6">{$LBL_FORGOT_PASSWORD}?</a></span></div>
            <div style="height:3px;">&nbsp;</div>
            </form>
         </div>
   </div>
   <div id="forgot_password" class="security-bg" style="display:none;">
      <div class="organization"><a><img src="{$SITE_IMAGES}help.png"  alt="" border="0"  class="valignmidd iconsize" /> &nbsp; {$LBL_FORGOT_PASSWORD}</a></div>
      <div id="fp_msg" class="errormsg"></div>
      <div class="user">
         <form name="frmsignin" id="frmsignin" method="post">
         <div class="username">{$LBL_COMP_CODE} :</div>
         <div class="user-input-bg">
            <input type="text" name="orcode" id="orcode" class="user-input" onkeypress="return chkEnter(event,'','forgotPass()')" style="width:90%;" tabindex="1" />
         </div>
         <div class="username">{$LBL_USERNAME}   :</div>
         <div class="user-input-bg">
            <input type="text" name="usrname" id="usrname" class="user-input" onkeypress="return chkEnter(event,'','forgotPass()')" style="width:90%;" value="" tabindex="2"/>
         </div>
         <div class="remember" style="height:30px;">
            <span class="pointer" style="float:right;"> &nbsp; &nbsp; &nbsp; <img src="{$SITE_IMAGES}btn-send.gif" alt="" border="0" class="valignmidd" onclick="return forgotPass();" onkeypress="return chkEnter(event,'yes','forgotPass()')" tabindex="3"/></span>
         </div>
         <div class="forget-pass"><span class="pointer"><a onclick="fplogin('lg');" class="forget-pass">{$LBL_BACK_LOGIN}</a></span></div>
         <div style="height:3px;">&nbsp;</div>
         </form>
	   </div>
   </div>
	</div>
	<div style="height:10px;">&nbsp;</div>
		{$homecontent}
   </div>
   <div>&nbsp;</div>
</div>
<script type="text/javascript" src="{$SITE_JS_AJAX}jsignin.js"></script>
<!--<script type="text/javascript" src="{$SITE_JS_AJAX}jforgotpassword.js"></script>-->
<!--<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>-->
{literal}
<script type="text/javascript">
//$("#frmsignin").validate();
function fplogin(vl)
{
   if(vl == 'fp')
   {
      $('#signup').fadeOut(900, function (){
         $('#forgot_password').fadeIn('slow');
      });
      $('#orcode').focus();
   }else{
      $('#forgot_password').fadeOut(900, function (){
         $('#signup').fadeIn('slow');
      });
   }
}
function chkEnter(events,space,frm)
{
   var unicodes=events.charCode? events.charCode :events.keyCode;

	if(unicodes == 13 ) {
		return eval(frm); // chkLogin('login');
   }
   
	if(space == 'yes') {
		if(unicodes == 32 )
			return eval(frm);	//chkLogin('login');
   }
    // return true;
}
</script>
{/literal}