<?php
session_start();
unset($_SESSION['acc_type']);
unset($_SESSION['id']);
header('Location: index.php');
?>

