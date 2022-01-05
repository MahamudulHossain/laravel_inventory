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
	                      <th>Supplier</th>
	                      <th>Category</th>
	                      <th>Unit</th>
	                      <th>Product Name</th>
	                      <th>Purchase No</th>
	                      <th>Date</th>
	                      <th>Unit Price</th>
	                      <th>Buying price</th>
	                      <th>Description</th>
	                      <th>Created By</th>
	                      <th>Updated By</th>
	                      <th>Action</th>
	                    </tr>
	                  </thead>


	                 
	                </table>
			  </div>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection