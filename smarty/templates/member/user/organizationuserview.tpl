<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<div id="content-header" class="clearfix">
								<div class="pull-left">
									<ol class="breadcrumb">
										<li><a href="#">Home</a></li>
										<li class="active"><span>{$LBL_USER_PROFILE}</span></li>
									</ol>

									<h1>{$LBL_USER_PROFILE}</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="main-box">
							<header class="main-box-header clearfix">

							</header>

                            <div class="main-box-body clearfix">
                                     {if $sess_usertype neq 'orguser'}
                                        <div class="alert alert-success">
                                            <i class="fa fa-info-circle fa-fw fa-lg"></i>
                                            <strong><a class="{if $file eq 'u-organizationuserview'}current{/if}"><EM>{$LBL_ORG_USER}</EM></a></strong>

                                        </div>
                                        {if $OuserData.eUserType eq 'User'}
                                        <div class="alert alert-success">
                                            <i class="fa fa-info-circle fa-fw fa-lg"></i>
                                            <strong><a href="{$SITE_URL_DUM}userrights/{$userData.iUserID}"
                                               class="{if $file eq 'u-userrights'}current{/if}"><EM>{$LBL_ORG_USER_ACCESS_RIGHTS}</EM></a></strong>
                                        </div>
                                        {/if}
                                     {/if}
                                    {if $msg neq '' && (($OuserData.eStatus neq 'Active' && $OuserData.eStatus neq 'Inactive') || $udts.eNeedToVerify eq 'Yes')}
                                        <div class="alert alert-warning">
                                           {$msg}
                                        </div>
                                    {/if}
                                     <a class="" href="javascript:openpopup('{$SITE_URL_DUM}orguserviewhistory/{$userData.iUserID}');" ><button type="button" class="btn btn-primary">{$LBL_VIEW_HISTORY}</button></a>

                                <form class="form-horizontal" name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-oueditprofile_a" method="post">
                                    <input type="hidden" name="iUserID" id="iUserID" value="{$iUserID}" />
                                    <input type="hidden" name="view" id="view" value="{$view}" />
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_USER_TYPE}</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" value="{$userData.eUserType}" >
                                            </div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_FIRST_NAME}</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" value="{$userData.vFirstName}" >
                                            </div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_LAST_NAME}</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" value="{$userData.vLastName}" >
                                            </div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Salutation </label>
										<div class="col-md-6">
                                            <input type="text" class="form-control" value="{$userData.eSalutation}" >
                                            </div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_ORGANIZATION} </label>
										<div class="col-md-6">
                                            <input type="text" class="form-control" value="{$organization[0].vCompanyName}({$organization[0].vOrganizationCode})" >
                                            </div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_COMP_CODE} </label>
										<div class="col-md-6">
                                            <input type="text" class="form-control" value="{$organization[0].vCompCode}" >
                                            </div>
									</div>
                                    <div class="form-group">
										<label class="col-md-2 control-label">{$LBL_USER_NAME} </label>
										<div class="col-md-6">
                                            <input type="text" class="form-control" value="{$userData.vUserName}" >
                                            </div>
									</div>
                                    {if $sess_usertype neq 'orguser'}
                                    <div class="form-group">
										<label class="col-md-2 control-label">{$LBL_PASSWORD} </label>
										<div class="col-md-6">
                                            <input type="text" class="form-control" value="{if $userData.vPassword neq ''}#####{else}---{/if}" >
                                            </div>
									</div>
                                    {/if}
                                    <div class="form-group">
										<label class="col-md-2 control-label">{$LBL_ADDR_LINE} 1</label>
										<div class="col-md-6">
											<input type="text" class="form-control" value="{$userData.vAddressLine1}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_ADDR_LINE} 2</label>
										<div class="col-md-6">
											<input type="text" class="form-control" value="{$userData.vAddressLine2}">
										</div>
									</div>
									<div class="form-group">
										<label  class="col-md-2 control-label">{$LBL_ADDR_LINE} 3</label>
										<div class="col-md-6">
											<input type="text" class="form-control" value="{$userData.vAddressLine3}" >
										</div>
									</div>
									<div class="form-group form-group-select2">
										<label class="col-md-2 control-label" >{$LBL_COUNTRY}</label>
										<div class="col-md-6">
                                        {section name=i loop=$db_country}
                                            {if $userData.vCountry eq $db_country[i].vCountryCode}
                                                {$db_country[i].vCountry}
                                            {/if}
                                        {/section}
										</div>
									</div>
									<div class="form-group form-group-select2">
										<label class="col-md-2 control-label" for="vState">{$LBL_STATE}</label>
										<div class="col-md-6">
											<input type="hidden" name="selstate" id="selstate" value="{$userData.vState}">
                                            {section name=i loop=$db_state}
                                                  {if $userData.vState eq $db_state[i].vStateCode}
                                                       {$db_state[i].vState}
                                                  {/if}
                                            {/section}
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_CITY}</label>
										<div class="col-md-6">
											<input type="text" value="{$userData.vCity}" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_ZIP_CODE}</label>
										<div class="col-md-6">
											<input type="number" class="form-control" value="{$userData.vZipCode}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_PHONE}</label>
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-phone"></i></span>
												<input type="text" class="form-control" value="{$userData.vPhoneCode}" >
											</div>
										</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{$userData.vPhone}" >
                                                </div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_EXTENTION} </label>
										<div class="col-md-6">
											<input type="text" class="form-control" value="{$userData.vExtention}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">{$LBL_MOBILE}</label>
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
												<input type="text" class="form-control" value="{$userData.vMobileCode}">
											</div>
										</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{$userData.vMobile}" />
                                            </div>
									</div>
									<div class="form-group">
										<label for="vEmail" class="col-md-2 control-label">{$LBL_EMAIL}</label>
										<div class="col-md-6">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
												<input type="email" class="form-control"  value="{$userData.vEmail}">
											</div>
										</div>
									</div>
                                    {if $sess_usertype neq 'orguser'}
                                    <div class="form-group">
										<label class="col-md-2 control-label">{$LBL_PER_TYPE}</label>
										<div class="col-md-6">
											<input type="text" value="{$userData.ePermissionType}" class="form-control">
										</div>
									</div>
                                    {if $userData.ePermissionType eq 'Group'}
                                    <div class="form-group">
										<label class="col-md-2 control-label">{$LBL_GROUP} </label>
										<div class="col-md-6">
											<input type="text" value="{$userData.vGroupName}" class="form-control">
										</div>
									</div>
                                    {/if}
                                    {/if}
									<div class="form-group">
										<label for="secret1" class="col-md-2 control-label">{$LBL_SEC_QUESTION}1</label>
										<div class="col-md-6">
                                            {$secQuestion1}
										</div>
									</div>
									<div class="form-group">
										<label for="vAnswer" class="col-md-2 control-label">{$LBL_ANSWER}</label>
										<div class="col-md-6">
											<input type="text" class="form-control" value="{if $userData.vAnswer neq ''}#####{else}---{/if}">
										</div>
									</div>
                                    {if $userData.iSecretQuestion2ID gt 0}
                                    <div class="form-group">
										<label class="col-md-2 control-label">{$LBL_SEC_QUESTION}2</label>
										<div class="col-md-6">
											{$secQuestion2}
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-md-2 control-label">{$LBL_ANSWER}</label>
										<div class="col-md-6">
											<input type="text" value="{if $userData.vAnwser neq ''}#####{else}---{/if}" class="form-control">
										</div>
									</div>
                                    {/if}
									<div class="form-group">
										<label for="eEmailNotification" class="col-md-2 control-label">{$LBL_ONLINE_EMAIL_NOTIFICATION}</label>
										<div class="col-md-6">
                                             {$userData.eEmailNotification}

										</div>
									</div>
									<div class="form-group">
										<label for="vLanguage" class="col-md-2 control-label">{$LBL_Default_Language}</label>
										<div class="col-md-6">
                                            {$defaltLan}
										</div>
									</div>
                                    {if $verify eq 'yes'}
                                    <div class="form-group">
										<label class="col-md-2 control-label">{$LBL_REASON_TO_REJECT}</label>
										<div class="col-md-6">
											<textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3" class="form-control"></textarea>
										</div>
									</div>
                                    {/if}
					                {if $vusrdt[0].iRejectedById gt 0 && $vusrdt[0].tReasonToReject|trim neq ''}
                                    <div class="form-group">
										<label class="col-md-2 control-label">{$LBL_REASON_TO_REJECT}</label>
										<div class="col-md-6">
											<div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;">{$vusrdt[0].tReasonToReject|trim}</div>
										</div>
									</div>

                                    {/if}
                                    <center class="form-group">
                                        <button type="button"  class="btn btn-primary" {if $verify eq 'yes'}onclick="location.href='{$SITE_URL_DUM}verifyorganizationuserlist'"{else}onclick="location.href='{$SITE_URL_DUM}organizationuserlist'"{/if}>Back</button>
                                    {if $verify eq 'yes' || $usrvrfy eq 'yes'}
                                        <button type="button" class="btn btn-primary" onclick="$('#view').val('verify');$('#frmadd').submit();">Verify</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#view').val('reject');$('#frmadd').submit();">Reject</button>
                                    {/if}
                                        {if $OuserData.eStatus eq 'Modified'}
                                            <a class="colorbox"
                                               href="{$SITE_URL_DUM}index.php?file=u-aj_useroverview&id={$OuserData.iUserID}"
                                               onmouseover="CallColoerBox(this.href,600,500,'file');"><button type="button" class="btn btn-primary">Click Here to view  Original </button></a>
                                        {/if}
                                    </center>
								</form>
							</div>
						</div>
					</div>



				</div>


<script src="{$SITE_JS}jquery.js"></script>
<script src="{$SITE_JS}bootstrap.js"></script>
<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>


<!-- this page specific scripts -->
<script src="{$SITE_JS}jquery.maskedinput.min.js"></script>
<script src="{$SITE_JS}select2.min.js"></script>
<script src="{$SITE_JS}modernizr.custom.js"></script>
<script src="{$SITE_JS}classie.js"></script>
<script src="{$SITE_JS}modalEffects.js"></script>
<!-- theme scripts -->
<script src="{$SITE_JS}scripts.js"></script>
<script src="{$SITE_JS}pace.min.js"></script>
