@extends('layout.app')

@section('content')
	
<div class="container">
<div class="row">
<div class="col-md-12 p-5">
<table id="VisitorDt" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">NO</th>
	  <th class="th-sm">IP</th>
	  <th class="th-sm">Date & Time</th>
    </tr>
  </thead>
 
  <tbody>
  	 @foreach($visitor_data as $visitor_data)
    <tr>
    <th class="th-sm">{{$visitor_data->id}}</th>
	  <th class="th-sm">{{$visitor_data->ip_address}}</th>
	  <th class="th-sm">{{$visitor_data->visit_time}}</th>
    </tr>	
   @endforeach
  </tbody>
   
</table>

</div>
</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function () {
  $('#VisitorDt').DataTable();
   
  $('.dataTables_length').addClass('bs-select');
  });

</script>>
@endsection