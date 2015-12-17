{assign var="field" value="vMailSubject_"|cat:$LANG}
{assign var="fielddesc" value="tMailContent_"|cat:$LANG}
<div class="middle-container">
       <h1>{$LBL_INBOX}</h1>
       <div class="middle-containt">
       <div class="statistics-main-box-white">
       <div class="clear"></div><div class="inner-gray-bg">
            	<div>&nbsp;</div>
                <div>
                    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                    <tr>
                      <td width="60" valign="top">{$LBL_SUBJECT}&nbsp; :</td>
                      <td>
                        {$res[0].$field}
                      </td>
                    </tr>
                    <tr>
                      <td valign="top">{$LBL_DATE}&nbsp; :</td>
                      <td>{$res[0].dActionDate|Time_Format}</td>
                    </tr>
                    <tr>
                      <td valign="top">{$LBL_CONTENT}&nbsp; :</td>
                      <td>
                        {$res[0].$fielddesc}
                      </td>
                    </tr>
                    </table>
						  <div align="center"><img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" /></div>
                </div>
                <div>&nbsp;</div>
            </div>
       </div>
       </div>
     </div>
</form>