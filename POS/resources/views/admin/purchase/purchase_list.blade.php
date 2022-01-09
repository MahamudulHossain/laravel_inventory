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
                        <th>Supplier Name</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
	                      <th>Unit Price</th>
	                      <th>Buying Price</th>
                        <th>Status</th>
	                      <th>Action</th>
	                    </tr>
	                  </thead>

	                  @foreach($allData as $data)
	                  <tr>
	                  	<td>{{$data->purchase_no}}</td>
                    	<td>{{$data->date}}</td>
                      <td>{{$data->supNm}}</td>
                      <td>{{$data->catNm}}</td>
                      <td>{{$data->proNm}}</td>
                      <td>{{$data->description}}</td>
                      <td>
                        <?php
                          $getUnit = getUnitId($data->product_id);
                          $getUnitName = getUnitName($getUnit['0']->uid);
                        ?>

                        {{$data->buying_qty}} {{$getUnitName['0']->name}}
                      </td>
                      <td>{{$data->unit_price}}</td>
                      <td>{{$data->buying_price}}</td>
                    	<td>
                        @if($data->status == '0')
                          <a href="{{url('updateStatus',$data->id)}}"><button class="btn btn-warning btn-sm">Pending</button></a>
                        @else
                          <button class="btn btn-success btn-sm" disabled>Approved</button>  
                        @endif
                      </td>
                    	<td>
                        @if($data->status == '0')
                    		<a href="{{url('delPurchase',$data->id)}}"><button class="btn btn-danger btn-sm">Delete</button></a>
                        @endif
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