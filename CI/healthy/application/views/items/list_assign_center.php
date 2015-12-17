<table class='' style='text-align:center;'>
	<thead>
		<tr style='text-align:center'>
			<th class="" style='text-align:center;width:5%;'>No</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Center Code</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Center Name</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Address</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Web Site</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>DefaultWorkout</th>
			<th class="" onclick="" style='text-align:center;'>Logo</th>
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
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['idx'] ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->CenterCode ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->CenterNm ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->Adress ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->WebSite ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->DefaultWorkout ?></td>
			<td>
				<!-- <div style="url(<?php echo $baseDir ?>/www/img/nophoto.png)"></div> -->
				<div class="oCenterImage" style="background-image: url(<?php echo $url ?>)"></div>
			</td>
			<td>
				<button class="normal" onclick="onAssignCenter(<?php echo $res['data']->Seq ?>)">Assign Center</button>
                <button class="normalbig" onclick="onAssignDefaultCenter(<?php echo $res['data']->Seq ?>)">Assign default workout</button>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>