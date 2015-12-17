<?php
include('logincheck.php');
// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// get the 'id' variable from the URL
    $id = $_GET['id'];

// connect to the database
    include('connect-db.php');

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit();
    }

    /* create a prepared statement */
    $stmt = $mysqli->stmt_init();
    if ($stmt->prepare("SELECT `id` FROM `tbl_user` WHERE `id`=$id LIMIT 0,1")) {

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        /* execute query */
        $stmt->execute();

        /* bind result variables */
        $stmt->bind_result($id);

        /* fetch value */
        $stmt->fetch();


        echo '<a href="tbl_userrec.php?id=' . $id . '">Edit</a>  <a href="tbl_userdelete.php?id=' . $id . '">Delete</a><br />';

        print "<table border='1' cellpadding='1'>";
        print "<tr><td>id</td><td>".$id."</td></tr>";

        print "</table>";

        /* close statement */
        $stmt->close();

        /* close connection */
        $mysqli->close();
    }
} else {
// if the 'id' variable isn't set, redirect the user
    header("Location: tbl_userlist.php");
}
?> 