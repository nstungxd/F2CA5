<?php
include('logincheck.php');
// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id']) && empty($_GET['d']))
{
// get the 'id' variable from the URL
    $id = $_GET['id'];

    print "<a href='tbl_userdelete.php?id=$id&d=1'>Are you sure you want to delete record number $id from table tbl_user? This can not be undone!</a>";
    print "<br /><a href='tbl_userlist.php'>No, I am not sure! Take me back!</a>";
    exit();
}

// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['d']) && is_numeric($_GET['d']))
{
// connect to the database
    include('connect-db.php');

// get the 'id' variable from the URL
    $id = $_GET['id'];

// delete record from database
    if ($stmt = $mysqli->prepare("DELETE FROM `tbl_user` WHERE `id` = ? LIMIT 1"))
    {
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
    else
    {
        echo "ERROR: could not prepare SQL statement.";
    }
    $mysqli->close();

// redirect user after delete is successful
    header("Location: tbl_userlist.php");
}
else
// if the 'id' variable isn't set, redirect the user
{
//if (!isset($_GET['id']) && !is_numeric($_GET['id']))

    header("Location: tbl_userlist.php");

}

?>