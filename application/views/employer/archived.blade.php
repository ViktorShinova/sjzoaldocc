@layout('layout.employer')
@section('page-id')page-employer-adverts@endsection
@section('content')
<h1 class="container-header">Jobs List</h1>
<div class="content">
	
	<div class="table-container">
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
				<td style="text-align:center; width: 10px;"><a title="Delete" href="/employer/post/delete/{{$job->id}}"><i class="icon-trash"></i></a></td>
			</tr>
			@endforeach
		</table>

    </div>

	
</div>

@endsection