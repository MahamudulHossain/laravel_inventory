@extends('admin.layout')

@section('title','Invoice Report')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Invoice Report</h2>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="row">
              <div class="col-md-12">
	                <div class="card-box">
					<form action="{{url('invoiceReportPdf')}}" method="get" target="_blank">
						<div class="col-md-4">
							<level>Start Date</level>
							<input type="date" name="sDate" class="form-control" required="required">
						</div>
						<div class="col-md-4">
							<level>End Date</level>
							<input type="date" name="eDate" class="form-control" required="required">
						</div>
						<div class="col-md-4" style="margin-top: 18px;">
							
							<input type="submit" name="submit" class="btn btn-info" value="Search">
						</div>
					</form>
			  </div>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection