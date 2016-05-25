<?php
require("../dal_pb.php");
$error='';
if ($_POST) {


    $uniqid='';
    // Check if image file is a actual image or fake image
    if (isset($_FILES["txtLogo"]) &&$_FILES["txtLogo"]["name"] != '' ) {
        $uniqid = uniqid();
        $target_dir = "../upload/";
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
    if($error=='')
        {
            $footer = trim($_POST['txtfooter']);
            $logo = $uniqid.basename($_FILES["txtLogo"]["name"]);
            updatePracticeFooter($_SESSION["id"], $footer,$logo);
        }

}
if (!isset($_SESSION['acc_type']) || !isset($_SESSION['id']) || $_SESSION['acc_type'] != '2') {
    echo '<script type="text/javascript">'
    , 'window.location.href="index.php";'
    , '</script>';
}
else
{
    $pr = getPracticeById($_SESSION["id"]);
    $rowCount = mysql_num_rows($pr);
    if ($rowCount > 0) {
        while ($r1 = mysql_fetch_array($pr)) {
            $template = $r1['template_id'];
            $footer = $r1['footer'];
            $e_logo = $r1['image_logo'];
        }
    }
    $lstDoctor = getDoctorByPractice($_SESSION['id']);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Practice</title>
    <meta name="generator" content="Bootply"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="../css/styles.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var practiceid = <?php echo $_SESSION["id"]; ?>;
            $("input[type='checkbox']").on('change', function () {
                //alert(this.name+' '+this.value+' '+this.checked);
                if (this.name == 'display') {
                    var ret = ChangeDisplay(this.name, this.value, this.checked, practiceid);
                }
                else if (this.name == 'allied') {
                    var ret = ChangeDisplay(this.name, this.value, this.checked, practiceid);
                }


            });
        });
        function ChangeDisplay(typeD, id, checked, practiceid) {
            $.ajax
                    ({
                        type: "POST",
                        url: "../dal_js.php",
                        data: "typeChange=" + typeD + "&id=" + id + "&checked=" + checked + "&practiceid=" + practiceid,
                        dataType: "json",
                        success: function (msg) {
                            if (msg == 0 && checked) {
                                if (typeD == 'display')
                                    alert('Set display failed. Only display maximum 10 doctor');
                                else
                                    alert('Set display failed. Only display maximum 4 doctor');
                                window.location.reload();
                            }
                        },
                        error: function () {

                        }
                    });
        }
    </script>
</head>
<body>
<div>
    <div class="container">
        <div class="col-md-12">
        <ul class="nav nav-pills">
          <li role="presentation" class="active"><a href="practice.php">Home</a></li>
          <li role="presentation"><a href="doctor_detail.php">Add Doctor</a></li>
          <li role="presentation"><a href="image_detail.php">Add Slide</a></li>
          <li role="presentation"><a href="logout.php">Logout</a></li>
        </ul>
        </div>
        <?php if (isset($template) && ($template == '1' || $template == '2')) { ?>
        <div class="col-md-12">
            <div class="page-header">
                <h1>Doctors Directory</h1>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a class="btn btn-primary" href="doctor_detail.php">Add Doctor</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <?php if (isset($template) && $template == '1') { ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Profile Photo</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Occupation</th>
                    <th>In Today</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                    <?php  while ($r1 = mysql_fetch_array($lstDoctor)) { ?>
                <tr>
                    <td>
                        <?php if ($r1['image_logo'] != null && isset( $r1['image_logo']) && !empty( $r1['image_logo']) && file_exists("../upload/".$r1['image_logo'])) { ?>
                                <img src="../upload/<?php echo $r1['image_logo'] ?>" width="133px" height="200">
                         <?php }?>
                    </td>
                    <td><?php echo $r1['title'] ?></td>
                    <td><?php echo $r1['name'] ?></td>
                    <td><?php echo $r1['occupation'] ?></td>
                    <td><?php if ($r1['now1'] == 0) echo 'NO'; else echo 'YES'; ?></td>
                    <td><a class="btn btn-primary" href="doctor_detail.php?id=<?php echo $r1['id'] ?>">EDIT</a></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <?php } else if($template == '2') { ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Profile Photo</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Occupation</th>
                    <th>Display</th>
                    <th>Allied Health Services</th>
                    <th>In Today</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                    <?php  while ($r1 = mysql_fetch_array($lstDoctor)) { ?>
                <tr>
                    <td>
                        <?php if ($r1['image_logo'] != null && isset( $r1['image_logo']) && !empty( $r1['image_logo']) && file_exists("../upload/".$r1['image_logo'])) { ?>
                                <img src="../upload/<?php echo $r1['image_logo'] ?>" width="133px" height="200">
                        <?php }?>
                    </td>
                    <td><?php echo $r1['title'] ?></td>
                    <td><?php echo $r1['name'] ?></td>
                    <td><?php echo $r1['occupation'] ?></td>
                    <td><input name="display" value="<?php echo $r1['id'] ?>" type="checkbox"
                               class="form-control" <?php if ($r1['Isdisplay'] == 1) { ?> checked <?php } ?> /></td>
                    <td><input name="allied" value="<?php echo $r1['id'] ?>" type="checkbox"
                               class="form-control" <?php if ($r1['IdAllied'] == 1) { ?> checked <?php } ?> /></td>
                    <td><?php if ($r1['now1'] == 0) echo 'NO'; else echo 'YES'; ?></td>
                    <td><a class="btn btn-primary" href="doctor_detail.php?id=<?php echo $r1['id'] ?>">EDIT</a></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <?php }?>
        </div>
        <?php } ?>
        <div class="col-md-12">
            <div class="page-header">
                <section id="Footer">
                    <h1>Footer Text and Logo</h1>
                </section>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <input type="text" placeholder="Enter Footer Text" name="txtfooter" id="txtfooter"
                           class="form-control" value="<?php echo $footer; ?>">
                </div>
                <div class="col-md-12">
                    <label>Logo</label>
                    <input type="file" placeholder="Enter Logo Image" name="txtLogo" id="txtLogo" class="form-control" />
                    <?php if ($e_logo != null && isset($e_logo) && !empty($e_logo) && file_exists("../upload/".$e_logo)) { ?>
                        <img src="../upload/<?php echo $e_logo; ?>" class="img-thumbnail" width="497px" height="93px" />
                    <?php }?>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="page-header">
                <section id="ImgSlide">
                    <h1>Image Slide Show</h1>
                </section>
            </div>
            <table class="table">

                <tbody>
<?php
$lstSLide = getSlideByPractice($_SESSION['id']);
while ($r1 = mysql_fetch_array($lstSLide)) {
    ?>
<tr>

    <td>
        <?php if (isset($template) && $template == '1') { ?>
        <table class="table">
            <tr>
                <td rowspan="3">
                    <input type="hidden" class="imgid" name="to[]" value="<?php echo $r1['id'] ?>">
                    <?php if ($r1['image_logo'] != null && isset($r1['image_logo']) && !empty( $r1['image_logo']) && file_exists("../upload/".$r1['image_logo'])) { ?>
                        <img src="../upload/<?php echo  $r1['image_logo'] ?>" height="100" width="100">
                    <?php }?>
                </td>
                <td>File name : <?php echo  $r1['image_logo'] ?></td>
                <td><a href="#ImgSlide" class="up">
                    <img src="../img/1437734758_arrow-up-01.png" width="30" height="30"/> </a></td>
            </tr>
            <tr>
                <td>Last Modified Date : <?php echo  $r1['modified'] ?></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <a href="delete_image.php?id=<?php echo $r1['id'] ?>"
                       onclick="return confirm('Are you sure delete this image slide?')">
                        <button class="btn btn-primary" type="button">Remove</button>
                    </a>
                    <a href="image_detail.php?id=<?php echo $r1['id'] ?>">
                        <button class="btn btn-primary" type="button">Update</button>
                    </a>
                </td>
                <td><a href="#ImgSlide" class="down">
                    <img src="../img/1437734774_arrow-down-01.png" width="30" height="30"/></a></td>
            </tr>
        </table>
        <?php } else { ?>
        <table class="table">
            <tr>
                <td rowspan="4">
                    <input type="hidden" class="imgid" name="to[]" value="<?php echo $r1['id'] ?>">
                    <?php if ($r1['image_logo'] != null && isset($r1['image_logo']) && !empty( $r1['image_logo']) && file_exists("../upload/".$r1['image_logo'])) { ?>
                        <img src="../upload/<?php echo  $r1['image_logo'] ?>" height="100" width="100">
                    <?php } ?>
                </td>
                <td>File name : <?php echo  $r1['image_logo'] ?></td>
                <td><a href="#ImgSlide" class="up">
                    <img src="../img/1437734758_arrow-up-01.png" width="30" height="30"/> </a></td>
            </tr>
            <tr>
                <td>Description : <?php echo  strip_tags($r1['description']); ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Last Modified Date : <?php echo  $r1['modified'] ?></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <a href="delete_image.php?id=<?php echo $r1['id'] ?>"
                       onclick="return confirm('Are you sure delete this image slide?')">
                        <button class="btn btn-primary" type="button">Remove</button>
                    </a>
                    <a href="image_detail.php?id=<?php echo $r1['id'] ?>">
                        <button class="btn btn-primary" type="button">Update</button>
                    </a>
                </td>
                <td><a href="#ImgSlide" class="down">
                    <img src="../img/1437734774_arrow-down-01.png" width="30" height="30"/></a></td>
            </tr>
        </table>
        <?php }?>

    </td>


</tr>
    <?php }?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a class="btn btn-primary" href="image_detail.php">Add Image</a>
                </div>
            </div>
        </div>


    </div>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $(".up,.down").click(function() {
            var row = $(this).parents("tr:first").parents("table:first").parents("tr:first");
            if ($(this).is(".up")) {
                row.insertBefore(row.prev());
            } else {
                row.insertAfter(row.next());
            }
            var lst_to = [];
            $("input:hidden.imgid").each(function() {
                lst_to.push($(this).val());
            });
            var str_query = "reorder=" + lst_to.join();
//                alert(str_query);
            $.ajax
                    ({
                        type: "POST",
                        url: "../dal_js.php",
                        data: str_query,
                        dataType: "json",
                        success: function (msg) {
                            // alert(msg);
                        },
                        error: function () {
                            //alert("Error : failed" );
                        }
                    });

        });
    });
</script>
</html>
