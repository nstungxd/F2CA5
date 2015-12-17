<table class='' style='text-align:center;'>
	<thead>
		<tr style='text-align:center'>
			<th class="" style='text-align:center;width:5%;'>No</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Trainer Name</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Center Name</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Trainer ID</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Password</th>
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
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->Name ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->CenterNm ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->UserID ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->UserPW ?></td>
			<td>
				<button class="normal" onclick="onModify(<?php echo $res['data']->Seq ?>)">Modify</button>
				<button class="normal" onclick="onDelete(<?php echo $res['data']->Seq ?>)">Delete</button>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>