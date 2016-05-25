<?php
    require("config.php");
    function login_adminpanel($email,$pass)
    {
        $acc_type='';
        $query = "select id, email,password,acc_type from user where email='".$email."' and password = '".$pass."' limit 1";
        $rs1 = mysql_query($query);
        $rowCount = mysql_num_rows($rs1);
        if($rowCount > 0)
        {
            $r1 = mysql_fetch_array($rs1);
            return $r1;
        }
        else return '';
        //return $acc_type;
    }
    function getAllPractice()
    {
        $query = "select * from user where acc_type=2";
        $rs1 = mysql_query($query);
        return $rs1;
    }
    function insertPractice($email,$password,$name,$address,$title,$image_logo,$template,$footer)
    {
        $rs = "insert into user(email,password,name,address,title,image_logo,acc_type,footer,template_id) values('".$email."','".md5($password)."','".$name."','".$address."','".$title."','".$image_logo."',2,'".$footer."','".$template."')";
        $output = mysql_query($rs);
        if (!$output) {
            //not sucess
            return '1';
        }
        //sucess
        return '0';
    }
function insertDoctor($id_prac,$name,$occu,$title,$image_logo)
    {
        $rs = "insert into doctor(id_practice,image_logo,title,name,occupation) values('".$id_prac."','".$image_logo."','".$title."','".$name."','".$occu."')";
        $output = mysql_query($rs);
        if (!$output) {
            //not sucess
            return '1';
        }
        //sucess
        updateStatus($id_prac);
        return '0';
    }
function updateDoctor($id_prac,$id,$name,$occu,$title,$image_logo)
{
    $query_img='';
    if($image_logo != '') $query_img = ", image_logo='".$image_logo."'";
    $rs = "update doctor set title='".$title."', name ='".$name."', occupation='".$occu."'".$query_img." where id='".$id."'";
    $output = mysql_query($rs);
    if (!$output) {
        return '1';
    }
    updateStatus($id_prac);
    return '0';
}
    function getPracticeById($id)
    {
        $query = "select * from user where id='".$id."' limit 1";
        $rs1 = mysql_query($query);
        return $rs1;
    }
function getStatus($id_practice)
{
    $query = "select * from status where id_practice = '".$id_practice."' limit 1";
    $rs1 = mysql_query($query);
    return $rs1;
}
function insertFirstStatus($id_practice)
{
    $dateNow = date('Y-m-d H:i:s');
    $query = "insert into status(id_practice,modified) values ('".$id_practice."','".$dateNow."')";
    $rs1 = mysql_query($query);
    return $rs1;
}
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
function getDoctorById($id)
{
    $query = "select * from doctor where id='".$id."' limit 1";
    $rs1 = mysql_query($query);
    return $rs1;
}
function getImageSlideBy($id)
{
    $query = "select * from slide where id='".$id."' limit 1";
    $rs1 = mysql_query($query);
    return $rs1;
}
function getRosterByDoctor($id,$month,$years)
{
    $sD = date("Y-m-d",mktime(0,0,0,$month,1,$years));
    $eD = date("Y-m-d",mktime(0,0,0,$month+1,1,$years));


    $query = "select * from roster where id_doctor='".$id."'and dt_roster between '".$sD."' AND '".$eD."'";
    $rs1 = mysql_query($query);
    return $rs1;
}

function updatePractice($id,$email,$password,$name,$address,$title,$image_logo,$template,$footer)
    {
        $query_img='';
        $query_pass='';
        if($image_logo != '') $query_img = ", image_logo='".$image_logo."'";
        if($password != '') $query_pass = ", password='".md5($password)."'";
        $rs = "update user set email='".$email."', name ='".$name."', address='".$address."',footer='".$footer."',template_id='".$template."', title='".$title."'".$query_img.$query_pass." where id='".$id."'";
        $output = mysql_query($rs);
        if (!$output) {
            return '1';
        }
        updateStatus($id);
        return '0';
    }
function updatePracticeFooter($id,$footer,$image_logo)
    {
        $query_img='';
        if($image_logo != '') $query_img = ", image_logo='".$image_logo."'";
        $rs = "update user set footer='".$footer."'".$query_img." where id='".$id."'";
        $output = mysql_query($rs);
        if (!$output) {
            return '1';
        }
        updateStatus($id);
        return '0';
    }
function getRoster($id_practice)
{
    $date1 = date('Y-m-d');
                    $date2 = date('Y-m-d', strtotime(' +1 day'));
                    $date3 = date('Y-m-d', strtotime(' +2 day'));
                    $date4 = date('Y-m-d', strtotime(' +3 day'));
                    $date5=  date('Y-m-d', strtotime(' +4 day'));
    $query = "SELECT
    r.id_doctor,
    d.title,
    d.name,
    d.occupation,
    d.image_logo,
    SUM(r.dt_roster= '".$date1."')AS now1,
    SUM(r.dt_roster= '".$date2."')AS now2,
    SUM(r.dt_roster= '".$date3."')AS now3,
    SUM(r.dt_roster= '".$date4."')AS now4,
    SUM(r.dt_roster= '".$date5."')AS now5
    FROM roster r
    left join doctor d on r.id_doctor = d.id
    where d.id_practice='".$id_practice."'
    GROUP BY r.id_doctor;";
    $rs1 = mysql_query($query);
    return $rs1;
}

function getDoctorRoster($id_practice,$type)
{
    $date1 = date('Y-m-d');
    if($type == 'allied')
    {
        $query = "SELECT A.id,A.title,A.name,A.occupation,A.image_logo, (SELECT COUNT(*) FROM roster B WHERE B.id_doctor = A.id and B.dt_roster= '".$date1."') AS now1 FROM doctor A where A.id_practice='".$id_practice."' and A.IdAllied=1";
    }
    else
    {
        $query = "SELECT A.id,A.title,A.name,A.occupation,A.image_logo, (SELECT COUNT(*) FROM roster B WHERE B.id_doctor = A.id and B.dt_roster= '".$date1."') AS now1 FROM doctor A where A.id_practice='".$id_practice."' and A.Isdisplay=1";

    }
    $rs1 = mysql_query($query);
    return $rs1;

}
function getDoctorByPractice($id_practice)
{
    $date1 = date('Y-m-d');
    $query = "SELECT a.*,(SELECT COUNT(*) FROM roster b WHERE b.dt_roster='".$date1."' and b.id_doctor=a.id)  AS now1 FROM `doctor` a where a.id_practice='".$id_practice."'";
    //$query = "select * from doctor where id_practice='".$id_practice."'";
        $rs1 = mysql_query($query);
        return $rs1;
}
function getSlideByPractice($id_practice)
{
    $query = "select * from slide where id_practice='".$id_practice."' order by position";
    $rs1 = mysql_query($query);
    return $rs1;
}
function updateImageSlide($id_practice,$id,$image_logo,$des)
    {
        $query_img='';
        if($image_logo != '') $query_img = ", image_logo='".$image_logo."'";
        $date1 = date('Y-m-d H:i:s');
        $rs = "update slide set modified = '".$date1."', description = '".$des."'".$query_img." where id='".$id."' ";
        $output = mysql_query($rs);
        if (!$output) {
            return '1';
        }
        updateStatus($id_practice);
        return '0';
    }
function insertImageSlide($id_practice,$image_logo,$des)
    {
        $date1 = date('Y-m-d H:i:s');
        $rs = "insert into slide(id_practice,image_logo,modified,description) values('".$id_practice."','".$image_logo."','".$date1."','".$des."')";
        $output = mysql_query($rs);
        if (!$output) {
            //not sucess
            return '1';
        }
        updateStatus($id_practice);
        //sucess
        return '0';
    }
function deleteImageSlide($id_practice,$id)
    {
        $query = "delete from slide where id='".$id."'";
        $output = mysql_query($query);
        if (!$output) {
            //not sucess
            return '1';
        }
        //sucess
        updateStatus($id_practice);
        return '0';
    }
?>
