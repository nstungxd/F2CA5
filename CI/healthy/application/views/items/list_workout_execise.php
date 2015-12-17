<table class='' style='text-align:center;'>
    <thead>
    <tr style='text-align:center'>
        <th class="" style='text-align:center;width:10%;'>No</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Exercise Name</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Input type1</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Value 1</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Input type2</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Value 2</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Input type3</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Value 3</th>
        <th class="" style='text-align:center;width:10%;'></th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($results) == 0): ?>
    <tr>
        <td colspan="9">No Data</td>
    </tr>
        <?php endif; ?>
    <?php foreach ($results as $res): ?>
    <tr style='text-align:center'>
        <td class="click"><?php echo $res['idx'] ?>
        <input type="hidden" class="imgid" name="to[]" value="<?php echo $res['data']->Seq ?>">
            
        </td>
        <td class="click"><?php echo $res['data']->ExerciseName ?></td>
        <td class="click"><?php echo $res['data']->InputName1 ?></td>
        <td class="click"><?php echo $res['data']->Value1 ?></td>
        <td class="click"><?php echo $res['data']->InputName2 ?></td>
        <td class="click"><?php echo $res['data']->Value2 ?></td>
        <td class="click"><?php echo $res['data']->InputName3 ?></td>
        <td class="click"><?php echo $res['data']->Value3 ?></td>
        <td>
             <?php if($check_owner == 'true'){?>
            <button class="normal" onclick="onDelete(<?php echo $res['data']->Seq ?>)">Delete</button>
            <button class="normal up">Up</button>
            <button class="normal down">Down</button>
            <?php }?>
            
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <script>
        $(document).ready(function() {
            $(".up,.down").click(function(e) {
                var row = $(this).parents("tr:first");
                if ($(this).is(".up")) {
                    row.insertBefore(row.prev());
                } else {
                    row.insertAfter(row.next());
                }
                var lst_to = [];
                $("input:hidden.imgid").each(function() {
                    lst_to.push($(this).val());
                });
                var str_query = "reorder=" + lst_to.join();
                $.post("<?php echo $baseDir; ?>/admin/cworkout/reorder", {
                        reorder : lst_to.join()
                    }, function(data) {
                    });
            });
        });


  </script>