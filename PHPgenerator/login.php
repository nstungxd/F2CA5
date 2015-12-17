<?php
$passstr = "";
session_start();
// store session data

if ($_POST['Password']==$passstr){

$_SESSION['loggedin']="loggedin";

header('Location: showtables.php');
}
else {

if (isset($_POST['Password'])){

echo ("Incorrect Password!<br>");
}
?>

<form action="login.php" method="post">
	<input name="Password" type="password"><input name="submit" type="submit" value="submit"></form>



<?php



}

?>

