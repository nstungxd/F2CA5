<?php
require("../dal_pb.php");
if ($_POST)
{
    $email = trim($_POST['txtEmail']);
    $pass = md5(trim($_POST['txtPassword']));
    $rs_login = login_adminpanel($email,$pass);

    if($rs_login != '')
    {
        $_SESSION['acc_type']=$rs_login['acc_type'];
        $_SESSION['id']=$rs_login['id'];
        if($rs_login['acc_type'] == '1')
        {
            echo '<script type="text/javascript">'
                , 'window.location.href="admin.php";'
                , '</script>';
        }
        else if($rs_login['acc_type'] =='2')
        {
            echo '<script type="text/javascript">'
            , 'window.location.href="practice.php";'
            , '</script>';
        }
    }
    else $error = 'Invalid email or password. Please check again';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Login panel</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="../css/styles.css" rel="stylesheet">
	</head>
	<body>

<!--login modal-->
<form action="" method="post">
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Login</h1>
      </div>
      <?php if(isset($error) && $error!=''){ ?>
      <div class="has-error">
           <div class="alert alert-danger" role="alert">
        <strong>Error ! </strong><?php echo $error ?>
      </div>
      </div>
      <?php } ?>
      <div class="modal-body">
          <form class="form col-md-12 center-block">
            <div class="form-group">
              <input type="text" name="txtEmail" id="txtEmail" class="form-control input-lg" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="password" name="txtPassword" name="txtPassword" class="form-control input-lg" placeholder="Password">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">

		  </div>
      </div>
  </div>
  </div>
</div>
<!-- Powered By Footer -->
<div>
<img src="/portal/admin/images/AM-tv-black-Logo.png">
</div>
    </form>
	<!-- script references -->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>
