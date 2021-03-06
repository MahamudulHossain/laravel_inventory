@extends('admin.layout')

@section('title','Purchase Now')

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
				<h2>Purchase <small>provide information about the purchase</small></h2>
				@if(session()->has('error'))
					<div style="float: right; color: red; font-size: 18px;">{{session()->get('error')}}</div>
				@endif
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
					<div class="card-columns">
						<p class="card-para">Date</p>
					    <div class="card">
					      <div class="card-body">
					        <input type="date" name="date" id="date" class="form-control">
					      </div>
					      <div id="dateError" class="errorMsg"></div>
					    </div>
					    <p class="card-para">Category Name</p>
					    <div class="card">
					      <div class="card-body">
					        <select name="category_id" id="category_id" class="form-control">
					        	<option value="">Select Category</option>
					        </select>
					      </div>
					      <div id="cateError" class="errorMsg"></div>
					    </div>
					    <p class="card-para">Purchase Number</p>
					    <div class="card">
					      <div class="card-body">
					        <input type="text" name="purchase_no" id="purchase_no" class="form-control" placeholder="Purchase No">
					      </div>
					      <div id="purError" class="errorMsg"></div>
					    </div>
					    <p class="card-para">Product Name</p>
					    <div class="card">
					      <div class="card-body">
					        <select name="product_id" id="product_id" class="form-control">
					        	<option value="">Select Product</option>
					        </select>
					      </div>
					      <div id="proError" class="errorMsg"></div>
					    </div>  
					    <p class="card-para">Supplier Name</p>
					    <div class="card">
					      <div class="card-body">
					        <select name="supplier_id" id="supplier_id" class="form-control">
					        	<option value="">Select Supplier</option>
					        	@foreach($supplier as $supplier)
									<option value="{{$supplier->id}}">{{$supplier->name}}</option>
								@endforeach
					        </select>
					      </div>
					      <div id="supError" class="errorMsg"></div>
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
									<th>Description</th>
									<th width="10%">Total Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="addRow" class="addRow">
								
							</tbody>
							<tbody>
								<tr>
									<td colspan="5"></td>
									<td>
										<input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
									</td>
									<td></td>
								</tr>
							</tbody>	
							</table>
							<button class="btn btn-primary mt-3" type="submit">Purchase</button>
						</form>
					</div>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$("#supplier_id").on("change",function(){
		var supId = $(this).val();
		$.ajax({
			url: "{{url('get-category')}}",
			type: "GET",
			data: {supId : supId},
			success: function(result){
				var html = '<option value="">Select Category</option>';
				$.each(result.data,function(key,val){
					html += '<option value="'+val.catId+'">'+val.catName+'</option>';
				});
				$("#category_id").html(html);
			}
		});
	});

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


	$("#addMore").on("click",function(){
		var date = $("#date").val();
		var purchase_no = $("#purchase_no").val();
		var supplier_id = $("#supplier_id").find('option:selected').val();
		var category_id = $("#category_id").find('option:selected').val();
		var category_nm = $("#category_id").find('option:selected').text();
		var product_id = $("#product_id").find('option:selected').val();
		var product_nm = $("#product_id").find('option:selected').text();

		
		if(date == ''){
			$("#dateError").html("Date is required");
			return false;
		}
		if(purchase_no == ''){
			$("#purError").html("Purchase No is required");
			return false;
		}
		if(supplier_id == 'Select Supplier'){
			$("#supError").html("Supplier is required");
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

		var tblRow = '<tr><td><input type="hidden" name="date[]" value="'+date+'"><input type="hidden" name="purchase_no[]" value="'+purchase_no+'"><input type="hidden" name="supplier_id[]" value="'+supplier_id+'"><input type="hidden" name="category_id[]" value="'+category_id+'"><input type="hidden" name="product_id[]" value="'+product_id+'"></td></tr><tr><td><input type="text" value="'+category_nm+'" readonly="readonly" class="form-control"></td><td><input type="text" value="'+product_nm+'" readonly="readonly" class="form-control"></td><td><input type="number" min="1" value="1" name="buying_qty[]" class="form-control buying_qty"></td><td><input type="number" id="unit_price" name="unit_price[]" class="form-control unit_price"></td><td><input type="text" id="desc" name="desc[]" class="form-control"></td><td><input type="text" id="buying_price" name="buying_price[]" class="form-control buying_price" readonly="readonly"></td><td><button class="btn btn-danger" onclick="removeMe(this)"> Delete</button></td></tr>';
		$("#addRow").append(tblRow);


	});
		

		function removeMe(that) {
	    	$(that).closest('tr').remove();
	    	totalAmountPrice();
		}

		$(document).on('keyup click','.unit_price,.buying_qty',function(){
			var buying_qty = $(this).closest("tr").find("input.buying_qty").val();
			var unit_price = $(this).closest("tr").find("input.unit_price").val();
			var total = buying_qty*unit_price;
			$(this).closest("tr").find("input.buying_price").val(total);
			totalAmountPrice();
		});

		//Calculate sum of total Amount
		function totalAmountPrice(){
			var sum=0;
			$(".buying_price").each(function(){
				var value = $(this).val();
				if(!isNaN(value) && value.length !=0){
					sum += parseFloat(value);
				}
			});
			$('#estimated_amount').val(sum);
		}
		


</script>



@endsection