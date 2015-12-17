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
    if($rowCount > 0)
    {
        while ($r1 = mysql_fetch_array($pr)) {
            $e_id = $r1['id'];
            $e_email = $r1['email'];
            $e_address = $r1['address'];
            $e_title = $r1['title'];
            $e_name = $r1['name'];
            $e_logo = $r1['image_logo'];
        }
    }
    $stt = getStatus();
    $rowCountStt = mysql_num_rows($stt);
    if($rowCountStt > 0)
    {
        while ($r1 = mysql_fetch_array($stt)) {
            $currentID = $r1['modified'];
        }
    }
    else
    {
        insertFirstStatus();
        $stt = getStatus();
        while ($r1 = mysql_fetch_array($stt)) {
            $currentID =$r1['modified'];
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>:: Welcome to Broadway Medical Centre ::</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 100%;
            margin: auto;
        }
    </style>
    <script type="text/javascript">
        tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
        tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

        function GetClock(){
            var d=new Date();
            var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear(),nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

            if(nhour==0){ap=" AM";nhour=12;}
            else if(nhour<12){ap=" AM";}
            else if(nhour==12){ap=" PM";}
            else if(nhour>12){ap=" PM";nhour-=12;}

            if(nyear<1000) nyear+=1900;
            if(nmin<=9) nmin="0"+nmin;
            if(nsec<=9) nsec="0"+nsec;

            document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
        }

        window.onload=function(){
            GetClock();
            setInterval(GetClock,1000);
        }
    </script>
    <script type="text/javascript">
        var auto_refresh = setInterval(
                function ()
                {
                    var curent = $('#currentID').val();
                    $.ajax
                            ({
                                type: "POST",
                                url: "dal_js.php",
                                data: "typeC="+ curent,
                                dataType: "json",
                                success: function (msg) {
                                    if(msg==0)
                                    {
                                        window.location.reload();
                                    }
                                },
                                error: function () {

                                }
                            });
                }, 5000); // refresh every 10000 milliseconds


    </script>
</head>
<body>
<div>
    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col-md-3"><img class="img-thumbnail" src="upload/<?php echo $e_logo ?>" height="360" width="150"></div>
                <div class="col-md-9 text-right"><h3><div id="clockbox"></div>
                    <?php /*echo date("h:i:s A jS \of F Y ")*/ ?></h3></div>

            </div>
            <h1><?php echo $e_title; ?></h1>
            <input type="hidden" name="currentID" id="currentID" value="<?php echo $currentID ?>">
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><b>Today</b></th>
                        <th>Tomorrow</th>
                        <th><?php echo date('l', strtotime(' +2 day')) ?></th>
                        <th><?php echo date('l', strtotime(' +3 day')) ?></th>
                        <th><?php echo date('l', strtotime(' +4 day')) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                     $rs_query = getRoster($_GET['id']);
                    while ($r1 = mysql_fetch_array($rs_query)) { ?>
                    <tr>
                        <td><img src="upload/<?php echo $r1['image_logo'] ?>" class="img-thumbnail" width="133px" height="200px" ></td>
                        <td><?php echo $r1['title'].' '.$r1['name'] ?></td>
                        <td><?php echo $r1['occupation'] ?></td>
                        <td><?php if($r1['now1'] == 0){ ?>
                                <a class="btn btn-danger disabled" href="#">NOT IN</a>
                            <?php } else { ?>
                                <a class="btn btn-primary disabled" href="#">IN</a>
                            <?php } ?>
                        </td>
                        <td><?php if($r1['now2'] == 0){ ?>
                                <a class="btn btn-danger disabled" href="#">NOT IN</a>
                            <?php } else { ?>
                                <a class="btn btn-primary disabled" href="#">IN</a>
                            <?php } ?>
                        </td>
                        <td><?php if($r1['now3'] == 0){ ?>
                                <a class="btn btn-danger disabled" href="#">NOT IN</a>
                            <?php } else { ?>
                                <a class="btn btn-primary disabled" href="#">IN</a>
                            <?php } ?>
                        </td>
                        <td><?php if($r1['now4'] == 0){ ?>
                                <a class="btn btn-danger disabled" href="#">NOT IN</a>
                            <?php } else { ?>
                                <a class="btn btn-primary disabled" href="#">IN</a>
                            <?php } ?>
                        </td>
                        <td><?php if($r1['now5'] == 0){ ?>
                                <a class="btn btn-danger disabled" href="#">NOT IN</a>
                            <?php } else { ?>
                                <a class="btn btn-primary disabled" href="#">IN</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php }?>

                    </tbody>
                </table>
            </div>

        </div>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <!--<ol class="carousel-indicators">
            <?php /*$lst = getSlideByPractice($_GET['id']);
                $i=0;
                while ($r1 = mysql_fetch_array($lst)) { */?>
                <?php /*if($i==0){*/?>
                        <li data-target="#myCarousel" data-slide-to="<?php /*echo $i */?>" class="active"></li>
                        <?php /*}else {*/?>
                        <li data-target="#myCarousel" data-slide-to="<?php /*echo $i */?>"></li>
                        <?php /*}*/?>
                    <?php /*$i++; }*/?>
            </ol>-->


            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
            <?php $lst = getSlideByPractice($_GET['id']);
                     $i=0;
            while ($r1 = mysql_fetch_array($lst)) { ?>
                <div class="<?php if($i==0) echo 'item active';else echo 'item'?>">
                <img src="upload/<?php echo $r1['image_logo'] ?>" alt="Chania" width="460" height="345">
                <div class="carousel-caption">

                </div>
                </div>
                <?php $i++;} ?>

            </div>

        </div>

    </div>
</div>
<br />
<br />
<br />

</body>
</html>