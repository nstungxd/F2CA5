<title>My Healthy App</title>
<!-- META TAG
================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8"/>
<meta http-equiv="imagetoolbar" content="no"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>

<!-- STYLE SHEET
================================================== -->
<!-- Forms Elemets -->
<link type="text/css" media="screen" rel="stylesheet" href="<?php echo $baseDir ?>/www/_layout/scripts/jquery.uniform/uniform.default.css" />
<link type="text/css" media="screen" rel="stylesheet" href="<?php echo $baseDir ?>/www/_layout/modal.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!-- The 1140px Grid -->
<link type="text/css" media="screen" rel="stylesheet" href="<?php echo $baseDir ?>/www/_layout/1140.admin.css"  />
<link type="text/css" media="screen" rel="stylesheet" href="<?php echo $baseDir ?>/www/css/styles.admin.css"   />

<!-- ICON LINK -->
<link rel="shortcut icon" href="<?php echo $baseDir ?>/www/img/admin/inzone.ico"/>
<!-- JAVA SCRIPT
================================================== -->
<!-- JQUERY -->
<script type="text/javascript" src="<?php echo $baseDir ?>/www/plugins/jquery/jquery.js"></script>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/plugins/jquery/jquery.jgrowl_minimized.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- LAYOUT -->

<script type="text/javascript" src="<?php echo $baseDir ?>/www/_layout/scripts/css3-mediaqueries.js"></script>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/_layout/scripts/jquery.raphael/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/_layout/scripts/jquery.morris/morris.min.js"></script>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/_layout/scripts/nicEdit/nicEdit.js"></script>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/_layout/scripts/jquery.uniform/jquery.uniform.js"></script>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/_layout/scripts/jquery.tablesorter/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/_layout/scripts/table.resizable/resizable.tables.js"></script>

<script type="text/javascript" src="<?php echo $baseDir ?>/www/_layout/custom.js"></script>

<script type="text/javascript" src="<?php echo $baseDir ?>/www/_layout/modal.js"></script>

<!-- COMMON
================================================== -->
<script type="text/javascript">
	function reload() {
    	document.location.reload();
	}
	function logout() {
		// TODO : clear session info...
		// alert("<?php echo $baseDir; ?>/scadmin/logout");
		document.location.href = "<?php echo $baseDir; ?>/scadmin/logout";
	}
	function gohome() {
		window.location.href = "<?php echo $baseDir; ?>/iz_admin/main";
	}
	function isnophoto(url) {
		return (url.indexOf("www/img/admin/nophoto.png") >= 0) ? true : false;
	}
	function getphotopath(url) {
		url = url.replace("\"", "");
		url = url.replace("\"", "");
		url = url.replace("\"", "");
		url = url.replace("\"", "");
		var start = url.indexOf("/www");
		var end = url.lastIndexOf(")");
		var mp_url = url.substring(start, end);
		return mp_url;
	}
	function getphotopath2(url) {
		url = url.replace("\"", "");
		url = url.replace("\"", "");
		url = url.replace("\"", "");
		url = url.replace("\"", "");
		var starttext = "<?php echo $baseDir?>";
		var start = url.indexOf(starttext);
		var end = url.lastIndexOf(")");
		var mp_url = url.substring(start, end);
		return mp_url;
	}
	function adjustHeight() {
		var h = $(window).height() - 60;//$('#sidebar').height();
    	var doch = $('#content').height();
    	var hh = 0;

    	if (h < doch) hh = doch;
    	else hh = h; $('#sidebar').height(h);
    	$('#sidebar').height(hh);
	}
	$(document).ready(function() {
		adjustHeight();
	
		$('#ajax-preloader').hide();
        $('#ajax-preloader')
        .ajaxStart(function(){
            $(this).show();
        }).ajaxStop(function(){
        	adjustHeight();
        	
        	$('#ajax-preloader').hide();
        	//$(this).fadeOut('slow',function(){$(this).hide();});
        });
	});
</script>
<div id="preloader">
	<p style="margin-top: 200px; margin-bottom: 30px; color: #FF2C67; font-size: 26px;">Loading...</p>
    <!-- <img src="<?php echo $baseDir; ?>/www/img/admin/loading.gif" alt="Loading" /> -->
</div>
<script type="text/javascript">
	$(window).load(function(){
		$('#preloader').fadeOut(500, function(){
			$(this).remove();
		});
		$('#ajax-preloader').hide();
	});

</script>

<div id="ajax-preloader">
	<img src="<?php echo $baseDir; ?>/www/img/admin/ajax-loading.gif" alt="Loading..." />
</div>

<!-- PLUGIN
================================================== -->
<link rel="stylesheet" href="<?php echo $baseDir ?>/www/plugins/contextmenu/jquery.contextMenu.css"/>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/plugins/contextmenu/jquery.ui.position.js"></script>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/plugins/contextmenu/jquery.contextMenu.js"></script>

<link rel="stylesheet" href="<?php echo $baseDir ?>/www/plugins/magnific-popup/magnific-popup.css"/>
<script type="text/javascript" src="<?php echo $baseDir ?>/www/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script>
function popGallery(obj, effect) {
	if (effect == "" || effect == undefined)
		effect = "mfp-with-zoom";

	$(obj).magnificPopup({
		delegate: 'a',
		type:'image',
		gallery: {
  			enabled:true,
  			tPrev: '다음사진', // title for left button
  			tNext: '이전사진', // title for right button
		},
		closeOnContentClick: false,
		closeBtnInside: false,
		//mainClass: 'mfp-with-zoom mfp-img-mobile',
		mainClass: effect,
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				var title = item.el.attr('title');
				if (title == undefined) title = "내용이 없습니다.";
				return title;
			  	//return title + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
			}
		},
		zoom: {
			enabled: true,
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
			  return element.find('img');
			}
		}
	});
}
function popGpsPosition(lat, long)
{
	var url = "http://maps.google.com/maps?z=8&t=m&q=loc:";
		url = url + lat + "+" + long;
		
		$.magnificPopup.open({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-with-zoom',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false,

			items: {
			  src: url,
			  type: 'iframe'
			}
		}, 0);
}
function isNumber(val)
{
	return /^\d+$/.test(val);
}

function showPhoto(url) {
    if (isnophoto(url)) return;
    document.getElementById('modal--image').src = url;
    showModal('image', 'popup-showphoto', '');
}
function onClickClose() {
    closeModal();
    document.getElementById('modal--image').src = "";
}
function showDiplicate(seq,zadminseq) {
    document.getElementById('zseq').value = seq;
    document.getElementById('zadminseq').value = zadminseq;
    showModal('image', 'duplicate', '');
}
function onDuplicate() {
    var exname = $("#namedulicate").val();
    var zseq = $("#zseq").val();
    var zadminseq = $("#zadminseq").val();
    $.post("<?php echo $baseDir; ?>/admin/cworkout/duplicate_workout", {
        zseq:zseq,
        exname:exname,
        zadminseq:zadminseq
    }, function(data) {
        document.location.href = '/admin/cworkout/lists?page=0';
    });
}
function onSubmitDuplicate()
{
    if ($("#namedulicate").val() == "") {
        alert("Please enter new name workout.");
        $("#namedulicate").focus();
        return;
    }
    if (confirm("Are you sure to save this?")) {
        onDuplicate();
    }
}
</script>

<div id="popup-showphoto" class="modal__container">
    <div class="modal__outline modal--clouddate">
        <section class="modal modal--image" data-modal="image" data-animation="fade" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
        <img id="modal--image" class="modal__img" onclick="onClickClose();return false;"/>
        </section>
    </div>
</div>
    <div id="duplicate" class="modal__container" >
    <div class="modal__outline modal--clouddate" style="width: 40%">
        <section class="modal modal--image" data-modal="image" data-animation="fade" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
            <table class='register' style="background: #F7F7F7;">
                <tr>
                    <td>Rename workout</td>
                    <td><input type="hidden" id="zseq" name="zseq" value="">

                        <input type="hidden" id="zadminseq" name="zadminseq" value="">
                        <input class="medium" id="namedulicate" name="namedulicate" required="required" placeholder=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button class="normal" onclick="onSubmitDuplicate();return false;">Duplicate</button>
                        <button class="normal" onclick="onClickClose();return false;">Cancel</button>
                    </td>
                </tr>
            </table>

        </section>
    </div>
</div>