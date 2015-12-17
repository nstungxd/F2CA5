<form name="frmlanguage" action="{$SITE_URL}index.php?file=c-language" method="post" style="margin:0px; padding:0px;">
    <input type="Hidden" name="lang_code" id="lang_code" value="{$LANG}" />
<header class="navbar" id="header-navbar">
			<div class="container">
				<a href="#" id="logo" class="navbar-brand">
					<img src="{$SITE_IMAGES}/exchainge.png" alt="" class="normal-logo logo-white"/>
				</a>

				<div class="clearfix">
				<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>

				<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
                    {*<span onclick="changLang('en');" style="cursor:pointer; padding:0px;" >EN</span>&nbsp;/&nbsp;
                    <span onclick="changLang('fr');" style="cursor:pointer; padding:0px;" >FR</span></span>*}
					<ul class="nav navbar-nav pull-left">
						<li>
							<a class="btn" id="make-small-nav">
								<i class="fa fa-bars"></i>
							</a>
						</li>
						<li class="dropdown hidden-xs">
							<a class="btn dropdown-toggle" data-toggle="dropdown">
								{if $LANG eq 'en'}
                                    English
                                {else}
                                    French
                                {/if}
								<i class="fa fa-caret-down"></i>

							</a>
							<ul class="dropdown-menu">
								<li class="item">
                                {if $LANG eq 'en'}
                                    <a>
                                        <span onclick="changLang('fr');" style="cursor:pointer; padding:0px;" > French</span>
                                    </a>
                                {else}
                                <a>
                                        <span onclick="changLang('en');" style="cursor:pointer; padding:0px;" >English</span>
                                 </a>
                                {/if}

								</li>
							</ul>
						</li>
					</ul>
				</div>

				<div class="nav-no-collapse pull-right" id="header-nav">
					<ul class="nav navbar-nav pull-right">
						<li class="mobile-search">
							<a class="btn">
								<i class="fa fa-search"></i>
							</a>

							<div class="drowdown-search">
								<form role="search">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Search...">
										<i class="fa fa-search nav-search-icon"></i>
									</div>
								</form>
							</div>

						</li>
						<li class="dropdown profile-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="{$SITE_IMAGES}/exchainge.png" alt=""/>
								<span class="hidden-xs">{$sess_user_name} ({$sess_usertype_short})</span> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{$SITE_URL_DUM}oueditprofile"><i class="fa fa-user"></i>Edit Profile</a></li>
								<li><a href="{$SITE_URL_DUM}changepass/{$iUserId}"><i class="fa fa-cog"></i>Change Password</a></li>
								<li><a href="{$SITE_URL_DUM}logout"><i class="fa fa-power-off"></i>Logout</a></li>
							</ul>
						</li>
						<li class="hidden-xxs">
							<a href="{$SITE_URL_DUM}logout" class="btn">
								<i class="fa fa-power-off"></i>
							</a>
						</li>
					</ul>
				</div>
				</div>
			</div>
		</header>
</form>
{literal}
<script>

function changLang(val) {
   document.frmlanguage.lang_code.value = val;
	document.frmlanguage.submit();
}
</script>
{/literal}