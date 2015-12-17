<?php /* Smarty version 2.6.0, created on 2015-06-26 12:04:35
         compiled from member/reportsrptpop.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'member/reportsrptpop.tpl', 8, false),array('modifier', 'is_array', 'member/reportsrptpop.tpl', 16, false),array('modifier', 'count', 'member/reportsrptpop.tpl', 16, false),)), $this); ?>
<div>
<div class="middle-container">
	<h1><?php echo $this->_tpl_vars['LBL_REPORTS']; ?>
</h1>
	<div class="middle-containt" >
		<div class="statistics-main-box-white">
			<div class="clear"></div>
			<div class="inner-gray-bg" style="height:361px;">
            	<div align="center"><h3><?php if (((is_array($_tmp=$this->_tpl_vars['inetserverurl'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) == ''): ?><br/><?php echo $this->_tpl_vars['LBL_INET_SERVER_URL_UNAVAILABLE']; ?>
<br/><br/><?php endif; ?></h3></div>
					<?php if (((is_array($_tmp=$this->_tpl_vars['inetserverurl'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
               <div>
					<form id="frmrpt" name="frmrpt" method="post" action="<?php echo $this->_tpl_vars['inetserverurl']; ?>
">
					<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
						<tr>
							<td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_AVAILABLE']; ?>
 <?php echo $this->_tpl_vars['LBL_REPORT']; ?>
 &nbsp; * : </td>
							<td>
								<?php if (((is_array($_tmp=$this->_tpl_vars['rptfls'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['rptfls']) > 0): ?>
								<select id="rptfile" name="report">
								<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['rptfls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
									<option id="<?php echo $this->_tpl_vars['rptfls'][$this->_sections['l']['index']]['iReportId']; ?>
" lp="<?php echo $this->_sections['l']['index']; ?>
" value="<?php echo $this->_tpl_vars['rptfls'][$this->_sections['l']['index']]['path']; ?>
"><?php echo $this->_tpl_vars['rptfls'][$this->_sections['l']['index']]['name']; ?>
</option>
								<?php endfor; endif; ?>
								</select>
								<?php else: ?>
									<?php echo $this->_tpl_vars['LBL_NO_REPORT_FILES_AVAILABLE']; ?>

								<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td valign="top"><?php echo $this->_tpl_vars['LBL_DESCRIPTION']; ?>
&nbsp; :</td>
							<td><div id="rptdesc" style="display:inline-block; width:390px; word-wrap:break-word;">---</div></td>
						</tr>
						<tr>
							<td valign="top"><?php echo $this->_tpl_vars['LBL_TYPE']; ?>
&nbsp; :</td>
							<td>
								<select id="init" name="init" style="width:100px;">
									<option value="pdf">PDF</option>
									<option value="png">PNG</option>
								</select>
							</td>
						</tr>
						<tr>
							<td valign="top" colspan="2"><u><?php echo $this->_tpl_vars['LBL_PARAMETERS']; ?>
&nbsp;</u> :</td>
						</tr>
						<tr>
							<td colspan="2">
								<div id="prms">
																	</div>
							</td>
						</tr>
											</table>
					<div>&nbsp;</div>
					<div align="center">
						<a id="btncancel" name="btncancel" id="btncancel" class="btllbl" style="" title="<?php echo $this->_tpl_vars['LBL_CANCEL']; ?>
" ><b><?php echo $this->_tpl_vars['LBL_CANCEL']; ?>
</b></a>
						<a id="btnsubmit" name="btnsubmit" class="btllbl pointer" style="" title="<?php echo $this->_tpl_vars['LBL_SUBMIT']; ?>
" ><b><?php echo $this->_tpl_vars['LBL_SUBMIT']; ?>
</b></a>
											</div>
					</form>
				</div>
				<div id="rptvw">&nbsp;</div>
				<div>&nbsp;</div>
				<?php endif; ?>
			</div>
      </div>
	</div>
	<span id="preview" style="display:none;"></span>
</div>
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery-ui-timepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.listboxfilter.js" ></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<?php echo '
<script type="text/javascript">
var prms = ["';  echo $this->_tpl_vars['prms'];  echo '"];
var rptdesc = ["';  echo $this->_tpl_vars['rptdesc'];  echo '"];
$(document).ready(function()
{
	$("#btncancel").click(function() {
		parent.$.colorbox.close();
	});
	$("#orgfilter").bigoFilter("#promptorganization_id", {property: \'text\'});
	$("#usrfilter").bigoFilter("#promptuser_id", {property: \'text\'});
	$("#pofilter").bigoFilter("#promptpo_id", {property: \'text\'});
	$("#invfilter").bigoFilter("#promptinvoice_id", {property: \'text\'});
	$("#rfq2filter").bigoFilter("#promptrfq2_id", {property: \'text\'});
	$("#rfq2bidfilter").bigoFilter("#promptrfq2_bid_id", {property: \'text\'});
	$("#rfq2bidawardfilter").bigoFilter("#promptrfq2_bid_award_id", {property: \'text\'});
	function getorgusers() {
		if($.trim($(\'#promptorganization_id\').val()) == \'\') {
			if($(\'#promptuser_id option\').length >0) {
				$(\'#promptuser_id option[value!=""]\').remove();
			}
		} else if($(\'#promptuser_id option\').length >0) {
			var url = SITE_URL+"index.php?file=m-aj_getRptCombos";
			var pars = $(\'#frmrpt\').serialize()+\'&type=usr&dseltxt=\'+\'';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_USER'];  echo '\';
			$.ajax({type:"post", url:url, data:pars, success:function(resp) {
				$(\'.puser\').attr(\'innerHTML\',resp);
			}});
		}
	}
	$(\'#promptorganization_id\').live("change", getorgusers);
	function setprms() {
		var lp = $(\'#rptfile option:selected\').attr(\'lp\');
		$(\'#prms\').attr(\'innerHTML\', prms[lp]);
		$(\'#rptdesc\').attr(\'innerHTML\', rptdesc[lp]);
		//
		// $(\'#prms > el\').hide();
		// $(\'#prms > el[pth="\'+$(\'#rptfile\').val()+\'"]\').show();
		//
		//$("#fDate").live("click",function() {
			$("#promptfrom_date").datepicker({
			  dateFormat: \'yy-mm-dd\',
			  // timeFormat: \'hh:mm:ss\',
			  showOn: "both",
			  buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
			  buttonImageOnly: true,
			  onSelect: function(dateText, inst) {
					$(document).ready(function(dateText, inst) {
						 var ead = 10;
						 $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
					});
			  },
			  onClose: function() {
					$(document).ready(function(dateText, inst) {
						 var ead = 10;
						 $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
					});
			  }
			});
		//});
		// $("#tDate").live("click",function() {
			$("#promptto_date").datepicker({
			  dateFormat: \'yy-mm-dd\',
			  // timeFormat: \'hh:mm:ss\',
			  showOn: "both",
			  buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
			  buttonImageOnly: true,
			  onSelect: function(dateText, inst) {
					$(document).ready(function(dateText, inst) {
						 var ead = 10;
						 $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
					});
			  },
			  onClose: function() {
					$(document).ready(function(dateText, inst) {
						 var ead = 10;
						 $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
					});
			  }
			});
		//});
		//
	}
	setprms();
	$(\'#rptfile\').change(setprms);
	$(\'#frmrpt\').validate({
		"ignore":":hidden"
	});
	function frmsubmit() {
		var vld = $(\'#frmrpt\').valid();
		if(! vld) {
			return false;
		}
		if($(\'#rptfile\').length >0 && $(\'#rptfile\').val()!=\'\') {
			// var href = $(\'#frmrpt\').attr(\'action\')+\'&rptfile=\'+$(\'#rptfile\').val()+\'&init=\'+$(\'#init\').val();
			// var href = \'';  echo $this->_tpl_vars['SITE_URL'];  echo 'index.php?file=m-getinetreports&\'+$(\'#frmrpt\').serialize();
			var url = "';  echo $this->_tpl_vars['SITE_URL'];  echo '"+"index.php?file=m-getinetreports";
			var prms = $(\'#frmrpt\').serialize()+"&nwrpt=n";
			$.ajax({type:"post", url:url, data:prms, success:function(resp) {
				rslt = $.parseJSON(resp);
				// alert(rslt[\'file\']);
				if($.trim(rslt[\'file\'])==\'\') {
					alert(LBL_REPORT_NOT_AVAILABLE);
					return false;
				}
				window.location.href = rslt[\'file\'];
				// $.colorbox({ width:"790px", height:"550px", iframe:true, href:rslt[\'file\'] });
			}
			});
			// var href = $(\'#frmrpt\').attr(\'action\')+\'/?\'+$(\'#frmrpt\').serialize();
			// $.colorbox({ width:"790px", height:"550px", iframe:true, href:href });
			// $(".btnsubmit").trigger(\'click\');
			// $(\'#frmrpt\')[0].submit();
			return true;
		}
		alert(\'No Report Selected\');
		return false;
	}
	$(\'#btnsubmit\').click(frmsubmit);
});
</script>
'; ?>
