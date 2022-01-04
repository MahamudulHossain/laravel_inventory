@extends('admin.layout')

@section('title','Add Product')

@section('content')

<div class="row">
	<div class="col-md-12 col-sm-12 ">
		<div class="x_panel">
			<div class="x_title">
				<h2>Add Product <small>provide information about the product</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{url('addProduct')}}" method="post">
					@csrf
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Supplier <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 ">
							<select name="supplier_id" class="form-control" required="required">
								<option value="">Select Supplier</option>
								@foreach($supplier as $supplier)
									<option value="{{$supplier->id}}">{{$supplier->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Category <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 ">
							<select name="category_id" class="form-control" required="required">
								<option value="">Select Category</option>
								@foreach($categories as $categories)
									<option value="{{$categories->id}}">{{$categories->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Unit <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 ">
							<select name="unit_id" class="form-control" required="required">
								<option value="">Select Unit</option>
								@foreach($units as $units)
									<option value="{{$units->id}}">{{$units->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Name <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 ">
							<input type="text" required="required" class="form-control" name="name" placeholder="Enter product name">
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="item form-group">
						<div class="col-md-6 col-sm-6 offset-md-3">
							<button type="submit" class="btn btn-success">Submit</button>
							<button class="btn btn-primary" type="reset">Reset</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>



@endsection