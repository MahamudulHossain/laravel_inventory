@extends('admin.layout')

@section('title','Units')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Add Units</h2>
         <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{url('addUnit')}}" method="post">
			@csrf
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 ">
					<input type="text" required="required" class="form-control" name="name">
				</div>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		 </form>
        <div class="clearfix"></div>
      </div>
      <div class="x_title">
        <h2>Units List</h2>
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
	                      <th>Created By</th>
	                      <th>Action</th>
	                    </tr>
	                  </thead>


	                  <tbody>
	                  	@foreach($data as $data)
	                    <tr>
	                    	<td>{{$data->name}}</td>
	                    	<td>{{$data->created_by}}</td>
	                    	<td>
	                    		<a href="{{url('delUnit',$data->id)}}"><button class="btn btn-sm btn-danger">Delete</button></a>
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