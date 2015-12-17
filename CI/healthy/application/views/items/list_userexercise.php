<table class='' style='text-align:center;'>
	<thead>
		<tr style='text-align:center'>
			<th class="" style='text-align:center;width:5%;'>No</th>
			<th class="" onclick="" style='text-align:center;'>Center</th>
			<th class="" onclick="" style='text-align:center;'>User</th>
			<th class="" onclick="" style='text-align:center;'>Exercise</th>
			<th class="" onclick="" style='text-align:center;'>Trainer</th>
			<th class="" onclick="" style='text-align:center;'>Pro1</th>
			<th class="" onclick="" style='text-align:center;'>Pro2</th>
			<th class="" onclick="" style='text-align:center;'>Pro3</th>
			<th class="" style='text-align:center;width:15%;'></th>
		</tr>
	</thead>
	<tbody>
<?php if (count($results) == 0): ?>
		<tr>
			<td colspan="9">No Data</td>
		</tr>
<?php endif; ?>	
<?php
	foreach ($results as $res):
?>
		<tr style='text-align:center'>
			<td><?php echo $res['idx'] ?></td>
			<td><?php echo $res['data']->CenterNm ?></td>
			<td><?php echo $res['data']->UserNm ?></td>
			<td><?php echo $res['data']->ExName ?></td>
			<td><?php echo $res['data']->Trainer ?></td>
			<td><?php echo $res['data']->Pro1.v2k_ex_pro1($res['data']->ExType); ?></td>
			<td><?php echo $res['data']->Pro2.v2k_ex_pro2($res['data']->ExType)?></td>
			<td><?php echo $res['data']->Pro3.v2k_ex_pro3($res['data']->ExType) ?></td>
			<td>
				<button class="normal" onclick="onModify(<?php echo $res['data']->Seq ?>)">Modify</button>
				<button class="normal" onclick="onDelete(<?php echo $res['data']->Seq ?>)">Delete</button>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>