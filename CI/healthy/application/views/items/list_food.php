<table class='' style='text-align:center;'>
	<thead>
		<tr style='text-align:center'>
			<th class="" style='text-align:center;width:5%;'>No</th>
			<th class="" onclick="" style='text-align:center;'>Food Name</th>
			<th class="" onclick="" style='text-align:center;width: 10%;'>KCal</th>
			<th class="" style='text-align:center;width:25%;'></th>
		</tr>
	</thead>
	<tbody>
<?php if (count($results) == 0): ?>
		<tr>
			<td colspan="7">No Data</td>
		</tr>
<?php endif; ?>	
<?php
	foreach ($results as $res):
?>
		<tr style='text-align:center'>
			<td><?php echo $res['idx'] ?></td>
			<td><?php echo $res['data']->FoodName ?></td>
			<td><?php echo $res['data']->KCal ?></td>
			<td>
				<button class="normal" onclick="onModify(<?php echo $res['data']->Seq ?>)">Modify</button>
				<button class="normal" onclick="onDelete(<?php echo $res['data']->Seq ?>)">Delete</button>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>