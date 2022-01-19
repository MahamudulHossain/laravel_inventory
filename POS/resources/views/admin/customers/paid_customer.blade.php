@extends('admin.layout')

@section('title','Paid Customer')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Paid Customer Report</h2>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="row">
              <div class="col-sm-12">
	                <div class="card-box table-responsive">
					<table id="datatable" class="table table-striped table-bordered" style="width:100%">
	                  <thead>
	                    <tr>
	                      <th>Customer</th>
	                      <th>Invoice No</th>
	                      <th>Date</th>
	                      <th>Action</th>
	                    </tr>
	                  </thead>
	                   <tbody>
	                   	@foreach($data as $data)
	                  		<?php
				        		$cusData = App\Models\Customers::where('id',$data->customer_id)->first();
				        		$invDate = App\Models\Invoice::where('invoice_no',$data->invoice_id)->first();
				        	?>
	                    <tr>
	                    	<td>
	                    		{{$cusData->name}} ({{$cusData->mobile_no}}) <br>(Address: {{$cusData->address}})
	                    	</td> 
	                    	<td>Invoice #{{$data->invoice_id}}</td>
	                    	<td>{{date('d-m-Y',strtotime($invDate->date))}}</td>
	                    	<td>
	                    		<a href="{{url('paid_customer_pdf',[$data->invoice_id,$cusData->id])}}" target="_blank"><button class="btn btn-sm btn-primary">Details</button></a>
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