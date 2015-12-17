<?php
/*-*- mode: C; mode: font-lock; tab-width:4 -*-*/
/*
i-net software provides programming examples for illustration only,
without warranty either expressed or implied, including, but not
limited to, the implied warranties of merchantability and/or fitness
for a particular purpose. This programming example assumes that you
are familiar with the programming language being demonstrated and the
tools used to create and debug procedures. i-net software support
professionals can help explain the functionality of a particular
procedure, but they will not modify these examples to provide added
functionality or construct procedures to meet your specific needs.  
© i-net software 1998-2011

This is a more complex PHP script to give you an example of how to set
and change report properties for our java viewer applet. Copy this
file to the appropriate place so that your PHP engine can find it and
invoke it with
http://host/.../Sample.php?reportProperty1=xxx&reportProperty2=yyy,
assuming your web-server listens on port 80. The reportProperties are
described at:
http://www.inetsoftware.de/documentation/crystal-clear/online-help/features/report-url-parameters.
See also:
http://www.inetsoftware.de/documentation/crystal-clear/online-help/features/usage-of-crystal-clear.


Here's how this PHP is used to generate a report:

0. A client requests the following getLine:
   http://localhost?reportfile=report1.rpt&prompt0=1&SF=true&hasgrouptree=false
 
1. A properties object is created with contains the pairs (report
   . http://localhost:80?report=file:.../report1.rpt&prompt0=1&SF=true),
   (prompt0 . 1), (sf . true) (hasgrouptree . false).

2. The code below marked with "STEP 1" is returned to the client.  You
   can use the properties object to modify the HTML code.
 
3. The viewer starts in the client's HTML page and passes the report
   pair from step 1 back to the report servlet.
 
4. The ReportServlet reads the getLine passed to it from the report
   viewer and converts it into key/value pairs and stores them into a
   newly allocated properties object. The object contains the pairs:
   (report . file:.../report1.rpt), (prompt0 . 1), (sf . true).
 
5. checkProperties is run (see code below marked with STEP 2).
 
6. the report template is examined, an engine object is created.
 
7. checkProperties with an engine parameter is run (see code below
   marked with STEP 3).
 
8. the report is executed, the ReportServlet sends back the binary
   data to the report viewer running in the client's HTML page.
*/

/*--------------------- The code -------------------------------------------*/

/*
 * We write our own class My_Report which extends from the
 * ClearReports_Report class. You can use your own descendant of
 * ClearReports_Report if you wish, see documentation of ClearReports_Report.
*/
$rptfile = PostVar('rptfile');
$rptfile = (trim($rptfile)!='')? $rptfile : GetVar('rptfile');
// echo $rptfile; exit;
/*$msg = GetVar('msg');
$pvar = $_POST;
$rptfile = PostVar('rptfile');
$rptfile = (trim($rptfile)!='')? $rptfile : GetVar('rptfile');
// unset($pvar['rptfile']);
$_GET['init'] = $pvar['init'];
$script = $_SERVER['SCRIPT_FILENAME'];
$_POST['report'] = "file:" . dirname($script) . "$inetreportsfiles/$rptfile.rpt";
unset($pvar['init']);
$pvar = array();
$pvar['param1'] = 'Invoice Report';
$pvar = '&'.http_build_query($pvar);*/
// pr($pvar); exit;
// $_POST['param1'] = 'Invoice Reports';
$_GET['type'] = (isset($_GET['init']))? $_GET['init'] : '';
$_GET['iOrganizationID'] = $curORGID;
$_GET['iUserID'] = $sess_id;
$parameters = $_GET['parameters'];
if(is_array($parameters) && count($parameters)>0) {
  foreach($parameters as $ky => $vl) {
	 $_GET['prompt'.$ky] = $vl;
  }
}
unset($_GET['parameters']);
$inetreportsfiles = (isset($sess_usertype_short) && (trim($sess_usertype_short)=='OA' || trim($sess_usertype_short)=='OU'))? $inetreportsfiles.'/adminrpt' : $inetreportsfiles.'/userrpt';
//
// pr($_GET); exit;
set_time_limit(0);
require_once("http://localhost:8080/JavaBridge/java/Java.inc");
java_require("$inetcorehome/ClearReports.jar;$inetcorehome/ReportViewer.jar;$inetcorehome/CCLib.jar;$javalib/mysql-connector-java-5.1.10.jar");
/*
 * Helper function to get the request property bag from the
 * get and post parameters
*/

function clearreports_get_request_properties($get, $post)
{
  $p=new Java("java.util.Properties");
  foreach ($post as $key => $val) {
	$p->put($key, $val);
  }
  foreach ($get as $key => $val) {
	$p->put($key, $val);
  }
  // Add the client language that the browser has sent.  Useful for
  // multi-language reports.
  $p->put("locale", array_key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : "en");

  if(array_key_exists('PATH_INFO', $_SERVER)) {
	$reportname = $_SERVER['PATH_INFO'];
	$p->put("reportname", java_values($reportname));
  }
  return $p;
}

include_once("$clearreportsclass/ClearReports_Report.php");

class My_Report extends ClearReports_Report
{
  function setConfiguration()
  {
	$mana = new Java("com.inet.report.config.ConfigurationManager");
	$manager = $mana->getInstance();
	$conf = $manager->getCurrent();

	$name = "Default";
	$scope_name = "System";
	$scope = $conf->SCOPE_SYSTEM;
	if($scope_name == "USER") {
		$scope = $conf->SCOPE_USER;
	}
	
	if($conf->getScope() != $scope || $conf->getName() != $name) {
		$conf = $manager->get( $scope , $name );
	$manager->setCurrent( $conf );
	}
  }

/* 
 * STEP 2: change the report properties before the report template is
 * examined. The following code will be executed on the server. The
 * properties you set or change here will not go to the client and
 * will not appear in the source of the HTML page. Use the props
 * object to change the name of the report that should be examined
 * and/or its parameters, for example password, username, database,
 * schema, SF, prompt0, ...
 */

  function checkProperties($reportProperties)
  {
	 global $inetreportsfiles, $rptfile;
	 $currentReportName = strtolower($reportProperties->getProperty("report", ""));
	 if(strlen($currentReportName)==0) {
	   error_log("No report has been set. Please append ?reportfile=myReport.rpt&... Setting report to: /sample.rpt");
		$script = $_SERVER['SCRIPT_FILENAME'];
		// $report = "file:" . dirname($script) . "$inetreportsfiles/$rptfile.rpt";
		$report = "file:" . "$rptfile";
		$reportProperties->put("report", $report);
    }
  }


/* 
 * STEP 3: the report template has been examined, now adjust the
 * report a little bit using RDC. The following code will be executed
 * on the server. The properties you set or change here will not go to
 * the client and will not appear in the source of the HTML page. We
 * use the engine- and props-object to change the loaded report using
 * RDC.  In this example we simply add a text to the report
 * header. But one can use any RDC function available, including
 * setSQL(), setData() etc.
*/

  function checkEngine ($engine, $props) {
	  $area = $engine->getArea("RH");
	  $sec  = $area->getSection(0);
	  $text = $sec->addText(100, 100, 8000, 500); // coordinates in twips
	  $para = $text->addParagraph();
	  // $string = $props->getProperty("param1", "Append &param1=<text> to show the text here.");
	  $string = $props->getProperty("", "");
	  $para->addTextPart($string);
  }
}// end of My_Report class definition 


/*
 * now invoke our class
 */
$report = new My_Report($HOME, $_POST, $_GET);
$report->setConfiguration(); // set the configuration
//
if(!$report->must_send_html_page()) {
  $report->print_report_data(); 	// this will invoke the above callbacks
} else {
	/*
	 * instead of calling $report->print_report_data(); we generate
	 * the HTML page ourselfs by escaping back to HTML:
	 */
// print_r(java_values($report->props->getProperty("http_server_port"))); exit;
?>

<!-- STEP 1: send back a HTML page -->
<!--  The following code creates a HTML page with a report viewer applet -->
<!--  embedded.  The parameters you set here will be sent to the client and -->
<!--  are visible in your HTML browser. -->
<!--  Use the props object to change the look ot the HTML page depending on the report that -->
<!--  has been requested. -->
<HTML>
<HEAD><TITLE>My Report Viewer</TITLE></HEAD>
<BODY bgcolor="#eeeeee">
<applet code="com.inet.viewer.ViewerApplet" codebase='<?php print java_values($report->props->getProperty("http_server_port")); ?>'  id='ReportViewer' width='100%' height='95%' >
<param name=HasGroupTree value=false>
<param name=HasExportButton value=true>
<param name=HasRefreshButton value=true>
<param name=HasPrintButton value=false>
<!-- 
 set the ReportName (i.e. the URL for the callback) to something like:
 param name=ReportName value=http://<host>/cc/Sample.php?param1=value1&param2=value2&...
-->
<param name=ReportName value=
<?php
// the server + port + path, e.g.: http://host:80/cc/
$http_server_port = $report->props->getProperty("http_server_port"); 

// the script name, e.g.: Sample.php
$context = $report->props->getProperty("context");

$currentReportName = strtolower($report->props->getProperty("report", ""));

if(strlen($currentReportName)==0) {
	 $script = $_SERVER['SCRIPT_FILENAME'];
	 // $report_file = "file:" . dirname($script) . "/sample.rpt";
	 // $report_file = "file:" . dirname($script) . "$inetreportsfiles/$rptfile.rpt";
	 $report_file = "file:" . "$rptfile";
	 $report->props->put("report", $report_file);
}

// the parameters for the report, e.g.: report=foo.rpt&prompt0=1&sf=false&...
$key=new Java("com.inet.report.ReportKeyFactory", $report->props);
// echo $querystring = ""; exit;
// build the URL that the java viewer shall use to send us the request.
$request_url = $http_server_port . $context . "?" . $key->toString();
print $request_url;
?> >

<param name=Archive value=<?php print $report->props->getProperty("http_server_port") . "/$javalib_folder/ReportViewer.jar"?> >
</applet>
</BODY>
</HTML>
<?php
} // must_return_html_page
// http://107.20.246.110:9000/?report
exit;
?>