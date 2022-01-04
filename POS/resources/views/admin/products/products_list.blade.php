@extends('admin.layout')

@section('title','Products List')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Products List</h2>
        <a href="{{url('add_products_form')}}"><button class="btn btn-info" style="float:right">Add Products</button></a>
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
	                <div class="card-box table-responsive">
					<table id="datatable" class="table table-striped table-bordered" style="width:100%">
	                  <thead>
	                    <tr>
	                      <th>Supplier</th>
	                      <th>Category</th>
	                      <th>Product Name</th>
	                      <th>Unit</th>
	                      <th>Quantity</th>
	                      <th>Created By</th>
	                      <th>Updated By</th>
	                      <th>Action</th>
	                    </tr>
	                  </thead>


	                  <tbody>
	                  	@foreach($data as $data)
	                    <tr>
	                    	<td>{{$data->sname}}</td>
	                    	<td>{{$data->catname}}</td>
	                    	<td>{{$data->name}}</td>
	                    	<td>{{$data->uname}}</td>
	                    	<td>{{$data->quantity}}</td>
	                    	<td>{{$data->created_by}}</td>
	                    	<td>{{$data->updated_by}}</td>
	                    	<td>
	                    		<a href="{{url('editProduct',$data->id)}}"><button class="btn btn-sm btn-primary">Edit</button></a>

	                    		<a href="{{url('delProduct',$data->id)}}"><button class="btn btn-sm btn-danger">Delete</button></a>
	                    	</td>
	                    </tr>
	                    @endforeach
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