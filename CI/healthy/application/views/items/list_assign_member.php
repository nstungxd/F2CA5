<table class='' style='text-align:center;'>
	<thead>
		<tr style='text-align:center'>
			<th class="" style='text-align:center;width:5%;'>No</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Center Name</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Name</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Member ID</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Gender</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Phone</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Email</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Height</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Default Workout</th>
			<th class="" style='text-align:center;width:15%;'></th>
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
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->CenterNm ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->UserNm ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->UserID ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo v2k_gender($res['data']->Sex) ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo ($res['data']->Phone) ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo ($res['data']->Email) ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo ($res['data']->Height) ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo ($res['data']->DefaultWorkout) ?></td>
			<td>
				<button class="normal" onclick="onAssignMember(<?php echo $res['data']->Seq ?>)">Assign Member</button>
				<button class="normalbig" onclick="onAssignDefault(<?php echo $res['data']->Seq ?>)">Assign Default Workout</button>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>