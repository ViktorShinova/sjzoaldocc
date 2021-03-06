@layout('layout.employer')
@section('page-id')page-employer-adverts@endsection
@section('content')

	<h2>Active Job Adverts</h2>
	
	<div class="table-container drop-shadow-butterfly">
        <div class="table-header-wrapper">
           
			<div class="table-toolbar">
				<a href="/employer/post/create"><i class="icon-plus-sign icon-white"></i>Have a new position?</a>
			</div>
        </div>
		<table>
			<tr class="table-header-row">
				<th>Title</th>
				<th>Created on</th>
				<th>Modified on</th>
				<th>Status</th>
				<th># of Applicants</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			@foreach( $jobs->results as $job )
			<tr class="table-data-row">
				<td><a href="/job/article/{{$job->slug}}">{{ $job->title }}</a></td>
				<td style="width: 250px;">{{ Formatter::format_date($job->created_at, Formatter::DATE_LONG_W_TIME) }}</td>
				<td style="width: 250px;">{{ Formatter::format_date($job->updated_at, Formatter::DATE_LONG_W_TIME) }}</td>
				<td style="width: 80px;">
					@if ( $job->status === 1 )
					Active
					@elseif ( $job->status === 0 )
					Inactive
					@endif
				</td>
				<td>{{$job->num_of_applicants}}</td>
				<td style="width: 50px;"><a href="/employer/post/details/{{$job->id}}">Details</a></td>
				@if($job->status == 1)
				<td style="text-align:center;width: 10px;"><a title="Deactivate" href="/employer/post/change_status/{{$job->id}}/deactivate"><i class="icon-stop"></i></a></td>
				@elseif ($job->status== 0)
				<td style="text-align:center;width: 10px;"><a title="Activate" href="/employer/post/change_status/{{$job->id}}/activate"><i class="icon-play"></i></a></td>
				@endif
			
				<td style="text-align:center; width: 10px;"><a title="Edit" href="/employer/post/edit/{{$job->id}}"><i class="icon-edit"></i></a></td>
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
    <a href="#" class="btn"  data-dismiss="modal">Cancel</a>
    <a href="" class="btn btn-danger" id="btn-job-delete">Delete</a>
  </div>
</div>
@endsection