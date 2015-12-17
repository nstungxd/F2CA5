<!--<script type="text/javascript" src="{$DATETIMEPICKER}jquery.dynDateTime.js"></script>
<script type="text/javascript" src="{$DATETIMEPICKER}lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER}css/calendar-blue.css" />-->
<div class="middle-container">
<h1><span class="">{$LBL_INBOX}</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
<div class="inner-white-bg">
   <div>
      <div><h2>{$LBL_SEARCH}</h2></div>
      <div class="inport-gray-bg">
         <div style=" padding-top:2px;">
            <strong>Search By Subject : </strong><input type="text" name="search_key" id="search_key" value="" style="width:150px;" />
         </div>
         <div style=" padding-top:2px;">
            <strong>From : </strong><input type="text" name="from" id="from" value="" style="width:139px;" /> &nbsp; {*<img src="{$SITE_IMAGES}sm_images/icon-calander.gif" />*} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <strong>To : </strong><input type="text" name="to" id="to" value="" style="width:139px;" /> &nbsp; {*<img src="{$SITE_IMAGES}sm_images/icon-calander.gif"/>*} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp; <input type="image" src="{$SITE_IMAGES}sm_images/btn-go.gif" alt=""  style="cursor: pointer; vertical-align:middle;background: #f8f8f8;border:none;" onclick="getgrouplist('srch',1,'')" />
         </div>
      </div>

      <div style="height:25px; padding-right:10px; padding-top:7px;" align="center">
           <span id="dispmsg" style="font-size: 15px;font-weight: bold;color: red;">
           </span>

           <img src="{$SITE_IMAGES}sm_images/btn-delete-1.gif"  align="right" alt="" border="0" style="cursor:pointer;" onclick="Delete('deleteall','')"/>
      <span id="updating" style="display: none;float: right;padding-right:5px">
           <img src="{$SITE_IMAGES}sm_images/progress.gif" alt="" style="vertical-align:middle;" />&nbsp;Processing
          </span>

      </div>
      <div class="light-golden-bor">
         <table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
            <tr>
            <td class="listing-sky-blue">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="2" height="26" align="center">
                     <input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" /></td>
                    <td width="158" align="left">{$LBL_SUBJECT}</td>
                    <td width="119" align="center">{$LBL_DATE}</td>
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
</div>
<script type="text/javascript" src="{$SITE_JS_AJAX}jlistinbox.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery-ui-timepicker.js"></script>
{literal}
<script type="text/javascript">
jQuery(document).ready(function() {
	$("#from").attr('readonly','readonly');
	$("#from").datetimepicker({
		  dateFormat: 'yy-mm-dd',
		  timeFormat: 'hh:mm:ss',
		  showOn: "both",
		  buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) {
				$(document).ready(function(dateText, inst) {
					 var ead = 10;
					 $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
				});
		  },
		  onClose: function() {
				$(document).ready(function(dateText, inst) {
					 var ead = 10;
					 $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
				});
		  }
	});
	//
	$("#to").attr('readonly','readonly');
	$("#to").datetimepicker({
		  dateFormat: 'yy-mm-dd',
		  timeFormat: 'hh:mm:ss',
		  showOn: "both",
		  buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) {
				$(document).ready(function(dateText, inst) {
					 var ead = 10;
					 $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
				});
		  },
		  onClose: function() {
				$(document).ready(function(dateText, inst) {
					 var ead = 10;
					 $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
				});
		  }
	});
	/*jQuery("#from").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d %H:%M:00",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings('.dtcDisplayArea')"
	});
	jQuery("#to").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d %H:%M:00",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings('.dtcDisplayArea')"
	});*/
});
/*
Date.format = 'yyyy-mm-dd';
//dateFormat: 'yy-mm-dd',
//Date.timeFormat= ' hh:ii:ss';
$("#from").attr('readonly','readonly');
$('#from').datePicker({startDate:'2001-01-01'});
$("#to").attr('readonly','readonly');
$('#to').datePicker({startDate:'2001-01-01'});
*/
</script>
{/literal}