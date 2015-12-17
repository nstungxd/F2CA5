{assign var="field" value="vStatus_"|cat:$LANG}
<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<div id="content-header" class="clearfix">
										<div class="pull-left">
											<ol class="breadcrumb">
												<li><a href="#">Home</a></li>
												<li class="active"><span>{$LBL_DASHBOARD}</span></li>
											</ol>

											<h1>{$LBL_DASHBOARD}</h1>
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
											<h2 class="pull-left">{$LBL_BIDS}</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                {section name=l loop=$resbid}
                                                    <li class="clearfix">
													<div class="title">
														<b style="font-size:12.9px;">{$LBL_BID_NO}:</b> <a href="{$SITE_URL_DUM}rfq2bidview/{$resbid[l].iBidId}"><b style="font-size:12.9px;">{$resbid[l].vBidNum}</b></a>
													</div>
													<div class="post-time">
														{$resbid[l].dBidDate|calcLTzTime|DateTime:10}
                                                        <label>{$LBL_RFQ2_CODE}:</label> {$resbid[l].vRFQ2Code}<br/>
                                                        <label>{$LBL_BID} {$LBL_ADVANCE}:</label> {$resbid[l].fBidAdvanceTotal}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
                                                        <label>{$LBL_BID} {$LBL_PRICE}:</label> {$resbid[l].fBidPriceTotal}<br/>
													</div>
													<div class="time-ago">
														<i class="fa fa-clock-o"></i> 5 min.
													</div>
												</li>
                                                {sectionelse}
                                                <li class="clearfix">
                                                    {$LBL_NO_REC_AVAILABLE}
                                                </li>
                                                {/section}
											</ul>
										</div>
										<footer class="main-box-header clearfix">
                                            <a href="{$SITE_URL_DUM}rfq2bidlist">
											<button class="btn btn-primary pull-right">{$LBL_VIEW_MORE} </button>
                                                </a>
										</footer>
									</div>
								</div>

								<div class="col-md-6">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left">{$LBL_AWARDS}</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                {section name=l loop=$latestaward}
                                                <li class="clearfix">
													<div class="title">
														<b style="font-size:12.9px;">{$LBL_AWARD_NO}:</b>&nbsp;<a href="{$SITE_URL_DUM}rfq2awardview/{$latestaward[l].iAwardId}"><b style="font-size:12.9px;">{$latestaward[l].vAwardNum}</b></a>
													</div>
													<div class="post-time">
														<span>{$latestaward[l].dADate|calcLTzTime|DateTime:10}</span><br>
                                                        <label>{$LBL_RFQ2_CODE}:</label>&nbsp;{$latestaward[l].vRFQ2Code}<br>
                                                        <label>{$LBL_BUYER2}:</label>&nbsp;{$latestaward[l].vCompanyName}<br>
                                                        <label>{$LBL_ADVANCE_TOTAL}:</label>&nbsp;{$latestaward[l].fBidAdvanceTotal}<br>
                                                        <label>{$LBL_PRICE_TOTAL}:</label>&nbsp;{$latestaward[l].fBidPriceTotal}<br>
                                                        <label>{$LBL_STATUS}:</label>&nbsp;{$latestaward[l].vStatus_en}
													</div>
												</li>
                                                {sectionelse}
                                                 <li class="clearfix">
													<div class="title">
														{$LBL_NO_REC_AVAILABLE}
													</div>
												</li>
                                                {/section}
											</ul>
										</div>

										<footer class="main-box-header clearfix">
                                            <a href="{$SITE_URL_DUM}rfq2awardlist">
											<button class="btn btn-primary pull-right">{$LBL_VIEW_MORE}</button>
                                                </a>
										</footer>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-8">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>{$LBL_STATISTICS}</h2>
										</header>

										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
                                                    <thead>
														<tr>
                                                            <th>&nbsp;</th>
                                                            {section name="l" loop=$sts}
															<th  class="text-center">
																<span>{$sts[l].vStatus|htmlentities}</span>
															</th>
                                                            {/section}
															<th  class="text-center">
                                                                {$LBL_TOTAL}
                                                            </th>
                                                            <th></th>
														</tr>
                                                    </thead>
                                                    <tbody>
														{if $orgtype neq 'Supplier'}
                                                        <tr>
                                                            <td class="text-center">{$LBL_PO_ISSUANCE}</td>
                                                            <td class="text-center">{if $crstatisu[0].pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','Create','{$crpo}','isu')">{/if}{$crstatisu[0].pocnt}{if $crstatisu[0].pocnt >0}</a>{/if}</td>
                                                            <td class="text-center">{if $vstatistics[0].pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','Verify','{$povisu}','isu')">{/if}{$vstatistics[0].pocnt}{if $vstatistics[0].pocnt >0}</a>{/if}</td>
                                                            {assign var="poisusts" value=$isustats.poisu}
                                                            {foreach key="ky" item="itm" from=$poisusts}
                                                                {if $itm.eFor eq 'PO'}
                                                                    <td class="text-center">{if $itm.pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','{$itm.vStatus_en}','{$ky}','isu')">{/if}{$itm.pocnt}{if $itm.pocnt >0}</a>{/if}</td>
                                                                {/if}
      		                                                {/foreach}
                                                            <td class="text-center">{if $tisu[0].tpoisu >0}{/if}<b>{$tisu[0].tpoisu}</b>{if $tisu[0].tpoisu >0}{/if}</td>
                                                        </tr>
                                                        {/if}

                                                        {if $orgtype neq 'Buyer'}
                                                        <tr>
                                                            <td class="text-center">{$LBL_INVOICE_ISSUANCE}</td>
                                                            {assign var="invisutotal" value=0}
                                                            <td class="text-center">{if $crstatisu[0].iocnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','Create','{$crio}','isu')">{assign var="invisutotal" value=`$crstatisu[0].iocnt+$invisutotal`}{/if}{$crstatisu[0].iocnt}</a></td>
                                                            <td class="text-center">{if $vstatistics[0].iocnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','Verify','{$iovapt}','isu')">{assign var="invisutotal" value=`$vstatistics[0].iocnt+$invisutotal`}{/if}{$vstatistics[0].iocnt}{if $vstatistics[0].iocnt >0}</a>{/if}</td>
                                                            {assign var="ioisusts" value=$isustats.invisu}
                                                            {foreach key="ky" item="itm" from=$ioisusts}
                                                                {*if $itm.vStatus_en neq 'Verify'*}
                                                            {if $itm.eFor eq 'Invoice'}
                                                            <td class="text-center">
                                                                {if $itm.incnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','{$itm.vStatus_en}','{$ky}','isu')">{assign var="invisutotal" value=`$itm.incnt+$invisutotal`}{/if}{$itm.incnt}{if $itm.incnt >0}</a>{/if}
                                                            </td>
                                                            {*/if*}
                                                                {/if}
      		                                                {/foreach}
                                                            <td class="text-center"><b>{$invisutotal}</b></td>

                                                        </tr>
                                                        {/if}
                                                        {if $orgtype neq 'Buyer'}
                                                        <tr>
                                                            <td class="text-center">{$LBL_PO_ACCEPTANCE}</td>
                                                            <td class="text-center">{if $crstatact[0].pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','Create','{$crpo}','acpt')">{/if}{$crstatact[0].pocnt}{if $crstatact[0].pocnt >0}</a>{/if}</td>
                                                            <td class="text-center">{if $avstatistics[0].pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','Verify','{$povisu}','acpt')">{/if}{$avstatistics[0].pocnt}{if $avstatistics[0].pocnt >0}</a>{/if}</td>
                                                            {assign var="poactsts" value=$acptstats.poacpt}
                                                            {foreach key="ky" item="itm" from=$poactsts}
                                                            {if $itm.eFor eq 'PO'}
                                                                <td class="text-center">{if $itm.pocnt >0}<a style="cursor:pointer;" onclick="showlist('PO','{$itm.vStatus_en}','{$ky}','acpt')">{/if}{$itm.pocnt}{if $itm.pocnt >0}</a>{/if}</td>
                                                            {/if}
      		                                                {/foreach}
                                                            <td class="text-center">{if $tact[0].tpoact >0}<a href="{$SITE_URL_DUM}poacptlist/all">{/if}<b>{if $tact[0].tpoact >0}{$tact[0].tpoact}{else}0{/if}</b>{if $tact[0].tpoact >0}</a>{/if}</td>
                                                            <td></td>
                                                        </tr>
                                                        {/if}

                                                        {if $orgtype neq 'Supplier'}
                                                        <tr>
                                                            <td class="text-center">{$LBL_INVOICE_ACCEPTANCE}</td>
                                                            <td class="text-center">{if $crstatact[0].iocnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','Create','{$crio}','acpt')">{/if}{$crstatact[0].iocnt}</a></td>
                                                            <td class="text-center">{if $avstatistics[0].iocnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','Verify','{$iovapt}','acpt')">{/if}{$avstatistics[0].iocnt}{if $avstatistics[0].iocnt >0}</a>{/if}</td>
                                                            {assign var="ioactsts" value=$acptstats.invacpt}
                                                            {foreach key="ky" item="itm" from=$ioactsts}
                                                                {if $itm.eFor eq 'Invoice'}
                                                                    <td class="text-center">{if $itm.incnt >0}<a style="cursor:pointer;" onclick="showlist('Invoice','{$itm.vStatus_en}','{$ky}','acpt')">{/if}{$itm.incnt}{if $itm.incnt >0}</a>{/if}</td>
                                                                {/if}
      		                                                {/foreach}
                                                            <td class="text-center">{if $tact[0].tioact >0}{/if}<b>{$tact[0].tioact}</b>{if $tact[0].tioact >0}{/if}</td>
                                                        </tr>
                                                        {/if}
                                                        <tr><td colspan="11" class="text-center"></td></tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left">{$LBL_LAST_3_LOGIN}</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                {section name=l loop=$lastlogins}
                                                <li class="clearfix">
													<div class="date">
														<i class="fa fa-clock-o pull-left"></i>
														{$LBL_LAST_LOGIN} : {$lastlogins[l].dLoginDate|calcLTzTime|DateTime:7}
													</div>
													<div class="ipaddress">
														<i class="fa fa-map-marker pull-left"></i>
														{$lastlogins[l].vIP}
													</div>
												</li>
                                                {sectionelse}
                                                    <li class="clearfix">
													<div class="date">
														{$LBL_NO_REC_AVAILABLE}
													</div>
												</li>
                                                {/section}
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
											<h2>{$LBL_RFQ2}&nbsp;{$LBL_STATISTICS}</h2>
										</header>
                                        {assign var="field" value="vStatus_"|cat:$LANG}
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
                                                      <thead>
														<tr>
                                                            <th>&nbsp;</th>
                                                            {section name="l" loop=$rfq2sts}
                                                            <th  class="text-center">
                                                                <span>
																{if $rfq2sts[l].vStatus|htmlentities eq "Accepted"}
                                                                    {$LBL_ISSUED}
                                                                {else}
                                                                    {$rfq2sts[l].vStatus|htmlentities}
                                                                {/if}
                                                                    </span>
															</th>
                                                            {/section}
															<th  class="text-center">
																{$LBL_TOTAL}
															</th>
														</tr>
                                                      </thead>
                                                    <tbody>
														<tr>
															<td  class="text-center">
																{$LBL_RFQ2}
															</td>
                                                            {assign var='st' value=0}
			                                                    {section name="l" loop=$rfq2sts}
															<td class="text-center">
                                                                {assign var="vl" value=$rfq2sts[l].vStatus_en}
                                                                {if $r2stats.$vl neq ''}
                                                                {if $r2stats.$vl neq 0}
                                                                     <a href="{$SITE_URL_DUM}rfq2list/{if $vl neq 'Rejected'}{$st}{else}{$rfq2sts[l].iStatusID}{/if}">{$r2stats.$vl}</a>
                                                                  {else}
                                                                  {$r2stats.$vl}
                                                                  {/if}
                                                                     {assign var='st' value=$rfq2sts[l].iStatusID}
                                                                {else} x {/if}
															</td>
                                                            {/section}
                                                            <td class="text-center">
                                                                {if $r2stats.ttol neq ''}{$r2stats.ttol}{else}0{/if}
                                                            </td>
														</tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                {$LBL_AWARD}
                                                            </td>
                                                            {assign var="tot" value=0}
			                                                {section name="l" loop=$rfq2sts}
                                                                <td class="text-center">
                                                                    {if $rfq2sts[l].iStatusID|in_array:$aworgsts || $rfq2sts[l].vStatus_en eq 'Accepted' || $rfq2sts[l].vStatus_en eq 'Verify'}
                                                                        {if $rfq2sts[l].vStatus_en eq 'Create'}
                                                                            <a href="{$SITE_URL_DUM}rfq2awardlist/1">{$saved_award[0].tot}</a>
                                                                            {assign var="tot" value=`$tot+$saved_award[0].tot`}
                                                                            {elseif $rfq2sts[l].vStatus_en eq 'Verify'}
                                                                            {assign var="vvl" value=$rfq2sts[l].iStatusID}
                                                                            {if $rfq2sts[l].iStatusID|in_array:$aworgsts}
                                                                                {if $award.$vl neq ''}
                                                                                    {if $award.$vl > 0}
                                                                                        <a href="{$SITE_URL_DUM}rfq2awardlist/{$rfq2sts[l].iStatusID}">{$award.$vl}</a>
                                                                                        {assign var="tot" value=`$tot+$award.$vl`}
                                                                                        {else}
                                                                                        {$award.$vl}
                                                                                    {/if}
                                                                                    {else} 0 {/if}
                                                                                {else} x {/if}
                                                                            {elseif $rfq2sts[l].vStatus_en eq 'Rejected'}
                                                                            {assign var="cvl" value=$rfq2sts[l].iStatusID}
                                                                            <a href="{$SITE_URL_DUM}rfq2awardlist/{$rfq2sts[l].iStatusID}">{$award.$cvl}</a>
                                                                            {assign var="tot" value=`$tot+$award.$cvl`}
                                                                            {elseif $rfq2sts[l].vStatus_en eq 'Accepted'}
                                                                            <a href="{$SITE_URL_DUM}rfq2awardlist/2">{$award.$vvl}</a>
                                                                            {assign var="tot" value=`$tot+$award.$vvl`}
                                                                            {else}
                                                                            {if $award.$vl neq ''}
                                                                                {if $award.$vl > 0}
                                                                                    <a href="{$SITE_URL_DUM}rfq2awardlist/{$rfq2sts[l].iStatusID}">{$award.$vl}</a>
                                                                                    {assign var="tot" value=`$tot+$award.$vl`}
                                                                                    {else}
                                                                                    {$award.$vl}
                                                                                {/if}
                                                                                {else} 0 {/if}
                                                                        {/if}
                                                                        {assign var="vl" value=$rfq2sts[l].iStatusID}
                                                                        {else} x {/if}
                                                                </td>
                                                            {/section}
                                                            <td class="text-center">
                                                                {if $tot neq ''}{$tot}{else}0{/if}
                                                            </td>
                                                        </tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
                                    <div class="main-box clearfix">
                                        <header class="main-box-header clearfix">
                                            <h2>{$LBL_RFQ2}&nbsp;{$LBL_COUNTS}</h2>
                                        </header>

                                        <div class="main-box-body clearfix">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center"></th>
                                                    {section name=l loop=$cntsts}
                                                        <th  class="text-center">
                                                            <span>{$cntsts[l]}</span>
                                                        </th>
                                                    {/section}
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-center">{$LBL_RFQ2}</td>
                                                    {assign var='ln' value=0}

                                                    {section name="l" loop=$cntsts}
                                                        {if $cntsts[l] eq 'Not Started'}
                                                            {assign var='rfq2ls' value=0}
                                                        {/if}
                                                        {if $cntsts[l] eq 'Live'}
                                                            {assign var='rfq2ls' value=1}
                                                        {/if}
                                                        {if $cntsts[l] eq 'Completed'}
                                                            {assign var='rfq2ls' value=2}
                                                        {/if}
                                                        {if $cntsts[l] eq 'Cancelled'}
                                                            {assign var='rfq2ls' value=2}
                                                        {/if}
                                                        <td class="text-center" >
                                                            {if $cntsts[l]|in_array:$r2sts}{if $cntsts[l] neq 'Awarded'}
                                                                <a href="{$SITE_URL_DUM}rfq2list/{$rfq2ls}/rfq2count">{$rfq2stats[$ln].cnt}</a>{else}{$rfq2stats[$ln].cnt}{/if}{assign var='ln' value=`$ln+1`}{else}
                                                                0 {/if}
                                                        </td>
                                                    {/section}
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
											<h2 class="pull-left">{$LBL_RFQ2}</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                {section name=l loop=$latestrfq2}
                                                <li class="clearfix">
													<div class="title">
														{$LBL_RFQ2_CODE}:<a href="{$SITE_URL_DUM}rfq2view/{$latestrfq2[l].iRFQ2Id}">{$latestrfq2[l].vRFQ2Code}</a>
													</div>
													<div class="post-time">
														{$LBL_INVOICE_CODE}: {$latestrfq2[l].vInvoiceCode}&nbsp; {$LBL_TYPE}: {$latestrfq2[l].eAuctionType}
                                                        {$LBL_START_DATE}: {$latestrfq2[l].dStartDate|calcLTzTime|DateTime:10}&nbsp;{$LBL_END_DATE}:{$latestrfq2[l].dEndDate|calcLTzTime|DateTime:10}
                                                        {$LBL_STATUS}:{$latestrfq2[l].eAuctionStatus}
													</div>
													<div class="time-ago">
														<i class="fa fa-clock-o"></i> 5 min.
													</div>
												</li>
                                                {sectionelse}
                                                <li class="clearfix">
													<div class="title">
                                                        {$LBL_NO_REC_AVAILABLE}
                                                    </div>
                                                </li>
                                                {/section}
											</ul>
										</div>

										<footer class="main-box-header clearfix">
                                            <a href="{$SITE_URL_DUM}rfq2list">
											    <button class="btn btn-primary pull-right">{$LBL_VIEW_MORE}</button>
                                            </a>
										</footer>
									</div>
								</div>
								<!-- RFQ2 counts -->

							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left">{$LBL_PURCHASE_ORDER}</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                {section name=l loop=$latestpo}
                                                    <li class="clearfix">
													<div class="ordername"><a href="{$SITE_URL_DUM}purchaseorderview/{$latestpo[l].iPurchaseOrderID}">{$latestpo[l].vPoBuyerCode}</a></div>
													<div class="company-name pull-left">
                                                        <p>
                                                        {$latestpo[l].supplierorg} {*$latestpo[l].vCompanyName*}, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                            {$LBL_CREATED_DATE} : <span>{$latestpo[l].addDate|calcLTzTime|DateTime:'0'}</span> <br />
                                                        {$latestpo[l].vCity}, {$latestpo[l].vState}, {$latestpo[l].vCountry} &nbsp; <br />
                                                        {*}Contact Party :<a href="mailto:info@abccorprjsanf.com"> <span>Party Name</span></a><br />{*}
                                                        {$LBL_STATUS} : <span>Active</span>
                                                        </p>
                                                    </div>
												</li>
                                                {sectionelse}
                                                <li class="clearfix">
													<div class="ordername">{$LBL_NO_REC_AVAILABLE}</div>
                                                   </li>
                                                 {/section}
											</ul>
										</div>
										<footer class="main-box-header clearfix">
                                            {if $orgtype eq 'Supplier'}
                                            <a href="{$SITE_URL_DUM}poacptlist">
											<button class="btn btn-primary pull-right">{$LBL_VIEW_MORE}</button>
                                                </a>
                                            {else}
                                            <a href="{$SITE_URL_DUM}polist">
											<button class="btn btn-primary pull-right">{$LBL_VIEW_MORE}</button>
                                                </a>
                                            {/if}
										</footer>
									</div>
								</div>

								<div class="col-md-6">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left">{$LBL_INVOICE_ORDER}</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                {section name=l loop=$latestio}
                                                <li class="clearfix">
													<div class="ordername"><a href="{$SITE_URL_DUM}invoiceview/{$latestio[l].iInvoiceID}">{$latestio[l].vInvSupplierCode}</a></div>
													<div class="company-name pull-left">
                                                         <p>
                                                             {$latestio[l].buyerorg} {*$latestio[l].buyerorg*}, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                {$LBL_CREATED_DATE} : <span>{$latestio[l].addDate|calcLTzTime|DateTime:'0'}</span> <br />
                                                             {$latestio[l].vCity}, {$latestio[l].vState}, {$latestio[l].vCountry} &nbsp; <br />
                                                             {*}Contact Party :<a href="mailto:info@abccorprjsanf.com"> <span>Party Name</span></a><br />{*}
                                                             {$LBL_STATUS} : <span>Active</span>
                                                         </p>
                                                    </div>
												</li>
                                                {sectionelse}
                                                <li class="clearfix">
													<div class="ordername">{$LBL_NO_REC_AVAILABLE}</div>
                                                </li>
                                                {/section}
											</ul>
										</div>

										<footer class="main-box-header clearfix">
                                            {if $orgtype eq 'Buyer'}
                                            <a href="{$SITE_URL_DUM}invacptlist">
											<button class="btn btn-primary pull-right">{$LBL_VIEW_MORE}</button>
                                                    </a>
                                            {else}
                                                <a href="{$SITE_URL_DUM}invoicelist">
											<button class="btn btn-primary pull-right">{$LBL_VIEW_MORE}</button>
                                                    </a>
                                            {/if}

										</footer>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="main-box feed">
										<header class="main-box-header clearfix">
											<h2 class="pull-left">{$LBL_INBOX} ({$totInboxres})</h2>
										</header>

										<div class="main-box-body clearfix">
											<ul>
                                                {if $res|@count gt 0}
                                                 {assign var="field" value="vMailSubject_"|cat:$LANG}
                                                 {section name=in loop=$res}
                                                    <strong><a href="{$SITE_URL_DUM}inboxdetail/{$res[in].iVerifiedID}">{$res[in].$field}</a></strong>
                                                    <strong>{$res[in].dActionDate|calcLTzTime|getInboxDate}</strong>
                                                 {/section}
                                                    {if $totInboxres gt $res|@count}<em><a href="{$SITE_URL_DUM}inbox" >{$LBL_VIEW_MORE}</a></em>{/if}
                                                 {else}
                                                 <li class="clearfix">
                                                    {$LBL_NO_RECENT_MESSAGES}
												</li>
                                                 {/if}

											</ul>
										</div>
										<footer class="main-box-header clearfix">
                                            <a href="{$SITE_URL_DUM}inbox">
											<button class="btn btn-primary pull-right">{$LBL_VIEW_MORE}</button>
                                                </a>
										</footer>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>




<script src="{$SITE_JS}jquery.js"></script>
<script src="{$SITE_JS}bootstrap.js"></script>
<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>

<script src="{$SITE_JS}demo.js"></script> <!-- only for demo -->

<!-- this page specific scripts -->
<script src="{$SITE_JS}moment.min.js"></script>
<script src="{$SITE_JS}jquery-jvectormap-1.2.2.min.js"></script>
<script src="{$SITE_JS}jquery-jvectormap-world-merc-en.js"></script>
<script src="{$SITE_JS}gdp-data.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.min.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.resize.min.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.time.min.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.threshold.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.axislabels.js"></script>
<script src="{$SITE_JS}jquery.sparkline.min.js"></script>
<script src="{$SITE_JS}skycons.js"></script>

<!-- theme scripts -->
<script src="{$SITE_JS}scripts.js"></script>
<script src="{$SITE_JS}pace.min.js"></script>
{*<script type="text/javascript" src="{$S_JQUERY}jquery.js"></script>
<script type="text/javascript" src="{$SITE_CONTENT_JS}jgeneral.js"></script>*}
{literal}
<script type="text/javascript">
var cookie = '{/literal}{$tDashboard}{literal}';
</script>
{/literal}
<script type="text/javascript" src="{$SITE_JS_AJAX}jOuDashboard.js" async="async"></script>