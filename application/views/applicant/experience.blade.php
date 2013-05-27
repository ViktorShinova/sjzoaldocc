@if ( isset ( $message ) ) 

<div class="validation success">
	<p>
		{{ $message }}
	</p>
</div>

@endif



<ul>
	@foreach ($experiences as $experience)
	<li>

		<h4>{{$experience->company_name}} 
			<button title="Delete" class="btn btn-mini btn-danger eremove pull-right" type="button" data-eid="{{ $experience->id }}"><i class="icon-remove"></i></button>
			<button title="Edit" class="btn btn-mini eedit btn-warning pull-right" type="button" data-eid="{{ $experience->id }}"><i class="icon-pencil"></i></button>
		</h4>
		<p>From: {{$experience->started_month}} {{$experience->started_year}} to 
			@if ($experience->ended_year == 1)
			Current
			@else
			{{$experience->ended_month}} {{$experience->ended_year}}
			@endif
		</p>
		<p>Industry: {{$experience->industry}}</p>
		<p>Position: {{$experience->position}}</p>
		<p>Job Scope:  {{$experience->description}}</p>
	</li>
	@endforeach
</ul>


