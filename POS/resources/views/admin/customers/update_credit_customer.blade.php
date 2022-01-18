@extends('admin.layout')

@section('title','Update Credit Customer')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h1>Update Credit Customer </h1>
        <h2>Invoice No #{{$invoice_no}}</h2>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="row">
              <div class="col-sm-12">
              	<div>
              		@if(session()->has('msg'))
					<div style="float: right; color: blue; font-size: 18px;">{{session()->get('msg')}}</div>
				@endif
              	</div>
	            <div class="card-box table-responsive">
					<table width="100%" style="line-height: 35px;">
						<tr>
							<td><strong>Customar Info</strong></td>
						</tr>
						<tr>
							<td width="25%"><strong>Name: </strong>{{$cutomerData->name}}</td>
							<td width="25%"><strong>Mobile No: </strong>{{$cutomerData->mobile_no}}</td>
							<td width="50%"><strong>Address: </strong>{{$cutomerData->address}}</td>
						</tr>
					</table>
				<form action="{{url('store-credit-customer',$invoice_no)}}" method="POST">
						@csrf
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
							<td colspan="5" style="text-align: right;"><b>Due Amount</b></td>
							<input type="hidden" name="due_amount" value="{{$val->dueAmount}}">
							<td class="text-center"><b>{{$val->dueAmount}}/-</b></td>
						</tr>
					</tbody>
				</table>
				<div class="mt-3">
					<p class="card-para">Payment Type</p> 
					<select name="paid_status" class="form-control col-md-3 paid_status" id="paid_status" required="required">
						<option value="">Select payment type</option>
						<option value="paid">Paid</option>
						<option value="partital_paid">Partital Paid</option>
					</select>
				</div>
				<div class="col-md-9">
					<div class="col-md-6">
					<input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" id="paid_amount" placeholder="Enter the paid amount" style="display: none;">
					</div>
					<div class="col-md-6">
						<input type="date" name="date" id="date" class="form-control" required="required">
					</div>
				</div>
				<button class="btn btn-primary" type="submit" style="margin-top: 15px;">Pay</button>
			</form>
			  </div>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$("#paid_status").on('change',function(){
			$paid_status = $(this).val();
			if($paid_status == 'partital_paid'){
				$("#paid_amount").show();
			}else{
				$("#paid_amount").hide();
			}
		});
</script>

@endsection