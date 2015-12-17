<?php
$curday = date("j");
$curmnth = date("n");
$curyear = date("Y");
$date = mktime(12, 0, 0, $mnth, 1, $yrs);
$daysInMonth = date("t", $date);
$offset = date("w", $date);
$rows = 1;


if($mnth == 12)
{
    $nextM=1;
    $nextY=$yrs+1;

    $pevM = $mnth-1;
    $pevY = $yrs;
}
if($mnth == 1)
{
    $nextM = $mnth+1;
    $nextY = $yrs;

    $pevM=12;
    $pevY=$yrs-1;
}
else
{
    $nextM = $mnth+1;
    $nextY = $yrs;

    $pevM = $mnth-1;
    $pevY = $yrs;
}
?>
<table class="table table-bordered" id="data">
    <tbody>
    <tr>
        <td class="click" onclick="javascript:doSearch(<?php echo $pevM ?>,<?php echo $pevY ?>);">
            <?php echo date('M', mktime(0, 0, 0, $pevM+1, 0, $pevY)) ?>
        </td>
        <th align="center" colspan="5"><?php echo date("F Y", $date) ?></th>
        <td class="click" align="right" onclick="javascript:doSearch(<?php echo $nextM ?>,<?php echo $nextY ?>);">
            <?php echo date('M', mktime(0, 0, 0, $nextM+1, 0, $nextY)) ?>
        </td>
    </tr>
    <tr>
        <th>Sunday</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
        <th>Saturday</th>
    </tr>
    <tr>
    <?php
        $j=0;
        for ($i = 1; $i <= $offset; $i++) {
            echo "<td></td>";
            $j++;
        }
        for ($day = 1; $day <= $daysInMonth; $day++)
        {

            if (($day + $offset - 1) % 7 == 0 && $day != 1) {
                echo "</tr>\n\t<tr>";
                $j=0;
                $rows++;
            }
            $td = "<td class='info'";
	        foreach ($results as $res):
                if($res->WorkoutDate == date('Y-m-d', mktime(0, 0, 0, $mnth, $day, $yrs)))
                {
                    $td ="<td class='choose'";
                    $td .= " title='<p> Group : ".$res->BName."</p>";
                    $td .= "<p> Workout : ".$res->WorkoutName."</p>";
                    $td .= "<p> DateTime Modified : ".$res->DateModified."</p>'";

                }
            endforeach;
            $td.="onclick='changeColor(".($rows+6).",".$j.",".$day.",".$mnth.",".$yrs.")'>";
            if (($curday == $day) && ($curmnth == $mnth))
                echo $td."<b>" . $day . "</b></td>";
            else
                echo $td.$day."</td>";
            $j++;
        }

        while (($day + $offset) <= $rows * 7) {
            echo "<td></td>";
            $j++;
            $day++;
        }
    ?>
    </tr>
    </tbody>
</table>
    <script>
        $(function() {
            $(".info").tooltip({
                position: { my: "center top", at: "center center" },
                content : function(event, ui) { return $(this).attr("title");  }
             });
            $( ".choose" ).tooltip({
                position: { my: "center top", at: "center center" },
                content : function(event, ui) { return $(this).attr("title");  }
            });
        });
    </script>