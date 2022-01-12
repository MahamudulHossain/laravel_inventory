@extends('admin.layout')

@section('title','Approve Invoice Form')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Invoice No # {{$data->invoice_no}} ({{$data->date}})</h2>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
        	@if(session()->has('message'))
                <div class="alert alert-success alert-dismissible " role="alert">
                    {{session('message')}}
                  </div>
              @endif
          <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                	<?php

                		$cudID = App\Models\Payment::where('invoice_id',$data->invoice_no)->first()->customer_id;
                		$cusInfo = App\Models\Customers::find($cudID);
                	?>
					<table width="100%" style="line-height: 25px;">
						<tr>
							<td width="15%"><strong>Customar Info</strong></td>
							<td width="25%"><strong>Customar Name: </strong>{{$cusInfo->name}}</td>
							<td width="25%"><strong>Mobile No: </strong>{{$cusInfo->mobile_no}}</td>
							<td width="35%"><strong>Address: </strong>{{$cusInfo->address}}</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3"><strong>Description: </strong>{{$data->description}}</td>
						</tr>
					</table>
					<table border="1" width="100%" class="mt-3" style="line-height:30px">
						<thead>
							<tr class="text-center">
								<th>SL.</th>
								<th>Category</th>
								<th>Product Name</th>
								<th style="background-color: #ddd;">Current Stock</th>
								<th>Puchase Quantity</th>
								<th>Unit Price</th>
								<th>Total Price</th>
							</tr>
						</thead>
						<tbody>
							<?php $subTotal=0;?>
							@foreach($details as $key=>$val)
								<tr class="text-center">
									<td>{{$key+1}}</td>
									<?php 
										$catNm = App\Models\Categories::where('id',$val->catID)->first()->name;
									?>
									<td>{{$catNm}}</td>
									<?php 
										$proNm = App\Models\Products::where('id',$val->proID)->first();
									?>
									<td>{{$proNm->name}}</td>
									<td>{{$proNm->quantity}}</td>
									<td>{{$val->sQuan}}</td>
									<td>{{$val->uPrice}}</td>
									<td>{{$val->sPrice}}</td>
								</tr>
								<?php $subTotal += $val->sPrice;?>
							@endforeach	
								<tr>
									<td colspan="6" class="text-right"><b>Subtotal</b></td>
									<td class="text-center"><b>{{$subTotal}}/-</b></td>
								</tr>
								<tr>
									<td colspan="6" class="text-right"><b>Discount</b></td>
									<td class="text-center"><b>{{$val->disAmount}}/-</b></td>
								</tr>
								<tr>
									<td colspan="6" class="text-right"><b>Subtotal</b></td>
									<td class="text-center"><b>{{$val->tAmount}}/-</b></td>
								</tr>
								<tr>
									<td colspan="6" class="text-right"><b>Paid Amount</b></td>
									<td class="text-center"><b>{{$val->pAmount}}/-</b></td>
								</tr>
								<tr>
									<td colspan="6" class="text-right"><b>Due Amount</b></td>
									<td class="text-center"><b>{{$val->dueAmount}}/-</b></td>
								</tr>
						</tbody>
					</table>
		  		</div>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection