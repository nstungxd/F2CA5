<div class="left-menu">
   <h1>{$LBL_NAVIGATION}</h1>
   <dl>{$LBL_DASHBOARD}</dl>
   <ul {if '/(.*)(smdashboard)(.*)/'|preg_match:$currentUrl || '/(.*)(inbox)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
   <li><a href="{$SITE_URL_DUM}smdashboard" {if '/(.*)(smdashboard)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_DASHBOARD}</a></li>
   <li><a href="{$SITE_URL_DUM}inbox" {if '/(.*)(inbox)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_INBOX} <strong>({$totInboxres})</strong></a></li>
   </ul>

   <dl>{$LBL_ORGANIZATION}</dl>
   {assign var="linkurl" value=$SITE_URL_DUM|cat:'createorganization/'}
   {*}<ul {if $currentUrl eq $SITE_URL_DUM|cat:'createorganization' || $currentUrl eq $SITE_URL_DUM|cat:'organizationlist' || $currentUrl eq $SITE_URL_DUM|cat:'verifyorganization' || $currentUrl eq $SITE_URL_DUM|cat:'verifyorgpreflist'} {else}style="display:none;"{/if}>{*}
   <ul {if ('/(.*)(createorganization)(.*)/'|preg_match:$currentUrl && $currentUrl eq $SITE_URL_DUM|cat:'createorganization') || '/(.*)(organizationlist)(.*)/'|preg_match:$currentUrl || '/(.*)(createorganizationpref)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationview)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationprefview)(.*)/'|preg_match:$currentUrl || ('/(.*)(verifyorganization)(.*)/'|preg_match:$currentUrl && $currentUrl eq $SITE_URL_DUM|cat:'verifyorganization')} {else}style="display:none;"{/if}>
   {*}<li><a href="{$SITE_URL_DUM}createorganization" {if $currentUrl eq $SITE_URL_DUM|cat:'createorganization'}class="active"{/if}>{$LBL_CREATE_MODIFY}</a></li>{*}
   <li><a href="{$SITE_URL_DUM}createorganization" {if ('/(.*)(createorganization)(.*)/'|preg_match:$currentUrl && $currentUrl eq $SITE_URL_DUM|cat:'createorganization') || '/(.*)(createorganizationpref)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationview)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationprefview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_CREATE_MODIFY}</a></li>
   <li><a href="{$SITE_URL_DUM}organizationlist" {if '/(.*)(organizationlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_ORG_LIST}</a></li>
   <li><a href="{$SITE_URL_DUM}verifyorganization" {if '/(.*)(verifyorganization)(.*)/'|preg_match:$currentUrl && $currentUrl eq $SITE_URL_DUM|cat:'verifyorganization'}class="active"{/if}>{$LBL_VERIFY_ORG}</a></li>
   {*}<li><a href="{$SITE_URL_DUM}verifyorgpreflist" {if $currentUrl eq $SITE_URL_DUM|cat:'verifyorgpreflist'}class="active"{/if}>{$LBL_VERIFY_PREFERENCES}</a></li>{*}
   </ul>

   <dl>{$LBL_ASSOCIATION}</dl>
   <ul {if '/(.*)(createassociation)(.*)/'|preg_match:$currentUrl || '/(.*)(associationview)(.*)/'|preg_match:$currentUrl || '/(.*)(associationlist)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
   <li><a href="{$SITE_URL_DUM}createassociation" {if '/(.*)(createassociation)(.*)/'|preg_match:$currentUrl || '/(.*)(associationview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_CREATE_MODIFY}</a></li>
   {assign var="linkurl" value=$SITE_URL_DUM|cat:'associationlist/'}
   <li><a href="{$SITE_URL_DUM}associationlist" {if '/(.*)(associationlist)(.*)/'|preg_match:$currentUrl && $currentUrl eq $SITE_URL_DUM|cat:'associationlist'}class="active"{/if}>{$LBL_ASSO_LIST}</a></li>
   <li><a href="{$SITE_URL_DUM}verifyassociationlist" {if '/(.*)(verifyassociationlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY_ASSOCIATION}</a></li>
   </ul>

   {if $ENABLE_AUCTION eq 'Yes'}
   <dl>{$LBL_NEW_ASSOCIATIONS}</dl>
   <ul {if '/(.*)(b2)(.*)(asoc)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
   <ld>{$LBL_BUYER2} {$LBL_PRODUCT} <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
   <li><a href="{$SITE_URL_DUM}b2bprodtasoclist" {if ('/(.*)(b2bprodtasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2bprodtasocvlist')===false) || '/(.*)(b2bprodtasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2bprodtasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_BPRODUCT}</a></li>
   <li><a href="{$SITE_URL_DUM}b2bprodtasocvlist" {if '/(.*)(b2bprodtasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_BPRODUCT}</a></li>
   <li><a href="{$SITE_URL_DUM}b2sprodtasoclist" {if ('/(.*)(b2sprodtasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2sprodtasocvlist')===false) || '/(.*)(b2sprodtasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2sprodtasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_SPRODUCT}</a></li>
   <li><a href="{$SITE_URL_DUM}b2sprodtasocvlist" {if '/(.*)(b2sprodtasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_SPRODUCT}</a></li>
   <br/>
   <ld>{$LBL_BUYER2} {$LBL_BUYER} {$LBL_SUPPLIER} <span style="float:right; display:inline-block; width:50px; height:30px;">&nbsp;</span></ld>
   <li><a href="{$SITE_URL_DUM}b2buyerasoclist" {if ('/(.*)(b2buyerasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2buyerasocvlist')===false) || '/(.*)(b2buyerasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2buyerasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_BUYER}</a></li>
   <li><a href="{$SITE_URL_DUM}b2buyerasocvlist" {if '/(.*)(b2buyerasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_BUYER}</a></li>
   <li><a href="{$SITE_URL_DUM}b2supplierasoclist" {if ('/(.*)(b2supplierasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2supplierasocvlist')===false) || '/(.*)(b2supplierasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2supplierasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_SUPPLIER}</a></li>
   <li><a href="{$SITE_URL_DUM}b2supplierasocvlist" {if '/(.*)(b2supplierasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_SUPPLIER}</a></li>
   <br/>
   <ld>{$LBL_BUYER2} {$LBL_PRODUCT} {$LBL_BUYER} {$LBL_SUPPLIER} <span style="float:right; display:inline-block; width:10px; height:30px;">&nbsp;</span></ld>
   <li><a href="{$SITE_URL_DUM}b2bprdtbasoclist" {if ('/(.*)(b2bprodtbasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2bprdtbasocvlist')===false) || '/(.*)(b2bprdtbasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2bprodtbasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_BPRODUCT_BUYER}</a></li>
   <li><a href="{$SITE_URL_DUM}b2bprdtbasocvlist" {if '/(.*)(b2bprdtbasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_BPRODUCT_BUYER}</a></li>
   <li><a href="{$SITE_URL_DUM}b2sprdtsasoclist" {if ('/(.*)(b2sprodtsasoc)(.*)/'|preg_match:$currentUrl && strpos($currentUrl,'b2sprdtsasocvlist')===false) || '/(.*)(b2sprdtsasoclist)(.*)/'|preg_match:$currentUrl || '/(.*)(b2sprodtsasocview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_BUYER2_SPRODUCT_SUPPLIER}</a></li>
   <li><a href="{$SITE_URL_DUM}b2sprdtsasocvlist" {if '/(.*)(b2sprdtsasocvlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_BUYER2_SPRODUCT_SUPPLIER}</a></li>
   </ul>
   {/if}

   <dl>{$LBL_USER}</dl>
   <ul {if '/(.*)(createorganizationuser)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationuserview)(.*)/'|preg_match:$currentUrl || '/(.*)(userrights)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationuserlist)(.*)/'|preg_match:$currentUrl || '/(.*)(assignrights)(.*)/'|preg_match:$currentUrl || '/(.*)(creategroup)(.*)/'|preg_match:$currentUrl || '/(.*)(grouplist)(.*)/'|preg_match:$currentUrl || '/(.*)(groupview)(.*)/'|preg_match:$currentUrl || '/(.*)(verifyrights)(.*)/'|preg_match:$currentUrl || '/(.*)(listrights)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
   <li><a href="{$SITE_URL_DUM}createorganizationuser" {if '/(.*)(createorganizationuser)(.*)/'|preg_match:$currentUrl || '/(.*)(organizationuserview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_CREATE_USER}</a></li>
   {assign var="linkurl" value=$SITE_URL_DUM|cat:'organizationuserlist'}
   <li><a href="{$SITE_URL_DUM}organizationuserlist" {if $currentUrl|strpos:$linkurl !== false}class="active"{/if}>{$LBL_USER_LIST}</a></li>
   <li><a href="{$SITE_URL_DUM}verifyorganizationuserlist" {if '/(.*)(verifyorganizationuserlist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY_USER}</a></li>
   <li><a href="{$SITE_URL_DUM}assignrights" {if '/(.*)(assignrights)(.*)/'|preg_match:$currentUrl || '/(.*)(userrights)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_ASSIGN_RIGHTS_USER}</a></li>
   {*}{*}<li><a href="{$SITE_URL_DUM}listrights" {if '/(.*)(listrights)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_USER_RIGHTS}</a></li>{*}{*}
   {*}{*}<li><a href="{$SITE_URL_DUM}verifyrights" {if '/(.*)(verifyrights)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY_USER_RIGHTS}</a></li>{*}{*}
   <li><a href="{$SITE_URL_DUM}creategroup" {if '/(.*)(creategroup)(.*)/'|preg_match:$currentUrl || '/(.*)(groupview)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_CREATE_GROUP}</a></li>
   {assign var="linkurl" value=$SITE_URL_DUM|cat:'grouplist'}
   <li><a href="{$SITE_URL_DUM}grouplist" {if $currentUrl|strpos:$linkurl !== false}class="active"{/if}>{$LBL_GROUP_LIST}</a></li>
   <li><a href="{$SITE_URL_DUM}verifygrouplist" {if '/(.*)(verifygrouplist)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_VERIFY} {$LBL_GROUP}</a></li>
   {*}<li><a href="{$SITE_URL_DUM}assigngrouprights">{$LBL_ASSIGN_RIGHTS_GROUP}</a></li>{*}
   </ul>

   <dl id='pf'>{$LBL_REPORTS}</dl>
   <ul {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
      <li><a href="{$SITE_URL_DUM}reportsrpt" {if '/(.*)(reportsrpt)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_REPORTS}</a></li>
   </ul>

   <dl>{$LBL_PREFERENCE}</dl>
   <ul {if '/(.*)(editprofile)(.*)/'|preg_match:$currentUrl || '/(.*)(changepass)(.*)/'|preg_match:$currentUrl || '/(.*)(logout)(.*)/'|preg_match:$currentUrl} {else}style="display:none;"{/if}>
   <li><a href="{$SITE_URL_DUM}editprofile" {if '/(.*)(editprofile)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_EDIT_PROFILE}</a></li>
   <li><a href="{$SITE_URL_DUM}changepass/{$iUserId}" onmouseover="CallColoerBox(this.href,630,315,'file');" {if '/(.*)(changepass)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_CHANGE_PASSWORD}</a></li>
   <li><a href="{$SITE_URL_DUM}logout" {if '/(.*)(logout)(.*)/'|preg_match:$currentUrl}class="active"{/if}>{$LBL_LOGOUT}</a></li>
   </ul>
</div>
{literal}
<script type="text/javascript" async="async">
var curURl = '{/literal}{$currentUrl}{literal}';
/*
$('.left-menu ul').each(function(){
    var chkSel =0;
    $(this).children('li').each(function(){
       if($(this).children('a').attr('href') == curURl){
         $(this).children('a').addClass('active');
         chkSel++;
       }else{
         $(this).children('a').removeClass('active');
       }
    });
   if(chkSel > 0){
      $(this).show();
   }else{
      $(this).hide();
   }
});
*/
/*$('.left-menu ul').children('li').children('a').click(function(){
   urlhref = $(this).attr('href');
   if(urlhref.search('changepass') != -1)
       return true;

   url = SITE_URL_DUM+"session.php?seturl="+urlhref;
   pars='';
   $.post(url, pars, function(resp){
      //alert(resp);
      if(resp !='ok'){
         return false;
      }else{
         window.location = urlhref;
      }
   });
   return false;
   //$('#mid_content').load(url);
})
*/
//$('.left-menu dl').each(function(){
//   $(this).click(function(){
      //alert($(this).next('ul').attr('style'));
//      $(this).next('ul').toggle('slow');
      /*if($(this).next('ul').attr('style') == 'display: none;' || $(this).next('ul').attr('style') == 'DISPLAY: none'){
         $(this).next('ul').show('slow');
      }else{
         $(this).next('ul').hide('slow');
      }*/
//   });
// });
</script>
{/literal}