@layout('layout.admin')

@section('content')
<div class="span10">
	<h2>Review Job Posts</h2>
	
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
			@foreach( $jobs as $job )
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
</div>
@endsection