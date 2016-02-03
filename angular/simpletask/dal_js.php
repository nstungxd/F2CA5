<?php
require("config.php");
require("function.php");
if (isset($_POST['type'])) {
    $dt = date("Y-m-d", mktime(0, 0, 0, $_POST['month'], $_POST['date'], $_POST['year']));

    $rs = "insert into roster(id_doctor,dt_roster) values('" . $_POST['type'] . "','" . $dt . "')";
    $output = mysql_query($rs);
    if (!$output) {
        //not sucess
        echo json_encode('1');
    }
    //sucess
    updateStatus($_POST['practice']);
    echo json_encode('0');

}
if (isset($_POST['typer'])) {
    $dt = date("Y-m-d", mktime(0, 0, 0, $_POST['month'], $_POST['date'], $_POST['year']));
    $rs = "delete from roster where id_doctor='" . $_POST['typer'] . "' and dt_roster='" . $dt . "'";
    $output = mysql_query($rs);
    if (!$output) {
        //not sucess

        echo json_encode('1');
    }
    //sucess
    updateStatus($_POST['practice']);
    echo json_encode('0');


}
if (isset($_POST['typeC'])) {
    $currentID = $_POST['currentid'];
    $query = "select * from status where id_practice = '" . $currentID . "' limit 1";
    $rs1 = mysql_query($query);
    while ($r1 = mysql_fetch_array($rs1)) {
        $currentID = $r1['modified'];
    }
    if ($currentID > $_POST['typeC'])
        echo json_encode('0');
    else echo json_encode('1');
}
if (isset($_POST['reorder'])) {
    $rs = 0;
    $arr = explode(",", $_POST['reorder']);
    $i = 0;
    foreach ($arr as $val) {
        $i++;
        $query = "update slide set position='" . $i . "' where id='" . ($val) . "'";
        $rs1 = mysql_query($query);
        if (!$rs1) {
            $rs = 1;
        }

    }
    echo json_encode($rs);

}
if (isset($_POST['typeChange'])) {
    $rs = 0;
    if ($_POST['typeChange'] == 'display') {
        if ($_POST['checked'] == 'true') {
            $query1 = "select * from doctor where id_practice='" . $_POST['practiceid'] . "' and Isdisplay=1";
            $rs1 = mysql_query($query1);
            $rowCount = mysql_num_rows($rs1);
            if ($rowCount < 12) {
                $query = "update doctor set Isdisplay=1 where id='" . $_POST['id'] . "'";
                $rs2 = mysql_query($query);
                updateStatus($_POST['practiceid']);
                $rs = 1;
            }
            else {
                $rs = 0;
            }
        }
        else
        {
            $query3 = "update doctor set Isdisplay=0 where id='" . $_POST['id'] . "'";
            $rs3 = mysql_query($query3);
            updateStatus($_POST['practiceid']);
            $rs = 1;
        }
    }
    else if ($_POST['typeChange'] == 'allied') {
        if ($_POST['checked'] == 'true') {
            $query1 = "select * from doctor where id_practice='" . $_POST['practiceid'] . "' and IdAllied=1";
            $rs1 = mysql_query($query1);
            $rowCount = mysql_num_rows($rs1);
            if ($rowCount < 4) {
                $query = "update doctor set IdAllied=1 where id='" . $_POST['id'] . "'";
                $rs2 = mysql_query($query);

                updateStatus($_POST['practiceid']);

                $rs = 1;
            }
            else {
                $rs = 0;
            }
        }
        else
        {
            $query3 = "update doctor set IdAllied=0 where id='" . $_POST['id'] . "'";
            $rs3 = mysql_query($query3);

            updateStatus($_POST['practiceid']);


            $rs = 1;
        }
    }
    echo json_encode($rs);
}


 
