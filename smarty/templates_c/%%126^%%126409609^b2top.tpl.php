<?php /* Smarty version 2.6.0, created on 2015-07-12 20:01:12
         compiled from top/user/b2top.tpl */ ?>
<header class="navbar" id="header-navbar">
			<div class="container">
				<a href="#" id="logo" class="navbar-brand">
					<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
/exchainge.png" alt="" class="normal-logo logo-white"/>
				</a>

				<div class="clearfix">
				<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>

				<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
					<ul class="nav navbar-nav pull-left">
						<li>
							<a class="btn" id="make-small-nav">
								<i class="fa fa-bars"></i>
							</a>
						</li>
						<li class="dropdown hidden-xs">
							<a class="btn dropdown-toggle" data-toggle="dropdown">
								English
								<i class="fa fa-caret-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li class="item">
									<a href="#">
										French
									</a>
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
								<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
/exchainge.png" alt=""/>
								<span class="hidden-xs">Scarlett Johansson</span> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
oueditprofile"><i class="fa fa-user"></i>Edit Profile</a></li>
								<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
changepass/<?php echo $this->_tpl_vars['iUserId']; ?>
"><i class="fa fa-cog"></i>Change Password</a></li>
								<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
logout"><i class="fa fa-power-off"></i>Logout</a></li>
							</ul>
						</li>
						<li class="hidden-xxs">
							<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
logout" class="btn">
								<i class="fa fa-power-off"></i>
							</a>
						</li>
					</ul>
				</div>
				</div>
			</div>
		</header>
<?php echo '
<script>

function changLang(val) {
   document.frmlanguage.lang_code.value = val;
	document.frmlanguage.submit();
}
</script>
'; ?>