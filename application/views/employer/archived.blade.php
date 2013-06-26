@layout('layout.employer')
@section('page-id')page-employer-adverts@endsection
@section('content')
<h2>History</h2>

<div class="table-container drop-shadow-butterfly">
	<div class="table-header-wrapper">
		<h2 class="table-header">Archived Jobs</h2>
		<div class="table-toolbar">
			<a href="/employer/post/create"><i class="icon-plus-sign icon-white"></i>Have a new position?</a>
		</div>
	</div>
	<table>
		<tr class="table-header-row">
			<th style="width:200px">Title</th>
			<th>Date created</th>
			<th>Date modified</th>
			<th></th>
		</tr>
		@foreach( $jobs->results as $job )
		<tr class="table-data-row">
			<td><a href="/job/article/{{$job->id}}">{{ $job->title }}</a></td>
			<td style="width: 150px;">{{ Formatter::format_date($job->created_at, Formatter::DATE_LONG_W_TIME) }}</td>
			<td style="width: 150px;">{{ Formatter::format_date($job->updated_at, Formatter::DATE_LONG_W_TIME) }}</td>
			<td style="text-align:center; width: 10px;"><a title="Delete" href="/employer/post/delete/{{$job->id}}" class="job-delete"><i class="icon-trash"></i></a></td>
		</tr>
		@endforeach
	</table>

</div>

{{$jobs->links()}}


<div id="job-delete-modal" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Are you sure ?</h3>
  </div>
  <div class="modal-body">
    <p>Are you sure you want to delete this job?</p>
  </div>
  <div class="modal-footer">
    <a href="" class="btn">Cancel</a>
    <a href="" class="btn btn-danger">Delete</a>
  </div>
</div>


@endsection