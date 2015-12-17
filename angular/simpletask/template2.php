<?php
if (!isset($_GET["id"])) {
    echo '<script type="text/javascript">'
    , 'window.location.href="index.php";'
    , '</script>';
}
else
{

    $pr = getPracticeById($_GET["id"]);
    $rowCount = mysql_num_rows($pr);
    if ($rowCount > 0) {
        while ($r1 = mysql_fetch_array($pr)) {
            $e_id = $r1['id'];
            $e_email = $r1['email'];
            $e_address = $r1['address'];
            $e_title = $r1['title'];
            $e_name = $r1['name'];
            $e_logo = $r1['image_logo'];
            $e_footer = $r1['footer'];
        }
    }
    $stt = getStatus();
    $rowCountStt = mysql_num_rows($stt);
    if ($rowCountStt > 0) {
        while ($r1 = mysql_fetch_array($stt)) {
            $currentID = $r1['modified'];
        }
    }
    else
    {
        insertFirstStatus();
        $stt = getStatus();
        while ($r1 = mysql_fetch_array($stt)) {
            $currentID = $r1['modified'];
        }
    }

}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: Welcome to Broadway Medical Centre ::</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <!--<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>-->

    <script type="text/javascript">
        tday = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        tmonth = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

        function GetClock() {
            var objToday = new Date(),
                    weekday = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'),
                    dayOfWeek = weekday[objToday.getDay()],
                    domEnder = new Array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'),
                    dayOfMonth = today + (objToday.getDate() < 10) ? '0' + objToday.getDate() + domEnder[objToday.getDate()] : objToday.getDate() + domEnder[parseFloat(("" + objToday.getDate()).substr(("" + objToday.getDate()).length - 1))],
                    months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                    curMonth = months[objToday.getMonth()],
                    curYear = objToday.getFullYear(),
                    curHour = objToday.getHours() > 12 ? objToday.getHours() - 12 : (objToday.getHours() < 10 ? "0" + objToday.getHours() : objToday.getHours()),
                    curMinute = objToday.getMinutes() < 10 ? "0" + objToday.getMinutes() : objToday.getMinutes(),
                    curSeconds = objToday.getSeconds() < 10 ? "0" + objToday.getSeconds() : objToday.getSeconds(),
                    curMeridiem = objToday.getHours() > 12 ? "pm" : "am";
            var today = dayOfWeek + " " + dayOfMonth + " " + curMonth + " " + curYear;
            document.getElementById('clockbox').innerHTML = today;
            document.getElementById('timebox').innerHTML = curHour + ":" + curMinute + curMeridiem
        }

        window.onload = function() {
            GetClock();
            setInterval(GetClock, 1000);


        }


    </script>
    <script type="text/javascript">
        var auto_refresh = setInterval(
                function () {
                    var curent = $('#currentID').val();
                    $.ajax
                            ({
                                type: "POST",
                                url: "dal_js.php",
                                data: "typeC=" + curent,
                                dataType: "json",
                                success: function (msg) {
                                    if (msg == 0) {
                                        window.location.reload();
                                    }

                                },
                                error: function () {

                                }
                            });
                }, 5000);
    </script>
</head>
<body>
<input type="hidden" name="currentID" id="currentID" value="<?php echo $currentID ?>">
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<div class="header_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="logo">
                    <?php if ($e_logo != null && isset( $e_logo) && !empty( $e_logo) && file_exists("upload/".$e_logo)) { ?>
                    <a href="#"><img class="img-thumbnail" src="upload/<?php echo $e_logo ?>" height="93px" width="497px" alt=""/></a>
                    <?php }?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="date_time">
                    <h2>
                        <div id="clockbox"></div>
                    </h2>
                    <br/>
                    <h1>
                        <div id="timebox"></div>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="left_content">
                        <h2>Doctors Directory</h2>
                    <div class="col-lg-6">
<?php
                                $rs_query = getDoctorRoster($_GET['id'], 'display');
                        $rowCount = mysql_num_rows($rs_query);
                        $break = (int)($rowCount / 2) + 1;
                        $i = 0;
                        while ($r1 = mysql_fetch_array($rs_query)) {
                            $i++?>
                            <div class="single_dictionary">
                                <div class="dictionary_text">
                                    <p><?php echo $r1['title'] . ' ' . $r1['name'] ?></p>
                                </div>
                                <div class="dictionary_img">
                                    <?php if ($r1['now1'] == 0) { ?>
                                    <img src="img/not_in.jpg" alt=""/>
                                    <?php } else { ?>
                                    <img src="img/in.jpg" alt=""/>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                                                                                            if ($i == $break) {
                                ?>
                                </div>
							    <div class="col-lg-6">
                                    <?php

                            }
                        }?>
                    </div>

                    </div>
                </div>

                <div class="row">
                    <div class="left_content_bottom">
                        <h2>Allied Health Services</h2>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<?php
                                $rs_query = getDoctorRoster($_GET['id'], 'allied');
                        $rowCount = mysql_num_rows($rs_query);
                        $break = (int)($rowCount / 2) + 1;
                        $i = 0;
                        while ($r1 = mysql_fetch_array($rs_query)) {
                            $i++?>
                            <div class="single_dictionary">
                                <div class="dictionary_text">
                                    <p><?php echo $r1['title'] . ' ' . $r1['name'] ?></p>
                                </div>
                                <div class="dictionary_img">
                                    <?php if ($r1['now1'] == 0) { ?>
                                    <img src="img/not_in.jpg" alt=""/>
                                    <?php } else { ?>
                                    <img src="img/in.jpg" alt=""/>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                                                                if ($i == $break) {
                                ?>
                                </div>
							    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <?php }
                        }?>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div id="slideshow" style="background-size: 100%;border: 4px solid #196eb5;width: 100%;">
                <?php $lst = getSlideByPractice($_GET['id']);
                $i = 0;
                while ($r1 = mysql_fetch_array($lst)) {
                    ?>
						<div class="broadway_gp" style="
                        background-size: 100%;
						background:linear-gradient(
                                  rgba(255, 255, 255, 0.7),
                                  rgba(255, 255, 255, 0.7)
                                ),url('upload/<?php echo $r1['image_logo'] ?>') no-repeat scroll 0 0 / 807.405px; auto;
                        width: 100%;
                        padding: 40px 40px 80px 30px; height: 807.405px;">
							<?php echo $r1['description'] ?>
						</div>
                    <?php $i++; } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer_area">
    <div class="container">
        <div class="row">
            <div class="footer">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <div class="note">
                        <p><span>Please note: </span><?php echo $e_footer ?></p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="am_logo">
                        <a href="#"><img src="img/am_logo.png" alt=""/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>-->
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="js/jquery.slides.min.js"></script>
<script type="text/javascript">
    $(function() {
        var cpage = "<?php echo $i ?>";
        if(cpage > 1)
        {
            $('#slideshow').slidesjs({
                width: 940,
                height: 840,
                play: {
                    active: false,
                    auto: true,
                    interval: 4000,
                    swap: true
                },
                pagination: {
                    active: false
                }
            });
            $("#slideshow > a").hide();
        }
    });
</script>

</body>
</html>
