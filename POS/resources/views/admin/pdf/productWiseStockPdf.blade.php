<!DOCTYPE html>
<html>
<head>
	<title>Product Wise Stock Report</title>
</head>
<body>
	<div>
		<div style="margin-left: 210px; margin-bottom: 25px; width: 220px;height: 35px;border: 1px solid black;">
			<table>
				<tr>
					<td><strong> Product Wise Stock Report </strong></td>
				</tr>
			</table>
		</div>
		<div>
			<span><strong>Product Name: </strong>{{$data['0']->name}}</span>
			<table border="1" width="100%" class="mt-3" style="line-height:30px">
					<thead>
						<tr style="text-align: center">
	                      <th>Supplier Name</th>
	                      <th>Category</th>
	                      <th>Quantity</th>
	                      <th>Unit</th>
						</tr>
					</thead>
					<tbody>
	                  	@foreach($data as $data)
	                    <tr>
	                    	<td>{{$data->sname}}</td>
	                    	<td>{{$data->catname}}</td>
	                    	<td>{{$data->quantity}}</td>
	                    	<td>{{$data->uname}}</td>
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