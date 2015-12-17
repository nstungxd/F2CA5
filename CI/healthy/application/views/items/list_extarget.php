<table class='' style='text-align:center;'>
	<thead>
		<tr style='text-align:center'>
			<th class="" onclick="" style='text-align:center;width: 10%;'>Target Code</th>
			<th class="" onclick="" style='text-align:center;'>Target Name</th>
			<th class="" style='text-align:center;width:25%;'></th>
		</tr>
	</thead>
	<tbody>
<?php if (count($results) == 0): ?>
		<tr>
			<td colspan="4">No Data</td>
		</tr>
<?php endif; ?>	
<?php
	foreach ($results as $res):
?>
		<tr style='text-align:center'>
			<td><?php echo $res['data']->Code ?></td>
			<td><?php echo $res['data']->Name ?></td>
			<td>
				<button class="normal" onclick="onModify(<?php echo $res['data']->Seq ?>)">Modify</button>
				<button class="normal" onclick="onDelete(<?php echo $res['data']->Seq ?>)">Delete</button>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>