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
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{url('addCustomer')}}" method="post">
					@csrf
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
					    <button type="submit" class="btn btn-success mt-4">Add More</button>
					</div>		
					<div class="ln_solid"></div>

				</form>
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
</script>



@endsection