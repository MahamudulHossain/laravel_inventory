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
</style>
<div class="row">
	<div class="col-md-12 col-sm-12 ">
		<div class="x_panel">
			<div class="x_title">
				<h2>Purchase <small>provide information about the purchase</small></h2>
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
					    </div>
					    <p class="card-para">Category Name</p>
					    <div class="card">
					      <div class="card-body">
					        <select name="category_id" id="category_id" class="form-control">
					        	<option value="">Select Category</option>
					        </select>
					      </div>
					    </div>
					    <p class="card-para">Purchase Number</p>
					    <div class="card">
					      <div class="card-body">
					        <input type="text" name="purchase_no" id="purchase_no" class="form-control" placeholder="Purchase No">
					      </div>
					    </div>
					    <p class="card-para">Product Name</p>
					    <div class="card">
					      <div class="card-body">
					        <select name="product_id" id="product_id" class="form-control">
					        	<option value="">Select Product</option>
					        </select>
					      </div>
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
					    </div>
					    <button type="submit" class="btn btn-success mt-4">+ Add More</button>
					</div>		
					<div class="ln_solid"></div>

					<div class="card-body">
						<form>
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
							<button class="btn btn-primary mt-3">Purchase</button>
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
		var supId = $("#supplier_id").val();
		var catId = $(this).val();
		$.ajax({
			url: "{{url('get-product')}}",
			type: "GET",
			data: {supId : supId,catId : catId},
			success: function(result){
				var html = '<option value="">Select Product</option>';
				$.each(result.data,function(key,val){
					html += '<option value="'+val.proId+'">'+val.proName+'</option>';
				});
				$("#product_id").html(html);
			}
		});
	});


</script>



@endsection