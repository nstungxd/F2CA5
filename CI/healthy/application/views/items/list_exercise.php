<table class='' style='text-align:center;'>
	<thead>
		<tr style='text-align:center'>
			<th class="" style='text-align:center;width:5%;'>No</th>
			<th class="" onclick="" style='text-align:center;'>Exercise Name</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Type</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>KCal</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Exercise Target</th>
            <th class="" onclick="" style='text-align:center;width:20%;'>Logo</th>
			<th class="" style='text-align:center;width:15%;'></th>
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
    $url = $baseDir.(isset($res['data']->Logo)?$res['data']->Logo:"/www/img/nophoto.png");
?>
		<tr style='text-align:center'>
			<td><?php echo $res['idx'] ?></td>
			<td><?php echo $res['data']->Name ?></td>
			<td><?php echo $res['data']->CategoryName ?></td>
			<td><?php echo $res['data']->KCal ?></td>
			<td><?php echo v2k_excode($res['data']->ExName) ?></td>
            <td>
				<!-- <div style="url(<?php echo $baseDir ?>/www/img/nophoto.png)"></div> -->
				<div class="oCenterImage" style="background-image: url(<?php echo $url ?>)"></div>
			</td>
			<td>
				<button class="normal" onclick="onModify(<?php echo $res['data']->Seq ?>)">Modify</button>
				<button class="normal" onclick="onDelete(<?php echo $res['data']->Seq ?>)">Delete</button>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>