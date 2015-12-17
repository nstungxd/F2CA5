<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=1200"/>
    <title>{$SITE_SEO_TITLE}</title>
    <link href="{$SITE_CSS}{$cssfile}" rel="stylesheet" type="text/css"/>
    <meta name="keywords" content="{$META_KEYWORD}"/>
    <meta name="description" content="{$META_DESCRIPTION}"/>
{$META_OTHER}
    <base href="{$SITE_URL_DUM}"/>
    <link href="{$SITE_CSS}jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="{$S_JQUERY}jquery.js"></script>
    <script type="text/javascript" src="{$SITE_CONTENT_JS}jgeneral.js"></script>


    <!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="{$SITE_CSS}bootstrap/bootstrap.min.css" />

	<!-- RTL support - for demo only -->
	<script src="js/demo-rtl.js"></script>

	<link rel="stylesheet" type="text/css" href="{$SITE_CSS}libs/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="{$SITE_CSS}libs/nanoscroller.css" />

	<!-- global styles -->
	<link rel="stylesheet" type="text/css" href="{$SITE_CSS}compiled/theme_styles.css" />

	<!-- this page specific styles -->
	<link rel="stylesheet" href="{$SITE_CSS}libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="{$SITE_CSS}libs/jquery-jvectormap-1.2.2.css" type="text/css" />
	<link rel="stylesheet" href="{$SITE_CSS}libs/weather-icons.css" type="text/css" />



	<!-- google font libraries -->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

</head>
{literal}
<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        },i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-42379708-5', 'auto');
    ga('send', 'pageview');
</script>

<script type="text/javascript" async="async">
var d = new Date()
var gmtoffset = d.getTimezoneOffset();
function njs() {
    $('#nojs').attr('innerHTML', '');
}
</script>
{/literal}
{include file="jsvars.tpl"}
{if $file|@in_array:$notincludeindex}
<body class="pop">
<div>
{include file="member/user/oudashboard.tpl"}
</div>
</body>
    {else}
<body id="{$bodyid}" class="{$bodycls}" onload="njs();">
<div id="{$dvid}">
    {include file="top/user/b2top.tpl"}
    <div id="{$mdivid}" class="container">
            <div id="pane2" class="row" >
                {include file="left/user/b2left.tpl"}
                {include file="member/user/oudashboard.tpl"}
            </div>
    </div>
</div>
<div class="clear" style="height:1px;">&nbsp;</div>
</div>
<div class="clear" style="height:3px;">&nbsp;</div>
{include file="bottom/bottom.tpl"}
<div class="clear" style="height:1px;">&nbsp;</div>
<div id="flmsg" class="flmsg" style="z-index:300">
    {if $multipleLogins eq 'yes'}
        <div class="draggable" style="background:#aceef7; width:350px; float:right;">
            <div class="droppable" style="color:#ff0000; padding:3px; height:37px;">
                <center><span class="" style=""><p class="" style="height:9px;"><b>{$MSG_ANOTHER_LOGIN}
                    <br/>{*$MSG_LOGOUT_FROM_OTHER_PLACES*}</b></p></span></center>
			<span style=""><center>
                <form method="post" action="{$SITE_URL}index.php?file=m-aj_logoutothers" style="display:inline;">
                    <input class="flbtn" type="submit" name="lgout" id="lgout" value="{$LBL_LOGOUT_FROM_OTHER_PLACES}"
                           style=""/>
                    <span style="float:right; padding-top:3px;"><img src="{$SITE_IMAGES}sm_images/icon-cancel.gif"
                                                                     title="{$LBL_CLOSE}" onclick="closemsg('flmsg');"/></span>
                </form>
            </center>
			</span>
            </div>
        </div>
    {/if}
</div>
<span id="nojs"><noscript>
    <meta http-equiv="REFRESH" content="0; URL={$SITE_URL_DUM}nojavascript.php"/>
</noscript></span>
<!-- global scripts -->
<script src="{$SITE_JS}demo-skin-changer.js"></script> <!-- only for demo -->

<script src="{$SITE_JS}jquery.js"></script>
<script src="{$SITE_JS}bootstrap.js"></script>
<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>

<script src="{$SITE_JS}demo.js"></script> <!-- only for demo -->

<!-- this page specific scripts -->
<script src="{$SITE_JS}moment.min.js"></script>
<script src="{$SITE_JS}jquery-jvectormap-1.2.2.min.js"></script>
<script src="{$SITE_JS}jquery-jvectormap-world-merc-en.js"></script>
<script src="{$SITE_JS}gdp-data.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.min.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.resize.min.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.time.min.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.threshold.js"></script>
<script src="{$SITE_JS}flot/jquery.flot.axislabels.js"></script>
<script src="{$SITE_JS}jquery.sparkline.min.js"></script>
<script src="{$SITE_JS}skycons.js"></script>

<!-- theme scripts -->
<script src="{$SITE_JS}scripts.js"></script>
<script src="{$SITE_JS}pace.min.js"></script>
	{literal}
    <script>
	$(document).ready(function() {

	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}

		if ($('#graph-bar').length) {
			var data1 = [
			    [gd(2015, 1, 1), 838], [gd(2015, 1, 2), 749], [gd(2015, 1, 3), 634], [gd(2015, 1, 4), 1080], [gd(2015, 1, 5), 850], [gd(2015, 1, 6), 465], [gd(2015, 1, 7), 453], [gd(2015, 1, 8), 646], [gd(2015, 1, 9), 738], [gd(2015, 1, 10), 899], [gd(2015, 1, 11), 830], [gd(2015, 1, 12), 789]
			];

			var data2 = [
			    [gd(2015, 1, 1), 342], [gd(2015, 1, 2), 721], [gd(2015, 1, 3), 493], [gd(2015, 1, 4), 403], [gd(2015, 1, 5), 657], [gd(2015, 1, 6), 782], [gd(2015, 1, 7), 609], [gd(2015, 1, 8), 543], [gd(2015, 1, 9), 599], [gd(2015, 1, 10), 359], [gd(2015, 1, 11), 783], [gd(2015, 1, 12), 680]
			];

			var series = new Array();

			series.push({
				data: data1,
				bars: {
					show : true,
					barWidth: 24 * 60 * 60 * 12000,
					lineWidth: 1,
					fill: 1,
					align: 'center'
				},
				label: 'Revenues'
			});
			series.push({
				data: data2,
				color: '#e84e40',
				lines: {
					show : true,
					lineWidth: 3,
				},
				points: {
					fillColor: "#e84e40",
					fillColor: '#ffffff',
					pointWidth: 1,
					show: true
				},
				label: 'Orders'
			});

			$.plot("#graph-bar", series, {
				colors: ['#03a9f4', '#f1c40f', '#2ecc71', '#3498db', '#9b59b6', '#95a5a6'],
				grid: {
					tickColor: "#f2f2f2",
					borderWidth: 0,
					hoverable: true,
					clickable: true
				},
				legend: {
					noColumns: 1,
					labelBoxBorderColor: "#000000",
					position: "ne"
				},
				shadowSize: 0,
				xaxis: {
					mode: "time",
					tickSize: [1, "month"],
					tickLength: 0,
					// axisLabel: "Date",
					axisLabelUseCanvas: true,
					axisLabelFontSizePixels: 12,
					axisLabelFontFamily: 'Open Sans, sans-serif',
					axisLabelPadding: 10
				}
			});

			var previousPoint = null;
			$("#graph-bar").bind("plothover", function (event, pos, item) {
				if (item) {
					if (previousPoint != item.dataIndex) {

						previousPoint = item.dataIndex;

						$("#flot-tooltip").remove();
						var x = item.datapoint[0],
						y = item.datapoint[1];

						showTooltip(item.pageX, item.pageY, item.series.label, y );
					}
				}
				else {
					$("#flot-tooltip").remove();
					previousPoint = [0,0,0];
				}
			});

			function showTooltip(x, y, label, data) {
				$('<div id="flot-tooltip">' + '<b>' + label + ': </b><i>' + data + '</i>' + '</div>').css({
					top: y + 5,
					left: x + 20
				}).appendTo("body").fadeIn(200);
			}
		}

		//WORLD MAP
		$('#world-map').vectorMap({
			map: 'world_merc_en',
			backgroundColor: '#ffffff',
			zoomOnScroll: false,
			regionStyle: {
				initial: {
					fill: '#e1e1e1',
					stroke: 'none',
					"stroke-width": 0,
					"stroke-opacity": 1
				},
				hover: {
					"fill-opacity": 0.8
				},
				selected: {
					fill: '#8dc859'
				},
				selectedHover: {
				}
			},
			markerStyle: {
				initial: {
					fill: '#e84e40',
					stroke: '#e84e40'
				}
			},
			markers: [
				{latLng: [38.35, -121.92], name: 'Los Angeles - 23'},
				{latLng: [39.36, -73.12], name: 'New York - 84'},
				{latLng: [50.49, -0.23], name: 'London - 43'},
				{latLng: [36.29, 138.54], name: 'Tokyo - 33'},
				{latLng: [37.02, 114.13], name: 'Beijing - 91'},
				{latLng: [-32.59, 150.21], name: 'Sydney - 22'},
			],
			series: {
				regions: [{
					values: gdpData,
					scale: ['#6fc4fe', '#2980b9'],
					normalizeFunction: 'polynomial'
				}]
			},
			onRegionLabelShow: function(e, el, code){
				el.html(el.html()+' ('+gdpData[code]+')');
			}
		});

		/* SPARKLINE - graph in header */
		var orderValues = [10,8,5,7,4,4,3,8,0,7,10,6,5,4,3,6,8,9];

		$('.spark-orders').sparkline(orderValues, {
			type: 'bar',
			barColor: '#ced9e2',
			height: 25,
			barWidth: 6
		});

		var revenuesValues = [8,3,2,6,4,9,1,10,8,2,5,8,6,9,3,4,2,3,7];

		$('.spark-revenues').sparkline(revenuesValues, {
			type: 'bar',
			barColor: '#ced9e2',
			height: 25,
			barWidth: 6
		});

		/* ANIMATED WEATHER */
		var skycons = new Skycons({"color": "#03a9f4"});
		// on Android, a nasty hack is needed: {"resizeClear": true}

		// you can add a canvas by it's ID...
		skycons.add("current-weather", Skycons.SNOW);

		// start animation!
		skycons.play();

	});
	</script>
    {/literal}
</body>
{/if}
</html>
{literal}
<script type="text/javascript" async="async">
    function CallColoerBox(href, width, height, type) {
        $(document).ready(function() {
            if (type == 'image') {
                $(".single").colorbox();
            } else if (type == 'slideshow') {
                $("a[rel='slides']").colorbox({slideshow:true});
            } else if (type == 'options') {
                $(".colorbox").colorbox({width:"" + width + "px", height:"" + height + "px", iframe:true,href:"" + href + ""});
            } else {
                $("a[href='" + href + "']").colorbox({width:"" + width + "px", height:"" + height + "px", iframe:true});
            }
        });
    }
</script>
{/literal}
{if $file neq 'c-home' && $file neq 'c-login' && $file neq '' && $file neq 'c-aboutus' && $file neq 'c-contactus' && $file neq 'c-privacypolicy' && $file neq 'c-forgotpass' && $file neq 'm-orgregister'}
    {literal}
    <script type="text/javascript" async="async">
    $(document).ready(function() {
        $('.left-menu dl').each(function() {
            $(this).click(toggleleft);
        });
        $('#flmsg').fadeIn('slow');
        /*	$('.draggable').draggable({
          containment: 'parent',
          opacity: 0.70
      });*/
        $(function() {
            var ead = 10;
            $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
        });
        $("div.middle-container").bind("resize", function() {
            var ead = 10;
            $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
        });
        /*	$("div.middle-containt").bind("resize", function() {
                // $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-containt'});
            });
        */
        /*if($.browser.msie) {
          $('div.middle-container').live("resize", function() {
              $(document).ready( function() {
                  var ead = 10;
                  $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
              });
          });
      } else if($.browser.webkit) {
          //
      } else {
          $('div.middle-container').bind('DOMAttrModified', function(event) {
              $(document).ready( function() {
                  var ead = 10;
                  $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
              });
          });
      }*/
        $("div.middle-container").watch('width,height', function() {
            $(document).ready(function() {
                var ead = 10;
                $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
            });
        });
    });
    function toggleleft ()
    {
        $(this).next('ul').toggle('slow');
            if($('#jScrollPaneContainer').height() <= (parseInt($('div.left-menu').height()) + 90) || !($('#jScrollPaneContainer').height()))
    {
    var ust = '{/literal}{$sess_usertype_short}{literal}';
    if (ust == 'OU') {
        ead = 190;
    } else {
        ead = 170;
    }
    $(document).ready(function() {
        $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.left-menu', eladd:ead});
    });
}
}
function closemsg(el) {
    $('#' + el).fadeOut('slow');
}
</script>
{/literal}
{/if}
