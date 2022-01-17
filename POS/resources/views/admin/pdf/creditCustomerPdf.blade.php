<!DOCTYPE html>
<html>
<head>
	<title>Credit Customer</title>
</head>
<body>
	<div>
		<div style="margin-left: 270px; margin-bottom: 25px; width: 130px;height: 35px;border: 1px solid black;">
			<table>
				<tr>
					<td><strong> Credit Customer </strong></td>
				</tr>
			</table>
		</div>
		<div>
			<table border="1" width="100%" class="mt-3" style="line-height:30px">
					<thead>
						<tr style="text-align: center">
							<th>SL.</th>
							<th>Customer</th>
	                      	<th>Invoice No</th>
	                      	<th>Date</th>
	                      	<th>Amount</th>
						</tr>
					</thead>

					<tbody>
	                   	@foreach($data as $key=>$data)
	                  		<?php
				        		$cusData = App\Models\Customers::where('id',$data->customer_id)->first();
				        		$invDate = App\Models\Invoice::where('invoice_no',$data->invoice_id)->first();
				        	?>
	                    <tr>
	                    	<td>{{$key+1}}</td>
	                    	<td>
	                    		{{$cusData->name}} ({{$cusData->mobile_no}}) <br>(Address: {{$cusData->address}})
	                    	</td> 
	                    	<td>Invoice #{{$data->invoice_id}}</td>
	                    	<td>{{date('d-m-Y',strtotime($invDate->date))}}</td>
	                    	<td>{{$data->due_amount}}</td>
	                    	
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