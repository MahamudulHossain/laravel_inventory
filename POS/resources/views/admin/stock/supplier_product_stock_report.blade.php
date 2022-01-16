@extends('admin.layout')

@section('title','Supplier- Productwise Stock Report')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Supplier- Productwise Stock Report</h2>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="row">
	          <div class="col-sm-12">
		           <div class="card-box">
						<div class="text-center">
							<level>Supplier wise report</level>
							<input type="radio" name="supplier_product_wise" value="supplier_id" class="supProStock">
							&nbsp;&nbsp;
							<level>Product wise report</level>
							<input type="radio" name="supplier_product_wise" value="product_id" class="supProStock">
						</div>
				  </div>
	          </div>
          </div>
          <div class="row mt-5 supplierDiv" style="display: none">
          	<div class="col-md-9">
          		<form action="{{url('supplierWiseStock')}}" method="GET" target="_blank"> 
          		<div class="col-md-8">
          		<select name="supplierId" class="form-control" required="required"> 
          			<option value="">Select Supplier Name</option>
          			@foreach($suppliers as $supplier)
          				<option value="{{$supplier->id}}">{{$supplier->name}}</option>
          			@endforeach
          		</select>
	          	</div>
	          	<div class="col-md-4">
	          		<button type="submit" class="btn btn-info">Create</button>
	          	</div>
          	</form>
          	</div>
          </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).on('change','.supProStock',function(){
		var data = $(this).val();
		if(data == 'supplier_id'){
			$('.supplierDiv').show();
		}else{
			$('.supplierDiv').hide();
		}
	});
</script>

@endsection