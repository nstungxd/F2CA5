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
    $stt = getStatus($_GET["id"]);
    $rowCountStt = mysql_num_rows($stt);
    if ($rowCountStt > 0) {
        while ($r1 = mysql_fetch_array($stt)) {
            $currentdate = $r1['modified'];
        }
    }
    else
    {
        insertFirstStatus($_GET["id"]);
        $stt = getStatus($_GET["id"]);
        while ($r1 = mysql_fetch_array($stt)) {
            $currentdate = $r1['modified'];
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
</head>
<body>
<input type="hidden" name="currentID" id="currentID" value="<?php echo $_GET["id"] ?>">
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<div class="container" style="height: 300px">
        <div class="row">
            <div class="col-lg-12">
                <?php if ($e_logo != null && isset( $e_logo) && !empty( $e_logo) && file_exists("upload/".$e_logo)) { ?>
                    <a href="#"><img class="fixheight" src="upload/<?php echo $e_logo ?>" alt="" height="300px"/></a>
                    <?php }?>
            </div>
        </div>
    </div>
<div class="container" style="height: 630px">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                ),url('upload/<?php echo $r1['image_logo'] ?>') no-repeat scroll 0 0 ; auto; height: 629.669px;">
							<?php echo $r1['description'] ?>
						</div>
                    <?php $i++; } ?>
                </div>
            </div>
        </div>
    </div>
<div class="container" style="height: 150px">
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <textarea name="content" id="content">

                    </textarea>
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
                height: 314.5,
                play: {
                    active: false,
                    auto: true,
                    interval: 10000,
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
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR_BASEPATH = 'ckeditor';
        var editor = CKEDITOR.replace('content', {
            filebrowserBrowseUrl: "kcfinder/browse.php?type=files"
        });
    </script>

</body>
</html>
