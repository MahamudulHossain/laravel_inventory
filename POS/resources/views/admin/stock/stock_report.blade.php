@extends('admin.layout')

@section('title','Stock Report')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Stock Report</h2>
        <a href="{{url('download-stock-report')}}" target="_blank"><button class="btn btn-info" style="float:right"><i class="fa fa-download" aria-hidden="true"> Download Pdf</i></button></a>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="row">
              <div class="col-sm-12">
	                <div class="card-box table-responsive">
					<table id="datatable" class="table table-striped table-bordered" style="width:100%">
	                  <thead>
	                    <tr>
	                      <th>Supplier Name</th>
	                      <th>Category</th>
	                      <th>Product Name</th>
	                      <th>Quantity</th>
	                      <th>Unit</th>
	                    </tr>
	                  </thead>


	                  <tbody>
	                  	@foreach($data as $data)
	                    <tr>
	                    	<td>{{$data->sname}}</td>
	                    	<td>{{$data->catname}}</td>
	                    	<td>{{$data->name}}</td>
	                    	<td>{{$data->quantity}}</td>
	                    	<td>{{$data->uname}}</td>
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