<div class="middle-container">
     <h1><span class="">{$LBL_USER_LIST}</span></h1> <!-- blue-hadd-bg -->
     <div class="middle-containt">
          <div class="inner-white-bg">
               <div><h2>{$LBL_SEARCH}</h2></div>
               <div class="inport-gray-bg">
                    {if $msg neq ''}{*<div class="msg">{$msg}</div>*}
                    {*literal}
                    <script>
                    $(document).ready(function() {
                         var msg='{/literal}{$msg}{literal}';
                         if(msg!= '' && msg != undefined)
                         alert(msg);
                    });
                    </script>
                    {/literal}<div class="msg">{$msg}</div>{*}
                    {/if}
                    <div class="import-border">&nbsp;{$LBL_SEARCH} : &nbsp; &nbsp; &nbsp; &nbsp;
                         <input type="text" name="search_text" class="input-rag" id="search_text" style="width:190px; vertical-align:middle;" />
                         &nbsp; <input type="image" src="{$SITE_IMAGES}sm_images/btn-go.gif"  alt="" border="0" style="cursor: pointer; vertical-align:middle;background: #f8f8f8;border:none;" onclick="getuserlist('all',1)" />
                    </div>
                    <div  style="padding:5px;">
                         <table width="100%" border="0" cellspacing="2" cellpadding="2">
                              <tr>
                                   <td width="17%">{$LBL_ORGANIZATION} </td>
                                   <td>:</td>
                                   <td width="30%">
                                        <span class="import-border">
                                        <input type="text" name="vCompanyName" id="vCompanyName" class="input-rag" style="width:177px; vertical-align:middle;" />

                                        </span>
                                   </td>
                                   <td width="17%">{$LBL_USER_NAME} </td>
                                   <td>:</td>
                                   <td width="36%"><span class="import-border">
                                             <input type="text" name="vUserName" class="input-rag" id="vUserName" style="width:177px; vertical-align:middle;" />
                                        </span></td>
                              </tr>
                              <tr>
                                   <td>{$LBL_USER_TYPE}  </td>
                                   <td>:</td>
                                   <td>
                                        {$userTypes}
                                   </td>
                                   <td>{$LBL_EMAIL}</td>
                                   <td>:</td>
                                   <td>

                                        <input type="text" name="vEmail" id="vEmail" class="input-rag" style="width:177px; vertical-align:middle;" />
                                        <!--<select name="org_type" id="org_type" class="drop-down" style="width:179px;">
                                        <option value="">---Select---</option>
                                        </select>-->
                                   </td>

                              </tr>
                              <tr>
                                   <td> {$LBL_COUNTRY}</td>
                                   <td>:&nbsp;</td>
                                   <td colspan="3">

                                        <select name="vCountry" id="vCountry" class="drop-down" style="width:179px; vertical-align:middle;">
                                             <option value="">---Select---</option>
                                             {section name=i loop=$countries}
                                             <option value="{$countries[i].vCountryCode}">{$countries[i].vCountry}</option>
                                             {/section}
                                        </select>
                                        &nbsp; <input type="image" src="{$SITE_IMAGES}sm_images/btn-go.gif" alt="" border="0"  style="cursor: pointer; vertical-align:middle;border: none;background: #f8f8f8;" onclick="getuserlist('srch',1)" />
                                   </td>

                              </tr>
                         </table>
                    </div>
               </div>
               <div>
                    <div style="height:25px;" align="right">
                         <span id="updating" style="display: none; padding-bottom: 7px;"><img src="{$SITE_IMAGES}sm_images/progress.gif" alt="" /><a style="vertical-align:top;">Processing</a></span>
                         <span id="dispmsg" class="msg"></span></div>
                    <div class="light-golden-bor">
                         <table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
                              <input type="hidden" name="cursort" id="cursort" value="" />
                              <input type="hidden" name="cursorttype" id="cursorttype" value="" />
                              <tr>
                                   <td class="listing-sky-blue">
                                        <table width="100%" border="0" cellspacing="1" cellpadding="0">
                                             <tr>
                                             <!--<td width="30" height="26" align="center"><input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" /></td>-->
                                                  <td width="158" align="left" style="padding-left:2px;"><a href="javascript:getuserlist('all','1','vFirstName')"><strong>User Name</strong></a></td>
                                                  <td width="100" align="center" style="padding-left:2px;"><a href="javascript:getuserlist('all','1','org.vCompanyName')"><strong>Org. Name</strong></a></td>
                                                  <td width="119" align="center"><a href="javascript:getuserlist('all','1','ou.vEmail')"><strong>Email Id</strong></a></td>
                                                  <td width="100" align="center"><a href="javascript:getuserlist('all','1','ou.eUserType')"><strong>User Type</strong></a></td>
                                                  <td width="80" align="center"><a href="javascript:getuserlist('all','1','cm.vCountry')"><strong>Country</strong></a></td>
                                                  <td width="62" align="center"><a href="javascript:getuserlist('all','1','ou.eStatus')"><strong>Status</strong></a></a></td>
                                                  <td width="94" align="center">Action</td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td>
                                       <div id="userlist"><input type="hidden" name="pg" id="pg" value="1"/></div>
                                       <input type="hidden" name="mod" id="mod" value="" />
                                   </td>
                              </tr>
                         </table>
                    </div>
               </div>
          </div>
     </div>
<input type="hidden" name="m" id="m" value="" />
</div>
<script type="text/javascript" src="{$SITE_JS_AJAX}jverifylistusers.js"></script>
{if $msg neq ''}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	var msg='{/literal}{$msg}{literal}';
	if(msg!= '' && msg != undefined && $('#m').val()!=msg) {
		alert(msg);
		$('#m').val(msg);
	}
});
</script>
{/literal}
{/if}