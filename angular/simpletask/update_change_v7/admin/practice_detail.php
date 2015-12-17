<?php
require("../dal_pb.php");
$e_id='';
$e_email='';
$e_address='';
$e_title='';
$e_name='';
$e_logo='';
$e_footer='';
$error='';
if (!isset($_SESSION['acc_type']) || !isset($_SESSION['id'])  || $_SESSION['acc_type']!='1' )
{
    echo '<script type="text/javascript">'
    , 'window.location.href="index.php";'
    , '</script>';
}
if ($_POST) {
    $email = trim($_POST['txtEmail']);
    $pass = trim($_POST['txtPassword']);
    $name = trim($_POST['txtName']);
    $address = trim($_POST['txtAddress']);
    $title = trim($_POST['txtTitle']);
    $template = trim($_POST['template']);
    $footer = trim($_POST['txtFooter']);
    $logo = '';
    if (isset($_POST["hid"]) && $_POST["hid"] != '') {
        $id = trim($_POST['hid']);
        $update_practice = updatePractice($id, $email, $pass, $name, $address, $title, $logo, $template, $footer);
        if ($update_practice == '0') {
            echo '<script type="text/javascript">'
            , 'window.location.href="admin.php";'
            , '</script>';
        }
        else
        {
            $error = "Cannot update practice : ";
        }
    }
    else
    {
        $insert_practice = insertPractice($email, $pass, $name, $address, $title, $logo, $template, $footer);
        if ($insert_practice == '0') {
            echo '<script type="text/javascript">'
            , 'window.location.href="admin.php";'
            , '</script>';
        }
        else
        {
            $error = "Cannot insert practice : ";
        }
    }


}
if (isset($_GET["id"])) {
    $pr = getPracticeById($_GET["id"]);
    $rowCount = mysql_num_rows($pr);
    if($rowCount > 0)
    {
        $param = $_GET["id"];

        while ($r1 = mysql_fetch_array($pr)) {
            $e_id = $r1['id'];
            $e_email = $r1['email'];
            $e_address = $r1['address'];
            $e_title = $r1['title'];
            $e_name = $r1['name'];
            $e_logo = $r1['image_logo'];
            $e_tempate = $r1['template_id'];
            $e_footer = $r1['footer'];
        }
    }
    else {
         echo '<script type="text/javascript">'
                    , 'window.location.href="admin.php";'
                    , '</script>';
    }

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            <?php if (isset($e_tempate)): ?>
            $("#template").val('<?php echo $e_tempate ?>');
            <?php endif; ?>
        });
    </script>
	</head>
	<body>
    <div class="container">
        <div class="col-md-12">
            <ul class="nav nav-pills">
                <li role="presentation"><a href="admin.php">Home</a></li>
                <li role="presentation"  class="active"><a href="practice_detail.php">Add Practice</a></li>
                <li role="presentation"><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="col-md-12">
                        <div class="page-header">
            <?php if (isset($param))
                {
                    echo "<h1>Practice Detail #ID : ".$param."</h1>";
                } else echo "<h1>Add New Practice</h1>"?>
                </div>
            </div>
        

        <?php if (isset($error) && $error != ''){ ?>
            <div class="has-error">
                <div class="alert alert-danger" role="alert">
                    <strong>Error ! </strong><?php echo $error ?>
                </div>
            </div>
            <?php }?>
        <div class="row">
           <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="txtEmail">Email</label>
                    <input type="hidden" name="hid" id="hid" value="<?php echo $e_id ?>">
                     <input type="text" placeholder="Enter Email" name="txtEmail" id="txtEmail" class="form-control" value="<?php echo $e_email; ?>">
            </div>
            <div class="form-group">
                <label for="template">Template</label>
                <select id="template" name="template" class="form-control">
                                <option value="1">Doctor Directory - Portrait</option>
                                <option value="2">Doctor Direcrory - Landscape</option>
                </select>
            </div>
            <div class="form-group">
                    <label for="txtPassword">Password</label>
                     <input type="password" placeholder="Enter Password" name="txtPassword" id="txtPassword" class="form-control">
             </div>
            <div class="form-group">
                    <label for="txPassword2">Confirm Password</label>
                     <input type="password" placeholder="Enter Confirm password" name="txPassword2" id="txPassword2" class="form-control">
             </div>
            <div class="form-group">
                    <label for="txtName">Practice Name</label>
                     <input type="text" placeholder="Enter Practice Name" name="txtName" id="txtName" value="<?php echo $e_name; ?>" class="form-control">
             </div>
            <div class="form-group">
                    <label for="txtAddress">Address</label>
                     <input type="text" placeholder="Enter Address" name="txtAddress"  id="txtAddress" value="<?php echo $e_address; ?>" class="form-control">
             </div>
            <div class="form-group">
                    <label for="txtTitle">Welcome Title</label>
                     <input type="text" placeholder="Enter Welcome Title" name="txtTitle" id="txtTitle" value="<?php echo $e_title; ?>" class="form-control">
             </div>
            <div class="form-group">
                    <label for="txtFooter">Footer Text</label>
                     <input type="text" placeholder="Enter Footer Text" name="txtFooter" id="txtFooter" value="<?php echo $e_footer; ?>" class="form-control">
             </div>
            <div class="form-group">
                 <button class="btn btn-success" name="submit" type="submit">Submit</button>
             </div>
            </form>
        </div>

     </div>
    </body>
</html>