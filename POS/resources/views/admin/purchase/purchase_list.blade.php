@extends('admin.layout')

@section('title','Purchase List')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Purchase List</h2>
        <a href="{{url('purchase_form')}}"><button class="btn btn-info" style="float:right">Purchase Now</button></a>
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
	                      <th>Purchase No</th>
	                      <th>Date</th>
	                      <th>Product Name</th>
	                      <th>Unit</th>
	                      <th>Action</th>
	                    </tr>
	                  </thead>

	                  @foreach($allData as $data)
	                  <tr>
	                  	<td>{{$data->purchase_no}}</td>
                    	<td>{{$data->date}}</td>
                    	<td>{{$data->product_id}}</td>
                    	<td></td>
                    	<td>
                    		<button class="btn btn-info">Edit</button>
                    		<button class="btn btn-danger">Delete</button>
                    	</td>
                    </tr>	
	                  @endforeach
	                </table>
			  </div>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection