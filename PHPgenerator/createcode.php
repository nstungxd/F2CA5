<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Raw PHP: Create Code</title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	font-size: x-small;
}
.codetext{
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	font-size: x-small;
	font-style: normal;
	background-color: #FFFF00;
}

</style>

</head>

<body>
<h1>Copy/Paste Code Into Notepad</h1>
<h2>Database Connection</h2>
<b><i>Save as connect-db.php</i></b>
<div id="connect">
<p>&lt;?php<br />
<br />
// fill in with database server info<br />
$server = '';<br />
$user='';<br />
$pass='';<br />
$db='';<br />
<br />
<br />
// connect to the database<br />
$mysqli = new mysqli($server, $user, $pass, $db);<br />
<br />
// show errors (remove this line if on a live site)<br />
//mysqli_report(MYSQLI_REPORT_ERROR);<br />
<br />
?&gt;</p>
</div>
&nbsp;

<hr>
<?php


$ListScriptName = @$_GET["Tbl"]."list.php";
$ListScriptEdit = @$_GET["Tbl"]."rec.php";
$ListScriptDelete = @$_GET["Tbl"]."delete.php";
$ListScriptView = @$_GET["Tbl"]."view.php";
$PrimaryKey = @$_GET["PrimaryKey"];
$TableName =  @$_GET["Tbl"];
$FieldArray = array("");

foreach ($_GET as $key => $val)
{

if ($key!=="Submit" && $key!=="Tbl" && $key!=="PrimaryKey"){ 
array_push($FieldArray, $val);

}
}

$FieldArray = array_unique($FieldArray);
$n=0;
$listTableHeader='';
$datatypestring='';
$SelectString='';
$sqlcolsToUpdate='';
$bindParamStrA='';
$bindParamStr='';
$bindParamStrB='';
$chkStrNotEmpty='';
$ListFieldValues='';
$rowstoassign='';
$AddEditFormInputs = '';
$bindParamStrAddEdit='';
$fmPostToEdit='';
$viewPageResults ='';
foreach ($FieldArray as $key => $val)

{
//echo $key."=".$val."<br>";

if (!empty($val)){
//echo $key."=".$val."<br>";
$retdatatypes = explode("|",$val);
//echo $retdatatypes[0];
//echo $retdatatypes[1];
$valb=$retdatatypes[0];

$datatypestring = $datatypestring.$retdatatypes[1];
//echo $n. "=".$valb ."<br>";
$listTableHeader = $listTableHeader.'<th>'.$valb.'</th>';
//$viewTableHeader = $viewTableHeader.'<td>'.$valb.'</td>';

$SelectString = $SelectString."`$valb`,";
$ListFieldValues = $ListFieldValues."echo '&lt;td&gt;'.$$valb . '&lt;/td&gt;';<br />\n";
$rowstoassign=$rowstoassign.'$'.$valb.'=$row['.$n.'] ;<br />'."\n";
$sqlcolsToUpdate = $sqlcolsToUpdate."`$valb` = ?,";
$fmPostToEdit = $fmPostToEdit.'$'.$valb.'=htmlentities($_GET["'.$valb.'"], ENT_QUOTES);<br />'."\n";
$bindParamStrA=$bindParamStrA.$valb.",";
$bindParamStr = $bindParamStr.'$'.$valb.",";
$bindParamStrB=$bindParamStrB.'?,';
$bindParamStrAddEdit=$bindParamStrAddEdit.'$'.$valb."='',";
$chkStrNotEmpty = $chkStrNotEmpty.'$'.$valb." == '' || "; 
$AddEditFormInputs = $AddEditFormInputs.'&lt;strong&gt;'.$valb.': *&lt;/strong&gt; &lt;input type="text" name="'.$valb.'"<br />value="&lt;?php echo $'.$valb.'; ?&gt;"/&gt;&lt;br/&gt;<br />';
$viewPageResults = $viewPageResults .'print "&lt;tr&gt;&lt;td&gt;'.$valb.'&lt;/td&gt;&lt;td&gt;".$'.$valb . '."&lt;/td&gt;&lt;/tr&gt;";<br />'."\n";

$valb="";

$n=$n+1;
}

}
$listTableHeader="<tr>$listTableHeader<th>Edit</th><th>Delete</th><th>View</th></tr>";
$SelectString = RTRIM($SelectString,","); 
$sqlcolsToUpdate = RTRIM($sqlcolsToUpdate,","); 
$bindParamStrA = RTRIM($bindParamStrA,",");
$bindParamStr = RTRIM($bindParamStr,","); 
$bindParamStrB = RTRIM($bindParamStrB,",");
$chkStrNotEmpty = RTRIM($chkStrNotEmpty," || ");
///start List Page here
?>

<h2>List of Records</h2>
<b><i>Save as <?php print $ListScriptName;?></i></b>
<br />
<div id="listForm">
&lt;?php<br />
include('logincheck.php');<br />
// connect to the database<br />
include('connect-db.php');<br />
<br />
// number of results to show per page<br />
$per_page = 3;<br />
<br />
// figure out the total pages in the database<br />
if ($result = $mysqli-&gt;query(&quot;SELECT <?php print $SelectString;?> 
FROM `<?php print $TableName;?>`&quot;))<br />
{<br />
if ($result-&gt;num_rows != 0)<br />
{<br />
$total_results = $result-&gt;num_rows;<br />
print $total_results .&quot; Records&quot;;<br />
// ceil() returns the next highest integer value by rounding up value if 
necessary<br />
$total_pages = ceil($total_results / $per_page);<br />
<br />
// check if the 'page' variable is set in the URL (ex: 
view-paginated.php?page=1)<br />
if (isset($_GET['page']) &amp;&amp; is_numeric($_GET['page']))<br />
{<br />
$show_page = $_GET['page'];<br />
<br />
// make sure the $show_page value is valid<br />
if ($show_page &gt; 0 &amp;&amp; $show_page &lt;= $total_pages)<br />
{<br />
$start = ($show_page -1) * $per_page;<br />
$end = $start + $per_page; <br />
}<br />
else<br />
{<br />
// error - show first set of results<br />
$start = 0;<br />
$end = $per_page; <br />
} <br />
}<br />
else<br />
{<br />
// if page isn't set, show first set of results<br />
$start = 0;<br />
$end = $per_page; <br />
}<br />
<br />
// display pagination<br />
echo &quot;&lt;p&gt;&lt;a href='<?php print $ListScriptName;?>'&gt;View All&lt;/a&gt; | &lt;b&gt;View 
Page:&lt;/b&gt; &quot;;<br />
for ($i = 1; $i &lt;= $total_pages; $i++)<br />
{<br />
if (isset($_GET['page']) &amp;&amp; $_GET['page'] == $i)<br />
{<br />
echo $i . &quot; &quot;;<br />
}<br />
else<br />
{<br />
echo &quot;&lt;a href='<?php print $ListScriptName;?>?page=$i'&gt;$i&lt;/a&gt; &quot;;<br />
}<br />
}<br />
echo &quot;&lt;/p&gt;&quot;;<br />
<br />
// display data in table<br />
echo &quot;&lt;table border='1' cellpadding='10'&gt;&quot;;<br />
echo &quot;<?php print htmlentities($listTableHeader);?>&quot;;<br />
<br />
// loop through results of database query, displaying them in the table <br />
for ($i = $start; $i &lt; $end; $i++)<br />
{<br />
// make sure that PHP doesn't try to show results that don't exist<br />
if ($i == $total_results) { break; }<br />
<br />
// find specific row<br />
$result-&gt;data_seek($i);<br />
$row = $result-&gt;fetch_row();<br />
<?php print $rowstoassign;?>
// echo out the contents of each row into a table<br />
echo &quot;&lt;tr&gt;&quot;;<br />
<?php print $ListFieldValues;?>
echo '&lt;td&gt;&lt;a href=&quot;<?php print $ListScriptEdit;?>?id=' . $<?php print $PrimaryKey;?> 
. '&quot;&gt;Edit&lt;/a&gt;&lt;/td&gt;';<br />
echo '&lt;td&gt;&lt;a href=&quot;<?php print $ListScriptDelete;?>?id=' . $<?php print $PrimaryKey;?> 
. '&quot;&gt;Delete&lt;/a&gt;&lt;/td&gt;';<br>echo '&lt;td&gt;&lt;a href=&quot;<?php print $ListScriptView;?>?id=' . $<?php print $PrimaryKey;?> 
. '&quot;&gt;View&lt;/a&gt;&lt;/td&gt;';<br />
echo &quot;&lt;/tr&gt;&quot;;<br />
}<br />
<br />
// close table&gt;<br />
echo &quot;&lt;/table&gt;&quot;;<br />
}<br />
else<br />
<br />
{<br />
echo &quot;No results to display!&quot;;<br />
} <br />
}<br />
// error with the query<br />
else<br />
{<br />
echo &quot;Error: &quot; . $mysqli-&gt;error;<br />
}<br />
<br />
// close database connection<br />
$mysqli-&gt;close();<br />
<br />
?&gt;<br />
<br />
&lt;a href=&quot;<?php print $ListScriptEdit;?>&quot;&gt;Add New Record&lt;/a&gt;<br />
&nbsp;

<hr>
</div>
<h2>Edit and Add New Records</h2>
<b><i>Save as <?php print $ListScriptEdit;?></i></b>
<p>&lt;?php<br />
include('logincheck.php');<br />
/*<br />
Allows the user to both create new records and edit existing records<br />
*/<br />
<br />
// connect to the database<br />
include(&quot;connect-db.php&quot;);<br />
<br />
// creates the new/edit record form<br />
// since this form is used multiple times in this file, I have made it a 
function that is easily reusable<br />
function renderForm(<?php print $bindParamStrAddEdit;?> $error = '', $id = '')<br />
{ ?&gt;<br />
&lt;!DOCTYPE HTML PUBLIC &quot;-//W3C//DTD HTML 4.01//EN&quot; 
&quot;http://www.w3.org/TR/html4/strict.dtd&quot;&gt;<br />
&lt;html&gt;<br />
&lt;head&gt; <br />
&lt;title&gt;<br />
&lt;?php if ($id !== '') { echo &quot;Edit Record&quot;; } else { echo &quot;New Record&quot;; } ?&gt;<br />
&lt;/title&gt;<br />
&lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=utf-8&quot;/&gt;<br />
&lt;/head&gt;<br />
&lt;body&gt;<br />
&lt;h1&gt;&lt;?php if ($id !=='') { echo &quot;Edit Record&quot;; } else { echo &quot;New Record&quot;; } 
?&gt;&lt;/h1&gt;<br />
&lt;?php <br />
if (!empty($error)) {<br />
echo &quot;&lt;div style='padding:4px; border:1px solid red; color:red'&gt;&quot; . $error<br />
. &quot;&lt;/div&gt;&quot;;<br />
} ?&gt;<br />
<br />
&lt;form action=&quot;&quot; method=&quot;post&quot;&gt;<br />
&lt;div&gt;<br />
&lt;?php if ($id !== '') { ?&gt;<br />
&lt;input type=&quot;hidden&quot; name=&quot;id&quot; value=&quot;&lt;?php echo $id; ?&gt;&quot; /&gt;<br />
&lt;p&gt;ID: &lt;?php echo $id; ?&gt;&lt;/p&gt;<br />
&lt;?php } ?&gt;<br />
<br />
<?php print $AddEditFormInputs;?>
<br />
&lt;p&gt;* required&lt;/p&gt;<br />
&lt;input type=&quot;submit&quot; name=&quot;submit&quot; value=&quot;Submit&quot; /&gt;<br />
&lt;/div&gt;<br />
&lt;/form&gt;<br />
&lt;/body&gt;<br />
&lt;/html&gt;<br />
<br />
&lt;?php }<br />
<br />
<br />
<br />
/*<br />
<br />
EDIT RECORD<br />
<br />
*/<br />
// if the 'id' variable is set in the URL, we know that we need to edit a record<br />
if (isset($_GET['id']))<br />
{<br />
// if the form's submit button is clicked, we need to process the form<br />
if (isset($_GET['submit']))<br />
{<br />
// make sure the 'id' in the URL is valid<br />
if (is_numeric($_GET['id']))<br />
{<br />
// get variables from the URL/form<br />
$id = $_GET['id'];<br />
<?php print $fmPostToEdit;?>
<br />
// check that firstname and lastname are both not empty<br />
if (<?php print $chkStrNotEmpty;?>)<br />
{<br />
// if they are empty, show an error message and display the form<br />
$error = 'ERROR: Please fill in all required fields!';<br />
renderForm(<?php print $bindParamStr;?>, $error, $id);<br />
}<br />
else<br />
{<br />
// if everything is fine, update the record in the database<br />
if ($stmt = $mysqli-&gt;prepare(&quot;UPDATE <?php print $TableName;?> SET <?php print $sqlcolsToUpdate;?><br />
WHERE <?php print $PrimaryKey;?>=?&quot;))<br />
{<br />
$stmt-&gt;bind_param(&quot;<?php print $datatypestring;?>i&quot;, <?php print $bindParamStr;?>
,$id);<br />
//sssii one letter for each item s for strings i for numeric d for double or 
decimal
<br />
$stmt-&gt;execute();<br />
$stmt-&gt;close();<br />
}<br />
// show an error message if the query has an error<br />
else<br />
{<br />
echo &quot;ERROR: could not prepare SQL statement.&quot;;<br />
}<br />
<br />
// redirect the user once the form is updated<br />
header(&quot;Location: <?php print $ListScriptName;?>&quot;);<br />
}<br />
}<br />
// if the 'id' variable is not valid, show an error message<br />
else<br />
{<br />
echo &quot;Error!&quot;;<br />
}<br />
}<br />
// if the form hasn't been submitted yet, get the info from the database and 
show the form<br />
else<br />
{<br />
// make sure the 'id' value is valid<br />
if (is_numeric($_GET['id']) &amp;&amp; $_GET['id'] &gt; 0)<br />
{<br />
// get 'id' from URL<br />
$id = $_GET['id'];<br />
<br />
// get the recod from the database<br />
if($stmt = $mysqli-&gt;prepare(&quot;SELECT <?php print $SelectString;?> FROM <?php print $TableName;?> 
WHERE <?php print $PrimaryKey;?>=?&quot;))<br />
{<br />
$stmt-&gt;bind_param(&quot;i&quot;, $id);<br />
$stmt-&gt;execute();<br />
<br />
$stmt-&gt;bind_result(<?php print $bindParamStr;?>);<br />
$stmt-&gt;fetch();<br />
<br />
// show the form<br />
renderForm(<?php print $bindParamStr;?>, NULL, $id);<br />
<br />
$stmt-&gt;close();<br />
}<br />
// show an error if the query has an error<br />
else<br />
{<br />
echo &quot;Error: could not prepare SQL statement&quot;;<br />
}<br />
}<br />
// if the 'id' value is not valid, redirect the user back to the view.php page<br />
else<br />
{<br />
header(&quot;Location: <?php print $ListScriptName;?>&quot;);<br />
}<br />
}<br />
}<br />
<br />
<br />
<br />
/*<br />
<br />
NEW RECORD<br />
<br />
*/<br />
// if the 'id' variable is not set in the URL, we must be creating a new record<br />
else<br />
{<br />
// if the form's submit button is clicked, we need to process the form<br />
if (isset($_GET['submit']))<br />
{<br />
// get the form data<br />
<?php print $fmPostToEdit;?>
<br />
// check that firstname and lastname are both not empty<br />
if (<?php print $chkStrNotEmpty;?>)<br />
{<br />
// if they are empty, show an error message and display the form<br />
$error = 'ERROR: Please fill in all required fields!';<br />
renderForm(<?php print $bindParamStr;?>, $error);<br />
}<br />
else<br />
{<br />
// insert the new record into the database<br />
if ($stmt = $mysqli-&gt;prepare(&quot;INSERT INTO `<?php print $TableName;?>` (<?php print $SelectString;?>) 
VALUES (<?php print $bindParamStrB;?>)&quot;))<br />
{<br />
$stmt-&gt;bind_param(&quot;<?php print $datatypestring;?>&quot;, <?php print $bindParamStr;?>
);<br />
$stmt-&gt;execute();<br />
$stmt-&gt;close();<br />
}<br />
// show an error if the query has an error<br />
else<br />
{<br />
echo &quot;ERROR: Could not prepare SQL statement.&quot;;<br />
}<br />
<br />
// redirec the user<br />
header(&quot;Location: <?php print $ListScriptName;?>&quot;);<br />
}<br />
<br />
}<br />
// if the form hasn't been submitted yet, show the form<br />
else<br />
{<br />
renderForm();<br />
}<br />
}<br />
<br />
// close the mysqli connection<br />
$mysqli-&gt;close();<br />
?&gt;</p>
<hr />
<p><br />
</p>
<h2>Delete Record</h2>
<b><i>Save as <?php print $ListScriptDelete;?></i></b>

<p>&lt;?php<br />
include('logincheck.php');<br />
// confirm that the 'id' variable has been set<br />
if (isset($_GET['id']) &amp;&amp; is_numeric($_GET['id']) &amp;&amp; empty($_GET['d']))<br />
{<br />
// get the 'id' variable from the URL<br />
$id = $_GET['id'];<br />
<br />
print &quot;&lt;a href='<?php print $ListScriptDelete;?>?id=$id&amp;d=1'&gt;Are you sure you want to 
delete record number $id from table <?php print $TableName;?>? This can not be 
undone!&lt;/a&gt;&quot;;<br />
print &quot;&lt;br /&gt;&lt;a href='<?php print $ListScriptName;?>'&gt;No, I am not sure! Take me 
back!&lt;/a&gt;&quot;;<br />
exit();<br />
}<br />
<br />
// confirm that the 'id' variable has been set<br />
if (isset($_GET['id']) &amp;&amp; is_numeric($_GET['id']) &amp;&amp; !empty($_GET['d']) &amp;&amp; 
is_numeric($_GET['d']))<br />
{<br />
// connect to the database<br />
include('connect-db.php');<br />
<br />
// get the 'id' variable from the URL<br />
$id = $_GET['id'];<br />
<br />
// delete record from database<br />
if ($stmt = $mysqli-&gt;prepare(&quot;DELETE FROM `<?php print $TableName;?>` WHERE `<?php print $PrimaryKey;?>` 
= ? LIMIT 1&quot;))<br />
{<br />
$stmt-&gt;bind_param(&quot;i&quot;,$id);<br />
$stmt-&gt;execute();<br />
$stmt-&gt;close();<br />
}<br />
else<br />
{<br />
echo &quot;ERROR: could not prepare SQL statement.&quot;;<br />
}<br />
$mysqli-&gt;close();<br />
<br />
// redirect user after delete is successful<br />
header(&quot;Location: <?php print $ListScriptName;?>&quot;);<br />
}<br />
else<br />
// if the 'id' variable isn't set, redirect the user<br />
{<br />
//if (!isset($_GET['id']) &amp;&amp; !is_numeric($_GET['id']))<br />
<br />
header(&quot;Location: <?php print $ListScriptName;?>&quot;);<br />
<br />
}<br />
<br />
?&gt;</p>
<hr />
<h2>View Single Record</h2>
<p><b><i>Save as <?php print $ListScriptView;?></i></b></p>
<div class="example-contents">
	<div class="phpcode">
		&lt;?php<br />
		include('logincheck.php');<br />
		// confirm that the 'id' variable has been set<br />
		if (isset($_GET['id']) &amp;&amp; is_numeric($_GET['id']))<br />
		{<br />
		// get the 'id' variable from the URL<br />
		$id = $_GET['id'];<br />
		<br />
		// connect to the database<br />
		include('connect-db.php');<br />
		<br />
		/* check connection */<br />
		if (mysqli_connect_errno()) {<br />
		printf(&quot;Connect failed: %s\n&quot;, mysqli_connect_error());<br />
		exit();<br />
		}<br />
		<br />
		if ($mysqli-&gt;connect_errno) {<br />
		echo &quot;Failed to connect to MySQL: (&quot; . $mysqli-&gt;connect_errno . &quot;) &quot; . 
		$mysqli-&gt;connect_error;<br />
		exit();<br />
		}<br />
		<br />
		/* create a prepared statement */<br />
		$stmt = $mysqli-&gt;stmt_init();<br />
		if ($stmt-&gt;prepare(&quot;SELECT <?php print $SelectString;?> FROM `<?php print $TableName;?>` 
		WHERE `<?php print $PrimaryKey;?>`=$id LIMIT 0,1&quot;)) {<br />
		<br />
		if (!$stmt-&gt;execute()) {<br />
		echo &quot;Execute failed: (&quot; . $stmt-&gt;errno . &quot;) &quot; . $stmt-&gt;error;<br />
		}<br />
		<br />
		/* execute query */<br />
		$stmt-&gt;execute();<br />
		<br />
		/* bind result variables */<br />
		$stmt-&gt;bind_result(<?php print $bindParamStr;?>);<br />
		<br />
		/* fetch value */<br />
		$stmt-&gt;fetch();<br />
		<br />
		<br />echo '&lt;a href=&quot;<?php print $ListScriptEdit;?>?id=' . $id . 
		'&quot;&gt;Edit&lt;/a&gt;&nbsp; &lt;a href=&quot;<?php print $ListScriptDelete;?>?id=' . $id . 
		'&quot;&gt;Delete&lt;/a&gt;&lt;br /&gt;';<br />
<br />
		print &quot;&lt;table border='1' cellpadding='1'&gt;&quot;;<br />

<?php print $viewPageResults;?>
		<br />
		print &quot;&lt;/table&gt;&quot;; <br />
		<br />
		/* close statement */<br />
		$stmt-&gt;close();<br />
		<br />
		/* close connection */<br />
		$mysqli-&gt;close();<br />
		}<br />
		} else {<br />
		// if the 'id' variable isn't set, redirect the user<br />
		header(&quot;Location: <?php print $ListScriptName;?>&quot;);<br />
		}<br />
		?&gt; <br></div></div><hr>
		<div class="example-contents">
	<div class="phpcode">
<br>
		<h2>Security Files</h2>
		<strong>Save as 
		login.php and change the password to your own.</strong><br><br>&lt;?php<br>session_start();<br>// store session data<br>
		$passstr = &quot;passwordhere&quot;; <br>$goto = &quot;<?php echo $ListScriptName;?>&quot;;<br>
		<br>if ($_GET['Password']==$passstr){<br><br>
		$_SESSION['loggedin']=&quot;loggedin&quot;;<br><br>header('Location: '.$goto);<br>
		}<br>else {<br><br>if (isset($_GET['Password'])){<br><br>echo
		(&quot;Incorrect Password!&lt;br&gt;&quot;);<br>echo $_GET['Password'];<br>}<br>?&gt;<br>
		<br>&lt;form action=&quot;login.php&quot; method=&quot;post&quot;&gt;<br>&lt;input name=&quot;Password&quot; 
		type=&quot;password&quot;&gt;&lt;input name=&quot;submit&quot; type=&quot;submit&quot; 
		value=&quot;submit&quot;&gt;&lt;/form&gt;<br><br><br><br>&lt;?php<br><br><br><br>}<br><br>?&gt;<br>
		<br><br><strong>Save as logincheck.php</strong><br>&lt;?php<br>session_start();<br>// store 
		session data<br><br>if (!$_SESSION['loggedin']==&quot;loggedin&quot;){<br>
		header('Location: login.php');<br>}<br>?&gt;<br><br><strong>Save as logout.php</strong><br>
		&lt;?php<br>session_start();<br>unset($_SESSION['loggedin']);<br>
		header('Location: login.php');<br>?&gt;<br> </div>
</div>
<hr>
<p>Most of the MySQLi code for list/add/edit/delete comes from
<a href="http://www.killersites.com/community/index.php?/topic/3064-basic-php-system-view-edit-add-delete-records-with-mysqli/" target="_blank">
http://www.killersites.com/community/index.php?/topic/3064-basic-php-system-view-edit-add-delete-records-with-mysqli/</a> 
and was modified by Lil Peck (RawPHP.com) - LilPeck@gmail.com. Other parts of 
this php code generator comes from various sites I found with google, and 
especially from PHP.net.</p>
&nbsp;
</body>

</html>
