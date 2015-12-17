<?php
require("../dal_pb.php");
if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type']!='1' )
{
     echo '<script type="text/javascript">'
            , 'window.location.href="index.php";'
            , '</script>';
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Admin</title>
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
    <div>
    <div class="container">
        <div class="col-md-12">
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="admin.php">Home</a></li>
                <li role="presentation"><a href="practice_detail.php">Add Practice</a></li>
                <li role="presentation"><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="page-header">
                <h1>Doctors Directory</h1>
            </div>
        </div>
        <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary" href="practice_detail.php" >Add Practice</a>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Practice Name</th>
                <th>Address</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
            <?php $rs_query = getAllPractice(); while ($r1 = mysql_fetch_array($rs_query)) { ?>
              <tr>
                <td><?php echo $r1['id'] ?></td>
                <td><?php echo $r1['email'] ?></td>
                <td><?php echo $r1['name'] ?></td>
                <td><?php echo $r1['address'] ?></td>
                <td><a class="btn btn-primary" href="practice_detail.php?id=<?php echo $r1['id'] ?>" >EDIT</a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        
      </div>
     </div>
    </body>
</html>