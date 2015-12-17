<?php
session_start();
// store session data
$passstr = "";
$goto = "tbl_userlist.php";

if ($_POST['Password']==$passstr){

    $_SESSION['loggedin']="loggedin";

    header('Location: '.$goto);
}
else {

    if (isset($_POST['Password'])){

        echo ("Incorrect Password!<br>");
        echo $_POST['Password'];
    }
    ?>

<form action="login.php" method="post">
    <input name="Password" type="password"><input name="submit" type="submit" value="submit"></form>



<?php



}

?>