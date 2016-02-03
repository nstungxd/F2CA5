<?php
function updateStatus($id_practice)
{
        $query = "select id_practice,modified from status where id_practice='".$id_practice."' limit 1";
        $rs1 = mysql_query($query);
        $rowCount = mysql_num_rows($rs1);
        if($rowCount > 0)
        {
            $dateNow = date('Y-m-d H:i:s');
            $query = "update status set modified='".$dateNow."' where id_practice = '".$id_practice."'";
            $rs1 = mysql_query($query);
        }
    else{
        $dateNow = date('Y-m-d H:i:s');
        $query = "insert into status(id_practice,modified) values ('".$id_practice."','".$dateNow."')";
        $rs1 = mysql_query($query);
        return $rs1;
    }

    return $rs1;
}
