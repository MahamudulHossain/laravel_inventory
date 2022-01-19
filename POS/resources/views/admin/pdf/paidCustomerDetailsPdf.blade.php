<!DOCTYPE html>
<html>
<head>
	<title>Paid Customar Detail</title>
</head>
<body>
	<div>
		<div style="margin-left: 220px; margin-bottom: 25px; width: 180px;height: 35px;border: 1px solid black;">
			<table>
				<tr>
					<td><strong> Paid Customar Detail </strong></td>
				</tr>
			</table>
		</div>
		<div>
			<?php
        		$cudID = App\Models\Payment::where('invoice_id',$invoice_no)->first()->customer_id;
        		$cusInfo = App\Models\Customers::find($cudID);
        	?>
			<table width="100%" style="line-height: 25px;">
				<tr>
					<td width="25%"><strong>Customar Name: </strong>{{$cusInfo->name}}</td>
					<td width="25%"><strong>Mobile No: </strong>{{$cusInfo->mobile_no}}</td>
					<td width="50%"><strong>Address: </strong>{{$cusInfo->address}}</td>
				</tr>
				
			</table>

			<table border="1" width="100%" class="mt-3" style="line-height:30px">
				<thead>
					<tr style="text-align: center">
						<th width="5%">SL.</th>
						<th width="30%">Category</th>
						<th width="30%">Product Name</th>
						<th width="10%">Puchase Quantity</th>
						<th width="15%">Unit Price</th>
						<th width="20%">Total Price</th>
					</tr>
				</thead>
				<tbody>
					<?php $subTotal=0;?>
					@foreach($details as $key=>$val)
					<tr>
						<td style="text-align: center">{{$key+1}}</td>
						<?php 
							$catNm = App\Models\Categories::where('id',$val->catID)->first()->name;
						?>
						<td style="text-align: center">{{$catNm}}</td>
						<?php 
							$proNm = App\Models\Products::where('id',$val->proID)->first();
						?>
						<td  style="text-align: center">{{$proNm->name}}</td>
						<td style="text-align: center">{{$val->sQuan}}</td>
						<td style="text-align: center">{{$val->uPrice}}</td>
						<td style="text-align: center">{{$val->sPrice}}</td>
					</tr>
					<?php $subTotal += $val->sPrice;?>
				@endforeach	
					<tr>
						<td colspan="5" style="text-align: right;"><b>Subtotal</b></td>
						<td class="text-center"><b>{{$subTotal}}/-</b></td>
					</tr>
					<tr>
						<td colspan="5" style="text-align: right;"><b>Discount</b></td>
						<td class="text-center"><b>{{$val->disAmount}}/-</b></td>
					</tr>
					<tr>
						<td colspan="5" style="text-align: right;"><b>Subtotal</b></td>
						<td class="text-center"><b>{{$val->tAmount}}/-</b></td>
					</tr>
					<tr>
						<td colspan="5" style="text-align: right;"><b>Paid Amount</b></td>
						<td class="text-center"><b>{{$val->pAmount}}/-</b></td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: center;background-color: #BB8FCE";><b>Credit Details</b></td>
					</tr>
					<tr>
						<td style="text-align: center;" colspan="3"><b>Date of Payment</b></td>
						<td style="text-align: center;" colspan="3"><b>Amount</b></td>
					</tr>
					<?php
						$payDetail = App\Models\PaymentDetail::where('invoice_id',$invoice_no)->get();
					?>
					@foreach($payDetail as $pD)
					<tr>
						<td style="text-align: center;" colspan="3">{{date('d-m-Y',strtotime($pD->date))}}</td>
						<td style="text-align: center;" colspan="3">{{$pD->current_paid_amount}}/-</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			
			<div style="margin-top: 25px;">
				<table width="100%">
					<tr>
						<td width="75%">
							<?php $DateAndTime = date('d-m-Y', time());?>
							Date: <?php echo $DateAndTime;?>	
							</td>
						<td width="25%">
							<hr>
						</td>
					</tr>
					<tr>
						<td></td>
						<td style="text-align: center;">Owner's Sign.</td>
					</tr>
				</table>
			</div>			
						
		</div>
	</div>
</body>
</html>