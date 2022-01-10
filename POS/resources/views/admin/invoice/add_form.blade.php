@extends('admin.layout')

@section('title','Create Invoice')

@section('content')

<style type="text/css">
	.card-body{
		padding: 0px;
	}
	.card-para{
		font-weight: bold;
		font-size: 18px;
		margin-bottom: -4px;
	}
	.errorMsg{
		color: red;
		font-weight: bold;
		font-size: 16px;
	}
</style>
<div class="row">
	<div class="col-md-12 col-sm-12 ">
		<div class="x_panel">
			<div class="x_title">
				<h2>Invoice <small>provide information of invoice</small></h2>
				@if(session()->has('error'))
					<div style="float: right; color: red; font-size: 18px;">{{session()->get('error')}}</div>
				@endif
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
					<div class="card-columns">
						<div class="card">
						<p class="card-para">Invoice No</p>
					      <div class="card-body">
					        <input type="text" name="invoice_number" id="invoice_number" value="{{$invoice_no}}" class="form-control" readonly>
					      </div>
					      <div></div>
					    </div>
					    <div class="card">
						<p class="card-para">Date</p>
					      <div class="card-body">
					        <input type="date" name="date" id="date" class="form-control">
					      </div>
					      <div id="dateError" class="errorMsg"></div>
					    </div>
					    <div class="card">
					      <p class="card-para">Category Name</p>
					      <div class="card-body">
					        <select name="category_id" id="category_id" class="form-control">
					        	<option value="">Select Category</option>
					        	@foreach($categories as $categories)
									<option value="{{$categories->id}}">{{$categories->name}}</option>
								@endforeach
					        </select>
					      </div>
					      <div id="cateError" class="errorMsg"></div>
					    </div>
					    <div class="card">
					      <p class="card-para">Product Name</p>
					      <div class="card-body">
					        <select name="product_id" id="product_id" class="form-control">
					        	<option value="">Select Product</option>
					        </select>
					      </div>
					      <div id="proError" class="errorMsg"></div>
					    </div>
					    <div class="card">
					      <p class="card-para">Available Stock</p>
					      <div class="card-body">
					        <input type="text" name="available_stock" id="available_stock" class="form-control" readonly>
					      </div>
					      <div></div>
					    </div>
					    <button type="submit" class="btn btn-success mt-4" id="addMore">+ Add More</button>
					</div>		
					<div class="ln_solid"></div>

					<div class="card-body">
						<form action="{{url('purchase_now')}}" method="post">
							@csrf
							<table class="table-sm table-bordered" width="100%"> <thead>
								<tr>
									<th>Category</th>
									<th>Product Name</th>
									<th width="7%">Pcs/Kg</th>
									<th width="10%">Unit Price</th>
									<th width="15%">Total Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="addRow" class="addRow">
								
							</tbody>
							<tbody>
								<tr>
									<td colspan="4"></td>
									<td>
									<input type="text" name="discount_amount" id="discount_amount" placeholder="Discount amount" class="form-control form-control-sm discount_amount mt-2">
									</td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4"><textarea name="description" class="form-control description" id="description" placeholder="Add description...."></textarea></td>
									<td>
										<input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
									</td>
									<td></td>
								</tr>
							</tbody>	
							</table>
							<div class="mt-3">
								<p class="card-para">Payment Type</p> 
								<select name="paid_status" class="form-control col-md-3 paid_status" id="paid_status">
									<option value="">Select payment type</option>
									<option value="paid">Paid</option>
									<option value="due">Due</option>
									<option value="partital_paid">Partital Paid</option>
								</select>
							</div>
							<div class="col-md-3 mt-2 paid_amount_div" style="display: none;">
								<input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" id="paid_amount" placeholder="Enter the paid amount">
							</div>
							<br/><br/><br/>
							<button class="btn btn-primary mt-3" type="submit">Purchase</button>
						</form>
					</div>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$("#category_id").on("change",function(){
		var catId = $(this).val();
		$.ajax({
			url: "{{url('get-product')}}",
			type: "GET",
			data: {catId : catId},
			success: function(result){
				var html = '<option value="">Select Product</option>';
				$.each(result.data,function(key,val){
					html += '<option value="'+val.proId+'">'+val.proName+'</option>';
				});
				$("#product_id").html(html);
			}
		});
	});
	$("#product_id").on("change",function(){
		var proId = $(this).val();
		$.ajax({
			url: "{{url('get-stoke')}}",
			type: "GET",
			data: {proId : proId},
			success: function(result){
				$("#available_stock").val(result.data);
			}
		});
	});


	$("#addMore").on("click",function(){
		var date = $("#date").val();
		var invoice_number = $("#invoice_number").val();
		var category_id = $("#category_id").find('option:selected').val();
		var category_nm = $("#category_id").find('option:selected').text();
		var product_id = $("#product_id").find('option:selected').val();
		var product_nm = $("#product_id").find('option:selected').text();

		
		if(date == ''){
			$("#dateError").html("Date is required");
			return false;
		}
		if(category_id == 'Select Category'){
			$("#cateError").html("Category is required");
			return false;
		}
		if(product_id == 'Select Product'){
			$("#proError").html("Product Name is required");
			return false;
		}

		//Creating tablr row

		var tblRow = '<tr><td><input type="hidden" name="date" value="'+date+'"><input type="hidden" name="invoice_number" value="'+invoice_number+'"><input type="hidden" name="category_id[]" value="'+category_id+'"><input type="hidden" name="product_id[]" value="'+product_id+'"></td></tr><tr><td><input type="text" value="'+category_nm+'" readonly="readonly" class="form-control"></td><td><input type="text" value="'+product_nm+'" readonly="readonly" class="form-control"></td><td><input type="number" min="1" value="1" name="selling_qty[]" class="form-control selling_qty"></td><td><input type="number" id="unit_price" name="unit_price[]" class="form-control unit_price"></td><td><input type="text" id="selling_price" name="selling_price[]" class="form-control selling_price" readonly="readonly"></td><td><button class="btn btn-danger" onclick="removeMe(this)"> Delete</button></td></tr>';
		$("#addRow").append(tblRow);


	});
		

		function removeMe(that) {
	    	$(that).closest('tr').remove();
	    	totalAmountPrice();
		}

		$(document).on('keyup click','.unit_price,.selling_qty',function(){
			var selling_qty = $(this).closest("tr").find("input.selling_qty").val();
			var unit_price = $(this).closest("tr").find("input.unit_price").val();
			var total = selling_qty*unit_price;
			$(this).closest("tr").find("input.selling_price").val(total);
			//$("#discount_amount").trigger('keyup');
			totalAmountPrice();

		});

		$(document).on('keyup',"#discount_amount",function(){
			totalAmountPrice();
		});

		//Calculate sum of total Amount
		function totalAmountPrice(){
			var sum=0;
			$(".selling_price").each(function(){
				var value = $(this).val();
				if(!isNaN(value) && value.length !=0){
					sum += parseFloat(value);
				}	
			});

			var discount_amount = $("#discount_amount").val();
			if(!isNaN(discount_amount) && discount_amount.length !=0){
					sum -= parseFloat(discount_amount);
				}
			$('#estimated_amount').val(sum);
		}
		


</script>



@endsection