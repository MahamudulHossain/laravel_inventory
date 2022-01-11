@extends('admin.layout')

@section('title','Invoice')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Invoice List</h2>
        <a href="{{url('invoice_form')}}"><button class="btn btn-info" style="float:right">Add Invoice</button></a>
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
	                      <th>Customar Name</th>
	                      <th>Invoice No.</th>
	                      <th>Date</th>
	                      <th>Description</th>
	                      <th>Amount</th>
	                    </tr>
	                  </thead>


	                  <tbody>
	                  	@foreach($allData as $data)
	                    	<tr>
		                    	<td>{{$data->cName}}</td>
		                    	<td>Invoice No #{{$data->invoice_no}}</td>
		                    	<td>{{date('d-m-Y',strtotime($data->date))}}</td>
		                    	<td>{{$data->description}}</td>
		                    	<td>{{$data->total_amount}}</td>
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