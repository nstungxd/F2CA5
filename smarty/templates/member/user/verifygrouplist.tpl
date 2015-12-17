<div class="middle-container">
<h1><span class="">{$LBL_VERIFY_GROUP_LIST}</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
<div class="inner-white-bg">
   <div><h2>{$LBL_SEARCH}</h2></div>
   <div class="inport-gray-bg">
        {if $msg neq ''}
                    {*<div class="msg">{$msg}</div>*}
                    {*literal}
                    <script>
                    $(document).ready(function() {
                         var msg='{/literal}{$msg}{literal}';
                         if(msg!= '' && msg != undefined)
                         alert(msg);
                    });
                    </script>
                    {/literal*}
                    {/if}
      <div class="import-border">&nbsp;{$LBL_SEARCH} : &nbsp; &nbsp; &nbsp; &nbsp;
         <input type="text" name="search_text" class="input-rag" id="search_text" style="width:190px; vertical-align:middle;" />
         &nbsp; <input type="image" src="{$SITE_IMAGES}sm_images/btn-go.gif"  alt=""  style="cursor: pointer; vertical-align:middle;border: none;background: #f8f8f8;" onclick="getgrouplist('all',1)" />
      </div>
      <div  style="padding:5px;">
         <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
               <td width="17%">{$LBL_ORG_NAME} : </td>
               <td width="30%"><span class="import-border">
               <input type="text" name="org_name" class="input-rag" id="org_name" style="width:177px; vertical-align:middle;" />
               </span></td>
               <td width="17%">{$LBL_GROUP_NAME} :</td>
               <td width="36%"><span class="import-border">
                  <input type="text" name="grp_name" id="grp_name" class="input-rag" style="width:177px; vertical-align:middle;" />
               </span>
                    &nbsp; <input type="image" src="{$SITE_IMAGES}sm_images/btn-go.gif" alt=""   style="cursor: pointer; vertical-align:middle;border: none;background: #f8f8f8;" onclick="getgrouplist('srch',1)" />
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
                    <td width="188" align="left" style="padding-left:2px;"><a href="javascript:getgrouplist('all','1','vCompanyName')"><strong>Organization Name</strong></a></td>
                    <td width="189" align="left">&nbsp;<a href="javascript:getgrouplist('all','1','vGroupName')"><strong>Group Name</strong></a></td>
                    <td width="59" align="center"><a href="javascript:getgrouplist('all','1','eCreatedBy')"><strong>Created By</strong></a></td>
                    <td width="62" align="center"><a href="javascript:getgrouplist('all','1','grp.eStatus')"><strong>Status</strong></a></td>
                    <td width="94" align="center">Action</td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
					<input type="hidden" name="mod" id="mod" value="" />
					<div id="grouplist"><input type="hidden" name="pg" id="pg" value="1"/></div>
            </td>
         </tr>
      </table>
      </div>
   </div>
   </div>
</div>
<input type="hidden" name="m" id="m" value="" />
</div>
<script type="text/javascript" src="{$SITE_JS_AJAX}jverifylistgroup.js"></script>
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