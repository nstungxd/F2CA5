<?php /*-*- mode: C; mode: font-lock; tab-width:4 -*-*/
/*
 * Tested with php-java-bridge 5.4.4.2
*/

/*
 * The main render engine.
 */
Class ClearReports_Report {

  /*
  * The configuration properties from the crystalclear.properties file.
  */
  var $configuration_props;

  /*
   * The request properties from the post and get request.
   */
  var $props;

  /*
   * Constructor. We contact the i-net Clear Reports server
   * ask for the configuration properties and store the get and post
   * properties into the $props property bag.
   */
  function ClearReports_Report($home, $get=0, $post=array()) {
	if($get!=0) {
	  // Get the request properties
	  $this->props = clearreports_get_request_properties($get, $post);
	  
	  // We probably must return a HTML page with the java viewer applet embedded
	  // Modify the properties for the HTML page with the java applet (if necessary)
	  $this->_set_html_page_properties();
	}
  }
				   
  /*
   * only for internal use
   */
  function _set_html_page_properties() {
	$script = $_SERVER['SCRIPT_NAME'];     //..foo/Sample.php
	$last_slash = strrpos($script, "/");
	$path=substr($script, 0, $last_slash); //..foo
	$context=substr($script, $last_slash); // /Sample.php
	$url="http://".$_SERVER["SERVER_NAME"];
	
	$this->props->put("http_server_port", $url.":".$_SERVER['SERVER_PORT'] . $path);
	$this->props->put("http_server", $url . $path);
	$this->props->put("context", $context);
	
    $this->props->put( "cookie", $_COOKIE );
    $this->props->put( "application_context", $_SERVER["SCRIPT_NAME"] );
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
		$this->props->put( "locale", $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
	}
	
  }
  /*
   * only for internal use
   */
  function _send_response($bridge) {
	$page_data=$bridge->getResponseData();
	$page_data=java_values($page_data);
	// @ apache_setenv('no-gzip', 1);
   // @ ini_set('zlib.output_compression', 0);
   header("Content-type: " . $this->props->getProperty("content"));
   header("Content-Length: " . strlen($page_data));
	echo $page_data;
  }
  /*
   * This method returns true if we must send back a HTML page with
   * the java viewer embedded.  When the java viewer starts, it will
   * contact us again and this time the must_send_html_page() will
   * return false.
   */
  function must_send_html_page() {
	$is_init   = strlen($this->props->getProperty("init",""))>0;
	$is_viewer = strlen($this->props->getProperty("viewer",""))>0;
	return !($is_init || $is_viewer);
  }

  /*
   * You can override these functions in order to change the HTML page, the report name
   * or the content of the report itself.
   */
  function checkHtmlPageProperties($props){}
  function checkProperties($props){}
  function checkEngine($engine, $immutable_props){}

  /*
   * Same as the service() method of a java servlet.  This method
   * executes the report and sends back the report data to the client
   */
  function print_report_data()
  {
	 // global $inetreportsfiles;
	// let the user modify the properties 
	if($this->must_send_html_page()) {
	  $this->checkHtmlPageProperties($this->props);
	} else {
	  $this->checkProperties($this->props);
	  if(strlen($this->props->getProperty("reportname", ""))>0) {
		$reportname = $this->props->getProperty("reportname");
		$script = $_SERVER['SCRIPT_FILENAME'];
		if(strlen($this->props->getProperty("report", ""))>0) {
		  error_log("Both properties reportname and report are set.  I will use the reportname property instead.");
		}
		// $report = "file:" . dirname($script) . $reportname;
		$report = "file:" . $reportname;
		$props.put("report", $report);
	  }
	}
	// echo $this->props; exit;
	// Give the properties object to the report bridge so that
	// it can decide what to do
	$report = new Java("com.inet.report.ReportBridge", $this->props);

	// Try to get the report engine from the bridge -- will return
	// null if an error occurred, if must_send_html_page() returns true
	// or if the report matching the above properties is already in
	// the cache server
	$engine = $report->getEngine();
	if(!java_is_null($engine)) {
	  // We've obtained the report!  Let the user modify it and
	  // execute it to move the page data into the
	  // i-net Clear Reports cache server.
	  $this->checkEngine($engine, $this->props);
	  $report->execute();
	}
	
	// Send back the page data -- either binary data for the java viewer,
	// a HTML- or error page, or a page in the specified init= format (PDF,
	// RTF, PS, XML, XLS etc.)
	$this->_send_response($report);
  }
}
?>