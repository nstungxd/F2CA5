<?php
require("../dal_pb.php");
if (!isset($_SESSION['acc_type']) || !isset($_SESSION['id'])  || $_SESSION['acc_type']!='2' )
{
    echo '<script type="text/javascript">'
    , 'window.location.href="index.php";'
    , '</script>';
}
else
{
    $pr = getPracticeById($_SESSION["id"]);
    $rowCount = mysql_num_rows($pr);
    if($rowCount > 0)
    {
        while ($r1 = mysql_fetch_array($pr)) {
            $template = $r1['template_id'];
        }
    }
}
$e_logo='';
$d_id = '';
$e_des='';
$error='';
$uniqid='';
if($_POST)
{
    // Check if image file is a actual image or fake image
    if (isset($_FILES["txtLogo"]) &&$_FILES["txtLogo"]["name"] != '' ) {
        $target_dir = "../upload/";
        $uniqid = uniqid();
        $target_file = $target_dir .$uniqid. basename($_FILES["txtLogo"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        $check = getimagesize($_FILES["txtLogo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error= "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $error= "File already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["txtLogo"]["size"] > 5000000) {
            $error= "Your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $error= "Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk != 0) {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["txtLogo"]["tmp_name"], $target_file)) {

            } else {
                $error= "There was an error uploading your file.";
                $uploadOk = 0;
            }
        }
    }

    if ($error == '') {
        if (isset($_POST["doctorid"]) && $_POST["doctorid"] != '') {
            $id = trim($_POST['doctorid']);
            $logo = $uniqid.basename($_FILES["txtLogo"]["name"]);
            $des = '';
            if (isset($_POST['content'])) $des = ($_POST['content']);
            $update_img = updateImageSlide($_SESSION['id'],$id, $logo, $des);
            if ($update_img == '0') {
                echo '<script type="text/javascript">'
                , 'window.location.href="practice.php";'
                , '</script>';
            }
            else
            {
                $error = "Cannot update image ";
            }
        }
        else
        {
            $logo = $uniqid.basename($_FILES["txtLogo"]["name"]);
            $des = '';
            if (isset($_POST['content'])) $des = ($_POST['content']);
            $insert_img = insertImageSlide($_SESSION['id'], $logo, $des);
            if ($insert_img == '0') {
                echo '<script type="text/javascript">'
                , 'window.location.href="practice.php";'
                , '</script>';
            }
            else
            {
                $error = "Cannot insert image : " . $insert_img;
            }
        }
    }
    //else  $error= "Please upload file";
}
if (isset($_GET["id"])) {
    $dr = getImageSlideBy($_GET["id"]);
    $rowCount = mysql_num_rows($dr);
    if($rowCount > 0)
    {
        while ($r1 = mysql_fetch_array($dr)) {
            $e_logo = $r1['image_logo'];
            $e_des = $r1['description'];
            $d_id = $r1['id'];
        }
    }
    else {
        echo '<script type="text/javascript">'
        , 'window.location.href="practice.php";'
        , '</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Practice</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <![endif]-->
    <link href="../css/styles.css" rel="stylesheet">
     <script type="text/javascript">

    </script>
</head>
<body>
<div class="container">
    <div class="col-md-12">
        <ul class="nav nav-pills">
          <li role="presentation"><a href="practice.php">Home</a></li>
          <li role="presentation"><a href="doctor_detail.php">Add Doctor</a></li>
          <li role="presentation"  class="active"><a href="image_detail.php">Add Slide</a></li>
          <li role="presentation"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="col-md-12">
        <div class="page-header">
                <?php if (isset($_GET["id"]))
            {
                echo "<h1>Image Detail #ID : ".$_GET["id"]."</h1>";
            } else echo "<h1>Add New Image</h1>"?>
        </div>
    <form action="" method="post" enctype="multipart/form-data">
        <?php if (isset($error) && $error != ''){ ?>
        <div class="has-error">
            <div class="alert alert-danger" role="alert">
                <strong>Error ! </strong><?php echo $error ?>
            </div>
        </div>
        <?php }?>

        <div class="row">
            <table class="col-md-12">
                <?php if(isset($template) && $template!='1') {?>
                <div class="form-group">
                    <label for="content">Text</label>
                    <textarea name="content" id="content">
                        <?php echo $e_des ?>
                    </textarea>
                </div>
                <?php }?>
                <div class="form-group">
                    <label for="txtLogo">Image</label>
                    <input type="hidden" name="doctorid" id="doctorid" value="<?php echo $d_id ?>">
                    <input type="file" placeholder="Enter Logo Image" name="txtLogo" id="txtLogo" class="form-control">
                    <?php if($e_logo != ''){ ?>
                    <img src="../upload/<?php echo $e_logo; ?>" class="img-thumbnail" width="133px" height="200px">
                        <?php }?>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" name="submit" type="submit">Submit</button>
                </div>

             </table>
        </div>
        </form>
    </div>
</body>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR_BASEPATH = 'ckeditor';
        var editor = CKEDITOR.replace('content', {
            filebrowserBrowseUrl: "kcfinder/browse.php?type=files"
        });
    </script>