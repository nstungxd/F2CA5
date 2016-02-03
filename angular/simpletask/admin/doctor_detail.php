<?php
require("../dal_pb.php");
if (!isset($_SESSION['acc_type']) || !isset($_SESSION['id']) || $_SESSION['acc_type'] != '2') {
    echo '<script type="text/javascript">'
    , 'window.location.href="index.php";'
    , '</script>';
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="generator" content="Bootply"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="../css/styles.css" rel="stylesheet">
<?php

    $error = '';
    if ($_POST) {
        $uniqid = '';
        if (isset($_FILES["txtLogo"]) && $_FILES["txtLogo"]["name"] != '') {
            $uniqid = uniqid();
            $target_dir = "../upload/";
            $target_file = $target_dir . $uniqid . basename($_FILES["txtLogo"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            $check = getimagesize($_FILES["txtLogo"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $error = "File is not an image.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $error = "File already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["txtLogo"]["size"] > 5000000) {
                $error = "Your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk != 0) {
                // if everything is ok, try to upload file
                if (move_uploaded_file($_FILES["txtLogo"]["tmp_name"], $target_file)) {

                } else {
                    $error = "There was an error uploading your file.";
                    $uploadOk = 0;
                }
            }
        }
        if (isset($_POST["submit"]) && $error == '') {

            $txt_name = trim($_POST['txtName']);
            $txt_Title = trim($_POST['txtTitle']);
            $txt_Occu = trim($_POST['txtOccu']);
            $logo = $uniqid . basename($_FILES["txtLogo"]["name"]);
            if (isset($_POST["doctorid"]) && $_POST["doctorid"] != '') {
                $insert_practice = updateDoctor($_SESSION['id'],$_POST["doctorid"], $txt_name, $txt_Occu, $txt_Title, $logo);
                if ($insert_practice == '0') {
                    echo '<script type="text/javascript">'
                    , 'window.location.href="practice.php";'
                    , '</script>';
                }
                else
                {
                    $error = "Cannot update doctor ";
                }
            }
            else
            {
                $insert_practice = insertDoctor($_SESSION['id'], $txt_name, $txt_Occu, $txt_Title, $logo);
                if ($insert_practice == '0') {
                    echo '<script type="text/javascript">'
                    , 'window.location.href="practice.php";'
                    , '</script>';
                }
                else
                {
                    $error = "Cannot insert doctor ";
                }

            }
        }


    }
    $d_id = '';
    $d_name = '';
    $d_occupation = '';
    $d_title = '';
    $d_logo = '';
    if (isset($_GET["id"])) {
        $dr = getDoctorById($_GET["id"]);
        $rowCount = mysql_num_rows($dr);
        if ($rowCount > 0) {
            while ($r1 = mysql_fetch_array($dr)) {
                $d_id = $r1['id'];
                $d_name = $r1['name'];
                $d_occupation = $r1['occupation'];
                $d_title = $r1['title'];
                $d_logo = $r1['image_logo'];
            }
        }


        else {
            echo '<script type="text/javascript">'
            , 'window.location.href="practice.php";'
            , '</script>';
        }
    }

    ?>
</head>
<body>
<div class="container">
    <div class="col-md-12">
        <ul class="nav nav-pills">
          <li role="presentation"><a href="practice.php">Home</a></li>
          <li role="presentation"  class="active"><a href="doctor_detail.php">Add Doctor</a></li>
          <li role="presentation"><a href="image_detail.php">Add Slide</a></li>
          <li role="presentation"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="col-md-12">
        <div class="page-header">
                <?php if (isset($_GET["id"])) {
                echo "<h1>Doctor Detail #ID : " . $_GET["id"] . "</h1>";
            } else echo "<h1>Add New Doctor</h1>"?>
        </div>
    <form action="" method="post" enctype="multipart/form-data">
        <?php if (isset($error) && $error != '') { ?>
        <div class="has-error">
            <div class="alert alert-danger" role="alert">
                <strong>Error ! </strong><?php echo $error ?>
            </div>
        </div>
        <?php }?>

        <div class="row">
            <table class="col-md-12">
                <tr class="col-md-4">
                    <input type="hidden" name="doctorid" id="doctorid" value="<?php echo $d_id ?>">
                    <?php if ($d_logo != '') { ?>
                    <td colspan="3"><img src="../upload/<?php echo $d_logo ?>" width="133px" height="200"></td>
                    <?php } ?>
                </tr>
                <tr class="col-md-8">
                    <td class="col-md-12">
                        <div class="form-group col-md-12">
                            <label for="txtName">Name</label>
                            <input type="text" placeholder="Enter Name" name="txtName" id="txtName" class="form-control"
                                   value="<?php echo $d_name; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="txtTitle">Title</label>
                            <input type="text" placeholder="Enter Title" name="txtTitle" id="txtTitle"
                                   class="form-control"
                                   value="<?php echo $d_title; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="txtOccu">Occupation</label>
                            <input type="text" placeholder="Enter Occupation" name="txtOccu" id="txtOccu"
                                   class="form-control"
                                   value="<?php echo $d_occupation; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="txtLogo">Image</label>
                            <input type="file" placeholder="Enter Logo Image" name="txtLogo" id="txtLogo"
                                   class="form-control">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php if (isset($_GET["id"])) { ?>
        <div class="row">
            <div class="col-md-12">
                <table id="data" class="table table-bordered">
                    <?php
                        $curday = date("j");
                    $curmnth = date("n");
                    $curyear = date("Y");

                    if (isset($_GET['mnth'])) $month = $_GET['mnth'];
                    else $month = $curmnth;

                    if (isset($_GET['yrs'])) $year = $_GET['yrs'];
                    else $year = $curyear;

                    if (isset($_GET["id"]))
                        $ros = getRosterByDoctor($_GET["id"], $month, $year);

                    $date = mktime(12, 0, 0, $month, 1, $year);
                    $daysInMonth = date("t", $date);
                    $offset = date("w", $date);
                    $rows = 1;


                    if ($month == 12) {
                        $nextM = 1;
                        $nextY = $year + 1;

                        $pevM = $month - 1;
                        $pevY = $year;
                    }
                    if ($month == 1) {
                        $nextM = $month + 1;
                        $nextY = $year;

                        $pevM = 12;
                        $pevY = $year - 1;
                    }
                    else
                    {
                        $nextM = $month + 1;
                        $nextY = $year;

                        $pevM = $month - 1;
                        $pevY = $year;
                    }

                    echo "<tr>
                        <td>
                            <a href='doctor_detail.php?id=" . $_GET["id"] . "&mnth=" . $pevM . "&yrs=" . $pevY . "'>" . date('M', mktime(0, 0, 0, $pevM + 1, 0, $pevY)) . "</a>
                        </td>
                        <th colspan=\"5\" align=\"center\">" . date("F Y", $date) . "</th>
                        <td align=\"right\">
                            <a href='doctor_detail.php?id=" . $_GET["id"] . "&mnth=" . $nextM . "&yrs=" . $nextY . "'>" . date('M', mktime(0, 0, 0, $nextM + 1, 0, $nextY)) . "</a>
                        </td>
                        </tr>";
                    echo "\t<tr><th>Su</th><th>M</th><th>Tu</th><th>W</th><th>Th</th><th>F</th><th>Sa</th></tr>";
                    echo "\n\t<tr>";
                    $j = 0;
                    for ($i = 1; $i <= $offset; $i++)
                    {
                        echo "<td></td>";
                        $j++;
                    }
                    if (isset($_GET["id"])) {
                        $r2 = array();
                        while ($r1 = mysql_fetch_array($ros)) {
                            $r2[] = $r1;

                        }
                    }
                    for ($day = 1; $day <= $daysInMonth; $day++)
                    {
                        if (($day + $offset - 1) % 7 == 0 && $day != 1) {
                            echo "</tr>\n\t<tr>";
                            $j = 0;
                            $rows++;
                        }
                        $td = "<td class='warning'>";
                        if (isset($_GET["id"])) {
                            foreach ($r2 as $temp)
                            {

                                if ($temp['dt_roster'] == date('Y-m-d', mktime(0, 0, 0, $month, $day, $year))) {

                                    $td = "<td class='info'>";
                                }
                            }
                        }
                        if (($curday == $day) && ($curmnth == $month))
                            echo $td . "<a href='#' onclick='changeColor(" . $_GET["id"] . "," . ($rows + 3) . "," . $j . "," . $day . "," . $month . "," . $year . ")'><b>" . $day . "</b></a></td>";
                        else
                            echo $td . "<a href='#' onclick='changeColor(" . $_GET["id"] . "," . ($rows + 3) . "," . $j . "," . $day . "," . $month . "," . $year . ")'>" . $day . "</a></td>";
                        $j++;
                    }
                    while (($day + $offset) <= $rows * 7)
                    {
                        echo "<td></td>";
                        $j++;
                        $day++;
                    }
                    echo "</tr>\n";
                    ?>
                </table>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12 text-right">
                <button class="btn btn-primary" name="submit" type="submit">Submit</button>
            </div>
        </div>
    </form>
    </div>
</div>
</body>
<script type="text/javascript">
    function changeColor(id, rownum, cellnum, days, month, year) {
        var a = $("tr:eq(" + rownum + ") > td:eq(" + cellnum + ")");
        var paractice = '<?php echo $_SESSION['id'] ?>'
        if (a.attr("class") == 'warning') {

            $.ajax
                    ({
                        type: "POST",
                        url: "../dal_js.php",
                        data: "type=" + id + "&date=" + days + "&month=" + month + "&year=" + year+ "&practice=" + paractice,
                        dataType: "json",
                        success: function (msg) {
                            if (msg == 0) {
                                a.removeClass('info');
                                a.addClass('info');
                                a.removeClass('warning');
                            }
                        },
                        error: function () {
                            alert("Error : failed");
                            return 1;
                        }
                    });


        }
        else if (a.attr("class") == 'info') {

            $.ajax
                    ({
                        type: "POST",
                        url: "../dal_js.php",
                        data: "typer=" + id + "&date=" + days + "&month=" + month + "&year=" + year+ "&practice=" + paractice,
                        dataType: "json",
                        success: function (msg) {
                            if (msg == 0) {
                                a.removeClass('warning');
                                a.addClass('warning');
                                a.removeClass('info');
                            }
                        },
                        error: function () {
                            alert("Error : failed");
                            return 1;
                        }
                    });


        }

    }

</script>
</html>