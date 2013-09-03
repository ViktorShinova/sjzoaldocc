@layout('layout.admin')

@section('content')

	<h2>Review Job Posts</h2>
	
	<div class="table-container">
		<table>
			<thead>
			<tr class="table-header-row">
				<th>Title</th>
				<th>Created on</th>
				<th>Modified on</th>
				<th>Status</th>
				<th></th>
				<th></th>
			</tr>
			</thead>
			@foreach( $jobs as $job )
			<tr class="table-data-row">
				<td><a href="/admin/post/view/{{$job->id}}">{{ $job->title }}</a></td>
				<td style="width: 250px;">{{ Formatter::format_date($job->created_at, Formatter::DATE_LONG_W_TIME) }}</td>
				<td style="width: 250px;">{{ Formatter::format_date($job->updated_at, Formatter::DATE_LONG_W_TIME) }}</td>
				<td style="width: 80px;">
					@if ( $job->verify === 1 )
					Verified
					@elseif ( $job->verify === 0 )
					Not Verified
					@endif
				</td>
				@if($job->verify == 1)
				<td style="text-align:center;width: 10px;"><a title="Verified" href="/admin/post/verify/{{$job->id}}/0"><i class="icon-stop"></i></a></td>
				@elseif ($job->verify== 0)
				<td style="text-align:center;width: 10px;"><a title="Verify" href="/admin/post/verify/{{$job->id}}/1"><i class="icon-play"></i></a></td>
				@endif
				<td style="text-align:center; width: 10px;"><a title="Delete" href="/admin/post/delete/{{$job->id}}" class="job-delete"><i class="icon-trash"></i></a></td>
			</tr>
			@endforeach
		</table>
		
    </div>

@endsection