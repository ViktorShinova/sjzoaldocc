@if ( isset ( $message ) ) 

<div class="validation success">
	<p>
		{{ $message }}
	</p>
</div>

@endif



<table>

	<tr>
		<th class="level">Level</th>
		<th class="title">Title</th>
		<th class="institude">Institude</th>
		<th class="started">Started</th>
		<th class="ended">Ended</th>
		<th class="control"></th>
	</tr>
	@foreach ($qualifications as $qualification)
	<tr>
		<td>{{$qualification->level}}</td>
		<td>{{$qualification->title}}</td>
		<td>{{$qualification->institude}}</td>
		<td>{{$qualification->started}}</td>
		<td>{{$qualification->ended}}</td>
		<td>
			<button title='Edit' class="btn btn-mini qedit btn-warning'" type="button" data-qid="{{ $qualification->id }}"><i class="icon-pencil"></i></button>
			<button title='Delete' class="btn btn-mini qremove" type="button" data-qid="{{ $qualification->id }}"><i class="icon-remove"></i></button>
		</td>
	</tr>
	@endforeach
</table>

