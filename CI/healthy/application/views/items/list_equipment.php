<table class='' style='text-align:center;'>
	<thead>
		<tr style='text-align:center'>
			<th class="" style='text-align:center;width:5%;'>No</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Center Name</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Exercise</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Name</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>Equipment Number</th>
			<th class="" onclick="" style='text-align:center;width:10%;'>NFC Code</th>
			<th class="" style='text-align:center;width:15%;'></th>
		</tr>
	</thead>
	<tbody>
<?php if (count($results) == 0): ?>
		<tr>
			<td colspan="7">No Data</td>
		</tr>
<?php endif; ?>
<?php foreach ($results as $res): ?>
		<tr style='text-align:center'>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['idx'] ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->CenterNm ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->ExName ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->EqName ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->EqNum ?></td>
			<td class="click" onclick="javascript:onDetail(<?php echo $res['data']->Seq ?>);"><?php echo $res['data']->NFCCode ?></td>
			<td>
				<button class="normal" onclick="onModify(<?php echo $res['data']->Seq ?>)">Modify</button>
				<button class="normal" onclick="onDelete(<?php echo $res['data']->Seq ?>)">Delete</button>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>