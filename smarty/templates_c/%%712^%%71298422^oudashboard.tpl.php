<?php /* Smarty version 2.6.0, created on 2015-07-12 22:54:40
         compiled from member/user/oudashboard.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/user/oudashboard.tpl', 1, false),array('modifier', 'cat', 'member/user/oudashboard.tpl', 1, false),array('modifier', 'calcLTzTime', 'member/user/oudashboard.tpl', 70, false),array('modifier', 'DateTime', 'member/user/oudashboard.tpl', 70, false),array('modifier', 'htmlentities', 'member/user/oudashboard.tpl', 150, false),array('modifier', 'in_array', 'member/user/oudashboard.tpl', 313, false),array('modifier', 'count', 'member/user/oudashboard.tpl', 435, false),array('modifier', 'getInboxDate', 'member/user/oudashboard.tpl', 549, false),)), $this); ?>
<?php echo smarty_function_assign(array('var' => 'field','value' => ((is_array($_tmp='vStatus_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['LANG']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['LANG']))), $this);?>

<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<div id="content-header" class="clearfix">
										<div class="pull-left">
											<ol class="breadcrumb">
												<li><a href="#">Home</a></li>
												<li class="active"><span><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
</span></li>
											</ol>

											<h1><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
</h1>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-3 col-sm-6 col-xs-12">
									<div class="main-box infographic-box colored emerald-bg">
										<i class="fa fa-envelope"></i>
										<span class="headline">Messages</span>
										<span class="value">4.658</span>
									</div>
								</div>

								<div class="col-lg-3 col-sm-6 col-xs-12">
									<div class="main-box infographic-box colored green-bg">
										<i class="fa fa-money"></i>
										<span class="headline">Orders</span>
										<span class="value">22.631</span>
									</div>
								</div>

								<div class="col-lg-3 col-sm-6 col-xs-12">
									<div class="main-box infographic-box colored red-bg">
										<i class="fa fa-user"></i>
										<span class="headline">Users</span>
										<span class="value">92.421</span>
									</div>
								</div>

								<div class="col-lg-3 col-sm-6 col-xs-12">
									<div class="main-box infographic-box colored purple-bg">
										<i class="fa fa-globe"></i>
										<span class="headline">Visits</span>
										<span class="value">13.298</span>
									</div>
								</div>
							</div>

							<!-- Main Content -->
							<div class="row">
								<div class="col-md-6">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left"><?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['resbid']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                    <li class="clearfix">
													<div class="title">
														<b style="font-size:12.9px;"><?php echo $this->_tpl_vars['LBL_BID_NO']; ?>
:</b> <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2bidview/<?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['iBidId']; ?>
"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['vBidNum']; ?>
</b></a>
													</div>
													<div class="post-time">
														<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['resbid'][$this->_sections['l']['index']]['dBidDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>

                                                        <label><?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
:</label> <?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['vRFQ2Code']; ?>
<br/>
                                                        <label><?php echo $this->_tpl_vars['LBL_BID']; ?>
 <?php echo $this->_tpl_vars['LBL_ADVANCE']; ?>
:</label> <?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['fBidAdvanceTotal']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
                                                        <label><?php echo $this->_tpl_vars['LBL_BID']; ?>
 <?php echo $this->_tpl_vars['LBL_PRICE']; ?>
:</label> <?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['fBidPriceTotal']; ?>
<br/>
													</div>
													<div class="time-ago">
														<i class="fa fa-clock-o"></i> 5 min.
													</div>
												</li>
                                                <?php endfor; else: ?>
                                                <li class="clearfix">
                                                    <?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

                                                </li>
                                                <?php endif; ?>
											</ul>
										</div>
										<footer class="main-box-header clearfix">
                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2bidlist">
											<button class="btn btn-primary pull-right"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
 </button>
                                                </a>
										</footer>
									</div>
								</div>

								<div class="col-md-6">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left"><?php echo $this->_tpl_vars['LBL_AWARDS']; ?>
</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['latestaward']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                <li class="clearfix">
													<div class="title">
														<b style="font-size:12.9px;"><?php echo $this->_tpl_vars['LBL_AWARD_NO']; ?>
:</b>&nbsp;<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2awardview/<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['iAwardId']; ?>
"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['vAwardNum']; ?>
</b></a>
													</div>
													<div class="post-time">
														<span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['dADate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br>
                                                        <label><?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['vRFQ2Code']; ?>
<br>
                                                        <label><?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['vCompanyName']; ?>
<br>
                                                        <label><?php echo $this->_tpl_vars['LBL_ADVANCE_TOTAL']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['fBidAdvanceTotal']; ?>
<br>
                                                        <label><?php echo $this->_tpl_vars['LBL_PRICE_TOTAL']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['fBidPriceTotal']; ?>
<br>
                                                        <label><?php echo $this->_tpl_vars['LBL_STATUS']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['vStatus_en']; ?>

													</div>
												</li>
                                                <?php endfor; else: ?>
                                                 <li class="clearfix">
													<div class="title">
														<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

													</div>
												</li>
                                                <?php endif; ?>
											</ul>
										</div>

										<footer class="main-box-header clearfix">
                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2awardlist">
											<button class="btn btn-primary pull-right"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</button>
                                                </a>
										</footer>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-8">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><?php echo $this->_tpl_vars['LBL_STATISTICS']; ?>
</h2>
										</header>

										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<tbody>
														<tr>
                                                            <td>&nbsp;</td>
                                                            <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['sts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
															<td  class="text-center">
																<?php echo ((is_array($_tmp=$this->_tpl_vars['sts'][$this->_sections['l']['index']]['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>

															</td>
                                                            <?php endfor; endif; ?>
															<td  class="text-center">
                                                                <?php echo $this->_tpl_vars['LBL_TOTAL']; ?>

                                                            </td>
														</tr>
														<?php if ($this->_tpl_vars['orgtype'] != 'Supplier'): ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $this->_tpl_vars['LBL_PO_ISSUANCE']; ?>
</td>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['crstatisu'][0]['pocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('PO','Create','<?php echo $this->_tpl_vars['crpo']; ?>
','isu')"><?php endif;  echo $this->_tpl_vars['crstatisu'][0]['pocnt'];  if ($this->_tpl_vars['crstatisu'][0]['pocnt'] > 0): ?></a><?php endif; ?></td>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['vstatistics'][0]['pocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('PO','Verify','<?php echo $this->_tpl_vars['povisu']; ?>
','isu')"><?php endif;  echo $this->_tpl_vars['vstatistics'][0]['pocnt'];  if ($this->_tpl_vars['vstatistics'][0]['pocnt'] > 0): ?></a><?php endif; ?></td>
                                                            <?php echo smarty_function_assign(array('var' => 'poisusts','value' => $this->_tpl_vars['isustats']['poisu']), $this);?>

                                                            <?php if (count($_from = (array)$this->_tpl_vars['poisusts'])):
    foreach ($_from as $this->_tpl_vars['ky'] => $this->_tpl_vars['itm']):
?>
                                                                <?php if ($this->_tpl_vars['itm']['eFor'] == 'PO'): ?>
                                                                    <td class="text-center"><?php if ($this->_tpl_vars['itm']['pocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('PO','<?php echo $this->_tpl_vars['itm']['vStatus_en']; ?>
','<?php echo $this->_tpl_vars['ky']; ?>
','isu')"><?php endif;  echo $this->_tpl_vars['itm']['pocnt'];  if ($this->_tpl_vars['itm']['pocnt'] > 0): ?></a><?php endif; ?></td>
                                                                <?php endif; ?>
      		                                                <?php endforeach; unset($_from); endif; ?>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['tisu'][0]['tpoisu'] > 0):  endif; ?><b><?php echo $this->_tpl_vars['tisu'][0]['tpoisu']; ?>
</b><?php if ($this->_tpl_vars['tisu'][0]['tpoisu'] > 0):  endif; ?></td>
                                                        </tr>
                                                        <?php endif; ?>

                                                        <?php if ($this->_tpl_vars['orgtype'] != 'Buyer'): ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $this->_tpl_vars['LBL_INVOICE_ISSUANCE']; ?>
</td>
                                                            <?php echo smarty_function_assign(array('var' => 'invisutotal','value' => 0), $this);?>

                                                            <td class="text-center"><?php if ($this->_tpl_vars['crstatisu'][0]['iocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('Invoice','Create','<?php echo $this->_tpl_vars['crio']; ?>
','isu')"><?php echo smarty_function_assign(array('var' => 'invisutotal','value' => ($this->_tpl_vars['crstatisu'][0]['iocnt']+$this->_tpl_vars['invisutotal'])), $this); endif;  echo $this->_tpl_vars['crstatisu'][0]['iocnt']; ?>
</a></td>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['vstatistics'][0]['iocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('Invoice','Verify','<?php echo $this->_tpl_vars['iovapt']; ?>
','isu')"><?php echo smarty_function_assign(array('var' => 'invisutotal','value' => ($this->_tpl_vars['vstatistics'][0]['iocnt']+$this->_tpl_vars['invisutotal'])), $this); endif;  echo $this->_tpl_vars['vstatistics'][0]['iocnt'];  if ($this->_tpl_vars['vstatistics'][0]['iocnt'] > 0): ?></a><?php endif; ?></td>
                                                            <?php echo smarty_function_assign(array('var' => 'ioisusts','value' => $this->_tpl_vars['isustats']['invisu']), $this);?>

                                                            <?php if (count($_from = (array)$this->_tpl_vars['ioisusts'])):
    foreach ($_from as $this->_tpl_vars['ky'] => $this->_tpl_vars['itm']):
?>
                                                                                                                            <?php if ($this->_tpl_vars['itm']['eFor'] == 'Invoice'): ?>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['itm']['incnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('Invoice','<?php echo $this->_tpl_vars['itm']['vStatus_en']; ?>
','<?php echo $this->_tpl_vars['ky']; ?>
','isu')"><?php echo smarty_function_assign(array('var' => 'invisutotal','value' => ($this->_tpl_vars['itm']['incnt']+$this->_tpl_vars['invisutotal'])), $this); endif;  echo $this->_tpl_vars['itm']['incnt'];  if ($this->_tpl_vars['itm']['incnt'] > 0): ?></a><?php endif; ?></td>
                                                                                                                            <?php endif; ?>
                                                            <?php endforeach; unset($_from); endif; ?>
                                                            <td class="text-center"><b><?php echo $this->_tpl_vars['invisutotal']; ?>
</b></td>

                                                        </tr>
                                                        <?php endif; ?>
                                                        <?php if ($this->_tpl_vars['orgtype'] != 'Buyer'): ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $this->_tpl_vars['LBL_PO_ACCEPTANCE']; ?>
</td>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['crstatact'][0]['pocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('PO','Create','<?php echo $this->_tpl_vars['crpo']; ?>
','acpt')"><?php endif;  echo $this->_tpl_vars['crstatact'][0]['pocnt'];  if ($this->_tpl_vars['crstatact'][0]['pocnt'] > 0): ?></a><?php endif; ?></td>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['avstatistics'][0]['pocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('PO','Verify','<?php echo $this->_tpl_vars['povisu']; ?>
','acpt')"><?php endif;  echo $this->_tpl_vars['avstatistics'][0]['pocnt'];  if ($this->_tpl_vars['avstatistics'][0]['pocnt'] > 0): ?></a><?php endif; ?></td>
                                                            <?php echo smarty_function_assign(array('var' => 'poactsts','value' => $this->_tpl_vars['acptstats']['poacpt']), $this);?>

                                                            <?php if (count($_from = (array)$this->_tpl_vars['poactsts'])):
    foreach ($_from as $this->_tpl_vars['ky'] => $this->_tpl_vars['itm']):
?>
                                                            <?php if ($this->_tpl_vars['itm']['eFor'] == 'PO'): ?>
                                                                <td class="text-center"><?php if ($this->_tpl_vars['itm']['pocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('PO','<?php echo $this->_tpl_vars['itm']['vStatus_en']; ?>
','<?php echo $this->_tpl_vars['ky']; ?>
','acpt')"><?php endif;  echo $this->_tpl_vars['itm']['pocnt'];  if ($this->_tpl_vars['itm']['pocnt'] > 0): ?></a><?php endif; ?></td>
                                                            <?php endif; ?>
      		                                                <?php endforeach; unset($_from); endif; ?>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['tact'][0]['tpoact'] > 0): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poacptlist/all"><?php endif; ?><b><?php if ($this->_tpl_vars['tact'][0]['tpoact'] > 0):  echo $this->_tpl_vars['tact'][0]['tpoact'];  else: ?>0<?php endif; ?></b><?php if ($this->_tpl_vars['tact'][0]['tpoact'] > 0): ?></a><?php endif; ?></td>
                                                        </tr>
                                                        <?php endif; ?>

                                                        <?php if ($this->_tpl_vars['orgtype'] != 'Supplier'): ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $this->_tpl_vars['LBL_INVOICE_ACCEPTANCE']; ?>
</td>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['crstatact'][0]['iocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('Invoice','Create','<?php echo $this->_tpl_vars['crio']; ?>
','acpt')"><?php endif;  echo $this->_tpl_vars['crstatact'][0]['iocnt']; ?>
</a></td>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['avstatistics'][0]['iocnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('Invoice','Verify','<?php echo $this->_tpl_vars['iovapt']; ?>
','acpt')"><?php endif;  echo $this->_tpl_vars['avstatistics'][0]['iocnt'];  if ($this->_tpl_vars['avstatistics'][0]['iocnt'] > 0): ?></a><?php endif; ?></td>
                                                            <?php echo smarty_function_assign(array('var' => 'ioactsts','value' => $this->_tpl_vars['acptstats']['invacpt']), $this);?>

                                                            <?php if (count($_from = (array)$this->_tpl_vars['ioactsts'])):
    foreach ($_from as $this->_tpl_vars['ky'] => $this->_tpl_vars['itm']):
?>
                                                                <?php if ($this->_tpl_vars['itm']['eFor'] == 'Invoice'): ?>
                                                                    <td class="text-center"><?php if ($this->_tpl_vars['itm']['incnt'] > 0): ?><a style="cursor:pointer;" onclick="showlist('Invoice','<?php echo $this->_tpl_vars['itm']['vStatus_en']; ?>
','<?php echo $this->_tpl_vars['ky']; ?>
','acpt')"><?php endif;  echo $this->_tpl_vars['itm']['incnt'];  if ($this->_tpl_vars['itm']['incnt'] > 0): ?></a><?php endif; ?></td>
                                                                <?php endif; ?>
      		                                                <?php endforeach; unset($_from); endif; ?>
                                                            <td class="text-center"><?php if ($this->_tpl_vars['tact'][0]['tioact'] > 0):  endif; ?><b><?php echo $this->_tpl_vars['tact'][0]['tioact']; ?>
</b><?php if ($this->_tpl_vars['tact'][0]['tioact'] > 0):  endif; ?></td>
                                                        </tr>
                                                        <?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left"><?php echo $this->_tpl_vars['LBL_LAST_3_LOGIN']; ?>
</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['lastlogins']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                <li class="clearfix">
													<div class="date">
														<i class="fa fa-clock-o pull-left"></i>
														<?php echo $this->_tpl_vars['LBL_LAST_LOGIN']; ?>
 : <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['lastlogins'][$this->_sections['l']['index']]['dLoginDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 7) : DateTime($_tmp, 7)); ?>

													</div>
													<div class="ipaddress">
														<i class="fa fa-map-marker pull-left"></i>
														<?php echo $this->_tpl_vars['lastlogins'][$this->_sections['l']['index']]['vIP']; ?>

													</div>
												</li>
                                                <?php endfor; else: ?>
                                                    <li class="clearfix">
													<div class="date">
														<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

													</div>
												</li>
                                                <?php endif; ?>

											</ul>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<!-- RFQ2 Statistics -->
								<div class="col-md-8">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
&nbsp;<?php echo $this->_tpl_vars['LBL_STATISTICS']; ?>
</h2>
										</header>
                                        <?php echo smarty_function_assign(array('var' => 'field','value' => ((is_array($_tmp='vStatus_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['LANG']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['LANG']))), $this);?>

										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<tbody>
														<tr>
                                                            <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['rfq2sts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                            <td  class="text-center">
																<?php if (((is_array($_tmp=$this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)) == 'Accepted'): ?>
                                                                    <?php echo $this->_tpl_vars['LBL_ISSUED']; ?>

                                                                <?php else: ?>
                                                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>

                                                                <?php endif; ?>
															</td>
                                                            <?php endfor; endif; ?>
															<td  class="text-center">
																<?php echo $this->_tpl_vars['LBL_TOTAL']; ?>

															</td>
														</tr>
														<tr>
															<td  class="text-center">
																<?php echo $this->_tpl_vars['LBL_RFQ2']; ?>

															</td>
                                                            <?php echo smarty_function_assign(array('var' => 'st','value' => 0), $this);?>

			                                                    <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['rfq2sts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
															<td class="text-center">
                                                                <?php echo smarty_function_assign(array('var' => 'vl','value' => $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['vStatus_en']), $this);?>

                                                                <?php if ($this->_tpl_vars['r2stats'][$this->_tpl_vars['vl']] != ''): ?>
                                                                <?php if ($this->_tpl_vars['r2stats'][$this->_tpl_vars['vl']] != 0): ?>
                                                                     <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2list/<?php if ($this->_tpl_vars['vl'] != 'Rejected'):  echo $this->_tpl_vars['st'];  else:  echo $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID'];  endif; ?>"><?php echo $this->_tpl_vars['r2stats'][$this->_tpl_vars['vl']]; ?>
</a>
                                                                  <?php else: ?>
                                                                  <?php echo $this->_tpl_vars['r2stats'][$this->_tpl_vars['vl']]; ?>

                                                                  <?php endif; ?>
                                                                     <?php echo smarty_function_assign(array('var' => 'st','value' => $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID']), $this);?>

                                                                <?php else: ?> x <?php endif; ?>
															</td>
                                                            <?php endfor; endif; ?>
                                                            <td class="text-center">
                                                                <?php if ($this->_tpl_vars['r2stats']['ttol'] != ''):  echo $this->_tpl_vars['r2stats']['ttol'];  else: ?>0<?php endif; ?>
                                                            </td>
														</tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <?php echo $this->_tpl_vars['LBL_AWARD']; ?>

                                                            </td>
                                                            <?php echo smarty_function_assign(array('var' => 'tot','value' => 0), $this);?>

			                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['rfq2sts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                                <td class="text-center">
                                                                    <?php if (((is_array($_tmp=$this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['aworgsts']) : in_array($_tmp, $this->_tpl_vars['aworgsts'])) || $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['vStatus_en'] == 'Accepted' || $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['vStatus_en'] == 'Verify'): ?>
                                                                        <?php if ($this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['vStatus_en'] == 'Create'): ?>
                                                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2awardlist/1"><?php echo $this->_tpl_vars['saved_award'][0]['tot']; ?>
</a>
                                                                            <?php echo smarty_function_assign(array('var' => 'tot','value' => ($this->_tpl_vars['tot']+$this->_tpl_vars['saved_award'][0]['tot'])), $this);?>

                                                                            <?php elseif ($this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['vStatus_en'] == 'Verify'): ?>
                                                                            <?php echo smarty_function_assign(array('var' => 'vvl','value' => $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID']), $this);?>

                                                                            <?php if (((is_array($_tmp=$this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['aworgsts']) : in_array($_tmp, $this->_tpl_vars['aworgsts']))): ?>
                                                                                <?php if ($this->_tpl_vars['award'][$this->_tpl_vars['vl']] != ''): ?>
                                                                                    <?php if ($this->_tpl_vars['award'][$this->_tpl_vars['vl']] > 0): ?>
                                                                                        <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2awardlist/<?php echo $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID']; ?>
"><?php echo $this->_tpl_vars['award'][$this->_tpl_vars['vl']]; ?>
</a>
                                                                                        <?php echo smarty_function_assign(array('var' => 'tot','value' => ($this->_tpl_vars['tot']+$this->_tpl_vars['award'][$this->_tpl_vars['vl']])), $this);?>

                                                                                        <?php else: ?>
                                                                                        <?php echo $this->_tpl_vars['award'][$this->_tpl_vars['vl']]; ?>

                                                                                    <?php endif; ?>
                                                                                    <?php else: ?> 0 <?php endif; ?>
                                                                                <?php else: ?> x <?php endif; ?>
                                                                            <?php elseif ($this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['vStatus_en'] == 'Rejected'): ?>
                                                                            <?php echo smarty_function_assign(array('var' => 'cvl','value' => $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID']), $this);?>

                                                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2awardlist/<?php echo $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID']; ?>
"><?php echo $this->_tpl_vars['award'][$this->_tpl_vars['cvl']]; ?>
</a>
                                                                            <?php echo smarty_function_assign(array('var' => 'tot','value' => ($this->_tpl_vars['tot']+$this->_tpl_vars['award'][$this->_tpl_vars['cvl']])), $this);?>

                                                                            <?php elseif ($this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['vStatus_en'] == 'Accepted'): ?>
                                                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2awardlist/2"><?php echo $this->_tpl_vars['award'][$this->_tpl_vars['vvl']]; ?>
</a>
                                                                            <?php echo smarty_function_assign(array('var' => 'tot','value' => ($this->_tpl_vars['tot']+$this->_tpl_vars['award'][$this->_tpl_vars['vvl']])), $this);?>

                                                                            <?php else: ?>
                                                                            <?php if ($this->_tpl_vars['award'][$this->_tpl_vars['vl']] != ''): ?>
                                                                                <?php if ($this->_tpl_vars['award'][$this->_tpl_vars['vl']] > 0): ?>
                                                                                    <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2awardlist/<?php echo $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID']; ?>
"><?php echo $this->_tpl_vars['award'][$this->_tpl_vars['vl']]; ?>
</a>
                                                                                    <?php echo smarty_function_assign(array('var' => 'tot','value' => ($this->_tpl_vars['tot']+$this->_tpl_vars['award'][$this->_tpl_vars['vl']])), $this);?>

                                                                                    <?php else: ?>
                                                                                    <?php echo $this->_tpl_vars['award'][$this->_tpl_vars['vl']]; ?>

                                                                                <?php endif; ?>
                                                                                <?php else: ?> 0 <?php endif; ?>
                                                                        <?php endif; ?>
                                                                        <?php echo smarty_function_assign(array('var' => 'vl','value' => $this->_tpl_vars['rfq2sts'][$this->_sections['l']['index']]['iStatusID']), $this);?>

                                                                        <?php else: ?> x <?php endif; ?>
                                                                </td>
                                                            <?php endfor; endif; ?>
                                                            <td class="text-center">
                                                                <?php if ($this->_tpl_vars['tot'] != ''):  echo $this->_tpl_vars['tot'];  else: ?>0<?php endif; ?>
                                                            </td>
                                                        </tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left"><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['latestrfq2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                <li class="clearfix">
													<div class="title">
														<?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
:<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2view/<?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['iRFQ2Id']; ?>
"><?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['vRFQ2Code']; ?>
</a>
													</div>
													<div class="post-time">
														<?php echo $this->_tpl_vars['LBL_INVOICE_CODE']; ?>
: <?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['vInvoiceCode']; ?>
&nbsp; <?php echo $this->_tpl_vars['LBL_TYPE']; ?>
: <?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['eAuctionType']; ?>

                                                        <?php echo $this->_tpl_vars['LBL_START_DATE']; ?>
: <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['dStartDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
&nbsp;<?php echo $this->_tpl_vars['LBL_END_DATE']; ?>
:<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['dEndDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>

                                                        <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
:<?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['eAuctionStatus']; ?>

													</div>
													<div class="time-ago">
														<i class="fa fa-clock-o"></i> 5 min.
													</div>
												</li>
                                                <?php endfor; else: ?>
                                                <li class="clearfix">
													<div class="title">
                                                        <?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

                                                    </div>
                                                </li>
                                                <?php endif; ?>
											</ul>
										</div>

										<footer class="main-box-header clearfix">
                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2list">
											    <button class="btn btn-primary pull-right"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</button>
                                            </a>
										</footer>
									</div>
								</div>
								<!-- RFQ2 counts -->
								<div class="col-md-8">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
&nbsp;<?php echo $this->_tpl_vars['LBL_COUNTS']; ?>
</h2>
										</header>

										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<tbody>
														<tr>
                                                            <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['cntsts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
															<td  class="text-center">
																<?php echo $this->_tpl_vars['cntsts'][$this->_sections['l']['index']]; ?>

															</td>
															<?php endfor; endif; ?>
														</tr>
                                                        <tr>
                                                            <td class="text-center"><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</td>
                                                        <?php echo smarty_function_assign(array('var' => 'ln','value' => 0), $this);?>


                                                        <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['cntsts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                            <?php if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] == 'Not Started'): ?>
                                                                <?php echo smarty_function_assign(array('var' => 'rfq2ls','value' => 0), $this);?>

                                                            <?php endif; ?>
                                                            <?php if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] == 'Live'): ?>
                                                                <?php echo smarty_function_assign(array('var' => 'rfq2ls','value' => 1), $this);?>

                                                            <?php endif; ?>
                                                            <?php if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] == 'Completed'): ?>
                                                                <?php echo smarty_function_assign(array('var' => 'rfq2ls','value' => 2), $this);?>

                                                            <?php endif; ?>
                                                            <?php if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] == 'Cancelled'): ?>
                                                                <?php echo smarty_function_assign(array('var' => 'rfq2ls','value' => 2), $this);?>

                                                            <?php endif; ?>
                                                            <td
                                                                class="<?php if ($this->_sections['l']['index']+1 == count($this->_tpl_vars['cntsts'])): ?>listing-name-grey-total-1<?php else: ?>listing-name-grey-border-nomber-1<?php endif; ?>">
                                                                <?php if (((is_array($_tmp=$this->_tpl_vars['cntsts'][$this->_sections['l']['index']])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['r2sts']) : in_array($_tmp, $this->_tpl_vars['r2sts']))):  if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] != 'Awarded'): ?>
                                                                    <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2list/<?php echo $this->_tpl_vars['rfq2ls']; ?>
/rfq2count"><?php echo $this->_tpl_vars['rfq2stats'][$this->_tpl_vars['ln']]['cnt']; ?>
</a><?php else:  echo $this->_tpl_vars['rfq2stats'][$this->_tpl_vars['ln']]['cnt'];  endif;  echo smarty_function_assign(array('var' => 'ln','value' => ($this->_tpl_vars['ln']+1)), $this); else: ?>
                                                                    0 <?php endif; ?>
                                                            </td>
                                                        <?php endfor; endif; ?>
                                                        </tr>
                                                    </tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left"><?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['latestpo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                    <li class="clearfix">
													<div class="ordername"><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseorderview/<?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['iPurchaseOrderID']; ?>
"><?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['vPoBuyerCode']; ?>
</a></div>
													<div class="company-name pull-left">
                                                        <p>
                                                        <?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['supplierorg']; ?>
 , &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                            <?php echo $this->_tpl_vars['LBL_CREATED_DATE']; ?>
 : <span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['addDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, '0') : DateTime($_tmp, '0')); ?>
</span> <br />
                                                        <?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['vCity']; ?>
, <?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['vState']; ?>
, <?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['vCountry']; ?>
 &nbsp; <br />
                                                                                                                <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 : <span>Active</span>
                                                        </p>
                                                    </div>
												</li>
                                                <?php endfor; else: ?>
                                                <li class="clearfix">
													<div class="ordername"><?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>
</div>
                                                   </li>
                                                 <?php endif; ?>
											</ul>
										</div>
										<footer class="main-box-header clearfix">
                                            <?php if ($this->_tpl_vars['orgtype'] == 'Supplier'): ?>
                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
poacptlist">
											<button class="btn btn-primary pull-right"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</button>
                                                </a>
                                            <?php else: ?>
                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
polist">
											<button class="btn btn-primary pull-right"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</button>
                                                </a>
                                            <?php endif; ?>
										</footer>
									</div>
								</div>

								<div class="col-md-6">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left"><?php echo $this->_tpl_vars['LBL_INVOICE_ORDER']; ?>
</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['latestio']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                <li class="clearfix">
													<div class="ordername"><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceview/<?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['iInvoiceID']; ?>
"><?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['vInvSupplierCode']; ?>
</a></div>
													<div class="company-name pull-left">
                                                         <p>
                                                             <?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['buyerorg']; ?>
 , &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                <?php echo $this->_tpl_vars['LBL_CREATED_DATE']; ?>
 : <span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestio'][$this->_sections['l']['index']]['addDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, '0') : DateTime($_tmp, '0')); ?>
</span> <br />
                                                             <?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['vCity']; ?>
, <?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['vState']; ?>
, <?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['vCountry']; ?>
 &nbsp; <br />
                                                                                                                          <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 : <span>Active</span>
                                                         </p>
                                                    </div>
												</li>
                                                <?php endfor; else: ?>
                                                <li class="clearfix">
													<div class="ordername"><?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>
</div>
                                                </li>
                                                <?php endif; ?>
											</ul>
										</div>

										<footer class="main-box-header clearfix">
                                            <?php if ($this->_tpl_vars['orgtype'] == 'Buyer'): ?>
                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invacptlist">
											<button class="btn btn-primary pull-right"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</button>
                                                    </a>
                                            <?php else: ?>
                                                <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicelist">
											<button class="btn btn-primary pull-right"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</button>
                                                    </a>
                                            <?php endif; ?>

										</footer>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left"><?php echo $this->_tpl_vars['LBL_INBOX']; ?>
 (<?php echo $this->_tpl_vars['totInboxres']; ?>
)</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                <?php if (count($this->_tpl_vars['res']) > 0): ?>
                                                 <?php echo smarty_function_assign(array('var' => 'field','value' => ((is_array($_tmp='vMailSubject_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['LANG']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['LANG']))), $this);?>

                                                 <?php if (isset($this->_sections['in'])) unset($this->_sections['in']);
$this->_sections['in']['name'] = 'in';
$this->_sections['in']['loop'] = is_array($_loop=$this->_tpl_vars['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['in']['show'] = true;
$this->_sections['in']['max'] = $this->_sections['in']['loop'];
$this->_sections['in']['step'] = 1;
$this->_sections['in']['start'] = $this->_sections['in']['step'] > 0 ? 0 : $this->_sections['in']['loop']-1;
if ($this->_sections['in']['show']) {
    $this->_sections['in']['total'] = $this->_sections['in']['loop'];
    if ($this->_sections['in']['total'] == 0)
        $this->_sections['in']['show'] = false;
} else
    $this->_sections['in']['total'] = 0;
if ($this->_sections['in']['show']):

            for ($this->_sections['in']['index'] = $this->_sections['in']['start'], $this->_sections['in']['iteration'] = 1;
                 $this->_sections['in']['iteration'] <= $this->_sections['in']['total'];
                 $this->_sections['in']['index'] += $this->_sections['in']['step'], $this->_sections['in']['iteration']++):
$this->_sections['in']['rownum'] = $this->_sections['in']['iteration'];
$this->_sections['in']['index_prev'] = $this->_sections['in']['index'] - $this->_sections['in']['step'];
$this->_sections['in']['index_next'] = $this->_sections['in']['index'] + $this->_sections['in']['step'];
$this->_sections['in']['first']      = ($this->_sections['in']['iteration'] == 1);
$this->_sections['in']['last']       = ($this->_sections['in']['iteration'] == $this->_sections['in']['total']);
?>
                                                    <strong><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
inboxdetail/<?php echo $this->_tpl_vars['res'][$this->_sections['in']['index']]['iVerifiedID']; ?>
"><?php echo $this->_tpl_vars['res'][$this->_sections['in']['index']][$this->_tpl_vars['field']]; ?>
</a></strong>
                                                    <strong><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['res'][$this->_sections['in']['index']]['dActionDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('getInboxDate', true, $_tmp) : getInboxDate($_tmp)); ?>
</strong>
                                                 <?php endfor; endif; ?>
                                                    <?php if ($this->_tpl_vars['totInboxres'] > count($this->_tpl_vars['res'])): ?><em><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
inbox" ><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</a></em><?php endif; ?>
                                                 <?php else: ?>
                                                 <li class="clearfix">
                                                    <?php echo $this->_tpl_vars['LBL_NO_RECENT_MESSAGES']; ?>

												</li>
                                                 <?php endif; ?>

											</ul>
										</div>
										<footer class="main-box-header clearfix">
                                            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
inbox">
											<button class="btn btn-primary pull-right"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</button>
                                                </a>
										</footer>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
<?php echo '
<script type="text/javascript">
var cookie = \'';  echo $this->_tpl_vars['tDashboard'];  echo '\';
</script>
'; ?>