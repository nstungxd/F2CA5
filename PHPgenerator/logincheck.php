<?php
session_start();
// store session data

if (!$_SESSION['loggedin']=="loggedin"){


header('Location: login.php');

}

?>
