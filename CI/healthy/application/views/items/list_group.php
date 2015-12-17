<table class='' style='text-align:center;'>
    <thead>
    <tr style='text-align:center'>
        <th class="" style='text-align:center;width:5%;'>No</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Name</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Center</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Trainer</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Create By</th>
        <th class="" onclick="" style='text-align:center;width:10%;'>Datetime Modified</th>
        <th class="" style='text-align:center;width:20%;'></th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($results) == 0): ?>
    <tr>
        <td colspan="6">No Data</td>
    </tr>
        <?php endif; ?>
    <?php foreach ($results as $res): ?>
    <tr style='text-align:center'>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['idx'] ?></td>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->Name ?></td>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->NameCenter ?></td>
        <?php if($res['data']->TrainerSeq == -1 ){ ?>
            <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);">ADMIN</td>
        <?php } else { ?>
            <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->Trainer ?></td>
        <?php } ?>
        <?php if($res['data']->CreateBy == -1 ){ ?>
            <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);">ADMIN</td>
        <?php } else { ?>
            <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->NameCreateby ?></td>
        <?php } ?>
        <td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->DateModified ?></td>
        <td>
            <button class="normal" onclick="onModify(<?php echo $res['data']->Seq ?>)">Modify</button>
            <button class="normal" onclick="onDelete(<?php echo $res['data']->Seq ?>)">Delete</button>
            <button class="normal" onclick="onDetail(<?php echo $res['data']->Seq ?>)">View Detail</button>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>