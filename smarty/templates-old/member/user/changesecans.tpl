<div id="Password_details">
<h3 align="center"><b>{$LBL_ANS_TO_SEC_QUES}</b></h3>
<form id="chpas" name="chpas" method="post" action="">
<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}" />
<input type="hidden" name="qnum" id="qnum" value="{$num}" />

<div style="padding-left:30px;">
	<div>
		<label class="lbl" for="pass" style="width:150px;font-size: 14px">{$LBL_SEC_QUESTION}</label>
      <label>:</label>
		{$ques}
	</div>
	<div>
		<label class="lbl" for="pass" style="width:150px;font-size: 14px">Answer</label>
		<label>:</label>
      <input type="text" name="answer" id="answer" class="required" value="" style="width:210px;" title="{$LBL_ENTER_ANS}" >
	</div>
	<br/>
	<div>
		<label class="lbl" style="width:150px;">&nbsp;</label>
		<img src="{$SITE_IMAGES}/btn-submit.gif" alt="Save" name="save" value="Save" id="save" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#chpas').submit();" />
	</div>
</div>
</form>
</div>
<script language="JavaScript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript">
$("#chpas").validate();
</script>
{/literal}