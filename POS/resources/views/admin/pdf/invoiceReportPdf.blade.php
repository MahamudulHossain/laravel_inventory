<!DOCTYPE html>
<html>
<head>
	<title>Invoice Report</title>
</head>
<body>
	<div>
		<div style="margin-left: 270px; margin-bottom: 25px; width: 120px;height: 35px;border: 1px solid black;">
			<table>
				<tr>
					<td><strong> Invoice Report</strong></td>
				</tr>
			</table>
		</div>
		<table>
			<tr>
				<td><strong>Start Date: </strong>{{date('d-m-Y',strtotime($start_date))}}</td>
			</tr>
			<tr>
				<td><strong>End Date: </strong>{{date('d-m-Y',strtotime($end_date))}}</td>
			</tr>
		</table>
		<div>
			<?php 
				$grandAmount = 0;
				$dueAmount = 0;
				$receivedAmount = 0;
			?>
			@foreach($data as $data)
			<?php
        		$payInfo = App\Models\Payment::where('invoice_id',$data->invoice_no)->first();
        		$cusInfo = App\Models\Customers::find($payInfo->customer_id);
        	?>
			<table width="100%" border="1" style="line-height: 25px;">
				<tr>
					<th width="40%">Customar Info</strong></th>
					<th width="10%">Invoice No. </th>
					<th width="10%"><strong>Date</th>
					<th width="30%">Description</th>
					<th width="10%">Amount</th>
				</tr>
				<tr>
					<td>{{$cusInfo->name}} ({{$cusInfo->mobile_no}})<br>{{$cusInfo->address}}</td>
					<td style="text-align: center">{{$data->invoice_no}}</td>
					<td>{{date('d-m-Y',strtotime($data->date))}}</td>
					<td style="text-align: center">{{$data->description}}</td>
					<td>{{$payInfo->total_amount}}/-</td>
					<?php 
						$grandAmount += $payInfo->total_amount;
						$dueAmount += $payInfo->due_amount;
						$receivedAmount += $payInfo->paid_amount;
					?>
				</tr>
			</table>	
			<br><br>
			@endforeach	
			<table width="100%"> 
				<tr>
					<td width="90%" style="text-align: right"><strong>Grand Amount: </strong></td>
					<td>{{$grandAmount}}/-</td>
				</tr>
				<tr>
					<td width="90%" style="text-align: right"><strong>Due Amount: </strong></td>
					<td>{{$dueAmount}}/-</td>
				</tr>
				<tr>
					<td width="90%" style="text-align: right"><strong>Received Amount: </strong></td>
					<td>{{$receivedAmount}}/-</td>
				</tr>
			</table>
			<div style="width: 150px;">
				<table>
				<tr>
					<td><hr></td>
				</tr>
				<tr>
					<td>Audit's Sign</td>
				</tr>
			</table>
			</div>
		</div>
	</div>
</body>
</html>