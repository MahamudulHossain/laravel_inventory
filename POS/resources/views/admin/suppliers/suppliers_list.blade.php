@extends('admin.layout')

@section('title','Suppliers List')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Suppliers List</h2>
        <a href="{{url('add_suppliers_form')}}"><button class="btn btn-info" style="float:right">Add Suppliers</button></a>
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
	                      <th>Name</th>
	                      <th>Mobile No</th>
	                      <th>Email</th>
	                      <th>Address</th>
	                      <th>Created By</th>
	                      <th>Updated By</th>
	                      <th>Action</th>
	                    </tr>
	                  </thead>


	                  <tbody>
	                  	@foreach($data as $data)
	                    <tr>
	                    	<td>{{$data->name}}</td>
	                    	<td>{{$data->mobile_no}}</td>
	                    	<td>{{$data->email}}</td>
	                    	<td>{{$data->address}}</td>
	                    	<td>{{$data->created_by}}</td>
	                    	<td>{{$data->updated_by}}</td>
	                    	<?php
	                    		$supplierChk = App\Models\Products::where('supplier_id',$data->id)->count();
	                    	?>
	                    	<td>
	                    		<a href="{{url('editSupplier',$data->id)}}"><button class="btn btn-sm btn-primary">Edit</button></a>
	                    		@if($supplierChk<1)
	                    		<a href="{{url('delSupplier',$data->id)}}"><button class="btn btn-sm btn-danger">Delete</button></a>
	                    		@endif
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