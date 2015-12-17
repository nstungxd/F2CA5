<table class='' style='text-align:center;'>
    <thead>
    <tr style='text-align:center'>
        <th class="" style='text-align:center;width:10%;'>No</th>
        <th class="" onclick="" style='text-align:center;width:25%;'>Center</th>
        <th class="" onclick="" style='text-align:center;width:25%;'>Name</th>
        <th class="" onclick="" style='text-align:center;width:25%;'>Add by</th>
        <th class="" onclick="" style='text-align:center;width:25%;'>Datetime Modified</th>
        <th class="" style='text-align:center;width:20%;'></th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($results) == 0): ?>
    <tr>
        <td colspan="5">No Data</td>
    </tr>
        <?php endif; ?>
    <?php foreach ($results as $res): ?>
    <tr style='text-align:center'>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['idx'] ?></td>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->NameCenter ?></td>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->UserNM ?></td>
        <?php if($res['data']->CreateBy == -1 ){ ?>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);">ADMIN</td>
        <?php } else { ?>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->NameCreateby ?></td>
        <?php } ?>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->DateModified ?></td>
        <td>
            <button class="normal" onclick="onDelete(<?php echo $res['data']->Seq ?>)">Delete</button>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>